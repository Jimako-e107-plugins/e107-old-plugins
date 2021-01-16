<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT')) {
    exit;
}
if (!getperms("P")) {
    header("location:" . e_HTTP . "index.php");
    exit;
}

require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH")) {
    define(ADMIN_WIDTH, "width:100%");
}

if (!is_object($cpage_obj)) {
    require_once(e_PLUGIN . "cpage/includes/cpage_class.php");
    $cpage_obj = new cpage;
}

if (isset($_POST['cpageupdate'])) {
    require_once('languages/' . e_LANGUAGE . '_cpage_stopwords.php');
    // import selected pages in to plugin
    $cpage_mode = 'success';
    foreach($_POST['cpage_import'] as $value) {
        if ($sql->db_Select('page', '*', 'where page_id=' . $value, 'nowhere', false)) {
            $cpage_row = $sql->db_Fetch();
            // fetch the page to import
            // strip out all unnecessary or unwanted items from the body
            // make the description
            // make the keywords
            $cpage_body = stripUnwanted($cpage_row['page_text']);
            $keywords = implode(',', $cpage_body);
            // print_a($cpage_body);
            $description = $tp->text_truncate($description, 220, '');
            $title = $tp->text_truncate($cpage_row['page_title'], 25, '');
            // make the page title
            $link = $cpage_row['page_title'];

            if ($cpage_row['page_author'] == 0) {
                $cpage_row['page_author'] = USERID . '.' . USERNAME;
            }
            if ($sql2->db_Insert('cpage_page', "
			 '" . $cpage_row['page_id'] . "',
			 '" . $cpage_row['page_title'] . "',
			 '" . $tp->toDB($cpage_row['page_text']) . "',
			 '" . $cpage_row['page_author'] . "',
			 '" . $cpage_row['page_datestamp'] . "',
			 '" . intval($CPAGE_PREF['cpage_showdate_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_lastdate_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_showauthor_flag']) . "',
			 '" . intval($cpage_row['page_rating_flag']) . "',
			 '" . intval($cpage_row['page_comment_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_page_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_menu_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_email_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_print_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_pdf_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_views_flag']) . "',
			 '" . intval($CPAGE_PREF['cpage_unique_flag']) . "',
			 '" . $cpage_row['page_password'] . "',
			 '" . intval($cpage_row['page_class']) . "',
			 '" . $cpage_row['page_ip_restrict'] . "',
			 '" . $tp->toDB($description) . "',
			 '" . $tp->toDB($keywords) . "',
			 '" . $title . "',
			 0,
			 0,
			 " . time() . ",
			 0,
			 '" . $title . "',
			'',0,0,
			'" . intval($CPAGE_PREF['cpage_category']) . "'", false)) {
                $cpage_msgtext .= '<li>' . CPAGE_I08 . ' ' . $value . '</li>';
            } else {
                $cpage_mode = 'error';
                $cpage_msgtext .= '<li>' . CPAGE_I09 . ' ' . $value . '</li>';
            }
        } else {
        	$cpage_mode = 'error';
            $cpage_msgtext .= '<li>' . CPAGE_I10 . ' ' . $value . '</li>';
        }
    }
}

$cpage_text .= "
<script language=javascript>
function checkall()
{
	// toggle state of checkboxes
	// get the state of this checkbox
	var current = document.getElementById('cpage_checkall').checked;
	var status=current?true:false;
	var cName='cpage_import[]';
	var theForm=document.getElementById('custompage_import');

	for (i=0,n=theForm.elements.length;i<n;i++)
	{
		if (theForm.elements[i].name.indexOf(cName) !=-1)
		{
	    	theForm.elements[i].checked = status;
		}
	}
}
</script>

<form method='post' action='" . e_SELF . "' id='custompage_import'>
	<table  style='" . ADMIN_WIDTH . "'  class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'>" . CPAGE_I01 . "</td>
		</tr>
		<tr>
			<td colspan='3' class='forumheader2'>" . $prototype_obj->message_box($cpage_mode, $cpage_msgtext) . "</td>
		</tr>
		<tr>
			<td colspan='3' class='forumheader3'>" . CPAGE_I11 . "<br /><br />" . CPAGE_I12 . "</td>
		</tr>
		<tr>
			<td style='width:10%;text-align:center;' class='forumheader2'>" . CPAGE_I04 . "</td>
			<td style='width:80%;' class='forumheader2'>" . CPAGE_I05 . "</td>
			<td style='width:10%;text-align:center;' class='forumheader2'>" . CPAGE_I06 . "</td>
		</tr>";
if ($sql->db_Select_gen('select page_id,page_title,cpage_id from #page left join #cpage_page on cpage_id=page_id  WHERE  page_theme="" or page_theme is NULL order by page_id', false)) {
    while ($cpage_row = $sql->db_Fetch()) {
        $cpage_text .= "
		<tr>
			<td style='width:10%;text-align:center;' class='forumheader3'>" . $tp->toHTML($cpage_row['page_id'], false) . "</td>
			<td style='width:80%;' class='forumheader3'>" . $tp->toHTML($cpage_row['page_title'], false) . "</td>
			<td style='width:10%;text-align:center;' class='forumheader3'>";
        if ($cpage_row['cpage_id'] > 0) {
            // already in use (probably previously imported)
            $cpage_text .= CPAGE_I07;
        } else {
            $cpage_text .= "<input type='checkbox' id='cpage_import_{$cpage_row['page_id']}' name='cpage_import[]' value='{$cpage_row['page_id']}' />";
        }
        $cpage_text .= "
			</td>
		</tr>";
    }
} else {
    // no custom pages to import
    $cpage_text .= "
		<tr>
			<td colspan='3' class='forumheader2'>" . CPAGE_I03 . "</td>
		</tr>";
}
// Submit button
$cpage_text .= "
		<tr>
			<td colspan='2' class='forumheader2' style='text-align: right;'>" . CPAGE_I02 . "</td>
			<td class='forumheader2' style='text-align: center;'>
				<input type='checkbox' name='cpage_checkall' id='cpage_checkall' onchange='checkall()' value='1' />
			</td>
		</tr>
		<tr>
			<td colspan='3' class='forumheader2' style='text-align: left;'>
				<input type='submit'  name='cpageupdate' value='" . CPAGE_I06 . "' class='button' />
			</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";

$ns->tablerender(CPAGE_I01, $cpage_text);

require_once(e_ADMIN . "footer.php");
// End of main program - now for the functions
/**
* stripUnwanted()
* This function strips various unwanted items from $text. Used to clean up the body text
* of the page to create keywords and description meta tags.
*
* @param mixed $text text to strip unwanted bits from
* @return string stripped text
* @version 1.1
* @since 1.1
*/
function stripUnwanted($text)
{
    global $cpage_stopwords, $description;
    // remove bbcode
    $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
    $replace = '';
    $text = preg_replace($pattern, $replace, $text);
    $find = array("'", "\"");
    $alt = array('', '');
    $text = str_replace($find, $alt, $text);
    // remove shortcodes
    $text = preg_replace(" (\\{.*?\\})", '', $text);
    // strip html from http://nadeausoftware.com/articles/2007/09/php_tip_how_strip_html_tags_web_page
    $text = preg_replace(
        array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
            '@<area[^>]*?.*?</area>@siu',
            '@<map[^>]*?.*?</map>@siu',
            '@<marquee[^>]*?.*?</marquee>@siu',
            '@<menu[^>]*?.*?</menu>@siu',
            '@<select[^>]*?.*?</select>@siu',
            // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
            ),
        array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
            ),
        $text);
    $text = strip_tags($text);
    // $text = html_entity_decode($text, ENT_QUOTES, "utf-8");
    $text = html_entity_decode($text, ENT_QUOTES);
    $description = $text;
    $text = strip_punctuation($text);
    $text = strip_symbols($text);
    $text = strip_numbers($text);
    // to lower case
    // $text = mb_strtolower($text, "utf-8");
    $text = strtolower($text);
    // split into words
    // mb_regex_encoding("utf-8");
    // $words = mb_split(' +', $text);
    $words = split(' +', $text);
    $words = array_diff($words, $cpage_stopwords);
    $words = array_unique($words);
    return $words;
}
/**
* strip_punctuation()
* Called by stripUnwanted to remove punctuation
*
* @param mixed $text strip punctuation from text
* @return stripped text
* @version 1.1
* @since 1.1
*/
function strip_punctuation($text)
{
    // http://nadeausoftware.com/articles/2007/9/php_tip_how_strip_punctuation_characters_web_page
    $urlbrackets = '\[\]\(\)';
    $urlspacebefore = ':;\'_\*%@&?!' . $urlbrackets;
    $urlspaceafter = '\.,:;\'\-_\*@&\/\\\\\?!#' . $urlbrackets;
    $urlall = '\.,:;\'\-_\*%@&\/\\\\\?!#' . $urlbrackets;

    $specialquotes = '\'"\*<>';

    $fullstop = '\x{002E}\x{FE52}\x{FF0E}';
    $comma = '\x{002C}\x{FE50}\x{FF0C}';
    $arabsep = '\x{066B}\x{066C}';
    $numseparators = $fullstop . $comma . $arabsep;

    $numbersign = '\x{0023}\x{FE5F}\x{FF03}';
    $percent = '\x{066A}\x{0025}\x{066A}\x{FE6A}\x{FF05}\x{2030}\x{2031}';
    $prime = '\x{2032}\x{2033}\x{2034}\x{2057}';
    $nummodifiers = $numbersign . $percent . $prime;

    return preg_replace(
        array(
            // Remove separator, control, formatting, surrogate,
            // open/close quotes.
            '/[\p{Z}\p{Cc}\p{Cf}\p{Cs}\p{Pi}\p{Pf}]/u',
            // Remove other punctuation except special cases
            '/\p{Po}(?<![' . $specialquotes . $numseparators . $urlall . $nummodifiers . '])/u',
            // Remove non-URL open/close brackets, except URL brackets.
            '/[\p{Ps}\p{Pe}](?<![' . $urlbrackets . '])/u',
            // Remove special quotes, dashes, connectors, number
            // separators, and URL characters followed by a space
            '/[' . $specialquotes . $numseparators . $urlspaceafter . '\p{Pd}\p{Pc}]+((?= )|$)/u',
            // Remove special quotes, connectors, and URL characters
            // preceded by a space
            '/((?<= )|^)[' . $specialquotes . $urlspacebefore . '\p{Pc}]+/u',
            // Remove dashes preceded by a space, but not followed by a number
            '/((?<= )|^)\p{Pd}+(?![\p{N}\p{Sc}])/u',
            // Remove consecutive spaces
            '/ +/',
            ),
        ' ',
        $text);
}

