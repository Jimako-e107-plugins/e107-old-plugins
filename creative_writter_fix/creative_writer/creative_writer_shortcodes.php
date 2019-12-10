<?php

if (!defined('e107_INIT')) { exit; }

 
class plugin_creative_writer_creative_writer_shortcodes extends e_shortcode
{
 	protected $cwpref = array();
  
  public function __construct()
	{
     $this->cwpref = e107::pref('creative_writer');	
	}
 
  /* {CW_ADMIN_MANAGEBOOKS} */
 function sc_cw_admin_managebooks($parm)
	{
		if (check_class($this->cwpref['cwriter_admin']) || check_class($this->cwpref['cwriter_create']))
    {
      $options['class'] = vartrue($parm['class'],'btn btn-default btn-sm');
      //$url =  e_PLUGIN_ABS . "creative_writer/mybooks.php";
      $url = e107::url('creative_writer', "mybooks-index");
      $cwriter_text = '<a class="'.$options['class'].'" href="'.$url.'">'.CWRITER_32.'</a>';
 
      //$editbutton = $this->sc_cw_admin_newbook();
    }
    else $cwriter_text = '';
    
		return $cwriter_text.$editbutton;
	}
  
  /* {CW_ADMIN_NEWBOOK} */
 function sc_cw_admin_newbook($parm)
	{
 
    if (check_class($this->cwpref['cwriter_admin']) || check_class($this->cwpref['cwriter_create']))
    {
 
        $options['class'] = vartrue($parm['class'],'btn btn-default btn-sm');
        $url =     e_PLUGIN_ABS . "creative_writer/mybooks.php?add.0";
        $cwriter_text = '<a class="'.$options['class'].'" href="'.$url.'">'.CWRITER_203.'</a>';
       
    }
    else $cwriter_text = '';
    
		return $cwriter_text;
	}
  
  /* {CW_ADMIN_NEWCHAPTER} */
 function sc_cw_admin_newchapter($parm)
	{
		$cwriter_bookid = $this->var['cw_book_id'];
 
    if (check_class($this->cwpref['cwriter_admin']) || check_class($this->cwpref['cwriter_create']))
    {
      if($cwriter_bookid) {
        $options['class'] = vartrue($parm['class'],'btn btn-default btn-sm');
        $url =     e_PLUGIN_ABS . "creative_writer/mybooks.php?newchap.".$cwriter_bookid;
        $cwriter_text = '<a class="'.$options['class'].'" href="'.$url.'">'.CWRITER_303.'</a>';
      }
    }
    else $cwriter_text = '';
    
		return $cwriter_text;
	}  
  
  /*  {CW_CATEGORY_ICON} */
	function sc_cw_category_icon($parm = NULL)
	{
		if ($this->cwpref['cwriter_icons'] > 0) { 
      if (!empty($this->var['cw_category_icon'])  )
  		{
	  		$att['w'] = vartrue($parm['w']) ? $parm['w'] : e107::getParser()->thumbWidth(); // 190; // 160;
			  $att['h'] = vartrue($parm['h']) ? $parm['h'] : e107::getParser()->thumbHeight(); // 130;
			  $att['alt'] = $this->var['cw_category_name'];
        $att['style'] =  ' display: inline; ';        
	  		return e107::getParser()->toImage($this->var['cw_category_icon'], $att);
  	  }
    } 
	} 
	  
  /*  {CW_CATEGORY_NAME} */
	function sc_cw_category_name()
	{
	  return e107::getParser()->toHtml($this->var['cw_category_name'], true,'TITLE');
	}  
  
  /*  {CW_GENRE_ICON}  */
	function sc_cw_genre_icon($parm = NULL)
	{
		if ($this->cwpref['cwriter_icons'] > 0) { 
      if (!empty($this->var['cw_genre_icon'])  )
  		{
	  		$att['w'] = vartrue($parm['w']) ? $parm['w'] : e107::getParser()->thumbWidth(); // 190; // 160;
			  $att['h'] = vartrue($parm['h']) ? $parm['h'] : e107::getParser()->thumbHeight(); // 130;
			  $att['alt'] = $this->var['cw_genre_name'];
	  		return e107::getParser()->toImage($this->var['cw_genre_icon'], $att);
  	  }
    } 
	}
	  
