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
// always include the class2.php file - this is the main e107 file
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}

// this generates all the HTML up to the start of the main section
require_once(HEADERF);

// Include plugin language file, check first for site's preferred language
$pdir = e_PLUGIN."tutorials";
@include_once($pdir."/languages/".e_LANGUAGE.".php");
@include_once($pdir."/languages/English.php");

require_once($pdir."/tut_funcs.php");

if(e_QUERY){
	$qs = explode(".", e_QUERY);
}

if($qs[0] == 'view' && is_numeric($qs[1])){
	$sql -> db_Select("tutsplugin_tutorial", "*", "id=".$qs[1]);
	$r = $sql -> db_Fetch();
	$views = $r['views'] +1;
	$sql -> db_Update("tutsplugin_tutorial","views='$views' WHERE id='".$qs[1]."'");
	$text = '<div class="forumheader3" style="display:block; width:100%;">'.show_breadcrumb().'</div>';
	//View specific category
	$sql -> db_Select("tutsplugin_tutorial", "*", "accepted=1 AND id=".$qs[1]);
	while($row = $sql -> db_Fetch()){
		$text .= $TABLE_START;
		$author_info = array('user_name' => "me");//getAuthor($row['poster_id']);
		$dateConv = @gmdate("d M Y", $row['date']);  // Mods by e107 Italia
		$categ = getCategory($row['catID']);
		$text .= '
			<tr>
				<td class="fcaption">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="3"><img src="'.stripslashes($tp->toHTML($row['icon'], false)).'" border="0" alt=""></td>
						</tr>
						<tr>
							<td><a href="'.$pdir."/tutorials.php?view.".$row['id'].'"><b>'.stripslashes($tp->toHTML($row['name'], false)).'</b></a></td>
						</tr>
						<tr>
							<td>'.stripslashes($tp->toHTML($row['shortdesc'], true)).'<p>'.getRating("tutplug_r", $row['id']).'</p></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="forumheader3">'.stripslashes($tp->toHTML($row['longdesc'], true)).'</td>
			</tr>
			<tr>
				<td class="fcaption">'.TUT_VIEW_BY.' <a href="'.e_BASE.'user.php?id.'.$row['poster_id'].'">'.stripslashes($tp->toHTML($author_info['user_name'])).'</a> '.TUT_VIEW_ON.' '.$dateConv.' '.TUT_VIEW_IN.' <a href="'.$pdir.'/tutorials.php?cat.'.$row['catID'].'">'.stripslashes($tp->toHTML($categ['name'])).'</a>.</td>
			</tr>';
		$text.= $TABLE_END;
		$text .= getComment("tutplug_c", $row['id']);
	}
}else if($qs[0] == 'cat' && is_numeric($qs[1])){
	$text = '<div class="forumheader3" style="display:block; width:100%;">'.show_breadcrumb().'</div>';
	//View specific category
	if($sql -> db_Count("tutsplugin_tutorial", "(*)", "WHERE accepted=1 AND catID=".$qs[1]) > 0){
		$sql -> db_Select("tutsplugin_tutorial", "*", "accepted=1 AND catID=".$qs[1]." ORDER BY ".$pref['tuts_ordertby']." ".$pref['tuts_ordertdir']);
		while($row = $sql -> db_Fetch()){
			$text .= $TABLE_START;
			$author_info = getAuthor($row['poster_id']);
			$dateConv = @gmdate("d M Y", $row['date']); // Mods by e107 Italia
			$categ = getCategory($row['catID']);
			$text .= '
				<tr>
					<td rowspan="4" align="center" valign="middle" class="forumheader3"><a href="'.$pdir."/tutorials.php?view.".stripslashes($tp->toHTML($row['id'], false)).'"><img src="'.stripslashes($tp->toHTML($row['icon'], false)).'" border="0" alt=""></a></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="forumheader3"><a href="'.$pdir."/tutorials.php?view.".stripslashes($tp->toHTML($row['id'], false)).'"><b>'.stripslashes($tp->toHTML($row['name'], false)).'</b> ('.stripslashes($tp->toHTML($row['views'], false)).' '.TUT_VIEW_VIEWS.')</a></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="forumheader3">'.stripslashes($tp->toHTML($row['shortdesc'], true)).'</td>
				</tr>
				<tr>
					<td align="left" valign="top" class="forumheader3">'.TUT_VIEW_BY.' <a href="'.e_BASE.'user.php?id.'.$row['poster_id'].'">'.stripslashes($tp->toHTML($author_info['user_name'])).'</a> '.TUT_VIEW_ON.' '.$dateConv.' '.TUT_VIEW_IN.' <a href="'.$pdir.'/tutorials.php?cat.'.$row['catID'].'">'.stripslashes($tp->toHTML($categ['name'])).'</a>.</td>
				</tr>';
			$text.= $TABLE_END;
		}
	}else{
		$text = '<div class="forumheader3" style="display:block; width:100%;">'.show_breadcrumb().'</div>';
		$text .= TUT_VIEW_NOTUTS;
	}
}else{
	$text = '<div class="forumheader3" style="display:block; width:100%;">'.show_breadcrumb().'</div>';
	//View category list
	$sql -> db_Select("tutsplugin_cats", "*", "1 ORDER BY ".$pref['tuts_ordercby']." ".$pref['tuts_ordercdir']);
	while($row = $sql -> db_Fetch()){
		$text .= $TABLE_START;
		$text .= "
		<tr>
			<td rowspan='4' width='100' class='forumheader3' align='center' valign='middle'><a href='".$pdir."/tutorials.php?cat.".stripslashes($tp->toHTML($row['id'], false))."'><img src='".stripslashes($tp->toHTML($row['icon'], false))."' border='0' alt='' /></a></td>
		</tr>
		<tr>
			<td class='forumheader3'><b><a href='".$pdir."/tutorials.php?cat.".stripslashes($tp->toHTML($row['id'], false))."'>".stripslashes($tp->toHTML($row['name'], false))."</a> ( ".stripslashes($tp->toHTML($row['indexed'], false))." ".TUT_VIEW_INDEXED." )</b></td>
		</tr>
		<tr>
			<td class='forumheader3'>".stripslashes($tp->toHTML($row['desc'], true))."</td>
		</tr>";
		$text .= $TABLE_END."<br />";
	}
}

$usersubtag = (($pref['tuts_allowusersub'] == true) ? '<br /><center><a href="'.$pdir.'/submit.php">'.TUT_SUBM_LINK.'</a></center>' : "");
// Ensure the pages HTML is rendered using the theme layout.
$ns->tablerender(TUT_TITLE, $text.$usersubtag);

// this generates all the HTML (menus etc.) after the end of the main section
require_once(FOOTERF);
?>