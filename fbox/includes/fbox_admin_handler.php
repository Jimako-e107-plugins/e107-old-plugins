<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: fbox_admin_handler.php 717 2008-01-16 14:11:48Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

require_once(e_PLUGIN.'fbox/includes/fbox_utils.php');

    /*  MANAGE CONTENT  */
function fbox_page_manage($rel=array())
{
    global $pref, $tp, $rs, $sql, $FBOX_SYSMSG;
    
    if(!varset($rs)) {
        require_once(e_HANDLER."form_handler.php");
        $rs = new form;
    }

    require_once(e_HANDLER.'userclass_class.php');
    require_once(e_HANDLER.'ren_help.php');
    
    $id = varset($rel[1]) ? intval($rel[1]) : 0;
    $act = $id ? 'update' : 'create';
    
    //update
    if($act == 'update' && !varset($_POST['admin_event'])) {
        if($sql->db_Select('fbox',"*", "fbox_id='{$id}'")) {
            $_POST = $sql -> db_Fetch();
            //process some vars
            $_POST['fbox_page_match'] = str_replace('^', "\n", $_POST['fbox_page_match']);
            $_POST['fbox_image'] = $tp -> replaceConstants($_POST['fbox_image']);
        } else {
            fbox_out(FBOX_LANADM, LAN_ERROR, array(FBOX_LANSYSMSG_4));
            return;
        }
    }
    
    //text area + bbcodes
    $insertjs = (!e_WYSIWYG) ? "onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ": "";
    $ta = $rs -> form_textarea("fbox_text", 60, 10, $tp -> post_toForm(varset($_POST['fbox_text'])), $insertjs, 'width: 98%').display_help("helpb", 'body');
    //$rs -> form_textarea('fbox_text', 60, 10, $tp -> post_toForm(varsettrue($_POST['fbox_text'], '')), "", "width: 90%")
    
    
    //image selector
    $imgsel = fbox_imageselector('fbox_image', varset($_POST['fbox_image']));
    
    $text = "
    	<form method='post' action='".e_SELF.(e_QUERY ? "?".e_QUERY : '')."' id='module_data'>
        <table class='fborder' style='".USER_WIDTH."'>
        	<tr>
        		<td class='fcaption' colspan='2' style='text-align: left'><h3>".FBOX_LANMNG."</h3></td>
        	</tr>
        	
            <tr>
                <td style='width:40%; text-align: left' class='forumheader3'>
                    ".FBOX_LANMNG_1."
                </td>
                <td style='width:60%; text-align: left;' class='forumheader3'>
                    ".$rs -> form_text('fbox_title', '', $tp -> post_toForm(varsettrue($_POST['fbox_title'], '')), 250, 'tbox', "", "", " style='width: 90%'")."
                </td>
            </tr>

            <tr>
                <td style='text-align: left; vertical-align: top' class='forumheader3'>
                    ".FBOX_LANMNG_2."
                </td>
                <td style='text-align: left;' class='forumheader3'>
                    ".$ta."
                </td>
            </tr>
            
            <tr>
                <td style='text-align: left; vertical-align: top' class='forumheader3'>
                    ".FBOX_LANMNG_7."
                </td>
                <td style='text-align: left;' class='forumheader3'>
                    {$imgsel}
                </td>
            </tr>
        	
            <tr>
                <td style='text-align: left' class='forumheader3'>
                    ".FBOX_LANMNG_5."
                </td>
                <td style='text-align: left;' class='forumheader3'>
                    ".fbox_util_tmplcombo('fbox_default_tmpl', varsettrue($_POST['fbox_default_tmpl'], $pref['fbox_default_tmpl']))."
                </td>
            </tr>
            
            <tr>
                <td style='width:40%; text-align: left' class='forumheader3'>
                    ".FBOX_LANMNG_6."
                </td>
                <td style='width:60%; text-align: left;' class='forumheader3'>
                    ".$rs -> form_text('fbox_page_exactmatch', '', $tp -> post_toForm(varsettrue($_POST['fbox_page_exactmatch'], '')), 250, 'tbox', "", "", " style='width: 90%'")."
                </td>
            </tr>
            
            <tr>
                <td style='text-align: left; vertical-align: top' class='forumheader3'>
                    ".FBOX_LANMNG_4."
                </td>
                <td style='text-align: left;' class='forumheader3'>
                    ".$rs -> form_textarea('fbox_page_match', 60, 5, $tp -> post_toForm(varsettrue($_POST['fbox_page_match'], '')), "", "width: 98%")."
                </td>
            </tr>
            
            <tr>
                <td style='text-align: left' class='forumheader3'>
                    ".FBOX_LANMNG_3."
                </td>
                <td style='text-align: left;' class='forumheader3'>
                    ".r_userclass("fbox_permission", $tp -> post_toForm(varsettrue($_POST['fbox_permission'], '')), "off", "public,member,nobody,admin,main,classes")."
                </td>
            </tr>

            <tr>
                <td style='width:100%; text-align: center' colspan='2' class='forumheader'>
                    <input type='submit' class='button' name='admin_event[save_{$act}]' value='".constant('LAN_'.strtoupper($act))."' title='' />
                </td>
            </tr>
    	</table>
    	</form>
    ";
    //
    fbox_out(FBOX_LANADM, $text, $FBOX_SYSMSG);
    
}

