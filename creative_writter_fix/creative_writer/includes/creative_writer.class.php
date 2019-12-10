<?php

 
e107::lan('creative_writer');
/* shortcodes moved to separate file */

class creative_writer
{
	
  protected 	$cwriter_from       = null;
	protected 	$action             = null;
	protected 	$cwriter_bookid     = null;
	protected   $cwriter_chapterid  = null;
	protected   $challenge_id  = null;  
  
	private     $plugTemplates      = array(); 
  
  public function __construct()
	{
 
		$this->cwpref = e107::pref('creative_writer');
		$this->cwriter_from =  0;

		$this->get = $_GET;
		$this->post = $_POST;
		 
    if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$this->cwriter_from = intval($_POST['cwriter_from']);
			$this->action = $_POST['action'];
			$this->cwriter_bookid = intval($_POST['cwriter_bookid']);
      $this->cwriter_chapterid = intval($_POST['cwriter_chapterid']);     
    } elseif (e_QUERY)
    {
    	$cwriter_temp = explode(".", e_QUERY);
      $this->cwriter_from = intval($cwriter_temp[0]);
			$this->action = $cwriter_temp[1];
			$this->cwriter_bookid = intval($cwriter_temp[2]);
      $this->cwriter_chapterid = intval($cwriter_temp[3]); 
    }
    $this->setMode($this->action);
    
    $this->sc_book = e107::getScBatch('book','creative_writer');   
    $this->sc = e107::getScBatch('creative_writer','creative_writer');  

		$this->plugTemplates   = e107::getTemplate('creative_writer');
   
