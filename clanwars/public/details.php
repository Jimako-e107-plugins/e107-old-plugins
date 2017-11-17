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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "details.php")) {
    die ("You can't access this file directly...");
}

$wid = intval($_GET['wid']);
$result = $sql->db_Select("clan_wars", "*", "wid='$wid'");
if(!$sql->db_Rows()){
	$text = "<br /><br /><center>War not found.</center><br /><br />";
	$ns->tablerender(_CLANWARS, $text);
	require_once(FOOTERF);
	exit;
}
$row = $sql->db_Fetch();
	$wardate = $row['wardate'];
	$style = $row['style'];
	$team = $row['team'];
	$opp_tag = $row['opp_tag'];
	$opp_name = $row['opp_name'];
	$opp_url = $row['opp_url'];
	$opp_country = $row['opp_country'];
	$game = $row['game'];
	$players = $row['players'];
	$our_score = $row['our_score'];
	$opp_score = $row['opp_score'];
	$status = $row['status'];
	$serverip = $row['serverip'];
	$serverpass = $row['serverpass'];			
	$report = $row['report'];
	$report_url = $row['report_url'];
	$wholineup = $row['wholineup'];

?>
<link rel="StyleSheet" href="includes/jquery.fancybox.css" type="text/css" media="screen">
<style type="text/css">
div.mainwrap{
	width:100%-8px;
	display:block;
	margin-bottom:1px;
	text-align:left;
}
.iconpointer{
	cursor:pointer;
}
</style>
<script type="text/javascript" src="includes/jquery.min.js"></script>
<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
<script type="text/javascript">
var wid = "<?php echo $wid;?>";
var username = "<?php echo USERNAME;?>";
var usesubs = "<?php echo $conf['usesubs'];?>";
var players = "<?php echo $players;?>";
var is_admin = <?php echo ((ADMIN && getperms("P")) ? "true" : "false" ). ";\n";?>
var is_user = <?php echo ((USER) ? "true" : "false" ). ";\n";?>
var wars_jq = jQuery;
//LANG
var edittext = "<?php echo _WEDIT;?>";
var deltext = "<?php echo _WDEL;?>";
var savetext = "<?php echo _WSAVE;?>";
var canceltext = "<?php echo _WCANCEL;?>";
var suredelwar = "<?php echo _WSUREDELWAR;?>";
var errordelwar = "<?php echo _WERRORDELWAR;?>";
var writecomm = "<?php echo _WWRITECOMM;?>";
var loginfirstt = "<?php echo _WLOGINFIRSTT;?>";
var erroraddcomm = "<?php echo _WERRORADDCOMM;?>";
var suredelcomm = "<?php echo _WSUREDELCOMM;?>";
var errordelcomm = "<?php echo _WERRORDELCOMM;?>";
var suredelallcomm = "<?php echo _WSUREDELALLCOMM;?>";
var errordelcomms = "<?php echo _WERRORDELCOMMS;?>";
var errorsavecomm = "<?php echo _WERRORSAVECOMM;?>";
var erroraddlineup = "<?php echo _WERRORADDLINEUP;?>";
var errorremovelu = "<?php echo _WERRORREMOVELU;?>";
//END LANG

</script>
<script type="text/javascript" src="includes/details.js"></script>

