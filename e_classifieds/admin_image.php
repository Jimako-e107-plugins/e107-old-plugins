<?php

require_once("../../class2.php");
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
$eclassf_apdb2 = new DB;

if ($_POST['eclassf_action'] == "eclassf_app")
{
    $eclassf_newexpire = time() + ($pref['eclassf_valid'] * 86400);
    $eclassf_apparray = $_POST['eclassf_app'];
    foreach($eclassf_apparray as $eclassf_element)
    {
        $eclassf_apdb2->db_Update("eclassf_ads", "eclassf_cpdate='$eclassf_newexpire' where eclassf_cid='$eclassf_element' ");
    } 
    $eclassf_delarray = $_POST['eclassf_del'];
    foreach($eclassf_delarray as $eclassf_element)
    { 
        // get the picture and delete that then the ad
        if ($eclassf_apdb2->db_Select("eclassf_ads", "eclassf_cpic", "eclassf_cid='$eclassf_element' "))
        {
            $eclassf_row = $eclassf_apdb2->db_Fetch();
            extract($eclassf_row);
            if (file_exists("./images/classifieds/" . $eclassf_cpic))
            {
                unlink("./images/classifieds/" . $eclassf_cpic);
            } 
        } 

        $eclassf_apdb2->db_Delete("eclassf_ads", "eclassf_cid='$eclassf_element' ");
    } 

    $eclassf_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption'>" . ECLASSF_A82 . "</td></tr>
<tr><td class='forumheader3'><strong>" . ECLASSF_A91 . "</strong></td></tr>
</table>";
} 

$eclassf_aj = new textparse();
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
<tr><td class='fcaption' colspan='2'>" . ECLASSF_A103 . "<input type='hidden' name='eclassf_action' value='eclassf_app' /></td></tr>";
$eclassf_text .= "
<tr>
<td class='forumheader2' style='width:90%;'><span class='smalltext'>" . ECLASSF_A104 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . ECLASSF_A84 . "' title='" . ECLASSF_A84 . "' /></td>
</tr>";
// Get a list of files in directory and see if they are associated with an advert.  If not display in list.
$dir = "./images/classifieds";
$eclassf_img = 0;
if ($dh = opendir($dir))
{
    while (($file = readdir($dh)) !== false)
    {
        if ($file <> "." && $file <> "..")
        {
            $eclassf_found = $eclassf_apdb2->db_Select("eclassf_ads", "*", "where eclassf_cpic='" . $file . "'", "nowhere");
            if (!$eclassf_found)
            {
                $eclassf_img++;
                $eclassf_text .= "<tr>
			<td class='forumheader3'>$file</td>
			<td class='forumheader3' style='text-align:center;'>
			<input type='checkbox' class='tbox' style='border:0;' name='eclassf_del[]' id='delit' value='$file' /></td>
			</tr>";
            } 
        } 
    } 
    closedir($dh);
} 
if ($eclassf_img > 0)
{
    $eclassf_text .= "<tr><td class='forumheader3' style='text-align:center;'>&nbsp;</td>
		
<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . ECLASSF_A90 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='fcaption' colspan='5'><input class='button' type='submit' name='eclassfub_app' value='" . ECLASSF_A88 . "' /></td></tr>";
} 

if ($eclassf_img == 0)
{
    $eclassf_text .= "<tr><td class='forumheader3' colspan='5'>" . ECLASSF_A105 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
} 
$eclassf_text .= "</table></form>";
$ns->tablerender(ECLASSF_A1, $eclassf_text);
require_once(e_ADMIN . "footer.php");

?>