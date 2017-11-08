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
<script type="text/javascript" src="includes/jquery.min.js"></script>
<script type="text/javascript" src="includes/date.js"></script>
<script type="text/javascript" src="includes/jquery.datePicker.js"></script>
<script type="text/javascript">
var chal_jq = jQuery;
Date.format = '<?php echo $conf['dateformat'];?>';
chal_jq(function() {
	chal_jq("input[name=chdate]").datepicker({dateFormat: "<?php echo str_replace("yyyy","yy", $conf['dateformat']);?>", minDate: new Date(<?php echo date("Y");?>, <?php echo date("m")-1;?>, <?php echo date("j");?>)});
});
function ChangeFlag(obj) {
	var cflag = document.getElementById("flag");
	cflag.src = "<?php echo e_IMAGE;?>clan/flags/"+obj.value+".png"
}
</script>
<?php
$username = (USERNAME != "USERNAME" ? USERNAME : "");
$sql->db_Select("user", "user_email", "user_id='".intval(USERID)."'");
$row = $sql->db_Fetch();
$email = $row['user_email'];

$text = "<center>
    <table id='challengetable'><tr><td>
	<form method=\"post\" action=\"challengeus.php?Challenge\">

    <table border='0' cellpadding='0' cellspacing='0'>
	<tr><td colspan='2'><font class='chaltitle'>"._URINFO."</font><br /></td></tr>
    <tr><td><b>"._NICK.": </b></td><td><input type='text' name='uname' value='$username' size=15 maxlenght='25'></td></tr>
    <tr><td><b>"._EMAIL.": </b></td><td><input type='text' name='email' value='$email' size=25 maxlength='50'></td></tr>
    <tr><td><b>"._MSN.": </b></td><td><input type='text' name='msn' value='$msn' size=25 maxlength='50'></td></tr>
    <tr><td><b>"._XFIRE.": </b></td><td><input type='text' name='xfire' value='$xfire' size=15 maxlength='50'></td></tr>
	
	<tr><td colspan='2'><br /><font class='chaltitle'>"._CLANINFO."</font></td></tr>
    <tr><td><b>"._TAG.": </b></td><td><input type='text' name='clantag' value='$clantag' size=15 maxlenght='15'></td></tr>
    <tr><td><b>"._NAME.": </b></td><td><input type='text' name='clanname' value='$clanname' size=25 maxlenght='25'></td></tr>
	<tr><td><b>"._SITE.": </b></td><td><input type='text' name='clansite' value='$clansite' size=25 maxlength='50'></td></tr>
	<tr><td><b>"._COUNTRY.": </b></td><td><select name='country' onChange='ChangeFlag(this);' id='country'>";

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

$text .= "</select> <img src='".e_IMAGE."clan/flags/Unknown.png' id='flag'></td></tr>	
	
	<tr><td colspan='2'><br /><font class='chaltitle'>"._MTCHINFO."</font></td></tr>
   <tr><td> <b>"._DATE.": </b></td><td><input type='text' name='chdate' value='$chdate' class='date-pick' size='12' maxlength='10' autocomplete='off'>&nbsp;&nbsp;<input type='text' name='chtime' value='00:00' size='5' maxlength='5'></td></tr>
    <tr><td><b>"._GAME.": </b></td><td>";
	if($conf['linkwars']){
		$text .= "<select name='game'>";
		$sql->db_Select("clan_games","gname, gid", "inwars='1' ORDER BY gname");
		while($row = $sql->db_Fetch()){
			$gid = $row['gid'];
			$gname = $row['gname'];
			$text .= "<option value='$gid'>$gname</option>";
		}
		$text .= "</select>";
	}else{	
		$text .= "<input type='text' name='game' value='$game' size='15' maxlenght='25'>";
	}
	$text .= "</td></tr>
    <tr><td><b>"._MAP.": </b></td><td><input type='text' name='map' value='$map' size='15' maxlenght='25'></td></tr>
    <tr><td><b>"._PLAYERS.": </b></td><td><input type='text' name='players' value='$players' size='2' maxlength='2'></td></tr>

 	<tr><td colspan='2'><br /><font class='chaltitle'>"._SRVRINFO."</font></td></tr>
   <tr><td><b>"._IP.": </b></td><td><input type='text' name='serverip' value='$serverip' size='15' maxlength='25'></td></tr>
   <tr><td><b>"._PW.": </b></td><td><input type='text' name='serverpw' value='$serverpw' size='15' maxlength='25'></td></tr>

 	<tr><td colspan='2'><br /><font class='chaltitle'>"._OTHERINFO."</font></td></tr>
	<tr><td colspan='2'><textarea name='extra' cols='35' rows='5'>$extra</textarea></td></tr>
	</table><br />
    <input type='submit' name='submit' class='button' value='"._CHALLENGE."'>
    </form></td></tr></table></center>";
		
$ns->tablerender(_CHAUS, $text);
?>