<?php

/*
#######################################
#     AACGC Bracket Tracker           #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/




require_once("../../class2.php");
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}
//-----------------------------------------------------------------------------------------------------------+


if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_bt_place", "place_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {

        $text .= $rs->form_open("post", e_SELF, "myform_".$row['place_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:40%' class='forumheader3'>User/Team</td>
        <td style='width:40%' class='forumheader3'>Category</td>
        <td style='width:40%' class='forumheader3'>Place</td>
        <td style='width:0%' class='forumheader3'>Delete</td>
       </tr>";
        $sql->db_Select("aacgc_bt_place", "*", "ORDER BY place_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['user']."","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_bt_cat", "*", "WHERE cat_id=".$row['place_cat']."","");
        $row3 = $sql3->db_Fetch();
        $sql4 = new db;
        $sql4->db_Select("aacgc_bt_members", "*", "WHERE user_id=".$row['user']."","");
        $row4 = $sql4->db_Fetch();
        $sql5 = new db;
        $sql5->db_Select("aacgc_bt_teams", "*", "WHERE team_id=".$row4['user_team']."","");
        $row5 = $sql5->db_Fetch();


if ($row['place'] == "1"){$place = "Row 2 - Slot 1";}
if ($row['place'] == "2"){$place = "Row 2 - Slot 2";}
if ($row['place'] == "3"){$place = "Row 2 - Slot 3";}
if ($row['place'] == "4"){$place = "Row 2 - Slot 4";}
if ($row['place'] == "5"){$place = "Row 2 - Slot 5";}
if ($row['place'] == "6"){$place = "Row 2 - Slot 6";}
if ($row['place'] == "7"){$place = "Row 2 - Slot 7";}
if ($row['place'] == "8"){$place = "Row 2 - Slot 8";}
if ($row['place'] == "9"){$place = "Row 3 - Slot 1";}
if ($row['place'] == "10"){$place = "Row 3 - Slot 2";}
if ($row['place'] == "11"){$place = "Row 3 - Slot 3";}
if ($row['place'] == "12"){$place = "Row 3 - Slot 4";}
if ($row['place'] == "13"){$place = "Row 4 - Slot 1";}
if ($row['place'] == "14"){$place = "Row 4 - Slot 2";}
if ($row['place'] == "15"){$place = "Row 5 - Slot 1";}


        $text .= "
        <tr>
        <td style='width:' class='forumheader3' name='place_id' >".$row['place_id']."</td>
        <td style='width:' class='forumheader3' name='user'>".$row2['user_name']." (".$row5['team_name'].")</td>
        <td style='width:' class='forumheader3' name='place_cat'>".$row3['cat_name']."</td>
        <td style='width:' class='forumheader3' name='place'>".$place."</td>
        <td style='width:' class='forumheader3'>";
        
$text .= "<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['place_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['place_id']} ]')\"/>
                </td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("AACGC Bracket Tracker (Adjust Bracker Remove Users)", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+


?>


