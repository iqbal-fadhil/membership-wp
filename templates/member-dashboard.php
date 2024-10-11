<?php
/* Template Name: Member Dashboard */
get_header();

// Only logged-in users can see this page
if (!is_user_logged_in()) {
    echo 'You need to be logged in to view this page.';
} else {
    // Call the shortcode to render dashboard content
    echo do_shortcode('[member_dashboard_content]');
}

get_footer();
