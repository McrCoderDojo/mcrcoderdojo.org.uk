<?php get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php while (have_posts()) : the_post();
				get_template_part('content', 'page');
			endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar('content'); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
