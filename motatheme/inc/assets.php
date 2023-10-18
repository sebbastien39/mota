<?php
//====================Enqueuing Scripts and Styles
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('mota', get_template_directory_uri() . '/assets/css/main.css', array(), time());
    wp_enqueue_script( 'mota', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), time(), true);
    wp_localize_script('motatheme', 'motatheme_js', array('ajax_url' => admin_url('admin-ajax.php')));//permet de partager et de passer des données de PHP vers JavaScript de manière sécurisée
});
