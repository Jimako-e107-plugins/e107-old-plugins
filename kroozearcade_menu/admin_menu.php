<?php
/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7.3
|        Compatible with all games from www.ibproarcade.com
|        This is a joint reprogram issue
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stephen Sherlock
|        http://www.penbrock.com/
|        admin@penbrock.com
|        
|        Version:
|          030607  - Cleaned up code and commented unused code
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
    require_once(e_ADMIN."auth.php");

    $text = "<div style='text-align:center'>
    <form method='post' action='".e_SELF."'>\n
    <table style='width:85%' class='fborder'>";
	
	if (e_LANGUAGE != "English" && file_exists("./languages/" . e_LANGUAGE . ".php"))
{
    include_once("./languages/" . e_LANGUAGE . ".php");
} 
else
{
    include_once("./languages/English.php");
} 

    $text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='add_games' value='".KROOZEARCADE_3."' /></td>
    </tr>";

    $text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='view_games' value='".KROOZEARCADE_4."' /></td>
    </tr>";

    $text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='edit_scores' value='".KROOZEARCADE_5."' /></td>
    </tr>";

    $text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='edit_categories' value='".KROOZEARCADE_8."' /></td>
    </tr>";
// Added 03-06-07 by Pen. Not working yet but will display banned list
    $text .="
    <tr>
    <td style='width:30%' class='forumheader3' style='text-align:center'><input class='button' style='width: 100%' type='submit' name='edit_banned' value='".KROOZEARCADE_110."' /></td>
    </tr>";


    $text .=" </table>
    </form>
    </div>";
	
/*	                      Testing for future menu options 
	$text .= "<hr>";
	
	$menutitle  = "New Options Menu";

   $butname[]  = "Preferences";
   $butlink[]  = "config.php";
   $butid[]    = "config";

   $butname[]  = "Categories";
   $butlink[]  = "admin_cat.php";
   $butid[]    = "category";

   $butname[]  = "Read Me";
   $butlink[]  = "admin_readme.php";
   $butid[]    = "readme";
   
   // Added 3-2 penbrock
   $butname[]	=	"Ban List";
   $butlink[]	=	"banned.php"; // need to craete yet
   $butlink[]	=	"banned";

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };
*/
   show_admin_menu($menutitle, $pageid, $var);

    $ns -> tablerender(KROOZEARCADE_6, $text);



?>