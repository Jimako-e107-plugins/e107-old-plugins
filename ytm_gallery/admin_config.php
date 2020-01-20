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
require_once("./plugin.php");

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

// Check if upgrade is done
$query20  = "SELECT plugin_version FROM ".MPREFIX."plugin WHERE plugin_path = 'ytm_gallery'";
$result20 = mysql_query($query20);
while ($row20 = mysql_fetch_array($result20,MYSQL_ASSOC)) {
$inst_version = $row20['plugin_version'];
}

if ($inst_version <> $eplug_version){
$text .="<center>";
$text .="<img src='". e_IMAGE_ABS . "admin_images/nopreview.png' border='0' /><br />";
$text .= LAN_YTM_PREFS_37;
$text .="</center>";

$ns->tablerender(LAN_YTM_PREFS, $text);

require_once(e_ADMIN . "footer.php");
exit();

}else{

$subcheck      = $_POST['submit_check'];
$tg_dislan     = LAN_YTM_PREFS_14;
$tf_dislan     = LAN_YTM_PREFS_15;
$tm_dislan     = LAN_YTM_PREFS_16;
$sc_dislan     = LAN_YTM_PREFS_17;
$st_dislan     = LAN_YTM_PREFS_18;
$rm_dislan     = LAN_YTM_PREFS_19;
$sm_dislan     = LAN_YTM_PREFS_20;
$mc_dislan     = LAN_YTM_PREFS_21;
$mr_dislan     = LAN_YTM_PREFS_22;
$mw_dislan     = LAN_YTM_PREFS_23;
$mh_dislan     = LAN_YTM_PREFS_24;
$bb_dislan     = LAN_YTM_PREFS_8;
$un_dislan     = LAN_YTM_PREFS_28;
$go_dislan     = LAN_YTM_PREFS_32;
$dt_dislan     = LAN_YTM_PREFS_33;
$as_dislan     = LAN_YTM_PREFS_34;
$ss_dislan     = LAN_YTM_PREFS_39;
$sd_dislan     = LAN_YTM_PREFS_40;
$at_dislan     = LAN_YTM_PREFS_41;
$rc_dislan     = LAN_YTM_PREFS_44;
$dr_dislan     = LAN_YTM_PREFS_46;
$tr_dislan     = LAN_YTM_PREFS_47;
$tp_dislan     = LAN_YTM_PREFS_49;

// *************** Submitting ***************

if (!$subcheck == ""){

      $store_titl_gal      = $_POST['title_gallery'];
      $store_titl_form     = $_POST['title_form'];
      $store_titl_menu     = $_POST['title_menu'];
      $store_titl_rat      = $_POST['title_rating'];
      $store_titl_tp       = $_POST['title_tp'];
      $store_subm_class    = $_POST['submit_class'];
      $store_subm_text     = $_POST['submit_text'];
      $store_random_menu   = $_POST['random_menu'];
      $store_static_menu   = $_POST['stactic_menu'];
      $store_movie_colum   = $_POST['movie_colum'];
      $store_movie_row     = $_POST['movie_row'];
      $store_menu_width    = $_POST['menu_width'];
      $store_menu_height   = $_POST['menu_height'];
      $store_bb_class      = $_POST['bb_class'];
      $store_username      = $_POST['username'];
      $store_gal_ordening  = $_POST['gal_ordering'];
      $store_dis_title     = $_POST['dis_title'];
      $store_appr_subm     = $_POST['appr_subm'];
      $store_show_search   = $_POST['show_search'];
      $store_show_download = $_POST['show_download'];
      $store_short_title   = $_POST['short_title'];
      $store_short_title_c = $_POST['short_title_c'];
      $store_rate_class    = $_POST['ytm_rate_class'];
      $store_disp_rate     = $_POST['disp_rate'];

      $store_titl_gal   = str_replace ("'","&#39;",$store_titl_gal);
      $store_titl_form  = str_replace ("'","&#39;",$store_titl_form);
      $store_titl_menu  = str_replace ("'","&#39;",$store_titl_menu);
      $store_titl_rat   = str_replace ("'","&#39;",$store_titl_rat);
      $store_titl_tp    = str_replace ("'","&#39;",$store_titl_tp);
      $store_subm_text  = str_replace ("'","&#39;",$store_subm_text);

$store_ok = "1";

      if (!is_numeric($store_movie_colum))      {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mc_dislan = "<font color='red'>$mc_dislan</font>";}
      if (!is_numeric($store_movie_row))        {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mr_dislan = "<font color='red'>$mr_dislan</font>";}
      if (!is_numeric($store_menu_width))       {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mw_dislan = "<font color='red'>$mw_dislan</font>";}
      if (!is_numeric($store_menu_height))      {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mh_dislan = "<font color='red'>$mh_dislan</font>";}
      if (!is_numeric($store_short_title_c))    {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $at_dislan = "<font color='red'>$at_dislan</font>";}
      if ($store_movie_colum == "")             {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mc_dislan = "<font color='red'>$mc_dislan</font>";}
      if ($store_movie_row == "")               {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mr_dislan = "<font color='red'>$mr_dislan</font>";}
      if ($store_menu_width == "")              {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mw_dislan = "<font color='red'>$mw_dislan</font>";}
      if ($store_menu_height == "")             {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $mh_dislan = "<font color='red'>$mh_dislan</font>";}
      if ($store_titl_gal == "")                {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $tg_dislan = "<font color='red'>$tg_dislan</font>";}
      if ($store_titl_form == "")               {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $tf_dislan = "<font color='red'>$tf_dislan</font>";}
      if ($store_titl_menu == "")               {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $tm_dislan = "<font color='red'>$tm_dislan</font>";}
      if ($store_titl_rat == "")                {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $tr_dislan = "<font color='red'>$tr_dislan</font>";}
      if ($store_titl_tp == "")                 {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $tp_dislan = "<font color='red'>$tp_dislan</font>";}
      if ($store_subm_text == "")               {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $st_dislan = "<font color='red'>$st_dislan</font>";}
      if ($store_gal_ordening == "")            {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $st_dislan = "<font color='red'>$go_dislan</font>";}


      if ($store_random_menu == "0") {
      
                  if ($store_static_menu == "") {$store_ok = "0";  $msgtext = LAN_YTM_PREFS_25;  $rm_dislan = "<font color='red'>$rm_dislan</font>"; $sm_dislan = "<font color='red'>$sm_dislan</font>";}

                                    }
      
      if ($store_ok == "1") {
      mysql_query("UPDATE ".MPREFIX."er_ytm_gallery SET
      username = '$store_username',
      title_gallery = '$store_titl_gal',
      title_form = '$store_titl_form',
      title_menu = '$store_titl_menu',
      title_rating = '$store_titl_rat',
      title_tp = '$store_titl_tp',
      submit_class = '$store_subm_class',
      submit_text = '$store_subm_text',
      random_menu = '$store_random_menu',
      static_menu = '$store_static_menu',
      movie_colum = '$store_movie_colum',
      movie_row = '$store_movie_row',
      menu_width = '$store_menu_width',
      menu_height = '$store_menu_height',
      bb_class = '$store_bb_class',
      gal_order = '$store_gal_ordening',
      disp_title = '$store_dis_title',
      ap_submit = '$store_appr_subm',
      disp_search = '$store_show_search',
      disp_download = '$store_show_download',
      short_title = '$store_short_title',
      short_title_count = '$store_short_title_c',
      ytm_rate_class = '$store_rate_class',
      disp_rate = '$store_disp_rate'
      WHERE id ='1';");
      $msgtext = LAN_YTM_PREFS_5;}

}else{


      $query                = "SELECT * from ".MPREFIX."er_ytm_gallery WHERE id = '1'";
      $result               = mysql_query($query);
      $row                  = mysql_fetch_array($result,MYSQL_ASSOC);
      $store_username       = $row['username'];
      $store_titl_gal       = $row['title_gallery'];
      $store_titl_form      = $row['title_form'];
      $store_titl_menu      = $row['title_menu'];
      $store_titl_rat       = $row['title_rating'];
      $store_titl_tp        = $row['title_tp'];
      $store_subm_class     = $row['submit_class'];
      $store_subm_text      = $row['submit_text'];
      $store_random_menu    = $row['random_menu'];
      $store_static_menu    = $row['static_menu'];
      $store_movie_colum    = $row['movie_colum'];
      $store_movie_row      = $row['movie_row'];
      $store_menu_width     = $row['menu_width'];
      $store_menu_height    = $row['menu_height'];
      $store_bb_class       = $row['bb_class'];
      $store_gal_ordening   = $row['gal_order'];
      $store_dis_title      = $row['disp_title'];
      $store_appr_subm      = $row['ap_submit'];
      $store_show_search    = $row['disp_search'];
      $store_show_download  = $row['disp_download'];
      $store_short_title    = $row['short_title'];
      $store_short_title_c  = $row['short_title_count'];
      $store_rate_class     = $row['ytm_rate_class'];
      $store_disp_rate      = $row['disp_rate'];
}



// *************** Submit Form ***************

$text .= "<form name='pref_form' method='post' action='" . e_SELF . "'>
<table class='fborder' width='97%'>
<tr><td class='fcaption' colspan='2'><strong>" . LAN_YTM_PREFS_4 . "</strong></td></tr>
<tr><td style='width:30%' class='forumheader3'>$un_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='username' value='$store_username' size='60' maxlength='100' /><br />
</td></tr><font color='red'>$msgtext</font>";

$text .= "<tr><td style='width:30%' class='forumheader3'>$tg_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='title_gallery' value='$store_titl_gal' size='60' maxlength='100' />
</td></tr>";


$text .= "
<tr><td style='width:30%' class='forumheader3'>$tf_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='title_form' value='$store_titl_form' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$tm_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='title_menu' value='$store_titl_menu' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$tr_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='title_rating' value='$store_titl_rat' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$tp_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='title_tp' value='$store_titl_tp' size='60' maxlength='100' />
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$sc_dislan</td>
<td style='width:70%' class='forumheader3'>";
$text .= r_userclass("submit_class",$store_subm_class, $optlist = 'public, guest, nobody, member, admin, classes' );
$text .="</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$rc_dislan</td>
<td style='width:70%' class='forumheader3'>";
$text .= r_userclass("ytm_rate_class",$store_rate_class, $optlist = 'public, guest, nobody, member, admin, classes' );
$text .="&nbsp;<img src='". e_IMAGE_ABS . "admin_images/docs_16.png' title='" . LAN_YTM_PREFS_45 . "' border='0' /></td></tr>";

// Approve submittal
$text .= "
<tr><td style='width:30%' class='forumheader3'>$as_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_appr_subm == "1") {$sel_app_01 = "SELECTED";}
      if ($store_appr_subm == "0") {$sel_app_00 = "SELECTED";}

$text .= "
<select class='tbox' name='appr_subm' >
<option $sel_app_01 value='1' >". LAN_YTM_PREFS_9 . "</option>
<option $sel_app_00 value='0' >". LAN_YTM_PREFS_10 . "</option>
</select></td></tr>";

// Enable rating
$text .= "
<tr><td style='width:30%' class='forumheader3'>$dr_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_disp_rate == "1") {$sel_d_rate_01 = "SELECTED";}
      if ($store_disp_rate == "0") {$sel_d_rate_00 = "SELECTED";}

