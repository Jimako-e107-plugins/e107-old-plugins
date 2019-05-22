<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/libraryemail_template.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:16:15 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

global $pref;
$SIGNUPEMAIL_SUBJECT = "Rappel d'emprunt de documents à la librarythèque {SITENAME}";
$SIGNUPEMAIL_USETHEME = 1; // Use CSS STYLE from THEME: 0 = Off, 1 = external, 2 = embedded
$SIGNUPEMAIL_LINKSTYLE = ""; // css to use on links eg. color:red;
$SIGNUPEMAIL_IMAGES =  e_IMAGE.$pref['sitebutton']; // comma separated paths to image to embed. referenced below with {IMAGE1} (IMAGE2} etc.
$SIGNUPEMAIL_CC = "";  // comma separated email addresses to put in CC of the signup email.
$SIGNUPEMAIL_BCC = "webmaster@arcur.asso.fr";   // comma separated email addresses to put in BCC of the signup email.
$SIGNUPEMAIL_ATTACHMENTS = ""; // files-path array of attachments. eg. array(e_FILE."myfile.zip",e_FILE."myotherfile.zip");
$SIGNUPEMAIL_BACKGROUNDIMAGE = "";// relative path to a background image eg. e_IMAGE."mybackground.jpg";

$SIGNUPEMAIL_TEMPLATE = "
<div style='padding:10px'>
<div style='text-align:left; width:90%'>
Bonjour {USERNAME},<br /><br />
Ce courriel est un petit rappel que tu as emprunté des livres à la librarythèque de l'Association des Résidents de la Cité Universitaire le Rabot.
<br /><br />
 <center>Il serait souhaitable que tu ramènes les documents que tu as emprunté plutôt qu'on est a se déplacer pour te trouver...</center>
 <br />
Tu peux laisser tes livres à la loge Esclangon durant la journée si la librarythèque n'est pas ouverte quand tu passes nous voir.<br /><br />
{LISTE_DES_EMPRUNTS_EMAIL}<br /><br />Merci !<br /><br />
{LIEN_BIBLIO}<br />
<br />
<br /><br />
{SITENAME}<br />
<br /><br />
<center>{IMAGE1}</center>
</div>
</div>
";
?>
