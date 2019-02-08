<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_shortcode('recent_movies', 'searchForm');

function searchForm($atts = [], $content = null, $tag = '')
{
    if ( ! is_admin() ) {
        require __DIR__ . '/templates/recent_movies.php';
    }
}

function the_custom_terms($postId, $taxonomy)
{
    $out = [];
    $terms = get_the_terms( $postId, $taxonomy );

    if (is_array($terms)) {
        foreach ($terms as $term) {
            if (isset($term->name)) {
                $out[] = $term->name;
            }
        }
    }

    echo implode(', ', $out);
}

