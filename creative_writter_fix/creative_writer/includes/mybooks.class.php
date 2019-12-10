<?php

 
e107::lan('creative_writer');
/* shortcodes moved to separate file */

class mybooks
{
	protected 	$action             = null;
	protected   $challenge_id  = null;   
	private     $plugTemplates      = array(); 
  
  public function __construct()
	{
 
		$this->plugTemplates   = e107::getTemplate('creative_writer');
		$this->cwpref = e107::pref('creative_writer');
		$this->cwriter_from =  0;

		$this->get = $_GET;
		$this->post = $_POST;
		                                   
		$this->action = "show";
		$this->sc_cw   = e107::getScBatch('creative_writer','creative_writer');  
		$this->sc_book = e107::getScBatch('book','creative_writer');  
 
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
		{      
			$this->action = $_POST['action'];
			if($_POST['cw_book_id']) { $this->cwriter_bookid = intval($_POST['cw_book_id']); }
			else {$this->cwriter_bookid = intval($_POST['cwriter_bookid']); }
			
			if($_POST['cw_chapter_id']) { $this->cwriter_chapterid = intval($_POST['cw_chapter_id']); }
			else {$this->cwriter_chapterid = intval($_POST['cwriter_chapterid']); }			
    
    } elseif (e_QUERY)
    {      
    	$cwriter_temp = explode(".", e_QUERY);
			$this->action = $cwriter_temp[0];
			$this->cwriter_bookid = intval($cwriter_temp[1]);
      $this->cwriter_chapterid = intval($cwriter_temp[2]);  
    }
      
    $cw_book_id = $this->cwriter_bookid;
    $cw_chapter_id = $this->cwriter_chapterid;
 
	  $cwriter_admin = check_class($this->cwpref['cwriter_admin']);
		$cwriter_editor = check_class($this->cwpref['cwriter_create']);
		if (!$cwriter_admin && !$cwriter_editor)
		{
		    print "You are not permitted to administer books";
		    exit;
		}

			if (!empty($_POST['dobookdel']))
		{      
		    $cwriter_arg = "select * from #cw_book
		    where cw_book_id = $cw_book_id ";
		    e107::getDb()->gen($cwriter_arg, false);
		    extract(e107::getDb()->fetch());
		    // make sure they are allowed to delete the chapter - admin or user who created it.
		    if ($cwriter_admin || $cw_book_author == USERID . "." . USERNAME)
		    {
		        e107::getDb()->delete("cw_chapters", " cw_chapter_book ={$cw_book_id} ", false);
		        e107::getDb()->delete("cw_book", "cw_book_id={$cw_book_id}", false);
		        e107::getDb()->delete("rate", "rate_table='cwriter' and rate_itemid={$cw_book_id}", false);
		         
		        // delete ratings and comments
		    }
		    $action = "show";
		    $this->setMode('show');
		}
		 
		if (!empty($_POST['dodel']))
		{      
    
		    $cwriter_arg = "select * from #cw_chapters
		    left join #cw_book on cw_chapter_book=cw_book_id
		    where cw_book_id = $cw_book_id and cw_chapter_id=$cw_chapter_id";
		    e107::getDb()->gen($cwriter_arg, false);
		    extract(e107::getDb()->fetch());
		    // make sure they are allowed to delete the chapter - admin or user who created it.
		    if ($cwriter_admin || $cw_chapter_author == USERID . "." . USERNAME)
		    {
		        e107::getDb()->delete("cw_chapters", " cw_chapter_book ={$cw_book_id} and  cw_chapter_id={$cw_chapter_id}", false);
		        $this->update_chapters($cw_book_id);
		    }
		    $action = "chapters";
		    $this->setMode('chapters');
		}

		switch ($this->action)
		{
		case 'saveadd':
			if ($_POST['randcheck'] == e107::getSession()->get('rand'))
			{
				$this->setMode($this->action);
			}
			else $this->setMode("show");
			break;
		case 'savechap':
			if ($_POST['randcheck'] == e107::getSession()->get('rand'))
			{
				$this->setMode('savechap');
			}
			else {
			  $this->setMode('chapters');  
			}
			break;		
		case 'saveedit':
			if ($_POST['randcheck'] == e107::getSession()->get('rand'))
			{ 
				$this->setMode($this->action);
			}
			else {
			  $this->setMode("show");     
			}
			break;	
		case 'newchap':     
			$this->setMode($this->action);
			break;	
		case 'edchap':
			$this->setMode($this->action);
			break;
		case 'add':
		case 'edit':
		case 'show':
		case 'chapters':
		case 'delete' :
		case 'delchap':
			$this->setMode($this->action);
			break;
 
		default:
			break;
		}    
 
    /* challenge is not part of filter- needed for mybooks.php */
		if (array_key_exists('challenge_id', $this->get)) {
   		$this->challenge_id = intval($this->get['challenge_id']);
      e107::getSession()->set('cwriter_challenge', $this->challenge_id);  
		}
    else e107::getSession()->clear('cwriter_challenge'); 
	}
	
	function init()
	{ 
 
		$this->process();	
	}
	
	private function process()
	{ 

		   
   if(empty($this->action)) {
	    $this->setMode('show');
	 }
	}
	
	public function render($action = 'show')
	{
    
    
    if($action) { $this->setMode($action); }
		
		$ns = e107::getRender();
 
    if($this->getMode() == 'saveadd') {
       	$this->savebook();
				e107::getSession()->clear('rand'); 	
				$this->showBooksList(); 	  
		}
		elseif($this->getMode() == 'saveedit') {
       	$this->updatebook(false);      
				e107::getSession()->clear('rand'); 
				$this->showBooksList(); 		  
		}  
		elseif($this->getMode() == 'add') {
       	$this->renderAddBookForm(); 	  
		}    
		elseif($this->getMode() == 'edit') {
       	$this->renderEditBookForm(); 	  
		} 
		elseif($this->getMode() == 'show') {  
       	$this->showBooksList(); 	  
		} 
		elseif($this->getMode() == 'chapters') {  
       	$this->showChaptersList(); 	  
		} 
		elseif($this->getMode() == 'newchap') {  
		    $this->cwriter_chapterid = 0;
       	$this->renderAddChapterForm(); 	  
		} 
		elseif($this->getMode() == 'edchap') {  
       	$this->renderEditChapterForm(); 	  
		}
		elseif($this->getMode() == 'savechap') {    
       	$this->savechap(); 
				e107::getSession()->clear('rand');
				$this->showChaptersList(); 		  
		}
		elseif($this->getMode() == 'delete') {    
   	$this->delete_confirm_book(); 
		e107::getSession()->clear('rand');	  
		}
		elseif($this->getMode() == 'delchap') {    
   	$this->delete_confirm_chapter(); 
		e107::getSession()->clear('rand');	  
		}
	}
	
