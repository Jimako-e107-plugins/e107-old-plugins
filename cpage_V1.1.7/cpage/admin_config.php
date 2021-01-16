<?php
/**
*
* @version $Id$
* @copyright Barry Keal 2004 - 2009
* @author Barry Keal
*/
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT')) {
    exit;
}
if (!getperms("P")) {
    header("location:" . e_HTTP . "index.php");
    exit;
}

require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH")) {
    define(ADMIN_WIDTH, "width:100%");
}
if(!isset($pref['plug_installed']['prototype'])){
	print "REQUIRES Prototype plugin to be installed";
}

if (!is_object($cpage_obj)) {
    require_once("includes/cpage_class.php");
    $cpage_obj = new cpage;
}
$cpage_filedone = file_exists(e_BASE . 'cpage.php');
if (!$cpage_filedone) {
    $cpage_msgtext .= CPAGE_C12 . '<br />' ;
}
if (isset($_POST['cpageupdate'])) {
    // Update all config settings
    $cpage_seo_was = $CPAGE_PREF['cpage_seo'];
    $CPAGE_PREF['cpage_list'] = intval($_POST['cpage_list']);
    $CPAGE_PREF['cpage_redirect'] = intval($_POST['cpage_redirect']);
    $CPAGE_PREF['cpage_seo'] = intval($_POST['cpage_seo']);
    $CPAGE_PREF['cpage_revisions'] = intval($_POST['cpage_revisions']);
    $CPAGE_PREF['cpage_inmenu'] = intval($_POST['cpage_inmenu']);
    $CPAGE_PREF['cpage_rating_flag'] = intval($_POST['cpage_rating_flag']);
    $CPAGE_PREF['cpage_comment_flag'] = intval($_POST['cpage_comment_flag']);
    $CPAGE_PREF['cpage_showdate_flag'] = intval($_POST['cpage_showdate_flag']);
    $CPAGE_PREF['cpage_lastdate_flag'] = intval($_POST['cpage_lastdate_flag']);
    $CPAGE_PREF['cpage_showauthor_flag'] = intval($_POST['cpage_showauthor_flag']);
    $CPAGE_PREF['cpage_email_flag'] = intval($_POST['cpage_email_flag']);
    $CPAGE_PREF['cpage_print_flag'] = intval($_POST['cpage_print_flag']);
    $CPAGE_PREF['cpage_pdf_flag'] = intval($_POST['cpage_pdf_flag']);
    $CPAGE_PREF['cpage_views_flag'] = intval($_POST['cpage_views_flag']);
    $CPAGE_PREF['cpage_unique_flag'] = intval($_POST['cpage_unique_flag']);
    $CPAGE_PREF['cpage_page_flag'] = intval($_POST['cpage_page_flag']);
    $CPAGE_PREF['cpage_menu_flag'] = intval($_POST['cpage_menu_flag']);
    $CPAGE_PREF['cpage_class'] = intval($_POST['cpage_class']);
    $CPAGE_PREF['cpage_ip_restrict'] = $tp->toDB($_POST['cpage_ip_restrict']);
    $CPAGE_PREF['cpage_timeout'] = intval($_POST['cpage_timeout']);
    $CPAGE_PREF['cpage_category'] = intval($_POST['cpage_category']);
    $cpage_obj->save_prefs();
    $cpage_msg_type = 'success';
    $cpage_msgtext .= CPAGE_C05 ;
    if ($CPAGE_PREF['cpage_seo'] != $cpage_seo_was) {
        // seo setting change
        if ($CPAGE_PREF['cpage_seo'] == 1) {
            $result = $cpage_obj->regen_htaccess('on');
        } else {
            $result = $cpage_obj->regen_htaccess('off');
        }
        $cpage_msg_type = 'warning';
        $cpage_msgtext .= '<br />';
        switch ($result) {
            case 1:
                // can't create .htaccess
                $cpage_msgtext .= CPAGE_CP103 ;
                break;
            case 2:
                $cpage_msgtext .= CPAGE_CP104 ;
                break;
            case 3:
                $cpage_msgtext .= CPAGE_CP105 ;
                break;
            case 4:
                $cpage_msgtext .= CPAGE_CP106 ;
                break;
            case 5:
                $cpage_msgtext .= CPAGE_CP106 ;
                break;
            default:
                $cpage_msg_type = 'success';
                $cpage_msgtext .= CPAGE_CP107 ;
        } // switch
    }
}
$hta = e_BASE . '.htaccess';
$base_loc = e_HTTP;
$new_line[] = "#*** CUSTOM PAGE REWRITE BEGIN ***";
$new_line[] = 'RewriteEngine On';
$new_line[] = "RewriteBase $base_loc";
$new_line[] = 'RewriteRule cpage-([0-9]*)-([0-9]*)-([a-zA-Z0-9-]*)\.html(.*)$ cpage.php?$1.$2.$3 [L]';
$new_line[] = 'RewriteRule cpage.html cpage.php [L]';
$new_line[] = '#*** CUSTOM PAGE REWRITE END ***';
$cpage_rewrite = '<br /><br />' . implode("<br />", $new_line);

