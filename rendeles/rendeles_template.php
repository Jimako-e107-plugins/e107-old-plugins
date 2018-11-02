<?php
if (!defined("USER_WIDTH")){define("USER_WIDTH", "width:100%");}
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

if (!isset($RENDELES_HEADER)){
$RENDELES_HEADER = "

     <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
     <link rel='stylesheet' href='".THEME_ABS."style.css' type='text/css' />
     <link rel='stylesheet' href='".$eplug_folder."style.css' type='text/css' />
     <div style='margin: 10px;'>
       <div class='forumheader3' style='text-align: center;'>
         <center>
       
           <table border='0' cellpadding='10' cellspacing='5'>
            <tr>
              <td width='25%' align='center' valign='middle'><a href='".SITEURL."index.php'><div class='button'>".RENDELES_19."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."rendeles.php'><div class='button'>".RENDELES_27."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."addrendeles.php'><div class='button'>".RENDELES_1."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."admin_rendeles.php'><div class='button'>".RENDELES_38."</div></a></td>
            </tr>
            <tr>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."banners.php'><div class='button'>".RENDELES_21."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."type.php'><div class='button'>".RENDELES_22."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."flower.php'><div class='button'>".RENDELES_20."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."location.php'><div class='button'>".RENDELES_37."</div></a></td>
            </tr>
            <tr>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."completed.php'><div class='button'>".RENDELES_24."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."no_completed.php'><div class='button'>".RENDELES_25."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."paid.php'><div class='button'>".RENDELES_23."</div></a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."no_paid.php'><div class='button'>".RENDELES_50."</div></a></td>
            </tr>
          </table>
          
         </center>
       </div>
     </div>
    
    ";}
?>