  private function getMode()
	{
		return vartrue($this->get['mode']);
	}
	
	private function setMode($mode)
	{
		$this->get['mode'] = $mode;
	}
 
 
 
  /**
   * Prints form for adding new book .
   * @param boolean $display              (Optional) True or false.
   *                                      If false, the html code will be returned but not displayed.
   * @param boolean $debug                (Optional) True or false.
   *                                      If true, the html code will be displayed
   * @return $this
   */  
  function renderAddBookForm($display = true, $debug = false)  {
    $sql = e107::getDB();
    $tp  = e107::getParser();
    $frm = e107::getForm(); 
    $ns  = e107::getRender();
    
    $creative_writer = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php');
		 
    if($debug)  {
		 print_a('renderAddBookForm' );
		}
			
	  $cw_book_authorname = USERNAME;
	  /* adding book on challenge page */
	  if (e107::getSession()->is('cwriter_challenge')) {
      $cw_book_challenge   = e107::getSession()->get('cwriter_challenge');
    }
 
       $cw_book_rate      = $this->cwpref['cwriter_userating'] > 0 ? true : false;
       $cw_book_review    = $this->cwpref['cwriter_usereview'] > 0 ? true : false;
       $cw_book_comments  = $this->cwpref['cwriter_usecomments']  > 0 ? true : false;
 
		 
    $cwriter_yes = false;
 
    $cwriter_catopt   = $creative_writer->getCategory('select');
    $cwriter_chalopt  = $creative_writer->getChallengeSelect(); 
    $cwriter_genopt   = $creative_writer->getGenreSelect();
		 
		 
	  $selectedcharacters = explode(',',$cw_book_characters);
    if ($allRows =  $sql->retrieve("cw_character", "cw_character_id,cw_character_name",  " WHERE true order by cw_character_name", true ))
    {
        
        foreach($allRows as $cwriter_row)  
        {           
          $name = $tp->toFORM($cwriter_row['cw_character_name']);
          if (in_array($name,$selectedcharacters)) {
            $cwriter_charopt .= "<option  value='".$name."'selected='selected'>".$name."</option>";
          }
          else       {
            $cwriter_charopt .= "<option  value='".$name."' >".$name."</option>";
          }
         }
    }
    else
    {
        $cwriter_charopt .= "<option value='0'>" . CWRITER_08 . "</option>";
    }
 
    $cwriter_temp = explode(".", $cw_book_author, 2);
    $cw_book_authorname = $cwriter_temp[1];
    $cw_book_authorname = (empty($cw_book_authorname)?USERNAME: $cw_book_authorname);
    $rand=rand();
    e107::getSession()->set('rand', $rand);
    $cwriter_text .= "
<form enctype='multipart/form-data' id='dataform' action='" . e_SELF . "' method='post'  class='$action'>
	<div>
		<input type='hidden' name='action' value='saveadd' />
		<input type='hidden' name='cw_book_id' value='$cw_book_id' />
    <input type='hidden' name='cw_book_review' value='$cw_book_review' />
		<input type='hidden' name='randcheck' value='$rand'  />
		";
    if (!$cwriter_admin)
    {
        $cwriter_text .= "
		<input type='hidden' name='cw_book_rate' value='$cw_book_rate' />
		 
		<input type='hidden' name='cw_book_comments' value='$cw_book_comments' />";
    }
    $homeurl = e107::url('creative_writer','creative_writer');
    $cwriter_text .= "
	</div>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='fcaption' colspan='2'>" . LAN_BOOK_DETAILS . ": <em>" . $tp->toHTML($cw_book_title) . "</em></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
			<a href='" . $homeurl . "'><img src='images/updir.png' style='border:0' alt='" . LAN_CW_BACK_TO_HOME . "' title='" . LAN_CW_BACK_TO_HOME . "' /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_TITLE . "</td>
		<td class='forumheader3' > 
	  ".$frm->text('cw_book_title', $tp->toFORM($cw_book_title), 100, array('placeholder'=>LAN_BOOK_TITLE, 'required'=>1))."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_SUMMARY . "</td>
		<td class='forumheader3' > 
		".$frm->textarea('cw_book_summary', $tp->toFORM($cw_book_summary), 4, true, array('placeholder'=>LAN_BOOK_SUMMARY, 'required'=>1))."
		</td>
	</tr>";
    // If there is no file specified or the image is missing allow an upload
    // Otherwise just display the name of the picture
    
    /*
    if ($this->cwpref['cw_visibility_logo'] > 0) {
      if (empty($cw_book_logo) || !file_exists("./pictures/" . $cw_book_logo))
      {
          $cwriter_text .= "
    	<tr>
  		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A87 . ":</td>
  		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
  				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . CWRITER_A89 . "</i>
  		</td>
  	 </tr>";
      }
      else
      {
          $cwriter_text .= "
    	<tr>
    		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A87 . ":</td>
    		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
    			<img src='./pictures/" . $cw_book_logo . "' alt='picture' />
    			<br />" . CWRITER_A88 . "<input type='checkbox' name='cwriter_delpic' value='1' />
    			<input type='hidden' name='cw_book_logo' value='$cw_book_logo' />
    		</td>
    	</tr>";
     }
    }        */
    $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CHALLENGE . "</td>
		<td class='forumheader3' >{$cwriter_chalopt}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CATEGORY . "</td>
		<td class='forumheader3' > {$cwriter_catopt} </td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_GENRE . "</td>
		<td class='forumheader3' > {$cwriter_genopt} </td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_AUTHOR . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_authorname) . "</td>
	</tr>
 	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CHARACTERS . "</td>
		<td class='forumheader3' > " . $tp->toFORM($cw_book_characters) . " </td>
	</tr>
	<tr>
  	<td class='forumheader3' style='width:25%'> Edit " . LAN_BOOK_CHARACTERS . "</td>  
	  <td>
     <select class='searchable' name='characters[]'  id='custom-headers' multiple='multiple'>".$cwriter_charopt."
     </select>
    </td>
  </tr>";
   if ($this->cwpref['cw_visibility_warnings'] > 0) { 
   
   $cwriter_text .= "<tr>
  		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_WARNINGS . "</td>
  		<td class='forumheader3' >
				".$frm->textarea('cw_book_warnings', $tp->toFORM($cw_book_warnings), 4, true, array('placeholder'=>LAN_BOOK_WARNINGS, 'required'=>0))."
			</td>
  	</tr>";
   }
  if ($this->cwpref['cw_visibility_disclaimer'] > 0) {
  	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_DISCLAIMER . "</td>
		<td class='forumheader3' >
		   	".$frm->textarea('cw_book_disclaimer', $tp->toFORM($cw_book_disclaimer), 4, true, array('placeholder'=>LAN_BOOK_DISCLAIMER, 'required'=>0))." 
     </td>
	  </tr>";
  }
  if ($this->cwpref['cw_visibility_complete'] > 0) { 
	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_COMPLETE . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_complete' value='1' class='tbox' " . ($cw_book_complete == 1?"checked='checked'":"") . "/></td>
	</tr>
	<tr>";
	}
		
