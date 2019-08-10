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

if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if (!isset($pref['plug_installed']['dtilmeld']))
{
	header('Location: '.e_BASE.'index.php');
	exit;
}

include_lan(e_PLUGIN.'dtilmeld/languages/'.e_LANGUAGE.'.php');

require_once(HEADERF);

$JQueryLoad = "<script src='http://www.dtilmeld.com/JS/jquery-1.5.1/'></script>";

$text .= "</table>";

if(!isset($_GET['Enroll']) && !isset($_GET['EventID'])) {
	echo $locale['DTE_choose']."\n";	

if($headline_total = $sql->db_Select("dte_events"))
{
	$nfArray = $sql -> db_getList();

	$text = "<div style='text-align:center'>";
  $text .= "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border center'>\n";
  $text .= "<tr>\n";
  $text .= "<td class='tbl2'><strong>".$locale['DTE_admin_eventname']."</strong></td>\n";
  $text .= "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['DTE_admin_eventenrolled']."</strong></td>\n";
  $text .= "<td class='tbl2' style='white-space:nowrap'><strong>".$locale['DTE_options']."</strong></td>\n";
  $text .= "</tr>\n";
  
	foreach($nfArray as $entry)
	{
    $text .= "<tr>\n";
  	$text .= "<td><span ID=\"Event_Title_".$entry['LocalEventID']."\" onClick=\"send_request('error');\">".DTENR_admin_loading."</span></td>\n";
  	$text .= "<td><span ID=\"Event_Enrolled_".$entry['LocalEventID']."\">".DTENR_admin_loading."</span></td>\n";
  	$text .= "<td>
      <span ID=\"Event_Options_".$entry['LocalEventID']."\">
        <a href=\"?EventID=".$entry['LocalEventID']."&Enroll=1\">".DTENR_enroll."</a>
      </span>
      </td>\n";	
  	$text .= "</tr>\n";
    $text .= "
    <script type=\"text/javascript\"> 
    $.post(\"datapost.php\", { LocalEventID: \"".$entry['LocalEventID']."\", PublicPage: 1, RequestURL: 'http://www.dtilmeld.com/External/PublicEnrolled' },
       function(data) {
         var VarResults = data;
         var VarSplitted = VarResults.split(';');
         $(\"#Event_Title_".$entry['LocalEventID']."\").text(VarSplitted[0]);
         $(\"#Event_Enrolled_".$entry['LocalEventID']."\").text(VarSplitted[1]);
       });  
    </script>
    ";
	}



	$text .= "</table>\n</div>";
}  

}
elseif(isset($_GET['Enroll']) && isset($_GET['EventID']) && $_GET['Enroll'] == 1) {
  $text = "
  <div id='RequestDTInformation'>
    <img src='".e_PLUGIN."dtilmeld/images/ajax-loader.gif'>
  </div>
    <script type=\"text/javascript\"> 
    var aUserID = 0;
    function RequestPayment() {
       $('div#EventCreate').html('<img src=\"".e_PLUGIN."dtilmeld/images/ajax-loader.gif\">');
      $.post(\"datapost.php\", { LocalEventID: \"".$_GET['EventID']."\",
      "; 
        $i = 5;
        while($i < 15) {
          $text .= "person1_".$i.": $('#person1_".$i."').val(), ";
          $i++;
        }
      $text .= "
      PublicPage: 1,
      RequestURL: 'http://www.dtilmeld.com/External/GoToPayment'       
       },
         function(data) {
           $(\"#RequestDTInformation\").html(data);
      });    
    }
    function OpenPaymentWindow(UserID) {
      $('div#EventCreate').html('<img src=\"".e_PLUGIN."DTilmeld/images/ajax-loader.gif\">');
      my_window = window.open('http://www.dtilmeld.com/External/PaymentWindow/' + UserID,'Payment Window','menubar=0,resizable=0,width=700,height=585');
      aUserID = UserID;
      AwaitingPaymentData();
    }
      function AwaitingPaymentData() {
        $.post(\"datapost.php\", { LocalEventID: \"".$_GET['EventID']."\", PublicPage: 1, UserID: aUserID, RequestURL: 'http://www.dtilmeld.com/External/AwaitingPayment' },
        function(data) {
          if(data == 1) {
            var EnrolledToEvent = '<center><img src=\"http://www.dtilmeld.com/IMG/PNG/payment_done\"><br />".DTENR_complete_1."<br />".DTENR_complete_2."<br />".DTENR_complete_3."</center>';
            $(\"#RequestDTInformation\").html(EnrolledToEvent);          
            my_window.close();
            clearTimeout(timer);
          }
        });
        timer = setTimeout('AwaitingPaymentData()',5000);
      }
    $.post(\"datapost.php\", { LocalEventID: \"".$_GET['EventID']."\", PublicPage: 1, RequestURL: 'http://www.dtilmeld.com/External/PHPFusion7' },
      function(data) {
        $(\"#RequestDTInformation\").html(data);
      });
    </script>
    ";
}

$text .= "<div align=right>Event registration by <a href='http://www.dtilmeld.com'>DTilmeld</a></div>";



$ns->tablerender(DTENR_10, $JQueryLoad.$nav.$text);

require_once(FOOTERF);

?>