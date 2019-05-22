<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/library_prefs.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:16:15 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
#$WYSIWYG = $pref['wysiwyg'];
#$e_wysiwyg = "courriel_retard1,courriel_retard2,courriel_retard3"; // commas seperated list of textareas to use wysiwyg with.

$lan_file	= e_PLUGIN."library/languages/".e_LANGUAGE.".php";
require_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."library/languages/English.php"));


    $preftitle = PAGE_NAME." - ".BIBLIO_ADMIN_7;
	  $pageid = "prefs";

if(check_class($pref['library_gestionemprunt']) || ADMIN){
// Preference 1 using radio options.
    $prefcapt[] = BIBLIO_ADMIN_8;
    $prefname[] = "library_gestionemprunt_second";
    $preftype[] = "accesstable";
    $prefvalu[] = "";

    $prefcapt[] = BIBLIO_ADMIN_9;
    $prefname[] = "library_membre";
    $preftype[] = "accesstable";
    $prefvalu[] = "";

    $prefcapt[] = BIBLIO_ADMIN_10;
    $prefname[] = "library_perm_emprunt";
    $preftype[] = "checkbox";
    $prefvalu[] = "1";

    $prefcapt[] = BIBLIO_ADMIN_11;
    $prefname[] = "library_perm_retour";
    $preftype[] = "checkbox";
    $prefvalu[] = "1";

    $prefcapt[] = BIBLIO_ADMIN_12;
    $prefname[] = "library_perm_listeemprunt";
    $preftype[] = "checkbox";
    $prefvalu[] = "1";

    $prefcapt[] = BIBLIO_ADMIN_13;
    $prefname[] = "library_perm_ajout";
    $preftype[] = "checkbox";
    $prefvalu[] = "1";

    $prefcapt[] = BIBLIO_ADMIN_14;
    $prefname[] = "library_user_edit_summary";
    $preftype[] = "checkbox";
    $prefvalu[] = "1";

    $prefcapt[] = BIBLIO_ADMIN_15;
    $prefname[] = "library_nb_emprunt_max";
    $preftype[] = "text";
    $prefvalu[] = "";

    $prefcapt[] = BIBLIO_ADMIN_16;
    $prefname[] = "library_duree_emprunt";
    $preftype[] = "text_date";
    $prefvalu[] = "";

    $prefcapt[] = BIBLIO_ADMIN_17;
    $prefname[] = "library_edit_message";
    $preftype[] = "textarea";
    $prefvalu[] = BIBLIO_ADMIN_18;

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

require_once(e_PLUGIN."library/library_shortcodes.php");
include_once(e_PLUGIN."library/library_template.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(HEADERF);


if(IsSet($_POST['updatesettings'])){
	$count = count($prefname);
	for ($i=0; $i<$count; $i++) {
		$namehere = $prefname[$i];
		$pref[$namehere] = $_POST[$namehere];
//    echo $namehere." = ".$_POST[$namehere]."<br>";
//    echo $namehere." = ".$datevalue;
	};
	save_prefs();
	$message .= BIBLIO_ADMIN_4;
}
/*
if(IsSet($_POST['updatemembre'])){

update_poste_supress('Permanence&nbsp;library','perm',$pref['library_gestionemprunt_second']);
update_poste('Permanence&nbsp;library','perm',$pref['library_gestionemprunt_second']);
        $message .= "Les permanents enregistrés ont désormais accès au système de gestion des emprunts.";
}
if(IsSet($_POST['updatecourriel'])){
$sql -> db_Update("library_mail","library_message='".$_POST['courriel_retard1']."' WHERE library_mail_id='1'");
$sql -> db_Update("library_mail","library_message='".$_POST['courriel_retard2']."' WHERE library_mail_id='2'");
$sql -> db_Update("library_mail","library_message='".$_POST['courriel_retard3']."' WHERE library_mail_id='3'");
$message .= "Les messages ont été enregistrés.";
}
*/
if($message){
        $ns -> tablerender("OK", "<div style='text-align:center'><b>$message</b></div>");
}

//option table, classique
$text = $tp->parseTemplate($BIBLIO_OPTION, TRUE, $library_shortcodes);

//reder of the prefs, tentative core !
#require_once(e_HANDLER."form_handler.php");
#$rs = new form;


//render of the prefs
require_once("form_handler.php");
$ry = new custom_form;
$text .= "<div style='text-align:center'>
<form method='post' action='".e_SELF."'>
<table style='width:94%' class='fborder'>";

$form_completed_rewrite = array('textarea','text');
for ($i=0; $i<count($prefcapt); $i++) {
	$text .="
		<tr>
		<td style='width:30%; vertical-align:top' class='forumheader3'>".$prefcapt[$i].":</td>
		<td style='width:70%' class='forumheader3'>";
	if(in_array($preftype[$i], $form_completed_rewrite)){
		$prefvalu[$i] = ($pref[$prefname[$i]] ? $pref[$prefname[$i]] : $prefvalu[$i]);
		if($preftype[$i] == 'text'){
			$text .= $rs->form_text($prefname[$i], 12,  ($_POST[$prefname[$i]] ? $_POST[$prefname[$i]] : $prefvalu[$i]), 13);
		}elseif($preftype[$i] == 'textarea'){
			$text .= $rs->form_textarea($prefname[$i], '100%', 5, ($_POST[$prefname[$i]] ? $_POST[$prefname[$i]] : $prefvalu[$i]));
		}
	}else{

        $form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
        $name = $prefname[$i];
        $text .= $ry->  user_extended_element_edit($form_send,$pref[$name],$name);
	}
	$text .="</td></tr>";
};
    $text .="<tr style='vertical-align:top'>
    <td colspan='2'  style='text-align:center' class='forumheader'>
    <input class='button' type='submit' name='updatesettings' value='".BIBLIO_ADMIN_5."' />
    </td>
    </tr>
    </table>
    </form>
    </div>";
  $ns -> tablerender($preftitle, $text);

/* ----Gestion des membres du sous-groupe---
$membre .= "
    <div style='text-align:center'>
    <form method='post' action='".e_SELF."'>
    <table style='width:94%' class='fborder'>";
    
$membre .= update_poste_form('Permanence&nbsp;library','perm',10,TRUE);

    $membre .="
      <tr style='vertical-align:top'>
        <td colspan='2'  style='text-align:center' class='forumheader'>
          <input class='button' type='submit' name='updatemembre' value='Enregistrer les responsables' />
        </td>
      </tr>
    </table>
    </form>
    </div>";
  $ns -> tablerender('Membres du groupe Permanence library :', $membre);
*/
/* ---Mail messages ---
$sql -> db_Select("library_mail","*","");
while($row = $sql -> db_Fetch())
  {
  $courrier[]=$row[library_message];
  }
$mail .= "
    <div style='text-align:center'>
    <form method='post' action='".e_SELF."'>
    <table style='width:94%' class='fborder'>
    <tr>
        <td style='width:30%; vertical-align:middle' class='forumheader3'>Premier courriel de rappel :</td>
        <td style='width:70%' class='forumheader3'>
<textarea class='tbox' id='courriel_retard1' name='courriel_retard1' cols='70' style='width:100%' rows='15' >$courrier[0]</textarea>
      </td>
    </tr>
    <tr>
        <td style='width:30%; vertical-align:middle' class='forumheader3'>Deuxième courriel de rappel :</td>
        <td style='width:70%' class='forumheader3'>
<textarea class='tbox' id='courriel_retard2' name='courriel_retard2' cols='70' style='width:100%' rows='15' >$courrier[1]</textarea>
      </td>
    </tr>
    <tr>
        <td style='width:30%; vertical-align:middle' class='forumheader3'>Troisième courriel de rappel :</td>
        <td style='width:70%' class='forumheader3'>
<textarea class='tbox' id='courriel_retard3' name='courriel_retard3' cols='70' style='width:100%' rows='15' >$courrier[2]</textarea>
      </td>
    </tr>
      <tr style='vertical-align:top'>
        <td colspan='2'  style='text-align:center' class='forumheader'>
          <input class='button' type='submit' name='updatecourriel' value='Enregistrer les messages' />
        </td>
      </tr>
    </table>
    </form>
    </div>";
  $ns -> tablerender('Courriel envoyé aux retardataires (pas encore fonctionnel, mais vous pouvez les préparer...) :', $mail);
*/
  require_once(FOOTERF);exit;



}else{
	$text = $tp->parseTemplate($BIBLIO_OPTION.$BIBLIO_PERMISSION, TRUE, $library_shortcodes);
	$ns -> tablerender($preftitle, $text);   require_once(FOOTERF);exit;
}
//====================================================FONCTIONS!! -- non-utilisé pour l'instant, à réviser
/*
function update_poste_supress($poste,$nom_var,$groupe){
//FONCTION POUR UPDATER LA DATABASE
//Doit être écrit : update_poste('Président','president',7); où 7 est l'id du groupe d'usager, où 'president' est la variable reprise dans la fonction update_poste_form()
  global $sql,$sql2,$tp;
//Enlève le poste et le rajoute à l'historique de ceux qui ne sont plus mandaté. -le groupe d'usager.
  $sql->db_Select("user_extended","user_extended_id,user_details,user_mandat","find_in_set('".$tp->toDB($poste)."',user_mandat) ORDER by user_extended_id");
      while($row = $sql-> db_Fetch())
      {
        if(!in_array($row['user_extended_id'],$_POST[$nom_var]))
        {
          //ajouter l'historique une seule fois.
            if($row['user_details'] != ""){$ajout_poste = explode(",",$row['user_details']);}
            $ajout_poste = array_merge($ajout_poste,$tp->toDB($poste));
            $ajout_poste = implode(",",array_unique($ajout_poste));
            $sql2->db_Update("user_extended", "user_details='$ajout_poste' WHERE user_extended_id='".$row[user_extended_id]."' ");
          //enlever le mandat quand plus associée
          $diff_mandat = explode(",",$row['user_mandat']);
          $key = array_search($poste, $diff_mandat);  
          unset($diff_mandat[$key]);  
          $diff_mandat = implode(",",$diff_mandat);
          $sql2->db_Update("user_extended","user_mandat='$diff_mandat' WHERE user_extended_id='".$row[user_extended_id]."'");
          //enlever le groupe quand plus associée
          $sql2->db_Select("user","user_class","user_id = ".$row['user_extended_id']." ");
            while($row2 = $sql2-> db_Fetch())
            { 
              $diff_class = explode(",",$row2['user_class']);
              foreach ($diff_class as $key=>$value) {
              	if($value == $groupe){unset($diff_class[$key]);}
              }
              $diff_class = implode(",",$diff_class);
              $sql2->db_Update("user","user_class='$diff_class' WHERE user_id='".$row[user_extended_id]."'");
            }
        }
      }
}
function update_poste($poste,$nom_var,$groupe){
//FONCTION POUR UPDATER LA DATABASE
//Doit être écrit : update_poste('Président','president',7); où 7 est l'id du groupe d'usager, où 'president' est la variable reprise dans la fonction update_poste_form()
  global $sql,$sql2,$tp;
//Ajoute le poste. +le groupe d'usager.
  $id_poste = implode(",",$_POST[$nom_var]);
  $sql->db_Select("user_extended","user_extended_id,user_details,user_mandat","find_in_set(user_extended_id,'".$id_poste."') ");
      while($row = $sql-> db_Fetch())
      {
          //ajouter le nouveau mandat
          unset($ajout_poste);
          if($row['user_mandat'] != ""){$ajout_poste = explode(",",$row['user_mandat']);}
          $ajout_poste = array_merge($ajout_poste,$tp->toDB($poste));
          $ajout_poste = array_unique($ajout_poste);
          $ajout_poste = implode(",",$ajout_poste);
          $sql2->db_Update("user_extended","user_mandat='$ajout_poste' WHERE user_extended_id='".$row[user_extended_id]."'");
          //ajouter le nouveau groupe
          unset($ajout_class);
          $sql2->db_Select("user","user_class","user_id = ".$row['user_extended_id']." ");
            while($row2 = $sql2-> db_Fetch())
            { 
              if($row2['user_class'] != ""){$ajout_class = explode(",",$row2['user_class']);}
              $ajout_class = array_merge($ajout_class,$groupe);
              $ajout_class = array_unique($ajout_class);
              $ajout_class = implode(",",$ajout_class);
              $sql2->db_Update("user","user_class='$ajout_class' WHERE user_id='".$row[user_extended_id]."'");
            }
      }
}

function update_poste_form($poste,$nom_var,$quantite,$add = FALSE){
//FONCTION POUR LA TEMPLATE!
//Doit être écrit : update_poste('Président','president');    où 'president' est la variable reprise dans la fonction update_poste_form()
unset($expand);
unset($expand2);
unset($quantite_enregistre);
unset($j);
  global $sql,$sql2,$tp,$pref;
$quantite_enregistre = $sql->db_Count("user_extended","(*)","WHERE find_in_set('".$poste."',user_mandat)");  
($quantite_enregistre == '0') ? $quantite_enregistre = '1' : "";
for ($i=1; $i<=$quantite_enregistre; $i++) {
  $j = $quantite_enregistre+1;
  if($add && $i == $quantite_enregistre){$expand = "
      <span onclick='expandit(\"".$nom_var.$j."\");' style='vertical-align:middle; cursor: pointer; cursor: hand' title=''>
      <img src='".e_PLUGIN."library/plus.png' style='width:12px; height:12px' alt='' /></span>";}
  $ret .="
  <tr>
    <td class='forumheader3' style='width:30%;white-space:nowrap' >
      ".$poste." $expand
      
    </td>
    <td class='forumheader3' style='width:70%'>
      <select name='".$nom_var."[]' class='tbox'>
      <option>Liste de tous les inscrits (membres &amp; retardataire)</option>";
      $sql->db_Select("user", "user_id, user_login, user_name", "find_in_set('3',user_class) || find_in_set('4',user_class) || find_in_set('".$pref['arcur_cotisation_retard']."',user_class) ");
        while ($membre = $sql-> db_Fetch())
        {
        	$sql2->db_Select("user_extended","user_mandat","user_extended_id='".$membre['user_id']."' ");
        	while($row = $sql2->db_Fetch()){
          	if(ereg($poste,$row['user_mandat']) && !in_array($membre['user_id'],$liste_id[$i-1]))
            {$sel = "selected='selected'";
             $liste_id[$i] = array_merge($membre['user_id'],$liste_id[$i-1]);
            }
            else
            {$sel = "";
            }
          }
            $ret .= "<option value='".$membre['user_id']."' $sel>".$membre['user_login']." (".$membre['user_name'].")</option>";
        }
      $ret .= "</select>  
    </td>
  </tr>
  ";
}
  if($add){
  $ret .= new_poste_form($poste,$nom_var,$quantite);
  }
return $ret;
}

function new_poste_form($poste,$nom_var,$quantite){
//FONCTION POUR LA TEMPLATE!
//Doit être écrit : update_poste('Président','president');    où 'president' est la variable reprise dans la fonction update_poste_form()
  global $sql,$sql2,$tp,$pref;
$quantite_enregistre = $sql->db_Count("user_extended","(*)","WHERE find_in_set('".$poste."',user_mandat)");  
($quantite_enregistre == '0') ? $quantite_enregistre = '1' : "";
for ($i=$quantite_enregistre+1; $i<=$quantite+$quantite_enregistre; $i++) {
  unset($dis);
  $j = $i+1;
  if($i != $quantite+$quantite_enregistre){$expand2 = "<span onclick='expandit(\"".$nom_var.$j."\");' style='vertical-align:middle; cursor: pointer; cursor: hand' title=''>
      <img src='".e_PLUGIN."library/plus.png' style='width:12px; height:12px' alt='' /></span>";}
      else{$expand2 = "";}
  $ret .="
  <tr id='".$nom_var.$i."' style='display: none'>
    <td class='forumheader3' style='width:30%;white-space:nowrap' >
      ".$poste." $expand2
      
      

    </td>
    <td class='forumheader3' style='width:70%'>
      <select name='".$nom_var."[]' class='tbox'>
      <option>Liste de tous les inscrits (membres &amp; retardataire)</option>";
      $sql->db_Select("user", "user_id, user_login, user_name", "find_in_set('3',user_class) || find_in_set('4',user_class) || find_in_set('".$pref['arcur_cotisation_retard']."',user_class) ");
        while ($membre = $sql-> db_Fetch())
        {
            $ret .= "<option value='".$membre['user_id']."' $sel>".$membre['user_login']." (".$membre['user_name'].")</option>";
        }
      $ret .= "</select>  
    </td>
  </tr>
  ";
}
return $ret;
}
*/
?>
