<?php

add_theme_support('title-tag');
//Ajout ds le Dashbord "Ajout logo"
add_theme_support( 'custom-logo' );

//Enqueuing Scripts and Styles
function mota_theme_register_assets () {
    wp_enqueue_style('mota', get_template_directory_uri() . '/assets/css/main.css', array(), time());
    wp_enqueue_script( 'mota', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), time(), true);
}

//Création Menu de navigation
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal Desktop', 'motatheme' ) );
    register_nav_menu('footer-menu', __( 'Pied de page', 'motatheme' ) );
    //register_nav_menu( 'main-menu', 'En-tête Menu');
}

//Création taxonomie X2 - "Catégorie" "Format"
function motatheme_init() {
    register_taxonomy('motatheme_categorie','post',[
        'labels' => [
            'name' => 'Catégories photo',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,//checkbox
        ]);
        register_taxonomy('motatheme_format','post',[
            'labels' => [
                'name' => 'Formats photo',
            ],
            'show_in_rest' => true,
            'hierarchical' => true,//checkbox
            ]);
}

//Création custom post type - type de contenu personnalisé X1 "Photos"
function motatheme_register_custom_post_types() {    
    $labels_photo = array(    
    'menu_name'         => __('Photos', 'motatheme'),    
    'name_admin_bar'    => __('Photo', 'motatheme'),       
    'add_new_item'      => __('Ajouter une nouvelle photo', 'motatheme'),       
    'new_item'          => __('Nouvelle photo', 'motatheme'),       
    'edit_item'         => __('Modifier la photo', 'motatheme'),    
); 
$args_photo = array(    
    'label'             => __('Photos', 'motatheme'),    
    'description'       => __('Photos', 'motatheme'),    
    'labels'            => $labels_photo,    
    'supports'          => array('title', 'thumbnail', 'excerpt', 'editor'),    
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
    'capability_type'   => 'post',    
    'menu_icon'  => 'dashicons-camera-alt',
    //'show_in_rest' => true,
); 
register_post_type('cif_ingredient', $args_photo);
}
//Création custom post type - type de contenu personnalisé "Photos"
add_action('init', 'motatheme_register_custom_post_types', 11);

//Création page d'Administration personnalisée "Mota thème"
function mota_theme_add_admin_pages() {
    add_menu_page('Tableau de bord Mota-Thème', 'MotaTheme', 'manage_options', 'motatheme-settings', 'motatheme_theme_settings', 'dashicons-admin-settings', 60); //Nom complet de la page, Nom raccourcis afficher ds menu, Niveau d'accé necéssaire pour visualiser la page (droit admin içi), slug (partie ds l'URL qui va définir la page), fonction à appeler pour définir le contenu de la page, icone à afficher ds le menu de WP, position de la pré-page ds le menu - 60 - apparaît après onglet "apparences"
}

//Fonction qui affiche le contenu de la page
function motatheme_theme_settings(){
    echo '<h1>' . get_admin_page_title() . '</h1>';


}


function motatheme_settings_register() {
    register_setting('motatheme_settings_fields', 'motatheme_settings_fields', 'motatheme_settings_fields_validate');
    add_settings_section('motatheme_settings_section', __('Paramètres', 'motatheme'), 'motatheme_settings_section_introduction', 'motatheme_settings_section');
    add_settings_field('motatheme_settings_field_introduction', __('Introduction', 'motatheme'), 'motatheme_settings_field_introduction_output', 'motatheme_settings_section', 'motatheme_settings_section');
}

function motatheme_settings_section_introduction() {
    echo __('Télécharger nouvelle image header.', 'motatheme');
}

function motatheme_settings_field_introduction_output() {
    $value = get_option('motatheme_settings_field_introduction');
    echo '<input name="motatheme_settings_field_introduction_output" type="text" value="'.$value.'" />';
}

//Enqueue CSS - JS
add_action('wp_enqueue_scripts', 'mota_theme_register_assets');
//Menu de navigation
add_action( 'after_setup_theme', 'register_my_menu' );
//init
add_action('init', 'motatheme_init');
//Page d'Administration "Mota thème"
add_action('admin_menu', 'mota_theme_add_admin_pages');
//Ajout de champs à la page Admin "Tableau de bord Mota-thème"
add_action('admin_init', 'motatheme_settings_register');


