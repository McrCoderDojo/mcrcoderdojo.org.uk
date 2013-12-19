<div class="grid-item">
    <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
    <?php else: ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/coderdojo.png" width="150" height="150" /></a>
    <?php endif;

    $categories = get_the_category();
    $categories = array_map(function($category) {return $category->slug;}, $categories);

    if (get_post_type() == 'event'): ?>
    <h2><a href="<?php the_permalink(); ?>"><?php echo date(get_option('date_format'), strtotime(get_field('date'))); ?></a></h2>
    <?php $venue = mcd_get_venue_from_array(get_field('venue')); ?>
    <span class="venue"><?php echo get_the_title($venue); ?></span>
    <?php elseif (get_post_type() == 'post' && in_array('blog', $categories)): ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <span class="author"><?php the_author(); ?></span>
    <?php else: ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <span class="date"><?php echo get_the_date(); ?></span>
    <?php endif; ?>
</div>
