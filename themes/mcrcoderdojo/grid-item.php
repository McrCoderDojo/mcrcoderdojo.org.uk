<div class="grid-item">
    <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
    <?php else: ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/coderdojo.png" width="150" height="150" /></a>
    <?php endif;

    if (get_post_type() == 'event'): ?>
    <h2><a href="<?php the_permalink(); ?>"><?php echo date(get_option('date_format'), strtotime(get_field('date'))); ?></a></h2>
    <?php else: ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <span class="date"><?php echo get_the_date(); ?></span>
    <?php endif; ?>
</div>