<?php
	
	if($status == 0){
		$sql->db_Update("clan_wars_lineup", "available='1' WHERE wid='$wid' AND available='2'");
	}else{
		$sql->db_Update("clan_wars_lineup", "available='2' WHERE wid='$wid' AND available='1'");
		$sql->db_Delete("clan_wars_lineup", "wid='$wid' AND available='0'");
	}

	$opp_url2 = str_replace("www.", "", $opp_url);
	if (strlen($opp_url2) > 25) $opp_url2 = substr($opp_url2, 0, 25 - 3)."...";
	
	$sql->db_Select("clan_teams", "*", "tid='$team'");
	$teams = $sql->db_Rows();
	$row = $sql->db_Fetch();
	$team_name = $row['team_name'];
	$tid = $row['tid'];
	
	if($teams>0){
		$title = _CLANWARS.": ".$team_name." "._WVS." ".(($opp_name !="")?$opp_name:$opp_tag);
	}else{
		$title = _CLANWARS;
	}
	$text = "<a href='clanwars.php' style='font-size:10px;'>"._WRETURNLIST."</a><br />";
	$text .= "<center>";
	
	if (strlen($opp_name) > 25){
	  $opp_name = ""; 
	}	

	$text .= " <table width='350'>
	<tr>
		<td valign='top'>
	
	<table width='100%' class='fborder'>
	  <tr>
        <td class='fcaption' colspan='2' style='text-align: center;'><b>"._WOPP."</b></td>
      </tr>
	  <tr>
        <td align='left' class='forumheader2'>"._WNAME."</td>
        <td align='left' class='forumheader3' nowrap>$opp_tag";
		if($opp_tag !="" && $opp_name !=""){
			$text .= "&nbsp;-&nbsp;";
		}
		$text .= "$opp_name</td>
      </tr>
      <tr>
        <td align='left' class='forumheader2'>"._WCOUNTRY."</td>
        <td align='left' class='forumheader3' nowrap><img src='".e_IMAGE."clan/flags/$opp_country.png' align='absmiddle'>&nbsp;$opp_country</td>
      </tr>
      <tr>
        <td align='left' class='forumheader2'>"._WURL."</td>
        <td align='left' class='forumheader3' nowrap><a href='http://$opp_url' target='_blank'>$opp_url2</a></td>
      </tr>
    </table>
	
	
	</td><td valign='top'>
	
	
	<table width='100%' class='fborder'>
      <tr>
        <td class='fcaption' colspan='2'><div style='text-align: center;'><b>"._WOTHER."</b></div></td>
      </tr>
	  <tr>
        <td align='left' class='forumheader2'>"._WSTATUS."</td>
        <td align='left' class='forumheader3' nowrap>".(($status)?_WFINISHED:_WNEXTMATCH)."</td>
      </tr>
      <tr>
        <td align='left' class='forumheader2'>"._WDATE."</td>
        <td align='left' class='forumheader3' nowrap>".(($wardate == -1) ? "" : date($conf['formatdetails'], $wardate))."</td>
      </tr>
      <tr>
        <td align='left' class='forumheader2'>"._WRESULT."</td>";
		if($status==1){
			if ($our_score > $opp_score){
				$scorecolor = "#009900";
			}elseif($our_score < $opp_score){
				$scorecolor = "#990000";
			}else{
				$scorecolor = "#3333FF";
			}
			if($conf['colorbox']){
				//Colored Boxes					
				$text .= "<td class='forumheader3' style='background-color:$scorecolor' nowrap><b style='color: #FFF;'>$our_score/$opp_score</b></td>";
			}else{
				//Colored Text					
				$text .= "<td class='forumheader3' nowrap><b style='color: $scorecolor;'>$our_score/$opp_score</b></td>";			
			}
		}else{
			$text .= "<td align='left' class='forumheader3' nowrap>N/A</td>";
		}
		
		$text .= "</tr>
    </table>

</td></tr><tr><td valign='top'>

<table width='100%' class='fborder'>
      <tr>
        <td class='fcaption' colspan='2'><div style='text-align: center;'><b>"._WMATCH."</b></div></td>
      </tr>
	  <tr>
        <td align='left' class='forumheader2' nowrap>"._WGAME."</td>
        <td align='left' class='forumheader3' nowrap>";
	$sql->db_Select("clan_games", "*", "gid = '$game'");
	$rowicon = $sql->db_Fetch();
		$icon = $rowicon['icon'];
		$gname = $rowicon['gname'];
		$abbr = $rowicon['abbr'];

		if($players=="" or $players=="0"){
			$player = "N/A";
		}else{
			$player = "$players"._WON."$players";
		}

		if(file_exists(e_IMAGE."clan/games/$icon") && $icon !="")
		$text .= "<img src='".e_IMAGE."clan/games/$icon' alt='".($abbr?$abbr:$gname)."' title='$gname' align='absmiddle'>&nbsp;";
		$text .= "$gname</td>
      </tr>
      <tr>
        <td align='left' class='forumheader2' nowrap>"._WSTYLE."</td>
        <td align='left' class='forumheader3' nowrap>$style</td>
      </tr>
      <tr>
        <td align='left' class='forumheader2' nowrap>"._WPLAYERS."</td>
        <td align='left' class='forumheader3' nowrap>$player</td>
      </tr>
    </table>
	
</td>";