		if (array_key_exists('p', $this->get)) {
   		$this->cwriter_from = intval($this->get['p']);  
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
	
	public function render($action)
	{
 
    if($action) { $this->setMode($action); }
		
		$ns = e107::getRender();
  
    if($this->getMode() == 'show') {
        $text = $this->filter('filter');
		   	$text .= $this->show();
				$ns->tablerender(CWRITER_01,  $text, 'creative_writer-show');
		}     
		elseif($this->getMode() == 'review') {      
		   	$text = $this->review();
				$ns->tablerender(CWRITER_01,  $text, 'creative_writer-review');
		}              
		elseif($this->getMode() == 'homefilter')  {        
       // $text  = $this->filter('filter');
		   	$text  = $this->filter('homefilter');
				$ns->tablerender(CWRITER_01,  $text, 'creative_writer-filter');
		}
    // displays book under challenge
    elseif($this->getMode() == 'challenge') {          
  		   	$text .= $this->showChallenge($this->challenge_id);
  				$ns->tablerender('',  $text, 'creative_writer-challenge');
  	} 
		else
		{
		$text = 'Something is wrong';
		$ns->tablerender('Caption',  $text, 'creative_writer-view');
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
 
	function show() {
 
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();
	    
      $cwriter_bookid =  $this->cwriter_bookid;
      $cwriter_chapterid =  $this->cwriter_chapterid;
      $cwriter_from =  $this->cwriter_from;
      $action = $this->action;
			
			$tmpl = $this->plugTemplates;
			$this->sc->wrapper('creative_writer/booklist');	
 
		    // build up complex where for the filtering
		    if (intval(e107::getSession()->get('cwriter_category')) > 0)
		    {
		        $cwriter_where .= " and cw_book_category=" . intval(e107::getSession()->get('cwriter_category'));
		    }
		    if (intval($_POST['cwriter_genre']) > 0)
		    {
		        $cwriter_where .= " and cw_book_genre=" . intval(e107::getSession()->get('cwriter_genre'));
		    }
		    switch (intval(e107::getSession()->get('cwriter_completion')))
		    {
		        case 1:
		            $cwriter_where .= " and cw_book_complete=0";
		            break;
		        case 2:
		            $cwriter_where .= " and cw_book_complete=1";
		            break;
		    }
		    $author=e107::getSession()->get('cwriter_author');
		    if (!empty($author))
		    {
		        $cwriter_where .= " and cw_book_user_id='" . e107::getSession()->get('cwriter_author'). "'";
		    }
        $character=e107::getSession()->get('cwriter_characters');
		    if (!empty($character))
		    {
		        $cwriter_where .= " and find_in_set('" .e107::getSession()->get('cwriter_characters') . "',cw_book_characters)";
		    }
		    // $_SESSION['cwriter_characters'] = $_POST['cwriter_characters'];
		    $cwriter_arg = "
		select * from #cw_book
		left join #cw_category on cw_category_id=cw_book_category
		left join #cw_genre on cw_genre_id=cw_book_genre
		where cw_book_approved=1 and cw_book_visible=1 and find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
		$cwriter_where
		order by cw_book_title";
		    $cwriter_count = $sql->gen($cwriter_arg, false);
		    
		    ($this->cwpref['cwriter_perpage'] > 0?$cwriter_arg .= " limit $cwriter_from," . $this->cwpref['cwriter_perpage']:"");
		  
			  
       if($allRows = $sql->retrieve($cwriter_arg, true))
       {
        	  if ($this->cwpref['cw_visibility_complete'] > 0)  {
	   	  			$cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['start'], true, $this->sc);
        		}
        		else {
						  $cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['start-2'], true, $this->sc);
						}
					
  
          foreach($allRows as $cwriter_row)
        	{
        		$cwriter_row['cwriter_from'] = $cwriter_from;
  		      $cwriter_row['cwriter_count'] = $cwriter_count;
  		      $this->sc_book->setVars($cwriter_row);
          	$this->sc_book->wrapper('creative_writer/booklist');	
          	if ($this->cwpref['cw_visibility_complete'] > 0)  {
	   	  			$cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['item'], true, $this->sc_book); 
        		}
        		else {
						  $cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['item-2'], true, $this->sc_book); 
						}
        
          	 
        	}
        	$scvar['cwriter_count'] = $cwriter_count;
        	$scvar['cwriter_from'] = $cwriter_from;        	
        	$this->sc->setVars($scvar);
          $cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['end'], true, $this->sc); 
       }
 
		    else {
				 $cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['nobooks'], true, $this->sc); 
				 }
		  return  $cwriter_text;
	}
  
	function showChallenge($challenge_id) {
 
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();
	    
      $cwriter_bookid =  $this->cwriter_bookid;
      $cwriter_chapterid =  $this->cwriter_chapterid;
      $cwriter_from =  $this->cwriter_from;
      $action = $this->action;
			
			$tmpl = $this->plugTemplates;
			$this->sc_book->wrapper('book/book'); 	
 
		    $cwriter_arg = "
		select * from #cw_book
		left join #cw_category on cw_category_id=cw_book_category
		left join #cw_genre on cw_genre_id=cw_book_genre
		where cw_book_challenge=$challenge_id AND  cw_book_approved=1 and cw_book_visible=1 and find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
		$cwriter_where
		order by cw_book_title";
		    $cwriter_count = $sql->gen($cwriter_arg, false);
 
		    ($this->cwpref['cwriter_perpage'] > 0?$cwriter_arg .= " limit $cwriter_from," . $this->cwpref['cwriter_perpage']:"");
		   
       if($allRows = $sql->retrieve($cwriter_arg, true))
       {
        	$cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['start'], true, $this->sc_book); 
          foreach($allRows as $cwriter_row)
        	{
        		$cwriter_row['cwriter_from'] = $cwriter_from;
  		      $cwriter_row['cwriter_count'] = $cwriter_count;
  		      $this->sc_book->setVars($cwriter_row);
          	$this->sc_book->wrapper('creative_writer/booklist');	
          	$cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['item'], true, $this->sc_book);    
        	}
          $cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['end'], true, $this->sc_book); 
       }
 
		    else {
				 $cwriter_text  .= $tp->parseTemplate($tmpl['booklist']['nobooks'], true, $this->sc_book); 
				 }
		  return  $cwriter_text;
	} 
  
	function filter($type = 'filter') {
 
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();
	    
      $cwriter_bookid =  $this->cwriter_bookid;
      $cwriter_chapterid =  $this->cwriter_chapterid;
      $cwriter_from =  $this->cwriter_from;
      $action = $this->action;
      $tmpl = $this->plugTemplates;
 
         
        if (!empty($_POST['dofilter']))
		    {    
		       	e107::getSession()->set('cwriter_category', intval($_POST['cwriter_category']));   
            e107::getSession()->set('cwriter_genre', intval($_POST['cwriter_genre']));
            e107::getSession()->set('cwriter_characters', $tp->toDB($_POST['cwriter_characters']));
            e107::getSession()->set('cwriter_author', $tp->toDB($_POST['cwriter_author']));
            e107::getSession()->set('cwriter_completion', intval($_POST['cwriter_completion'])); 
		    }
 
		    $cwriter_catsel  =  $this->getCategory('select');
		    $cwriter_gensel  =  $this->getGenreSelect();
        $cwriter_charsel =  $this->getCharacterSelect();
		    $cwriter_compsel =  $this->getCompleteSelect();
		    $cwriter_authsel =  $this->getAuthorsList();
 
 				$var = array('CWRITER_AUTHSEL' => $cwriter_authsel,      
                     'CWRITER_COMPSEL' => $cwriter_compsel,
                     'CWRITER_CHARSEL' => $cwriter_charsel,
                     'CWRITER_GENSEL'  => $cwriter_gensel,
                     'CWRITER_CATSEL'  => $cwriter_catsel,
                     
        );
        
		    $cwriter_text  = $tp->parseTemplate($tmpl[$type]['open'], true, $this->sc);
		    if ($this->cwpref['cw_visibility_complete'] > 0)  {
	   	  	$cwriter_text .= $tp->parseTemplate($tmpl[$type]['captions'], true, $this->sc);	 
	   	  	$cwriter_text .= $tp->simpleParse( $tmpl[$type]['column'], $var) ;
        }
        else {
				 	$cwriter_text .= $tp->parseTemplate($tmpl[$type]['captions-2'], true, $this->sc);	 
				 	$cwriter_text .= $tp->simpleParse( $tmpl[$type]['column-2'], $var) ;
				}
         
        
 
        $cwriter_text .= $tp->parseTemplate($tmpl[$type]['close'], true, $this->sc);

 
		  return  $cwriter_text;
	}
 
  function review() {
    $sql = e107::getDB();
	  $tp  = e107::getParser();
	  $frm = e107::getForm();
 
    $cwriter_conv = e107::getDateConvert();
    
    $cwriter_bookid =  $this->cwriter_bookid;
    $cwriter_chapterid =  $this->cwriter_chapterid;
    $cwriter_cwriter_from =  $this->cwriter_from;
    $action = $this->action;
    
    $urlparam= array(
      'cw_book_id'			=> $cwriter_bookid,
      );
    $url = e107::url('creative_writer', 'book', $urlparam);    
    
      // review
    $cwriter_updir = "<a href='" . $url."'><img src='./images/updir.png' alt='" . CWRITER_69 . "' title='" . CWRITER_69 . "' /></a>";
    $sql->db_Select("cw_book", "cw_book_title", "where cw_book_id=$cwriter_bookid", "nowhere", false);
    extract($sql->db_Fetch());
    $cwriter_text = "
<form action='" . e_SELF . "' method='post' id='dataform' >
<div>
	<input type='hidden' name='cwriter_bookid' value='$cwriter_bookid' />
	<input type='hidden' name='cwriter_chapterid' value='$cwriter_chapterid' />
</div>
	<table class='fborder' style='width:100%'>
		<tr>
			<td class='fcaption' colspan='2'>" . CWRITER_219 . " - " . $tp->toHTML($cw_book_title) . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>$cwriter_updir&nbsp;</td>
		</tr>";
    $cwriter_arg = "select * from #cw_review
	left join #cw_book on cw_review_book=cw_book_id
	where cw_review_book=$cwriter_bookid
	order by cw_review_posted desc";
    $cwriter_reviewed = false;
    if ($sql->db_Select_gen($cwriter_arg, false))
    {
        while ($cwriter_row = $sql->db_Fetch())
        {
            extract($cwriter_row);
            $cwriter_tm = explode(".", $cw_reviewer, 2);
            if ($cwriter_tm[0] == USERID)
            {
                $cwriter_reviewed = true;
            }
            $cwriter_text .= "
        <tr>
			<td class='forumheader2' colspan='2'>" . CWRITER_220 . " <strong>" . $cwriter_tm[1] . "</strong> " . CWRITER_221 . " <strong>" . $cwriter_conv->convert_date($cw_review_posted, "short") . "</strong></td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>" . $tp->toHTML($cw_review, true) . "</td>
		</tr>
";
        } // while
    }
    else
    {
        $cwriter_text .= "
        <tr>
			<td class='forumheader2' style='text-align:center;' colspan='2'><strong>" . CWRITER_217 . "</strong></td>
		</tr>";
    }
    // If not reviewed then do a form
    if (!$cwriter_reviewed && USER)
    {
        $cwriter_text .= "
        <tr>
			<td class='forumheader2' colspan='2'>" . CWRITER_222 . "</td>
		</tr>
    	<tr>
			<td class='forumheader3' style='width:15%;'>" . CWRITER_223 . "</td>
			<td class='forumheader3' >
				<textarea class='tbox' style='width:90%;' rows='6' cols='50' name='cwreview' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ></textarea>
				<br /><input type='text' style='width:85%;border:0;' class='tbox' id='helpb' />
				<br />" . display_help("helpb") . "</td>
		</tr>
        <tr>
			<td class='fcaption' colspan='2'><input class='tbox' type='submit' name='subrev' value='" . CWRITER_224 . "' /></td>
		</tr>";
    }
    else
    {
        $cwriter_text .= "
            <tr>
			<td class='fcaption' colspan='2'>&nbsp;</td>
		</tr>";
    }
    $cwriter_text .= "
	</table>
</form>";
   return  $cwriter_text;
  }
 
  function getAuthorsList($parm=null) {
	    $sql = e107::getDB();
	    $tp  = e107::getParser();
	    $frm = e107::getForm();
      
      /* $cwriter_arg = "select distinct b.cw_book_user_id, u.user_name 
      from #cw_book AS b  
      LEFT JOIN #user AS u ON user_id = cw_book_user_id  
      ORDER by  user_name"; - it's slower */ 
      $cwriter_arg = "select distinct cw_book_author from #cw_book order by substring(cw_book_author,locate('.',cw_book_author))";
      if ($allRows = $sql->retrieve($cwriter_arg, true))
	    {     
	        $opts[0] =  CWRITER_20;
           
          foreach($allRows as $cwriter_row)
        	{  
            $cwriter_tmp = explode(".", $cwriter_row['cw_book_author'], 2);
		        $opts[$cwriter_tmp[0]]  = $cwriter_tmp[1];                   
        	}  
	    }
	    else
	    {
	        $cwriter_authsel .= "<option value='' >" . CWRITER_08 . "</option>";
	    }   
      
      foreach($opts AS $key => $option)   
      {
        $selected = (e107::getSession()->get('cwriter_author')  == $key ? TRUE : FALSE);
        $options .= $frm->option($option, $key, $selected );   
      }         
      //title="Choose One" data-live-search="true" data-style="btn-primary"
      $cwriter_authsel =  $frm->select_open('cwriter_author', array(
         'class' => 'form-control selectpicker show-tick',
         'data-style' => 'btn-primary',
         'data-live-search' => 'true',        
        ));

      $cwriter_authsel .=  $options;
      $cwriter_authsel .=  $frm->select_close();    
      return $cwriter_authsel;
  }


  function getCharacterSelect($parm=null) {  
        $sql = e107::getDB();
  	    $tp  = e107::getParser();
  	    $frm = e107::getForm(); 
 
		    if ($allRows =  $sql->retrieve("cw_character", "cw_character_id,cw_character_name",  " WHERE true order by cw_character_name", true ))
		    {
		        $opts[0] = LAN_CW_ANY_CHARACTER;
		        foreach($allRows as $cwriter_row)  
		        {		 
		          $name = $tp->toFORM($cwriter_row['cw_character_name']);
		          $opts[$name]  = $name;  
		        }
		    }
		    else
		    {
		        $opts[0] = LAN_CW_NO_CHARACTER;  
		    }
        
        foreach($opts AS $key => $option)   
        {
          $selected = (e107::getSession()->get('cw_character') == $key ? TRUE : FALSE);
          $options .= $frm->option($option, $key, $selected );   
        }
        $cwriter_charsel =  $frm->select_open('cw_character', array(
         'class' => 'form-control selectpicker show-tick',
         'data-style' => 'btn-primary',
         'data-live-search' => 'true',        
        ));

      $cwriter_charsel .=  $options;
      $cwriter_charsel .=  $frm->select_close();    
      return $cwriter_charsel;		     
  
  }
  
  /* @param type:  array - returns arrays of categories - used in e_search addon
                   select -  return select html code - used in filter, forms    */ 
 
  function getCategory($type='array') {  
        $sql = e107::getDB();
  	    $tp  = e107::getParser();
  	    $frm = e107::getForm(); 
 
        $where = " find_in_set(cw_category_class,'" . USERCLASS_LIST . "') or 1=1 order by cw_category_name";
        
		    if ($allRows =  $sql->retrieve("cw_category", "cw_category_id,cw_category_name",  $where, true ))
		    {
            $opts[0] =  array('id' => 0, 'title' => LAN_CW_ALL_CATEGORIES);
		        foreach($allRows as $cwriter_row)  
		        {		 
		          $name = $tp->toFORM($cwriter_row['cw_category_name']);
              $opts[] = array('id' => $cwriter_row['cw_category_id'], 'title' => $name);  
		        }
		    }
		    else
		    {
		        $opts[0] = LAN_CW_NO_CHALLENGES;  
		    }
       
        if($type == 'select') {        
            foreach($opts as $option)   
            { 
              $selected = (e107::getSession()->get('cwriter_category') == $option['id'] ? TRUE : FALSE);
              $options .= $frm->option($option['title'], $option['id'], $selected );   
            }
          $cwriter_catsel =  $frm->select_open('cwriter_category', array(
             'class' => 'form-control selectpicker show-tick',
             'data-style' => 'btn-primary',
             'data-live-search' => 'true',        
            ));
    
          $cwriter_catsel .=  $options;
          $cwriter_catsel .=  $frm->select_close();    
          
          return $cwriter_catsel;	  
        }
        else  return $opts;   
  }
 
  function getGenreSelect($parm=null) {  
        $sql = e107::getDB();
  	    $tp  = e107::getParser();
  	    $frm = e107::getForm(); 
 
		    if ($allRows =  $sql->retrieve("cw_genre", "cw_genre_id,cw_genre_name",  " WHERE true order by cw_genre_name", true ))
		    {
		        $opts[0] = LAN_CW_ALL_GENRES;
		        foreach($allRows as $cwriter_row)  
		        {		 
		          $name = $tp->toFORM($cwriter_row['cw_genre_name']);
		          $opts[$cwriter_row['cw_genre_id']]  = $name;  
		        }
		    }
		    else
		    {
		        $opts[0] = LAN_CW_NO_GENRES;  
		    }
        
        foreach($opts AS $key => $option)   
        {
          $selected = (e107::getSession()->get('cwriter_genre')  == $key ? TRUE : FALSE);
          $options .= $frm->option($option, $key, $selected );   
        }
      $cwriter_gensel =  $frm->select_open('cwriter_genre', array(
         'class' => 'form-control selectpicker show-tick',
         'data-style' => 'btn-primary',
         'data-live-search' => 'true',        
        ));

      $cwriter_gensel .=  $options;
      $cwriter_gensel .=  $frm->select_close();    
      return $cwriter_gensel;		     
        
     return $cwriter_gensel;   
  }  
 
  
  function getCompleteSelect($parm=null) {  
        $frm = e107::getForm();
        $cwriter_compsel =  $frm->select_open('cwriter_completion', array(
         'class' => 'form-control selectpicker show-tick',
         'data-style' => 'btn-primary',
         'data-live-search' => 'true',        
        ));
		    $cwriter_compsel .= " 
		        <option value='0'  " . (e107::getSession()->get('cwriter_completion') == 0?"selected='selected'":"") . "  >" . LAN_CW_EITHER . "</option>
		        <option value='1'  " . (e107::getSession()->get('cwriter_completion') == 1?"selected='selected'":"") . " >" . LAN_CW_INCOMPLETE . "</option>
		        <option value='2'  " . (e107::getSession()->get('cwriter_completion') == 2?"selected='selected'":"") . " >" . LAN_BOOK_COMPLETE . "</option>
		        </select>";
      return $cwriter_compsel;     
  }

  function getChallengeSelect($parm=null) {  
        $sql = e107::getDB();
  	    $tp  = e107::getParser();
  	    $frm = e107::getForm(); 
 
		    if ($allRows =  $sql->retrieve("cw_challenge", "cw_challenge_id,cw_challenge_name",  " WHERE true order by cw_challenge_name", true ))
		    {
		        $opts[0] = LAN_CW_ALL_CHALLENGES;
		        foreach($allRows as $cwriter_row)  
		        {		 
		          $name = $tp->toFORM($cwriter_row['cw_challenge_name']);
		          $opts[$cwriter_row['cw_challenge_id']]  = $name;  
		        }
		    }
		    else
		    {
		        $opts[0] = LAN_CW_NO_CHALLENGES;  
		    }
        
        foreach($opts AS $key => $option)   
        {
          $selected = (e107::getSession()->get('cwriter_challenge')  == $key ? TRUE : FALSE);
          $options .= $frm->option($option, $key, $selected );   
        }
      $cwriter_chalsel =  $frm->select_open('cwriter_challenge', array(
         'class' => 'form-control selectpicker show-tick',
         'data-style' => 'btn-primary',
         'data-live-search' => 'true',        
        ));

      $cwriter_chalsel .=  $options;
      $cwriter_chalsel .=  $frm->select_close();    
      return $cwriter_chalsel;		     
  
  } 
	    
}
 