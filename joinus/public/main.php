<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.0                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!(defined('JOIN_PUB') && preg_match("/joinus\.php/i", $_SERVER['REQUEST_URI']))){
    die ("Access denied.");
}
?>
<style type="text/css">
	#jointable td{
		margin: 1px;
		padding: 1px;
		text-align: left;
	}
</style>
<?php
$username = (USERNAME != "USERNAME" ? USERNAME : "");
$sql->db_Select("user", "user_email", "user_id='".intval(USERID)."'");
$row = $sql->db_Fetch();
$email = $row['user_email'];
$text = "<center><table id='jointable' width='320'><tr><td>
	<form method=\"post\" action=\"joinus.php?Apply\">
	<table>";
if($conf['jointext'] !=""){
  $text .="<tr>
    <td style='text-align: center;' colspan='2'>".nl2br($conf['jointext'])."<br />&nbsp;</td>
  </tr>";
}
  $text .= "<tr>
    <td style='text-align: right;'><b>"._NICK."* :</b></td>
    <td><input type='text' name='uname' value='$username' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._LOCATION."* :</b></td>
    <td><input type='text' name='location' value='$location' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._EMAIL."* :</b></td>
    <td><input type='text' name='email' value='$email' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._XFIRE." :</b></td>
    <td><input type='text' name='xfire' value='$xfire' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._STEAM." :</b></td>
    <td><input type='text' name='steam' value='$steam' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._MSN." :</b></td>
    <td><input type='text' name='msn' value='$msn' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._AGE."* :</b></td>
    <td><input type='text' name='age' value='$age' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;vertical-align:top;'><b>"._APPLYF."* :</b></td>
    <td>";
	if($conf['linkmembers']){
		$sql->db_Select("clan_games","gname, gid", "inmembers='1' ORDER BY gname");
		while($row = $sql->db_Fetch()){
			$gid = $row['gid'];
			$gname = $row['gname'];
			$text .= "<label><input type='checkbox' name='games[]' value='$gid' />$gname</label><br />";
		}
	}else{	
		$text .= "<input type='text' name='apply' value='$apply' size=18>";
	}
	$text .= "</td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._PCLANS." : </b></td>
    <td><input type='text' name='clans' value='$clans' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._CONNSPEED."* :</b></td>
    <td><input type='text' name='conn' value='$conn' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._MICRO."* :</b></td>
    <td><select name ='micro'>
			<option value='1'>"._YES."</option>	
			<option value='0'>"._NO."</option>
		</select>
	</td>
  </tr>
  <tr>
    <td colspan='2'><br /><b>"._EXTRAINFO." :</b><br />
    <textarea name='extra' style='width: 100%;' rows=6 wrap=virtual>$extra</textarea>
	<br />
	</td>
  </tr>
  <tr>
    <td colspan='2' style='text-align:center;'><br />"._FIELDSREQ."</td>
  </tr>
  </table>
	</td></tr></table>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
    <input type='submit' name='submit' class='button' value='"._APPLY."'>
    </form></center>";
	
$ns->tablerender(_JOINUS, $text);
?>