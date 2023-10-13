<!--fichier affichant par défaut quelque chose sur le site web-->
<!--code de la page d'accueil-->
<?php get_header(); //Cette fonction appelle le fichier header.php ?>

<!--contenu du site-->
<main>
    <div class="hero-image">
    <?php 
        // 1. On définit les arguments pour définir ce que l'on souhaite récupérer
        $args = array(
            'post_type' => 'photos',
            'orderby' => 'rand',
            'posts_per_page' => 1,
        );
        // 2. On exécute la WP Query
        $my_query = new WP_Query( $args );
        // 3. On lance la boucle !
        if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();        
            the_post_thumbnail('mota-hero');
        endwhile;
        endif;
        // 4. On réinitialise à la requête principale (important)
        wp_reset_postdata();
        ?> 
    </div>

            
    
</main>

<?php get_footer(); //appel le fichier footer.php ?>