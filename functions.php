<?php
// do action et apply_filters est un système qui va permetttre d'étendre wordpress

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); // permet de générer des images à la une dans le thème (dans le back-office)
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu (header)');
    register_nav_menu('footer', 'Pied de page (footer)');
    add_image_size('post-thumbnail', 350, 215, true); // permet de définir une taille d'image personnalisé à chaque envoie d'image et d'utiliser le nom de la fonction add_image_size() qui est donc card-header 
}

function montheme_register_assets()
{
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css');
    wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('script', get_template_directory_uri());
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', [], false, true);
}

function montheme_title_separator()
{
    return '|';
}

/* function montheme_document_title_parts($title) // -> fonction qui permet de modifier le titre de la page
{
    // unset($title['tagline']);
    // $title['demo'] = 'Mon theme';
    return $title;
} */

function montheme_menu_class_li($classes) // -> fonction qui permet de modifier la classe de la balise li
{
    // var_dump(func_get_arg()); // -> permet de débeuger et voir l'ensemble des arguments de la fonction
    // die();
    $classes[] = 'nav-item';
    return $classes; // -> dans le cadre d'un filtre faut toujours retourner une valeur
}

function montheme_menu_class_a($attrs) // -> fonction qui permet de modifier la classe de la balise a
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function montheme_pagination() // -> créatin d'une foncion personalisé
{
    $pages = paginate_links(['type' => 'array']); // Tableau qui contient l'ensemble des liens de pagination
    if ($pages == null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';
    // var_dump($pages); // renvoie null si dans réglage de wordpress les pages du site sont supérieur aux nombre d'articles affichés
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    // var_dump($pages);
    echo '</ul>';
    echo '</nav>';
}

// création d'une taxonomie personalisé
function montheme_taxonomy()
{
    // création d'une taxonomie
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name' => 'Sport',
            'plural_name' => 'Sports',
            'search_items' => 'Rechercher des sports',
            'all_items' => 'Tous les sports',
            'edit_item' => 'Editer un sport',
            'update_item' => 'Mettre à jour le sport',
            'add_new_item' => 'Ajouter un nouveau sport',
            'new_item_name' => 'Nom du nouveau sport',
            'menu_name' => 'Sport',
        ],
        'show_in_rest' => true, // permet d'afficher la taxonomie dans le back-office
        'hierarchical' => true, // permet de créer des cases à cocher
        'show_admin_column' => true, // permet d'afficher la colone taxonomie sport dans le back-office pour les articles
    ]);
}

function montheme_post_type() {
    // création d'un post type
    register_post_type('bien', [
        'labels' => [
            'name' => 'Biens',
            'singular_name' => 'Bien',
            'all_items' => 'Tous les biens',
            'add_new_item' => 'Ajouter un nouvel bien',
            'edit_item' => 'Editer un bien',
            'new_item' => 'Nouvel bien',
            'view_item' => 'Voir l\'bien',
            'search_items' => 'Rechercher un bien',
            'not_found' => 'Aucun bien trouvé',
            'not_found_in_trash' => 'Aucun bien dans la corbeille',
            'menu_name' => 'Biens',
        ],
        'public' => true,
        'has_archive' => true, 
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-building',
        'menu_position' => 3,
    ]);
}

function montheme_bien_column($columns)
{
    /* var_dump($columns);
    die(); */
    return [
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date'],
    ];
}

function montheme_bien_custom_column($column, $postId)
{
    // var_dump(func_get_args()); // -> permet de débeuger et voir l'ensemble des arguments de la fonction
    // die();
    if ($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
}

add_action('init', 'montheme_taxonomy');
add_action('init', 'montheme_post_type');
add_action('after_setup_theme', 'montheme_supports'); // -> ceci est un hook qui permet d'ajouter une fonction à l'action after_setup_theme
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('document_title_separator', 'montheme_title_separator');
// add_filter('document_title_parts', 'montheme_document_title_parts'); // -> les filtres sont commes des tuyaux qui permettent d'integré une valeur, dès que vous avez une question sur comment modifier telle ou telle fonctionnalité, n'hésitez a vous rendre sur le code source de la fontion utilisée pour voir si il y a des filtres ou des ations sur lequelle je peux les passées.
add_filter('nav_menu_css_class', 'montheme_menu_class_li');
add_filter('nav_menu_link_attributes', 'montheme_menu_class_a');
require_once('options/agence.php');
AgenceMenuPage::register();
add_filter('manage_bien_posts_columns', 'montheme_bien_column');
add_filter('manage_bien_posts_custom_column', 'montheme_bien_custom_column', 10, 2);
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('montheme-admin', get_template_directory_uri() . '/assets/admin.css');
});