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

    public function makeNonceField()
    {
        return '<input type="hidden" name="unite_nonce" value="' . wp_create_nonce( basename(__FILE__) ) . '">';
    }

    function load_unite_styles()
    {
        wp_enqueue_style( 'unite-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'unitechild-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( 'unite-style' ),
            wp_get_theme()->get('Version' )
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

        register_post_type( 'films',
            array(
                'labels' => $labels,
                'description'          => 'Description of film',
                'hierarchical'         => false,
                'menu_icon'            => 'dashicons-images-alt2',
                'menu_position'        => 5,
                'public'               => true,
                'rewrite'              => array( 'slug' => 'films', 'with_front' => false ),
                'show_in_admin_bar'    => false,
                'show_in_nav_menus'    => true,
                'show_ui'              => true,
                'supports'             => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes')
            ));
    }

    public function create_film_taxonomies()
    {
        $labels = array(
            'name'              => 'Genres',
            'singular_name'     => 'Genre',
            'search_items'      => 'Search Genres',
            'all_items'         => 'All Genres',
            'parent_item'       => 'Parent Genre',
            'parent_item_colon' => 'Parent Genre:',
            'edit_item'         => 'Edit Genre',
            'update_item'       => 'Update Genre',
            'add_new_item'      => 'Add New Genre',
            'new_item_name'     => 'New Genre',
            'menu_name'         => 'Genres',
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'genre' ),
        );
        register_taxonomy( 'genre', array( 'films' ), $args );

        $labels = array(
            'name'              => 'Countries',
            'singular_name'     => 'Country',
            'search_items'      => 'Search Countries',
            'all_items'         => 'All Countries',
            'parent_item'       => 'Parent Country',
            'parent_item_colon' => 'Parent Country:',
            'edit_item'         => 'Edit Country',
            'update_item'       => 'Update Country',
            'add_new_item'      => 'Add New Country',
            'new_item_name'     => 'New Country',
            'menu_name'         => 'Countries',
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'countries' ),
        );
        register_taxonomy( 'countries', array( 'films' ), $args );

        $labels = array(
            'name'              => 'Years',
            'singular_name'     => 'Year',
            'search_items'      => 'Search year',
            'all_items'         => 'All Years',
            'parent_item'       => 'Parent Year',
            'parent_item_colon' => 'Parent Year:',
            'edit_item'         => 'Edit Year',
            'update_item'       => 'Update Year',
            'add_new_item'      => 'Add New Year',
            'new_item_name'     => 'New Year',
            'menu_name'         => 'Years',
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'years' ),
        );
        register_taxonomy( 'years', array( 'films' ), $args );

        $labels = array(
            'name'              => 'Actors',
            'singular_name'     => 'Actor',
            'search_items'      => 'Search Actor',
            'all_items'         => 'All Actor',
            'parent_item'       => 'Parent Actor',
            'parent_item_colon' => 'Parent Actor:',
            'edit_item'         => 'Edit Actor',
            'update_item'       => 'Update Actor',
            'add_new_item'      => 'Add New Actor',
            'new_item_name'     => 'New Actor',
            'menu_name'         => 'Actors',
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'actors' ),
        );
        register_taxonomy( 'actors', array( 'films' ), $args );
    }

    public function add_fields_meta_box()
    {
        add_meta_box(
            'fields_meta_box',
            'Ticket Price and Release Date',
            array( $this,  'fields_ticket_price_date' ),
            'films',
            'normal',
            'high'
        );
    }

    public function fields_ticket_price_date()
    {
        global $post;
        $ticketPrice = get_post_meta( $post->ID, 'ticket_price', true );
        $releaseDate = get_post_meta( $post->ID, 'release_date', true );
        $output = $this->makeNonceField();
        $output .= '<p>
                        <label for="ticket_price">Ticket Price</label>
                        <br>
                        <input type="text" name="ticket_price" id="ticket_price" class="regular-text" value="' . $ticketPrice . '">
                    </p>';
        $output .= '<p>
                        <label for="ticket_price">Release Date</label>
                        <br>
                        <input type="text" name="release_date" id="release_date" class="regular-text" value="' . $releaseDate . '">
                    </p>';

        echo $output;
    }


}