<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

e107::lan('creative_writer',true);
e107::lan('creative_writer');
//  include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");

class creative_writer_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'cw_prefs_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_prefs_form_ui',
			'uipath' 		=> null
		),
    
		'challenge'	=> array(
			'controller' 	=> 'cw_challenge_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_challenge_form_ui',
			'uipath' 		=> null
		),
		
		'book'	=> array(
			'controller' 	=> 'cw_book_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_book_form_ui',
			'uipath' 		=> null
		),
		
		'category'	=> array(
			'controller' 	=> 'cw_category_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_category_form_ui',
			'uipath' 		=> null
		),
		

		'chapter'	=> array(
			'controller' 	=> 'cw_chapters_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_chapters_form_ui',
			'uipath' 		=> null
		),
		
		'submitted'	=> array(
			'controller' 	=> 'cw_submitted_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_submitted_form_ui',
			'uipath' 		=> null
		),
		
		'genre'	=> array(
			'controller' 	=> 'cw_genre_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_genre_form_ui',
			'uipath' 		=> null
		),
		
 		'characters'	=> array(
			'controller' 	=> 'cw_characters_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_characters_form_ui',
			'uipath' 		=> null
		),
    
		'review'	=> array(
			'controller' 	=> 'cw_review_ui',
			'path' 			=> null,
			'ui' 			=> 'cw_review_form_ui',
			'uipath' 		=> null
		),
 
	);	
	
	
	protected $adminMenu = array(
 		'challenge/list'			=> array('caption'=> LAN_CWRITER_A002, 'perm' => 'P'), 
		'book/list'			=> array('caption'=> CWRITER2_A97, 'perm' => 'P'),

		'chapter/list'			=> array('caption'=> CWRITER2_A99, 'perm' => '0'),
    'submitted/list' => array('caption'=> CWRITER2_A5, 'perm' => 'P'),
		'category/list'			=> array('caption'=> CWRITER_A8, 'perm' => 'P'),
		'genre/list'			=> array('caption'=> CWRITER_A4, 'perm' => 'P'), 
		'characters/list'			=> array('caption'=> CWRITER2_A92, 'perm' => 'P'),   
		'review/list'			=> array('caption'=> CWRITER2_A100, 'perm' => '0'),
    'main/prefs' 		=> array('caption'=> CWRITER_A3, 'perm' => 'P'),
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list',
   	'genre/edit'	=> 'genre/list',    
   	'category/edit'	=> 'category/list',  	
   	'book/edit'	=> 'book/list',
	);	
	
	protected $menuTitle = 'Creative Writer';
	
  function init (){
 
	    $this->adminMenu['submitted/list']['caption'] .= " (".e107::getDb()->count("cw_book", "(*)", "cw_book_approved = ''").")";
	  }
 
}

class cw_challenge_ui extends e_admin_ui
{
			
		protected $pluginTitle		= LAN_CWRITER_A003;
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_challenge'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_challenge';
		protected $pid				= 'cw_challenge_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_challenge_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'cw_challenge_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
      'cw_challenge_name' => array(
      	'title' => LAN_CWRITER_A005,
      	'type' => 'text',
      	'data' => 'str',
      	'width' => 'auto',
      	'inline' => true,
      	'validate' => true,
      	'help' => '',
      	'readParms' => '',
      	'writeParms' => array(
      		'size' => 'block-level'
      	) ,
      	'class' => 'left',
      	'thclass' => 'left',
      ) , 'cw_challenge_summary' => array(
      	'title' => LAN_CWRITER_A006,
      	'type' => 'text',
      	'data' => 'str',
      	'width' => 'auto',
      	'inline' => true,
      	'help' => '',
      	'readParms' => '',
      	'writeParms' => array(
      		'size' => 'block-level'
      	) ,
      	'class' => 'left',
      	'thclass' => 'left',
      ) , 'cw_challenge_desc' => array(
      	'title' => LAN_CWRITER_A007,
      	'type' => 'bbarea',
      	'data' => 'str',
      	'width' => 'auto',
      	'help' => '',
      	'readParms' => '',
      	'writeParms' => '',
      	'class' => 'left',
      	'thclass' => 'left',
      ) , 'cw_challenge_icon' => array(
      	'title' => LAN_CWRITER_A010,
      	'type' => 'image',
      	'data' => 'str',
      	'width' => 'auto',
      	'help' => '',
				'readParms' => 'thumb=0x100',
				'writeParms' => 'media=creative_writer&w=250', 
      	'class' => 'left',
      	'thclass' => 'left',
      ) , 'cw_challenge_starttime' => array(
      	'title' => LAN_CWRITER_A008,
      	'type' => 'datestamp',
      	'data' => 'int',
      	'width' => 'auto',
      	'batch' => true,
      	'inline' => true,
      	'validate' => false,
      	'help' => '',
      	'readParms' => '',
      	'writeParms' => 'type=datetime&auto=1',
      	'class' => 'left',
      	'thclass' => 'left',
      ) , 'cw_challenge_lastupdated' => array(
      	'title' => LAN_CWRITER_A009,
      	'type' => 'datestamp',
      	'data' => 'int',
      	'width' => 'auto',                             
      	'help' => '',
      	'readParms' => '',
      	'writeParms' => 'auto=1&readonly=1',
      	'class' => 'left',
      	'thclass' => 'left',
      ) ,
			'cw_challenge_author' => array(
				'title' => LAN_AUTHOR,
				'type' => 'text',
				'data' => 'str',
				'width' => 'auto', 
        'filter' => true,
				'help' => '',  'tab'=>2,
				'readParms' => '',
				'writeParms' => array('readonly'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_challenge_user_id' => array(
				'title' => LAN_USER,
				'type' => 'user',
				'data' => 'int',
				'width' => 'auto', 
        'filter' => true,
				'help' => '',  'tab'=>2, 
				'class' => 'left',
				'thclass' => 'left',
			) ,
      
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('cw_challenge_id', 'cw_challenge_name', 'cw_challenge_summary', 'cw_challenge_icon', 'cw_challenge_starttime');
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
		); 

	
		public function init()
		{
			// Set drop-down values (if any). 

      
	    $this->postFiliterMarkup = $this->AddButton();
 
	    /* check class */
		}

