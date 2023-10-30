<?php get_header(); ?>

<main>
    <div class="container-image-hero">
        <img class="hero-image" src="<?php echo get_template_directory_uri() . '/assets/images/nathalie-11.jpeg'; ?>" alt="Votre Image">
        <img class="hero-titre" src="<?php echo get_template_directory_uri() . '/assets/images/photographe-event-hero.png'; ?>" alt="">
    </div>
    <div class="container-select">
        <div class="select-left">
        <select id="category-filter">
            <option value="" disabled selected class="hidden-option">Catégories</option>
            <?php 
                $categories = get_terms(array(
                    'taxonomy' => 'motatheme_categorie',
                    'fields' => 'all',

                ));
                foreach($categories as $categorie) {
                    echo('<option value="'.$categorie->term_id.'">'.$categorie->name.'</option>');
                }
            ?>

        </select>
        <select id="format-filter">
            <option value="" disabled selected class="hidden-option">Formats</option>
            <option value="">Tous</option>
            <?php 
                $formats = get_terms(array(
                    'taxonomy' => 'motatheme_format',
                    'fields' => 'all',

                ));
                foreach($formats as $format) {
                    echo('<option value="'.$format->term_id.'">'.$format->name.'</option>');
                }
            ?>

        </select>
        </div>
        <div class="select-right">
            <select id="date-sort">
                <option value="ASC" disabled selected class="hidden-option">Trier par date</option>
                <option value="DESC">Plus récentes</option>
                <option value="ASC">Plus anciennes</option>
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