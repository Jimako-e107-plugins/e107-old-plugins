<?php


   require_once("../../class2.php");
   if (!getperms("P")) {
      header("location:".e_BASE."index.php");
   }

   require_once(e_ADMIN."auth.php");


   $preftitle   = "Coppermine Block Config";

   $pageid        = "blockcfg";       // unique name that matches the one used in admin_menu.php.


// Preferences
   $prefcapt[] = "Categories to show in dropdown";
   $prefnote[] = "Seperate with coma(s) ('all' = Show all categories)";
   $prefname[] = "cpg_showcats";
   $preftype[] = "text";
   $prefvalu[] = ",30,5";

   $prefcapt[] = "Albums to show in dropdown";
   $prefnote[] = "Seperate with coma(s) ('all' = Show all albums)";
   $prefname[] = "cpg_showalbs";
   $preftype[] = "text";
   $prefvalu[] = ",30,5";

   $prefcapt[] = "Restrict to categories";
   $prefnote[] = "Seperate with coma(s) (empty = show any)";
   $prefname[] = "cpg_cats";
   $preftype[] = "text";
   $prefvalu[] = ",30,5";

   $prefcapt[] = "Restrict to albums";
   $prefnote[] = "Seperate with coma(s) (empty = show any)";
   $prefname[] = "cpg_albums";
   $preftype[] = "text";
   $prefvalu[] = ",30,5";

   $prefcapt[] = "Number of images to display in block";
   $prefnote[] = "";
   $prefname[] = "cpg_numimages";
   $preftype[] = "text";
   $prefvalu[] = "1,3,3";

   $prefcapt[] = "Caption";
   $prefnote[] = "Title of the block";
   $prefname[] = "cpg_title1";
   $preftype[] = "text";
   $prefvalu[] = "Random Pics,50,50";

   $prefcapt[] = "Caption 2";
   $prefnote[] = "Title on the bottom of the block";
   $prefname[] = "cpg_title2";
   $preftype[] = "text";
   $prefvalu[] = ",50,50";

   $prefcapt[] = "'click to show' text";
   $prefnote[] = "Static text message displayed under image(s)";
   $prefname[] = "cpg_click_text";
   $preftype[] = "text";
   $prefvalu[] = ",20,20";

   $prefcapt[] = "Open images in new window";
   $prefnote[] = "(Yes or No)";
   $prefname[] = "cpg_opennew";
   $preftype[] = "dropdown";
   $prefvalu[] = "No,Yes";

   $prefcapt[] = "Image alignment";
   $prefnote[] = "Horizontal or Vertical";
   $prefname[] = "cpg_horiz";
   $preftype[] = "dropdown";
   $prefvalu[] = "Vertical,Horizontal";

   if(IsSet($_POST['updatesettings'])){
      $count = count($prefname);
      for ($i=0; $i<$count; $i++) {
         $namehere = $prefname[$i];
         $pref[$namehere] = $_POST[$namehere];
      };
      save_prefs();
      $message = "Your settings have been saved.";
   }

   if ($message){
      $ns -> tablerender("", "<div style='text-align:center'><b>$message</b></div>");
   }



require_once("form_handler.php");
   $rs = new form;


   $text .= "<div style='text-align:center'><form method='post' action='".e_SELF."'><table style='width:94%' class='fborder'>";

   for ($i=0; $i<count($prefcapt); $i++) {
      $form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
      $text .="<tr><td class='forumheader3'>".$prefcapt[$i]."<br><span class='smalltext'>".$prefnote[$i]."</span></td><td class='forumheader3'>";
      $name = $prefname[$i];
      $text .= $rs->user_extended_element_edit($form_send,$pref[$name],$name);
      $text .="</td></tr>";
   };

   $text .="<tr style='vertical-align:top'><td colspan='2' style='text-align:center' class='forumheader'>
      <input class='button' type='submit' name='updatesettings' value='Save Settings' /></td></tr></table></form></div>";

	 $text .="<div style='text-align:center'><table><tr><td style='text-align:center' class='forumheader'>
	 To add the coppermine block(menu) to your display, click on menus in the main e107 admin section, then choose coppermine and activate it in area of your choice.
   </td></tr></table></div>";
      
   $ns->tablerender($preftitle, $text);



   require_once(e_ADMIN."footer.php");







?>