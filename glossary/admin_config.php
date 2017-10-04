<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('glossary','admin',true);
e107::lan('glossary','help',true);
e107::lan('glossary','class',true);

class glossary_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'glossary_ui',
			'path' 			=> null,
			'ui' 			=> 'glossary_form_ui',
			'uipath' 		=> null
		),
		'submitted'	=> array(
			'controller' 	=> 'glossary_submitted_ui',
			'path' 			=> null,
			'ui' 			=> 'glossary_submitted_form_ui',
			'uipath' 		=> null
		),
		'general'	=> array(
			'controller' 	=> 'glossary_general_ui',
			'path' 			=> null,
			'ui' 			=> 'glossary_general_form_ui',
			'uipath' 		=> null
		),
		'page'	=> array(
			'controller' 	=> 'glossary_page_ui',
			'path' 			=> null,
			'ui' 			=> 'glossary_page_form_ui',
			'uipath' 		=> null
		),
		'menu'	=> array(
			'controller' 	=> 'glossary_menu_ui',
			'path' 			=> null,
			'ui' 			=> 'glossary_menu_form_ui',
			'uipath' 		=> null
		),		

	);	
	
	protected $adminMenu = array(
		'main/list'			 => array('caption'=> LAN_GLOSSARY_MENU_02, 'perm' => 'P'),
		'main/create'		 => array('caption'=> LAN_GLOSSARY_MENU_03, 'perm' => 'P'),
		'submitted/list' => array('caption'=> LAN_GLOSSARY_MENU_04, 'perm' => 'P'),
		'opt1'           => array('header'=> LAN_GLOSSARY_MENU_10),

		'general/prefs'			=> array('caption'=> LAN_GLOSSARY_MENU_11, 'perm' => 'P'),
		'page/prefs'			=> array('caption'=> LAN_GLOSSARY_MENU_12, 'perm' => 'P'),
		'menu/prefs'			=> array('caption'=> LAN_GLOSSARY_MENU_13, 'perm' => 'P'),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'Glossary';

  function init (){
  
//		protected $listQry      	= "SELECT * FROM `#glossary` WHERE glo_approved = '' "; //   
//    var_dump (e107::getDb()->count("glossary", "(*)", "glo_approved = ''"));  
//    var_dump ($this->adminMenu['submitted/list']['caption']);  
    $this->adminMenu['submitted/list']['caption'] .= " (".e107::getDb()->count("glossary", "(*)", "glo_approved = ''").")";
  }
}

class glossary_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Glossary';
		protected $pluginName		= 'glossary';
	//	protected $eventName		= 'glossary-glossary'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'glossary';
		protected $pid				= 'glo_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
		protected $listQry      	= "SELECT * FROM `#glossary` WHERE glo_approved != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'glo_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'glo_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_name' =>   array ( 'title' => LAN_GLOSSARY_CREATEWORD_03, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_description' =>   array ( 'title' => LAN_GLOSSARY_CREATEWORD_04, 'type' => 'textarea', 'data' => 'str', 'width' => '40%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_author' =>   array ( 'title' => LAN_GLOSSARY_SHOWWORD_08, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_datestamp' =>   array ( 'title' => LAN_DATESTAMP, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'filter' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_approved' =>   array ( 'title' => 'Approved', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'glo_linked' =>   array ( 'title' => LAN_GLOSSARY_CREATEWORD_07, 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('glo_name', 'glo_description', 'glo_author', 'glo_datestamp');

	//	protected $preftabs        = array('General', 'Other' );
