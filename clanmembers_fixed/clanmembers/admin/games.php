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
$games = $sql->db_Count("clan_games");

	?>
 
    <script type="text/javascript">	
	//LANG
	var games = "<?php echo $games;?>";
	var fillinname = "<?php echo _PLEASEFILLINNAME;?>";
	var suredelgame = "<?php echo _SUREDELGAME;?>";
	var errordelgame = "<?php echo _ERRORDELGAME;?>";
	</script>
	<script type="text/javascript" src="includes/jquery.tablednd.js"></script>
	<script type="text/javascript" src="includes/games.js"></script>
	<?php
	$text = "<center><form action='admin_old.php?AddGame' method='post' enctype='multipart/form-data' onSubmit='return CheckForm();'>
		<table id='addgametable' class='table adminform'><tbody>
			<tr>
				<td align='left'  >"._ABBRV.":&nbsp;</td>
				<td align='left'><input type='text' class='tbox form-control ' name='abbr' value=''></td>
			</tr>
			<tr>
				<td align='left'>"._NAME.":&nbsp;</td>
				<td align='left'><input type='text' class='tbox form-control ' id='gname' name='gname' value=''></td>
			</tr>
			<tr>	
				<td align='left'>"._BANNER.":&nbsp;</td>
				<td align='left'><input type='file' class='tbox ' name='gamebanner'></td>
			</tr>
			<tr>	
				<td align='left'>"._ICON.":&nbsp;</td>
				<td align='left'><input type='file' class='tbox ' name='gameicon'></td>
			</tr>";
			if(isset($pref['plug_installed']['clanwars'])){
				$text .= "<tr>	
					<td align='left'>"._INMEMBERS.":&nbsp;</td>
					<td align='left'><label><input type='radio' name='inmembers' value='1' checked>"._YES."</label>&nbsp;<label><input type='radio' name='inmembers' value='0'>"._NO."</label></td>
				</tr>
				<tr>	
					<td align='left'>"._INWARS.":&nbsp;</td>
					<td align='left'><label><input type='radio' name='inwars' value='1' checked>"._YES."</label>&nbsp;<label><input type='radio' name='inwars' value='0'>"._NO."</label></td>
				</tr>";
			}else{
				$text .= "<input type='hidden' name='inmembers' value='1' />
						<input type='hidden' name='inwars' value='1' />";
			}
			$text .= "<tr>
				<td align='left' colspan='2'><input class='button' type='submit' name='submit' value='"._ADDGAME."'></td>
			</tr>
		</tbody></table>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form></center>";
	$ns->tablerender(_ADDGAME, $text);
if($games>0){

	$text = "<form method='post' action='admin_old.php?assigngames' name='assigngames'>
	<div align='right'><input type='submit' class='button' value='"._ASSIGNGAMES."' title='"._CHECKGAMESTOASSIGN."' id='give1' disabled style='margin-bottom:2px;'></div>";
	$text .= "<table id='gamestable'   class='fborder table adminlist table-striped'>";	
		$text .= "<thead><tr>
					<th class='fcaption'></th>
					<th class='fcaption'><b>"._ABBR."</b></th>
					<th class='fcaption'><b>"._NAME."</b></th>
					<th class='fcaption'><b>"._BANNER."</b></th>
					<th class='fcaption'><b>"._ICON."</b></th>";
				if(isset($pref['plug_installed']['clanwars'])){
					$text .= "<th class='fcaption' nowrap><b>"._INMEMBERS."</b></th>
					<th class='fcaption' nowrap><b>"._INWARS."</b></th>";
				}
					$text .= "<th class='fcaption'><b>"._FUNCTIONS."</b></th>
				</tr> </thead>
				<tbody>";
		$sql -> select("clan_games", "*", "ORDER BY position ASC", "");
			while($row = $sql-> fetch()){
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
					<td class='forumheader3' width='10'><input type='checkbox' name='games[]' value='$gid' style='cursor:pointer;' onClick='EnableGive();'></td>
					<td class='forumheader3'>$abbr</td>
					<td class='forumheader3'>$gname</td>
					<td class='forumheader3'>$banner</td>
					<td class='forumheader3'>$icon</td>";
				if(isset($pref['plug_installed']['clanwars'])){
					$text .= "<td class='forumheader3' width='10'><img src='images/".($inmembers?"":"in")."active.png' title='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' alt='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' /></td>
					<td class='forumheader3' width='10'><img src='images/".($inwars?"":"in")."active.png' title='".($inwars?_INCWARS:_NOTINWARS)."' alt='".($inwars?_INCWARS:_NOTINWARS)."' /></td>";
				}
					$text .= "<td class='forumheader3' width='10' nowrap><input type='button' class='button' value='"._EDIT."' onclick=\"window.location='admin_old.php?editgame&gid=$gid'\">&nbsp;<input type='button' class='button' value='"._DEL."' onclick=\"DelGame('$gid');\"></td>
				</tr>";
			}
	$text .= "</tbody>
	</table>";
	$text .= "<div align='right'><input type='submit' class='button' value='"._ASSIGNGAMES."' title='"._CHECKGAMESTOASSIGN."' id='give2' disabled style='margin-top:2px;'></div>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form>";
	$text .= "<input type='hidden' name='neworder' id='neworder' value=''>";
	
	$ns->tablerender(_INFOGames, $text);
}
?>