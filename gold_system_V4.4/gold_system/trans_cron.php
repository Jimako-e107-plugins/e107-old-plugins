<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
$timestart = time();
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
if (!empty($_SERVER['REMOTE_ADDR']))
{
    echo GOLD_TC_013;
    exit;
}
echo ini_get('max_execution_time') . " Max execution time\n";
if (!is_object($gold_obj))
{
    echo GOLD_TC_002;
    exit;
}
if ($GOLD_PREF['gold_arcpass'] != $argv[1])
{
    echo GOLD_TC_001 . " $argv[1] ";
    exit;
}
// get logo if exists
if (is_readable(THEME . "images/goldlogopdf.png"))
{
    define('PDFLOGO', THEME . "images/goldlogopdf.png");
} elseif (is_readable(e_PLUGIN . "gold_system/images/logopdf.png"))
{
    define('PDFLOGO', e_PLUGIN . "gold_system/images/goldlogopdf.png");
}
else
{
    echo GOLD_TC_003;
}
// get the start of this month
$month = date('n');
$year = date('Y');
// first day of this month
$gold_start = mktime(0, 0, 0, $month, 1, $year);
// go back a day to move us into last month
$gold_start = $gold_start-86400;
// get start of last month
$gold_start = mktime(0, 0, 0, date('n', $gold_start), 1, date('Y', $gold_start));
// month for report
$rmonth = date('n', $gold_start);
// year for report
$ryear = date('Y', $gold_start);
// get the last day of month
$lastday = date('t', $gold_start);
$gold_end = mktime(23, 59, 59, $rmonth, $lastday, $ryear);
// print date('d m Y H:i:s', $gold_start). ' ' . date('d m Y H:i:s', $gold_end) ;
require_once(e_PLUGIN . 'pdf/ufpdf.php');
// require_once(e_PLUGIN . 'pdf/e107pdf.php');
$repdate = time();
$reportfor = date('F Y', $gold_start);
echo GOLD_TC_004 . $reportfor . "\n\n";
class GOLDPDF extends UFPDF
{
    var $errmsg;
    function GOLDPDF($orientation = 'P', $unit = 'mm', $format = 'A4')
    {
        // $this->e107PDF($orientation, $unit, $format);
        UFPDF::UFPDF($orientation, $unit, $format);
        $this->errmsg = '';
    }

    function header()
    {
        global $w, $users_name, $repdate, $reportfor;
        $this->SetTextColor(0);

        if (defined('GSPDFLOGO'))
        {
            $this->Image(GSPDFLOGO, 11, 6, 50, 0);
        }
        $headtext = GOLD_TC_016 . $users_name . ' -- ' . GOLD_TC_017 . $reportfor . ".\n" . GOLD_TC_018 . date('d M Y H:i', $repdate);

        $this->SetFontSize(7);
        $this->Rect(10, 5, 190, 9);
        $this->SetXY(60, 6);
        $this->MultiCell(0, 3, $headtext, 0, 'R', false);
        $this->Ln();
        $this->Line(10, 16, 200, 16);
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        // Header
        $header = array('Date', 'Type', 'Amount', 'Comment');
        for($i = 0;$i < count($header);$i++)
        {
            $this->Cell($w[$i], 5, $header[$i], 1, 0, 'L', true);
        }
        $this->Ln();
    }
    function footer()
    {
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Line($x, $y, 200, $y);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function error($msg)
    {
        $this->errmsg = $msg;
    }
    function FancyTable($header, $data, $gold_sumtrans, $gold_credit = 0, $gold_debit = 0)
    {
        global $w;

        $this->SetLeftMargin(10);
        $this->SetAutoPageBreak(true, 20);
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFontSize(6);
        $fill = false;
        $cellheight = 4;
        foreach($data as $row)
        {
            $this->SetFontSize(6);
            $this->Cell($w[0], $cellheight, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], $cellheight, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], $cellheight, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->SetFontSize(5);
            $this->Cell($w[3], $cellheight, $row[3], 'LR', 0, 'L', $fill);
            $this->Ln();
            $x = $this->GetX();
            $y = $this->GetY();
            $fill = !$fill;
        }
        $this->Line($x, $y, 200, $y);
        $this->Ln();
        $this->SetFontSize(6);
        $this->Cell(28, 6, "Credit  : " . number_format($gold_credit), 0, 0, 'R', false);
        $this->Cell(27, 6, "Debit : " . number_format($gold_debit), 0, 0, 'R', false);
        $this->Cell(15, 6, "Total : " . number_format($gold_sumtrans), 0, 1, 'R', false);
    }
}
// caption widths for table
$w = array(28, 27, 15, 120);
// $captions = array('Date', 'Type', 'Amount', 'Comment');
$captions = array(GOLD_TC_005, GOLD_TC_006, GOLD_TC_007, GOLD_TC_008);
$gold_arcarg = 'select u.user_name,h.* from #gold_system as h left join #user as u on gold_id = user_id ';
$padmonth = str_pad($rmonth, 2, '0', STR_PAD_LEFT);
$sql->db_Select_gen($gold_arcarg, false);
while ($gold_row = $sql->db_Fetch())
{
    $users_name = $tp->toTEXT($gold_row['user_name']);

    $gold_getuserid = $gold_row['gold_id'];
    unset($gold_pdf);
    unset($data);
    unset($gold_credit);
    unset($gold_debit);
    unset($gold_sumtrans);
    $gold_pdf = new GOLDPDF;
    $gold_pdf->AliasNbPages();
    $gold_pdf->SetAuthor('Father Barry\'s Gold System');
    $gold_pdf->SetTitle(GOLD_TC_009);
    $gold_pdf->SetSubject(GOLD_TC_009);
    $gold_pdf->SetKeywords(GOLD_TC_009);

    $gold_pdf->SetFont('Arial', '', 7);
    $gold_pdf->SetAutoPageBreak(true);
    $gold_pdf->AddPage();

    $numberof = $gold_sql->db_Select('gold_system_history', '*', 'where gold_hist_user_id=' . $gold_getuserid . ' and gold_hist_date between ' . $gold_start . ' and ' . $gold_end . ' order by gold_hist_date asc', 'nowhere', false);
    if ($numberof)
    {
        // there are records so create a pdf
        while ($row = $gold_sql->db_Fetch())
        {
            $data[] = array(date('d M Y H:i', $row[2]), $row[3], $row[4], $row[6]);
            $gold_sumtrans = $gold_sumtrans + $row[4];
            $gold_credit = $gold_credit + ($row[4] > 0?$row[4]:0); // get credits
            $gold_debit = $gold_debit - ($row[4] < 0?$row[4]:0); // get debits
        }
        $gold_pdf->FancyTable($captions, $data, $gold_sumtrans,$gold_credit,$gold_debit);
        $gold_pdf->Output($GOLD_PREF['gold_arcloc'] . '/' . $gold_getuserid . '_' . $padmonth . '_' . $ryear . '.pdf', 'F');
        if (!empty($gold_pdf->errmsg))
        {
            echo $gold_pdf->errmsg . "\n";
        }
        else
        {
            echo GOLD_TC_010 . $users_name . "\n";
            // delete history
            // $sql->db_Delete('gold_system_history', 'gold_hist_user_id=' . $gold_getuserid . ' and gold_hist_date between ' . $gold_start . ' and ' . $gold_end);
        }
    }
}
$execution = time() - $timestart;
echo GOLD_TC_011 . "\n" . GOLD_TC_014 . " " . $execution . " " . GOLD_TC_015 . "\n";

?>