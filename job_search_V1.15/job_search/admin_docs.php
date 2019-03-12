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
if (!defined('e107_INIT'))
{
    exit;
}
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

if ($_POST['jobsch_action'] == "jobsch_app")
{
    $jobsch_delarray = $_POST['jobsch_del'];
    foreach($jobsch_delarray as $jobsch_element)
    {
        if (file_exists("./documents/" . $jobsch_element))
        {
            unlink("./documents/" . $jobsch_element);
        }
    }

    $jobsch_text .= "<table class='fborder' style='" . ADMIN_WIDTH . "'>
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

<table class='fborder' style='" . ADMIN_WIDTH . "'>
<tr><td class='fcaption' colspan='2'>" . JOBSCH_A103 . "<input type='hidden' name='jobsch_action' value='jobsch_app' /></td></tr>";
$jobsch_text .= "
<tr>
<td class='forumheader2' style='width:90%;'><span class='smalltext'>" . JOBSCH_A104 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . JOBSCH_A84 . "' title='" . JOBSCH_A84 . "' /></td>
</tr>";
// Get a list of files in directory and see if they are associated with an advert.  If not display in list.
$dir = "./documents";
$jobsch_img = 0;
if ($dh = opendir($dir))
{
    while (($file = readdir($dh)) !== false)
    {
        if ($file <> "." && $file <> ".." && $file <> "index.htm")
        {
            $filename = $file;

            $jobsch_found = $sql2->db_Select("jobsch_ads", "*", "where jobsch_document='" . $file . "'", "nowhere");
            if (!$jobsch_found)
            {
                $jobsch_img++;
                $jobsch_text .= "<tr>
			<td class='forumheader3'>" . $filename . "</td>
			<td class='forumheader3' style='text-align:center;'>
			<input type='checkbox' class='tbox' style='border:0;' name='jobsch_del[]' id='delit' value='" . $filename . "' /></td>
			</tr>";
            }
        }
    }
    closedir($dh);
}
if ($jobsch_img > 0)
{
    $jobsch_text .= "<tr><td class='forumheader3' style='text-align:center;'>&nbsp;</td>

<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . JOBSCH_A90 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='forumheader2' colspan='5'><input class='button' type='submit' name='jobsch_app' value='" . JOBSCH_A88 . "' /></td></tr>
<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
else
{
    $jobsch_text .= "<tr><td class='forumheader3' colspan='5'>" . JOBSCH_A105 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
$jobsch_text .= "</table></form>";
$ns->tablerender(JOBSCH_A1, $jobsch_text);
require_once(e_ADMIN . "footer.php");

?>