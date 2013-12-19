<?php
/* Template name: Category archive */
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
        'posts_per_page' => 1000,
);

$upcoming_events = new WP_Query($upcoming_events_args);

$past_events_args = array(
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
        'posts_per_page' => 1000,
);

$past_events = new WP_Query($past_events_args);

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
                    <h2>Upcoming Events</h2>
                    <?php if ($upcoming_events->have_posts()):
                        while ($upcoming_events->have_posts()):
                            $upcoming_events->the_post();
                            get_template_part('grid', 'item');
                        endwhile;
                    else:
                        echo "No upcoming events scheduled. Please check back soon.";
                    endif; ?>

                    <h2>Past Events</h2>
                    <?php while ($past_events->have_posts()):
                        $past_events->the_post();
                        get_template_part('grid', 'item');
                    endwhile; ?>
                </div>
            </article>
        </div><!-- #content -->
    </div><!-- #primary -->
    <?php get_sidebar('content'); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