$text .= "
<select class='tbox' name='disp_rate' >
<option $sel_d_rate_01 value='1' >". LAN_YTM_PREFS_9 . "</option>
<option $sel_d_rate_00 value='0' >". LAN_YTM_PREFS_10 . "</option>
</select>&nbsp;<img src='". e_IMAGE_ABS . "admin_images/docs_16.png' title='" . LAN_YTM_PREFS_48 . "' border='0' /></td></tr>";

// Show search
$text .= "
<tr><td style='width:30%' class='forumheader3'>$ss_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_show_search == "0") {$sel_ss_00 = "SELECTED";}
      if ($store_show_search == "1") {$sel_ss_01 = "SELECTED";}

$text .= "
<select class='tbox' name='show_search' >
<option $sel_ss_00 value='0' >". LAN_YTM_PREFS_10 . "</option>
<option $sel_ss_01 value='1' >". LAN_YTM_PREFS_9 . "</option>
</select></td></tr>";

// Show download
$text .= "
<tr><td style='width:30%' class='forumheader3'>$sd_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_show_download == "0") {$sel_sd_00 = "SELECTED";}
      if ($store_show_download == "1") {$sel_sd_01 = "SELECTED";}

$text .= "
<select class='tbox' name='show_download' >
<option $sel_sd_00 value='0' >". LAN_YTM_PREFS_10 . "</option>
<option $sel_sd_01 value='1' >". LAN_YTM_PREFS_9 . "</option>
</select></td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$st_dislan</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' name='submit_text' rows='5' cols='60'>$store_subm_text</textarea>
</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$rm_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_random_menu == "1") {$sel_menu_01 = "SELECTED";}
      if ($store_random_menu == "0") {$sel_menu_00 = "SELECTED";}
      
