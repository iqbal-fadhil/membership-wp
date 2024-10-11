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

// Shortcode for the registration form
function membership_registration_form_shortcode() {
    ob_start();

    if (is_user_logged_in()) {
        echo '<p>You are already logged in.</p>';
    } else {
        // Output registration form
        ?>
        <form id="membership-registration-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <input type="hidden" name="action" value="membership_register_user">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <input type="submit" value="Register">
            </p>
        </form>
        <?php
    }

    return ob_get_clean();
}
add_shortcode('membership_registration_form', 'membership_registration_form_shortcode');

?>
