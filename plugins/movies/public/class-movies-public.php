<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/nariman924/movies
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Movies
 * @subpackage Movies/public
 * @author     Nariman <nariman.pub@gmail.com>
 */
class Movies_Public
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
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/movies-public.css', array(),
            $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/movies-public.js', array('jquery'),
            $this->version, false);

    }

    public function movie_single_template($template_path)
    {
        if (get_post_type() === 'movies') {

            if (is_single()) {
                if ($theme_file = locate_template(array('single-movies.php'))) {
                    $template_path = $theme_file;
                } else {
                    $template_path = __DIR__ . '/partials/single-movies.php';
                }
            } elseif (is_archive()) {
                if ($theme_file = locate_template(array('archive-movie.php'))) {
                    $template_path = $theme_file;
                } else {
                    $template_path = __DIR__ . '/partials/archive-movies.php';
                }
            }
        }
        return $template_path;
    }

    public function banner_action()
    {
        require __DIR__ . '/partials/banner.php';
    }
}
