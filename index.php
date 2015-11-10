<?php 
	// Load saved data from previous sessions
	require_once 'loadData.php';

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
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"  />
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

											<a data-toggle="collapse" href="<?php echo '#duplicateArticleMain' . $city; ?>">
												<h3><?php echo $city; ?> Main Article <small>[Duplicate]</small></h3>
											</a>

											<!-- Duplicate Section -->
											<div class="collapse" id="<?php echo 'duplicateArticleMain' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'main-article');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>

											<div class="input-group">
												<span class="input-group-addon">Title</span>
												<input type="text" name="main-article-title" class="form-control" placeholder="Main Article's Title" 
													value="<?php echo $articles['main-article-title']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon" >URL</span>
												<input type="text" name="main-article-url" class="form-control" placeholder="Main Article's Link Address" 
													value="<?php echo $articles['main-article-url']; ?>" value=""/>
											</div>
											<div class="input-group">
												<span class="input-group-addon">Copy</span>
												<textarea rows="3" name="main-article-copy" class="form-control" placeholder="Main Article's Summary" 
													><?php echo $articles['main-article-copy']; ?></textarea>
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateArticle1' . $city; ?>">
												<h4>Thumbnail Article 1 <small>[Duplicate]</small></h4>
											</a>

											<div class="collapse" id="<?php echo 'duplicateArticle1' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'article-1');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>

											<div class="input-group">
												<span class="input-group-addon">Title</span>
												<input type="text" name="article-1-title" class="form-control" placeholder="Article 1 Title" 
													value="<?php echo $articles['article-1-title']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="article-1-url" class="form-control" placeholder="Article 1 Link Address"
													value="<?php echo $articles['article-1-url']; ?>" />
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateArticle2' . $city; ?>">
												<h4>Thumbnail Article 2 <small>[Duplicate]</small></h4>
											</a>

											<div class="collapse" id="<?php echo 'duplicateArticle2' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'article-2');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>
											
											<div class="input-group">
												<span class="input-group-addon">Title</span>
												<input type="text" name="article-2-title" class="form-control" placeholder="Article 2 Title"
													value="<?php echo $articles['article-2-title']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="article-2-url" class="form-control" placeholder="Article 2 Link Address"
													value="<?php echo $articles['article-2-url']; ?>" />
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateArticle3' . $city; ?>">
												<h4>Thumbnail Article 3 <small>[Duplicate]</small></h4>
											</a>

											<div class="collapse" id="<?php echo 'duplicateArticle3' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'article-3');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>
											
											<div class="input-group">
												<span class="input-group-addon">Title</span>
												<input type="text" name="article-3-title" class="form-control" placeholder="Article 3 Title"
													value="<?php echo $articles['article-3-title']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="article-3-url" class="form-control" placeholder="Article 3 Link Address"
													value="<?php echo $articles['article-3-url']; ?>" />
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateArticle4' . $city; ?>">
												<h4>Thumbnail Article 4 <small>[Duplicate]</small></h4>
											</a>

											<div class="collapse" id="<?php echo 'duplicateArticle4' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'article-4');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>
											
											<div class="input-group">
												<span class="input-group-addon">Title</span>
												<input type="text" name="article-4-title" class="form-control" placeholder="Article 4 Title"
													value="<?php echo $articles['article-4-title']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="article-4-url" class="form-control" placeholder="Article 4 Link Address"
													value="<?php echo $articles['article-4-url']; ?>" />
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateArticle5' . $city; ?>">
												<h4>Thumbnail Article 5 <small>[Duplicate]</small></h4>
											</a>

											<div class="collapse" id="<?php echo 'duplicateArticle5' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateArticle('<?php echo $city ?>', '<?php echo $innerCity ?>', 'article-5');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>
											
											<div class="input-group">
												<span class="input-group-addon">Title</span>
												<input type="text" name="article-5-title" class="form-control" placeholder="Article 5 Title"
													value="<?php echo $articles['article-5-title']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="article-5-url" class="form-control" placeholder="Article 5 Link Address"
													value="<?php echo $articles['article-5-url']; ?>" />
											</div>

											<center>
												<button type="submit" class="btn btn-primary save-btn">Save Content</button>
												<button type="button" onclick="window.open('newsletter.php?city=<?php echo $city; ?>', '_blank');" class="btn btn-success">Preview Saved Content</button>
												<button type="button" class="clearFormButton btn btn-default">Clear Article Content</button>
											</center>

										</form>
									</div>

									<div id="<?php echo 'ads' . $city; ?>" role="tabpanel" class="tab-pane">
										<form action="saveAds.php" method="post">

											<input type="hidden" name="city" value="<?php echo $city; ?>" />

											<?php
												//-- Load Ads for Appropriate City --//

												if ($city === "Toronto")
													$ads = $toronto_ads;
												elseif ($city === "Montreal")
													$ads = $montreal_ads;
												elseif ($city === "Calgary")
													$ads = $calgary_ads;
												elseif ($city === "Vancouver")
													$ads = $vancouver_ads;
												else
													$ads = $nationwide_ads;
											?>

											<a data-toggle="collapse" href="<?php echo '#duplicateAdLB' . $city; ?>">
												<h3>Leaderboard <small>[Duplicate]</small></h3>
											</a>

											<div class="collapse" id="<?php echo 'duplicateAdLB' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateAd('<?php echo $city ?>', '<?php echo $innerCity ?>', 'LB');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>

											<div class="input-group">
												<span class="input-group-addon">Creative</span>
												<input type="text" name="LB-creative" class="form-control" placeholder="Link to LB Creative" 
													value="<?php echo $ads['LB-creative']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="LB-url" class="form-control" placeholder="LB's Link Address" 
													value="<?php echo $ads['LB-url']; ?>" />
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateAdBB1' . $city; ?>">
												<h3>Big Box 1 <small>[Duplicate]</small></h3>
											</a>

											<div class="collapse" id="<?php echo 'duplicateAdBB1' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateAd('<?php echo $city ?>', '<?php echo $innerCity ?>', 'BB1');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>

											<div class="input-group">
												<span class="input-group-addon">Creative</span>
												<input type="text" name="BB1-creative" class="form-control" placeholder="Link to BB1 Creative" 
													value="<?php echo $ads['BB1-creative']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="BB1-url" class="form-control" placeholder="BB1's Link Address" 
													value="<?php echo $ads['BB1-url']; ?>" />
											</div>

											<a data-toggle="collapse" href="<?php echo '#duplicateAdBB2' . $city; ?>">
												<h3>Big Box 2 <small>[Duplicate]</small></h3>
											</a>

											<div class="collapse" id="<?php echo 'duplicateAdBB2' . $city; ?>">
												<div class="well" style="text-align:center;">
													<div class="responsiveButtonGroup" data-toggle="buttons">
														<?php foreach($cities as $innerCity): ?>
															<?php if ($city === $innerCity): ?>
																<button type="button" class="btn btn-default" disabled><?php echo $city; ?></button>
															<?php else: ?>
																<button type="button" class="btn btn-default save-btn" onclick="duplicateAd('<?php echo $city ?>', '<?php echo $innerCity ?>', 'BB2');"><?php echo $innerCity; ?></button>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
											</div>

											<div class="input-group">
												<span class="input-group-addon">Creative</span>
												<input type="text" name="BB2-creative" class="form-control" placeholder="Link to BB2 Creative" 
													value="<?php echo $ads['BB2-creative']; ?>" />
											</div>
											<div class="input-group">
												<span class="input-group-addon">URL</span>
												<input type="text" name="BB2-url" class="form-control" placeholder="BB2's Link Address" 
													value="<?php echo $ads['BB2-url']; ?>" />
											</div>

											<center>
												<button type="submit" class="btn btn-primary save-btn">Save Content</button>
												<button type="button" onclick="window.open('newsletter.php?city=<?php echo $city; ?>', '_blank');" class="btn btn-success">Preview Saved Content</button>
												<button type="button" class="clearFormButton btn btn-default">Clear Ads Content</button>
											</center>

										</form>
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
				background: black url('loading.gif') no-repeat 50% 50%;
				opacity: 0.5;
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
				height: 60px;
				text-align: center;
				padding-top: 20px;
				position:fixed;
				top:0;
				z-index:100;">
			<strong>Success! </strong>Newsletter content saved
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

				/*--- Show Dimmed Loading Animation ---*/

				$(".save-btn").click(function(){
					//cancel onoging & incoming slideUp animation, if any -- NOTE: "if" condition seemed like overkill
					clearTimeout(timer);
					$("#success-message").css("display", "none");
					$("#success-message").finish();

					//show dimmed loading div
					$("#dim-page-wrapper").fadeIn(100);
				});


				/*--- Ajax Form Code ---*/

				/* prepare Ajax Form's Options: 
					dataType	- define expected server response
					error 		- error handling function
					success		- success handling function
				*/
				var options = { 
					dataType: 'xml',
					error:		function(responseXML, statusText, xhr, $form) {
						//show Error Message pop up
						alert('Something went wrong with the PHPs! \n\nSever returned an Error: ' + statusText);
						
						//hide dimmed loading div
						$("#dim-page-wrapper").fadeOut(100);
					},
					success:	function() { 
						//hide dimmed loading div
						$("#dim-page-wrapper").delay(200).fadeOut(100);

						//show Success Message briefly (for 1.5 sec)
						$("#success-message").css("display", "block");
						timer = setTimeout(function(){
							$("#success-message").slideUp(500);
						}, 1500);
					}
				};
				// bind all forms as Ajax Forms, with the Options above
				$("form").ajaxForm(options);

				
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


				/*--- Collapse all [Duplicate] sections when user clicks a City section ---*/

				$(".panel-heading").click(function(){
					$("form>div.in").toggleClass("in", false);
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

				if (articleName === 'main-article' ) {
					clipboard = $("#articles" + copyFrom + " div textarea[name='main-article-copy']").val();
					$("#articles" + pasteTo + " div textarea[name='main-article-copy']").val(clipboard);
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

				clipboard = $("#ads" + copyFrom + " div input[name='" + adName + "-creative']").val();
				$("#ads" + pasteTo + " div input[name='" + adName + "-creative']").val(clipboard);

				clipboard = $("#ads" + copyFrom + " div input[name='" + adName + "-url']").val();
				$("#ads" + pasteTo + " div input[name='" + adName + "-url']").val(clipboard);

				$("#ads" + pasteTo + " form").submit();
			};



			// AWESOME FOR JQUERY DOM TRAVERSING-TESTING .css( "background-color", "red" );

		</script>
		
	</body>
</html>