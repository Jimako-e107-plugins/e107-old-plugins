<?php
/*
+------------------------------------------------------------------------------+
|  P_Writer - a plugin by Paul Kater
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
require_once('../../class2.php');
require_once(e_ADMIN."auth.php");
if (!defined('e107_INIT')) { exit(); }

// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

include_lan(e_PLUGIN.'/p_writer/languages/'.e_LANGUAGE.'.php');

$eplug_admin = true;
$pageid = 'import';
$parms = explode(".", e_QUERY);

//===load==
if ($parms[0] == "load")
{
	$text = "in load<br />";
	$title="Importing";

	// is er een boekrc op de opgegeven locatie?
	$dir = $_POST['dir'];

	if (!file_exists($dir."/boekrc"))
	{
		$text .= "No BOEKRC in " . $dir;
		$ns -> tablerender($title, $text);
		require_once(e_ADMIN."footer.php");
		exit;
	}

	$boekrc = file($dir."/boekrc");
	$r=count($boekrc)-2;
	$text .= "aantal regels: " . $r;

	$title = $boekrc[0];
	$sql = new db();
	$storyid = $sql->db_Insert("pw_stories",	"0, '".$tp->toDB($title). "', '2009', '1', 'mixgroup', '0', '', '1'");

	for ($a=2;$a < $r+2; $a++)
	{
		$b = explode("|",$boekrc[$a]);
		$text .= "hfst " . $b[0] . "= ". $b[1] . "<br />";
	
		// genre = 1
		$text .= $dir."/hoofdstuk".$b[0]. "<br />";
		$chapter_text=file($dir."/hoofdstuk".$b[0]) or die ("hoofstukfile ". $dir."/hoofdstuk".$b[0] . " niet gevonden!");
		$ct = "";
		for ($c=0; $c < count($chapter_text); $c++)
		{
			$ct .= $chapter_text[$c];
		}

		$sql->db_Insert("pw_chapter", "0, '".$storyid. "', '" .$b[0]. "', '" .$b[1]. "', '" .$tp->toDB($ct)."'");
		$text .= "hfst ". $b[0] . " ingevoegd.<br />";
		unset ($chapter_text, $ct);
	}

	$ns -> tablerender($title, $text);
	require_once(e_ADMIN."footer.php");
	exit;

}

//== main

$text = "<form action=". e_SELF."?load method=post>Directory om te importeren:";
$text .= "<input type='text' name='dir' size='40' maxlength='64' value=''>
			<input class='button' type='submit' name='load' value='import' />";

$title="Importer";
$ns -> tablerender($title, $text);
require_once(e_ADMIN."footer.php");
exit;

?>
