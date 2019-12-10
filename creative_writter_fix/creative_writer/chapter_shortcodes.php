<?php

if (!defined('e107_INIT')) { exit; }

e107::lan('creative_writer');
 
class plugin_creative_writer_chapter_shortcodes extends e_shortcode
{
 	protected $cwpref = array();
  
  public function __construct()
	{
     $this->cwpref = e107::pref('creative_writer');	
	}
	

 
  /* {CW_CHAPTER_BODY} */
  function sc_cw_chapter_body()
	{
    return e107::getParser()->toHtml($this->var['cw_chapter_body'], true,'BODY');
	}
 
  /*  {CW_CHAPTER_CATEGORY_NAME} */
	function sc_cw_chapter_category_name()
	{
	  $where = " cw_category_id = ".$this->var['cw_book_category'];	  
		$text =  e107::getDb()->retrieve('cw_category', 'cw_category_name', $where);
		return e107::getParser()->toHtml($text, true,'TITLE');
	} 
	
	/* {CW_CHAPTER_BOOK_AUTHOR} */           
  function sc_cw_chapter_book_author($parm)
	{
    $cwriter_tmp = explode(".", $this->var['cw_book_author'], 2);
   	if($this->var['cw_book_author'])
		{
			$userData = e107::user($cwriter_tmp[0]); // Example  User ID #5.
      if($parm == 'nolink')
			{
				return $userData['user_name'];
			}
			else
			{
				return "<a href='".e107::getUrl()->create('user/profile/view', $userData)."'>".$cwriter_tmp[1]."</a>";
			}
		}
		else return "<a href='".SITEURL."'>".SITENAME."</a>"; 
	}
	
	/* {CW_CHAPTER_BOOK_EXTERNAL} */           
  function sc_cw_chapter_book_external($parm)
	{
    if($this->var['cw_book_external']) {
      $text = "";		
		} 
		else $text = LAN_BOOK_EXTERNAL; 
		return $text;
	}
  
	/*  {CW_CHAPTER_BOOK_CHARACTERS} */
  function sc_cw_chapter_book_characters()
	{
    return e107::getParser()->toHtml($this->var['cw_book_characters'], true,'TITLE'); 
	}
	
  /*  {CW_CHAPTER_BOOK_SUMMARY} */
	function sc_cw_chapter_book_summary()
	{             
    return e107::getParser()->toHtml($this->var['cw_book_summary'], true,'SUMMARY');
	}
	
	
  /* {CW_CHAPTER_BOOK_TITLE}  */
	function sc_cw_chapter_book_title()
	{
 
		return e107::getParser()->toHtml($this->var['cw_book_title'], true,'TITLE');
	}
  
  /* {CW_CHAPTER_COMMENTS} */
	function sc_cw_chapter_comments()
	{  	
    if ($this->var['cw_book_comments'] == 1 && $this->cwpref['cwriter_usecomments'] == 1 ) {       
			$templates   = e107::getTemplate('creative_writer', 'chapter');
      $cwriter_text  = $templates['chaptercomment']['start']; 
      $cwriter_text .= e107::getParser()->parseTemplate($templates['chaptercomment']['body'] , true, $this); 
      $cwriter_text .= $templates['chaptercomment']['end'];    
        
    }
    else  $cwriter_text = '';
    return $cwriter_text;
	}  
  
  /* {CW_CHAPTER_e107_COMMENTS}  */ 
	function sc_cw_chapter_e107_comments()
	{  	
    if ($this->var['cw_book_comments'] == 1 && $this->cwpref['cwriter_usecomments'] == 1 ) {       
			$cwriter_chapterid = $this->sc_cw_chapter_id();
			$comment_to = ($this->var['cw_book_comments'] == 1 && $this->cwpref['cwriter_usecomments'] == 1 ?$cwriter_chapterid:0);
      $comment_sub = "Re: " . e107::getParser()->toFORM($this->var['cw_chapter_title, false']);
      if ($comment_to > 0 && $this->cwpref['cwriter_usecomments'] > 0)
			{
			 //$cwriter_text =  e107::getComment()->compose_comment("cwbook", "comment", $comment_to, null, $comment_sub, false, 'html');
       $cwriter_text =  e107::getComment()->render('cwbook_chapter', $comment_to, $comment_sub, false);
			}  
    }
    else  $cwriter_text = '';
    return $cwriter_text;
	}
 
