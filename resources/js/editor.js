import EditorJS from '@editorjs/editorjs';

// --- ИМПОРТИРУЕМ ВСЕ НАШИ ИНСТРУМЕНТЫ ---
import Header from '@editorjs/header';
import List from '@editorjs/list';
import CodeTool from '@editorjs/code';
import ImageTool from '@editorjs/image';
import Embed from '@editorjs/embed';
import Warning from '@editorjs/warning';
import Checklist from '@editorjs/checklist';
import Marker from '@editorjs/marker';
import InlineCode from '@editorjs/inline-code';
import Table from '@editorjs/table';
import Delimiter from '@editorjs/delimiter';
import SimpleImage from '@editorjs/simple-image';
import Quote from '@editorjs/quote';
import Attaches from '@editorjs/attaches';
import LinkTool from '@editorjs/link';


const initEditor = () => {
    const editorElement = document.getElementById('editorjs');
    if (!editorElement) return;
    console.log('Data from attribute:', editorElement.dataset.initialData); // <-- ДОБАВЬТЕ ЭТУ СТРОКУ

    const form = editorElement.closest('form');
    const output = document.getElementById('content_text_output');
    if (!form || !output) return;

    const initialData = JSON.parse(editorElement.dataset.initialData || '{}');
    const uploadImageUrl = editorElement.dataset.uploadImageUrl; // Переименуем для ясности
    const uploadFileUrl = editorElement.dataset.uploadFileUrl;
    const uploadUrl = editorElement.dataset.uploadUrl;
    const fetchUrl = editorElement.dataset.fetchUrl;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const editor = new EditorJS({
        holder: 'editorjs',
        // --- ДОБАВЛЯЕМ ВСЕ ИНСТРУМЕНТЫ В КОНФИГУРАЦИЮ ---
        tools: {
            header: Header,
            list: { class: List, inlineToolbar: true },
            checklist: Checklist,
            table: Table,
            quote: Quote,
            code: CodeTool,
            embed: Embed,
            warning: Warning,
            delimiter: Delimiter,
            marker: Marker,
            inlineCode: InlineCode,
            simpleImage: SimpleImage,
            image: {
                class: ImageTool,
                config: {
                    endpoints: { byFile: uploadUrl },
                    additionalRequestHeaders: { 'X-CSRF-TOKEN': csrfToken }
                }
            },
            attaches: {
                class: Attaches,
                config: {
                    endpoint: uploadFileUrl, // Указываем наш эндпоинт для файлов
                    additionalRequestHeaders: { 'X-CSRF-TOKEN': csrfToken }
                }
            },
            linkTool: {
                class: LinkTool,
                config: {
                    endpoint: fetchUrl, // Указываем наш эндпоинт для ссылок
                    additionalRequestHeaders: { 'X-CSRF-TOKEN': csrfToken }
                }
            },
        },
        data: initialData
    });

    // --- ИСПРАВЛЕННАЯ ЛОГИКА СОХРАНЕНИЯ ---
    form.addEventListener('submit', async (event) => {
        // 1. Всегда останавливаем отправку формы
        event.preventDefault();

        try {
            // 2. Ждем, пока Editor.js соберет данные
            const outputData = await editor.save();

            // 3. Кладем данные в скрытое поле
            output.value = JSON.stringify(outputData);

            // 4. Теперь, когда поле заполнено, отправляем форму
            form.submit();
        } catch (error) {
            console.error('Ошибка сохранения Editor.js:', error);
            // Можно добавить уведомление для пользователя
            alert('Не удалось сохранить контент. Пожалуйста, проверьте консоль.');
        }
    });
}

initEditor();
