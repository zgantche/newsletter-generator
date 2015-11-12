<?php
	require_once 'VarDirectory.php';

	//create new varDirectory
	$varDir = new VarDirectory();

	//retrieve the toronto variables
	$toronto_articles = $varDir->getVar('torontoArticles');
	$toronto_ad_lb = $varDir->getVar('torontoAd-LB');
	$toronto_ad_bb1 = $varDir->getVar('torontoAd-BB1');
	$toronto_ad_bb2 = $varDir->getVar('torontoAd-BB2');

	//retrieve the montreal variables
	$montreal_articles = $varDir->getVar('montrealArticles');
	$montreal_ad_lb = $varDir->getVar('montrealAd-LB');
	$montreal_ad_bb1 = $varDir->getVar('montrealAd-BB1');
	$montreal_ad_bb2 = $varDir->getVar('montrealAd-BB2');

	//retrieve the vancouver variables
	$vancouver_articles = $varDir->getVar('vancouverArticles');
	$vancouver_ad_lb = $varDir->getVar('vancouverAd-LB');
	$vancouver_ad_bb1 = $varDir->getVar('vancouverAd-BB1');
	$vancouver_ad_bb2 = $varDir->getVar('vancouverAd-BB2');

	//retrieve the calgary variables
	$calgary_articles = $varDir->getVar('calgaryArticles');
	$calgary_ad_lb = $varDir->getVar('calgaryAd-LB');
	$calgary_ad_bb1 = $varDir->getVar('calgaryAd-BB1');
	$calgary_ad_bb2 = $varDir->getVar('calgaryAd-BB2');

	//retrieve the nationwide variables
	$nationwide_articles = $varDir->getVar('nationwideArticles');
	$nationwide_ad_lb = $varDir->getVar('nationwideAd-LB');
	$nationwide_ad_bb1 = $varDir->getVar('nationwideAd-BB1');
	$nationwide_ad_bb2 = $varDir->getVar('nationwideAd-BB2');
?>