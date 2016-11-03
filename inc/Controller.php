<?php
namespace cncGLY;

class Controller {
	public function __construct() {
		$this->plugin_path = plugin_dir_path(dirname(__FILE__));
		$this->plugin_url = plugin_dir_url(dirname(__FILE__));

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
		wp_register_script('swipebox', $this->plugin_url . 'assets/swipebox/js/jquery.swipebox.min.js', array('jquery'));
		wp_register_style('swipebox', $this->plugin_url . 'assets/swipebox/css/swipebox.min.css', array());
		wp_register_script('cnc-gallery-main-js', $this->plugin_url . 'assets/js/main.js', array('jquery'));
		wp_register_style('cnc-gallery-main', $this->plugin_url . 'assets/css/main.css', array());
	}

	/**
	 * Handle Gallery album shortcode generation
	 * @param  array $atts Shortcode attributes
	 * @return string       Shortcode HTML markup
	 */
	public function shortcodeGalleryAlbum($atts)
	{
		wp_enqueue_script('swipebox');
		wp_enqueue_style('swipebox');
		wp_enqueue_script('cnc-gallery-main-js');
		wp_enqueue_style('cnc-gallery-main');

		$a = shortcode_atts( array(
			'id' => 0,
			), $atts );
		$id = $a['id'];

		$this->view->assign('album', $this->model->getAlbumData($id, true));
		$album = $this->view->render('cnc-album-shortcode');

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