//Maps
$maps = "<tr>
		<td colspan='2'>
			<table width='100%' class='fborder'>
				<tr>
					<td class='fcaption' colspan='".($conf['mapsperrow']*2)."'><div style='text-align: center;'><b>"._WMAPS."</b></div></td>
				</tr>";
					$i = 0;
					$imgs = 0;
					$sql1 = new db;
					$sql->db_Select("clan_wars_maplink", "*", "wid='$wid' ORDER BY lid ASC");
						while($rowmap = $sql->db_Fetch()){
							$i++;
							if($i == 1) $maps .= "<tr>";
							$maps .= "<td class='forumheader3' width='".$conf['mapwidth']."'>";
							$mapname = $rowmap['mapname'];
							$gametype = $rowmap['gametype'];
							$image = "";
							if(intval($mapname) > 0){ 
								$sql1->db_Select("clan_wars_maps", "*", "mid='$mapname'");
								$rowmap = $sql1->db_Fetch();
								$mapname = $rowmap['name'];
								$image = $rowmap['image'];
							}
							if(file_exists("images/Maps/$image") && $image !=""){
								$maps .= "<img src='images/Maps/$image' width='".$conf['mapwidth']."' />";
								$imgs++;
							}
							$maps .= "</td>
							<td class='forumheader3' style='padding:8px;'><b>$mapname</b> <br />$gametype</td>";
							if($i == $conf['mapsperrow']){
								$maps .= "</tr>";
								$i = 0;
							}
							
						}
			$maps .= "</table>
		</td>
	</tr>";
	
	$showmap = false;
	$showip = false;
	if(($conf['showip'] or $status == 0) && canviewserver() && ($serverip !="" or $serverpass !="" )){
		$showip = true;
	}
		
	if($sql->db_Count("clan_wars_maplink", "(*)", "WHERE wid='$wid'")){
		$results = "<td valign='top' ".(($showip)?"rowspan='2'":"").">";	
		$results .= "<table width='100%' class='fborder'>
			  <tr>
				<td class='fcaption' colspan='".($conf['scorepermap'] && $status?3:2)."'><div style='text-align: center;'><b>".($imgs > 0?_RESULTS:_WMAPS)."</b></div></td>
			  </tr>";
			$scores = 0;
			$sql1 = new db;
			$sql->db_Select("clan_wars_maplink", "*", "wid='$wid'");
				while($rowmap = $sql->db_Fetch()){
					$mapname = $rowmap['mapname'];
					$gametype = $rowmap['gametype'];
					$ourscore = $rowmap['our_score'];
					$oppscore = $rowmap['opp_score'];
					if(intval($mapname) > 0){ 
						$sql1->db_Select("clan_wars_maps", "name", "mid='$mapname'");
						$rowmap = $sql1->db_Fetch();
						$mapname = $rowmap['name'];
					}
					if($conf['scorepermap'] && $status){
						$score = "";
						$colspan = " colspan='2'";
						if($ourscore > 0 or $oppscore > 0){
							$scores++;
							$colspan = "";
							if ($ourscore > $oppscore){
								$scorecolor = "#009900";
							}elseif($ourscore < $oppscore){
								$scorecolor = "#990000";
							}else{
								$scorecolor = "#3333FF";
							}
							if($conf['colorbox']){
								//Colored Boxes					
								 $score = "<td style='text-align:center;' width='30%' class='forumheader3' style='background:url() $scorecolor;' nowrap><b style='color: #FFF;'>$ourscore/$oppscore</b></td>";
							}else{
								//Colored Text					
								 $score = "<td style='text-align:center;' width='30%' class='forumheader3' nowrap><b style='color: $scorecolor;'>$ourscore/$oppscore</b></td>";
							}
						}
					}
					$results .= "<tr>
							<td align='left' class='forumheader2' width='30%' nowrap>$mapname&nbsp;</td>
							<td align='left' class='forumheader3' ".($conf['scorepermap']?$colspan:"")." nowrap>$gametype</td>";
							if($conf['scorepermap'] && $status) $results .= $score;
						  $results .= "</tr>";
				  }
				  
			$results .= "</table>";
	
		$results .= "</td></tr>";
		if($imgs == 0 or $scores > 0){
			 $showmap = true;
			 $text .= $results;
		}
	}
	
