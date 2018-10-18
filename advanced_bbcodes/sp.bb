/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes
|        Version: 0.4
|        Date: 12/01/2009
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

$spolierID = mt_rand();
$button = "<input class='spoiler_button' type='button' value='".LAN_ADVANCED_BBCODES_SPOILER_SHOW."' onClick=\"if (this.value=='".LAN_ADVANCED_BBCODES_SPOILER_SHOW."') {this.value='".LAN_ADVANCED_BBCODES_SPOILER_HIDE."'; document.getElementById('{$spolierID}').style.display='';} else {this.value='".LAN_ADVANCED_BBCODES_SPOILER_SHOW."'; document.getElementById('{$spolierID}').style.display='none';}\">";
$title = ($parm ? "{$parm}: {$button}" : "<b>Spoiler</b>: {$button}");
return "{$title}<br /><div class='indent'><div id='{$spolierID}' style='display: none'>{$code_text}</div></div>";
