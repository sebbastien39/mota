<?php get_header(); ?>

<main>
<img class="hero-titre" src="<?php echo get_template_directory_uri() . '/assets/images/photographe-event-hero.png'; ?> " alt="">

    <div class="hero-image">
    <?php
        
        $args = array(
            'post_type' => 'photos',
            'orderby' => 'rand',
            'posts_per_page' => 1,
        );
        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();        
            the_post_thumbnail('mota-hero');
        endwhile;
        endif;
        wp_reset_postdata();
        ?> 
    </div>
    <div class="container-select">
        <div class="select-left">
        <select id="category-filter">
            <option value="" disabled selected class="hidden-option">Catégories</option>
            <option value="Reception">Réception</option>
            <option value="Mariage">Mariage</option>
            <option value="Concert">Concert</option>
            <option value="Television">Télévision</option>
        </select>



            <select id="format-filter">
                <option value="" disabled selected class="hidden-option">Formats</option>
                <option value="">Tous</option>
                <option value="paysage">Paysage</option>
                <option value="portrait">Portrait</option>
            </select>
        </div>
        <div class="select-right">
            <select id="date-sort">
                <option value="" disabled selected class="hidden-option">Trier par date</option>
                <option value="desc">Plus récentes</option>
                <option value="asc">Plus anciennes</option>
            </select>
        </div>        
    </div>
    <div class="selection-images">
            <?php 
            $args = array(
                'post_type' => 'photos',
                array(
                'taxonomy' => 'motatheme_categorie',
                ),
                'orderby' => 'rand',
                'post__not_in' => array($post->ID),
                'posts_per_page' => 8,
            );
            $my_query = new WP_Query( $args );

            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();        
                get_template_part('template-parts/photo_block');
            endwhile;
            endif;
            wp_reset_postdata();
            ?>  
        </div>
         <div class="btn-charger-plus">
            <button>Charger plus</button>
         </div>   

</main>

<?php get_footer(); ?>