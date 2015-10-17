<?php
	require_once 'VarDirectory.php';

	//create new varDirectory
	$varDir = new VarDirectory();

	//retrieve the toronto variables
	$toronto_articles = $varDir->getVar('torontoArticles');
	$toronto_ads = $varDir->getVar('torontoAds');

	//retrieve the montreal variables
	$montreal_articles = $varDir->getVar('montrealArticles');
	$montreal_ads = $varDir->getVar('montrealAds');

	//retrieve the vancouver variables
	$vancouver_articles = $varDir->getVar('vancouverArticles');
	$vancouver_ads = $varDir->getVar('vancouverAds');

	//retrieve the calgary variables
	$calgary_articles = $varDir->getVar('calgaryArticles');
	$calgary_ads = $varDir->getVar('calgaryAds');

	//retrieve the nationwide variables
	$nationwide_articles = $varDir->getVar('nationwideArticles');
	$nationwide_ads = $varDir->getVar('nationwideAds');

?>