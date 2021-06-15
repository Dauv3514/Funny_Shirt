<?php

// les querys - récupere les éléments du post type

$post_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3
]);

$magasin_query = new WP_Query([
    'post_type' => 'magasins',
    'posts_per_page' => 3
]);

$product_query = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 3
]);

// recuperation du champs carbon fields dans une variable

$slides = carbon_get_theme_option('crb_slides');

get_header();
?>

<section id="slide">

    <!-- Boucle permettant de récuperer le slider -->
    <?php foreach ($slides as $slide) : ?>
        <!-- Contient la fonction permettant d'afficher les images -->
        <div class="slider" style="background-image: url('<?= wp_get_attachment_image_url($slide['image']); ?>');">
            <div class="containerslide">
                <div class="centrageslide">
                    <div class="gras">
                        <!-- On affiche la description dans la boucle foreach -->
                        <?php echo $slide['description'] ?>
                        <br>
                        <br>
                    </div>
                    <!-- Affichage du boutton en créant une boucle qui va nous permettent d'afficher les boutons avec un lien -->
                    <?php $buttons = $slide['buttons']; ?>
                    <?php foreach ($buttons as $button) : ?>
                        <!-- Les boutons renvoient vers la page produit -->
                        <a href="?post_type=product" class="btn btn-secondary">
                            <!-- Fonction qui récupère les associations -->
                            <?php echo carbon_get_the_post_meta('crb_association'); ?>
                            <?php echo $button['text'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


</section>

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

</section>

<section id="actualites">

    <div class="titre2">
        <?= carbon_get_theme_option('titre2'); ?>
    </div>

    <div class="centrage">

        <!-- Boucle permettant de récuperer les posts actualités -->

        <?php if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post(); ?>

                <div class="container2">
                    <!-- RFonction pour recupérer les images -->
                    <div class="image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                    <div class="lien">
                        <a href="<?php the_permalink() ?>"><button type="button" class="btn btn-success"> Lire la suite </a> </button>
                    </div>

                </div>

            <?php endwhile;
        else : ?>
            <p>Rien à afficher !</p>
        <?php endif; ?>
    </div>

</section>


<section id="magasins">

    <div class="titre2">
        <?= carbon_get_theme_option('titre3'); ?>
    </div>

    <div class="centrer">

        <!-- Boucle permettant d'afficher le contenu du post-type magasin -->
        <?php if ($magasin_query->have_posts()) : while ($magasin_query->have_posts()) : $magasin_query->the_post(); ?>

                <div class="container3">

                    <div class="images">
                        <?php the_post_thumbnail(); ?>
                    </div>

                    <h3><?php the_title(); ?></h3>

                    <div class="categories">

                        <!-- Fonction qui récupère l'ID de chaque magasins crees -->
                        <?php $magasins = get_the_terms(get_the_ID(), 'magasins_categorie'); ?>
                        <ul>
                            <?php foreach ($magasins as $magasin) : ?>
                                <li>
                                    <!-- Boutton cliquable qui renvoie vers la catégorie d'un magasin (avec la fonction) -->
                                    <a href="<?= get_term_link($magasin); ?>" class="badge rounded-pill bg-primary">
                                        <?= $magasin->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- Boutton cliquable qui renvoie vers une page d'un magasin -->
                    <div class="lien">
                        <a href="<?php the_permalink() ?>"><button type="button" class="btn btn-success"> Voir plus </a>
                    </div>

                </div>

            <?php endwhile;
        else : ?>
            <p>Rien à afficher !</p>
        <?php endif; ?>

    </div>

</section>

<section id="ventes">

    <div class="titre2">
        <?= carbon_get_theme_option('titre4'); ?>
    </div>


    <!-- WP Query qui permet de récuperer les produits crées dans la boutique woocommerce -->
    <?php $product_query = new WP_Query(['post_type' => 'product']); ?>

    <div class="contenu">

        <?php if ($product_query->have_posts()) : while ($product_query->have_posts()) : $product_query->the_post(); ?>

                <div class="contenu2">
                    <div class="image2">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="titreproduits">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="prix">
                        <h3><?= $product->get_price(); ?> €</h3>
                    </div>

                    <div class="lien">
                        <a href="<?php the_permalink() ?>"><button type="button" class="btn btn-success"> Voir les options </a>

                    </div>


                </div>

            <?php endwhile; ?>

            <!-- Cette fonction restaure le global $post au post courant de la requête principale. -->

            <?php wp_reset_postdata(); ?>


        <?php else : ?>
            <p>Aucun produit</p>
        <?php endif; ?>

    </div>


</section>

<?php get_footer();
