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

$eplug_js = "".e_PLUGIN."ytm_gallery/scripts/check.js";
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
$actcheck       = $_GET['activate'];
$deactcheck     = $_GET['deactivate'];
$subcheck       = $_POST['submovie_code'];
$editcheck      = $_GET['edit'];
$editingcheck   = $_POST['edit_id'];
$deletecheck    = $_GET['delete'];
$deleteconfirm  = $_GET['confirm_delete'];
$sortcheck      = $_GET['sort'];
$delallcheck    = $_POST['del_all_com'];
$actiallcheck   = $_POST['acti_all_comm'];
$deactiallcheck = $_POST['deacti_all_comm'];
$actiallcat     = $_POST['acti_all_cat'];
$mcheckaction   = $_POST['mcheckaction'];
$mcheckaction2   = $_POST['mcheckaction2'];
$delcheckconf   = $_POST['delcheckconf'];


            if     ($sortcheck == "title_down") {$q02sort = "ORDER BY movie_title ASC";}
            elseif ($sortcheck == "title_up")   {$q02sort = "ORDER BY movie_title DESC";}
            elseif ($sortcheck == "cat_down")   {$q02sort = "ORDER BY cat_name ASC";}
            elseif ($sortcheck == "cat_up")     {$q02sort = "ORDER BY cat_name DESC";}
            else   {$q02sort = "ORDER by timestamp DESC";}

$disable_check_form = "false";




// *************** Edit page ***************

