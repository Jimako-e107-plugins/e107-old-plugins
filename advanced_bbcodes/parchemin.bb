/*
+---------------------------------------------------------------+
|        Plugin: Advanced BBcodes
|        Version: 0.4
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

$advanced_bbcodes_path = e_PLUGIN.'advanced_bbcodes/';

$bbcode_parchemin = '<div align="center"><table width="430" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><img src="'.$advanced_bbcodes_path.'images/parchemin/parch_01.gif" width=25 height=26></td>
		<td><img src="'.$advanced_bbcodes_path.'images/parchemin/parch_02.gif" width=370 height=26></td>
		<td><img src="'.$advanced_bbcodes_path.'images/parchemin/parch_03.gif" width=35 height=26></td>
	</tr>
	<tr>
		<td background="'.$advanced_bbcodes_path.'images/parchemin/parch_04.gif" width=25 height=136></td>
		<td background="'.$advanced_bbcodes_path.'images/parchemin/parch_05.gif" width=370 height=136><span class="postbody">'.$code_text.'</span></td>
		<td background="'.$advanced_bbcodes_path.'images/parchemin/parch_06.gif" width=35 height=136></td>
	</tr>
	<tr>
		<td><img src="'.$advanced_bbcodes_path.'images/parchemin/parch_07.gif" width=25 height=106></td>
		<td><img src="'.$advanced_bbcodes_path.'images/parchemin/parch_08.gif" width=370 height=106></td>
		<td><img src="'.$advanced_bbcodes_path.'images/parchemin/parch_09.gif" width=35 height=106></td>
	</tr>
</table></div>';

return $bbcode_parchemin;