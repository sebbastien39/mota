<!--header-->
<?php get_header(); //Cette fonction appelle le fichier header.php ?>
<!--contenu page single-photo.php-->

<!--zone de contenu-->
<main>
    <div class="container-contenu-image">
        <div class="container-image">
            <div class="bloc1">
                <?php if (have_posts()): while (have_posts()): the_post(); //Boucle WP, affiche 1 ou plusieurs articles?>    
                    <article>
                        <h2><?php the_title(); ?></h2>
                        <p>RÉFÉRENCE : <span id="reference"><?php the_field('reference-photo'); //champs ACF Référence?></span></p>
                        <P>CATÉGORIE : <?php the_terms(get_the_ID(), 'motatheme_categorie'); //Récupération taxonomie catégorie?></p>
                        <P>FORMAT : <?php the_terms(get_the_ID(), 'motatheme_format'); //Récupération taxonomie formats?></p>
                        <P>TYPE : <?php the_field('type-photo'); //champs ACF argentique/numérique?></p>
                        <P>ANNÉE : <?php the_time( 'Y', $photos ); ?></p>
                    </article>        
                <?php endwhile; else: ?>
                <p>Aucune photo : </p>
                <?php endif; ?>
            </div>
            <div class="bloc2">
            <?php the_post_thumbnail(); ?>
            </div>
        </div>
        <div class="bloc3">
            <div class="bloc3-button">
                <p>Cette photo vous intéresse ?</p>
                <button class="contact-btn">Contact</button>
            </div>
            <div class="bloc3-image">
                <div class="bloc3-image-image">
                <?php the_post_thumbnail('mota-thumbnail'); ?>
                </div>
                <div class="bloc3-arrows">
                   <a href="<?php the_post_navigation(); ?>"><img src="<?= get_stylesheet_directory_uri()."/assets/images/arrow-left.png" ?>" title='hello' alt="arrow-left"></a>
                   <a href="<?php the_post_navigation(); ?>"><img src="<?= get_stylesheet_directory_uri()."/assets/images/arrow-right.png" ?>" alt="arrow-right"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="bloc4">
            <p>Vous aimerez aussi</p>
        <div class="autres-images">
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
                'posts_per_page' => 2,
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
        <div class="bloc4-button">
            <button>Toutes les photos</button>
        </div>
    </div>
</main>
<!--footer-->
<?php get_footer(); //appel le fichier footer.php ?>