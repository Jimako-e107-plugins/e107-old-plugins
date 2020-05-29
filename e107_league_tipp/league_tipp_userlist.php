<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        
|    GNU General Public License (http://gnu.org).
|		
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/userlist.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/userlist.php");
// ------------------------------

$ganz=$pref['league_tipp_treffer'];
$tendenz=$pref['league_tipp_tendenz'];
$leer=0;
$timeout=(60 * $pref['league_tipp_timeout']);
$statis[1]="<div style='color:#f8941d'>".LAN_LEAGUE_TIPP_UL_4."</div>";
$statis[2]="<div style='color:#39b54a'>".LAN_LEAGUE_TIPP_UL_5."</div>";
$statis[3]="<div style='color:#ee1c24'>".LAN_LEAGUE_TIPP_UL_6."</div>";

   $qry="
   SELECT u.*, uh.* FROM ".MPREFIX."league_tipp_users AS u 
   LEFT JOIN ".MPREFIX."user AS uh ON uh.user_id=u.lique_users_user_id 
   WHERE u.lique_users_user_id!=''
   		";
   			$ucount=0;
   			 	$sql->db_Select_gen($qry);
   				while($row = $sql-> db_Fetch()){
   					$User[$ucount]['id']=$row['lique_users_id'];
   					$User[$ucount]['benutzer_id']=$row['user_id'];
   					$User[$ucount]['name']=$row['user_name'];
   					$User[$ucount]['mail']=$row['user_email'];
   					$User[$ucount]['lique_users_status']=$row['lique_users_status'];
   					$User[$ucount]['lique_users_date']=$row['lique_users_date'];
   					$ucount++;
   				}

$text="<div style='text-align:center; vertical-align:top;'>
		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='fcaption' style='text-align:left;width:5%;border-top:0px'>.</td>
				<td class='fcaption' style='text-align:center;width:25%;border-top:0px'>".LAN_LEAGUE_TIPP_UL_2."</td>  
				<td class='fcaption' style='text-align:center;width:45%;border-top:0px'>".LAN_LEAGUE_TIPP_UL_3."</td>
				<td class='fcaption' style='text-align:center;width:25%;border-top:0px'>".LAN_LEAGUE_TIPP_UL_7."</td> 
			</tr>";
		for($j=0; $j < $ucount; $j++)
		{
		$text.="<tr>
				<td class='forumheader3' style='text-align:right;border-top:0px'>".($Nr=$j+1)."</td>
				<td class='forumheader3' style='text-align:left;border-top:0px'><a href='".e_BASE."user.php?id.".$User[$j]['benutzer_id']."'>".$User[$j]['name']."</a></td>  
			  <td class='forumheader3' style='text-align:center;border-top:0px'><b>".$statis[$User[$j]['lique_users_status']]."</b></td>
			  <td class='forumheader3' style='text-align:center;border-top:0px'><b>".strftime("%a. %d %b %Y",$User[$j]['lique_users_date'])."</b></td>
			</tr>";
		}	
$text.="</table>
				<br/><form method='get' action='league_tipp_login.php' id='back'>
							<input class='button' type='submit' name='back' value='".LAN_LEAGUE_TIPP_UL_8."'/></form><br/>
				<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
				<br/>
</div>";
$title=LAN_LEAGUE_TIPP_UL_1;
$ns -> tablerender($title, $text);
require_once(FOOTERF);
?>