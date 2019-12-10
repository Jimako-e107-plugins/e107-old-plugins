<?php
/*
+---------------------------------------------------------------+
|        CreativeWriter Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

 

if (!defined('e107_INIT')) {   exit;   }
 
e107::lan('creative_writer'); 
 
$pref = e107::pref('creative_writer');
 
$creative_writer = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php'); 
$creative_writer->init();

 
$cwriter_text = "<table class='fborder' style='width:100%' >   ";
    $cwriter_text .= "
    <tr><td> ";
                           
   if (check_class($pref['cwriter_admin']) || check_class($pref['cwriter_create']))
    { 
        $cwriter_text .= $tp->parseTemplate("{CW_ADMIN_MANAGEBOOKS}", true, $creative_writer->sc);
				//$cwriter_text .= "<a href='" . e_PLUGIN . "creative_writer/mybooks.php' >" . CWRITER_32 . "</a>";
        $cwriter_text .= "</td></tr><tr><td>";
        $cwriter_text .= $tp->parseTemplate("{CW_ADMIN_NEWBOOK}", true, $creative_writer->sc);
        $cwriter_text .= "</td></tr><tr><td>";
				$cwriter_text .= "<a href='" . e107::getUrl()->create('user/myprofile/edit',array('id'=>USERID))."'>" . LAN_CWRITER_97 . "</a>";
        $cwriter_text .= "</td></tr>";
    }
    else      $cwriter_text .= CWRITER_225."</td> ";   
    $cwriter_text .= " 
	</tr>
</table>  ";

 
$ns->tablerender(CWRITER_01, $cwriter_text, 'creativewriter');
?>
 