<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/admin_config.php,v $
 * $Revision: 1.4 $
 * $Date: 2006/06/28 01:16:10 $
 * $Author: duclos $
 */

require_once("../../class2.php");

if (!getperms("P"))
{
	header("location:".e_BASE."index.php");
	exit;
}

//these have to be set for the tinymce wysiwyg
$e_wysiwyg	= "word_desc";

require_once(e_PLUGIN."glossary/glossary_ver.php");
require_once(e_PLUGIN."glossary/glossary_defines.php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."ren_help.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;

require_once(e_PLUGIN."glossary/glossary_class.php");
$gc = new glossary_class();

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

if (is_readable(THEME."glossary_template.php"))
	require_once(THEME."glossary_template.php");
else
	require_once(e_PLUGIN."glossary/glossary_template.php");

$deltest = array_flip($_POST);
$id = FALSE;

if (e_QUERY)
	list($action, $id) = explode(".", e_QUERY);

if(isset($_POST['action']))
{
	$tmp = array_pop(array_flip($_POST['action']));
	list($action, $id) = explode("_", $tmp);
}

if ($action)
{
	$function = $action."Word";

	if ($action == "add")
		$gc->$function();
	else
		$gc->$function($id);

	if($gc->message || $gc->caption)
	{
		$gc->show_message($gc->message, $gc->caption);
		$gc->showExistingWord();
	}
}
else
	$gc->showExistingWord();

// Display options
function admin_config_adminmenu()
{
	global $gc, $action;

	$gc->show_options($action);
}

require_once(e_ADMIN.'footer.php');

?>