<?php
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

// verifie si l'utilisateur est un admin, redirige sur l'index du site sinon
if (!getperms("P")) {
header("location:".e_HTTP."index.php");
exit;
}

// multilanguages
@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."advanced_bbcodes/languages/French.php");

$text = "<center>
<b>".ADVANCED_BBCODES_HELP01."</b>
<br />
".ADVANCED_BBCODES_HELP02."
<br /><br />
".ADVANCED_BBCODES_HELPLINK."
</center>";

$ns -> tablerender(ADVANCED_BBCODES_TITRE, $text);

?>