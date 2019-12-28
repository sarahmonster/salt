<?php
/**
 * The template for displaying the front page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Salt
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<main id="primary" class="site-main">

		<header class="page-header">
			<img src="<?php echo(get_template_directory_uri()) ?>/assets/svg/hiatus.svg" alt="On hiatus due to existential crisis." width="100%"/>
		</header>

		<div>

		<p class="text-block">I've owned triggersandsparks.com for fifteen years. In that time, it's housed innumerable variations of a portfolio, my fledgling (and then, somehow, less-fledgling) business, a collection of stories that veered wildly between confessional poetry and promotional marketing, and a whole lot of curse words.</p>

		<p class="text-block">It's time for something new.</p>

		<p class="text-block">If you're looking for design & development work, I'm back on the market. Visit <a href="https://octopusthink.com">octopusthink.com</a> to learn more.</p>

		<p class="text-block">I'll be back with more stories once I've got all my ducks in order. In the meantime, you can still read the <a href="/stories">archives</a> or <a href="https://twitter.com/sarahsemark">follow me on Twitter</a> on the off chance I suddenly start sharing short-form content on the internet again.</p>

		<p class="text-block">❤️ sarah</p>
		</div>

	</main><!-- #primary -->
</div>
</body>
</html>
<?php

