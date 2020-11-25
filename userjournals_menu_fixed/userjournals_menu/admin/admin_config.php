<?php

// Generated e107 Plugin Admin Area 

require_once('../../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('userjournals_menu',true);
 
require_once 'admin_leftmenu.php';
 
				
class userjournals_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_JOURNAL_A0;
		protected $pluginName		= 'userjournals_menu';
	//	protected $eventName		= 'userjournals_menu-userjournals'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'userjournals';
		protected $pid				= 'userjournals_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
 
	
		protected $listOrder		= 'userjournals_id DESC';
	
		protected $fields 		= array (
			'checkboxes'              => array (  'title' => '',  'type' => null,  'data' => null,  'width' => '5%',  'thclass' => 'center',  'forced' => true,  'class' => 'center',  'toggle' => 'e-multiselect',  'readParms' =>  array (),  'writeParms' =>  array (),),
			'userjournals_id'         => array (  'title' => LAN_ID,  'data' => 'int',  'width' => '5%',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_userid'     => array (  'title' => LAN_AUTHOR,  'type' => 'user',  'data' => 'int',  'width' => 'auto',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_subject'    => array (  'title' => UJ6,  'type' => 'text',  'data' => 'int',  'width' => 'auto',  'inline' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array ('size'=>'block-level'),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_is_published'=> array (  'title' => UJ62,  'type' => 'boolean',  'data' => 'int',  'width' => 'auto',  'batch' => true,  'help' => UJ63,  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_categories' => array (  'title' => 'Categories',  'type' => 'dropdown',  'data' => 'int',  'width' => 'auto',  'batch' => true,  'filter' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			'userjournals_playing'    => array (  'title' => UJ41,  'type' => 'text',  'data' => 'int',  'width' => 'auto',  'help' => UJ64,  'readParms' =>  array (),  'writeParms' =>  array ('size'=>'block-level'),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_mood'       => array (  'title' => UJ42,  'type' => 'dropdown',  'data' => 'int',  'width' => 'auto',  'batch' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',  'filter' => false,),
			
			'userjournals_entry'      => array (  'title' => UJ7,  'type' => 'bbarea',  'data' => 'str',  'width' => 'auto',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_date'       => array (  'title' => UJ96,  'type' => false,    'data' => 'str',  'width' => 'auto',  'filter' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_timestamp'  => array (  'title' => 'Timestamp',  'type' => false,   'data' => 'str',  'width' => 'auto',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			/* 'userjournals_is_comment' => array (  'title' => 'Is Comment',  'type' => 'boolean',  'data' => 'int',  'width' => '40%',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			
			'userjournals_comment_parent'=> array (  'title' => 'Parent',  'type' => 'number',  'data' => 'int',  'width' => 'auto',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			
			'userjournals_is_blog_desc'=> array (  'title' => 'Is Description',  'type' => 'boolean',  'data' => 'int',  'width' => 'auto',  'batch' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			*/


			'options'                 => array (  'title' => LAN_OPTIONS,  'type' => null,  'data' => null,  'width' => '10%',  'thclass' => 'center last',  'class' => 'center last',  'forced' => true,  'readParms' =>  array (),  'writeParms' =>  array (),),
		);		
		
		protected $fieldpref = array('userjournals_id', 'userjournals_userid', 'userjournals_subject', 'userjournals_mood', 'userjournals_date');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'userjournals_active'		=> array('title'=> JOURNAL_A3, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>JOURNAL_A3_P, 'writeParms' => array()),
			
			'userjournals_page_title'		=> array('title'=> JOURNAL_A13, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>JOURNAL_A13_P, 'writeParms' => array()),
			
			'userjournals_menu_title'		=> array('title'=> JOURNAL_A14, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>JOURNAL_A14_P, 'writeParms' => array()),
			
			'userjournals_cat_menu_title'		=> array('title'=> JOURNAL_A29, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>JOURNAL_A29_P, 'writeParms' => array()),
			
			'userjournals_writers'		=> array('title'=> JOURNAL_A11, 'tab'=>0, 'type'=>'userclass', 'data' => 'str', 'help'=>JOURNAL_A11_P, 'writeParms' => array()),
			
			'userjournals_readers'		=> array('title'=> JOURNAL_A12, 'tab'=>0, 'type'=>'userclass', 'data' => 'str', 'help'=>JOURNAL_A12_P, 'writeParms' => array()),

			'userjournals_allowcomments'		=> array('title'=> JOURNAL_A6, 'tab'=>0, 'type'=>'userclass', 'data' => 'str', 'help'=>JOURNAL_A6_P, 'writeParms' => array()),
	 
			'userjournals_allowratings'		=> array('title'=> JOURNAL_A15, 'tab'=>0, 'type'=>'userclass', 'data' => 'str', 'help'=>JOURNAL_A15_P, 'writeParms' => array()),

			'userjournals_len_subject'		=> array('title'=> JOURNAL_A19, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>JOURNAL_A19_P, 'writeParms' => array()),

			'userjournals_len_preview'		=> array('title'=> JOURNAL_A20, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>JOURNAL_A20_P, 'writeParms' => array()),

			'userjournals_recent_entries'		=> array('title'=> JOURNAL_A21, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>JOURNAL_A21_P, 'writeParms' => array()),
	
			'userjournals_bloggers_menu_max'		=> array('title'=> JOURNAL_A31, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>JOURNAL_A31_P, 'writeParms' => array()),

			'userjournals_bloggers_per_page'		=> array('title'=> JOURNAL_A32, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>JOURNAL_A32_P, 'writeParms' => array()),

			'userjournals_blogs_per_page'		=> array('title'=> JOURNAL_A33, 'tab'=>0, 'type'=>'number', 'data' => 'str', 'help'=>JOURNAL_A33_P, 'writeParms' => array()),	
			
			'userjournals_show_rss'		=> array('title'=> JOURNAL_A22, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>JOURNAL_A22_P, 'writeParms' => array()),

			'userjournals_show_playing'		=> array('title'=> JOURNAL_A23, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>JOURNAL_A23_P, 'writeParms' => array()),	

			'userjournals_show_cats'		=> array('title'=>JOURNAL_A25, 'tab'=>0, 'type'=>'dropdown', 
			'data' => 'str', 
			'help'=>JOURNAL_A25_P,  ),	

			'userjournals_template'		=> array('title'=> JOURNAL_A30, 'tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'help'=>JOURNAL_A30_P, 'writeParms' => array()),

			'userjournals_show_mood'		=> array('title'=> JOURNAL_A24, 'tab'=>0, 'type'=>'boolean', 'data' => 'str', 'help'=>JOURNAL_A24_P, 'writeParms' => array()),	

			'userjournals_report_blog'		=> array('title'=> JOURNAL_A34, 'tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'help'=>JOURNAL_A34_P, 'writeParms' => array()),


		); 

		public function __construct($request, $response, $params = array())
		{
			parent::__construct($request, $response, $params = array());
	
			$this->listQry      	= "SELECT * FROM `#".$this->table."` WHERE userjournals_is_blog_desc = '0' ";  
		}
		
		
		public function init()
		{
 
			$this->prefs['userjournals_show_cats']['writeParms']['optArray'] = array(JOURNAL_A25_0,JOURNAL_A25_1,JOURNAL_A25_2); 

			$this->prefs['userjournals_report_blog']['writeParms']['optArray'] = array(	JOURNAL_A34_0,JOURNAL_A34_1,JOURNAL_A34_2,JOURNAL_A34_3);  

			$available_templates = $this->getTemplates();
			foreach($available_templates AS  $available_template) {
				$key = $available_template[0];
				$options[$key] = $available_template[1];
			}
 
			$this->prefs['userjournals_template']['writeParms']['optArray'] = $options;

			$moods = array(
				//''           => UJ68,
				'happy'      => UJ69,
				'sad'        => UJ70,
				'alienated'  => UJ71,
				'beat_up'    => UJ72,
				'angry'      => UJ73,
				'annoyed'    => UJ74,
				'chicken'    => UJ75,
				'confused'   => UJ76,
				'crying'     => UJ77,
				'doh'        => UJ78,
				'evil'       => UJ79,
				'funny'      => UJ80,
				'greedy'     => UJ81,
				'hungry'     => UJ82,
				'puzzled'    => UJ83,
				'innocent'   => UJ84,
				'shocked'    => UJ85,
				'sick'       => UJ86,
				'sleepy'     => UJ87,
				'very_happy' => UJ88,
			 );

			 $this->fields['userjournals_mood']['writeParms']['optArray'] = $moods;

			// Get all categories - we need these all ove rthe place
			$cats[0] = "--";
			if (e107::getDb()->select("userjournals_categories", "*", "WHERE 1 ORDER BY userjournals_cat_name ASC" , true)) {
				while ($row = e107::getDb()->fetch()) { 
				$cats[$row["userjournals_cat_id"]] = $row['userjournals_cat_name'];
				}
			}	
 
			$this->fields['userjournals_categories']['writeParms']['optArray'] = $cats;
		}

		
		function getTemplates() {
			
			$sitetheme = e107::getPref('sitetheme');

			function getTemplatesFromDir($folder, $suffix, $sc_folder) {
			   $templates = array();
			   $handle = opendir($folder);
			   while ($file = readdir($handle)) {
				  $pathinfo = pathinfo($file);
 
				  if ($pathinfo["extension"] == "php") {
					 unset($userjournals_template_name);
					 include($folder.$file);
					 if (isset($userjournals_template_name)) {
						$templates[] = array($sc_folder.$file, $userjournals_template_name.$suffix);
					 } else {
						$templates[] = array($sc_folder.$file, $file.$suffix);
					 }
				  }
			   }
			   closedir($handle);
			   return $templates;
			}
   
			$templates = array_merge(
			   getTemplatesFromDir(e_PLUGIN."userjournals_menu/templates/", UJ99, "{e_PLUGIN}userjournals_menu/templates/"),
			   getTemplatesFromDir(e_THEME.$sitetheme."/templates/userjournals_menu/", UJ100, "{e_THEME}".$sitetheme."/templates/userjournals_menu/")
			);
			asort($templates);
	 
			return $templates;
		 }

		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			$thetime = time();
			$new_data['userjournals_timestamp'] = $thetime;
			$new_data['userjournals_date'] = e107::getDate()->convert_date($thetime, "forum");
				  
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
			
 
		// optional - a custom page.  
		public function readmePage()
		{
			$ns = e107::getRender();

			$text .= "<div style='padding:5px;'>  
			UserJournals 1.1 by bugrain<br>
			<br>
			A plugin for the e107 Website System (http://e107.org)<br>
			<br>
			Released under the terms and conditions of the<br>
			GNU General Public License (http://gnu.org).<br>
			<hr>
			This plugin allows the e107 CMS to support individual journals for
			registered/logged-in users. Each user gets their own journal, and
			can write, edit, and delete their entries. Admin has the option of
			totally disabling User Journals, as well as restricting access to
			logged-in users only.
			<br /><br />
			THIS PLUGIN IS ONLY KNOWN TO WORK WITH e_107 VERSION .6+ and .7!
			<br /><br />
			<u>Features:</u>
			<ul>
			   <li>Individual journals for individual users</li>
			   <li>Journals can be limited to specific users by userclass</li>
			   <li>Journals viewing can be limited by user class</li>
			   <li>Journal entries can be commented on by other</li>
			</ul>
			
			<hr>
			
			<u>Changelog:</u>
			<ul>
			   <li>Please refere to the <a target = '_blank' href='../README.txt'>README.txt</a> file for full change details.
			</ul>
			</div>";
			
			$ns->tablerender(JOURNAL_MENU_99, $text);
			
		}
 
			
}
				


class userjournals_form_ui extends e_admin_form_ui
{

}	


class userjournals_synopsis_ui extends userjournals_ui
{	
		
	public function __construct($request, $response, $params = array())
	{

		parent::__construct($request, $response, $params = array());

		$this->listQry      	= "SELECT * FROM `#".$this->table."` WHERE userjournals_is_blog_desc > '0' ";  
	}

 
}
				
class userjournals_categories_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_JOURNAL_A0;
		protected $pluginName		= 'userjournals_menu';
	//	protected $eventName		= 'userjournals_menu-userjournals_categories'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'userjournals_categories';
		protected $pid				= 'userjournals_cat_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;
 
		protected $listOrder		= 'userjournals_cat_id DESC';
	
		protected $fields 		= array (
			'checkboxes'              => array (  'title' => '',  'type' => null,  'data' => null,  'width' => '5%',  'thclass' => 'center',  'forced' => true,  'class' => 'center',  'toggle' => 'e-multiselect',  'readParms' =>  array (),  'writeParms' =>  array (),),

			'userjournals_cat_id'     => array (  'title' => LAN_ID,  'data' => 'int',  'width' => '5%',  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_cat_icon'   => array (  'title' => JOURNAL_A27,  'type' => 'image',  'data' => 'str',  'width' => 'auto',  'help' => JOURNAL_A27_P,  'readParms' => 'thumb=100x100', 'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),

			'userjournals_cat_name'   => array (  'title' => JOURNAL_A26,  'type' => 'text',  'data' => 'str',  'width' => 'auto',  'inline' => true,  'help' => JOURNAL_A26_P,  'readParms' =>  array (),  array ('size'=>'block-level'),  'class' => 'left',  'thclass' => 'left',),
			
			 
			/*
			'userjournals_cat_parent_id'=> array (  'title' => LAN_PARENT,  'type' => 'dropdown',  'data' => 'int',  'width' => 'auto',  'batch' => true,  'filter' => true,  'help' => '',  'readParms' =>  array (),  'writeParms' =>  array (),  'class' => 'left',  'thclass' => 'left',),
			*/
			'options'                 => array (  'title' => LAN_OPTIONS,  'type' => null,  'data' => null,  'width' => '10%',  'thclass' => 'center last',  'class' => 'center last',  'forced' => true,  'readParms' =>  array (),  'writeParms' =>  array (),),
		);		
		
		protected $fieldpref = array('userjournals_cat_id', 'userjournals_cat_name', 'userjournals_cat_icon');
		
	
		public function init()
		{
 
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
				


class userjournals_categories_form_ui extends e_admin_form_ui
{

}		
		
		
new leftmenu_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

