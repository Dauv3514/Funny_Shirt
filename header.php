<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- On met la navigation du site car elle est sur chaque page -->

    <header class="header">
        <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
            <div class="container">

                <?php the_custom_logo(); ?>
                <div class="centre">
                    <h1><?php bloginfo('name'); ?></h1>
                    <p><?php bloginfo('description'); ?></p>
                </div>


                <?php
                wp_nav_menu(array(
                    'theme_location'    => 'menu-top',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'bs-example-navbar-collapse-1',
                    'menu_class'        => 'nav navbar-nav',
                ));
                ?>
                <!-- Affiche un menu de navigation -->
            </div>
        </nav>

    </header>