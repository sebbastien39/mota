<?php
defined('ABSPATH') or die('');

add_action('after_setup_theme', function() {
    add_theme_support('title_tag');// Ajouter automatiquement le titre du site dans l'en-tête du site
    add_theme_support( 'custom-logo' );//Ajout ds le Dashbord "Ajout logo"
    add_theme_support( 'post-thumbnails' );//Prise en charge des images
    //add_theme_support( 'responsive-embeds' );
});