<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/nariman924/movies
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Movies
 * @subpackage Movies/admin
 * @author     Nariman <nariman.pub@gmail.com>
 */
class Movies_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    public static function display_movie_meta_box($movie)
    {
        $movieCost = (float)get_post_meta($movie->ID, 'movie_cost', true);
        $movieDate = esc_html(get_post_meta($movie->ID, 'movie_date', true));

        require __DIR__ . '/partials/movies-meta-box-display.php';
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Movies_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Movies_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
        wp_enqueue_style('jquery-ui');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) .
            'css/movies-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Movies_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Movies_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) .
            'js/movies-admin.js', array('jquery', 'jquery-ui-datepicker'), $this->version, true);
    }

    public function create_movie_cpt()
    {
        register_post_type('movies',
            [
                'labels' => [
                    'name' => 'Movies',
                    'singular_name' => 'Movie',
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New Movie',
                    'edit' => 'Edit',
                    'edit_item' => 'Edit Movie',
                    'new_item' => 'New Movie',
                    'view' => 'View',
                    'view_item' => 'View Movie',
                    'search_items' => 'Search Movie',
                    'not_found' => 'No Movie found',
                    'not_found_in_trash' => 'No Movie found in Trash',
                    'parent' => 'Parent Movie'
                ],

                'public' => true,
                'menu_position' => 15,
                'supports' => ['title', 'editor', 'thumbnail'],
                'taxonomies' => [''],
                'menu_icon' => 'dashicons-media-document',
                'has_archive' => true
            ]
        );
    }

    public function create_movie_meta_box()
    {
        add_meta_box('movie_review_meta_box',
            'Movie Details',
            [self::class, 'display_movie_meta_box'],
            'movies', 'normal', 'high'
        );
    }

    public function save_movie_meta_box($movie_id, $movie)
    {
        // Check post type for movie reviews
        if ($movie->post_type === 'movies') {
            // Store data in post meta table if present in post data
            if (!empty($_POST['movie_cost'])) {
                update_post_meta($movie_id, 'movie_cost', sanitize_text_field($_POST['movie_cost']));
            }
            if (!empty($_POST['movie_date'])) {
                update_post_meta($movie_id, 'movie_date', sanitize_text_field($_POST['movie_date']));
            }
        }
    }

    public function create_movie_tax()
    {
        register_taxonomy(
            'tax_movies_genre',
            'movies',
            [
                'labels' => [
                    'name' => 'Movie Genre',
                    'add_new_item' => 'Add New Movie Genre',
                    'new_item_name' => 'New Movie Genre'
                ],
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            ]
        );
        register_taxonomy(
            'tax_movies_year',
            'movies',
            [
                'labels' => [
                    'name' => 'Movie Year',
                    'add_new_item' => 'Add New Movie Year',
                    'new_item_name' => 'New Movie Year'
                ],
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            ]
        );
        register_taxonomy(
            'tax_movies_country',
            'movies',
            [
                'labels' => [
                    'name' => 'Movie Country',
                    'add_new_item' => 'Add New Movie Country',
                    'new_item_name' => 'New Movie Country'
                ],
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            ]
        );
        register_taxonomy(
            'tax_movies_actor',
            'movies',
            [
                'labels' => [
                    'name' => 'Movie Actor',
                    'add_new_item' => 'Add New Movie Actor',
                    'new_item_name' => 'New Movie Actor'
                ],
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            ]
        );
    }
}
