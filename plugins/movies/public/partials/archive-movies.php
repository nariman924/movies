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
    <section id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option('site_layout'); ?>">
        <main id="main" class="site-main" role="main">
            <?php
            do_action('banner_action');
            $loop = new WP_Query(['post_type' => 'movies']);
            ?>
            <?php if ($loop->have_posts()) : ?>
                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="taxonomy-description">', '</div>');
                    ?>
                </header><!-- .page-header -->

                <?php /* Start the Loop */ ?>
                <?php while ($loop->have_posts()) : $loop->the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header page-header">
                            <a href="<?php the_permalink() ?>"
                               title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('unite-featured',
                                    array('class' => 'thumbnail')); ?></a>

                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"
                                                       rel="bookmark"><?php the_title(); ?></a></h2>
                        </header><!-- .entry-header -->

                        <?php if (is_search()) : // Only display Excerpts for Search ?>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                                <p><a class="btn btn-primary read-more"
                                      href="<?php the_permalink(); ?>"><?php _e('Continue reading', 'unite'); ?> <i
                                                class="fa fa-chevron-right"></i></a></p>
                            </div><!-- .entry-summary -->
                        <?php else : ?>
                            <div class="entry-content">

                                <?php if (of_get_option('blog_settings') == 1 || !of_get_option('blog_settings')) : ?>
                                    <?php the_content(__('Continue reading <i class="fa fa-chevron-right"></i>',
                                        'unite')); ?>
                                <?php elseif (of_get_option('blog_settings') == 2) : ?>
                                    <?php the_excerpt(); ?>
                                <?php endif; ?>

                                <?php
                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . __('Pages:', 'unite'),
                                    'after' => '</div>',
                                ));
                                ?>
                            </div><!-- .entry-content -->
                        <?php endif; ?>

                        <footer class="entry-meta">
                            <?php edit_post_link(__('Edit', 'unite'),
                                '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>'); ?>
                        </footer><!-- .entry-meta -->
                        <hr class="section-divider">
                    </article><!-- #post-## -->
                <?php endwhile; ?>
                <?php unite_paging_nav(); ?>
            <?php else : ?>
                <?php get_template_part('content', 'none'); ?>
            <?php endif; ?>
            <?php do_action('banner_action'); ?>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php wp_reset_query();?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>