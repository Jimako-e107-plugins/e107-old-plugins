<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/library.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:16:15 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if(check_class($pref['library_global_access']) || getperms("0")){
$eplug_js = "autocomplete/initialize.js";
$eplug_css[] = "library.css";
$lan_file	= e_PLUGIN."library/languages/".e_LANGUAGE.".php";
require_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."library/languages/English.php"));
require_once(e_PLUGIN."library/library_shortcodes.php");
include_once(e_PLUGIN."library/library_template.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(HEADERF);
//               !!!!!!!!!!!!!!!!!!!!!!!!!!Début du script!!!!!!!!!!!!!!!!!!
$sql->db_Mark_Time('Library plugin');

//=========================Début - Accès à la page de liste (PAGE PRINCIPALE)====================================
//+++Début Bloquage+++
//+++Fin Bloquage+++
if (!e_QUERY) {
$rs = new form;
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_LISTE, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_LIST_TITLE, $text);
require_once(FOOTERF);exit;
}
//--------------------------Fin - Accès à la page de liste (PAGE PRINCIPALE)-------------------------------------
$e_QUERY = explode(".", e_QUERY);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////MODE D'EMPLOI/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//=========================Début - Accès à la page du mode d'emploi ====================================
//+++Début Bloquage+++
//+++Fin Bloquage+++
if ($e_QUERY[0] == "notice"){
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_NOTICE, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_NOTICE_TITLE, $text);
require_once(FOOTERF);exit;
}
//--------------------------Fin - Accès à la page du mode d'emploi -------------------------------------

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////EMPRUNTS/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($e_QUERY[0] == "emprunt"){
//=========================Début - Accès à la page de gestion des EMPRUNTS=======================================
//++++++++++++++++++++++++++++++++++++Début Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second']) || (check_class($pref['library_membre']) && $pref['library_perm_emprunt'] == '1') || getperms("0")) {
//...............start SCRIPT update DB after post (second in order of appearance)...............
if (isset($_POST['emprunt']))
{
    $emprunts_titre = explode(";",$_POST['ac_liste_multichoice']);
// ========== Start of verification.. ====================================================
      $error_message = "";
      require_once(e_HANDLER."message_handler.php");
      // Check for nombre d'emprunt vs nb permis
      //Cette alerte est buggé lorsqu'un seul document est ajouté à la fois = pas de message !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
      $nbemprunt = $sql->db_Count("library", "(*)", "WHERE library_empruntepar = '".$_POST['emprunteur']."' ");
      $nbempruntnow = count($emprunts_titre);
      $compare = $pref['library_nb_emprunt_max']-$nombredemprunt-$nbempruntnow;
      if ($compare <='0')
      {$error_message .= BIBLIO_EMPRUNT_ERROR_2.($pref['library_nb_emprunt_max']-$nbemprunt)." documents.";$error = TRUE;}
      // Check for emtpy fields
      if (trim($_POST['emprunteur']) == "" || trim($_POST['emprunteur']) == "???")
      {$error_message .= BIBLIO_EMPRUNT_ERROR_1;$error = TRUE;}
      if($error_message)	{message_handler("P_ALERT", $error_message);}
// ========== End of verification.. ====================================================
	if (!$error)
	{
		$empruntepar = $tp -> toDB(strip_tags($_POST['emprunteur']));
		$time = time();
//boucle qui attribue l'emprunteur, la date d'emprunt et le statut au document empruntés
				foreach($emprunts_titre as $pourdb)
        {
          $pourdb = explode(" _ ",$pourdb);
          $sql->db_Update("library", "library_emprunte='1', library_empruntepar=$empruntepar, library_empruntdate=$time WHERE library_titre='".$tp -> toDB($pourdb[0])."' AND library_soustitre='".$tp -> toDB($pourdb[1])."' ");
        }
        $message = BIBLIO_EMPRUNT_MESSAGE_3;
			// ==========================================================
  }
}
if($message){
        $CONFIRM = "<div style='text-align:center'><b>$message</b></div><br />";}
//...............end   SCRIPT update DB after post (second in order of appearance)...............

