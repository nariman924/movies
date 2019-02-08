<?php do_action('banner_action'); ?>
<div class="row">
<?php
$loop = new WP_Query(['post_type' => $atts['type'], 'posts_per_page' => $atts['count']]);
if ($loop->have_posts()) :
    while ($loop->have_posts()) :
        $loop->the_post();
        $postId = get_the_ID();
    ?>
        <div class="col-sm-6">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header page-header">
                    <?php
                        if ( of_get_option( 'single_post_image', 1 ) == 1 ) :
                            the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' ));
                        endif;
                    ?>
                    <h1 class="entry-title "><a href="<?php the_permalink(); ?>"
                                                rel="bookmark"><?php the_title(); ?></a></h1>
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

                </div><!-- .entry-content -->
            </article><!-- #post-## -->
        </div>
    <?php endwhile; ?>
<?php else : ?>
    <?php get_template_part('content', 'none'); ?>
<?php endif;
    wp_reset_query();
?>
</div>
<?php do_action('banner_action'); ?>