//Server Info
if($showip){
	if($showmap)$text .= "<tr>";
	$text .= "<td valign='top'>
	<table width='100%' class='fborder'>
		  <tr>
			<td class='fcaption' colspan='2'><div style='text-align: center;'><b>"._WSERVER."</b></div></td>
		  </tr>
		  <tr>
			<td align='left' class='forumheader2' nowrap>"._WIP."</td>
			<td align='left' class='forumheader3' nowrap width='95%'>$serverip</td>
		  </tr>
		  <tr>
			<td align='left' class='forumheader2' nowrap>"._WPASS."</td>
			<td align='left' class='forumheader3' nowrap>$serverpass</td>
		  </tr>
	</table>
	
	</td></tr>";
}

if($imgs > 0) $text .= $maps;

//Report
if($report!="" or $report_url!=""){
$text .= "<tr>
		<td colspan='2'>
			<table width='100%' class='fborder'>
				<tr>
					<td class='fcaption'><div style='text-align: center;'><b>"._WREPORT."</b></div></td>
				</tr>";
				if($report!=""){
				$text .= "<tr>
						<td align='left' class='forumheader2'>".nl2br($report)."</td>
					</tr>";
				}if($report_url!="" && $report_url!="/"){
				$text .= "<tr>
						<td class='forumheader3' style='text-align: center;' nowrap><a href='http://$report_url' target='_blank'>"._WREPORTURL."</a></td>
					</tr>";
				}
			$text .= "</table>
		</td>
	</tr>";
}

