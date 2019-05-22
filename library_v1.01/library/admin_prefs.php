<?php
/* 
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/admin_prefs.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:12 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

 $lan_file	= e_PLUGIN."library/languages/".e_LANGUAGE.".php";
require_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."library/languages/English.php"));

    $preftitle = PAGE_NAME." - ".BIBLIO_ADMIN_1;
	  $pageid = "prefs";

// Preference 1 using radio options.
    $prefcapt[] = BIBLIO_ADMIN_2;
    $prefname[] = "library_gestionemprunt";
    $preftype[] = "accesstable";
    $prefvalu[] = "";
    
    $prefcapt[] = BIBLIO_ADMIN_3;
    $prefname[] = "library_global_access";
    $preftype[] = "accesstable";
    $prefvalu[] = "";


//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------



if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");

if(IsSet($_POST['updatesettings'])){

        $count = count($prefname);
        for ($i=0; $i<$count; $i++) {
        $namehere = $prefname[$i];

        if($preftype[$i]=="date" || $fieldtype[$i] == "datestamp"){
        $year = $prefname[$i]."_year";
        $month = $prefname[$i]."_month";
        $day = $prefname[$i]."_day";
    		if($fieldtype[$i]=="date"){
				$datevalue = $_POST[$year]."-".$_POST[$month]."-".$_POST[$day];
        	}else {
				$datevalue = mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year]);
        	}
        $pref[$namehere] = $datevalue;
        }else{

        $pref[$namehere] = $_POST[$namehere];
        }
  //    echo $namehere." = ".$_POST[$namehere]."<br>";
  //      echo $namehere." = ".$datevalue;
        };

        save_prefs();
        $message = BIBLIO_ADMIN_4;
	

}

if($message){
        $ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}


require_once("form_handler.php");
$rs = new custom_form;
$text = "<div style='text-align:center'>
<form method='post' action='".e_SELF."'>
<table style='width:94%' class='fborder'>";


for ($i=0; $i<count($prefcapt); $i++) {
        $form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
        $text .="
        <tr>
        <td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i].":</td>
        <td style=\"width:70%\" class=\"forumheader3\">";
        $name = $prefname[$i];
        $text .= $rs->  user_extended_element_edit($form_send,$pref[$name],$name);
        $text .="</td></tr>";
    };


    $text .="<tr style='vertical-align:top'>
    <td colspan='2'  style='text-align:center' class='forumheader'>
    <input class='button' type='submit' name='updatesettings' value='".BIBLIO_ADMIN_5."' />
    </td>
    </tr>
    </table>
    </form>
    </div>";

$ns -> tablerender($preftitle, $text);

require_once(e_ADMIN."footer.php");

?>
