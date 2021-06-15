<?php
// Template Name: A propos
get_header();
?>

<div class="cont">
    <div class="titre">
        <?= carbon_get_theme_option('titre'); ?>
    </div>
    <div class="detail">
        <?= carbon_get_theme_option('detail'); ?>
    </div>
</div>

<?php get_footer();
