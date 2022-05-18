<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
?>
        <div class="container">
            <h2><?php the_title() ?></h2>
        <div><?php the_content() ?></div>
<<<<<<< HEAD
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="<?php the_field('image_a_gauche') ?>" alt="">
                </div>
                <div class="col">
                    <p class="text-left"><?php the_field('texte_a_droite') ?></p>
                </div>
=======
        <span class="pills"><?php the_category() ?></span>
        <div class="row">
            <div class="col">
                <img class="img-fluid" src="<?php the_field("image_gauche") ?>" >
            </div>
            <div class="col">
                <p><?php the_field("text_droite") ?></p>
>>>>>>> parent of e583da5 (commit du Mercredi)
            </div>
        </div>
<?php endwhile;
endif;

get_footer();
?>