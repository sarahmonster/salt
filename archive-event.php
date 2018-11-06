<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Phoenix
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="page-header">
				<div class="entry-meta">
					<span class="page-description">Sometimes I get up on a stage and chatter</span>
				</div>
				<h1 class="page-title"><?php esc_html_e( 'Talks', 'salt' ); ?></h1>
				
			</header><!-- .page-header -->

		<?php if ( have_posts() ) : ?>

			<div class="phoenix-event-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'talk' ); ?>
				<?php endwhile; ?>

			</div><!-- .phoenix-event-list -->

			<?php salt_numeric_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
