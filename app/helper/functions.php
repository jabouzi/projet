<?php

function get_projects()
{
    $sClient = new SoapClient('http://svn.tgiprojects.com/wsdl/usvnws.wsdl', array('trace' => 1));
    $projects = $sClient->getlist();
    echo '<select id="_projects" name="projects"><option value="*">All</option>';
    foreach($projects as $project)
    {
        echo '<option value="'.$project['projects_sitestaging'].'">'.$project['projects_sitestaging']).'</option>';
    }
    echo '</select>
    <span id="projects">
	</span>';
}
