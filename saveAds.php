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
		//load class and create new WP_File_Uploader, specify image cache
		require_once 'WP_File_Uploader.php';
		$myFileUploader = new WP_File_Uploader('imageCache');

		//validate integrity of uploaded file
		$validation = $myFileUploader->validate_file('fileToUpload', null);

		//check file's validation status and act accordingly
		switch ($validation['status']) {
			case 'success':
				//upload clean file
				$imageUploadStatus = $myFileUploader->upload_validated_file();
				$ad_info['creative'] = $imageUploadStatus['file_url'];
				$returnStatus['info'] = $imageUploadStatus['info'];
				break;
			case 'warning':
				//record warning information
				$returnStatus['status'] = $validation['status'];
				$returnStatus['info'] = $validation['info'];
				break;
			default:
				$returnStatus['info'] = "Image updated.";
				break;
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