<div id="header">
<?php
if (islogged())
{
	$links = array('/'=>'Home',
				   '/application/add'=>'Add Account',
				   '/application/import'=>'Import Accounts',
				   '/application/profile'=>'My profile');

	if (isadmin()) {
		$links['/application/admins'] = 'Admins';
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
