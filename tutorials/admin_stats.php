<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."ren_help.php");

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}
// Include plugin language file, check first for site's preferred language
$pdir = e_PLUGIN."tutorials";
@include_once($pdir."/languages/".e_LANGUAGE.".php");
@include_once($pdir."/languages/English.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."file_class.php");
$fl = new e_file;

require_once($pdir."/tut_funcs.php");

if(e_QUERY){
	$qs = explode(".", e_QUERY);
}

function getTuts($catID){
	global $tp, $TABLE_START, $TABLE_END;
	$sql=new db();
	if($sql->db_Count("tutsplugin_tutorial", "(*)", "WHERE catID='".$catID."' AND accepted='1'") > 0){
		$sql->db_Select("tutsplugin_tutorial", "*", "catID='".$catID."' AND accepted='1'");
		$text .= $TABLE_START.'
			<tr>
				<td class="fcaption" style="background-color:#CCCCFF;">&nbsp;</td>
				<td class="forumheader3" style="background-color:#CCCCFF;"><b>'.TUT_STATS_ICON.'</b></td>
				<td class="forumheader3" style="background-color:#CCCCFF;"><b>'.TUT_STATS_NAME.'</b></td>
				<td class="forumheader3" style="background-color:#CCCCFF;"><b>'.TUT_STATS_AUTHOR.'</b></td>
				<td class="forumheader3" style="background-color:#CCCCFF;"><b>'.TUT_STATS_VIEWS.'</b></td>
			</tr>';
		$count=0;
		
		while($row=$sql->db_Fetch()){
			$count++;
			$author_info = getAuthor($row['poster_id']);
			$text .= '
				<tr>
					<td class="fcaption">#'.$count.'</td>
					<td class="forumheader3"><img src="'.stripslashes($tp->toHTML($row['icon'])).'" border="0" alt="" /></td>
					<td class="forumheader3">'.stripslashes($tp->toHTML($row['name'])).'</td>
					<td class="forumheader3">'.$author_info['user_name'].'</td>
					<td class="forumheader3">'.stripslashes($tp->toHTML($row['views'])).'</td>
				</tr>';
		}
		$text .= $TABLE_END;
		return $text;
	}
}

$sql->db_Select("tutsplugin_cats", "*", "1 ORDER BY id DESC");
$text=$TABLE_START.'
	<tr>
		<td class="fcaption">&nbsp;</td>
		<td class="forumheader3"><b>'.TUT_STATS_ICON.'</b></td>
		<td class="forumheader3"><b>'.TUT_STATS_NAME.'</b></td>
		<td class="forumheader3"><b>'.TUT_STATS_INDEXED.'</b></td>
	</tr>';
$count=0;
while($row=$sql->db_Fetch()){
	$count++;
	$text.='
		<tr>
			<td class="fcaption">#'.$count.'</td>
			<td class="forumheader3"><img src="'.stripslashes($tp->toHTML($row['icon'])).'" border="0" alt="" /></td>
			<td class="forumheader3">'.stripslashes($tp->toHTML($row['name'])).'</td>
			<td class="forumheader3">'.stripslashes($tp->toHTML($row['indexed'])).'</td>
		</tr>
		<tr>
			<td width="10" class="fcaption">&nbsp;</td>
			<td colspan="3">'.getTuts($row['id']).'</td>
		</tr>';
}
$text .=$TABLE_END;

if($message){
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}

$ns->tablerender(TUT_ADMIN_TITLE, $text);
require_once(e_ADMIN."footer.php");

?>