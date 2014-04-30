<div id="header">
<?php
if (islogged())
{
	$links = array('/'=>'Home',
				   '/auth/add'=>'Add Account',
				   '/auth/import'=>'Import Accounts',
				   '/users/profile'=>'My profile');

	if (isadmin()) {
		$links['/users/admins'] = 'User Admin';
	}
	$links['/login/logout'] = 'Log Out';

	echo '<ul>';
	foreach ($links as $link=>$title) {
		echo '<li><a href="' . $link . '">' . $title . '</a></li>';
	}
	echo '</ul>';
}

?>
</div>
    <div id="body">