if (!$editcheck == ""){

$disable_button = "false";
$diable_button_message  = "";

$query03          = "SELECT * FROM ".MPREFIX."er_ytm_gallery_movies gm
                    LEFT JOIN ".MPREFIX."er_ytm_gallery_category gg ON gm.movie_category = gg.cat_id
                    WHERE movie_id = '$editcheck'";
$result           = mysql_query($query03);
$row              = mysql_fetch_array($result,MYSQL_ASSOC);
$edit_movie_title = $row['movie_title'];
$edit_movie_code  = $row['movie_code'];
$edit_movie_user  = $row['input_user'];
$edit_movie_time  = $row['timestamp'];
$edit_movie_cat   = $row['cat_id'];
$edit_movie_acti  = $row['active'];

$text .= "<form name='edit_movie_form' method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_MOVIE_PREFS_17 . "</strong></td></tr>
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_MOVIE_PREFS_7 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='edit_title' value='$edit_movie_title' size='60' maxlength='100' /><br />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_PREFS_0 . "</td>
<td style='width:70%' class='forumheader3'><input DISABLED class='tbox' type='text' name='edit_code' value='$edit_movie_code' size='60' maxlength='100' />
<input class='tbox' type='HIDDEN' name='edit_id' value='$editcheck' size='1'/></td>
</tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_MOVIE_PREFS_3 . "</td>
<td style='width:70%' class='forumheader3'>";

      $query05        = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category";
      $result05       = mysql_query($query05);
      $num_rows05     = mysql_num_rows($result05);

      if ($num_rows05 < 1) {

$text .= LAN_YTM_MOVIE_PREFS_25;
$disable_button = "true";
$diable_button_message  = LAN_YTM_MOVIE_PREFS_24;

      }else{
      
$text .="<select style='width:180px' class='tbox' name='edit_category' >";

      while ($row05   = mysql_fetch_array($result05,MYSQL_ASSOC)) {
      $cat_id         = $row05['cat_id'];
      $cat_name       = $row05['cat_name'];

      if ($cat_id == $edit_movie_cat) {$selected_cat="SELECTED";}else{$selected_cat = "";}

$text .="<option $selected_cat value='$cat_id' >$cat_name</option>";}
$text .="</select>";}
$text .="</td></tr>";

      if ($edit_movie_acti == "1") {$checkbox = "CHECKED";}

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_MOVIE_PREFS_34 . "</td>
<td style='width:70%' class='forumheader3'><input type='checkbox' name='edit_active' $checkbox VALUE='active'>
</td></tr>";


$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'>
<input type='button' value='" . LAN_YTM_MOVIE_PREFS_19 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">
<input type='submit' name='edit_movie_submit' value='" . LAN_YTM_MOVIE_PREFS_18 . "' class='button' />\n
&nbsp;$diable_button_message</td></tr></table></form>";

$text .="<SCRIPT language='JavaScript'>
document.edit_movie_form.edit_movie_submit.disabled=$disable_button;</SCRIPT>";

$ns->tablerender(LAN_YTM_MOVIE_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}




// *************** Delete page ***************

if (!$deletecheck == ""){

$query01          = "SELECT * FROM ".MPREFIX."er_ytm_gallery_movies WHERE movie_id = '$deletecheck'";
$result           = mysql_query($query01);
$row              = mysql_fetch_array($result,MYSQL_ASSOC);
$del_movie_title  = $row['movie_title'];

$text .= "<table class='fborder' width='97%'><tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_MOVIE_PREFS_16 . "</strong></td></tr><tr><td style='width:100%' class='forumheader3'>";
$text .= "<center><img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' />";
$text .= "<br /><br /> ". LAN_YTM_MOVIE_PREFS_12 ." $del_movie_title?";
$text .= "<br /><br /><form>";
$text .= "<input type='button' value='" . LAN_YTM_MOVIE_PREFS_14 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">";
$text .= "&nbsp;&nbsp;";
$text .= "<input type='button' value='" . LAN_YTM_MOVIE_PREFS_13 . "' class='button' onClick=\"parent.location='" . e_SELF . "?confirm_delete=$deletecheck'\">";
$text .= "</form></center></td></tr></table>";

$ns->tablerender(LAN_YTM_MOVIE_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}




// *************** Delete All page ***************

if (!$delallcheck == ""){

            if (!$mcheckaction == "") {

$text .= "<table class='fborder' width='97%'><tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_MOVIE_PREFS_16 . "</strong></td></tr><tr><td style='width:100%' class='forumheader3'>";
$text .= "<center><img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' />";
$text .= "<br /><br />". LAN_YTM_MOVIE_PREFS_48 ."?";
$text .= "<br /><br /><form name='delallconf' method='post' action='" . e_SELF . "'>";

      foreach($mcheckaction as $mcheckaction_action) {
      $text .= "<input type='hidden' name='mcheckaction2[]' value='$mcheckaction_action' \>";}

$text .= "<input type='hidden' name='delcheckconf' value='confirm' \>";

$text .= "<input type='button' value='" . LAN_YTM_MOVIE_PREFS_14 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">";
$text .= "&nbsp;&nbsp;";
$text .= "<input type='submit' value='" . LAN_YTM_MOVIE_PREFS_13 . "' class='button'>";
$text .= "</form></center></td></tr></table>";

$ns->tablerender(LAN_YTM_MOVIE_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}
}


// *************** Actions **************

// If posted movie, add to database
if (!$subcheck == ""){
$store_movie_title = $_POST['submovie_title'];
$store_movie_code  = $_POST['submovie_code'];
$store_movie_cat   = $_POST['submovie_category'];
$store_movie_title = str_replace ("'","&#39;",$store_movie_title);
$store_movie_user = USERNAME;

            $query11          = "SELECT user_email from ".MPREFIX."user WHERE user_name = '" . USERNAME ."'";
            $result11         = mysql_query($query11);
            $row11            = mysql_fetch_array($result11,MYSQL_ASSOC);
            $store_movie_mail = $row11['user_email'];

      $query07        = "SELECT movie_code FROM ".MPREFIX."er_ytm_gallery_movies";
      $result07       = mysql_query($query07);

      while ($row07   = mysql_fetch_array($result07,MYSQL_ASSOC)) {
      $already_sub    = $row07['movie_code'];}

            if ($store_movie_code == $already_sub)          {$msgtext .= LAN_YTM_MOVIE_PREFS_37;
            }else{

            mysql_query("insert into ".MPREFIX."er_ytm_gallery_movies (movie_title, movie_code, movie_category, input_way, input_user, input_email, input_status) VALUES ('$store_movie_title', '$store_movie_code' , '$store_movie_cat' , '1' , '$store_movie_user' , '$store_movie_mail' , '1');");
            $msgtext = LAN_YTM_MOVIE_PREFS_10;}
            }

// If edited a movie, change in database
elseif (!$editingcheck == ""){
$store_movie_title = $_POST['edit_title'];
$store_movie_title = str_replace ("'","&#39;",$store_movie_title);
$store_movie_id    = $_POST['edit_id'];
$store_movie_cat   = $_POST['edit_category'];
$store_movie_acti  = $_POST['edit_active'];

      if ($store_movie_acti == "active") {$store_movie_acti = "1";}else{$store_movie_acti = "0";}

      mysql_query("update ".MPREFIX."er_ytm_gallery_movies set movie_title = '$store_movie_title', movie_category = '$store_movie_cat', active = '$store_movie_acti'  WHERE movie_id = '$store_movie_id';");
      $msgtext = LAN_YTM_MOVIE_PREFS_20;}

// If deactivated a movie, change in database
elseif (!$deactcheck == ""){

      mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set active = '0' WHERE movie_id ='$deactcheck'");
      $msgtext = LAN_YTM_MOVIE_PREFS_32;}

// If activated a movie, change in database
elseif (!$actcheck == ""){

      mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set active = '1' WHERE movie_id ='$actcheck'");
      $msgtext = LAN_YTM_MOVIE_PREFS_33;}

// If deleted a movie, remove from database
elseif (!$deleteconfirm == ""){

      mysql_query("DELETE FROM ".MPREFIX."er_ytm_gallery_movies WHERE movie_id ='$deleteconfirm'");
      $msgtext = LAN_YTM_MOVIE_PREFS_15;
      }

// If deleted a movie thrue checkboxes, remove from database
elseif (!$delcheckconf == ""){

            if (!$mcheckaction2 == "") {

            foreach($mcheckaction2 as $mcheckaction_action2) {

            mysql_query("DELETE FROM ".MPREFIX."er_ytm_gallery_movies WHERE movie_id ='$mcheckaction_action2'");
            }

            $msgtext = LAN_YTM_MOVIE_PREFS_38;}
            
            }

// If activated a movie thrue checkboxes, set to database
elseif (!$actiallcheck == ""){

            if (!$mcheckaction == "") {

            foreach($mcheckaction as $mcheckaction_action) {

            mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set active = '1' WHERE movie_id ='$mcheckaction_action'");
            }

            $msgtext = LAN_YTM_MOVIE_PREFS_39;}

            }


// If deactivated a movie thrue checkboxes, set to database
elseif (!$deactiallcheck == ""){

            if (!$mcheckaction == "") {

            foreach($mcheckaction as $mcheckaction_action) {

            mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set active = '0' WHERE movie_id ='$mcheckaction_action'");
            }

            $msgtext = LAN_YTM_MOVIE_PREFS_40;}
            
            }

// If category change thrue checkboxes, set to database
elseif (!$actiallcat == ""){

            if (!$mcheckaction == "") {

            foreach($mcheckaction as $mcheckaction_action) {

            mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set movie_category = '$actiallcat' WHERE movie_id ='$mcheckaction_action'");
            }

            $msgtext = LAN_YTM_MOVIE_PREFS_43;}
            
}else{
$msgtext = "";
}





// ***************     Main page      ***************

$disable_button         = "false";
$diable_button_message  = "";

// Input Form
$text .= "<form name='input_movie_form' method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_MOVIE_PREFS_8 . "</strong></td></tr>
<font color='red'>$msgtext</font>

<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_MOVIE_PREFS_7 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='submovie_title' size='60' maxlength='100' /><br />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_PREFS_0 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='submovie_code' size='60' maxlength='100' />&nbsp;<img src='". e_IMAGE_ABS . "admin_images/docs_16.png' title='" . LAN_YTM_MOVIE_PREFS_11 . "' border='0' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_MOVIE_PREFS_3 . "</td>
<td style='width:70%' class='forumheader3'>";

      $query04        = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category ORDER BY cat_name ASC";
      $result04       = mysql_query($query04);
      $num_rows04     = mysql_num_rows($result04);

      if ($num_rows04 < 1) {

$text .= LAN_YTM_MOVIE_PREFS_25;
$disable_button = "true";
$diable_button_message  = LAN_YTM_MOVIE_PREFS_24;

      }else{

$text .= "<select style='width:180px' class='tbox' name='submovie_category' >";

      while ($row04   = mysql_fetch_array($result04,MYSQL_ASSOC)) {
      $cat_id         = $row04['cat_id'];
      $cat_name       = $row04['cat_name'];

$text .="<option value='$cat_id'>$cat_name</option>";}
$text .="</select></td></tr>";}


$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='input_movie_submit' value='" . LAN_YTM_MOVIE_PREFS_9 . "' class='button' />
&nbsp;$diable_button_message</td></tr></table></form><br /><br />";

$text .="<SCRIPT language='JavaScript'>
document.input_movie_form.input_movie_submit.disabled=$disable_button;</SCRIPT>";



// Movie Database overview
$text .= "
<table class='fborder' width='97%'><form name='checkform' method='post' action='" . e_SELF . "'>
<tr><td class='forumheader3' colspan='4'><strong>" . LAN_YTM_MOVIE_PREFS_0 . "</strong>
</td></tr>";

$text .= "<tr>
<td style='width:5%' class='fcaption'><input type='checkbox' name='checkall' onclick=\"checkUncheckAll(this);\"/></td>

<td style='width:45%' class='fcaption'><b><u>" . LAN_YTM_MOVIE_PREFS_2 . "</u></b>
      <a href='" . e_SELF . "?sort=title_down' title='". LAN_YTM_MOVIE_PREFS_26 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortdown.png' border='0' /></a>
      <a href='" . e_SELF . "?sort=title_up' title='". LAN_YTM_MOVIE_PREFS_27 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortup.png' border='0' /></a></td>

<td style='width:15%' class='fcaption'><b><u>" . LAN_YTM_MOVIE_PREFS_3 . "</u></b>
      <a href='" . e_SELF . "?sort=cat_down' title='". LAN_YTM_MOVIE_PREFS_28 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortdown.png' border='0' /></a>
      <a href='" . e_SELF . "?sort=cat_up' title='". LAN_YTM_MOVIE_PREFS_29 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortup.png' border='0' /></a></td>
      
<td style='width:40%' class='fcaption'><b><u>" . LAN_YTM_MOVIE_PREFS_4 . "</u></b>";
$text .= "</td></tr>";

// Get Movies
$query02  = "
SELECT * FROM ".MPREFIX."er_ytm_gallery_movies gm
LEFT JOIN ".MPREFIX."er_ytm_gallery_category gg ON gm.movie_category = gg.cat_id
WHERE input_status = '1' $q02sort";
                             
$result = mysql_query($query02);
$num_rows = mysql_num_rows($result);
 
if ($num_rows < 1) {$disable_check_form = "true";
$text .="<tr><td colspan='5' class='forumheader3' style='text-align: left;'><br />" . LAN_YTM_MOVIE_PREFS_44 . "<br /><br /></td></tr>";

}else{

$movie_i = 1;

while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
$movie_title = $row['movie_title'];
$movie_category = $row['cat_name'];
$movie_user     = $row['input_user'];
$movie_time     = $row['timestamp'];
$movie_code     = $row['movie_code'];
$movie_id       = $row['movie_id'];
$movie_active   = $row['active'];

if ($movie_active == "1") {$acti_icon = "active.png";       $acti_lan = LAN_YTM_MOVIE_PREFS_31;  $acti_action = "deactivate";}
if ($movie_active == "0") {$acti_icon = "inactive.png";     $acti_lan = LAN_YTM_MOVIE_PREFS_30;  $acti_action = "activate";}

// Display movies
$text .= "<tr>
<td style='width:5%' class='forumheader3'><input type='checkbox' name='mcheckaction[]' value='$movie_id'/></td>
<td style='width:30%' class='forumheader3'><a href='admin_config_preview.php?movie=$movie_id' title='" . LAN_YTM_MOVIE_PREFS_2 . ": $movie_title - " . LAN_YTM_MOVIE_PREFS_5 . ": $movie_user " . LAN_YTM_MOVIE_PREFS_6 . ": $movie_time' onclick=\"window.open('admin_config_preview.php?movie=$movie_id','movie','width=550,height=550,scrollbars=no,toolbar=no,location=no,resizable=no,menubar=no,directories=no,status=no'); return false\">$movie_title</a></td>
<td style='width:30%' class='forumheader3'>$movie_category</td>
<td style='width:30%' class='forumheader3'>
<a href='" . e_SELF . "?$acti_action=$movie_id' title='$acti_lan $movie_title'><img src='".e_PLUGIN."ytm_gallery/images/$acti_icon' border='0' /></a>
<a href='admin_config_preview.php?movie=$movie_id' title='". LAN_YTM_MOVIE_PREFS_21 ." $movie_title' onclick=\"window.open('admin_config_preview.php?movie=$movie_id','movie','width=550,height=550,scrollbars=no,toolbar=no,location=no,resizable=no,menubar=no,directories=no,status=no'); return false\"><img src='". e_IMAGE_ABS . "admin_images/content_16.png' border='0' /></a>
<a href='" . e_SELF . "?edit=$movie_id' title='". LAN_YTM_MOVIE_PREFS_22 ." $movie_title'><img src='". e_IMAGE_ABS . "admin_images/edit_16.png' border='0' /></a>
<a href='" . e_SELF . "?delete=$movie_id' title='". LAN_YTM_MOVIE_PREFS_23 ." $movie_title'><img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' /></a>
";
$text .= "</td></tr>";
$movie_i++;
}
}

$text .= "<tr><td colspan='5' class='fcaption' style='text-align: left;'>
<input class='button' type='submit' name='del_all_com' value='" . LAN_YTM_MOVIE_PREFS_45 . "'>
<input class='button' type='submit' name='deacti_all_comm' value='" . LAN_YTM_MOVIE_PREFS_46 . "'>
<input class='button' type='submit' name='acti_all_comm' value='" . LAN_YTM_MOVIE_PREFS_47 . "'>
<select style='width:180px' class='tbox' name='acti_all_cat' onchange=checkform.submit()>
<option value=''>". LAN_YTM_MOVIE_PREFS_41 ."</option>";

      $query10        = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category ORDER BY cat_name ASC";
      $result10       = mysql_query($query10);

      while ($row10   = mysql_fetch_array($result10,MYSQL_ASSOC)) {
      $m_cat_id         = $row10['cat_id'];
      $m_cat_name       = $row10['cat_name'];

$text .="<option value='$m_cat_id'>$m_cat_name</option>";}
$text .="</select></td></tr></form></table>";

$text .="<SCRIPT language='JavaScript'>
document.checkform.del_all_com.disabled=$disable_check_form;</SCRIPT>";
$text .="<SCRIPT language='JavaScript'>
document.checkform.deacti_all_comm.disabled=$disable_check_form;</SCRIPT>";
$text .="<SCRIPT language='JavaScript'>
document.checkform.acti_all_comm.disabled=$disable_check_form;</SCRIPT>";
$text .="<SCRIPT language='JavaScript'>
document.checkform.acti_all_cat.disabled=$disable_check_form;</SCRIPT>";
$text .="<SCRIPT language='JavaScript'>
document.checkform.checkall.disabled=$disable_check_form;</SCRIPT>";


$ns->tablerender(LAN_YTM_MOVIE_PREFS, $text);

require_once(e_ADMIN . "footer.php");
?>
