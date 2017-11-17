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
<script type="text/javascript" src="includes/jquery.tablednd.js"></script>
<script type="text/javascript">
	<!--
	clanm_jq(document).ready(function() {
	clanm_jq('#ordertable').tableDnD({
			onDrop: function(table, row) {
				document.getElementById('orderorder').value = $.tableDnD.serialize();
			}
		});	
		clanm_jq('#infotable').tableDnD({
			onDrop: function(table, row) {
				document.getElementById('neworder').value = $.tableDnD.serialize();
			}
		});
		clanm_jq('#profiletable').tableDnD({
			onDrop: function(table, row) {
				document.getElementById('profileorder').value = $.tableDnD.serialize();
			}
		});
	});
	
	 clanm_jq(function() {
        clanm_jq("#hardware").jcollapser({target: '#hardwareorder', state: 'collapsed'});
        clanm_jq("#memberslist").jcollapser({target: '#listorder', state: 'collapsed'});
        clanm_jq("#ordertitle").jcollapser({target: '#orderlist', state: 'collapsed'});
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
	
	function checkProfile(obj) {
		if (obj.checked) {
			displayByName("profile","block",1,8);
			document.getElementById('gallery').style.display = "";
			if(document.getElementById('showuserimage').checked){
				displayByName("userimages","block",1,2);
				displayByName("userimages","block",5,6);
			}
			if(document.getElementById('enablegallery').checked){
				document.getElementById('galleryoptions').style.display = "";
			}
		} else {
			displayByName("profile","none",1,8);
			displayByName("userimages","none",5,6);
			document.getElementById('gallery').style.display = "none";
			document.getElementById('galleryoptions').style.display = "none";
			if(!document.getElementById('image').checked){
				displayByName("userimages","none",1,2);
			}
		}
	}
	
	function ShowHideGallery(obj) {
		if (obj.checked) {
			document.getElementById('galleryoptions').style.display = "";
		} else {
			document.getElementById('galleryoptions').style.display = "none";
		}
	}
	
	function checkProfileImage(obj) {
		if (obj.checked) {
			displayByName("userimages","block",1,2);
			displayByName("userimages","block",5,6);
		} else {
			displayByName("userimages","none",5,6);
			if(!document.getElementById('image').checked){
				displayByName("userimages","none",1,2);
			}
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
			displayByName("userimages","none",3,4);
			if(!document.getElementById('showuserimage').checked || !document.getElementById('enableprofile').checked){
				displayByName("userimages","none",1,2);
			}
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
					<td colspan='2' align='left'>
						<table border='0' cellpadding='0' cellspacing='1' width='95%'>
							<tr>
								<td align='left' nowrap>"._PAGETITLE.":&nbsp;</td>
								<td align='right'><input type='text' name='cmtitle' value='".$conf['cmtitle']."' style='width:95%;'></td>
							</tr>
						</table>
					</td>
				</tr>
									
				<tr>
					<td colspan='2'><label><input name='xrank_per_game' type='checkbox' value='1' ".($conf['rank_per_game']?"checked":"")." />"._DIFFERENTRANKPER.($conf['gamesorteams']=="Games"?_GAME:_TEAM)."</label><br /></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='guestviewcontactinfo' type='checkbox' value='1' ".($conf['guestviewcontactinfo']?"checked":"")." />"._GUESTVIEWCONTACTINFO."</label><br /></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='changeatdot' type='checkbox' value='1' ".($conf['changeatdot']?"checked":"")." />"._CHANGEATDOT."</label><br /></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='showview' type='checkbox' value='1' ".($conf['showview']?"checked":"")." />"._SHOWVIEW."</label><br /></td>
				</tr>
				<tr>
					<td colspan='2'><label><input name='showcontactlist' type='checkbox' value='1' ".($conf['showcontactlist']?"checked":"")." />"._SHOWCONTACTLIST."</label><br /></td>
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
				</tr>";
				$dot = explode("-",$conf['memberorder']);
				for($i=0;$i<count($dot);$i++){
					$dot[$i] = explode("|",$dot[$i]);
				}
				
				$text .= "<tr>
					<td colspan='2' align='left'>
					<div id='ordertitle'>
						<div class='collapse'><b>"._ORDERBY." -</b></div>
						<div class='expand'><b>"._ORDERBY." +</b></div>
					</div>
					<div id='orderlist'><b>"._DRAGDROPORDER."</b><br />
					<table id='ordertable' width='150' class='fborder tableleft'>";
						$ordertable = "";
						for($i=0;$i<count($dot);$i++){
							$option = $dot[$i][0];
							$text .= "<tr id='$option'>
								<td class='forumheader3'>
									<div>
										<div style='float:left;margin-top:4px;'>&nbsp;$option</div>
										<div style='float:right;'><select name='order$option'>
											<option".($dot[$i][1]=="ASC"?" selected":"").">ASC</option>
											<option".($dot[$i][1]=="DESC"?" selected":"").">DESC</option>
										</select></div>
									</div>
								</td>
							</tr>";
							$ordertable .= "&ordertable[]=".$option;
						}
					$text .= "</table></div>&nbsp;<br />
					</td>
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
						<div class="collapse"><b>'._LISTORDER.' -</b></div>
						<div class="expand"><b>'._LISTORDER.' +</b></div></div>';
				$listorder .= '<div id="listorder"><br /><b>'._DRAGDROPLIST.'</b><br />';
				$listorder .= "<table id='infotable' width='150' class='fborder tableleft'>";
				
				$check = 1;
				foreach($firstarray as $secondarray){
					foreach($secondarray as $infoname){
						if($infoname !=""){					
							$title = $infolang[$infoname];
							
							$infotable .= "&infotable[]=".$infoname;
							$chk = $check;
							$display = $disabled = "";
							if($infoname == "Username"){$chk = 1;$disabled = "disabled";}
							if($infoname == "User Image"){$display = "style='display:$visimg2;'";$disabled = "onClick=\"checkMaxSize(this)\"";}
							if(($infoname == "Last War" or $infoname == "Wars Played") && !isset($pref['plug_installed']['clanwars']))$display = "style='display:none;'";
							$idname = strtolower(str_replace(" ","",$infoname));
							$listorder .= "<tr id='$infoname' $display>
											<td class='forumheader3'><input name='info[$infoname]' id='list$idname' type='checkbox' value='1' $disabled ".($chk?"checked":"")." onmouseover=\"this.style.cursor='default'\">&nbsp;".$title."</td>
										</tr>";
						}
					}
					$check--;
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
		<tr>
			<td colspan='2'><label><input id='enableprofile' name='enableprofile' type='checkbox' value='1' ".($conf['enableprofile']?"checked":"")." onClick=\"checkProfile(this)\" />"._ENABLEMEMBERPROFILE."</label></td>";
			if($conf['enableprofile']) $showprofile = "block"; else $showprofile = "none";

		$text .= "</tr>
		<tr>
			<td>"._INACTIVEAFTER1."&nbsp;</td>
			<td><input type='text' size='3' maxlength='4' value='".$conf['inactiveafter']."' name='inactiveafter'> days</td>
		</tr>
		<tr>
			<td colspan='2'>"._INACTIVEAFTER2."&nbsp;</td>
		</tr>
		<tr id='profile1' style='display:$showprofile;'>
			<td colspan='2' align='left'><br /><b>"._MEMBERPROFILE."</b></td>
		</tr>
		<tr id='profile2' style='display:$showprofile;'>
			<td>"._ALIGNTITLESTO.":&nbsp;</td>
			<td><select name='profilealign'>";
			$sel0 = $sel1 = $sel2 = "";
			if($conf['profilealign'] == "left"){
				$sel0 = "selected";
			}elseif($conf['profilealign'] == "center"){
				$sel1 = "selected";
			}else{
				$sel2 = "selected";
			}
				$text .= "<option value='left' $sel0>"._LEFT."</option>";
				$text .= "<option value='center' $sel1>"._CENTER."</option>";
				$text .= "<option value='right' $sel2>"._RIGHT."</option>";
			
			$text .= "</select></td>
		</tr>
		<tr id='profile3' style='display:$showprofile;'>
			<td>"._LEFTSIDEWIDTH.":&nbsp;</td>
			<td><input type='text' size='3' maxlength='3' value='".$conf['leftsidewidth']."' name='leftsidewidth'> px</td>
		</tr>
		<tr id='profile4' style='display:$showprofile;'>
			<td colspan='2'><label><input name='profiletoguests' type='checkbox' value='1' ".($conf['profiletoguests']?"checked":"")." />"._SHOWPROFILETOGUESTS."</label></td>
		</tr>
		<tr id='profile5' style='display:$showprofile;'>
			<td colspan='2'><label><input name='enablehardware' type='checkbox' value='1' ".($conf['enablehardware']?"checked":"")." />"._ENABLEHARWPROFILE."</label></td>
		</tr>
		<tr id='gallery' style='display:$showprofile;'>
			<td colspan='2'><label><input id='enablegallery' name='enablegallery' type='checkbox' value='1' ".($conf['enablegallery']?"checked":"")." onClick=\"ShowHideGallery(this)\" />"._ENABLEGALLERY."</label>";
			$showgallery = "style='display:none;'";
			if($conf['enablegallery'] && $showprofile == "block"){
				$showgallery = "";
			}
		$text .= "</td>
		</tr>
		<tr id='profile6' style='display:$showprofile;'>
			<td colspan='2'><label><input name='showawards' type='checkbox' value='1' ".($conf['showawards']?"checked":"")." />"._SHOWMEMBERSAWARDS."</label></td>
		</tr>
		<tr id='profile7' style='display:$showprofile;'>
			<td colspan='2'><label><input id='showuserimage' name='showuserimage' type='checkbox' value='1' ".($conf['showuserimage']?"checked":"")." onClick=\"checkProfileImage(this)\" />"._SHOWUSRIMG."</label></td>";
			$showuimage = "none";
			if($conf['showuserimage'] && $showprofile == "block"){
				$showuimage = "block";
			}
		$text .= "</tr>";
		
//Drag and Drop	info
$text .= '<tr id="profile8" style="display:'.$showprofile.';">
		<td colspan="2">';	
	
	$profiletable = "";
	$firstarray = unserialize($conf['profileorder']);
	$profileorder = '<br /><div id="hardware">
			<div class="collapse"><b>'._PROFILEORDER.' -</b></div>
			<div class="expand"><b>'._PROFILEORDER.' +</b></div></div>';
	$profileorder .= '<div id="hardwareorder"><br /><b>'._DRAGDROPPROFILE.'</b><br />';
	$profileorder .= "<table id='profiletable' class='fborder tableleft' width='150'>";
	
	$check = 1;
	foreach($firstarray as $secondarray){
		foreach($secondarray as $infoname){
			if($infoname !=""){
				$title = $infolang[$infoname];
				
				$profiletable .= "&profiletable[]=".$infoname;
				$display = "";
				if(($infoname == "Last War" or $infoname == "Wars Played") && !isset($pref['plug_installed']['clanwars']))$display = "style='display:none;'";
				$profileorder .= "<tr id='$infoname' $display>
								<td class='forumheader3'><input name='profile[$infoname]' type='checkbox' value='1' $disabled ".($check?"checked":"")." onmouseover=\"this.style.cursor='default'\">&nbsp;".$title."</td>
							</tr>";
			}
		}
		$check--;
	}
	$profileorder .= "</table></div>";
	$text .= $profileorder;
	
	$text .= "</td>
	</tr>
	<tbody id='galleryoptions' $showgallery>
	<tr>
		<td colspan='2' align='left'><br /><br /><b>"._MEMBERSGALLERY."</b></td>
	</tr>
		<tr>
		<td>"._MAXIMGS.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='5' value='".$conf['maximages']."' name='maximages'></td>
	</tr>
	<tr>
		<td>"._MAXFILESIZE.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='10' value='".$conf['galfilesize']."' name='galfilesize'> kB</td>
	</tr>
	<tr>
		<td>"._THUMBWIDTH.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='4' value='".$conf['thumbwidth']."' name='thumbwidth'> px</td>
	</tr>
	</tbody>
	
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
	<tr id='userimages5' style='display:$showuimage;'>
		<td>"._PROFILEMAXWIDTH.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='10' value='".$conf['profileimgwidth']."' name='profileimgwidth'> px</td>
	</tr>
	<tr id='userimages6' style='display:$showuimage;'>
		<td>"._PROFILEMAXHEIGHT.":&nbsp;</td>
		<td><input type='text' size='3' maxlength='10' value='".$conf['profileimgheight']."' name='profileimgheight'> px</td>
	</tr>";
	if(file_exists("admin/config_custom.php")){
		define('CUSTOM_CONFIG',true);
		include "admin/config_custom.php";
	}
$text .= "</table></div>";

$text .= "<br /><br /><input type='hidden' name='orderorder' id='orderorder' value='".substr($ordertable,1)."'>
	<input type='hidden' name='neworder' id='neworder' value='".substr($infotable,1)."'>
	<input type='hidden' name='profileorder' id='profileorder' value='".substr($profiletable,1)."''>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='submit' class='button' value='"._SAVECHANGES."'>
</form>";
$text .= "</td></tr></table></center>";

$ns->tablerender(_CONFIG, $text);

?>