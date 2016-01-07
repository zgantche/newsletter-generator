<?php
	require_once 'VarDirectory.php';	//load VarDirectory class
	require_once '../wp-load.php';		// Import WordPress functions for us to use

	//array for the return status
	$returnStatus = array (
		'status'	=> "success",
		'info'		=> ""
	);

	//array for all Article Info input, passed by form
	$article_info = array (
		'main-article-title' => $_POST['main-article-title'],
		'main-article-url' => 	$_POST['main-article-url'],
		'main-article-copy' => 	$_POST['main-article-copy'],
		'article-1-title' => 	$_POST['article-1-title'],
		'article-1-url' => 		$_POST['article-1-url'],
		'article-2-title' => 	$_POST['article-2-title'],
		'article-2-url' => 		$_POST['article-2-url'],
		'article-3-title' => 	$_POST['article-3-title'],
		'article-3-url' => 		$_POST['article-3-url'],
		'article-4-title' => 	$_POST['article-4-title'],
		'article-4-url' => 		$_POST['article-4-url'],
		'article-5-title' => 	$_POST['article-5-title'],
		'article-5-url' => 		$_POST['article-5-url']
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

	//save $article_info to varDirectory
	switch ($_POST['city']) {
		case 'Toronto':
			$varDir->setVar($article_info, 'torontoArticles');
			$returnStatus['info'] = 'Articles updated.';
			break;
		case 'Montreal':
			$varDir->setVar($article_info, 'montrealArticles');
			$returnStatus['info'] = 'Articles updated.';
			break;
		case 'Vancouver':
			$varDir->setVar($article_info, 'vancouverArticles');
			$returnStatus['info'] = 'Articles updated.';
			break;
		case 'Calgary':
			$varDir->setVar($article_info, 'calgaryArticles');
			$returnStatus['info'] = 'Articles updated.';
			break;
		case 'Nationwide':
			$varDir->setVar($article_info, 'nationwideArticles');
			$returnStatus['info'] = 'Articles updated.';
			break;	
		default:
			$returnStatus['status'] = 'warning.';
			$returnStatus['info'] = 'Articles <b>not</b> updated; no match found for city.';
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
		'main-article-img'	=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['main-article-url'] )), array(300,200) )[0],
		'article-1-img' 	=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-1-url'] )), array(300,200) )[0],
		'article-2-img'		=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-2-url'] )), array(300,200) )[0],
		'article-3-img'		=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-3-url'] )), array(300,200) )[0],
		'article-4-img'		=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-4-url'] )), array(300,200) )[0],
		'article-5-img'		=> wp_get_attachment_image_src( get_post_thumbnail_id(url_to_postid( $_POST['article-5-url'] )), array(300,200) )[0]
	);
	echo json_encode( $data );

?>