function fbox_event_manage($event, $rel=array())
{
    global $pref, $tp, $FBOX_SYSMSG;
    
    $id = varset($rel[1]) ? intval($rel[1]) : 0;
    $act = $id ? 'update' : 'create';
    
    $data = array();
    
    $data['fbox_title'] = $tp -> toDB($_POST['fbox_title']);
    $data['fbox_text'] = $tp -> toDB($_POST['fbox_text']);
    $data['fbox_image'] = $tp -> createConstants(fbox_abs2rel($_POST['fbox_image']), 1);
    $data['fbox_default_tmpl'] = $tp -> toDB($_POST['fbox_default_tmpl']);
    $data['fbox_page_match'] = $_POST['fbox_page_match'] ? implode('^', explode("\n", trim(str_replace("\r\n", "\n", $_POST['fbox_page_match'])))) : '';
    $data['fbox_page_exactmatch'] = $tp -> createConstants(fbox_abs2rel($_POST['fbox_page_exactmatch']), 1);
    $data['fbox_page_exactmatch'] = str_replace('{e_BASE}', '', $data['fbox_page_exactmatch']);
    $data['fbox_permission'] = $tp -> toDB($_POST['fbox_permission']);
    
    //tricky ;)
    $func = 'fbox_manage_'.$act;

    //more tricky ;)
    if($scss = $func($data, $id)) {
        //clear all posted vars
        $_POST = '';
        fbox_sessmgs(constant('LAN_'.strtoupper($act).'D'));
        session_write_close();
        header('Location: '.e_SELF.'?'.e_QUERY);
        exit;
    } else {
        $FBOX_SYSMSG[] = constant('LAN_'.strtoupper($act).'D_FAILED');
    }
}

function fbox_manage_update(&$data, $rel)
{
    global $sql;
    
    if(!$rel) return false;

    $update = '';
    foreach ($data as $key=>$value) {
    	$update .= ", {$key}='{$value}'";
    }
    $update = trim(substr($update, 1));

    return $sql -> db_Update('fbox', $update." WHERE fbox_id='{$rel}'");
}

function fbox_manage_create(&$data, $rel)
{
    global $sql;
    return $sql -> db_Insert('fbox', $data);
}

    /*  LIST CONTENT ITEMS  */
