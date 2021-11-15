<?php

/**
 * Plugin Name:       fb_test_plugin
 * Description:       Plugin to run some quick test. Right now does it cleans some user metadata in DB. 
 * Version:           1.0
 * Author:            Francois Bessette
 * License:           GPL v2 or later
 * Text Domain:       fb_test_plugin
 */


//This is a temporary function to clean the Outaouais DB by removing
//meta-data that is no longer used.
function clear_db_duplicate_entries() {
    error_log("Will start clearing entries");
    $db_users = get_users(‘all_with_meta’);
    error_log("We have " . count($db_users) . " users in DB");
    foreach ( $db_users as $key => $user ) {
        $result1 = delete_user_meta($user->ID, 'City');
        $result2 = delete_user_meta($user->ID, 'Home Phone');
        $result3 = delete_user_meta($user->ID, 'Cell Phone');
        error_log("Cleaned DB for user " . $user->display_name . ", results=" . $result1 . $result2 . $result3);
    }
}


/**
 * Activate the plugin.
 */
function activate_fb_test_plugin() {
    error_log("Hello captain");
    clear_db_duplicate_entries();
}
register_activation_hook( __FILE__, 'activate_fb_test_plugin' );