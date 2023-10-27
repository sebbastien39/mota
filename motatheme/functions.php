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





// Ajoutez cette fonction dans functions.php
function motatheme_localize_script()
{
    wp_localize_script('mota', 'myAjax', array('ajax_url' => admin_url('admin-ajax.php')));
}

// Appelez cette fonction avec l'action wp_enqueue_scripts
add_action('wp_enqueue_scripts', 'motatheme_localize_script');





add_action('wp_ajax_charger_plus', 'charger_plus_callback');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus_callback');

function charger_plus_callback()
{
    $args = array(
        'post_type' => 'photos',
        'orderby' => 'rand',
        'post__not_in' => isset($_POST['excluded_posts']) ? $_POST['excluded_posts'] : array(),
        'posts_per_page' => 8,
    );

    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
            get_template_part('template-parts/photo_block');
        endwhile;
    endif;

    wp_reset_postdata();

    die();
}