  if ($this->cwpref['cw_visibility_series'] > 0) {
	$cwriter_text .= "<tr>	
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_PART_OF_SERIES . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_series' value='1' class='tbox' " . ($cw_book_series == 1?"checked='checked'":"") . "/></td>
	</tr>";
	}
			
	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_EXTERNAL . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_external' value='1' class='tbox' " . ($cw_book_external == 1?"checked='checked'":"") . "/></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_DISPLAY . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_visible' value='1' class='tbox' " . ($cw_book_visible == 1?"checked='checked'":"") . "/></td>
	</tr>";
    if ($cwriter_admin)
    {
        $cwriter_text .= "
    <tr>
		<td class='forumheader3' style='width:25%'>".LAN_BOOK_IS_RATED . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_rate' value='1' class='tbox' " . ($cw_book_rate == 1?"checked='checked'":"") . "/>
		 <span class='alert-danger center'>".LAN_CW_ONLY_ADMINS."</span></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_IS_COMMENTED . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_comments' value='1' class='tbox' " . ($cw_book_comments == 1?"checked='checked'":"") . "/>
		<span class='alert-danger center'>".LAN_CW_ONLY_ADMINS."</span></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_IS_APPROVED . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_approved' value='1' class='tbox' " . ($cw_book_approved == 1?"checked='checked'":"") . "/>
		 <span class='alert-danger center'>".LAN_CW_ONLY_ADMINS."</span></td>
	</tr>";
    }
								/*  adding new book, this is empty
    $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_WORDCOUNT . "</td>
		<td class='forumheader3' >" . $cw_book_wordcount . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CHAPTERS . "</td>
		<td class='forumheader3' >" . $cw_book_chapters . "</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CREATED . "</td>
		<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_created) . "</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_LASTUPDATE . "</td>
		<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_lastupdate) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_VIEWS . "</td>
		<td class='forumheader3' >" . $cw_book_views . " (" . LAN_BOOK_UNIQUE . " $cw_book_unique)</td>
	</tr>     */
	$cwriter_text .= "
	<tr>
		<td colspan='2' class='fcaption'><input type='submit' class='tbox' name='subfrm' value='" . LAN_CW_SAVE . "' /></td>
	</tr>
</table>
</form>";
   
	  if ($display === false) {
        return $cwriter_text;
    } else {
        $ns->tablerender(LAN_MB_ADD_NEW_BOOK, $cwriter_text);
    }

