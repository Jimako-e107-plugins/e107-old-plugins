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
|     $Source: e107_plugins/quick_news/admin_prefs.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");

// Check current user is an admin, redirect to main site if not
if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}

require_once(e_ADMIN."auth.php");

/* GET VARS */
$submit = ( isset($_GET['submit']) && intval($_GET['submit']) === 1 ) ? TRUE : FALSE;

/* Read quick_news DB Configuration */
$text = '';
$mysql = new db();
$mysql->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

/* Render */
if ( $submit === FALSE ) {
	/* Get current value */
	$query = $mysql->db_Select("core", "e107_value", "e107_name = 'quick_news_prefs'");
	if ( $query === 1 ) {
		$row = $mysql->db_Fetch();
		$preferences = unserialize($row[0]);
		if ( !is_array($preferences) ) {
			$query = $mysql->db_Update("core", "`e107_value`='a:6:{s:9:\"plgstatus\";s:1:\"1\";s:9:\"behaviour\";s:1:\"0\";s:9:\"direction\";s:1:\"0\";s:6:\"speedo\";s:1:\"2\";s:6:\"height\";s:2:\"50\";s:7:\"marquee\";s:1:\"0\";}' WHERE `e107_name`='quick_news_prefs'");
			$text .= QUICKNEWS_ERR01;
		} else {
			/* Show configuration form */
			$text .= "<div style='padding:5px 0px;'><form action='".e_SELF."?submit=1' name='submit' method='POST'><table style='width: 95%;' class='fborder'><tbody>";
			$text .= "<tr><td style='width: 40%;' class='forumheader3'><div class='normaltext'>".QUICKNEWS_CFG14."</div></td>";
			if ( intval($preferences['plgstatus']) === 1 ) {
				$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='plgstatus'><option selected='selected' value='1'>".QUICKNEWS_CFG19."</option><option value='0'>".QUICKNEWS_CFG20."</option></select></td></tr>";
			} else {
				$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='plgstatus'><option selected='selected' value='0'>".QUICKNEWS_CFG20."</option><option value='1'>".QUICKNEWS_CFG19."</option></select></td></tr>";
			}

			$text .= "<tr><td style='width: 40%;' class='forumheader3'><div class='normaltext'>".QUICKNEWS_CFG15."</div></td>";
			if ( intval($preferences['behaviour']) === 1 ) {
				$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='behaviour'><option selected='selected' value='1'>".QUICKNEWS_CFG16."</option><option value='0'>".QUICKNEWS_CFG17."</option></select></td></tr>";
			} else {
				$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='behaviour'><option selected='selected' value='0'>".QUICKNEWS_CFG17."</option><option value='1'>".QUICKNEWS_CFG16."</option></select></td></tr>";
			}

			$text .= "<tr><td style='width: 40%;' class='forumheader3'><div class='normaltext'>".QUICKNEWS_CFG26."</div></td>";
			if ( intval($preferences['marquee']) === 1 ) {
				$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='marquee'><option selected='selected' value='1'>".QUICKNEWS_CFG28."</option><option value='0'>".QUICKNEWS_CFG29."</option></select></td></tr>";
				$nusd  = TRUE;
			} else {
				$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='marquee'><option selected='selected' value='0'>".QUICKNEWS_CFG29."</option><option value='1'>".QUICKNEWS_CFG28."</option></select></td></tr>";
				$nusd  = FALSE;
			}

			if ( $nusd === TRUE ) {
				$text .= "<tr><td style='width: 40%;' class='forumheader3'><div class='normaltext'>".QUICKNEWS_CFG18."</div></td>";
				if ( intval($preferences['direction']) === 0 ) {
					$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='direction'><option selected='selected' value='0'>".QUICKNEWS_CFG21."</option><option value='1'>".QUICKNEWS_CFG22."</option><option value='2'>".QUICKNEWS_CFG23."</option><option value='3'>".QUICKNEWS_CFG24."</option></select></td></tr>";
				} elseif ( intval($preferences['direction']) === 1 ) {
					$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='direction'><option selected='selected' value='1'>".QUICKNEWS_CFG22."</option><option value='0'>".QUICKNEWS_CFG21."</option><option value='2'>".QUICKNEWS_CFG23."</option><option value='3'>".QUICKNEWS_CFG24."</option></select></td></tr>";
				} elseif ( intval($preferences['direction']) === 2 ) {
					$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='direction'><option selected='selected' value='2'>".QUICKNEWS_CFG23."</option><option value='0'>".QUICKNEWS_CFG21."</option><option value='1'>".QUICKNEWS_CFG22."</option><option value='3'>".QUICKNEWS_CFG24."</option></select></td></tr>";
				} elseif ( intval($preferences['direction']) === 3 ) {
					$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='direction'><option selected='selected' value='3'>".QUICKNEWS_CFG24."</option><option value='0'>".QUICKNEWS_CFG21."</option><option value='1'>".QUICKNEWS_CFG22."</option><option value='2'>".QUICKNEWS_CFG23."</option></select></td></tr>";
				} else {
					$text .= "<td style='width:60%; text-align:right' class='forumheader3'><select class='tbox' size='1' name='direction'><option  selected='selected' value='0'>".QUICKNEWS_CFG21."</option><option value='1'>".QUICKNEWS_CFG22."</option><option value='2'>".QUICKNEWS_CFG23."</option><option value='3'>".QUICKNEWS_CFG24."</option></select></td></tr>";
				}
			}

			$text .= "<tr><td style='width: 40%;' class='forumheader3'><div class='normaltext'>".QUICKNEWS_CFG25."</div></td>";
			$text .= "<td style='width:60%; text-align:right' class='forumheader3'><input style='text-align: right;' class='tbox' type='text' name='speedo' size='10' maxlength='3' value='".intval($preferences['speedo'])."' /></td></tr>";

			$text .= "<tr><td style='width: 40%;' class='forumheader3'><div class='normaltext'>".QUICKNEWS_CFG27."</div></td>";
			$text .= "<td style='width:60%; text-align:right' class='forumheader3'><input style='text-align: right;' class='tbox' type='text' name='height' size='10' maxlength='3' value='".intval($preferences['height'])."' /></td></tr>";

			$text .= "<tr style='vertical-align: top;'><td colspan='2' style='text-align: center;' class='forumheader'><input class='button' name='send' value='".QUICKNEWS_CFG09."' type='submit'></td></tr></tbody></table>";

			if ( $nusd === FALSE ) {
				$text .= "<input type='hidden' name='direction' value='".intval($preferences['direction'])."' />";
			}

			$text .= "</form></div>";
		}
	} else {
		/* Default value */
		$query = $mysql->db_Insert("core", "'quick_news_prefs', 'a:6:{s:9:\"plgstatus\";s:1:\"1\";s:9:\"behaviour\";s:1:\"0\";s:9:\"direction\";s:1:\"0\";s:6:\"speedo\";s:1:\"2\";s:6:\"height\";s:2:\"50\";s:7:\"marquee\";s:1:\"0\";}'");
		$text .= QUICKNEWS_ERR01;
	}

	$ns->tablerender(QUICKNEWS_CFG04, $text);
} else {
	$preferences = array( 'plgstatus' => '1', 'behaviour' => '0', 'direction' => '0', 'speedo' => '2', 'height' => '50', 'marquee' => '0' );
	$preferences['plgstatus'] = ( isset($_POST['plgstatus']) && intval($_POST['plgstatus']) === 1 ) ? '1' : '0';
	$preferences['behaviour'] = ( isset($_POST['behaviour']) && intval($_POST['behaviour']) === 1 ) ? '1' : '0';
	$preferences['direction'] = ( isset($_POST['direction']) ) ? $_POST['direction'] : '0';
	$preferences['direction'] = ereg_replace("[^0-9]", "", $preferences['direction']);
        if ( intval($preferences['direction']) < 0 || intval($preferences['direction']) > 3 ) {
		$preferences['direction'] = '0';
	}
	$preferences['speedo']    = ( isset($_POST['speedo']) && intval($_POST['speedo']) !== 0 ) ? $_POST['speedo'] : '2';
	if ( intval($preferences['speedo']) < 0 ) { $preferences['speedo']='1'; }
	if ( intval($preferences['speedo']) > 5 ) { $preferences['speedo']='5'; }
	$preferences['height']    = ( isset($_POST['height']) && intval($_POST['height']) > 5 ) ? $_POST['height'] : '50';
	$preferences['marquee']   = ( isset($_POST['marquee']) && intval($_POST['marquee']) === 1 ) ? '1' : '0';
	$serial_prefs = serialize($preferences);
	$query = $mysql->db_Update("core", "`e107_value`='$serial_prefs' WHERE `e107_name`='quick_news_prefs'");

	if ( isset($query) && intval($query) === 1 ) {
		$text .= QUICKNEWS_INF04;
	} else {
		if ( isset($query) && intval($query) === 0 ) {
			$text .= QUICKNEWS_INF05;
		} else {
			$text .= QUICKNEWS_ERR13;
		}
	}

	$ns->tablerender(QUICKNEWS_CFG04, $text);
}
$mysql->db_Close();

require_once(e_ADMIN."footer.php");
?>
