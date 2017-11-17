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

if (!defined('WARS_ADMIN') or !preg_match("/admin.php\?Config/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
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
	var wars_jq = jQuery;
	//LANG
	var suredelallcomms = "<?php echo _WSUREDELALLCOMMS;?>";
	var allcommsdel = "<?php echo _WALLCOMMSDEL;?>";
	var errordelcomms = "<?php echo _WERRDELCOMMS;?>";
	var suredeluser = "<?php echo _WSUREDELUSER;?>";
	var suredelallcomms = "<?php echo _WSUREDELALLCOMMS;?>";
	var suredelallcomms = "<?php echo _WSUREDELALLCOMMS;?>";
	var suredelallcomms = "<?php echo _WSUREDELALLCOMMS;?>";
	var suredelallcomms = "<?php echo _WSUREDELALLCOMMS;?>";
	
</script>
<script type="text/javascript" src="includes/config.js"></script>

<?php
	$text =  "<center>
	<table align='center'><tr><td>		
	
	<form method='post' action='admin.php?SaveConfig'>
	<table cellspacing='1' cellpadding='3' border='0' width='300' id='configtable'>
	<tr> 
		<td align='left' colspan='2'><b><font class='warstitle'>"._WGENERAL."</font></b></td>
	</tr>		   
	<tr> 
		<td align='left'>"._WWARSPP.": </td>
		<td align='left'><input type='text' name='rowsperpage' value='".$conf['rowsperpage']."' size='5' maxlength='3'></td>
	  </tr>
	  
	<tr>
		<td align='left' nowrap>"._WBOXTEXT.": </td>
	<td align='left' nowrap><label><input type='radio' name='colorbox' value='1' ".(($conf['colorbox'])?"checked":"").">"._WBOXES."</label>&nbsp;&nbsp;<label><input type='radio' name='colorbox' value='0' ".(($conf['colorbox'])?"":"checked").">"._WTEXT."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._WSHOWIPPASS.": </td>
		<td align='left'><label><input type='radio' name='showip' value='1' ".(($conf['showip'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='showip' value='0' ".(($conf['showip'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._WSEPNEXFIN.": </td>
		<td align='left'><label><input type='radio' name='seperate' value='1' ".(($conf['seperate'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='seperate' value='0' ".(($conf['seperate'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._WSHOWREAMSFLAG.": </td>
		<td align='left'><label><input type='radio' name='showteamflag' value='1' ".(($conf['showteamflag'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='showteamflag' value='0' ".(($conf['showteamflag'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._WSHOWWARSSUMM.": </td>
		<td align='left'><label><input type='radio' name='warssummary' value='1' ".(($conf['warssummary'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='warssummary' value='0' ".(($conf['warssummary'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr> 
		<td colspan='2' align='left'>"._WCANLINEUPSUBVIEW."</td>
	</tr>
	<tr>
		<td align='left'>"._WTABLENAME.": </td>
		<td align='left'><input type='text' name='tablename' id='tablename' value='".$conf['tablename']."' size='25' maxlength='100' /></td>
	</tr>
	<tr> 
		<td align='left'>"._WFIELDNAME.": </td>
		<td align='left'><input type='text' name='fieldname' id='fieldname' value='".$conf['fieldname']."' size='15' maxlength='100' /></td>
	</tr>
	 
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WDATEFORMATS."</td>
	</tr>";
	  $format = explode("/", $conf['dateformat']);	
	  $options = array("dd","mm","yyyy");
	  $text .= "<tr> 
		<td align='left'>"._WEDITWAR.": </td>
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
	  </tr>
	  <tr> 
		<td align='left'>"._WWARSLIST.":</td>
		<td align='left'><input type='text' name='formatlist' value='".$conf['formatlist']."' size='15' maxlength='20'></td>
	</tr>
	<tr> 
		<td align='left'>"._WWARDETAILS.":</td>
		<td align='left'><input type='text' name='formatdetails' value='".$conf['formatdetails']."' size='15' maxlength='20'></td>
	</tr>
	<tr> 
		<td align='left'>"._WWARSBLOCK.":</td>
		<td align='left'><input type='text' name='formatblock' value='".$conf['formatblock']."' size='15' maxlength='20'></td>
	</tr>
	<tr>
		<td align='left'>"._WARROWCLR.":</td>
		<td align='left'><select name='arrowcolor'>
			<option ".(($conf['arrowcolor'] == "Black")?"selected":"").">"._WBLCK."</option>
			<option ".(($conf['arrowcolor'] == "White")?"selected":"").">"._WWHT."</option>
		</select></td>
	</tr>
	
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WSPECPRIV."</font></b></td>
	</tr>
	<tr>
		<td align='left' valign='top'>"._WUSERSCANADDWARS.":</td>
		<td align='left'><select multiple name='addwarlist' id='addwarlist' ondblclick='DelUser(this);' title='"._WDBLCLCKTOREMOVE."' style='width:100%;height:70px;'>";
		$addwarlist = explode(",",$conf['addwarlist']);
		for($i=0;$i<count($addwarlist);$i++){
			if($addwarlist[$i]!=""){
				$text .= "<option>".$addwarlist[$i]."</option>";
			}
		}
		$text .= "</select></td>
	</tr>
	<tr>
		<td align='left'>"._WADDUSRTOLIST.":</td>
		<td align='left'><input id='newaddwarlist' name='newaddwarlist' value='".$conf['addwarlist']."' type='hidden'><input id='addtolist' type='text' style='width:96%;' title='"._WCLCKONNAMETOADD."' onKeyPress='return submitenter(event);'></td>
	</tr>
	<tr>
		<td align='left'>"._WEDITWARSTOO.": </td>
		<td align='left'><label><input type='radio' name='caneditwar' value='1' ".(($conf['caneditwar'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='caneditwar' value='0' ".(($conf['caneditwar'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left'>"._REQUIREAPPROVAL.": </td>
		<td align='left'><label><input type='radio' name='requireapproval' value='1' ".(($conf['requireapproval'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='requireapproval' value='0' ".(($conf['requireapproval'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WWARSMAIL."</font></b></td>
	</tr>
	<tr>
		<td align='left'>"._WENABLEWMAIL.": </td>
		<td align='left'><label onclick='ChangeMail();'><input type='radio' name='enablemail' id='enablemail' value='1' ".(($conf['enablemail'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label onclick='ChangeMail();'><input type='radio' name='enablemail' value='0' ".(($conf['enablemail'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr id='warsmail1' ".(($conf['enablemail'])?"":"style='display:none;'").">
		<td align='left'>"._WALLOWSUB.": </td>
		<td align='left'><label><input type='radio' name='allowsubscr' value='1' ".(($conf['allowsubscr'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='allowsubscr' value='0' ".(($conf['allowsubscr'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr id='warsmail2' ".(($conf['enablemail'])?"":"style='display:none;'").">
		<td align='left'>"._WUSEACT.": </td>
		<td align='left'><label><input type='radio' name='emailact' value='1' ".(($conf['emailact'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='emailact' value='0' ".(($conf['emailact'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr id='warsmail3' ".(($conf['enablemail'])?"":"style='display:none;'").">
		<td align='left'>"._WSENDMAIL.": </td>
		<td align='left'><label><input type='radio' name='sendmail' value='1' ".(($conf['sendmail'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='sendmail' value='0' ".(($conf['sendmail'])?"":"checked").">"._NO."</label></td>		
	</tr>
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WMAPSSS."</font></b></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._MAPMUSTMATCH.": </td>
		<td align='left'><label><input type='radio' name='mapmustmatch' value='1' ".(($conf['mapmustmatch'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='mapmustmatch' value='0' ".(($conf['mapmustmatch'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._SCOREPERMAP.": </td>
		<td align='left'><label><input type='radio' name='scorepermap' value='1' ".(($conf['scorepermap'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='scorepermap' value='0' ".(($conf['scorepermap'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._AUTOCALCSCORE.": </td>
		<td align='left'><label><input type='radio' name='autocalcscore' value='1' ".(($conf['autocalcscore'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='autocalcscore' value='0' ".(($conf['autocalcscore'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr> 
		<td align='left'>"._MAPSPERROW.": </td>
		<td align='left'><input type='text' name='mapsperrow' value='".$conf['mapsperrow']."' size='5' maxlength='1'></td>
	</tr>
	<tr> 
		<td align='left'>"._MAPSIMGWIDTH.": </td>
		<td align='left'><input type='text' name='mapwidth' value='".$conf['mapwidth']."' size='5' maxlength='3'> px</td>
	</tr>
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WLINEUP."</font></b></td>
	</tr>
	<tr>			
		<td align='left'>"._WENABLELINEUP.": </td>
		<td align='left'><label onclick='ChangeLineUp();'><input type='radio' name='enablelineup' id='enablelineup' value='1' ".(($conf['enablelineup'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label onclick='ChangeLineUp();'><input type='radio' name='enablelineup' value='0' ".(($conf['enablelineup'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr id='lineup1' ".(($conf['enablelineup'])?"":"style='display:none;'").">
		<td align='left'>"._WGUESTLINEUP.": </td>
		<td align='left'><label><input type='radio' name='guestlineup' value='1' ".(($conf['guestlineup'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='guestlineup' value='0' ".(($conf['guestlineup'])?"":"checked").">"._NO."</label></td>
	</tr>		  
	<tr id='lineup2' ".(($conf['enablelineup'])?"":"style='display:none;'").">
		<td align='left'>"._WUSESUBS.": </td>
		<td align='left'><label><input type='radio' name='usesubs' value='1' ".(($conf['usesubs'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='usesubs' value='0' ".(($conf['usesubs'])?"":"checked").">"._NO."</label></td>
	</tr>	
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WSCRSHOTS."</font></b></td>
	</tr>
	<tr> 
		<td align='left'>"._WSCRSPERROW.": </td>
		<td align='left'><input type='text' name='screensperrow' value='".$conf['screensperrow']."' size='5' maxlength='2'></td>
	</tr>
	<tr> 
		<td align='left'>"._WSCRMAX.": </td>
		<td align='left'><input type='text' name='kbsize' value='".($conf['screenmaxsize'] / 1024)."' size='5' maxlength='12'> kB</td>
	</tr>
	<tr>
		<td align='left'>"._WRESIZESCRS.": </td>
		<td align='left'><label onclick='ChangeScreens();'><input type='radio' name='resizescreens' id='resizescreens' value='1' ".(($conf['resizescreens'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label onclick='ChangeScreens();'><input type='radio' name='resizescreens' value='0' ".(($conf['resizescreens'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left'>"._WCREATETHUMBS.": </td>
		<td align='left'><label><input type='radio' name='createthumbs' value='1' ".(($conf['createthumbs'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='createthumbs' value='0' ".(($conf['createthumbs'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr id='resizewidth1' ".(($conf['resizescreens'])?"":"style='display:none;'")."> 
		<td align='left'>"._WWIDTHRESIZED.": </td>
		<td align='left'><input type='text' name='resizedwidth' value='".$conf['resizedwidth']."' size='5' maxlength='4'> px</td>
	</tr>
	<tr> 
		<td align='left'>"._WWIDTHTHUMB.": </td>
		<td align='left'><input type='text' name='thumbwidth' value='".$conf['thumbwidth']."' size='5' maxlength='3'> px</td>
	</tr>		
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WCOMS."</font></b></td>
	</tr>
	<tr>
		<td align='left'>"._WENABLECOMS.": </td>
		<td align='left'><label onclick='ChangeComments();'><input type='radio' name='enablecomments' id='enablecomments' value='1' ".(($conf['enablecomments'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label onclick='ChangeComments();'><input type='radio' name='enablecomments' value='0' ".(($conf['enablecomments'])?"":"checked").">"._NO."</label></td>
	  </tr>
	  <tr id='comments1' ".(($conf['enablecomments'])?"":"style='display:none;'").">
		<td align='left' nowrap>"._WGUESTSEECOMS.": </td>
		<td align='left'><label><input type='radio' name='guestcomments' value='1' ".(($conf['guestcomments'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='guestcomments' value='0' ".(($conf['guestcomments'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left'>"._WDELALLCOMS."</td>
		<td align='left'><label onclick='DelAllComments();'><input type='radio' name='dellallcomms' value='1'>"._YES."&nbsp;&nbsp;<label><input type='radio' name='dellallcomms' value='0' checked id='delallcomms'>"._NO." </td>
	</tr>	
	<tr> 
		<td align='left' colspan='2'><br /><b><font class='warstitle'>"._WEDITWPAGE."</font></b></td>
	</tr>
	<tr>
		<td align='left'>"._WSHOWSERVER.":</td>
		<td align='left'><select name='stateserver'><option ".(($conf['stateserver'])?"selected":"")." value='1'>"._WOPENEND."</option><option ".(($conf['stateserver'])?"":"selected")." value='0'>"._WCLOSD."</option></td>
	</tr>
	<tr>
		<td align='left'>"._WSHOWREPORT.":</td>
		<td align='left'><select name='statereport'><option ".(($conf['statereport'])?"selected":"")." value='1'>"._WOPENEND."</option><option ".(($conf['statereport'])?"":"selected")." value='0'>"._WCLOSD."</option></td>
	</tr>
	<tr>
		<td align='left'>"._WSHOWMPAS.":</td>
		<td align='left'><select name='statemaps'><option ".(($conf['statemaps'])?"selected":"")." value='1'>"._WOPENEND."</option><option ".(($conf['statemaps'])?"":"selected")." value='0'>"._WCLOSD."</option></td>
	</tr>
	<tr>
		<td align='left'>"._WSHOWLU.":</td>
		<td align='left'><select name='statelineup'><option ".(($conf['statelineup'])?"selected":"")." value='1'>"._WOPENEND."</option><option ".(($conf['statelineup'])?"":"selected")." value='0'>"._WCLOSD."</option></td>
	</tr>
	<tr>
		<td align='left'>"._WSHOWSCRS.":</td>
		<td align='left'><select name='statescreens'><option ".(($conf['statescreens'])?"selected":"")." value='1'>"._WOPENEND."</option><option ".(($conf['statescreens'])?"":"selected")." value='0'>"._WCLOSD."</option></td>
	</tr>
	<tr>
		<td align='left'>"._WSHOWCOMMS.":</td>
		<td align='left'><select name='statecomments'><option ".(($conf['statecomments'])?"selected":"")." value='1'>"._WOPENEND."</option><option ".(($conf['statecomments'])?"":"selected")." value='0'>"._WCLOSD."</option></td>
	</tr>
	</table>	
	
	</td></tr>
	
	<tr><td>		
		
	<br /><br /><input type='submit' class='button' value='"._SAVECHANGES."'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
  </form>
  
  </td></tr></table></center>";
  
  $ns->tablerender(_WCONFIGWARS, $text);
	  
?>