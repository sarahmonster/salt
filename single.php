<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Salt
 */

get_header(); ?>

	<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		the_post_navigation( array(
			'prev_text' => salt_get_icon( 'arrow' ) . '<span class="post-navigation-description">Previous</span> %title',
			'next_text' => salt_get_icon( 'arrow' ) . '<span class="post-navigation-description">Next</span> %title',
		) );

	endwhile; // End of the loop.
	?>

	</main><!-- #primary -->

<?php
get_footer();
