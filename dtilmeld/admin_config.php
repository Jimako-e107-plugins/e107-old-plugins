<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: http://www.dtilmeld.com $
|     
|     All Support entries should be asked directly to DTilmeld.com at our website: https://www.dtilmeld.com
|     All support questions will be answered within 24 hours.
|     
|     $Author: DTilmeld $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	 exit;
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."file_class.php");
$fl = new e_file;

$JQueryLoad = "<script src='http://www.dtilmeld.com/JS/jquery-1.5.1/'></script>";

$nav = "<table cellpadding='0' cellspacing='0' class='tbl-border' align='center' style='width:600px; margin-bottom:20px; text-align:center;'>\n<tr>\n";
$nav .= "<td class='".(!isset($_GET['page']) || $_GET['page'] == "payout" ? "tbl2" : "tbl1")."'><a href='admin_config.php'>".DTENR_admin."</a></td>\n";
$nav .= "<td class='".(isset($_GET['page']) && $_GET['page'] == "newevent" ? "tbl2" : "tbl1")."'><a href='admin_config.php?page=newevent'>".DTENR_admin_newevent."</a></td>\n";
$nav .= "<td class='".(isset($_GET['page']) && $_GET['page'] == "information" ? "tbl2" : "tbl1")."'><a href='admin_config.php?page=information'>".DTENR_admin_information."</a></td>\n";
$nav .= "</tr>\n</table>\n";


