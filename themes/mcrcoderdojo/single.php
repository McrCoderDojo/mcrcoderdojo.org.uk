<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				while (have_posts()) {
					the_post();
					get_template_part('content', get_post_type());
					twentyfourteen_post_nav(get_post_type());
				}
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar('content');
get_sidebar();
get_footer();