    /* {CW_CHAPTER_FB_COMMENTS} */ 
	function sc_cw_chapter_fb_comments()
	{  	
    if ($this->var['cw_book_comments'] == 1 && $this->cwpref['cwriter_usecomments'] == 1 ) {       
			$cwriter_chapterid = $this->sc_cw_chapter_id();
			$comment_to = ($this->var['cw_book_comments'] == 1 && $this->cwpref['cwriter_usecomments'] == 1 ?$cwriter_chapterid:0);
      $comment_sub = "Re: " . e107::getParser()->toFORM($this->var['cw_chapter_title, false']);
      if ($comment_to > 0 && $this->cwpref['cwriter_usecomments'] > 0)
			{
			 //$cwriter_text =  e107::getComment()->compose_comment("cwbook", "comment", $comment_to, null, $comment_sub, false, 'html');
        $params = array('cwbook_book', "comment", $comment_to, $comment_sub, false, 'html');
        $obj = e107::getAddon('social','e_comment');
        $cwriter_text = e107::callMethod($obj, 'facebook', $params);
			}  
    }
    else  $cwriter_text = '';
    return $cwriter_text;
	}

  /* {CW_CHAPTER_COMMENT_COUNT}  */  
	public function sc_cw_chapter_comment_count($parm=null)
	{
		if ($this->var['cw_book_comments'] == 1 && $this->cwpref['cwriter_usecomments'] == 1 ) 
    {
     	 $cwriter_chapterid = $this->sc_cw_chapter_id();
       $count_comments = e107::getComment()->count_comments('cwbook_chapter', $cwriter_chapterid);
  		return $count_comments;
	  }
  else 	return null;
	}
  
  /* {CW_CHAPTER_COMMENT_LABEL=short}  */  
	public function sc_cw_chapter_comment_label($parm=null)
	{
		
    return ($this->news_item['news_comment_total'] == 1) ? COMLAN_8 : LAN_COMMENTS;
	}
  
  /* {CW_CHAPTER_CREATED=short}  */
	function sc_cw_chapter_created($parm)
	{ 
		$date = ($this->var['cw_chapter_created'] > 0) ? $this->var['cw_chapter_created'] : $this->var['cw_chapter_created'];
		$con = e107::getDate();
		$tp = e107::getParser();

		if($parm == '')
		{
			return  $tp->toDate($date, 'long');
		}
		switch($parm)
		{
			case 'long':
			return  $tp->toDate($date, 'long');
			break;
			case 'short':
			return  $tp->toDate($date, 'short');
			break;
			case 'forum':
			return  $con->convert_date($date, 'forum');
			break;
			default :
			return $tp->toDate($date,$parm);
		//	return date($parm, $date);
			break;
		}
	}
	
	/**
	* {CW_CHAPTER_HOME}
	*/
	public function sc_cw_chapter_home($parm=null)
	{ 
    $url = e107::url('creative_writer','chapters');
    $options['class'] = vartrue($parm['class'],'btn btn-default btn-sm');
		$text = '<a class="'.$options['class'].'" href="'.$url.'">'.LAN_CHAPTER_003.'</a>';   		 
    return $text;
	}	
  
  /* {CW_CHAPTER_ID} */
  function sc_cw_chapter_id()
	{
    return (int)$this->var['cw_chapter_id'];
	}
	
  /* {CW_CHAPTER_LASTUPDATE=short}  */
	function sc_cw_chapter_lastupdate($parm)
	{ 
		$date = ($this->var['cw_chapter_created'] > 0) ? $this->var['cw_chapter_created'] : $this->var['cw_chapter_created'];
		$con = e107::getDate();
		$tp = e107::getParser();

		if($parm == '')
		{
			return  $tp->toDate($date, 'long');
		}
		switch($parm)
		{
			case 'long':
			return  $tp->toDate($date, 'long');
			break;
			case 'short':
			return  $tp->toDate($date, 'short');
			break;
			case 'forum':
			return  $con->convert_date($date, 'forum');
			break;
			default :
			return $tp->toDate($date,$parm);
		//	return date($parm, $date);                         
			break;
		}
	}
	
  
  /* {CW_CHAPTER_NUMBER} */
  function sc_cw_chapter_number()
	{
    return (int)$this->var['cw_chapter_number'];
	}

