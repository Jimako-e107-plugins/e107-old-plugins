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
if (!defined('e107_INIT')) { exit; }
	$pdir = e_PLUGIN."tutorials";
	$text = "";
	$place = 0;
	$replace = array('$', '"', "'", '\\', "'&#092;'");
	$search = array('&#036;','&quot;','&#039;','&#092;','&#039;');
	switch($pref['tuts_menulist']){
		case 'new':
		case 'views':
			$sort=($pref['tuts_menulist']=='new') 
			? "accepted=1 ORDER BY id DESC LIMIT ".$pref['tuts_menunum'] 
			: "accepted=1 ORDER BY views DESC LIMIT ".$pref['tuts_menunum'];
			$sql -> db_Select("tutsplugin_tutorial", "*", $sort);
			echo mysql_error();
			$text.='
				<table width="100%" border="0" cellpadding="0" cellspacing="0">';
			while($row = $sql -> db_Fetch()){
				$place++;
				$text .='
					<tr>
						<td valign="top">#'.$place.':</td>
						<td valign="top"><a href="'.$pdir.'/tutorials.php?view.'.$row['id'].'">'.stripslashes(str_replace($search, $replace, $row['name'])).'</a></td>
					</tr>';
			}
			$text.='
				</table>';
		break;
		case 'rate':
		default:
			$text .="This option is not available.";
		break;
	}
	$ns -> tablerender(TUT_MENU_TITLE, $text);
?>