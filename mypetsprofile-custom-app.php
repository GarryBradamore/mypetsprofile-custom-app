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
        // Includes
        include 'blocks/directorist-category.php';
        include 'blocks/frontpage-menu-custom.php';
        include 'blocks/mpp-image-menu.php';
        include 'blocks/app-menu-block.php';

        // Custom post type
        include 'inc/mpp-custom-post-type.php';

        // Active Classes
        BuddyBossApp\Custom\DirectoristCategory::instance();
        BuddyBossApp\Custom\FrontpageMenuCustom::instance();
        BuddyBossApp\Custom\MppImageMenu::instance();
        BuddyBossApp\Custom\AppMenuBlock::instance();
    }
}
add_action('plugins_loaded', 'bbapp_custom_work_init');
