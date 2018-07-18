<?php

use inc\UniteChildFunctions;

require_once( trailingslashit(dirname(__FILE__)) . '/autoloader.php' );

add_action('init', 'film_post_types');
add_action( 'init', 'register_film_taxonomy', 0 );
add_action('wp_enqueue_scripts', 'initTheme');
add_action('add_meta_boxes', 'custom_post_meta');
add_action( 'save_post', 'save_release_date_and_ticket_price' );

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

function custom_post_meta() {
    $uniteInstance = UniteChildFunctions::get_instance();
    $uniteInstance->add_fields_meta_box();
}

function save_release_date_and_ticket_price( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    if ( 'page' === $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }

    $oldPrice = get_post_meta( $post_id, 'ticket_price', true );
    $newPrice = $_POST['ticket_price'];
    $oldReleaseDate = get_post_meta( $post_id, 'release_date', true );
    $newReleaseDate = $_POST['release_date'];

    if ( $newPrice && $newPrice !== $oldPrice ) {
        update_post_meta( $post_id, 'ticket_price', $newPrice );
    } elseif ( '' === $newPrice && $oldPrice ) {
        delete_post_meta( $post_id, 'ticket_price', $oldPrice );
    }

    if ( $newReleaseDate && $newReleaseDate !== $oldReleaseDate ) {
        update_post_meta( $post_id, 'release_date', $newReleaseDate );
    } elseif ( '' === $newReleaseDate && $oldReleaseDate ) {
        delete_post_meta( $post_id, 'release_date', $oldReleaseDate );
    }
}
