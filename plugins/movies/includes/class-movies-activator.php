<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/nariman924/movies
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Movies
 * @subpackage Movies/includes
 * @author     Nariman <nariman.pub@gmail.com>
 */
class Movies_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        $movies = [
            [
                'post_type' => 'movies',
                'post_title' => 'Movie 1',
                'post_content' => '1 All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
                'post_status' => 'publish',
                'post_author' => 1,
            ],
            [
                'post_type' => 'movies',
                'post_title' => 'Movie 2',
                'post_content' => '2 All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
                'post_status' => 'publish',
                'post_author' => 1,
            ],
            [
                'post_type' => 'movies',
                'post_title' => 'Movie 3',
                'post_content' => '3 All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
                'post_status' => 'publish',
                'post_author' => 1,
            ],
            [
                'post_type' => 'movies',
                'post_title' => 'Movie 4',
                'post_content' => '4 All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
                'post_status' => 'publish',
                'post_author' => 1,
            ],
            [
                'post_type' => 'movies',
                'post_title' => 'Movie 5',
                'post_content' => '5 All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
                'post_status' => 'publish',
                'post_author' => 1,
            ],
        ];

        $taxes = [
            'tax_movies_genre',
            'tax_movies_year',
            'tax_movies_country',
            'tax_movies_actor',
        ];

        foreach ($movies as $movie) {
            $movieExist = get_page_by_title($movie['post_title'], OBJECT, 'movies');

            if ($movieExist === null) {
                $movieId = wp_insert_post($movie);
                update_post_meta($movieId, 'movie_cost', random_int(100, 500));
                update_post_meta($movieId, 'movie_date', date('Y-m-d', mt_rand(time() - 100000, time())));

                foreach ($taxes as $tax) {
                    register_taxonomy($tax, 'movies');

                    $termName = $movie['post_title'] . str_replace('tax_movies_', ' ', $tax);
                    $termArr = wp_insert_term($termName, $tax);

                    if (!is_wp_error($termArr) && isset($termArr['term_id'])) {
                        wp_set_object_terms($movieId, $termArr['term_id'], $tax);
                    }
                }
            }
        }
    }

}
