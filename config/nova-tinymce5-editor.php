<?php

return [
    /*
    |--------------------------------------------------------------------------------
    | Nova TinyMCE5 Editor config options
    |--------------------------------------------------------------------------------
    |
    */

    'options' => [
        'init' => [
            'menubar' => true,
            'autoresize_bottom_margin' => 200,
            'branding' => false,
            'image_caption' => true,
            'paste_as_text' => true,
            'paste_word_valid_elements' => 'b,strong,i,em,h1,h2',
            'external_filemanager_path' => '/vendor/tinymce/plugins/filemanager/',
            'filemanager_title' => 'Responsive Filemanager',
            'external_plugins' => [
                'filemanager' => '/vendor/tinymce/plugins/filemanager/plugin.min.js',
                'responsivefilemanager' => '/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js',
            ],
            'filemanager_access_key' => 'rtsCMS',
            'content_css' => mix('css/app.css')->__toString(),
        ],
        'plugins' => [
            'advlist autolink lists link image imagetools media',
            'paste code wordcount autoresize table responsivefilemanager fullscreen preview',
        ],
        'toolbar' => [
            'undo redo | formatselect forecolor backcolor |
                 bold italic underline strikethrough blockquote removeformat |
                 align bullist numlist outdent indent | link table | media insertmedialibrary image responsivefilemanager | fullscreen preview',
        ],
        'apiKey' => env('TINYMCE_API_KEY', ''),
    ],
];
