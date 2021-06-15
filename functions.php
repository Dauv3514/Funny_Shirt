<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


//hook (function) qui met en route carbon fields

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
	require_once('vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}

//hook qui génere les feuilles de styles et les scripts - recuperer les fichiers et les executent (js), css, slick pour le slider 

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
	$version = wp_get_theme()->get('Version');

	wp_enqueue_style('slick', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.css', [], $version);
	wp_enqueue_style('slick-theme', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick-theme.css', ['slick'], $version);
	wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', ['slick', 'slick-theme'], $version);

	wp_enqueue_script('slick', get_template_directory_uri() . '/node_modules/slick-carousel/slick/slick.min.js', ['jquery'], $version, true);
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', ['slick'], $version, true);
}


//hook qui permet de gérer les options dans l'admin (dont woo commerce)

add_action('after_setup_theme', 'funnyshirt_after_setup_theme');
function funnyshirt_after_setup_theme()
{

	add_theme_support('html5'); // Support de HTML5
	add_theme_support('title-tag'); // Balise titre dans le head
	add_theme_support('post-thumbnails'); // Image mise en avant
	add_theme_support('custom-logo'); // Logo
	add_theme_support('woocommerce'); // WooCommerce



	// Déclaration des menus (pour l'administration)
	register_nav_menu('menu-top', 'Menu en haut de page');
	register_nav_menu('menu-footer', 'Menu en pied de page');
}

//hook qui permet de transformer les images en svg

add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	$mimes['webp'] = 'image/webp';
	return $mimes;
});

//hook qui permet de générer des champs carbon fields

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	Container::make('theme_options', __('Theme Options'))
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
			Field::make('complex', 'crb_slides', 'Slides')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('image', 'image', 'Image'),
					Field::make('text', 'description', 'Description'),
					Field::make('complex', 'buttons', 'Boutons')
						->add_fields(array(
							Field::make('text', 'text', 'Texte'),
							Field::make('association', 'crb_association', __('Association'))
								->set_types(array(
									array(
										'type'      => 'post',
										'post_type' => 'page',
									),
									array(
										'type'      => 'post',
										'post_type' => 'post',
									),
									array(
										'type'      => 'post',
										'post_type' => 'magasins',
									)
								))
								->set_max(1)
								->set_min(1)

						)),

				)),

		]);;
}

// Les champs complexes agissent comme des conteneurs auxquels vous pouvez ajouter plusieurs groupes de champs

//hook qui génere mon custom post type (magasins) avec sa taxonomie (villes)

add_action('init', 'fromscratch_init');
function fromscratch_init()
{
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

// Un slug est le texte qui apparaît après votre nom de domaine dans l’URL d’une page. Essentiellement, c’est la partie de l’URL de votre site qui identifie chaque page de votre site (sauf la page d’accueil).
