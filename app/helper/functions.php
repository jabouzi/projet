<?php

function get_projects()
{
    $sClient = new SoapClient('http://svn.tgiprojects.com/wsdl/usvnws.wsdl', array('trace' => 1));
    $projects = $sClient->getlist();
    var_dump($projects);
    //echo '<select id="projects" name="projects"><option value="*">All</option>';
    //foreach($projects as $project)
    //{
        //$selected = '';
        //if ($id == $project['code_c']) $selected = 'selected';
        //echo '<option value="'.$project['code_c'].'" '.$selected.' >'.ucfirst(strtolower($project['nom_legal'])).'</option>';
    //}
    //echo '</select>';
}
