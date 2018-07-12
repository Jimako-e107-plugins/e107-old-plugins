<?php

require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/English.php");
}
require_once(e_ADMIN . "auth.php");

if ($_POST['eclassf_action'] == "eclassf_app")
{
    $eclassf_apparray = $_POST['eclassf_app'];
    foreach($eclassf_apparray as $eclassf_element)
    {
        $sql->db_Update("eclassf_ads", "eclassf_capproved='1' where eclassf_cid='$eclassf_element' ");
    }
    $eclassf_delarray = $_POST['eclassf_del'];
    foreach($eclassf_delarray as $eclassf_element)
    {
        $sql->db_Delete("eclassf_ads", "eclassf_cid='$eclassf_element' ");
    }

    $eclassf_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption'>" . ECLASSF_A82 . "</td></tr>
<tr><td class='forumheader3'><strong>" . ECLASSF_A91 . "</strong></td></tr>
</table>";
}

$eclassf_text .= "
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

<form id='eclassf_qap' action='" . e_SELF . "' method='post'>

<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='5'>" . ECLASSF_A82 . "<input type='hidden' name='eclassf_action' value='eclassf_app' /></td></tr>";

$eclassf_text .= "
<tr>
<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . ECLASSF_A85 . "</span></td>
<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . ECLASSF_A86 . "</span></td>
<td class='forumheader2' style='width:10%;'><span class='smalltext'>" . ECLASSF_A87 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.gif' alt='" . ECLASSF_A83 . "' title='" . ECLASSF_A83 . "' /></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . ECLASSF_A84 . "' title='" . ECLASSF_A84 . "' /></td>
</tr>";

if ($sql->db_Select("eclassf_ads", "*", "where eclassf_capproved='0'", "nowhere"))
{
    while ($eclassf_row = $sql->db_Fetch())
    {
        extract($eclassf_row);

        $eclassf_postname = substr($eclassf_cuser, strpos($eclassf_cuser, ".")+1);
        $eclassf_text .= "<tr>
			<td class='forumheader3'>".$tp->toHTML($eclassf_cname)."</td>
			<td class='forumheader3'>" . $tp->toHTML($eclassf_cdesc) . "</td>
			<td class='forumheader3'>$eclassf_postname&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='eclassf_app[]' id='app' value='$eclassf_cid' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='eclassf_del[]' id='delit' value='$eclassf_cid' /></td>
			</tr>";
    } // while
    $eclassf_text .= "<tr><td class='forumheader3' colspan='3' style='text-align:center;'>&nbsp;</td>
		<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAlls' value='" . ECLASSF_A90 . "'
onclick=\"checkAll('app');\" /></td>
<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . ECLASSF_A90 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='fcaption' colspan='5'><input class='button' type='submit' name='eclassfub_app' value='" . ECLASSF_A88 . "' /></td></tr>";
}

else
{
    $eclassf_text .= "<tr><td class='forumheader3' colspan='5'>" . ECLASSF_A89 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
$eclassf_text .= "</table></form>";

$ns->tablerender(ECLASSF_A1, $eclassf_text);
require_once(e_ADMIN . "footer.php");

?>