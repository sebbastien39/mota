<?php
//====================Enqueuing Scripts and Styles
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('mota', get_template_directory_uri() . '/assets/css/main.css', array(), time());
    wp_enqueue_script( 'mota', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
});