    return $this;
	}
	
	function savebook($debug = FALSE) {
	  $e_event = e107::getEvent();
    $sql = e107::getDB();
    $tp  = e107::getParser();
 
    if($debug)  {
		 print_a('savebook' );
		} 
	  /* todo check this */
	  foreach ($_POST['characters'] as $selectedOption) {
     $cwriter_newarray[] = ucwords(strtolower($selectedOption));
    }

    $cwriter_newarray = array_unique($cwriter_newarray);
    $cwriter_newarray = implode(",", $cwriter_newarray);
    
    
    if (!$cwriter_admin && $this->cwpref['cwriter_approval'] == 1)
    {
        // if not an admin and approval is required then set to zero
        $_POST['cw_book_approved'] = 0;
    }
    if (!$cwriter_admin && $this->cwpref['cwriter_approval'] == 0)
    {
        // if no approval and not an admin is required then approve it automatically
        $_POST['cw_book_approved'] = 1;
    }
    
    
	     $cw_book_author = USERID . "." . USERNAME;
	      $cwriter_arg = "
			  0,
	    	'" . $tp->toDB($_POST['cw_book_title']) . "',
	    	'" . $tp->toDB($_POST['cw_book_summary']) . "',
	    	'" . $cpic . "',
	    	'" . $tp->toDB($cw_book_author) . "',
	    	'" . intval($_POST['cwriter_category']) . "',
	    	'" . intval($_POST['cwriter_genre']) . "',
	    	'" . $tp->toDB($cwriter_newarray) . "',
	    	'" . time() . "',
	    	'" . time() . "',
	    	'" . intval($_POST['cw_book_complete']) . "',
	    	'0',
	    	'" . intval($_POST['cw_book_series']) . "',
	    	'0',
	    	'" . $tp->toDB($_POST['cw_book_warnings']) . "',
				'0',
				'" . $tp->toDB($_POST['cw_book_disclaimer']) . "',
				'" . intval($_POST['cw_book_rate']) . "',
				'" . intval($_POST['cw_book_review']) . "',
				'" . intval($_POST['cw_book_comments']) . "',
				'" . intval($_POST['cw_book_visible']) . "',
				'" . intval($_POST['cw_book_approved']) . "',
				'" . $cw_book_unique . "',
				'',
				'',
				'" . USERID . "',
				'" . intval($_POST['cwriter_challenge'])   . "',
				'" . $tp->toDB($_POST['cw_book_external']) . "'";
		
	 
	        $cwriter_insertid = $sql->insert("cw_book", $cwriter_arg, $debug);
	        $cwriter_data = array("user" => USERNAME, "itemtitle" => $tp->toDB($_POST['cw_book_title']), "catid" => $cwriter_insertid);
	        $e_event->trigger("creativewriternew", $cwriter_data);
	
	  
	}
	
  /**
   * Prints form for adding new book .
   * @param boolean $display              (Optional) True or false.
   *                                      If false, the html code will be returned but not displayed.
   * @param boolean $debug                (Optional) True or false.
   *                                      If true, the html code will be displayed
   * @return $this
   */  
  function renderEditBookForm($display = true, $debug = false)  {
    $sql = e107::getDB();
    $tp  = e107::getParser();
    $frm = e107::getForm(); 
    $ns  = e107::getRender();
    $cw_book_id = $this->cwriter_bookid;
    
    $creative_writer = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php');
		 
    if($debug)  {
		 print_a('renderEditBookForm' );
		}
			
    /* todo check */
		$sql->select("cw_book", "*", "where cw_book_id=$cw_book_id", "nowhere", false);    
    extract($sql->fetch()); 
        
  	e107::getSession()->set('cwriter_category', $cw_book_category);   
    e107::getSession()->set('cwriter_genre', $cw_book_genre);
    e107::getSession()->set('cwriter_characters', $cw_book_characters); 
    e107::getSession()->set('cwriter_challenge', $cw_book_challenge); 
        
    $cw_book_rate      = $this->cwpref['cwriter_userating'] > 0 ? true : false;
    $cw_book_review    = $this->cwpref['cwriter_usereview'] > 0 ? true : false;
    $cw_book_comments  = $this->cwpref['cwriter_usecomments']  > 0 ? true : false;
 
    $cwriter_yes = false;
 
    $cwriter_catopt   = $creative_writer->getCategory('select');
    $cwriter_chalopt  = $creative_writer->getChallengeSelect(); 
    $cwriter_genopt   = $creative_writer->getGenreSelect();

		 
		/* todo move multiselect to creative_writer class */ 
	  $selectedcharacters = explode(',',$cw_book_characters);
    if ($allRows =  $sql->retrieve("cw_character", "cw_character_id,cw_character_name",  " WHERE true order by cw_character_name", true ))
    {
        
        foreach($allRows as $cwriter_row)  
        {           
          $name = $tp->toFORM($cwriter_row['cw_character_name']);
          if (in_array($name,$selectedcharacters)) {
            $cwriter_charopt .= "<option  value='".$name."'selected='selected'>".$name."</option>";
          }
          else       {
            $cwriter_charopt .= "<option  value='".$name."' >".$name."</option>";
          }
         }
    }
    else
    {
        $cwriter_charopt .= "<option value='0'>" . CWRITER_08 . "</option>";
    }
 
    $cwriter_temp = explode(".", $cw_book_author, 2);
    $cw_book_authorname = $cwriter_temp[1];
    $cw_book_authorname = (empty($cw_book_authorname)?USERNAME: $cw_book_authorname);
    $rand=rand();
    e107::getSession()->set('rand', $rand);
    
   	$cwriter_text  = $tp->parseTemplate($this->plugTemplates['mybooks']['breadcrumbs'], true, $this->sc_cw); 

    $cwriter_text .= "
<form enctype='multipart/form-data' id='dataform' action='" . e_SELF . "' method='post'  class='$action'>
	<div>
		<input type='hidden' name='action' value='saveedit' />
		<input type='hidden' name='cw_book_id' value='$cw_book_id' />
    <input type='hidden' name='cw_book_review' value='$cw_book_review' />
		<input type='hidden' name='randcheck' value='$rand'  />
		";
    if (!$cwriter_admin)
    {
        $cwriter_text .= "
		<input type='hidden' name='cw_book_rate' value='$cw_book_rate' />
		 
		<input type='hidden' name='cw_book_comments' value='$cw_book_comments' />";
    }
     
    $cwriter_text .= "
	</div>
<table class='fborder' style='width:100%'>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_TITLE . "</td>
		<td class='forumheader3' > 
	  ".$frm->text('cw_book_title', $tp->toFORM($cw_book_title), 100, array('placeholder'=>LAN_BOOK_TITLE, 'required'=>1))."
		</td>
	</tr>

	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_SUMMARY . "</td>
		<td class='forumheader3' > 
		".$frm->textarea('cw_book_summary', $tp->toFORM($cw_book_summary), 4, true, array('placeholder'=>LAN_BOOK_SUMMARY, 'required'=>1))."
		</td>
	</tr>";
    // If there is no file specified or the image is missing allow an upload
    // Otherwise just display the name of the picture
    
    /*
    if ($this->cwpref['cw_visibility_logo'] > 0) {
      if (empty($cw_book_logo) || !file_exists("./pictures/" . $cw_book_logo))
      {
          $cwriter_text .= "
    	<tr>
  		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A87 . ":</td>
  		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
  				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . CWRITER_A89 . "</i>
  		</td>
  	 </tr>";
      }
      else
      {
          $cwriter_text .= "
    	<tr>
    		<td class='forumheader3' style='vertical-align:top;' >" . CWRITER_A87 . ":</td>
    		<td class='forumheader3' style='width:80%;text-align:left;vertical-align:top;'>
    			<img src='./pictures/" . $cw_book_logo . "' alt='picture' />
    			<br />" . CWRITER_A88 . "<input type='checkbox' name='cwriter_delpic' value='1' />
    			<input type='hidden' name='cw_book_logo' value='$cw_book_logo' />
    		</td>
    	</tr>";
     }
    }        */
    $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CHALLENGE . "</td>
		<td class='forumheader3' >{$cwriter_chalopt}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CATEGORY . "</td>
		<td class='forumheader3' > {$cwriter_catopt} </td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_GENRE . "</td>
		<td class='forumheader3' > {$cwriter_genopt} </td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_AUTHOR . "</td>
		<td class='forumheader3' >" . $tp->toHTML($cw_book_authorname) . "</td>
	</tr>
 	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CHARACTERS . "</td>
		<td class='forumheader3' > " . $tp->toFORM($cw_book_characters) . " </td>
	</tr>
	<tr>
  	<td class='forumheader3' style='width:25%'> Edit " . LAN_BOOK_CHARACTERS . "</td>  
	  <td>
     <select class='searchable' name='characters[]'  id='custom-headers' multiple='multiple'>".$cwriter_charopt."
     </select>
    </td>
  </tr>";
   if ($this->cwpref['cw_visibility_warnings'] > 0) { 
   
   $cwriter_text .= "<tr>
  		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_WARNINGS . "</td>
  		<td class='forumheader3' >
				".$frm->textarea('cw_book_warnings', $tp->toFORM($cw_book_warnings), 4, true, array('placeholder'=>LAN_BOOK_WARNINGS, 'required'=>0))."
			</td>
  	</tr>";
   }
  if ($this->cwpref['cw_visibility_disclaimer'] > 0) {
  	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_DISCLAIMER . "</td>
		<td class='forumheader3' >
		   	".$frm->textarea('cw_book_disclaimer', $tp->toFORM($cw_book_disclaimer), 4, true, array('placeholder'=>LAN_BOOK_DISCLAIMER, 'required'=>0))." 
     </td>
	  </tr>";
  }

  if ($this->cwpref['cw_visibility_complete'] > 0) { 
	$cwriter_text .= "<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_COMPLETE . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_complete' value='1' class='tbox' " . ($cw_book_complete == 1?"checked='checked'":"") . "/></td>
	</tr>
	<tr>";
	}
		
  if ($this->cwpref['cw_visibility_series'] > 0) {
	$cwriter_text .= "<tr>	
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_PART_OF_SERIES . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_series' value='1' class='tbox' " . ($cw_book_series == 1?"checked='checked'":"") . "/></td>
	</tr>";
	}
	
	 
	$cwriter_text .= "<tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_EXTERNAL . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_external' value='1' class='tbox' " . ($cw_book_external == 1?"checked='checked'":"") . "/></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_DISPLAY . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_visible' value='1' class='tbox' " . ($cw_book_visible == 1?"checked='checked'":"") . "/></td>
	</tr>";
    if ($cwriter_admin)
    {
        $cwriter_text .= "
    <tr>
		<td class='forumheader3' style='width:25%'>".LAN_BOOK_IS_RATED . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_rate' value='1' class='tbox' " . ($cw_book_rate == 1?"checked='checked'":"") . "/>
		 <span class='alert-danger center'>".LAN_CW_ONLY_ADMINS."</span></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_IS_COMMENTED . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_comments' value='1' class='tbox' " . ($cw_book_comments == 1?"checked='checked'":"") . "/>
		<span class='alert-danger center'>".LAN_CW_ONLY_ADMINS."</span></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_IS_APPROVED . "</td>
		<td class='forumheader3' ><input type='checkbox' name='cw_book_approved' value='1' class='tbox' " . ($cw_book_approved == 1?"checked='checked'":"") . "/>
		 <span class='alert-danger center'>".LAN_CW_ONLY_ADMINS."</span></td>
	</tr>";
    }
								/*  adding new book, this is empty
    $cwriter_text .= "
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_WORDCOUNT . "</td>
		<td class='forumheader3' >" . $cw_book_wordcount . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CHAPTERS . "</td>
		<td class='forumheader3' >" . $cw_book_chapters . "</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_CREATED . "</td>
		<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_created) . "</td>
	</tr>
		<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_LASTUPDATE . "</td>
		<td class='forumheader3' >" . $cwriter_conv->convert_date($cw_book_lastupdate) . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%'>" . LAN_BOOK_VIEWS . "</td>
		<td class='forumheader3' >" . $cw_book_views . " (" . LAN_BOOK_UNIQUE . " $cw_book_unique)</td>
	</tr>     */
	$cwriter_text .= "
	<tr>
		<td colspan='2' class='fcaption'><input type='submit' class='tbox' name='subfrm' value='" . LAN_CW_SAVE . "' /></td>
	</tr>
</table>
</form>";
   
	  if ($display === false) {
        return $cwriter_text;
    } else {
        $ns->tablerender(LAN_MB_EDIT_BOOK." : ".$tp->toHTML($cw_book_title), $cwriter_text);
    }

    return $this;
	}
	
	function updatebook($debug = FALSE) {
	  $e_event = e107::getEvent();
    $sql = e107::getDB();
    $tp  = e107::getParser();
    $cw_book_id = $this->cwriter_bookid;
    
    if($debug)  {
     print_a($cw_book_id);
     print_a($this->cwriter_bookid);
		 print_a('updatebook' );
		} 
	  /* todo check this */
	  foreach ($_POST['characters'] as $selectedOption) {
     $cwriter_newarray[] = ucwords(strtolower($selectedOption));
    }

    $cwriter_newarray = array_unique($cwriter_newarray);
    $cwriter_newarray = implode(",", $cwriter_newarray);
    
    
    if (!$cwriter_admin && $this->cwpref['cwriter_approval'] == 1)
    {
        // if not an admin and approval is required then set to zero
        $_POST['cw_book_approved'] = 0;
    }
    if (!$cwriter_admin && $this->cwpref['cwriter_approval'] == 0)
    {
        // if no approval and not an admin is required then approve it automatically
        $_POST['cw_book_approved'] = 1;
    }
    
		$cwriter_arg = "
	    	cw_book_title='" . $tp->toDB($_POST['cw_book_title']) . "',
	    	cw_book_summary='" . $tp->toDB($_POST['cw_book_summary']) . "',
	    	cw_book_logo='" . $cpic . "',
	    	cw_book_category='" . intval($_POST['cwriter_category']) . "',
	    	cw_book_genre='" . intval($_POST['cwriter_genre']) . "',
	    	cw_book_characters='" . $tp->toDB($cwriter_newarray) . "',
	    	cw_book_lastupdate='" . time() . "',
	    	cw_book_complete='" . intval($_POST['cw_book_complete']) . "',
	    	cw_book_series='" . intval($_POST['cw_book_series']) . "',
	    	cw_book_warnings='" . $tp->toDB($_POST['cw_book_warnings']) . "',
	    	cw_book_title='" . $tp->toDB($_POST['cw_book_title']) . "',
				cw_book_disclaimer='" . $tp->toDB($_POST['cw_book_disclaimer']) . "',
				cw_book_rate='" . intval($_POST['cw_book_rate']) . "',
				cw_book_review='" . $tp->toDB($_POST['cw_book_review']) . "',
				cw_book_comments='" . intval($_POST['cw_book_comments']) . "',
				cw_book_lastupdate='" . time() . "',
				cw_book_visible='" . intval($_POST['cw_book_visible']) . "',
				cw_book_approved='" . intval($_POST['cw_book_approved']) . "',
				cw_book_challenge='" . intval($_POST['cwriter_challenge']) . "',
				cw_book_external='" . $tp->toDB($_POST['cw_book_external']) . "' 
				where cw_book_id=$cw_book_id";
	 
	  $sql->update("cw_book", $cwriter_arg, $debug);
	  $this->update_chapters($cw_book_id);
	}
	
	protected function update_chapters($cw_book_uid)
	{
	    global $sql;
	    $cwriter_numwords = $sql->db_Select("cw_chapters", "count(cw_chapter_id) as numchap,sum(cw_chapter_wordcount) as numwords", "where cw_chapter_book=$cw_book_uid", "nowhere", false);
	    $cwriter_rowc = $sql->db_Fetch();
	    $sql->db_Update("cw_book", "cw_book_chapters=" . $cwriter_rowc['numchap'] . ",cw_book_wordcount=" . $cwriter_rowc['numwords'] . " where cw_book_id=$cw_book_uid", false);
	    return;
	}

  function showBooksList($display=true) {
		$cwriter_text  = e107::getParser()->parseTemplate($this->plugTemplates['mybooks']['breadcrumbs'], true, $this->sc_cw); 
    $cwriter_text  .= e107::getParser()->parseTemplate($this->plugTemplates['mybooks']['start'], true, $this->sc_cw); 
    if (!$cwriter_admin)
    {
        // if not an admin then only get the users books
        $cwriter_where = "where  cw_book_user_id='" . USERID . "' ";
    }
    /* todo rewrite to retrieve, template, shortcodes */
    e107::getDB()->select("cw_book", "cw_book_id,cw_book_title", "$cwriter_where order by cw_book_title", "nowhere", false);
    while ($cwriter_row = e107::getDB()->fetch())
    {
        $this->sc_book->setVars($cwriter_row);
        $cwriter_text  .= e107::getParser()->parseTemplate($this->plugTemplates['mybooks']['item'], true, $this->sc_book);
    } 
    $cwriter_text  .= e107::getParser()->parseTemplate($this->plugTemplates['mybooks']['end'], true, $this->sc_cw);
	  if ($display === false) {
        return $cwriter_text;
    } else {
         e107::getRender()->tablerender(LAN_MB_ADMINISTER_BOOKS, $cwriter_text);
    }
	}
  
  function showChaptersList($display = true) {
    $sql = e107::getDB();
    $tp  = e107::getParser();
    $frm = e107::getForm(); 
    $ns  = e107::getRender();
    $cw_book_id = $this->cwriter_bookid;
  
    if($sql->select("cw_book", "*", "where cw_book_id =$cw_book_id", "nowhere", false)) {
        $cwriter_bookrow = $sql->fetch();
  
        $cwriter_title = $tp->toHTML($cwriter_bookrow['cw_book_title']);
        $homeurl = e107::url('creative_writer','creative_writer');
         
        $this->sc_cw->setVars($cwriter_bookrow);
        
        $cwriter_text  = $tp->parseTemplate($this->plugTemplates['mychapters']['breadcrumbs'], true, $this->sc_cw); 
        $cwriter_text  .= $tp->parseTemplate($this->plugTemplates['mychapters']['start'], true, $this->sc_cw); 
 
        $sql->select("cw_chapters", "cw_chapter_id,cw_chapter_title,cw_chapter_number,cw_chapter_book", "where cw_chapter_book=$cw_book_id order by cw_chapter_number asc", "nowhere", false);
        while ($cwriter_row = $sql->fetch())
        {
            extract($cwriter_row);
            $cwriter_text .= "
    	<tr>
    		<td class='forumheader3' style='width:5%;'>" . $tp->toHTML($cw_chapter_number) . "</td>
    		<td class='forumheader3' style='width:70%;'>" . $tp->toHTML($cw_chapter_title) . "</td>
    		<td class='forumheader3' style='width:25%;text-align:center;'> 
    			<a href='" . e_SELF . "?edchap.$cw_chapter_book.$cw_chapter_id' class='btn btn-xs btn-warning'><i class='fa fa-2x fa-pencil' title='".CWRITER_214."'></i> </a>
    			<a href='" . e_SELF . "?delchap.$cw_chapter_book.$cw_chapter_id' class='btn btn-xs btn-danger'><i class='fa fa-2x  fa-times' title='".CWRITER_215."'></i></a>
    		</td>
    	</tr>";
        } // while
 
    $cwriter_text  .= $tp->parseTemplate($this->plugTemplates['mychapters']['end'], true, $this->sc_cw);
    if ($display === false) {
        return $cwriter_text;
    } else {
         $ns->tablerender(LAN_MB_ADMINISTER_CHAPTERS_IN_BOOK." : ".$cwriter_title, $cwriter_text);
    }
    
    }
  }
  
 function renderAddChapterForm() {
    $sql = e107::getDB();
    $tp  = e107::getParser();
    $frm = e107::getForm(); 
    $ns  = e107::getRender();
    $cw_chapter_id = $this->cwriter_chapterid;
		$cw_book_id= $this->cwriter_bookid; 
    $cw_chapter_id = 0;
    
    if ($cw_chapter_id > 0)
    {
        // we are editing
        $cwriter_arg = "select * from #cw_chapters
		left join #cw_book on cw_book_id=cw_chapter_book
		where cw_chapter_id=$cw_chapter_id";
        $sql->gen($cwriter_arg, false);
    }
    else
    {
        // just get the book name
        $sql->select("cw_book", "*", "where cw_book_id = $cw_book_id", "nowhere", false);      
    }
    extract($sql->fetch());
		$cwriter_title = $tp->toHTML($cw_book_title);
    $rand=rand();
    e107::getSession()->set('rand', $rand);
		    
    $cwriter_text .= "
		<form method='post' action='" . e_SELF . "' id='dataform' class='$action'>
		<div>
			<input type='hidden' name='action' value='savechap' />
			<input type='hidden' name='cwriter_chapterid' value='$cw_chapter_id' />
			<input type='hidden' name='cwriter_bookid' value='$cw_book_id' />
		  <input type='hidden' name='randcheck' value='$rand'  />
		</div>
		<table class='fborder' style='width:100%;'>
				<tr>
				<td class='forumheader3' colspan='2'><a href='" . e_SELF . "?chapters.$cw_book_id.$cw_chapter_id'><img src='images/updir.png' style='border:0' alt='" . CWRITER_71 . "' title='" . CWRITER_71 . "' /></a></td>
			</tr>";
			
			if($cw_book_external > 0) {
			$cwriter_text .= "
			<tr>
				<td style='width:25%;' class='forumheader3'>" . LAN_BOOK_EXTERNAL_SOURCE . "</td>
				<td style='width:75%;' class='forumheader3'>
				".$frm->text('cw_chapter_source', $tp->toFORM($cw_chapter_source), 250, array('placeholder'=>LAN_BOOK_EXTERNAL, 'required'=>1))."
				</td>
			</tr>";
			}
			
			$cwriter_text .= "
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_309 . "</td>
				<td style='width:75%;' class='forumheader3'>
				".$frm->text('cw_chapter_number', $tp->toFORM($cw_chapter_number), 100, array('placeholder'=>CWRITER_309, 'required'=>1))."
				</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_310 . "</td>
				<td style='width:75%;' class='forumheader3'>
				".$frm->text('cw_chapter_title', $tp->toFORM($cw_chapter_title), 100, array('placeholder'=>CWRITER_310, 'required'=>1))."	
				</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_312 . "</td>
				<td style='width:75%;' class='forumheader3'>
				  ".$frm->textarea('cw_chapter_body', $tp->toFORM($cw_chapter_body), 4, true, array('placeholder'=>CWRITER_312, 'required'=>0))."
				</td>
			</tr>";
 
			$cwriter_text .= "	<tr>
				<td colspan='2' class='fcaption'><input type='submit' class='tbox' name='subfrm' value='" . LAN_CW_SAVE . "' />
				</td>
			</tr>
		</table>
		</form>";
		
   if ($display === false) {
        return $cwriter_text;
    } else {
         $ns->tablerender(LAN_MB_ADD_NEW_CHAPTER." : ".$cwriter_title, $cwriter_text);
    }
 
 }
 
 function renderEditChapterForm() {
    $sql = e107::getDB();
    $tp  = e107::getParser();
    $frm = e107::getForm(); 
    $ns  = e107::getRender();
    $cw_chapter_id = $this->cwriter_chapterid;
		$cw_book_id= $this->cwriter_bookid; 
   
    
    if ($cw_chapter_id > 0)
    {
        // we are editing
        $cwriter_arg = "select * from #cw_chapters
		left join #cw_book on cw_book_id=cw_chapter_book
		where cw_chapter_id=$cw_chapter_id";
        $sql->gen($cwriter_arg, false);
    }
    else
    {
        // just get the book name
        $sql->select("cw_book", "*", "where cw_book_id = $cw_book_id", "nowhere", false);      
    }
    extract($sql->fetch());
		$cwriter_title = $tp->toHTML($cw_book_title);
 
    $rand=rand();
    e107::getSession()->set('rand', $rand);
		    
    $cwriter_text .= "
		<form method='post' action='" . e_SELF . "' id='dataform' class='$action'>
		<div>
			<input type='hidden' name='action' value='savechap' />
			<input type='hidden' name='cwriter_chapterid' value='$cw_chapter_id' />
			<input type='hidden' name='cwriter_bookid' value='$cw_book_id' />
		  <input type='hidden' name='randcheck' value='$rand'  />
		</div>
		<table class='fborder' style='width:100%;'>
				<tr>
				<td class='forumheader3' colspan='2'><a href='" . e_SELF . "?chapters.$cw_book_id.$cw_chapter_id'><img src='images/updir.png' style='border:0' alt='" . CWRITER_71 . "' title='" . CWRITER_71 . "' /></a></td>
			</tr>";
			
			if($cw_book_external > 0) {
			$cwriter_text .= "
			<tr>
				<td style='width:25%;' class='forumheader3'>" . LAN_BOOK_EXTERNAL_SOURCE . "</td>
				<td style='width:75%;' class='forumheader3'>
				".$frm->text('cw_chapter_source', $tp->toFORM($cw_chapter_source), 250, array('placeholder'=>LAN_BOOK_EXTERNAL, 'required'=>1))."
				</td>
			</tr>";
			}
			
			$cwriter_text .= "
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_309 . "</td>
				<td style='width:75%;' class='forumheader3'>
				".$frm->text('cw_chapter_number', $tp->toFORM($cw_chapter_number), 100, array('placeholder'=>CWRITER_309, 'required'=>1))."
				</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_310 . "</td>
				<td style='width:75%;' class='forumheader3'>
				".$frm->text('cw_chapter_title', $tp->toFORM($cw_chapter_title), 100, array('placeholder'=>CWRITER_310, 'required'=>1))."	
				</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_312 . "</td>
				<td style='width:75%;' class='forumheader3'>
				  ".$frm->textarea('cw_chapter_body', $tp->toFORM($cw_chapter_body), 4, true, array('placeholder'=>CWRITER_312, 'required'=>0))."
				</td>
			</tr>";
		      /*
		    $cwriter_text .= "
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_313 . "</td>
				<td style='width:75%;' class='forumheader3'>" . $cwriter_conv->convert_date($cw_chapter_created) . "</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_314 . "</td>
				<td style='width:75%;' class='forumheader3'>" . $cwriter_conv->convert_date($cw_chapter_lastupdate) . "</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_315 . "</td>
				<td style='width:75%;' class='forumheader3'>" . number_format($cw_chapter_wordcount) . " " . CWRITER_77 . "</td>
			</tr>
			<tr>
				<td style='width:25%;' class='forumheader3'>" . CWRITER_316 . "</td>
				<td style='width:75%;' class='forumheader3'>" . $tp->toFORM($cw_chapter_views) . "</td>
			</tr> */
			$cwriter_text .= "	<tr>
				<td colspan='2' class='fcaption'><input type='submit' class='tbox' name='subfrm' value='" . LAN_CW_SAVE . "' />
				</td>
			</tr>
		</table>
		</form>";
		
   if ($display === false) {
        return $cwriter_text;
    } else {
         $ns->tablerender(LAN_MB_ADD_NEW_CHAPTER." : ".$cwriter_title, $cwriter_text);
    }
 
 }
 
 
 function savechap($debug = false) {
        $sql = e107::getDB();     
				$tp  = e107::getParser();
        $cw_chapter_id = $this->cwriter_chapterid;
		    $cw_book_id= $this->cwriter_bookid; 
 
			    $cwriter_words = $_POST['cw_chapter_body'];
			    $cwriter_words = str_replace("<br />", " ", $cwriter_words);
			    $cwriter_words = strip_tags($cwriter_words);
			    $cwriter_words = preg_replace("/\s\s+/", " ", $cwriter_words);
			    $cwriter_temp = explode(" ", $cwriter_words);
			
			    $cwriter_wordcount = count($cwriter_temp);
			    if ($cw_chapter_id == 0)
			    {
			        // new chapter
			        $cwriter_arg = "
				0,
				'" . $tp->toDB($_POST['cw_chapter_title']) . "',
				'" . $tp->toDB($_POST['cw_chapter_number']) . "',
				'" . $tp->toDB($_POST['cw_chapter_body']) . "',
				'" . time() . "',
				'" . time() . "',
				'" . intval($cw_book_id) . "',
				'" . USERID . "." . USERNAME . "',
				'" . $cwriter_wordcount . "',
				'0',
				'" . $tp->toDB($_POST['cw_chapter_source']) . "'";
			        $cwriter_insid = $sql->insert("cw_chapters", $cwriter_arg, $debug);
			        $this->update_chapters($cw_book_id);
			    }
			    else
			    {
			        // update chapter
			        $cwriter_arg = "
				cw_chapter_title = '" . $tp->toDB($_POST['cw_chapter_title']) . "',
				cw_chapter_number = '" . $tp->toDB($_POST['cw_chapter_number']) . "',
				cw_chapter_body = '" . $tp->toDB($_POST['cw_chapter_body']) . "',
				cw_chapter_wordcount = '" . $cwriter_wordcount . "',
				cw_chapter_lastupdate = '" . time() . "',
				cw_chapter_source='" . $tp->toDB($_POST['cw_chapter_source']) . "'
				where cw_chapter_id=$cw_chapter_id";
			        $sql->update("cw_chapters", $cwriter_arg, $debug);
			    }
			    $this->update_chapters($cw_book_id);
			    $action = "chapters";
			}
 
 
  function delete_confirm_book() {
    $sql = e107::getDB();  
    				$tp  = e107::getParser();
	  $cw_chapter_id = $this->cwriter_chapterid;
    $cw_book_id= $this->cwriter_bookid; 
	
	  $cwriter_arg = "select *,count(cw_chapter_id) as numchap from #cw_book
		    left join #cw_chapters on cw_chapter_book=cw_book_id
		    where cw_book_id = $cw_book_id
			group by cw_book_id ";
		$sql->gen($cwriter_arg, false);
		
	  extract($sql->fetch());
		$cwriter_text .= "
			<form method='post' action='" . e_SELF . "' id='dataform'  class='$action'>
		<div>
			<input type='hidden' name='action' value='show' />
			<input type='hidden' name='cw_chapter_id' value='$cw_chapter_id' />
			<input type='hidden' name='cw_book_id' value='$cw_book_id' />
		
		</div>
		<table class='fborder' style='width:100%;'>
			<tr>
				<td  class='fcaption' >" . CWRITER_A83 . " - <em>" . $tp->toHTML($cw_book_title) . "</em></td>
			</tr>
				<tr>
				<td class='forumheader3'><a href='" . e_SELF . "?show'><img src='images/updir.png' style='border:0' alt='" . CWRITER_66 . "' title='" . CWRITER_66 . "'  /></a></td>
			</tr>
		
			<tr>
				<td  class='forumheader3' style='text-align:center;' ><strong>" . CWRITER_A84 . " <em>" . $tp->toHTML($cw_book_title) . "</em> " . CWRITER_A85 . " $numchap " . CWRITER_A86 . "</strong><br />
					<input class='button' type='submit' name='dobookcancel' value='" . CWRITER_A81 . "' />&nbsp;&nbsp;
					<input class='button' type='submit' name='dobookdel' value='" . CWRITER_A82 . "' />
				</td>
			</tr>
		</table>
		</form>";
		
		e107::getRender()->tablerender(CWRITER_01, $cwriter_text);
	}
	
  function delete_confirm_chapter() {
		    $sql = e107::getDB();  
		    $tp  = e107::getParser();
			  $cw_chapter_id = $this->cwriter_chapterid;
		    $cw_book_id= $this->cwriter_bookid;   
		    
		    $cwriter_arg = "select * from #cw_chapters
		    left join #cw_book on cw_chapter_book=cw_book_id
		    where cw_book_id = $cw_book_id and cw_chapter_id=$cw_chapter_id";
		    $sql->gen($cwriter_arg, false);
		
		    extract($sql->fetch());
		    
		    $cwriter_text .= "
		<form method='post' action='" . e_SELF . "' id='dataform' class='$action'
		 
			<input type='hidden' name='action' value='chapters' />
			<input type='hidden' name='cw_chapter_id' value='$cw_chapter_id' />
			<input type='hidden' name='cw_book_id' value='$cw_book_id' />
		 
		<table class='fborder' style='width:100%;'>
			<tr>
				<td  class='fcaption' >" . LAN_MB_ADMINISTER_CHAPTERS_IN_BOOK . " - <em>" . $tp->toHTML($cw_book_title) . "</em></td>
			</tr>
				<tr>
				<td class='forumheader3'> <a href='" . e_SELF . "?chapters.$cw_book_id.$cw_chapter_id'><img src='images/updir.png' style='border:0' alt='" . CWRITER_71 . "' title='" . CWRITER_71 . "'  /></a></td>
			</tr>
			<tr>
				<td  class='forumheader3' style='text-align:center;' ><strong>" . CWRITER_A80 . "</strong> $cw_chapter_number<br />
					<input class='button' type='submit' name='docancel' value='" . CWRITER_A81 . "' />&nbsp;&nbsp;
					<input class='button' type='submit' name='dodel' value='" . CWRITER_A82 . "' />
				</td>
			</tr>
		</table>
		</form>";  
		
		
     	e107::getRender()->tablerender(CWRITER_01, $cwriter_text);
  }
}
 