<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL:$
|     $Revision:$
|     $Id:$
|     $Author:$
+----------------------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!getperms("P")) {
	header("location:../../index.php");
	 exit;
}
if (isset($_POST['updateStats']))
{
	header("location: ".e_PLUGIN."log/admin_updateroutine.php");
	exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
define("TIMEOUTPOPPATH", e_PLUGIN."log/");
include_lan(TIMEOUTPOPPATH."languages/admin/".e_LANGUAGE.".php");

if (isset($_POST['updatesettings'])) {
	$pref['timePop_class'] = $_POST['timePop_class'];
	$pref['timePop_timeout'] = $_POST['timePop_timeout'];
	$pref['timePop_message'] = $tp->toDB($_POST['timePop_message']);
	save_prefs();
	$message = LAN_TIMEPOP_M01;
}

$text = "<div style='text-align:center'>";
if (isset($message)) {
   $text .= "<b>".$message."</b>";
}
$text .= "
   	<form method='post' action='".e_SELF."'>
      	<table style='".ADMIN_WIDTH."' class='fborder'>
         	<tr>
            	<td class='forumheader3'>".LAN_TIMEPOP_L03."</td>
         		<td class='forumheader3'>".r_userclass('timePop_class', $pref['timePop_class'], 'off')."</td>
         	</tr>
         	<tr>
         		<td class='forumheader3'>".LAN_TIMEPOP_L01."</td>
            	<td class='forumheader3'>
               	<input class='tbox' type='text' name='timePop_timeout' size='5' value='".$pref['timePop_timeout']."' maxlength='5' />
            	</td>
         	</tr>
         	<tr>
            	<td class='forumheader3'>".LAN_TIMEPOP_L02.LAN_TIMEPOP_11.ini_get("session.gc_maxlifetime")."</td>
            	<td class='forumheader3'>
               	<textarea class='tbox' name='timePop_message' cols='70' rows='5'>".$pref['timePop_message']."</textarea>
            	</td>
         	</tr>
         	<tr>
            	<td colspan='2' style='text-align:center' class='forumheader'>
               	<input class='button' type='submit' name='updatesettings' value='".LAN_TIMEPOP_N01."' />
            	</td>
         	</tr>
      	</table>
   	</form>
	</div>
	";
$ns->tablerender(LAN_TIMEPOP_H03, $text);
require_once(e_ADMIN."footer.php");
?>