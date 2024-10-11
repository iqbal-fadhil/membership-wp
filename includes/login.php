<?php
// Login Form Shortcode
function custom_login_form() {
    ob_start(); ?>
    <form id="custom-login-form" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </p>
        <p>
            <input type="submit" name="submit_login" value="Login">
        </p>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_login', 'custom_login_form');

// Login Handling Function
function custom_user_login() {
    if ( isset($_POST['submit_login']) ) {
        // Sanitize the input
        $creds = array(
            'user_login'    => sanitize_user( $_POST['username'] ),
            'user_password' => sanitize_text_field( $_POST['password'] ),
            'remember'      => true
        );

        // Attempt to sign in the user
        $user = wp_signon( $creds, false );

        if ( is_wp_error( $user ) ) {
            // Display error message
            echo '<div class="error">Login failed: ' . $user->get_error_message() . '</div>';
        } else {
            // Redirect to member dashboard after successful login
            wp_redirect( home_url() . '/member-dashboard' );
            exit;
        }
    }
}
add_action('init', 'custom_user_login');
