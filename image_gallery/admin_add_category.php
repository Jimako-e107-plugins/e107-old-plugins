<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_add_category.php
|
| Revision: 0.9.7
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");

   if (file_exists(e_PLUGIN."/image_gallery/languages/image_gallery_".e_LANGUAGE.".php")) {
      require_once(e_PLUGIN."/image_gallery/languages/image_gallery_".e_LANGUAGE.".php");
   } else {
      // No language localization, default to Enlish language
      require_once(e_PLUGIN."/image_gallery/languages/image_gallery_English.php");
   }

   require_once("myfuncs.php");
   require_once ("functions.php");

   function admin_add_category_adminmenu() {
        show_menu("addcat");
    }

 $mydb = new db();
 $mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);


if (!empty($_POST['addcat']) AND !empty($_POST['butaddcat']))
{
	//dobavi kategoriq
    if (!empty($_POST['addcat'])){
        $catname = mysql_real_escape_string(trim($_POST['addcat']));
        $catdescription = mysql_real_escape_string(trim($_POST['cat_desc']));
    }
    $mydb->db_Insert("tbl_category", array("cat_name" => $catname, "cat_description" => $catdescription));
}
if (!empty($_POST['catlist']) AND !empty($_POST['editcat']))
{
    $editing = TRUE;
    $catlist = (INT)$_POST['catlist'];
    //get name of cat for edit and set it in the field. :)
    $mydb->db_Select("tbl_category","cat_name, cat_description", "cat_id = '$catlist'");
    $catrow = $mydb->db_Fetch(MYSQL_ASSOC);

    $catname = $catrow['cat_name'];
    $cat_desc = $catrow['cat_description'];
}

if(!empty($_POST['editcat']) AND !empty($_POST['buteditcat']))
{
    $editcat = mysql_real_escape_string(trim($_POST['editcat']));
    $editcatdesc = mysql_real_escape_string(trim($_POST['editcad_desc']));
    $editcatid = (INT)$_POST['editcatid'];
    if ($mydb->db_Update("tbl_category", "cat_name='$editcat', cat_description='$editcatdesc' WHERE cat_id='$editcatid'" ) == FALSE)
    {
        //error
    }
    unset($editcat);
    unset($editcatid);
    unset($editcatdesc);
    $editing = FALSE;
}

if (!empty($_POST['catlist']) AND !empty($_POST['delcat']))
{
    $catlist = (INT)$_POST['catlist'];
    //working
    $mydb->db_Select("tbl_album", "al_cat_id", "al_cat_id = '$catlist'");
    $myrow = $mydb -> db_Fetch(MYSQL_NUM);

    if( strlen($myrow[0]) > 0)
    {
       $ns->tablerender("", "<div style='text-align:center'><b>".image_gallery_CONFIG_CATL6."</b></div>");

    }
    else
    {
       //working
        $mydb->db_Delete("tbl_category", "cat_id='$catlist'");
    }
    unset($catlist, $myrow, $query);
}

$text = "
	<div style='text-align:center; ".ADMIN_WIDTH."; margin-left: auto; margin-right: auto'>
	<form method='post' action='".e_SELF."'>
	<table style='width:100%' class='fborder'>
	<tr>
	<td class='fcaption' title='".image_gallery_CONFIG_CATL1."' style='text-align:left;' colspan='2'>".image_gallery_CONFIG_CATL1."</td>
	</tr>
	<tr>
";
if ($editing){
    $text .="<td class='fcaption'>".image_gallery_CONFIG_CATL7.":</font>
    </td>
    <td class='fcaption'>
    <label for='cat_name'>".image_gallery_CONFIG_CATL10."</label>
    <input type=\"text\" size=\"40\" class='tbox' maxlength=\"64\" name=\"editcat\" value=\"$catname\" id='cat_name'/><br />
    <label for='cat_desc'>".image_gallery_CONFIG_CATL9."</label>
    <INPUT TYPE=\"text\" size=\"50\" class='tbox' maxlength='255' name='editcad_desc' value=\"$cat_desc\" id='cat_desc'>
    <INPUT TYPE=\"submit\" class='button' name=\"buteditcat\" VALUE=\"".image_gallery_CONFIG_CATL7."\"/>
    <input type=\"hidden\" name=\"editcatid\" value=\"$catlist\"/>
    </td>";
}
else{
    $text .="<td class='fcaption'>".image_gallery_CONFIG_CATL2.":
    </td>
    <td class='fcaption'>
    <label for='cat_name'>".image_gallery_CONFIG_CATL10."</label>
    <input type=\"text\" size=\"40\" class='tbox' maxlength=\"64\" name=\"addcat\" value='' id='cat_name'/><br />
    <label for='cat_desc'>".image_gallery_CONFIG_CATL9."</label>
    <INPUT TYPE=\"text\" size=\"50\" class='tbox' maxlength='255' name=\"cat_desc\" value='' id='cat_desc' />
    <INPUT TYPE=\"submit\" class='button' name=\"butaddcat\" VALUE=\"".image_gallery_CONFIG_CATL2."\" />
    </td>";
}
$text .="</tr>
<tr>
<td class='fcaption'>".image_gallery_CONFIG_CATL3.":
</td>
<td class='fcaption'>
<select class='tbox' name=\"catlist\">";
if ($editing){
//    $text .= $categoryList = listcategory($conn, $catlist)."</select>";
    $text .= $categoryList = listcategory($mydb, $catlist)."</select>";
}
else{
//    $text .= $categoryList = listcategory($conn)."</select>";
    $text .= $categoryList = listcategory($mydb)."</select>";
}
$text .="

<INPUT TYPE=\"submit\" class='button' name='editcat' VALUE=\"".image_gallery_CONFIG_CATL4."\"/>
<input TYPE=\"submit\" class='button' VALUE=\"".image_gallery_CONFIG_CATL5."\" name='delcat' onclick=\"return jsconfirm('".image_gallery_CONFIG_CATL8."')\"/>
</td>
</tr>";

$text .= "</table></form></div>";


$ns->tablerender(image_gallery_cat, $text);

require_once(e_ADMIN."footer.php");
$mydb->db_Close();

?>