<?php

use inc\UniteChildFunctions;

require_once( trailingslashit(dirname(__FILE__)) . '/autoloader.php' );

add_action('init', 'film_post_types');
add_action( 'init', 'register_film_taxonomy', 0 );
add_action('wp_enqueue_scripts', 'initTheme');
add_action('add_meta_boxes', 'custom_post_meta');
add_action( 'save_post', 'save_release_date_and_ticket_price' );
add_shortcode( 'films', 'film_shortcode' );


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

function listAllTaxonomies($post_id, $taxonomies)
{
    $all = array();
    foreach ($taxonomies as $taxonomy) {
        $terms = get_the_terms($post_id,$taxonomy);
        $term_names = '';
        foreach ($terms as $term) {
            $term_names .= $term->name;
            if ($term !== end($terms)){
                $term_names .= ', ';
            }

        }
        $all[$taxonomy] = $term_names;
    }
    return $all;
}

function film_shortcode($attributes)
{
    $a = shortcode_atts( array(
        'count' => 5
    ), $attributes );

    query_posts( array( 'post_type' => array('films'), 'posts_per_page' => $a['count'], 'order' => 'DESC'));
    if ( have_posts() ) {
        $output = '<ul>';
        while (have_posts()) : the_post();

            $output .= '<li><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a> </li>';

        endwhile;
        $output .= '<ul>';

        return $output;

    } else {
        echo 'No films added yet';
    }
}
