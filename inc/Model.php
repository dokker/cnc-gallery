<?php
namespace cncGLY;

class Model {
	public function __construct() {
	}

	public function getAlbumData($id)
	{
		$images = get_field('gallery_album', $id);
		$album = [
			'id' => $id,
			'images' => $images,
		];
		return $album;
	}
}