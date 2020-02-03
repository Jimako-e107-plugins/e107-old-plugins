<?php

// Generated e107 Plugin Admin Area 

require_once('../../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('aacgc_dltracker',true);

require_once("admin_menu.php");
				
class aacgc_dltracker_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'AACGC Download Tracker';
		protected $pluginName		= 'aacgc_dltracker';
	//	protected $eventName		= 'aacgc_dltracker-'; // remove comment to enable event triggers in admin. 		
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
		

	 	protected $preftabs        = array('General', 'Extra Settings' );
		protected $prefs = array(
			'dltracker_pagetitle'		=> array('title'=> 'Download Tracker Page Title', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
			'dltracker_rendperpage'		=> array('title'=> 'Downloads Per Page', 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
			'dltracker_order'		=> array('title'=> 'Order Downloads By', 'tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'help'=>'', 'writeParms' => array('optArray'=> array('Name/ASC'=>'Name/ASC', 'Name/DESC'=>'Name/DESC', 
			'Times Downloaded/ASC'=>'Times Downloaded/ASC', 'Times Downloaded/DESC'=>'Times Downloaded/DESC'))),
			'dltracker_enable_avatar'		=> array('title'=> 'Show Users Avatar', 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
			'dltracker_avatar_size'		=> array('title'=> 'Avatar Size', 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
			'dltracker_enable_profile'		=> array('title'=> 'Show Downloaded Files In Profiles', 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
			 
			'dltracker_enable_gold'		=> array('title'=> 'Extra Settings: Show Gold Orbs as Usernames: (must have Gold Orbs installed)', 'tab'=>0, 'type'=>'boolean', 'tab'=>1,  'data' => 'str', 'help'=>'', 'writeParms' => array()),



		); 

	
		public function init()
		{
			// This code may be removed once plugin development is complete. 
			if(!e107::isInstalled('aacgc_dltracker'))
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
		
		/*
		// left-panel help menu area. (replaces e_help.php used in old plugins)
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
		*/	
		public function helpPage()
		{
			$ns = e107::getRender();
 
			include('e_help.php');
			$text = '<div class="tab-content"><div class="tab-pane  active">'.$helplink_text['body'].'</div></div>';
			$ns->tablerender('',$text);	
			
		}
		
}
				


class aacgc_dltracker_form_ui extends e_admin_form_ui
{

}		
		
		
new aacgc_dltrackermenu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

