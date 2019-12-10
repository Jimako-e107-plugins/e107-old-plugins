<?php
// ***************************************************************
// *
// * 	Uses fpdf library for PHP.  A fabulous utility for creating
// *     pdf documents without having to have the pdf libraries
// *		installed on the server.  visit www.fpdf.org for details
// *
// ***************************************************************
// Location of font files and get the fpdf library
define('FPDF_FONTPATH', '../pdf/font/');
require_once("../../class2.php");
require(e_PLUGIN . "pdf/fpdf.php");
require(e_PLUGIN . "pdf/ufpdf.php");
require(e_PLUGIN . 'pdf/e107pdf.php');

include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");

$cwriter_pdfbookid = e_QUERY;

if (class_exists("e107PDF"))
{
    class PDF extends e107PDF
    {
        // table of contents script from http://www.fpdf.org/en/script/script73.php
        // Author: Richard Bondi
        // License: Freeware
        var $_toc = array();
        var $_numbering = false;
        var $_numberingFooter = false;
        var $_numPageNum = 1;
        var $chap;
        var $pagewidth;
        // Page header

        function Header()
        {
            if ($this->page > 1)
            {
                // Logo
                // if (file_exists(e_PLUGIN . "creative_writer/images/cwriter_32.png"))
                // {
                // $this->Image(e_PLUGIN . "creative_writer/images/cwriter_32.png", 10, 8, 32, 32);
                // }
                // Line break
                $this->Cell(0, 3, $this->chap, 0, 0);
                $this->SetLineWidth(0.2);
                $this->Line(0, 18, 300, 18);
                $this->Ln();
                $this->Ln();
            }
        }
        function ShowTitle($y, $cwriter_title, $cwriter_author)
        {
            $cwriter_temp = explode(".", $cwriter_author, 2);
            // helvetica bold 15
            // Title;
            $this->pagewidth = $this->w - $this->lMargin - $this->rMargin;
            $y = $this->tMargin + $y;
            $this->SetLineWidth(0.4);
            $this->SetFillColor(215, 215, 255);
            $this->SetDrawColor(0, 0, 255);
            $this->SetFont('helvetica', '', 12);
            $strt = $this->GetStringWidth($cwriter_title);
            $this->SetFont('helvetica', '', 8);
            $strn = $this->GetStringWidth("By " . $cwriter_temp[1]);
            $printarea = $this->pagewidth;


            $maxwidth = max($strt, $strn);
            $centre = $printarea / 2;
            $boxleft = $centre - ($maxwidth / 2);
            $boxwidth = $maxwidth + 20;
            $this->RoundedRect($boxleft, $y, $boxwidth, 14, 3.5, 'DF');
            $this->SetXY(0, $y + 2);
            $this->SetFont('helvetica', '', 12);
            $this->Cell(200, 5, $cwriter_title, 0, 2, 'C');
            $this->SetFont('helvetica', '', 8);
            // $this->SetXY($left-20,$y+6);
            $this->Cell(200, 5, "By " . $cwriter_temp[1], 0, 0, 'C');

            $this->SetLineWidth(0.2);
        }
        function cover_page($cwriter_details)
        {
        $this->pagewidth = $this->w - $this->lMargin - $this->rMargin;
            $this->chap = "";
            $this->AddPage();
            $this->SetXY(0, 10);
            $this->Cell(200, 5, CWRITER_P02, 0, 1, "C");
            if (!empty($cwriter_details['cw_book_logo']) && file_exists(e_PLUGIN . "creative_writer/pictures/" . $cwriter_details['cw_book_logo']))
            {
                $imgsz = getimagesize(e_PLUGIN . "creative_writer/pictures/" . $cwriter_details['cw_book_logo']);
                $cwriter_left = ($this->pagewidth/2) - ($imgsz[0]*.264 / 2);
                $this->Image(e_PLUGIN . "creative_writer/pictures/" . $cwriter_details['cw_book_logo'], $cwriter_left, 20);
            }
            $this->ShowTitle(90, $cwriter_details['cw_book_title'], $cwriter_details['cw_book_author']);
        }
        function fly_sheet($cwriter_details)
        {
            global $cwriter_conv, $tp, $PLUGINS_DIRECTORY;
            $this->SetXY(0, 20);
            $this->chap = "";
            $this->AddPage();
            $this->SetFont("helvetica", "B", 14);
            $this->Cell(200, 4, CWRITER_P04, 0, 1, "C");
            $this->Ln();
            // Author Biography
            /*
            if (!empty($cwriter_details['cw_bio_biography']))
            {
                $this->SetFont("helvetica", "IB", 10);
                $this->Cell(50, 4, CWRITER_P05, 0, 1);
                $this->SetFont("helvetica", "", 8);
                if (!empty($cwriter_details['cw_bio_picture']) && file_exists(e_PLUGIN . "creative_writer/biopics/" . $cwriter_details['cw_bio_picture']))
                {
                    $this->Image(e_PLUGIN . "creative_writer/biopics/" . $cwriter_details['cw_bio_picture'], $this->lMargin + 5, $this->tMargin + 20, 0, 15);
                    $this->SetY($this->tMargin + 35);
                }
                else
                {
                    $this->SetY($this->tMargin + 20);
                }
                $this->Ln();
                if (!empty($cwriter_details['cw_bio_name']))
                {
                    $this->Cell(50, 4, $cwriter_details['cw_bio_name'], 0, 1);
                    $this->Ln();
                }
                $this->SetFont("helvetica", "UB", 8);
                $this->Cell(50, 4, CWRITER_P06, 0, 1);
                $this->SetFont("helvetica", "", 8);
                $this->WriteHTML($tp->toHTML($cwriter_details['cw_bio_biography'], true));
                $this->Ln();
                $this->Ln();
                if (!empty($cwriter_details['cw_bio_name']))
                {
                    $this->SetFont("helvetica", "UB", 8);
                    $this->Cell(50, 4, CWRITER_P07, 0, 1);
                    $this->SetFont("helvetica", "", 8);
                    $this->Cell(50, 4, $cwriter_details['cw_bio_contact'], 0, 1);
                    $this->Ln();
                }
                if (!empty($cwriter_details['cw_bio_email']))
                {
                    $this->SetFont("helvetica", "UB", 8);
                    $this->Cell(50, 4, CWRITER_P08, 0, 1);
                    $this->SetFont("helvetica", "", 8);
                    $this->Cell(50, 4, $cwriter_details['cw_bio_email'], 0, 1);
                    $this->Ln();
                }
            }
            */
            $this->SetFont("helvetica", "IB", 10);
            $this->Cell(50, 4, CWRITER_P09, 0, 1);
            $this->Ln();
            if (!empty($cwriter_details['cw_book_summary']))
            {
                $this->SetFont("helvetica", "UB", 8);
                $this->Cell(50, 4, CWRITER_P10, 0, 1);
                $this->SetFont("helvetica", "", 8);
                $this->Cell(50, 4, $cwriter_details['cw_book_summary'], 0, 1);
                $this->Ln();
            }
            if (!empty($cwriter_details['cw_book_disclaimer']))
            {
                $this->SetFont("helvetica", "UB", 8);
                $this->Cell(50, 4, CWRITER_P11, 0, 1);
                $this->SetFont("helvetica", "", 8);
                $this->WriteHTML($tp->toHTML($cwriter_details['cw_book_disclaimer'], true));
                $this->Ln();
                $this->Ln();
            }
            if (!empty($cwriter_details['cw_book_warnings']))
            {
                $this->SetFont("helvetica", "UB", 8);
                $this->Cell(50, 4, CWRITER_P12, 0, 1);
                $this->SetFont("helvetica", "", 8);
                $this->WriteHTML($tp->toHTML($cwriter_details['cw_book_warnings'], true));
                $this->Ln();
            }
            $this->Ln();
            $this->Cell(50, 4, $cw_book_complete, 0, 1);
            // Book statistics
            $this->SetFont("helvetica", "IB", 10);
            $this->Cell(50, 4, CWRITER_P13, 0, 1);
            $this->SetFont("helvetica", "", 8);
            $this->Ln();
            $cwriter_aboutcat = CWRITER_P14 . " " . $cwriter_details['cw_category_name'] . " " . CWRITER_P15 . " " . $cwriter_details['cw_genre_name'] . " " . CWRITER_P16;
            $this->Cell(50, 4, $cwriter_aboutcat, 0, 1);

            $this->Cell(50, 4, CWRITER_P17 . " " . $cwriter_conv->convert_date($cwriter_details['cw_book_created']), 0, 1);
            $this->Cell(50, 4, CWRITER_P18 . " " . $cwriter_conv->convert_date($cwriter_details['cw_book_lastupdate']), 0, 1);
            $this->Cell(50, 4, CWRITER_P19 . " " . $cwriter_details['cw_book_chapters'] . " " . CWRITER_P20, 0, 1);
            $this->Cell(50, 4, CWRITER_P21 . " " . number_format($cwriter_details['cw_book_wordcount']) . " " . CWRITER_P22, 0, 1) ;
            
            $urlparam= array(
              'cw_book_id'			=> $cwriter_details['cw_book_id'],
              );
            $url = e107::url('creative_writer', 'book', $urlparam);
    
            //$cwriter_tosite = CWRITER_P23 . " <a href=\"" . SITEURL . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php?0.precis." . $cwriter_details['cw_book_id'] . "\" >" . CWRITER_P24 . ".</a><br />";
            $cwriter_tosite = CWRITER_P23 . " <a href=\"" . $url . "\" >" . CWRITER_P24 . ".</a><br />";
            $cwriter_tosite .= CWRITER_P25 . " <a href=\"" . SITEURL . $PLUGINS_DIRECTORY . "creative_writer/cwriter.php\" >" . SITENAME . "</a> " . CWRITER_P26;
            $this->WriteHTML($tp->toHTML($cwriter_tosite, false));
        }
        function AddPage($orientation = '')
        {
            parent::AddPage($orientation);
            if ($this->_numbering)
            {
                $this->_numPageNum++;
            }
        }

        function startPageNums()
        {
            $this->_numbering = true;
            $this->_numberingFooter = true;
        }

        function stopPageNums()
        {
            $this->_numbering = false;
        }

        function numPageNo()
        {
            return $this->_numPageNum;
        }

        function TOC_Entry($txt, $level = 0)
        {
            $this->_toc[] = array('t' => $txt, 'l' => $level, 'p' => $this->numPageNo());
        }

        function insertTOC($location = 1,
            $labelSize = 20,
            $entrySize = 10,
            $tocfont = 'Times',
            $label = CWRITER_P03
            )
        {
            // make toc at end
            $this->stopPageNums();
            $this->chap = "";
            $this->AddPage();
            $tocstart = $this->page;

            $this->SetFont($tocfont, 'B', $labelSize);
            $this->Cell(0, 5, $label, 0, 1, 'C');
            $this->Ln(10);
            // $this->SetTitle($label);
            foreach($this->_toc as $t)
            {
                // Offset
                $level = $t['l'];
                if ($level > 0)
                    $this->Cell($level * 8);
                $weight = '';
                if ($level == 0)
                    $weight = 'B';
                $str = $t['t'];
                $this->SetFont($tocfont, $weight, $entrySize);
                $strsize = $this->GetStringWidth($str);
                $this->Cell($strsize + 2, $this->FontSize + 2, $str);
                // Filling dots
                $this->SetFont($tocfont, '', $entrySize);
                $PageCellSize = $this->GetStringWidth($t['p']) + 2;
                $w = $this->w - $this->lMargin - $this->rMargin - $PageCellSize - ($level * 8) - ($strsize + 2);
                $nb = $w / $this->GetStringWidth('.');
                $dots = str_repeat('.', $nb);
                $this->Cell($w, $this->FontSize + 2, $dots, 0, 0, 'R');
                // Page number
                $this->Cell($PageCellSize, $this->FontSize + 2, " " . $t['p'], 0, 1, 'R');
            }
            // grab it and move to selected location
            $n = $this->page;
            $n_toc = $n - $tocstart + 1;
            $last = array();
            // store toc pages
            for($i = $tocstart;$i <= $n;$i++)
            $last[] = $this->pages[$i];
            // move pages
            for($i = $tocstart - 1;$i >= $location-1;$i--)
            $this->pages[$i + $n_toc] = $this->pages[$i];
            // Put toc pages at insert point
            for($i = 0;$i < $n_toc;$i++)
            $this->pages[$location + $i] = $last[$i];
        }

        function Footer()
        {
            if ($this->_numberingFooter == false || $this->page == 1)
                return;
            // Go to 1.5 cm from bottom
            $this->SetY(-15);
            // Select helvetica italic 8
            $this->SetFont('helvetica', 'I', 8);
            // $this->Cell(20, 7, "Creative Writer e_Book ", 0, 0, 'l');
            $this->Cell(0, 7, "" . $this->numPageNo(), 0, 0, 'C');
            // $this->Cell(20, 7, "Book name" . $this->numPageNo(), 0, 0, 'r');
            if ($this->_numbering == false)
                $this->_numberingFooter = false;
        }
        // rounded rectangle script from
        function RoundedRect($x, $y, $w, $h, $r, $style = '')
        {
            // Author: Maxime Delorme
            // License: Freeware
            $k = $this->k;
            $hp = $this->h;
            if ($style == 'F')
                $op = 'f';
            elseif ($style == 'FD' or $style == 'DF')
                $op = 'B';
            else
                $op = 'S';
            $MyArc = 4 / 3 * (sqrt(2) - 1);
            $this->_out(sprintf('%.2f %.2f m', ($x + $r) * $k, ($hp - $y) * $k));
            $xc = $x + $w - $r ;
            $yc = $y + $r;
            $this->_out(sprintf('%.2f %.2f l', $xc * $k, ($hp - $y) * $k));

            $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);
            $xc = $x + $w - $r ;
            $yc = $y + $h - $r;
            $this->_out(sprintf('%.2f %.2f l', ($x + $w) * $k, ($hp - $yc) * $k));
            $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);
            $xc = $x + $r ;
            $yc = $y + $h - $r;
            $this->_out(sprintf('%.2f %.2f l', $xc * $k, ($hp - ($y + $h)) * $k));
            $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);
            $xc = $x + $r ;
            $yc = $y + $r;
            $this->_out(sprintf('%.2f %.2f l', ($x) * $k, ($hp - $yc) * $k));
            $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
            $this->_out($op);
        }

        function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
        {
            // Author: Maxime Delorme
            // License: Freeware
            $h = $this->h;
            $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1 * $this->k, ($h - $y1) * $this->k,
                    $x2 * $this->k, ($h - $y2) * $this->k, $x3 * $this->k, ($h - $y3) * $this->k));
        }
    }
}
// ...
require_once(e_HANDLER . "date_handler.php");
$cwriter_conv = new convert;
$pdf = new PDF();
$pdfpref = $pdf->getPDFPrefs();
$pdf->SetMargins($pdfpref['pdf_margin_left'], $pdfpref['pdf_margin_top'], $pdfpref['pdf_margin_right']);
$pdf->SetCompression(true);
$pdf->SetCreator(CWRITER_P01);
$pdf->SetTitle(CWRITER_P02);
$pdf->SetKeywords(CWRITER_P02);
$pdf->SetSubject(SITENAME . CWRITER_P02);
$pdf->SetAuthor(SITENAME);
$pdf->AliasNbPages();
$pdf->SetFont($pdfpref['pdf_font_family'] , '', $pdfpref['pdf_font_size']);
// *
// * Generate the cover page
// *
$cwriter_arg = "
	select * from #cw_book
	left join #cw_category on cw_book_category = cw_category_id
	left join #cw_genre on cw_book_genre=cw_genre_id
	left join #cw_biography on substring_index(cw_book_author,'.',1) = cw_bio_id
	where cw_book_id={$cwriter_pdfbookid}";
