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

/* order for main page ($start.$submittext.$text2.$text.$end):
WORD_PAGE_START
  WORD_ALLCHAR_PRE
   WORD_CHAR_LINK/WORD_CHAR_NOLINK
  WORD_ALLCHAR_POST
  
  WORD_CHAR_START - NEW !!!
  WORD_ANCHOR
    WORD_BODY_PAGE
    BACK_TO_TOP
    WORD_BODY_PAGE
    BACK_TO_TOP
  CHAR_END - NEW  !!!
      
WORD_PAGE_END
*/
 
//$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_NAME']  = "<span style='color: #990000; font-weight: bold;'>{---}</span>";
$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_DESCRIPTION'] = "<div style='text-align: justify;'>{---}</div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_BODY_MENU'] = "
	{WORD_NAME}<br />
	{WORD_DESCRIPTION}<br />";

$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_MENU_TITLE'] = "<div style='text-align:center;'><b>{---}</b></div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_MENU_TITLE'] = "{WORD_MENU_TITLE}";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_CHAR_START'] = '<!-- doc-index-block --><div class="doc-index-block">';
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_BODY_PAGE'] = '
                            <div class="index-item">
                                <div class="index-header">
                                    {WORD_NAME=page}  
                                </div>
                                <div class="index-desc">
                                    <p>{WORD_DESCRIPTION}</p>
                                </div>
                                <div class="index-icons">
                                <span>{EMAILITEM}&nbsp;{PRINTITEM}&nbsp;{PDFITEM}&nbsp;{ADMINOPTIONS}</span>
                                </div>
                            </div><!-- /index-item --> 
';

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_CHAR_END'] = '</div><!-- /doc-index-block -->';

$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['LINK_TO_TOP']  = "<div class='smalltext'>[{---}]</div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['BACK_TO_TOP'] = "
	{LINK_TO_TOP}
	<hr style='width: 75%' />";

$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_PAGE_TITLE'] = "{---}";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_PAGE_TITLE'] = "{WORD_PAGE_TITLE}";
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_PAGE_START'] = '<!-- doc-index-block --><div class="doc-content-box">';
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_PAGE_END']   = '</div><!--/.doc-content-box -->';

//$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_ANCHOR'] = "<span style='font-size: large; font-weight: bold;'>{---}</span>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_ANCHOR'] = '{WORD_ANCHOR: tag=h2}';

$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_CHAR_LINK'] = '<span class="label label-primary">{---}</span>';
$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['WORD_CHAR'] = '<span class="label label-default">{---}</span>';

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_CHAR_LINK'] = " {WORD_CHAR_LINK: link=link&class=btn-primary}";
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_CHAR_NOLINK'] = '{WORD_CHAR}' ;

$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_ALLCHAR_PRE'] = '<div class="doc-index"> ';
$GLOSSARYBOOTSTRAP3_TEMPLATE['WORD_ALLCHAR_POST'] = "</div>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['PRINT_MESSAGE_PRE'] =   "<br /><div style='text-align:center'><b>";
$GLOSSARYBOOTSTRAP3_TEMPLATE['PRINT_MESSAGE_POST'] =  "</b></div>";

$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['LINK_PAGE_NAVIGATOR'] = "
	<table cellpadding='2' cellspacing='0' style='width:100%; margin-bottom:20px;'>
		<tr>
			<td style='text-align:right;'>{---}
			</td>
		</tr>
	</table>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['LINK_PAGE_NAVIGATOR'] = "{LINK_PAGE_NAVIGATOR}";

$GLOSSARYBOOTSTRAP3_WRAPPER['glossary']['LINK_MENU_NAVIGATOR'] = "
	<table cellpadding='0' cellspacing='0' style='width:100%; margin-bottom:10px;'>
		<tr>
			<td style='text-align:left;'>{---}
			</td>
		</tr>
	</table>";

$GLOSSARYBOOTSTRAP3_TEMPLATE['LINK_MENU_NAVIGATOR'] = "{LINK_MENU_NAVIGATOR}";

?>