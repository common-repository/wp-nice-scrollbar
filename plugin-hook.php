<?php

/*
 * Plugin Name: WordPress Nice Scrollbar
 * Plugin URI:http://rajuahmed.0fees.net
 * Description: This plugin can change the color, width,height of scrollbar  in the wordpress  website.
 * Author: Raju Ahmed
 * Author URI: http://rajuahmed.0fees.net
 * Version: 3.0
 */
/*
Copyright (C) 2014 Raju Ahmed

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANT ABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

 
 
 
require_once dirname( __FILE__ ) . '/setting.php';
require_once dirname( __FILE__ ) . '/output-setting.php';

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('WeDevs_Settings_API_Test' ) ):
class WeDevs_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'scrollbar options', 'scrollbar options', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wedevs_basics',
                'title' => __( 'Main Settings', 'wedevs' )
            ),
            array(
                'id' => 'wedevs_advanced',
                'title' => __( 'Advanced Settings', 'wedevs_second' )
            )
           
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wedevs_basics' => array(
                array(
                    'name' => 'cursorcolor',
                    'label' => __( 'Scrollbar Custom Color ', 'wedevs' ),
                    'desc' => __( 'You can change the scrollbar color from here.The default scrollbar #1E73BE', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#35B137'
                  
                ),
                array(
                    'name' => 'cursorwidth',
                    'label' => __( 'Scrollbar Width ', 'wedevs' ),
                    'desc' => __( 'You can change the scrollbar width from here.The default scrollbar width is 5px', 'wedevs' ),
                    'type' => 'text',
					'default' => '10px'
                ),
                array(
                    'name' => 'cursorborderradius ',
                    'label' => __( 'Scrollbar Border Radius ', 'wedevs' ),
                    'desc' => __( ' You can change the scrollbar border radius from here.The default border radius is 4px', 'wedevs' ),
                    'type' => 'text',
					'default' => '4px'
                ),
                array(
                    'name' => 'autohidemode',
                    'label' => __( 'Scrollbar Visibility Settings', 'wedevs' ),
                    'desc' => __( 'You can change the Scrollbar visualization from here. Default option is enable auto hide scrollbar ', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'true' => 'Enable Auto Hide Scrollbar',
                        'false' => 'Disable Auto Hide Scrollbar'
                    )
                )
		
				),
            'wedevs_advanced' => array(
                array(
                   
				    'name' => 'cursorborder ',
                    'label' => __( 'Scrollbar Border Style ', 'wedevs_second' ),
                    'desc' => __( 'You can change the scrollbar border style from here. The default  border style  is 1px solid #fff', 'wedevs_second' ),
                    'type' => 'text',
					'default' => '1px solid #fff'
                ),
				
				 array(
                   
				    'name' => 'scrollspeed  ',
                    'label' => __( 'Scrollbar Speed ', 'wedevs_second' ),
                    'desc' => __( 'You can change the scrollbar speed from here.The  default  scrollbar speed  value is 60', 'wedevs_second' ),
                    'type' => 'text',
					'default' => '60'
                ),
				
				   array(
                   
				  'name' => 'horizrailenabled',
                    'label' => __( 'Visibility Horizontal Scrollbar', 'wedevs_second' ),
                    'desc' => __( ' You can enable  the horizontal scrollbar from here. Default is enable', 'wedevs_second' ),
                    'type' => 'radio',
                    'options' => array(
                        'true' => 'Enable Auto Horizontal Scrollbar',
                        'false' => 'Disable Horizontal Scrollbar'
                    )
                ),
				
				   array(
                   
				  'name' => 'touchbehavior ',
                    'label' => __( 'Scrollbar Touch Behaviour', 'wedevs_second' ),
                    'desc' => __( ' You can change the scrollbar touch behaviour. The default is Disable Touch Behaviour Scrollbar', 'wedevs_second' ),
                    'type' => 'radio',
                    'options' => array(
                        'true' => 'Enable Touch Behaviour Scrollbar',
                        'false' => 'Disable Touch Behaviour Scrollbar'
                    )
                ),
				
				
				
				
				
		
              
              
           
               
             
            )
         
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
function my_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}



$settings = new WeDevs_Settings_API_Test();