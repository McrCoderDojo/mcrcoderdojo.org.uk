<?php

$selected_issue = $_POST['issue'];
$query = $selected_issue ? "p={$selected_issue}" : "posts_per_page=1";

?>

<form method="post">
<br />
<select name="issue">
<?php

$args = array(
    'category_name' => 'newsletters',
    'posts_per_page' => 1000,
);

$issues = new WP_Query($args);
while ($issues->have_posts()) {
    $issues->the_post();
    $selected = $selected_issue == get_the_ID() ? ' selected' : '';
    echo "<option value='" . get_the_ID() . "'{$selected}>" . get_the_title() . "</option>";
}

?>
</select><input type="submit" value="Go" style="width:60px;" /><br /><br />
<textarea rows="20" cols="100">
<?php

$issue = new WP_Query($query);
$issue->the_post();
include 'email-template.php';

?>
</textarea/><br />
</form>

<form action="http://mailchimp.com/" target="_new">
<input type="submit" value="Go to Mailchimp" />
</form>
