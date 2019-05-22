<?php
// ***************************************************************
// *
// *		Title		:	Corporate Phone Directory
// *
// *		Author		:	Barry Keal
// *
// ***************************************************************
// ***************************************************************
// *
// * 	Uses fpdf library for PHP.  A fabulous utility for creating
// *     pdf documents without having to have the pdf libraries
// *		installed on the server.  visit www.fpdf.org for details
// *
// ***************************************************************
// Location of font files and get the fpdf library
define('FPDF_FONTPATH', '../pdf/font/');
require('../pdf/ufpdf.php');
require_once("../../class2.php");

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "phonedir/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "phonedir/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "phonedir/languages/English.php");
}
$pd_title = LAN_phonedir_1;
// Create a new class extending fpdf to have custom header and footer for the page
class PDF extends UFPDF
{
    // Page header
    function Header()
    {
        global $pd_title, $pdir_selection, $pdir_siteurl;
        // Logo
        if (file_exists("./images/logo_pd.png"))
        {
            $this->Image('./images/logo_pd.png', 10, 8, 33, '', '', $pdir_siteurl);
        }
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(70, 10, $pd_title, 1, 1, 'C');
        // $this->Ln(10);
        $this->Cell(80);

        $this->SetFont('Arial', 'B', 8);

        $this->Cell(70, 10, $pdir_selection, 0, 0, 'C');
        // Line break
        $this->Line(0, 30, 300, 30);

        $this->Ln(15);
    }
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
// Instantiation of inherited class
$pdir_siteurl = SITEURL . "index.php";
// die("gg".$_GET['pd_optioncat']."hh");
$pdir_selection = pdir_getname("pd_categories", $_GET['pd_optioncat']) . " " ;
if ($_GET['pd_optionsite'] > 0 || $_GET['pd_project'] || $_GET['pd_job'])
{
    $pdir_selection .= LAN_phonedir_88 ;
}

if ($_GET['pd_optionsite'] > 0)
{
    $pdir_selection .= pdir_getname("pd_sites", $_GET['pd_optionsite']) . " - ";
}

if ($_GET['pd_project'] > 0)
{
    $pdir_selection .= pdir_getname("pd_department", $_GET['pd_project']) . " - ";
}

if ($_GET['pd_job'] > 0)
{
    $pdir_selection .= pdir_getname("pd_jobtitle", $_GET['pd_job']);
}

if ($_GET['pd_office'] == 1)
{
    $pdir_selection .= LAN_phonedir_89;
}
if ($_GET['pd_office'] == 0)
{
    $pdir_selection .= LAN_phonedir_90;
}

$pdir_sysarg = "select *
from #pd_directory
left  join  #pd_department on pd_department = pd_dept_id
left  join   #pd_sites  on pd_site = pd_site_id
left join #pd_jobtitle on #pd_directory.pd_jobtitle=pd_job_id
where pd_last_name like '%" . $_GET['pd_name'] . "%' and pd_dir_cat = '" . $_GET['pd_optioncat'] . "'";

if ($pref['phonedir_usesite'] == 1)
{
    if ($_GET['pd_optionsite'] > 0)
    {
        $pdir_sysarg .= " and pd_site = '" . $_GET['pd_optionsite'] . "' ";
    }
}

if ($pref['phonedir_usedept'] == 1)
{
    if ($_GET['pd_project'] > 0)
    {
        $pdir_sysarg .= " and pd_department = '" . $_GET['pd_project'] . "' ";
    }
}

if ($pref['phonedir_usejob'] == 1)
{
    if ($_GET['pd_job'] > 0)
    {
        $pdir_sysarg .= " and pd_jobtitle = '" . $_GET['pd_job'] . "' ";
    }
}

if ($pref['phonedir_useoffice'] == 1)
{
    if ($_GET['pd_office'] == 1 || $_GET['pd_office'] == 0)
    {
        $pdir_sysarg .= " and pd_officed = '" . $_GET['pd_office'] . "' ";
    }
}

$pdir_sysarg .= " order by pd_last_name,pd_first_name";

if ($_GET['pdir_rptt'] == "b")
{
    // basic 2 column report so portrait
    $pdf = new PDF("p", "mm", $_GET['pdir_pagesize']);
}
else
{
    // full report so landscape
    $pdf = new PDF("l", "mm", $_GET['pdir_pagesize']);
}

$pdf->SetCompression(true);
$pdf->SetCreator("Created by Father Barrys e107 phone directory plugin from www.keal.me.uk");
$pdf->SetTitle("Phone Directory");
$pdf->SetKeywords("Phone Directory");
$pdf->SetSubject(SITENAME . " Phone Directory");
$pdf->SetAuthor(SITENAME);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 9);
// die($pdir_sysarg);
// $pdir_count = $sql->db_Count("pd_directory", "", $pdir_sysarg);
// die($pdir_count);
$pdir_count = 1;
if ($pdir_count > 0)
{
    // If there are records to display
    if ($_GET['pdir_rptt'] == "b")
    {
        // basic 2 column report
        twocol();
    }
    else
    {
        // full report
        fullrpt();
    }
}
else
{
    // No records to display
    $pdf->Cell(100, 6, "No Records selected", 0, 1);
}
// ensure buffer is clean before generating output
while (@ob_end_clean());
$pdf->Output("phonedirectory.pdf", $_GET['pdir_dest']);
// ##################### Functions #######################################################
function fullrpt()
{
    global $pdf, $sql, $pdir_sysarg, $tp, $pref;
    // Do a basic 2 column report in portrait
    $pdf->SetFont('Times', 'b', 9);
    $pdf->Cell(25, 6, LAN_phonedir_41, 0, 0);
    $pdf->Cell(25, 6, LAN_phonedir_42, 0, 0);
    $pdf->Cell(25, 6, LAN_phonedir_30, 0, 0);
    $pdf->Cell(25, 6, LAN_phonedir_32, 0, 0);
    $pdf->Cell(25, 6, LAN_phonedir_4, 0, 0);
    $pdf->Cell(55, 6, LAN_phonedir_5, 0, 0);
    if ($pref['phonedir_usejob'] == 1)
    {
        $pdf->Cell(30, 6, LAN_phonedir_8, 0, 0);
    }

    if ($pref['phonedir_usedept'] == 1)
    {
        $pdf->Cell(30, 6, LAN_phonedir_7, 0, 0);
    }
    $pdf->Cell(35, 6, LAN_phonedir_67, 0, 1);
    if ($pref['phonedir_usedept'] != 1 || $pref['phonedir_usejob'] != 1)
    {
        $pad = $pad-30;
    }
    $pdf->SetFont('Times', '', 8);
    $pdir_sysarg;
    $sql->db_Select_gen($pdir_sysarg);
    while ($pdir_row = $sql->db_Fetch())
    {
        extract($pdir_row);
        $pdf->Cell(25, 5, $pd_last_name, 0, 0);
        $pdf->Cell(25, 5, $pd_first_name, 0, 0);
        $pdf->Cell(25, 5, $pd_work_phone, 0, 0);
        $pdf->Cell(25, 5, $pd_centrex, 0, 0);
        $pdf->Cell(25, 5, $pd_mobile, 0, 0);
        $pdf->Cell(55, 5, $pd_email, 0, 0);
        $pad = 180;
        if ($pref['phonedir_usedept'] == 1)
        {
            $pad = $pad + 30;
            $pdf->Cell(30, 5, $pd_dept_name, 0, 0);
        }
        if ($pref['phonedir_usejob'] == 1)
        {
            $pad = $pad + 30;
            $pdf->Cell(30, 5, $pd_job_title, 0, 0);
        }
        if ($pref['phonedir_usesite'] == 1)
        {
            $pdf->Cell(35, 5, $pd_site_name, 0, 1);
        }
        else
        {
            if ($pref['phonedir_usedept'] != 1 || $pref['phonedir_usejob'] != 1)
            {
                $pdf->Cell(35, 5, $pd_address1, 0, 0);

                $pdf->Cell(35, 5, $pd_address2, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_town, 0, 0);
                $pdf->Cell(35, 5, $pd_county, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_postcode, 0, 0);
                $pdf->Cell(35, 5, $pd_country, 0, 1);
            }
            else
            {
                $pdf->Cell(35, 5, $pd_address1, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_address2, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_town, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_county, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_postcode, 0, 1);
                $pdf->cell($pad, 5, " ", 0, 0);
                $pdf->Cell(35, 5, $pd_country, 0, 1);
            }
        }
    }
}

