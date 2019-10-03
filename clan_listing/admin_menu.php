<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

//-----------------------+
         	

$text1 = "
<table class='fborder' style='width:100%;'>
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_main.php") {
        $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_main.php'>>> ".ACLANLIST_MENU_01." <<</a></b>";
        } else {
        $text1 .= "
        <a style='cursor:hand; text-decoration:none' href='admin_main.php'>".ACLANLIST_MENU_01."</a>";         
        }

$text1 .= "
                </td>
                </tr> ";

$text1 .= "
 
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_config.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_config.php'>>> ".ACLANLIST_MENU_02." <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_config.php'> ".ACLANLIST_MENU_02." </a>";
		}

$text1 .= "
                </td>
                </tr> ";

$text1 .= "
 
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new_cat.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'>>> ".ACLANLIST_MENU_03." <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new_cat.php'> ".ACLANLIST_MENU_03." </a>";
		}

$text1 .= "
                </td>
                </tr> ";




$text1 .= "
 
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_cat.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'>>> ".ACLANLIST_MENU_04." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat.php'> ".ACLANLIST_MENU_04." </a>";
		}
$text1 .= "
                </td>
                </tr>";
$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit_cat_order.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat_order.php'>>> ".ACLANLIST_MENU_09." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit_cat_order.php'> ".ACLANLIST_MENU_09." </a>";
		}


$text1 .= "
                </td>
                </tr>";



$text1 .= "

	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_new.php") {
         $text1 .= "
		 <b><a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'>>> ".ACLANLIST_MENU_05." <<</a></b>";
		} else {
		 $text1 .="
		 <a style='cursor:hand; cursor:pointer; text-decoration:none;' href='admin_new.php'> ".ACLANLIST_MENU_05." </a>";
		}




$text1 .= "
                </td>
                </tr>";


$text1 .= "
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_edit.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_edit.php'>>> ".ACLANLIST_MENU_06." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_edit.php'> ".ACLANLIST_MENU_06." </a>";
		}
         	
 



$text1 .= "
                </td>
                </tr> ";


$text1 .= "
         
	<tr>
        <td style='width:30%' class='button'>";
        if (e_PAGE == "admin_clan_submissions.php") {
         $text1 .= "
		<b>
		<a style='cursor:hand; text-decoration:none' href='admin_clan_submissions.php'>>> ".ACLANLIST_MENU_07." <<</a>
		</b>";
		} else {
		$text1 .= "
		<a style='cursor:hand; text-decoration:none' href='admin_clan_submissions.php'> ".ACLANLIST_MENU_07." </a>";
		}


$text1 .= "
                </td>
                </tr>";



$text1 .= "</table>";





//--------------------------------------------------------------------------------------------
 

//-----------------------------------------------------------------------------------------------------


$ns -> tablerender($ttl1, $text1);

?>
