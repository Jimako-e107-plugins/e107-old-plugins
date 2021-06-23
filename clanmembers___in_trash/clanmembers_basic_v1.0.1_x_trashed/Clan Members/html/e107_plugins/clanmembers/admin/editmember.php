<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members Basic 1.0                                     |
| =============================                                    |
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
	$xfire = $row['xfire'];
	$steam = $row['steam'];
	$avatar = $row['avatar'];
	$realname = $row['realname'];
	$country = $row['country'];
	$location = $row['location'];
	$avatar = $row['avatar'];
	$gender = $row['gender'];
	
	if($country == ""){
		$country = "Unknown";
	}
	
	?>
	<link rel="StyleSheet" href="includes/jquery.fancybox.css" type="text/css" media="screen">
	<script type="text/javascript" src="includes/jquery.fancybox.js"></script>
	<script type="text/javascript" src="includes/jquery.jcollapser.js"></script>
	<script type="text/javascript"> 
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
		<?php if(VisibleInfo("User Image")){?>
        	clanm_jq("#uimage").jcollapser({target: '#userimage', state: 'collapsed'});
		<?php }?>
        clanm_jq("#general").jcollapser({target: '#memberprofile', state: 'expanded'});		
    });
	<?php if(VisibleInfo("User Image")){?>
		clanm_jq(document).ready(function() {
			clanm_jq("a#avatar").fancybox();
		});
	<?php }?>
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
	}$text .= "</table></div>";
	
	$ns->tablerender("<div id='general'>
			<div class='collapse'>Edit the info of $member -</div>
			<div class='expand'>Edit the info of $member +</div></div>", $text);
	
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


$sql1 = new db;
$sql2 = new db;
$sql3 = new db;			
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
			<td align='left'><label><input name='game$gid' type='checkbox' value='1' $check />$gname</label></td>
			</tr>";
	}	
	$text .= "</table></div>";
	$ns->tablerender("<div id='games'>
			<div class='collapse'>"._INFOGames." -</div>
			<div class='expand'>"._INFOGames." +</div></div>", $text);
}

//Teams
$teams = $sql->db_Count("clan_teams");
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
			<td align='left'><label><input name='team$tid' type='checkbox' value='1' $check />$team_name</label></td>
			</tr>";
	}	
	$text .= "</table></div>";

	$ns->tablerender("<div id='teams'>
			<div class='collapse'>"._INFOTeams." -</div>
			<div class='expand'>"._INFOTeams." +</div></div>", $text);
}



	$text =  "<input type='hidden' name='member' value='$member'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='hidden' name='memberid' value='$memberid'></form>";

$ns->tablerender("<input type='submit' value='"._SAVECHANGES."' class='button'>", $text);

?>