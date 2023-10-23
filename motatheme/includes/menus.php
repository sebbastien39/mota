<?php
add_action('after_setup_theme', function() {
    register_nav_menu( 'main-menu', __( 'Menu principal Desktop', 'motatheme' ) );
    register_nav_menu('footer-menu', __( 'Pied de page', 'motatheme' ) );
});
