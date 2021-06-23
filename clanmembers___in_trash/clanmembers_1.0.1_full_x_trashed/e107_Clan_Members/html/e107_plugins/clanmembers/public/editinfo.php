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

if (!defined('CM_PUB') or (!$conf['allowchangeinfo'] && !$conf['allowupimage'])) {
    header("Location:modules.php?name=$module_name");
	die ("Access Denied");
}

if(!is_clanmember(USERID)){
	header("Location: modules.php?name=$module_name");
}
$memberid = USERID;

$sql->db_Select("clan_members_info", "*", "userid='$memberid'");
$row = $sql->db_Fetch();
	$member = $row['name'];
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
	if($conf['allowupimage'] && !$conf['allowchangeinfo']){
		$state = "expanded";
	}else{
		$state = "collapsed";
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
		<?php
		if($conf['enableprofile'] && $conf['enablehardware'] && $conf['allowchangeinfo']){
		?>
        	clanm_jq("#hardware").jcollapser({target: '#hardwareprofile', state: 'collapsed'});
		<?php
		}
		if(VisibleInfo("User Image") && $conf['allowupimage']){
		?>
        	clanm_jq("#uimage").jcollapser({target: '#userimage', state: '<?php echo $state;?>'});
		<?php
		}
		?>
        clanm_jq("#general").jcollapser({target: '#memberprofile', state: 'expanded'});
    });
	<?php
	if(VisibleInfo("User Image") && $conf['allowupimage']){
	?>
		clanm_jq(document).ready(function() {
			clanm_jq("a#avatar").fancybox();
		});
	<?php
	}
	?>
    </script>
    
	<style type="text/css">
		#general{
			text-align: left;
		}
        .collapse{
			cursor:pointer;
			text-align: left;
        }
        
        .expand{
            display:none;
			cursor:pointer;
			text-align: left;
        }
    </style>
    <?php
			
$text = "<table width='310' cellpadding='0' border='0' cellspacing='0'><tr><td align='left'>";
$text .= "<form name='memberinfo' method='post' action='clanmembers.php?saveinfo' enctype=\"multipart/form-data\">";
	if($conf['allowchangeinfo']){
	$text .= "<b><div id='general'>
			<div class='collapse'>"._GENERAL." -</div>
			<div class='expand'>"._GENERAL." +</div></div></b>
		
	<div id='memberprofile'>
	<table border='0' cellpadding='0' cellspacing='1'>";
	
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
			<td align='left'>			
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
	}
	$text .= "</table></div>";
	}
	//User Image
	if(VisibleInfo("User Image") && $conf['allowupimage']){
	$text .= "<br /><b><div id='uimage'>
		<div class='collapse'>"._INFOUserImage." -</div>
		<div class='expand'>"._INFOUserImage." +</div></div></b>
		<div id='userimage'>
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
	}
	if($conf['enableprofile'] && $conf['enablehardware'] && $conf['allowchangeinfo']){
		//Hardware Profile
		$text .= "<br /><b><div id='hardware'>
				<div class='collapse'>"._HARDWPROFILE." -</div>
				<div class='expand'>"._HARDWPROFILE." +</div></div></b>
			<div id='hardwareprofile'>
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
		
		$text .= "</table></div><br />";
	}
	

	$text .= "<input type='hidden' name='memberid' value='$memberid'>
	<input type='submit' class='button' value='"._SAVECHANGES."'>
</form>";
$text .= "</td></tr></table></center>";

$ns->tablerender(_EDITURINFO, $text);

?>