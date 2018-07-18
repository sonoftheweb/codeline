<?php

use inc\UniteChildFunctions;

require_once( trailingslashit(dirname(__FILE__)) . '/autoloader.php' );

add_action('init', 'film_post_types');
add_action( 'init', 'register_film_taxonomy', 0 );
add_action('wp_enqueue_scripts', 'initTheme');

function initTheme() {
    // Load theme css file, parent before child
    $uniteInstance = UniteChildFunctions::get_instance();
    $uniteInstance->load_unite_styles();
}

function film_post_types() {
    $uniteInstance = UniteChildFunctions::get_instance();
    $uniteInstance->film_post_types();
}

function register_film_taxonomy() {
    $uniteInstance = UniteChildFunctions::get_instance();
    $uniteInstance->create_film_taxonomies();
}
