<?php
// Define the location of font files and get the fpdf library
require_once("../../class2.php");
define('FPDF_FONTPATH', e_PLUGIN . 'pdf/font/');
require(e_PLUGIN . 'pdf/ufpdf.php');

if (!is_object($helpdesk_obj))
{
    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
    $helpdesk_obj = new helpdesk;
}

// Create a new class extending fpdf to have custom header and footer for the page
class HDUPDF extends UFPDF
{
    // Page header
    function Header()
    {
        global $pd_title, $pdir_selection, $pdir_siteurl;
        // Logo
        if (file_exists("./images/logo_hd.png"))
        {
            $this->Image('./images/logo_hd.png', 10, 8, 33, '', '', $pdir_siteurl);
        }
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(70, 10, HDU_66, 1, 1, 'C');
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
// ####################### get all the data ############################
if (isset($_GET['hdu_id']))
{
    // print "bert";
    pdfit($_GET['hdu_id'], $_GET['hdu_dest'], "Helpdesk" . $_GET['hdu_id'] . ".pdf", "", $_GET['hdu_pagesize']);
}

function pdfit($hdu_pdf_id = 0, $hdu_pdf_dest = "f", $hdu_pdf_name = "Helpdesk.pdf", $hdu_pdf_fname, $hdu_pdf_size = "A4")
{
    // Parameters $hdu_pref_id the record to display
    // $hdu_pdf_dest destination f - file v - view in browser s- save in browser
    // $hdu_pdf_name name of pdf
    // $hdu_pdf_fname filename
    // $hdu_pdf_size - paper size
    if ($hdu_pdf_id == 0)
    {
        // If it is not a valid id then return
        return;
    }

    global $helpdesk_obj, $sql, $hdu_assto,$tp;
    // Create objects
    $hdu_conv = new convert;
    $hdushow = new DB;
    $hdu_udb = new DB;
    // Get the ticket record
    // get the helpdesk it is assigned to
    $arg = "select * from #hdunit left join #hdu_helpdesk on hdudesk_id=hdu_tech where hdu_id={$hdu_pdf_id}";
    $hdu_res = $hdushow->db_Select_gen($arg,false);
    #die("W");
    $hdurow = $hdushow->db_Fetch();
    extract($hdurow);


if (empty($hdudesk_name) )
{
    $hdu_assto = HDU_41;
}
else
{
$hdu_assto = $tp->toHTML($hdudesk_name);
}

    $hduposterdet = explode(".", $hdu_poster);
    $hduposterid = $hduposterdet[0];
    $hdupostername = $hduposterdet[1];

    $hdutechname = $hdu_assto;
    // See if poster allows email address to be shown
    if ($hdu_udb->db_Select("user", "*", "user_id='$hduposterid'"))
    {
        $hdu_urow = $hdu_udb->db_Fetch();
        extract($hdu_urow);
    }
    // If the user is the poster then show the email address anyway
    if (USERID == $hduposterid)
    {
        $user_hideemail = 1;
    }
    // $hdu_tdbg = $hdu_priority_array[($hdu_priority-1)];
    // $hdu_status = $hdu_resolution_array[$hdu_resolution];
    // If it is the poster then
    if (USERID == $hduposterid && $hdu_return == 1 && $hdu_closed == 0)
    {
        $hdu_text .= "<tr>
		<td colspan='2' class='forumheader3'>" . HDU_90 . "</td>
		</tr>";
    }
    // Create the pdf documet
    $hdu_pdf = new HDUPDF("p", "mm", $hdu_pdf_size);

    $hdu_pdf->SetCompression(true);
    // #### DO NOT CHANGE THIS
    $hdu_pdf->SetCreator("Created by Father Barrys e107 Helpdesk plugin from www.keal.me.uk");
    // ####
    $hdu_pdf->SetTitle("Helpdesk Ticket");
    $hdu_pdf->SetKeywords("Help");
    $hdu_pdf->SetSubject(SITENAME . " Helpdesk");
    $hdu_pdf->SetAuthor(SITENAME);
    $hdu_pdf->AliasNbPages();
    $hdu_pdf->AddPage();
    $hdu_pdf->SetFont('Times', 'bu', 14);
    $hdu_tit = HDU_120 . " " . $hdu_pdf_id;
    $hdu_pdf->Cell(40, 6, $hdu_tit, 0, 1);
    $hdu_pdf->SetFont('Times', 'b', 12);
    $hdu_tit = HDU_121 . $hdu_conv->convert_date(time());
    $hdu_pdf->Cell(40, 6, $hdu_tit, 0, 1);
    $hdu_pdf->SetFont('Times', '', 10);
    $hdu_pdf->Cell(40, 6, HDU_3, 0, 0);
    $hdu_pdf->MultiCell(140, 6, $hdupostername, 0, 1);
    $hdu_pdf->Cell(40, 6, HDU_36, 0, 0);
    $hdu_pdf->Cell(40, 6, $hdu_conv->convert_date($hdu_datestamp), 0, 1);
    $hdu_pdf->Cell(40, 6, HDU_6, 0, 0);
    switch ($hdu_priority)
    {
        case 1:
            $hdu_pdf->MultiCell(140, 6, HDU_137, 0, 1);
            break; ;
        case 2:
            $hdu_pdf->MultiCell(140, 6, HDU_138, 0, 1);
            break; ;
        case 3:
            $hdu_pdf->MultiCell(140, 6, HDU_139, 0, 1);
            break; ;
        case 4:
            $hdu_pdf->MultiCell(140, 6, HDU_140, 0, 1);
            break; ;
        case 5:
            $hdu_pdf->MultiCell(140, 6, HDU_141, 0, 1);
            break; ;
    } // switch
    $hdu_pdf->Cell(40, 6, HDU_31, 0, 0);
    $hdu_pdf->MultiCell(140, 6, $hdu_summary, 0, 1);
    $hdu_pdf->Cell(40, 6, HDU_10, 0, 0);
    if ($sql->db_Select("hdu_categories", "*", "hducat_id = '$hdu_category'"))
    {
        $hdu_pdf_row = $sql->db_Fetch();
        extract($hdu_pdf_row);
    }
    else
    {
        $hducat_category = HDU_70;
    }

    $hdu_pdf->MultiCell(0, 6, $hducat_category, 0, 1);
    if ($hduprefs_showassettag == 1 && !empty($hdu_tagno))
    {
        $hdu_pdf->Cell(40, 6, HDU_39, 0, 0);
        $hdu_pdf->Cell(40, 6, $hdu_tagno, 0, 1);
    }
    $hdu_pdf->Cell(40, 6, HDU_12, 0, 0);
    $hdu_pdf->MultiCell(140, 6, $hdu_description, 0, 1);
    if ($user_hideemail == 1)
    {
        $hdu_pdf->Cell(40, 6, HDU_28, 0, 0);
        $hdu_pdf->Cell(40, 6, HDU_81, 0, 1);
    }
    else
    {
        $hdu_pdf->Cell(40, 6, HDU_28, 0, 0);
        $hdu_pdf->Cell(40, 6, $hdu_email, 0, 1);
    }
    if ($hdu_allocated == 0)
    {
        $hdu_pdf->Cell(40, 6, HDU_26, 0, 0);
        $hdu_pdf->Cell(40, 6, HDU_41, 0, 1);
    }
    else
    {
        $hdu_pdf->Cell(40, 6, HDU_26, 0, 0);
        $hdu_pdf->Cell(40, 6, $hdu_conv->convert_date($hdu_allocated), 0, 1);
        $hdu_pdf->Cell(40, 6, HDU_25, 0, 0);
        $hdu_pdf->Cell(40, 6, $hdutechname, 0, 1);
    }
    $hdu_pdf->Cell(40, 6, HDU_4, 0, 0);

    if ($sql->db_Select("hdu_resolve", "*", "hdures_id = '$hdu_resolution'"))
    {
        $hdu_pdf_row = $sql->db_Fetch();
        extract($hdu_pdf_row);
    }
    else
    {
        $hdures_resolution = HDU_70;
    }
    $hdu_pdf->MultiCell(140, 6, $hdures_resolution, 0, 1);

    if ($hdu_closed == 0)
    {
        $hdu_pdf->Cell(40, 6, HDU_37, 0, 0);
        $hdu_pdf->Cell(40, 6, HDU_38, 0, 1);
    }
    else
    {
        $hdu_pdf->Cell(40, 6, HDU_37, 0, 0);
        $hdu_pdf->Cell(40, 6, $hdu_conv->convert_date($hdu_closed), 0, 1);
    }
    $hdu_pdf->Cell(40, 6, HDU_91, 0, 0);
    $hdu_pdf->Cell(40, 6, $hdu_conv->convert_date($hdu_lastchanged), 0, 1);

    if ($hduprefs_showfixes == 1)
    {
        if ($hdu_fix > 0)
        {
            if ($sql->db_Select("hdu_fixes", "*", "hdufix_id = '$hdu_fix'"))
            {
                $hdu_pdf_row = $sql->db_Fetch();
                extract($hdu_pdf_row);
            }
            else
            {
                $hdufix_fix = HDU_70;
            }
            $hdu_pdf->Cell(40, 6, HDU_162, 0, 0);
            $hdu_pdf->MultiCell(140, 6, $hdufix_fix, 0, 1);
        }
        if (!empty($hdu_fixother))
        {
            $hdu_pdf->Cell(40, 6, HDU_162, 0, 0);
            $hdu_pdf->MultiCell(140, 6, $hdu_fixother, 0, 1);
        }
    }
    // Check if we show financial info and to users too
    if ($helpdesk_obj->hduprefs_showfinance)
    {
        if ($helpdesk_obj->hduprefs_showfinance || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)
        {
            $hdu_pdf_x = $hdu_pdf->GetX();
            $hdu_pdf_y = $hdu_pdf->GetY();

            $hdu_pdf->SetFont('Times', 'b', 12);
            $hdu_pdf->Cell(60, 6, HDU_168, 0, 1);
            $hdu_pdf->SetFont('Times', '', 10);
            $hdu_pdf->Cell(60, 6, HDU_165, 0, 0, "R");
            $hdu_pdf->Cell(20, 6, HDU_166, 0, 0, "R");
            $hdu_pdf->Cell(20, 6, HDU_167, 0, 1, "R");
            $hdu_pdf->Cell(40, 6, HDU_163, 0, 0);
            $hdu_pdf->Cell(60, 6, $hdu_fixcost, 0, 1, "R");
            $hdu_pdf->Cell(40, 6, HDU_145, 0, 0);
            $hdu_pdf->Cell(20, 6, $hdu_hours, 0, 0, "R");
            $hdu_pdf->Cell(20, 6, $hdu_hrate, 0, 0, "R");

            $hdu_pdf->Cell(20, 6, $hdu_hcost, 0, 1, "R");
            $hdu_pdf->Cell(40, 6, HDU_148, 0, 0);
            $hdu_pdf->Cell(20, 6, $hdu_distance, 0, 0, "R");
            $hdu_pdf->Cell(20, 6, $hdu_drate, 0, 0, "R");
            $hdu_pdf->Cell(20, 6, $hdu_dcost, 0, 1, "R");
            $hdu_pdf->Cell(40, 6, HDU_164, 0, 0);
            $hdu_pdf->Cell(60, 6, $hdu_eqptcost, 0, 1, "R");
            $hdu_pdf->Cell(40, 6, HDU_151, 0, 0);
            $hdu_pdf->Cell(40, 6, " ", 0, 0);
            $hdu_pdf->Cell(20, 6, $hdu_callout, "B", 1, "R");
            $hdu_pdf->Cell(40, 6, HDU_152, 0, 0);
            $hdu_pdf->Cell(40, 6, " ", 0, 0);
            $hdu_pdf->Cell(20, 6, $hdu_totalcost, "B", 0, "R");

            $hdu_pdf->rect($hdu_pdf_x, $hdu_pdf_y, 6 + $hdu_pdf->GetX() - $hdu_pdf_x, 6 + $hdu_pdf->GetY() - $hdu_pdf_y, "D");
            // $hdu_pdf->Cell(20, 6, " ", 0, 1);
            $hdu_pdf->Ln();
        }
    }
    // ######################################## Comments #######################################
    $hducomdb = new DB;
    // Get the poster id
    $hducomdb->db_Select("hdunit", "hdu_poster,hdu_closed", "hdu_id='$hdu_pdf_id'");
    $hduc_owner = $hducomdb->db_Fetch();
    extract($hduc_owner);
    $hduc_creat = explode(".", $hdu_poster);
    $hduc_creatorid = $hduc_creat[0];
    $hduc_closed = $hdu_closed;

    if ($helpdesk_obj->hduprefs_allread || $helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || (USERID == $hduc_creatorid))
    {
        if ($hducomdb->db_Select("hdu_comments", "*", "hduc_ticketid='$hdu_pdf_id' order by hduc_date desc"))
        {
            $hdu_pdf->AddPage("P");

            $hdu_pdf->SetFont('Times', 'bu', 14);
            $hdu_pdf->Cell(40, 6, HDU_122, 0, 1);
            $hdu_pdf->SetFont('Times', '', 10);
            $hdu_pdf->Cell(40, 6, HDU_98, 0, 0);
            $hdu_pdf->Cell(40, 6, HDU_99, 0, 0);
            $hdu_pdf->Cell(40, 6, HDU_100, 0, 1);

            while ($hducrow = $hducomdb->db_Fetch())
            {
                extract($hducrow);
                $hduc_poster = explode(".", $hduc_poster);
                $hduc_posterid = $hduc_poster[0];
                $hduc_postername = $hduc_poster[1];
                $hdu_pdf->Cell(40, 6, $hdu_conv->convert_date($hduc_date, "short"), 0, 0);
                $hdu_pdf->Cell(40, 6, $hduc_postername, 0, 0);
                $hdu_pdf->MultiCell(100, 6, $hduc_comment, 0, 1);
            }
        }
        else
        {
            $hdu_pdf->SetFont('Times', '', 10);
            $hdu_pdf->Cell(40, 6, HDU_169, 0, 1);
        }
    }

    if ($hdu_pdf_dest == 'f')
    {
        // ensure buffer is clean before generating output
        // while (@ob_end_clean());
        $hdu_pdf->Output($hdu_pdf_fname, $hdu_pdf_dest);
    }
    else
    {
        // ensure buffer is clean before generating output
        // while (@ob_end_clean());
        $hdu_pdf->Output($hdu_pdf_name, $hdu_pdf_dest);
    }
} // End function

?>