if (!isset($_GET['page'])) {

if($headline_total = $sql->db_Select("dte_events"))
{
	$nfArray = $sql -> db_getList();
  $text .= "<table cellpadding='0' cellspacing='1' width='500' class='tbl-border center'>\n";
    $text .= "<tr>\n";
  	$text .= "<td class='tbl2'><strong>".DTENR_admin_eventname."</strong></td>\n";
  	$text .= "<td align='center' class='tbl2' style='white-space:nowrap'><strong>".DTENR_admin_eventenrolled."</strong></td>\n";
  	$text .= "<td align='center' class='tbl2' style='white-space:nowrap'><strong>".DTENR_admin_withdrawable."</strong></td>\n";
  	$text .= "<td align='center' colspan=2 class='tbl2' style='white-space:nowrap'><strong>".DTENR_admin_eventoptions."</strong></td>\n";
  	$text .= "</tr>\n";
  	foreach($nfArray as $data)
  	{
    $text .= "<tr>\n";
  	$text .= "<td><span ID=\"Event_Title_".$data['LocalEventID']."\" onClick=\"send_request('error');\">".DTENR_admin_loading."</span></td>\n";
  	$text .= "<td><span ID=\"Event_Enrolled_".$data['LocalEventID']."\">".DTENR_admin_loading."</span></td>\n";
  	$text .= "<td><span ID=\"Event_Withdrawable_".$data['LocalEventID']."\">".DTENR_admin_loading."</span></td>\n";
  	$text .= "<td>
      <span ID=\"Event_Options_".$data['LocalEventID']."\">
        <a target=\"_new\" href=\"http://www.dtilmeld.com/ExternalCalls/FileDownload.php?DTEventID=".$data['DTEventID']."&api_key=".$data['api_key']."&md5key=".$data['md5key']."\">".DTENR_admin_event_downloadcsvfile."</a>
      </span>
      </td>\n";	
  	$text .= "<td>
      <span ID=\"Event_Options_".$data['LocalEventID']."\">
        <a href=\"admin_config.php?page=payout&amp;LocalEventID=".$data['LocalEventID']."&DTEventID=".$data['DTEventID']."\">".DTENR_admin_event_payout."</a>
      </span>
      </td>\n";	
  	$text .= "</tr>\n";
  	
  
    $text .= "
    <script type=\"text/javascript\"> 
        $.post(\"datapost.php\", { DTEventID: \"".$data['DTEventID']."\", api_key: \"".$data['api_key']."\", md5key: \"".$data['md5key']."\", RequestURL: 'http://www.dtilmeld.com/External/TitleEnrolled' },
           function(data) {
             var VarResults = data;
             var VarSplitted = VarResults.split(';');
             $(\"#Event_Title_".$data['LocalEventID']."\").text(VarSplitted[0]);
             $(\"#Event_Enrolled_".$data['LocalEventID']."\").text(VarSplitted[1]);
             $(\"#Event_Withdrawable_".$data['LocalEventID']."\").text(VarSplitted[2]);
        });  

    </script>
    ";
    }
  $text .= "</table>\n";
  }
}
elseif (isset($_GET['page']) && $_GET['page'] == "payout") {

	if($sql->db_Select("dte_events", "*", "LocalEventID=".$_GET['LocalEventID']))
	{
		$row = $sql->db_Fetch();
		extract($row);
	}
$text .= "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'><b>".DTENR_admin_event_balance."</b></td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_available;
$text .= "</td><td width=\"260px\">";
$text .= "DKK: <div id=\"EventBalance\">";
$text .= "</div>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_withdrawable;
$text .= "</td><td>";
$text .= "DKK: <div id=\"EventWithdrawBalance\">";
$text .= "</div>";
$text .= "</td>";
$text .= "</tr>";

$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'><b>".DTENR_admin_withdraw."</b></td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td colspan='2' class='tbl'>";
$text .= DTENR_admin_withdraw_withdraw."<br />";
$text .= "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n";
$text .= "<tr>";
$text .= "<td width='50%' class='tbl'>";
$text .= "<b>".DTENR_admin_withdraw_danish_banks."</b><br />".DTENR_admin_withdraw_danish_transfer."<br />&nbsp;";
$text .= "</td><td>";
$text .= DTENR_admin_withdraw_costs."<br />".DTENR_admin_withdraw_danish_costs;
$text .= "<br /><a href=\"admin_config.php?page=withdraw_bank&amp;LocalEventID=".LocalEventID."&DTEventID=".$DTEventID."\"\">".DTENR_admin_withdraw_now."</a>";
$text .= "</div>";
$text .= "</tr>\n";

$text .= "<tr>";
$text .= "<td width='50%' class='tbl'>";
$text .= "<b>".DTENR_admin_withdraw_paypal."</b><br />".DTENR_admin_withdraw_paypal_transfer;
$text .= "</td><td>";
$text .= DTENR_admin_withdraw_costs."<br />".DTENR_admin_withdraw_paypal_costs;
$text .= "<br /><a href=\"admin_config.php?&amp;page=withdraw_paypal&amp;LocalEventID=".LocalEventID."&DTEventID=".$DTEventID."\">".DTENR_admin_withdraw_now."</a>";
$text .= "</div>";
$text .= "</tr>\n";

$text .= "</table>";

$text .= "</td>";
$text .= "</tr>\n";

$text .= "<tr>";
$text .= "<td colspan='2'>";
$text .= "<br /><b>".DTENR_admin_withdraw_description_title."</b><br />";
$text .= DTENR_admin_withdraw_description_text."<br />
<br />
<b>Note:</b> ".DTENR_admin_withdraw_description_note;
$text .= "</td>";
$text .= "</tr>";

$text .= "</table>\n";
  $text .= "
  <script type=\"text/javascript\"> 
  $.post('datapost.php', { DTEventID: '".$DTEventID."', api_key: '".$api_key."', md5key: '".$md5key."', RequestURL: 'http://www.dtilmeld.com/External/TitleEnrolled' },
     function(data) {
       var VarResults = data;
       var VarSplitted = VarResults.split(';');
       $(\"#EventBalance\").text(VarSplitted[3]);
       $(\"#EventWithdrawBalance\").text(VarSplitted[2]);
     });  
  </script>
  ";
}
elseif (isset($_GET['page']) && $_GET['page'] == "withdraw_bank") {
	if($sql->db_Select("dte_events", "*", "LocalEventID=".$_GET['LocalEventID']))
	{
		$row = $sql->db_Fetch();
		extract($row);
	}
$text .= "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'>".DTENR_admin_event_balance."</td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_available;
$text .= "</td><td width=\"260px\">";
$text .= "DKK: <div id=\"EventBalance\">";
$text .= "</div>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_withdrawable;
$text .= "</td><td>";
$text .= "DKK: <div id=\"EventWithdrawBalance\">";
$text .= "</div>";
$text .= "</td>";
$text .= "</tr>";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'>".DTENR_admin_event_bank_withdraw."</td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_registrationcode;
$text .= "</td><td width=\"260px\">";
$text .= "<input type=\"text\" name=\"BankReg\" id=\"BankReg\" class=\"textbox\" style=\"width: 230px; \" maxlength=4>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_bankaccount;
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"BankReg\" id=\"BankAcc\" class=\"textbox\" style=\"width: 230px; \" maxlength=10>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_re_bankaccount;
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"BankReg\" id=\"BankAccTwice\" class=\"textbox\" style=\"width: 230px; \" maxlength=10>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan='2'>";
$text .= "<input type=\"button\" value=\"".DTENR_admin_withdraw_sendrequest."\" id=\"BankReg\" class=\"button\" style=\"width: 230px;\" onClick=\"StartWithDraw();\">";
$text .= "</td>";
$text .= "</tr><tr>\n";
$text .= "<td class='tbl' colspan='2'>";
$text .= DTENR_admin_withdraw_payout_notification;
$text .= "</td>";
$text .= "</tr>\n";

$text .= "</table>";
  $text .= "
  <script type=\"text/javascript\"> 
  $.post(\"datapost.php\", { DTEventID: '".$DTEventID."', api_key: '".$api_key."', md5key: '".$md5key."', RequestURL: 'http://www.dtilmeld.com/External/TitleEnrolled' },
     function(data) {
       var VarResults = data;
       var VarSplitted = VarResults.split(';');
       var SiteEmail = '".SITEADMINEMAIL."';
       $(\"#EventBalance\").text(VarSplitted[3]);
       $(\"#EventWithdrawBalance\").text(VarSplitted[2]);
     });
     function StartWithDraw() {
      var Reg = $('#BankReg').val();
      var Acc = $('#BankAcc').val();
      var AccTwi = $('#BankAccTwice').val();

      var strLen = Reg.length;
      var AccLen = Acc.length;
     
      if(strLen != 4)
      {
        alert(\"Wrong length in Bank Code\");
      }
      else if(Acc != AccTwi) {
        alert(\"Mismatch in Account number\");
      }
      else if(AccLen != 10)
      {
        alert(\"Wrong length in Account Number. Must be 10 numberic chars.\");
      } else {
      
       $.post(\"datapost.php\", { DTEventID: '".$data['DTEventID']."', api_key: '".$data['api_key']."', md5key: '".$data['md5key']."', Payout: 1, BankReg: Reg, BankAcc: Acc, Email: SiteEmail, RequestURL: 'http://www.dtilmeld.com/External/PayMents' },
       function(data) {
         var VarResults = data;
         var VarSplitted = VarResults.split(';');
         $(\"#EventBalance\").text(VarSplitted[3]);
         $(\"#EventWithdrawBalance\").text(VarSplitted[2]);
         alert(\"Your withdraw has been registered. You will receive the money on you account in 1-2 Business days\");
       });      
      }
     }  
  </script>
  ";
}
elseif (isset($_GET['page']) && $_GET['page'] == "withdraw_paypal") {
	if($sql->db_Select("dte_events", "*", "LocalEventID=".$_GET['LocalEventID']))
	{
		$row = $sql->db_Fetch();
		extract($row);
	}
$text .= "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'>".DTENR_admin_event_balance."</td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_available;
$text .= "</td><td width=\"260px\">";
$text .= "DKK: <div id=\"EventBalance\">";
$text .= "</div>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_withdrawable;
$text .= "</td><td>";
$text .= "DKK: <div id=\"EventWithdrawBalance\">";
$text .= "</div>";
$text .= "</td>";
$text .= "</tr>";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'>".DTENR_admin_event_paypal_withdraw."</td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= DTENR_admin_withdraw_paypal_email;
$text .= "</td><td width=\"260px\">";
$text .= "<input type=\"text\" name=\"PaypalEmail\" id=\"PaypalEmail\" class=\"textbox\" style=\"width: 230px; \">";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan='2'>";
$text .= DTENR_admin_event_paypal_description;
$text .= "<br />";
$text .= DTENR_admin_event_paypal_description2;
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan='2'>";
$text .= "<input type=\"button\" value=\"".DTENR_admin_withdraw_sendrequest."\" id=\"BankReg\" class=\"button\" style=\"width: 230px;\" onClick=\"StartWithDraw();\">";
$text .= "</td>";
$text .= "</tr><tr>\n";
$text .= "<td class='tbl' colspan='2'>";
$text .= DTENR_admin_withdraw_payout_notification;
$text .= "</td>";
$text .= "</tr>\n";

$text .= "</table>";
  $text .= "
  <script type=\"text/javascript\"> 
  $.post(\"datapost.php\", { DTEventID: '".$DTEventID."', api_key: '".$api_key."', md5key: '".$md5key."', RequestURL: 'http://www.dtilmeld.com/External/TitleEnrolled' },
     function(data) {
       var VarResults = data;
       var VarSplitted = VarResults.split(';');
       $(\"#EventBalance\").text(VarSplitted[3]);
       $(\"#EventWithdrawBalance\").text(VarSplitted[2]);
     });
     function StartWithDraw() {
      var PaypalEmail = $('#PaypalEmail').val();
      var Reg = '0';
      var Acc = '0';
      var SiteEmail = '".SITEADMINEMAIL."';

      var AccLen = PaypalEmail.length;
     
      if(AccLen < 5)
      {
        alert(\"Email to short!\");
      } else {
       $.post(\"datapost.php\", { DTEventID: '".$data['DTEventID']."', api_key: '".$data['api_key']."', md5key: '".$data['md5key']."', Payout: 1, BankReg: Reg, BankAcc: Acc, Email: SiteEmail, PaypalAccount: PaypalEmail, RequestURL: 'http://www.dtilmeld.com/External/PayMents' },
       function(data) {
         var VarResults = data;
         var VarSplitted = VarResults.split(';');
         $(\"#EventBalance\").text(VarSplitted[3]);
         $(\"#EventWithdrawBalance\").text(VarSplitted[2]);
         alert(\"Your withdraw has been registered. You will receive the money on you account in 5-7 Business days\");
       });      
      }
     }  
  </script>
  ";
}   
elseif (isset($_GET['page']) && $_GET['page'] == "newevent") {
$text .= "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'>".DTENR_admin_newevent_title."</td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= "Event Name:";
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"EventTitle\" id=\"EventTitle\" class=\"textbox\" style=\"width: 230px; \">";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= "Event Startdate:";
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"StartDay\" id=\"StartDay\" class=\"textbox\" style=\"width: 230px; \" value='".date("Y-m-d")."' maxlength=10>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= "Event End date:";
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"EndDay\" id=\"EndDay\" class=\"textbox\" style=\"width: 230px; \" value='".date("Y-m-d", (time() + 60 * 60 * 24 * 5))."' maxlength=10>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= "Valuta:";
$text .= "</td><td>";
  $text .= "<select name='Valuta' id='Valuta'>";
    $text .= "<option value='208'>DKK</option>";
    $text .= "<option value='978'>EUR</option>";
  $text .= "</select>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= "Participant price<br />(In choosen valuta):";
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"ParticipantPrice\" id=\"ParticipantPrice\" class=\"textbox\" style=\"width: 230px; \">";
$text .= "<div id='ParticipantRealPrice'></div>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan=2>";
$text .= "Please enter the the informations below you wish to know from you participants.<br />Example: <b>Name</b>, <b>Address</b> ect.";
$text .= "</td>";
$i = 1;
while($i < 10) {
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl'>";
$text .= "Participants Information ".$i;
$text .= "</td><td>";
$text .= "<input type=\"text\" name=\"ParticipantPrice_".$i."\" id=\"Participant_info_".$i."\" class=\"textbox\" style=\"width: 230px; \" maxlength=10>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$i++;
}
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan='2'>";
$text .= "<center>";
$text .= "<div id='CreateButton'>
        <input type=\"button\" value=\"Create event\" id=\"EventCreate\" class=\"button\" style=\"width: 230px;\" onClick='CreateEvent();'>
      </div>";
$text .= "</center>";
$text .= "</td>";
$text .= "</tr>\n";
$text .= "</table>\n";
  $text .= "
  <script type=\"text/javascript\">

     $('#ParticipantPrice').bind('keyup', function() {
         var ParticipantPrice = $('#ParticipantPrice').val();
         ParticipantPrice = ParticipantPrice.replace(/\,/i, '.');
         var ParticipantRound = Math.round(ParticipantPrice);
         var Valuta = '';
         if($('#Valuta').val() == 208) { Valuta = 'DKK'; }
         if($('#Valuta').val() == 978) { Valuta = 'EUR'; }
         $(\"#ParticipantRealPrice\").text( Valuta + ':' + ParticipantRound + ',00');      
     } ); 
     function CreateEvent() {
      var EventTitle = $('#EventTitle').val();
      var StartDay = $('#StartDay').val();
      var EndDay = $('#EndDay').val();
      var Valuta = $('#Valuta').val();
      var ParticipantPrice = $('#ParticipantPrice').val();
      ParticipantPrice = ParticipantPrice.replace(/\,/i, '.');
      ";
      $i = 1;
      while($i < 10) {
        $text .= "
            var ParticipantInfo_".$i." = $('#Participant_info_".$i."').val();
        ";
      $i++;
      }
      $text .= "

      var EventTitleLen = EventTitle.length;
      var ParticipantRound = Math.round(ParticipantPrice);

     
      if(EventTitleLen < 5)
      {
        alert(\"Title to short!\");
      }
      
       else {
       $('div#CreateButton').html('<img src=\"images/ajax-loader.gif\">');
       $.post(\"datapost.php\", {
        RequestURL: 'http://www.dtilmeld.com/External/CreateEvent',
        URL: '".SITEURL."', 
        WebsiteEmail: '".SITEADMINEMAIL."', 
        SiteName: '".SITENAME."', 
        EventTitle: EventTitle, 
        StartDay: StartDay, 
        EndDay: EndDay, 
        ParticipantPrice: ParticipantRound,
        ";
        $i = 1;
        while($i < 10) {
          $text .= "
              ParticipantInfo_".$i.": ParticipantInfo_".$i.", 
          ";
        $i++;
        }
        $text .= "
              Valuta: Valuta
        ";
        $text .= "
        },
       function(data) {
         var VarResults = data;
         var VarSplitted = VarResults.split(';');
         var DTEventID = VarSplitted[0];
         var API = VarSplitted[1];

         $.post(\"dtilmeld_admin_create_event.php\", { DTEventID: DTEventID, API: API, AID: '".$_GET['aid']."' },
         function(data) {
           if(data == 1) {
             alert(\"Your event has been created\");           
             $('div#CreateButton').html('<input type=\"button\" value=\"Create event\" id=\"EventCreate\" class=\"button\" style=\"width: 230px;\" onClick=\"CreateEvent();\">');           
           } else {
            alert(data);
           }
         });
       });      
      }
     }  
  </script>
  ";
/*
  $text .= "
  <link rel='stylesheet' type='text/css' media='screen,projection' href='".INFUSIONS."DTilmeld/jquery.datepicker.css' title='Main' />
	<script src='https://www.dtilmeld.dk/JS/jquery.ui.datepicker/'></script> 
  <script type='text/javascript'> 
	$(function() {
		var dates = $('#StartDay, #EndDay').datepicker({
			defaultDate: '+1w',
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				var option = this.id == 'StartDay' ? 'minDate' : 'maxDate',
					instance = $( this ).data('datepicker'),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker('option', option, date );
			}
		});
	$('#StartDay').datepicker('option', 'dateFormat', ('yy-mm-dd'));
	$('#EndDay').datepicker('option', 'dateFormat', ('yy-mm-dd'));
	});
  </script>
  ";
*/
}
elseif (isset($_GET['page']) && $_GET['page'] == "information") {
$text .= "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n";
$text .= "<tr>";
$text .= "<td class='tbl2' align='center' colspan='2'>".DTENR_admin_event_information."</td>\n";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl2' colspan=2>";
  $text .= "<b>";
    $text .= DTENR_admin_information_about;
  $text .= "</b>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan=2>";
    $text .= DTENR_admin_information_description;
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl2' colspan=2>";
  $text .= "<b>";
    $text .= DTENR_admin_information_pricing_model;
  $text .= "</b>";
$text .= "</td>";
$text .= "</tr>\n<tr>\n";
$text .= "<td class='tbl' colspan=2>";
    $text .= DTENR_admin_information_pricing_model_description;
$text .= "</td>";
$text .= "</tr>\n";


$text .= "</table>";

}

$ns->tablerender(DTENR_10, $JQueryLoad.$nav.$text);

require_once(e_ADMIN."footer.php");
?>