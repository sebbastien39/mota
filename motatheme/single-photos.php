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
                <?php
                    //Flèche gauche, requête pour récupérer les données par date==========================================
                    $previous = array(
                        'post_type' => 'photos',
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'ASC',
                        'date_query' => array(
                            'after' => get_the_date('Y-m-d H:i:s'),
                        ),
                    );
                    $query_previous = new WP_Query($previous);

                    //
                    if($query_previous->have_posts()) {
                        $query_previous->the_post();
                        $image_previous_id = get_post_thumbnail_id();
                        if($image_previous_id) {
                            $image_previous = wp_get_attachment_image_src($image_previous_id, 'mota-thumbnail');
                            echo '<img class="display-none-image-left" src="'.$image_previous[0].'">';
                        }   
                    };
                    wp_reset_postdata();

                    //Flèche droite, requête pour récupérer les données par date=====================================
                    $next = array(
                        'post_type' => 'photos',
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'date_query' => array(
                            'before' => get_the_date('Y-m-d H:i:s'),
                       
                        ),
                    );
                    $query_next = new WP_Query($next);
                    if($query_next->have_posts()) {
                        $query_next->the_post();
                        $image_next_id = get_post_thumbnail_id();
                        if($image_next_id) {
                            $image_next = wp_get_attachment_image_src($image_next_id, 'mota-thumbnail');
                            echo '<img class="display-none-image-right" src="'.$image_next[0].'">';
                        }                       
                    };
                    wp_reset_postdata();                   
                ?>
                </div>
                <div class="bloc3-arrows">
                    <?php
                        $post_previous = get_next_post();//Flèche gauche
                        if(!empty($post_previous)) {
                            $url_previous = get_permalink($post_previous);
                            ?>
                            <a href="<?= $url_previous ?>"><img class="arrow_left" src="<?= get_stylesheet_directory_uri()."/assets/images/arrow-left.png" ?>" alt="flèche gauche"></a>
                            <?php
                        };
                    ?>
                    <?php
                        $post_next = get_previous_post();//Flèche droite
                        if(!empty($post_next)) {
                            $url_next = get_permalink($post_next);
                            ?>
                            <a href="<?= $url_next ?>"><img class="arrow_right" src="<?= get_stylesheet_directory_uri()."/assets/images/arrow-right.png" ?>" alt="flèche droite"></a>
                            <?php
                        };
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bloc4">
            <p>Vous aimerez aussi</p>
        <div class="autres-images">
            <?php 
            $categorie = get_the_terms($post->ID, 'motatheme_categorie' );
            // 1. On définit les arguments pour définir ce que l'on souhaite récupérer
            $args = array(
                'post_type' => 'photos',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'motatheme_categorie',
                        'field' => 'id',
                        'terms' => $categorie[0]->term_id,
                    )
                    ),             
                'orderby' => 'rand',
                'post__not_in' => array($post->ID),
                'posts_per_page' => 2,
            );
            // 2. On exécute la WP Query
            $my_query = new WP_Query( $args );

            // 3. On lance la boucle !
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();        
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