//...............start SCRIPT create form before post (first in order of appearance)...............
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($CONFIRM.$EMPRUNT_BODY, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_EMPRUNT_TITLE, $text);
require_once(FOOTERF);exit;
//...............end   SCRIPT create form before post (first in order of appearance)...............
}
else{
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_PERMISSION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_EMPRUNT_TITLE, $text);require_once(FOOTERF);exit;}
//++++++++++++++++++++++++++++++++++++++++++Fin Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Voir fonction associée à la fin : function select_form(.....) 
//--------------------------Fin - Accès à la page de gestion des EMPRUNTS----------------------------------------
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////RETOURS////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($e_QUERY[0] == "retour"){
//=========================Début - Accès à la page de gestion des RETOURS========================================
//++++++++++++++++++++++++++++++++++++Début Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second']) || (check_class($pref['library_membre']) && $pref['library_perm_retour'] == '1') || getperms("0")) {
//...............start SCRIPT update DB after post (third in order of appearance)...............
if (isset($_POST['docurendu']))
{
//boucle qui complète l'historique. Doit être placée en premier!!
  $time = time();
  $histo = ".$time;";
  if(isset($_POST['retour_sans_emprunteur']))
    {
      $histo = ".$time;";
				foreach($_POST['doc_pour_histo'] as $k => $pourdb )
        {
          $sql->db_Select("library","library_histo,library_empruntdate","library_id='".$pourdb."'");
          $his = $sql->db_Fetch();
          $sql->db_Update("library", "library_histo='".$his[library_histo].$k.".".$his[library_empruntdate].$histo."' WHERE library_id='".$pourdb."' ");
        }
    }else
    {
				foreach($_POST['docurendu'] as $pourdb )
        {
          $sql->db_Select("library","library_histo,library_empruntdate","library_id='".$pourdb."'");
          $his = $sql->db_Fetch();
          $sql->db_Update("library", "library_histo='".$his[library_histo].$_POST['emprunteur'].".".$his[library_empruntdate].$histo."' WHERE library_id='".$pourdb."' ");
        }
    }
//boucle qui enlève le statut d'emprunt à un livre.
				foreach($_POST['docurendu'] as $pourdb)
        {
          $sql->db_Update("library", "library_emprunte='0', library_empruntepar='0' WHERE library_id='".$pourdb."' ");
        }

			// ==========================================================
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($RETOUR_FIN, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_RETOUR_TITLE, $text);
  require_once(FOOTERF);  exit;
}
//...............end   SCRIPT update DB after post (third in order of appearance)...............
//...............start SCRIPT create form before post (first & second in order of appearance)...............
if(isset($_POST['retour_sans_emprunteur']))
{
  $rs = new form;
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
  	$text = $tp->parseTemplate($RETOUR_BODY_SANS_EMPRUNTEUR, TRUE, $library_shortcodes);
  	$ns->tablerender(BIBLIO_RETOUR_TITLE, $text);
  require_once(FOOTERF);exit;
}else
{ if(isset($_POST['retour_emprunteur']) || $pref['library_perm_retour'] == '1' && !check_class($pref['library_gestionemprunt']) && !check_class($pref['library_gestionemprunt_second']))
  {
  $rs = new form;
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
  	$text = $tp->parseTemplate($RETOUR_BODY, TRUE, $library_shortcodes);
  	$ns->tablerender(BIBLIO_RETOUR_TITLE, $text);
  require_once(FOOTERF);exit;
  }else
  {
//..........start SCRIPT create first form (qui est l'emprunteur?)........
$rs = new form;
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($RETOUR_EMPRUNTEUR, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_RETOUR_TITLE, $text);
require_once(FOOTERF);exit;
//..........end   SCRIPT create first form (qui est l'emprunteur?)........
}}
//...............end   SCRIPT create form before post (first & second in order of appearance)...............
}else{
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_PERMISSION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_RETOUR_TITLE, $text);require_once(FOOTERF);exit;}
//++++++++++++++++++++++++++++++++++++++++++Fin Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//--------------------------Fin - Accès à la page de gestion des RETOURS-----------------------------------------
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////LISTE des EMPRUNTS/////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//petite exception, ce dernier query existait déjà, il est conservé en attendant de mieux l'intégrer!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if($e_QUERY[0] == "preview_email"){	
  $eml = render_email(TRUE); 
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($eml['preview'], TRUE, $library_shortcodes);        //PEUT ÊTRE UNE SOURCE DE BUGS!!!!!!
  $ns->tablerender(BIBLIO_EMAIL_TITLE, $text);
  require_once(FOOTERF);exit;}
