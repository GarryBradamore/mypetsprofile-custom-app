<?php

namespace BuddyBossApp\Custom;

use BuddyBossApp\Admin\GutenbergBlockAbstract;

/**
 * Class FrontpageMenuCustom
 * @package BuddyBossApp\Menus
 */
class FrontpageMenuCustom extends GutenbergBlockAbstract
{
    private static $instance;

    /**
     * Get the instance of the class.
     *
     * @return FrontpageMenuCustom
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
        $this->set_namespace('bbapp/frontpagemenu');
        $this->set_title("Frontpage Menu - App");
        $this->set_description("Custom Menu on frontpage");
        $this->set_icon('menu');
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
                'name'      => 'option_1_color',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-1 Color',
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
                'name'      => 'option_2_color',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-2 Color',
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
                'name'      => 'option_3_color',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Option-3 Color',
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
        );
    }

    function get_preview()
    {
        return "<div>
                <h3 class='bbapp-block-title'>" . esc_html__('Frontpage Menu', '') . "</h3>
                <ul>
                    <li id='li_one'> <div className='appboss_div'>" . esc_html__('Option 1', '') . "</div></li>
                    <li id='li_two'> <div className='appboss_div' >" . esc_html__('Option 2', '') . "</div></li>
                    <li id='li_three'> <div className='appboss_div' >" . esc_html__('Option 3', '') . "</div></li>
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
        $option_1_color = isset($block_data['attrs']['option_1_color']) && !empty($block_data['attrs']['option_1_color']) ? $block_data['attrs']['option_1_color'] : '';
        $option_1_url = isset($block_data['attrs']['option_1_url']) && !empty($block_data['attrs']['option_1_url']) ? $block_data['attrs']['option_1_url'] : '';
        $option_1_image = isset($block_data['attrs']['option_1_image']) && !empty($block_data['attrs']['option_1_image']) ? $block_data['attrs']['option_1_image'] : '';

        $options[] = array(
            'text'  => $option_1_text,
            'color'  => $option_1_color,
            'url'   => $option_1_url,
            'image' => $option_1_image
        );

        // Option Two
        $option_2_text = isset($block_data['attrs']['option_2_text']) && !empty($block_data['attrs']['option_2_text']) ? $block_data['attrs']['option_2_text'] : '';
        $option_2_color = isset($block_data['attrs']['option_2_color']) && !empty($block_data['attrs']['option_2_color']) ? $block_data['attrs']['option_2_color'] : '';
        $option_2_url = isset($block_data['attrs']['option_2_url']) && !empty($block_data['attrs']['option_2_url']) ? $block_data['attrs']['option_2_url'] : '';
        $option_2_image = isset($block_data['attrs']['option_2_image']) && !empty($block_data['attrs']['option_2_image']) ? $block_data['attrs']['option_2_image'] : '';

        $options[] = array(
            'text'  => $option_2_text,
            'color'  => $option_2_color,
            'url'   => $option_2_url,
            'image' => $option_2_image
        );

        // Option One
        $option_3_text = isset($block_data['attrs']['option_3_text']) && !empty($block_data['attrs']['option_3_text']) ? $block_data['attrs']['option_3_text'] : '';
        $option_3_color = isset($block_data['attrs']['option_3_color']) && !empty($block_data['attrs']['option_3_color']) ? $block_data['attrs']['option_3_color'] : '';
        $option_3_url = isset($block_data['attrs']['option_3_url']) && !empty($block_data['attrs']['option_3_url']) ? $block_data['attrs']['option_3_url'] : '';
        $option_3_image = isset($block_data['attrs']['option_3_image']) && !empty($block_data['attrs']['option_3_image']) ? $block_data['attrs']['option_3_image'] : '';

        $options[] = array(
            'text'  => $option_3_text,
            'color'  => $option_3_color,
            'url'   => $option_3_url,
            'image' => $option_3_image
        );

        $app_page_data['data']['menu_options'] = $options;

        return $app_page_data;
    }
}
