<?php

get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <h2><?php the_category() ?></h2>
<?php endwhile;
endif;