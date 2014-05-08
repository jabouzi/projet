<div id="header">
<?php
echo '<ul>';
echo '<li class="first-item"><a href="/'.strtolower(lang('site.lang')).'">'.lang('site.lang').'</a>';
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

	
	foreach ($links as $link=>$title) {
		echo '<li><a href="' . $link . '">' . $title . '</a></li>';
	}
	
}
echo '</ul>';

?>

</div>
    <div id="body">
