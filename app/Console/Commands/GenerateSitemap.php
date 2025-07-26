<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\StaticPage;

class GenerateSitemap extends Command
{
    protected $signature = 'app:generate-sitemap';
    protected $description = 'Генерирует sitemap.xml для сайта';

    public function handle()
    {
        $this->info('Начинаем генерацию карты сайта...');

        // Создаем экземпляр карты сайта
        $sitemap = Sitemap::create();

        // 1. Добавляем статичные страницы
        $sitemap->add(Url::create('/')->setPriority(1.0)); // Главная страница
        $sitemap->add(Url::create('/blog')->setPriority(0.9)); // Главная страница блога

        // 2. Добавляем все опубликованные посты из блога
        Post::whereNotNull('published_at')->get()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(
                Url::create("/blog/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setPriority(0.8)
            );
        });

        // 3. Добавляем все статические страницы
        StaticPage::all()->each(function (StaticPage $page) use ($sitemap) {
            $sitemap->add(
                Url::create("/pages/{$page->slug}")
                    ->setLastModificationDate($page->updated_at)
                    ->setPriority(0.7)
            );
        });

        // Сохраняем файл в папку public
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Карта сайта успешно сгенерирована!');
        return 0;
    }
}
