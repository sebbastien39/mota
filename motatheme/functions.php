<?php
require_once('includes/assets.php');//Enqueuing Scripts and Styles
require_once('includes/supports.php');//Titre site, logo, prise en charge images
require_once('includes/menus.php');//Menus de navigation

//add_action('wp_enqueue_scripts', function() {
//    wp_enqueue_style('mota', get_template_directory_uri() . '/assets/css/main.css', array(), time());
//    wp_enqueue_script( 'mota', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), time(), true);
//    //wp_localize_script('motatheme', 'motatheme_js', array('ajax_url' => admin_url('admin-ajax.php')));//permet de partager et de passer des données de PHP vers JavaScript de manière sécurisée
//    $x=wp_add_inline_script(
//        'mothatheme-script',
//        'const MYAJAX=' .wp_json_encode(
//            array(
//                'ajax_url' => admin_url('admin-ajax.php')
//            )
//        ),
//        'before');//requête ajax passe du valeur variablephp au JS
// var_dump('const MYAJAX=' .wp_json_encode(
//    array(
//        'ajax_url' => admin_url('admin-ajax.php')
//    )
//)); die();
//});

//add_action('wp_ajax_charger_plus', 'charger_plus');
//add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');
//
//function charger_plus() {
//    wp_send_json(array('ok'=>'ok'));
//}



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