$cpage_text .= "
<form method='post' action='" . e_SELF . "' id='cpageconf'>
	<table style='" . ADMIN_WIDTH . "'  class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . CPAGE_C04 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'>" . $prototype_obj->message_box($cpage_msg_type, $cpage_msgtext) . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>" . CPAGE_C07 . "</b></td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_C15 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_redirect' id='cpage_redirect_on' value='1'" . ($CPAGE_PREF['cpage_redirect'] ? " checked='checked'" : "") . " /><label for='cpage_redirect_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_redirect' id='cpage_redirect_off' value='0'" . ($CPAGE_PREF['cpage_redirect'] ? "" : " checked='checked'") . " /><label for='cpage_redirect_off'> " . CPAGE_CP14 . "</label>  <img src='" . e_PLUGIN . "cpage/images/info_16.png' style='border:0px;'  onclick='expandit(\"cpage_confredir\");' />
				<br />
					<div id='cpage_confredir' style='display:none;'>
						<span class='smalltext'><i>" . CPAGE_CP113 . "</i></span>
					</div>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_C09 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<select class='tbox' name='cpage_list' >
					<option value='0' " . ($CPAGE_PREF['cpage_list'] == '0'?'selected="selected"':'') . ">" . CPAGE_C16 . "</option>
					<option value='1' " . ($CPAGE_PREF['cpage_list'] == '1'?'selected="selected"':'') . ">" . CPAGE_C17 . "</option>
					<option value='2' " . ($CPAGE_PREF['cpage_list'] == '2'?'selected="selected"':'') . ">" . CPAGE_C18 . "</option>
					<option value='3' " . ($CPAGE_PREF['cpage_list'] == '3'?'selected="selected"':'') . ">" . CPAGE_C19 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_C06 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_seo' id='cpage_seo_on' value='1'" . ($CPAGE_PREF['cpage_seo'] ? " checked='checked'" : "") . " /><label for='cpage_seo_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_seo' id='cpage_seo_off' value='0'" . ($CPAGE_PREF['cpage_seo'] ? "" : " checked='checked'") . " /><label for='cpage_seo_off'> " . CPAGE_CP14 . "</label> <img src='" . e_PLUGIN . "cpage/images/info_16.png' style='border:0px;'  onclick='expandit(\"cpage_confseo\");' />
					<br />
					<div id='cpage_confseo' style='display:none;'>
						<span class='smalltext'><i>" . CPAGE_C10 . "</i></span>$cpage_rewrite
					</div>
			</td>
		</tr>
				<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_C11 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_revisions' id='cpage_revisions_on' value='1'" . ($CPAGE_PREF['cpage_revisions'] ? " checked='checked'" : "") . " /><label for='cpage_revisions_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_revisions' id='cpage_revisions_off' value='0'" . ($CPAGE_PREF['cpage_revisions'] ? "" : " checked='checked'") . " /><label for='cpage_revisions_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP58 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='text' class='tbox' name='cpage_timeout'  value='" . $CPAGE_PREF['cpage_timeout'] . "' />

			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP72 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='text' class='tbox' name='cpage_inmenu'  value='" . $CPAGE_PREF['cpage_inmenu'] . "' />

			</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>" . CPAGE_C02 . "</b></td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP12 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_rating_flag' id='cpage_rating_flag_on' value='1'" . ($CPAGE_PREF['cpage_rating_flag'] ? " checked='checked'" : "") . " /><label for='cpage_rating_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_rating_flag' id='cpage_rating_flag_off' value='0'" . ($CPAGE_PREF['cpage_rating_flag'] ? "" : " checked='checked'") . " /><label for='cpage_rating_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP15 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_comment_flag' id='cpage_comment_flag_on' value='1'" . ($CPAGE_PREF['cpage_comment_flag'] ? " checked='checked'" : "") . " /><label for='cpage_comment_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_comment_flag' id='cpage_comment_flag_off' value='0'" . ($CPAGE_PREF['cpage_comment_flag'] ? "" : " checked='checked'") . " /><label for='cpage_comment_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP16 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_showdate_flag' id='cpage_showdate_flag_on' value='1'" . ($CPAGE_PREF['cpage_showdate_flag'] ? " checked='checked'" : "") . " /><label for='cpage_showdate_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_showdate_flag' id='cpage_showdate_flag_off' value='0'" . ($CPAGE_PREF['cpage_showdate_flag'] ? "" : " checked='checked'") . " /><label for='cpage_showdate_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP42 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_lastdate_flag' id='cpage_lastdate_flag_on' value='1'" . ($CPAGE_PREF['cpage_lastdate_flag'] ? " checked='checked'" : "") . " /><label for='cpage_lastdate_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_lastdate_flag' id='cpage_lastdate_flag_off' value='0'" . ($CPAGE_PREF['cpage_lastdate_flag'] ? "" : " checked='checked'") . " /><label for='cpage_lastdate_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP41 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_showauthor_flag' id='cpage_showauthor_flag_on' value='1'" . ($CPAGE_PREF['cpage_showauthor_flag'] ? " checked='checked'" : "") . " /><label for='cpage_showauthor_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_showauthor_flag' id='cpage_showauthor_flag_off' value='0'" . ($CPAGE_PREF['cpage_showauthor_flag'] ? "" : " checked='checked'") . " /><label for='cpage_showauthor_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP59 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_page_flag' id='cpage_page_flag_on' value='1'" . ($CPAGE_PREF['cpage_page_flag'] ? " checked='checked'" : "") . " /><label for='cpage_page_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_page_flag' id='cpage_page_flag_off' value='0'" . ($CPAGE_PREF['cpage_page_flag'] ? "" : " checked='checked'") . " /><label for='cpage_page_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP60 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_menu_flag' id='cpage_menu_flag_on' value='1'" . ($CPAGE_PREF['cpage_menu_flag'] ? " checked='checked'" : "") . " /><label for='cpage_menu_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_menu_flag' id='cpage_menu_flag_off' value='0'" . ($CPAGE_PREF['cpage_menu_flag'] ? "" : " checked='checked'") . " /><label for='cpage_menu_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>

				<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP61 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_email_flag' id='cpage_email_flag_on' value='1'" . ($CPAGE_PREF['cpage_email_flag'] ? " checked='checked'" : "") . " /><label for='cpage_email_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_email_flag' id='cpage_email_flag_off' value='0'" . ($CPAGE_PREF['cpage_email_flag'] ? "" : " checked='checked'") . " /><label for='cpage_email_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
				<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP62 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_print_flag' id='cpage_print_flag_on' value='1'" . ($CPAGE_PREF['cpage_print_flag'] ? " checked='checked'" : "") . " /><label for='cpage_print_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_print_flag' id='cpage_print_flag_off' value='0'" . ($CPAGE_PREF['cpage_print_flag'] ? "" : " checked='checked'") . " /><label for='cpage_print_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
				<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP63 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_pdf_flag' id='cpage_pdf_flag_on' value='1'" . ($CPAGE_PREF['cpage_pdf_flag'] ? " checked='checked'" : "") . " /><label for='cpage_pdf_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_pdf_flag' id='cpage_pdf_flag_off' value='0'" . ($CPAGE_PREF['cpage_pdf_flag'] ? "" : " checked='checked'") . " /><label for='cpage_pdf_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>

		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP17 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_views_flag' id='cpage_views_flag_on' value='1'" . ($CPAGE_PREF['cpage_views_flag'] ? " checked='checked'" : "") . " /><label for='cpage_views_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_views_flag' id='cpage_views_flag_off' value='0'" . ($CPAGE_PREF['cpage_views_flag'] ? "" : " checked='checked'") . " /><label for='cpage_views_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP31 . "</td>
			<td style='width:75%;' class='forumheader3'>
				<input type='radio' name='cpage_unique_flag' id='cpage_unique_flag_on' value='1'" . ($CPAGE_PREF['cpage_unique_flag'] ? " checked='checked'" : "") . " /><label for='cpage_unique_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
				<input type='radio' name='cpage_unique_flag' id='cpage_unique_flag_off' value='0'" . ($CPAGE_PREF['cpage_unique_flag'] ? "" : " checked='checked'") . " /><label for='cpage_unique_flag_off'> " . CPAGE_CP14 . "</label>
			</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_CP24 . "</td>
			<td style='width:75%' class='forumheader3'>" . r_userclass("cpage_class", $CPAGE_PREF['cpage_class'], "off", "public,guest,nobody,member,main,admin,classes") . "</td>
		</tr>
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_C13 . "</td>
			<td style='width:75%' class='forumheader3'>
				<select name='cpage_category' class='tbox' >
					<option value='0' " . ($CPAGE_PREF['cpage_category'] == 0?"selected='selected'":"") . " >" . CPAGE_C14 . "</option>";
$sql->db_Select('cpage_category', '*', 'order by cpage_cat_name', 'nowhere', false);
while ($row = $sql->db_Fetch()) {
    $cpage_text .= "<option value='" . $row['cpage_cat_id'] . "' " . ($CPAGE_PREF['cpage_category'] == $row['cpage_cat_id']?"selected='selected'":"") . " >" . $tp->toFORM($row['cpage_cat_name']) . "</option>";
}
$cpage_text .= "
				</select>
			</td>
		</tr>
		<!--
		<tr>
			<td style='width:25%' class='forumheader3'>" . CPAGE_C08 . "</td>
			<td style='width:75%' class='forumheader3'><textarea class='tbox' name='cpage_ip_restrict' style='width:80%;' rows='6' cols='80'>" . $tp->toFORM($CPAGE_PREF['cpage_ip_restrict']) . "</textarea></td>
		</tr>
		-->		";
// Submit button
$cpage_text .= "
		<tr>
			<td class='forumheader2' colspan='2' style='text-align: left;'>
				<input type='submit' name='cpageupdate' value='" . CPAGE_C03 . "' class='button' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";

$ns->tablerender(CPAGE_C01, $cpage_text);

require_once(e_ADMIN . "footer.php");