<?php
namespace cncGLY;

class Controller {
	public function __construct() {
		$this->plugin_url = plugin_dir_path(dirname(__FILE__));

		// Register ACF fields
		$this->acf = new ACF();
		$this->view = new View();
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
	}

	public function registerScripts()
	{
		wp_register_script('cnc-gallery-main-js', $this->plugin_url . DIRECTORY_SEPARATOR . 'assets/js/main.js', array('jquery'));
	}
}