  /*  {CW_GENRE_NAME} */
	function sc_cw_genre_name()
	{
    return e107::getParser()->toHtml($this->var['cw_genre_name'], true,'TITLE');
	} 
 
  
  /* {CW_CHAPTER_BODY} */
  function sc_cw_chapter_body()
	{
    return e107::getParser()->toHtml($this->var['cw_chapter_body'], true,'BODY');
	}
 
  
  /* todo add prefs */ /* {CW_CHAPTER_COMMENTS}  */ 
	function sc_cw_chapter_comments()
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
 
 
	function sc_cw_nav_button_back($parm)
	{
    $cwriter_bookid = $this->var['cwriter_bookid'];
 
		if($parm['type']=='show') {
		  $text = "<a href='" .e_PLUGIN_ABS. "creative_writer/cwriter.php?0.show'>      				
				<img src='".e_PLUGIN_ABS. "creative_writer/images/updir.png' style='border:0' alt='" . CWRITER_66 . "' title='" . CWRITER_66 . "' />      			</a>";
			return $text;
		}
    if($parm['type']=='precis' AND $cwriter_bookid > 0) {
    
    $urlparam= array(
      'cw_book_id'			=> $cwriter_bookid,
      );
    $url = e107::url('creative_writer', 'book', $urlparam);
    
		$text = "<a href='".$url."'>" . $cw_book_title . "</a>";
    
		  $text = "<a href='" .e_PLUGIN_ABS. $url."'>
				<img src='".e_PLUGIN_ABS. "creative_writer/images/updir.png' style='border:0'  alt='" . CWRITER_69 . "' title='" . CWRITER_69 . "'/></a>";
			return $text;
		}		 
		return $text;
	}  
  	
	function sc_cw_nav_button_email($parm)
	{
    $cwriter_bookid = $this->sc_cw_book_id();
		if($parm['type']=='book') {
		  $text = "			<a href='../../email.php?plugin:cwriter.{$cwriter_bookid}'>      				
				<img src='".e_PLUGIN_ABS. "creative_writer/images/email.png' style='border:0' alt='" . CWRITER_73 . "' title='" . CWRITER_73 . "' /></a>";
		}
		return $text;
	}	
	
	function sc_cw_nav_button_pdf($parm)
	{
    if (e107::isInstalled('pdf')) {
		$cwriter_bookid = $this->sc_cw_book_id();
		if($parm['type']=='book') {
			  $text = "	<a href='".e_PLUGIN_ABS. "creative_writer/cwriter_pdf.php?{$cwriter_bookid}'>      				
					<img src='".e_PLUGIN_ABS. "creative_writer/images/pdf_16.png' style='border:0' alt='" . CWRITER_72 . "' title='" . CWRITER_72 . "' />      			</a>";
			}
		}
		else $text = '';
		return $text;
	}	
 
	
	/* {CW_PAGINATION} */
	function sc_cw_pagination($parm)
	{
 
		$cwriter_amount		 = $this->cwpref['cwriter_perpage'];
		$cwriter_count		 = $this->var['cwriter_count'];
		$cwriter_from  		 = $this->var['cwriter_from']   ;
		$cwriter_npaction = "show";	
		
		$url = e107::url('creative_writer','creative_writer')."/[FROM]";		   
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

  
	/**
	* {CW_WRITER_HOME}
	*/
	public function sc_cw_writer_home($parm=null)
	{ 
    $url = e107::url('creative_writer','creative_writer');
 
    $options['class'] = vartrue($parm['class'],'btn btn-default btn-sm');
    if($parm['link']) {
      return $url;
    } 
		$text = '<a class="'.$options['class'].'" href="'.$url.'">'.CWRITER_01.'</a>';   		 
    return $text;
	}	
	
	/**
	* {CW_BREADCRUMBS}
	*/  
 	function sc_cw_breadcrumbs($parm='')
	{
    $parms = eHelper::scParams($parm);
    $level = empty($parm['level']) ? '1' : $parm['level'];	

    $breadcrumb = array();
    $breadcrumb[0] = array('url'=> e107::url('creative_writer','creative_writer'), 'text'=> CWRITER_01); 
 	 
   
    if (strpos(e_QUERY, 'chapters') !== false) {
        $breadcrumb[1] = array('url'=> e107::url('creative_writer','mybooks-index'), 'text'=> LAN_MB_ADMINISTER_BOOKS);
    }

    if($level == 1) {
      return e107::getForm()->breadcrumb($breadcrumb);
    }
  }
}
?>