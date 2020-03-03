<?php
if (!defined('e107_INIT')) { exit; }

class links_page_shortcodes extends e_shortcode
{

	/**
	 * Private variable to store plugin configurations.
	 *
	 * @var array
	 */
	private $plugPrefs = array();
  
	/**
	 * Constructor.
	 */
	function __construct()
	{
		$this->plugPrefs = e107::getPlugConfig('links_page')->getPref();
	}

  
	function sc_link_navigator($parm='')
	{ 
		global  $rs;
		$frm = e107::getForm(); 
		$mains = "";   
                     
		if(vartrue($this->plugPrefs['link_navigator_frontpage'])){
			$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'index').'">'.LAN_LINKS_14.'</a></li>';  
		}
		if(vartrue($this->plugPrefs['link_navigator_refer'])){
			$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'top').'">'.LAN_LINKS_12.'</a></li>';
		}
		if(vartrue($this->plugPrefs['link_navigator_rated'])&&(vartrue($this->plugPrefs['link_rating']))) {
			$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'rated').'">'.LAN_LINKS_13.'</a></li>';
		}
		if(vartrue($this->plugPrefs['link_navigator_category'])){
			$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'allcats').'">'.LAN_LINKS_43.'</a></li>';
		}
		if(vartrue($this->plugPrefs['link_navigator_links'])){
			$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'alllinks').'">'.LAN_LINKS_51.'</a></li>';
		}
		if(vartrue($this->plugPrefs['link_navigator_submit']) && vartrue($this->plugPrefs['link_submit']) && check_class($this->plugPrefs['link_submit_class'])){
			$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'submit').'">'.LAN_LINKS_27.'</a></li>';
		}
		if(vartrue($this->plugPrefs['link_navigator_manager']) && vartrue($this->plugPrefs['link_manager']) && check_class($this->plugPrefs['link_manager_class'])){
		$mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'manage').'">'.LAN_LINKS_35.'</a></li>';
		}
		return $mains; 
 
}

  function sc_link_nav_allcats($parm='')
	{ 
    global  $rs, $rowc;
    $mains = "";
    if(vartrue($this->plugPrefs['link_navigator_allcat'])){     
    	$dbc = e107::getDb('dbc');
    	if ($dbc->select("links_page_cat", "link_category_id, link_category_name, link_category_sef", "link_category_class REGEXP '".e_CLASS_REGEXP."' ORDER BY link_category_name")){
    		while ($rowc = $dbc->fetch()){
          $mains .= '<li><a class="btn btn-default" href="'.e107::url('links_page', 'category', $rowc, 'full').'">'.$rowc['link_category_name'].'</a></li>';
    		}
    	}
    }
    return $mains;
  }

  function sc_link_sortorder($parm='')
	{ 
    global $LINK_SORTORDER;
    return $LINK_SORTORDER;
  }


 
  
  function sc_link_nextprev($parm='')
	{ 
    global $LINK_NEXTPREV;
    return $LINK_NEXTPREV;
  } 
  
  function sc_link_manage_icon($parm='')
	{ 
    global $LINK_MANAGE_ICON, $row;
    $LINK_MANAGE_ICON = "";
    return $LINK_MANAGE_ICON;
  }  

  function sc_link_manage_name($parm='')
	{ 
    global $LINK_MANAGE_NAME, $row, $tp;
    return $tp->toHTML($row['link_name'], TRUE);
  } 

  function sc_link_manage_options($parm='')
	{ 
    global $LINK_MANAGE_OPTIONS, $row, $tp;
    $baseurl = e107::url('links_page', 'index'); 
    $linkid = $row['link_id'];
    $LINK_MANAGE_EDIT=  $baseurl."/manage.edit.".$linkid;
    $LINK_MANAGE_OPTIONS = "<a href='".$LINK_MANAGE_EDIT."' title='".LCLAN_ITEM_31."'>".LINK_ICON_EDIT."</a>";
   
    if (vartrue($this->plugPrefs['link_directdelete'])){
    	$LINK_MANAGE_OPTIONS .= " <input type='image' title='delete' name='delete[main_{$linkid}]' alt='".LCLAN_ITEM_32."' src='".LINK_ICON_DELETE_BASE."' onclick=\"return jsconfirm('".$tp->toJS(LCLAN_ITEM_33." [ ".$row['link_name']." ]")."')\" style='vertical-align:top;' />";
    }
    return $LINK_MANAGE_OPTIONS;
  } 
  
  function sc_link_manage_cat($parm='')
	{ 
    global $LINK_MANAGE_CAT, $tp, $row;
    return $tp->toHTML($row['link_category_name'], TRUE);
  }  

  function sc_link_manage_newlink($parm='')
	{        
    $LINK_MANAGE_CREATE= e107::url('links_page', 'manage');   
    return  $LINK_MANAGE_CREATE;
  } 
  
  function sc_link_manage_active($parm='')
	{     
    if($this->var['link_active']) {  
      $LINK_MANAGE_ACTIVE = LINK_ICON_TRUE;
    } else {
    $LINK_MANAGE_ACTIVE = LINK_ICON_FALSE;
    };
    return  $LINK_MANAGE_ACTIVE;
  } 
    
    
  function sc_link_main_heading($parm='')
	{ 
    global $LINK_MAIN_HEADING, $rowl, $tp;
    return (!$rowl['total_links'] ? $rowl['link_category_name'] : "<a href='".e107::url('links_page', 'category', $rowl, 'full')."'>".$tp->toHTML($rowl['link_category_name'], TRUE)."</a>");
  }
  
  function sc_link_main_desc($parm='')
	{ 
    global $LINK_MAIN_DESC, $rowl,  $tp;
                         
    return (vartrue($this->plugPrefs['link_cat_desc'])? $tp->toHTML($rowl['link_category_description'], TRUE,'description') : "");
  }
 
  function sc_link_main_number($parm='')
	{ 
    global $LINK_MAIN_NUMBER, $rowl;   
    if(vartrue($this->plugPrefs['link_cat_amount'])){
    $LINK_MAIN_NUMBER = $rowl['total_links']." ".($rowl['total_links'] == 1 ? LAN_LINKS_17 : LAN_LINKS_18)." ".LAN_LINKS_16;
    }else{
    $LINK_MAIN_NUMBER = "";
    }
    return $LINK_MAIN_NUMBER;
  }


  function sc_link_main_icon($parm='')
	{ 
    global $rowl;
    
    $tp = e107::getParser();
    if(!$this->plugPrefs['link_cat_icon']){
    	return "";
    }
    $LINK_MAIN_ICON = "&nbsp;";

		$parms 		  = eHelper::scParams($parm);
		$w 		     	= vartrue($parms['w']) ? $parms['w'] : $tp->thumbWidth(); // 190; // 160;
		$h 			    = vartrue($parms['h']) ? $parms['h'] : $tp->thumbHeight(); // 130;	
    $x          = vartrue($parms['x']) ? $parms['h'] : 0;
    $crop       = vartrue($parms['crop']) ? $parms['crop'] : 1;    
		$class 		  = varset($parms['class'],'');
    $caption    = $tp->toAttribute($rowl['link_cat_name']) ;
    $att        = array('w'=>$w, 'h'=>$h, 'class'=>$class, 'alt'=>$caption, 'x'=>$x, 'crop'=>$crop);
        
    if(vartrue($this->plugPrefs['link_cat_icon']))
    {
    	if (vartrue($rowl['link_category_icon']))
    	{
    		$LINK_MAIN_ICON = $tp->toImage($rowl['link_category_icon'],$att);  
    	}
    	if($rowl['total_links'] && $LINK_MAIN_ICON)
    	{
    		$LINK_MAIN_ICON = "<a href='".e107::url('links_page', 'category', $rowl, 'full')."'>".$LINK_MAIN_ICON."</a>";
    	}
    }
    return $LINK_MAIN_ICON;
  }

 
  function sc_link_main_total($parm='')
	{ 
    global $LINK_MAIN_TOTAL,  $category_total,  $alllinks;
    if(vartrue($this->plugPrefs['link_cat_total'])){
    $LINK_MAIN_TOTAL = LAN_LINKS_21." ".($alllinks == 1 ? LAN_LINKS_22 : LAN_LINKS_23)." ".$alllinks." ".($alllinks == 1 ? LAN_LINKS_17 : LAN_LINKS_18)." ".LAN_LINKS_24." ".$category_total." ".($category_total == 1 ? LAN_LINKS_20 : LAN_LINKS_19);
    }else{
    $LINK_MAIN_TOTAL = "";
    }
    return $LINK_MAIN_TOTAL;
  } 

 
  function sc_Link_Main_Showall($parm='')
	{ 
    global $LINK_MAIN_SHOWALL;
    return (vartrue($this->plugPrefs['link_cat_total']) ? "<a href='".e107::url('links_page', 'all', $rowc, 'full')."'>".LAN_LINKS_25."</a>" : "");
  } 
 



