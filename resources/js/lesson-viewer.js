import edjsHTML from 'editorjs-html';
import Prism from 'prismjs';

const initViewer = () => {
    const viewerElement = document.getElementById('editorjs-viewer');
    if (!viewerElement) return;

    // --- ИСПРАВЛЕНИЕ: Переносим объявление сюда ---
    const customParsers = {
        image: function(block){
            return `<img class="img-fluid w-full rounded-lg my-4" src="${block.data.file.url}" alt="${block.data.caption}">`;
        },
        code: function(block) {
            // Указываем язык, чтобы Prism мог его подсветить
            const code = block.data.code.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            return `<pre><code class="language-js">${code}</code></pre>`;
        },
        warning: function(block) {
            return `<div class="p-4 my-4 border-l-4 border-yellow-500 bg-yellow-500/20 text-yellow-300">
                        <strong class="font-bold">${block.data.title}</strong><br>
                        ${block.data.message}
                    </div>`;
        },
        checklist: function(block) {
            let itemsHtml = block.data.items.map(item =>
                `<div class="flex items-center">
                    <span class="mr-2">${item.checked ? '✅' : '⬜️'}</span>
                    <span>${item.text}</span>
                </div>`
            ).join('');
            return `<div class="my-4">${itemsHtml}</div>`;
        },
        table: function(block) {
            let rowsHtml = block.data.content.map(row =>
                `<tr>${row.map(cell => `<td class="border border-gray-600 p-2">${cell}</td>`).join('')}</tr>`
            ).join('');
            return `<table class="w-full my-4 border-collapse border border-gray-600"><tbody>${rowsHtml}</tbody></table>`;
        },
        attaches: function(block) {
            return `<a href="${block.data.file.url}" target="_blank" rel="noopener noreferrer" class="block my-4 p-4 bg-gray-700 rounded-lg hover:bg-gray-600">
                        📎 Скачать файл: ${block.data.file.name}
                    </a>`;
        },
        linkTool: function(block) {
            return `<a href="${block.data.link}" target="_blank" rel="noopener noreferrer" class="block my-4 p-4 bg-gray-700 rounded-lg hover:bg-gray-600">
                        <strong class="block">${block.data.meta.title}</strong>
                        <span class="text-sm text-gray-400">${block.data.meta.description}</span>
                    </a>`;
        }
    };
    // --- КОНЕЦ ИСПРАВЛЕНИЯ ---

    const content = JSON.parse(viewerElement.dataset.content || '{}');

    if (content && content.blocks && content.blocks.length > 0) {
        const edjsParser = edjsHTML(customParsers);
        const html = edjsParser.parse(content);
        viewerElement.innerHTML = html;

        // Запускаем подсветку синтаксиса
        Prism.highlightAll();

    } else {
        viewerElement.innerHTML = '<p class="p-10 text-center text-custom-text-secondary">Контент для этого урока еще не добавлен.</p>';
    }
}

initViewer();
