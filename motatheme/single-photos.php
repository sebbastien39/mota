<!--fichier affichant par défaut quelque chose sur le site web-->
<!--code de la page d'accueil-->
<?php get_header(); //Cette fonction appelle le fichier header.php ?>

<!--contenu du site-->
<h1>Bienvenue sur photographie Mota</h1>

<?php if (have_posts()): while (have_posts()): the_post(); //Boucle WP 1 ou plusieurs articles?>
    <article>
        <h2><?php the_title(); ?></h2>
        <?php the_post_thumbnail(); ?>
        <?php the_category(); ?>
        <?php the_field('reference-photo'); //champs ACF ?>
        <?php the_field('type-photo'); //champs ACF ?>
    </article>
 <?php endwhile; else: ?>
    <p>Aucune photo : </p>
 <?php endif; ?>

<?php get_footer(); //appel le fichier footer.php ?>