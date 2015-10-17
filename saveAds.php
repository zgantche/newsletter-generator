<?php
	require_once 'VarDirectory.php';

	//array for all Ads Info input, passed by form
	$ads_info = array (
		'LB-creative' =>	$_POST['LB-creative'],
		'LB-url' =>			$_POST['LB-url'],
		'BB1-creative' =>	$_POST['BB1-creative'],
		'BB1-url' =>		$_POST['BB1-url'],
		'BB2-creative' =>	$_POST['BB2-creative'],
		'BB2-url' =>		$_POST['BB2-url']
	);

	//clean up input (call $value by reference)
	foreach ($article_info as &$value) {
		//replace all special colons with regular ones
		$value = str_replace(array("‘", "’"), "'", $value);
		$value = str_replace(array('“', '”'), '"', $value);
		//replace other special characters with regular ones
		$value = str_replace("–", "-", $value);
		$value = str_replace("…", "...", $value);

		//trim spaces at beginning & end of string, then convert special char's to HTML entities
		$value = htmlspecialchars( trim($value) );
	}

	//create new varDirectory
	$varDir = new VarDirectory();

	//save $ads_info to varDirectory
	switch ($_POST['city']) {
		case 'Toronto':
			$varDir->setVar($ads_info, 'torontoAds');
			break;
		case 'Montreal':
			$varDir->setVar($ads_info, 'montrealAds');
			break;
		case 'Vancouver':
			$varDir->setVar($ads_info, 'vancouverAds');
			break;
		case 'Calgary':
			$varDir->setVar($ads_info, 'calgaryAds');
			break;
		case 'Nationwide':
			$varDir->setVar($ads_info, 'nationwideAds');
			break;	
		default:
			# error code...
			break;
	}

?>