<?php get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if (have_posts()): ?>

			<header class="archive-header">
				<h1><?php echo single_cat_title('', false); ?></h1>
			</header><!-- .archive-header -->

			<?php

					while (have_posts()) {
						the_post();
						get_template_part('content', 'excerpt');
					}
					twentyfourteen_paging_nav();

				else:
					get_template_part('content', 'none');
				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar('content');
get_sidebar();
get_footer();