/**
* strip_symbols()
* Strips out symbols, called by stripUnwanted
*
* @param mixed $text stext to strip symbols from
* @return string - cleaned text
* @version 1.1
* @since 1.1
*/
function strip_symbols($text)
{
    // http://nadeausoftware.com/articles/2007/09/php_tip_how_strip_symbol_characters_web_page
    $plus = '\+\x{FE62}\x{FF0B}\x{208A}\x{207A}';
    $minus = '\x{2012}\x{208B}\x{207B}';

    $units = '\\x{00B0}\x{2103}\x{2109}\\x{23CD}';
    $units .= '\\x{32CC}-\\x{32CE}';
    $units .= '\\x{3300}-\\x{3357}';
    $units .= '\\x{3371}-\\x{33DF}';
    $units .= '\\x{33FF}';

    $ideo = '\\x{2E80}-\\x{2EF3}';
    $ideo .= '\\x{2F00}-\\x{2FD5}';
    $ideo .= '\\x{2FF0}-\\x{2FFB}';
    $ideo .= '\\x{3037}-\\x{303F}';
    $ideo .= '\\x{3190}-\\x{319F}';
    $ideo .= '\\x{31C0}-\\x{31CF}';
    $ideo .= '\\x{32C0}-\\x{32CB}';
    $ideo .= '\\x{3358}-\\x{3370}';
    $ideo .= '\\x{33E0}-\\x{33FE}';
    $ideo .= '\\x{A490}-\\x{A4C6}';

    return preg_replace(
        array(
            // Remove modifier and private use symbols.
            '/[\p{Sk}\p{Co}]/u',
            // Remove mathematics symbols except + - = ~ and fraction slash
            '/\p{Sm}(?<![' . $plus . $minus . '=~\x{2044}])/u',
            // Remove + - if space before, no number or currency after
            '/((?<= )|^)[' . $plus . $minus . ']+((?![\p{N}\p{Sc}])|$)/u',
            // Remove = if space before
            '/((?<= )|^)=+/u',
            // Remove + - = ~ if space after
            '/[' . $plus . $minus . '=~]+((?= )|$)/u',
            // Remove other symbols except units and ideograph parts
            '/\p{So}(?<![' . $units . $ideo . '])/u',
            // Remove consecutive white space
            '/ +/',
            ),
        ' ',
        $text);
}

