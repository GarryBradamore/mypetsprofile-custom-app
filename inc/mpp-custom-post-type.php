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
            'supports'           => array('title', 'editor', 'author', 'thumbnail'),
            'taxonomies'         => array('category'),
            'show_in_rest'       => true
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
        $diwp_textfield = get_post_meta($post->ID, '_diwp_text_field', true);
        $diwp_radiofield = get_post_meta($post->ID, '_diwp_radio_field', true);
        $diwp_checkboxfield = get_post_meta($post->ID, '_diwp_checkbox_field', true) ? get_post_meta($post->ID, '_diwp_checkbox_field', true) : [];
        $diwp_selectfield = get_post_meta($post->ID, '_diwp_select_field', true);
        $diwp_textareafield = get_post_meta($post->ID, '_diwp_textarea_field', true);

?>

        <div class="row">
            <div class="label">Textfield</div>
            <div class="fields"><input type="text" name="_diwp_text_field" value="<?php echo $diwp_textfield; ?>"> </div>
        </div>

        <br />

        <div class="row">
            <div class="label">Radio Fields</div>
            <div class="fields">
                <label><input type="radio" name="_diwp_radio_field" value="R1" <?php if ($diwp_radiofield == 'R1') echo 'checked'; ?> /> Radio Option 1 </label>
                <label><input type="radio" name="_diwp_radio_field" value="R2" <?php if ($diwp_radiofield == 'R2') echo 'checked'; ?> /> Radio Option 2</label>
                <label><input type="radio" name="_diwp_radio_field" value="R3" <?php if ($diwp_radiofield == 'R3') echo 'checked'; ?> /> Radio Option 3</label>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="label">Checkbox Fields</div>
            <div class="fields">
                <label><input type="checkbox" name="_diwp_checkbox_field[]" value="C1" <?php if (in_array('C1', $diwp_checkboxfield)) echo 'checked'; ?> /> Checkbox Option 1</label>
                <label><input type="checkbox" name="_diwp_checkbox_field[]" value="C2" <?php if (in_array('C2', $diwp_checkboxfield)) echo 'checked'; ?> /> Checkbox Option 2</label>
                <label><input type="checkbox" name="_diwp_checkbox_field[]" value="C3" <?php if (in_array('C3', $diwp_checkboxfield)) echo 'checked'; ?> /> Checkbox Option 3</label>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="label">Select Dropdown</div>
            <div class="fields">
                <select name="_diwp_select_field">
                    <option value="">Select Option</option>
                    <option value="1" <?php if ($diwp_selectfield == '1') echo 'selected'; ?>>Option 1</option>
                    <option value="2" <?php if ($diwp_selectfield == '2') echo 'selected'; ?>>Option 2</option>
                    <option value="3" <?php if ($diwp_selectfield == '3') echo 'selected'; ?>>Option 3</option>
                </select>
            </div>
        </div>

        <br />

        <div class="row">
            <div class="label">Textarea</div>
            <div class="fields">
                <textarea rows="5" name="_diwp_textarea_field"><?php echo $diwp_textareafield; ?></textarea>
            </div>
        </div>

<?php
    }

    // Save Meta Values
    public function diwp_save_multiple_fields_metabox()
    {

        global $post;


        if (isset($_POST["_diwp_text_field"])) :
            update_post_meta($post->ID, '_diwp_text_field', $_POST["_diwp_text_field"]);
        endif;

        if (isset($_POST["_diwp_radio_field"])) :
            update_post_meta($post->ID, '_diwp_radio_field', $_POST["_diwp_radio_field"]);
        endif;

        if (isset($_POST["_diwp_checkbox_field"])) :
            update_post_meta($post->ID, '_diwp_checkbox_field', $_POST["_diwp_checkbox_field"]);
        endif;

        if (isset($_POST["_diwp_select_field"])) :
            update_post_meta($post->ID, '_diwp_select_field', $_POST["_diwp_select_field"]);
        endif;

        if (isset($_POST["_diwp_textarea_field"])) :
            update_post_meta($post->ID, '_diwp_textarea_field', $_POST["_diwp_textarea_field"]);
        endif;
    }
}

new MPP_App_Support_Post_Type;
