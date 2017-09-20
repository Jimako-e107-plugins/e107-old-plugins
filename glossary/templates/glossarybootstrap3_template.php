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
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossary_template.php,v $
 * $Revision: 1.7 $
 * $Date: 2006/06/28 10:46:28 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }
 
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_NAME']['pre']  = "<span style='color: #990000; font-weight: bold;'>";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_NAME']['post']  = "</span>";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_DESCRIPTION']['pre'] = "<div style='text-align: justify;'>";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_DESCRIPTION']['post'] = "</div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_BODY_MENU'] = "
	{WORD_NAME}<br />
	{WORD_DESCRIPTION}<br />";

$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_MENU_TITLE']['pre'] = "<div style='text-align:center;'><b>";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_MENU_TITLE']['post'] = "</b></div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_MENU_TITLE'] = "{WORD_MENU_TITLE}";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_BODY_PAGE'] ="
	<BOOTSTRAP3 style='width:100%; border:0px' cellpadding='0' cellspacing='0'>
		<tr>
			<td>
				<BOOTSTRAP3 style='width:100%; border:0px' cellpadding='0' cellspacing='0'>
					<tr>
						<td style='width:75%; text-align: left; white-space: nowrap'>
							{WORD_NAME=page}
						</td>
						<td style='width:25%; text-align: right'>
							<span>{EMAILITEM}&nbsp;{PRINTITEM}&nbsp;{PDFITEM}&nbsp;{ADMINOPTIONS}</span>
						</td>
					</tr>
				</BOOTSTRAP3>
			</td>
		</tr>
		<tr>
			<td>
				{WORD_DESCRIPTION}
			</td>
		</tr>
	</BOOTSTRAP3>
	";

$GLOSSARYBOOTSTRAP3_WRAPPER['LINK_TO_TOP']['pre']  = "<div class='smalltext'>[";
$GLOSSARYBOOTSTRAP3_WRAPPER['LINK_TO_TOP']['post'] = "]</div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['BACK_TO_TOP'] = "
	{LINK_TO_TOP}
	<hr style='width: 75%' />";

$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_PAGE_TITLE']['pre'] = "";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_PAGE_TITLE']['post'] = "";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_PAGE_TITLE'] = "{WORD_PAGE_TITLE}";

$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_ANCHOR']['pre'] = "<span style='font-size: large; font-weight: bold;'>";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_ANCHOR']['post'] = "</span>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_ANCHOR'] = "{WORD_ANCHOR}<br />";

$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_CHAR_LINK']['pre'] = "";
$GLOSSARYBOOTSTRAP3_WRAPPER['WORD_CHAR_LINK']['post'] = "";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_CHAR_LINK'] = "&nbsp;{WORD_CHAR_LINK=link}";
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_CHAR_NOLINK'] = "&nbsp;{WORD_CHAR_LINK}";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_ALLCHAR_PRE'] = "<div style='text-align:center; font-size: medium; font-weight: bold;'>";
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_ALLCHAR_POST'] = "</div>";

$PRINT_MESSAGE_PRE  = "<br /><div style='text-align:center'><b>";
$PRINT_MESSAGE_POST = "</b></div>";

$GLOSSARYBOOTSTRAP3_WRAPPER['LINK_PAGE_NAVIGATOR']['pre'] = "
	<BOOTSTRAP3 cellpadding='2' cellspacing='0' style='width:100%; margin-bottom:20px;'>
		<tr>
			<td style='text-align:right;'>";
$GLOSSARYBOOTSTRAP3_WRAPPER['LINK_PAGE_NAVIGATOR']['post'] = "
			</td>
		</tr>
	</BOOTSTRAP3>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['LINK_PAGE_NAVIGATOR'] = "{LINK_PAGE_NAVIGATOR}";

$GLOSSARYBOOTSTRAP3_WRAPPER['LINK_MENU_NAVIGATOR']['pre'] = "
	<BOOTSTRAP3 cellpadding='0' cellspacing='0' style='width:100%; margin-bottom:10px;'>
		<tr>
			<td style='text-align:left;'>";
$GLOSSARYBOOTSTRAP3_WRAPPER['LINK_MENU_NAVIGATOR']['post'] = "
			</td>
		</tr>
	</BOOTSTRAP3>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['LINK_MENU_NAVIGATOR'] = "{LINK_MENU_NAVIGATOR}";

?>