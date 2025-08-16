<?php
// **************************************************************************
// *
// *  Newslinks Menu for e107 v7xx
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
require_once(e_PLUGIN."newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}
// require_once(HEADERF);
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if ($_POST['newslink_action'] == "newslink_app")
{

    $newslink_apparray = $_POST['newslink_app'];
    foreach($newslink_apparray as $newslink_element)
    {
        $sql->db_Update("newslink_newslink", "newslink_approved='1' where newslink_id='$newslink_element' ");
    }
    $newslink_delarray = $_POST['newslink_del'];
    foreach($newslink_delarray as $newslink_element)
    {
        $sql->db_Delete("newslink_newslink", "newslink_id='$newslink_element' ");
    }

    $newslink_text .= "
	<table class='fborder'  style='" . ADMIN_WIDTH . "' >
		<tr>
			<td class='fcaption'>" . NEWSLINK_A40 . "</td>
		</tr>
		<tr>
			<td class='forumheader3'><strong>" . NEWSLINK_A48 . "</strong></td>
		</tr>
	</table>";
}


$newslink_text .= "
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
<form id='newslink_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='newslink_action' value='newslink_app' />
	</div>
	<table class='fborder'  style='" . ADMIN_WIDTH . "' >
		<tr>
			<td class='fcaption' colspan='5'>" . NEWSLINK_A40 . "</td>
		</tr>";
$newslink_text .= "
		<tr>
			<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . NEWSLINK_A41 . "</span></td>
			<td class='forumheader2' style='width:35%;'><span class='smalltext'>" . NEWSLINK_A43 . "</span></td>
			<td class='forumheader2' style='width:10%;'><span class='smalltext'>" . NEWSLINK_A42 . "</span></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.gif' alt='" . NEWSLINK_A44 . "' title='" . NEWSLINK_A44 . "' /></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . NEWSLINK_A70 . "' title='" . NEWSLINK_A70 . "' /></td>
		</tr>";
if ($sql->db_Select("newslink_newslink", "*", "where newslink_approved='0'", "nowhere"))
{
    while ($newslink_row = $sql->db_Fetch())
    {
        extract($newslink_row);
        $newslink_post = explode(".", $newslink_author);
        $newslink_postname = $newslink_post[1];
        $newslink_text .= "
		<tr>
			<td class='forumheader3'>$newslink_name</td>
			<td class='forumheader3'>" . $tp->toHTML($newslink_body) . "</td>
			<td class='forumheader3'>$newslink_postname&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='newslink_app[]' id='app' value='$newslink_id' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='newslink_del[]' id='delit' value='$newslink_id' /></td>
		</tr>";
    } // while
    $newslink_text .= "
		<tr>
			<td class='forumheader3' colspan='3' style='text-align:center;'>&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAll' value='" . NEWSLINK_A71 . "'
onclick=\"checkAll('app');\" /><br />
			</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAll' value='" . NEWSLINK_A71 . "'
onclick=\"checkAll('delit');\" />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'><input class='button' type='submit' name='newslinkub_app' value='" . NEWSLINK_A47 . "' /></td>
		</tr>";
}

else
{
    $newslink_text .= "
		<tr>
			<td class='forumheader3' colspan='5'>" . NEWSLINK_A45 . "</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='5'>&nbsp;</td>
		</tr>";
}
$newslink_text .= "
	</table>
</form>";

$ns->tablerender(NEWSLINK_A2, $newslink_text);
require_once(e_ADMIN . "footer.php");

?>