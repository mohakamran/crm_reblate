<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Disable warnings to prevent cluttering output

    'public_path' => public_path(),  // Ensure this is correctly set for accessing public assets

    /*
     * Dejavu Sans font is missing glyphs for converted entities, turn it off if you need to show € and £.
     */
    'convert_entities' => true,

    'options' => [
        /**
         * The location of the DOMPDF font directory
         */
        'font_dir' => storage_path('fonts'),

        /**
         * The location of the DOMPDF font cache directory
         */
        'font_cache' => storage_path('fonts'),

        /**
         * The location of a temporary directory.
         */
        'temp_dir' => sys_get_temp_dir(),

        /**
         * DOMPDF chroot. This should be an absolute path.
         */
        'chroot' => realpath(base_path()),

        /**
         * Protocol whitelist
         */
        'allowed_protocols' => [
            'file://' => true,
            'http://' => true,
            'https://' => true,
        ],

        /**
         * Output file for log
         */
        'log_output_file' => storage_path('logs/dompdf.log'),

        /**
         * Whether to enable font subsetting or not.
         */
        'enable_font_subsetting' => true,

        /**
         * The PDF rendering backend to use
         */
        'pdf_backend' => 'CPDF',  // Default backend; can also use 'PDFLib' or 'GD'

        /**
         * Image DPI setting
         */
        'dpi' => 96,  // Adjusted for typical screen resolution; 96 is common

        /**
         * Enable inline PHP
         */
        'enable_php' => false, // Recommended to keep false for security

        /**
         * Enable inline Javascript
         */
        'enable_javascript' => false, // Typically false for security; true if required

        /**
         * Enable remote file access
         */
        'enable_remote' => true, // Ensure this is enabled to access images from URLs

        /**
         * Use the HTML5 Lib parser
         */
        'enable_html5_parser' => true, // True to use the HTML5 Lib parser for better compatibility
    ],
];
