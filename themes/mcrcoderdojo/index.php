<?php get_header(); ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					get_template_part('content', 'post');
				}
				twentyfourteen_paging_nav();
			}
			else {
				get_template_part('content', 'none');
			}
		?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar('content'); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
