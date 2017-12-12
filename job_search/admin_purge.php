<?php
/*
+---------------------------------------------------------------+
|	Job Search Plugin for e107
|
|	Copyright (C) Fathr Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
if (!is_object($jobsch_obj))
{
    $jobsch_obj = new job_search;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}

$jobsch_gen = new convert;

if ($_POST['jobsch_action'] == "jobsch_app")
{
    $jobsch_newexpire = time() + ($pref['jobsch_valid'] * 86400);
    $jobsch_apparray = $_POST['jobsch_app'];
    foreach($jobsch_apparray as $jobsch_element)
    {
        $sql->db_Update("jobsch_ads", "jobsch_closedate='$jobsch_newexpire' where jobsch_cid='$jobsch_element' ");
    }
    $jobsch_delarray = $_POST['jobsch_del'];
    foreach($jobsch_delarray as $jobsch_element)
    {
        // get the picture and delete that then the ad
        if ($sql->db_Select("jobsch_ads", "jobsch_document", "jobsch_cid='$jobsch_element' "))
        {
            $jobsch_row = $sql->db_Fetch();
            extract($jobsch_row);
            if (file_exists("./images/classifieds/" . $jobsch_document))
            {
                unlink("./images/classifieds/" . $jobsch_document);
            }
        }

        $sql->db_Delete("jobsch_ads", "jobsch_cid='$jobsch_element' ");
    }

    $jobsch_text .= "<table class='fborder' style='".ADMIN_WIDTH."'>
<tr><td class='fcaption'>" . JOBSCH_A82 . "</td></tr>
<tr><td class='forumheader3'><strong>" . JOBSCH_A91 . "</strong></td></tr>
</table>";
}


$jobsch_text .= "
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

<form id='jobsch_qap' action='" . e_SELF . "' method='post'>

<table class='fborder' style='".ADMIN_WIDTH."'>
<tr><td class='fcaption' colspan='5'>" . JOBSCH_A101 . "<input type='hidden' name='jobsch_action' value='jobsch_app' /></td></tr>";
$jobsch_text .= "
<tr>
<td class='forumheader2' style='width:30%;'><span class='smalltext'>" . JOBSCH_A85 . "</span></td>
<td class='forumheader2' style='width:30%;'><span class='smalltext'>" . JOBSCH_A86 . "</span></td>
<td class='forumheader2' style='width:20%;'><span class='smalltext'>" . JOBSCH_A73 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/accept.png' alt='" . JOBSCH_A83 . "' title='" . JOBSCH_A83 . "' /></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/remove.png' alt='" . JOBSCH_A84 . "' title='" . JOBSCH_A84 . "' /></td>
</tr>";
$jobsch_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
if ($sql->db_Select("jobsch_ads", "*", "where jobsch_closedate>'0' and jobsch_closedate<" . $jobsch_today, "nowhere"))
{
    while ($jobsch_row = $sql->db_Fetch())
    {
        extract($jobsch_row);
        $jobsch_post = explode(".", $jobsch_submittedby,2) ;
        $jobsch_postname = $jobsch_post[1];
        $jobsch_expdate = $jobsch_gen->convert_date($jobsch_closedate, "short");
        $jobsch_text .= "<tr>
			<td class='forumheader3'>$jobsch_vacancy</td>
			<td class='forumheader3'>" .$tp->toHTML($jobsch_companyinfoname) . "</td>
			<td class='forumheader3'>$jobsch_expdate&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='jobsch_app[]' id='app' value='$jobsch_cid' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='jobsch_del[]' id='delit' value='$jobsch_cid' /></td>
			</tr>";
    } // while
    $jobsch_text .= "<tr><td class='forumheader3' colspan='3' style='text-align:center;'>&nbsp;</td>
		<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAlls' value='" . JOBSCH_A90 . "'
onclick=\"checkAll('app');\" /></td>
<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . JOBSCH_A90 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='fcaption' colspan='5'><input class='button' type='submit' name='jobschub_app' value='" . JOBSCH_A88 . "' /></td></tr>";
}

else
{
    $jobsch_text .= "<tr><td class='forumheader3' colspan='5'>" . JOBSCH_A102 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
$jobsch_text .= "</table></form>";
$ns->tablerender(JOBSCH_A1, $jobsch_text);
require_once(e_ADMIN . "footer.php");

?>