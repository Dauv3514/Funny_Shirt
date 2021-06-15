<?php

get_header();

?>

<!-- index.php est la template générale par défaut.
Si WordPress ne trouve pas la template dont il a
besoin pour une rendre une page, il utilise en dernier
recours index.php pour rendre la page. -->


<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <?php the_title(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

<?php get_footer();
