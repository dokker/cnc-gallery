<?php
namespace cncGLY;

class Controller {
	public function __construct() {
		$this->plugin_url = plugin_dir_path(dirname(__FILE__));

		// Register ACF fields
		$this->view = new View();
	}

	public function registerScripts()
	{
	}
}
