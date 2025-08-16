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

$memberid = intval($_GET['memberid']);
$sql->db_Select_gen("SELECT i.*, u.user_name from #clan_members_info i, #user u WHERE u.user_id=i.userid and i.userid='$memberid'");
$row = $sql->db_Fetch();
	$member = $row['user_name'];
	$rank = $row['rank'];
	$joindate = $row['joindate'];
	$birthday = $row['birthday'];
	$active = $row['active'];
	$xfire = $row['xfire'];
	$steam = $row['steam'];
	$avatar = $row['avatar'];
	$realname = $row['realname'];
	$country = $row['country'];
	$location = $row['location'];
	$avatar = $row['avatar'];
	$gender = $row['gender'];
	$tryout = $row['tryout'];
	$votedate = (intval($row['votedate']) > 0 ? date("Y/m/d", $row['votedate']) : "");

	$manufacturer = $row['manufacturer'];
	$cpu = $row['cpu'];
	$memory = $row['memory'];
	$hdd = $row['hdd'];
	$vga = $row['vga'];
	$monitor = $row['monitor'];
	$sound = $row['sound'];
	$speakers = $row['speakers'];
	$keyboard = $row['keyboard'];
	$mouse = $row['mouse'];
	$surface = $row['surface'];
	$os = $row['os'];
	$mainboard = $row['mainboard'];
	$pccase = $row['pccase'];
	
	if($country == ""){
		$country = "Unknown";
	}
	
	?>
	<link rel="StyleSheet" href="includes/jquery.fancybox.css" type="text/css" media="screen">
	<link rel="StyleSheet" href="includes/jquery.datePicker.css" type="text/css">
    <style type="text/css">
	div.mainwrap{
		width:450px;
		display:block;
		margin-bottom:1px;
		text-align:left;
	}
	.collapse{
		cursor:pointer;
	}
	
	.expand{
		display:none;
		cursor:pointer;
	}
	</style>
	<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
	<script type="text/javascript" src="includes/jquery.jcollapser.js"></script>
    <script type="text/javascript" src="includes/date.js"></script>
	<script type="text/javascript" src="includes/jquery.datePicker.js"></script>
	<script type="text/javascript"> 
	function SetVoteDate(obj){
		if(obj.value == "1"){
			document.getElementById('trvotedate').style.display = "";
		}else{
			document.getElementById('trvotedate').style.display = "none";
		}
	}
	
	Date.format = 'yyyy/mm/dd';
	clanm_jq(function(){
		clanm_jq('.date-pick').datePicker({startDate:'<?php echo str_replace(array("dd","mm","yyyy"),array(date("d"),date("m"),date("Y")),"yyyy/mm/dd");?>',clickInput:true});
	});
	function updateFlag(obj) {
		var cflag = document.getElementById("cflag");
		cflag.src = "<?php echo e_IMAGE;?>clan/flags/"+obj.value+".png"
	}
	function ShowJoin(obj){
		
		if(obj.checked){
			document.memberinfo.joiny.disabled = false;
			document.memberinfo.joinm.disabled = false;
			document.memberinfo.joind.disabled = false;
		}else{
			document.memberinfo.joiny.disabled = true;
			document.memberinfo.joinm.disabled = true;
			document.memberinfo.joind.disabled = true;
		}
	}
	
	function ShowAge(obj){
		
		if(obj.checked){
			document.memberinfo.yyyy.disabled = false;
			document.memberinfo.mm.disabled = false;
			document.memberinfo.dd.disabled = false;
		}else{
			document.memberinfo.yyyy.disabled = true;
			document.memberinfo.mm.disabled = true;
			document.memberinfo.dd.disabled = true;
		}
	}

    clanm_jq(function() {
		<?php if($conf['enableprofile'] && $conf['enablehardware']){?>
        	clanm_jq("#hardware").jcollapser({target: '#hardwareprofile', state: 'collapsed'});
		<?php }if(VisibleInfo("User Image")){?>
        	clanm_jq("#uimage").jcollapser({target: '#userimage', state: 'collapsed'});
		<?php }?>
        clanm_jq("#comments").jcollapser({target: '#commentsbox', state: 'collapsed'});		
        clanm_jq("#general").jcollapser({target: '#memberprofile', state: 'expanded'});		
    });
	<?php if(VisibleInfo("User Image")){?>
		clanm_jq(document).ready(function() {
			clanm_jq("a#avatar").fancybox();
		});
	<?php }?>

	var memberid = <?php echo intval($memberid);?>;
	var userid = <?php echo intval(USERID);?>;
	var username = "<?php echo USERNAME;?>";
	var is_admin = <?php echo ((ADMIN && getperms("P")) ? "true" : "false" ). ";\n";?>
	var is_user = <?php echo ((USER) ? "true" : "false" ). ";\n";?>
	//LANG
	var edittext = "<?php echo _EDIT;?>";
	var deltext = "<?php echo _DEL;?>";
	var savetext = "<?php echo _SAVE;?>";
	var canceltext = "<?php echo _CANCEL;?>";
	var writecomm = "<?php echo _WRITECOMM;?>";
	var loginfirstt = "<?php echo _LOGINFIRSTT;?>";
	var erroraddcomm = "<?php echo _ERRORADDCOMM;?>";
	var suredelcomm = "<?php echo _SUREDELCOMM;?>";
	var errordelcomm = "<?php echo _ERRORDELCOMM;?>";
	var errorsavecomm = "<?php echo _ERRORSAVECOMM;?>";
	//END LANG

