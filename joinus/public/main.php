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
$text = "<center><table id='jointable' width='370'><tr><td>
	<form method=\"post\" action=\"joinus.php?Apply\">
	<table>";
if($conf['jointext'] !=""){
  $text .="<tr>
    <td style='text-align: center;' colspan='2'>".nl2br($conf['jointext'])."<br />&nbsp;</td>
  </tr>";
}
  $text .= "<tr>
    <td style='text-align: right;'><b>"._NICK."<span style='color:red;'>*</span> :</b></td>
    <td><input type='text' name='uname' value='$username' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._LOCATION."<span style='color:red;'>*</span> :</b></td>
    <td><input type='text' name='location' value='$location' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._EMAIL."<span style='color:red;'>*</span> :</b></td>
    <td><input type='text' name='email' value='$email' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._STEAM."<span style='color:red;'>*</span> :</b></td>
    <td><input type='text' name='steam' value='$steam' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'><b>"._CONNSPEED."<span style='color:red;'>*</span> :</b></td>
    <td><input type='text' name='conn' value='$conn' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._AGE."<span style='color:red;'>*</span> :</b></td>
    <td><input type='text' name='age' value='$age' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._PCLANS." : </b></td>
    <td><input type='text' name='clans' value='$clans' size=18></td>
  </tr>
  <tr>
    <td style='text-align: right;'>&nbsp;<b>"._MICRO."<span style='color:red;'>*</span> :</b></td>
    <td><select name ='micro'>
      <option value='5'>"._COD."</option>
      <option value='4'>"._LOL."</option>
      <option value='3'>"._TITAN."</option>
      <option value='2'>"._BF."</option>
			<option value='1'>"._CSGO."</option>	
			<option value='0'>"._ANDET."</option>
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