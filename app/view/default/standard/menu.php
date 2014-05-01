<div id="header">
<?php
if (islogged())
{
	$links = array('/'=>'Home',
				   '/'.get_site_lang().'/application/add'=>'Add Account',
				   '/'.get_site_lang().'/application/import'=>'Import Accounts',
				   '/'.get_site_lang().'/application/profile'=>'My profile');

	if (isadmin()) {
		$links['/'.get_site_lang().'/application/admins'] = 'Admins';
	}
	$links['/'.get_site_lang().'/login/logout'] = 'Log Out';

	echo '<ul>';
	foreach ($links as $link=>$title) {
		echo '<li><a href="' . $link . '">' . $title . '</a></li>';
	}
	echo '</ul>';
}

?>
</div>
    <div id="body">
