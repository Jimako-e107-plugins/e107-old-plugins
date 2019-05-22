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
|     $Source: e107_plugins/quick_news/admin_addqnews.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("Location:".e_HTTP."index.php");
	exit;
}

require_once(e_ADMIN."auth.php");
define(MAX_TEXT_LENGTH, 400);

/* GET VARS */
$submit = ( isset($_GET['submit']) && intval($_GET['submit']) === 1 ) ? TRUE : FALSE;

/* Read quick_news DB Configuration */
$text = '';
/* Render */
if ( ! $submit ) {
	/* Show add form */
	$text .= "<div style='padding:5px 0px;'><form action='".e_SELF."?submit=1' name='submit' method='POST'><table style='width: 95%;' class='fborder'><tbody><tr><td style='width: 30%;' class='forumheader3'><div class='normaltext'><label style='font-weight:bold;' for='action'>".QUICKNEWS_ADD02."</label></div></td><td style='width: 70%;' class='forumheader3'>";
	$text .= "<input type='text' name='qntext' class='tbox' size='70' value='' maxlength='".MAX_TEXT_LENGTH."' /></td></tr><tr style='vertical-align: top;'><td colspan='2' style='text-align: center;' class='forumheader'><input class='button' name='send' value='".QUICKNEWS_CFG50."' type='submit'></td></tr></tbody></table></form></div>";

	$ns->tablerender(QUICKNEWS_ADD01, $text);
} else {
	/* Sanitize */
	$qntext = ( @get_magic_quotes_gpc() ) ? $_POST['qntext'] : @addslashes($_POST['qntext']);
	if ( @strlen($qntext) > MAX_TEXT_LENGTH ) {
		$qntext = rtrim(substr($qntext, 0, MAX_TEXT_LENGTH), " \t\\\0");
	}

	/* DB Insert */
	$mysql = new db();
	$mysql->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);
	$rtn = $mysql->db_Insert("quick_news", "'', '1', '$qntext'", FALSE);
	$mysql->db_Close();

	/* Show results */
	$text .= ( $rtn != FALSE ) ? QUICKNEWS_ADD03 : QUICKNEWS_ERR10;
	$ns->tablerender(QUICKNEWS_ADD01, $text);
}

require_once(e_ADMIN."footer.php");
?>
