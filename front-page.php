<?php 

$post_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page'=> 3
]);

$magasin_query = new WP_Query([
    'post_type' => 'magasins',
    'posts_per_page'=> 3
]);

$product_query = new WP_Query([
    'post_type' => 'product',
    'posts_per_page'=> 3
]);


get_header(); 
?>

<section id="apropos">

<div class="container1">
<div class="apropos">

<div class="titre">
<?= carbon_get_theme_option('titre'); ?>
</div>
<div class="detail">
<?= carbon_get_theme_option('detail'); ?>
</div>
<a href="?page_id=9"> <button type="button" class="btn btn-success"> <?= carbon_get_theme_option('button'); ?> </button> </a>

</div>
</div>

<section id="actualites">

<div class="titre2">
<?= carbon_get_theme_option('titre2'); ?>
</div>

<div class="centrage">

<?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>

    <div class="container2">
    <div class="image">
    <?php the_post_thumbnail(); ?>
    </div>
    <h3><?php the_title(); ?></h3>
	<?php the_excerpt(); ?>
    <div class="lien">
    <a href="<?php the_permalink() ?>"><button type="button" class="btn btn-success"> Lire la suite </a> </button>
    </div>
    
</div>

<?php endwhile; else : ?>
    <p>Rien à afficher !</p>
<?php endif; ?>
</div>

</section>


<section id="magasins">

<div class="titre2">
<?= carbon_get_theme_option('titre3'); ?>
</div>

<div class="centrer">

<?php if ($magasin_query->have_posts()) : while ($magasin_query->have_posts()) : $magasin_query->the_post(); ?>

<div class="container3">

<div class="images">
<?php the_post_thumbnail(); ?>
</div>

<h3><?php the_title(); ?></h3>

<div class="categories">
<?php $magasins = get_the_terms(get_the_ID(), 'magasins_categorie'); ?>
    <ul>
        <?php foreach ($magasins as $magasin) : ?>
    <li>
        <a href="<?= get_term_link($magasin); ?>" class="badge rounded-pill bg-primary">
        <?= $magasin->name; ?>
        </a>
    </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="lien">
<a href="<?php the_permalink()?>"><button type="button" class="btn btn-success"> Voir plus </a>
</div>

</div>

<?php endwhile; else : ?>
<p>Rien à afficher !</p>
<?php endif; ?>

</div>

</section>

<section id="ventes">

<div class="titre2">
<?= carbon_get_theme_option('titre4'); ?>
</div>

<?php
$product_query = new WP_Query(['post_type' => 'product']); ?>

<?php if ($product_query->have_posts()) : ?>
    <?php while ($product_query->have_posts()) : $product_query->the_post(); ?>
        <h2><?php the_title(); ?></h2>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
<?php else : ?>
    <p>Aucun produit</p>
<?php endif; ?>




</section>

<?php get_footer();