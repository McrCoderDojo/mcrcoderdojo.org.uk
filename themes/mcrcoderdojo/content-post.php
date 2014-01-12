<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php twentyfourteen_post_thumbnail(); ?>

    <header class="entry-header">
        <div class="entry-meta">
            <?php $categories = get_the_category(); ?>
            <span class="cat-links">
            <?php foreach ($categories as $category): ?>
                <a href="/<?php echo $category->slug; ?>/"><?php echo $category->name; ?></a>
            <?php endforeach; ?>
            </span>
        </div>

        <?php if (is_single()):
            if (get_field('issue_number')): ?>
                <h1 class="entry-title">Issue #<?php the_field('issue_number'); ?>: <?php the_title(); ?></h1>
            <?php else: ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif;
            else: ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <div class="entry-meta">
            <?php twentyfourteen_posted_on(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <?php if (is_search()): ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else: ?>
    <div class="entry-content">
        <div style="margin-bottom: 20px;font-family:monospace;"><?php the_field('tagline'); ?></div>
        <?php
            the_content();
            if (is_singular('post') && get_field('links')): ?>
                <h2>Links</h2>
                    <ul>
                <?php while (has_sub_field('links')): ?>
                        <li>
                            <a href="<?php the_sub_field('url'); ?>" target="_blank">
                                <?php the_sub_field('title'); ?>
                            </a><br />
                            <?php the_sub_field('summary'); ?>
                        </li>
                <?php endwhile; ?>
                </ul>
            <?php endif;

            if (get_field('picture_description')) {
                the_field('picture_description');
            }

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
