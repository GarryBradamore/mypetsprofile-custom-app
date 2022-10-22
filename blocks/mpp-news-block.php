<?php

namespace BuddyBossApp\Custom;

use BuddyBossApp\Admin\GutenbergBlockAbstract;

/**
 * Class MppNewsBlock
 * @package BuddyBossApp\Menus
 */
class MppNewsBlock extends GutenbergBlockAbstract
{
    private static $instance;

    /**
     * Get the instance of the class.
     *
     * @return MppNewsBlock
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
        $this->set_namespace('bbapp/mppnewsblock');
        $this->set_title("Mpp News Block - App");
        $this->set_description("MPP News Block");
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
                'name'      => 'category',
                'fieldtype' => 'text',
                'default'   => '',
                'label'     => 'Enter category',
            )
        );
    }

    function get_preview()
    {
        return "<div>
                <h3 class='bbapp-block-title'>" . esc_html__('News Block', '') . "</h3>
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
        $category = '';

        // Selected Cats.
        if (isset($block_data['attrs']['category']) && !empty($block_data['attrs']['category'])) {
            $category = $block_data['attrs']['category'];
        }

        $data_source = array(
            'type'           => 'fetch',
            'request_params' => array(
                'category' => $category,
            ),
        );

        $app_page_data['data']['data_source'] = $data_source;

        return $app_page_data;
    }
}