//Line up
if($conf['enablelineup'] && ((!$conf['guestlineup'] && USER) or $conf['guestlineup'])){
if($status==0){
	//Upcomming War
	$result = $sql->db_Select("clan_wars_lineup", "*", "wid='$wid'");
	$arows = $sql->db_Rows();
	if(canlineup(($wholineup == 1?$tid:$game), $wholineup) or $arows > 0){
		$text .= "<tr><td colspan='2'>
		<center>
		<table width='100%' class='fborder'>
			<tr>
				<td class='fcaption' colspan='2' style='text-align: center;'><b>"._WLINEUP."</b></td>
			</tr>";
	}
	
	//Available
	$qry = "ORDER BY member";
	if($conf['usesubs'] && $players > 0){
		$qry = "ORDER BY pid LIMIT $players";
	}
	$sql->db_Select("clan_wars_lineup", "*", "wid='$wid' AND available='1' $qry");	
	$available = $sql->db_Rows();
	$i=1;
	$text .= "<tr ".(($available>0) ? "" : "style='display:none;'")." id='travailable'>
			<td align='left' class='forumheader2' width='15%' valign='top' nowrap>"._WAVAIL."&nbsp;</td>
			<td align='left' class='forumheader3' width='85%' id='available'>"; 
			$members = array();
			while ($row = $sql->db_Fetch()) {		
				$members[] = (intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
			}
			sort($members);
			foreach($members as $member){
				$text .= $member.(($i < $available) ? ", " : "");
				$i++;
			}
	$text .= "</td>
		</tr>";

	if($conf['usesubs']){
		//Subs
		$sql->db_Select("clan_wars_lineup", "*", "wid='$wid' and available='1' order by pid ASC LIMIT $players, 99");
		$subs = $sql->db_Rows();
		$i=1;
		$text .= "<tr ".(($subs>0 && $players>0) ? "" : "style='display:none;'")." id='trsubs'>
				<td align='left' class='forumheader2' width='15%' valign='top' nowrap>"._WSUBS."&nbsp;</td>
				<td align='left' class='forumheader3' width='85%' id='subs'>"; 
				if($players>0){
					$members = array();
					while ($row = $sql->db_Fetch()) {
						$members[] = (intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
					}
					sort($members);
					foreach($members as $member){
						$text .= $member.(($i < $subs) ? ", " : "");
						$i++;
					}
				}
		$text .= "</td>
		</tr>";
	}

	//Not Available
	$sql->db_Select("clan_wars_lineup", "*", "wid='$wid' and available='0' ORDER BY member");
	$notavailable = $sql->db_Rows();
	$i=1;
	$text .= "<tr ".(($notavailable>0) ? "" : "style='display:none;'")." id='trunavailable'>
			<td align='left' class='forumheader2' width='15%' valign='top' nowrap>"._WNOTAVAIL."&nbsp;</td>
			<td align='left' class='forumheader3' width='85%' id='unavailable'>";
			$members = array();
			while ($row = $sql->db_Fetch()) {
				$members[] = (intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
			}
			sort($members);
			foreach($members as $member){
				$text .= $member.(($i < $notavailable) ? ", " : "");
				$i++;
			}
	$text .= "</td>
	</tr>";
		
	//Submit availability 
	if(canlineup(($wholineup == 1?$tid:$game), $wholineup)){
		
	$entered = $sql->db_Count("clan_wars_lineup", "(*)", "where member='".USERID."' and wid='$wid'");

	$text .= "<tr>
			<td colspan='2' class='forumheader3' style='text-align: center;'>
			<div".(($entered)?"":" style='display:none;'")." id='dellineup'>
				<input type=\"button\" class=\"iconpointer button\" value=\""._WCHANGEAVAIL."\" onclick=\"DelFromLineup()\">
			</div>
			<div".(($entered)?" style='display:none;'":"")." id='addlineup'>
				<form>
				<select id='availability'>
					<option value='1'>"._WILLPLAY."</option>
					<option value='0'>"._WICANT."</option>
				</select>
				<input type=\"button\" class=\"iconpointer button\" value=\""._WSUBMIT."\" onclick=\"AddToLineup()\">
				</form>
			</div>
			</td>
		</tr>";
	}
		  
	if(canlineup(($wholineup == 1?$tid:$game), $wholineup) or $arows>0){
		$text .= "</table>";
		$text .= "</td></tr>";
	}

}else{

	//Finished War
	$i=1;
	$result = $sql->db_Select("clan_wars_lineup", "*", "wid='$wid' AND available='2' ORDER BY member ASC");
	$players = $sql->db_Rows();
	if($players > 0){
		$text .= "<tr>
				<td colspan='2'>
					<table width='100%' class='fborder'>
						<tr>
							<td class='fcaption' colspan='2' style='text-align: center;'><b>"._WLINEUP."</b></td>
						</tr>";
					$text .= "<tr>
							<td align='left' class='forumheader2' width='15%' valign='top' nowrap>"._WMEMPLAYED."&nbsp;</td>
							<td align='left' class='forumheader3' width='85%'>"; 
							$members = array();
							while ($row = $sql->db_Fetch()) {
								$members[] = (intval($row['member']) > 0 ? cw_getuser_name($row['member']):$row['member']);
							}
							sort($members);
							foreach($members as $member){
								$text .= $member.(($i < $players) ? ", " : "");
								$i++;
							}
						$text .= "</td>
						</tr>
					</table>
				</td>
			</tr>";
	}
	
}

}

//images/Screenshot	  
$sql->db_Select("clan_wars_screens", "*", "wid='$wid'");
if($sql->db_Rows()) {
$text .= "<tr>
		<td colspan='2'>
			<table width='100%' class='fborder'>
				<tr>
					<td class='fcaption' style='text-align: center;'><b>"._WSCRSHOTS."</b></td>
				</tr>
				<tr>
					<td class='forumheader3' style='text-align: center;'>
						<table border='0' cellpadding='3' cellspacing='0'>\n";
					$screens = 0;
					$i=1;
					while ($row = $sql->db_Fetch()) {
						$url = $row['url'];
						
						$thumbexists = false;
						if(file_exists("images/Screens/thumbs/$url") && $url!="" && $conf['createthumbs']){
							$thumbexists = true;
						}
						if(file_exists("images/Screens/$url") && $url!=""){						
							if($i == 1)$text .= "<tr>\n";
							$text .= "<td><a href='images/Screens/$url' class='screens' rel='screens'><img src='images/Screens/".(($thumbexists)?"thumbs/":"")."$url' width='".$conf['thumbwidth']."' border='0' /></a></td>\n";
							if($i == $conf['screensperrow']){$text .= "</tr>\n";$i=0;}
							$screens++;
							$i++;
						}
					}	
					
				if($screens < $conf['screensperrow']){
					$text .= "</tr>\n";
				}elseif($screens > $conf['screensperrow']){
					for($x=$i;$x<=$conf['screensperrow'];$x++){
						$text .= "<td></td>";
					}
					$text .= "</tr>";
				}
				
				$text .= "</table>\n</td></tr></table></td></tr>";
}

if($screens > 0){
?>
<script type="text/javascript">
wars_jq(document).ready(function() {
		wars_jq("a.screens").fancybox();
});
</script>
<?php
}


//Comments
if($conf['enablecomments'] && ($conf['guestcomments'] or USER or (ADMIN && getperms("P")))){

$text .= "<tr>
		<td colspan='2' width='100%'>
			<table width='100%' class='fborder'>
				<tr>
					<td class='fcaption' style='padding:2px;'><center><b>"._WCOMMENTS."</b></center></td>
				</tr>
				<tr>
					<td align='left'><div id='commentsdiv'>";

	$sql->db_Select("clan_wars_comments", "*", "wid='$wid' order by postdate DESC, cid DESC");
		while ($row = $sql->db_Fetch()) {
			$cid = $row['cid'];
			$poster = cw_getuser_name($row['poster']);
			$comment = $row['comment'];
			$postdate = $row['postdate'];
			
		$text .= "<div class='mainwrap forumheader3' id='comment$cid'>
				<table width='100%' cellpadding='2' cellspacing='0' border='0'>
					<tr>
						<td width='100%' align='left' valign='top'><b>$poster</b><br /><div id='commenttext$cid' style='padding-left:2px;'>".nl2br($comment)."</div></td>";
					if((ADMIN && getperms("P")) or $poster == USERNAME){
						$text .= "<td style='text-align: right; vertical-align:top;'><input type=\"button\" class=\"iconpointer button\" value=\""._WEDIT."\" onclick=\"EditComment($cid)\" style=\"margin-bottom:2px;width:100%;\"><input type=\"button\" class=\"iconpointer button\" value=\""._WDEL."\" onclick=\"DelComment($cid)\"></td>";
					}
					$text .= "</tr>
				</table>
			</div>";
			if((ADMIN && getperms("P")) or $poster == USERNAME){
			$text .= "<div class='mainwrap forumheader3' id='editcomment$cid' style='display:none;'>
				<table width='100%' cellpadding='2' cellspacing='0' border='0'>
					<tr>
						<td width='100%' align='left' valign='top'><b>$poster</b><br /><textarea id='commarea$cid' style='width:95%;height:75px;'>$comment</textarea></td>
						<td style='text-align: right; vertical-align:top;'><input type=\"button\" class=\"iconpointer button\" value=\""._WSAVE."\" onclick=\"SaveComment($cid)\" style=\"margin-bottom:2px;width:100%;\"><input type=\"button\" class=\"iconpointer button\" value=\""._WCANCEL."\" onclick=\"CancelComment($cid)\"></td>
					</tr>

				</table>
			</div>";
			}
		}
	$text .= "</div>";
	if (ADMIN && getperms("P") && $sql->db_Rows() > 1) {
		$text .= "<div class='mainwrap' style='text-align:right;' id='delallcommsdiv'><div style='padding:2px;'><input type=\"button\" class=\"iconpointer button\" value=\"Delete All\" onclick=\"DelAllComments()\"></div></div>";
	}
	if(USER){
		$text .= "<div class='mainwrap forumheader2' style='margin-bottom:0px;'>
			<table width='95%' cellpadding='0' cellspacing='2' border='0' style='text-align: center;'>
				<tr>
					<td width='100%'><textarea style='width:98%;height:60px;' id='comment'></textarea></td>
				</tr>
				<tr>
					<td style='text-align: right;'><input type=\"button\" class=\"iconpointer button\" value=\""._WADDCOMMENT."\" onclick=\"AddComment()\"></td>
				</tr>
			</table>
		</div>";
	}else{
		$text .= "<div class='mainwrap' style='text-align:center;margin-bottom:0px;'><div style='padding:2px;'>&nbsp;<br />"._WLOGINBEFOREPOST."<br />&nbsp;</div></div>";
	}
	$text .= "</td></tr></table>";
} 

$text .= "</td></tr></table></center>";

if (ADMIN && getperms("P")) {
	$text .= "<center><br /><b>[</b>&nbsp;<b>"._WADMIN.":</b> <a href='admin.php?EditWar&wid=$wid'>"._WEDITWAR."</a>&nbsp;<b>|</b>&nbsp;<a href='javascript:DelWar($wid);'>"._WDELWAR."</a>&nbsp<b>]</b></center>";
}elseif(canaddwars() && $conf['caneditwar']){
		$text .= "<center><br /><b>[</b>&nbsp;<b>"._WWAROPS.":</b> <a href='clanwars.php?EditWar&wid=$wid'>"._WEDIT." War</a>&nbsp;<b>]</b></center>";

}

$ns->tablerender($title, $text);

?>