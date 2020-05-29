<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|      
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."lique/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."lique/languages/admin/English.php");

class team
{
$name="";
$playerscount=0;
$players="";
/////////---------------------------------------------------------
    function set_team($id, $id_type)
		{
         $name = "";
         return 0;
        }
/////////---------------------------------------------------------
    function get_team($id, $id_type)
		{
         $name = "";
         return $name;
        }
		
}

?>