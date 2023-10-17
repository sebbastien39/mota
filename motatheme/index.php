<!--fichier affichant par défaut quelque chose sur le site web-->
<!--code de la page d'accueil-->
<?php get_header(); //Cette fonction appelle le fichier header.php ?>

<!--contenu du site-->
<main>
    <h1>PHOTOGRAPHE EVENT</h1>
    <div class="hero-image">
    <?php
    //echo do_shortcode('[mota-banniere-titre titre="salut" src=""]');
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
    <div class="container-select">
        <div class="select-left">
            <label for="pet-select">Choose a pet:</label>
            <label for="pet-select">Choose a pet2:</label>   
        </div>
        <div class="select-right">
        <label for="pet-select"></label>  


<select name="pets" id="pet-select">
  <option value="">Choose a pet3:</option>
  <option value="dog">Dog</option>
  <option value="cat">Cat</option>
  <option value="hamster">Hamster</option>
  <option value="parrot">Parrot</option>
  <option value="spider">Spider</option>
  <option value="goldfish">Goldfish</option>
</select>
        </div>        
    </div>
    <div class="selection-images">
            <?php 
            // 1. On définit les arguments pour définir ce que l'on souhaite récupérer
            $args = array(
                'post_type' => 'photos',
                array(
                'taxonomy' => 'motatheme_categorie',
                ),
                'orderby' => 'rand',
                'post__not_in' => array($post->ID),
                
                //'category' => 'television',
                //'category_name' => 'reception',
                //'tag' => 'reception',
                //'meta_key' => 'reception', // nom du champ personnalisé
                //'meta_value_num' => 20, // ou meta_value pour tester un texte
                //'meta_compare' => '<' // < > != >= <=
                'posts_per_page' => 8,
            );

            // 2. On exécute la WP Query
            $my_query = new WP_Query( $args );

            // 3. On lance la boucle !
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();        
                //the_title();
                //the_content();
                get_template_part('template-parts/photo_block');
            endwhile;
            endif;

            // 4. On réinitialise à la requête principale (important)
            wp_reset_postdata();
            ?>  
        </div>
         <div class="btn-charger-plus">
            <button>Charger plus</button>
         </div>   

</main>

<?php get_footer(); //appel le fichier footer.php ?>