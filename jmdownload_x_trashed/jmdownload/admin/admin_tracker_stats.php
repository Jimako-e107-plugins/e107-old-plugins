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
e107::lan('download','download'); // e_PLUGIN.'download/languages/'.e_LANGUAGE.'/download.php'
e107::lan('download', 'admin', true); // e_PLUGIN.'download/languages/'.e_LANGUAGE.'/admin_download.php'
 		
class download_ui extends e_admin_ui
{
	    protected $pluginPrefs		= array();
		protected $pluginTitle ;
		protected $pluginName		= 'jmdownload';
	  	//protected $eventName		= ''; // remove comment to enable event triggers in admin. 		
		protected $table			= 'download';
		protected $pid				= 'download_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     	= true;
		//	protected $batchCopy		= true;

		//	protected $sortField		= 'somefield_order';
		//	protected $sortParent      = 'somefield_parent';
		//	protected $treePrefix      = 'somefield_title';

	 	protected $tabs				= array('Download Info'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
		//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'download_id DESC';
	
		protected $fields 		
		= array (  
		'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 
			'width' => '5%', 
			'thclass' => 'center', 
			'forced' => '1', 
			'class' => 'center', 
			'toggle' => 'e-multiselect', 
			'readParms' =>  array ( ),
			'writeParms' =>  array ( ),
			),
		'download_id' =>   array ( 'title' => LAN_ID, 
			'data' => 'int', 
			'width' => '5%', 
			'help' => '', 
			'readParms' =>  array ( ),
		 	'writeParms' =>  array ( ),
			 'class' => 'left', 
			 'thclass' => 'left', 
		),
		'download_name' =>   array ( 'title' => LAN_TITLE, 
			'type' => 'text', 
			'data' => 'str', 'width' => 'auto', 	
			'inline' => false, 
			'validate' => false, 
			'help' => '', 
			'readParms' =>  array ( ),
          	'writeParms' => array(
				'size' => 'block-level',
				'post' => "<div class='label bg-info'>Unique name, there is unique index for it, so no copy </div>"
			),
		),
		'download_requested' =>   array ( 
			'title' => 'Requested', 
			'type' => 'number', 
			'data' => 'int', 
			'width' => 'auto', 
			'help' => '', 
			'readParms' =>  array ( ),
		), 
		'numbers_week'		 => array (  'title' => 'Last week',  'type' => 'method', 'data' => false,   'nosort'=>true ),
		'numbers_month'		 => array (  'title' => 'Last month',  'type' => 'method', 'data' => false,   'nosort'=>true ),  
		'numbers_all'		 => array (  'title' => 'All records',  'type' => 'method', 
		'data' => false,  'nosort'=>true ),  

		'options' =>   array ( 'title' => LAN_OPTIONS, 
			'type' => 'method', 
			'data' => null, 
			'width' => '10%', 
			'thclass' => 'center last', 
			'class' => 'center last', 
			'forced' => '1', 
			'readParms' =>  array ( ),
			'writeParms' =>  array ( ),
		  ),
 

		);		
		
		protected $fieldpref = array('download_name',  'download_class', 'download_requested');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 

		public function __construct($request, $response, $params = array()) {
			$this->pluginPrefs = e107::getPlugPref('jmdownload');
			$this->pluginTitle = $this->pluginPrefs['dltracker_pagetitle'] ; 
			parent::__construct($request, $response, $params = array());
		}
		
	
		public function init()
		{
			
			$this->perPage	   = $this->pluginPrefs['dltracker_rendperpage']; 
 		
			if ($this->pluginPrefs['dltracker_order'] == "Name/ASC")
			{$order = " download_name ASC ";}
			elseif ($this->pluginPrefs['dltracker_order'] == "Name/DESC")
			{$order = " download_name DESC ";}
			elseif ($this->pluginPrefs['dltracker_order'] == "Times Downloaded/ASC")
			{$order = " download_requested ASC ";}
			elseif ($this->pluginPrefs['dltracker_order'] == "Times Downloaded/DESC")
			{$order = " download_requested DESC ";}
			elseif ($this->pluginPrefs['dltracker_order'] == "")
			{$order = " download_requested DESC ";}
			
			$this->listOrder		= $order;
  
	
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
			$text = 'Shows all downloads on a page with number of times downloaded, click each download to view who and when they download it. <br>
			<b>Requested</b> - value displayed on download page (save for download)
			<br>
			<b>All records</b> - real count of recorded requests for download';

			return array('caption'=>$caption,'text'=> $text);

		}
			
}
 
class download_form_ui extends e_admin_form_ui
{

	
	// Custom Method/Function 
	function download_keywords($curVal,$mode)
	{

		 		
		switch($mode)
		{
			case 'read': // List Page
				return $curVal;
			break;
			
			case 'write': // Edit Page
				return $this->text('download_keywords',$curVal, 255, 'size=large');
			break;
			
			case 'filter':
			case 'batch':
				return  array();
			break;
		}
	}

	public function numbers_week($curVal, $mode) {
		if($mode == "read") {
			$id =   $this->getController()->getListModel()->get('download_id');  
			$menu_pref['top_downloads_period'] = 7;

			$s_date	= time();	
			if (0 > $period) $period = 6;	
 
			$e_date = strtotime(date("Y-m-d", $s_date) . " -1 week");
			$count = $this->get_requests_numbers($id, $e_date, $s_date);
			if($count > 0) return "<span class='badge badge-primary'>".$count."</span>";
    		return $count;
	   }
	}
	public function numbers_month($curVal, $mode) {
		if($mode == "read") {
			$id =   $this->getController()->getListModel()->get('download_id');  
			$menu_pref['top_downloads_period'] = 30;

			$s_date	= time();	# Current time(stamp)
			$e_date = strtotime(date("Y-m-d", $s_date) . " -1 month");
	
			$count = $this->get_requests_numbers($id, $e_date, $s_date );
			if($count > 0) return "<span class='badge badge-primary'>".$count."</span>";
    		return $count;
	   }
	}
	public function numbers_all($curVal, $mode) {
		if($mode == "read") {
			$id =   $this->getController()->getListModel()->get('download_id');  
			$count = $this->get_requests_numbers($id, 0, 0);
			if($count > 0) return "<span class='badge badge-primary'>".$count."</span>";
    		return $count;
	   }
	}

	public function options($parms, $value, $id, $attributes) {
		$download_id = $this->getController()->getListModel()->get('download_id');
		if($attributes['mode'] == 'read')
		{
			$text = "<div class='btn-group'>";
			 
			
			if($download_id != 0)
			{
				$link = "admin_tracker.php?searchquery=&filter_options=download_request_download_id__".$download_id."&mode=admin_tracker&action=list";	
				$text .= "<a href='".$link."' class='btn btn-default' title='Details'>".ADMIN_PAGES_ICON."</a>";   
			}


			$text .= "</div>";
			return $text;
		}

	}

	private function get_requests_numbers($id, $start_day, $end_day) {

		
		$q_date	= "";
		if($start_day > 0 )
		{
			$q_date	= "
			AND
				dr.download_request_datestamp >= {$start_day}
			AND
				dr.download_request_datestamp < {$end_day}";	
		}
		$query	= "
			SELECT COUNT(dr.download_request_id) as download_this_period_count
			FROM #download_requests as dr
			WHERE dr.download_request_download_id = ".$id.$q_date;
		 
		$count = e107::getDb()->retrieve($query);
		
		return $count;
	}


}		
		
		
new leftmenu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>