<?php
/*
################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
*/

$butname[] = CB2LAN_VLB1;
$butlink[] = "admin_general.php";
$butid[] = "cb2_general";

$butname[] = CB2LAN_VLB2;
$butlink[] = "admin_chatbox2.php";
$butid[] = "cb2_chatbox";

$butname[] = CB2LAN_VLB3;
$butlink[] = "admin_chatpage.php";
$butid[] = "cp2_chatpage";

$butname[] = CB2LAN_GLD_B1;
$butlink[] = "admin_gold.php";
$butid[] = "cb2_gold";

$butname[] = CB2LAN_VLB4;
$butlink[] = "admin_readme.php";
$butid[] = "admin_readme";

global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu(CB2LAN_VLM1, $pageid, $var);

?>