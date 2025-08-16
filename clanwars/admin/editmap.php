<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?EditMap/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$mid = intval($_GET['mid']);
$gid = intval($_GET['gid']);

$sql->db_Select("clan_wars_maps", "*", "mid='$mid'");
$row = $sql->db_Fetch();
	$mapname = $row['name'];
	$mapimage = $row['image'];

	$text =  "<form action='admin.php?SaveMap' method='post' enctype='multipart/form-data'>
	<table id='editgametable'>
		<tr>
			<td align='left'>"._WNAME.":&nbsp;</td>
			<td align='left'><input type='text' name='mapname' value='$mapname'></td>
		</tr>";
		if($mapimage !="" && file_exists("images/Maps/$mapimage")){
		$wihei = "";
		$size = getimagesize("images/Maps/$mapimage");
		if($size[0] > 150){
			$wihei = "width='150'";
			$newh = 150 / $size[0] * $size[1];
			if($newh > 30){
				$wihei = "height='30'";
			}
		}elseif($size[1] > 30){
			$wihei = "height='30'";
		}
	
		$text .= "<tr>
				<td align='left' valign='top' style='padding-top:3px;'>Current Image&nbsp;</td>
				<td align='left' valign='middle'><img src='images/Maps/$mapimage' border='0' $wihei align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delimage' value='1'>"._WDEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._WUPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='mapimage'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._IMAGE.":&nbsp;</td>
				<td align='left'><input type='file' name='mapimage'></td>
			</tr>";
		}
		$text .= "<tr>
			<td align='left' colspan='2'><br />
			<input type='hidden' name='mid' value='$mid'>
			<input type='hidden' name='gid' value='$gid'>
			<input type='hidden' name='e-token' value='".e_TOKEN."' />
			<input type='submit' class='button' name='submit' value='"._WSAVECHANGES."'></td>
		</tr>
	</table>
	</form>";
	
	$ns->tablerender(_WEDITGAME, $text);
	
?>