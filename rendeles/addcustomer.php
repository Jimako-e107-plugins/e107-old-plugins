<?php

require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
        global $cal;
        return $cal->load_files();
}

if (is_readable(THEME . "rendeles_template.php")){
    require_once(THEME . "rendeles_template.php");}
else{
    require_once(e_PLUGIN . "rendeles/rendeles_template.php");}

require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

   $text .= $tp->parseTemplate($RENDELES_HEADER, false);
   $ns -> tablerender("".RENDELES_18."", $text);	

   if (isset($_POST['kuldes'])) {

    $sql -> db_Insert("rendeles_customer", "'".$_POST['rendeles_customer_id']."', '".$_POST['rendeles_customer_name']."', '".$_POST['rendeles_customer_email']."', '".$_POST['rendeles_customer_address']."' ");
    $text = "
	    <table class='fborder' style='width:100%'>			    
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_ADLAN_18."</span>
          </td>			    
        </tr>		    
      </table>";

   } else {

    $text = "<form action='".e_SELF."' method='post'>";
    $text .="
	    <table class='fborder' style='width:100%'>			    
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_2."</span>
          </td>				    
          <td class='forumheader3'>    
            <input type='text' name='rendeles_customer_name' class='tbox' style='width:200px' value='' />            
          </td>			    
        </tr>
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_3."</span>
          </td>				    
          <td class='forumheader3'>    
            <input type='text' name='rendeles_customer_email' class='tbox' style='width:200px' value='' />            
          </td>			    
        </tr>
        <tr>				    
          <td style='width:25%; vertical-align:top;' class='forumheader3'>
            <span class='smalltext'>".RENDELES_4."</span>
          </td>				    
          <td class='forumheader3'>    
            <input type='text' name='rendeles_customer_address' class='tbox' style='width:500px' value='' />            
          </td>			    
        </tr>  
        <tr style='vertical-align:top'>				    
          <td colspan='2' style='text-align:center' class='forumheader'>					    
            <input class='button' type='submit' name='post' value='".RENDELES_ADLAN_23."' />					    
            <input type='hidden' name='kuldes' value='kuldes' />				    
          </td>			    
        </tr>		    
      </table>	    
    ";
    $text .= "</form>";
   }	

   $ns -> tablerender("".RENDELES_17."", $text);	
   
?>