<?php

// Generated e107 Plugin Admin Area 

// see issue https://github.com/e107inc/e107/issues/4056 why this weird name for admin_menu file


require_once('../../../class2.php');

if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('tagcloud', true );
 
 
class leftblock_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
 
	);	

	protected $adminMenu = array(                                                                                
		'config/prefs'		=> array('caption'=> "Preferences", 'perm' => 'P',  'url'=>'admin_config.php'),
		'style/prefs'		=> array('caption'=> "Tag Style", 	'perm' => 'P',  'url'=>'admin_style.php'),
		'maintenance/page'	=> array('caption'=> "Maintenance", 'perm' => 'P',  'url'=>'admin_maintenance.php'),	
		'readme/page'		=> array('caption'=> "Read Me", 	'perm' => 'P',  'url'=>'admin_readme.php'),						
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list',		
	);	
	
	protected $menuTitle = "TagCloud Options";
}