<?php

// Generated e107 Plugin Admin Area 

require_once('../../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('jm_download',true);

require_once("admin_leftmenu.php");
 
class download_ui extends e_admin_ui
{			
		protected $pluginTitle		= LAN_JMD_LATEST_DOWNLOADS_03;
		protected $pluginName		= 'jmdownload';
		//	protected $eventName		= 'jm_download-'; // remove comment to enable event triggers in admin.	
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
	
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		

		//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'menus_amount'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_22, 
							'tab'=>0, 
							'type'=>'number', 
							'data' => 'int', 
							'help'=>LAN_JMD_HELP_LAN_02,
							'writeParms' => array('default'=>5)
			),
			'menus_author'		=> 	 array('title'=>LAN_JMD_LATEST_DOWNLOADS_27,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_06,		
			), 
			'menus_category'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_47,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>'If set ON,  download category will be displayed in Latest menu'
			),

			'menus_size'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_26,
			  				'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_12
			),
			'menus_count'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_28,
			  				'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_14
			),
			'menus_description'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_18,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'str',
							'help'=>LAN_JMD_HELP_LAN_08
			  ),
			'menus_usepagebreak'		=> array('title'=> 'Use pagebreak', 
							'tab'=>0, 
							'type'=>'boolean', 
							'data' => 'int', 
							'help'=>'Use pagebreak to separate summary',
							'writeParms' => array('default'=>1)
			),
			'menus_maxchars'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_21, 
							'tab'=>0, 
							'type'=>'number', 
							'data' => 'int', 
							'help'=>LAN_JMD_HELP_LAN_04,
							'writeParms' => array('default'=>0)
			),
			'menus_readmore'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_06, 
							'tab'=>0, 
							'type'=>'boolean', 
							'data' => 'int', 
							'help'=>LAN_JMD_LATEST_DOWNLOADS_07,
							'writeParms' => array('default'=>1)
			),
			'menus_adminlink'		=> array('title'=> LAN_JMD_LATEST_DOWNLOADS_04,
							'tab'=>0,
							'type'=>'boolean',
							'data' => 'int',
							'help'=>LAN_JMD_LATEST_DOWNLOADS_05
			)
		); 
	
	 
		// left-panel help menu area. 
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Settings that can be changed in Menu Manager: '."<br>";
			$text .= LAN_JMD_HELP_LAN_01."<br>";
			$text .= LAN_JMD_HELP_LAN_23."<br>";
			$text .= LAN_JMD_HELP_LAN_24."<br>";
			$text .= "<hr>";
			$text .= "Available menus: <br>";
			$text .= "Latest Downloads Menu <br>";
			$text .= "Top Downloads Menu <br>";
			$text .= "<hr>";
			$text .= "All settings could be replaced by used template <br>";

			return array('caption'=>$caption,'text'=> $text);

		}	
}		

class download_form_ui extends e_admin_form_ui
{

}		
			
new leftmenu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>