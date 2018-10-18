/*
+---------------------------------------------------------------+
|        Plugin: Advanced BBcodes - Hide
|        Version: 0.4
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

@include_once(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."advanced_bbcodes/languages/French.php");

if(!USER)
{
	if(defined('HIDE_TEXT_HIDDEN'))
	{
		return "<div class='".HIDE_TEXT_HIDDEN."'>".LAN_ADVANCED_BBCODES_HIDE_TEXTE."</div>";
	}
	else
	{
		return "<div style='border:solid 1px;padding:5px'>".LAN_ADVANCED_BBCODES_HIDE_TEXTE."</div>";
	}
}
else
{
	if(defined('HIDE_TEXT_SHOWN'))
	{
		return "<div class='".HIDE_TEXT_SHOWN."'>$code_text</div>";
	}
	else
	{
		return "<div style='border:solid 1px;padding:5px'>$code_text</div>";
	}
}