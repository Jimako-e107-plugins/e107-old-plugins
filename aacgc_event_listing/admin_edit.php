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
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_event'])) {
        $message = ($sql->db_Update("aacgc_event_listing", "event_name='".$_POST['event_name']."',event_host='".$_POST['event_host']."',event_locatiom='".$_POST['event_locatiom']."',event_cost='".$_POST['event_cost']."',event_date='".$_POST['event_date']."',event_details='".$_POST['event_details']."',event_link='".$_POST['event_link']."',event_linktext='".$_POST['event_linktext']."',event_open='".$_POST['event_open']."' WHERE event_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {

        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
        $sql2->db_Delete("aacgc_event_listing", "event_id='".$delete_id[0]."'");
        $sql3 = new db;
        $sql3->db_Delete("aacgc_event_listing_members", "event_id='".$delete_id[0]."'");
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['event_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:5%' class='forumheader3'>Event ID</td>
        <td style='width:' class='forumheader3'>Name</td>
        <td style='width:' class='forumheader3'>Host</td>
        <td style='width:15%' class='forumheader3'>Location</td>
        <td style='width:10%' class='forumheader3'>Cost</td>
        <td style='width:10%' class='forumheader3'>Date</td>
        <td style='width:' class='forumheader3'>Details</td>
        <td style='width:' class='forumheader3'>Open To Users</td>
        <td style='width:' class='forumheader3'>Link</td>
        <td style='width:5%' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_event_listing", "*", "ORDER BY event_id ASC","");
        while($row = $sql->db_Fetch()){
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['event_id']."</td>
        <td style='width:' class='forumheader3'>".$row['event_name']."</td>
        <td style='width:' class='forumheader3'>".$row['event_host']."</td>
        <td style='width:' class='forumheader3'>".$row['event_locatiom']."</td>
        <td style='width:' class='forumheader3'>".$row['event_cost']."</td>
        <td style='width:' class='forumheader3'>".$row['event_date']."</td>
        <td style='width:' class='forumheader3'>".$row['event_details']."</td>
        <td style='width:' class='forumheader3'>".$row['event_open']."</td>
        <td style='width:' class='forumheader3'>Link Text:".$row['event_linktext']."<br>Link:".$row['event_link']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['event_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['event_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['event_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit"){
$time = time($row['event_date']);

                $sql->db_Select("aacgc_event_listing", "*", "event_id = $id");
                $row = $sql->db_Fetch();


        $width = "width:100%";
$text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Name:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("event_name", 100, $row['event_name'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Host:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("event_host", 100, $row['event_host'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Location:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("event_locatiom", 100, $row['event_locatiom'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Cost:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("event_cost", 100, $row['event_cost'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Date:</td>
        <td style='width:70%' class='forumheader3'>";

$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%Y/%m/%d %I:%M %P',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'event_date',
                 'value'       => date("Y/m/d h:i a", $time)));

//".$rs -> form_text("event_date", 100, $row['event_date'], 500)."

$text .= "</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Details:</td>
        <td style='width:70%' class='forumheader3'>
        ".$rs -> form_text("event_details", 100, $row['event_details'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Link:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("event_link", 100, $row['event_link'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Link Text:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("event_linktext", 100, $row['event_linktext'], 500)."
        </td>
        </tr>
	<tr>
		<td style='width:30%' class='forumheader3'>Allow User Submissions:</td>
                <td style='width:' class=''>
                <select name='event_open' size='1' class='tbox' style='width:50%'>
                <option name='event_open' value='".$row['event_open']."'>".$row['event_open']."</option>
                <option name='event_open' value='Yes'>Yes</option>
                <option name='event_open' value='No'>No</option>
                </td>
	<tr>


";

$text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['event_id']."")."
        ".$rs -> form_button("submit", "update_event", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


