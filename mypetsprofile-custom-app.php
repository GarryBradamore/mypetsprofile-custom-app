<?php
/*
Plugin Name: MyPetsProfile Custom App
Plugin URI: https://mypertsprofile.com
Description: MyPetsProfile custom app development
Version: 1.0.0
Author: MPP
Author URI: https://mypertsprofile.com
*/
if (!defined('ABSPATH')) {
    exit();
}

/**
 * Load Custom Block Functions
 */
function bbapp_custom_work_init()
{
    if (class_exists('bbapp')) {
        include 'mpp-app-custom-block.php';
        BuddyBossApp\Custom\DirectoristCategory::instance();
    }
}
add_action('plugins_loaded', 'bbapp_custom_work_init');
