<?php
/*
Plugin Name: Manchester CoderDojo Newsletter Generator
Plugin URI: https://github.com/mcrcoderdojo/mcrcoderdojo.org.uk
Description: Generate HTML from WordPress Post for a mailchimp newsletter
Version: 1.1
Author: Ben Nuttall
Author URI: http://bennuttall.com/
*/

add_action('admin_menu', 'pw_admin_menu_setup');

// Add to left admin menu
function pw_admin_menu_setup() {
	add_menu_page('Newsletter Generator', 'Newsletter Generator', 'add_users', 'mcd-newsletter', 'mcd_generate_newsletter');
}

function mcd_generate_newsletter() {
    include 'newsletter-generator.php';
}

// Functions used in template

function get_domain_from_url($url) {
    $parsed_url = parse_url($url);
    $domain = str_replace('www.', '', $parsed_url['host']);
    return $domain;
}

function strip_paragraphs($content) {
    return str_replace('<p>', '', str_replace('</p>', '', $content));
}
