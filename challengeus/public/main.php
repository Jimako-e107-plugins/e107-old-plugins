<?php
/*
+ -----------------------------------------------------------------+
| e107: Challenge Us 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!(defined('CHAL_PUB') && preg_match("/challengeus\.php/i", $_SERVER['REQUEST_URI']))){
    die ("Access denied.");
}
?>
<link rel="stylesheet" href="includes/main.css" />
<link rel="stylesheet" href="includes/jquery.datePicker.css" />
<link rel="stylesheet" href="includes/jquery.autocomplete.css" />
<script type="text/javascript" src="includes/jquery.min.js"></script>
<script type="text/javascript" src="includes/date.js"></script>
<script type="text/javascript" src="includes/jquery.datePicker.js"></script>
<script type="text/javascript" src="includes/jquery.autocomplete.js"></script>
<script type="text/javascript">
<!--
var chal_jq = jQuery;
chal_jq(function() {
	chal_jq("input[name=chdate]").datepicker({dateFormat: "<?php echo str_replace("yyyy","yy", $conf['dateformat']);?>", minDate: new Date(<?php echo date("Y");?>, <?php echo date("m")-1;?>, <?php echo date("j");?>)});
});
chal_jq(document).ready(function() {
	chal_jq("#mapname").autocomplete('challengeus.php?Search&gid='+document.getElementById('gid').value, {
		matchContains: true,
		selectFirst: false,
		autoFill: true,
		minChars: 1
	});
});

function ChangeFlag(obj) {
	var cflag = document.getElementById("flag");
	cflag.src = "<?php echo e_IMAGE;?>clan/flags/"+obj.value+".png"
}
function ChangeGame(obj) {
	chal_jq("#mapname").autocomplete('challengeus.php?Search&gid='+obj.value, {
		matchContains: true,
		selectFirst: false,
		autoFill: true,
		minChars: 1
	});
}
-->
</script>
<?php
$username = (USERNAME != "USERNAME" ? USERNAME : "");
$sql->db_Select("user", "user_email", "user_id='".intval(USERID)."'");
$row = $sql->db_Fetch();
$email = $row['user_email'];
$text = "<div style='text-align:center;'><table id='challengetable'>
<tr>
    <td style='text-align: center;' colspan='2'>Language: <img src='".e_IMAGE."clan/flags/United-Kingdom.png' alt='' />&nbsp;<a href='challengeus.php?Main&amp;lan=English'>English</a> - <img src='".e_IMAGE."clan/flags/Denmark.png' alt='' />&nbsp;<a href='challengeus.php?Main&amp;lan=Danish'>Danish</a><br />&nbsp;</td>
  </tr>";
if($conf['text'.strtolower($lan)] !=""){
  $text .= "<tr>
    <td style='text-align: center;' colspan='2'>".nl2br($conf['text'.strtolower($lan)])."<br />&nbsp;</td>
  </tr>";
}
    $text .= "<tr><td>
	<form method=\"post\" action=\"challengeus.php?Challenge&amp;lan=$lan\">

    <table border='0' cellpadding='0' cellspacing='0'>
	<tr><td colspan='2'><span class='chaltitle'>"._URINFO."</span><br /></td></tr>
    <tr><td><b>"._NICK."<span style='color:red;'>*</span> : </b></td><td><input type='text' name='uname' value='$username' size='15' maxlength='25' /></td></tr>
    <tr><td><b>"._EMAIL."<span style='color:red;'>*</span> : </b></td><td><input type='text' name='email' value='$email' size='25' maxlength='50' /></td></tr>
    <tr><td><b>"._MSN.": </b></td><td><input type='text' name='msn' value='$msn' size='25' maxlength='50' /></td></tr>
    <tr><td><b>"._XFIRE.": </b></td><td><input type='text' name='xfire' value='$xfire' size='15' maxlength='50' /></td></tr>
	
	<tr><td colspan='2'><br /><span class='chaltitle'>"._CLANINFO."</span></td></tr>
    <tr><td><b>"._TAG."<span style='color:red;'>*</span> : </b></td><td><input type='text' name='clantag' value='$clantag' size='15' maxlength='15' /></td></tr>
    <tr><td><b>"._NAME."<span style='color:red;'>*</span> : </b></td><td><input type='text' name='clanname' value='$clanname' size='25' maxlength='25' /></td></tr>
	<tr><td><b>"._SITE.": </b></td><td><input type='text' name='clansite' value='$clansite' size='25' maxlength='50' /></td></tr>
	<tr><td><b>"._COUNTRY."<span style='color:red;'>*</span> : </b></td><td><select name='country' onchange='ChangeFlag(this);' id='country'>";

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
		$text .= "<option value='$file' ".(("Unknown" == $file) ? "selected='selected'" : "").">$file</option>";
	}

$text .= "</select> <img src='".e_IMAGE."clan/flags/Unknown.png' id='flag' alt='' /></td></tr>	
	
	<tr><td colspan='2'><br /><span class='chaltitle'>"._MTCHINFO."</span></td></tr>
   <tr><td> <b>"._DATE."<span style='color:red;'>*</span> : </b></td><td><input type='text' name='chdate' value='' size='12' />&nbsp;&nbsp;<input type='text' name='chtime' value='00:00' size='5' maxlength='5' /></td></tr>
    <tr><td><b>"._GAME."<span style='color:red;'>*</span> : </b></td><td>";
	if($conf['linkwars']){
		$text .= "<select name='game' id='gid' onchange='ChangeGame(this);'>";
		$sql->db_Select("clan_games","gname, gid", "inwars='1' ORDER BY gname");
		while($row = $sql->db_Fetch()){
			$gid = $row['gid'];
			$gname = $row['gname'];
			$text .= "<option value='$gid'>$gname</option>";
		}
		$text .= "</select>";
	}else{	
		$text .= "<input type='text' name='game' value='$game' size='15' maxlength='25'>";
	}
	$text .= "</td></tr>
	 <tr><td valign='top'><b>"._TEAMS."<span style='color:red;'>*</span> : </b></td><td>";
	if($conf['linkwars']){
		$sql->db_Select("clan_teams","team_name, tid", "inwars='1' ORDER BY team_name");
		while($row = $sql->db_Fetch()){
			$tid = $row['tid'];
			$tname = $row['team_name'];
			$text .= "<label><input type='checkbox' name='teams[]' value='$tid' />$tname</label><br />";
		}
	}else{	
		$text .= "<input type='hidden' name='teams[]' value='0' />";
	}
	$text .= "</td></tr>
    <tr><td><b>"._MAP.": </b></td><td><input type='text' name='map' id='mapname' value='$map' size='15' maxlength='25' /></td></tr>
    <tr><td><b>"._PLAYERS.": </b></td><td><input type='text' name='players' value='$players' size='2' maxlength='2' /></td></tr>

 	<tr><td colspan='2'><br /><span class='chaltitle'>"._SRVRINFO."</span></td></tr>
   <tr><td><b>"._IP.": </b></td><td><input type='text' name='serverip' value='$serverip' size='15' maxlength='25' /></td></tr>
   <tr><td><b>"._PW.": </b></td><td><input type='text' name='serverpw' value='$serverpw' size='15' maxlength='25' /></td></tr>

 	<tr><td colspan='2'><br /><span class='chaltitle'>"._OTHERINFO."</span></td></tr>
	<tr><td colspan='2'><textarea name='extra' cols='35' rows='5'>$extra</textarea><br /></td></tr>
	<tr>
	  <td colspan='2' style='text-align:left;'><br />"._FIELDSREQ."</td>
	</tr>
	<tr>
	  <td colspan='2' style='text-align:left;'><br /><input type='submit' name='submit' class='button' value='"._CHALLENGE."' /></td>
	</tr>
	</table>
    </form></td></tr></table></div>";
		
$ns->tablerender(_CHAUS, $text);
?>