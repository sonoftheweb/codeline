<?php

namespace inc;

class UniteChildFunctions
{
    public static function get_instance() {
        static $instance = null;
        if ($instance == null) {
            $instance = new self();
        }
        return $instance;
    }

    function load_unite_styles()
    {
        wp_enqueue_style( 'unite-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'unitechild-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( 'unite-style' ),
            wp_get_theme()->get('Version')
        );
    }

    public function film_post_types()
    {
        $labels = array(
            'name'               => 'Films',
            'singular_name'      => 'Film',
            'add_new_item'       => 'Add new film',
            'edit_item'          => 'Edit film',
            'new_item'           => 'New film',
            'view_item'          => 'View film',
            'search_items'       => 'Search films',
            'not_found'          => 'No film found',
            'not_found_in_trash' => 'No film found in trash'
        );

        register_post_type( 'Slides',
            array(
                'labels' => $labels,
                'description'          => 'Description of film',
                'hierarchical'         => false,
                'menu_icon'            => 'dashicons-images-alt2',
                'menu_position'        => 5,
                'public'               => true,
                'register_meta_box_cb' => array('SlideJS', 'createCPTMetaboxes'),
                'rewrite'              => array( 'slug' => 'films', 'with_front' => false ),
                'show_in_admin_bar'    => false,
                'show_in_nav_menus'    => true,
                'show_ui'              => true,
                'supports'             => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes')
            ));
    }
}