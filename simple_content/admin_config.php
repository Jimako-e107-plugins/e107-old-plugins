<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('simple_content',true);

   // Required files
   require_once(e_PLUGIN."simple_content/handlers/scontent_class.php");
   require_once(SCONTENTC_HANDLERS_DIR."/scontent_utils.php");
   $SimpleContent = new SimpleContent();
   
class simple_content_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'groups'	=> array(
			'controller' 	=> 'scontent_groups_ui',
			'path' 			=> null,
			'ui' 			=> 'scontent_groups_form_ui',
			'uipath' 		=> null
		),
		

		'cats'	=> array(
			'controller' 	=> 'scontent_cats_ui',
			'path' 			=> null,
			'ui' 			=> 'scontent_cats_form_ui',
			'uipath' 		=> null
		),
		

		'items'	=> array(
			'controller' 	=> 'scontent_items_ui',
			'path' 			=> null,
			'ui' 			=> 'scontent_items_form_ui',
			'uipath' 		=> null
		),
		

		'relationships'	=> array(
			'controller' 	=> 'scontent_relationships_ui',
			'path' 			=> null,
			'ui' 			=> 'scontent_relationships_form_ui',
			'uipath' 		=> null
		),
		
		'prefs'	=> array(
			'controller' 	=> 'scontent_prefs_ui',
			'path' 			=> null,
			'ui' 			=> 'scontent_prefs_form_ui',
			'uipath' 		=> null
		),
	);	
	
 
	protected $adminMenu = array(

  	'items/list'			=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_LIST_10, 'perm' => 'P'),
		'items/create'		=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_ADD_10, 'perm' => 'P'),
	
		'cats/list'			=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_LIST_20, 'perm' => 'P'),
		'cats/create'		=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_ADD_20, 'perm' => 'P'),
		
			
		'groups/list'			=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_LIST_30, 'perm' => 'P'),
		'groups/create'		=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_ADD_30, 'perm' => 'P'),
 

		'relationships/list'			=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_LIST_40, 'perm' => 'P'),
		'relationships/create'		=> array('caption'=> SCONTENT_LAN_ADMIN_MENU_ADD_40, 'perm' => 'P'),
			
		'prefs/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

     "SCONTENTC_ADMIN_PAGE_99" => array("text" => SCONTENT_LAN_ADMIN_MENU_99, "link" => SCONTENTC_ADMIN_PAGE."?99", "form" => false),
 
 

	);   
	
 

	protected $adminMenuAliases = array(
		'groups/edit'	=> 'groups/list'				
	);	
	
	protected $menuTitle = 'SimpleContent';
}




				
class scontent_groups_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'SimpleContent';
		protected $pluginName		= 'simple_content';
	//	protected $eventName		= 'simple_content-scontent_groups'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'scontent_groups';
		protected $pid				= 'scontent_group_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

  	protected $tabs				= array('Basic',LAN_DESCRIPTION); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'scontent_group_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'scontent_group_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_group_icon' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_ICON, 'type' => 'image', 
				'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 
				'readParms'=>'thumb=60&thumb_urlraw=0&thumb_aw=60',
				'writeParms'=>'media=page&glyphs=1&video=1', 
				'class' => 'left', 'thclass' => 'left',  ),

		  'scontent_group_name' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_NAME, 
			'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 
			'writeParms' => array('size'=>'block-level'),  'class' => 'left', 'thclass' => 'left',  ),
 
			'scontent_group_description' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_DESCRIPTION, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),	

		  'scontent_group_start_date' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_START_DATE, 
			'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 
			'writeParms'=>'type=datetime&auto=1', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_group_end_date' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_END_DATE, 
				'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '',   
				'writeParms'=>'type=datetime', 'class' => 'left', 'thclass' => 'left',  'parms' => 'mask=%A %d %B %Y'),
 		  'scontent_group_closed' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_CLOSED, 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_group_view_class' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP_VIEW_CLASS, 
			'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 
			'writeParms' => '', 'inline' => true, 'class' => 'left', 'thclass' => 'left',  ),
 		
	  	'scontent_group_template' => array(
					'title' => SCONTENT_LAN_ADMIN_GROUP_TEMPLATE,
					'type' => 'dropdown',
					'data' => 'str',
					'width' => 'auto',
					'inline' => true,
					'validate' => false,
					'help' => '',
					'readParms' => '',
					'writeParms' => '',
					'class' => 'center',
					'thclass' => 'center',
				),
		 
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 
			'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('scontent_group_name');
 
 		public function init()
		{
 
      global $SimpleContent;
			$templates = $SimpleContent->formatTemplatesDropDown("scontent", $pluginname="simple_content");
 
			$code = array_keys($templates); 
			foreach($templates as $template)
			{
				$this->scontent_group_template[$template[0]] = $template[1];
			}
 
      $this->fields['scontent_group_template']['writeParms']  = $this->scontent_group_template;
      
  
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
}
				


