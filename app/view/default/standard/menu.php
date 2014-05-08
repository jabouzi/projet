<div id="header">
<?php
if (islogged())
{
	$links = array('/'=> lang('title.accounts'),
				   '/'.get_site_lang().'/application/add'=> lang('title.add.account'),
				   '/'.get_site_lang().'/application/import'=> lang('title.import.accounts')
				   );

	if (isadmin()) {
		$links['/'.get_site_lang().'/admin'] = lang('title.admins');
		$links['/'.get_site_lang().'/admin/add'] = lang('title.add.admin');
	}
	$links['/'.get_site_lang().'/admin/profile'] = lang('title.profile');
	$links['/'.get_site_lang().'/login/logout'] = lang('login.logout');

	echo '<ul>';
	foreach ($links as $link=>$title) {
		echo '<li><a href="' . $link . '">' . $title . '</a></li>';
	}
	echo '<li style="float:right"><a href="">fr</a>';
	echo '</ul>';
}

?>

<ul style="float:right"><li><a href="">fr</a></li></ul>
</div>
    <div id="body">
