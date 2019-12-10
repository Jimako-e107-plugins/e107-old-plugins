<?php

if (!defined('e107_INIT')) { exit; }

e107::lan('creative_writer');
 
class plugin_creative_writer_book_shortcodes extends e_shortcode
{
 	protected $cwpref = array();
  
  public function __construct()
	{
     $this->cwpref = e107::pref('creative_writer');	
	}
  
  

	
	
	/* {CW_BOOK_AUTHOR} */           
  function sc_cw_book_author($parm)
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

	
  /*  {CW_BOOK_COMPLETE} */ 
  function sc_cw_book_complete()
	{
    if ($this->cwpref['cw_visibility_complete'] > 0) { 
		 $text = ($this->var['cw_book_complete'] == 1?'<i class="fa  fa-check" aria-hidden="true"></i>':"&nbsp;");
     return $text;
    }
    else return '';
	}
  
  function sc_cw_book_created()
	{
    return e107::getParser()->toDate($this->var['cw_book_created']);
	}
  
  /* {CW_BOOK_CHAPTERS} */
  function sc_cw_book_chapters()
	{
    return (int)$this->var['cw_book_chapters']; 
	}  
	
 
  
  /* {CW_BOOK_TITLE}  */
	function sc_cw_book_title()
	{
 
		return e107::getParser()->toHtml($this->var['cw_book_title'], true,'TITLE');
	}
 
 
  function sc_cw_book_chapters_list()
	{
  	$cw_book_chapters =  $this->var['cw_book_chapters'];
  	$cwriter_bookid = $this->var['cw_book_id'];  
     
    $cwriter_arg = "select cw_chapter_id, cw_chapter_number 
		from #cw_chapters   
    where cw_chapter_book = ".$cwriter_bookid . " ORDER BY cw_chapter_number " ;
    
    
    if($allRows = e107::getDB()->retrieve($cwriter_arg, true))
    {
    	foreach($allRows as $row)
    	{ 
    		$urlparam= array(
                'cw_book_id'			=> $cwriter_bookid,
                'cw_chapter_id'		=> $row["cw_chapter_id"]
                );  
        $url = e107::url('creative_writer', 'chapter', $urlparam);
        
        $cwriter_text .= "<a href='" .$url."'>-".$row['cw_chapter_number']."-</a>&nbsp;&nbsp;";
    	}
    }     
 
    $cwriter_text .= ""; 
  	return $cwriter_text;
	} 
 
  function sc_cw_book_characters()
	{
    if($this->var['cw_book_characters']) {
      return e107::getParser()->toHtml($this->var['cw_book_characters'], true,'TITLE'); 
    }
    else return '--';
	}  
  
	function sc_cw_book_disclaimer()
	{
    if ($this->cwpref['cw_visibility_disclaimer'] > 0) {
      return e107::getParser()->toHtml($this->var['cw_book_disclaimer'], true,'SUMMARY');
    }
	} 
  
  function sc_cw_book_id()
	{
    return (int)$this->var['cw_book_id'];
	}
  
	function sc_cw_book_lastupdate()
	{
    return e107::getParser()->toDate($this->var['cw_book_lastupdate']);
	}
  
	function sc_cw_book_logo()
	{
		if ($this->cwpref['cw_visibility_logo'] > 0) { 
      if (!empty($this->var['cw_book_logo'])  )
  		{
  		$att['w'] = $this->cwpref['cwriter_picw'];
  		$att['h'] = $this->cwpref['cwriter_pich'];
  		return e107::getParser()->toImage($this->var['cw_book_logo'], $att);
  	  }
    }
	}	
	
  /*  {CW_BOOK_PART_OF_SERIE} */ 
  function sc_cw_book_series()
	{
    if ($this->cwpref['cw_visibility_series'] > 0) { 
		 $text = ($this->var['cw_book_series'] == 1?'<i class="fa  fa-check" aria-hidden="true"></i>':"&nbsp;");
     return $text;
    }
    else return '';
	}
	

