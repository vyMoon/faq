<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<title>FAQ</title>
</head>
<body>
<header>
	<h1>FAQ</h1>
</header>

	<section class="cd-faq">

		<?php if ($themes !== null) : ?>

			<ul class="cd-faq-categories">

				<?php foreach ($themes as $theme) : ?>

					<?php
						$countAnsweredThemeQuestion = 0;
						foreach ($questions as $question) {
							if ($question['theme_id'] == $theme['id'] && $question['answer'] !== null && $question['display'] == 1) {
								$countAnsweredThemeQuestion++;
							}
						} 
					?>
					
					<?php if ($countAnsweredThemeQuestion !== 0) : ?>

						<li><a href="#<?php echo $theme['theme'] ?>"><?php echo $theme['theme'] ?></a></li>

					<?php endif ?>
				
				<?php endforeach ?>

				<li><a href="#youreQ">Задать вопрос</a></li>

			</ul> <!-- cd-faq-categories -->

		<?php endif ?>


		<?php if ($themes !== null) : ?>

			<div class="cd-faq-items">

				<?php foreach ($themes as $theme) : ?>

					<?php
						$countAnsweredThemeQuestion = 0;
						foreach ($questions as $question) {
							if ($question['theme_id'] == $theme['id'] && $question['answer'] !== null && $question['display'] == 1) {
								$countAnsweredThemeQuestion++;
							}
						} 
					?>

					<?php if ($countAnsweredThemeQuestion !== 0) : ?>

						<ul id="<?php echo $theme['theme'] ?>" class="cd-faq-group">

							<li class="cd-faq-title"><h2><?php echo $theme['theme'] ?></h2></li>

							<?php foreach ($questions as $question) : ?>

								<?php if ($question['theme_id'] == $theme['id'] && $question['answer'] !== null && $question['display'] == 1) : ?>

									<li>
										<a class="cd-faq-trigger" href="#0"><?php echo $question['question']; ?></a>
										<div class="cd-faq-content">
											<p><?php echo $question['answer']; ?></p>
										</div> <!-- cd-faq-content -->
									</li>

								<?php endif ?>

							<?php endforeach ?>

						</ul> <!-- cd-faq-group -->

					<?php endif ?>


				<?php endforeach ?>

			</div> <!-- cd-faq-items -->
			<a href="#0" class="cd-close-panel">Close</a>
		<?php endif ?>


		<div id="youreQ" class="cd-faq-items">

			<p class="cd-faq-title">Задать вопрос</p>
				
			<form action="./controller/controllerFaq.php" method="post" >
				<div class="form-right">
					<input required  type="text" name="asking" placeholder="Ваше имя" >

					<input required type="email" name="askingEmail" placeholder="Ваш email" >

					<select name="themeId" size="1">
						<?php foreach ($themes as $theme) : ?>

							<option value="<?php echo $theme['id'] ?>"><?php echo $theme['theme'] ?></option>

						<?php endforeach ?>       
					</select>

				</div>
				<div class="form-left">
					<textarea required name="question" id="" cols="51" rows="7"></textarea>
				</div>
				<input type="submit" value="отправить">
			</form>

			<a href="./index.php">Управление</a>

		</div>

		
	</section> <!-- cd-faq -->

		<script src="js/jquery-2.1.1.js"></script>
		<script src="js/jquery.mobile.custom.min.js"></script>
		<script src="js/main.js"></script> <!-- Resource jQuery -->

    </body>
</html>