/**
* strip_numbers()
* Strips out numbers, called by stripUnwanted
*
* @param mixed $text text to strip numbers from
* @return
* @version 1.1
* @since 1.1
*/
function strip_numbers($text)
{
    $urlchars = '\.,:;\'=+\-_\*%@&\/\\\\?!#~\[\]\(\)';
    $notdelim = '\p{L}\p{M}\p{N}\p{Pc}\p{Pd}' . $urlchars;
    $predelim = '((?<=[^' . $notdelim . '])|^)';
    $postdelim = '((?=[^' . $notdelim . '])|$)';

    $fullstop = '\x{002E}\x{FE52}\x{FF0E}';
    $comma = '\x{002C}\x{FE50}\x{FF0C}';
    $arabsep = '\x{066B}\x{066C}';
    $numseparators = $fullstop . $comma . $arabsep;
    $plus = '\+\x{FE62}\x{FF0B}\x{208A}\x{207A}';
    $minus = '\x{2212}\x{208B}\x{207B}\p{Pd}';
    $slash = '[\/\x{2044}]';
    $colon = ':\x{FE55}\x{FF1A}\x{2236}';
    $units = '%\x{FF05}\x{FE64}\x{2030}\x{2031}';
    $units .= '\x{00B0}\x{2103}\x{2109}\x{23CD}';
    $units .= '\x{32CC}-\x{32CE}';
    $units .= '\x{3300}-\x{3357}';
    $units .= '\x{3371}-\x{33DF}';
    $units .= '\x{33FF}';
    $percents = '%\x{FE64}\x{FF05}\x{2030}\x{2031}';
    $ampm = '([aApP][mM])';

    $digits = '[\p{N}' . $numseparators . ']+';
    $sign = '[' . $plus . $minus . ']?';
    $exponent = '([eE]' . $sign . $digits . ')?';
    $prenum = $sign . '[\p{Sc}#]?' . $sign;
    $postnum = '([\p{Sc}' . $units . $percents . ']|' . $ampm . ')?';
    $number = $prenum . $digits . $exponent . $postnum;
    $fraction = $number . '(' . $slash . $number . ')?';
    $numpair = $fraction . '([' . $minus . $colon . $fullstop . ']' . $fraction . ')*';

    return preg_replace(
        array(
            // Match delimited numbers
            '/' . $predelim . $numpair . $postdelim . '/u',
            // Match consecutive white space
            '/ +/u',
            ),
        ' ',
        $text);
}