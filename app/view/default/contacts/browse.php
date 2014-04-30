<h1>Accounts</h1>
<div id="browsecontacts">
<?php
	foreach ($users as $user) {
		var_dump($user);
		echo '<a href="/'.get_site_lang().'/application/edit/' . $user['user_first_name'] . '">';
		echo $user['user_first_name'] . " " . $user['user_last_name'];
		echo '</a>';
	}
	echo '</div>';
?>