$text .= "
<select style='width:180px' class='tbox' name='random_menu' >
<option $sel_menu_01 value='1' >". LAN_YTM_PREFS_11 . "</option>
<option $sel_menu_00 value='0' >". LAN_YTM_PREFS_12 . "</option>
</select>&nbsp;<img src='". e_IMAGE_ABS . "admin_images/docs_16.png' title='" . LAN_YTM_PREFS_26 . "' border='0' /></td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$sm_dislan</td>
<td style='width:70%' class='forumheader3'>";

      $query02        = "SELECT movie_title, movie_code FROM ".MPREFIX."er_ytm_gallery_movies WHERE active = '1' AND input_status = '1'";
      $result02       = mysql_query($query02);

$text .= "
<select style='width:180px' class='tbox' name='stactic_menu' >
<option value='' >". LAN_YTM_PREFS_13 . "</option>";

      while ($row02   = mysql_fetch_array($result02,MYSQL_ASSOC)) {
      $c_movie_titl     = $row02['movie_title'];
      $c_movie_code     = $row02['movie_code'];

      if ($c_movie_code == $store_static_menu) {$selected_movie="SELECTED";}else{$selected_movie = "";}

$text .="<option $selected_movie value='$c_movie_code' >$c_movie_titl</option>";}
$text .="</select>&nbsp;<img src='". e_IMAGE_ABS . "admin_images/docs_16.png' title='" . LAN_YTM_PREFS_27 . "' border='0' /></td></tr>";


      if ($store_gal_ordening == "1") {$sel_gal_ord_01 = "SELECTED";}
      if ($store_gal_ordening == "2") {$sel_gal_ord_02 = "SELECTED";}

