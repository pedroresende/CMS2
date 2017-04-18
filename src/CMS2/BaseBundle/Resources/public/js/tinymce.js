tinymce.init({
    selector: 'textarea',
    menubar: true,
    height: 300,
    toolbar: "undo redo | styleselect | bold italic underline hr | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code fullscreen",
    autosave_ask_before_unload: false,
    removed_menuitems: 'newdocument',
    plugins: ['link image code fullscreen table image'],
    image_list: "/app_dev.php/admin/files/imagelist",
    convert_urls: false
});