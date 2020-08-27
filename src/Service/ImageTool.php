<?php

namespace App\Service;


// Link image type to correct image loader and saver
// - makes it easier to add additional types later on
// - makes the function easier to read
use App\Repository\ImageRepository;
use Psr\Log\LoggerInterface;

const IMAGE_HANDLERS = [
	IMAGETYPE_JPEG => [
		'load' => 'imagecreatefromjpeg',
		'save' => 'imagejpeg',
		'quality' => 100
	],
	IMAGETYPE_PNG => [
		'load' => 'imagecreatefrompng',
		'save' => 'imagepng',
		'quality' => 0
	],
	IMAGETYPE_GIF => [
		'load' => 'imagecreatefromgif',
		'save' => 'imagegif'
	]
];

class ImageTool
{
	private $logger;
	
	/**
	 * @required
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function check(ImageRepository $imageRepository)
	{
		foreach ($imageRepository->findAll() as $image) {
			$thf = $image->getThumbFile();
			//dump($thf);
			if (!is_file($thf)) {
				$this->createThumbnail($image->getOrigFile(), $thf, 160);
			}
		}
		
	}
	
	
	public function img($fn)
	{
		$this->createThumbnail($fn, $fn . '.thb.jpg', 160);
		$exif = exif_read_data($fn, 0, true);
		return json_encode($exif);
		return var_dump($exif);
//		foreach ($exif as $key => $section) {
//			foreach ($section as $name => $val) {
//				echo "$key.$name: $val<br />\n";
//			}
//		}
	}
	
	public function update_info($fn, $img)
	{
		$exif = exif_read_data($fn, 'EXIF');
		dump($exif);
		$origdt = new \DateTime($exif["DateTimeOriginal"]);
		$img->setOriginalTime($origdt);
	}
	
	public function scan_dir($dirname, $tmbname)
	{
		echo "create thump $dirname -> $tmbname";
		foreach (scandir($dirname) as $filename) {
			$fn = realpath($dirname.'/'.$filename);
			if (is_file($fn)) {
				$tfn = $tmbname.'/'.$filename;
				echo "create thump $fn -> $tfn";
				$this->createThumbnail($fn, $tfn, 200);
			}
		}
	}

	/**
	 * @param $src - a valid file location
	 * @param $dest - a valid file target
	 * @param $targetWidth - desired output width
	 * @param $targetHeight - desired output height or null
	 */
	function createThumbnail($src, $dest, $targetWidth, $targetHeight = null) {
		
		//echo "Creating thumb $dest from $src";
		$this->logger->info("Creating thumb $dest from $src");
		// 1. Load the image from the given $src
		// - see if the file actually exists
		// - check if it's of a valid image type
		// - load the image resource
		
		// get the type of the image
		// we need the type to determine the correct loader
		$type = exif_imagetype($src);
		
		// if no valid type or no handler found -> exit
		if (!$type || !IMAGE_HANDLERS[$type]) {
			return null;
		}
		
		// load the image with the correct loader
		$image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);
		
		// no image found at supplied location -> exit
		if (!$image) {
			return null;
		}
		
		
		// 2. Create a thumbnail and resize the loaded $image
		// - get the image dimensions
		// - define the output size appropriately
		// - create a thumbnail based on that size
		// - set alpha transparency for GIFs and PNGs
		// - draw the final thumbnail
		
		// get original image width and height
		$width = imagesx($image);
		$height = imagesy($image);
		
		// maintain aspect ratio when no height set
		if ($targetHeight == null) {
			
			// get width to height ratio
			$ratio = $width / $height;
			
			// if is portrait
			// use ratio to scale height to fit in square
			if ($width > $height) {
				$targetHeight = floor($targetWidth / $ratio);
			}
			// if is landscape
			// use ratio to scale width to fit in square
			else {
				$targetHeight = $targetWidth;
				$targetWidth = floor($targetWidth * $ratio);
			}
		}
		
		// create duplicate image based on calculated target size
		$thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
		
		// set transparency options for GIFs and PNGs
		if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {
			
			// make image transparent
			imagecolortransparent(
				$thumbnail,
				imagecolorallocate($thumbnail, 0, 0, 0)
			);
			
			// additional settings for PNGs
			if ($type == IMAGETYPE_PNG) {
				imagealphablending($thumbnail, false);
				imagesavealpha($thumbnail, true);
			}
		}
		
		// copy entire source image to duplicate image and resize
		imagecopyresampled(
			$thumbnail,
			$image,
			0, 0, 0, 0,
			$targetWidth, $targetHeight,
			$width, $height
		);
		
		
		// 3. Save the $thumbnail to disk
		// - call the correct save method
		// - set the correct quality level
		
		// save the duplicate version of the image to disk
		return call_user_func(
			IMAGE_HANDLERS[$type]['save'],
			$thumbnail,
			$dest,
			IMAGE_HANDLERS[$type]['quality']
		);
	}
	
}