<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/nariman924/movies
 * @since      1.0.0
 *
 * @package    Movies
 * @subpackage Movies/public/partials
 */

get_header(); ?>
    <div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option('site_layout'); ?>">
        <main id="main" class="site-main" role="main">
            <?php while (have_posts()) : the_post();
                $postId = get_the_ID();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header page-header">
                        <?php
                            if (of_get_option('single_post_image', 1) == 1) :
                                the_post_thumbnail('unite-featured', array('class' => 'thumbnail'));
                            endif;
                        ?>
                        <h1 class="entry-title "><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <?php unite_posted_on(); ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <table class="table">
                            <tr>
                                <th>Country</th>
                                <td>
                                    <span class="glyphicon glyphicon-globe"></span>
                                    <?php the_custom_terms( $postId, 'tax_movies_country' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td>
                                    <span class="glyphicon glyphicon-picture"></span>
                                    <?php the_custom_terms( $postId, 'tax_movies_genre' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Cost</th>
                                <td>
                                    <span class="glyphicon glyphicon-euro"></span>
                                    <span class="label label-default">
                                        <?= get_post_meta($postId, 'movie_cost', true) ?> Р.</span></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    <span class="label label-default">
                                        <?= get_post_meta($postId, 'movie_date', true) ?></span></td>
                            </tr>
                        </table>
                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'unite'),
                            'after' => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->
                    <footer class="entry-meta">
                        <?php
                        /* translators: used between list items, there is a space after the comma */
                        $category_list = get_the_category_list(__(', ', 'unite'));

                        /* translators: used between list items, there is a space after the comma */
                        $tag_list = get_the_tag_list('', __(', ', 'unite'));

                        if (!unite_categorized_blog()) {
                            // This blog only has 1 category so we just need to worry about tags in the meta text
                            if ('' != $tag_list) {
                                $meta_text = '<i class="fa fa-folder-open-o"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
                            } else {
                                $meta_text = '<i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
                            }

                        } else {
                            // But this blog has loads of categories so we should probably display them here
                            if ('' != $tag_list) {
                                $meta_text = '<i class="fa fa-folder-open-o"></i> %1$s <i class="fa fa-tags"></i> %2$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
                            } else {
                                $meta_text = '<i class="fa fa-folder-open-o"></i> %1$s. <i class="fa fa-link"></i> <a href="%3$s" rel="bookmark">permalink</a>.';
                            }

                        } // end check for categories on this blog

                        printf(
                            $meta_text,
                            $category_list,
                            $tag_list,
                            get_permalink()
                        );
                        ?>

                        <?php edit_post_link(__('Edit', 'unite'),
                            '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>'); ?>
                        <?php unite_setPostViews(get_the_ID()); ?>
                        <hr class="section-divider">
                    </footer><!-- .entry-meta -->
                </article><!-- #post-## -->
            <?php endwhile; // end of the loop. ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php wp_reset_query();?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>