<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php twentyfourteen_post_thumbnail(); ?>

    <header class="entry-header">
    <?php
            if (is_single()) {
                the_title('<h1 class="entry-title">', '</h1>');
            }
            else {
                the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
            }

            $today = new DateTime();
            $date = new DateTime(get_field('date'));

            $venue = mcd_get_venue_from_array(get_field('venue'));
         ?>
    </header>

    <?php if (is_search()): ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    <?php else: ?>
    <div class="entry-content">
        <div class="col">
            <h2>Date &amp; Time</h2>
            <?php echo $date->format(get_option('date_format')); ?><br />
            <?php the_field('time'); ?>
        </div>

        <div class="col">
            <h2>Venue</h2>
            <strong><?php echo get_the_title($venue); ?></strong><br />
            <?php the_field('address', $venue); ?><br />
            <?php the_field('post_code', $venue); ?>
        </div>

        <?php if ($date > $today): ?>

                <h2>Tickets</h2>
                <?php
                    $pattern = "/<iframe(.*?)<\/iframe>/";
                    if (preg_match($pattern, get_field('eventbrite_embed_code'), $matches)) {
                        echo $matches[0];
                    }
                    else {
                        the_field('eventbrite_embed_code');
                    }

                ?>

                <h2>Map</h2>
                <?php mcd_google_map(get_field('post_code', $venue)); ?>

                <h2>Parking</h2>
                <?php the_field('parking', $venue);

                if ($post->post_content != ''): ?>
                    <h2>More Info</h2>
                    <?php the_content();
                endif;

            elseif (get_field('after_event_content')): ?>
                <h2>Summary</h2>
                <?php the_field('after_event_content');
            endif;

            wp_link_pages(array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfourteen') . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ));
        ?>
    </div>
    <?php endif;

    the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
</article>
