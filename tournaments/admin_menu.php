<?php
/*
+---------------------------------------------------------------+
|        Tournaments plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
    require_once(e_ADMIN."auth.php");

    $text = "<div style='text-align:center'>
    <form method='post' action='".e_SELF."'>\n
    <table style='width:85%' class='fborder'>";

	$text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='' value='".TOURNAMENTS_40."' /></td>
    </tr>";
	
    $text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='add_game' value='".TOURNAMENTS_02."' /></td>
    </tr>";
	
	$text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='view_games' value='".TOURNAMENTS_21."' /></td>
    </tr>";
	
	$text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='add_tournament' value='".TOURNAMENTS_03."' /></td>
    </tr>";
	
	$text .=" </table>
    </form>
    </div>";

    $ns -> tablerender(TOURNAMENTS_01, $text);



?>