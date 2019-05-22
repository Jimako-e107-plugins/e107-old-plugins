<?php
// ***************************************************************
// *
// *		Title		:	Corporate Phone Directory
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	6 May 2004
// *
// *		Version		:	1.04
// *
// *		Description	: 	Corporate phone directory
// *
// *		Revisions	:	06 May 2004 Initial design
// *					:	03 Oct 2004 Change table names etc
// *
// ***************************************************************
// parameter order $pd_from $pd_action $pdcat_id $pd_optioncat $pd_optionsite $pd_project $pd_job $pd_office $pd_name $pd_id $pd_site $pd_dept
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "phonedir/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "phonedir/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "phonedir/languages/English.php");
}
$pd_from = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    // $pd_from = $_POST['pd_from'];
    $pd_from = 0;
    $pd_action = $_POST['pd_action'];
    $pdcat_id = intval($_POST['pdcat_id']);
    $pd_optioncat = intval($_POST['pd_optioncat']);
    $pd_optionsite = intval($_POST['pd_optionsite']);
    $pd_project = intval($_POST['pd_project']);
    $pd_job = intval($_POST['pd_job']);
    $pd_office = intval($_POST['pd_office']);
    $pd_name = $_POST['pd_name'];
    $pd_id = intval($_POST['pd_id']);
    $pd_site = intval($_POST['pd_site']);
    $pd_dept = intval($_POST['pd_dept']);
} elseif (e_QUERY)
{
    $tmp = explode(".", e_QUERY);
    $pd_from = intval($tmp[0]);
    $pd_action = $tmp[1];
    $pdcat_id = intval($tmp[2]);
    $pd_optioncat = intval($tmp[3]);
    $pd_optionsite = intval($tmp[4]);
    $pd_project = intval($tmp[5]);
    $pd_job = intval($tmp[6]);
    $pd_office = intval($tmp[7]);
    $pd_name = $tmp[8];
    $pd_id = intval($tmp[9]);
    $pd_site = intval($tmp[10]);
    $pd_dept = intval($tmp[11]);
}
if (!empty($_REQUEST['printable']))
{
    $pd_action = "printable";
}
if ($pd_optioncat == 0)
{
    $pd_optioncat = $pref['phonedir_defcat'];
}
if (!empty($_REQUEST['donotify']))
{
    $pd_action = "donotify";
}
if (empty($pd_action)) $pd_action = "list";
// Check if print button pressed to produce a pdf printable list.
// Set keywords and description
if (!empty($pref['phonedir_metadesc']))
{
    define("META_DESCRIPTION", $tp->toFORM($pref['phonedir_metadesc']));
}
if (!empty($pref['phonedir_metakey']))
{
    define("META_KEYWORDS", $tp->toFORM($pref['phonedir_metakey']));
}
unset($pd_text);
// Check user class
if (!check_class($pref['phonedir_userclass']))
{
    require_once(HEADERF);
    print LAN_phonedir_82;
    require_once(FOOTERF);
    exit();
}

$pd_perpage = $pref['phonedir_perpage'];

switch ($pd_action)
{
    case "sendnotify":
        require_once("notifyc.php");
        break;
    case "donotify":
        require_once("notifyc.php");
        break;
    case "list":
        require_once("list.php");
        break;
    case "view":
        require_once("view.php");
        break;
    case "site" :
        require_once("site.php");
        break;
    case "dept":
        require_once("dept.php");
        break;
    case "help":
        require_once("./languages/eng_help.php");
        break;
    case "printable":
        require_once("printable.php");
        break;
}


?>