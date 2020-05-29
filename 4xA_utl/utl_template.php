<?php
/*
+---------------------------------------------------------------+
|        4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/utl_template.php
|
|        For the e107 website system
|        Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
global $utl_shortcodes, $pref;
$ImageEDIT['PFAD']=e_PLUGIN."4xA_utl/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".e4xA_UTL_EDIT."' src='".$ImageEDIT['PFAD']."'>";

$UTL_SHORT_TEMPLATE = "
	<td class='".$pref['4xA_utl_css_class']."' style='vertical-align:top;text-align:left;padding:2px;'>
	<table style='width:100%;font-size:100%;'>
		<tr>
			<td rowspan='5' style='width:100px;text-align:center;padding:3px;'>{USER_PHOTO}</td>
			<td class='' style='width:80%;text-align:left;padding:0px;padding-left:3px;'>{USER_NAMERICH} <font style='color:#888'>&nbsp;".e4xA_UTL_GEN."&nbsp;</font><b>{USER_NAME_LINK}</b>&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_UTL_KONTACT."</font> {USER_EMAIL}</td>
		</tr>
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_UTL_ONLINE_STAT."</font>{USER_STATUS}";
if(ADMIN)
	{
	$UTL_SHORT_TEMPLATE .= "<a href='".e_PLUGIN."4xA_utl/admin_config.php?edit.{UTL_LIST_IS}' ><img border='0' style='vertical-align: middle' title='".e4xA_UTL_EDIT."' src='".$ImageEDIT['PFAD']."'></a>";			
	}
$UTL_SHORT_TEMPLATE .= "</td>
		</tr>	
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_UTL_ONLINE_FUNCT."</font><br/>{USER_AUFG}</td>
		</tr>
		<tr>
			<td class='' style='text-align:left;padding:0px;padding-left:3px;'><font style='color:#888'>".e4xA_UTL_DESC2."</font><br/> {USER_DATA_DESC}</td>
		</tr>";
$UTL_SHORT_TEMPLATE .= "</table></td>";
?>
