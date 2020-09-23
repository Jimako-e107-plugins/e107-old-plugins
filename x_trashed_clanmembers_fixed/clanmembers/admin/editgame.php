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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$gid = intval($_GET['gid']);

$sql->select("clan_games", "*", "gid='$gid'");
$row = $sql->fetch();
	$gid = intval($row['gid']);
	$abbr = $row['abbr'];
	$gname = $row['gname'];
	$banner = $row['banner'];
	$icon = $row['icon'];
	$inmembers = $row['inmembers'];
	$inwars = $row['inwars'];
	
	?>
	<script type="text/javascript" src="includes/jquery.jcollapser.js"></script>
	<script type="text/javascript"> 
	clanm_jq(function() {
        clanm_jq("#members").jcollapser({target: '#memberslist', state: 'collapsed'});
    });
    </script>
    
	<style type="text/css">
        .collapse{
			cursor:pointer;
        }        
        .expand{
            display:none;
			cursor:pointer;
        }
 
    </style>
    <?php

	$text =  "<form action='admin_old.php?savegame' method='post' enctype='multipart/form-data'>
	<table id='editgametable' class='table adminform'>  <tbody>
		<tr>
			<td align='left'>"._ABBRV.":&nbsp;</td>
			<td align='left'><input type='text' name='abbr' value='$abbr'></td>
		</tr>
		<tr>
			<td align='left'>"._NAME.":&nbsp;</td>
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
				<td align='left' valign='top' style='padding-top:3px;'>"._CURRBANNER.":&nbsp;</td>
				<td align='left' valign='middle'><img src='".e_IMAGE."clan/games/$banner' border='0' $wihei align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delbanner' value='1'>"._DEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._UPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='gamebanner'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._BANNER.":&nbsp;</td>
				<td align='left'><input type='file' name='gamebanner'></td>
			</tr>";
		}
		if($icon !="" && file_exists(e_IMAGE."clan/games/$icon")){

		$text .= "<tr>
				<td align='left' valign='top' style='padding-top:3px;'>"._CURRICON.":&nbsp;</td>
				<td align='left' valign='middle'><img src='".e_IMAGE."clan/games/$icon' border='0' align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delicon' value='1'>"._DEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._UPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='gameicon'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._ICON.":&nbsp;</td>
				<td align='left'><input type='file' name='gameicon'></td>
			</tr>";
		}
		if(isset($pref['plug_installed']['clanwars'])){
			$text .= "<tr>	
				<td align='left'>"._INMEMBERS.":&nbsp;</td>
				<td align='left'><label><input type='radio' name='inmembers' value='1'".($inmembers?" checked":"")." />"._YES."</label>&nbsp;<label><input type='radio' name='inmembers' value='0'".($inmembers?"":" checked")." />"._NO."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._INWARS.":&nbsp;</td>
				<td align='left'><label><input type='radio' name='inwars' value='1'".($inwars?" checked":"")." />"._YES."</label>&nbsp;<label><input type='radio' name='inwars' value='0'".($inwars?"":" checked")." />"._NO."</label></td>
			</tr>";
		}else{
			$text .= "<input type='hidden' name='inmembers' value='1' />
					<input type='hidden' name='inwars' value='1' />";
		}
		$text .= "<tr>
			<td align='left' colspan='2'>
			
			<br /><br />
			
			<div id='members'>
				<div class='collapse'><b>"._EDITMEMBERS." -</b></div>
				<div class='expand'><b>"._EDITMEMBERS." +</b></div>
			</div>
			<br />				
			<div id='memberslist'>";
			$sql1 = e107::getDb();
			$sql->gen("SELECT u.user_name, i.userid FROM #clan_members_info i, #user u WHERE u.user_id=i.userid Order BY u.user_name");
				while($row = $sql->fetch()){
					$memberid = $row['userid'];
					$member = $row['user_name'];
					$match = $sql1->db_Count("clan_members_gamelink", "(*)", "WHERE userid='$memberid' and gid='$gid'");
					if($match>0){$chk="checked";}else{$chk="";}
					$text .= "<label><input name='add$memberid' value='1' type='checkbox' $chk>$member</label><br />";					
				}
			$text .= "</div></td>
		</tr>
		<tr>
			<td align='left' colspan='2'><br /><input type='hidden' name='gid' value='$gid'>
			<input type='hidden' name='e-token' value='".e_TOKEN."' />
			<input type='submit' class='button' name='submit' value='"._SAVECHANGES."'></td>
		</tr>
	</tbody></table>
	</form>";
	
	$ns->tablerender(_EDITGAME, $text);
	
?>