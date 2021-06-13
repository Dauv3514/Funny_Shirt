<?php 
// Template Name: Contact
get_header(); 
?>

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

            if( current_user_can( 'publish_posts' ) ) { // Contrôle des rôles utilisateur
		acf_form_head(); // Initialiser le formulaire ACF
    }

	get_header();
    if( have_posts() ): while( have_posts() ): the_post();
?>

      <h1 class="site__heading"><?php the_title(); ?></h1>
      <div class="wp-content"><?php the_content(); ?></div>

      <p>Texte : <?php the_field( 'text' ); ?></p>
      <p>Éditeur : <?php the_field( 'editor' ); ?></p>
      <p>Couleur : <?php the_field( 'color' ); ?></p>

  <?php 
    if( current_user_can( 'publish_posts' ) ) { // Contrôle des rôles utilisateur
      	acf_form(); // Le formulaire ACF
    }
  ?>

<?php get_footer();