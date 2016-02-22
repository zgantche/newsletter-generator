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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Notable.ca</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- CSS Reset -->
    <style type="text/css">
        /* Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            Margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        
        /* Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        
        /* Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }
        
        /* Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
                
        /* Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            Margin: 0 auto !important;
        }
        table table table {
            table-layout: auto; 
        }
        
        /* Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }
        
        /* Overrides styles added when Yahoo's auto-senses a link. */
        .yshortcuts a {
            border-bottom: none !important;
        }
        
        /* A work-around for iOS meddling in triggered links. */
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit !important;
            text-decoration: underline !important;
        }
    </style>

    <!-- Media Queries -->
    <style type="text/css">
        @media only screen and (max-width: 631px) {
            .notable_logo {
                width: 350px !important;
            }
            #main_article_title {
                font-size: 26px !important;
                margin-right: 0px !important;
                margin-left: 0px !important;
            }
            #main_article_copy {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
            .thumbnail_article_img {
                width: 45% !important;
            }
            .thumbnail_article_img tr td {
                padding-left: 5px !important;
                padding-right: 10px !important;
            }
            .thumbnail_article_title {
                width: 55%!important;
            }
            .thumbnail_article_title tr td {
                font-size: 19px !important;
                padding-top: 0px !important;
            }
            .nav_bar_menu_items {
                display: none !important;
            }
            .nav_bar_sm_icons{
                width: 100% !important;
            }
            .sm_icons {
                margin-left: 0px !important;
                margin-right: 0px !important;
            }

            /* Forces table cells into full-width rows. */
            .stack-column {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
        }
    </style>
</head>

<body width="100%" bgcolor="#f1f1f1" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<!--[if mso]>
<table cellspacing="0" cellpadding="0" border="0" width="728" align="center">
    <tr>
        <td align="center" valign="top" width="660">
