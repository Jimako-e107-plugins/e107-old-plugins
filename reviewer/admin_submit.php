<?php
/*
+---------------------------------------------------------------+
|        Reviewer for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
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
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");

if (!is_object($reviewer_obj))
{
    e107_require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
    $reviewer_obj = new reviewer;
}

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if ($_POST['reviewer_action'] == "reviewer_app")
{
    $reviewer_apparray = $_POST['reviewer_app'];
    foreach($reviewer_apparray as $reviewer_element)
    {
        $sql->db_Update("reviewer_items", "reviewer_items_approved='1' where reviewer_items_id='$reviewer_element' ");
    }
    $reviewer_delarray = $_POST['reviewer_del'];
    foreach($reviewer_delarray as $reviewer_element)
    {
        $sql->db_Delete("reviewer_items", "reviewer_items_id='$reviewer_element' ");
    }

    $reviewer_msg = REVIEWER_SI11;
}

$reviewer_text .= "
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
<form id='reviewer_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='reviewer_action' value='reviewer_app' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='5'>" . REVIEWER_SI01 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='5'><b>$reviewer_msg</b>&nbsp;</td>
		</tr>		";


$reviewer_text .= "
		<tr>
			<td class='forumheader2' style='width:25%;'><span class='smalltext'>" . REVIEWER_SI02 . "</span></td>
			<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . REVIEWER_SI03 . "</span></td>
			<td class='forumheader2' style='width:20%;'><span class='smalltext'>" . REVIEWER_SI04 . "</span></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.png' alt='" . REVIEWER_SI05 . "' title='" . REVIEWER_SI05 . "' /></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.png' alt='" . REVIEWER_SI06 . "' title='" . REVIEWER_SI06 . "' /></td>
		</tr>";
if ($sql->db_Select_gen("select * from #reviewer_items left join #user on reviewer_items_posterid = user_id
where reviewer_items_approved='0'", false))
{
    while ($reviewer_row = $sql->db_Fetch())
    {
        extract($reviewer_row);

        $reviewer_postername = $tp->toHTML($user_name, false);
        $reviewer_text .= "
		<tr>
			<td class='forumheader3'>" . $tp->toHTML($reviewer_items_name, false) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($reviewer_items_description) . "</td>
			<td class='forumheader3'>$reviewer_postername&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='reviewer_app[]' id='app' value='$reviewer_items_id' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='reviewer_del[]' id='delit' value='$reviewer_items_id' /></td>
		</tr>";
    } // while
    $reviewer_text .= "
		<tr>
			<td class='forumheader3' colspan='3' style='text-align:center;'>&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAll' value='" . REVIEWER_SI07 . "'
onclick=\"checkAll('app');\" /><br />
			</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAll' value='" . REVIEWER_SI07 . "'
onclick=\"checkAll('delit');\" />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'><input class='button' type='submit' name='reviewer_subapp' value='" . REVIEWER_SI08 . "' /></td>
		</tr>";
}

else
{
    $reviewer_text .= "
		<tr>
			<td class='forumheader3' colspan='5'>" . REVIEWER_SI09 . "</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'>&nbsp;</td>
		</tr>";
}
$reviewer_text .= "
	</table>
</form>";

$ns->tablerender(REVIEWER_SI10, $reviewer_text);
require_once(e_ADMIN . "footer.php");

?>