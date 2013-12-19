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

            $venue = get_field('venue');
            if (is_array($venue)) {
                $venue = array_pop($venue);
            }
         ?>
    </header><!-- .entry-header -->

    <?php if (is_search()): ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else: ?>
    <div class="entry-content">
        <?php

            if ($date > $today):
                the_content();
        ?>

                <h2>Date &amp; Time</h2>
                <?php echo $date->format(get_option('date_format')); ?><br />
                <?php the_field('time'); ?>

                <h2>Venue</h2>
                <strong><?php echo get_the_title($venue); ?></strong><br />
                <?php echo the_field('address', $venue); ?><br />
                <?php echo the_field('post_code', $venue); ?>

                <h3>Parking</h3>
                <?php echo the_field('parking', $venue); ?>

                <div id="map-canvas" style="width:100%;height:300px;"></div>

                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHypiArLzJ3yOE4qdHZDleTlEm_bDnmE&sensor=false"></script>
                <script type="text/javascript">
                <?php

                $post_code = urlencode(get_field('post_code', $venue));
                $url = "http://maps.googleapis.com/maps/api/geocode/json?address={$post_code}&sensor=false";
                $json = json_decode(file_get_contents($url));

                $lat = $json->results[0]->geometry->location->lat;
                $lng = $json->results[0]->geometry->location->lng;

                ?>
                    function initialize() {
                        var lat = <?php echo $lat; ?>;
                        var lng = <?php echo $lng; ?>;
                        var position = new google.maps.LatLng(lat, lng);
                        var mapOptions = {
                            center: position,
                            zoom: 13
                        };
                        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                        var image = "<?php bloginfo('template_directory'); ?>/images/coderdojo-32x32.png";
                        var marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            icon: image
                        });
                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>

        <?php else:
                the_field('after_event_content');
            endif;

            wp_link_pages(array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfourteen') . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ));
        ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

    <?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
</article><!-- #post-## -->
