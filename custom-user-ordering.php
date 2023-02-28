<?php
/* 
Plugin Name: Custom User Ordering
Plugin URI: https://codingheads.com/
Description: Allows you to order the users with simple Drag and Drop Sortable capability.
Version: 2.1
Author: CodingHeads Team
Author URI: https://codingheads.com/

OLD Plugin URI: http://wordpress.org/plugins/custom-users-order/
OLD Author URI: http://www.betterinfo.in/hiren-patel/
OLD Author: Nidhi Parikh, Hiren Patel
OLD Version: 1.1

License: GPLv2 or later
*/
//-------------------Connection -----------------------------
include_once('addsection.php');


// Add settings link on plugin page
function user_order_settings_link($links)
{
    $settings_link = '<a href="users.php?page=addsection">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'user_order_settings_link');


add_action('admin_enqueue_scripts', 'custom_order_scripts');
function custom_order_scripts()
{ /*  Proper way to enqueue scripts and styles  */
    wp_enqueue_style('customstyle', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('orderusers', plugin_dir_url(__FILE__) . 'js/orderusers.js', array(), true);
}

add_action('wp_enqueue_scripts', 'custom_display_style');
function custom_display_style()
{
    wp_enqueue_style('customstyle', plugin_dir_url(__FILE__) . 'css/customdisplay.css');
}

add_action('admin_menu', 'manageuser');
function manageuser()
{
    add_submenu_page('users.php', 'Custom Users Order Page', 'Custom Users Order', 'manage_options', 'addsection', 'addsection');
}