		function AddButton()
	  {
      $text .= "</fieldset></form><div class='e-container'>
      <table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>";
      $text .=  
      '<a href="admin_config.php?mode=challenge&action=create"  class="btn batch e-hide-if-js btn-primary"><span>'.LAN_CWRITER_A001.'</span></a>';
      $text .= "</td></tr></table></div><form><fieldset>";
      return $text;
    }
		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{    
      $userInfo = e107::user($new_data['cw_challenge_user_id']);
			$userName = $userInfo['user_name'];
      $new_data['cw_challenge_author'] = $new_data['cw_challenge_user_id'].'.'.$userName;
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
      $userInfo = e107::user($new_data['cw_challenge_user_id']);
			$userName = $userInfo['user_name'];
      $new_data['cw_challenge_author'] = $new_data['cw_challenge_user_id'].'.'.$userName;
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
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
				
		/**
		 *
		 * @return TBD
		 */
		public function CreatePage()
		{
		  /* check access */
		  $pref = e107::pref('creative_writer');
	    $userclass = e107::getUserClass()->getName($pref['cwriter_challenge']); 			
			if (!check_class($pref['cwriter_challenge']))
			{    
			    e107::getMessage()->add("
					You are not permitted to add challenges<br>
					Permission [".$pref['cwriter_admin']."] ". $userclass, E_MESSAGE_ERROR);			   
					return  e107::getMessage()->render();
			}
 			e107::getMessage()->add("
					You are permitted to add challenges<br>
					Permission [".$pref['cwriter_admin']."] ". $userclass, E_MESSAGE_INFO);			    
			return  e107::getMessage()->render().$this->getUI()->getCreate();
		}
		
	/**
	 * Generic Edit page
	 * @return string
	 */
	public function EditPage()
	{
		$controller = $this->getUI()->getController();
		$data= $controller->getModel()->getData();
		$pref = e107::pref('creative_writer');
		$userInfo = e107::user($data['cw_challenge_user_id']); 
		$userclass = e107::getUserClass()->getName($pref['cwriter_admin']);
		/* check if you are not main moderator cwriter_admin */
		if (check_class($pref['cwriter_admin']))
		{    
		   e107::getMessage()->add("
					You are permitted to change this challenge, you are Superadmin <br>".
					"Superadmin: [".$pref['cwriter_admin']."] ". $userclass , E_MESSAGE_INFO);
			 return $this->getUI()->getCreate();
		}	
		elseif ($data['cw_challenge_user_id'] == USERID  OR  $data['cw_challenge_user_id'] == 0 )/* check if it's your record or something went wrong */
		{    
		  e107::getMessage()->add("You are not permitted to edit this challenge.<br> 
			Record owner: [".$data['cw_challenge_user_id']."] ".$userInfo['user_name']." <br> 
			Author: ".$data['cw_challenge_author']."<br>"
			."Superadmin: [".$pref['cwriter_admin']."] ". $userclass , E_MESSAGE_INFO);	  
			return $this->getUI()->getCreate();
		}				
		else {
		  $userInfo = e107::user($data['cw_challenge_user_id']); 
			$userclass = e107::getUserClass()->getName($pref['cwriter_admin']); 
		  e107::getMessage()->add("You are not permitted to edit this challenge.<br> 
			Record owner: [".$data['cw_challenge_user_id']."] ".$userInfo['user_name']." <br> 
			Author: ".$data['cw_challenge_author']."<br>"
			."Superadmin: [".$pref['cwriter_admin']."] ". $userclass , E_MESSAGE_ERROR);			   
			return  e107::getMessage()->render();
		}

		
		// return $this->CreatePage();
	}
				
}
				


class cw_challenge_form_ui extends e_admin_form_ui
{

}

class cw_prefs_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
 

	 	protected $preftabs        = array('General', 'Visibility', 'Terminology', 'Pagination', 'Permissions' );
		protected $prefs = array(
			'cwriter_approval'		=> array('title'=> CWRITER_A25, 'tab'=>0, 'type'=>'boolean', 'data' => 'int', 'help'=>''),
			'cwriter_read'		    => array('title'=> CWRITER_A29, 'tab'=>4, 'type'=>'userclass', 'data' => 'str', 'help'=>''),
     	'cwriter_admin'		    => array('title'=> CWRITER_A48, 'tab'=>4, 'type'=>'userclass', 'data' => 'str', 'help'=>''),
     	'cwriter_challenge'		    => array('title'=> LAN_CWRITER_A023, 'tab'=>4, 'type'=>'userclass', 'data' => 'str', 'help'=>''),     	
			'cwriter_create'		  => array('title'=> CWRITER_A28, 'tab'=>4, 'type'=>'userclass', 'data' => 'str', 'help'=>''),
      'cwriter_dformat'		  => array('title'=> CWRITER_A49, 'tab'=>0, 'type'=>'dropdown', 'data' => 'str', 'help'=>''),
		  'cwriter_userating'   => array( 'title' => CWRITER_A50, 'type' => 'boolean', 'data' => 'int',     ),
		  'cwriter_usecomments'      => array( 'title' => CWRITER_A66, 'type' => 'boolean', 'data' => 'int',     ),
		  'cwriter_usereview' => array( 'title' => CWRITER_A66A, 'type' => 'boolean', 'data' => 'int',     ),  
    
		  'cwriter_icons' =>   array( 'title' => CWRITER_A51, 'type' => 'boolean', 'data' => 'int',     ),
		  'cwriter_thumbs' =>   array( 'title' => CWRITER_A52, 'type' => 'boolean', 'data' => 'int',     ),
       
			'cwriter_thumbheight'		=> array('title'=> CWRITER_A53, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>''),    
			'cwriter_pich'		=> array('title'=> CWRITER_A54, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>''),
 			'cwriter_picw'		=> array('title'=> CWRITER_A55, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>''), 
			'cwriter_currency'		=> array('title'=> CWRITER_A56, 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>''),      
			'cwriter_terms'		=> array('title'=> CWRITER_A58, 'tab'=>0, 'type'=>'textarea', 'data' => 'str', 'help'=>''),
 			'cwriter_metad'		=> array('title'=> CWRITER_A59, 'tab'=>0, 'type'=>'textarea', 'data' => 'str', 'help'=>''),
    	'cwriter_metak'		=> array('title'=> CWRITER_A60, 'tab'=>0, 'type'=>'textarea', 'data' => 'str', 'help'=>''),
      
      'cw_visibility_disclaimer'		=> array('title'=> LAN_CW_VISIBILITY_DISCLAIMER, 'tab'=>1, 'type'=>'boolean', 
      'data' => 'int', 'help'=>''),
      'cw_visibility_warnings'		=> array('title'=> LAN_CW_VISIBILITY_WARNINGS, 'tab'=>1, 'type'=>'boolean', 
      'data' => 'int', 'help'=>''),     
      'cw_visibility_logo'		=> array('title'=> LAN_CW_VISIBILITY_LOGO, 'tab'=>1, 'type'=>'boolean', 
      'data' => 'int', 'writeParms' => array('readonly'=> true), 'help'=>''),
      'cw_visibility_series'		=> array('title'=> LAN_CW_VISIBILITY_SERIES, 'tab'=>1, 'type'=>'boolean', 
      'data' => 'int', 'writeParms' => '', 'help'=>''), 
      'cw_visibility_complete'		=> array('title'=> LAN_CW_VISIBILITY_COMPLETE, 'tab'=>1, 'type'=>'boolean', 
      'data' => 'int', 'writeParms' => '', 'help'=>''),			     
      'bookterm_01'		=> array('title'=> 'Term for Books - plural', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),
      'bookterm_02'		=> array('title'=> 'Term for Book - singular', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),    
      'bookterm_03'		=> array('title'=> 'Term for books - plural', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),  
      'bookterm_04'		=> array('title'=> 'Term for book - singular', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),
      'chapterterm_01'		=> array('title'=> 'Term for Chapters - plural', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),
      'chapterterm_02'		=> array('title'=> 'Term for Chapter - singular', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),    
      'chapterterm_03'		=> array('title'=> 'Term for chapters - plural', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),  
      'chapterterm_04'		=> array('title'=> 'Term for chapter - singular', 'tab'=>2, 'type'=>'text', 'data' => 'str', 'help'=>'If this is not enough, use lang files'),     
			
      'cwriter_challengeperpage'  => array('title'=> LAN_CWRITER_A022, 'tab'=>3, 'type'=>'number', 'data' => 'str', 'help'=>''),
			'cwriter_perpage'		=> array('title'=> LAN_CWRITER_A020, 'tab'=>3, 'type'=>'number', 'data' => 'str', 'help'=>''),                
			'cwriter_chapterperpage'		=> array('title'=> LAN_CWRITER_A021, 'tab'=>3, 'type'=>'number', 'data' => 'str', 'help'=>''),        
      
		); 
    /* price didn't work before and frontend logo upload is not fixed */
	
		public function init()
		{
                                                                                                 
			$this->prefs['cwriter_dformat']['writeParms']['optArray'] = array('d-m-Y' =>'d-m-Y','m-d-Y' => 'm-d-Y', 'Y-m-d' =>'Y-m-d'); // Example Drop-down array. 
  

		  
				
		}

	 	public function PrefsPage()
		{

			/* check access */
		  $pref = e107::pref('creative_writer');
	    $userclass = e107::getUserClass()->getName($pref['cwriter_admin']); 			
			if (!check_class($pref['cwriter_admin']))
			{    
			    e107::getMessage()->add("
					You do not have permission <br>
					Permission [".$pref['cwriter_admin']."] ". $userclass, E_MESSAGE_ERROR);			   
					return  e107::getMessage()->render();   
					 
			}
 			e107::getMessage()->add("
					You have permission to see and change preferencies <br>
					Permission [".$pref['cwriter_admin']."] ". $userclass, E_MESSAGE_INFO);			    
			return   $this->getUI()->getSettings();
			
 
		}
		// left-panel help menu area. 
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
 
			
}
				


class cw_prefs_form_ui extends e_admin_form_ui
{

}	

				
class cw_book_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_book'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_book';
		protected $pid				= 'cw_book_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;
    protected $listQry      	= "SELECT * FROM `#cw_book` WHERE cw_book_approved = '1' ";
	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

  	protected $tabs				= array('Basic','Advanced','Other'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_book_id DESC';
	
		protected $fields = array(
			'checkboxes' => array( 				'title' => '', 				'type' => null, 				'data' => null, 				'width' => '5%', 				'thclass' => 'center', 				'forced' => '1', 				'class' => 'center', 				'toggle' => 'e-multiselect', 			) ,
			'cw_book_id' => array( 				'title' => LAN_ID, 				'data' => 'int', 				'width' => '5%', 				'help' => '', 				'readParms' => '', 				'writeParms' => '', 				'class' => 'left', 				'thclass' => 'left', 			) ,
			'cw_book_title' => array( 				   'title' => CWRITER_318, 				'type' => 'text', 				'data' => 'str', 				'width' => 'auto', 				'inline' => true, 				'help' => '', 				'readParms' => '', 				'writeParms' => array('size'=>'block-level'), 				'class' => 'left', 				'thclass' => 'left', 			) ,
			'cw_book_summary' => array( 				'title' => CWRITER2_A86, 				'type' => 'textarea', 				'data' => 'str','tab'=>1, 				'width' => 'auto', 				'inline' => true, 				'help' => '', 				'readParms' => '', 				'writeParms' => array('size'=>'block-level'), 				'class' => 'left', 				'thclass' => 'left', 			) ,
			'cw_book_disclaimer' => array( 			'title' => CWRITER_41, 				'type' => 'textarea', 				'data' => 'str','tab'=>1, 				'width' => 'auto', 				'help' => '', 				'readParms' => '', 				'writeParms' => array('size'=>'block-level'), 				'class' => 'left', 				'thclass' => 'left', 			) ,
			'cw_book_warnings' => array( 				'title' => CWRITER_40, 				'type' => 'textarea', 				'data' => 'str', 'tab'=>1,				'width' => 'auto', 				'help' => '', 				'readParms' => '', 				'writeParms' => array('size'=>'block-level'), 				'class' => 'left', 				'thclass' => 'left', 			) ,
	/*		'cw_book_logo' => array( 'title' => 'Logo', 'type' => 'image', 'data' => 'str', 'tab'=>1, 'width' => 'auto', 'help' => '', 
			'readParms' => 'thumb=0x50', 'writeParms' => 'media=creative_writer&w=600', 'class' => 'left', 'thclass' => 'left', ) , */
			'cw_book_author' => array(
				'title' => LAN_AUTHOR,
				'type' => 'text',
				'data' => 'str',
				'width' => 'auto', 
        'filter' => true,
				'help' => '',  'tab'=>2,
				'readParms' => '',
				'writeParms' => array('readonly'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_user_id' => array(
				'title' => LAN_USER,
				'type' => 'user',
				'data' => 'int',
				'width' => 'auto', 
        'filter' => true,
				'help' => '',  'tab'=>2, 
				'class' => 'left',
				'thclass' => 'left',
			) ,  
			'cw_book_challenge' => array(
				'title' => LAN_CWRITER_A003,
				'type' => 'dropdown',
				'data' => 'int',
				'width' => 'auto',
				'batch' => true,
				'filter' => true,
				'inline' => true,
				'help' => '',
				'readParms' => '',
				'writeParms' => array('required'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,    
			'cw_book_category' => array(
				'title' => CWRITER_A30,
				'type' => 'dropdown',
				'data' => 'int',
				'width' => 'auto',
				'batch' => true,
				'filter' => true,
				'inline' => true,
				'help' => '',
				'readParms' => '',
				'writeParms' => array('required'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_genre' => array(
				'title' => CWRITER_37,
				'type' => 'dropdown',
				'data' => 'int',
				'width' => 'auto',
				'help' => '',
				'readParms' => '',
				'writeParms' => array('required'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_characters' => array(
				'title' => CWRITER_39,
				'type' => 'dropdown',
				'data' => 'str',
				'width' => 'auto',
				'help' => '',
				'readParms'=>array('type'=>'checkboxes'),
				'nosort' => true, 'batch'=>true, 'filter'=>true,
				'class' => 'left',
				'thclass' => 'left',
			) ,

			'cw_book_complete' => array(
				'title' => 'Complete',
				'type' => 'boolean',
				'data' => 'int',
				'width' => 'auto',
				'help' => '',
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_chapters' => array(
				'title' => CWRITER_43,
				'type' => 'text',
				'data' => 'str',
				'width' => 'auto','tab'=>2,
				'help' => '',
				'readParms' => '',
				'writeParms' => array('readonly'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_series' => array(
				'title' => 'Series',
				'type' => 'boolean',
				'data' => 'int',
				'width' => 'auto',
				'help' => '',
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_wordcount' => array(
				'title' => CWRITER_42,
				'type' => 'text',
				'data' => 'int',
				'width' => 'auto',  'tab'=>2,
				'help' => '',
				'readParms' => '',
				'writeParms' => array('readonly'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
 
			'cw_book_views' => array(
				'title' => 'Views',
				'type' => 'number',
				'data' => 'int',
				'width' => 'auto',
				'help' => '', 'tab'=>2,
				'readParms' => array('readonly'=> true),
				'writeParms' => array('readonly'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,

			'cw_book_rate' => array(
				'title' => 'Rate',
				'type' => 'boolean',
				'data' => 'int',
				'width' => 'auto',
				'help' => '', 'batch' => true,
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_review' => array(
				'title' => 'Review',
				'type' => 'boolean',
				'data' => 'int',
				'width' => 'auto',
				'help' => '',  'batch' => true,
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_comments' => array(
				'title' => 'Comments',
				'type' => 'boolean',
				'data' => 'str',
				'width' => '40%',
				'help' => '',  'batch' => true,
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_external' => array(
				'title' => 'External Source',
				'type' => 'boolean',
				'data' => 'int',
				'width' => 'auto',
				'help' => 'Source of chapter is not on this site',
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) ,
			'cw_book_visible' => array( 				'title' => CWRITER_A67, 				'type' => 'boolean', 				'data' => 'int', 				'width' => 'auto', 				'help' => '', 				'readParms' => '', 				'writeParms' => '', 				'class' => 'left', 				'thclass' => 'left', 			) ,
			'cw_book_approved' => array( 				'title' => CWRITER_A68, 				'type' => 'boolean', 				'data' => 'int', 				'width' => 'auto', 				'help' => '', 				'readParms' => '', 				'writeParms' => '', 				'class' => 'left', 				'thclass' => 'left', 			) ,
			'cw_book_unique' => array(
				'title' => CWRITER_59,
				'type' => 'number',
				'data' => 'int',
				'width' => 'auto',
				'help' => '', 'tab'=>2,
				'readParms' => array('readonly'=> true),
				'writeParms' => array('readonly'=> true),
				'class' => 'left',
				'thclass' => 'left',
			) ,
	/*	 list of viewer IP adress doesnt work
		  'cw_book_viewers' => array(
				'title' => 'Viewers',
				'type' => 'text',
				'data' => 'str',
				'width' => 'auto',
				'help' => '',
				'writeParms' => array( 'size'=>'block-level'),
				'class' => 'left',
				'thclass' => 'left',  
			) ,*/
	/*		'cw_book_language' => array(
				'title' => 'Language',
				'type' => 'dropdown',
				'data' => 'str',
				'width' => 'auto',
				'help' => '',
				'readParms' => '',
				'writeParms' => '',
				'class' => 'left',
				'thclass' => 'left',
			) , */
			'cw_book_created' => array( 'title' => 'Created', 'type' => 'datestamp', 'data' => 'int', 'tab'=>2, 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => array('readonly'=> true), 'class' => 'left', 'thclass' => 'left', ) ,
			'cw_book_lastupdate' => array( 'title' => CWRITER_45, 'type' => 'datestamp', 'data' => 'int', 'tab'=>2, 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => array('readonly'=> true), 'class' => 'left', 'thclass' => 'left', ) ,
			'options' => array(
				'title' => LAN_OPTIONS,
				'type' => null,
				'data' => null,
				'width' => '10%',
				'thclass' => 'center last',
				'class' => 'center last',
				'forced' => '1',
			) ,
		);	
		
		protected $fieldpref = array('cw_book_title', 'cw_book_user_id', 'cw_book_challenge', 'cw_book_summary', 'cw_book_category');
		

	  
		public function init()
		{
    
			// challenge
			$this->cw_book_challenge[0] = CWRITER_A31;
			if(e107::getDb()->select("cw_challenge", "cw_challenge_id,cw_challenge_name", " order by cw_challenge_name", "nowhere"));
			{
				while ($row = e107::getDb()->fetch())	{	$this->cw_book_challenge[$row['cw_challenge_id']] = $row['cw_challenge_name'];	}
			}
			$this->fields['cw_book_challenge']['writeParms']['optArray'] = $this->cw_book_challenge;  
      
			// category
			$this->cw_book_category[0] = CWRITER_A31;
			if(e107::getDb()->select("cw_category", "cw_category_id,cw_category_name", " order by cw_category_name", "nowhere"));
			{
				while ($row = e107::getDb()->fetch())	{	$this->cw_book_category[$row['cw_category_id']] = $row['cw_category_name'];	}
			}
			$this->fields['cw_book_category']['writeParms']['optArray'] = $this->cw_book_category;    	
			
			//genre
			$this->cw_book_genre[0] = CWRITER_A18;
			if(e107::getDb()->select("cw_genre", "cw_genre_id,cw_genre_name", " order by cw_genre_name", "nowhere"));
			{
				while ($row = e107::getDb()->fetch())	{	$this->cw_book_genre[$row['cw_genre_id']] = $row['cw_genre_name'];	}
			}
			$this->fields['cw_book_genre']['writeParms']['optArray'] = $this->cw_book_genre; 
    
      //multi characters  Warning, uses name as key, not ID
		 
			if(e107::getDb()->select("cw_character", "cw_character_id,cw_character_name", " order by cw_character_name", "nowhere"));
			{
				while ($row = e107::getDb()->fetch())	{	$this->cw_book_character[$row['cw_character_name']] = $row['cw_character_name'];	}
			}
      $this->fields['cw_book_characters']['writeParms']['optArray'] = $this->cw_book_character; 
      $this->fields['cw_book_characters']['writeParms']['size'] = 'xlarge';
      $this->fields['cw_book_characters']['writeParms']['multiple'] = 1;
    
			$this->fields['cw_book_language']['writeParms']['optArray'] = array('cw_book_language_0','cw_book_language_1', 'cw_book_language_2'); // Example Drop-down array. 
 
	    $this->postFiliterMarkup = $this->AddButton();
		}

		function AddButton()
	  {
      $text .= "</fieldset></form><div class='e-container'>
      <table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>";
      $text .=  
      '<a href="admin_config.php?mode=book&action=create"  class="btn batch e-hide-if-js btn-primary"><span>'.CWRITER2_A96.'</span></a>';
      $text .= "</td></tr></table></div><form><fieldset>";
      return $text;
    }
    


		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
      $userInfo = e107::user($new_data['cw_book_user_id']);
			$userName = $userInfo['user_name'];
      $new_data['cw_book_author'] = $new_data['cw_book_user_id'].'.'.$userName;
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
      $userInfo = e107::user($new_data['cw_book_user_id']);
			$userName = $userInfo['user_name'];
      $new_data['cw_book_author'] = $new_data['cw_book_user_id'].'.'.$userName;
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
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
			
		/**
		 *
		 * @return TBD
		 */
		public function CreatePage()
		{
		  /* check access */
		  $pref = e107::pref('creative_writer');
	    $userclass = e107::getUserClass()->getName($pref['cwriter_admin']); 			
			if (!check_class($pref['cwriter_admin']))
			{    
			    e107::getMessage()->add("
					You are not permitted to add book<br>
					Permission [".$pref['cwriter_admin']."] ". $userclass, E_MESSAGE_ERROR);			   
					return  e107::getMessage()->render();
			}
 			e107::getMessage()->add("
					You are permitted to add book<br>
					Permission [".$pref['cwriter_admin']."] ". $userclass, E_MESSAGE_INFO);			    
			return  e107::getMessage()->render().$this->getUI()->getCreate();
		}
		
		/**
		 * Generic Edit page
		 * @return string
		 */
		public function EditPage()
		{
			$controller = $this->getUI()->getController();
			$data= $controller->getModel()->getData();
			$pref = e107::pref('creative_writer');
			$userInfo = e107::user($data['cw_book_user_id']); 
			$userclass = e107::getUserClass()->getName($pref['cwriter_admin']);
			/* check if you are not main moderator cwriter_admin */
			if (check_class($pref['cwriter_admin']))
			{    
			   e107::getMessage()->add("
						You are permitted to change this book, you are Superadmin <br>".
						"Superadmin: [".$pref['cwriter_admin']."] ". $userclass , E_MESSAGE_INFO);
				 return $this->getUI()->getCreate();
			}		
			elseif ($data['cw_book_user_id'] == USERID  OR  $data['cw_book_user_id'] == 0 )/* check if it's your record or something went wrong */
			{    
			  e107::getMessage()->add("You are not permitted to edit this book.<br> 
				Record owner: [".$data['cw_book_user_id']."] ".$userInfo['user_name']." <br> 
				Author: ".$data['cw_book_author']."<br>"
				."Superadmin: [".$pref['cwriter_admin']."] ". $userclass , E_MESSAGE_INFO);	  
				return $this->getUI()->getCreate();
			}		 			
			else {
			  $userInfo = e107::user($data['cw_book_user_id']); 
				$userclass = e107::getUserClass()->getName($pref['cwriter_admin']); 
			  e107::getMessage()->add("You are not permitted to edit this book.<br> 
				Record owner: [".$data['cw_book_user_id']."] ".$userInfo['user_name']." <br> 
				Author: ".$data['cw_book_author']."<br>"
				."Superadmin: [".$pref['cwriter_admin']."] ". $userclass , E_MESSAGE_ERROR);			   
				return  e107::getMessage()->render();
			}
		}	
}
				


class cw_book_form_ui extends e_admin_form_ui
{

}		
		
class cw_submitted_ui extends cw_book_ui
{
	protected $listQry      	= "SELECT * FROM `#cw_book` WHERE cw_book_approved = '0' "; 
 
	public function init()
	{
 
  }
}		

				
class cw_category_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_category'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_category';
		protected $pid				= 'cw_category_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_category_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'cw_category_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_category_name' =>   array ( 'title' => CWRITER_A32, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 
			'readParms' => '', 'writeParms' => array('required'=> true), 'class' => 'left', 'thclass' => 'left',  ),
			'cw_category_icon' => array(
				'title' => CWRITER_A33,
				'type' => 'image',
				'data' => 'str',
				'width' => 'auto',
				'help' => '',
				'readParms' => 'thumb=0x50',
				'writeParms' => 'media=creative_writer&w=600',
				'class' => 'left',
				'thclass' => 'left',
			) ,
		  'cw_category_lastupdated' =>   array ( 'title' => CWRITER_45, 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 
			'readParms' => '', 'writeParms' => array('readonly'=> true), 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_category_class' =>   array ( 'title' => CWRITER_A39, 'type' => 'userclass', 'data' => 'int', 'width' => 'auto', 'batch' => true, 'filter' => true, 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('cw_category_name', 'cw_category_icon', 'cw_category_class',  'cw_category_lastupdated');
		
 
	  
		public function init()
		{
			// Set drop-down values (if any). 
	    $this->postFiliterMarkup = $this->AddButton();
		}

		function AddButton()
	  {
      $text .= "</fieldset></form><div class='e-container'>
      <table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>";
      $text .=  
      '<a href="admin_config.php?mode=category&action=create"  class="btn batch e-hide-if-js btn-primary"><span>'.CWRITER2_A95.'</span></a>';
      $text .= "</td></tr></table></div><form><fieldset>";
      return $text;
    }


		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			$new_data['cw_category_lastupdated'] = time();
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
			$new_data['cw_category_lastupdated'] = time();
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

		/**
		 * Prevent deletion of categories in use
		 */
		public function beforeDelete($data, $id)
		{
	 
			if ($sql->db_Select("cw_book", "cw_book_id", " where cw_book_category='intval($id)'", "nowhere"))
			{
				$this->getTreeModel()->addMessageWarning("Can't delete <strong>{$data['cw_category_name']}</strong>".CWRITER_A34."!");
				return false;
			}
			return true;
		}
	
		
		// left-panel help menu area. 
		public function renderHelp()
		{
			$caption = LAN_HELP;
			$text = 'Some help text';

			return array('caption'=>$caption,'text'=> $text);

		}
 
			
}
				


class cw_category_form_ui extends e_admin_form_ui
{
 
}		
		

				
class cw_chapters_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_chapters'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_chapters';
		protected $pid				= 'cw_chapter_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_chapter_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'cw_chapter_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_title' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		 		  'cw_chapter_book' =>   array ( 'title' => 'Book', 'type' => 'text', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_number' =>   array ( 'title' => 'Number', 'type' => 'text', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_body' =>   array ( 'title' => 'Body', 'type' => 'bbarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_created' =>   array ( 'title' => 'Created', 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_lastupdate' =>   array ( 'title' => 'Lastupdate', 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),

		  'cw_chapter_author' =>   array ( 'title' => LAN_AUTHOR, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_wordcount' =>   array ( 'title' => 'Wordcount', 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_chapter_views' =>   array ( 'title' => 'Views', 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
			'cw_chapter_source' => array(
				'title' => LAN_URL,
				'type' => 'url',
				'data' => 'str',
				'width' => 'auto',
				'inline' => true,
				'help' => '',
				'readParms' => '',
				'writeParms' => array(
      		'size' => 'block-level'
      	) ,
				'class' => 'left',
				'thclass' => 'left',
			) ,
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('cw_chapter_title');
		
	
		public function init()
		{
			// Set drop-down values (if any). 
	    $this->postFiliterMarkup = $this->AddButton();
		}

		function AddButton()
	  {
      $text .= "</fieldset></form><div class='e-container'>
      <table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>";
      $text .=  
      '<a href="admin_config.php?mode=chapter&action=create"  class="btn batch e-hide-if-js btn-primary"><span>'.CWRITER2_A98.'</span></a>';
      $text .= "</td></tr></table></div><form><fieldset>";
      return $text;
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
				


class cw_chapters_form_ui extends e_admin_form_ui
{

}		
		

				
class cw_genre_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_genre'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_genre';
		protected $pid				= 'cw_genre_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_genre_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'cw_genre_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_genre_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_genre_icon' =>   array ( 'title' => LAN_ICON, 'type' => 'image', 'data' => 'str', 'width' => 'auto', 'help' => '', 
			'readParms' => 'thumb=0x50',
			'writeParms' => 'media=creative_writer&w=600', 
			'class' => 'left', 'thclass' => 'left',  ),
		  'cw_genre_lastupdated' =>   array ( 'title' => 'Lastupdated', 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 
      'readParms' => '', 'writeParms' => array('readonly'=> true), 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('cw_genre_name');
		
	
		public function init()
		{
			// Set drop-down values (if any). 
	    $this->postFiliterMarkup = $this->AddButton();
		}

		function AddButton()
	  {
      $text .= "</fieldset></form><div class='e-container'>
      <table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>";
      $text .=  
      '<a href="admin_config.php?mode=genre&action=create"  class="btn batch e-hide-if-js btn-primary"><span>'.CWRITER2_A94.'</span></a>';
      $text .= "</td></tr></table></div><form><fieldset>";
      return $text;
    }
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			$new_data['cw_genre_lastupdated'] = time();
      return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{

		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			$new_data['cw_genre_lastupdated'] = time();
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
 
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
		// left-panel help menu area. 
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
				


class cw_genre_form_ui extends e_admin_form_ui
{

}		
		
class cw_characters_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_characters'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_character';
		protected $pid				= 'cw_character_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_character_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'cw_character_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_character_name' =>   array ( 'title' => LAN_TITLE, 'type' => 'text', 'data' => 'str', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_character_icon' =>   array ( 'title' => LAN_ICON, 'type' => 'image', 'data' => 'str', 'width' => 'auto', 'help' => '', 
				'readParms' => 'thumb=0x50',
				'writeParms' => 'media=creative_writer&w=600', 
			'class' => 'left', 'thclass' => 'left',  ),
		  'cw_character_lastupdated' =>   array ( 'title' => 'Lastupdated', 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 
      'readParms' => '', 'writeParms' => array("readonly"=>true), 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array('cw_character_id', 'cw_character_icon', 'cw_characters_name');
		
	
		public function init()
		{
			// Set drop-down values (if any). 
	    $this->postFiliterMarkup = $this->AddButton();
		}

		function AddButton()
	  {
      $text .= "</fieldset></form><div class='e-container'>
      <table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>";
      $text .=  
      '<a href="admin_config.php?mode=characters&action=create"  class="btn batch e-hide-if-js btn-primary"><span>'.CWRITER2_A93.'</span></a>';
      $text .= "</td></tr></table></div><form><fieldset>";
      return $text;
    }
		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			$new_data['cw_character_lastupdated'] = time();
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
			$new_data['cw_character_lastupdated'] = time();
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
				


class cw_characters_form_ui extends e_admin_form_ui
{

}
				
class cw_review_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Creative Writer';
		protected $pluginName		= 'creative_writer';
	//	protected $eventName		= 'creative_writer-cw_review'; // remove comment to enable event triggers in admin. 		
		protected $table			= 'cw_review';
		protected $pid				= 'cw_review_id';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
		protected $batchExport     = true;
		protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= 'cw_review_id DESC';
	
		protected $fields 		= array (  'checkboxes' =>   array ( 'title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect',  ),
		  'cw_review_id' =>   array ( 'title' => LAN_ID, 'data' => 'int', 'width' => '5%', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_review_book' =>   array ( 'title' => 'Book', 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_reviewer' =>   array ( 'title' => 'Reviewer', 'type' => 'number', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_review' =>   array ( 'title' => 'Review', 'type' => 'textarea', 'data' => 'str', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_review_rate' =>   array ( 'title' => 'Rate', 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'cw_review_posted' =>   array ( 'title' => 'Posted', 'type' => 'datestamp', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => '', 'writeParms' => '', 'class' => 'left', 'thclass' => 'left',  ),
		  'options' =>   array ( 'title' => LAN_OPTIONS, 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1',  ),
		);		
		
		protected $fieldpref = array();
		
	
		public function init()
		{
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
		
		// left-panel help menu area. 
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
				


class cw_review_form_ui extends e_admin_form_ui
{

}		
		

 	
new creative_writer_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>