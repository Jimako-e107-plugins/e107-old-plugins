<?php

/*
#######################################
#     AACGC Download Tracker          #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################


//***************************************************************
//*
//*		Update 				:	Jimako (e107 v2.x) 
//*
//*   Web site			: https://www.e107sk.com/
//*
//*		Last Change		:	09.07.2019
//*
//*		Version				:	2.0.0
//***************************************************************
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

$plugPref = e107::getPlugPref('aacgc_dltracker');

if ($plugPref['dltracker_enable_gold'] == "1"){$gold_obj = new gold();}

//---------------------------------------------------------------------------------
$title .= "".$plugPref['dltracker_pagetitle'].""; 
//---------------------------------------------------------------------------------


$text .= "<center>[ <a href='".e_PLUGIN."aacgc_dltracker/DLTracker_List.php'>Back to Download List</a> ]</center>";


$text .= "<br><center><table style='width:100%' class=''>";


        $sql ->db_Select("download", "*", "download_id = '".intval($sub_action)."'");
        $row = $sql->db_Fetch();


$text .= "
<tr>
<td class='forumheader3' colspan=2><center><font size='3'>".$tp->toHTML($row['download_name'], TRUE)."</font></center></td>
</tr>";

$text .= "
<tr><td class='forumheader3'>Author:</td><td class='forumheader3'>".$row['download_author']."</td></tr>
<tr><td class='forumheader3'>Author Email:</td><td class='forumheader3'>".$row['download_author_email']."</td></tr>
<tr><td class='forumheader3'>Author Website:</td><td class='forumheader3'>".$row['download_author_website']."</td></tr>
<tr><td class='forumheader3'>Total Downloads:</td><td class='forumheader3'>".$row['download_requested']."</td></tr>
<tr><td class='forumheader3'>Description:</td><td class='forumheader3'>".$tp->toHTML($row['download_description'], TRUE)."</td></tr>

";


$text .= "</table>";





$text .= "<br><center><div style='width:auto; height:400px; overflow:auto'><table style='width:100%' class=''>";
$text .= "
<tr>
<td class='forumheader3'><u>Downloaded by:</u></td>
<td class='forumheader3'><center><u>Date:</u></center></td>
<td class='forumheader3'><u>Time Ago:</u></td>
</tr>";
$records = e107::getDb()->retrieve("download_requests", "*", "download_request_download_id='".intval($row['download_id'])."' ORDER BY download_request_datestamp DESC", true);
foreach($records as $row2) {
        $uid = intval($row2['download_request_userid']);
        $row3 = e107::user($uid); 

        if ($plugPref['dltracker_enable_gold'] == "1"){
            $username = "".$gold_obj->show_orb($row3['user_id'])."";
        }
        else {
            $username = varset($row3['user_name'] , "Anonymous") ;
        }
        /* avatar */
	      if ($plugPref['dltracker_enable_avatar'] == "1"){
		      if ($row3['user_image'] == "")  {
							$avatar = "";
					}
		      else
			    {	
					  	$parm = array(
								'w' => $plugPref['dltracker_avatar_size'],
								'h' => $plugPref['dltracker_avatar_size'],
								'crop' => 'C',
							  'shape' => null
								);
	
						$avatar = e107::getParser()->toAvatar($row3, $parm);
			 
					}
				}
				/* date fix */
 
 
        $when = e107::getParser()->toDate($row2['download_request_datestamp'], "relative");
        $date = e107::getParser()->toDate($row2['download_request_datestamp'], "short");

				
				$text .= "
				<tr>
				<td class='indent' style='text-align:left'><a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$avatar." ".$username."</a></td>
				<td class='indent'>".$date."</td>
				<td class='indent' style='text-align:left'>".$when."</td>
				</tr>";
}


$text .= "</table></div>";

$ns -> tablerender($title, $text);

require_once(FOOTERF);