// LINK_TABLE ------------------------------------------------

  function sc_link_button($parm='')
	{ 
    global $rowl;
    $tp = e107::getParser();
    if(!$this->plugPrefs['link_icon']){
    	return "";
    }    
		$parms 		  = eHelper::scParams($parm);
		$w 		     	= vartrue($parms['w']) ? $parms['w'] : $tp->thumbWidth(); // 190; // 160;
		$h 			    = vartrue($parms['h']) ? $parms['h'] : $tp->thumbHeight(); // 130;	
    $x          = vartrue($parms['x']) ? $parms['h'] : 0;
    $crop       = vartrue($parms['crop']) ? $parms['crop'] : 1;    
		$class 		  = varset($parms['class'],'');
    $caption    = $tp->toAttribute($rowl['link_name']) ;
    $att        = array('w'=>$w, 'h'=>$h, 'class'=>$class, 'alt'=>$caption, 'x'=>$x, 'crop'=>$crop);

    $LINK_BUTTON = "&nbsp;";
    if(vartrue($this->plugPrefs['link_icon'])){
    	if ($rowl['link_button']) {                    
         $LINK_BUTTON = $tp->toImage($rowl['link_button'],$att);
    	}  
    }
    return $LINK_BUTTON;
  }

  /* preparing for moving all APPENDS to templates or using button as link in template */
	function sc_link_open($parm = '')
	{
    global $rowl;
    if($this->plugPrefs['link_open_all'] && $this->plugPrefs['link_open_all'] == "5"){
            $link_open_type = $rowl['link_open'];
    }else{
            $link_open_type = $this->plugPrefs['link_open_all'];
    }

		switch($link_open_type)
		{
      case 1:
      $lappend = "onclick=\"open_window('".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."','full');return false;\""; // Googlebot won't see it any other way.
      break;
      case 2:
      $lappend = "onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."';return false\"";  // Googlebot won't see it any other way.
      break;
      case 3:
      $lappend = "onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."';return false\"";  // Googlebot won't see it any other way.
      break;
      case 4:
      $lappend = "onclick=\"open_window('".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."');return false\""; // Googlebot won't see it any other way.
      break;
      default:
      $lappend = "onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."';return false\"";  // Googlebot won't see it any other way.
		}
		return $lappend;
	}

  function sc_button_column($parm='')
	{ 
    global $linkbutton_count;
    return ($this->plugPrefs['link_icon']) ? 2 : 1;
  }
  
  function sc_link_append($parm='')
	{ 
    global $LINK_APPEND;
    return $LINK_APPEND;
  }  
  
  function sc_link_name($parm='')
	{ 
    global $LINK_NAME, $rowl;
    return $rowl['link_name'];
  } 
  
  
  function sc_link_page_url($parm='')
	{ 
		global $rowl;
		if(vartrue($this->plugPrefs['link_url'])){
		return ($parm == "link") ? "<a class='linkspage_url' href=\"".$rowl['link_url']."\" rel='external' title=\"".$rowl['link_description']."\">".$rowl['link_url']."</a>" : $rowl['link_url'];
		}
		else return '';
  } 
  
  function sc_link_refer($parm='')
	{ 
    global $LINK_REFER, $rowl;
    return (vartrue($this->plugPrefs['link_referal'])  ? $rowl['link_refer'] : "");
  }   
  
  function sc_link_comment($parm='')
	{ 
    global $LINK_COMMENT, $rowl;
    $LINK_COMMENT =  e107::url('links_page', 'comment', $rowl, 'full');
    return (vartrue($this->plugPrefs['link_comment']) ? 
    "<a href='".$LINK_COMMENT."'>".($rowl['link_comment'] ? $rowl['link_comment'] : "0")."</a>" : "");
  }   
 
  function sc_link_desc($parm='')
	{ 
    global $LINK_DESC, $tp, $rowl;
    return (vartrue($this->plugPrefs['link_desc']) ? $tp->toHTML($rowl['link_description'], TRUE,'BODY') : "");
  }   
  
  function sc_link_rating($parm='')
	{ 
    global $LINK_RATING,  $rowl, $qs; 
        
    if(vartrue($this->plugPrefs['link_rating'])){
      $frm = e107::getForm();
      $options = array('label'=>' ','template'=>'RATE|VOTES|STATUS');
      $LINK_RATING = $frm->rate("links_page", $rowl['link_id'], $options);
    }
    return $LINK_RATING;
  }     
  
  function sc_link_new($parm='')
	{ 
    global $LINK_NEW,  $qs, $rowl;
    $LINK_NEW = "";
    if(USER && $rowl['link_datestamp'] > USERLV){
   // $LINK_NEW = "<img class='linkspage_new' src='".IMAGE_NEW."' alt='' style='vertical-align:middle' />";
   $LINK_NEW = IMAGE_NEW;
    }
    return $LINK_NEW;
  }   
  
  function sc_link_cat_name($parm='')
	{ 
    global $rowl;
    return $rowl['link_category_name'];
  } 


  function sc_link_cat_desc($parm='')
	{ 
    global $rowl;
    return $rowl['link_category_description'];
  }   
  
  function sc_link_cat_total($parm='')
	{ 
    global $link_category_total;
    return " (<span title='".(ADMIN ? LAN_LINKS_2 : LAN_LINKS_1)."' >".$link_category_total."</span>".(ADMIN ? "/<span title='".(ADMIN ? LAN_LINKS_1 : "" )."' >".$link_category_total."</span>" : "").") ";
  }
  
  function sc_link_refer_lan($parm='')
	{ 
    return (vartrue($this->plugPrefs['link_referal']) ? LAN_LINKS_26 : "");
  }  
  
  function sc_link_comment_lan($parm='')
	{ 
    return (vartrue($this->plugPrefs['link_comment']) ? LAN_LINKS_37 : "");
  } 
  
  function sc_link_rating_lan($parm='')
	{ 
    if(vartrue($this->plugPrefs['link_rating'])){
        return LCLAN_ITEM_39;
    }
    return "";
  }  
  
  function sc_navigator($parm='')
	{ 
      return displayNavigator('');
  } 
  
  // LINK_RATED_TABLE ------------------------------------------------
  function sc_link_rated_rating($parm='')
	{ 
    global $LINK_RATED_RATING, $rowl;
    if(vartrue($this->plugPrefs['link_rating'])){
      $frm = e107::getForm();
      $options = array('label'=>' ','template'=>'RATE|VOTES|STATUS');
      $LINK_RATED_RATING = $frm->rate("links_page", $rowl['link_id'], $options);
    }
    return $LINK_RATED_RATING;
  } 
  
  
  function sc_link_rated_append($parm='')
	{ 
    global $LINK_RATED_APPEND;
    return $LINK_RATED_APPEND;
  } 
  
  function sc_link_rated_category($parm='')
	{ 
    global $LINK_RATED_CATEGORY, $rowl, $qs, $tp;
    if(!isset($qs[1])){
    $LINK_RATED_CATEGORY = "<a href='".e_SELF."?cat.".$rowl['link_category_id']."'>".$tp->toHTML($rowl['link_category_name'], TRUE)."</a>";
    }
    return $LINK_RATED_CATEGORY;
  } 
  
  function sc_link_rated_name($parm='')
	{ 
    global $LINK_RATED_NAME, $rowl;
    return $rowl['link_name'];
  } 
  
  function sc_link_rated_url($parm='')
	{ 
    global $LINK_RATED_URL, $rowl;
    return (vartrue($this->plugPrefs['link_url']) ? $rowl['link_url'] : "");
  } 
  
  function sc_link_rated_refer($parm='')
	{ 
    global $LINK_RATED_REFER, $rowl;
    return (vartrue($this->plugPrefs['link_referal']) ? LAN_LINKS_26." ".$rowl['link_refer'] : "");
  } 
  
  function sc_nk_rated_desc($parm='')
	{ 
global $LINK_RATED_DESC,  $tp, $rowl;
return (vartrue($this->plugPrefs['link_desc']) ? $tp->toHTML($rowl['link_description'], TRUE) : "");
  } 
    
  // LINK_SUBMIT_TABLE ------------------------------------------------    
  function sc_link_submit_cat($parm='')
	{ 
    $db  = e107::getDb();
    $frm = e107::getForm();
    
    if($allRows = $db->retrieve("links_page_cat", "*", " link_category_class REGEXP '".e_CLASS_REGEXP."' ", TRUE))
    {
    	foreach($allRows as $catrow)
    	{                                
    		$id =  $catrow['link_category_id']; $name = $catrow['link_category_name']; 
        $catlist[$id] = $name;
    	}
    } 
    $LINK_SUBMIT_CAT .= $frm->select('cat_id',$catlist,$row['link_category']);         
    return $LINK_SUBMIT_CAT;
  }    
  
  function sc_link_submit_pretext($parm='')
	{ 
    global $LINK_SUBMIT_PRETEXT;
    if(vartrue($this->plugPrefs['link_submit_directpost'])){
    return "";
    }else{
    return LCLAN_SL_9;
  }     
 }
 
  function sc_link_submit_name($parm='')
	{ 
    $frm = e107::getForm();
    return $frm->text('link_name',$this->var['link_name'],100,array('required'=>'1'));
  } 
  
  function sc_link_submit_url($parm='')
	{ 
    $frm = e107::getForm();
    return $frm->text('link_url',$this->var['link_url'],100,array('required'=>'1'));
  } 
      
  function sc_link_submit_description($parm='')
	{ 
    $frm = e107::getForm();
    return $frm->textarea('link_description',$this->var['link_description'],3,59,array('size'=>'xxlarge','required'=>'1'));
  }   
  
  function sc_link_submit_image($parm='')
	{ 
    $frm = e107::getForm();
    return $frm->imagepicker("link_button",  $this->var['link_button'] , LCLAN_ITEM_7, "media=linkspage");
  }
  

}
 
?>