$sql->db_Select_gen($cwriter_arg, false);

$cwriter_row = $sql->db_Fetch();
$pdf->cover_page($cwriter_row);
$pdf->fly_sheet($cwriter_row);
$pdf->TOC_Entry("Preface", 0);
// *
// * Generate the chapters
// *
$pdf->startPageNums();
$sql->db_Select("cw_chapters", "*", "where cw_chapter_book=$cwriter_pdfbookid order by cw_chapter_number", "nowhere", false);
while ($cwriter_row = $sql->db_Fetch())
{
    extract($cwriter_row);
    cwriter_chapter($cw_chapter_number, $cw_chapter_title, $cw_chapter_body);
}
$pdf->stopPageNums();
// Instert the table of contents
$pdf->insertTOC(2);

while (@ob_end_clean());
// can be i or d
$pdf->Output("book.pdf", "i");

function cwriter_chapter($cwriter_chapno, $cwriter_chap_tit, $cwriter_chapter_text)
{
    global $pdf, $tp;
    $pdf->chap = CWRITER_P27 . " " . $cwriter_chapno . " - " . $cwriter_chap_tit;
    $pdf->AddPage();
    $pdf->TOC_Entry($cwriter_chapno . " " . $cwriter_chap_tit, 0);
    $pdf->WriteHTML($tp->toHTML($cwriter_chapter_text, true));
}

?>