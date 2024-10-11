<?php
// Add Member Management Page to Admin Menu
function add_member_management_menu() {
    add_menu_page(
        'Member Management',              // Page title
        'Members',                        // Menu title
        'manage_options',                 // Capability
        'member-management',              // Menu slug
        'render_member_management_page',  // Callback function
        'dashicons-admin-users',          // Icon
        6                                 // Position
    );
}
add_action('admin_menu', 'add_member_management_menu');

// Render Member Management Page
function render_member_management_page() {
    ?>
    <div class="wrap">
        <h1>Member Management</h1>

        <!-- Display Members Table -->
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch members from the database
                $users = get_users();

                foreach ( $users as $user ) {
                    echo '<tr>';
                    echo '<td>' . $user->ID . '</td>';
                    echo '<td>' . $user->user_login . '</td>';
                    echo '<td>' . $user->user_email . '</td>';
                    echo '<td>';
                    echo '<a href="' . admin_url('admin.php?page=edit-member&user_id=' . $user->ID ) . '">Edit</a> | ';
                    echo '<a href="' . wp_nonce_url( admin_url('admin.php?page=delete-member&user_id=' . $user->ID ), 'delete_member_' . $user->ID ) . '">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Add member handling (edit, delete)
function handle_member_actions() {
    if ( isset( $_GET['page'] ) && $_GET['page'] == 'delete-member' && isset( $_GET['user_id'] ) ) {
        $user_id = intval( $_GET['user_id'] );

        // Verify nonce for security
        if ( wp_verify_nonce( $_GET['_wpnonce'], 'delete_member_' . $user_id ) ) {
            wp_delete_user( $user_id );
            wp_redirect( admin_url('admin.php?page=member-management') );
            exit;
        }
    }

    if ( isset( $_GET['page'] ) && $_GET['page'] == 'edit-member' && isset( $_GET['user_id'] ) ) {
        // Redirect to the default user profile page
        wp_redirect( admin_url('user-edit.php?user_id=' . intval($_GET['user_id']) ) );
        exit;
    }
}
add_action( 'admin_init', 'handle_member_actions' );
