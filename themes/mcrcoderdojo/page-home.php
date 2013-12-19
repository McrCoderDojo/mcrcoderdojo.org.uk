<?php

get_header();

$upcoming_events_args = array(
    'post_type' => 'event',
    'meta_query' => array(
        array(
            'key' => 'date',
            'value' => date('Y-m-d'),
            'compare' => '>=',
            'type' => 'date',
        ),
    ),
    'order' => 'asc',
    'posts_per_page' => 4,
);

$upcoming_events = new WP_Query($upcoming_events_args);

$recent_events_args = array(
    'post_type' => 'event',
    'meta_query' => array(
        array(
            'key' => 'date',
            'value' => date('Y-m-d'),
            'compare' => '<',
            'type' => 'date',
        ),
    ),
    'order' => 'desc',
    'posts_per_page' => 4,
);

$recent_events = new WP_Query($recent_events_args);

$latest_newsletters_args = array(
    'category_name' => 'newsletters',
    'posts_per_page' => 4,
);

$latest_newsletters = new WP_Query($latest_newsletters_args);

$latest_blog_posts_args = array(
    'category_name' => 'blog',
    'posts_per_page' => 4,
);

$latest_blog_posts = new WP_Query($latest_blog_posts_args);

?>

<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php twentyfourteen_post_thumbnail(); ?>

                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->


                <div class="entry-content <?php echo $pagename; ?>">
                    <?php wp_reset_query();
                    the_content(); ?>
                </div><!-- .entry-content -->

                <div class="entry-content full">
                    <?php if ($upcoming_events->have_posts()): ?>
                        <h2><a href="/events/">Upcoming Events</a></h2>
                        <?php while ($upcoming_events->have_posts()):
                            $upcoming_events->the_post();
                            get_template_part('grid', 'item');
                        endwhile;
                    endif; ?>

                    <h2><a href="/events/">Recent Events</a></h2>
                    <?php while ($recent_events->have_posts()):
                        $recent_events->the_post();
                        get_template_part('grid', 'item');
                    endwhile; ?>

                    <h2><a href="/newsletters/">Latest Newsletters</a></h2>
                    <?php while ($latest_newsletters->have_posts()):
                        $latest_newsletters->the_post();
                        get_template_part('grid', 'item');
                    endwhile; ?>

                    <h2><a href="/blog/">Latest Blog Posts</a></h2>
                    <?php while ($latest_blog_posts->have_posts()):
                        $latest_blog_posts->the_post();
                        get_template_part('grid', 'item');
                    endwhile; ?>

                </div><!-- .entry-content -->

            </article><!-- #post-## -->

        </div><!-- #content -->
    </div><!-- #primary -->
    <?php get_sidebar('content'); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
