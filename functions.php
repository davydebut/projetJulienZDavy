<?php

function projetJulienZDavy_Setup(){
    add_theme_support('post-thumbnails');
}

function mon_theme_scripts(){
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_script('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',[],false,true);
}

function mon_theme_custom_types(){
    register_post_type('boardgame',[
        'labels' => [
            'name' => 'boardgames',
            'singular_name' => 'boardgame'
        ],
            'public'      => true,
            'menu_position' => 3,
            'menu_icon'=>'dashicons-buddicons-activity',
            'supports' => ['title', 'editor', 'thumbnail'],
            'has_archive' => true,
            'show_in_rest' => true

    ]);
}

add_action('after_setup_theme', 'projetJulienZDavy_Setup');
add_action('init', 'mon_theme_custom_types');
add_action('wp_enqueue_scripts', 'projetJulienZDavy_Setup');



