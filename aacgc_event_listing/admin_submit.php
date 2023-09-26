<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Adv Ribbons & Medals V5.0 #
#     by Reid Baughman AKA M@CH!N3    #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
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
if ($_POST['addusertodb'] == "1") {
$eventid = $_POST['event_id'];
$uid = $_POST['user_id'];
$sql->db_Select("user", "*", "WHERE user_id = '".$uid."'","");
while($row = $sql->db_Fetch())
{$usern2 = $row[user_name];}
$userchoice =  $_POST['user_choice'];
$userinfo =  $_POST['user_info'];


$sql->db_Insert("aacgc_event_listing_members", "NULL, '".$eventid."', '".$uid."', '".$userchoice."', '".$userinfo."'");



$txt = "<center><b>".$usern2." Added To Event</b><center>";
$ns -> tablerender("", $txt);}

//-----------------------------------------------------------------------------------------------------------+

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_event_listing_request", "eventreq_id='".$delete_id[0]."'");}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}


//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {

        $text .= $rs->form_open("post", e_SELF, "myform_".$row['eventreqt_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>Request ID</td>
        <td style='width:25%' class='forumheader3'>User ID# / Name</td>
        <td style='width:25%' class='forumheader3'>Event</td>
        <td style='width:25%' class='forumheader3'>Choice</td>
        <td style='width:25%' class='forumheader3'>Reason</td>
        <td style='width:' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_event_listing_request", "*", "ORDER BY eventreq_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['user_id']."","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_event_listing", "*", "WHERE event_id=".$row['eventlist_id']."","");
        $row3 = $sql3->db_Fetch();

if ($row['user_choice'] == "1"){
$choice = "Yes";}
if ($row['user_choice'] == "2"){
$choice = "No";}
if ($row['user_choice'] == "3"){
$choice = "Maybe";}

        $text .= "
        <tr>
        <td style='width:' class='forumheader3' name='event_id' >".$row['eventreq_id']."</td>
        <td style='width:25%' class='forumheader3' name='user_id'>".$row['user_id']." / ".$row2['user_name']."</td>
        <td style='width:25%' class='forumheader3' name='event_name'>".$row3['event_name']."</td>
        <td style='width:25%' class='forumheader3' name='user_choice'>".$choice."</td>
        <td style='width:25%' class='forumheader3' name='user_info'>".$row['user_info']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['eventreq_id']}'><img src='".e_PLUGIN."aacgc_event_listing/images/add.png' alt='Add User'></img></a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['eventreq_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['eventreq_id']} ]')\"/>
                </td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("Event Join Requests", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+


//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                $sql->db_Select("aacgc_event_listing_request", "*", "eventreq_id = $id");
                $row = $sql->db_Fetch();
                $sql2 = new db;
                $sql2->db_Select("aacgc_event_listing", "*", "WHERE event_id='".$row['eventlist_id']."'","");
                $row2 = $sql2->db_Fetch();
                $sql3 = new db;
                $sql3->db_Select("user", "*", "WHERE user_id='".$row['user_id']."'","");
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
        <td colspan=2><center><font size='2'>Make Sure All Information Is Correct, Then Click Add User.</font><br><br></td>
        </tr></tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User ID#:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("user_id", 50, $row['user_id'], 500)." (".$row3['user_name'].")
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Choice:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("user_choice", 50, $row['user_choice'], 500)." (".$choice.")
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Reason:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("user_info", 50, $row['user_info'], 500)."
        </td>
        </tr>
";



        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Event:<br>(User Selected - ".$row2['event_name'].")</td>
        <td style='width:70%' class='forumheader3'>
        <select name='event_id' size='1' class='tbox' style='width:35%'>";
        $sql5 = new db;
	$sql5->db_Select("aacgc_event_listing", "*", "ORDER BY event_id ASC","");
        while($row5 = $sql5->db_Fetch()){
        $text .= "<option name='event_id' value='".$row5['event_id']."'>".$row5['event_name']."</option>";}




        $text .= "</div>
   		</td>
		</tr>
		
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='addusertodb' value='1'>
		<input class='button' type='submit' value='Add User' style='width:150px'>
		</td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>



