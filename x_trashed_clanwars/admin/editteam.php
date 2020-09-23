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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?EditTeam/i", $_SERVER['REQUEST_URI'])) {
	die ("Access Denied");
}

$tid = intval($_GET['tid']);

$sql->db_Select("clan_teams", "*", "tid='$tid'");
$row = $sql->db_Fetch();
	$tid = intval($row['tid']);
	$team_tag = $row['team_tag'];
	$team_name = $row['team_name'];
	$team_country = $row['team_country'];
	$banner = $row['banner'];
	$icon = $row['icon'];
	$inmembers = $row['inmembers'];
	$inwars = $row['inwars'];
	if($team_country == "") $team_country = "Unknown";
	
	?>
	<script type="text/javascript"> 
	function ChangeFlag(obj) {
		var cflag = document.getElementById("team_flag");
		cflag.src = "<?php echo e_IMAGE;?>clan/flags/"+obj.value+".png"
	}
    </script>
    
	<style type="text/css">
		#editteamtable td{
		padding: 1px;
	}
    </style>
    <?php

	$text =  "<form action='admin.php?SaveTeam' method='post' enctype='multipart/form-data'>
	<table id='editteamtable'>
		<tr>
			<td align='left'>"._WTAG.":&nbsp;</td>
			<td align='left'><input type='text' id='team_tag' name='team_tag' value='$team_tag'></td>
		</tr>
		<tr>
			<td align='left'>"._WNAME.":&nbsp;</td>
			<td align='left'><input type='text' id='team_name' name='team_name' value='$team_name'></td>
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
				$text .= "<option value='$file' ".(($team_country == $file) ? "selected" : "").">$file</option>";
			}
		
		$text .= "</select> <img src='".e_IMAGE."clan/flags/$team_country.png' id='team_flag'>
		  </td>
		</tr>";
		if($banner !="" && file_exists(e_IMAGE."clan/teams/$banner")){
		$wihei = "";
		$size = getimagesize(e_IMAGE."clan/teams/$banner");
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
				<td align='left' valign='middle'><img src='".e_IMAGE."clan/teams/$banner' border='0' $wihei align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delbanner' value='1'>"._WDEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._WUPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='teambanner'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._WBANNER.":&nbsp;</td>
				<td align='left'><input type='file' name='teambanner'></td>
			</tr>";
		}
		if($icon !="" && file_exists(e_IMAGE."clan/teams/$icon")){

		$text .= "<tr>
				<td align='left' valign='top' style='padding-top:3px;'>"._WCURRICON.":&nbsp;</td>
				<td align='left' valign='middle'><img src='".e_IMAGE."clan/teams/$icon' border='0' align='absmiddle' vspace='3'>&nbsp;&nbsp;<label><input type='checkbox' name='delicon' value='1'>"._WDEL."</label></td>
			</tr>
			<tr>	
				<td align='left'>"._WUPLNEW.":&nbsp;</td>
				<td align='left'><input type='file' name='teamicon'></td>
			</tr>";
		}else{
		$text .= "<tr>	
				<td align='left'>"._WICON.":&nbsp;</td>
				<td align='left'><input type='file' name='teamicon'></td>
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
			<td align='left' colspan='2'><br /><input type='hidden' name='tid' value='$tid'>
			<input type='hidden' name='e-token' value='".e_TOKEN."' />
			<input type='submit' class='button' name='submit' value='"._WSAVECHANGES."'></td>
		</tr>
	</table>
	</form>";
	
	$ns->tablerender(_WEDITTEAM, $text);
	
?>