(function() {
    tinymce.PluginManager.add('cshero_quote_btn', function( editor, url ) {
        editor.addButton( 'cshero_quote_btn', {
            text: 'Quote',
            icon: false,
            type: 'menubutton',
            menu: [
                {
                    text: 'Blockquote',
                    value: 'cms-blockquote',
                    onclick: function() {
                        editor.insertContent('<blockquote class="'+this.value()+'">'+tinyMCE.activeEditor.selection.getContent()+'<blockquote>');
                    }
                },
                {
                    text: 'Blockquote Alternate',
                    value: 'cms-blockquote-2',
                    onclick: function() {
                        editor.insertContent('<blockquote class="'+this.value()+'">'+tinyMCE.activeEditor.selection.getContent()+'<blockquote>');
                    }
                },
           ]
        });
    });
})();