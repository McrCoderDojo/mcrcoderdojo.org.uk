<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php twentyfourteen_post_thumbnail(); ?>

	<header class="entry-header">
		<?php if (in_array('category', get_object_taxonomies(get_post_type())) && twentyfourteen_categorized_blog()): ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen')); ?></span>
		</div>
		<?php
			endif;

			if (is_single()) {
				the_title('<h1 class="entry-title">', '</h1>');
			}
			else {
				the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
			}

			$today = new DateTime();
			$date = new DateTime(get_field('date'));

			$venue = get_field('venue');
			if (is_array($venue)) {
				$venue = array_pop($venue);
			}
		 ?>
	</header><!-- .entry-header -->

	<?php if (is_search()): ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else: ?>
	<div class="entry-content">
		<?php

			if ($date > $today):
				the_content();
		?>

				<h2>Date &amp; Time</h2>
				<?php echo $date->format(get_option('date_format')); ?><br />
				<?php the_field('time'); ?>

				<h2>Venue</h2>
				<strong><?php echo get_the_title($venue); ?></strong><br />
				<?php echo the_field('address', $venue); ?><br />
				<?php echo the_field('post_code', $venue); ?>

				<h3>Parking</h3>
				<?php echo the_field('parking', $venue); ?>

		<?php else:
				the_field('after_event_content');
			endif;

			wp_link_pages(array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfourteen') . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			));
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php the_tags('<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>'); ?>
</article><!-- #post-## -->
