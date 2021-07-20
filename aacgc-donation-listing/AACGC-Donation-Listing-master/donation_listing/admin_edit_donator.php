<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
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
if (isset($_POST['update_donator'])) {
        $message = ($sql->db_Update("donation_listing", "year='".$_POST['year']."', month='".$_POST['month']."', user_day='".$_POST['user_day']."', user_amount='".$_POST['user_amount']."' WHERE don_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("donation_listing", "don_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['don_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>User</td>
        <td style='width:' class='forumheader3'>Amount</td>
        <td style='width:' class='forumheader3'>Day</td>
        <td style='width:' class='forumheader3'>Month</td>
        <td style='width:' class='forumheader3'>Year</td>
        <td style='width:' class='forumheader3'>Options</td>
        </tr>";
        $sql->db_Select("donation_listing", "*", "ORDER BY don_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("donation_listing_month", "*", "WHERE month_id=".$row['month']."", "");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("donation_listing_year", "*", "WHERE year_id=".$row['year']."", "");
        $row3 = $sql3->db_Fetch();
        $sql4 = new db;
        $sql4->db_Select("user", "*", "WHERE user_id='".$row['user_id']."'","");
        $row4 = $sql4->db_Fetch();
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row4['user_name']."</td>
        <td style='width:' class='forumheader3'>".$row['user_amount']."</td>
        <td style='width:' class='forumheader3'>".$row['user_day']."</td>
        <td style='width:' class='forumheader3'>".$row2['month_name']."</td>
        <td style='width:' class='forumheader3'>".$row3['year_name']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['don_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['don_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['don_id']} ]')\"/>
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

if ($action == "edit")
{
        $sql->db_Select("donation_listing", "*", "WHERE don_id= $id","");
        $row = $sql->db_Fetch();
        $sql2 = new db;
        $sql2->db_Select("donation_listing_month", "*", "WHERE month_id=".$row['month']."", "");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("donation_listing_year", "*", "WHERE year_id=".$row['year']."", "");
        $row3 = $sql3->db_Fetch();
        $sql4 = new db;
        $sql4->db_Select("user", "*", "WHERE user_id='".$row['user_id']."'","");
        $row4 = $sql4->db_Fetch();


        $width = "width:100%";
        $text .= "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Name:</td>
        <td style='width:70%' class='forumheader3'>
        ".$row4['user_name']."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Amount:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("user_amount", 100, $row['user_amount'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Day:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("user_day", 100, $row['user_day'], 500)."
         </td>
        </tr>";



        $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Month:</td>
        <td style='width:70%' class='forumheader3'>
        <select name='month' size='1' class='tbox' style='width:100%'>";
        $sql5 = new db;
        $sql5->db_Select("donation_listing_month", "*", "ORDER BY month_id", "");
        while($row5 = $sql5->db_Fetch()){
        $text .= "<option name='month' value='".$row5['month_id']."'>".$row5['month_name']."</option>";}


       $text .= "
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Year:</td>
        <td style='width:70%' class='forumheader3'>
        <select name='year' size='1' class='tbox' style='width:100%'>";
        $sql6 = new db;
        $sql6->db_Select("donation_listing_year", "*", "ORDER BY year_id", "");
        while($row6 = $sql6->db_Fetch()){
        $text .= "<option name='year' value='".$row6['year_id']."'>".$row6['year_name']."</option>";}





        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['don_id']."")."
        ".$rs -> form_button("submit", "update_donator", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Donation Listing (Edit Donator)", $text);
	      require_once(e_ADMIN."footer.php");
}
?>