class scontent_groups_form_ui extends e_admin_form_ui
{

}		
		
class scontent_prefs_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'SimpleContent';
		protected $pluginName		 = 'simple_content';
 
	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'simple_content_pagetitle'		=> array('title'=> SCONTENT_LAN_ADMIN_PREFS_PAGE_TITLE, 'tab'=>0, 
			'type'=>'text', 'data' => 'str', 'help'=>SCONTENT_LAN_ADMIN_PREFS_PAGE_TITLE_2),
			'simple_content_separator'		=> array('title'=> SCONTENT_LAN_ADMIN_PREFS_SEPARATOR, 'tab'=>0, 
			'type'=>'text', 'data' => 'str', 'help'=>SCONTENT_LAN_ADMIN_PREFS_SEPARATOR_2),
			'simple_content_view_class'		=> array('title'=> SCONTENT_LAN_ADMIN_PREFS_VIEW_CLASS, 'tab'=>0, 
			'type'=>'userclass', 'data' => 'str', 'help'=>SCONTENT_LAN_ADMIN_PREFS_VIEW_CLASS_2),
			'simple_content_template'		=> array('title'=> SCONTENT_LAN_ADMIN_PREFS_TEMPLATE, 'tab'=>0, 
			'type'=>'dropdown', 'data' => 'str', 'help'=>SCONTENT_LAN_ADMIN_PREFS_TEMPLATE_2),
			'scontent_allow_homepage'		=> array('title'=> SCONTENT_LAN_ADMIN_PREFS_ALLOW_HOME_PAGE, 'tab'=>0, 
			'type'=>'checkbox', 'data' => 'str', 'help'=>SCONTENT_LAN_ADMIN_PREFS_ALLOW_HOME_PAGE_2),
			'scontent_force_cache'		=> array('title'=> SCONTENT_LAN_ADMIN_PREFS_CACHE, 'tab'=>0, 
			'type'=>'checkbox', 'data' => 'str', 'help'=>SCONTENT_LAN_ADMIN_PREFS_CACHE_2),

		);

	
		public function init()
		{
 
      global $SimpleContent;
			$templates = $SimpleContent->formatTemplatesDropDown("scontent", $pluginname="simple_content");
			$code = array_keys($templates); 
			foreach($templates as $template)
			{
				$this->simple_content_template[$template[0]] = $template[1];
			}
			//print_a($this->simple_content_template);
      $this->prefs['simple_content_template']['writeParms']['optArray'] = $this->simple_content_template;
       
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
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
			
}
				


class scontent_prefs_form_ui extends e_admin_form_ui
{

}	

				
class scontent_cats_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'SimpleContent';
		protected $pluginName		= 'simple_content';
	//	protected $eventName		= 'simple_content-scontent_cats'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'scontent_cats';
		protected $pid				= 'scontent_cat_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	 	protected $tabs				= array('Basic','Fields'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'scontent_cat_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null,  
			'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'scontent_cat_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_cat_icon' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_ICON, 'type' => 'image', 
				'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 
				'readParms'=>'thumb=60&thumb_urlraw=0&thumb_aw=60',
				'writeParms'=>'media=page&glyphs=1&video=1', 
				'class' => 'left', 'thclass' => 'left',  ),
			'scontent_cat_name' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_NAME, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_cat_description' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_DESCRIPTION, 'type' => 'bbarea', 
					'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 
					'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_cat_group_id' =>   array ( 'title' => SCONTENT_LAN_ADMIN_GROUP, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

		  'scontent_cat_start_date' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_START_DATE, 
			'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 
			'writeParms'=>'type=datetime&auto=1', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_cat_end_date' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_END_DATE, 
				'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '',   
				'writeParms'=>'type=datetime', 'class' => 'left', 'thclass' => 'left',  'parms' => 'mask=%A %d %B %Y'),
		  'scontent_cat_closed' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_CLOSED, 
				'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 
				'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_cat_view_class' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_VIEW_CLASS, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_cat_label_f1' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F1, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_cat_label_f2' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F2, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),				
			'scontent_cat_label_f3' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F3, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),		
			'scontent_cat_label_f4' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F4, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),	
			'scontent_cat_label_f5' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F5, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_cat_label_f6' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F6, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),										
			'scontent_cat_label_f7' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F7, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),	
			'scontent_cat_label_f8' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F8, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),	
			'scontent_cat_label_f9' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY_LABEL_F9, 'type' => 'text', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1, 
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),								
								
			'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('scontent_cat_icon','scontent_cat_name','scontent_cat_group_id','scontent_cat_closed');
		
	
		public function init()
		{
				// Set drop-down values (if any). 
			$sql = e107::getDb();
			// debtor
			$this->scontent_cat_group_id[0] = LAN_SELECT;
			if($sql->select('scontent_groups'))
			{
				while ($row = $sql->fetch())
				{
					$this->scontent_cat_group_id[$row['scontent_group_id']] = $row['scontent_group_name'];
				}
			}
			$this->fields['scontent_cat_group_id']['writeParms'] = $this->scontent_cat_group_id;
				
		}
 		
}
				


