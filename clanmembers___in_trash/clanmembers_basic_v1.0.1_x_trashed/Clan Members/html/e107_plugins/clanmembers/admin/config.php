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

?>

<style type="text/css">
.collapse{
	cursor:pointer;
}

.expand{
	display:none;
	cursor:pointer;
}
.tableleft{
	margin: 5px;
	float: left;
}
</style>
<script type="text/javascript" src="includes/jquery.jcollapser.js"></script>
<script type="text/javascript">
	<!--
	 clanm_jq(function() {
        clanm_jq("#memberslist").jcollapser({target: '#listorder', state: 'collapsed'});
    });	
	
	function displayByName(obj, vis, start, end){
		for(i=start;i<=end;i++){
			document.getElementById(obj+i).style.display = vis;
		}
	}
	
	function checkForOther(obj) {
		if (obj.value == "0") {
			document.getElementById("showusrmg1").style.display = "none";
			document.getElementById("User Image").style.display = "inline";
			document.getElementById("alignment").style.display = "inline";
			document.getElementById("perrow").style.display = "none";
		} else {
			document.getElementById("showusrmg1").style.display = "inline";
			document.getElementById("User Image").style.display = "none";
			document.getElementById("alignment").style.display = "none";
			document.getElementById("perrow").style.display = "block";
		}
	}
	
	function checkMaxSize(obj) {			
		if(obj.id == document.configform.image.id){
			if(document.configform.image.checked){
				document.getElementById('listuserimage').checked = true;
			}else{
				document.getElementById('listuserimage').checked = false;
			}
		}else{
			if(document.getElementById('listuserimage').checked){
				document.configform.image.checked = true
			}else{
				document.configform.image.checked = false
			}
		}
		
		if (obj.checked) {
			displayByName("userimages","block",1,4);
		} else {
			displayByName("userimages","none",1,4);
		}
	}	
