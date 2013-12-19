<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php twentyfourteen_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
			if (is_single()) {
				the_title('<h1 class="entry-title">', '</h1>');
			}
			else {
				the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
			}
		?>
	</header><!-- .entry-header -->

	<?php if (is_search()): ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else: ?>
	<div class="entry-content <?php echo $pagename; ?>">
		<?php wp_reset_query();
		the_content(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
