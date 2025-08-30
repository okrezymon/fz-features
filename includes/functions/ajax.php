<?php

if ( !defined('ABSPATH' ) ) {
    exit;
}

if ( !function_exists('fz_features_get_latest_books_ajax') ) {
    function fz_features_get_latest_books_ajax() {

        if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'fz_books_nonce') ) {
            wp_send_json_error('Invalid nonce');
        }

        $current_id = intval($_POST['current_id']);

        $args = [
            'post_type'      => 'fz-book',
            'posts_per_page' => 20,
            'post_status'    => 'publish',
            'post__not_in'   => [$current_id],
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];

        $books = get_posts( $args );
        $data = [];

        foreach ( $books as $book ) {
            $terms = get_the_terms( $book->ID, 'fz-genre' );
            $genre = ( $terms && !is_wp_error( $terms ) ) ? $terms[0]->name : '';

            $data[] = [
                'title'     => get_the_title( $book->ID ),
                'date'      => get_the_date('', $book->ID ),
                'genre'     => $genre,
                'excerpt'   => get_the_excerpt( $book->ID ),
                'link'      => get_permalink( $book->ID ),
            ];
        }

        wp_send_json_success($data);
    }
}

add_action('wp_ajax_fz_get_latest_books', 'fz_features_get_latest_books_ajax');
add_action('wp_ajax_nopriv_fz_get_latest_books', 'fz_features_get_latest_books_ajax');