if ($e_QUERY[0] == "listeemprunt"){
//=========================Début - Accès à la page de LISTE des EMPRUNTS=========================================
/*
!!!!!!!!!!!!!!!!!TRÈS INCOMPLET!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
Discussion : pourrait être débloqué pour les autres usagers,
 ajouter des données sur l'emprunteur (chambre, bâtiment, etc.. faire gaffe à la loi nominative...).

Développement : principalement tiré de signup.php et ses afférences
TO DO:
*compléter la transmission de mails
*faire différents modèles de mails (1er avertissement, 2e, etc., final 
avec sanctions sur l'ensemble des données traitées par le programme...)
*Envoi automatique de courriels lorsqu'emprunt dépasse la date permise 
*/
//++++++++++++++++++++++++++++++++++++Début Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second']) || check_class($pref['library_membre'])) {
//...............start SCRIPT send email after post (second in order of appearance)...............
if (isset($_POST['email']))
{
  $eml = render_email();
	$mailheader_e107id = $eml['userid'];
	require_once(e_HANDLER."mail.php");
  if(!sendemail($_POST['email'], $eml['subject'], $eml['message'], "", "", "", $eml['attachments'], $eml['cc'], $eml['bcc'], "", "", $eml['inline-images']))
	  {
		$error_message = BIBLIO_EMAIL_ERROR;
	  }
  if ($error_message){
        $ns -> tablerender("", "<div style='text-align:center'><b>$error_message</b></div>");}
  else{
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	    $text = $tp->parseTemplate($BIBLIO_EMAIL_PREVIEW, TRUE, $library_shortcodes);}     //$BIBLIO_EMAIL_PREVIEW est à créer dans le template!!!!!!
	$ns->tablerender(BIBLIO_LISTEMPRUNT_TITLE, $text);
  require_once(FOOTERF);exit;
}
//...............end   SCRIPT send email after post (second in order of appearance)...............
//...............start SCRIPT create list before post email (first in order of appearance)...............
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_EMPRUNTEUR, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_LISTEMPRUNT_TITLE, $text);
  require_once(FOOTERF);exit;
