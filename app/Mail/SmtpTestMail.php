<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SmtpTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Проверка настроек SMTP - AI Fire LMS')
            ->html('<p>Если вы получили это письмо, значит, ваши настройки SMTP работают корректно!</p>');
    }
}
