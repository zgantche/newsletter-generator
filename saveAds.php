<?php

	//load VarDirectory class
	require_once 'VarDirectory.php';

	//create new varDirectory
	$varDir = new VarDirectory();

	//array for the return status
	$returnStatus = array (
		'status'	=> "success",
		'info'		=> ""
	);

	//array for all Ads Info input, passed by form
	$ad_info = array (
		'creative' 	=>	$_POST['creative'],
		'link-url'	=>	$_POST['link-url']
	);

	//determine if we need to upload a file
	if( isset($_FILES['fileToUpload']) ) {

		//maximum file size is 2MB
		if ( $_FILES['fileToUpload']['size'] < 1000000 ) {

			//only allow image files to be uploaded
			$allowedFileTypes =  array('gif','png' ,'jpg', 'jpeg');
			$filename = $_FILES['fileToUpload']['name'];
			$extension = pathinfo($filename, PATHINFO_EXTENSION);

			if( in_array($extension, $allowedFileTypes) ) {

				//load image cache and check if it exists, if not, define it as an empty array
				$imageCache = $varDir->getVar('imageCache');
				if ( !isset($imageCache) )
					$imageCache = array();

				//define the file's name, and a flag for its uniqueness
				$fileToUpload_name = $_FILES['fileToUpload']['name'];
				$uniqueImage = true;


				//search our cache of uploaded images for this image name
				foreach ($imageCache as $currentCachedImage)
					if ($currentCachedImage['name'] === $fileToUpload_name){
						$uniqueImage = false;

						//retrieve the cached image's URL
						$ad_info['creative'] = $currentCachedImage['url'];
					}

				//if image was not found in the cache, upload it
				if ($uniqueImage) {
					//load WordPress the light-weight way
					define('WP_USE_THEMES', false);
					require('../wp-load.php');

					//load files required for image uploading
					require_once( "../wp-admin/includes/image.php" );
					require_once( "../wp-admin/includes/file.php" );
					require_once( "../wp-admin/includes/media.php" );

					//give image to WordPress for upload
					$attachment_id = media_handle_upload( 'fileToUpload', 0 );

					//retrieve the upload's URL
					$ad_info['creative'] = wp_get_attachment_url( $attachment_id );
					
					//define our new image
					$imageToCache = array(
						'name' 	=> $fileToUpload_name,
						'url'	=> $ad_info['creative']
					);

					//push new image info to our cache
					array_push($imageCache, $imageToCache);

					//update our image cache
					$varDir->setVar($imageCache, 'imageCache');
				}
			} else {
				//file not acceptable type
				$returnStatus['status'] = "warning";
				$returnStatus['info'] = "File is not an acceptable image format. \nAcceped image types are: PNG, JPG, JPEG, and GIF.";
			}
		} else {
			//file too big, max size is 2MB
			$returnStatus['status'] = "warning";
			$returnStatus['info'] = "Image file is too large, the maximum file size is 1MB. This is too heavy for an image. "
				. $_FILES['fileToUpload']['size'];
		}
	}

	//clean up input (call $value by reference)
	foreach ($ad_info as &$value) {
		//replace all special colons with regular ones
		$value = str_replace(array("‘", "’"), "'", $value);
		$value = str_replace(array('“', '”'), '"', $value);
		//replace other special characters with regular ones
		$value = str_replace("–", "-", $value);
		$value = str_replace("…", "...", $value);

		//trim spaces at beginning & end of string, then convert special char's to HTML entities
		$value = htmlspecialchars( trim($value) );
	}

	//save $ad_info to varDirectory
	switch ($_POST['city']) {
		case 'Toronto':
			$varDir->setVar($ad_info, 'torontoAd-' . $_POST['ad-type']);
			break;
		case 'Montreal':
			$varDir->setVar($ad_info, 'montrealAd-' . $_POST['ad-type']);
			break;
		case 'Vancouver':
			$varDir->setVar($ad_info, 'vancouverAd-' . $_POST['ad-type']);
			break;
		case 'Calgary':
			$varDir->setVar($ad_info, 'calgaryAd-' . $_POST['ad-type']);
			break;
		case 'Nationwide':
			$varDir->setVar($ad_info, 'nationwideAd-' . $_POST['ad-type']);
			break;	
		default:
			# error code...
			break;
	}
	
	//tell the client to expect a JSON response
	header('Content-type: application/json');

	//create and return our JSON object
	$response = array(
		'status' 	=> $returnStatus['status'],
		'info'		=> $returnStatus['info'],
		'type'		=> 'ads',
		'city'		=> $_POST['city'],
		'ad-type'	=> $_POST['ad-type'],
		'creative' 	=> $ad_info['creative'],
		'link-url'	=> $ad_info['link-url']
	);
	echo json_encode( $response );

?>