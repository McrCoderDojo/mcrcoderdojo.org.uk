<?php
    get_header();
    $author = get_queried_object();
    $id = $author->ID;

    $args = array(
        'category_name' => 'blog',
        'author' => $id,
    );

    $author_posts = new WP_Query($args);
?>

<section id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

        <header class="archive-header">
            <?php
                $user = get_userdata($id);
                $name = "{$user->first_name} {$user->last_name}";
                $fname = $user->first_name;
                $photo = get_field('photo', "user_{$id}");
                $web = $user->user_url;
                $twitter = get_field('twitter', "user_{$id}");
                $gplus = get_field('google_plus', "user_{$id}");
            ?>
            <h1><?php echo $name; ?></h1>

            <div class="author-photo">

            <?php
                if ($photo) {
                    $thumbnail = $photo['sizes']['thumbnail'];
                    echo "<img src='{$thumbnail}' /><br />";
                }

                if ($web) {
                    echo "<a href='{$web}' class='web' target='_blank'>" . get_domain_from_url($web) . "</a><br />";
                }

                if ($twitter) {
                    echo "<a href='http://twitter.com/{$twitter}' class='twitter' target='_blank'>@{$twitter}</a><br />";
                }

                if ($gplus) {
                    $gplus_text = $gplus[0] == '+' ? "{$gplus}" : $name;
                    echo "<a href='http://plus.google.com/{$gplus}' class='gplus' target='_blank'>{$gplus_text}</a>";
                }
            ?>

            </div>

            <div class="author-bio">
                <?php the_field('bio', "user_{$id}"); ?>
            </div>
        </header><!-- .archive-header -->
        <div class="entry-content full">

            <?php rewind_posts();

            if ($author_posts->have_posts()): ?>

                <h2><?php echo $fname; ?>'s Blog Posts</h2>
                <?php while ($author_posts->have_posts()):
                    $author_posts->the_post();
                    get_template_part('grid', 'item');
                endwhile;
            endif; ?>
        </div>

    </div><!-- #content -->
</section><!-- #primary -->

<?php
get_sidebar('content');
get_sidebar();
get_footer();
