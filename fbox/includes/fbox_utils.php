<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: fbox_utils.php 717 2008-01-16 14:11:48Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

function fbox_util_tmplcombo($name, $default='')
{
    global $rs, $pref;
    
    if(!varset($rs)) {
        require_once(e_HANDLER."form_handler.php");
        $rs = new form;
    }

    $list = fbox_get_templates(false, $pref['sitetheme']);
    
    $combo = $rs -> form_select_open($name);
    $combo .= $rs -> form_option('&nbsp;', false, '');
    
    if($list) {
        foreach ($list as $value) {
        	$combo .= $rs -> form_option($value, ($default==$value), $value);
        }
    }
    
    $combo .= $rs -> form_select_close();
    return $combo;
}

function fbox_get_templates($fullpath=false, $theme='')
{
    global $fl, $pref;
    
    if(!$theme) $theme = THEME;
    else $theme = e_THEME.$theme.'/';
    
    $tid = str_replace(array('/', "\\"), '', dirname($theme));
    
    if(!$fullpath && $fbox_templates = getcachedvars('fbox_templates_'.$tid))
        return $fbox_templates;
    elseif($fullpath && $fbox_template_paths = getcachedvars('fbox_template_paths_'.$tid))
        return $fbox_template_paths;
        
    $fbox_templates = array();
    $fbox_template_paths = array();
    
    if(!varset($fl)) {
        require_once(e_HANDLER.'file_class.php');
        $fl = new e_file;
    }
    
    $tmp = $fl -> get_files($theme.'fbox', '([\w])+\.tmpl\.php$');
    $tmp1 = $fl -> get_files(e_PLUGIN.'fbox/templates', '([\w]+)\.tmpl\.php$');

    if($tmp) {
        foreach ($tmp as $value) {   
            $fbox_templates[] = fbox_file2tmpl($value['fname']);
            $fbox_template_paths[] = $theme.'fbox/'.$value['fname'];
        }
    }
    
    if($tmp1) {
        foreach ($tmp1 as $value) {
            $tmp = fbox_file2tmpl($value['fname']);
            if(!in_array($tmp, $fbox_templates)) {
                $fbox_templates[] = $tmp;
                $fbox_template_paths[] = e_PLUGIN.'fbox/templates/'.$value['fname'];
            }
        }
    }
    
    sort($fbox_templates, "strnatcmp");
    sort($fbox_template_paths, "strnatcmp");

    cachevars('fbox_templates_'.$tid, $fbox_templates);
    cachevars('fbox_template_paths_'.$tid, $fbox_template_paths);
    
    return $fullpath ? $fbox_template_paths : $fbox_templates;
}

function fbox_check_template($tmpl_name, $path='') 
{
    if(!$tmpl_name) 
        return e_PLUGIN.'fbox/templates/default.tmpl.php';
      
    if(!$path) $path = THEME;

    if(is_readable($tmp = fbox_tmpl2file($tmpl_name, $path.'/fbox/'))) {
        //theme template - Ok
    } elseif(is_readable($tmp = fbox_tmpl2file($tmpl_name, e_PLUGIN.'/fbox/templates/'))) {
        //plugin template - Ok
    } else {
        $tmp = e_PLUGIN.'fbox/templates/default.tmpl.php'; //default template
    }
    
    return $tmp;
}

function fbox_imageselector($name='', $default='', $theme='') 
{
    global $tp, $pref;
    
    if(!$name) $name = 'fbox_image';
    if(!$theme) $theme = e_THEME.$pref['sitetheme'].'/fbox/tmpl_images/';
    else $theme = $theme.'fbox/tmpl_images/';
    $thname = basename(str_replace('/fbox/tmpl_images/', '', $theme));
    
    $parms = 'name='.$name;
    //array params
    $parms .= '&path[]='.$theme;//theme images
	$parms .= '&path[]='.e_PLUGIN.'fbox/templates/tmpl_images/';//plugin
	$parms .= '&label[]='.FBOX_LANMNG_9.' ('.$thname.') ' ;//theme images
	$parms .= '&label[]='.FBOX_LANMNG_8;//plugin
	//array params end
	$parms .= '&default='.$default;
	$parms .= '&float=left';
	$parms .= '&width=200px';
	$parms .= '&swidth=250px';
	$parms .= '&height=200px';
	$parms .= '&subdirs=1';
	$parms .= '&multiple=1';

    $ret = $tp->parseTemplate("{FBOX_IMAGESELECTOR={$parms}}");

    return $ret;
}

function fbox_abs2rel($path) 
{
    global $pref;
    
    $path = trim($path);
    $s = array(e_PLUGIN_ABS, e_IMAGE_ABS, e_FILE_ABS, e_ADMIN_ABS);
    $r = array(e_PLUGIN, e_IMAGE, e_FILE, e_ADMIN);

    return str_replace($s, $r,$path);
}

function fbox_tmpl2file($f, $path='') 
{
    $ret = $path.$f.'.tmpl.php';

    return $ret;
}

function fbox_file2tmpl($f) 
{
    $ret = basename($f, '.tmpl.php');

    return $ret ? $ret : false;
}

