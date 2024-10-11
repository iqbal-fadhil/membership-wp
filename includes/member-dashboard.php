<?php
// Create a Member Dashboard page upon plugin activation
function create_member_dashboard_page() {
    $page_title = 'Member Dashboard';
    $page_content = '[member_dashboard_content]';  // Use shortcode for dashboard content
    $page_check = get_page_by_title($page_title);

    if (!isset($page_check->ID)) {
        $new_page_id = wp_insert_post(array(
            'post_title' => $page_title,
            'post_content' => $page_content,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_author' => 1
        ));
    }
}
register_activation_hook(__FILE__, 'create_member_dashboard_page');

// Member Dashboard Shortcode
function member_dashboard_shortcode() {
    if (!is_user_logged_in()) {
        return 'You need to be logged in to view this page.';
    }

    // Fetch logged-in user info
    $user = wp_get_current_user();
    $user_id = $user->ID;

    ob_start();

    // Display Premium Content
    echo '<h2>Your Premium Content</h2>';
    $args = array(
        'post_type' => 'premium_content',
        'posts_per_page' => -1,
        'author' => $user_id
    );
    $premium_content_query = new WP_Query($args);
    if ($premium_content_query->have_posts()) {
        while ($premium_content_query->have_posts()) {
            $premium_content_query->the_post();
            echo '<h3>' . get_the_title() . '</h3>';
            the_content();
        }
    } else {
        echo '<p>No premium content available yet.</p>';
    }

    // Display WooCommerce Order Info
    if (class_exists('WooCommerce')) {
        echo '<h2>Your Orders</h2>';
        $customer_orders = wc_get_orders(array(
            'customer_id' => $user_id,
            'limit' => -1
        ));

        if (!empty($customer_orders)) {
            foreach ($customer_orders as $order) {
                echo '<div class="order-summary">';
                echo '<strong>Order #' . $order->get_order_number() . '</strong><br>';
                echo 'Date: ' . wc_format_datetime($order->get_date_created()) . '<br>';
                echo 'Total: ' . $order->get_formatted_order_total() . '<br>';
                echo 'Status: ' . wc_get_order_status_name($order->get_status()) . '<br>';
                echo '</div><hr>';
            }
        } else {
            echo '<p>No orders found.</p>';
        }
    } else {
        echo '<p>WooCommerce is not activated.</p>';
    }

    return ob_get_clean();
}
add_shortcode('member_dashboard_content', 'member_dashboard_shortcode');
