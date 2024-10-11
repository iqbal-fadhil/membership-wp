<?php
// Register Premium Content Custom Post Type (CPT)
function create_premium_content_cpt() {
    $labels = array(
        'name' => 'Premium Content',
        'singular_name' => 'Premium Content',
        'menu_name' => 'Premium Content',
        'name_admin_bar' => 'Premium Content',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Premium Content',
        'edit_item' => 'Edit Premium Content',
        'new_item' => 'New Premium Content',
        'view_item' => 'View Premium Content',
        'all_items' => 'All Premium Content',
        'search_items' => 'Search Premium Content',
        'not_found' => 'No Premium Content found.',
        'not_found_in_trash' => 'No Premium Content found in Trash.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => false,       // Only logged-in users should see it
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'premium-content'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail'),  // Content fields supported
        'show_in_rest' => true,               // For Gutenberg editor
    );

    register_post_type('premium_content', $args);
}
add_action('init', 'create_premium_content_cpt');

// Restrict Access to Premium Content for Non-Members
function restrict_premium_content_access( $content ) {
    if ( is_singular('premium_content') && !is_user_logged_in() ) {
        return 'This content is for members only. Please log in to view.';
    }
    return $content;
}
add_filter('the_content', 'restrict_premium_content_access');
