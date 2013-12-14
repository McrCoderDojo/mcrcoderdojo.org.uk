<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">Events</h1>
			</header><!-- .page-header -->

			<div class="entry-content">

				<ul>

			<?php
					$first = true;
					$past = false;

					// Start the Loop.
					while ( have_posts() ) : the_post();

						$today = new DateTime();
						$date = new DateTime(get_field('date'));

					 	if ($first && $date > $today) {
					 		echo "<h2>Upcoming Events</h2>";
					 	}
					 	else if (!$past && $today > $date) {
					 		echo "<h2>Past Events</h2>";
					 		$past = true;
					 	}

					 	?>

					 	<li>
					 		<a href="<?php the_permalink(); ?>"><?php echo $date->format(get_option('date_format')); ?></a>
					 		at <?php the_field('venue'); ?>
					 	</li>

					 	<?php

						$first = false;

					endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();
			?>
				</ul>
			</div>
			<?php
				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
