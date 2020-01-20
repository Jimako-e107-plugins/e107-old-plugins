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
if (!defined('e107_INIT'))
{
    exit;
}

require_once(HEADERF);
$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");

$query03   = "SELECT * from ".MPREFIX."er_ytm_gallery WHERE id = '1'";

      $result03      = mysql_query($query03);
      $row03         = mysql_fetch_array($result03,MYSQL_ASSOC);
      $page_title    = $row03['title_form'];
      $submit_text   = $row03['submit_text'];
      $gallery_title = $row03['title_gallery'];
      $submit_class  = $row03['submit_class'];
      $set_appr      = $row03['ap_submit'];

if(!check_class($submit_class)) {

   $text .= LAN_YTM_SUBM_PREFS_49;
   $ns->tablerender($page_title, $text);
   require_once(FOOTERF);
   exit();
}

$subcheck      = $_POST['submit_check'];
$codevalue     = LAN_YTM_SUBM_PREFS_39;

$titledislan    = LAN_YTM_SUBM_PREFS_37;
$codedislan     = LAN_YTM_SUBM_PREFS_38;
$catdislan      = LAN_YTM_SUBM_PREFS_3;
$userdislan     = LAN_YTM_SUBM_PREFS_41;
$maildislan     = LAN_YTM_SUBM_PREFS_24;
$commentdislan  = LAN_YTM_SUBM_PREFS_13;


// *************** Submitting ***************

if (!$subcheck == ""){

$store_title      = $_POST['submit_title'];
$store_code       = $_POST['submit_code'];
$store_category   = $_POST['submit_category'];
$store_user       = $_POST['submit_user'];
$store_mail       = $_POST['submit_mail'];
$store_comment    = $_POST['submit_comment'];

      $store_title    = str_replace ("'","&#39;",$store_title);
      $store_comment  = str_replace ("'","&#39;",$store_comment);
      $store_user     = str_replace ("'","&#39;",$store_user);
      
$store_ok = "1";

      if (!check_email($store_mail))            {$store_ok = "0";  $msgtext = LAN_YTM_SUBM_PREFS_44;  $maildislan = "<font color='red'>$maildislan</font>";}
      if ($store_title == "")                   {$store_ok = "0";  $msgtext = LAN_YTM_SUBM_PREFS_44;  $titledislan = "<font color='red'>$titledislan</font>";}
      if ($store_code == "")                    {$store_ok = "0";  $msgtext = LAN_YTM_SUBM_PREFS_44;  $codedislan = "<font color='red'>$codedislan</font>";}
      if ($store_code == LAN_YTM_SUBM_PREFS_39) {$store_ok = "0";  $msgtext = LAN_YTM_SUBM_PREFS_44;  $codedislan = "<font color='red'>$codedislan</font>";}
      if ($store_category == "")                {$store_ok = "0";  $msgtext = LAN_YTM_SUBM_PREFS_44;  $catdislan = "<font color='red'>$catdislan</font>";}
      if ($store_user == "")                    {$store_ok = "0";  $msgtext = LAN_YTM_SUBM_PREFS_44;  $userdislan = "<font color='red'>$userdislan</font>";}

      $query04        = "SELECT movie_code FROM ".MPREFIX."er_ytm_gallery_movies";
      $result04       = mysql_query($query04);

      while ($row04   = mysql_fetch_array($result04,MYSQL_ASSOC)) {
      $already_sub    = $row04['movie_code'];

            if ($store_code == $already_sub)          {$store_ok = "0";  $msgtext .= LAN_YTM_SUBM_PREFS_47;}
            }




      if ($store_ok == "1") {

                if     ($set_appr == "1") {$ip_stat = "0";}
                elseif ($set_appr == "0") {$ip_stat = "1";}
                else   {$ip_stat = "1";}

      mysql_query("insert into ".MPREFIX."er_ytm_gallery_movies (movie_title, movie_code, movie_category, input_user, input_email, input_comment, input_way, input_status) VALUES ('$store_title', '$store_code' , '$store_category' , '$store_user' , '$store_mail' , '$store_comment' , '2', '$ip_stat');");

$text .= "$submit_text<br />" . LAN_YTM_SUBM_PREFS_45 . "$gallery_title" . LAN_YTM_SUBM_PREFS_46 . "";
$text .= "<script language=javascript>setTimeout(\"location.href='".e_PLUGIN."ytm_gallery/ytm.php'\", 5000);</script>";
$ns->tablerender($page_title, $text);
require_once(FOOTERF);
exit();

}else{

$codevalue = $store_code;
}}



