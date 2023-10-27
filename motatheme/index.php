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
  
        </div>
        <div class="select-right">
       
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