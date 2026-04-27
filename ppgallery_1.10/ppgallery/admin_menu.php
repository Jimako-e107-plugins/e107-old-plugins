<?php
/*
*************************************
*        PPGallery					*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/admin.php");

   $menutitle  = PPGLAN_35;

   $butname[]  = PPGLAN_36;
   $butlink[]  = "admin.php";
   $butid[]    = "main";

   $butname[]  = PPGLAN_37;
   $butlink[]  = "admin_new_gallery.php";
   $butid[]    = "new";
   
   $butname[]  = PPGLAN_61;
   $butlink[]  = "admin_sort.php";
   $butid[]    = "sort";
   
   $butname[]  = PPGLAN_38;
   $butlink[]  = "admin_ftp_loads.php";
   $butid[]    = "ftp_load";
   
   $butname[]  = PPGLAN_62;
   $butlink[]  = "admin_mass_activation.php";
   $butid[]    = "mass_activation";
   
   $butname[]  = PPGLAN_39;
   $butlink[]  = "admin_ftp_delete.php";
   $butid[]    = "ftp_delete";
   
   $butname[]  = PPGLAN_40;
   $butlink[]  = "readme.php";
   $butid[]    = "readme";
   
   $butname[]  = PPGLAN_41;
   $butlink[]  = "admin_delete_gallery.php";
   $butid[]    = "delete";

   global $pageid;
   for ($i=0; $i<count($butname); $i++) {
      $var[$butid[$i]]['text'] = $butname[$i];
      $var[$butid[$i]]['link'] = $butlink[$i];
   };

   show_admin_menu($menutitle, $pageid, $var);
?>