function fbox_sc($parm, $id=0)
{
    global $sql, $tp, $ns, $pref, $fbox_shortcodes;
    
    parse_str($parm, $parms);
    
    $exact = varset($parms['exact']) ? urldecode($parms['exact']) : '';
    $one = varset($parms['get_one'], 1); //default is true
    $found = array();
    $def_found = '';
    $nav = varset($parms['navigation']);
    $rand = varset($parms['random']);
    $fnum = 0;
    
    //to do - SQL LIMIT
    $flimit = varset($parms['limit'], 0);
    
    //check navigation
    if(!$pref['fbox_js'] && $nav)
        return '';
    
    $pc_str = 'fbox_page_cache_'.md5($exact.$one.$nav.USERCLASS_LIST);

    if($id) {
        if(!$sql -> db_Select("fbox", "*", "fbox_id='{$id}' AND fbox_permission!='".e_UC_NOBODY."' AND fbox_permission IN (".USERCLASS_LIST.") ORDER BY fbox_page_match DESC"))
            return '';
            
        $row = $sql->db_Fetch();
        $row['fbox_default_item'] = true;
        $found[] = $row;
        $def_found = $row;
        
    } elseif(!($found = getcachedvars($pc_str))) {
   
        if($one && !$nav && !$rand && $sql -> db_Select("fbox", "*", "fbox_page_exactmatch='{$exact}' AND fbox_permission!='".e_UC_NOBODY."' AND fbox_permission IN (".USERCLASS_LIST.")"))
        {
            while($row = $sql->db_Fetch())
        	{
        	   $row['fbox_default_item'] = true;
               $found[] = $row;
               $def_found = $row;
        	   break;
        	}
        } elseif($sql -> db_Select("fbox", "*", "fbox_permission!='".e_UC_NOBODY."' AND fbox_permission IN (".USERCLASS_LIST.") ORDER BY fbox_page_match DESC")) {
        	$exact_match = false;
        	
            while($row = $sql->db_Fetch())
            {
                
                if($row['fbox_page_exactmatch'] && $row['fbox_page_exactmatch'] == $exact) 
                    $exact_match = true;
                
                $row['fbox_parms'] = $parm;//ajax parms
                
                //check for filter match
                if($row['fbox_page_match']) {
                    $tmp = explode('^',$row['fbox_page_match']);
                    $match = false;
                    foreach ($tmp as $value) {
                    	if(strpos(e_SELF, $value) !== FALSE) {
                            $match = true;
                            break;
                        }
                    }
                } else $match = true; //true if no rules
                
                if($match) {
                
                    $fnum++;

                    $row['fbox_num'] = $fnum; 
                    //first is default
                    if($fnum == 1) {
                        $row['fbox_default_item'] = 1;
                        $def_found = $row;
                        
                    }
                    //exact match found!
                    if($tmp = getcachedvars('fbox_active_item') && $tmp == $row['fbox_id']) {
                        $row['fbox_default_item'] = 1;
                        $def_found = $row;
                        $exact_match = false;
                    } elseif($exact_match && !$rand) {
                        if(isset($found[0]['fbox_default_item'])) 
                            $found[0]['fbox_default_item'] = 0; //just to be sure
                        $row['fbox_default_item'] = 1;
                        $def_found = $row;
                        $exact_match = false;
                        
                    }
                        
                    
                    $found[] = $row;
                    if($one && !$nav && !$rand) break;
                }
                
        	}
        	
        } 
    }
     
    //no matches
    if(empty($found))
        return '';
    
    //cache for the current page only
    cachevars($pc_str, $found);

    //load template
    if($theme_tmpl = varsettrue($parms['use_template'], false)) {
        $tmp = array($parms['use_template']);
    } elseif($one)
        $tmp = array($found[0]['fbox_default_tmpl']);
    else 
        $tmp = array('default', '');
        
    $tmpl = fbox_check_template($tmp[0], $tmp[1]);

    //not once!
    include($tmpl);
    if(!$FBOX_TEMPLATE)
        include(e_PLUGIN.'fbox/templates/default.tmpl.php');
    
    if(!varset($fbox_shortcodes))
        require_once(e_PLUGIN.'fbox/includes/fbox_batch.php');
    
    $text = array();
    $itemsep = '';
    $ctmpl = $FBOX_TEMPLATE;
    $pre_tmpl = varset($FBOX_TEMPLATE_PRE);
    $post_tmpl = varset($FBOX_TEMPLATE_POST);
    
    if($nav) {
        $ctmpl = $FBOX_TEMPLATE_NAV;
        $pre_tmpl = '';
        $post_tmpl = '';
        $itemsep = $FBOX_TEMPLATE_NAVSEPARATOR;
        
    } elseif($one && $rand) {
        $x = array_rand($found);
        $found = array($found[$x]);
        $found[0]['fbox_default_item'] = 1;
        $def_found = $found[0]; 
    }
    
    
    //else  print_a($def_found);
    if(!getcachedvars('fbox_active_item'))
        cachevars('fbox_active_item', varset($def_found['fbox_id'], 0));

    if($pre_tmpl && $def_found) {
        cachevars('fbox_cdata', $def_found);
        $text[] = $tp -> parseTemplate($pre_tmpl, true, $fbox_shortcodes);
    }
       
    foreach($found as $row) {
    	cachevars('fbox_cdata', $row);
    	$text[] = $tp -> parseTemplate($ctmpl, true, $fbox_shortcodes);
    }
    
    if($post_tmpl && $def_found) {
        cachevars('fbox_cdata', $def_found);
        $text[] = $tp -> parseTemplate($post_tmpl, true, $fbox_shortcodes);
    }

    $ret = ($nav ? varset($FBOX_TEMPLATE_NAV_PRE) : '').implode($itemsep, $text).($nav ? varset($FBOX_TEMPLATE_NAV_POST) : '');

    if(!varset($parms['tablerender']) || $nav)
        return $ret;

    $title = $one ? $tp -> toHTML($found[0]['fbox_title'], FALSE, 'TITLE') : '';
    
    return $ns -> tablerender(($title ? $title : FBOX_MENU_1), $ret, varsettrue($parms['render_mod'], 'fbox'));
}
?>