function fbox_page_list($rel=array())
{
    global $pref, $tp, $rs, $sql, $FBOX_SYSMSG;
    
    if(!varset($rs)) {
        require_once(e_HANDLER."form_handler.php");
        $rs = new form;
    }
    
    require_once(e_HANDLER.'userclass_class.php');
    
    if($sql->db_Select('fbox',"*")) {
        $text = '';
        $tmparray = $sql -> db_getList();
       
        foreach ($tmparray as $row) {

            $text .= "
            <tr>
                <td style='text-align: left' class='forumheader3'>
                    ".$tp -> toHtml($row['fbox_title'], false, 'TITLE')."
                </td>
                
                <td style='text-align: center' class='forumheader3'>
                    ".($row['fbox_page_exactmatch'] ? "<a href='#' onclick=\"expandit('fboxp_{$row['fbox_id']}'); return false;\">".FBOX_LANLIST_6."</a><div id='fboxp_{$row['fbox_id']}' style='display: none; padding: 5px;'>".$tp -> toHtml($row['fbox_page_exactmatch'], true, 'TITLE')."</div>" : FBOX_LANSYSMSG_NA)."
                </td>
                
                <td style='text-align: center;' class='forumheader3'>
                    ".($row['fbox_page_match'] ? "<a href='#' onclick=\"expandit('fboxps_{$row['fbox_id']}'); return false;\">".FBOX_LANLIST_6."</a><div id='fboxps_{$row['fbox_id']}' style='display: none; padding: 5px;'>".(implode('<br />', explode('^', $row['fbox_page_match'])))."</div>" : FBOX_LANSYSMSG_NA)."
                </td>
                
                <td style='text-align: center;' class='forumheader3'>
                    ".r_userclass("fbox_multi_permission[{$row['fbox_id']}]", $row['fbox_permission'], "off", "public,member,nobody,admin,main,classes")."
                </td>
                
                <td style='text-align: center;' class='forumheader3'>
                    <a href='".e_PAGE."?manage.{$row['fbox_id']}'>[".LAN_EDIT."]</a> <a href='".e_PAGE."?delete.{$row['fbox_id']}' onclick=\"return jsconfirm('".FBOX_LANSYSMSG_CONFIRM." [ID: {$row['fbox_id']} ]')\">[".LAN_DELETE."]</a>
                </td>
            </tr>
            ";
        } 
        $text .= "

            <tr>
                <td style='width:100%; text-align: right' colspan='5' class='forumheader'>
                    <input type='submit' class='button' name='admin_event[multi_update]' value='".LAN_UPDATE."' title='' />
                </td>
            </tr>
        ";
    }else {
        $text = "
        <tr>
            <td style='text-align: center' colspan='5' class='forumheader3'>
                ".FBOX_LANSYSMSG_5." <a href='".e_PAGE."?manage'>[".LAN_CREATE."]</a>
            </td>
        </tr>
        ";
    }
    
    
    $text = "
    	<form method='post' action='".e_SELF.(e_QUERY ? "?".e_QUERY : '')."' id='module_data'>
        <table class='fborder' style='".USER_WIDTH."'>
        	<tr>
        		<td class='fcaption' colspan='5' style='text-align: left'><h3>".FBOX_LANLIST."</h3></td>
        	</tr>
        	
            <tr>
                <td style='width:30%; text-align: center' class='forumheader'>
                    ".FBOX_LANLIST_1."
                </td>
                <td style='width:15%; text-align: center;' class='forumheader'>
                    ".FBOX_LANLIST_3."
                </td>
                <td style='width:15%; text-align: center;' class='forumheader'>
                    ".FBOX_LANLIST_4."
                </td>
                <td style='width:20%; text-align: center;' class='forumheader'>
                    ".FBOX_LANLIST_2."
                </td>
                <td style='width:20%; text-align: center;' class='forumheader'>
                    ".FBOX_LANLIST_5."
                </td>
            </tr>

            $text

    	</table>
    	</form>
    ";
    
    //
    fbox_out(FBOX_LANADM, $text, $FBOX_SYSMSG);
    
}

function fbox_event_list($event, $rel=array())
{
    global $pref, $sql, $FBOX_SYSMSG;
    
    if(!$event) return;
    
    foreach ($event as $key=>$value) {
    	$func = 'fbox_list_'.$key;
    	$func($_POST);
    }
}

function fbox_list_multi_update(&$data)
{
    global $pref, $sql, $FBOX_SYSMSG;
    
    if(varset($_POST['fbox_multi_permission'])) {
        $upd = array();
        foreach ($_POST['fbox_multi_permission'] as $id=>$vis) {
        	$upd[$vis][] = $id;
        }
        
        if(!empty($upd)) {
            foreach ($upd as $ord=>$ids) {
            	$sql -> db_Update("fbox", "fbox_permission='{$ord}' WHERE fbox_id IN (".implode(',', $ids).")");
            }
            
            $FBOX_SYSMSG[] = LAN_UPDATED;
        }
    }
}


function fbox_page_delete($rel=array())
{
    global $pref, $sql, $FBOX_SYSMSG;
    
    fbox_delete_item($rel);
    fbox_page_list($rel);
    
}