class scontent_cats_form_ui extends e_admin_form_ui
{

}		
		

				
class scontent_items_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'SimpleContent';
		protected $pluginName		= 'simple_content';
	//	protected $eventName		= 'simple_content-scontent_items'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'scontent_items';
		protected $pid				= 'scontent_item_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	 	protected $tabs				= array('Basic','Fields'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'scontent_item_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'scontent_item_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_item_name' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_NAME, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_item_cat_id' =>   array ( 'title' => SCONTENT_LAN_ADMIN_CATEGORY, 'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_item_last_updated' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_LASTUPDATE, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => array('readonly'=>1), 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_item_f1' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F1, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_item_f2' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F2, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_item_f3' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F3, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),				
			'scontent_item_f4' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F4, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),			
			'scontent_item_f5' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F5, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),				
			'scontent_item_f6' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F6, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
			'scontent_item_f7' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F7, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),				
			'scontent_item_f8' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F8, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),				
			'scontent_item_f9' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_F9, 'type' => 'bbarea', 
				'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '',  'tab' => 1,
				'writeParms' => array('size'=>'block-level'), 'class' => 'left', 'thclass' => 'left',  ),
					
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('scontent_item_name','scontent_item_cat_id','scontent_item_last_updated');
		
	
		public function init()
		{
				// Set drop-down values (if any). 
				$sql = e107::getDb();
				// debtor
				$this->scontent_item_cat_id[0] = LAN_SELECT;
				if($sql->select('scontent_cats'))
				{
					while ($row = $sql->fetch())
					{
						$this->scontent_item_cat_id[$row['scontent_cat_id']] = $row['scontent_cat_name'];
					}
				}
				$this->fields['scontent_item_cat_id']['writeParms'] = $this->scontent_item_cat_id; 
	
		}
 
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
	    // do something	
			global $SimpleContent;
			$new_data['scontent_item_last_updated'] = $SimpleContent->getCurrentDatestamp();
			return $new_data;		
			 
		}
 		
}
				


class scontent_items_form_ui extends e_admin_form_ui
{

}		
		

				
class scontent_relationships_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'SimpleContent';
		protected $pluginName		= 'simple_content';
	//	protected $eventName		= 'simple_content-scontent_relationships'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'scontent_relationships';
		protected $pid				= 'scontent_rel_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'scontent_rel_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'scontent_rel_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_rel_name' =>   array ( 'title' => SCONTENT_LAN_ADMIN_REL_NAME, 
			'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 
			'writeParms' => '', 'validate' => true, 'class' => 'left', 'thclass' => 'left',  ),
		  		  
			'scontent_rel_parent_item_id' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_PARENT, 
			'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '',  'validate' => true,
			'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'scontent_rel_child_item_id' =>   array ( 'title' => SCONTENT_LAN_ADMIN_ITEM_CHILD, 
			'type' => 'dropdown', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '',   'validate' => true,
			'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

		  'scontent_rel_description' =>   array ( 'title' => 'SCONTENT_LAN_ADMIN_REL_DESCRIPTION', 
			'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('scontent_rel_name');
		
	
		public function init()
		{
	    // Set drop-down values (if any). 
				$sql = e107::getDb();
				// debtor
				$this->scontent_rel_item_id[0] = LAN_SELECT;
				if($sql->select('scontent_items'))
				{
					while ($row = $sql->fetch())
					{
						$this->scontent_rel_item_id[$row['scontent_item_id']] = $row['scontent_item_name'];
					}
				}
				$this->fields['scontent_rel_parent_item_id']['writeParms'] = $this->scontent_rel_item_id;
				$this->fields['scontent_rel_child_item_id']['writeParms'] = $this->scontent_rel_item_id;			
		}
 
}
				


class scontent_relationships_form_ui extends e_admin_form_ui
{

}		
		
		
new simple_content_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>