//-->
</script> 	
        <?php

	$text = "<center><table><tr><td align='left'>";
	$text .= "<form action='admin.php?saveconfig' method='post' name='configform'>";
		$text .= "<table border='0' cellpadding='0' cellspacing='1'>
				<tr>
					<td colspan='2' align='left'><b>"._GENERAL."</b></td>
				</tr>				
				<tr>
					<td colspan='2'><label><input name='guestviewcontactinfo' type='checkbox' value='1' ".($conf['guestviewcontactinfo']?"checked":"")." />"._GUESTVIEWCONTACTINFO."</label><br /></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='changeatdot' type='checkbox' value='1' ".($conf['changeatdot']?"checked":"")." />"._CHANGEATDOT."</label><br /></td>
				</tr>
								
				<tr>
					<td colspan='2' align='left'><br /><b>"._CLANMLIST."</b></td>
				</tr>
				<tr>
					<td>"._GROUPBY.":&nbsp;</td>
					<td><select name='gamesorteams'>
						<option value='Games' ".($conf['gamesorteams'] == "Games"?"selected":"").">"._INFOGames."</option>
						<option value='Teams' ".($conf['gamesorteams'] == "Games"?"":"selected").">"._INFOTeams."</option>
					</select></td>
				</tr>
				<tr>
					<td>"._LISTSTYLE.":&nbsp;</td>
					<td align='left'><select name='style' onchange=\"checkForOther(this)\">";
			if($conf['style'] == 0){
				$sel0 = "selected";
				$sel1 = "";
				$visimg1 = "none";
				$visimg2 = "inline";
				$visalign = "inline";
				$showperrow = "none";
			}else{
				$sel0 = "";
				$sel1 = "selected";
				$visimg1 = "inline";
				$visimg2 = "none";
				$visalign = "none";
				$showperrow = "inline";
			}
				$text .= "<option value='0' $sel0>"._LIST."</option>";
				$text .= "<option value='1' $sel1>"._BLOCKS."</option>";
			
				$text .= "</select></td>
				</tr>";
			$text .= "<tr id='alignment' style='display: $visalign'>
					<td>"._ALIGNLISTTITLESTO.":&nbsp;</td>
					<td><select name='titlealign'>";
			$sel0 = $sel1 = $sel2 = "";
			if($conf['titlealign'] == "left"){
				$sel0 = "selected";
			}elseif($conf['titlealign'] == "center"){
				$sel1 = "selected";
			}else{
				$sel2 = "selected";
			}
				$text .= "<option value='left' $sel0>"._LEFT."</option>";
				$text .= "<option value='center' $sel1>"._CENTER."</option>";
				$text .= "<option value='right' $sel2>"._RIGHT."</option>";
			
			$text .= "</select></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='xshow_opened' type='checkbox' value='1' ".($conf['show_opened']?"checked":"")." />"._SHOWOPENED."</label><br /></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='xshow_gname' type='checkbox' value='1' ".($conf['show_gname']?"checked":"")." />".($conf['gamesorteams']=="Games"?_SHOWGAMENAMEBANNER:_SHOWTEAMNAMEBANNER)."</label><br /></td>
				</tr>
				<tr id='showusrmg1' style='display:$visimg1;'>
					<td colspan='2'>";
			
			if(VisibleInfo("User Image")){
				$text .= "<label><input name='listuserimage' type='checkbox' value='1' checked onClick=\"checkMaxSize(this)\" id='image' />"._SHOWUSRIMG."</label><br />";
				$showmax = "block";
			}else{
				$text .= "<label><input name='listuserimage' type='checkbox' value='1' onClick=\"checkMaxSize(this)\" id='image' />"._SHOWUSRIMG."</label><br />";
				$showmax = "none";
			}
				$text .= "</td>
				</tr>
				<tr>
					<td>"._LISTWIDTH.":&nbsp;</td>
					<td><input type='text' size='3' maxlength='4' value='".$conf['listwidth']."' name='listwidth'> px</td>
				</tr>
				<tr>
					<td>"._GIMAGEPADDING.":&nbsp;</td>
					<td><input type='text' size='3' maxlength='2' value='".$conf['padding']."' name='padding'> px</td>
				</tr>
				<tr id='perrow' style='display:$showperrow;'>
					<td>"._MEMBERSPERROW.":&nbsp;</td>
					<td><input type='text' size='3' maxlength='2' value='".$conf['membersperrow']."' name='xmembersperrow'></td>
				</tr>
				<tr>
					<td colspan='2'>";
					
			//Drag and Drop	info
				$infotable = "";
				$firstarray = unserialize($conf['listorder']);
				$listorder = '<br /><div id="memberslist">
						<div class="collapse"><b>List Items -</b></div>
						<div class="expand"><b>List Items +</b></div></div>';
				$listorder .= '<div id="listorder"><br />';
				$listorder .= "<table width='150' class='fborder tableleft'>";
				
				$items = array("Username", "Rank", "Rank Image", "Realname", "Gender", "Birthday", "Age", "Country", "Location", "User Image", "Xfire", "Steam ID", "Join Date", "Games", "Teams", "Activity");
				$hide = array("Activity", "Rank", "Rank Image", "Last War", "Wars Played");
				foreach($items as $infoname){
					if($infoname !=""){					
						$title = $infolang[$infoname];
						
						$infotable .= "&infotable[]=".$infoname;
						$chk = (in_array($infoname, $firstarray["show"])?1:0);
						$display = $disabled = "";
						if($infoname == "Username"){$chk = 1;$disabled = "disabled";}
						if($infoname == "User Image"){$display = "style='display:$visimg2;'";$disabled = "onClick=\"checkMaxSize(this)\"";}
						if(in_array($infoname, $hide)){$display = "style='display:none;'";$chk=0;}
						$idname = strtolower(str_replace(" ","",$infoname));
						$listorder .= "<tr id='$infoname' $display>
										<td class='forumheader3'><input name='info[$infoname]' id='list$idname' type='checkbox' value='1' $disabled ".($chk?"checked":"")." onmouseover=\"this.style.cursor='default'\">&nbsp;".$title."</td>
									</tr>";
					}
				}
		
				$listorder .= '</table></div>';
				$text .= $listorder;
					
				$text .= "</td>
				</tr>				
				<tr>
					<td colspan='2' align='left'><br /><b>"._DATEFORMATS."</b> (<a href='http://php.net/manual/en/function.date.php' target='_blank'>"._EXAMPLES."</a>)</td>
				</tr>
				<tr>
					<td>"._JOINFORMAT.":&nbsp;</td>
					<td><input type='text' size='6' maxlength='25' value='".$conf['joinformat']."' name='joinformat'></td>
				</tr>
				<tr>
					<td>"._BDAYFORMAT.":&nbsp;</td>
					<td><input type='text' size='6' maxlength='25' value='".$conf['birthformat']."' name='birthformat'></td>
				</tr>";
				

	//Member profile
	$text .= "<tr>
			<td colspan='2' align='left'><br /><b"._MEMBERINFO."</b></td>
		</tr>
		<tr>
			<td colspan='2'><label><input name='xallowchangeinfo' type='checkbox' value='1' ".($conf['allowchangeinfo']?"checked":"")." />"._ALLOWMEMBERCHANGEINFO."</label><br /></td>
		</tr>
		<tr>
			<td colspan='2'><label><input name='xallowupimage' type='checkbox' value='1' ".($conf['allowupimage']?"checked":"")." />"._ALLOWMEMBERUPLIMG."</label><br />";
			if($conf['allowupimage'])$showup = "block"; else $showup = "none";
			$text .= "</td>
		</tr>
	<tr id='userimages1' style='display:$showmax;'>
		<td colspan='2' align='left'><br /><b>"._USERIMGS."</b></td>
	</tr>
	<tr id='userimages2' style='display:$showmax;'>
		<td>"._MAXFILESIZE.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='5' value='".$conf['maxfilesize']."' name='maxfilesize'> kB</td>
	</tr>
	<tr id='userimages3' style='display:$showmax;'>
		<td>"._LISTMAXWIDTH.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='3' value='".$conf['maxwidth']."' name='maxwidth'> px</td>
	</tr>
	<tr id='userimages4' style='display:$showmax;'>
		<td>"._LISTMAXHEIGHT.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='3' value='".$conf['maxheight']."' name='maxheight'> px</td>
	</tr>
	</table></div>";

$text .= "<br /><br />
	<input type='hidden' name='neworder' id='neworder' value='".substr($infotable,1)."'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='submit' class='button' value='"._SAVECHANGES."'>
</form>";
$text .= "</td></tr></table></center>";

$ns->tablerender(_CONFIG, $text);

?>