<h1>Accounts</h1>
<div id="browsecontacts">
<?php
	foreach ($users as $user) {
		echo '<a href="/application/edit/' . $user['user_name'] . '">';
		echo $user['user_first_name'] . " " . $user['user_last_name'];
		echo '</a>';
	}
	echo '</div>';
?>
