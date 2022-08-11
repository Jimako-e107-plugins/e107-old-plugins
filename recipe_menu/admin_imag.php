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
$recipemenu_apdb2 = new DB;

if ($_POST['recipemenu_action'] == "recipemenu_app")
{
    $recipemenu_delarray = $_POST['recipemenu_del'];
    foreach($recipemenu_delarray as $recipemenu_element)
    {
        if (file_exists("./images/pictures/" . $recipemenu_element))
        {
            unlink("./images/pictures/" . $recipemenu_element);
        }
    }

    $recipemenu_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption'>" . RCPEMENU_A116 . "</td></tr>
<tr><td class='forumheader3'><strong>" . RCPEMENU_A117 . "</strong></td></tr>
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
<tr><td class='fcaption' colspan='2'>" . RCPEMENU_A100 . "<input type='hidden' name='recipemenu_action' value='recipemenu_app' /></td></tr>";
$recipemenu_text .= "
<tr>
<td class='forumheader2' style='width:90%;'><span class='smalltext'>" . RCPEMENU_A103 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . recipemenu_A84 . "' title='" . recipemenu_A84 . "' /></td>
</tr>";
// Get a list of files in directory and see if they are associated with an advert.  If not display in list.
$dir = "./images/pictures";
$recipemenu_img = 0;
if ($dh = opendir($dir))
{
    while (($file = readdir($dh)) !== false)
    {
        if ($file <> "." && $file <> ".." && $file <> "index.htm")
        {
            $recipemenu_found = $recipemenu_apdb2->db_Select("recipemenu_recipes", "*", "where recipe_picture='" . $file . "'", "nowhere");
            if (!$recipemenu_found)
            {
                $recipemenu_img++;
                $recipemenu_text .= "<tr>
			<td class='forumheader3'>$file</td>
			<td class='forumheader3' style='text-align:center;'>
			<input type='checkbox' class='tbox' style='border:0;' name='recipemenu_del[]' id='delit' value='$file' /></td>
			</tr>";
            }
        }
    }
    closedir($dh);
}
if ($recipemenu_img > 0)
{
    $recipemenu_text .= "<tr><td class='forumheader3' style='text-align:center;'>&nbsp;</td>

<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . RCPEMENU_A101 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='fcaption' colspan='5'><input class='button' type='submit' name='eclassfub_app' value='" . RCPEMENU_A107 . "' /></td></tr>";
}

if ($recipemenu_img == 0)
{
    $recipemenu_text .= "<tr><td class='forumheader3' colspan='5'>" . RCPEMENU_A102 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
$recipemenu_text .= "</table></form>";
$ns->tablerender(RCPEMENU_A2, $recipemenu_text);
require_once(e_ADMIN . "footer.php");

?>