//...............end   SCRIPT create list before post email (first in order of appearance)...............
}else{
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_PERMISSION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_LISTEMPRUNT_TITLE, $text);require_once(FOOTERF);exit;}
//++++++++++++++++++++++++++++++++++++++++++Fin Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Voir fonction associée à la fin : function render_email() 
//--------------------------Fin - Accès à la page de LISTE des EMPRUNTS------------------------------------------
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////AJOUT/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($e_QUERY[0] == "ajout"){
//=========================Début - Accès à la page d'AJOUT de documents==========================================
//++++++++++++++++++++++++++++++++++++Début Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second']) || (check_class($pref['library_membre']) && $pref['library_perm_ajout'] == '1') || getperms("0")) {
//...............start SCRIPT update DB after post (second in order of appearance)...............
if (isset($_POST['ajout']))
{
		($_POST['categorie_text'])? $categorie = $tp -> toDB(strip_tags($_POST['categorie_text'])):$categorie = $tp -> toDB(strip_tags($_POST['categorie_edit']));
// ========== Start of verification.. ====================================================
      $error_message = "";
      require_once(e_HANDLER."message_handler.php");
      // Vérifie que le livre ne contient pas les caractères du AUTOCOMPLETE (voir section emprunt et ac_retrieve.php)
      if (strstr($_POST['titre'], "_") || strstr($_POST['soustitre'], "_") || strstr($_POST['titre'], ";") || strstr($_POST['soustitre'], ";"))
      { $error_message .= BIBLIO_AJOUT_ERROR_1;
  		$error = TRUE;  }
      // Livres existe déjà dans la banque.
      if ($sql->db_Select("library", "*", "library_titre='".$tp -> toDB($_POST['titre'])."' AND library_soustitre='".$tp -> toDB($_POST['soustitre'])."'"))
      {	$error_message .= BIBLIO_AJOUT_ERROR_2;
      $error = TRUE;	}
      // ISBN exists
      if ($_POST['isbn'] != ''){
        if ($sql->db_Select("library", "*", "library_isbn='".$tp -> toDB($_POST['isbn'])."' "))
        {	$error_message .= BIBLIO_AJOUT_ERROR_3;
        $error = TRUE;	}}
      // Check for emtpy fields
      if (trim($_POST['titre']) == "" || trim($_POST['auteur1']) == "")
      {$error_message .= BIBLIO_AJOUT_ERROR_4;$error = TRUE;}
      if (trim($categorie) == "")
      {$error_message .= BIBLIO_AJOUT_ERROR_5;$error = TRUE;}

      if($error_message)	{message_handler("P_ALERT", $error_message);}
// ========== End of verification.. ====================================================
	if (!$error)
	{
    //$categorie posté plus haut afin de vérifier le champs saisi et créer une nouvelle catégorie si demandé.
		$pretautorise = $tp -> toDB(strip_tags($_POST['pretautorise']));
		$isbn = $tp -> toDB(strip_tags($_POST['isbn']));
 		$titre = $tp -> toDB(strip_tags($_POST['titre']));
 		$soustitre = $tp -> toDB(strip_tags($_POST['soustitre']));
		$auteur1 = $tp -> toDB(strip_tags($_POST['auteur1']));		$auteur2 = $tp -> toDB(strip_tags($_POST['auteur2']));		$auteur3 = $tp -> toDB(strip_tags($_POST['auteur3']));		$auteur4 = $tp -> toDB(strip_tags($_POST['auteur4']));		$auteur5 = $tp -> toDB(strip_tags($_POST['auteur5']));
 		$editeur = $tp -> toDB(strip_tags($_POST['editeur']));
 		$collection = $tp -> toDB(strip_tags($_POST['collection']));
 		$sommaire = $tp -> toDB(strip_tags($_POST['sommaire']));
 		$parution = $tp -> toDB(strip_tags($_POST['parution']));
 		$quantite = $tp -> toDB(strip_tags($_POST['quantite']));
		$time = time();

		$nid = $sql->db_Insert("library", "0, '{$isbn}', '{$auteur1}', '{$auteur2}', '{$auteur3}', '{$auteur4}', '{$auteur5}', '{$titre}', '{$soustitre}', '{$categorie}', '{$editeur}', '{$collection}', '{$sommaire}', '{$parution}', '{$quantite}', '{$time}', '0', '', '', '', '{$pretautorise}' ");

		if(!$nid || !$sql -> db_Select("library", "library_id", "library_titre='{$titre}'")){
      $ns->tablerender("", BIBLIO_AJOUT_ERROR_TEXT);
      require_once(FOOTERF);exit;}                  //CHANGER POUR EMPLOYER LE PARSETEMPLATE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			// ==========================================================
		$title = $titre;  //PAS VRAIMENT UTILE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		header("location: ".e_SELF);exit;
  }
}
//...............end   SCRIPT update DB after post (second in order of appearance)...............
//...............start SCRIPT create form before post (first in order of appearance)...............
$rs = new form;
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
$text = $tp->parseTemplate($AJOUT_BODY, TRUE, $library_shortcodes);
$ns->tablerender(BIBLIO_AJOUT_TITLE, $text);
require_once(FOOTERF);exit;
//...............end   SCRIPT create form before post (first in order of appearance)...............
}else{
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_PERMISSION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_AJOUT_TITLE, $text);require_once(FOOTERF);exit;}
//++++++++++++++++++++++++++++++++++++++++++Fin Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//--------------------------Fin - Accès à la page d'AJOUT de documents-------------------------------------------
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////ÉDITION/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if ($e_QUERY[0] == "edit"){
//=========================Début - Accès à la page d'ÉDITION des documents=======================================
/*
Discussion : peut-être accéder par tous ? si on bloque l'édition de tous les champs pour les USER..
Script issue de ajout plus haut.
Script qui doit pouvoir reposter ses données afin de pallier les erreurs. 
(le défi semble réussi, reste à le vérifier dans toutes les situations)
*/
//++++++++++++++++++++++++++++++++++++Début Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if (!USER) {
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$text = $tp->parseTemplate($BIBLIO_PERMISSION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_EDIT_TITLE, $text);require_once(FOOTERF);exit;}
//++++++++++++++++++++++++++++++++++++++++++Fin Bloquage+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//...............start SCRIPT update DB after post (second in order of appearance)...............
$id = $e_QUERY[1]; 
if (isset($_POST['ac_liste'])){
	$titre = explode(' _ ',$_POST['ac_liste']);
	$sql->db_Select("library","library_id","library_titre='".$titre[0]."' AND library_soustitre='".$titre[1]."' ");
	while($row = $sql->db_Fetch()){
	$id = $row['library_id'];}
	}
