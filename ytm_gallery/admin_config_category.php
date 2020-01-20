<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");

if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "ytm_gallery/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "ytm_gallery/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "ytm_gallery/languages/English.php");
}

// Post Checks
$subcheck      = $_POST['subcat_name'];
$editcheck     = $_GET['edit'];
$editingcheck  = $_POST['edit_cat_name'];
$deletecheck   = $_GET['delete'];
$deleteconfirm = $_GET['confirm_delete'];
$sortcheck     = $_GET['sort'];

            if     ($sortcheck == "cat_down")   {$q02sort = "ORDER BY cat_name ASC";}
            elseif ($sortcheck == "cat_up")     {$q02sort = "ORDER BY Cat_name DESC";}
            else   {$q02sort = "ORDER BY cat_name ASC";}



// *************** Edit page ***************

if (!$editcheck == ""){

$query03          = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category WHERE cat_id = '$editcheck'";
$result           = mysql_query($query03);
$row              = mysql_fetch_array($result,MYSQL_ASSOC);
$edit_cat_name    = $row['cat_name'];
$edit_cat_auth    = $row['cat_auth'];

$text .= "<form method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_CAT_PREFS_17 . "</strong></td></tr>
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_CAT_PREFS_5 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='edit_cat_name' value='$edit_cat_name' size='60' maxlength='100' />
<input class='tbox' type='hidden' name='edit_cat_id' value='$editcheck' size='1'/><br />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_CAT_PREFS_6 . "</td>
<td style='width:70%' class='forumheader3'>";

$text .= r_userclass("edit_cat_auth",$edit_cat_auth, $optlist = 'public, guest, nobody, member, admin, classes' );

$text .="</td></tr>";

$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'>
<input type='button' value='" . LAN_YTM_CAT_PREFS_19 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">
<input type='submit' name='update' value='" . LAN_YTM_CAT_PREFS_18 . "' class='button' />\n
</td></tr></table></form>";

$ns->tablerender(LAN_YTM_CAT_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}



// *************** Delete page ***************

if (!$deletecheck == ""){

$query01          = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category WHERE cat_id = '$deletecheck'";
$result           = mysql_query($query01);
$row              = mysql_fetch_array($result,MYSQL_ASSOC);
$del_cat_name     = $row['cat_name'];

$text .= "<table class='fborder' width='97%'><tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_CAT_PREFS_11 . "</strong></td></tr><tr><td style='width:100%' class='forumheader3'>";
$text .= "<center><img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' />";
$text .= "<br /><br /> ". LAN_YTM_CAT_PREFS_12 ." $del_cat_name?";
$text .= "<br /><br /><form>";
$text .= "<input type='button' value='" . LAN_YTM_CAT_PREFS_14 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">";
$text .= "&nbsp;&nbsp;";
$text .= "<input type='button' value='" . LAN_YTM_CAT_PREFS_13 . "' class='button' onClick=\"parent.location='" . e_SELF . "?confirm_delete=$deletecheck'\">";
$text .= "</form></center></td></tr></table>";

$ns->tablerender(LAN_YTM_CAT_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}




// If posted category, add to database
if (!$subcheck == ""){
$store_cat_name    = $_POST['subcat_name'];
$store_cat_auth    = $_POST['subcat_auth'];
$store_cat_name    = str_replace ("'","&#39;",$store_cat_name);

      mysql_query("insert into ".MPREFIX."er_ytm_gallery_category (cat_name, cat_auth) VALUES ('$store_cat_name', '$store_cat_auth');");
      $msgtext = LAN_YTM_CAT_PREFS_10;}

// If edited a category, change in database
elseif (!$editingcheck == ""){
$store_cat_name    = $_POST['edit_cat_name'];
$store_cat_auth    = $_POST['edit_cat_auth'];
$store_cat_id      = $_POST['edit_cat_id'];
$store_cat_name    = str_replace ("'","&#39;",$store_cat_name);

      mysql_query("update ".MPREFIX."er_ytm_gallery_category set cat_name = '$store_cat_name', cat_auth = '$store_cat_auth' WHERE cat_id = '$store_cat_id';");
      $msgtext = LAN_YTM_CAT_PREFS_20;}

// If deleted a category, remove from database
elseif (!$deleteconfirm == ""){

      mysql_query("DELETE FROM ".MPREFIX."er_ytm_gallery_category WHERE cat_id ='$deleteconfirm'");
      $msgtext = LAN_YTM_CAT_PREFS_15;

}else{
$msgtext = "";
}





// ***************     Main page      ***************

// Input Form
$text .= "<form name='input' method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_CAT_PREFS_0 . "</strong></td></tr>
<font color='red'>$msgtext</font>

<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_CAT_PREFS_1 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='subcat_name' size='60' maxlength='100' /><br />
</td></tr>";

$text .= "<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_CAT_PREFS_6 . "</td>
<td style='width:70%' class='forumheader3'>";
$text .= r_userclass("subcat_auth", '0', $optlist = 'public, guest, nobody, member, admin, classes' );
$text .= "</td></tr>";

$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='input' value='" . LAN_YTM_CAT_PREFS_2 . "' class='button' />\n
</td></tr></table></form><br /><br />";


// Category overview
$text .= "
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='4'><strong>" . LAN_YTM_CAT_PREFS_3 . "</strong>
</td></tr>";

$text .= "<tr>
<td style='width:5%' class='forumheader3'><b><u>" . LAN_YTM_CAT_PREFS_4 . "</u></b></td>

<td style='width:45%' class='forumheader3'><b><u>" . LAN_YTM_CAT_PREFS_5 . "</u></b>
      <a href='" . e_SELF . "?sort=cat_down' title='". LAN_YTM_CAT_PREFS_21 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortdown.png' border='0' /></a>
      <a href='" . e_SELF . "?sort=cat_up' title='". LAN_YTM_CAT_PREFS_22 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortup.png' border='0' /></a></td>

<td style='width:10%' class='forumheader3'><b><u>" . LAN_YTM_CAT_PREFS_6 . "</u></b></td>

<td style='width:40%' class='forumheader3'><b><u>" . LAN_YTM_CAT_PREFS_7 . "</u></b>";
$text .= "</td></tr>";

// Get Categories
$query02  = "
SELECT * FROM ".MPREFIX."er_ytm_gallery_category $q02sort";
                             
$result = mysql_query($query02);
$cat_i = 1;

while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
$cat_id     = $row['cat_id'];
$cat_name   = $row['cat_name'];
$cat_auth   = $row['cat_auth'];

// Display categories
$text .= "<tr>
<td style='width:5%' class='forumheader3'>$cat_i</td>
<td style='width:30%' class='forumheader3'>$cat_name</td>
<td style='width:30%' class='forumheader3'>";


if ($cat_auth == e_UC_PUBLIC)       {$text .= UC_LAN_0;}
if ($cat_auth == e_UC_GUEST)        {$text .= UC_LAN_1;}
if ($cat_auth == e_UC_NOBODY)       {$text .= UC_LAN_2;}
if ($cat_auth == e_UC_MEMBER)       {$text .= UC_LAN_3;}
if ($cat_auth == e_UC_READONLY)     {$text .= UC_LAN_4;}
if ($cat_auth == e_UC_ADMIN)        {$text .= UC_LAN_5;}
if ($cat_auth == e_UC_MAINADMIN)    {$text .= UC_LAN_6;}

            $cat_custom_classList = get_userclass_list();
      	foreach($cat_custom_classList as $c_c_row){
            extract($c_c_row);

if ($cat_auth == $c_c_row['userclass_id']) {$text .= $c_c_row['userclass_name'];}}
	
	
$text .="</td><td style='width:30%' class='forumheader3'>
<a href='" . e_SELF . "?edit=$cat_id' title='". LAN_YTM_CAT_PREFS_16 ." $cat_name'><img src='". e_IMAGE_ABS . "admin_images/edit_16.png' border='0' /></a>
<a href='" . e_SELF . "?delete=$cat_id' title='". LAN_YTM_CAT_PREFS_8 ." $cat_name'><img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' /></a>
";
$text .= "</td></tr>";
$cat_i++;
}

$text .= "</table>";


$ns->tablerender(LAN_YTM_CAT_PREFS, $text);

require_once(e_ADMIN . "footer.php");
?>
