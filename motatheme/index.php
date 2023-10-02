<!--fichier affichant par défaut quelque chose sur le site web-->
<!--code de la page d'accueil-->
<?php get_header(); //Cette fonction appelle le fichier header.php ?>

<!--contenu du site-->
<h1>Bienvenue sur photographie Mota</h1>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article>
        <h2><?php the_title(); ?></h2>
        <?php the_content() ?>
    </article>
 <?php endwhile; else: ?>
    <p>Aucun article :(</p>
 <?php endif; ?>

<?php get_footer(); //appel le fichier footer.php ?>