	function sc_cw_book_rating()
	{    
				if ($this->cwpref['cwriter_userating'] > 0)
        {
 
						$cwriter_rating  = '';
						$cwriter_bookid = $this->sc_cw_book_id();
            if ($ratearray = e107::getRate()->getrating("cwbook", $cwriter_bookid))
            {   
                for($c = 1;
                    $c <= $ratearray[1];
                    $c++)
                {
                    $cwriter_rating .= "<img src='".e_PLUGIN_ABS. "creative_writer/images/star.png' alt='' />";
                }
                if ($ratearray[2])
                {
                    $cwriter_rating .= "<img src='".e_PLUGIN_ABS. "creative_writer/images/" . $ratearray[2] . ".png'  alt='' />";
                }
                if ($ratearray[2] == "")
                {
                    $ratearray[2] = 0;
                }
                $cwriter_rating .= "<span class='smallblacktext'>&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                $cwriter_rating .= "" . ($ratearray[0] == 1 ? CWRITER_54 : CWRITER_55) . "</span>";
            }
            else
            {
                $cwriter_rating .= CWRITER_57;
            }
            
            if (!e107::getRate()->checkrated("cwbook", $cwriter_bookid) && USER)
            {
                $cwriter_rating .= e107::getRate()->rateselect("&nbsp;&nbsp;&nbsp;&nbsp; <b>" . CWRITER_56, "cwbook", $cwriter_bookid) . "</b>";
            }
            else if (!USER)
            {
                $cwriter_rating .= "&nbsp;";
            }
            else
            {
                $cwriter_rating .= "&nbsp;<span class='smallblacktext'>" . CWRITER_58 . "</span>";
            }
 
            if ($this->var['cw_book_rate'] == 1 && $this->cwpref['cwriter_userating'] > 0)
            {
                $cwriter_text .=  $cwriter_rating ;
            }
        }
        else  $cwriter_text = LAN_BOOK_003;
        
        return $cwriter_text;
	}
	
	function sc_cw_book_rating_simple()
	{
	    $cw_book_id = $this->sc_cw_book_id();
			$cwriter_rating = "";
     // if ($ratearray = $rater->getrating("cwbook", $cw_book_id))
       if ($ratearray = e107::getRate()->getrating("cwbook", $cw_book_id))
      {    
          for($c = 1;
              $c <= $ratearray[1];
              $c++)
          {
              $cwriter_rating .= "<img src='".e_PLUGIN_ABS. "creative_writer/images/star.png' alt='' />";
          }
          if ($ratearray[2])
          {
              $cwriter_rating .= "<img src='".e_PLUGIN_ABS. "creative_writer/images/" . $ratearray[2] . ".png'  alt='' />";
          }
          if ($ratearray[2] == "")
          {
              $ratearray[2] = 0;
          }
          // $cwriter_rating .="&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
          // $cwriter_rating .=($ratearray[0]==1 ? RCPEMENU_89 : RCPEMENU_88);    
      }
      else
      {
          $cwriter_rating .= "<span class='smalltext'>" . CWRITER_53 . "</span>";
      }   
       $cwriter_rating =  e107::getRate()->render("cwbook", $cw_book_id, $options);
       
       
	    if ($this->cwpref['cwriter_userating'] == 1 && $this->var['cw_book_rate'] == 1)
	    {
	        $cwriter_text .= "<br />$cwriter_rating";
	    }
		            
       return $cwriter_text;		            
	}
  
	function sc_cw_book_review()
	{  
		if ($this->cwpref['cwriter_usereview'] > 0)
    {
      if ($this->var['cw_book_review'] == 1) {
  			$cwriter_bookid = $this->sc_cw_book_id();
  	    $cwriter_review = "<a href='" .  e_PLUGIN_ABS. "creative_writer/cwriter.php?0.review.$cwriter_bookid'>" . ($this->var['numreviews'] == 0?CWRITER_217:CWRITER_218) . "</a>"; 
      }
      else  $cwriter_review = LAN_BOOK_004;
    }
    else  $cwriter_review = LAN_BOOK_004;
    return $cwriter_review;
	}
  
