<div class="row"><?php display_message(); ?></div>
<h1><?php echo lang('title.admins'); ?></h1>
<div id="browsecontacts">
<?php
	foreach ($users as $user) {
		echo '<a href="/'.get_site_lang().'/admin/edit/' . $user->get_id() . '">';
		echo $user->get_first_name() . " " . $user->get_last_name();
		echo '</a>';
	}
	echo '</div>';
?>
