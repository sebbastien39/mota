<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <?php wp_body_open(); ?>
    <header>
        <?php if (has_custom_logo()){//Aficher le Logo du site
            the_custom_logo();
        } else {
            echo get_bloginfo('name');
        } ?>
        <?php wp_nav_menu([
            'theme_location' => 'main-menu',
            'container' => 'nav',
            'container_class' => 'mota-menu',
        ]); //Affiche le menu créé ds functions.php?>
    </header>
