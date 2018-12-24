<?php
/**
 * @package salt
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	// Get an array of all our post meta.
	$meta = get_post_meta( get_the_ID(), 'event_details' )[0];

	if ( salt_date_is_upcoming( $meta['date'] ) ) : ?>
		<span class="salt-upcoming"><?php esc_html_e( 'Upcoming', 'salt' ); ?></span>
	<?php endif; ?>

	<header class="entry-header">

	<?php
	// Output the title of the talk, if we're not on the talk page itself.
	if ( is_post_type_archive( 'event' ) ):
		echo( '<h2 class="entry-title">' );
		the_terms( get_the_ID(), 'talks' );
		echo( '</h2>' );
	endif; ?>

	</header>

	<div class="salt-event-details">
		<?php // Output the name of the event.
		if ( array_key_exists( 'link' , $meta ) ) :
			printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( $meta['link'] ),
				esc_html( get_the_title() )
			);
		else :
			the_title();
		endif;

		// Format and output location.
		if ( array_key_exists( 'location' , $meta ) && $meta['location'] ) :
			echo '<br />';
			echo $meta['location'];
		endif;

		// Format and output date.
		if ( array_key_exists( 'date' , $meta ) && $meta['date'] ) :
			echo '<br /> ';
			if ( salt_date_is_upcoming( $meta['date'] ) ) :
				echo date( 'l jS F Y', $meta['date'] );
			else :
				echo date( 'F Y', $meta['date'] );
			endif;
		endif;

		

		if ( array_key_exists( 'slides' , $meta ) && $meta['slides'] OR array_key_exists( 'video' , $meta ) && $meta['video'] ) :
			echo '<br />';

			// Format and output link to slides.
			if ( array_key_exists( 'slides' , $meta ) && $meta['slides'] ) :
				printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
					esc_url( $meta['slides'] ),
					esc_html__( 'Slides', 'salt' )
				);
			endif;

			if ( array_key_exists( 'slides' , $meta ) && $meta['slides']
				&& array_key_exists( 'video' , $meta ) && $meta['video'] ) :
				echo '|';
			endif;

			// Format and output link to video.
			if ( array_key_exists( 'video' , $meta ) && $meta['video'] ) :
				printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
					esc_url( $meta['video'] ),
					esc_html__( 'Video', 'salt' )
				);
			endif;

		endif;

		?>
	</div>

</article><!-- #post-## -->
