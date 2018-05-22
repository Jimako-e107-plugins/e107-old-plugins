<?php
/*-----------------------------------------------------------------------------
     Google adwords menu plugin for e107

     ©PhpToys 2006
     http://www.phptoys.com

     Released under the terms and conditions of the
     GNU General Public License (http://gnu.org).

     $Revision: 1.0 $
     $Date: 2006/06/07 $
     $Author: PhpToys $
     
     USAGE:
          Copy your AdWords generated script between the START SCRIPT and 
          END SCRIPT comments.
          Please take care that don't owerwrite the first and last line in
          that area.
-----------------------------------------------------------------------------*/

if (!defined('e107_INIT')) { exit; }

$text = "<div style='text-align: center'>";

/* PUT YOUR GOOGLE ACCOUNT INFO BELOW */
/* START SCRIPT */
$text.='
        <script type="text/javascript">
            <!--
                google_ad_client = "pub-YOUR GOOGLE ACCOUNT";
                google_ad_width = 120;
                google_ad_height = 600;
                google_ad_format = "120x600_as";
                google_ad_type = "text";
                google_ad_channel ="";
                google_color_border = "000000";
                google_color_bg = "F0F0F0";
                google_color_link = "0000FF";
                google_color_url = "008000";
                google_color_text = "000000";
            //-->
        </script>
        <script type="text/javascript"
             src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
        '; // Don't remove this line
/* END SCRIPT */

$text.='</div>';
$ns->tablerender(GAD_BOX_TITLE,  $text, 'googlead');
?>