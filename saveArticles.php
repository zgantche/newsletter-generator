<?php
	require_once 'VarDirectory.php';		//load VarDirectory class
	require_once '../wp-load.php';			// Import WordPress functions for us to use
	#require_once 'WP_File_Uploader.php'	//included below ONLY if uploaded file exists

	//array for the return status
	$returnStatus = array (
		'status'	=> "success",
		'info'		=> ""
	);

	//array for all Article Info input, passed by form
	$article_info = array (
		'article-0-title'		=> $_POST['article-0-title'],
		'article-0-url'			=> $_POST['article-0-url'],
		'article-0-copy'		=> $_POST['article-0-copy'],
		'article-1-title'		=> $_POST['article-1-title'],
		'article-1-url'			=> $_POST['article-1-url'],
		'article-1-url-old'		=> $_POST['article-1-url-old'],
		'article-1-thumbnail'	=> $_POST['article-1-thumbnail'],
		'article-2-title'		=> $_POST['article-2-title'],
		'article-2-url'			=> $_POST['article-2-url'],
		'article-2-url-old'		=> $_POST['article-2-url-old'],
		'article-2-thumbnail'	=> $_POST['article-2-thumbnail'],
		'article-3-title'		=> $_POST['article-3-title'],
		'article-3-url'			=> $_POST['article-3-url'],
		'article-3-url-old'		=> $_POST['article-3-url-old'],
		'article-3-thumbnail'	=> $_POST['article-3-thumbnail'],
		'article-4-title'		=> $_POST['article-4-title'],
		'article-4-url'			=> $_POST['article-4-url'],
		'article-4-url-old'		=> $_POST['article-4-url-old'],
		'article-4-thumbnail'	=> $_POST['article-4-thumbnail'],
		'article-5-title'		=> $_POST['article-5-title'],
		'article-5-url'			=> $_POST['article-5-url'],
		'article-5-url-old'		=> $_POST['article-5-url-old'],
		'article-5-thumbnail'	=> $_POST['article-5-thumbnail'],
	);
	
	//if URL field is changed, fetch thumbnail via WordPress
	#TO DO: Convert article-0 to article-0
	for ($i = 1; $i <= 5; $i++) {
		if ($_POST['article-' . $i . '-url'] !== $_POST['article-' . $i . '-url-old'])
			$article_info['article-' . $i . '-thumbnail'] = 
				wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-' . $i . '-url'] )), [300,200] )[0];
	}

	//check if the user has uploaded an image file, handle upload if they have
	if ($_POST['article-x-thumbnail'] !== ""){
		//$article_info['article-1-thumbnail'] = "value: " . $_POST['article-x-thumbnail'];

		//load and instantiate new WP_File_Uploader, specify image cache
		require_once 'WP_File_Uploader.php';
		$myFileUploader = new WP_File_Uploader('imageCache');

		//retrieve report of image upload
		$report = $myFileUploader->upload_file($_POST['article-x-thumbnail']);

		//save report info to pass back as JSON object
		$returnStatus['status'] = $report['status'];
		$returnStatus['info'] = $report['info'] . " ";
		$article_info[ $_POST['article-x-thumbnail'] ] = $report['file_url'];
	}

	//clean up input (call $value by reference)
	foreach ($article_info as $key =>&$value) {
		//replace all special colons with regular ones
		$value = str_replace(array("‘", "’"), "'", $value);
		$value = str_replace(array('“', '”'), '"', $value);
		//replace other special characters with regular ones
		$value = str_replace("–", "-", $value);
		$value = str_replace("…", "...", $value);

		//trim spaces at beginning & end of string, then convert special char's to HTML entities
		$value = htmlspecialchars( trim($value) );

		//remove all backslashes from articles' Title & Copy text
		switch ($key) {
			case 'article-0-title':
			case 'article-0-copy':
			case 'article-1-title':
			case 'article-2-title':
			case 'article-3-title':
			case 'article-4-title':
			case 'article-5-title':
				$value = removeSlashes($value);
				break;
		}
	}

	//create new varDirectory
	$varDir = new VarDirectory();

	//save $article_info to varDirectory
	switch ($_POST['city']) {
		case 'Toronto':
			$varDir->setVar($article_info, 'torontoArticles');
			$returnStatus['info'] .= "Articles updated.";
			break;
		case 'Montreal':
			$varDir->setVar($article_info, 'montrealArticles');
			$returnStatus['info'] .= "Articles updated.";
			break;
		case 'Vancouver':
			$varDir->setVar($article_info, 'vancouverArticles');
			$returnStatus['info'] .= "Articles updated.";
			break;
		case 'Calgary':
			$varDir->setVar($article_info, 'calgaryArticles');
			$returnStatus['info'] .= "Articles updated.";
			break;
		case 'Nationwide':
			$varDir->setVar($article_info, 'nationwideArticles');
			$returnStatus['info'] .= "Articles updated.";
			break;	
		default:
			$returnStatus['status'] = "warning.";
			$returnStatus['info'] .= "Articles <b>not</b> updated; no match found for city.";
			break;
	}

	//tell the client to expect a JSON response
	header('Content-type: application/json');

	//create and return our JSON object
	$data = array(
		'status' 			=> $returnStatus['status'],
		'info'				=> $returnStatus['info'],
		'type'				=> 'articles',
		'city'				=> $_POST['city'],
		'article-0-img'	=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-0-url'] )), array(300,200) )[0],
		'article-1-img' 	=> $article_info['article-1-thumbnail'],
		'article-2-img'		=> $article_info['article-2-thumbnail'],
		'article-3-img'		=> $article_info['article-3-thumbnail'],
		'article-4-img'		=> $article_info['article-4-thumbnail'],
		'article-5-img'		=> $article_info['article-5-thumbnail']
	);
	echo json_encode( $data );

	//helper function to remove all backslashes from string
	function removeSlashes($string) {
		$string = implode( "", explode("\\",$string) );
		return stripslashes( trim($string) );
	}
?>