<div class="card" style="width: 18rem;">
    <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height: auto;']); ?>
    <!-- the_post_thumbnail(1,2) 1->affiche l'image de l'article et défini un 2->attribut [] -->
    <div class="card-body">
        <h5 class="card-title"><?php the_title(); ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php the_category(); ?></h6>
        <ul>
            <?php the_terms(get_the_ID(), 'sport', '<li>', '</li><li>', '</li>'); ?>
        </ul>
        <?php // var_dump(get_the_terms(get_the_ID(), 'sport', '<li>', '</li><li>', '</li>')); 
        ?>
        <!-- renvoie un tableau wp_term ce sont des objets qui permet de réprésenter un terme associé a une taxonomie -->
        <!-- Astuce : on peut voir aussi les fonctions qui sortent en tapant simplement the_(undescore) -->
        <p class="card-text"><?php the_excerpt(); ?></p> <!-- the_excerpt() permet de récupérer un extrait de l'article -->
        <a href="<?php the_permalink(); ?>" class="card-link">Voir plus</a>
    </div>
</div>
</div>