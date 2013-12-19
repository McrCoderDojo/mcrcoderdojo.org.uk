<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-meta">
            <?php $categories = get_the_category(); ?>
            <span class="cat-links">
            <?php foreach ($categories as $category): ?>
                <a href="/<?php echo $category->slug; ?>/"><?php echo $category->name; ?></a>
            <?php endforeach; ?>
            </span>
        </div>

        <?php
            if (is_single()) {
                the_title('<h1 class="entry-title">', '</h1>');
            }
            else {
                the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
            }
        ?>

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
        <?php the_excerpt();

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
