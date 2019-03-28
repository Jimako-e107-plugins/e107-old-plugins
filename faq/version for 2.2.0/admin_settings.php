<?php
/*
+---------------------------------------------------------------+
|		FAQ Plugin
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
}

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}

require_once("includes/faq_class.php");
if (!is_object($faq_obj))
{
    $faq_obj = new FAQ;
}
$faq_fp = fopen(e_PLUGIN . "faq/graphics/index.htm", "w+");
if ($faq_fp === false)
{
    $faq_message .= FAQ_ADLAN_143 . " ";
}
fclose($faq_fp);
if (isset($_POST['updatesettings']))
{
    $success = 0;
    if (intval($_POST['faq_seo']) == 1 )
    {
        // changed to we are using seo
        $faq_newht = $faq_obj->regen_htaccess('on');
    } elseif (intval($_POST['faq_seo']) == 0 )
    {
        // changed to not using seo
        $faq_newht = $faq_obj->regen_htaccess('off');
    }
    if ($faq_newht > 0)
    {
        $faq_errmsg = explode('~', FAQ_PREFLAN_13);
        $faq_message .= FAQ_PREFLAN_12 . ' ' . $faq_errmsg[$faq_newht] . " ({$faq_newht}) <br />";
    }
    $FAQ_PREF['faq_user'] = intval($_POST['faq_user']);
    $FAQ_PREF['add_faq'] = intval($_POST['add_faq']);
    $FAQ_PREF['faq_approve'] = intval($_POST['faq_approve']);
    $FAQ_PREF['faq_defcomments'] = intval($_POST['faq_defcomments']);
    $FAQ_PREF['faq_allowcomments'] = intval($_POST['faq_allowcomments']);
    $FAQ_PREF['faq_ownedit'] = intval($_POST['faq_ownedit']);
    $FAQ_PREF['faq_super'] = intval($_POST['faq_super']);
    $FAQ_PREF['faq_description'] = $tp->toDB($_POST['faq_description']);
    $FAQ_PREF['faq_keywords'] = $tp->toDB($_POST['faq_keywords']);
    $FAQ_PREF['faq_showposter'] = intval($_POST['faq_showposter']);
    $FAQ_PREF['faq_picupload'] = intval($_POST['faq_picupload']);
    $FAQ_PREF['faq_sendto'] = intval($_POST['faq_sendto']);
    $FAQ_PREF['faq_title'] = $tp->toDB($_POST['faq_title']);
    $FAQ_PREF['faq_mtext'] = $tp->toDB($_POST['faq_mtext']);
    $FAQ_PREF['faq_perpage'] = intval($_POST['faq_perpage']);
    $FAQ_PREF['faq_showrand'] = intval($_POST['faq_showrand']);
    $FAQ_PREF['faq_top'] = intval($_POST['faq_top']);
    $FAQ_PREF['faq_log'] = intval($_POST['faq_log']);
    $FAQ_PREF['faq_stats'] = intval($_POST['faq_stats']);
    $FAQ_PREF['faq_rating'] = intval($_POST['faq_rating']);
    $FAQ_PREF['faq_simple'] = intval($_POST['faq_simple']);
    $FAQ_PREF['faq_seo'] = intval($_POST['faq_seo']);
    $faq_obj->save_prefs();

    $faq_message .= FAQ_PREFLAN_01;
    // we've made changes so clear the cache to get rid of old info
    $faq_obj->faq_cache_clear();
}

$faq_text = "
<div style='text-align:center'>
	<form method='post' action='" . e_SELF . "' id='faqpref'>
		<table style='" . ADMIN_WIDTH . "' class='fborder'>
			<tr>
				<td class='fcaption' colspan='2'>" . FAQ_PREFLAN_10 . "</td>
			</tr>
			<tr>
				<td class='forumheader2' colspan='2'><strong>$faq_message</strong>&nbsp;</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_128 . ":</td>
        		<td style='width:70%' class='forumheader3'>" . r_userclass("faq_user", $FAQ_PREF['faq_user'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
       		 <tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_110 . ":</td>
	        	<td style='width:70%' class='forumheader3'>" . r_userclass("faq_super", $FAQ_PREF['faq_super'], "off", "nobody,admin,main,member,classes") . "</td>
			</tr>
    	    <tr>
	    	    <td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_PREFLAN_02 . ":</td>
	    	    <td style='width:70%' class='forumheader3'>" . r_userclass("add_faq", $FAQ_PREF['add_faq'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_PREFLAN_09 . ":</td>
        		<td style='width:70%' class='forumheader3'>" . r_userclass("faq_approve", $FAQ_PREF['faq_approve'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
	        <tr>
    	    	<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_96 . ":</td>
        		<td style='width:70%' class='forumheader3'>" . r_userclass("faq_allowcomments", $FAQ_PREF['faq_allowcomments'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_95 . ":</td>
        		<td style='width:70%' class='forumheader3'>" . r_userclass("faq_defcomments", $FAQ_PREF['faq_defcomments'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_121 . ":</td>
        		<td style='width:70%' class='forumheader3'>" . r_userclass("faq_sendto", $FAQ_PREF['faq_sendto'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_133 . ":</td>
        		<td style='width:70%' class='forumheader3'>" . r_userclass("faq_stats", $FAQ_PREF['faq_stats'], "off", "admin,main,public,guest,nobody,member,classes") . "</td>
			</tr>
	        <tr>
    	    	<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_139 . ":</td>
        		<td style='width:70%' class='forumheader3'>";

$faq_sub = "<select class='tbox' name='faq_simple' >";
$faq_sub .= "<option value='0' " . ($FAQ_PREF['faq_simple'] == 0?"selected='selected'":"") . ">" . FAQ_ADLAN_141 . "</option>";
$sql->db_Select("faq_info", "faq_info_id,faq_info_title", "where faq_info_parent > 0", "nowhere", false);
while ($faq_row = $sql->db_Fetch())
{
    $faq_sub .= "<option value='" . $faq_row['faq_info_id'] . "' " . ($FAQ_PREF['faq_simple'] == $faq_row['faq_info_id']?"selected='selected'":"") . ">" . $tp->toFORM($faq_row['faq_info_title']) . "</option>";
} // while
$faq_sub .= "</select>";
$faq_text .= $faq_sub;
$faq_text .= "
				</td>
			</tr>
	        <tr>
    	    	<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_144 . ":</td>
        		<td style='width:70%' class='forumheader3'>
					<input type='checkbox' class='tbox' value='1' name='faq_seo' " . ($FAQ_PREF['faq_seo'] > 0?"checked='checked'":"") . " /><br /><i>".FAQ_PREFLAN_14."</i>
				</td>
			</tr>
	        <tr>
    	    	<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_135 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='faq_rating' " . ($FAQ_PREF['faq_rating'] > 0?"checked='checked'":"") . " /></td>
			</tr>
	        <tr>
    	    	<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_109 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='faq_ownedit' " . ($FAQ_PREF['faq_ownedit'] > 0?"checked='checked'":"") . " /></td>
			</tr>
        	<tr>
       			<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_134 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='faq_log' " . ($FAQ_PREF['faq_log'] > 0?"checked='checked'":"") . " /></td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_117 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='faq_showposter' " . ($FAQ_PREF['faq_showposter'] > 0?"checked='checked'":"") . " /></td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_118 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='faq_picupload' " . ($FAQ_PREF['faq_picupload'] > 0?"checked='checked'":"") . " /></td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_125 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='faq_showrand' " . ($FAQ_PREF['faq_showrand'] > 0?"checked='checked'":"") . " /></td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_126 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='text' name='faq_top' style='width:10%' class='tbox' value='" . $tp->toFORM($FAQ_PREF['faq_top']) . "' /></td>
			</tr>
			<tr>
		        <td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_122 . ":</td>
		        <td style='width:70%' class='forumheader3'><input type='text' name='faq_title' style='width:80%' class='tbox' value='" . $tp->toFORM($FAQ_PREF['faq_title']) . "' /></td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_113 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='text' name='faq_description' style='width:80%' class='tbox' value='" . $tp->toFORM($FAQ_PREF['faq_description']) . "' />
					<br /><span class='smalltext'>" . FAQ_ADLAN_114 . "</span>
				</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_115 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='text' name='faq_keywords' style='width:80%' class='tbox' value='" . $tp->toFORM($FAQ_PREF['faq_keywords']) . "' />
					<br /><span class='smalltext'>" . FAQ_ADLAN_116 . "</span>
				</td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_123 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='text' name='faq_mtext' style='width:80%' class='tbox' value='" . $tp->toFORM($FAQ_PREF['faq_mtext']) . "' /></td>
			</tr>
        	<tr>
        		<td style='width:30%; vertical-align:center' class='forumheader3'>" . FAQ_ADLAN_124 . ":</td>
        		<td style='width:70%' class='forumheader3'><input type='text' name='faq_perpage' style='width:10%' class='tbox' value='" . $tp->toFORM($FAQ_PREF['faq_perpage']) . "' /></td>
			</tr>
			<tr>
				<td colspan='2'  style='text-align:left;vertical-align:top' class='fcaption'>
    				<input class='button' type='submit' name='updatesettings' value='" . FAQ_PREFLAN_03 . "' />
    			</td>
    		</tr>
    	</table>
	</form>
</div>";

$ns->tablerender(FAQ_ADLAN_88, $faq_text);

require_once(e_ADMIN . "footer.php");
