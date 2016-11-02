<?php
namespace cncGLY;

class Model {
	public function __construct() {
	}

	public function getAlbumData($id, $json_data = false)
	{
		$images = get_field('gallery_album', $id);
		if ($json_data) {
			$images = $this->transformImagesData($images);
		}
		$album = [
			'id' => $id,
			'images' => $images,
		];
		return $album;
	}

	/**
	 * Convert to JSON the ACF gallery field images data
	 * @param  array $images_data Gallery field data
	 * @return string              JSON Simplified data
	 */
	private function transformImagesData($images_data)
	{
		$images_tdata = [];
		foreach ($images_data as $image_raw) {
			$image = [
				'href' => $image_raw['sizes']['large'],
				'title' => $image_raw['caption'],
			];
			$images_tdata[] = $image;
		}
		$transformed = htmlspecialchars(json_encode($images_tdata), ENT_QUOTES, 'UTF-8');
		return $transformed;
	}
}