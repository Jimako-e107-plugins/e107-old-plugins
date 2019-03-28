<?php
// **************************************************************************
// *
// *  FAQ Menu for e107 v7
// *
// **************************************************************************
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

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once("includes/faq_class.php");
if (!is_object($faq_obj))
{
    $faq_obj = new FAQ;
}
if ($_POST['faq_action'] == "faq_app")
{
    $faq_apparray = $_POST['faq_app'];
    foreach($faq_apparray as $faq_element)
    {
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_09 . " " . intval($faq_element);
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }
        $sql->db_Update("faq", "faq_approved='1' where faq_id='" . intval($faq_element) . "' ", false, $faq_plugin, $faq_action);
    }
    $faq_delarray = $_POST['faq_del'];
    foreach($faq_delarray as $faq_element)
    {
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_10 . " " . intval($faq_element);
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }
        $sql->db_Delete("faq", "faq_id='" . intval($faq_element) . "' ", false, $faq_plugin, $faq_action);
    }

    $faq_msg .= FAQ_ADLAN_107 ;
    $faq_obj->faq_cache_clear();
}

$faq_text .= "
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

<form id='faq_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='faq_action' value='faq_app' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='5'>" . FAQ_ADLAN_99 . "</td>
		</tr>
				<tr>
			<td class='forumheader2' colspan='5'>" . $faq_msg . "&nbsp;</td>
		</tr>";

$faq_text .= "
		<tr>
			<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . FAQ_ADLAN_100 . "</span></td>
			<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . FAQ_ADLAN_101 . "</span></td>
			<td class='forumheader2' style='width:10%;'><span class='smalltext'>" . FAQ_ADLAN_102 . "</span></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.gif' alt='" . FAQ_ADLAN_103 . "' title='" . FAQ_ADLAN_103 . "' /></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . FAQ_ADLAN_104 . "' title='" . FAQ_ADLAN_104 . "' /></td>
		</tr>";

if ($sql->db_Select("faq", "*", "where faq_approved='0'", "nowhere"))
{
    while ($faq_row = $sql->db_Fetch())
    {
        extract($faq_row);
        $faq_post = explode(".", $faq_author, 2);
        $faq_postname = $faq_post[1];
        $faq_text .= "
		<tr>
			<td class='forumheader3'>" . $tp->toHTML($tp->html_truncate($faq_question, 50), false) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($tp->html_truncate($faq_answer, 50), false) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($faq_postname, false) . "&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='faq_app[]' id='app' value='$faq_id' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='faq_del[]' id='delit' value='$faq_id' /></td>
		</tr>";
    } // while
    $faq_text .= "
		<tr>
			<td class='forumheader3' colspan='3' style='text-align:center;'>&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAlls' value='" . FAQ_ADLAN_105 . "'
onclick=\"checkAll('app');\" /></td>
<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . FAQ_ADLAN_105 . "'
onclick=\"checkAll('delit');\"  />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'><input class='button' type='submit' name='recipeub_app' value='" . FAQ_ADLAN_106 . "' /></td>
		</tr>";
}

else
{
    $faq_text .= "
		<tr>
			<td class='forumheader3' colspan='5'><b>" . FAQ_ADLAN_108 . "</b></td>
		</tr>";
}
$faq_text .= "
		<tr>
			<td class='fcaption' colspan='5'>&nbsp;</td>
		</tr>
	</table>
</form>";

$ns->tablerender(FAQ_ADLAN_98, $faq_text);
require_once(e_ADMIN . "footer.php");

?>
