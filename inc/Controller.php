<?php
namespace cncGLY;

class Controller {
	public function __construct() {
		$this->plugin_url = plugin_dir_path(dirname(__FILE__));

		// Register ACF fields
		$this->acf = new ACF();
		$this->view = new View();
		$this->model = new Model();
		add_action('wp_enqueue_scripts', [$this, 'registerScripts']);
		add_shortcode('cnc_gallery_album', [$this, 'shortcodeGalleryAlbum']);
		add_filter( 'manage_album_posts_columns', [$this, 'wpcolumn_add_column'], 5 );
		add_action( 'manage_album_posts_custom_column', [$this, 'wpcolumn_column_content'], 5, 2 );
	}

	public function registerScripts()
	{
		wp_register_script('cnc-gallery-main-js', $this->plugin_url . DIRECTORY_SEPARATOR . 'assets/js/main.js', array('jquery'));
	}

	/**
	 * Handle Gallery album shortcode generation
	 * @param  array $atts Shortcode attributes
	 * @return string       Shortcode HTML markup
	 */
	public function shortcodeGalleryAlbum($atts)
	{
		$a = shortcode_atts( array(
			'id' => 0,
			), $atts );
		$album = 'album #$' . $a['id'];
		return $album;
	}

	/**
	 * Add new custom column before the last column
	 * @param  array $columns WP list column list
	 * @return array          Appended column list
	 */
	public function wpcolumn_add_column( $columns ) {
		$ccolumns = [];
		end($columns);
		$lastkey = key($columns);
		foreach ($columns as $key => $value) {
			if ($key == $lastkey) {
				$ccolumns['shortcode'] = 'Shortcode';
			}
			$ccolumns[$key] = $value;
		}
		return $ccolumns;
	}

	/**
	 * Generate customn column content
	 * @param  string $column Column name
	 * @param  int $id     Post ID
	 */
	public function wpcolumn_column_content( $column, $id ) {
	  if( 'shortcode' == $column ) {
	    echo '[cnc_gallery_album id=' . $id . ']';
	  }
	}
}
