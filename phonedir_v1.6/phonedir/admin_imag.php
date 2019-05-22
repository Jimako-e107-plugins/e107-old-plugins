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
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "phonedir/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "phonedir/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "phonedir/languages/admin/English.php");
}
require_once(e_ADMIN . "auth.php");

if ($_POST['pdir_action'] == "pdir_app")
{
    $pdir_delarray = $_POST['pdir_del'];
    foreach($pdir_delarray as $pdir_element)
    {
        if (file_exists("./photos/" . $pdir_element))
        {
            unlink("./photos/" . $pdir_element);
        }
    }

    $pdir_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption'>" . phonedir_ADLAN_122 . "</td></tr>
<tr><td class='forumheader3'><strong>" . phonedir_ADLAN_125 . "</strong></td></tr>
</table>";
}

$pdir_text .= "
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

<form id='pdir_qap' action='" . e_SELF . "' method='post'>

<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='2'>" . phonedir_ADLAN_119 . "<input type='hidden' name='pdir_action' value='pdir_app' /></td></tr>";
$pdir_text .= "
<tr>
<td class='forumheader2' style='width:90%;'><span class='smalltext'>" . phonedir_ADLAN_121 . "</span></td>
<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.gif' alt='" . phonedir_ADLAN_122 . "' title='" . phonedir_ADLAN_122 . "' /></td>
</tr>";
// Get a list of files in directory and see if they are associated with an advert.  If not display in list.
$dir = "./photos";
$pdir_img = 0;
if ($dh = opendir($dir))
{
    while (($file = readdir($dh)) !== false)
    {
        if ($file <> "." && $file <> ".." && $file <> "index.htm" && $file <> "nophoto.png")
        {
            $pdir_found = $sql->db_Select("pd_directory", "*", "where pd_picture='" . $file . "'", "nowhere");
            if (!$pdir_found)
            {
                $pdir_img++;
                $pdir_text .= "<tr>
			<td class='forumheader3'>$file</td>
			<td class='forumheader3' style='text-align:center;'>
			<input type='checkbox' class='tbox' style='border:0;' name='pdir_del[]' id='delit' value='$file' /></td>
			</tr>";
            }
        }
    }
    closedir($dh);
}
if ($pdir_img > 0)
{
    $pdir_text .= "<tr><td class='forumheader3' style='text-align:center;'>&nbsp;</td>

<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . phonedir_ADLAN_123 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>

<tr><td class='fcaption' colspan='5'><input class='button' type='submit' name='eclassfub_app' value='" . phonedir_ADLAN_124 . "' /></td></tr>";
}
//frank modifications fix lang file error
if ($pdir_img == 0)
{
    $pdir_text .= "<tr><td class='forumheader3' colspan='5'>" . phonedir_ADLAN_124 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
$pdir_text .= "</table></form>";
$ns->tablerender(phonedir_ADLAN_116, $pdir_text);
require_once(e_ADMIN . "footer.php");

?>
