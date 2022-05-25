<?php get_header() ?>
<!-- Acceuil Bonjour tout le monde : <?php //wp_title(); 
                                        ?> -->
<?php // wp_list_categories(['taxonomy' => 'sport', 'title_li' => '']); 
?>
<!-- affiche toutes les catégories de sport listing de taxonomie des différents sport utilisé la fonction wp_list_categories() permet de lister les catégories mais également les taxonomies  -->
<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class="nav nav-pills my-4">
    <?php foreach ($sports as $sport) : ?>
        <li class="nav-item">
            <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>">
                <?= $sport->name ?>
               <?php // var_dump($sport->name); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<!--  -->
<!-- Quelle que chose d'essentiels à maitriser la boucle et qui va permettre de charger la liste de nos articles -->
<?php if (have_posts()) : ?>
    <div class="row">
        <!-- <ul> -->
        <?php while (have_posts()) : the_post(); ?>
            <!-- la class-wp-query.php ça déclare une varaible globale qui s'appelle $post, ca va itéré dans la boucle et ça va changer la valeur de post avec les différents articles. (Explication pour déboger) -->
            <?php
            // global $post; global $wp_query; var_dump($post); echo '<br>'; echo '<br>'; echo '<br>'; echo '<br>'; echo '<br>'; var_dump($wp_query); die();
            ?>
            <!-- Boucle while tant qu'il y a des articles et la fonction the_post() permettra de déclaré l'article et d'utilisé tout un ensemble de fonction -->
            <!-- <li>
                <a href="<?php // the_permalink() 
                            ?>"> la fonction the_permalink() permet de généré le lien vers l'article
                    <?php // the_title(); 
                    ?>
                </a>
                -
                <?php // the_author() 
                ?>
            </li> affiche le titre de l'article et le nom de l'auteur 
            <p><?php // the_content(); 
                ?></p> -->
            <div class="col-sm-4">
                <?php get_template_part('parts/card', 'post'); ?>
                <?php endwhile; ?>
            </div>
            <?php montheme_pagination(); ?>
            <?php // echo next_posts_link(); 
            ?>
            <!-- permet de généré le lien vers l'article précédent sans pagination c'est à dire sans les nombres -->
            <?php // echo previous_posts_link(); 
            ?>
            <?php echo paginate_links(); ?>
            <!-- paginate_links() permet de généré la pagination sans avoir de titre h2 en yant directement les liens -->
            <?php // the_posts_pagination(); 
            ?>
            <!-- la fonction the_posts_pagination() permet de généré la pagination mais affiche un titre h2 -->
            <!-- Fin de la boucle while -->
            <!-- </ul> -->
        <?php else : ?>
            <h1>Pas d'articles</h1>
        <?php endif; ?>
        <?php get_footer() ?>