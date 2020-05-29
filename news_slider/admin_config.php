<?php
/*
+---------------------------------------------------------------+
|        News Slider
|	 Autor ***RuSsE***
|	http://www.e107.4xa.de e107-Temlates.de    
|
|        For the e107 website system
|        Â©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!getperms("P")) {
   header("location:".e_HTTP."index.php");
   exit;
}
$lan_file = e_PLUGIN."news_slider/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."news_slider/languages/German.php");
//
if (isset($_POST['updatepagesets'])) {
		$pref['news_slider_news_list'] = $_POST['news_slider_news_list'];
    $pref['news_slider_count'] = $_POST['news_slider_count'];
		$pref['news_slider_time'] = $_POST['news_slider_time'];
		$pref['news_slider_news_list_count'] = $_POST['news_slider_news_list_count'];
		$pref['news_slider_news_list2'] = $_POST['news_slider_news_list2'];
		$pref['news_slider_kategorien_show'] = $_POST['news_slider_kategorien_show'];
		$pref['news_slider_kategorien_show_nfp_display'] = $_POST['news_slider_kategorien_show_nfp_display'];
		$pref['news_slider_chars'] = $_POST['news_slider_chars'];
		$pref['news_slider_class'] = $_POST['news_slider_class'];
		$pref['news_slider_sticky'] = $_POST['news_slider_sticky'];
		//news_sticky
    header("Location: ".e_SELF); // Required to get the right extended field status

    save_prefs();
}
$ret ="<select class='tbox' style='width:200px'  name='news_slider_class'><option></option>";
$checked = ($pref['news_slider_class'] == 'forumheader')? " selected='selected'" : "";
$ret .="<option value='forumheader' $checked >forumheader</option>"; 							
$checked = ($pref['news_slider_class'] == 'forumheader2')? " selected='selected'" : "";
$ret .="<option value='forumheader2' $checked >forumheader2</option>"; 						
$checked = ($pref['news_slider_class'] == 'forumheader3')? " selected='selected'" : "";
$ret .="<option value='forumheader3' $checked >forumheader3</option>";						
$checked = ($pref['news_slider_class'] == 'fcaption')? " selected='selected'" : "";
$ret .="<option value='fcaption' $checked >fcaption</option>";						
$ret .="</select>";



require_once(e_ADMIN."auth.php");
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}
  $text = "<div style='text-align:center'>
  <form method='post' action='".e_SELF."'>
 		<table style='width:100%' class='fborder'>";
/*		
$text .= "		
      <tr>
        <td style='vertical-align:top;' colspan='2' class='fcaption'>".vv."</td>
      </tr>
			<tr>
			<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_21."</td>
       <td style='width:60%;vertical-align:top;' class='forumheader3'> 
           ".$ret."
       </td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_9."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'> 
        <input style='width: 40px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='news_slider_chars' type='text' value='".$pref['news_slider_chars']."' /> ".NEWSSLIDER_LAN_10."     
        </td>
		</tr>";
*/
		
$text .= "		
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_11."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'> 
        <input style='width: 40px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='news_slider_count' type='text' value='".$pref['news_slider_count']."' />     
        </td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_12."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'> 
        <input style='width: 40px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='news_slider_time' type='text' value='".$pref['news_slider_time']."' /> ".NEWSSLIDER_LAN_13."     
        </td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_22."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='news_slider_sticky' type='checkbox' value='1' ".($pref['news_slider_sticky']==1?" checked='checked' ":"")." /></td>
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_14."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='news_slider_news_list' type='checkbox' value='1' ".($pref['news_slider_news_list']==1?" checked='checked' ":"")." />     
    ".($pref['news_slider_news_list']==1?"&nbsp;<b>".NEWSSLIDER_LAN_15."</b>&nbsp;<input style='width: 20px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='news_slider_news_list_count' type='text' value='".$pref['news_slider_news_list_count']."' />&nbsp;
    <b>".NEWSSLIDER_LAN_16."</b> &nbsp;<input name='news_slider_news_list2' type='checkbox' value='1' ".($pref['news_slider_news_list2']==1?" checked='checked' ":"")." />
                                ":"")." 
     	</td>  
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_17."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='news_slider_kategorien_show' type='checkbox' value='1' ".($pref['news_slider_kategorien_show']==1?" checked='checked' ":"")." /></td>  
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".NEWSSLIDER_LAN_18."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='news_slider_kategorien_show_nfp_display' type='checkbox' value='1' ".($pref['news_slider_kategorien_show_nfp_display']==1?" checked='checked' ":"")." /></td>
		</tr>
    <tr>
        <td colspan='2' class='fcaption'><div align='center'><input class='button' name='updatepagesets' type='submit' value='".NEWSSLIDER_LAN_19."' /></div></td>
     </tr>
        </table></form></div>";

$ns->tablerender("<div style='text-align:center'>".NEWSSLIDER_LAN_20."</div>", $text);

require_once(e_ADMIN."footer.php");

?>