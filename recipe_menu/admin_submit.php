<?php

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/English.php");
}
require_once(e_ADMIN . "auth.php");

if ($_POST['recipemenu_action'] == "recipe_app")
{
    require_once(e_HANDLER . "cache_handler.php");
    if ($pref['cachestatus'] == 1)
    {
        $e107cache->clear("recipetop_menu");
    }
    $recipemenu_apparray = $_POST['recipemenu_app'];
    foreach($recipemenu_apparray as $recipemenu_element)
    {
        $sql->db_Update("recipemenu_recipes", "recipe_approved='1' where recipe_id='$recipemenu_element' ");
    }
    $recipemenu_delarray = $_POST['recipemenu_del'];
    foreach($recipemenu_delarray as $recipemenu_element)
    {
        $sql->db_Select("recipemenu_recipes", "recipe_picture", " recipe_id='$recipemenu_element'");
        $recipemenu_row = $sql->db_Fetch();
        extract($recipemenu_row);

        unlink("./images/pictures/" . $recipe_picture);
        $sql->db_Delete("recipemenu_recipes", "recipe_id='$recipemenu_element' ");
    }

    $recipemenu_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption'>" . RCPEMENU_A40 . "</td></tr>
<tr><td class='forumheader3'><strong>" . RCPEMENU_A48 . "</strong></td></tr>
</table>";
}

$recipemenu_text .= "
<script type=\"text/javascript\">
<!--
function checkAll(checkWhat) {
  // Find all the checkboxes...
  var inputs = document.getElementsByTagName(\"input\");

  // Loop through all form elements (input tags)
  for(index = 0; index < inputs.length; index++)
  {
    // ...if it's the type of checkbox we're looking for, toggle its checked status
    if(inputs[index].id == checkWhat)
      if(inputs[index].checked == 0)
      {
        inputs[index].checked = 1;
      }
      else if(inputs[index].checked == 1)
      {
        inputs[index].checked = 0;
      }
  }
}
-->
</script>

<form id='recipemenu_qap' action='" . e_SELF . "' method='post'>

<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='5'>" . RCPEMENU_A40 . "<input type='hidden' name='recipemenu_action' value='recipe_app' /></td></tr>";

$recipemenu_text .= "
<tr>
<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . RCPEMENU_A41 . "</span></td>
<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . RCPEMENU_A43 . "</span></td>
<td class='forumheader2' style='width:10%;'><span class='smalltext'>" . RCPEMENU_A42 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.gif' alt='" . RCPEMENU_A44 . "' title='" . RCPEMENU_A44 . "' /></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . RCPEMENU_A70 . "' title='" . RCPEMENU_A70 . "' /></td>
</tr>";

if ($sql->db_Select("recipemenu_recipes", "*", "where recipe_approved='0'", "nowhere"))
{
    while ($recipemenu_row = $sql->db_Fetch())
    {
        extract($recipemenu_row);
        $recipemenu_postername = substr($recipe_author, strpos($recipe_author, ".") + 1);

        $recipemenu_text .= "<tr>
			<td class='forumheader3'>" . $tp->toHTML($recipe_name) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($recipe_body) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($recipemenu_postname) . "&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='recipemenu_app[]' id='app' value='$recipe_id' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='recipemenu_del[]' id='delit' value='$recipe_id' /></td>
			</tr>";
    } // while
    $recipemenu_text .= "<tr><td class='forumheader3' colspan='3' style='text-align:center;'>&nbsp;</td>
		<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAlls' value='" . RCPEMENU_A71 . "'
onclick=\"checkAll('app');\" /></td>
<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . RCPEMENU_A71 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='fcaption' colspan='5'><input class='button' type='submit' name='recipeub_app' value='" . RCPEMENU_A47 . "' /></td></tr>";
}

else
{
    $recipemenu_text .= "<tr><td class='forumheader3' colspan='5'>" . RCPEMENU_A45 . "</td></tr>";
}
$recipemenu_text .= "</table></form>";

$ns->tablerender(RCPEMENU_A2, $recipemenu_text);
require_once(e_ADMIN . "footer.php");

?>