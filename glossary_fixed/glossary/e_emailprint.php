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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/e_emailprint.php,v $
 * $Revision: 1.3 $
 * $Date: 2006/06/21 01:58:48 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

include_once(e_PLUGIN.'glossary/glossary_class.php');

function print_item($id)
{
	global $tp, $sql;

	require_once(e_HANDLER.'bbcode_handler.php');
	$conv = new convert;
	$e_bb = new e_bbcode;
	$gc = new glossary_class;

	include_once(e_PLUGIN.'glossary/glossary_class.php');
	$gc = new glossary_class;

	$sql->db_Select("glossary", "*", "glo_id='".intval($id)."'");
	$row = $sql->db_Fetch();

	$row['glo_name']				= $tp->toHTML($row['glo_name']);
	$row['glo_description'] = $tp->toHTML($row['glo_description']);
	
	list($uid, $author, $email) = $gc->getAuthor($row['glo_author']);
	
	$row['glo_datestamp'] = $conv->convert_date($row['glo_datestamp'], "long");

	$text = "<font style=\"font-size: 11px; color: black; font-family: tahoma, verdana, arial, helvetica; text-decoration: none\">
					<b>".$row['glo_name']."</b>
					<br />
					<i>" . $author . " [" . $email . "], " . $row['glo_datestamp'] . "</i>
					<br />
					" . $row['glo_description'] ."
					<br />
					<hr />
					<br />
					<i>" . LAN_GLOSSARY_PRINT_01 . " <b>" . SITENAME . "</b></i>
					<br />
					( ". SITEURLBASE.e_PLUGIN_ABS."glossaire/glossaire.php#".$gc->first_car($row['glo_name']) . " )
					";	
	
	$text = $e_bb->parseBBCodes($text , '');
	
	return $text;
}

function email_item($id)
{
	return "<br /><br /><hr />".print_item($id);
}

function print_item_pdf($id)
{
	global $tp, $sql;

	require_once(e_HANDLER.'bbcode_handler.php');

	$conv = new convert;
	$e_bb = new e_bbcode;
	$gc = new glossary_class;

	$sql->db_Select("glossary", "*", "glo_id='".intval($id)."'");
	$row = $sql->db_Fetch();

	$row['glo_name']				= $tp->toHTML($row['glo_name']);
	$row['glo_description'] = $tp->toHTML($row['glo_description']);
	
	list($uid, $author, $email) = $gc->getAuthor($row['glo_author']);
	
	$row['glo_datestamp'] = $conv->convert_date($row['glo_datestamp'], "long");
	
	//the following defines are processed in the document properties of the pdf file

	//Do NOT add parser function to the variables, leave them as raw data !
	//as the pdf methods will handle this !
	$text			= $row['glo_description'];	//define text
	$creator	= SITENAME;									//define creator
	$author		= $author;									//define author
	$title		= $row['glo_name'];					//define title
	$subject	= $row['glo_name'];					//define subject
	$keywords	= "";												//define keywords

	//define url to use in the header of the pdf file
	$url		= SITEURLBASE.e_PLUGIN_ABS."glossary/glossaire.php#".$gc->first_car($row['glo_name']);

	//always return an array with the following data:

	$text = $e_bb->parseBBCodes($text , '');

	return array($text, $creator, $author, $title, $subject, $keywords, $url);
}

?>