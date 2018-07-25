<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
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
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
// check folder writable
$gold_fp=fopen($GOLD_PREF['gold_arcloc'].'/index.htm','w+');
if(!$gold_fp)
{
$gold_msg=GOLD_AT_018;

}
fclose($gold_fp);
// end check
if (isset($_POST['gold_acrhive']))
{
    $timestart = time();
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
        $gtrans_msg .= GOLD_TC_003;
    }
    // get the start of this month
    $month = $_POST['gold_msel'];
    $year = $_POST['gold_ysel'];
    // first day of this month
    $gold_start = mktime(0, 0, 0, $month, 1, $year);
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
    $gtrans_msg .= GOLD_TC_004 . $reportfor . "\n\n";
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
    $gold_sql2 = new DB;
    $gold_sql2->db_Select_gen($gold_arcarg, false);
    while ($gold_row = $gold_sql2->db_Fetch())
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
                $gold_credit = $gold_credit + ($row[4] > 0?$row[4]:0); // get credits
                $gold_debit = $gold_debit - ($row[4] < 0?$row[4]:0); // get debits
                $gold_sumtrans = $gold_sumtrans + $row[4];
            }

            $gold_pdf->FancyTable($captions, $data, $gold_sumtrans, $gold_credit, $gold_debit);

            $gold_pdf->Output($GOLD_PREF['gold_arcloc'] . '/' . $gold_getuserid . '_' . $padmonth . '_' . $ryear . '.pdf', 'F');
            if (!empty($gold_pdf->errmsg))
            {
                $gtrans_msg .= $gold_pdf->errmsg . "\n";
            }
            else
            {
                $gtrans_msg .= GOLD_TC_010 . $users_name . "\n";
                // delete history
                if (intval($_POST['gold_delafter'])==1)
                {
                   $nums= $sql->db_Delete('gold_system_history', 'gold_hist_user_id=' . $gold_getuserid . ' and gold_hist_date between ' . $gold_start . ' and ' . $gold_end,false);

                }
            }
        }
    }
    $execution = time() - $timestart;
    $gtrans_msg .= GOLD_TC_011 . "\n" . GOLD_TC_014 . " " . $execution . " " . GOLD_TC_015 . "\n";
    $gold_text = nl2br($gtrans_msg);
}
else
{
    $gold_msel = '<select name="gold_msel" class="tbox">
	<option value="1" >' . GOLD_AT_004 . '</option>
	<option value="2" >' . GOLD_AT_005 . '</option>
	<option value="3" >' . GOLD_AT_006 . '</option>
	<option value="4" >' . GOLD_AT_007 . '</option>
	<option value="5" >' . GOLD_AT_008 . '</option>
	<option value="6" >' . GOLD_AT_009 . '</option>
	<option value="7" >' . GOLD_AT_010 . '</option>
	<option value="8" >' . GOLD_AT_011 . '</option>
	<option value="9" >' . GOLD_AT_012 . '</option>
	<option value="10" >' . GOLD_AT_013 . '</option>
	<option value="11" >' . GOLD_AT_014 . '</option>
	<option value="12" >' . GOLD_AT_015 . '</option>
</select>
	';
    $gold_year = date('Y');
    $gold_ysel = '<select class="tbox" name="gold_ysel">
	<option value="2007" ' . ($gold_year == 2007?'selected="selected"':'') . '>2007</option>
	<option value="2008" ' . ($gold_year == 2008?'selected="selected"':'') . '>2008</option>
	<option value="2009" ' . ($gold_year == 2009?'selected="selected"':'') . '>2009</option>
	<option value="2010" ' . ($gold_year == 2010?'selected="selected"':'') . '>2010</option>
	<option value="2011" ' . ($gold_year == 2011?'selected="selected"':'') . '>2011</option>

	';
    $gold_text = '
<form method="post" action="' . e_SELF . '" id="dataform">
	<table class="fborder" style="' . ADMIN_WIDTH . '" >
		<tr>
			<td class="fcaption" colspan="2">' . GOLD_AT_001 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="2">' . $gold_msg . '&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader3" style="width:30%" >' . GOLD_AT_002 . '</td>
			<td class="forumheader3" >' . $gold_msel . '</td>
		</tr>
		<tr>
			<td class="forumheader3" style="width:30%" >' . GOLD_AT_003 . '</td>
			<td class="forumheader3" >' . $gold_ysel . '</td>
		</tr>
		<tr>
			<td class="forumheader3" style="width:30%" >' . GOLD_AT_017 . '</td>
			<td class="forumheader3" ><input type="checkbox" class="tbox" name="gold_delafter" value="1" /></td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="2"><input type="submit" class="button" name="gold_acrhive" value="' . GOLD_AT_016 . '" /></td>
		</tr>
				<tr>
			<td class="fcaption" colspan="2">&nbsp;
			</td>
		</tr>
	</table>
</form>';
}

$ns->tablerender(ADLAN_GS, $gold_text);
require_once(e_ADMIN . 'footer.php');

?>