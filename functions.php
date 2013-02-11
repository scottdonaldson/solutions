<?php

// Register nav menu
register_nav_menu('primary', 'Primary Menu');

// include jQuery
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    // As of Jan. 2013, latest jQuery is 1.9.0
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
}

// Excerpt length and '...'
function custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Remove some stuff from head
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');

// Remove a few admin pages
add_action( 'admin_menu', 'my_remove_menus', 999 );
function my_remove_menus() {
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'upload.php' );
	remove_menu_page( 'link-manager.php' );
}

// Admin footer
add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'Site developed by <a href="http://parsleyandsprouts.com" target="_blank">Parsley &amp Sprouts</a>.';
    return $text;
}
add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = '&copy '.date('Y').'.';
    return $text;
}

?>