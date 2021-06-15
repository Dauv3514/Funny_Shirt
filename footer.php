<footer>

    <div class="container4">
        <div class="row">

            <div class="lo">

                <div class="vert">
                    <!-- Recupere les infos d'identité du site dans personnaliser (logo) -->
                    <?php the_custom_logo(); ?>
                </div>

                <div class="logo">
                    <div class="logo-title">
                    <!-- Recupere les infos d'identité du site dans personnaliser -->
                        <?php bloginfo('name'); ?>
                    </div>
                    <div class="logo-subtitle">
                        <?php bloginfo('description'); ?>
                    </div>
                </div>

            </div>

            <div class="navigation">
                <h5>Navigation</h5>

                <div class="nav2">
                <!-- Fonction qui affiche le menu du footer -->
                    <?php wp_nav_menu(['theme_location' => 'menu-footer', 'container' => 'nav']); ?>
                </div>

            </div>


            <div class="contact">
                <h5>Nous contacter</h5>

                <div class="adress">
                    <p> Adresse : <?= carbon_get_theme_option('adresse'); ?> </p>
                </div>

                <div class="telephone">
                    <p> Téléphone : <a href="tel:<?= carbon_get_theme_option('phone'); ?>">
                            <?= carbon_get_theme_option('phone'); ?>
                    </a> </p>
                </div>

                <div class="mail">
                    <p> Email : <a href="mailto:<?= carbon_get_theme_option('email'); ?>">
                            <?= carbon_get_theme_option('email'); ?>
                        </a> </p>
                </div>

            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>