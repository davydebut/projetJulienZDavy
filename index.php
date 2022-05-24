<?php get_header() ?>
<!-- Acceuil Bonjour tout le monde : <?php //wp_title(); 
                                        ?> -->
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
                <div class="card" style="width: 18rem;">
                <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => '']); ?> <!-- the_post_thumbnail(1,2) 1->affiche l'image de l'article et défini un 2->attribut [] -->
                    <div class="card-body">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php the_category(); ?></h6>
                        <!-- Astuce : on peut voir aussi les fonctions qui sortent en tapant simplement the_(undescore) -->
                        <p class="card-text"><?php the_excerpt(); ?></p> <!-- the_excerpt() permet de récupérer un extrait de l'article -->
                        <a href="<?php the_permalink(); ?>" class="card-link">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <!-- Fin de la boucle while -->
    <!-- </ul> -->
<?php else : ?>
    <h1>Pas d'article</h1>
<?php endif; ?>
<?php get_footer() ?>