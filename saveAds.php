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

		//maximum file size is 1MB
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
				$imageIsUnique = true;


				//search our cache of uploaded images for this image name
				foreach ($imageCache as $currentCachedImage)
					//when match is found, double check that exists on server
					if ( $currentCachedImage['name'] === $fileToUpload_name && 
							file_exists(absoluteImgPath( $currentCachedImage['url'] )) ){
						$imageIsUnique = false;

						//retrieve the cached image's URL
						$ad_info['creative'] = $currentCachedImage['url'];

						$returnStatus['info'] = 'Updated image, found on server.';
					}

				//if image was not found in the cache, upload it
				if ($imageIsUnique) {
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
					
					$returnStatus['info'] = 'Image uploaded and updated.';
				}
			} else {
				//file not acceptable type
				$returnStatus['status'] = "warning";
				$returnStatus['info'] = "Image <b>not</b> updated; invalid file type -- accepted extensions are: PNG, JPG, JPEG, and GIF.<br />";
			}
		} else {
			//file too big, max size is 2MB
			$returnStatus['status'] = "warning";
			$returnStatus['info'] = "Image <b>not</b> updated; file is too large -- the maximum file size is 1MB.<br />"
				. $_FILES['fileToUpload']['size'];
		}
	} else
		$returnStatus['info'] = "Image updated.";


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
			$returnStatus['info'] .= ' Link URL updated.';
			break;
		case 'Montreal':
			$varDir->setVar($ad_info, 'montrealAd-' . $_POST['ad-type']);
			$returnStatus['info'] .= ' Link URL updated.';
			break;
		case 'Vancouver':
			$varDir->setVar($ad_info, 'vancouverAd-' . $_POST['ad-type']);
			$returnStatus['info'] .= ' Link URL updated.';
			break;
		case 'Calgary':
			$varDir->setVar($ad_info, 'calgaryAd-' . $_POST['ad-type']);
			$returnStatus['info'] .= ' Link URL updated.';
			break;
		case 'Nationwide':
			$varDir->setVar($ad_info, 'nationwideAd-' . $_POST['ad-type']);
			$returnStatus['info'] .= ' Link URL updated.';
			break;	
		default:
			$returnStatus['info'] .= ' Link URL <b>not</b> updated; no match found for city.';
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


	//converts image URL to image's absolute path
	function absoluteImgPath($url){
		$rootPath = preg_replace('/newsletter-generator.*/', '', __FILE__);
		$absolutePath = preg_replace('/.*wp-content/', $rootPath . 'wp-content', $url);

		return $absolutePath;
	}
?>