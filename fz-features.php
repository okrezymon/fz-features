<?php
/*
Plugin Name: Fooz features
Description: Custom features to extend basic theme
Version: 1.0
Author: Olga Krezymon
*/

if (!defined('ABSPATH')) {
    exit;
}

define( 'FZ_FEATURES_PATH', plugin_dir_path( __FILE__ ) );
define( 'FZ_FEATURES_URL', plugin_dir_url( __FILE__ ) );

if ( !function_exists( 'fz_features_load_textdomain' ) ) {
    function fz_features_load_textdomain() {
        load_plugin_textdomain( 'fz-features', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
    }
}

add_action( 'plugins_loaded', 'fz_features_load_textdomain' );

/*
 * Function for setting placeholder image for dummy content
 */
if ( !function_exists('fz_features_add_placeholder_image' ) ) {
    function fz_features_add_placeholder_image() {

        $image_url = FZ_FEATURES_URL . 'assets/img/book-placeholder.png';
        global $wpdb;

        $attachment_id = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE guid=%s AND post_type='attachment'",
                $image_url
            )
        );

        if ( !$attachment_id ) {

            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            $post_id_dummy = 0;
            $attachment_id = media_sideload_image( $image_url, $post_id_dummy, null, 'id' );
        }

        if ( $attachment_id ) {
            update_option('fz_features_placeholder_id', $attachment_id );
        }
    }
}

register_activation_hook( __FILE__, 'fz_features_add_placeholder_image' );

/*
 * Function for creating dummy taxonomies
 */
if ( !function_exists('fz_features_create_dummy_taxonomies' ) ) {
    function fz_features_create_dummy_taxonomies() {
        $genres = [
            'science-fiction' => 'Science Fiction',
            'thriller' => 'Thriller',
        ];

        foreach ( $genres as $slug => $name ) {
            if ( !term_exists( $name, 'fz-genre' ) ) {
                wp_insert_term( $name, 'fz-genre', [ 'slug' => $slug ] );
            }
        }
    }
}

add_action( 'init', 'fz_features_create_dummy_taxonomies', 20 );

/*
 * Function for creating dummy books
 */
if ( !function_exists('fz_features_create_dummy_books' ) ) {
    function fz_features_create_dummy_books() {

        $existing = get_posts([
            'post_type' => 'fz-book',
            'posts_per_page' => 1,
            'post_status' => 'any',
        ]);
        if ( !empty( $existing ) ) return;

        $books = [
            // sci-fi
            ['title' => 'Dune', 'excerpt' => 'Epic story of politics, religion, and empires on the desert planet Arrakis.', 'genres' => ['science-fiction']],
            ['title' => 'Neuromancer', 'excerpt' => 'Cyberpunk classic about hacking and artificial intelligence.', 'genres' => ['science-fiction']],
            ['title' => 'Foundation', 'excerpt' => 'The story of the fall and rise of a galactic empire.', 'genres' => ['science-fiction']],
            ['title' => 'Hyperion', 'excerpt' => 'Epic space opera full of mysteries and interstellar journeys.', 'genres' => ['science-fiction']],
            ['title' => 'Snow Crash', 'excerpt' => 'A cyberpunk tale about virtual reality and hackers.', 'genres' => ['science-fiction']],
            ['title' => 'Altered Carbon', 'excerpt' => 'Futuristic crime story with transferable consciousness.', 'genres' => ['science-fiction']],
            ['title' => 'I, Robot', 'excerpt' => 'Asimov’s collection of stories about robots and the laws of robotics.', 'genres' => ['science-fiction']],
            ['title' => 'The Martian', 'excerpt' => 'Adventures of an astronaut stranded on Mars.', 'genres' => ['science-fiction']],
            ['title' => 'Ready Player One', 'excerpt' => 'Futuristic adventure in a virtual reality world.', 'genres' => ['science-fiction']],
            ['title' => 'Red Rising', 'excerpt' => 'Sci-Fi story about a revolution on Mars.', 'genres' => ['science-fiction']],
            ['title' => 'Old Man’s War', 'excerpt' => 'Sci-Fi about veterans fighting in space.', 'genres' => ['science-fiction']],
            // thriller
            ['title' => 'The Da Vinci Code', 'excerpt' => 'Mystery thriller with historical codes and secrets.', 'genres' => ['thriller']],
            ['title' => 'Gone Girl', 'excerpt' => 'Dark psychological thriller about a mysterious disappearance.', 'genres' => ['thriller']],
            ['title' => 'The Girl with the Dragon Tattoo', 'excerpt' => 'Crime thriller full of intrigue and hacking.', 'genres' => ['thriller']],
            ['title' => 'Angels & Demons', 'excerpt' => 'Thriller with Vatican mysteries and ancient organizations.', 'genres' => ['thriller']],
            ['title' => 'The Silent Patient', 'excerpt' => 'Psychological thriller about a woman who stops speaking after a murder.', 'genres' => ['thriller']],
            ['title' => 'Before I Go to Sleep', 'excerpt' => 'Psychological thriller about a woman who loses memory every day.', 'genres' => ['thriller']],
            ['title' => 'Shutter Island', 'excerpt' => 'Psychological thriller with a mysterious island.', 'genres' => ['thriller']],
            ['title' => 'Dark Places', 'excerpt' => 'Thriller about dark family secrets.', 'genres' => ['thriller']],
            ['title' => 'The Reversal', 'excerpt' => 'Legal thriller with twists and courtroom drama.', 'genres' => ['thriller']],
            ['title' => 'The Partner', 'excerpt' => 'Thriller about betrayal, revenge, and deception.', 'genres' => ['thriller']],
        ];

        foreach ( $books as $book ) {
            $post_id = wp_insert_post([
                'post_title'   => $book['title'],
                'post_excerpt' => $book['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'fz-book',
            ]);

            if ( $post_id && !is_wp_error( $post_id ) ) {
                wp_set_object_terms( $post_id, $book['genres'], 'fz-genre' );

                $placeholder_id = get_option( 'fz_features_placeholder_id' );
                if ($placeholder_id) {
                    set_post_thumbnail($post_id, $placeholder_id);
                }
            }
        }
    }
}
add_action( 'init', 'fz_features_create_dummy_books', 25 );

// load functions
require_once FZ_FEATURES_PATH . 'includes/functions/assets.php';
require_once FZ_FEATURES_PATH . 'includes/functions/ajax.php';

// load cpt, tax
require_once FZ_FEATURES_PATH . 'includes/custom-post-types/fz-book.php';

// load blocks
require_once FZ_FEATURES_PATH . 'includes/blocks/fz-faq.php';

