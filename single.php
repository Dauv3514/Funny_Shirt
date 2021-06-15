<?php

get_header();
?>

<!-- récupere le contenu des articles - actualites - sur une autre page  -->

<div class="actu">

    <?php the_post_thumbnail(); ?>

    <h3><?php the_title(); ?></h3>

    <?php the_content(); ?>

</div>


<?php get_footer();