function twocol()
{
    global $pdf, $sql, $pdir_sysarg;
    // Do a basic 2 column report in portrait
    $pdf->SetFont('Times', 'b', 12);
    $pdf->SetLineWidth(0.2);
    $pdf->Line(100, 30, 100, 250);
    if ($_GET['pdir_extn'] == 'y')
    {
        $pdf->Cell(50, 6, LAN_phonedir_9, 0, 0);
        $pdf->Cell(50, 6, LAN_phonedir_20, 0, 0);
        $pdf->Cell(50, 6, LAN_phonedir_9, 0, 0);
        $pdf->Cell(20, 6, LAN_phonedir_20, 0, 1);
    }
    else
    {
        $pdf->Cell(50, 6, LAN_phonedir_9, 0, 0);
        $pdf->Cell(50, 6, LAN_phonedir_19, 0, 0);
        $pdf->Cell(50, 6, LAN_phonedir_9, 0, 0);
        $pdf->Cell(20, 6, LAN_phonedir_19, 0, 1);
    }

    $pdf->SetFont('Times', '', 9);
    $pdir_col = true;
    $sql->db_Select_gen($pdir_sysarg);
    while ($pdir_row = $sql->db_Fetch())
    {
        extract($pdir_row);
        if ($_GET['pdir_extn'] == 'y')
        {
            if ($pdir_col)
            {
                $pdf->Cell(50, 6, $pd_last_name . ", " . $pd_first_name, 0, 0);
                $pdf->Cell(50, 6, $pd_centrex, 0, 0);
                $pdir_col = !$pdir_col;
            }
            else
            {
                $pdf->Cell(50, 6, $pd_last_name . ", " . $pd_first_name, 0, 0);
                $pdf->Cell(20, 6, $pd_centrex, 0, 1);
                $pdir_col = !$pdir_col;
            }
        }
        else
        {
            if ($pdir_col)
            {
                $pdf->Cell(50, 6, $pd_last_name . ", " . $pd_first_name, 0, 0);
                $pdf->Cell(50, 6, $pd_work_phone, 0, 0);
                $pdir_col = !$pdir_col;
            }
            else
            {
                $pdf->Cell(50, 6, $pd_last_name . ", " . $pd_first_name, 0, 0);
                $pdf->Cell(20, 6, $pd_work_phone, 0, 1);
                $pdir_col = !$pdir_col;
            }
        }
    }
}

