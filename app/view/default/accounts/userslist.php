<div class="row"><?php display_message(); ?></div>
<h1><?php echo lang('title.accounts'); ?></h1>
<div id="browsecontacts">
<?php
	foreach ($users as $user) {
		echo '<a href="/'.get_site_lang().'/application/edit/' . $user->get_user_name() . '">';
		echo $user->get_user_first_name() . " " . $user->get_user_last_name();
		echo '</a>';
	}
	echo '</div>';
?>
