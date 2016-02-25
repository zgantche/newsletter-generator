<?php 
	require_once 'loadData.php';		// Load saved data from previous sessions
	require_once '../wp-load.php';		// Import WordPress functions for us to use

	// Declare cities in order
	$cities = array("Toronto", "Montreal", "Calgary", "Vancouver", "Nationwide");
?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="An interactive Notable.ca newsletters template, for the code-impaired. Built with Bootstrap.">
		<meta name="keywords" content="Newsletter Creation Template">
		<meta name="author" content="Zlatko Gantchev">

		<title>
			Newsletter Template
		</title>

		<!-- Bootstrap core CSS & custom CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		
	</head>

	<body>
		<div class="container">
			<div class="page-header">
				<h1>Newsletter Generator!</h1>
			</div>

			<div class="panel-group" id="accordion" role="tablist" >


				<!-- Loop for all the city sections -->
				<?php foreach($cities as $city): ?>

					<div class="panel panel-default">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="<?php echo '#collapse' . $city; ?>" >
							<div class="panel-heading" role="tab">
								<h2 class="panel-title"><?php echo $city; ?></h2>
							</div>
						</a>
						<div id="<?php echo 'collapse' . $city; ?>" class="panel-collapse collapse" role="tabpanel" >
							<div class="panel-body">

								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="<?php echo '#articles' . $city; ?>" role="tab" data-toggle="tab">ARTICLES</a></li>
									<li role="presentation"><a href="<?php echo '#ads' . $city; ?>" role="tab" data-toggle="tab">ADS</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div id="<?php echo 'articles' . $city; ?>" role="tabpanel" class="tab-pane active">
										<form action="saveArticles.php" method="post">

											<input type="hidden" name="city" value="<?php echo $city; ?>" />
											<input type="hidden" name="article-x-thumbnail" value="" />

											<?php 
												//-- Load Articles for Appropriate City --//

												if ($city === "Toronto")
													$articles = $toronto_articles;
												elseif ($city === "Montreal")
													$articles = $montreal_articles;
												elseif ($city === "Calgary")
													$articles = $calgary_articles;
												elseif ($city === "Vancouver")
													$articles = $vancouver_articles;
												else
													$articles = $nationwide_articles;
											?>

											<div class="row article-row">
												<div class="col-md-9 col-md-offset-3">
													<a data-toggle="collapse" href="<?php echo '#duplicateArticleMain' . $city; ?>">
														<h3><?php echo $city; ?> Main Article <small>[Duplicate]</small></h3>
													</a>
												</div>
												<div class="col-md-12">
													<!-- Duplicate Section -->
													<div class="collapse" id="<?php echo 'duplicateArticleMain' . $city; ?>">
														<div class="well">
															<div class="responsiveButtonGroup" data-toggle="buttons">
																<?php foreach($cities as $innerCity): ?>
																	<?php if ($city === $innerCity): ?>
																		<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
																	<?php else: ?>
																		<button type="button" 
																			class="btn btn-default" 
																			onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'article-0');">
																				<?php echo $innerCity; ?>
																		</button>
																	<?php endif; ?>
																<?php endforeach; ?>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
													<span class="file-input btn btn-warning btn-file">
														Upload<input type="file" name="article-0-thumbnail" class="articleThumbnail">
													</span>
													<img src="<?php echo $articles['article-0-thumbnail']; ?>" 
														name="article-0-preview-img" class="article-0-preview-img img-thumbnail center-block" />
												</div>
												<div class="col-md-9">
													<div class="input-group">
														<span class="input-group-addon">Title</span>
														<input type="text" name="article-0-title" class="form-control" placeholder="Main Article's Title" 
															value="<?php echo $articles['article-0-title']; ?>" />
													</div>
													
													<div class="input-group">
														<span class="input-group-addon" >URL</span>
														<input type="text" name="article-0-url" class="form-control" placeholder="Main Article's Link Address" 
															value="<?php echo $articles['article-0-url']; ?>" value=""/>
													</div>
													<div class="input-group">
														<span class="input-group-addon">Copy</span>
														<textarea rows="3" name="article-0-copy" class="form-control" placeholder="Main Article's Summary" 
															><?php echo $articles['article-0-copy']; ?></textarea>
													</div>
												</div>
											</div>

											<?php 
												//-- Loop Through Each of the 8 Thumbnail Articles --//
												for ($i = 1; $i <= 8; $i++):
													$article_title = 'article-' . $i . '-title';
													$article_url = 'article-' . $i . '-url';
													$article_thumbnail = 'article-' . $i . '-thumbnail';
											?>

												<?php 
													// Check if Subheading needs to be inserted
													if($i === 1 || $i === 5): 
														if ($i === 1)
															$subheading_num = 1;
														else
															$subheading_num = 2;
												?>
												<div class="row article-group-divider">
													<div class="col-md-6 col-md-offset-3">
															<div class="row">
																<div class="col-md-8 col-md-offset-2">
																	<select name="subheading-<?php echo $subheading_num; ?>" class="form-control" 
																			style="">
																		<option value="[Select Subheading]">--- Select Subheading <?php echo $subheading_num; ?> ---</option>
																		<?php
																			foreach (
																				["FEATURED ARTICLES", "TRENDING ARTICLES", "LOCAL ARTICLES"] 
																				as $subheading) {
																			 	echo '<option value="' . $subheading . '"';
																			 	if ($articles['subheading-' . $subheading_num] === $subheading)
																			 		echo ' selected';
																			 	echo '>' . $subheading . '</option>';
																			 };
																		?>
																	</select>
																</div>
													    	</div>
													</div>
												</div>
												<?php endif; ?>

												<div class="row article-row">
													<div class="col-md-9 col-md-offset-3">
														<a data-toggle="collapse" href="<?php echo '#duplicateArticle' . $i . $city; ?>">
															<h4>Thumbnail Article <?php echo $i ?> <small>[Duplicate]</small></h4>
														</a>
													</div>
													<div class="col-md-12">
														<!-- Duplicate Section -->
														<div class="collapse" id="<?php echo 'duplicateArticle' . $i . $city; ?>">
															<div class="well">
																<div class="responsiveButtonGroup" data-toggle="buttons">
																	<?php foreach($cities as $innerCity): ?>
																		<?php if ($city === $innerCity): ?>
																			<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
																		<?php else: ?>
																			<button type="button" 
																				class="btn btn-default" 
																				onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', '<?php echo 'article-' . $i ?>');">
																					<?php echo $innerCity; ?>
																			</button>
																		<?php endif; ?>
																	<?php endforeach; ?>
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-3">
														<span class="file-input btn btn-warning btn-file">
															Upload<input type="file" name="<?php echo 'article-' . $i . '-thumbnail'; ?>" class="articleThumbnail">
														</span>
														<img src="<?php echo $articles[$article_thumbnail]; ?>" 
															name="<?php echo 'article-' . $i . '-preview-img'; ?>" class="article-preview-img img-thumbnail center-block" />
													</div>
													<div class="col-md-9 bit-of-top-padding">
														<div class="input-group">
															<span class="input-group-addon">Title</span>
															<input type="text" name="<?php echo 'article-' . $i . '-title'; ?>" class="form-control" 
																placeholder="<?php echo 'Article ' . $i . ' Title'; ?>" value="<?php echo $articles[$article_title]; ?>" />
														</div>
														<div class="input-group">
															<span class="input-group-addon">URL</span>
															<input type="text" name="<?php echo 'article-' . $i . '-url'; ?>" class="form-control" 
																placeholder="<?php echo 'Article ' . $i . ' Link Address'; ?>" value="<?php echo $articles[$article_url]; ?>" />
															<!-- Hidden fields used for 'smart' thumnail file uploads -->
															<input type="hidden" name="<?php echo 'article-' . $i . '-thumbnail'; ?>" value="<?php echo $articles[$article_thumbnail]; ?>" />
															<input type="hidden" name="<?php echo 'article-' . $i . '-url-old'; ?>" value="<?php echo $articles[$article_url]; ?>" />
														</div>
													</div>
												</div>

											<?php endfor; ?>

											<center>
												<button type="submit" class="btn btn-primary">Save Content</button>
												<button 
													type="button" 
													onclick="window.open('newsletter.php?city=<?php echo $city; ?>', '_blank');" 
													class="btn btn-success">
														Preview Saved Content
												</button>
												<button type="button" class="clearFormButton btn btn-default">Clear Article Content</button>
											</center>

										</form>
									</div>

									<div id="<?php echo 'ads' . $city; ?>" role="tabpanel" class="tab-pane text-center">
										<?php

											//-- Load Ads for Appropriate City --//
											if ($city === "Toronto"){
												$ads = array (
													'LB' 	=> $toronto_ad_lb,
													'BB1' 	=> $toronto_ad_bb1,
													'BB2' 	=> $toronto_ad_bb2
												);
											}
											elseif ($city === "Montreal")
												$ads = array (
													'LB' 	=> $montreal_ad_lb,
													'BB1' 	=> $montreal_ad_bb1,
													'BB2' 	=> $montreal_ad_bb2
												);
											elseif ($city === "Calgary")
												$ads = array (
													'LB' 	=> $calgary_ad_lb,
													'BB1' 	=> $calgary_ad_bb1,
													'BB2' 	=> $calgary_ad_bb2
												);
											elseif ($city === "Vancouver")
												$ads = array (
													'LB' 	=> $vancouver_ad_lb,
													'BB1' 	=> $vancouver_ad_bb1,
													'BB2' 	=> $vancouver_ad_bb2
												);
											else
												$ads = array (
													'LB' 	=> $nationwide_ad_lb,
													'BB1' 	=> $nationwide_ad_bb1,
													'BB2' 	=> $nationwide_ad_bb2
												);


											//-- Loop Through Each of the Ads --//
											foreach($ads as $ads_key => $ad):

												//update each ad's text label
												switch ($ads_key) {
													case "LB":	$ad_label = "Leaderboard"; break;
													case "BB1":	$ad_label = "Big Box 1"; break;
													case "BB2":	$ad_label = "Big Box 2"; break;
													default:	$ad_label = "Non-expected $ads key? :/"; break;
												}
										?>

							<!-- BEGIN section for current ad (<?php echo $ad_label; ?>) -->
							<a data-toggle="collapse" href="<?php echo '#duplicateAd' . $ads_key . $city; ?>">
								<h3><?php echo $ad_label; ?> <small>[Duplicate]</small></h3>
							</a>

							<div class="collapse" id="<?php echo 'duplicateAd' . $ads_key . $city; ?>">
								<div class="well">
									<div class="responsiveButtonGroup" data-toggle="buttons">
										<?php foreach($cities as $innerCity): ?>
											<?php if ($city === $innerCity): ?>
												<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
											<?php else: ?>
												<button type="button" 
													class="btn btn-default" 
													onclick="duplicateAd('<?php echo $city ?>', '<?php echo $innerCity ?>', '<?php echo $ads_key ?>');">
														<?php echo $innerCity; ?>
												</button>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
							</div>

							<!-- Image trigger modal. Use a placeholder kitten if image does not exist. -->
							<a href="#" data-toggle="modal" data-target="#adModal<?php echo $city . $ads_key; ?>">
								<img src="<?php 
												if ( strlen($ad['creative']) == 0 )
													echo 'http://placekitten.com.s3.amazonaws.com/homepage-samples/408/287.jpg';
												else
													echo $ad['creative'];
												?>" name="modal-image-trigger-<?php echo $ads_key; ?>" class="img-thumbnail center-block" />
							</a><br />

							<!-- Modal -->
							<div class="modal fade" id="adModal<?php echo $city . $ads_key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h3 class="modal-title" >Edit <?php echo $ad_label; ?></h3>
										</div>
										<form id="<?php echo $city . $ads_key; ?>" action="saveAds.php" method="post" enctype="multipart/form-data">
											<div class="modal-body">

												<input type="hidden" name="city" value="<?php echo $city; ?>" />
												<input type="hidden" name="ad-type" value="<?php echo $ads_key; ?>" />

												<a href="<?php echo $ad['link-url']; ?>" name="preview-link-url" target="_blank">
													<img src="<?php echo $ad['creative']; ?>" name="preview-creative" class="img-thumbnail center-block" />
												</a>
												<br />

												<div class="input-group">
													<span class="input-group-addon">Creative</span>
													<input type="text" class="form-control" name="preview-filename" placeholder="Browse for a new image..." readonly>
													<span class="input-group-btn">
														<span class="btn btn-warning btn-file">
															Browse...<input type="file" name="fileToUpload" id="fileToUpload"><br />
														</span>
													</span>
												</div>

												<input type="hidden" name="creative" class="form-control" value="<?php echo $ad['creative']; ?>" />
												<div class="input-group">
													<span class="input-group-addon">Link URL</span>
													<input type="text" name="link-url" class="form-control" placeholder="ex. http://destination.site.goes.here" 
														value="<?php echo $ad['link-url']; ?>" />
												</div>

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- END section for current ad (<?php echo $ad_label; ?>) -->


										<?php endforeach; ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>


			</div>
		</div>

		<!-- Loading Status Background div -->
		<div id="dim-page-wrapper" style="
				display: none;
				background: black url('images/waitingtea.gif') no-repeat 50% 50%;
				opacity: 0.8;
				width:100%;
				height:100%;
				position:fixed;
				top:0;
				left:0;
				z-index:99;">&nbsp;
		</div>
		<div id="success-message" class="alert alert-success" role="alert" style="
				display: none;
				width: 100%;
				text-align: center;
				padding-top: 20px;
				position:fixed;
				top:0;
				z-index:100;">
			<strong>Success!</strong>
			<div id="success-message-info"></div>
		</div>
		<div id="warning-message" class="alert alert-warning" role="alert" style="
				display: none;
				width: 100%;
				text-align: center;
				padding-top: 20px;
				position:fixed;
				top:0;
				z-index:100;">
			<button type="button" class="close" data-hide="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<strong>Warning!</strong>
			<div id="warning-message-info"></div>
		</div>
		
		<!-- Bootstrap core JavaScript, jQuery, Ajax form JS - (Placed at end of doc so page loads faster) -->
		<!-- ============================================================================================= -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/jquery.form.js"></script> 
		<script src="js/bootstrap.min.js"></script>

		<!-- Ajax form code -->
		<script>
			$(document).ready(function(){
				var timer;

				/*--- Ajax Form Code ---*/

				/* prepare Ajax Form's Options: 
					dataType		- define expected server response
					beforeSubmit	- show dimmed loading animation
					error 			- error handling function
					success			- success handling function
				*/
				var options = { 
					dataType: 'json',
					beforeSubmit: function(formData, jqForm) {

						//cancel onoging & incoming slideUp animation, if any -- NOTE: "if" condition seemed like overkill
						clearTimeout(timer);
						$("#success-message").css("display", "none");
						$("#success-message").finish();

						//close open modal
						$("div[id^='adModal']").modal("hide");

						//show dimmed loading div
						$("#dim-page-wrapper").fadeIn(100);
					},
					error:		function(responseXML, statusText, xhr, $form) {

						//show Error Message pop up
						alert('Something went wrong with the PHPs! \n\nSever returned an Error: ' + statusText);
						
						//hide dimmed loading div
						$("#dim-page-wrapper").fadeOut(100);
					},
					success:	function(data) { 

						//if form submission was regarding ads, update their images
						if (data['type'] == "ads") {
							//update appropriate image preview thumbnail with latest Creative and URL
							$("#" + data['city'] + data['ad-type'] + " a[name='preview-link-url']").attr("href", data['link-url']);
							$("#" + data['city'] + data['ad-type'] + " a img[name='preview-creative']").attr("src", data['creative']);

							//update appropriate modal trigger image
							$("#ads" + data['city'] + " a img[name='modal-image-trigger-" + data['ad-type'] + "']").attr("src", data['creative']);
						}
						else if (data['type'] == "articles") {

							var articlesClass = "#articles" + data['city'];
							
							//reset thumbnail name field
							$(articlesClass).find("input[name='article-x-thumbnail']").attr("value", "");

							for (i = 0; i <= 8; i++) { 
								//update "article-i-preview-img" thumbnails
								$(articlesClass + " img[name='article-" + i + "-preview-img']").attr("src", data["article-" + i + "-img"]);

								//update "article-i-thumbnail" & "articles-i-url-old" hidden inputs
								$(articlesClass + " input[name='article-" + i + "-thumbnail']").attr("value", data["article-" + i + "-img"]);
								$(articlesClass + " input[name='article-" + i + "-url-old']").attr("value", 
									$(articlesClass + " input[name='article-" + i + "-url']").val());
							}
						}

						//hide dimmed loading div
						$("#dim-page-wrapper").delay(300).fadeOut(200);

						//display Warning message, if applicable
						if (data['status'] == "warning") {
							//update warning message, and display it to user
							$("#warning-message-info").html(data['info']);
							$("#warning-message").css("display", "block");
						} else {
							//update success message, and display it briefly (for 2.5 sec)
							$("#success-message-info").html(data['info']);
							$("#success-message").css("display", "block");
							timer = setTimeout(function(){
								$("#success-message").slideUp(500);
							}, 2500);
						}
					}
				};
				// bind all forms as Ajax Forms, with the Options above
				$("form").ajaxForm(options);


				/*--- Auto-submit Articles Form on Thumbnail Selection ---*/
				$(".articleThumbnail").change(function() { 
					var thumb = $(this);

					//update appropriate city's thumbnail Name with the correct article (0-8), and submit
					thumb.closest("form").children("input[name='article-x-thumbnail']").attr("value", thumb.attr("name"));
					thumb.closest("form").submit();
				});


				/*--- Clear Button Code ---*/

				$(".clearFormButton").click(function(){
					// retrieve parent form
					var parentForm = $(this).parents('form:first');

					// loop through all the form's inputs and clear their values
					parentForm.find('input:text, textarea').val('');
				});


				/*--- Button Group Dynamic Styling, [Duplicate] Sections ---*/

				// determine which class to use (vertical/horizontal) at page load
				if ($(window).width() < 580) {
					$('.responsiveButtonGroup').addClass('btn-group-vertical');
				} else{
					$('.responsiveButtonGroup').addClass('btn-group');
				};

				// switch between horizontal/vertical class dynamically
				$(window).resize(function() {
					if ($(window).width() < 580) {
						$('.responsiveButtonGroup').removeClass('btn-group');
						$('.responsiveButtonGroup').addClass('btn-group-vertical');
					} else {
						$('.responsiveButtonGroup').addClass('btn-group');
						$('.responsiveButtonGroup').removeClass('btn-group-vertical');
					};
				});


				/*--- Hide Warning message when "close" is clicked ---*/

				$("[data-hide]").click(function(){
					$("#warning-message").hide();
				});
				

				/*--- Collapse all [Duplicate] sections when user clicks a City section ---*/

				$(".panel-heading").click(function(){
					$("form>div.in").toggleClass("in", false);
				});

				
				/*--- Provide feedback to user before file upload via preview-filename input ---*/

				$(document).on('change', '.btn-file :file', function() {
					var fileUploadButton = $(this);
					var fileName = fileUploadButton.val().replace(/\\/g, '/').replace(/.*\//, '');
					fileUploadButton.closest(".modal-body").find("input[name='preview-filename']").val(fileName);
				});

			});
			

			/**
			 * Duplicates desired article, and submits changes
			 *
			 * @param {String} copyFrom -- City which we're copying Article from
			 * @param {String) pasteTo -- City which we're copying Article to
			 * @param {String) articleName -- Specifies article name
			 *
			 * @return void
			*/
			function duplicateArticle(copyFrom, pasteTo, articleName){
				var clipboard = "";

				clipboard = $("#articles" + copyFrom + " div input[name='" + articleName + "-title']").val();
				$("#articles" + pasteTo + " div input[name='" + articleName + "-title']").val(clipboard);

				clipboard = $("#articles" + copyFrom + " div input[name='" + articleName + "-url']").val();
				$("#articles" + pasteTo + " div input[name='" + articleName + "-url']").val(clipboard);

				if (articleName === 'article-0' ) {
					clipboard = $("#articles" + copyFrom + " div textarea[name='article-0-copy']").val();
					$("#articles" + pasteTo + " div textarea[name='article-0-copy']").val(clipboard);
				};

				$("#articles" + pasteTo + " form").submit();
			};

			/**
			 * Duplicates desired ads, and submits changes
			 *
			 * @param {String} copyFrom -- City which we're copying Ads from
			 * @param {String) pasteTo -- City which we're copying Ads to
			 * @param {String) adName -- Specifies article name
			 *
			 * @return void
			*/
			function duplicateAd(copyFrom, pasteTo, adName){
				var clipboard = "";
				
				clipboard = $("#" + copyFrom + adName + " div input[name='creative']").val();
				$("#" + pasteTo + adName + " div input[name='creative']").val(clipboard);

				clipboard = $("#" + copyFrom + adName + " div input[name='link-url']").val();
				$("#" + pasteTo + adName + " div input[name='link-url']").val(clipboard);
				
				$("#ads" + pasteTo + " form").submit();
			};



			// AWESOME FOR JQUERY DOM TRAVERSING-TESTING .css( "background-color", "red" );

		</script>
		
	</body>
</html>