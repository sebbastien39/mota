<?php

add_theme_support('title-tag');
add_theme_support( 'custom-logo' );

function mota_theme_register_assets () {
    wp_enqueue_style('mota', get_template_directory_uri() . '/assets/css/main.css', array(), time());
    wp_enqueue_script( 'mota', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), time(), true);
}

//Création Menu de navigation
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal Desktop', 'motatheme' ) );
    register_nav_menu('footer-menu', __( 'Pied de page', 'motatheme' ) );
    //register_nav_menu( 'main-menu', 'En-tête Menu');
}


add_action('wp_enqueue_scripts', 'mota_theme_register_assets');
add_action( 'after_setup_theme', 'register_my_menu' );


