<?php

function get_projects($user_projects = array())
{
    $sClient = new SoapClient('http://svn.tgiprojects.com/wsdl/usvnws.wsdl', array('trace' => 1));
    $projects = $sClient->getlist();
    $selected = '';
    if (in_array('*', $user_projects)) $selected = 'selected'; 
    echo '<select id="_projects" name="_projects[]" multiple="multiple"><option value="*" '.$selected.'>All</option>';
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
