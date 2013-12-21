<?php

include 'template-header.php';

include 'intro.php';

if (has_post_thumbnail()) {
    include 'border-thin.php';
    include 'picture.php';
}

include 'border-thick.php';

if (get_field('links')) {
    include 'links-section.php';
}

include 'template-footer.php';
