<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?EditWar/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);
$new = intval($_GET['new']);

$sql->db_Select("clan_wars", "*", "wid='$wid'");
$row = $sql->db_Fetch();
	$wid = $row['wid'];
	$status = $row['status'];
	$game = $row['game'];
	$wardate = $row['wardate'];
	$team = $row['team'];
	$opp_tag = $row['opp_tag'];
	$opp_name = $row['opp_name'];
	$opp_url = $row['opp_url'];
	$opp_country = $row['opp_country'];
	$style = $row['style'];
	$players = $row['players'];
	$our_score = $row['our_score'];
	$opp_score = $row['opp_score'];
	$serverip = $row['serverip'];
	$serverpass = $row['serverpass'];
	$wreport = $row['report'];
	$report_url = $row['report_url'];
	$wholineup = $row['wholineup'];
	
	if(intval($game) == 0){
		$sql->db_Select("clan_games", "*", "inwars='1' ORDER BY gname");
		$rowg = $sql->db_Fetch();
		$game = $rowg['gid'];
	}
?>
<link rel="stylesheet" href="includes/editwar.css" />
<link rel="stylesheet" href="includes/jquery.autocomplete.css" />
<link rel="stylesheet" href="includes/jquery.fancybox.css" type="text/css" media="screen">
<script type="text/javascript" src="includes/jquery.min.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
<script type="text/javascript" src="includes/jquery.jcollapser.js"></script>
<script type="text/javascript" src="includes/date.js"></script>
<script type="text/javascript" src="includes/jquery.datePicker.js"></script>
<script type="text/javascript" src="includes/jquery.autocomplete.js"></script>
<script type="text/javascript">
var wars_jq = jQuery;
wars_jq(function() {
	wars_jq("#servertitle").jcollapser({target: '#servercontent', state: '<?php echo (($conf['stateserver'])?"expanded":"collapsed"); ?>'});
	wars_jq("#reporttitle").jcollapser({target: '#reportcontent', state: '<?php echo (($conf['statereport'])?"expanded":"collapsed"); ?>'});
	wars_jq("#mapstitle").jcollapser({target: '#mapscontent', state: '<?php echo (($conf['statemaps'])?"expanded":"collapsed"); ?>'});
	wars_jq("#screenstitle").jcollapser({target: '#screenscontent', state: '<?php echo (($conf['statescreens'])?"expanded":"collapsed"); ?>'});
	<?php if($conf['enablelineup']){?>
	wars_jq("#lineuptitle").jcollapser({target: '#lineupcontent', state: '<?php echo (($conf['statelineup'])?"expanded":"collapsed"); ?>'});
	<?php } 
	if($conf['enablecomments'] && !$new){?>
	wars_jq("#commentstitle").jcollapser({target: '#commentsdiv', state: '<?php echo (($conf['statecomments'])?"expanded":"collapsed"); ?>'});
	<?php } ?>	
});

