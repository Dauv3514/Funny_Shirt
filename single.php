<?php 

get_header(); 
?>

<div class="actu">
<?php the_post_thumbnail(); ?>

<h3><?php the_title(); ?></h3>

<?php the_content(); ?>



</div>


<?php get_footer();