<![endif]-->
<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#f1f1f1" style="border-collapse:collapse;"><tr><td valign="top">
    <center style="width: 100%;">
        <div style="max-width: 728px;">

            <!-- Email Header : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" bgcolor="#242424" style="max-width: 728px;">
                <!-- Leaderboard Ad -->
                <tr>
                    <td align="center" style="background-color:#f1f1f1;">
                        <a href="<?php echo $ad_lb['link-url']; ?>" target="_blank"><img src="<?php echo $ad_lb['creative']; ?>" alt="Leaderboard Ad" width="728" border="0" align="center" style="width: 100%; max-width: 728px;" /></a>
                    </td>
                </tr>
                <!-- Social Media Icons - No indentation, so it's not rendered as spacing between them :(-->
                <tr>    
                    <td align="right" style="padding-right:15px; padding-top:12px; padding-bottom:10px;">
                        <a href="https://www.facebook.com/Notable.ca" target="_blank" style="color:#242424;"><img src="http://notable.ca/wp-content/uploads/2015/03/facebook_icon_74px.jpg" alt="facebook" width="29" style="max-width:29px" /></a><a href="https://twitter.com/notableca" target="_blank" style="color:#242424;"><img src="http://notable.ca/wp-content/uploads/2015/03/twitter_icon_74px.jpg" alt="twitter" width="29" style="max-width:29px" /></a><a href="https://www.linkedin.com/company/notable-ca" target="_blank" style="color:#242424;"><img src="http://notable.ca/wp-content/uploads/2015/03/linkedin_icon_74px.jpg" alt="linkedin" width="29" style="max-width:29px" /></a><a href="https://instagram.com/notableca" target="_blank" style="color:#242424;"><img src="http://notable.ca/wp-content/uploads/2015/03/instagram_icon_74px.jpg" alt="instagram" width="29" style="max-width:29px" /></a>
                    </td>
                </tr>
                <!-- Header Logo -->
                <tr>
                    <td align="center" style="padding-top:2px; padding-bottom:33px; padding-left:20px; padding-right:20px;">
                        <a href="http://www.notable.ca/" target="_blank">
                            <img src="http://notable.ca/wp-content/uploads/2015/03/notable-logo-newsletter.jpg" alt="Notable.ca Header Logo" width="350" border="0" align="center" style="width: 100%; max-width: 350px;" />
                        </a>
                    </td>
                </tr>
                <!-- Separator -->
                <tr>
                    <td style="background-color:#333333; height:15px;">
                    </td>
                </tr>
            </table>
            <!-- Email Header : END -->

            <!-- Email Body : BEGIN -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#fdfdfd" width="100%" style="max-width: 728px;">

                <!-- Main Article : BEGIN -->
                <tr>
                    <td align="center" style="padding-top:20px; padding-left:20px; padding-right:20px;">
                        <a href="<?php echo $articles['article-0-url']; ?>" target="_blank">
                            <img src="<?php echo $articles['article-0-thumbnail']; ?>" alt="Main Article Thumbnail Image" width="600" border="0" align="center" style="width: 100%; max-width: 600px;" />
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td id="main_article_copy" align="center" style="padding-left: 40px; padding-right: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 25px; color: #555555;">
                                    <a href="<?php echo $articles['article-0-url']; ?>" target="_blank" style="text-decoration:none">
                                        <h1 id="main_article_title" style="font-size:24px; color: #202020; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:20px; margin-top:20px; margin-left:20px; margin-right:20px; display:block; text-align: center;"><?php echo $articles['article-0-title']; ?></h1>
                                    </a>
                                    <?php echo nl2br($articles['article-0-copy']); ?>
                                    <br /><br />
                                    <!-- Call to Action Button -->
                                    <table cellspacing="0" cellpadding="0" border="0" align="center" style="Margin: auto">
                                        <tr>
                                            <td align="center" style="border-radius: 3px; background: #222222;" class="button-td">
                                                <a href="<?php echo $articles['article-0-url']; ?>" target="_blank" style="background: #222222; max-width: 250px; border: 15px solid #222222; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">Continue Reading
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Main Article : END -->

                <!-- Big Box Ad 1 : START -->
                <tr>
                    <td align="center" style="padding-top:40px; padding-bottom:40px;">
                        <a href="<?php echo $ad_bb1['link-url']; ?>" target="_blank">
                            <img src="<?php echo $ad_bb1['creative']; ?>" alt="Big Box Ad" width="300" border="0" align="center" style="width: 100%; max-width: 300px;" />
                        </a>
                    </td>
                </tr>
                <!-- Big Box Ad 1 : END -->

                <!-- First Group of Four Thumbnail Articles : START -->
                <tr>
                    <td bgcolor="#fdfdfd" align="center" height="100%" valign="top" width="100%">
                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:660px; border-top:1px dashed #cccccc;">
                            <tr>
                                <td align="center" valign="top" style="font-size:0; padding: 10px 0;">
                                    <h1 style="font-size:20px; color: #202020; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:20px; margin-top:20px; text-align: center;">FEATURED ARTICLES</h1>
                                    <!--[if mso]>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-1-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-1-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-1-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-2-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-2-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-2-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-3-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-3-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-3-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-4-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-4-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-4-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- First Group of Four Thumbnail Articles : END -->

                <!-- Big Box Ad 2 : START -->
                <tr>
                    <td align="center" style="padding-top:40px; padding-bottom:40px;">
                        <a href="<?php echo $ad_bb2['link-url']; ?>" target="_blank">
                            <img src="<?php echo $ad_bb2['creative']; ?>" width="300" height="" alt="Big Box Ad" border="0" align="center" style="width: 100%; max-width: 300px;" />
                        </a>
                    </td>
                </tr>
                <!-- Big Box Ad 2 : END -->

                <!-- Second Group of Four Thumbnail Articles : START -->
                <tr>
                    <td bgcolor="#fdfdfd" align="center" height="100%" valign="top" width="100%">
                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:660px; border-top:1px dashed #cccccc;">
                            <tr>
                                <td align="center" valign="top" style="font-size:0; padding: 10px 0;">
                                    <h1 style="font-size:20px; color: #202020; line-height:1.2em; font-family:Helvetica, Arial, sans-serif; margin-bottom:20px; margin-top:20px; text-align: center;">TRENDING ARTICLES</h1>
                                    <!--[if mso]>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-5-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-5-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%;max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-5-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-6-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-6-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-6-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-7-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-7-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-7-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="300">
                                    <![endif]-->
                                    <div style="display:inline-block; Margin: 0 -2px; width:100%; min-width:200px; max-width:320px; vertical-align:top;" class="stack-column">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px 10px;">
                                                    <a href="<?php echo $articles['article-8-url']; ?>" target="_blank" style="text-decoration:none">
                                                        <table class="thumbnail_article_img" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td align="center">
                                                                    <img src="<?php echo $articles['article-8-thumbnail']; ?>" alt="Article Thumbnail Image" width="300" style="border: 0; width: 100%; max-width: 300px;" class="center-on-narrow" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="thumbnail_article_title" align="left" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: left;">
                                                            <tr>
                                                                <td style="font-family: sans-serif; max-width: 300px; font-size: 20px; font-weight: bold; mso-height-rule: exactly; line-height: 25px; color: #000000; padding-top: 10px;" class="stack-column-center">
                                                                    <?php echo $articles['article-8-title']; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--[if mso]>
                                                </td>
                                            </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Second Group of Four Thumbnail Articles : END -->
            </table>

            <!-- Email Footer : START -->
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" bgcolor="#242424" style="max-width: 728px;">
                <tr>
                    <td style="margin-top:20px; width: 100%; text-align: center;">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="background-color:#333333; height:15px;"></table>
                        <table width="100%" height="60px" cellpadding="0" cellspacing="0" border="0" align="center">
                            <tr >
                                <td align="center">
                                      <img src="http://notable.ca/wp-content/uploads/2015/03/notable-logo-newsletter.jpg" alt="Notable.ca Footer Logo" width="191" height="26" border="0" style="padding-top:23px; padding-bottom:0px;" />
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:12px; padding:20px; color: #aaaaaa; line-height:1.6em; font-family:Helvetica, Arial, sans-serif;">
                                    Notable Media Inc. | 476 Richmond St. W, 1st Floor | Toronto, ON, M5V 1Y2
                                </td>
                            </tr>
                            <tr>
                                <td align="right" style="color: #888888; font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; padding-bottom:8px; padding-right:10px;">
                                    <br />
                                    You can always <a href="http://notable.ca/unsubscribe/" target="_blank" style="color:#888888; text-decoration:underline;">unsubscribe</a> here
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->

        </div>
    </center>
</td></tr></table>
<!--[if mso]>
        </td>
    </tr>
</table
<![endif]-->
</body>
</html>