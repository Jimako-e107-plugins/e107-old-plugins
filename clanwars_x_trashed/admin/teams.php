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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?Teams/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}
$teams = $sql->db_Count("clan_teams");

	?>
	<style type="text/css">
	.showpointer{
		border:0;
		cursor:default;
	}
	#teamstable td{
		vertical-align: middle;
		text-align:center;
	}
	#addteamtable td{
		padding: 1px;
	}
	</style>
    <script type="text/javascript">	
	//LANG
	var imgfolder = "<?php echo e_IMAGE;?>";
	var fillintag = "<?php echo _WFILLINATAG;?>";
	var fillinname = "<?php echo _WFILLINNAME;?>";
	var suredelteam = "<?php echo _WSUREDELTEAM;?>";
	var errordelteam = "<?php echo _WERRORDELTEAM;?>";
	</script>
	<script type="text/javascript" src="includes/teams.js"></script>
	<?php
	$text = "<center><form action='admin.php?AddTeam' method='post' enctype='multipart/form-data' onSubmit='return CheckForm();'>
		<table id='addteamtable'>
			<tr>
				<td align='left'>"._WTAG.":&nbsp;</td>
				<td align='left'><input type='text' id='team_tag' name='team_tag' value=''></td>
			</tr>
			<tr>
				<td align='left'>"._WNAME.":&nbsp;</td>
				<td align='left'><input type='text' id='team_name' name='team_name' value=''></td>
			</tr>
			<tr>
				<td>"._WCOUNTRY.": </td>
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
				<td align='left'>"._WBANNER.":&nbsp;</td>
				<td align='left'><input type='file' name='teambanner'></td>
			</tr>
			<tr>	
				<td align='left'>"._WICON.":&nbsp;</td>
				<td align='left'><input type='file' name='teamicon'></td>
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
				<td align='left' colspan='2'><input class='button' type='submit' name='submit' value='"._WADDTEAM."'></td>
			</tr>
		</table>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form></center>";
	$ns->tablerender(_WADDTEAM, $text);
if($teams>0){

	$text = "<form method='post' action='admin.php?assignteams' name='assignteams'>";
		$text .= "<table id='teamstable' style='".ADMIN_WIDTH."' class='fborder'>";	
		$text .= "<tr>
					<td class='fcaption'><b>"._WCOUNTRY."</b></td>
					<td class='fcaption'><b>"._WTAG."</b></td>
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
		$sql -> db_Select("clan_teams", "*", "ORDER BY ".(isset($pref['plug_installed']['clanmembers'])?"position":"team_name")." ASC", "");
			while($row = $sql-> db_Fetch()){
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
					<td class='forumheader3'><img src='".e_IMAGE."clan/flags/$team_country.png' alt='$team_country' title='$team_country' /></td>
					<td class='forumheader3'>$team_tag</td>
					<td class='forumheader3'>$team_name</td>
					<td class='forumheader3'>$banner</td>
					<td class='forumheader3'>$icon</td>";
				if(isset($pref['plug_installed']['clanmembers'])){
					$text .= "<td class='forumheader3' width='10'><img src='images/".($inmembers?"":"in")."active.png' title='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' alt='".($inmembers?_INCMEMBERS:_NOTINMEMBERS)."' /></td>
					<td class='forumheader3' width='10'><img src='images/".($inwars?"":"in")."active.png' title='".($inwars?_INCWARS:_NOTINWARS)."' alt='".($inwars?_INCWARS:_NOTINWARS)."' /></td>";
				}
					$text .= "<td class='forumheader3' width='10' nowrap><input type='button' class='button' value='"._WEDIT."' onclick=\"window.location='admin.php?EditTeam&tid=$tid'\">&nbsp;<input type='button' class='button' value='"._WDEL."' onclick=\"DelTeam('$tid');\"></td>
				</tr>";
			}
	$text .= "</tbody>
	</table>";
	$text .= "<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form>";
	$text .= "<input type='hidden' name='neworder' id='neworder' value=''>";
	
	$ns->tablerender(_WTEAMS, $text);
}
?>