var wid = "<?php echo $wid;?>";
var gid = "<?php echo $game;?>";
var scorepermap = "<?php echo $conf['scorepermap'];?>";
var mapmustmatch = <?php echo ($conf['mapmustmatch']?"true":"false");?>;
var imgfolder = "<?php echo e_IMAGE;?>";
//LANG
var edittext = "<?php echo _WEDIT;?>";
var deltext = "<?php echo _WDEL;?>";
var savetext = "<?php echo _WSAVE;?>";
var canceltext = "<?php echo _WCANCEL;?>";
var alrindbaddsame1 = "<?php echo _WALRINDBADDSAME1;?>";
var alrindbaddsame2 = "<?php echo _WALRINDBADDSAME2;?>";
var stag = "<?php echo _WSTAG;?>";
var sname = "<?php echo _WSNAME;?>";
var errorgetinfo = "<?php echo _WERRORGETINFO;?>";
var fillinmapname = "<?php echo _WFILLINMAPNAME;?>";
var erroraddmap = "<?php echo _WERRORADDMAP;?>";
var suredelmap = "<?php echo _WSUREDELMAP;?>";
var errordelmap = "<?php echo _WERRORDELMAP;?>";
var errorupdmap = "<?php echo _WERRORUPDMAP;?>";
var fillinname = "<?php echo _WFILLINNAME;?>";
var alrinlu = "<?php echo _WALRINLU;?>";
var erroraddpl = "<?php echo _WERRORADDPL;?>";
var suredelpl = "<?php echo _WSUREDELPL;?>";
var errordelpl = "<?php echo _WERRORDELPL;?>";
var suredelscr = "<?php echo _WSUREDELSCR;?>";
var errordelscr = "<?php echo _WERRORDELSCR;?>";
var suredelcomm = "<?php echo _WSUREDELCOMM;?>";
var errordelcomm = "<?php echo _WERRORDELCOMM;?>";
var suredelallcomms = "<?php echo _WSUREDELALLCOMMS;?>";
var nocommsonwar = "<?php echo _WNOCOMMSONWARR;?>";
var errordelcomms = "<?php echo _WERRORDELCOMMS;?>";
var writecomm = "<?php echo _WWRITECOMM;?>";
var errorsavecomm = "<?php echo _WERRORSAVECOMM;?>";
//END LANG
Date.format = '<?php echo $conf['dateformat'];?>';
wars_jq(function(){
	wars_jq('.date-pick').datePicker({startDate:'<?php echo str_replace(array("dd","mm","yyyy"),array("01","01","1970"),$conf['dateformat']);?>',clickInput:true});
});
</script>

<script type="text/javascript" src="includes/admineditwar.js"></script>

<?php
$thedate = "";
if($wardate != -1){
	$thedate = str_replace(array("dd","mm","yyyy"),array(date("d",$wardate),date("m",$wardate),date("Y",$wardate)),$conf['dateformat']);
}

$title = (($new) ? _WADDWAR : _WEDITWAR);
$text = "<form method='post' action='admin.php?SaveWar'>
<table id='editwartable' width='426'>";

$text .= "<tr>
    <td colspan='2'><font class='warstitle'>"._WGENERAL."</font></td>
  </tr> 
  <tr>
    <td>"._WSTATUS.": </td>
    <td>
       <select name='status' onchange='ChangeStatus(this);' id='warstatus'>";
          if($status == 0){
		  	$text .= "<option value='0' selected>"._WNEXTMATCH."</option>";
		  	$text .= "<option value='1'>"._WFINISHED."</option>";
		  }else{
          	$text .= "<option value='0'>"._WNEXTMATCH."</option>";
		  	$text .= "<option value='1' selected>"._WFINISHED."</option>";
		  }
       $text .= "</select>
    </td>
  </tr>";

	$result = $sql->db_Select("clan_teams", "*", "inwars='1' ORDER BY team_name");
	if($sql->db_Rows() > 0){
	$text .= "<tr>
		<td>"._WTEAM.": </td>
		<td>
			<select name='team'>";	
			while($rowt = $sql->db_Fetch()){
				$tid = $rowt['tid'];
				$team_tag = $rowt['team_tag'];
				$text .= "<option value='$tid' ".(($tid == $team) ? "selected" : "").">$team_tag</option>";
			}
			$text .= "</select></td></tr>";  
	}else{
		$text .= "<input type='hidden' name='team' value='1' />";
	} 
  $text .= "<tr>
    <td>"._WGAME.": </td>
    <td><select name='game' onchange='ChangeGame(this);'>";
		$sql->db_Select("clan_games", "*", "inwars='1' ORDER BY gname");
			while ($rowg = $sql->db_Fetch()){
				$gid = $rowg['gid'];
				$gname = $rowg['gname'];			
				$text .= "<option value='$gid' ".(($gid == $game) ? "selected" : "").">$gname</option>\n";
			} 
        $text .= "</select>
    </td>
  </tr>
  <tr>
    <td>"._WDATE.": </td>
    <td> 
	<input type='text' name='wardate' id='wardate' value='$thedate' class='date-pick'>
	</td>
  </tr>
  <tr>
    <td>"._WTIME.":  </td>
    <td><input type='text' name='wartime' value='".(($wardate != -1) ? date("H:i",$wardate) : "00:00")."' size='6' maxlength='5'></td>
  </tr>
  <tr>
    <td colspan='2'><br><font class='warstitle'>"._WOPP."</font></td>
  </tr>
  <tr>
    <td>"._WTAG.": </td>
    <td><input type='text' name='opp_tag' value='$opp_tag' size='20' maxlength='60' id='opp_tag'></td>
  </tr>
  <tr>
    <td>"._WNAME.": </td>
    <td><input type='text' name='opp_name' value='$opp_name' size='30' maxlength='60' id='opp_name'></td>
  </tr>
    <tr>
    <td>"._WURL.": </td>
    <td><input type='text' name='opp_url' value='$opp_url' size='30' maxlength='100' id='opp_url'></td>
  </tr>
    <tr>
    <td>"._WCOUNTRY.": </td>
    <td>	
	<select name='opp_country' onChange='ChangeFlag(this);' id='opp_country'>";

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
		$text .= "<option value='$file' ".(($opp_country == $file) ? "selected" : "").">$file</option>";
	}

