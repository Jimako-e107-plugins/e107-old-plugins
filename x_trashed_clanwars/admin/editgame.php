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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?EditGame/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$gid = intval($_GET['gid']);

$sql->db_Select("clan_games", "*", "gid='$gid'");
$row = $sql->db_Fetch();
	$gid = intval($row['gid']);
	$abbr = $row['abbr'];
	$gname = $row['gname'];
	$banner = $row['banner'];
	$icon = $row['icon'];
	$inmembers = $row['inmembers'];
	$inwars = $row['inwars'];
	
	?>
    
	<style type="text/css">
		#editgametable td{
		padding: 1px;
	}
    </style>
    <?php

	$text =  "<form action='admin.php?savegame' method='post' enctype='multipart/form-data'>
	<table id='editgametable'>
		<tr>
			<td align='left'>"._ABBRV.":&nbsp;</td>
			<td align='left'><input type='text' name='abbr' value='$abbr'></td>
		</tr>
		<tr>
			<td align='left'>"._WNAME.":&nbsp;</td>
			<td align='left'><input type='text' id='gname' name='gname' value='$gname'></td>
		</tr>";
		if($banner !="" && file_exists(e_IMAGE."clan/games/$banner")){
		$wihei = "";
		$size = getimagesize(e_IMAGE."clan/games/$banner");
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
				<td align='left' valign='top' style='padding-top:3px;'>"._WCURRBANNER.":&nbsp;</td>
				<td align='left' valign='middle'><img src='".e_IMAGE."clan/games/$banner' border='0' $wihei align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delbanner' value='1'>"._WDEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._WUPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='gamebanner'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._WBANNER.":&nbsp;</td>
				<td align='left'><input type='file' name='gamebanner'></td>
			</tr>";
		}
		if($icon !="" && file_exists(e_IMAGE."clan/games/$icon")){

		$text .= "<tr>
				<td align='left' valign='top' style='padding-top:3px;'>"._WCURRICON.":&nbsp;</td>
				<td align='left' valign='middle'><img src='".e_IMAGE."clan/games/$icon' border='0' align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delicon' value='1'>"._WDEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._WUPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='gameicon'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._WICON.":&nbsp;</td>
				<td align='left'><input type='file' name='gameicon'></td>
			</tr>";
		}
		if(isset($pref['plug_installed']['clanmembers'])){
			$text .= "<tr>	
				<td align='left'>"._WINMEMBERS.":&nbsp;</td>
				<td align='left'><label><input type='radio' name='inmembers' value='1'".($inmembers?" checked":"")." />"._YES."</label>&nbsp;<label><input type='radio' name='inmembers' value='0'".($inmembers?"":" checked")." />"._NO."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._WINWARS.":&nbsp;</td>
				<td align='left'><label><input type='radio' name='inwars' value='1'".($inwars?" checked":"")." />"._YES."</label>&nbsp;<label><input type='radio' name='inwars' value='0'".($inwars?"":" checked")." />"._NO."</label></td>
			</tr>";
		}else{
			$text .= "<input type='hidden' name='inmembers' value='1' />
					<input type='hidden' name='inwars' value='1' />";
		}
		$text .= "<tr>
			<td align='left' colspan='2'><br /><input type='hidden' name='gid' value='$gid'>
			<input type='hidden' name='e-token' value='".e_TOKEN."' />
			<input type='submit' class='button' name='submit' value='"._WSAVECHANGES."'></td>
		</tr>
	</table>
	</form>";
	
	$ns->tablerender(_WEDITGAME, $text);
	
?>