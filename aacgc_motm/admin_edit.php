<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Of the Month       #
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
if (isset($_POST['update_motm'])) {
        $message = ($sql->db_Update("aacgc_motm", "motm_user='".$_POST['motm_user']."', month='".$_POST['month']."', year='".$_POST['year']."' WHERE motm_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_motm", "motm_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['motm_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:' class='forumheader3'>ID</td>
        <td style='width:25%' class='forumheader3'>User Name</td>
        <td style='width:25%' class='forumheader3'>Month</td>
        <td style='width:25%' class='forumheader3'>Month</td>
        <td style='width:' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_motm", "*", "ORDER BY motm_id ASC","");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['motm_user']."","");
        $row2 = $sql2->db_Fetch();
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['motm_id']."</td>
        <td style='width:25%' class='forumheader3'>".$row2['user_name']."</td>
        <td style='width:25%' class='forumheader3'>".$row['month']."</td>
        <td style='width:25%' class='forumheader3'>".$row['year']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['motm_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['motm_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['motm_id']} ]')\"/>
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
        $sql->db_Select("aacgc_motm", "*", "WHERE motm_id=$id","");
        $row = $sql->db_Fetch();
        $sql2 = new db;
        $sql2->db_Select("user", "*", "WHERE user_id=".$row['motm_user']."","");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("user", "*");
        $rows = $sql3->db_Rows();
        for ($i=0; $i < $rows; $i++) {
        $option = $sql3->db_Fetch();
        $options .= "<option name='motm_user' value='".$option['user_id']."'>".$option['user_name']."</option>";}

        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>User Name:</td>
        <td style='width:' class='forumheader3' colspan=2>
		<select name='motm_user' size='1' class='tbox' style='width:60%'>
                <option name='motm_user' value='".$row2['user_id']."'>".$row2['user_name']."</option>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Month:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='month' size='1' class='tbox' style='width:25%'>
                <option name='month' value='".$row['month']."'>".$row['month']."</option>
		<option name='month' value='January'>January</option>
		<option name='month' value='February'>February</option>
		<option name='month' value='March'>March</option>
		<option name='month' value='April'>April</option>
		<option name='month' value='May'>May</option>
		<option name='month' value='June'>June</option>
		<option name='month' value='July'>July</option>
		<option name='month' value='August'>August</option>
		<option name='month' value='September'>September</option>
		<option name='month' value='October'>October</option>
                <option name='month' value='November'>November</option>
                <option name='month' value='December'>December</option>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Year:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='year' size='1' class='tbox' style='width:25%'>
                <option name='year' value='".$row['year']."'>".$row['year']."</option>
		<option name='year' value='2008'>2008</option>
		<option name='year' value='2009'>2009</option>
		<option name='year' value='2010'>2010</option>
		<option name='year' value='2011'>2011</option>
		<option name='year' value='2012'>2012</option>
		<option name='year' value='2013'>2013</option>
		<option name='year' value='2014'>2014</option>
		<option name='year' value='2015'>2015</option>
		<option name='year' value='2016'>2016</option>
		<option name='year' value='2017'>2017</option>
            <option name='year' value='2018'>2018</option>
            <option name='year' value='2019'>2019</option>
        </td>
        </tr>";




        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['motm_id']."")."
        ".$rs -> form_button("submit", "update_motm", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC MOTM", $text);
	      require_once(e_ADMIN."footer.php");
}
?>