<?php
/**
 * Plugin Name: Widget to Shortcode
 * Plugin URI: http://www.christianbautista.info/widget-to-shortcode
 * Description: This plugin will let you use any of your active widgets as a shortcode.
 * Version: 1.0.1
 * Author: Christian A. Bautista
 * Author URI: http://www.christianbautista.info
 * License: Free
 */
 define('WTSPLUGINURL',plugin_dir_url(__FILE__));
 require( 'lib/wts_main.class.php' );

 //initiate Main Class
 $CF7AdvanceDB = new WTSMAIN();