function fbox_delete_item($rel=array())
{
    global $pref, $sql, $FBOX_SYSMSG;
    
    if(!varset($rel[0]) || !varsettrue($rel[1])) return;
    
    $id = intval($rel[1]);
    if($sql->db_Delete("fbox", "fbox_id='{$id}' "))
        $FBOX_SYSMSG[] = LAN_DELETED;
}

    /*  PLUGIN SETTINGS  */
function fbox_page_config($rel=array())
{
    global $pref, $rs, $FBOX_SYSMSG;
    
//radio - js pref
	$checked = $pref['fbox_js'] ? " checked='checked'" : "";
    $chbox .= "\n<input type='radio' value='1' name='fbox_js' id='fbox_js_1'{$checked} title='' />";
    $chbox .= "\n<label for='fbox_js_1' title=''>".LAN_ENABLED."</label>&nbsp;&nbsp;";
    
    $checked = !$pref['fbox_js'] ? " checked='checked'" : "";
    $chbox .= "\n<input type='radio' value='0' name='fbox_js' id='fbox_js_0'{$checked} title='' />";
    $chbox .= "\n<label for='fbox_js_0' title=''>".LAN_DISABLED."</label>";

/*
    if(!varset($rs)) {
        require_once(e_HANDLER."form_handler.php");
        $rs = new form;
    }
//menu template combo
    $combo = $rs -> form_select_open('fbox_menutmpl');
    $combo .= $rs -> form_option(FBOX_LANCONF_NONE, !$pref['fbox_menutmpl'], '');
    $combo .= $rs -> form_option(FBOX_LANCONF_DEFAULT, ($pref['fbox_menutmpl'] == 'default'), 'default');
    $combo .= $rs -> form_option(FBOX_LANCONF_ALTERNATE, ($pref['fbox_menutmpl'] == 'menu_alt'), 'menu_alt');
    $combo .= $rs -> form_select_close();
*/
    
    require_once(e_HANDLER.'userclass_class.php');
    
    $text = "
    	<form method='post' action='".e_SELF."?".e_QUERY."' id='module_prefs'>
        <table class='fborder' style='".USER_WIDTH."'>
        	<tr>
        		<td class='fcaption' colspan='2' style='text-align: left'><h3>".FBOX_LANCONF."</h3></td>
        	</tr>
            <tr>
                <td style='width:40%; text-align: left' class='forumheader3'>
                    <strong>".FBOX_LANCONF_1."</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".FBOX_LANCONF_1a."</span>
                </td>
                <td style='width:60%; text-align: left;' class='forumheader3'>
                    ".r_userclass("fbox_permission", $pref['fbox_permission'], "off", "public,member,nobody,admin,main,classes")."
                </td>
            </tr>
            <tr>
                <td style='text-align: left' class='forumheader3'>
                    <strong>".FBOX_LANCONF_2."</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".FBOX_LANCONF_2a."</span>
                </td>
                <td style='text-align: left;' class='forumheader3'>
                    ".fbox_util_tmplcombo('fbox_default_tmpl', $pref['fbox_default_tmpl'])."
                </td>
            </tr>
            <tr>
                <td style='width:40%; text-align: left' class='forumheader3'>
                    <strong>".FBOX_LANCONF_3."</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".FBOX_LANCONF_3a."</span>
                </td>
                <td style='width:60%; text-align: left;' class='forumheader3'>
                    ".$chbox."
                </td>
            </tr>
            <tr>
                <td style='width:40%; text-align: left' class='forumheader3'>
                    <strong>".FBOX_LANCONF_4."</strong>
                    <br /><span class='smalltext' style='font-style: italic;'>".FBOX_LANCONF_4a."</span>
                </td>
                <td style='width:60%; text-align: left;' class='forumheader3'>
                    ".fbox_util_tmplcombo('fbox_menutmpl', $pref['fbox_menutmpl'])."
                </td>
            </tr>
            <tr>
                <td style='width:100%; text-align: center' colspan='2' class='forumheader'>
                    <input type='submit' class='button' name='admin_event[save_prefs]' value='".LAN_UPDATE."' title='' />
                </td>
            </tr>
    	</table>
    	</form>
    ";
    //
    fbox_out(FBOX_LANADM, $text, $FBOX_SYSMSG);
    
}

