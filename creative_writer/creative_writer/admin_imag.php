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
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
require_once(e_ADMIN . "auth.php");

if ($_POST['cwriter_action'] == "cwriter_app")
{
    $cwriter_delarray = $_POST['cwriter_del'];
    foreach($cwriter_delarray as $cwriter_element)
    {
        // print $cwriter_element;
        if (file_exists("pictures/" . $cwriter_element))
        {
            unlink("pictures/" . $cwriter_element);
        }
    }
    $cwriter_delarray = $_POST['cwriter_biodel'];
    foreach($cwriter_delarray as $cwriter_element)
    {
        // print $cwriter_element;
        if (file_exists("biopics/" . $cwriter_element))
        {
            unlink("biopics/" . $cwriter_element);
        }
    }

    $cwriter_msg = CWRITER_A46;
}

$cwriter_text .= "
<script type=\"text/javascript\">
<!--
function checkAll(checkWhat) {
  // Find all the checkboxes...
  var inputs = document.getElementsByTagName(\"input\");

  // Loop through all form elements (input tags)
  for(index = 0; index < inputs.length; index++)
  {
    // ...if it's the type of checkbox we're looking for, toggle its checked status
    str=inputs[index].id
    leng=checkWhat.length
    if(str.substring(0,leng) == checkWhat)
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

<form id='cwriter_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='cwriter_action' value='cwriter_app' />
	</div>
	<table class='fborder' style='width:100%;'>
		<tr>
			<td class='fcaption' colspan='2'>" . CWRITER_A40 . "&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'><strong>" . $cwriter_msg . "&nbsp;</strong></td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:90%;'><span class='smalltext'>" . CWRITER_A41 . "</span></td>
			<td class='forumheader2' style='width:10%;text-align:center;'>
				<img src='" . e_IMAGE . "admin_images/delete_16.png' alt='" . CWRITER_A42 . "' title='" . ECLASSF_A84 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2'>" . CWRITER_A93 . "&nbsp;</td>
		</tr>
";
// Get a list of files in directory and see if they are associated with an advert.  If not display in list.
$cwriter_img = 0;
// get file list
require_once(e_HANDLER . "file_class.php");
$cwriter_fl = new e_file;

$thumblist = $cwriter_fl->get_files(e_PLUGIN . "creative_writer/pictures", '');

foreach($thumblist as $icon)
{
    if (!$sql->db_Select("cw_book", "cw_book_logo", "where cw_book_logo='" . $tp->toDB($icon['fname']) . "'", "nowhere", false))
    {
        $cwriter_img++;
        $cwriter_text .= "
		<tr>
			<td class='forumheader3'>" . $icon['fname'] . "</td>
			<td class='forumheader3' style='text-align:center;'>
				<input type='checkbox' class='tbox' style='border:0;' name='cwriter_del[]' id='delit$cwriter_img' value='" . $tp->toDB($icon['fname']) . "' />
			</td>
		</tr>";
    }
}
$cwriter_text .= "
		<tr>
			<td class='fcaption' colspan='2'>" . CWRITER_A94 . "&nbsp;</td>
		</tr>";

$thumblist = $cwriter_fl->get_files(e_PLUGIN . "creative_writer/biopics", '');

foreach($thumblist as $icon)
{
    if (!$sql->db_Select("cw_biography", "cw_bio_picture", "where cw_bio_picture='" . $tp->toDB($icon['fname']) . "'", "nowhere", false))
    {
        $cwriter_img++;
        $cwriter_text .= "<tr>
			<td class='forumheader3'>" . $icon['fname'] . "</td>
			<td class='forumheader3' style='text-align:center;'>
			<input type='checkbox' class='tbox' style='border:0;' name='cwriter_biodel[]' id='delit$cwriter_img' value='" . $tp->toDB($icon['fname']) . "' /></td>
			</tr>";
    }
}
if ($cwriter_img > 0)
{
    $cwriter_text .= "<tr><td class='forumheader3' style='text-align:center;'>&nbsp;</td>

<td class='forumheader3' style='text-align:center;'>
<input class='button' type='button' name='CheckAll' value='" . CWRITER_A43 . "'
onclick=\"checkAll('delit');\"  /></td>

</tr>
<tr><td class='fcaption' colspan='2'><input class='button' type='submit' name='eclassfub_app' value='" . CWRITER_A44 . "' /></td></tr>";
}

if ($cwriter_img == 0)
{
    $cwriter_text .= "<tr><td class='forumheader3' colspan='5'>" . CWRITER_A45 . "</td></tr>
		<tr><td class='fcaption' colspan='5'>&nbsp;</td></tr>";
}
$cwriter_text .= "</table></form>";
$ns->tablerender(CWRITER_A1, $cwriter_text);
require_once(e_ADMIN . "footer.php");

?>