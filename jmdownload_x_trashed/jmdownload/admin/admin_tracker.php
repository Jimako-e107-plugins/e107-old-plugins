<?php

// Generated e107 Plugin Admin Area 

require_once('../../../class2.php');

if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('aacgc_dltracker',true);
require_once("admin_leftmenu.php");
 
				
class download_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_JMD_LATEST_DOWNLOADS_03;
		protected $pluginName		= 'jmdownload';
	//	protected $eventName		= 'aacgc_dltracker-download_requests'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'download_requests';
		protected $pid				= 'download_request_id';
		protected $perPage			= 40; 
		protected $batchDelete		= false;
		protected $batchExport     = false;
		protected $batchCopy		= false;

	 	protected $sortField		= 'download_request_datestamp';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'download_request_id DESC';
	
		protected $fields 		= array (
			'checkboxes'              => array (  'title' => '',  'type' => null,  'data' => null,  'width' => '5%',  'thclass' => 'center',  'forced' => true,  'class' => 'center',  'toggle' => 'e-multiselect',  'readParms' =>  array (),  'writeParms' =>  array (),),
			'download_request_id'     => array (  'title' => LAN_ID,  'data' => 'int',  'width' => '5%',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left', ),
			'download_request_userid' => array (  'title' => 'Downloaded by',  'type' => 'user',  'data' => 'int',  'width' => 'auto',  'help' => '',  'filter' => true, 'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			'download_request_ip'     => array (  'title' => LAN_IP,  'type' => 'ip',  'data' => 'int',  'width' => 'auto',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			'download_request_download_id'=> array (  'title' => LAN_DOWNLOAD,  'type' => 'dropdown',  'data' => 'int',  'width' => 'auto',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',  'filter' => true,  'batch' => false,),
			'download_request_datestamp'=> array (  'title' => LAN_DATESTAMP,  'type' => 'datestamp',  'data' => 'int',  'width' => 'auto',  'filter' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			'options'                 => array (  'title' => LAN_OPTIONS,  'type' => null,  'data' => null,  'width' => '10%',  'thclass' => 'center last',  'class' => 'center last',  'forced' => true,  'readParms' =>  array (),  'writeParms' =>  array (),),
		);		
		
		protected $fieldpref = array('download_request_id', 'download_request_userid', 'download_request_download_id', 'download_request_ip', 'download_request_datestamp');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'dltracker_rendperpage'		=> array('title'=> 'Downloads Per Page', 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>'', 'writeParms' => array()),
			'dltracker_pagetitle'		=> array('title'=> 'Download Tracker Page Title', 
			'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'', 
			'writeParms' => array('size'=>'block-level', 'default'=>'Download Tracker Page',
			'help'=>'Download Tracker Page Title')),
			'dltracker_order'		=> array('title'=> 'Order Downloads By', 'tab'=>0, 
				'type'=>'dropdown', 'data' => 'str', 'help'=> 'Not important anymore for admin area' , 
            'writeParms' => array(
				'optArray'=> array('Name/ASC'=>'Name/ASC', 'Name/DESC'=>'Name/DESC', 
			'Times Downloaded/ASC'=>'Times Downloaded/ASC', 
			'Times Downloaded/DESC'=>'Times Downloaded/DESC'),
		    )),
		); 

		public function __construct($request, $response, $params = array()) {
			$this->pluginPrefs = e107::getPlugPref('jmdownload');
			$this->pluginTitle = $this->pluginPrefs['dltracker_pagetitle'] ; 
			parent::__construct($request, $response, $params = array());
		}
		
		public function init()
		{
			$sql = e107::getDb();
			// debtor
			$this->downloads[0] = 'Nothing available';   
			if($records = $sql->retrieve('download', '*', null, true))
			{
				foreach($records as $row )
				{
					$this->downloads[$row['download_id']] = $row['download_name'];
				}
			}
			$this->fields['download_request_download_id']['writeParms']['optArray'] = $this->downloads;
	
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
	
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Shows all recorded downloads as they are. ';

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

