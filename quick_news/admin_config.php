<?
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Ricardo Uceda 2007
|     http://www.ion-labs.com
|     ionlabs@gmail.com
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: e107_plugins/quick_news/admin_config.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("Location: ".e_HTTP."index.php");
	exit;
}

require_once(e_ADMIN."auth.php");
define(MAX_TEXT_LENGTH, 400);

/* GET VARS */
$edit   = ( isset($_GET['edit'])    && intval($_GET['edit'])    !== 0 ) ? TRUE : FALSE;
$change = ( isset($_GET['cstatus']) && intval($_GET['cstatus']) !== 0 ) ? TRUE : FALSE;
$delete = ( isset($_GET['delete'])  && intval($_GET['delete'])  !== 0 ) ? TRUE : FALSE;
$text   = '';

/* Render */
$mysql = new db();
$mysql->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
if ( $edit === FALSE && $change === FALSE && $delete === FALSE ) {
	/*
	 *	NOTE: Limited output list by default!
	 */
	$row_count = $mysql->db_Select("quick_news", "*", "LIMIT 40", FALSE);
	if ( intval($row_count) > 0 ) {
		/* Show list */
		$text .= "<div style='padding:5px 0px;'><table style='width: 95%;' class='fborder'><thead><tr><td class='fcaption'>ID</td><td class='fcaption'>".QUICKNEWS_CFG06."</td><td class='fcaption'>".QUICKNEWS_CFG07."</td><td class='fcaption'>".QUICKNEWS_CFG08."</td></tr></thead><tbody>";
		while ( $row = $mysql->db_Fetch() ) {
			$text .= "<tr><td style='width: 5%;' class='forumheader3'><div class='normaltext'>#".$row['qnew_id']."</div></td>";
			$text .= "<td style='width: 78%;' class='forumheader3'>".htmlspecialchars(stripslashes($row['qnew_text']), ENT_QUOTES)."</td>";
			$text .= ( intval($row['qnew_visible']) === 0 ) ? "<td style='width: 5%;' class='forumheader3'>".QUICKNEWS_CFG13."</td>" : "<td style='width: 5%;' class='forumheader3'>".QUICKNEWS_CFG12."</td>";
			$text .= "<td style='width: 12%;' class='forumheader3'><a href='".e_SELF."?edit=".$row['qnew_id']."'><img src='".e_PLUGIN_ABS."quick_news/images/edit_16.png' alt='".QUICKNEWS_CFG30."' title='".QUICKNEWS_CFG30."' style='border:0px; height:16px; width:16px' /></a>&nbsp;";
			$text .= "<a href='".e_SELF."?cstatus=".$row['qnew_id']."&vis=".intval($row['qnew_visible'])."'><img src='".e_PLUGIN_ABS."quick_news/images/change_16.png' alt='".QUICKNEWS_CFG09."' title='".QUICKNEWS_CFG09."' style='border:0px; height:16px; width:16px' /></a>&nbsp;";
			$text .= "<a href='".e_SELF."?delete=".$row['qnew_id']."' onclick=\"return jsconfirm('".QUICKNEWS_CFG11." [ID: ".$row['qnew_id']."]')\"><img src='".e_PLUGIN_ABS."quick_news/images/delete_16.png' alt='".QUICKNEWS_CFG10."' title='".QUICKNEWS_CFG10."' style='border:0px; height:16px; width:16px' /></a>";
			$text .= "</tr>";
		}
		$text .= "</tbody></table></div>";
	} else {
		$text .= "<p>".QUICKNEWS_INF01."</p><br />";
	}
} elseif ( $edit === TRUE ) {
	$id = intval(ereg_replace("[^0-9]", "", $_GET['edit']));

	if ( isset($_POST['submit']) && intval($_POST['submit']) === 1 ) {
		$qntext = ( @get_magic_quotes_gpc() ) ? $_POST['qntext'] : @addslashes($_POST['qntext']);
		if ( @strlen($qntext) > MAX_TEXT_LENGTH ) {
			$qntext = rtrim(substr($qntext, 0, MAX_TEXT_LENGTH), " \t\\\0");
		}
		$row_count = $mysql->db_Update("quick_news", "qnew_text='$qntext' WHERE qnew_id='$id'", FALSE);
		$text .= ( intval($row_count) === 0 ) ? QUICKNEWS_ERR14 : QUICKNEWS_INF06;
	} else {
		$row_count = $mysql->db_Select("quick_news", "*", "qnew_id=$id LIMIT 1", TRUE);
		if ( intval($row_count) > 0 ) {
			/* Show mod form */
			$row = $mysql->db_Fetch();
			$text .= "<div style='padding:5px 0px;'><form action='".e_SELF."?edit=$id' name='submit' method='POST'><table style='width: 95%;' class='fborder'><tbody><tr><td style='width: 30%;' class='forumheader3'><div class='normaltext'><label style='font-weight:bold;' for='action'>".QUICKNEWS_ADD02."</label></div></td><td style='width: 70%;' class='forumheader3'>";
			$text .= "<input type='text' name='qntext' class='tbox' size='70' value='".htmlspecialchars(stripslashes($row['qnew_text']), ENT_QUOTES)."' maxlength='".MAX_TEXT_LENGTH."' /><input type='hidden' name='submit' value='1' /></td></tr><tr style='vertical-align: top;'><td colspan='2' style='text-align: center;' class='forumheader'><input class='button' name='send' value='".QUICKNEWS_CFG40."' type='submit'></td></tr></tbody></table></form></div>";
		} else {
			$text .= "<p>".QUICKNEWS_ERR02."</p><br />";
		}
	}
} elseif ( $change === TRUE ) {
	$visibility = ( isset($_GET['vis']) && intval($_GET['vis']) !== 0 ) ? 0 : 1;
	$row_count = $mysql->db_Update("quick_news", "qnew_visible='$visibility' WHERE qnew_id='".intval($_GET['cstatus'])."'", FALSE);
	$text .= ( intval($row_count) === 0 ) ? QUICKNEWS_ERR11 : QUICKNEWS_INF02;
} elseif ( $delete === TRUE ) {
	$row_count = $mysql->db_Delete("quick_news", "qnew_id='".intval($_GET['delete'])."'", FALSE);
	$text .= ( intval($row_count) === 0 ) ? QUICKNEWS_ERR12 : QUICKNEWS_INF03;
}
$mysql->db_Close();

$ns->tablerender(QUICKNEWS_CFG02, $text);

require_once(e_ADMIN."footer.php");
?>
