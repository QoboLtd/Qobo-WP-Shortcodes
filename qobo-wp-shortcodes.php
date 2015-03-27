<?php
/*
Plugin Name: Qobo Shortcodes
Plugin URI: http://www.qobo.biz
Description: Qobo Shortcodes
Author: Qobo ltd
Version: 1.0.0
Author URI: http://www.qobo.biz
*/

define('QBSC__TEXT_DOMAIN', 'qbsc');
define('QBSC__SU_CLASS', 'Shortcodes_Ultimate');
define('QBSC__GROUP_CUSTOM_KEY', 'custom');
define('QBSC__GROUP_CUSTOM', 'Custom');

define('QBSC__PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('QBSC__PLUGIN_SRC_DIR', plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
require_once (QBSC__PLUGIN_SRC_DIR.'qbsc_shortcodes.php');
require_once (QBSC__PLUGIN_SRC_DIR.'qbsc_shortcodes_ultimate.php');