$text .= "</select> <img src='".e_IMAGE."clan/flags/$opp_country.png' id='opp_flag'>
  </td>
  </tr>
   <tr>
    <td colspan='2'><br><font class='warstitle'>"._WMATCH."</font></td>
  </tr>
  <tr> 
    <td width='40%'>"._WSTYLE.": </td>
    <td><input type='text' name='style' value='$style' size='20' maxlength='60' id='style'></td>
  </tr>
    <tr> 
    <td>"._WPLAYERS.": </td>
    <td><input type='text' name='players' value='$players' size='4' maxlength='2'></td>
  </tr>
	<tr>
    <td>"._WOURSCORE.": </td>
    <td><input type='text' name='our_score' value='$our_score' size='4' maxlength='4' /></td>
  </tr>
  <tr>
    <td nowrap>"._WOPPSCORE.": </td>
    <td><input type='text' name='opp_score' value='$opp_score' size='4' maxlength='4' /></td>
  </tr>
  <tr>
    <td colspan='2'><br><div id='servertitle'><div class='collapse'><font class='warstitle'>"._WSERVER." <img src='images/ArrowUp".$conf['arrowcolor'].".png' border='0'></font></div><div class='expand'><font class='warstitle'>"._WSERVER." <img src='images/ArrowDown".$conf['arrowcolor'].".png' border='0'></font></div></div></td>
  </tr>
</table>
<div id='servercontent'>
<table border='0' cellspacing='0' cellpadding='1' width='426'>
  <tr>
    <td width='40%'>"._WSERVERIP.": </td>
    <td><input type='text' name='serverip' value='$serverip' size='20' maxlength='25' /></td>
  </tr>
  <tr>
    <td>"._WSERVERPASS.": </td>
    <td><input type='text' name='serverpass' value='$serverpass' size='20' maxlength='25' /></td>
  </tr>
</table>
</div>
<table border='0' cellspacing='0' cellpadding='1' width='426'>
  <tr>
    <td colspan='2'><br><div id='reporttitle'><div class='collapse'><font class='warstitle'>"._WREPORT." <img src='images/ArrowUp".$conf['arrowcolor'].".png' border='0'></font></div><div class='expand'><font class='warstitle'>"._WREPORT." <img src='images/ArrowDown".$conf['arrowcolor'].".png' border='0'></font></div></div></td>
  </tr> 
