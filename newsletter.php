<?php
	require_once 'VarDirectory.php';	// Include VarDirectory Class
	

	//create new varDirectory
	$varDir = new VarDirectory();

	//retrieve correct varFile
	switch ($_GET['city']) {
		case 'Toronto':
			$articles = $varDir->getVar('torontoArticles');
			$ad_lb = $varDir->getVar('torontoAd-LB');
			$ad_bb1 = $varDir->getVar('torontoAd-BB1');
			$ad_bb2 = $varDir->getVar('torontoAd-BB2');
			break;
		case 'Montreal':
			$articles = $varDir->getVar('montrealArticles');
			$ad_lb = $varDir->getVar('montrealAd-LB');
			$ad_bb1 = $varDir->getVar('montrealAd-BB1');
			$ad_bb2 = $varDir->getVar('montrealAd-BB2');
			break;
		case 'Vancouver':
			$articles = $varDir->getVar('vancouverArticles');
			$ad_lb = $varDir->getVar('vancouverAd-LB');
			$ad_bb1 = $varDir->getVar('vancouverAd-BB1');
			$ad_bb2 = $varDir->getVar('vancouverAd-BB2');
			break;
		case 'Calgary':
			$articles = $varDir->getVar('calgaryArticles');
			$ad_lb = $varDir->getVar('calgaryAd-LB');
			$ad_bb1 = $varDir->getVar('calgaryAd-BB1');
			$ad_bb2 = $varDir->getVar('calgaryAd-BB2');
			break;
		case 'Nationwide':
			$articles = $varDir->getVar('nationwideArticles');
			$ad_lb = $varDir->getVar('nationwideAd-LB');
			$ad_bb1 = $varDir->getVar('nationwideAd-BB1');
			$ad_bb2 = $varDir->getVar('nationwideAd-BB2');
			break;	
		default:
			# error code...
			echo "No matching city! $_GET[city] = " . $_GET['city'];
			break;
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Notable</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=690, initial-scale=1">
		<style>
		body {
			-webkit-font-smoothing: subpixel-antialiased !important;
			-webkit-text-size-adjust:none !important;
		}
		
		@font-face { font-family: Oswald; src: "fonts/Oswald-Megular.ttf"; }
		
		.link:Link, .link:Active, .link:Visited {
			text-decoration: none;
			color:#777777;
		}
		.link:Hover {
			text-decoration: underline;
			color:#555555;
		}
		</style>
	</head>

	<body style="background-color: #f1f1f1; margin:0; padding:0">
	
	
		<!-- NOTABLE HEADER -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:20px; background-color:#ffffff; padding:30px 0px 20px 0px;">
			<tr>
				<td style="padding-bottom:0px;">
					<a href="http://www.notable.ca/" target="_blank"><img src="http://notable.ca/wp-content/uploads/2015/03/notable-logo.png" border="0" width="410" height="45" alt="notable" style="display: block; margin:0 auto;"/></a>
				</td>
			</tr>
		</table>
		
		
		<!-- LEADERBOARD AD -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#ffffff;">
			<tr>
				<td style="padding-bottom:0px;">
					<a href="<?php echo $ad_lb['link-url']; ?>" target="_blank"><img src="<?php echo $ad_lb['creative']; ?>" border="0" width="780" height="90" alt="leaderboard" style="display: block; margin:0 auto; padding-bottom: 10px;"/></a>
				</td>
			</tr>
		</table>


		<!-- NAVIGATION -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#262626; height:48px; margin-bottom: 0px;">
			<tr>
				
			<td style="padding-left:10px;">
				<span style="font-size:16px; color: #ffffff; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:15px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: center"><a href="http://notable.ca/category/people/" target="_blank" style="text-decoration:none"><font color="#ffffff">PEOPLE+</font></a></span>
			</td>
			<td >
				<span style="font-size:16px; color: #ffffff; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:15px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: center"><a href="http://notable.ca/category/life/" target="_blank" style="text-decoration:none"><font color="#ffffff">LIFE+</font></a></span>
			</td>
			<td >
				<span style="font-size:16px; color: #ffffff; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:15px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: center"><a href="http://notable.ca/category/business/" target="_blank" style="text-decoration:none"><font color="#ffffff">BUSINESS+</font></a></span>
			</td>
			<td style="padding-right:50px;">
				<span style="font-size:16px; color: #ffffff; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:15px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: center"><a href="http://notable.ca/category/culture/" target="_blank" style="text-decoration:none"><font color="#ffffff">CULTURE+</font></a></span>
			</td>
			<td width="40px" align="center">
				<a href="https://www.facebook.com/Notable.ca" target="_blank"><img src="http://notable.ca/wp-content/uploads/2015/03/social-facebook.png" alt="facebook" style="display: block;" border="0" height="20" width="20" /></a>
			</td>
			<td width="40px" align="center">
				<a href="https://twitter.com/notableca" target="_blank"><img src="http://notable.ca/wp-content/uploads/2015/03/social-twitter.png" alt="twitter" style="display: block;" border="0" height="20" width="20" /></a>
			</td>
			<td width="40px" align="center">
				<a href="https://www.linkedin.com/company/notable-ca" target="_blank"><img src="http://notable.ca/wp-content/uploads/2015/03/social-linkedin.png" alt="linkedin" style="display: block;" border="0" height="20" width="20" /></a>
			</td>
			<td width="40px" align="center" style="padding-right:10px;">
				<a href="https://instagram.com/notableca" target="_blank"><img src="http://notable.ca/wp-content/uploads/2015/03/social-insta.png" alt="instagram" style="display: block;" border="0" height="20" width="20" /></a>
			</td>
			</tr>
		</table>
		
		
		
		<!-- MAIN ARTICLE -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="margin-bottom:0px; background-color:#FFF; font-family:Helvetica, Arial, sans-serif;">
			<tr>
				<td align="center" style="font-size:13px; color: #7c7c7c; font-family:Helvetica, Arial, sans-serif; vertical-align:top;">
					<span style="font-size:24px; color: #202020; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:20px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: left"><b>
						
						<?php echo $articles['article-0-title']; ?>

					</b></span>

					<a href="<?php echo $articles['article-0-url']; ?>" target="_blank" style="text-decoration:none">
					<img src="<?php echo $articles['article-0-thumbnail']; ?>" alt="main story image" style="display: block;" border="0" width="450" height="300" />

						<p style="font-size:13px; color: #202020; line-height:1.3em; font-family:Helvetica, Arial, sans-serif; margin-bottom:20px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: left">
							<?php echo nl2br($articles['article-0-copy']); ?>
						</p>
					</a>
				</td>
				
				<!-- ADVERTISING -->
				<td style="font-size:12px; color: #7c7c7c; line-height:1.6em; font-family:Helvetica, Arial, sans-serif; vertical-align:top;">

					<a href="<?php echo $ad_bb1['link-url']; ?>" target="_blank"><img src="<?php echo $ad_bb1['creative']; ?>" alt="big box one" style="display: block; padding:10px 0px;" border="0" height="250" width="300" /></a>

					<a href="<?php echo $ad_bb2['link-url']; ?>" target="_blank"><img src="<?php echo $ad_bb2['creative']; ?>" alt="big box two" style="display: block; padding-bottom: 10px;" border="0" height="250" width="300" /></a>

				</td>
			</tr>
		</table>
		
		
		
		<!-- TOP SEPARATION BAR -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#262626; height:12px; margin-bottom: 0px;"></table>
		
		
		
		<!-- OTHER ARTICLES -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#ffffff; margin-bottom: 0px; padding: 10px 10px 30px 10px;">
			<tbody><tr>
			
					<td width="145px" style="padding-right:9px; font-size:11.5px; align:left; color:#666666; letter-spacing:0.5px; line-height:1.4em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">
			
						<a href="<?php echo $articles['article-1-url']; ?>" target="_blank" style="text-decoration:none">
						<img src="<?php echo $articles['article-1-thumbnail']; ?>" alt="Story 2 image" style="display: block; padding-bottom:7px;" border="0" height="100" width="143" />
						<font color="#000000">
							<?php echo $articles['article-1-title']; ?>
						</font></a>

					</td> 
						
					<td width="145px" style="padding-right:9px; font-size:11.5px; align:left; color:#666666; letter-spacing:0.5px; line-height:1.4em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">

						<a href="<?php echo $articles['article-2-url']; ?>" target="_blank" style="text-decoration:none">
						<img src="<?php echo $articles['article-2-thumbnail']; ?>" alt="Story 3 image" style="display: block; padding-bottom:7px;" border="0" height="100" width="143" />
						<font color="#000000">
							<?php echo $articles['article-2-title']; ?>
						</font></a>

					</td> 
				
					<td width="145px" style="padding-right:9px; font-size:11.5px; align:left; color:#666666; letter-spacing:0.5px; line-height:1.4em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">

						<a href="<?php echo $articles['article-3-url']; ?>" target="_blank" style="text-decoration:none">
						<img src="<?php echo $articles['article-3-thumbnail']; ?>" alt="Story 2 image" style="display: block; padding-bottom:7px;" border="0" height="100" width="143" />
						<font color="#000000">
							<?php echo $articles['article-3-title']; ?>
						</font></a>

					</td> 
				
					<td width="145px" style="padding-right:9px;	font-size:11.5px; align:left; color:#666666; lletter-spacing:0.5px; line-height:1.4em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">

						<a href="<?php echo $articles['article-4-url']; ?>" target="_blank" style="text-decoration:none">
						<img src="<?php echo $articles['article-4-thumbnail']; ?>" alt="Story 5 image" style="display: block; padding-bottom:7px;" border="0" height="100" width="143" />
						<font color="#000000">
							<?php echo $articles['article-4-title']; ?>
						</font></a>

					</td> 
				
					<td width="145px" style="font-size:11.5px; align:left; color:#666666; letter-spacing:0.5px; line-height:1.4em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">

						<a href="<?php echo $articles['article-5-url']; ?>" target="_blank" style="text-decoration:none">
						<img src="<?php echo $articles['article-5-thumbnail']; ?>" alt="Story 6 image" style="display: block; padding-bottom:7px;" border="0" height="100" width="143" />
						<font color="#000000">
							<?php echo $articles['article-5-title']; ?>
						</font></a>

					</td> 
				
			</tr></tbody>
		</table> 
				
				
				
		<!-- BOTTOM SEPARATION BAR -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#333333; height:12px; margin-bottom: 0px;"></table>
		
		<!-- MAIN FOOTER -->
		<table width="780" cellpadding="" cellspacing="0" border="0" align="center" style="background-color:#262626; height:220px; margin-bottom: 0px;">
		
			<!-- NOTABLE LOGO -->
			<tr>
				<td>
					<img src="http://notable.ca/wp-content/uploads/2015/03/notable-logo-white.png" alt="" align="left" style="display: block; padding-left:20px; padding-top:8px; padding-bottom:0px;" border="0" height="21" width="auto">
				</td>
			</tr>
			
			<!-- TEXT -->
			<tr>
				<td style="font-size:13px; align:left; padding-left:20px; padding-right:20px; padding-bottom:4px; color:#808080; line-height:1.38em; font-family: Helvetica, Arial, sans-serif;">
					Notable.ca is Canada's leading online lifestyle magazine for driven young professionals. We cover all aspects of millennial life including social, professional, and charitable engagements. We're young, connected, ambitious, and one hell of a lively bunch.
				</td>
			</tr>

			<td style="width:780px; display:inline;">

				<table width="200" cellpadding="0" cellspacing="0" border="0" align="left">
					<tr>
						<td style="padding-left:20px; padding-bottom:20px; padding-top:2px; height:auto; font-size:13px; align:left; color:#cccccc; line-height:1.5em; font-family:Helvetica, Arial, sans-serif;">
							<a href="http://notable.ca/advertise-with-notableca/" target="_blank" style="text-decoration:none"><font color="#ffffff">Advertise with Notable.ca</font></a><br>
							<a href="http://notable.ca/about-notable-ca/" target="_blank" style="text-decoration:none"><font color="#ffffff">About Notable.ca</font></a><br>
							<a href="http://notable.ca/contact-page/" target="_blank" style="text-decoration:none"><font color="#ffffff">Contact Notable</font></a>
						</td> 
					</tr>
				</table>
								
				<table width="130" cellpadding="0" cellspacing="0" border="0" align="left" >
					<tr>
						<td style="padding-left:15px; padding-bottom:20px; padding-top:2px; height:auto; font-size:13px; align:left; color:#cccccc; line-height:1.5em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">
							<a href="http://notable.ca/privacy-policy/" target="_blank" style="text-decoration:none"><font color="#ffffff">Privacy Policy</font></a><br>
							<a href="http://notable.ca/unsubscribe/" target="_blank" style="text-decoration:none"><font color="#ffffff">Unsubscribe</font></a>
						</td> 
					</tr>
				</table>
				
				<table width="200" cellpadding="0" cellspacing="0" border="0" align="left" >
					<tr>
						<td style="padding-left:15px; padding-bottom:20px; padding-top:2px; height:auto; font-size:13px; align:left; color:#cccccc; line-height:1.5em; font-family:Helvetica, Arial, sans-serif; vertical-align: text-top;">
							<a href="http://notable.ca/write-for-notableca/" target="_blank" style="text-decoration:none"><font color="#ffffff">Write for Notable.ca</font></a><br>
							<a href="http://notable.ca/jobs-at-notableca/" target="_blank" style="text-decoration:none"><font color="#ffffff">Jobs at Notable.ca</font></a>
						</td> 
					</tr>
				</table>

			</td>
		</table>
		
		
		
		<!-- COPYRIGHT -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color:#1c1d1e; height:60px; margin-bottom: 0px;">
			<td style="font-size:10px; align:left; padding:20px; color: #7c7c7c; line-height:1.6em; font-family:Helvetica, Arial, sans-serif;">
				© 2015 ALL RIGHTS RESERVED NOTABLE TV CORP.
			</td>
		</table>
		
		
		
		<!-- BOTTOM INFO -->
		<table width="780" cellpadding="0" cellspacing="0" border="0" align="center">
			<tr>
				<td style="padding:0; height:50px; font-size:12px; text-align:center; color:#808080; line-height:1.6em; font-family:Helvetica, Trebuchet MS, sans-serif;">
					<p> Notable TV Corp | 476 Richmond St. W, 1st Floor | Toronto, ON, M5V 1Y2
				 </td> 
			</tr>
		</table>


	</body>
</html>