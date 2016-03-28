<?php

	require_once 'VarDirectory.php'; //load the VarDirectory cache class
	#require_once 'WP_File_Uploader.php' //included below ONLY if uploaded file exists

	//create new VarDirectory
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
	
	//check if the user has uploaded an image file, handle upload if they have
	if( isset($_FILES['fileToUpload']) ){
		//load and instantiate new WP_File_Uploader, specify image cache
		require_once 'WP_File_Uploader.php';
		$myFileUploader = new WP_File_Uploader('imageCache');

		//retrieve report of image upload
		$report = $myFileUploader->upload_file('fileToUpload');

		//save report info to pass back as JSON object
		$returnStatus['status'] = $report['status'];
		$returnStatus['info'] = $report['info'];
		$ad_info['creative'] = $report['file_url'];
	}

	//clean up input (call $url by reference)
	foreach ($ad_info as &$url) {
		//replace all special colons with regular ones
		$url = str_replace(array("‘", "’"), "'", $url);
		$url = str_replace(array('“', '”'), '"', $url);
		//replace other special characters with regular ones
		$url = str_replace("–", "-", $url);
		$url = str_replace("…", "...", $url);

		//trim spaces at beginning & end of string, then convert special char's to HTML entities
		$url = htmlspecialchars( trim($url) );
		
		//add "http://" if URL doesn not start with either "http://" or "https://"
		if (!preg_match("~^https?://~", $url))
			$url = "http://" . $url;
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
?>