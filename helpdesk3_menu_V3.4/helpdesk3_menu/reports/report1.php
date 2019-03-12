<?php
// *report*Finance*
// Create a new class extending fpdf to have custom header and footer for the page
class HDU_PDF extends UFPDF
{
    // Page header
    function Header()
    {
        global $hdu_now, $hdu_title, $hdu_siteurl;
        // Logo
        if (file_exists("./images/logo_hd.png"))
        {
            $this->Image('./images/logo_hd.png', 10, 8, 33, '', '', $hdu_siteurl);
        }
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        // $this->Cell(80);
        // Title
        $this->Cell(0, 10, HDU_REPORTTITLE, 0, 1, 'C');
        // $this->Ln(10);
        // $this->Cell(80);
        // Line break
        $this->Line(0, 33, 300, 33);
        $this->SetFont('Arial', 'bu', 9);
        $hdu_tit = $hdu_title . " " . HDU_121 . " " . $hdu_now;
        $this->Cell(0, 6, $hdu_tit, 0, 1, 'C');
        $this->SetFont('Arial', 'b', 9);
        $this->Cell(0, 6, $hdu_subtitle, 0, 1, 'C');
        $this->SetFont('Arial', 'b', 9);
        $this->Cell(10, 6, HDU_216, 0, 0, "R");
        $this->Cell(25, 6, "Posted by", 0, 0);
        $this->Cell(22, 6, "Posted on", 0, 0);
        $this->Cell(30, 6, HDU_218, 0, 0);
        $this->Cell(30, 6, HDU_221, 0, 0);
        $this->Cell(22, 6, "Closed on", 0, 0);
        $this->Cell(20, 6, "Fix Cost", 0, 0, "R");
        $this->Cell(20, 6, "Time Cost", 0, 0, "R");
        $this->Cell(20, 6, "Travel", 0, 0, "R");
        $this->Cell(20, 6, "Callout", 0, 0, "R");
        $this->Cell(20, 6, "Materials", 0, 0, "R");
        $this->Cell(20, 6, "Total", 0, 1, "R");
        $this->Ln(5);
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
// ####################### get the data ############################
$hdu_conv = new convert;
$hdu_now = $hdu_conv->convert_date(time());
$hdu_siteurl = SITEURL . "index.php";

$hdu_udb = new DB;

switch ($_GET['hdu_rep'])
{
    case "1":
        // All open tickets
        $hdu_dbarg = "hdu_closed = '0' order by hdu_id desc";
        $hdu_title = HDU_129;
        break;
    case "2":
        // All closed tickets
        $hdu_dbarg = "hdu_closed > '0' order by hdu_id desc";
        $hdu_title = HDU_130;
        break;
    case "3":
        // All unassigned tickets
        $hdu_dbarg = "hdu_allocated = '0' order by hdu_id desc";
        $hdu_title = HDU_131;
        break;
    case "4":
        // All  tickets
        $hdu_dbarg = "hdu_id > '0' order by hdu_id desc";
        $hdu_title = HDU_132;
        break;
}
// Create the pdf documet
$hdu_pdf = new HDU_PDF("l", "mm", $_GET['hdu_pagesize']);

$hdu_pdf->SetCompression(true);
// #### DO NOT CHANGE THIS
$hdu_pdf->SetCreator("Created by Barrys e107 Helpdesk plugin from www.keal.me.uk");
// ####
$hdu_pdf->SetTitle("Helpdesk Report");
$hdu_pdf->SetKeywords("Help");
$hdu_pdf->SetSubject(SITENAME . " Helpdesk Report");
$hdu_pdf->SetAuthor(SITENAME);
$hdu_pdf->AliasNbPages();
$hdu_pdf->AddPage();

$hdu_udb->db_Select("hdunit", "*", $hdu_dbarg);
$hdu_avg = 0;
$hdu_count = 0;
while ($hdu_row = $hdu_udb->db_Fetch())
{
    extract($hdu_row);
    $hdu_pdf->SetFont('Times', '', 8);
    $hdu_pdf->Cell(10, 5, "$hdu_id", 0, 0, "R");
    $hdu_p = explode(".", $hdu_poster);
    $hdu_postername = $hdu_p[1];
    $hdu_pdf->Cell(25, 5, ucfirst($hdu_postername), 0, 0);
    $hdu_pdf->Cell(22, 5, $hdu_conv->convert_date($hdu_datestamp, "short"), 0, 0);
    $hdu_pdf->Cell(30, 5, $helpdesk_obj->hdu_getcat($hdu_category), 0, 0);

    $hdu_pdf->Cell(30, 5, $helpdesk_obj->hdu_getstat($hdu_resolution), 0, 0);
    if ($hdu_closed > 0)
    {
        $hdu_pdf->Cell(22, 5, $hdu_conv->convert_date($hdu_closed, "short"), 0, 0);
    }
    else
    {
        $hdu_pdf->Cell(22, 5, "", 0, 0);
    }
    $hdu_pdf->Cell(20, 5, number_format($hdu_fixcost, 2), 0, 0, "R");
    $hdu_tot_fixcost = $hdu_tot_fixcost + $hdu_fixcost;
    $hdu_pdf->Cell(20, 5, number_format($hdu_hcost, 2), 0, 0, "R");
    $hdu_tot_hcost = $hdu_tot_hcost + $hdu_hcost;
    $hdu_pdf->Cell(20, 5, number_format($hdu_dcost, 2), 0, 0, "R");
    $hdu_tot_dcost = $hdu_tot_dcost + $hdu_dcost;
    $hdu_pdf->Cell(20, 5, number_format($hdu_callout, 2), 0, 0, "R");
    $hdu_tot_callout = $hdu_tot_callout + $hdu_callout;
    $hdu_pdf->Cell(20, 5, number_format($hdu_eqptcost, 2), 0, 0, "R");
    $hdu_tot_eqptcost = $hdu_tot_eqptcost + $hdu_eqptcost;
    $hdu_pdf->Cell(20, 5, number_format($hdu_totalcost, 2), 0, 1, "R");
    $hdu_tot_totalcost = $hdu_tot_totalcost + $hdu_totalcost;
}

$hdu_y = $hdu_pdf->GetY();
if ($hdu_y > 203)
{
    // If we are more than 203 mm down the page do a new page for the totals
    $hdu_pdf->AddPage();
    $hdu_y = $hdu_pdf->GetY();
}
$hdu_pdf->Line(159, $hdu_y, 268, $hdu_y);
$hdu_pdf->Cell(139, 5, "Totals", 0, 0, "R");
$hdu_pdf->Cell(20, 5, number_format($hdu_tot_fixcost, 2), 0, 0, "R");
$hdu_pdf->Cell(20, 5, number_format($hdu_tot_hcost, 2), 0, 0, "R");
$hdu_pdf->Cell(20, 5, number_format($hdu_tot_dcost, 2), 0, 0, "R");
$hdu_pdf->Cell(20, 5, number_format($hdu_tot_callout, 2), 0, 0, "R");
$hdu_pdf->Cell(20, 5, number_format($hdu_tot_eqptcost, 2), 0, 0, "R");
$hdu_pdf->Cell(20, 5, number_format($hdu_tot_totalcost, 2), 0, 1, "R");
$hdu_y = $hdu_pdf->GetY();
$hdu_pdf->Line(159, $hdu_y, 268, $hdu_y);
// ensure buffer is clean before generating output
// while (@ob_end_clean());
$hdu_pdf->Output("helpdesk.pdf", $_GET['hdu_dest']);

?>