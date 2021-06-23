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
$teams = $sql->db_Count("clan_teams");

	?>
    <script type="text/javascript">	
	//LANG
	var teams = "<?php echo $teams;?>";
	var imgfolder = "<?php echo e_IMAGE;?>";
	var fillintag = "<?php echo _PLEASEFILLINTAG;?>";
	var fillinname = "<?php echo _PLEASEFILLINNAME;?>";
	var suredelteam = "<?php echo _SUREDELTEAM;?>";
	var errordelteam = "<?php echo _ERRORDELTEAM;?>";
	</script>
	<script type="text/javascript" src="includes/jquery.tablednd.js"></script>
	<script type="text/javascript" src="includes/teams.js"></script>
	<?php
	$text = "<center><form action='admin_old.php?AddTeam' method='post' enctype='multipart/form-data' onSubmit='return CheckForm();'>
		<table id='addteamtable' class='table adminform'><tbody>
			<tr>
				<td align='left'>"._TAG.":&nbsp;</td>
				<td align='left'><input type='text' id='team_tag' name='team_tag' value=''></td>
			</tr>
			<tr>
				<td align='left'>"._NAME.":&nbsp;</td>
				<td align='left'><input type='text' id='team_name' name='team_name' value=''></td>
			</tr>
			<tr>
				<td>"._INFOCountry.": </td>
				<td>	
				<select name='team_country' onChange='ChangeFlag(this);' id='team_country'>";
			
				$files = array();	
				$TrackDir=opendir(e_IMAGE."clan/flags");
					while ($file = readdir($TrackDir)) {  
						  if ($file == "." || $file == ".." || $file == "Thumbs.db") { 
						  }else{
							  $file = explode(".",$file);
							  if(in_array(strtolower($file[1]),array("gif","jpg","png")))
							  $files[] = $file[0];
						  } 
					 }  
				closedir($TrackDir);
				sort($files);
			
				foreach($files as $file){
					$text .= "<option value='$file' ".(("Unknown" == $file) ? "selected" : "").">$file</option>";
				}
			
			$text .= "</select> <img src='".e_IMAGE."clan/flags/Unknown.png' id='team_flag'>
			  </td>
			</tr>
			<tr>	
				<td align='left'>"._BANNER.":&nbsp;</td>
				<td align='left'><input type='file' name='teambanner'></td>
			</tr>
			<tr>	
				<td align='left'>"._ICON.":&nbsp;</td>
				<td align='left'><input type='file' name='teamicon'></td>
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
				<td align='left' colspan='2'><input class='button' type='submit' name='submit' value='"._ADDTEAM."'></td>
			</tr>
		</tbody></table>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form></center>";
	$ns->tablerender(_ADDTEAM, $text);
if($teams>0){

	$text = "<form method='post' action='admin_old.php?assignteams' name='assignteams'>
	<div align='right'><input type='submit' class='button' value='"._ASSIGNTEAMS."' title='"._CHECKTEAMSTOASSIGN."' id='give1' disabled style='margin-bottom:2px;'></div>";
	$text .= "<table id='teamstable' class='fborder table adminlist table-striped'>";	
		$text .= "<thead><tr>
					<th class='fcaption'></th>
					<th class='fcaption'><b>"._INFOCountry."</b></th>
					<th class='fcaption'><b>"._TAG."</b></th>
					<th class='fcaption'><b>"._NAME."</b></th>
					<th class='fcaption'><b>"._BANNER."</b></th>
					<th class='fcaption'><b>"._ICON."</b></th>";
				if(isset($pref['plug_installed']['clanwars'])){
					$text .= "<td class='fcaption' nowrap><b>"._INMEMBERS."</b></th>
					<th class='fcaption' nowrap><b>"._INWARS."</b></th>";
				}
					$text .= "<th class='fcaption'><b>"._FUNCTIONS."</b></th>
				</tr> </thead>
				<tbody>";
		$sql -> select("clan_teams", "*", "ORDER BY position ASC", "");
			while($row = $sql-> fetch()){
				$tid = $row['tid'];
				$team_tag = $row['team_tag'];
				$team_name = $row['team_name'];
				$team_country = $row['team_country'];
				$banner = $row['banner'];
				$icon = $row['icon'];
				$inmembers = $row['inmembers'];
				$inwars = $row['inwars'];

				if(file_exists(e_IMAGE."clan/teams/$banner") && $banner !=""){
					$size = getimagesize(e_IMAGE."clan/teams/$banner");
					$banner = "<img src='".e_IMAGE."clan/teams/$banner' class='showpointer' ".($size[0] > 200?"width='200'":"")." />";
				}else{
					$banner = "";
				}
				if(file_exists(e_IMAGE."clan/teams/$icon") && $icon !=""){
					$icon = "<img src='".e_IMAGE."clan/teams/$icon' class='showpointer' />";
				}else{
					$icon = "";
				}

			$text .= "<tr id='$tid'>
					<td class='forumheader3' width='10'><input type='checkbox' name='teams[]' value='$tid' style='cursor:pointer;' onClick='EnableGive();'></td>
					<td class='forumheader3'><img src='".e_IMAGE."clan/flags/$team_country.png' alt='$team_country' title='$team_country' /></td>
					<td class='forumheader3'>$team_tag</td>
					<td class='forumheader3'>$team_name</td>
					<td class='forumheader3'>$banner</td>
					<td class='forumheader3'>$icon</td>";
				if(isset($pref['plug_installed']['clanwars'])){
					$text .= "<td class='forumheader3' width='10'><img src='images/".($inmembers?"":"in")."active.png' title='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' alt='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' /></td>
					<td class='forumheader3' width='10'><img src='images/".($inwars?"":"in")."active.png' title='".($inwars?_INCWARS:_NOTINWARS)."' alt='".($inwars?_INCWARS:_NOTINWARS)."' /></td>";
				}
					$text .= "<td class='forumheader3' width='10' nowrap><input type='button' class='button' value='"._EDIT."' onclick=\"window.location='admin_old.php?EditTeam&tid=$tid'\">&nbsp;<input type='button' class='button' value='"._DEL."' onclick=\"DelTeam('$tid');\"></td>
				</tr>";
			}
	$text .= "</tbody>
	</table>";
	$text .= "<div align='right'><input type='submit' class='button' value='"._ASSIGNTEAMS."' title='"._CHECKTEAMSTOASSIGN."' id='give2' disabled style='margin-top:2px;'></div>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form>";
	$text .= "<input type='hidden' name='neworder' id='neworder' value=''>";
	
	$ns->tablerender(_INFOTeams, $text);
}
?>