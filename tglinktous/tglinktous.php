<?php

/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     Creative Commons License (http://creativecommons.org/licenses/by-nc-nd/2.5/).
|
|     Original Scripts By;
|     Steve Dunstan - http://e107.org - sitebutton_menu
|     doorsoft - http://www.doorsoft.es -  Link Me v1.0
|     
|     Edited and Compiled by;
|     Frederick McAninch - http://e107themersguild.org - TG Link To Us v2.0 CVS
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(HEADERF);

 
include "languages/".e_LANGUAGE.".php";

	$text = "<form name=\"form_link_me\">";
    $text .= "<center><font class=\"option\">".TGLINKTOUS_MENU_TG5."</font></center><br><br>
        <table width=\"90%\" bgcolor=\"$bgcolor2\"cellpadding=\"4\" cellspacing=\"1\" border=\"0\">
        <tr><td bgcolor=\"$bgcolor1\"><font class=\"option\"></td></tr>";
    $text .= "".TGLINKTOUS_MENU_TG6."<br><br>";
    if (TGLINKTOUS_MENU_TG7 != ""){
    $text .= "".TGLINKTOUS_MENU_TG7."<br><br>";
    }else{}
    $text .= "</center>";
	$incremento = 1;
    $direktory = "images";
    $handle=opendir($direktory);
    while ($file = readdir($handle)) {
          $filelist[] = $file;
    }
    asort($filelist);
    while (list ($a, $file) = each ($filelist)) {
          if ($file == "." || $file == ".." || $file == "index.htm") {
          } else {
	   $incremento++;
       $text .= "<p align=\"center\"><img alt=\"".SITENAME."\" src=\"".SITEURL."e107_plugins/TG_link_to_us_menu/images/$file\" border=\"0\"></a></p>\n";
       $text .= "<p align=\"center\"><textarea rows=\"8\" name=\"S$incremento\" cols=\"50%\"><!-- begin link -->\n";
       $text .= "<a href=\"".SITEURL."\" target=\"_blank\"><img alt=\"".SITENAME."\" src=\"".SITEURL."e107_plugins/TG_link_to_us_menu/images/$file\" border=\"0\"></a>\n";
       $text .= "<!-- end link --></textarea><br><a href=\"#\" onClick=\"copia($incremento)\">".TGLINKTOUS_MENU_TG10."</a></p>\n";
       $text .= "<hr>\n";
            }
    }
// the next 5 Lines resting upon --> thx to jochen@rittscher.de  ;o)
		$text .= "<script language=\"JavaScript\">function copia(campo){tempval = eval(\"document.form_link_me.S\"+campo);tempval.focus();tempval.select();if (document.all){therange = tempval.createTextRange();therange.execCommand(\"Copy\");}else{alert(\"".TGLINKTOUS_MENU_TG0."\");}}</script>";
	   $incremento++;
       $text .= "<center><font class=\"option\">".TGLINKTOUS_MENU_TG8."</font><br><br>";
       $text .= "<a href=\"".SITEURL."\" target=\"_blank\">".TGLINKTOUS_MENU_TG9." ".SITENAME."</a></center><br>\n";
       $text .= "<p align=\"center\"><textarea rows=\"4\" name=\"S$incremento\" cols=\"51\"><!-- begin link -->\n";
       $text .= "<a href=\"".SITEURL."\" target=\"_blank\">".TGLINKTOUS_MENU_TG9."".SITENAME."</a>\n";
       $text .= "<!-- end link --></textarea><br><a href=\"#\" onClick=\"copia($incremento)\">".TGLINKTOUS_MENU_TG10."</a></p>\n";
       $text .= "<hr>\n";

    $text .= "<p align=\"right\"><a href=\"http://micro.myftpsite.net\" target=\"_blank\">lnkme 0.2 (c) 2002 by micro.</a><br><a href=\"http://www.cdmon.com\" target=\"_blank\">Linkanos 0.3 2003 por XrV</a><br /><a href=\"http://e107themersguild.org\" target=\"_blank\">TG Link To Us (c) 2005 by TMFOMedia Productions.</a></p><p align=\"right\" class='smalltext'><a href=\"http://e107themersguild.org\" target=\"_blank\">[Get Plugin]</a></p>\n";
    $text .= "</table>";
	$text .= "</form>";
	
$ns->tablerender("".SITENAME." Link", $text);
require_once(FOOTERF);
?>
</form>