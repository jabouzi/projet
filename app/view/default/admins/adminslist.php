<div class="row error"><label></label><?php display_message(); ?></div>
<h1>Accounts</h1>
<div id="browsecontacts">
<?php
	foreach ($users as $user) {
		echo '<a href="/'.get_site_lang().'/application/edit/' . $user->get_email() . '">';
		echo $user->get_first_name() . " " . $user->get_last_name();
		echo '</a>';
	}
	echo '</div>';
?>