	function sc_cw_book_summary()
	{
    if($this->var['cw_book_summary']) {
      return e107::getParser()->toHtml($this->var['cw_book_summary'], true,'SUMMARY');
    }
    else return '--';
	}
  
 
  
	function sc_cw_book_title_url()
	{                           
    $cw_book_id = $this->var['cw_book_id'];
    $cw_book_title = $this->sc_cw_book_title(); 
    $cwriter_from = $this->var['cwriter_from'];
    $urlparam= array(
      'cw_book_id'			=> $cw_book_id,
      );
    $url = e107::url('creative_writer', 'book', $urlparam);
    
		$text = "<a href='".$url."'>" . $cw_book_title . "</a>";
		return $text;
	}
  
	function sc_cw_book_views()
	{
    $text = $this->var['cw_book_views'] . " (" . LAN_BOOK_UNIQUE ." ".  $this->var['cw_book_unique'].")";
    
    return $text;
	} 
  
  /* {CW_BOOK_URL} */
  function sc_cw_book_url()
	{
 
		return e107::url('creative_writer', 'book', $this->var);  
	}
  
	function sc_cw_book_warnings()
	{
    if ($this->cwpref['cw_visibility_warnings'] > 0) {
      return e107::getParser()->toHtml($this->var['cw_book_warnings'], true,'SUMMARY');
    }
	} 
  
  function sc_cw_book_wordcount()
	{
    return (int)$this->var['cw_book_wordcount']." ". CWRITER_77;
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
	  if($this->var['cw_category_name']) {
    return e107::getParser()->toHtml($this->var['cw_category_name'], true,'TITLE');
    }
    else return '--';
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
    if($this->var['cw_genre_name']) {
      return e107::getParser()->toHtml($this->var['cw_genre_name'], true,'TITLE');
    }
    else return '--';
	} 
	
 /* {CW_MB_BOOK_EDIT} */
 function sc_cw_mb_book_edit($parm)
	{          
    if (check_class($this->cwpref['cwriter_admin']) || check_class($this->cwpref['cwriter_create']))
    {
        $options['class'] = vartrue($parm['class'],'btn btn-xs btn-warning');
        $url =     e_PLUGIN_ABS . "creative_writer/mybooks.php?edit.".$this->var['cw_book_id'].".0";
        $cwriter_text = '<a class="'.$options['class'].'" href="'.$url.'"><i class="fa fa-2x fa-pencil" title="'.LAN_MB_EDIT_BOOK.'"></i></a>';       
    }
    else $cwriter_text = '';
    
		return $cwriter_text;
	}
	
 /* {CW_MB_BOOK_DELETE} */
 function sc_cw_mb_book_delete($parm)
	{          
    if (check_class($this->cwpref['cwriter_admin']) || check_class($this->cwpref['cwriter_create']))
    {
        $options['class'] = vartrue($parm['class'],'btn btn-xs btn-danger');
        $url =     e_PLUGIN_ABS . "creative_writer/mybooks.php?delete.".$this->var['cw_book_id'].".0";
        $cwriter_text = '<a class="'.$options['class'].'" href="'.$url.'"><i class="fa fa-2x fa-times" title="'.LAN_MB_DELETE_BOOK.'"></i></a>';
    }
    else $cwriter_text = '';
    
		return $cwriter_text;
	}	
	
 /* {CW_MB_BOOK_EDIT_CHAPTERS} */
 function sc_cw_mb_book_edit_chapters($parm)
	{          
    if (check_class($this->cwpref['cwriter_admin']) || check_class($this->cwpref['cwriter_create']))
    {
        $options['class'] = vartrue($parm['class'],'btn btn-xs btn-default');
        $url =     e_PLUGIN_ABS . "creative_writer/mybooks.php?chapters.".$this->var['cw_book_id'].".0";
        $cwriter_text = '<a class="'.$options['class'].'" href="'.$url.'"><i class="fa fa-2x fa-list-ol" title="'.LAN_MB_EDIT_CHAPTERS.'"></i></a>';
    }
    else $cwriter_text = '';
    
		return $cwriter_text;
	}
}
?>