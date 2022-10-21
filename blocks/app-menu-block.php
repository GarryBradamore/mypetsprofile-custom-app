<?php

namespace BuddyBossApp\Custom;

use BuddyBossApp\Admin\GutenbergBlockAbstract;

/**
 * Class ListingCategory
 * @package BuddyBossApp\Menus
 */
class AppMenuBlock extends GutenbergBlockAbstract
{
    private static $instance;

    /**
     * Get the instance of the class.
     *
     * @return AppMenuBlock
     */
    public static function instance()
    {
        if (!isset(self::$instance)) {
            $class          = __CLASS__;
            self::$instance = new $class;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->set_namespace('bbapp/appmenublock');
        $this->set_title("App Menu Block - App");
        $this->set_description("MPP App Menu Block");
        $this->set_icon('editor-table');
        $this->set_keywords(array('directorist'));

        $attributes = $this->get_attributes();
        $this->set_attributes($attributes);

        $preview = $this->get_preview();
        $this->set_preview($preview);

        $this->init();
    }

    public function init()
    {
        parent::init();
        add_filter('bbapp_custom_block_data', array($this, 'update_block_data'), 10, 2);
    }

    function get_attributes()
    {
        return array(
            array(
                'name'      => 'title',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Enter Title',
            ),
            array(
                'name'      => 'category_name',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Enter category',
            ),
            array(
                'name'      => 'selected_options',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Selected Options',
            ),
            array(
                'name'      => 'see_more_link',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'See More Link',
            )
        );
    }

    function get_preview()
    {
        return "<div>
                <h3 class='bbapp-block-title'>" . esc_html__('Menu Options', '') . "</h3>
                <ul>
                    <li id='li_one'> <div className='appboss_div'>" . esc_html__('Option Name', '') . "</div></li>
                    <li id='li_two'> <div className='appboss_div' >" . esc_html__('Option Name', '') . "</div></li>
                    <li id='li_three'> <div className='appboss_div' >" . esc_html__('Option Name', '') . "</div></li>
                </ul>
            </div>";
    }

    function get_results($attrs)
    {
        return array();
    }

    function update_block_data($app_page_data, $block_data)
    {
        $selected_options = '';

        // Selected Cats.
        if (isset($block_data['attrs']['selected_options']) && !empty($block_data['attrs']['selected_options'])) {
            $selected_options = $block_data['attrs']['selected_options'];
        }

        $data_source = array(
            'type'           => 'fetch',
            'request_params' => array(
                'selected_options' => $selected_options,
            ),
        );

        $app_page_data['data']['data_source'] = $data_source;
        $app_page_data['data']['selected_options'] = $this->get_menu_options($selected_options);

        return $app_page_data;
    }

    /**
     * GET CATEGORY BY QUERY
     */
    public function get_menu_options($selected_options = '')
    {
        $data = [];

        if (empty($selected_cats)) return $data;

        $options = new WP_Query(
            array(
                'post_type' => 'mpp_app_menu',
                'posts_per_page' => -1,
                'post__in' => $selected_options,
                'orderby' => 'include',
                'order' => 'ASC',
                'meta_key' => 'option_enabled',
                'meta_value' => '1',
            )
        );

        if ($options->have_posts()) {
            while ($options->have_posts()) {
                $options->the_post();
                $option_id = get_the_ID();

                //fields
                $title = get_the_title();
                $option_title = get_post_meta($option_id, 'option_title', true) ?  get_post_meta($option_id, 'option_title', true) : "";
                $option_subtitle = get_post_meta($option_id, 'option_subtitle', true) ?  get_post_meta($option_id, 'option_subtitle', true) : "";
                $option_description = get_post_meta($option_id, 'option_description', true) ?  get_post_meta($option_id, 'option_description', true) : "";
                $option_short_description = get_post_meta($option_id, 'option_short_description', true) ?  get_post_meta($option_id, 'option_short_description', true) : "";
                $option_category = get_post_meta($option_id, 'option_category', true) ?  get_post_meta($option_id, 'option_category', true) : "";
                $option_link_one = get_post_meta($option_id, 'option_link_one', true) ?  get_post_meta($option_id, 'option_link_one', true) : "";
                $option_link_two = get_post_meta($option_id, 'option_link_two', true) ?  get_post_meta($option_id, 'option_link_two', true) : "";

                //Image
                $image = get_the_post_thumbnail_url($option_id, 'full');

                //prepare data
                $data[] = array(
                    'id' => $option_id,
                    'title' => $title,
                    'option_title' => $option_title,
                    'option_subtitle' => $option_subtitle,
                    'option_description' => $option_description,
                    'option_short_description' => $option_short_description,
                    'option_category' => $option_category,
                    'option_link_one' => $option_link_one,
                    'option_link_two' => $option_link_two,
                    'image' => $image,
                );
            }
        }

        return $data;
    }
}