function pdir_getname($pdir_table, $pdir_rec)
{
    global $tp, $sql2;
    switch ($pdir_table)
    {
        case "pd_sites":
            // die($pdir_table . $pdir_rec);
            $sql2->db_Select($pdir_table, "pd_site_name", "pd_site_id = '$pdir_rec'");
            $pdir_row = $sql2->db_Fetch();
            extract($pdir_row);
            $retval = LAN_phonedir_84 . $pd_site_name;
            break;

        case "pd_department":

            $sql2->db_Select($pdir_table, "pd_dept_name", "pd_dept_id = '$pdir_rec'");
            $pdir_row = $sql2->db_Fetch();
            extract($pdir_row);
            $retval = LAN_phonedir_85 . $pd_dept_name;
            break;

        case "pd_jobtitle":

            $sql2->db_Select($pdir_table, "pd_jobtitle", "where pd_job_id = '$pdir_rec'" . "nowhere", true);
            $pdir_row = $sql2->db_Fetch();
            extract($pdir_row);
            $retval = LAN_phonedir_86 . $pd_job_title;
            break;
        case "pd_categories":

            $sql2->db_Select($pdir_table, "pd_cat_desc", "pd_cat_id = '$pdir_rec'");
            $pdir_row = $sql2->db_Fetch();
            extract($pdir_row);
            $retval = LAN_phonedir_87 . $pd_cat_desc;
            break;

        default:
    } // switch
    $retval = $tp->toHTML($retval, false, "no_make_clickable emotes_off");
    return $retval;
}

?>

