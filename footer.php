<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Salt
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php
			printf( esc_html__( 'Made with ❤️ and %s', 'salt' ), '<a href="https://wordpress.org">WordPress</a>' );
		?>
		<span class="sep"> · </span>
		<?php
			printf( esc_html__( 'Theme on %s', 'salt' ), '<a href="https://github.com/sarahmonster/salt/">Github</a>' );
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
