<?php
	require_once 'VarDirectory.php';

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
			$varDi->setVar($article_info, 'torontoArticles');
			break;
		case 'Montreal':
			$varDir->setVar($article_info, 'montrealArticles');
			break;
		case 'Vancouver':
			$varDir->setVar($article_info, 'vancouverArticles');
			break;
		case 'Calgary':
			$varDir->setVar($article_info, 'calgaryArticles');
			break;
		case 'Nationwide':
			$varDir->setVar($article_info, 'nationwideArticles');
			break;	
		default:
			# error code...
			break;
	}

?>