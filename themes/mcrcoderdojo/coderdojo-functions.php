<?php

// Post Types

function create_events_post_type() {
    $labels = array(
        'name'               => 'Events',
        'singular_name'      => 'Event',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Event',
        'edit_item'          => 'Edit Event',
        'new_item'           => 'New Event',
        'all_items'          => 'All Events',
        'view_item'          => 'View Event',
        'search_items'       => 'Search Events',
        'not_found'          => 'No Events found',
        'not_found_in_trash' => 'No Events found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Events',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'event'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('event', $args);
}
add_action('init', 'create_events_post_type');

function create_venues_post_type() {
    $labels = array(
        'name'               => 'Venues',
        'singular_name'      => 'Venue',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Venue',
        'edit_item'          => 'Edit Venue',
        'new_item'           => 'New Venue',
        'all_items'          => 'All Venues',
        'view_item'          => 'View Venue',
        'search_items'       => 'Search Venues',
        'not_found'          => 'No Venues found',
        'not_found_in_trash' => 'No Venues found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Venues',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => null,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title'),
    );

    register_post_type('venue', $args);
}
add_action('init', 'create_venues_post_type');

// Filters

function mcd_excerpt($more) {
    return "... <a href='" . get_permalink() . "'>Continue reading</a>";
}
add_filter('excerpt_more', 'mcd_excerpt');

// Shortcodes

// Shortcode [userbio]
function mcd_user_bio($opts) {
    $usernames = $opts['usernames'];

    $html = '';

    foreach (split(',', $usernames) as $i => $username) {
        $username = trim($username);
        $user = get_user_by('slug', $username);
        $name = "{$user->first_name} {$user->last_name}";
        $fname = $user->first_name;
        $id = $user->id;
        $bio = get_field('bio', "user_{$id}");
        $photo = get_field('photo', "user_{$id}");
        $user = get_userdata($id);
        $web = $user->user_url;
        $twitter = get_field('twitter', "user_{$id}");
        $gplus = get_field('google_plus', "user_{$id}");
        $endcol = $i % 4 == 0 ? 'endcol' : '';

        $html .= "<div class='user-bio {$endcol}'>";
        $html .= '<h3><a href="/author/' . $username . '">' . $name . '</a></h3>';

        if ($photo) {
            $thumbnail = $photo['sizes']['thumbnail'];
            $html .= '<a href="/author/"' . $username . '/"><img src="' . $thumbnail . '" /></a>';
        }

        $html .= $bio;

        if ($web) {
            $html .= "<a href='{$web}' class='web' target='_blank'>" . get_domain_from_url($web) . "</a><br />";
        }

        if ($twitter) {
            $html .= "<a href='http://twitter.com/{$twitter}' class='twitter' target='_blank'>@{$twitter}</a><br />";
        }

        if ($gplus) {
            $gplus_text = $gplus[0] == '+' ? "{$gplus}" : $name;
            $html .= "<a href='http://plus.google.com/{$gplus}' class='gplus' target='_blank'>{$gplus_text}</a>";
        }

        $html .= "</div>";
    }
    return $html;
}
add_shortcode('userbio', 'mcd_user_bio');

function mcd_google_map($post_code) {
    echo mcd_google_map_sc(array('postcode' => $post_code));
}

function mcd_google_map_sc($opts) {
    $post_code = $opts['postcode'];
    $dir = get_bloginfo('template_directory');

    $html = "<div id='map-canvas' style='width:100%;height:300px;'></div>

        <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAjHypiArLzJ3yOE4qdHZDleTlEm_bDnmE&sensor=false'></script>
        <script type='text/javascript'>
            function initialize() {
                geocoder = new google.maps.Geocoder();
                var mapOptions = {
                    zoom: 13
                };
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                codeAddress();
            }

            function codeAddress() {
                var address = '{$post_code}';
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        var image = '{$dir}/images/coderdojo-32x32.png';
                        var marker = new google.maps.Marker({
                            position: results[0].geometry.location,
                            map: map,
                            icon: image
                        });
                    }
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>";

        return $html;
    }
    add_shortcode('googlemap', 'mcd_google_map_sc');

// MCD Specific functions

function mcd_get_venue_from_array($venue) {
    $venue = get_field('venue');
    if (is_array($venue)) {
        $venue = array_pop($venue);
        return $venue;
    }
}

// Useful Functions
