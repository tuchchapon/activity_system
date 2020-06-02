//$(function () {
//    //CKEditor
//    CKEDITOR.replace('ckeditor');
//    CKEDITOR.config.height = 300;
//    CKEDITOR.editorConfig = function (config) {
//        config.toolbar = [
//            {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']},
//            {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
//            {name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
//            {name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
//            '/',
//            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']},
//            {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']},
//            {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
//            {name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']},
//            '/',
//            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
//            {name: 'colors', items: ['TextColor', 'BGColor']},
//            {name: 'tools', items: ['Maximize', 'ShowBlocks']},
//            {name: 'about', items: ['About']}
//        ];
//    };
//});


var toolbarGroups = [
    {name: 'document', groups: ['document', 'mode', 'doctools','list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']}, 
];

var initEditor = function () {
    return CKEDITOR.replace('ckeditor', {
        toolbar: 'Basic',
        uiColor: '#9AB8F3',
        toolbarGroups,
    });
}
initEditor();