if (isset($_POST['enregistrer_edition_documents']))
{
  ($_POST['categorie_text'])? $categorie = $tp -> toDB(strip_tags($_POST['categorie_text'])):$categorie = $tp -> toDB(strip_tags($_POST['categorie_edit']));
// ========== Start of verification.. ====================================================
      $error_message = "";
      require_once(e_HANDLER."message_handler.php");
      // Vérifie que le livre ne contient pas les caractères du AUTOCOMPLETE (voir section emprunt et ac_retrieve.php)
      if (strstr($_POST['titre'], "_") || strstr($_POST['soustitre'], "_") || strstr($_POST['titre'], ";") || strstr($_POST['soustitre'], ";"))
      { $error_message .= BIBLIO_AJOUT_ERROR_1;
  		$error = TRUE;  }
      // Check for emtpy fields
      if (trim($_POST['titre']) == "" || trim($_POST['auteur1']) == "")
      {$error_message .= BIBLIO_AJOUT_ERROR_4;$error = TRUE;}
      if (trim($categorie) == "")
      {$error_message .= BIBLIO_AJOUT_ERROR_5;$error = TRUE;}

      if($error_message)	{		message_handler("P_ALERT", $error_message);	}
// ========== End of verification.. ====================================================
	if (!$error)
	{
    //$categorie posté plus haut afin de vérifier le champs saisi et créer une nouvelle catégorie si demandé.
		$pretautorise = $tp -> toDB(strip_tags($_POST['pretautorise']));
		$isbn = $tp -> toDB(strip_tags($_POST['isbn']));
 		$titre = $tp -> toDB(strip_tags($_POST['titre']));
 		$soustitre = $tp -> toDB(strip_tags($_POST['soustitre']));
		$auteur1 = $tp -> toDB(strip_tags($_POST['auteur1']));		$auteur2 = $tp -> toDB(strip_tags($_POST['auteur2']));		$auteur3 = $tp -> toDB(strip_tags($_POST['auteur3']));		$auteur4 = $tp -> toDB(strip_tags($_POST['auteur4']));		$auteur5 = $tp -> toDB(strip_tags($_POST['auteur5']));
 		$editeur = $tp -> toDB(strip_tags($_POST['editeur']));
 		$collection = $tp -> toDB(strip_tags($_POST['collection']));
 		$sommaire = $tp -> toDB(strip_tags($_POST['sommaire']));
 		$parution = $tp -> toDB(strip_tags($_POST['parution']));
 		$quantite = $tp -> toDB(strip_tags($_POST['quantite']));

    if(check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])){
      $uid = $sql->db_Update("library", "library_isbn='{$isbn}', library_auteur1='{$auteur1}', library_auteur2='{$auteur2}', library_auteur3='{$auteur3}', library_auteur4='{$auteur4}', library_auteur5='{$auteur5}', library_titre='{$titre}', library_soustitre='{$soustitre}', library_categorie='{$categorie}', library_editeur='{$editeur}', library_collection='{$collection}', library_sommaire='{$sommaire}', library_anneeparu='{$parution}', library_exemplaire='{$quantite}', library_pretautorise='{$pretautorise}'  WHERE library_id='{$id}'");
    }else{
		  $uid = $sql->db_Update("library", "library_sommaire='{$sommaire}' WHERE library_id='{$id}'");
    }
		if(!$uid || !$sql -> db_Select("library", "library_id", "library_titre='{$titre}'")){
		  $ns->tablerender("", BIBLIO_EDIT_ERROR_1);
      require_once(FOOTERF);exit;}                  //CHANGER POUR EMPLOYER LE PARSETEMPLATE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			// ==========================================================
		$title = $titre;  //PAS VRAIMENT UTILE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		header("location: ".e_SELF."?edit.".$id);exit;
	}
}
//...............end   SCRIPT update DB after post (second in order of appearance)...............
//...............start SCRIPT create form before post (first in order of appearance)...............
if (isset($_POST['enregistrer_edition_documents']))
{
    $_POST['id'] = $id;
  $rs = new form;
  if(check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])){
    $text = $tp->parseTemplate($BIBLIO_EDITION, TRUE, $library_shortcodes);
	}else{
    $text = $tp->parseTemplate($BIBLIO_EDITION_USER, TRUE, $library_shortcodes);
  }   //RAJOUTER UN ELSEIF ICI POURRAIT PERMETTRE D'EMPLOYER CETTE FEUILLE COMME LE DÉTAILS DU VISITEUR....... SAIS PAS....!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$ns->tablerender(BIBLIO_EDIT_TITLE, $text);
  require_once(FOOTERF);exit;

}else{
	$_POST['id'] = $id;
	$sql -> db_Select("library","*","library_id = '$id'");
	while($row = $sql->db_Fetch())
	{	$_POST['pretautorise'] = $tp -> toHTML($row[library_pretautorise]);
		$_POST['categorie_edit'] = $row[library_categorie];
		$_POST['isbn'] = $tp -> toHTML($row[library_isbn]);
	    $_POST['titre'] = $row[library_titre];
	    $_POST['soustitre'] = $row[library_soustitre];
	    $_POST['auteur1'] = $row[library_auteur1];		$_POST['auteur2'] = $row[library_auteur2];		$_POST['auteur3'] = $row[library_auteur3];		$_POST['auteur4'] = $row[library_auteur4];		$_POST['auteur5'] = $row[library_auteur5];
	    $_POST['editeur'] = $row[library_editeur];
	    $_POST['collection'] = $row[library_collection];
	    $_POST['sommaire'] = $row[library_sommaire];
	    $_POST['parution'] = $row[library_anneeparu];
	    $_POST['quantite'] = $row[library_exemplaire];
	}
	$rs = new form;
	if(check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])){
		$text = $tp->parseTemplate($BIBLIO_EDITION, TRUE, $library_shortcodes);
	}else{
		$text = $tp->parseTemplate($BIBLIO_EDITION_USER, TRUE, $library_shortcodes);
	}   //RAJOUTER UN ELSEIF ICI POURRAIT PERMETTRE D'EMPLOYER CETTE FEUILLE COMME LE DÉTAILS DU VISITEUR....... SAIS PAS....!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$option = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);
	$ns->tablerender(BIBLIO_OPTION_WELCOME, $option);
	$ns->tablerender(BIBLIO_EDIT_TITLE, $text);
	require_once(FOOTERF);exit;
}
//...............end   SCRIPT create form before post (first in order of appearance)...............
//--------------------------Fin - Accès à la page d'ÉDITION des documents----------------------------------------
}