  /* {CW_CHAPTER_NAME} */
	function sc_cw_chapter_name()
	{
    return e107::getParser()->toHtml($this->var['cw_chapter_title'], true,'TITLE');
	}
 
  /* {CW_CHAPTER_URL} */
  function sc_cw_chapter_url()
	{
   	$urlparam= array(
                'cw_book_id'			=> $this->var['cw_book_id'],
                'cw_chapter_id'		=> $this->var["cw_chapter_id"]
                );  
    $url = e107::url('creative_writer', 'chapter', $urlparam);
 
		return $url;  
	}
  
    
  /* {CW_CHAPTER_VIEWS} */
  function sc_cw_chapter_views()
	{
    return (int)$this->var['cw_chapter_views'];
	}

  
  /* {CW_CHAPTER_PREV_FULL} */
  function sc_cw_chapter_prev_full() {

     $previous = $this->var['cw_chapter_prev'];
 
     if($previous > 0 ) {
 
    	$urlparam= array(
					'cw_book_id'			=> $this->var['cw_book_id'],
					'cw_chapter_id'		=> $previous
			);
		  $url = e107::url('creative_writer', 'chapter', $urlparam);
 
      $cwriter_text .= "
			<div style='float: left;width: 49%;text-align:left;'>
				<a class='btn btn-primary' href='" .$url. "'>
					<img src='".e_PLUGIN. "creative_writer/images/prev.png' style='border:0;' title='" . LAN_CHAPTER_050 . "' alt='" . LAN_CHAPTER_050 . "' />
				</a>
			</div>";
     } 
     else {
       $cwriter_text .= "<div style='float: left;width: 49%;text-align:left;'>&nbsp;</div>";
     }
     
    return $cwriter_text;
  }
  
  /* {CW_CHAPTER_NEXT_FULL} */
  function sc_cw_chapter_next_full() {
     $next = $this->var['cw_chapter_next'];
     
     if($next > 0) {;
 
		  $urlparam= array(
						'cw_book_id'			=> $this->var['cw_book_id'],
						'cw_chapter_id'		=> $next
				);
		  $url = e107::url('creative_writer', 'chapter', $urlparam);
		   
      $cwriter_text .= "
    	<div style='float: right;width: 49%;text-align:right;'>
				<a class='btn btn-primary' href='" .$url. "'>
					<img src='".e_PLUGIN. "creative_writer/images/next.png' style='border:0;' title='" . LAN_CHAPTER_049 . "' alt='" . LAN_CHAPTER_049 . "' />
				</a>
			</div>";
     } 
     else {
       $cwriter_text .= "<div style='float: left;width: 49%;text-align:left;'>&nbsp;</div>";
     }
     
    return $cwriter_text;
  }
  
	
	/* {CW_CHAPTER_PAGINATION} */
	function sc_cw_chapter_pagination($parm)
	{
 
		$cwriter_amount		 = $this->cwpref['cwriter_chapterperpage'];
		$cwriter_count		 = $this->var['cwriter_count'];
		$cwriter_from  		 = $this->var['cwriter_from']  ;
		$cwriter_npaction = "";	
		
		
		$url = e107::url('creative_writer','chapters')."/[FROM]";
		
				   
 		$nextprev = array(
				'tmpl_prefix'	=>'default',
				'total'			=> $cwriter_count,
				'amount'		=> $cwriter_amount,
				'current'		=> $cwriter_from,
				'url'			=> $url  
 
		);
 
		       
		$nextprev_parms  = http_build_query($nextprev,false,'&');	
		
		$cwriter_nextprev = e107::getParser()->parseTemplate("{NEXTPREV={$nextprev_parms}}") . "";
 
		return $cwriter_nextprev;
	}
 
  /* {CW_CHAPTER_WORDCOUNT} */
  function sc_cw_chapter_wordcount()
	{
    if($this->var['cw_book_external']) {
		   return LAN_BOOK_EXTERNAL_SOURCE;
		}
		else return (int)$this->var['cw_chapter_wordcount'];
	} 
 
}
?>