function fbox_event_config($event, $rel=array())
{
    global $pref, $tp, $FBOX_SYSMSG;
    if(varset($event['save_prefs'])) {
        $pref['fbox_permission'] =  $tp -> toDB($_POST['fbox_permission']);
        $pref['fbox_default_tmpl'] = $tp -> toDB($_POST['fbox_default_tmpl']);
        $pref['fbox_js'] = $_POST['fbox_js'] ? 1 : 0;
        $pref['fbox_menutmpl'] = $tp -> toDB($_POST['fbox_menutmpl']);
        
        save_prefs();
        $FBOX_SYSMSG[] = FBOX_LANSYSMSG_1;
        
        return true;
    }
    
    $FBOX_SYSMSG[] = FBOX_LANSYSMSG_2;
    return false;
}


    /*  PLUGIN HELP  */
function fbox_page_help($rel=array())
{

    $text = "
    	<table class='fborder' style='".USER_WIDTH."'>
        	<tr>
        		<td class='fcaption' colspan='2' style='text-align: left'><h3>".FBOX_LANHELP."</h3></td>
        	</tr>
        	<tr>
        		<td class='forumheader' style='width: 5%; text-align: right; vertical-align: top'><strong>".FBOX_LANHELP_QUESTION."</strong>&nbsp;</td>
        		<td class='forumheader3' style='width:95%; text-align: left'><strong>".FBOX_LANHELP_1."</strong></td>  
        	</tr>
        	<tr>
        		<td class='forumheader' style='width:5%; text-align: right; vertical-align: top'><strong>".FBOX_LANHELP_ANSWER."</strong>&nbsp;</td>
        		<td class='forumheader3' style='width:95%; text-align: left'>".FBOX_LANHELP_1a."&nbsp;&nbsp;<a href='http://www.clabteam.com'>free-source.net</a></td>  
        	</tr>
        	<tr>
        		<td class='fcaption' colspan='2' style='text-align: center'>&nbsp;</td>
        	</tr>
        	
        	<tr>
        		<td class='forumheader' style='width: 5%; text-align: right; vertical-align: top'><strong>".FBOX_LANHELP_QUESTION."</strong>&nbsp;</td>
        		<td class='forumheader3' style='width:95%; text-align: left'><strong>".FBOX_LANHELP_2."</strong></td>  
        	</tr>
        	<tr>
        		<td class='forumheader' style='width:5%; text-align: right; vertical-align: top'><strong>".FBOX_LANHELP_ANSWER."</strong>&nbsp;</td>
        		<td class='forumheader3' style='width:95%; text-align: left'>".FBOX_LANHELP_2a."&nbsp;&nbsp;<a href='http://www.clabteam.com'>free-source.net</a></td>  
        	</tr>
        	<tr>
        		<td class='fcaption' colspan='2' style='text-align: center'>&nbsp;</td>
        	</tr>
        	
        	<tr>
        		<td class='forumheader' style='width: 5%; text-align: right; vertical-align: top'><strong>".FBOX_LANHELP_QUESTION."</strong>&nbsp;</td>
        		<td class='forumheader3' style='width:95%; text-align: left'><strong>".FBOX_LANHELP_3."</strong></td>  
        	</tr>
        	<tr>
        		<td class='forumheader' style='width:5%; text-align: right; vertical-align: top'><strong>".FBOX_LANHELP_ANSWER."</strong>&nbsp;</td>
        		<td class='forumheader3' style='width:95%; text-align: left'>".str_replace("%s%", "&nbsp;<a href='http://www.clabteam.com'>free-source.net</a>&nbsp;", FBOX_LANHELP_3a)."<br />".FBOX_LANHELP_3b."</td>  
        	</tr>
    	</table>
    ";
    
    fbox_out(FBOX_LANADM, $text, $FBOX_SYSMSG);
    
}

    /*  PLUGIN README  */
function fbox_page_readme($rel=array())
{

    $fc = file_get_contents(e_PLUGIN.'fbox/readme.txt');
    $fc = str_replace("\n", "<br />", htmlspecialchars($fc, ENT_COMPAT, CHARSET));
    $text = "
    	<table class='fborder' style='".USER_WIDTH."'>
        	<tr>
        		<td class='fcaption' style='text-align: left'><h3>".FBOX_LANREADME."</h3></td>
        	</tr>
        	<tr>
        		<td class='forumheader3' style='width:100%; text-align: left'>".$fc."</td>
        	</tr>
    	</table>
    ";
    
    fbox_out(FBOX_LANADM, $text, $FBOX_SYSMSG);
    
}

?>