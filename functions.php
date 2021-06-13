<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');
function crb_load() {
	require_once('vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', [], wp_get_theme()->get('Version'));


}

add_action('after_setup_theme', 'funnyshirt_after_setup_theme');
function funnyshirt_after_setup_theme() {

    add_theme_support( 'html5' ); // Support de HTML5
	add_theme_support( 'title-tag' ); // Balise titre dans le head
    add_theme_support( 'post-thumbnails' ); // Image mise en avant
    add_theme_support( 'custom-logo' ); // Logo
    


    // Déclaration des menus (pour l'administration)
	register_nav_menu('menu-top', 'Menu en haut de page');
	register_nav_menu('menu-footer', 'Menu en pied de page');


}


add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['webp'] = 'image/webp';
	return $mimes;
});

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Theme Options' ) )
    ->add_fields([

		Field::make('text', 'titre', 'Titre'),
        Field::make('text', 'detail', 'Detail'),
		Field::make('text', 'button', 'Button'),
		Field::make('text', 'titre2', 'Titre2'),
		Field::make('text', 'titre3', 'Titre3'),
		Field::make('text', 'titre4', 'Titre4'),
		Field::make('text', 'phone', 'Phone'),
		Field::make('text', 'adresse', 'Adresse'),
		Field::make('text', 'email', 'Email'),

    ]);
} 

add_action('init', 'fromscratch_init');
function fromscratch_init() {
    register_post_type('magasins', [
		'labels' => ['name' => 'Magasins', 'singular_name' => 'Magasin', 'menu_name' => 'Magasins'],
		'public' => true,
		'has_archive' => true,
		'rewrite' => ['slug' => 'magasin'],
		'supports' => ['title', 'thumbnail', 'editor'],
	]);
	register_taxonomy('magasins_categorie', ['magasins'], [
		'label' => 'Villes',
		'rewrite' => ['slug' => 'project-magasin'],
		'hierarchical' => false
	]);

}


