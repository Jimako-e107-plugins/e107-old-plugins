/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes - Acronym
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

global $pref, $tp;

$parm_array = array();
$parm_array = explode("|",$parm);
$tmar = varset($lmargin[0], '0');

$acronym = '<acronym title="'.$tp -> toAttribute($parm_array[0]).'" style="border-bottom: 1px dotted; cursor: help;">'.$code_text.'</acronym>';

return $acronym;