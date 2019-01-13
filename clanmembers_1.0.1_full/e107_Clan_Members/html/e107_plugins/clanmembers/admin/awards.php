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
	.showpointer{
		border:0;
		cursor:default;
	}
	#awardstable td{
		vertical-align: middle;
		text-align:center;
	}
	</style>
	<script type="text/javascript" src="includes/jquery.tablednd.js"></script>
	<script type="text/javascript">
	clanm_jq(document).ready(function() {
	clanm_jq('#awardstable').tableDnD({
			onDrop: function(table, row) {
				document.getElementById('neworder').value = $.tableDnD.serialize();
				document.forms["awardform"].submit(); 				
			}
		});
	});
	
	function DelAward(id){
		var sure = confirm("<?php echo _SUREDELAWARD;?>");
		if(sure){
			top.cmupdate.document.location = "admin.php?delaward&rid="+id;
			document.getElementById(id).style.display = "none";
		}
	}
	
	function CheckForm(){
		if(document.getElementById('awardtitle').value !=""){
			return true;
		}else{
			alert("<?php echo _FILLINTITLE;?>");
			return false;
		}
	}
	function EnableGive(){
		var field = document.giveaward.elements
		var enable = false
		var i;
		for(i=0;i<field.length;i++){
			if(field[i].checked){
				enable = true;
			}
		}
		if(enable){
			document.getElementById('give1').disabled = false;
			document.getElementById('give2').disabled = false;
		}else{
			document.getElementById('give1').disabled = true;
			document.getElementById('give2').disabled = true;
		}
	}
	</script>
	
	<?php

	
	$text = "<form action='admin.php?AddAward' method='post' enctype='multipart/form-data' onSubmit='return CheckForm();'>
	<table border='0' cellpadding='0' cellspacing='2'>
		<tr>
			<td align='left'>"._TITLE.": </td>
			<td align='left'><input id='awardtitle' type='text' name='awardtitle' maxlength='40'></td>
		</tr>
		<tr>
			<td align='left'>"._DESCR.": </td>
			<td align='left'><textarea name='awarddescription' rows='6'></textarea></td>
		</tr>
		<tr>
			<td align='left'>"._IMG.": </td>
			<td align='left'><input type='file' name='awardimage' size='15' ></td>
		</tr><tr>
			<td align='left' colspan='1'><input type='submit' class='button' name='submit' value='"._ADDAWARD."'> </td>
		</tr>
	</table>
	
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form>";
	
	$ns->tablerender(_ADDAWARD, $text);
	
if($sql->db_Count("clan_members_awards") > 0){
	
	//Edit awards	
	$text = "<form method='post' action='admin.php?giveaward' name='giveaward'>
	<div align='right'><input type='submit' class='button' value='"._GIVEAWARDS."' title='"._CHECKAWARDSFIRST."' id='give1' disabled style='margin-bottom:2px;'></div>";
	$text .= "<table id='awardstable' style='".ADMIN_WIDTH."' class='fborder'>";
	$result = $sql->db_Select("clan_members_awards", "*", "ORDER BY position ASC", "");
	while($row = $sql->db_Fetch()){
		$rid = $row['rid'];
		$title = $row['title'];
		$description = $row['description'];
		$image = $row['image'];
		$position = $row['position'];
		
		$img = "";
		if(file_exists("images/Awards/$image") && $image !=""){
			$img = "<img src='images/Awards/$image' class='showpointer'>";
		}

	$text .= "<tr id='$rid'>
			<td class='forumheader3' width='10'><input type='checkbox' name='cmawards[]' value='$rid' style='cursor:pointer;' onClick='EnableGive();'></td>
			<td class='forumheader3'>$title</td>
			<td class='forumheader3'>$description</td>
			<td class='forumheader3'>$img</td>			
			<td class='forumheader3' width='10' nowrap><input type='button' class='button' value='"._EDIT."' onclick=\"window.location='admin.php?editaward&rid=$rid'\">&nbsp;<input type='button' class='button' value='"._DEL."' onclick=\"DelAward('$rid');\"></td>
		</tr>";
	}
	$text .= "</table>";
	$text .= "<div align='right'><input type='submit' class='button' value='"._GIVEAWARDS."' title='"._CHECKAWARDSFIRST."' id='give2' disabled style='margin-top:2px;'></div>
		<input type='hidden' name='e-token' value='".e_TOKEN."' />
		</form>";
	$text .= "<form id='awardform' method='post' action='admin.php?saveawardorder' target='cmupdate'>
	<input type='hidden' name='neworder' id='neworder' value=''>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form>";
	
	$ns->tablerender(_AWARDS, $text);

	echo '<iframe name="cmupdate" id="cmupdate" style="width:0;height:0;display:none;" src="#"></iframe>';
}
?>