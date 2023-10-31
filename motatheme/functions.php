<?php
require_once('includes/assets.php');//Enqueuing Scripts and Styles
require_once('includes/supports.php');//Titre site, logo, prise en charge images
require_once('includes/menus.php');//Menus de navigation

//====================Image size
add_action('register_my_image_sizes', function () {
    add_image_size( 'mota-thumbnail', 80, 80, 'center' );
    add_image_size('mota-image-resultat', 564, 495, 'center');
    add_image_size('mota-hero', 1440, 962);
});

//====================Création custom post type - type de contenu personnalisé X1 "Photos"
function motatheme_register_custom_post_types() {    
    $labels_photo = array(    
    'menu_name'         => __('Photos', 'motatheme'), 
    'name_admin_bar'    => __('Photo', 'motatheme'),    
    'add_new' =>__('Ajouter', 'motatheme'),  
    'not_found' => __('Aucune photo trouvée', 'motatheme'),
    'add_new_item'      => __('Ajouter une nouvelle photo', 'motatheme'),       
    'new_item'          => __('Nouvelle photo', 'motatheme'),       
    'edit_item'         => __('Modifier la photo', 'motatheme'),
        
); 
$args_photo = array(    
    'label'             => __('Photos', 'motatheme'),    
    'description'       => __('Photos', 'motatheme'),    
    'labels'            => $labels_photo,    
    'supports'          => array('title', 'thumbnail'), //interface   
    'taxonomies'    => array('motatheme_categorie', 'motatheme_format'),//lien entre cpt et taxonomies
    'hierarchical'      => false,    
    'public'            => true,    
    'show_ui'           => true,    
    'show_in_menu'      => true,    
    'menu_position'     => 2,//40    
    'show_in_admin_bar' => true,    
    'show_in_nav_menus' => true,    
    'can_export'        => true,    
    'has_archive'       => true,
    'exclude_from_search'   => false,    
    'publicly_queryable' => true,    
    'capability_type'   => 'post',  //gestion de droit  
    'menu_icon'  => 'dashicons-camera-alt',
    'show_in_rest' => true,//accessible depuis l'API
); 
register_post_type('photos', $args_photo);
}
//Création custom post type - type de contenu personnalisé "Photos"
add_action('init', 'motatheme_register_custom_post_types', 11);

//====================Création taxonomie X2 - "Catégorie" et "Format" sur custom_post_type "photos"
function motatheme_init() {
    register_taxonomy('motatheme_categorie','photos',[//concert, mariage, réception, télévision
        'labels' => [
            'name' => 'Catégories',
        ],
        'show_in_rest' => true,//accessible dans l'éditeur de block
        'hierarchical' => true,//checkbox
        'show_admin_column' => true, //Affiche catégorie ds admin photos
        ]);
        register_taxonomy('motatheme_format','photos',[//paysage, portrait
            'labels' => [
                'name' => 'Formats',
            ],
            'show_in_rest' => true,//accessible dans l'éditeur de block
            'hierarchical' => true,//checkbox
            'show_admin_column' => true, //Affiche format ds admin photos
            ]);
}
//====================initialisation des taxonomies "catégorie" et "format"
add_action('init', 'motatheme_init');



//====================Chargement Ajax des image Btn "Charger plus" index.php
add_action('wp_ajax_charger_plus', 'charger_plus_callback');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus_callback');



function charger_plus_callback() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $excluded_posts = isset($_POST['data_loaded']) ? array_map('intval', $_POST['data_loaded']) : array();

    $args = array(
        'post_type' => 'photos',
        'orderby' => 'rand',
        'posts_per_page' => 8,
        'paged' => $page,
        'post__not_in' => $excluded_posts,
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
            $post_id = get_the_ID();
            
            // Output the content of each photo block
            get_template_part('template-parts/photo_block');
            //echo '</div>';
        endwhile;
    endif;

    wp_reset_postdata();

    die();
}


//=========================================================Label
add_action('wp_ajax_filter_photos', 'filter_photos_callback');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_callback');

function filter_photos_callback() {

    $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => $_POST['date_choix'],//choix_date
        'posts_per_page' => -1,
    );
    $sb_tax_query = array();
    if(!empty($_POST['categorie_choix'])){
       $sb_tax_query[]=
            array(
                'taxonomy' => 'motatheme_categorie',
                'field' => 'id',
                'terms' => $_POST['categorie_choix'],//POST ou GET
            );
        }
        if(!empty($_POST['format_choix'])){
            $sb_tax_query[]=
            array(
                'taxonomy' => 'motatheme_format',
                'field' => 'id',
                'terms' => $_POST['format_choix'],//récupère le format paysage / portrait
            );
        }
        
        if(!empty($sb_tax_query)) {
            $args['tax_query']=$sb_tax_query;
        }

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
            $post_id = get_the_ID();
            
            // Output the content of each photo block
            get_template_part('template-parts/photo_block');
            //echo '</div>';
        endwhile;
    endif;

    wp_reset_postdata();

    die();
}