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
$approvecheck     = $_GET['approve'];
$approvalcheck    = $_POST['approve_check'];
$deletecheck      = $_GET['delete'];
$deleteconfirm    = $_GET['confirm_delete'];
$sortcheck        = $_GET['sort'];
$delallcheck      = $_POST['del_all_com'];
$actiallcheck     = $_POST['acti_all_comm'];
$deactiallcheck   = $_POST['deacti_all_comm'];
$actiallcat       = $_POST['acti_all_cat'];
$mcheckaction     = $_POST['mcheckaction'];
$mcheckaction2    = $_POST['mcheckaction2'];
$delcheckconf     = $_POST['delcheckconf'];


            if     ($sortcheck == "title_down") {$q02sort = "ORDER BY movie_title ASC";}
            elseif ($sortcheck == "title_up")   {$q02sort = "ORDER BY movie_title DESC";}
            elseif ($sortcheck == "cat_down")   {$q02sort = "ORDER BY cat_name ASC";}
            elseif ($sortcheck == "cat_up")     {$q02sort = "ORDER BY Cat_name DESC";}
            else   {$q02sort = "ORDER by timestamp DESC";}


$disable_check_form = "false";





// *************** Approve page ***************

if (!$approvecheck == ""){

$disable_button = "false";
$diable_button_message  = "";

$query03          = "SELECT * FROM ".MPREFIX."er_ytm_gallery_movies gm
                    LEFT JOIN ".MPREFIX."er_ytm_gallery_category gg ON gm.movie_category = gg.cat_id
                    WHERE movie_id = '$approvecheck'";
$result           = mysql_query($query03);
$row              = mysql_fetch_array($result,MYSQL_ASSOC);
$approve_movie_title    = $row['movie_title'];
$approve_movie_code     = $row['movie_code'];
$approve_movie_user     = $row['input_user'];
$approve_movie_time     = $row['timestamp'];
$approve_movie_cat      = $row['cat_id'];
$approve_movie_mail     = $row['input_email'];
$approve_movie_comment  = $row['input_comment'];

$text .= "<form name='approve_movie_form' method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_SUBM_PREFS_18 . "</strong></td></tr>
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_2 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='approve_title' value='$approve_movie_title' size='60' maxlength='100' /><br />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_PREFS_0 . "</td>
<td style='width:70%' class='forumheader3'><input DISABLED class='tbox' type='text' name='approve_code' value='$approve_movie_code' size='60' maxlength='100' />
<input class='tbox' type='hidden' name='approve_id' value='$approvecheck' size='1'/></td>
</tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_3 . "</td>
<td style='width:70%' class='forumheader3'>";

      $query05        = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category";
      $result05       = mysql_query($query05);
      $num_rows05     = mysql_num_rows($result05);

      if ($num_rows05 < 1) {

$text .= LAN_YTM_SUBM_PREFS_20;
$disable_button = "true";
$diable_button_message  = LAN_YTM_SUBM_PREFS_19;

      }else{

$text .="<select style='width:180px' class='tbox' name='approve_category' >";

      while ($row05   = mysql_fetch_array($result05,MYSQL_ASSOC)) {
      $cat_id         = $row05['cat_id'];
      $cat_name       = $row05['cat_name'];

if ($cat_id == $approve_movie_cat) {$selected_cat="SELECTED";}else{$selected_cat = "";}

$text .="<option $selected_cat value='$cat_id' >$cat_name</option>";}
$text .="</select>";}
$text .="</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_5 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' DISABLED value='$approve_movie_user' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_24 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' DISABLED value='$approve_movie_mail' size='60' maxlength='100' />";

      if ($approve_movie_mail) {$text .= "&nbsp;<a href='mailto:$approve_movie_mail?subject=". LAN_YTM_SUBM_PREFS_26 .": $approve_movie_title'><img src='". e_IMAGE_ABS . "admin_images/mail_16.png' title='" . LAN_YTM_SUBM_PREFS_25 . "' border='0' /></a>";}

$text .= "</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_12 . "</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' DISABLED value='$approve_movie_time' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_13 . "</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' DISABLED rows='5' cols='60'>$approve_movie_comment</textarea>
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>" . LAN_YTM_SUBM_PREFS_48 . "</td>
<td style='width:70%' class='forumheader3'><input type='checkbox' name='approve_active' CHECKED VALUE='active'>
<input class='tbox' type='hidden' name='approve_check' value='check' size='1'/></td></td></tr>";

$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'>
<input type='button' value='" . LAN_YTM_SUBM_PREFS_22 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">
<input type='submit' name='approve_movie_submit' value='" . LAN_YTM_SUBM_PREFS_21 . "' class='button' />\n
&nbsp;$diable_button_message</td></tr></table></form>";

$text .="<SCRIPT language='JavaScript'>
document.approve_movie_form.approve_movie_submit.disabled=$disable_button;</SCRIPT>";

$ns->tablerender(LAN_YTM_SUBM_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}


// *************** Delete All page ***************

if (!$delallcheck == ""){

            if (!$mcheckaction == "") {

$text .= "<table class='fborder' width='97%'><tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_SUBM_PREFS_28 . "</strong></td></tr><tr><td style='width:100%' class='forumheader3'>";
$text .= "<center><img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' />";
$text .= "<br /><br />". LAN_YTM_SUBM_PREFS_57 ."?";
$text .= "<br /><br /><form name='delallconf' method='post' action='" . e_SELF . "'>";

      foreach($mcheckaction as $mcheckaction_action) {
      $text .= "<input type='hidden' name='mcheckaction2[]' value='$mcheckaction_action' \>";}

$text .= "<input type='hidden' name='delcheckconf' value='confirm' \>";

$text .= "<input type='button' value='" . LAN_YTM_SUBM_PREFS_31 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">";
$text .= "&nbsp;&nbsp;";
$text .= "<input type='submit' value='" . LAN_YTM_SUBM_PREFS_30 . "' class='button'>";
$text .= "</form></center></td></tr></table>";

$ns->tablerender(LAN_YTM_SUBM_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}
}


// *************** Delete page ***************

if (!$deletecheck == ""){

$query01          = "SELECT * FROM ".MPREFIX."er_ytm_gallery_movies WHERE movie_id = '$deletecheck'";
$result           = mysql_query($query01);
$row              = mysql_fetch_array($result,MYSQL_ASSOC);
$del_movie_title  = $row['movie_title'];

$text .= "<table class='fborder' width='97%'><tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_SUBM_PREFS_28 . "</strong></td></tr><tr><td style='width:100%' class='forumheader3'>";
$text .= "<center><img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' />";
$text .= "<br /><br /> ". LAN_YTM_SUBM_PREFS_29 ." $del_movie_title?";
$text .= "<br /><br /><form>";
$text .= "<input type='button' value='" . LAN_YTM_SUBM_PREFS_31 . "' class='button' onClick=\"parent.location='" . e_SELF . "'\">";
$text .= "&nbsp;&nbsp;";
$text .= "<input type='button' value='" . LAN_YTM_SUBM_PREFS_30 . "' class='button' onClick=\"parent.location='" . e_SELF . "?confirm_delete=$deletecheck'\">";
$text .= "</form></center></td></tr></table>";

$ns->tablerender(LAN_YTM_SUBM_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();
}


// *************** Actions ***************

// If approved a movie, change in database

if (!$approvalcheck == ""){
$store_movie_title = $_POST['approve_title'];
$store_movie_title = str_replace ("'","&#39;",$store_movie_title);
$store_movie_id    = $_POST['approve_id'];
$store_movie_cat   = $_POST['approve_category'];
$store_movie_acti  = $_POST['approve_active'];

      if ($store_movie_acti == "active") {$store_movie_acti = "1";}else{$store_movie_acti = "0";}
      
      mysql_query("update ".MPREFIX."er_ytm_gallery_movies set movie_title = '$store_movie_title', movie_category = '$store_movie_cat', active = '$store_movie_acti', input_status = '1' WHERE movie_id = '$store_movie_id';");
      $msgtext = LAN_YTM_SUBM_PREFS_23;

}

// If deleted a movie thrue checkboxes, remove from database
elseif (!$delcheckconf == ""){

            if (!$mcheckaction2 == "") {

            foreach($mcheckaction2 as $mcheckaction_action2) {

            mysql_query("DELETE FROM ".MPREFIX."er_ytm_gallery_movies WHERE movie_id ='$mcheckaction_action2'");
            }

            $msgtext = LAN_YTM_SUBM_PREFS_53;}

            }

// If approve a movie as active thrue checkboxes, set to database
elseif (!$actiallcheck == ""){

            if (!$mcheckaction == "") {

            foreach($mcheckaction as $mcheckaction_action) {

            mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set active = '1', input_status = '1' WHERE movie_id ='$mcheckaction_action'");
            }

            $msgtext = LAN_YTM_SUBM_PREFS_55;
            }

}


// If approve a movie as deactivated thrue checkboxes, set to database
elseif (!$deactiallcheck == ""){

            if (!$mcheckaction == "") {

            foreach($mcheckaction as $mcheckaction_action) {

            mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set active = '0', input_status = '1' WHERE movie_id ='$mcheckaction_action'");
            mysql_error();}

            $msgtext = LAN_YTM_SUBM_PREFS_54;
            }

}

// If category change thrue checkboxes, set to database
elseif (!$actiallcat == ""){

            if (!$mcheckaction == "") {

            foreach($mcheckaction as $mcheckaction_action) {

            mysql_query("UPDATE ".MPREFIX."er_ytm_gallery_movies set movie_category = '$actiallcat' WHERE movie_id ='$mcheckaction_action'");
            }

            $msgtext = LAN_YTM_SUBM_PREFS_56;}
}
            
// If deleted a movie, remove from database
elseif (!$deleteconfirm == ""){

      mysql_query("DELETE FROM ".MPREFIX."er_ytm_gallery_movies WHERE movie_id ='$deleteconfirm'");
      $msgtext = LAN_YTM_SUBM_PREFS_32;

}else{
$msgtext = "";
}





// ***************     Main page      ***************


// Movie submitted overview
$text .= "
<table class='fborder' width='97%'><form name='checkform' method='post' action='" . e_SELF . "'>
<tr><td class='forumheader3' colspan='4'><strong>" . LAN_YTM_SUBM_PREFS_0 . "</strong>
</td></tr><font color='red'>$msgtext</font>";

$text .= "<tr>
<td style='width:5%' class='fcaption'><input type='checkbox' name='checkall' onclick=\"checkUncheckAll(this);\"/></td>

<td style='width:45%' class='fcaption'><b><u>" . LAN_YTM_SUBM_PREFS_2 . "</u></b>
      <a href='" . e_SELF . "?sort=title_down' title='". LAN_YTM_SUBM_PREFS_33 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortdown.png' border='0' /></a>
      <a href='" . e_SELF . "?sort=title_up' title='". LAN_YTM_SUBM_PREFS_34 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortup.png' border='0' /></a></td>
      
<td style='width:15%' class='fcaption'><b><u>" . LAN_YTM_SUBM_PREFS_3 . "</u></b>
      <a href='" . e_SELF . "?sort=cat_down' title='". LAN_YTM_SUBM_PREFS_35 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortdown.png' border='0' /></a>
      <a href='" . e_SELF . "?sort=cat_up' title='". LAN_YTM_SUBM_PREFS_36 ."'>
      <img src='".e_PLUGIN."ytm_gallery/images/sortup.png' border='0' /></a></td>

<td style='width:40%' class='fcaption'><b><u>" . LAN_YTM_SUBM_PREFS_4 . "</u></b>";
$text .= "</td></tr>";

// Get Movies
$query02  = "
SELECT * FROM ".MPREFIX."er_ytm_gallery_movies gm
LEFT JOIN ".MPREFIX."er_ytm_gallery_category gg ON gm.movie_category = gg.cat_id
WHERE input_status = '0' AND input_way = '2' $q02sort";
                             
$result     = mysql_query($query02);
$num_rows02 = mysql_num_rows($result);

      if ($num_rows02 < 1) {

$disable_check_form = "true";
$text .="<tr><td colspan='5' class='forumheader3' style='text-align: left;'><br />" . LAN_YTM_SUBM_PREFS_15 . "<br /><br /></td></tr>";

      }else{
      
$movie_i = 1;

while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
$movie_title = $row['movie_title'];
$movie_category = $row['cat_name'];
$movie_user = $row['input_user'];
$movie_comment = $row['input_comment'];
$movie_time = $row['timestamp'];
$movie_code = $row['movie_code'];
$movie_id   = $row['movie_id'];

// Display movies
$text .= "<tr>
<td style='width:5%' class='forumheader3'><input type='checkbox' name='mcheckaction[]' value='$movie_id'/></td>
<td style='width:30%' class='forumheader3'><a href='admin_config_preview.php?commentmovie=$movie_id' title='" . LAN_YTM_SUBM_PREFS_2 . ": $movie_title - " . LAN_YTM_SUBM_PREFS_5 . ": $movie_user " . LAN_YTM_SUBM_PREFS_6 . ": $movie_time' onclick=\"window.open('admin_config_preview.php?commentmovie=$movie_id','movie','width=550,height=550,scrollbars=yes,toolbar=no,location=no,resizable=yes,menubar=no,directories=no,status=no'); return false\">$movie_title</a></td>
<td style='width:30%' class='forumheader3'>$movie_category</td>
<td style='width:30%' class='forumheader3'>
<a href='admin_config_preview.php?commentmovie=$movie_id' title='". LAN_YTM_SUBM_PREFS_10 .": $movie_comment' onclick=\"window.open('admin_config_preview.php?commentmovie=$movie_id','movie','width=550,height=550,scrollbars=yes,toolbar=no,location=no,resizable=yes,menubar=no,directories=no,status=no'); return false\"><img src='". e_IMAGE_ABS . "admin_images/content_16.png' border='0' /></a>
<a href='" . e_SELF . "?approve=$movie_id' title='". LAN_YTM_SUBM_PREFS_11 ."'><img src='".e_PLUGIN."ytm_gallery/images/approve.gif' border='0' /></a>
<a href='" . e_SELF . "?delete=$movie_id' title='". LAN_YTM_SUBM_PREFS_9 ." $movie_title'><img src='". e_IMAGE_ABS . "admin_images/delete_16.png' border='0' /></a>
";
$text .= "</td></tr>";
$movie_i++;
}
}

$text .= "<tr><td colspan='5' class='fcaption' style='text-align: left;'>
<input class='button' type='submit' name='del_all_com' value='" . LAN_YTM_SUBM_PREFS_50 . "'>
<input class='button' type='submit' name='deacti_all_comm' value='" . LAN_YTM_SUBM_PREFS_51 . "'>
<input class='button' type='submit' name='acti_all_comm' value='" . LAN_YTM_SUBM_PREFS_52 . "'>
<select style='width:180px' class='tbox' name='acti_all_cat' onchange=checkform.submit()>
<option value=''>". LAN_YTM_SUBM_PREFS_58 ."</option>";

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


$ns->tablerender(LAN_YTM_SUBM_PREFS, $text);

require_once(e_ADMIN . "footer.php");
?>
