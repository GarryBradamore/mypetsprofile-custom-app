<?php

namespace BuddyBossApp\Custom;

use BuddyBossApp\Admin\GutenbergBlockAbstract;

/**
 * Class MppImageMenu
 * @package BuddyBossApp\Menus
 */
class MppImageMenu extends GutenbergBlockAbstract
{
    private static $instance;

    /**
     * Get the instance of the class.
     *
     * @return MppImageMenu
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
        $this->set_namespace('bbapp/mppimagemenu');
        $this->set_title("Image Menu - App");
        $this->set_description("Image Menu on app");
        $this->set_icon('images-alt');
        $this->set_keywords(array('buddyboss', 'custom', 'menu'));

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
                'name'      => 'option_1_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-1 Text',
            ),
            array(
                'name'      => 'option_1_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-1 Url',
            ),
            array(
                'name'      => 'option_1_image',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-1 Image',
            ),
            array(
                'name'      => 'option_2_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-2 Text',
            ),
            array(
                'name'      => 'option_2_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-2 Url',
            ),
            array(
                'name'      => 'option_2_image',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-2 Image',
            ),
            array(
                'name'      => 'option_3_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-3 Text',
            ),
            array(
                'name'      => 'option_3_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-3 Url',
            ),
            array(
                'name'      => 'option_3_image',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-3 Image',
            ),

            array(
                'name'      => 'option_4_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-4 Text',
            ),
            array(
                'name'      => 'option_4_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-4 Url',
            ),
            array(
                'name'      => 'option_4_image',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-4 Image',
            ),

            array(
                'name'      => 'option_5_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-5 Text',
            ),
            array(
                'name'      => 'option_5_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-5 Url',
            ),
            array(
                'name'      => 'option_5_image',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-5 Image',
            ),
            array(
                'name'      => 'option_6_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-6 Text',
            ),
            array(
                'name'      => 'option_6_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-6 Url',
            ),
            array(
                'name'      => 'option_6_image',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-6 Image',
            ),
            array(
                'name'      => 'more_text',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'More Button Text',
            ),
            array(
                'name'      => 'more_url',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'More Button Url',
            ),
        );
    }

    function get_preview()
    {
        return "<div>
                <h3 class='bbapp-block-title'>" . esc_html__('Image Menu', '') . "</h3>
                <ul>
                    <li id='li_one'> <div className='appboss_div'>" . esc_html__('Option 1', '') . "</div></li>
                    <li id='li_two'> <div className='appboss_div'>" . esc_html__('Option 2', '') . "</div></li>
                    <li id='li_three'> <div className='appboss_div'>" . esc_html__('Option 3', '') . "</div></li>
                </ul>
            </div>";
    }

    function get_results($attrs)
    {
        return array();
    }

    function update_block_data($app_page_data, $block_data)
    {
        $options = [];

        // Option One
        $option_1_text = isset($block_data['attrs']['option_1_text']) && !empty($block_data['attrs']['option_1_text']) ? $block_data['attrs']['option_1_text'] : '';
        $option_1_url = isset($block_data['attrs']['option_1_url']) && !empty($block_data['attrs']['option_1_url']) ? $block_data['attrs']['option_1_url'] : '';
        $option_1_image = isset($block_data['attrs']['option_1_image']) && !empty($block_data['attrs']['option_1_image']) ? $block_data['attrs']['option_1_image'] : '';

        if (!empty($option_1_text)) {
            $options[] = array(
                'text'  => $option_1_text,
                'url'   => $option_1_url,
                'image' => $option_1_image
            );
        }

        // Option Two
        $option_2_text = isset($block_data['attrs']['option_2_text']) && !empty($block_data['attrs']['option_2_text']) ? $block_data['attrs']['option_2_text'] : '';
        $option_2_url = isset($block_data['attrs']['option_2_url']) && !empty($block_data['attrs']['option_2_url']) ? $block_data['attrs']['option_2_url'] : '';
        $option_2_image = isset($block_data['attrs']['option_2_image']) && !empty($block_data['attrs']['option_2_image']) ? $block_data['attrs']['option_2_image'] : '';

        if (!empty($option_2_text)) {
            $options[] = array(
                'text'  => $option_2_text,
                'url'   => $option_2_url,
                'image' => $option_2_image
            );
        }

        // Option Three
        $option_3_text = isset($block_data['attrs']['option_3_text']) && !empty($block_data['attrs']['option_3_text']) ? $block_data['attrs']['option_3_text'] : '';
        $option_3_url = isset($block_data['attrs']['option_3_url']) && !empty($block_data['attrs']['option_3_url']) ? $block_data['attrs']['option_3_url'] : '';
        $option_3_image = isset($block_data['attrs']['option_3_image']) && !empty($block_data['attrs']['option_3_image']) ? $block_data['attrs']['option_3_image'] : '';

        if (!empty($option_3_text)) {
            $options[] = array(
                'text'  => $option_3_text,
                'url'   => $option_3_url,
                'image' => $option_3_image
            );
        }

        // Option Four
        $option_4_text = isset($block_data['attrs']['option_4_text']) && !empty($block_data['attrs']['option_4_text']) ? $block_data['attrs']['option_4_text'] : '';
        $option_4_url = isset($block_data['attrs']['option_4_url']) && !empty($block_data['attrs']['option_4_url']) ? $block_data['attrs']['option_4_url'] : '';
        $option_4_image = isset($block_data['attrs']['option_4_image']) && !empty($block_data['attrs']['option_4_image']) ? $block_data['attrs']['option_4_image'] : '';

        if (!empty($option_4_text)) {
            $options[] = array(
                'text'  => $option_4_text,
                'url'   => $option_4_url,
                'image' => $option_4_image
            );
        }

        // Option Five
        $option_5_text = isset($block_data['attrs']['option_5_text']) && !empty($block_data['attrs']['option_5_text']) ? $block_data['attrs']['option_5_text'] : '';
        $option_5_url = isset($block_data['attrs']['option_5_url']) && !empty($block_data['attrs']['option_5_url']) ? $block_data['attrs']['option_5_url'] : '';
        $option_5_image = isset($block_data['attrs']['option_5_image']) && !empty($block_data['attrs']['option_5_image']) ? $block_data['attrs']['option_5_image'] : '';

        if (!empty($option_5_text)) {
            $options[] = array(
                'text'  => $option_5_text,
                'url'   => $option_5_url,
                'image' => $option_5_image
            );
        }

        // Option Six
        $option_6_text = isset($block_data['attrs']['option_6_text']) && !empty($block_data['attrs']['option_6_text']) ? $block_data['attrs']['option_6_text'] : '';
        $option_6_url = isset($block_data['attrs']['option_6_url']) && !empty($block_data['attrs']['option_6_url']) ? $block_data['attrs']['option_6_url'] : '';
        $option_6_image = isset($block_data['attrs']['option_6_image']) && !empty($block_data['attrs']['option_6_image']) ? $block_data['attrs']['option_6_image'] : '';

        if (!empty($option_6_text)) {
            $options[] = array(
                'text'  => $option_6_text,
                'url'   => $option_6_url,
                'image' => $option_6_image
            );
        }

        $app_page_data['data']['menu_options'] = $options;

        return $app_page_data;
    }
}
