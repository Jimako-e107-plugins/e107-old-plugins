<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('advanced_bbcodes',true);
// multilanguages
@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");

class advanced_bbcodes_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'advanced_bbcodes_ui',
			'path' 			=> null,
			'ui' 			=> 'advanced_bbcodes_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

		// 'main/div0'      => array('divider'=> true),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P'),
		
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'Advanced BBcodes';
}




				
class advanced_bbcodes_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_ADVANCED_BBCODES_CONFIG;
		protected $pluginName		= 'advanced_bbcodes';
	//	protected $eventName		= 'advanced_bbcodes-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= array (
		);		
		
		protected $fieldpref = array();
		

 	protected $preftabs        = array(LAN_ADVANCED_BBCODES_PREFERENCES, LAN_ADVANCED_BBCODES_PREFS_AFFICHAGE, 'Deprecated' );
  protected $prefs = array(
			'advanced_bbcodes_ligne'		=> array('title'=> LAN_ADVANCED_BBCODES_LIGNE_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_roller'		=> array('title'=> LAN_ADVANCED_BBCODES_ROLLER_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_strike'		=> array('title'=> LAN_ADVANCED_BBCODES_STRIKE_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_hide'		=> array('title'=> LAN_ADVANCED_BBCODES_HIDE_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_gvideo'		=> array('title'=> LAN_ADVANCED_BBCODES_GVIDEO_ADMIN, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
 			'advanced_bbcodes_youtube'		=> array('title'=> LAN_ADVANCED_BBCODES_YOUTUBE_ADMIN, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
 			'advanced_bbcodes_dailymotion'		=> array('title'=> LAN_ADVANCED_BBCODES_DAILYMOTION_ADMIN, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
      'advanced_bbcodes_metacafe'		=> array('title'=> LAN_ADVANCED_BBCODES_METACAFE_ADMIN, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
      'advanced_bbcodes_acronym'		=> array('title'=> LAN_ADVANCED_BBCODES_ACRONYM_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),		
    	'advanced_bbcodes_mplayer'		=> array('title'=> LAN_ADVANCED_BBCODES_MP3_ADMIN, 'tab'=>2, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_parchemin'		=> array('title'=> LAN_ADVANCED_BBCODES_PARCHEMIN_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_spoiler'		=> array('title'=> LAN_ADVANCED_BBCODES_SPOILER_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_toolfaq'		=> array('title'=> LAN_ADVANCED_BBCODES_TOOLFAQ_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),	
			'advanced_bbcodes_bukvica'		=> array('title'=>LAN_ADVANCED_BBCODES_BUKVICA_ADMIN, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
								
			'advanced_bbcodes_ligne_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_LIGNE_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_roller_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_ROLLER_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'advanced_bbcodes_strike_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_STRIKE_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			 
			'advanced_bbcodes_hide_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_HIDE_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_gvideo_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_GVIDEO_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'advanced_bbcodes_youtube_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_YOUTUBE_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'advanced_bbcodes_dailymotion_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_DAILYMOTION_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_metacafe_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_METACAFE_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'advanced_bbcodes_mplayer_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_MP3_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'advanced_bbcodes_parchemin_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_PARCHEMIN_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),
			'advanced_bbcodes_sp_news'		=> array('title'=> LAN_ADVANCED_BBCODES_PREFS_SPOILER_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),			
			'advanced_bbcodes_toolfaq_news'		=> array('title'=>LAN_ADVANCED_BBCODES_PREFS_TOOLFAQ_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),	
			'advanced_bbcodes_bukvica_news'		=> array('title'=>LAN_ADVANCED_BBCODES_PREFS_BUKVICA_NEWS, 'tab'=>1, 'type'=>'boolean', 'data' => 'str', 'help'=>''),	 		
		); 

	
		public function init()
		{
			// This code may be removed once plugin development is complete. 
			if(!e107::isInstalled('advanced_bbcodes'))
			{
				e107::getMessage()->addWarning("This plugin is not yet installed. Saving and loading of preference or table data will fail.");
			}
			
			// Set drop-down values (if any). 
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
		// left-panel help menu area. (replaces e_help.php used in old plugins)
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
		
	
		
		
	*/
			
}
				


class advanced_bbcodes_form_ui extends e_admin_form_ui
{

}		
		
		
new advanced_bbcodes_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