</table>
<div id='reportcontent'>
<table border='0' cellspacing='0' cellpadding='1' width='426'>
  <tr>
    <td colspan='2' style='padding-right:9px;'>
      <textarea name='wreport' style='width:100%;' rows='6'>$wreport</textarea></td>
  </tr>
  <tr>
    <td width='40%'>"._WURLOFFREPORT.": </td>
    <td style='padding-right:9px;'><input type='text' name='report_url' value='$report_url' style='width:100%;' maxlength='100' /></td>
  </tr>
  </table>
  </div>
  <table border='0' cellspacing='0' cellpadding='1' width='426'>";
 
  $mapwidth = array();
	if($conf['scorepermap']){
		$mapwidth[0] = 126;
		$mapwidth[1] = $mapwidth[0] - 10;
		$mapwidth[2] = 74;
		$mapwidth[3] = $mapwidth[2] - 10;
		
	}else{
		$mapwidth[0] = 180;
		$mapwidth[1] = $mapwidth[0] - 10;
		$mapwidth[2] = 110;
		$mapwidth[3] = $mapwidth[2] - 10;
	}  
  
$text .= "<tr>
    <td colspan='2'><br><div id='mapstitle'><div class='collapse'><font class='warstitle'>"._WMAPSSS." <img src='images/ArrowUp".$conf['arrowcolor'].".png' border='0'></font></div><div class='expand'><font class='warstitle'>"._WMAPSSS." <img src='images/ArrowDown".$conf['arrowcolor'].".png' border='0'></font></div></div></td>
  </tr>
  <tr>
    <td colspan='2'>
	<div id='mapscontent'>
	<div class='nowrap'>
		<table border='0' cellspacing='0' cellpadding='2'>
			<tr>
				<td width='".$mapwidth[0]."'><b>"._WMAPNAME."</b></td>
				<td width='".$mapwidth[2]."'><b>"._WGAMETYPE."</b></td>";
			if($conf['scorepermap'])
			$text .= "<td width='98' style='text-align:center;'><b>"._SCORE."</b></td>";
			$text .= "<td width='118'>&nbsp;</td>
			</tr>
		</table>
	</div>
	<div id='mapsdiv'>";
	$sql1 = new db;
	$sql->db_Select("clan_wars_maplink", "*", "wid='$wid' ORDER BY lid ASC");
		while ($row = $sql->db_Fetch()) {
			$lid = intval($row['lid']);
			$mapname = $row['mapname'];
			$gametype = $row['gametype'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
			if(intval($mapname) > 0){
				$sql1->db_Select("clan_wars_maps", "name", "mid='$mapname'");
				$row2 = $sql1->db_Fetch();
				$mapname = $row2['name'];
			}

			$text .= "<div class='mainwrap forumheader3' id='map$lid'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='".$mapwidth[0]."' id='mapnametext$lid'>&nbsp;$mapname</td>
							<td width='".$mapwidth[2]."' id='gametypetext$lid'>&nbsp;$gametype</td>";
						if($conf['scorepermap']){
						$text .= "<td width='36' style='text-align:right;' id='our_scoretext$lid'>$our_score</td>
							<td width='6' style='text-align:center;'>/</td>
							<td width='36' align='left' id='opp_scoretext$lid'>$opp_score</td>";
						}
						$text .= "<td width='118' style='text-align:right;' nowrap><input type='button' class='iconpointer button' value='"._WEDIT."' onclick='EditMap($lid);'>&nbsp;<input type='button' class='iconpointer button' value='"._WDEL."' onclick='DelMap($lid);'></td>
						</tr>
					</table>
				</div>
				<div class='mainwrap forumheader3' id='editmap$lid' style='display:none;'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='".$mapwidth[0]."'><input type='text' id='mapname$lid' value='$mapname' style='width:".$mapwidth[1]."px;margin:0'></td>
							<td width='".$mapwidth[2]."'><input type='text' id='gametype$lid' value='$gametype' style='width:".$mapwidth[3]."px;margin:0'></td>";
						if($conf['scorepermap']){
						$text .= "<td width='36' style='text-align:right;'><input class='bginput' type='text' id='our_score$lid' value='$our_score' style='width:30px;margin:0'></td>
							<td width='6' style='text-align:center;'>/</td>
							<td width='36'><input class='bginput' type='text' id='opp_score$lid' value='$opp_score' style='width:30px;margin:0'></td>";
						}
						$text .= "<td width='118' style='text-align:right;' nowrap><input type='button' class='iconpointer button' value='"._WSAVE."' onclick='SaveMap($lid);'>&nbsp;<input type='button' class='iconpointer button' value='"._WCANCEL."' onclick='CancelMap($lid);'></td>
						</tr>
					</table>
				</div>";
		}
		$text .= "</div>
			<div class='nowrap'>
				<table border='0' cellspacing='0' cellpadding='2'>
					<tr>
						<td width='".$mapwidth[0]."' align='left'><input class='bginput' type='text' id='mapname' style='width:".$mapwidth[1]."px;margin:0'></td>
						<td width='".$mapwidth[2]."' align='left'><input class='bginput' type='text' id='gametype' style='width:".$mapwidth[3]."px;margin:0'></td>";
					if($conf['scorepermap']){
					$text .= "<td width='36' align='left'><input class='bginput' type='text' id='ourscore' style='width:30px;margin:0'></td>
						<td width='6' align='left'>/</td>
						<td width='36' align='left'><input class='bginput' type='text' id='oppscore' style='width:30px;margin:0'></td>";
					}
					$text .= "<td width='118' align='right' nowrap><input type='button' class='button' value='"._WADDMAP."' onclick='AddMap();'></td>
					</tr>
				</table>
			</div>
		</div>
	</td>
  </tr>";

//LINEUP
if($conf['enablelineup']){  
  $text .= "<tr>
    <td colspan='2'><br><div id='lineuptitle'><div class='collapse'><font class='warstitle'>"._WLINEUP." <img src='images/ArrowUp".$conf['arrowcolor'].".png' border='0'></font></div><div class='expand'><font class='warstitle'>"._WLINEUP." <img src='images/ArrowDown".$conf['arrowcolor'].".png' border='0'></font></div></div></td>
  </tr>
  <tr>
    <td colspan='2'>
	<div id='lineupcontent'>
	
	<div style='width:426px;display:".(($status) ? "block" : "none").";'>
	<table id='lineuptable' width='426'>
		<tr>
			<td id='lineupdiv2'>";
	//Finished
	$members = array();
	$result = $sql->db_Select("clan_wars_lineup", "*", "wid='$wid' AND available in (1,2) ORDER BY member ASC");
		while ($row = $sql->db_Fetch()) {
			$members['member'][] =(intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
			$members['pid'][] =intval($row['pid']);
		}
		array_multisort($members['member'], $members['pid']);
		for($i=0;$i<count($members['member']);$i++){
			$pid = $members['pid'][$i];
			$text .= "<span id='playerfin$pid' class='smallwrap forumheader3'><table cellpadding='2' cellspacing='0' border='0' width='100%'><tr>
					<td>&nbsp;".$members['member'][$i]."</td>
					<td style='text-align:right;'><input type='button' class='iconpointer button' value='"._WDEL."' onclick='DelPlayer($pid,2);'></td>
					</tr></table></span>";
		}
		$text .= "</td>
			</tr>
			<tr>
				<td>
					<div class='nowrap'>";
					$text .= "<div class='playerwrap' style='width:200px;'><input type='text' id='playername2' style='width:140px;' onKeyPress='return submitenter(2,event)'>&nbsp;<input type='button' class='iconpointer button' value='Add' onclick='AddPlayer(2);'></div>
				</div>
				</td>
			</tr>
		</table>
	</div>
				
	<div id='lineupupcdiv' style='display:".(($status) ? "none" : "block")."'>";
	if($conf['tablename'] == "clan_members_info" && $conf['fieldname'] == "userid"){
	$text .= "&nbsp;"._WHOCANLU." <select name='wholineup'>
		<option value='0'".($wholineup == 0?" selected":"").">"._WCLANMEM."</option>
		<option value='1'".($wholineup == 1?" selected":"").">"._WTEAMMEM."</option>
		<option value='2'".($wholineup == 2?" selected":"").">"._WGAMEMEM."</option>
	</select>";
	}
	$text .= "<table width='426'>
		<tr>
			<td width='213'><div class='nowrap' style='width:100%;'><b>"._WAVAIL."</b></div></td>
			<td width='213'><div class='nowrap' style='width:100%;'><b>"._WNOTAVAIL."</b></div></td>
		</tr>
		<tr>
			<td id='lineupdiv1' valign='top' style='padding:0;'>";
	//Upcomming
	$members = array();
	$result = $sql->db_Select("clan_wars_lineup", "*", "wid='$wid' AND available in (1,2) ORDER BY member ASC");
		while ($row = $sql->db_Fetch()) {
			$members['member'][] =(intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
			$members['pid'][] =intval($row['pid']);
		}
		array_multisort($members['member'], $members['pid']);
		for($i=0;$i<count($members['member']);$i++){
			$pid = $members['pid'][$i];
			$text .= "<span class='smallwrap forumheader3' id='playerupc$pid'>
					<table width='100%'><tr>
					<td>&nbsp;".$members['member'][$i]."</td>
					<td style='text-align:right;'><input type='button' class='iconpointer button' value='"._WDEL."' onclick='DelPlayer($pid,1);'></td>
					</tr></table>
				</span>";
		}
		$text .= "</td>
		<td id='lineupdiv0' valign='top'>";
	
	$members = array();
	$result = $sql->db_Select("clan_wars_lineup", "*", "wid='$wid' AND available='0' ORDER BY member ASC");
		while ($row = $sql->db_Fetch()) {
			$members['member'][] =(intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
			$members['pid'][] =intval($row['pid']);
		}
		array_multisort($members['member'], $members['pid']);
		for($i=0;$i<count($members['member']);$i++){
			$pid = $members['pid'][$i];
			$text .= "<span class='smallwrap forumheader3' id='playerupc$pid'>
					<table width='100%'><tr>
					<td>&nbsp;".$members['member'][$i]."</td>
					<td style='text-align:right;'><input type='button' class='iconpointer button' value='"._WDEL."' onclick='DelPlayer($pid,0);'></td>
					</tr></table>
				</span>";
		}
		$text .= "</td>
			</tr>
			<tr>
				<td><div class='nowrap' style='width:100%;'><input type='text' id='playername1' style='width:140px;' onKeyPress='return submitenter(1,event)'>&nbsp;<input type='button' class='iconpointer button' value='Add' onclick='AddPlayer(1);'></div></td>
				<td><div class='nowrap' style='width:100%;'><input type='text' id='playername0' style='width:140px;' onKeyPress='return submitenter(0,event)'>&nbsp;<input type='button' class='iconpointer button' value='Add' onclick='AddPlayer(0);'></div></td>
			</tr>
		</table>
	</td>
  </tr>";
}
  
  //SCREENS
$text .= "<tr>
    <td colspan='2'><br><div id='screenstitle'><div class='collapse'><font class='warstitle'>"._WSCRSHOTS." <img src='images/ArrowUp".$conf['arrowcolor'].".png' border='0'></font></div><div class='expand'><font class='warstitle'>"._WSCRSHOTS." <img src='images/ArrowDown".$conf['arrowcolor'].".png' border='0'></font></div></div></td>
  </tr>
  <tr>
    <td colspan='2'>
	<div id='screenscontent'>
	<div class='titlewrap'><b>"._WFILELOC."</b></div>
			<div id='screensdiv'>";
	$result = $sql->db_Select("clan_wars_screens", "*", "wid='$wid' ORDER BY sid ASC");
		while ($row = $sql->db_Fetch()) {
			$sid = intval($row['sid']);
			$url = $row['url'];

			$text .= "<div class='mainwrap forumheader3' id='screen$sid'>
					<table cellpadding='2' cellspacing='0' border='0' width='100%'><tr>
					<td>&nbsp;<a href='images/Screens/$url' class='screens' rel='screens'>$url</a></td>
					<td style='text-align:right;'><input type='button' class='iconpointer button' value='"._WDEL."' onclick='DelScreen($sid);'></td>
					</tr></table>
				</div>";
		}
		$text .= "</div>
			<iframe name='screens' id='screens' src='admin.php?Screens&wid=$wid' width='400' height='40' frameborder='0' scrolling='no' allowtransparency='yes' onload=\"autoIframe('screens');\"></iframe>
	</div>
	</td>
  </tr>";

//COMMENTS
if($conf['enablecomments'] && !$new){  
$text .= "<tr>
    <td colspan='2'><br><div id='commentstitle'><div class='collapse'><font class='warstitle'>"._WCOMS." <img src='images/ArrowUp".$conf['arrowcolor'].".png' border='0'></font></div><div class='expand'><font class='warstitle'>"._WCOMS." <img src='images/ArrowDown".$conf['arrowcolor'].".png' border='0'></font></div></div></td>
  </tr>
  <tr>
    <td colspan='2'>
		<div id='commentsdiv'>";
	$result = $sql->db_Select("clan_wars_comments", "*", "wid='$wid' ORDER BY cid DESC");
	$comms = $sql->db_Rows();
	if($comms == 0 ){
		$text .= "<div class='mainwrap forumheader3' style='text-align:center;'><div style='padding:2px;'><i>"._WNOCOMMSONWAR."</i></div></div>";
	}else{	
		while ($row = $sql->db_Fetch()) {
			$cid = intval($row['cid']);
			$poster = cw_getuser_name($row['poster']);
			$comment = $row['comment'];
			$postdate = $row['date'];

			$text .= "<div class='mainwrap forumheader3' id='comment$cid'>
					<table cellpadding='2' cellspacing='0' border='0' width='100%'>
						<tr>
							<td width='100%' valign='top'><div class='commentwrap'><div><b>$poster</b></div>
							<div style='margin-left:3px;' id='commenttext$cid'>".nl2br($comment)."</div></td>
							<td style='text-align:right;' valign='top'>
								<table cellpadding='0' cellspacing='0' border='0' style='text-align:right;'>
								<tr>
									<td><input type='button' class='iconpointer button' value='"._WEDIT."' onclick='EditComment($cid);' style='margin-bottom:2px;width:100%;'></td>
								</tr>
								<tr>
									<td><input type='button' class='iconpointer button' value='"._WDEL."' onclick='DelComment($cid);' style='margin-bottom:2px;width:100%;'></td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
				</div>
				<div class='mainwrap forumheader3' id='editcomment$cid' style='display:none;'>
					<table cellpadding='2' cellspacing='0' border='0' width='100%'>
						<tr>
							<td width='100%' valign='top'><div><b>$poster</b></div><div><textarea id='commarea$cid' style='width:340px;height:75px;'>$comment</textarea></div></td>
							<td style='text-align:right;' valign='top'>
								<table cellpadding='0' cellspacing='0' border='0' style='text-align:right;'>
								<tr>
									<td><input type='button' class='iconpointer button' value='"._WSAVE."' onclick='SaveComment($cid);' style='margin-bottom:2px;width:100%;'></td>
								</tr>
								<tr>
									<td><input type='button' class='iconpointer button' value='"._WCANCEL."' onclick='CancelComment($cid);' style='margin-bottom:2px;width:100%;'></td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
				</div>";
		}
		$text .= "<div style='text-align:right;padding-right:5px;'><a href='javascript:DelWarComments();'>"._WDELALL."</a></div>";
	}
		$text .= "</div>
	</td>
  </tr>";
}

if($conf['enablemail']){
$text .= "<tr>
		<td><br><font class='warstitle'>"._WWARSMAIL."</font></td>
	</tr>
	<tr>
		<td nowrap colspan='2'><label><input type='checkbox' name='sendemail' value='1' ".(($conf['sendmail'] && $new == 1) ? "checked" : "").">"._WSENDEMAILTOSUBSCR."</label></td>
	</tr>";
}
	if($new) $text .= "<input type='hidden' name='new' value='1'>";
	$text .= "<tr>
				<td colspan='2'><br /><br /><input type='hidden' name='wid' value='$wid'>
				<input type='submit' class='button' value='".(($new) ? _WADDWAR : _SAVECHANGES )."'>
				<input type='hidden' name='e-token' value='".e_TOKEN."' /></td>
			</tr>
		</table>
	</form></center>";

$ns->tablerender($title, $text);

?>