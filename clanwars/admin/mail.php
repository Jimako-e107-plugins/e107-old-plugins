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

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?Mail/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}
?>
<link rel="stylesheet" href="includes/warsmail.css" />
<script type="text/javascript">
	//LANG
	var edittext = "<?php echo _WEDIT;?>";
	var deltext = "<?php echo _WDEL;?>";
	var savetext = "<?php echo _WSAVE;?>";
	var canceltext = "<?php echo _WCANCEL;?>";
	var fillinusername = "<?php echo _WFILLINUSERNAME;?>";
	var entervalidmail = "<?php echo _WENTERVALIGMAIL;?>";
	var erroraddmail = "<?php echo _WERRORADDMAIL;?>";
	var suredelmail = "<?php echo _WSUREDELEMAIL;?>";
	var errordelmail = "<?php echo _WERRORDELMAIL;?>";
	var fillinmail = "<?php echo _WFILLINEMAIL;?>";
	var errorsavechanges = "<?php echo _WERRORSAVECHANGES;?>";
	var errorchangestatus = "<?php echo _WERRORCHANGESTATUS;?>";
</script>
<script type="text/javascript" src="includes/warsmail.js"></script>

<?php

	$text = "<div class='nowrap'>
			<table border='0' cellspacing='0' cellpadding='2'>
				<tr>
					<td width='28'>&nbsp;</td>
					<td width='98'><b>"._WUSRNAME."</b></td>
					<td width='188'><b>"._WEMAILADDR."</b></td>
					<td width='118'>&nbsp;</td>
				</tr>
			</table>
		</div>
		<div id='mailsdiv'>";
	$members = array();
	$result = $sql->db_Select("clan_wars_mail", "*", "order by member ASC", "");
		while ($row = $sql->db_Fetch()) {
			if(intval($row['member']) > 0) $row['member'] = cw_getuser_name($row['member']);			
			$members[] = $row;
		}
		$members = multisort($members, 'member', 'email', 'active', 'mid');
		foreach($members as $row){
			$mid = intval($row['mid']);
			$member = $row['member'];
			$email = $row['email'];
			$status = $row['active'];

			$text .= "<div class='mainwrap forumheader3' id='mail$mid'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='28' style='text-align:center;'><img id='img$mid' src='images/".(($status)?"":"in")."active.png' border='0' value='$status' onclick='ChangeStatus($mid);' class='iconpointer' title='".(($status)?_WACT:_WINACT).". "._WCLCKTOCHANGE."'></td>
							<td width='98' id='unametext$mid'>$member</td>
							<td width='188' id='addresstext$mid'>$email</td>
							<td width='118' style='text-align:right;' nowrap><input type='button' class='iconpointer button' value='"._WEDIT."' onclick='EditMail($mid);'>&nbsp;<input type='button' class='iconpointer button' value='"._WDEL."' onclick='delData($mid);'></td>
						</tr>
					</table>
				</div>
				
				<div class='mainwrap forumheader3' id='edit$mid' style='display:none;'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='28' style='text-align:center;'><img id='editimg$mid' src='images/".(($status)?"":"in")."active.png' border='0' value='$status' onclick='ChangeStatus($mid);' class='iconpointer' title='".(($status)?_WACT:_WINACT).". "._WCLCKTOCHANGE."'></td>
							<td width='98'><input type='text' id='uname$mid' value='$member' style='width:90px;margin:0;'></td>
							<td width='188'><input type='text' id='address$mid' value='$email' style='width:180px;margin:0;'></td>
							<td width='118' style='text-align:right;' nowrap><input type='button' class='iconpointer button' value='"._WSAVE."' onclick='saveData($mid);'>&nbsp;<input type='button' class='iconpointer button' value='"._WCANCEL."' onclick='CancelMail($mid);'></td>
						</tr>
					</table>					
				</div>";
		}
		$text .= "</div>
				<div class='nowrap'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='28' style='text-align:center;'><img src='images/active.png' border='0'></td>
							<td width='98'><input type='text' id='uname' style='width:90px;margin:0;'></td>
							<td width='188'><input type='text' id='address' style='width:180px;margin:0;'></td>
							<td width='118' style='text-align:right;' nowrap><input type='button' class='iconpointer button' value='"._WADDMAIL."' onclick='addData();'></td>
						</tr>
					</table>
				</div>";
		$ns->tablerender(_WWARSMAIL, "<center>".$text."</center>");
?>