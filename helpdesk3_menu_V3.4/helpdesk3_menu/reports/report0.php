<?php
// *report*General*
// Create a new class extending fpdf to have custom header and footer for the page
class HDU_PDF extends UFPDF
{
    // Page header
    function Header()
    {

        global $hdu_now, $hdu_title, $hdu_siteurl, $hdu_subtitle;
        // Logo
        if (file_exists(e_PLUGIN . "helpdesk3_menu/images/logo_hd.png"))
        {
            $this->Image(e_PLUGIN . "helpdesk3_menu/images/logo_hd.png", 10, 8, 33, '', '', $hdu_siteurl);
        }
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        #$this->Cell(80);
        // Title
        $this->Cell(0, 10, HDU_REPORTTITLE, 0, 1, 'C');
        # $this->Ln(10);
        #$this->Cell(80);
        // Line break
        $this->Line(0, 33, 300, 33);
        $this->SetFont('Arial', 'bu', 9);
        $hdu_tit = $hdu_title . " " . HDU_121 . " " . $hdu_now;
        $this->Cell(0, 6, $hdu_tit, 0, 1,'C');
        $this->SetFont('Arial', 'b', 9);
        $this->Cell(0, 6, $hdu_subtitle, 0, 1,'C');
        $this->SetFont('Arial', 'b', 9);
        $this->Cell(10, 6, HDU_216, 0, 0, "R");
        $this->Cell(27, 6, HDU_217, 0, 0);
        $this->Cell(35, 6, HDU_227, 0, 0);
        $this->Cell(35, 6, HDU_218, 0, 0);
        $this->Cell(20, 6, HDU_219, 0, 0);
        $this->Cell(15, 6, HDU_220, 0, 0);
        $this->Cell(30, 6, HDU_221, 0, 0);
        $this->Cell(30, 6, HDU_222, 0, 0);
        $this->Cell(22, 6, HDU_223, 0, 0);
        $this->Cell(22, 6, HDU_224, 0, 0);
        $this->Cell(22, 6, HDU_225, 0, 0);
        $this->Cell(15, 6, HDU_226, 0, 1, "R");
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
$hdu_from = $helpdesk_obj->hdu_indate($_GET['hdu_fromd']);
$hdu_to = $helpdesk_obj->hdu_indate($_GET['hdu_tod']);
$hdu_subtitle = HDU_215;
if ($hdu_from > 0 && $hdu_to > 0)
{
    // Make date from
    $hdu_dbarg = "hdu_datestamp >'$hdu_from' and hdu_datestamp < '$hdu_to' and " . $hdu_dbarg;
    $hdu_subtitle = "posted between " . date("d F Y", $hdu_from) . " and " . date("d F Y", $hdu_to);
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

$hdu_udb->db_Select_gen("select * from #hdunit
left join #hdu_categories on hducat_id=hdu_category
left join #hdu_helpdesk on hdudesk_id=hdu_tech", $hdu_dbarg);
$hdu_avg = 0;
$hdu_count = 0;
while ($hdu_row = $hdu_udb->db_Fetch())
{
    extract($hdu_row);
    $hdu_pdf->SetFont('Times', '', 8);
    $hdu_pdf->Cell(10, 6, "$hdu_id", 0, 0, "R");
    $hdu_p = explode(".", $hdu_poster,2);
    $hdu_postername = $hdu_p[1];
    $hdu_pdf->Cell(27, 6, $tp->toFORM(ucfirst($hdu_postername)), 0, 0);
    $hdu_pdf->Cell(35, 6, $tp->toFORM($hdu_summary), 0, 0);
    $hdu_pdf->Cell(35, 6, $tp->toFORM($hducat_category), 0, 0);

    $hdu_pdf->Cell(20, 6, $tp->toFORM($hdu_tagno), 0, 0);
    $hdu_pdf->Cell(15, 6, "$hdu_priority", 0, 0);
    $hdu_pdf->Cell(30, 6, $tp->toFORM($helpdesk_obj->hdu_getstat($hdu_resolution)), 0, 0);
    $hdu_pdf->Cell(30, 6, $tp->toFORM($hdudesk_name), 0, 0);

    if ($hdu_allocated > 0)
    {
        $hdu_pdf->Cell(22, 6, $hdu_conv->convert_date($hdu_allocated, "short"), 0, 0);
    }
    else
    {
        $hdu_pdf->Cell(22, 6, "", 0, 0);
    }
    $hdu_pdf->Cell(22, 6, $hdu_conv->convert_date($hdu_datestamp, "short"), 0, 0);
    if ($hdu_closed > 0)
    {
        $hdu_pdf->Cell(22, 6, $hdu_conv->convert_date($hdu_closed, "short"), 0, 0);
    }
    else
    {
        $hdu_pdf->Cell(22, 6, "", 0, 0);
    }
    if ($hdu_closed > 0)
    {
        $hdu_duration = ($hdu_closed - $hdu_datestamp) / (3600 * 24);
        $hdu_avg = $hdu_avg + $hdu_duration;
        $hdu_count ++;
    }
    else
    {
        $hdu_duration = 0;
    }
    if ($hdu_duration > 0)
    {
        $hdu_pdf->Cell(15, 6, number_format($hdu_duration, 2), 0, 1, "R");
    }
    else
    {
        $hdu_pdf->Cell(15, 6, "", 0, 1);
    }
}

if ($hdu_count > 0)
{
    $hdu_y = $hdu_pdf->GetY();
    $hdu_pdf->Line(280, $hdu_y, 293, $hdu_y);
    $hdu_avgdur = $hdu_avg / $hdu_count;
    $hdu_pdf->Cell(263, 6, HDU_135, 0, 0, "R");
    $hdu_pdf->Cell(20, 6, number_format($hdu_avgdur, 2), 0, 1, "R");
}
// ensure buffer is clean before generating output
#while (@ob_end_clean());
$hdu_pdf->Output("helpdesk.pdf", $_GET['hdu_dest']);

?>