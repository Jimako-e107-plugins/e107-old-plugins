<?php
// ***************************************************************
// *
// *		Title		:	Helpdesk Ticketing
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	10 November 2003
// *
// *		Version		:	3.01
// *
// *		Description	: 	helpdesk ticketing system
// *
// *		Revisions	:	10 December 2003 Prefix all variables by hdu
// *					:	10 Dec 2003 Check user in permitted class
// *					:	23 Dec 2003 Added update for field for posterid added restict pref
// *					:				Changed field type for resolution.
// *					:	12 Jan 2004 Added back button to top of form
// *					:	13 Jan 2004 Added extra error checking
// *					:	08 Feb 2004 Reflect changes in version 2
// *					:	30 Apr 2004 Fix for IE Java bug form submit
// *					:	17 May 2004 Fix for error in javascript IE posted twice
// *					:	19 May 2004 Added extra bit for putting details in email
// *
// ***************************************************************
// ***************************************************************
// *
// * 	Uses fpdf library for PHP.  A fabulous utility for creating
// *     pdf documents without having to have the pdf libraries
// *		installed on the server.  visit www.fpdf.org for details
// *
// ***************************************************************
// Define the location of font files and get the fpdf library
require_once("../../class2.php");
define('FPDF_FONTPATH', e_PLUGIN.'pdf/font/');

require(e_PLUGIN.'pdf/ufpdf.php');


require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
if (!is_object($helpdesk_obj))
{
    $helpdesk_obj = new helpdesk;
}

switch ($_GET['hdu_repselection'])
{
    case 1:
        require_once(e_PLUGIN . "helpdesk3_menu/reports/report1.php");
        break;
    default:
        require_once(e_PLUGIN . "helpdesk3_menu/reports/report0.php");
} // switch
