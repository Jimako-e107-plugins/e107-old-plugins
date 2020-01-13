<?php
/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Tag shortcode - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if(!defined('e107_INIT'))
{
	exit;
}



class tagcloud_shortcodes extends e_shortcode
{
 
	function sc_tags($parm = '')
	{   
    require_once('tags_sc.php');
    return $text; 
	}
	
	function sc_tagcloud($parm = '')
	{ 
				
				require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
        $tagcloud = new e107tagcloud;
        $plugPrefs = e107::getPlugConfig('tagcloud')->getPref();

        $tmp    = explode("|",$parm);       
 
        $tagcnt = (empty($parm['number']) ? (empty($tmp[0]) ? $plugPrefs['tags_number'] : $tmp[0]) : $parm['number']);
        $tagtyp = substr($tmp[1],0,10);  //security
        $tagord = substr($tmp[2],0,10);  //security
        $tagord = (empty($parm['order']) ? ((strlen($tagord)<1) ? $plugPrefs['tags_order'] : $tagord) : $parm['order']);
        
        $templatekey = (empty($parm['template']) ? 'list' : $parm['template']);
 
        //if (strlen($tagord)<1){$tagord=$plugPrefs['tags_order'];}
                                 
        $tags = $tagcloud->get_cloud_list($tagcnt,$tagtyp,$tagord);        
        
            //returns tag_name and number quant
        $max_size = $plugPrefs['tags_max_size']; // max font size in %
        $min_size = $plugPrefs['tags_min_size']; // min font size in %

        $max_qty = max(array_values($tags));
        $min_qty = min(array_values($tags));
        $spread = $max_qty - $min_qty;
        $colour  = $tagcloud->gradient($plugPrefs['tags_min_colour'],$plugPrefs['tags_max_colour'],$spread);    
        
        //$colour  = $tagcloud->gradient('87CEFA','483D8B',$spread);
        if (0 == $spread) 
        { // we don't want to divide by zero
            $spread = 1;
        }
        $step = ($max_size - $min_size)/($spread);
        $htmlout = "<div class='".$plugPrefs['tags_style_cloud']."'>";
        $var['tags_style_cloud'] = $plugPrefs['tags_style_cloud'];
        $var['tag_main_page'] = e107::url('tagcloud', 'tagcloud');
        
        $htmlout = e107::getParser()->simpleParse($tagcloud->tagsTemplates[$templatekey]['header'], $var);
 
				foreach ($tags as $key => $value) {
            //UTF-8
            $size     = $min_size + (($value - $min_qty) * $step);
            $link     = $tagcloud->MakeSEOLink($key);
            $search_link = mb_convert_encoding($link, 'utf-8', 'windows-1251');
            $search_link = str_replace("_","+",$search_link);
            $key      = preg_replace("#_#"," ",$key);
            
            
	 				  $tagcloud->tagsShortcodes->setVars(array(
			      'size' => $size,
			      'key' => $key,
			      'link' => $link,  
			      'value' => $value,
			      'color' => $colour[$value]
			      ));            
 
            $htmlout .= e107::getParser()->parseTemplate($tagcloud->tagsTemplates[$templatekey]['item'], true, $tagcloud->tagsShortcodes);
              
        }
        $htmlout .= e107::getParser()->simpleParse($tagcloud->tagsTemplates[$templatekey]['footer'], $var);
 
        $text = e107::getParser()->parseTemplate($htmlout)."\n";

        return $text;
	}
}