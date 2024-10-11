<?php

// Registration form and handling logic here
function custom_registration_form() {
    ob_start(); ?>
    <!-- Your registration form HTML -->
    <?php
    return ob_get_clean();
}
add_shortcode('custom_registration', 'custom_registration_form');

// Registration handler
function custom_user_registration() {
    // Registration logic here
}
add_action('init', 'custom_user_registration');
?>
