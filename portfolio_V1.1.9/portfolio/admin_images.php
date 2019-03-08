<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
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

require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");

if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
// Do file upload if required
if ($_POST['portfolio_updest'] == 1)
{
    $portfolio_uploaddir = e_PLUGIN . "portfolio/images/portfolio" ;
    $portfolio_destination = PORTFOLIO_A114;
}
if ($_POST['portfolio_updest'] == 2)
{
    $portfolio_uploaddir = e_PLUGIN . "portfolio/images/staff" ;
    $portfolio_destination = PORTFOLIO_A113;
}

if (isset($_FILES['portfolio_upfile']['name'][0]))
{
    require_once(e_HANDLER . "upload_handler.php");
    $portfolio_fileoptions = array('file_mask' => 'jpg,gif,png', 'file_array_name' => 'portfolio_upfile', 'overwrite' => true);
    $portfolio_upresult = process_uploaded_files($portfolio_uploaddir, false, $portfolio_fileoptions);
    if ($portfolio_upresult !== false)
    {
        $portfolio_msg .= $portfolio_upresult[0]['message'] . " " . $portfolio_destination;
    }
    else
    {
        $portfolio_msg .= PORTFOLIO_A115 . " " . $portfolio_destination;
    }
    $portfolio_obj->cache_clear();
}
// Delete image from people
if (isset($_POST['portfolio_deld']))
{
    if ($_POST['portfolio_deldok'] == '1')
    {
        $sql = new DB;
        if ($sql->db_Select("portfolio_cat", "portfoliocat_id", "portfoliocat_imageurl='" . $_POST['portfolio_catsel'] . "'"))
        {
            $portfolio_msg .= PORTFOLIO_A81;
        }
        else
        {
            if (unlink("./images/portfolio/" . $_POST['portfolio_catsel']))
            {
                $portfolio_msg .= $_POST['portfolio_catsel'] . PORTFOLIO_A78 ;
            }
            else
            {
                $portfolio_msg .= PORTFOLIO_A79 . $_POST['portfolio_catsel'] ;
            }
        }
    }
    else
    {
        $portfolio_msg .= PORTFOLIO_A80 ;
    }
    $portfolio_obj->cache_clear();
}
// Delete image from staff
if (isset($_POST['portfolio_dels']))
{
    if ($_POST['portfolio_delsok'] == '1')
    {
        if ($sql->db_Select("portfolio_person", "portfolio_person_id", "portfolio_person_websiteurl='" . $_POST['portfolio_staffsel'] . "'"))
        {
            $portfolio_msg .= PORTFOLIO_A81 ;
        }
        else
        {
            if (unlink("./images/staff/" . $_POST['portfolio_staffsel']))
            {
                $portfolio_msg .= $_POST['portfolio_staffsel'] . PORTFOLIO_A78 ;
            }
            else
            {
                $portfolio_msg .= PORTFOLIO_A79 . $_POST['portfolio_staffsel'];
            }
        }
    }
    else
    {
        $portfolio_msg .= PORTFOLIO_A80 ;
    }
}
// Get the existing files
// Get list of files in staff
if ($handle = opendir("./images/staff"))
{
    $portfolio_ssel .= "<select class='tbox' name='portfolio_staffsel'><option value=''> </option>";
    while (false !== ($file = readdir($handle)))
    {
        if ($file <> "." && $file <> "..")
            $portfolio_ssel .= "<option value='$file' " .
            ($file == $portfolio_person_websiteurl ? " selected='selected' " : " ") . ">$file</option>";
    }

    closedir($handle);
    $portfolio_ssel .= "</select>";
}
// Get list of images in portfolio
if ($handle = opendir("./images/portfolio"))
{
    $portfolio_dsel .= "<select class='tbox' name='portfolio_catsel'><option value=''> </option>";
    while (false !== ($file = readdir($handle)))
    {
        if ($file <> "." && $file <> "..")
            $portfolio_dsel .= "<option value='$file' " .
            ($file == $portfolio_person_websiteurl ? " selected='selected' " : " ") . ">$file</option>";
    }

    closedir($handle);
    $portfolio_dsel .= "</select>";
}
// $portfolio_dir = opendir("./images/portfolio");
// Get the image to upload then upload it.
$portfolio_text .= "
<form enctype='multipart/form-data' id='fileupform' method='post' action='" . e_SELF . "' >
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . PORTFOLIO_IMG_01 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2'><b>$portfolio_msg</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PORTFOLIO_A71 . "</td>
			<td class='forumheader3' style='width:70%;'>$portfolio_dsel&nbsp;&nbsp;
				<input type='submit' name='portfolio_deld' value='" . PORTFOLIO_A72 . "' class='tbox' />&nbsp;&nbsp;" . PORTFOLIO_A73 . "
				<input type='checkbox' class='tbox' name='portfolio_deldok' value='1' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PORTFOLIO_A75 . "</td>
			<td class='forumheader3' style='width:70%;'>$portfolio_ssel&nbsp;&nbsp;
				<input type='submit' name='portfolio_dels' value='" . PORTFOLIO_A72 . "' class='tbox' />&nbsp;&nbsp;" . PORTFOLIO_A73 . "
				<input type='checkbox' class='tbox' name='portfolio_delsok' value='1' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PORTFOLIO_A69 . "</td>
			<td class='forumheader3' style='width:70%;'>
				<input type='radio' class='tbox' style='border:0px;' name='portfolio_updest' value='1' checked='checked' />" . PORTFOLIO_A76 . "<br />
				<input type='radio' class='tbox' style='border:0px;' name='portfolio_updest' value='2' />" . PORTFOLIO_A77 . "<br />
				<input class='tbox' size='40' type='file' name='portfolio_upfile[]' /><br />
				<input type='submit' class='tbox' name='portfolio_upit' value='" . PORTFOLIO_A74 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2'>&nbsp;</td>
		</tr>
	</table>
</form>";
$portfolio_caption = PORTFOLIO_A19;
$ns->tablerender($portfolio_caption, $portfolio_text);

require_once(e_ADMIN . "footer.php");

?>