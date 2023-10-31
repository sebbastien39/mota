<!--Pied de page appelé sur toutes les pages du site-->
<?php get_template_part('template-parts/modale'); ?>
<?php wp_footer() //Affiche WP action, ligne du dashboard?>
<footer>
<!--Code de la lightbox-->


<div class="lightbox__container">
    <button class="lightbox__close">Fermer</button>
    <button class="lightbox__next"></button>
    <button class="lightbox__prev"></button>
    <div class="lightbox__container__image">
        <img src="https://www.zooplus.fr/magazine/wp-content/uploads/2019/06/comprendre-le-langage-des-chats.jpg" alt="">
    </div>


</div>



    <?php wp_nav_menu([//======Menu de navigation du footer
            'theme_location' => 'footer-menu',
            //'container' => 'footer',
            ]); //Affiche le menu créé ds functions.php?>
    <p>TOUS DROITS RÉSERVÉS</p>
</footer>
</body>
</html>