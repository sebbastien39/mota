<!--Pied de page appelé sur toutes les pages du site-->
<?php get_template_part('template-parts/modale'); ?>
<?php wp_footer() //Affiche WP action, ligne du dashboard?>
<?php wp_nav_menu([
            'theme_location' => 'footer-menu',
            'container' => 'p',
            ]); //Affiche le menu créé ds functions.php?>
<p>TOUS DROITS RÉSERVÉS</p>
</body>
</html>