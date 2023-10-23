<!--En-tête appelé sur toutes les pages du site-->
<!DOCTYPE html>
<html lang="fr"><!--remplacer en par fr-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title>Nathalie Mota</title> Remplacer par add_theme_support('title-tag') dans functions.php-->
    <?php wp_head() //Fonction insère toutes les infos à mettres en en-tête?>
</head>
<body>
    <header>
        <?php if (has_custom_logo()){//Aficher le Logo du site
            the_custom_logo();
        } else {
            echo get_bloginfo('name');
        } ?>
        <?php wp_nav_menu([
            'theme_location' => 'main-menu',
            'container' => 'nav',
            'container_class' => 'mota-menu',
        ]); //Affiche le menu créé ds functions.php?>
    </header>