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
define('QBSC__PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('QBSC__PLUGIN_SRC_DIR', plugin_dir_path( __FILE__ ) . 'src' . DIRECTORY_SEPARATOR);
//TODO add autoload and remove require
require_once (QBSC__PLUGIN_SRC_DIR.'Shortcodes.php');
require_once (QBSC__PLUGIN_SRC_DIR.'ShortcodesUltimate.php');
require_once (QBSC__PLUGIN_SRC_DIR.'Post.php');
require_once (QBSC__PLUGIN_SRC_DIR.'Text.php');

Qobo\Shortcodes\Shortcodes::add_shortcodes();
Qobo\Shortcodes\Shortcodes::add_shortcodes_ultimate();