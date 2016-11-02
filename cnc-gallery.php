<?php
/*
Plugin Name: CNC Gallery
Plugin URI: https://github.com/dokker/cnc-gallery
Description: Gallery plugin for Jupiter theme. in order to use install ACF Pro
Version: 1.0
Author: docker
Author URI: https://hu.linkedin.com/in/docker
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload
 */
$vendorAutoload = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
if (is_file($vendorAutoload)) {
	require_once($vendorAutoload);
}

function __cnc_gallery_load_plugin()
{
	// load translations
	load_plugin_textdomain( 'cnc-gallery', false, 'cnc-gallery/languages' );

	$catches = new cncGLY\ContentType('album',
		['menu_icon' => 'dashicons-camera', 'has_archive' => true, 'supports' => ['title']],
		['singular_name' => __('Album', 'cnc-gallery'), 'plural_name' => __('Albums', 'cnc-gallery')],
		_x('albums', 'albums archive slug', 'cnc-gallery'));

	// instantiate classes to register hooks
	$controller = new cncGLY\Controller();
}
add_action('plugins_loaded', '__cnc_gallery_load_plugin');
