<?php
/*
Plugin Name: Meta Data
Description: Display name and email data from wp_frmt_form_entry_meta in admin panel.
Version: 1.0
Author: Aman Sharma
*/

// Add a menu item in the admin panel
add_action('admin_menu', 'custom_admin_table_menu');

function custom_admin_table_menu() {
    add_menu_page('Name and Email Data', 'Name and Email Data', 'manage_options', 'custom-admin-table-plugin', 'custom_admin_table_page');
}

// Function to display the table on the admin panel page
function custom_admin_table_page() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'frmt_form_entry_meta';

    // Modify the SQL query to select only rows with specific meta_key values for names and emails
    $entries = $wpdb->get_results("SELECT * FROM $table_name WHERE meta_key IN ('name-1', 'name-2', 'name-3', 'email-1') ORDER BY entry_id, meta_key");

    ?>
    <div class="wrap">
        <h2>Name and Email Data</h2>
        <table class="widefat">
            <thead>
                <tr>
                    <th>Entry ID</th>
                    <th>Meta ID</th>
                    <th>Meta Key</th>
                    <th>Meta Value</th>
                    <th>Date Updated</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($entries as $entry) {
                    echo '<tr>';
                    echo '<td>' . esc_html($entry->entry_id) . '</td>';
                    echo '<td>' . esc_html($entry->meta_id) . '</td>';
                    echo '<td>' . esc_html($entry->meta_key) . '</td>';
                    echo '<td>' . esc_html($entry->meta_value) . '</td>';
                    echo '<td>' . esc_html($entry->date_updated) . '</td>';
                    echo '<td>' . esc_html($entry->date_created) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}
