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
		protected $pluginTitle		= 'JM Downloads';
		protected $pluginName		= 'jm_download';
	  	protected $eventName		= 'download'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'download';
		protected $pid				= 'download_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
        protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	 	protected $tabs				= array('Download Info'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'download_id DESC';
	
		protected $fields 		= array (  
			'checkboxes' =>   array ( 
				'title' => '', 
				'type' => null, 
				'data' => null, 
				'width' => '5%', 
				'thclass' => 'center', 
				'forced' => '1', 
				'class' => 'center', 
				'toggle' => 'e-multiselect', 
				'readParms' =>  array ( ),
		 		'writeParms' =>  array ( ),
		  ),
		  'download_id' =>   array ( 
				'title' => LAN_ID, 
				'data' => 'int', 
				'width' => '5%',
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( ) 
			),
          	'download_name' =>   array ( 
				'title' => LAN_TITLE,
				'type' => 'text', 
				'data' => 'str', 
				'inline' => true, 
				'validate' => true, 
				'help' => 'Unique name, there is unique index for it, so no copy', 
				'readParms' =>  array ( ),
          		'writeParms' => array(
					'size' => 'block-level')
				), 
          	'download_url' =>   array ( 
				'title' => DOWLAN_13, 
				'type' => 'url', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => 'Internal or external URL', 
				'readParms' =>  array ( ),
          		'writeParms' => array(
				'size' => 'block-level') 
			),
		  	'download_sef' =>   array ( 
				'title' => 'Sef', 
				'type' => 'text', 
				'data' => 'str', 
				'width' => 'auto', 
				'inline' => true, 
				'help' => ''),
		  	'download_author' =>   array ( 
				'title' => LAN_AUTHOR, 
				'type' => 'text', 
				'data' => 'str', 
				'filter' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_author_email' =>   array ( 
				'title' => LAN_EMAIL, 
				'type' => 'email', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
		 		'writeParms' =>  array ( )
		   	),
		  	'download_author_website' =>   array ( 
				'title' => LAN_URL, 
				'type' => 'url', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
		 		'writeParms' =>  array ( )
		   	),
		  	'download_description' =>   array ( 
				'title' => LAN_DESCRIPTION, 
				'type' => 'bbarea', 
				'data' => 'str', 
				'width' => '40%', 
				'help' => '',
			 	'readParms' =>  array ( ),
			 	'writeParms' => array(
            		'size' => 'block-level',
				 )  
			),
		  	'download_keywords' =>   array ( 
				'title' => 'Keywords', 
				'type' => 'tags', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( ) 
			),
		  	'download_filesize' =>   array ( 
				'title' => 'Filesize', 
				'type' => 'text', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_requested' =>   array ( 
				'title' => 'Requested', 
				'type' => 'number', 
				'data' => 'int', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( ) 
			),
		  	'download_category' =>   array ( 
				'title' => LAN_CATEGORY, 
				'type' => 'dropdown', 
				'data' => 'int', 
				'width' => 'auto', 
				'batch' => true, 
				'filter' => true, 
				'inline' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_active' =>   array ( 
				'title' => 'Active', 
				'type' => 'boolean', 
				'data' => 'int', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array ( ),
				 'writeParms' =>  array ( )
			),
		  	'download_datestamp' =>   array ( 
				'title' => LAN_DATESTAMP, 
				'type' => 'datestamp', 
				'data' => 'int', 
				'width' => 'auto', 
				'filter' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				'writeParms' =>  array ( ),
			),
		  	'download_thumb' =>   array ( 
				'title' => 'Thumb image', 
				'type' => 'image', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' => 'thumb=80x80', 
				'writeParms' =>  array ( ),
				'class' => 'left', 
				'thclass' => 'left',  ),
		  	'download_image' =>   array ( 
				'title' => 'Download image' , 
				'type' => 'image', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' => 'thumb=80x80', 
				'writeParms' =>  array ( )
			),
		  	'download_comment' =>   array ( 
				'title' => 'Comment', 
				'type' => 'boolean', 
				'data' => 'int', 
				'help' => '', 
				'readParms' =>  array ( ),
				'writeParms' =>  array ( )
			),
		  	'download_class' =>   array ( 
				'title' => LAN_USERCLASS, 
				'type' => 'userclass', 
				'data' => 'str', 
				'width' => 'auto', 
				'batch' => true, 
				'filter' => true, 
				'inline' => true, 
				'help' => '', 
				'readParms' =>  array ( ),
				'writeParms' =>  array ( ) 
			),
 		  	'download_visible' => array ( 
				'title' => 'Visible', 
				'type' => 'userclass', 
				'data' => 'str', 
				'width' => 'auto', 
				'help' => '', 
				'readParms' =>  array(),
				'writeParms' =>  array()
			),
		  'options' =>   array ( 
			  'title' => LAN_OPTIONS, 
			  'type' => null, 
			  'data' => null, 
			  'width' => '10%', 
			  'thclass' => 'center last',
          	'noselector'=>false, 'class' => 'center last', 'forced' => '1', 'readParms' =>  array ( ),
		 'writeParms' =>  array ( ),
		  ),
		);		
		
		protected $fieldpref = array('download_name', 'download_url', 'download_category', 'download_active', 'download_datestamp', 'download_class');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 

	
		public function init()
		{
            
            $sql = e107::getDb();
            if($sql->select('download_category'))
            {
                while ($row = $sql->fetch())
                {
                    $this->download_category[$row['download_category_id']] = $row['download_category_name'];
                }
            }
           

            $this->fields['download_category']['writeParms']['optArray'] = $this->download_category;

            // Set drop-down values (if any). 
			$this->fields['download_active']['writeParms']['optArray'] = array('download_active_0','download_active_1', 'download_active_2'); // Example Drop-down array. 
  
	
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
		
		// left-panel help menu area. 
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = '<b>Warning!</b> <br>Not upload files here. Use core Download plugin. This is just overview for checking saved data. ';

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

}		
		
		
new leftmenu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>