$text .= "
<tr><td style='width:30%' class='forumheader3'>$go_dislan</td>
<td style='width:70%' class='forumheader3'>
<select style='width:180px' class='tbox' name='gal_ordering' >
<option $sel_gal_ord_01 value='1' >". LAN_YTM_PREFS_30 . "</option>
<option $sel_gal_ord_02 value='2' >". LAN_YTM_PREFS_31 . "</option>
</select></td></tr>";

// Show Title
$text .= "
<tr><td style='width:30%' class='forumheader3'>$dt_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_dis_title == "1") {$sel_dt_01 = "SELECTED";}
      if ($store_dis_title == "2") {$sel_dt_02 = "SELECTED";}
      if ($store_dis_title == "0") {$sel_dt_00 = "SELECTED";}


$text .= "
<select style='width:180px' class='tbox' name='dis_title' >
<option $sel_dt_01 value='1' >". LAN_YTM_PREFS_35 . "</option>
<option $sel_dt_02 value='2' >". LAN_YTM_PREFS_38 . "</option>
<option $sel_dt_00 value='0' >". LAN_YTM_PREFS_36 . "</option>
</select></td></tr>";

// Shorten Title
$text .= "
<tr><td style='width:30%' class='forumheader3'>$at_dislan</td>
<td style='width:70%' class='forumheader3'>";

      if ($store_short_title == "0") {$sel_at_00 = "SELECTED";}
      if ($store_short_title == "1") {$sel_at_01 = "SELECTED";}

$text .= "
<select class='tbox' name='short_title' >
<option $sel_at_00 value='0' >". LAN_YTM_PREFS_10 . "</option>
<option $sel_at_01 value='1' >". LAN_YTM_PREFS_9 . "</option>
</select> ". LAN_YTM_PREFS_42 . "

<input class='tbox' type='text' name='short_title_c' value='$store_short_title_c' size='5' maxlength='3' /> ". LAN_YTM_PREFS_43 . "";
$text .= "</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$mc_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='movie_colum' value='$store_movie_colum' size='60' maxlength='2' />";
$text .= "</td></tr>";


$text .= "
<tr><td style='width:30%' class='forumheader3'>$mr_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='movie_row' value='$store_movie_row' size='60' maxlength='2' />";
$text .= "</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$mw_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='menu_width' value='$store_menu_width' size='60' maxlength='3' />";
$text .= "</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$mh_dislan</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text' name='menu_height' value='$store_menu_height' size='60' maxlength='3' />";
$text .= "</td></tr>";

$text .= "
<tr><td style='width:30%' class='forumheader3'>$bb_dislan</td>
<td style='width:70%' class='forumheader3'>";
$text .= r_userclass("bb_class",$store_bb_class, $optlist = 'public, guest, nobody, member, admin, classes' );
$text .= "<input class='tbox' type='HIDDEN' name='submit_check' value='1' size='1' maxlength='1' /></td></tr>";

$text .= "
<tr><td colspan='2' class='fcaption' style='text-align: left;'>
<input type='submit' name='pref_submit_button' value='" . LAN_YTM_PREFS_3 . "' class='button' />\n
</td></tr></table></form>";





$ns->tablerender(LAN_YTM_PREFS, $text);

require_once(e_ADMIN . "footer.php");
}
?>