</script>
<script type="text/javascript" src="includes/comments.js"></script>    

    <?php
			
echo "<form name='memberinfo' method='post' action='admin.php?savemember' enctype=\"multipart/form-data\">";
	$text = "<div id='memberprofile'>
	<table border='0' cellpadding='0' cellspacing='1'>";
	
	if($active == 1){
		$yeschk = "checked";
		$nochk = "";
	}else{
		$yeschk = "";
		$nochk = "checked";
	}
	
	$month = array("",_CMJAN,_CMFEB,_CMMAR,_CMAPR,_CMMAY,_CMJUN,_CMJUL,_CMAUG,_CMSEP,_CMOCT,_CMNOV,_CMDEC);
	
	if(VisibleInfo("Realname")){
	$text .= "<tr>
			<td align='left' width='120'>"._INFORealname.":&nbsp;</td>
			<td align='left'><input type='text' name='realname' value='$realname' size='25' maxlength='100'></td>
		</tr>";
	}if(VisibleInfo("Gender")){
	if($gender == "Male"){$male="checked";$female="";}elseif($gender == "Female"){$male="";$female="checked";}
	$text .= "<tr>
			<td align='left' width='120'>"._INFOGender.":&nbsp;</td>
			<td align='left'><label><input type='radio' name='gender' value='Male' $male>Male</label> <label><input type='radio' name='gender' value='Female' $female>Female</label></td>
		</tr>";
	}if(VisibleInfo("Age") or VisibleInfo("Birthday")){
		
		if($birthday == 1){
			$yyyy = "";
			$mm = "";
			$dd = "";
			$chk = "";
			$disabled = "disabled";
		}else{
			$yyyy = date("Y", $birthday);
			$mm =  date("n", $birthday);
			$dd = date("j", $birthday);
			$chk = "checked";
			$disabled = "";
		}
		
		$text .= "<tr>
			<td align='left' width='120'>"._INFOBirthday.":&nbsp;</td>
			<td align='left' nowrap>			
			<select name='dd' id='dd' $disabled>";
			for($i=1;$i<=31;$i++){

				if($dd == $i){$sel = "selected";}else{$sel="";}
				$text .= "<option $sel>$i</option>";
			}
			$text .= "</select>
			<select name='mm' id='mm' $disabled>";
			for($i=1;$i<=12;$i++){
				if($mm == $i){$sel = "selected";}else{$sel="";}
				$text .= "<option value='$i' $sel>".$month[$i]."</option>";
			}
			$text .= "</select>			
			<select name='yyyy' id='yyyy' $disabled>";
			$thisyear = date("Y");
			for($i=$thisyear-120;$i<=$thisyear;$i++){
				if($yyyy == $i){$sel = "selected";}elseif($yyyy==""&&$i==$thisyear-18){$sel = "selected";}else{$sel="";}
				$text .= "<option $sel>$i</option>";
			}
			$text .= "</select>	
			<input type='checkbox' name='showage' value='1' onclick='ShowAge(this);' $chk></td>
		</tr>";
	}if(VisibleInfo("Location")){
	$text .= "<tr>
			<td align='left' width='120'>"._INFOLocation.":&nbsp;</td>
			<td align='left'><input type='text' name='location' value='$location' size='25' maxlength='100'></td>
		</tr>";
	}if(VisibleInfo("Country")){
	$text .= "<tr>
			<td align='left' width='120'>"._INFOCountry.":&nbsp;</td>
			<td align='left'><select name='country' onchange=\"updateFlag(this)\">";

			$files = array();	
			$TrackDir=opendir(e_IMAGE."clan/flags");
			while ($file = readdir($TrackDir)) {  
					  if ($file == "." || $file == ".." || $file == "Thumbs.db") { 
					  }else{
					  $file = explode(".",$file);
					  $file2 = $file[0];
					  $files[] = $file2;
					  } 
				 }  
			
			closedir($TrackDir);
			asort($files);
			
			foreach($files as $file){
			if($country == $file){$selected = "selected";}else{$selected = "";}
			$text .= "<option value='$file' $selected>$file</option>";
		}
		
		$text .= "</select>&nbsp;<img id='cflag' src='".e_IMAGE."clan/flags/$country.png'>
		</td>
	</tr>";
	}if(VisibleInfo("Join Date")){		
	
	if($joindate == 1){
		$yyyy = "";
		$mm = "";
		$dd = "";
		$chk = "";
		$disabled = "disabled";
	}else{
		$yyyy = date("Y", $joindate);
		$mm =  date("n", $joindate);
		$dd = date("j", $joindate);
		$chk = "checked";
		$disabled = "";
	}
		
	$text .= "<tr>
			<td align='left' width='120'>"._INFOJoinDate.":&nbsp;</td>
			<td align='left'>					
			<select name='joind' id='joind' $disabled>";
			for($i=1;$i<=31;$i++){
				if($dd == $i){$sel = "selected";}elseif($dd=="" && $i==date("j")){$sel = "selected";}else{$sel="";}
				$text .= "<option $sel>$i</option>";
			}
			$text .= "</select>
			<select name='joinm' id='joinm' $disabled>";
			for($i=1;$i<=12;$i++){
				if($mm == $i){$sel = "selected";}elseif($mm=="" && $i==date("n")){$sel = "selected";}else{$sel="";}
				$text .= "<option value='$i' $sel>".$month[$i]."</option>";
			}
			$text .= "</select>			
			<select name='joiny' id='joiny' $disabled>";
			$thisyear = date("Y");
			for($i=$thisyear-120;$i<=$thisyear;$i++){
				if($yyyy == $i){$sel = "selected";}elseif($yyyy=="" && $i==$thisyear){$sel = "selected";}else{$sel="";}
				$text .= "<option $sel>$i</option>";
			}
			$text .= "</select>	
			<input type='checkbox' name='showjoin' value='1' onclick='ShowJoin(this);' $chk>
			</td>
		</tr>";
	}if($conf['rank_per_game'] == 0 && (VisibleInfo("Rank") or VisibleInfo("Rank Image"))){
		if($sql->db_Count("clan_members_ranks") > 0){
		$text .= "<tr>
				<td align='left' width='120'>"._INFORank.":&nbsp;</td>
				<td align='left'><select name='rank'>";
				$text .= "<option value='0'>"._NORANK."</option>";
			
			$sql->db_Select("clan_members_ranks", "*", "ORDER BY rankorder ASC", "");
				while($rowrank = $sql->db_Fetch()){
					$rid = $rowrank['rid'];
					$xrank = $rowrank['rank'];
					if($rid == $rank){
						$text .= "<option value='$rid' selected>$xrank</option>";
					}else{
						$text .= "<option value='$rid'>$xrank</option>";
					}
				}
			$text .= "</select></td>
			</tr>";
		}
	}if(VisibleInfo("Xfire")){
	$text .= "<tr>
			<td align='left' width='120'>"._INFOXfire.":&nbsp;</td>
			<td align='left'><input type='text' name='xfire' value='$xfire' size='20' maxlength='100'></td>
		</tr>";
	}if(VisibleInfo("Steam ID")){
	$text .= "<tr>
			<td align='left' width='120'>"._INFOSteamID.":&nbsp;</td>
			<td align='left'><input type='text' name='steam' value='$steam' size='20' maxlength='100'></td>
		</tr>";
	}if(VisibleInfo("Activity")){
	$text .= "<tr>
			<td align='left' width='120'>"._ACTIVE.":&nbsp;</td>
			<td align='left'><label><input type='radio' name='xactive' value='1' $yeschk>"._YES."</label>&nbsp;<label><input type='radio' name='xactive' value='0' $nochk>"._NO."</label></td>
		</tr>";
	}else{
	$text .= "<input type='hidden' name='xactive' value='1'>";
	}
	$text .= "<tr>
			<td align='left' width='120'>"._TRYOUT.":&nbsp;</td>
			<td align='left'><label><input type='radio' name='tryout' value='1' ".($tryout?"checked":"")." onclick='SetVoteDate(this)'>"._YES."</label>&nbsp;<label><input type='radio' name='tryout' value='0' ".($tryout?"":"checked")." onclick='SetVoteDate(this)'>"._NO."</label></td>
		</tr>";
	$text .= "<tr id='trvotedate'".($tryout?"":" style='display:none;'").">
			<td align='left' width='120'>"._VOTEDATE.":&nbsp;</td>
			<td align='left'><input type='text' name='votedate' value='$votedate' class='date-pick' size='20' maxlength='20'></td>
		</tr>";
	$text .= "</table></div>";
	
	$ns->tablerender("<div id='general'>
			<div class='collapse'>Edit the info of $member -</div>
			<div class='expand'>Edit the info of $member +</div></div>", $text);
	
	$usrinfo = get_user_data(USERID);
	if(check_class($conf['commentsclass']) or $usrinfo["user_perms"] == "0"){
		$text = "<div id='commentsbox'><table width='100%' class='fborder'>
					<tr>
						<td align='left'><div id='commentsdiv'>";
		$sql->db_Select("clan_members_comments", "*", "userid='$memberid' order by postdate DESC, cid DESC");
			while ($row = $sql->db_Fetch()) {
				$cid = $row['cid'];
				$posterid = $row['posterid'];
				$poster = cm_getuser_name($posterid);
				$comment = $row['comment'];
				$postdate = $row['postdate'];
				
				
			$text .= "<div class='mainwrap forumheader3' id='comment$cid'>
					<table width='100%' cellpadding='2' cellspacing='0' border='0'>
						<tr>
							<td width='100%' align='left' valign='top'><b>$poster</b><br /><div id='commenttext$cid' style='padding-left:2px;'>".nl2br($comment)."</div></td>";
						if($usrinfo["user_perms"] == "0" or $posterid == USERID){
							$text .= "<td style='text-align: right; vertical-align:top;'><input type=\"button\" class=\"iconpointer button\" value=\""._EDIT."\" onclick=\"EditComment($cid)\" style=\"margin-bottom:2px;width:100%;\"><input type=\"button\" class=\"iconpointer button\" value=\""._DEL."\" onclick=\"DelComment($cid)\"></td>";
						}
						$text .= "</tr>
					</table>
				</div>";
				if($usrinfo["user_perms"] == "0" or $posterid == USERID){
				$text .= "<div class='mainwrap forumheader3' id='editcomment$cid' style='display:none;'>
					<table width='100%' cellpadding='2' cellspacing='0' border='0'>
						<tr>
							<td width='100%' align='left' valign='top'><b>$poster</b><br /><textarea id='commarea$cid' style='width:95%;height:75px;'>$comment</textarea></td>
							<td style='text-align: right; vertical-align:top;'><input type=\"button\" class=\"iconpointer button\" value=\""._SAVE."\" onclick=\"SaveComment($cid)\" style=\"margin-bottom:2px;width:100%;\"><input type=\"button\" class=\"iconpointer button\" value=\""._CANCEL."\" onclick=\"CancelComment($cid)\"></td>
						</tr>
	
					</table>
				</div>";
				}
			}
		$text .= "</div>";
	
		if(USER){
			$text .= "<div class='mainwrap forumheader2' style='margin-bottom:0px;'>
				<table width='95%' cellpadding='0' cellspacing='2' border='0' style='text-align: center;'>
					<tr>
						<td width='100%'><textarea style='width:98%;height:60px;' id='comment'></textarea></td>
					</tr>
					<tr>
						<td style='text-align: right;'><input type=\"button\" class=\"iconpointer button\" value=\""._ADDCOMMENT."\" onclick=\"AddComment()\"></td>
					</tr>
				</table>
			</div>";
		}else{
			$text .= "<div class='mainwrap' style='text-align:center;margin-bottom:0px;'><div style='padding:2px;'>&nbsp;<br />"._LOGINBEFOREPOST."<br />&nbsp;</div></div>";
		}
		$text .= "</td></tr></table></div>";
			$ns->tablerender("<div id='comments'>
				<div class='collapse'>Comments -</div>
				<div class='expand'>Comments +</div></div>", $text);	
	}
	//User Image
	if(VisibleInfo("User Image")){
		$text = "<div id='userimage'>
			<table border='0' cellpadding='0' cellspacing='1'>";
	
		if($avatar !="" && file_exists("images/UserImages/$avatar")){
			$wihei = "";
			$size = getimagesize("images/UserImages/$avatar");
			if($size[0] > 100){
				$wihei = "width='100'";
				$newh = 100 / $size[0] * $size[1];
				if($newh > 100){
					$wihei = "height='100'";
				}
			}elseif($size[1] > 100){
				$wihei = "height='100'";
			}
		
			$text .= "<tr>
					<td align='left' valign='top' style='padding-top:3px;'>"._CURRENT.":&nbsp;</td>
					<td align='left' valign='top'><a id='avatar' href='images/UserImages/$avatar'><img src='images/UserImages/$avatar' border='0' $wihei align='top' vspace='3'></a>&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='delavatar' value='1'>"._DEL."</label></td>
				</tr>";
		}
		$text .= "<tr>
			<td align='left' width='120'>"._UPLNEW.":&nbsp;</td>
			<td align='left'><input type=\"file\" name=\"newimage\" size='15'></td>
		</tr>";
		$text .= "</table></div>";
		
	
		$ns->tablerender("<div id='uimage'>
				<div class='collapse'>"._INFOUserImage." -</div>
				<div class='expand'>"._INFOUserImage." +</div></div>", $text);
	}
	if($conf['enableprofile'] && $conf['enablehardware']){
		//Hardware Profile
		$text = "<div id='hardwareprofile'>
			<table border='0' cellpadding='0' cellspacing='1'>
			<tr>
				<td align='left' width='120'>"._INFOmanufacturer.":&nbsp;</td>
				<td align='left'><input type='text' name='manufacturer' value='$manufacturer' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOcpu.":&nbsp;</td>
				<td align='left'><input type='text' name='cpu' value='$cpu' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOmainboard.":&nbsp;</td>
				<td align='left'><input type='text' name='mainboard' value='$mainboard' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOmemory.":&nbsp;</td>
				<td align='left'><input type='text' name='memory' value='$memory' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOhdd.":&nbsp;</td>
				<td align='left'><input type='text' name='hdd' value='$hdd' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOvga.":&nbsp;</td>
				<td align='left'><input type='text' name='vga' value='$vga' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOmonitor.":&nbsp;</td>
				<td align='left'><input type='text' name='monitor' value='$monitor' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOsound.":&nbsp;</td>
				<td align='left'><input type='text' name='sound' value='$sound' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOspeakers.":&nbsp;</td>
				<td align='left'><input type='text' name='speakers' value='$speakers' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOkeyboard.":&nbsp;</td>
				<td align='left'><input type='text' name='keyboard' value='$keyboard' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOmouse.":&nbsp;</td>
				<td align='left'><input type='text' name='mouse' value='$mouse' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOsurface.":&nbsp;</td>
				<td align='left'><input type='text' name='surface' value='$surface' size='25' maxlength='50'></td>
			</tr>
			<tr>
				<td align='left'>"._INFOos.":&nbsp;</td>
				<td align='left'><input type='text' name='os' value='$os' size='25' maxlength='50'></td>
			</tr>
					<tr>
				<td align='left'>"._INFOpccase.":&nbsp;</td>
				<td align='left'><input type='text' name='pccase' value='$pccase' size='25' maxlength='50'></td>
			</tr>";
		
		$text .= "</table></div>";

		$ns->tablerender("<div id='hardware'>
					<div class='collapse'>"._HARDWPROFILE." -</div>
					<div class='expand'>"._HARDWPROFILE." +</div></div>", $text);

	}

$sql1 = new db;
$sql2 = new db;
$sql3 = new db;	
//Games
$games = $sql->db_Count("clan_games", "(*)", "WHERE inmembers='1'");
if($games > 0){
	?>
    <script type="text/javascript">
	clanm_jq(function() {
		clanm_jq("#games").jcollapser({target: '#gamesprofile', state: 'collapsed'});
	});
	</script>
    <?php
	$text = "<div id='gamesprofile'>
	<table border='0' cellpadding='0' cellspacing='1'>";
		
	$sql->db_Select("clan_games", "*", "inmembers='1' order by position ASC");
	while($row = $sql->db_Fetch()){
		$gid = $row['gid'];
		$gname = $row['gname'];
		
		if($sql1->db_Count("clan_members_gamelink", "(*)", "WHERE gid='$gid' AND userid='$memberid'") == 0){	
			$check = "";
		}else{	
			$check= "checked";
		}
		$text .= "<tr>
				<td align='left'><label><input name='game$gid' type='checkbox' value='1' $check />$gname</label></td>";
	
		if($conf['rank_per_game'] == 1 && (VisibleInfo("Rank") or VisibleInfo("Rank Image")) && $conf['gamesorteams'] == "Games"){
			$text .= "<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._INFORank.": <select name='rank$gid'>";	
			$text .= "<option value='0'>"._NORANK."</option>";
			$sql2->db_Select("clan_members_ranks", "*", "ORDER BY rankorder", "");
				while($rowrank = $sql2->db_Fetch()){
					$rid = $rowrank['rid'];
					$rank = $rowrank['rank'];
		
					//Match
					$sql3->db_Select("clan_members_gamelink", "*", "userid='$memberid' and gid='$gid'");
					$rowmatch = $sql3->db_Fetch();
						if($rowmatch['rank'] == $rid){
							$text .= "<option value='$rid' selected>$rank</option>";
						}else{
							$text .= "<option value='$rid'>$rank</option>";
						}
					//End Match		
				}
			$text .= "</select></td>";	
		}
		$text .= "</tr>";
	}	
	$text .= "</table></div>";
	$ns->tablerender("<div id='games'>
			<div class='collapse'>"._INFOGames." -</div>
			<div class='expand'>"._INFOGames." +</div></div>", $text);
}

//Teams
$teams = $sql->db_Count("clan_teams", "(*)", "WHERE inmembers='1'");
if($teams > 0){
	?>
    <script type="text/javascript">
	clanm_jq(function() {
        clanm_jq("#teams").jcollapser({target: '#teamsprofile', state: 'collapsed'});
	});
	</script>
    <?php
	$text = "<div id='teamsprofile'>
	<table border='0' cellpadding='0' cellspacing='1'>";


	$sql->db_Select("clan_teams", "*", "inmembers='1' order by position ASC");
	while($row = $sql->db_Fetch()){	
	$tid = $row['tid'];
	$team_name = $row['team_name'];
	
	if($sql1->db_Count("clan_members_teamlink", "(*)", "WHERE tid='$tid' AND userid='$memberid'") == 0){	
		$check = "";
	}else{	
		$check= "checked";
	}
	$text .= "<tr>
			<td align='left'><label><input name='team$tid' type='checkbox' value='1' $check />$team_name</label></td>";

	if($conf['rank_per_game'] == 1 && (VisibleInfo("Rank") or VisibleInfo("Rank Image")) && $conf['gamesorteams'] == "Teams"){
		$text .= "<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._INFORank.": <select name='rank$tid'>";	
$text .= "<option value='0'>"._NORANK."</option>";
		$sql2 = new db;
		$sql2->db_Select("clan_members_ranks", "*", "ORDER BY rankorder", "");
			while($rowrank = $sql2->db_Fetch()){
				$rid = $rowrank['rid'];
				$rank = $rowrank['rank'];
	
			//Match
			$sql3 = new db;			
			$sql3->db_Select("clan_members_teamlink", "*", "userid='$memberid' and tid='$tid'");
			$rowmatch = $sql3->db_Fetch();
				if($rowmatch['rank'] == $rid){
					$text .= "<option value='$rid' selected>$rank</option>";
				}else{
					$text .= "<option value='$rid'>$rank</option>";
				}
			//End Match
	
			}
		$text .= "</select></td>";	
		}
	$text .= "</tr>";
	}	
	$text .= "</table></div>";

	$ns->tablerender("<div id='teams'>
			<div class='collapse'>"._INFOTeams." -</div>
			<div class='expand'>"._INFOTeams." +</div></div>", $text);
}


//Awards
$sql->db_Select_gen("SELECT a.title, l.id FROM #clan_members_awards a, #clan_members_awardlink l WHERE a.rid=l.award AND l.userid='$memberid' ORDER BY position ASC");
if($sql->db_Rows() > 0 && $conf['showawards']){
?>
	<script type="text/javascript"> 
    clanm_jq(function() {
        clanm_jq("#awards").jcollapser({target: '#membersawards', state: 'collapsed'});
     });
	</script>
<?php
$text = "<div id='membersawards'>
	<table border='0' cellpadding='0' cellspacing='1'>";

	while($row = $sql->db_Fetch()){
		$id = $row['id'];
		$title = $row['title'];

	$text .= "<tr>
			<td align='left'><input type='checkbox' name='awards[$id]' value='1' checked>$title</td>
		</tr>";
	}
$text .= "</table></div>";

$ns->tablerender("<div id='awards'>
			<div class='collapse'>"._AWARDS." -</div>
			<div class='expand'>"._AWARDS." +</div></div>", $text);

}

	$text =  "<input type='hidden' name='member' value='$member'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='hidden' name='memberid' value='$memberid'></form>";

$ns->tablerender("<input type='submit' value='"._SAVECHANGES."' class='button'>", $text);

?>