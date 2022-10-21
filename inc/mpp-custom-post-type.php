<?php

/**
 * @author  mahfuz
 * @since   1.0
 * @version 1.0
 */

class MPP_App_Support_Post_Type
{
    public function __construct()
    {
        add_action('init', [$this, 'create_custom_post_type']);

        add_filter('use_block_editor_for_post_type', [$this, 'prefix_disable_gutenberg'], 10, 2);

        add_action('add_meta_boxes', [$this, 'diwp_metabox_mutiple_fields']);

        add_action('save_post', [$this, 'diwp_save_multiple_fields_metabox']);
    }

    public function create_custom_post_type()
    {
        $labels = array(
            'name'                  => _x('App Menus', 'Post type general name', 'buddyboss'),
            'singular_name'         => _x('App Menu', 'Post type singular name', 'buddyboss'),
            'menu_name'             => _x('App Menus', 'Admin Menu text', 'buddyboss'),
            'name_admin_bar'        => _x('App Menu', 'Add New on Toolbar', 'buddyboss'),
            'add_new'               => __('Add New', 'buddyboss'),
            'add_new_item'          => __('Add New Option', 'buddyboss'),
            'new_item'              => __('New Option', 'buddyboss'),
            'edit_item'             => __('Edit Option', 'buddyboss'),
            'view_item'             => __('View Option', 'buddyboss'),
            'all_items'             => __('All options', 'buddyboss'),
            'search_items'          => __('Search options', 'buddyboss'),
            'parent_item_colon'     => __('Parent option:', 'buddyboss'),
            'not_found'             => __('No options found.', 'buddyboss'),
            'not_found_in_trash'    => __('No options found in Trash.', 'buddyboss'),
            'featured_image'        => _x('App Menu Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'buddyboss'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'buddyboss'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'buddyboss'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'buddyboss'),
            'archives'              => _x('App Menu archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'buddyboss'),
            'insert_into_item'      => _x('Insert into option', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'buddyboss'),
            'uploaded_to_this_item' => _x('Uploaded to this option', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'buddyboss'),
            'filter_items_list'     => _x('Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'buddyboss'),
            'items_list_navigation' => _x('Option list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'buddyboss'),
            'items_list'            => _x('Option list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'buddyboss'),
        );

        $args = array(
            'labels'             => $labels,
            'description'        => 'App Menu custom post type.',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'mpp_app_menu'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 20,
            'supports'           => array('title', 'author', 'thumbnail'),
            'show_in_rest'       => false,
            'menu_icon'          => 'dashicons-smartphone'
        );

        register_post_type('mpp_app_menu', $args);
    }

    // Disable Gutenberg
    public function prefix_disable_gutenberg($current_status, $post_type)
    {
        // Use your post type key instead of 'product'
        if ($post_type === 'mpp_app_menu') return false;
        return $current_status;
    }

    // Custom Metabox
    public function diwp_metabox_mutiple_fields()
    {

        add_meta_box(
            'diwp-metabox-multiple-fields',
            'Metabox With Multiple Fields',
            [$this, 'diwp_add_multiple_fields'],
            'mpp_app_menu'
        );
    }

    // HTML
    public function diwp_add_multiple_fields()
    {

        global $post;

        // Get Value of Fields From Database
        $option_title = get_post_meta($post->ID, 'option_title', true) ?  get_post_meta($post->ID, 'option_title', true) : "";
        $option_subtitle = get_post_meta($post->ID, 'option_subtitle', true) ?  get_post_meta($post->ID, 'option_subtitle', true) : "";
        $option_description = get_post_meta($post->ID, 'option_description', true) ?  get_post_meta($post->ID, 'option_description', true) : "";
        $option_short_description = get_post_meta($post->ID, 'option_short_description', true) ?  get_post_meta($post->ID, 'option_short_description', true) : "";
        $option_category = get_post_meta($post->ID, 'option_category', true) ?  get_post_meta($post->ID, 'option_category', true) : "";
        $option_link_one = get_post_meta($post->ID, 'option_link_one', true) ?  get_post_meta($post->ID, 'option_link_one', true) : "";
        $option_link_two = get_post_meta($post->ID, 'option_link_two', true) ?  get_post_meta($post->ID, 'option_link_two', true) : "";
        $option_enabled = get_post_meta($post->ID, 'option_enabled', true) ?  get_post_meta($post->ID, 'option_enabled', true) : "";

?>

        <div class="row">
            <div class="label"><strong>Title</strong></div>
            <div class="fields"><input type="text" name="option_title" class="widefat" value="<?php echo $option_title; ?>"> </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Subtitle</strong></div>
            <div class="fields"><input type="text" name="option_subtitle" class="widefat" value="<?php echo $option_subtitle; ?>"> </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Description</strong></div>
            <div class="fields">
                <textarea rows="5" name="option_description"><?php echo $option_description; ?></textarea>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Short Descriptions</strong></div>
            <div class="fields">
                <textarea rows="5" name="option_short_description"><?php echo $option_short_description; ?></textarea>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Category</strong></div>
            <div class="fields"><input type="text" name="option_category" value="<?php echo $option_category; ?>"> </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Link One</strong></div>
            <div class="fields"><input type="text" name="option_link_one" class="widefat" value="<?php echo $option_link_one; ?>"> </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Link Two</strong></div>
            <div class="fields"><input type="text" name="option_link_two" class="widefat" value="<?php echo $option_link_two; ?>"> </div>
        </div>

        <br />

        <div class="row">
            <div class="label"><strong>Enabled</strong></div>
            <div class="fields">
                <select name="option_enabled">
                    <option value="1" <?php if ($option_enabled == '1') echo 'selected'; ?>>Yes</option>
                    <option value="2" <?php if ($option_enabled == '2') echo 'selected'; ?>>No</option>
                </select>
            </div>
        </div>



<?php
    }

    // Save Meta Values
    public function diwp_save_multiple_fields_metabox()
    {

        global $post;


        if (isset($_POST["option_title"])) :
            update_post_meta($post->ID, 'option_title', $_POST["option_title"]);
        endif;

        if (isset($_POST["option_subtitle"])) :
            update_post_meta($post->ID, 'option_subtitle', $_POST["option_subtitle"]);
        endif;

        if (isset($_POST["option_description"])) :
            update_post_meta($post->ID, 'option_description', $_POST["option_description"]);
        endif;

        if (isset($_POST["option_short_description"])) :
            update_post_meta($post->ID, 'option_short_description', $_POST["option_short_description"]);
        endif;

        if (isset($_POST["option_category"])) :
            update_post_meta($post->ID, 'option_category', $_POST["option_category"]);
        endif;

        if (isset($_POST["option_link_one"])) :
            update_post_meta($post->ID, 'option_link_one', $_POST["option_link_one"]);
        endif;

        if (isset($_POST["option_link_two"])) :
            update_post_meta($post->ID, 'option_link_two', $_POST["option_link_two"]);
        endif;

        if (isset($_POST["option_enabled"])) :
            update_post_meta($post->ID, 'option_enabled', $_POST["option_enabled"]);
        endif;
    }
}

new MPP_App_Support_Post_Type;
