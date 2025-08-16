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
if (!defined('CHAL_ADMIN') or !preg_match("/admin.php\?Config/i", $_SERVER['REQUEST_URI'])) {
    die ("Access denied.");
}
?>
<link rel="stylesheet" href="includes/jquery.autocomplete.css" />
<style type="text/css">
.warstitle{
	font-size:1.1em;
	font-weight: bold;
}
#configtable td{
	padding: 1px;
}
</style>
<script type="text/javascript" src="includes/jquery.min.js"></script>
<script type="text/javascript" src="includes/jquery.autocomplete.js"></script>
<script type="text/javascript">
	var join_jq = jQuery;
	var suredeluser = "<?php echo _WSUREDELUSER;?>";
</script>
<script type="text/javascript" src="includes/config.js"></script>

<?php
	$text =  "<center>
	<table align='center'><tr><td>		
	
	<form method='post' action='admin.php?SaveConfig'>
	<table cellspacing='1' cellpadding='3' border='0' width='300' id='configtable'>
	<tr>
		<td align='left' nowrap>"._MAILTO.":<br />Seperated by a comma \",\"</td>
		<td align='left'><textarea name='mailto' rows='3' cols='30'>".$conf['mailto']."</textarea></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._SENDMAIL.": </td>
		<td align='left'><label><input type='radio' name='sendmail' value='1' ".(($conf['sendmail'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='sendmail' value='0' ".(($conf['sendmail'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._MUSTREGISTER.": </td>
		<td align='left'><label><input type='radio' name='mustregister' value='1' ".(($conf['mustregister'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='mustregister' value='0' ".(($conf['mustregister'])?"":"checked").">"._NO."</label></td>
	</tr>";
	if (isset($pref['plug_installed']['clanwars'])){
		$text .= "<tr>
			<td align='left' nowrap>"._LINKWITHWARS.": </td>
			<td align='left'><label><input type='radio' name='linkwars' value='1' ".(($conf['linkwars'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='linkwars' value='0' ".(($conf['linkwars'])?"":"checked").">"._NO."</label></td>
		</tr>";
	}

	  $format = explode("/", $conf['dateformat']);	
	  $options = array("dd","mm","yyyy");
	  $text .= "<tr> 
		<td align='left'>"._DATEFORMAT.": </td>
		<td align='left' nowrap><select name='format1' id='format1' onchange='CheckFormat(1);'>";
			for($i=0;$i<=2;$i++){
				$sel = (($format[0] == $options[$i]) ? $sel="selected" : "");
				$text .= "<option $sel>".$options[$i]."</option>";
			}
			$text .= "</select>
			<select name='format2' id='format2' onchange='CheckFormat(2);'>";
				for($i=0;$i<=2;$i++){
					if($options[$i] != $format[0]){
						$sel = (($format[1] == $options[$i]) ? $sel="selected" : "");
						$text .= "<option $sel>".$options[$i]."</option>";
					}
				}
			$text .= "</select>
			<select name='format3' id='format3'>";
				for($i=0;$i<=2;$i++){
					if($options[$i] != $format[0] && $options[$i] != $format[1]){
						$sel = (($format[2] == $options[$i]) ? $sel="selected" : "");
						$text .= "<option $sel>".$options[$i]."</option>";
					}
				}
			$text .= "</select>
		</td>
	  </tr>";
	  $text .= "<tr>
		<td align='left' valign='top'>"._SPECIALPRIVS.":</td>
		<td align='left'><select multiple name='specialprivs' id='specialprivs' ondblclick='DelUser(this);' title='"._DBLCLCKTOREMOVE."' style='width:100%;height:70px;'>";
		$specialprivs = explode(",",$conf['specialprivs']);
		for($i=0;$i<count($specialprivs);$i++){
			if($specialprivs[$i]!=""){
				$text .= "<option>".$specialprivs[$i]."</option>";
			}
		}
		$text .= "</select></td>
	</tr>
	<tr>
		<td align='left'>"._ADDUSRTOLIST.":</td>
		<td align='left'><input id='newspecialprivs' name='newspecialprivs' value='".$conf['specialprivs']."' type='hidden'><input id='addtolist' type='text' style='width:96%;' title='"._CLCKONNAMETOADD."' onKeyPress='return submitenter(event);'></td>
	</tr>
	  <tr>
			<td align='left' colspan='2'>"._CHALLTEXT." (Danish): </td>
		</tr>
		<tr>
			<td align='left' colspan='2'><textarea name='textdanish' style='width:100%;height:80px;'>".$conf['textdanish']."</textarea></td>
		</tr>
		<tr>
			<td align='left' colspan='2'>"._CHALLTEXT." (English): </td>
		</tr>
		<tr>
			<td align='left' colspan='2'><textarea name='textenglish' style='width:100%;height:80px;'>".$conf['textenglish']."</textarea></td>
		</tr>
	  </table>	
	
	</td></tr>
	
	<tr><td>		
		
	<br /><br /><input type='submit' class='button' value='"._SAVECHANGES."'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
  </form>
  
  </td></tr></table></center>";
  
  $ns->tablerender(_CONFIG, $text);
	  
?>