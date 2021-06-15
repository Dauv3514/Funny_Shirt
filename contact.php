<?php
// Template Name: Contact
get_header();
?>

<div class="milieu">

    <div class="contact">

        <h5>Pour nous contacter</h5>

        <div class="adresse">
            <p> Adresse : <?= carbon_get_theme_option('adresse'); ?> </p>
        </div>

        <div class="telephone2">
            <p> Téléphone : <a href="tel:<?= carbon_get_theme_option('phone'); ?>">
                    <?= carbon_get_theme_option('phone'); ?>
                </a> </p>
        </div>

        <div class="mail2">
            <p> Email : <a href="mailto:<?= carbon_get_theme_option('email'); ?>">
                    <?= carbon_get_theme_option('email'); ?>
                </a> </p>
        </div>

    </div>

    <div class="formulaire">

    <!-- Boucle qui affiche les élements d'une page -Gutenberg- -->

        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>

    </div>

</div>

<?php get_footer();
