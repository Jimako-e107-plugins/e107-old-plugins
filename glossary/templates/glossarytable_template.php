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
 
$GLOSSARYTABLE_WRAPPER['glossary']['WORD_NAME']  = "<span style='color: #990000; font-weight: bold;'>{---}</span>";
$GLOSSARYTABLE_WRAPPER['glossary']['WORD_DESCRIPTION'] = "<div style='text-align: justify;'>{---}</div>";

$GLOSSARYTABLE_TEMPLATE['WORD_BODY_MENU'] = "
	{WORD_NAME}<br />
	{WORD_DESCRIPTION}<br />";

$GLOSSARYTABLE_WRAPPER['glossary']['WORD_MENU_TITLE'] = "<div style='text-align:center;'><b>{---}</b></div>";

$GLOSSARYTABLE_TEMPLATE['WORD_MENU_TITLE'] = "{WORD_MENU_TITLE}";

$GLOSSARYTABLE_TEMPLATE['WORD_BODY_PAGE'] ="
	<table style='width:100%; border:0px' cellpadding='0' cellspacing='0'>
		<tr>
			<td>
				<table style='width:100%; border:0px' cellpadding='0' cellspacing='0'>
					<tr>
						<td style='width:75%; text-align: left; white-space: nowrap'>
							{WORD_NAME=page}
						</td>
						<td style='width:25%; text-align: right'>
							<span>{EMAILITEM}&nbsp;{PRINTITEM}&nbsp;{PDFITEM}&nbsp;{ADMINOPTIONS}</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				{WORD_DESCRIPTION}
			</td>
		</tr>
	</table>
	";

$GLOSSARYTABLE_WRAPPER['glossary']['LINK_TO_TOP'] = "<div class='smalltext'>[{---}]</div>";

$GLOSSARYTABLE_TEMPLATE['BACK_TO_TOP'] = "
	{LINK_TO_TOP}
	<hr style='width: 75%' />";

$GLOSSARYTABLE_WRAPPER['glossary']['WORD_PAGE_TITLE'] = "{---}";


$GLOSSARYTABLE_TEMPLATE['WORD_PAGE_TITLE'] = "{WORD_PAGE_TITLE}";

$GLOSSARYTABLE_WRAPPER['glossary']['WORD_ANCHOR'] = "<span style='font-size: large; font-weight: bold;'>{---}</span>";

$GLOSSARYTABLE_TEMPLATE['WORD_ANCHOR'] = "{WORD_ANCHOR}<br />";

$GLOSSARYTABLE_WRAPPER['glossary']['WORD_CHAR_LINK'] = "{---}";

$GLOSSARYTABLE_TEMPLATE['WORD_CHAR_LINK'] = "&nbsp;{WORD_CHAR_LINK: link=link}";
$GLOSSARYTABLE_TEMPLATE['WORD_CHAR_NOLINK'] = "&nbsp;{WORD_CHAR_LINK}";

$GLOSSARYTABLE_TEMPLATE['WORD_ALLCHAR_PRE'] = "<div style='text-align:center; font-size: medium; font-weight: bold;'>";
$GLOSSARYTABLE_TEMPLATE['WORD_ALLCHAR_POST'] = "</div>";

$GLOSSARYTABLE_TEMPLATE['PRINT_MESSAGE_PRE'] = "<br /><div style='text-align:center'><b>";
$GLOSSARYTABLE_TEMPLATE['PRINT_MESSAGE_POST'] = "</b></div>";

$GLOSSARYTABLE_WRAPPER['glossary']['LINK_PAGE_NAVIGATOR'] = "
	<table cellpadding='2' cellspacing='0' style='width:100%; margin-bottom:20px;'>
		<tr>
			<td style='text-align:right;'>{---}
			</td>
		</tr>
	</table>";

$GLOSSARYTABLE_TEMPLATE['LINK_PAGE_NAVIGATOR'] = "{LINK_PAGE_NAVIGATOR}";

$GLOSSARYTABLE_WRAPPER['glossary']['LINK_MENU_NAVIGATOR'] = "
	<table cellpadding='0' cellspacing='0' style='width:100%; margin-bottom:10px;'>
		<tr>
			<td style='text-align:left;'>{---}
			</td>
		</tr>
	</table>";

$GLOSSARYTABLE_TEMPLATE['LINK_MENU_NAVIGATOR'] = "{LINK_MENU_NAVIGATOR}";

?>