<?php
get_header();

// $query = get_queried_object();
// var_dump($query);

if (have_posts()) :
    while (have_posts()) : the_post();
        // the_title('<h1>', '</h1>'); 
?>
        <h2><?php the_title() ?></h2>
        <span class="pills"><?php the_category() ?></span>
<?php
    endwhile;
endif;
get_footer();
