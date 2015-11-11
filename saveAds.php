<?php

	//load VarDirectory class
	require_once 'VarDirectory.php';

	//array for all Ads Info input, passed by form
	$ad_info = array (
		'creative' =>	$_POST['creative'],
		'link-url' =>	$_POST['link-url']
	);

	//determine if we need to upload a file
	if( isset($_FILES['fileToUpload']) ) {

		// TODO: PERFORM UPLOAD FILE TYPE & SIZE CHECK!! 
		//&& ($_FILES['xxxx_image']['size'] > 0)) {

		//load WordPress the light-weight way
		define('WP_USE_THEMES', false);
		require('../wp-load.php');

		//load files required for image uploading
		require_once( "../wp-admin/includes/image.php" );
		require_once( "../wp-admin/includes/file.php" );
		require_once( "../wp-admin/includes/media.php" );

		//let WordPress handle the upload
		$attachment_id = media_handle_upload( 'fileToUpload', 0 );

		$ad_info['creative'] = wp_get_attachment_url( $attachment_id );
	}

	//clean up input (call $value by reference)
	/*foreach ($article_info as &$value) {					//  <-------------- FIX THIS!!!!!!! AIYAAAAAAA
		//replace all special colons with regular ones
		$value = str_replace(array("‘", "’"), "'", $value);
		$value = str_replace(array('“', '”'), '"', $value);
		//replace other special characters with regular ones
		$value = str_replace("–", "-", $value);
		$value = str_replace("…", "...", $value);

		//trim spaces at beginning & end of string, then convert special char's to HTML entities
		$value = htmlspecialchars( trim($value) );
	}*/

	//create new varDirectory
	$varDir = new VarDirectory();

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

?>