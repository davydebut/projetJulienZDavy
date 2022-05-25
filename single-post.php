<?php get_header() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <p>
            <img src="<?php the_post_thumbnail_url() ?>" alt="" style="width: 25%; height: auto;">
        </p>
        <?php the_content() ?>
        <?php // var_dump(get_the_ID()); 
        ?>
        <h2>Articles relatifs</h2>
        <div class="row">
            <?php
            $sports = array_map(function ($term) {
                return $term->term_id;
            }, get_the_terms(get_post(), 'sport'));
            /* var_dump($sports); // renvoie un objet qui contient l'ensemble des termes de la taxonomie sport
            die(); */
            $query = new WP_Query([
                'post__not_in' => [get_the_ID()], // -> permet de ne pas afficher l'article en cours get_the_ID() -> permet de récupérer l'id de l'article en cours
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'rand',
                'tax_query' => [
                    [
                        'taxonomy' => 'sport',
                        'terms' => $sports,
                        // 'operator' => 'AND',
                    ]
                ],
            ]);
            // var_dump($query->get_posts()); // -> renvoie un tableau qui contient 3 objet de l'objet WP_Post et permet de récupérer les articles
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-sm-4">
                    <?php get_template_part('parts/card', 'post'); ?>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
            <?php // var_dump(get_the_ID()); 
            ?>
        </div>
<?php endwhile;
endif; ?>

<?php get_footer() ?>