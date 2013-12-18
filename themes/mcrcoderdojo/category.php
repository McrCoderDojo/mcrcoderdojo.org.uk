<?php get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if (have_posts()): ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf(__('Category Archives: %s', 'twentyfourteen'), single_cat_title('', false)); ?></h1>
			</header><!-- .archive-header -->

			<?php

					while (have_posts()):
						the_post();
						get_template_part('content', 'excerpt');
					endwhile;

					twentyfourteen_paging_nav();

				else:
					// If no content, include the "No posts found" template.
					get_template_part('content', 'none');

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar('content');
get_sidebar();
get_footer();
