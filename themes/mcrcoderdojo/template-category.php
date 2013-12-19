<?php
/* Template name: Category archive */
get_header();

$args = array(
    'category_name' => $pagename,
);

$posts = new WP_Query($args);

?>

<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php twentyfourteen_post_thumbnail(); ?>

                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content full">
                    <?php while ($posts->have_posts()): $posts->the_post(); ?>
                        <div class="grid-item">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/coderdojo.png" width="150" height="150" /></a>
                            <?php endif; ?>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <span class="date"><?php echo get_the_date(); ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </article>
        </div><!-- #content -->
    </div><!-- #primary -->
    <?php get_sidebar('content'); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