// *************** Submit Form ***************
$mailvalue = "value='$store_mail'";
$uservalue = "value='$store_user'";


      if (USER) {
      $query02   = "SELECT user_email from ".MPREFIX."user WHERE user_name = '" . USERNAME ."'";
      $result02  = mysql_query($query02);
      $row02     = mysql_fetch_array($result02,MYSQL_ASSOC);
      $user_mail = $row02['user_email'];
      
                  $mailvalue = "value='$user_mail' READONLY";
                  $uservalue = "value='" . USERNAME . "' READONLY";
                  $userdislan = LAN_YTM_SUBM_PREFS_42;}

$text .= "<form name='submit_movie_form' method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_SUBM_PREFS_40 . "</strong></td></tr>
<tr><td style='width:30%' class='forumheader3'>$titledislan *</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='submit_title' value='$store_title' size='60' maxlength='100' /><br />
</td></tr><font color='red'>$msgtext</font>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$codedislan *</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='submit_code' value='$codevalue' size='60' maxlength='100' />&nbsp;<img src='". e_IMAGE_ABS . "admin_images/docs_16.png' title='" . LAN_YTM_MOVIE_PREFS_11 . "' border='0' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$catdislan *</td>
<td style='width:70%' class='forumheader3'>";

            $classes02 = e_CLASS_REGEXP;
            $classes02 = str_replace("(^|,)(", "", $classes02);
            $classes02 = str_replace(")(,|$)", "", $classes02);
            $classes02 = (explode("|",$classes02));


            $qspec02_i = 0;
            foreach($classes02 as $class02) {
            $qspec02 = $class02;
            if (!$qspec02_i == 0) {$pre_qspecq02 = "OR";}
            $qspecq02 .= "$pre_qspecq02 cat_auth = '$qspec02' ";
            $qspec02_i++;
            }
            $auth_spec02 .=  "($qspecq02)";

      $query01        = "SELECT * FROM ".MPREFIX."er_ytm_gallery_category WHERE $auth_spec02";
      $result01       = mysql_query($query01);
      $num_rows01     = mysql_num_rows($result01);

      if ($num_rows01 < 1) {

$text .= LAN_YTM_SUBM_PREFS_20;

      }else{

$text .="<select style='width:180px' class='tbox' name='submit_category' >";

      while ($row01   = mysql_fetch_array($result01,MYSQL_ASSOC)) {
      $cat_id         = $row01['cat_id'];
      $cat_name       = $row01['cat_name'];

      if ($cat_id == $store_category) {$selected_cat="SELECTED";}else{$selected_cat = "";}
      
$text .="<option $selected_cat value='$cat_id' >$cat_name</option>";}
$text .="</select>";}
$text .="</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$userdislan *</td>
<td style='width:70%' class='forumheader3'><input class='tbox' name='submit_user' $uservalue type='text' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$maildislan *</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='submit_mail' $mailvalue size='60' maxlength='100' />";

$text .= "</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$commentdislan</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' name='submit_comment' rows='5' cols='60'>$store_comment</textarea>
<input class='tbox' type='HIDDEN' name='submit_check' value='1' size='1' maxlength='1' /></td></tr>";

$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'>
<input type='button' value='" . LAN_YTM_SUBM_PREFS_22 . "' class='button' onClick=\"parent.location='".e_PLUGIN."ytm_gallery/ytm.php'\">
<input type='submit' name='movie_submit_button' value='" . LAN_YTM_SUBM_PREFS_43 . "' class='button' />\n
</td></tr></table></form>";


   $ns->tablerender($page_title, $text);
   require_once(FOOTERF);
?>
