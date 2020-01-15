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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossaire.php,v $
 * $Revision: 1.5 $
 * $Date: 2006/06/27 13:38:49 $
 * $Author: duclos $
 */

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}

$pref = e107::getPlugConfig('glossary')->getPref();
//these have to be set for the tinymce wysiwyg
$e_wysiwyg	= "word_desc";
$WYSIWYG = true;


require_once(e_PLUGIN.'glossary/glossary_defines.php');

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

if(!$sql -> db_Select("plugin", "*", "plugin_path = 'glossary' AND plugin_installflag = '1' "))
{
	require_once(HEADERF);
	$ns -> tablerender("", "<b><u>Glossary:</u> ".LAN_GLOSSARY_GLO_01."</b>");
	require_once(FOOTERF);
	exit;
}

require_once(e_HANDLER."form_handler.php");
$rs = new form;

require_once(e_PLUGIN.'glossary/glossary_class.php');
$gc = new glossary_class();

$deltest = array_flip($_POST);

if (e_QUERY)
	list($action, $id) = explode(".", e_QUERY);

if(isset($_POST['action']))
{
	$tmp = array_pop(array_flip($_POST['action']));
	list($action, $id) = explode("_", $tmp);
}

$gc->setPageTitle();

require_once(HEADERF);

require_once(e_HANDLER."ren_help.php");

if ($action == "createSub")
{
	if (check_class($pref['glossary_submit_class']))
	{
		if (isset($pref['glossary_submit_directpost']) && $pref['glossary_submit_directpost'])
			$gc->createSubWord(1);
		else
			$gc->createSubWord(0);
	}
	else
		js_location(e_SELF);
}

if ($action == "add" || $action == "submit")
{
	if (check_class($pref['glossary_submit_class']))
		$gc->submitWord();
	else
		js_location(e_SELF);
}

if ($action == "s")
	$gc->show_message(LAN_GLOSSARY_GLO_02, LAN_GLOSSARY_GLO_03);

if ($action == "s_direct")
	$gc->show_message(LAN_GLOSSARY_GLO_04, LAN_GLOSSARY_GLO_03);

if (!e_QUERY)
{
	$gc->displayWords($gc->displayNav("page"));
}

require_once(FOOTERF);

?>