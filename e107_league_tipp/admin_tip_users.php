<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        GNU General Public License (http://gnu.org).
|		
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipp_admin_user_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipp_admin_user_lan.php");
// ------------------------------
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_LEAGUE_TIPP_ADMIN_USER_1;//"Tippgemeinschaft- Verwalten";

    $tablename = "league_tipp_users";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "lique_users_id";   // first column of your table.
    $e_wysiwyg = "";
    $pageid = "tips_users"; 
/////////////////////////////////////

require_once(e_ADMIN."auth.php");
require_once("form_handler.php");
$rs = new form;

if(IsSet($_POST['delete'])){
		$message = ($sql -> db_Delete("league_tipp_tab", "league_tipp_user_id='".$_POST['T_ID']."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
		$message .= ($sql -> db_Delete($tablename, "$primaryid='".$_POST['T_ID']."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;		
}
if(IsSet($_POST['id'])){
		$inputstr = " lique_users_status= '".$tp->toDB($_POST['statuswert'])."'";
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['id']."' ")) ? LAN_UPDATED: LAN_UPDATED_FAILED ;
}
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

// =================================================================

$ImageDELETE['PFAD']=e_PLUGIN."e107_league_tipp/images/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_TIPP_ADMIN_USER_2."' src='".$ImageDELETE['PFAD']."'>";
$statis[1]="Neu, noch nicht freigeschaltet";
$statis[2]="Freigeschaltet";
$statis[3]="Gespert!!!";


$text = "<div style='text-align:center'><br/><br/>".LAN_LEAGUE_TIPP_ADMIN_USER_8."<br/><br/><br/>
			<table style='width:90%' border='0' cellspacing='0' cellpadding='0'>
				<tr>
					<td class='forumheader'>
						".LAN_LEAGUE_TIPP_ADMIN_USER_3."
					</td>
					<td class='forumheader'>
						".LAN_LEAGUE_TIPP_ADMIN_USER_4."
					</td>
					<td class='forumheader'>
						".LAN_LEAGUE_TIPP_ADMIN_USER_5."
					</td>
					<td class='forumheader'>
						".LAN_LEAGUE_TIPP_ADMIN_USER_6."
					</td>
					<td class='forumheader'>
						".LAN_LEAGUE_TIPP_ADMIN_USER_7."
					</td>
				</tr>";
				
 $qry1="
   SELECT a.*, ab.* FROM ".MPREFIX."league_tipp_users AS a 
   LEFT JOIN ".MPREFIX."user AS ab ON ab.user_id=a.lique_users_user_id
   WHERE a.lique_users_id!='' ORDER BY lique_users_id
   		";
		$sql->db_Select_gen($qry1);	
	 while($row = $sql-> db_Fetch()){
			$text .="<tr>";
			$text .="<td class='forumheader3'>".$row['lique_users_id']."</td>";
			$text .="<td class='forumheader3'>".$row['lique_users_user_id']." / ".$row['user_name']."</td>";
			$text .="<td class='forumheader3'>".strftime("%a. %d-%b-%Y %H:%M ",$row['lique_users_date'])."</td>";
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='status_setzen'>
																				<input type='hidden' name='id' value='".$row['lique_users_id']."'>
																				<select class='tbox' style='width:200px'  name='statuswert' onChange='this.form.submit()'><option></option>";
			
						for ($i=1; $i< 4; $i++) {
                            $checked = ($row['lique_users_status'] == $i)? " selected='selected'" : "";
                            $text .="<option value='".$i."' $checked >". $statis[$i] ."</option />\n";
                            };
                            $text .="</select></form></td>";
								
			$text .="<td class='forumheader3'><form method='post' action='".e_SELF."' id='editform'>
																				<input type='hidden' name='T_ID' value='".$row['lique_users_id']."'>
																				<input type='image' title='".LAN_DELETE."' name='delete[team_{$row['lique_users_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_LEAGUE_TIPP_ADMIN_USER_9."[ ".$row['user_name']." ] ? ')\"/></form></td></tr>";
         }
 $text .= "</table>
     	<br/><br/>
				<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
			<br/>
 </div>
";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>
