<?php get_header() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <p>
            <img src="<?php the_post_thumbnail_url() ?>" alt="" style="width: 25%; height: auto;">
        </p>
        <?php the_content() ?>
        <?php echo get_field('surface') ?>
        <?php if (get_field('jardin') === true) : ?>
            <p>
                <strong>Jardin : </strong> <?php echo get_field('surface_jardin') ?>m²
            </p>
            <?php endif ?>
<?php endwhile;
endif; ?>

<?php get_footer() ?>