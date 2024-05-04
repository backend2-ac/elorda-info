CKEDITOR.plugins.add('customPasteHandler', {
    init: function(editor) {
        
        editor.on('paste', function(evt) {
            
            // Получить вставляемый контент
            var html = evt.data.dataValue;

            //console.log('Original HTML:', html);

            // Удалить font-size и font-family (обновленное регулярное выражение)
            html = html.replace(/style="[^"]*(font-size|font-family|margin|padding|color|line-height|background|border|text-align|font-weight|font-style)[^;"]*;?[^"]*"/gi, '');

            //console.log('Filtered HTML:', html);

            // Вернуть отфильтрованный HTML
            evt.data.dataValue = html;
        });
    }
});