//		protected $prefs = array(
//		); 
//public $postFiliterMarkup = '';
	
		public function init()
		{
			// Set drop-down values (if any). 
    require_once(e_PLUGIN.'glossary/glossary_class.php');
    $gc = new glossary_class();
    
//    var_dump($gc);
    $this->postFiliterMarkup = $gc->show_letter(1);

		$tp = e107::getParser();
    $letter = (isset($_GET['letter']) ? $_GET['letter'] : "");
		if ($letter != "" && $letter != LAN_GLOSSARY_SHOWLETT_02 )
			$this->listQry .= " AND glo_name LIKE '".$tp->toDB($letter)."%' ";

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
				
class glossary_form_ui extends e_admin_form_ui
{

}		


class glossary_submitted_ui extends glossary_ui
{
	protected $listQry      	= "SELECT * FROM `#glossary` WHERE glo_approved = '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	public function init()
	{
			// Set drop-down values (if any). 
    require_once(e_PLUGIN.'glossary/glossary_class.php');
    $gc = new glossary_class();
    
//    var_dump($gc);
    $this->postFiliterMarkup = $gc->show_letter(0);

//    var_dump($_POST);
//    var_dump($_GET);
    $tp = e107::getParser();
		$letter = (isset($_GET['letter']) ? $_GET['letter'] : "");
		if ($letter != "" && $letter != LAN_GLOSSARY_SHOWLETT_02 )
			$this->listQry .= " AND glo_name LIKE '".$tp->toDB($letter)."%' ";
  }
}		

class glossary_general_ui extends e_admin_ui
{
		protected $pluginTitle		= 'Glossary';
		protected $pluginName		= 'glossary';
	//	protected $eventName		= 'glossary-glossary'; // remove comment to enable event triggers in admin. 		
//		protected $table			= 'glossary';
//		protected $pid				= 'glo_id';
//		protected $perPage			= 10; 
//		protected $batchDelete		= true;
//		protected $batchExport     = true;
//		protected $batchCopy		= true;

// how to set this?  $rs->form_button("submit", "action[saveOptgen]", LAN_GLOSSARY_OPTGEN_02)

  	protected $prefs = array( 
  					'glossary_linkword'  => array('title'=> LAN_GLOSSARY_OPTGEN_05,'type' => 'boolean'),
					  'glossary_submit'  => array('title'=> LAN_GLOSSARY_OPTGEN_07,'type' => 'boolean'),
					  'glossary_submit_class'  => array('title'=> LAN_GLOSSARY_OPTGEN_08, 'type'=>'userclass'),
					  'glossary_submit_directpost'  => array('title'=> LAN_GLOSSARY_OPTGEN_09,'type' => 'boolean'),
					  'glossary_submit_htmlarea'  => array('title'=> LAN_GLOSSARY_OPTGEN_10,'type' => 'boolean'),
            );
}		
		
class glossary_general_form_ui extends e_admin_form_ui
{
}		

class glossary_page_ui extends e_admin_ui
{
		protected $pluginTitle		= 'Glossary';
		protected $pluginName		= 'glossary';
	//	protected $eventName		= 'glossary-glossary'; // remove comment to enable event triggers in admin. 		
//		protected $table			= 'glossary';
//		protected $pid				= 'glo_id';
//		protected $perPage			= 10; 
//		protected $batchDelete		= true;
//		protected $batchExport     = true;
//		protected $batchCopy		= true;

// how to set this?  $rs->form_button("submit", "action[saveOptgen]", LAN_GLOSSARY_OPTGEN_02)
  	protected $prefs = array( 
  					'glossary_page_title'  => array('title'=> LAN_GLOSSARY_OPTPAGE_03,'type' => 'text'),
					  'glossary_page_caption_nav'  => array('title'=> LAN_GLOSSARY_OPTPAGE_04,'type' => 'text'),
					  'glossary_emailprint'  => array('title'=> LAN_GLOSSARY_OPTPAGE_05, 'type'=>'boolean'),
					  'glossary_page_link_submit'  => array('title'=> LAN_GLOSSARY_OPTPAGE_06,'type' => 'boolean'),
					  'glossary_page_link_rendertype'  => array('title'=> LAN_GLOSSARY_OPTPAGE_07,'type' => 'radio', 'writeParms'=>array('optArray'=>array(0=> LAN_GLOSSARY_OPT_04, 1=> LAN_GLOSSARY_OPT_03))),
            );

}		
		
class glossary_page_form_ui extends e_admin_form_ui
{

}		

class glossary_menu_ui extends e_admin_ui
{
		protected $pluginTitle		= 'Glossary';
		protected $pluginName		= 'glossary';
	//	protected $eventName		= 'glossary-glossary'; // remove comment to enable event triggers in admin. 		
//		protected $table			= 'glossary';
//		protected $pid				= 'glo_id';
//		protected $perPage			= 10; 
//		protected $batchDelete		= true;
//		protected $batchExport     = true;
//		protected $batchCopy		= true;

// how to set this?  $rs->form_button("submit", "action[saveOptgen]", LAN_GLOSSARY_OPTGEN_02)

  	protected $prefs = array( 
  					'glossary_menu_caption'  => array('title'=> LAN_GLOSSARY_OPTMENU_04,'type' => 'text'),
					  'glossary_menu_caption_nav'  => array('title'=> LAN_GLOSSARY_OPTMENU_05,'type' => 'text'),
					  'glossary_menu_link_frontpage'  => array('title'=> LAN_GLOSSARY_OPTMENU_06, 'type'=>'boolean'),
					  'glossary_menu_link_submit'  => array('title'=> LAN_GLOSSARY_OPTMENU_07,'type' => 'boolean'),
					  'glossary_menu_link_rendertype'  => array('title'=> LAN_GLOSSARY_OPTMENU_08,'type' => 'radio', 'writeParms'=>array('optArray'=>array(0=> LAN_GLOSSARY_OPT_04, 1=> LAN_GLOSSARY_OPT_03))),
					  'glossary_menu_lastword'  => array('title'=> LAN_GLOSSARY_OPTMENU_09,'type' => 'radio', 'writeParms'=>array('optArray'=>array(0=> LAN_GLOSSARY_OPTMENU_11, 1=> LAN_GLOSSARY_OPTMENU_10))),
					  'glossary_menu_number'  => array('title'=> LAN_GLOSSARY_OPTMENU_12,'type' => 'text'),
            );


}		
		
class glossary_menu_form_ui extends e_admin_form_ui
{

}		

new glossary_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>