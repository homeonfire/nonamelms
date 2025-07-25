import EditorJS from '@editorjs/editorjs';

// --- Импортируем все инструменты, которые мы используем ---
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
import Attaches from '@editorjs/attaches';
import SimpleImage from '@editorjs/simple-image';
import Quote from '@editorjs/quote';
import LinkTool from '@editorjs/link';
// ---------------------------------------------------------

const initPageEditor = () => {
    const editorElement = document.getElementById('editorjs');
    if (!editorElement) return;

    const form = editorElement.closest('form');
    const output = document.getElementById('content_text_output');
    // Находим кнопку по ID, который мы договорились использовать
    const saveButton = document.getElementById('save-page-btn');

    // Проверяем наличие всех ключевых элементов
    if (!form || !output || !saveButton) {
        console.error('Не найдены все необходимые элементы для редактора: форма, поле вывода или кнопка сохранения.');
        return;
    }

    // --- ИСПРАВЛЕНО: Берем данные из глобальной переменной, а не из атрибута ---
    const initialData = window.INITIAL_EDITOR_DATA || {};

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const editor = new EditorJS({
        holder: 'editorjs',
        // --- Полная конфигурация всех инструментов ---
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
                    endpoints: { byFile: '{{ route("admin.editorjs.upload-image") }}' }, // Этот URL нужно будет передать
                    additionalRequestHeaders: { 'X-CSRF-TOKEN': csrfToken }
                }
            },
            attaches: {
                class: Attaches,
                config: {
                    endpoint: '{{ route("admin.editorjs.upload-file") }}', // И этот
                    additionalRequestHeaders: { 'X-CSRF-TOKEN': csrfToken }
                }
            },
            linkTool: {
                class: LinkTool,
                config: {
                    endpoint: '{{ route("admin.editorjs.fetch-url") }}', // И этот
                    additionalRequestHeaders: { 'X-CSRF-TOKEN': csrfToken }
                }
            }
        },
        data: initialData
    });

    // --- ИСПРАВЛЕНО: Вместо 'submit' слушаем 'click' на кнопке ---
    saveButton.addEventListener('click', async () => {
        try {
            const outputData = await editor.save();
            output.value = JSON.stringify(outputData);
            form.submit();
        } catch (error) {
            console.error('Ошибка сохранения Editor.js:', error);
            alert('Не удалось сохранить контент. Пожалуйста, проверьте консоль.');
        }
    });
}

// Запускаем инициализацию
initPageEditor();