//               !!!!!!!!!!!!!!!!!!!!!!!!!!Fin du script!!!!!!!!!!!!!!!!!!!!
}else{ header("location:".e_BASE."index.php"); } //fin du bloquage global

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//===========================LISTE DES FONCTIONS EMPLOYÉES PAR LE SCRIPT=========================================

//--------------Fonction employée avec le script listeemprunt-----------------------------------------------
//--------------Énormément modifiée, provient de signup.php, pas sur qu'il fonctionne correctement
function render_email()
{
	global $pref,$nomlogin,$passwordrandom,$vrainom,$nid,$u_key,$_POST,$SIGNUPEMAIL_LINKSTYLE,$SIGNUPEMAIL_SUBJECT,$SIGNUPEMAIL_TEMPLATE;

	define("RETURNADDRESS", SITEURL."e107_plugins/library/library.php");       //ATTENTION À L'ADRESSE DU COURRIEL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	require_once("libraryemail_template.php");
	
	$inline_images = explode(",",$SIGNUPEMAIL_IMAGES);

	$ret['userid'] = $nid;      //à vérifier!!!
	$ret['cc'] = $SIGNUPEMAIL_CC;
	$ret['bcc'] = $SIGNUPEMAIL_BCC;
	$ret['attachments'] = $SIGNUPEMAIL_ATTACHMENTS;
	$ret['inline-images'] = implode(",",$inline_images);

	$style = ($SIGNUPEMAIL_LINKSTYLE) ? "style='$SIGNUPEMAIL_LINKSTYLE'" : "";

	$search[0] = "{LOGINNAME}";
	$replace[0] = $nomlogin;

	$search[1] = "{PASSWORD}";
	$replace[1] = $passwordrandom;

	$search[2] = "{LIEN_BIBLIO}";
	$replace[2] = "<a href='".RETURNADDRESS."' $style>".RETURNADDRESS."</a>";

	$search[3] = "{SITENAME}";
	$replace[3] = SITENAME;

	$search[4] = "{SITEURL}";
	$replace[4] = "<a href='".SITEURL."' $style>".SITEURL."</a>";

	$search[5] = "{USERNAME}";
	$replace[5] = $vrainom;

	$cnt=1;

	foreach($inline_images as $img)
	{
		if(is_readable($inline_images[$cnt-1]))
		{
			$cid_search[] = "{IMAGE".$cnt."}";
			$cid_replace[] = "<img alt=\"".SITENAME."\" src='cid:".md5($inline_images[$cnt-1])."' />\n";
			$path_search[] = "{IMAGE".$cnt."}";
			$path_replace[] = "<img alt=\"".SITENAME."\" src=\"".$inline_images[$cnt-1]."\" />\n";
		}
		$cnt++;
	}

	$subject = str_replace($search,$replace,$SIGNUPEMAIL_SUBJECT);
	$ret['subject'] =  $subject;

	$HEAD = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n";
	$HEAD .= "<html xmlns='http://www.w3.org/1999/xhtml' >\n";
	$HEAD .= "<head><meta http-equiv='content-type' content='text/html; charset=utf-8' />\n";
	$HEAD .= ($SIGNUPEMAIL_USETHEME == 1) ? "<link rel=\"stylesheet\" href=\"".SITEURL.THEME.$pref['themecss']."\" type=\"text/css\" />\n" : "";
	if($SIGNUPEMAIL_USETHEME == 2)
	{
		$CSS = file_get_contents(THEME.$pref['themecss']);
		$HEAD .= "<style>\n".$CSS."\n</style>";
	}

	$HEAD .= "</head>\n";
	if($SIGNUPEMAIL_BACKGROUNDIMAGE)
	{
		$HEAD .= "<body background=\"cid:".md5($SIGNUPEMAIL_BACKGROUNDIMAGE)."\" >\n";
	}
	else
	{
		$HEAD .= "<body>\n";
	}
	$FOOT = "\n</body>\n</html>\n";

	$SIGNUPEMAIL_TEMPLATE = $HEAD.$SIGNUPEMAIL_TEMPLATE.$FOOT;
	$message = str_replace($search,$replace,$SIGNUPEMAIL_TEMPLATE);

	$ret['message'] = str_replace($cid_search,$cid_replace,$message);
	$ret['preview'] = str_replace($path_search,$path_replace,$message);

	return $ret;
}

//================================================================================================================
?>
