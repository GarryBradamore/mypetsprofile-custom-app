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
        $options[1]['text'] = isset($block_data['attrs']['option_1_text']) && !empty($block_data['attrs']['option_1_text']) ? $block_data['attrs']['option_1_text'] : '';
        $options[1]['url'] = isset($block_data['attrs']['option_1_url']) && !empty($block_data['attrs']['option_1_url']) ? $block_data['attrs']['option_1_url'] : '';
        $options[1]['image'] = isset($block_data['attrs']['option_1_image']) && !empty($block_data['attrs']['option_1_image']) ? $block_data['attrs']['option_1_image'] : '';

        // Option Two
        $options[2]['text'] = isset($block_data['attrs']['option_2_text']) && !empty($block_data['attrs']['option_2_text']) ? $block_data['attrs']['option_2_text'] : '';
        $options[2]['url'] = isset($block_data['attrs']['option_2_url']) && !empty($block_data['attrs']['option_2_url']) ? $block_data['attrs']['option_2_url'] : '';
        $options[2]['image'] = isset($block_data['attrs']['option_2_image']) && !empty($block_data['attrs']['option_2_image']) ? $block_data['attrs']['option_2_image'] : '';

        // Option One
        $options[3]['text'] = isset($block_data['attrs']['option_3_text']) && !empty($block_data['attrs']['option_3_text']) ? $block_data['attrs']['option_3_text'] : '';
        $options[3]['url'] = isset($block_data['attrs']['option_3_url']) && !empty($block_data['attrs']['option_3_url']) ? $block_data['attrs']['option_3_url'] : '';
        $options[3]['image'] = isset($block_data['attrs']['option_3_image']) && !empty($block_data['attrs']['option_3_image']) ? $block_data['attrs']['option_3_image'] : '';

        $app_page_data['data']['menu_options'] = $options;

        return $app_page_data;
    }
}
