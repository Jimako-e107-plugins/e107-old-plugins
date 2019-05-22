<?
/* 
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/library_menu.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:16:15 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
$text = "";
if(check_class($pref['library_global_access']=="1")){
$sql -> db_Select("library","library_titre,library_empruntdate","library_emprunte = '1' AND library_empruntepar = '".USERID."' ORDER by library_empruntdate,library_titre");
        while($row = $sql-> db_Fetch())
        {
        $nb = count($row);
            $ret .="<ul>";
            $ret .="<li>$row[library_titre]<br />
                    le ".strftime("%d %B %Y", $row[library_empruntdate])."</li>
                   ";
            $ret .="</ul>";
        }
if($nb){
$text = BIBLIO_MENU_2;
$text .= $ret;
}



	$title = "<a href='".e_PLUGIN."library/library.php'>".BIBLIO_MENU_1."</a>";
	$ns -> tablerender($title, $text, 'library');
}
?>
