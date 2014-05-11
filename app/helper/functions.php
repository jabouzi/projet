<?php

function get_projects($user_projects = array())
{
	$sClient = new SoapClient('http://svn.tgiprojects.com/wsdl/usvnws.wsdl', array('trace' => 1));
	$projects = $sClient->getlist();
	$selected = '';
	if (in_array('*', $user_projects)) $selected = 'selected';
	echo '<select id="user_vhost" name="user_vhost[]" multiple="multiple" data-validate="required" >
				<option value="*" '.$selected.'>All</option>';
	foreach($projects as $project)
	{
		$selected = '';
		if (in_array($project['projects_sitestaging'], $user_projects)) $selected = 'selected';
		echo '<option value="'.$project['projects_sitestaging'].'" '.$selected.'>'.$project['projects_sitestaging'].'</option>';
	}
	echo '</select>
	<span id="projects">
	</span>';
}

function adjust_vhosts($vhosts)
{
	$sClient = new SoapClient('http://svn.tgiprojects.com/wsdl/usvnws.wsdl', array('trace' => 1));
	$projects = $sClient->getlist();
	if (in_array('*', $vhosts)) return array('*');
	else if (!in_array('*', $vhosts) && count($vhosts) == count($projects)) return array('*');
	else return $vhosts;
}

function compare_user_data($user1, $user2)
{
	if (isempty($user1['user_password'])) $user2['user_password'] = '';
	$a1 = $user1;
	$a2 = $user1['user_vhost'];
	sort($a2);
	unset($a1['user_vhost']);

	$b1 = $user2;
	$b2 = $user2['user_vhost'];
	sort($b2);
	unset($b1['user_vhost']);

	return array_merge(array_diff_assoc($a1, $b1),array_diff_assoc($a2, $b2),array_diff_assoc($b1, $a1),array_diff_assoc($b2, $a2));
}

function compare_user_admin($user1, $user2)
{
	if (isempty($user1['password'])) $user2['password'] = '';
	if (!isset($user1['admin'])) $user1['admin'] = 0;
	if (!isset($user1['status'])) $user1['status'] = 0;
	return array_merge(array_diff_assoc($user1, $user2), array_diff_assoc($user2, $user1));
}
