<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|   http://e107.org
|	/image_gallery/admin_readme.php
|
| Revision: 0.9.6.2
| Date: 2008/02/15
| Author: Krassswr
|	
|	krassswr@abv.bg
|
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
   // Remember that we must include class2.php
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");
   $lan_file = e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php";
   require_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."image_gallery/languages/image_gallery_English.php");
   require_once("myfuncs.php");

   function admin_readme_adminmenu() {
     show_menu("Readme");
   }
   // Handle preferences form being submitted
   // n.b. to complex to list in this example

   // Our informative text

    $text = "".image_gallery_CONFIG_L40." ".image_gallery_CONFIG_L41." .<p>

".image_gallery_CONFIG_L42.":<p>
 - ".image_gallery_CONFIG_L14." - ".image_gallery_CONFIG_L46.".<br>
 - ".image_gallery_CONFIG_L6." - ".image_gallery_CONFIG_L47.".<br>
 - ".image_gallery_CONFIG_L43." - ".image_gallery_CONFIG_L48.". <br>
 - ".image_gallery_CONFIG_L45." - ".image_gallery_CONFIG_L49.".<br>
 - ".image_gallery_CONFIG_L13." - ".image_gallery_CONFIG_L50.".<br>
 - ".image_gallery_CONFIG_L5." - ".image_gallery_CONFIG_L51.".<br>
 - ".image_gallery_CONFIG_L44." - ".image_gallery_CONFIG_L52.". <br>
 - ".image_gallery_CONFIG_L61." - ".image_gallery_CONFIG_L53.".<br>
 - ".image_gallery_LAN_SUBMCOME." - ".image_gallery_CONFIG_LCOMM."<br>
 - ".image_gallery_CONFIG_LCOMMDel." - ".image_gallery_CONFIG_LCOMMD."<br>
 - ".image_gallery_CONFIG_LCOMMEdit." - ".image_gallery_CONFIG_LCOMME."<p>


<center>".image_gallery_CONFIG_L54.":</center><p>
<center>
<table border=1 cellspacing=0 cellpadding=0 width=636>
 <tr style='mso-yfti-irow:0;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>".image_gallery_CONFIG_L55."<o:p></o:p></span></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>".image_gallery_CONFIG_L56."<o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>".image_gallery_CONFIG_L57."<o:p></o:p></span></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>".image_gallery_CONFIG_L58."<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><span class=SpellE><b style='mso-bidi-font-weight:normal'><span
  lang=BG style='mso-ansi-language:BG'>".image_gallery_CONFIG_L14."</span><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<o:p></o:p></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+(".image_gallery_CONFIG_L59.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span><span lang=BG> </span>(".image_gallery_CONFIG_L59.")<o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:18.2pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:18.2pt'>
  <p class=MsoNormal><span class=SpellE><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L6."<b style='mso-bidi-font-weight:
  normal'><span lang=BG style='mso-ansi-language:BG'><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<o:p></o:p></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.2pt'>
  <p class=MsoNormal align=center style='text-align:center'>+(".image_gallery_CONFIG_L59.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:18.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>-<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L43."</b><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<o:p></o:p></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+ (".image_gallery_CONFIG_L60.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>-<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L45."</b><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+ (".image_gallery_CONFIG_L60.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>-<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L13."</b><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+(".image_gallery_CONFIG_L59.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span><span lang=BG> </span>(".image_gallery_CONFIG_L59.")<o:p></o:p></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L5."</b><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+(".image_gallery_CONFIG_L59.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'>-<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L44."</b><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+ (".image_gallery_CONFIG_L60.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'>-<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_L61."<o:p></o:p></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+ (".image_gallery_CONFIG_L60.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'>-<o:p></o:p></span></b></p>
  </td>
 </tr>
   <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_LAN_SUBMCOME."<o:p></o:p></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>+ (".image_gallery_CONFIG_L59.")</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'></b>+(".image_gallery_CONFIG_L59.")<o:p></o:p></span></b></p>
  </td>
 </tr>
   <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_LCOMMDel."<o:p></o:p></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+</span>(".image_gallery_CONFIG_L59.")<span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>-</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'>-<o:p></o:p></span></b></p>
  </td>
 </tr>
    <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes;height:17.3pt'>
  <td width=156 valign=top style='width:117.0pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal><b style='mso-bidi-font-weight:normal'>".image_gallery_CONFIG_LCOMMEdit."<o:p></o:p></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=BG
  style='mso-ansi-language:BG'>+(".image_gallery_CONFIG_L59.")</span><span lang=BG style='mso-ansi-language:
  BG'><o:p></o:p></span></p>
  </td>
  <td width=156 valign=top style='width:117.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'>-</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=BG style='mso-ansi-language:
  BG'>-<o:p></o:p></span></b></p>
  </td>
 </tr>
</table>
</center>";

   $readmetitle = image_gallery_HELP_L1;
   // The usual, tell e107 what to include on the page
   $ns->tablerender($readmetitle, $text);

   require_once(e_ADMIN."footer.php");
?>