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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?Games/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}
$games = $sql->db_Count("clan_games");

	?>
	<style type="text/css">
	.showpointer{
		border:0;
		cursor:default;
	}
	#gamestable td{
		vertical-align: middle;
		text-align:center;
	}
	#addgametable td{
		padding: 1px;
	}
	</style>
    <script type="text/javascript">	
	//LANG
	var fillinname = "<?php echo _WFILLINNAME;?>";
	var suredelgame = "<?php echo _WSUREDELGAME;?>";
	var errordelgame = "<?php echo _WERRORDELGAME;?>";
	</script>
	<script type="text/javascript" src="includes/games.js"></script>
	<?php
	$text = "<center><form action='admin.php?AddGame' method='post' enctype='multipart/form-data' onSubmit='return CheckForm();'>
		<table id='addgametable'>
			<tr>
				<td align='left'>"._ABBRV.":&nbsp;</td>
				<td align='left'><input type='text' name='abbr' value=''></td>
			</tr>
			<tr>
				<td align='left'>"._WNAME.":&nbsp;</td>
				<td align='left'><input type='text' id='gname' name='gname' value=''></td>
			</tr>
			<tr>	
				<td align='left'>"._WBANNER.":&nbsp;</td>
				<td align='left'><input type='file' name='gamebanner'></td>
			</tr>
			<tr>	
				<td align='left'>"._WICON.":&nbsp;</td>
				<td align='left'><input type='file' name='gameicon'></td>
			</tr>";
			if(isset($pref['plug_installed']['clanmembers'])){
				$text .= "<tr>	
					<td align='left'>"._WINMEMBERS.":&nbsp;</td>
					<td align='left'><label><input type='radio' name='inmembers' value='1' checked>"._YES."</label>&nbsp;<label><input type='radio' name='inmembers' value='0'>"._NO."</label></td>
				</tr>
				<tr>	
					<td align='left'>"._WINWARS.":&nbsp;</td>
					<td align='left'><label><input type='radio' name='inwars' value='1' checked>"._YES."</label>&nbsp;<label><input type='radio' name='inwars' value='0'>"._NO."</label></td>
				</tr>";
			}else{
				$text .= "<input type='hidden' name='inmembers' value='1' />
						<input type='hidden' name='inwars' value='1' />";
			}
			$text .= "<tr>
				<td align='left' colspan='2'><input class='button' type='submit' name='submit' value='"._WADDGAME."'></td>
			</tr>
		</table>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form></center>";
	$ns->tablerender(_WADDGAME, $text);
if($games>0){

	$text = "<table id='gamestable' style='".ADMIN_WIDTH."' class='fborder'>";	
		$text .= "<tr>
					<td class='fcaption'><b>"._ABBR."</b></td>
					<td class='fcaption'><b>"._WNAME."</b></td>
					<td class='fcaption'><b>"._WBANNER."</b></td>
					<td class='fcaption'><b>"._WICON."</b></td>";
				if(isset($pref['plug_installed']['clanmembers'])){
					$text .= "<td class='fcaption' nowrap><b>"._WINMEMBERS."</b></td>
					<td class='fcaption' nowrap><b>"._WINWARS."</b></td>";
				}
					$text .= "<td class='fcaption'><b>"._FUNCTIONS."</b></td>
				</tr>
				<tbody>";
		$sql -> db_Select("clan_games", "*", "ORDER BY ".(isset($pref['plug_installed']['clanmembers'])?"position":"gname")." ASC", "");
			while($row = $sql-> db_Fetch()){
				$gid = $row['gid'];
				$abbr = $row['abbr'];
				$gname = $row['gname'];
				$banner = $row['banner'];
				$icon = $row['icon'];
				$inmembers = $row['inmembers'];
				$inwars = $row['inwars'];

				if(file_exists(e_IMAGE."clan/games/$banner") && $banner !=""){
					$size = getimagesize(e_IMAGE."clan/games/$banner");
					$banner = "<img src='".e_IMAGE."clan/games/$banner' class='showpointer' ".($size[0] > 200?"width='200'":"")." />";
				}else{
					$banner = "";
				}
				if(file_exists(e_IMAGE."clan/games/$icon") && $icon !=""){
					$icon = "<img src='".e_IMAGE."clan/games/$icon' class='showpointer' />";
				}else{
					$icon = "";
				}

			$text .= "<tr id='$gid'>
					<td class='forumheader3'>$abbr</td>
					<td class='forumheader3'>$gname</td>
					<td class='forumheader3'>$banner</td>
					<td class='forumheader3'>$icon</td>";
				if(isset($pref['plug_installed']['clanmembers'])){
					$text .= "<td class='forumheader3' width='10'><img src='images/".($inmembers?"":"in")."active.png' title='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' alt='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' /></td>
					<td class='forumheader3' width='10'><img src='images/".($inwars?"":"in")."active.png' title='".($inwars?_INCWARS:_NOTINWARS)."' alt='".($inwars?_INCWARS:_NOTINWARS)."' /></td>";
				}
					$text .= "<td class='forumheader3' width='10' nowrap><input type='button' class='button' value='"._WEDIT."' onclick=\"window.location='admin.php?EditGame&gid=$gid'\">&nbsp;<input type='button' class='button' value='"._WDEL."' onclick=\"DelGame('$gid');\"><br /><input type='button' class='button' value='"._MANMAPS."' onclick=\"window.location='admin.php?ManageMaps&gid=$gid'\" style='margin-top:3px;width:100%;' /></td>
				</tr>";
			}
	$text .= "</tbody>
	</table>";
	$text .= "<input type='hidden' name='neworder' id='neworder' value=''>";
	
	$ns->tablerender(_WGAMES, $text);
}
?>