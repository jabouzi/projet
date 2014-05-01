<?php

function get_projects($user_projects)
{
    $sClient = new SoapClient('http://svn.tgiprojects.com/wsdl/usvnws.wsdl', array('trace' => 1));
    $projects = $sClient->getlist();
    echo '<select id="_projects" name="_projects" multiple="multiple"><option value="*">All</option>';
    foreach($projects as $project)
    {
		$selected = '';
		if (in_array($user_projects, $project['projects_sitestaging'])) $selected = 'selected';
        echo '<option value="'.$project['projects_sitestaging'].'" '.$selected.'>'.$project['projects_sitestaging'].'</option>';
    }
    echo '</select>
    <span id="projects">
	</span>';
}
