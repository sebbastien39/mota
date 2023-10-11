<?php
    //the_post_thumbnail('mota-image-resultat');
    //get_the_post_thumbnail();
?>
<?php echo get_the_post_thumbnail($post->ID, 'mota-image-resultat', array('class'=>'autre-image'));?>