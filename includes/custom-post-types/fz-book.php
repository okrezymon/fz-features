<?php

function fz_book_cpt() {
    register_post_type('fz-book',
        array(
            'labels'      => array(
                'name'               => __( 'Books', 'fz-features' ),
                'singular_name'      => __( 'Book', 'fz-features' ),
                'add_new'            => __( 'Add new', 'fz-features' ),
                'add_new_item'       => __( 'Add new book', 'fz-features' ),
                'edit'               => __( 'Edit', 'fz-features' ),
                'edit_item'          => __( 'Edit book', 'fz-features' ),
                'new_item'           => __( 'New book', 'fz-features' ),
                'view'               => __( 'Show', 'fz-features' ),
                'view_item'          => __( 'Show book', 'fz-features' ),
                'search_items'       => __( 'Search', 'fz-features' ),
                'not_found'          => __( 'Not found', 'fz-features' ),
                'not_found_in_trash' => __( 'Not found in trash', 'fz-features' )
            ),
            'public'        => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
            'has_archive'   => true,
            'can_export'    => true,
            'menu_icon'     => 'dashicons-book',
            'show_in_rest'  => true,
            'rewrite'       => array( 'slug' => 'library' )
        )
    );
}
add_action( 'init', 'fz_book_cpt' );

function fz_genre_taxonomy() {
    register_taxonomy('fz-genre', 'fz-book',
        array(
            'labels'      => array(
                'name'              => _x( 'Genres', 'fz-features' ),
                'singular_name'     => _x( 'Genre', 'fz-features' ),
                'search_items'      => __( 'Search genres', 'fz-features' ),
                'all_items'         => __( 'All genres', 'fz-features' ),
                'parent_item'       => __( 'Parent genre', 'fz-features' ),
                'parent_item_colon' => __( 'Parent genre:', 'fz-features' ),
                'edit_item'         => __( 'Edit genre', 'fz-features' ),
                'update_item'       => __( 'Update genre', 'fz-features' ),
                'add_new_item'      => __( 'Add New genre', 'fz-features' ),
                'new_item_name'     => __( 'New genre name', 'fz-features' ),
                'menu_name'         => __( 'Genres', 'fz-features' ),
            ),
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'book-genre' ),
        )
    );
}

add_action( 'init', 'fz_genre_taxonomy' );
