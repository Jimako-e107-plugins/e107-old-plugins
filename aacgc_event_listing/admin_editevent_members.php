<?php

/*
#######################################
#     AACGC Event Listing             #                
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
if (isset($_POST['update_user'])) {
        $message = ($sql->db_Update("aacgc_event_listing_members", "event_id='".$_POST['event_id']."',user_id='".$_POST['user_id']."',user_choice='".$_POST['user_choice']."',user_info='".$_POST['user_info']."' WHERE eventmem_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_event_listing_members", "eventmem_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {

        $text .= $rs->form_open("post", e_SELF, "myform_".$row['eventmem_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>Request ID</td>
        <td style='width:25%' class='forumheader3'>User</td>
        <td style='width:25%' class='forumheader3'>Event</td>
        <td style='width:25%' class='forumheader3'>Choice</td>
        <td style='width:25%' class='forumheader3'>Reason</td>
        <td style='width:' class='forumheader3'>Delete</td>
       </tr>";
        $sql->db_Select("aacgc_event_listing_members", "*", "ORDER BY eventmem_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['user_id']."","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_event_listing", "*", "WHERE event_id=".$row['event_id']."","");
        $row3 = $sql3->db_Fetch();

if ($row['user_choice'] == "1"){
$choice = "Yes";}
if ($row['user_choice'] == "2"){
$choice = "No";}
if ($row['user_choice'] == "3"){
$choice = "Maybe";}

        $text .= "
        <tr>
        <td style='width:' class='forumheader3' name='event_id' >".$row['eventmem_id']."</td>
        <td style='width:25%' class='forumheader3' name='user_id'>".$row2['user_name']."</td>
        <td style='width:25%' class='forumheader3' name='event_name'>".$row3['event_name']."</td>
        <td style='width:25%' class='forumheader3' name='user_choice'>".$choice."</td>
        <td style='width:25%' class='forumheader3' name='user_info'>".$row['user_info']."</td>
        <td style='width:' class='forumheader3'>";
        
$text .= "<a href='".e_SELF."?edit.{$row['eventmem_id']}'>".ADMIN_EDIT_ICON."</a>";
$text .= "<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['eventmem_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['eventmem_id']} ]')\"/>
                </td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("Event Edit Members", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
        $sql->db_Select("aacgc_event_listing_members", "*", "WHERE eventmem_id=".$id."","");
        $row = $sql->db_Fetch();
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['user_id']."","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_event_listing", "*", "WHERE event_id=".$row['event_id']."","");
        $row3 = $sql3->db_Fetch();

if ($row['user_choice'] == "1"){
$choice = "Yes";}
if ($row['user_choice'] == "2"){
$choice = "No";}
if ($row['user_choice'] == "3"){
$choice = "Maybe";}



        $width = "width:100%";
        $text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Name:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("user_id", 100, $row2['user_id'], 300)." ".$row2['user_name']."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Event:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("event_id", 100, $row3['event_id'], 300)." ".$row3['event_name']."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Choice:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("user_choice", 100, $choice, 500)." (type 1 for yes, 2 for no, & 3 for maybe)
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Reason:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("user_info", 100, $row['user_info'], 500)."
        </td>
        </tr>
";



        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['eventmem_id']."")."
        ".$rs -> form_button("submit", "update_user", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>



