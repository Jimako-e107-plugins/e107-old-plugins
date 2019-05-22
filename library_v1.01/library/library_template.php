<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/library_template.php,v $
|     $Revision: 1.2 $
|     $Date: 2007/01/21 10:37:20 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:100%"); }

//template apparaissant au-dessus de toutes les pages.
if(!defined($BIBLIO_OPTION)){
$BIBLIO_OPTION = "
<div id='option' style='text-align: right;'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
  <td class='forumheader3' rowspan='2'>
{MEMBRE_EMPRUNT}<br />
{CHECK_CLASS_BIBLIO}
  </td>
  <td class='fcaption' style='white-space:nowrap'>
  ".BIBLIO_OPTION_1."
  </td>
</tr>
<tr>
  <td class='forumheader3' style='white-space:nowrap'>
<ul> 
 <li>  <a href='library.php?notice'><strong>".BIBLIO_NOTICE_1."</strong><br /></a></li>
 <li>  <a href='library.php?emprunt'>".BIBLIO_OPTION_2."<br /></a></li>
 <li> <a href='library.php?retour'>".BIBLIO_OPTION_3."<br /></a></li>
 <li> <a href='library.php?listeemprunt'>".BIBLIO_OPTION_4."<br /></a></li>
 <li> <a href='library.php?ajout'>".BIBLIO_OPTION_5."<br /></a></li>
 <li> <a href='library_prefs.php'>".BIBLIO_OPTION_6."</a></li>
</ul>  </td>
</tr>
</table>


<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
  <td class='fcaption' style='white-space:nowrap'><form action='library.php' method='post' id='categorie_form'>
    ".BIBLIO_OPTION_7."{SI_CATEGORIE}&nbsp;&nbsp;&nbsp;
	<select class='tbox' id='categorie' name='categorie' onchange='this.form.submit()'>{LISTE_CATEGORIE}
    <option value='*'>".BIBLIO_OPTION_CAT_ALL."</option>
    </select></form>
  </td>
  <td  class='fcaption' style='width:262px;white-space:nowrap'>
    {AUTOCOMPLETE_RECHERCHE_TITRE}
  </td>
</tr>
</table>
</div>
";}
require_once(e_HANDLER."userclass_class.php");
$library_admin1 = r_userclass_name($pref['library_gestionemprunt']);
$library_admin2 = r_userclass_name($pref['library_gestionemprunt_second']);
$library_membre = r_userclass_name($pref['library_membre']);
// $pref['library_gestionemprunt']
if(!defined($BIBLIO_NOTICE)){
$BIBLIO_NOTICE = "
<div id='notice'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
  <tr>
    <td class='fcaption' style='white-space:nowrap;text-align:center' colspan='2'>".BIBLIO_NOTICE_2." :
    </td>
  </tr>
{FIRST_TABLE}".BIBLIO_NOTICE_3."
{OPEN2}{$library_admin1}<br />{$library_admin2}
{OPEN1}".BIBLIO_NOTICE_4."
{OPEN2}{$library_membre}
{OPEN1}".BIBLIO_NOTICE_5."
{OPEN2}".$pref['library_nb_emprunt_max']." ".BIBLIO_NOTICE_6."
{OPEN1}".BIBLIO_NOTICE_7."
{OPEN2}{DUREE_DISPLAY} ".BIBLIO_NOTICE_8."
  <tr>
    <td class='forumheader' style='border-right:none;white-space:nowrap;text-align:left' colspan='2'>".BIBLIO_NOTICE_9."
{OPEN1}".BIBLIO_NOTICE_10."
{OPEN2}{EMPRUNT_OUINON}
{OPEN1}".BIBLIO_NOTICE_11."
{OPEN2}{RETOUR_OUINON}
{OPEN1}".BIBLIO_NOTICE_12."
{OPEN2}{LISTE_OUINON}
{OPEN1}".BIBLIO_NOTICE_13."
{OPEN2}{AJOUT_OUINON}
{OPEN1}
{OPEN2}
{LAST_TABLE}
</table>
</div>
<br />
<br />
";
$lan_notice_file	= e_PLUGIN."library/languages/".e_LANGUAGE."_notice.php";
require_once((file_exists($lan_notice_file) ? $lan_notice_file : e_PLUGIN."library/languages/English_notice.php"));
$BIBLIO_NOTICE .= $notice_complete;
}

//Template de la page de renvoi (permissions insuffisantes)
if(!defined($BIBLIO_PERMISSION)){
$BIBLIO_PERMISSION = "
<div id='library_permission'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='white-space:nowrap'>".BIBLIO_PERMISSION_2."
</td></tr><tr>
<td class='forumheader3' style='white-space:nowrap'>
".BIBLIO_PERMISSION_1."
</td></tr></table>
</div>
";}

//Template de la page d'édition des documents pour les utilisateurs, voir les détails, changer le sommaire.
//CETTE SECTION EST COMPLETEMENT À REFAIRE!!!!!
if(!defined($BIBLIO_EDITION_USER)){
$BIBLIO_EDITION_USER = "
{EDITION_FORM_OPEN}
<div id='edtion_doc'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_EDIT_2." {DOCUMENT_NAME}
</td></tr></table>
<table class='fborder' style='".USER_WIDTH."'>
{FIRST_TABLE}".BIBLIO_AJOUT_3."
{OPEN2}{CATEGORIE_USER}
{OPEN1}".BIBLIO_AJOUT_4."
{OPEN2}{PRET_AUTORISE}
{OPEN1}".BIBLIO_AJOUT_5."
{OPEN2}{AJOUT_ISBN}
{OPEN1}".BIBLIO_AJOUT_6."
{OPEN2}{AJOUT_TITRE}
{OPEN1}".BIBLIO_AJOUT_7."
{OPEN2}{AJOUT_SOUSTITRE}
{OPEN1}".BIBLIO_AJOUT_8."
{OPEN2}{AUTEURS_USER}
{OPEN1}".BIBLIO_EDIT_9."
{OPEN2}{AJOUT_EDITEUR}
{OPEN1}".BIBLIO_EDIT_10."
{OPEN2}{AJOUT_COLLECTION}
{OPEN1}".SUMMARY."
{OPEN2}{AJOUT_SOMMAIRE}
{OPEN1}".BIBLIO_EDIT_11."
{OPEN2}{AJOUT_PARUTION}
{OPEN1}".BIBLIO_EDIT_12."
{OPEN2}{AJOUT_QUANTITE}
{LAST_TABLE}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2'  style='text-align:center'>
<INPUT TYPE='hidden' name='id' VALUE='".$_POST['id']."' />
<input class='button' type='submit' name='enregistrer_edition_documents' value='".BIBLIO_EDIT_3."' />
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
";}

//Template de la page d'édition des documents des gestionnaires
$img_style_plus = "<img src='".e_PLUGIN."library/plus.png' style='vertical-align:middle; cursor: pointer; width: 12px; height: 12px' alt='".BIBLIO_AJOUT_1."' title='".BIBLIO_AJOUT_1."' /> ";
if(!defined($BIBLIO_EDITION)){
$BIBLIO_EDITION = "
{EDITION_FORM_OPEN}
<div id='edtion_doc'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_EDIT_2." {DOCUMENT_NAME}
</td></tr></table>
<table class='fborder' style='".USER_WIDTH."'>
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
".$tp->toHTML($pref['library_edit_message'])."
</td>
</tr>
{FIRST_TABLE}".CATEGORY."{CHAMPS_REQUIS}:
{OPEN2}<select class='tbox' id='categorie_edit' name='categorie_edit'>{LISTE_CATEGORIE}</select> &nbsp;&nbsp;&nbsp;<input class='button' type ='button' value='".BIBLIO_EDIT_4."' onclick='expandit(\"categorie_text_form\");' />
<div id='categorie_text_form' style='display: none'>
{AJOUT_CATEGORIE_TEXT}<span class='smalltext'>".BIBLIO_EDIT_5."</span>
</div>
{OPEN1}".BIBLIO_AJOUT_4."
{OPEN2}{AJOUT_PRETAUTORISE}
{OPEN1}".BIBLIO_AJOUT_5."
{OPEN2}{AJOUT_ISBN}<span class='smalltext'>".BIBLIO_EDIT_6."</span>
{OPEN1}".TITLE."{CHAMPS_REQUIS}:
{OPEN2}{AJOUT_TITRE}
{OPEN1}".SUBTITLE." :
{OPEN2}{AJOUT_SOUSTITRE}
{OPEN1}".AUTHOR."(s){CHAMPS_REQUIS}: &nbsp;<span class='smalltext'>(<u><strong>".BIBLIO_EDIT_7."</strong></u> &amp; ".BIBLIO_EDIT_8.")</span>
{OPEN2}
	{AJOUT_AUTEUR1}
	<span class='smalltext' onclick='expandit(\"auteurs1\");' style='vertical-align:middle; cursor: pointer' title='".BIBLIO_AJOUT_1."'>
		".$img_style_plus.BIBLIO_AJOUT_2."
	</span>
	<div id='auteurs1' style='display: none'>
		<span class='smalltext' onclick='expandit(\"auteurs2\");' style='vertical-align:middle; cursor: pointer'  title='".BIBLIO_AJOUT_1."'>
		{AJOUT_AUTEUR2}
		".$img_style_plus.BIBLIO_AJOUT_2."
		</span>
		<div id='auteurs2' style='display: none'>
			<span class='smalltext' onclick='expandit(\"auteurs3\");' style='vertical-align:middle; cursor: pointer' title='".BIBLIO_AJOUT_1."' >
			{AJOUT_AUTEUR3} 
			".$img_style_plus.BIBLIO_AJOUT_2."
			</span>
			<div id='auteurs3' style='display: none'>
				<span class='smalltext' onclick='expandit(\"auteurs4\");' style='vertical-align:middle; cursor: pointer' title='".BIBLIO_AJOUT_1."' >
				{AJOUT_AUTEUR4} 
				".$img_style_plus.BIBLIO_AJOUT_2."
				</span>
				<div id='auteurs4' style='display: none'>
					{AJOUT_AUTEUR5}
				</div id='auteurs4'>
			</div id='auteurs3'>
		</div id='auteurs2'>
	</div id='auteurs1'>
{OPEN1}".BIBLIO_EDIT_9." :
{OPEN2}{AJOUT_EDITEUR}
{OPEN1}".BIBLIO_EDIT_10." :
{OPEN2}{AJOUT_COLLECTION}
{OPEN1}".SUMMARY." :
{OPEN2}{AJOUT_SOMMAIRE}
{OPEN1}".BIBLIO_EDIT_11." :
{OPEN2}{AJOUT_PARUTION}
{OPEN1}".BIBLIO_EDIT_12." :
{OPEN2}{AJOUT_QUANTITE}
{LAST_TABLE}

<tr style='vertical-align:top'>
<td class='forumheader' colspan='2'  style='text-align:center'>
<input class='button' type='submit' name='enregistrer_edition_documents' value='".BIBLIO_EDIT_3."' />
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
";}

//Template de la page liste des documents
if(!defined($BIBLIO_LISTE)){
$BIBLIO_LISTE = "
<div id='liste_documents'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
{LISTE_DOCUMENTS}
</table>
</div>
";}


//Template de la page liste de tous les emprunts
if(!defined($BIBLIO_EMPRUNTEUR)){
$BIBLIO_EMPRUNTEUR = "
<div id='liste_emprunteur'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' colspan='5' style='width:100%; white-space:nowrap'>".BIBLIO_LISTEMPRUNT_1."
</td></tr></table>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
{LISTE_EMPRUNTEUR}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='5' style='text-align:center'>
<br />
</td>
</tr>
</table>
</div>
";}


//Template de la page de query des emprunteurs (1ere page des retours de documents)
if(!defined($RETOUR_EMPRUNTEUR)){
$RETOUR_EMPRUNTEUR = "
{RETOUR_FORM_OPEN}
<div id='retour_emprunteur_form'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_RETOUR_4."
</td></tr></table>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
{FIRST_TABLE}".BIBLIO_RETOUR_5."
{OPEN2}{RETOUR_EMPRUNTEUR}
{OPEN1}".BIBLIO_RETOUR_6."
{OPEN2}
<input class='button' type='submit' id='retour_sans_emprunteur' name='retour_sans_emprunteur' value='".BIBLIO_RETOUR_7."' />
{LAST_TABLE}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
";}

//Template de la page retour (2e page des retours de documents)
if(!defined($RETOUR_BODY)){
$RETOUR_BODY = "
{RETOUR_FORM_OPEN}
<div id='retour'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_RETOUR_4."
</td></tr></table>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
{FIRST_TABLE}".BIBLIO_LIST_9." :
{OPEN2}{NOM_EMPRUNTEUR_RETOUR}<input type='hidden' name='emprunteur' value='".$_POST['retour_emprunteur']."' />
{OPEN1}".BIBLIO_RETOUR_8."<br />
{OPEN2}{RETOUR_LISTE_EMPRUNT}
{LAST_TABLE}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
<input class='button' type='submit' name='emprunt' value='".BIBLIO_RETOUR_9."' />
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
";}
//Template de la page retour (2e page des retours de documents) - sans connaître l'emprunteur
if(!defined($RETOUR_BODY_SANS_EMPRUNTEUR)){
$RETOUR_BODY_SANS_EMPRUNTEUR = "
{RETOUR_FORM_OPEN}
<div id='retour'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_RETOUR_4."
</td></tr></table>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
{FIRST_TABLE}".BIBLIO_RETOUR_8." :<br /><br /><span class='smalltext'>".BIBLIO_RETOUR_10."</span>
{OPEN2}{RETOUR_LISTE_EMPRUNT_SANS_EMPRUNTEUR}
{LAST_TABLE}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
<input class='button' type='submit' name='retour_sans_emprunteur' id='retour_sans_emprunteur' value='".BIBLIO_RETOUR_9."' />
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
";}
//Template de la page final des retours (3e page des retours de documents)
if(!defined($RETOUR_FIN)){
$RETOUR_FIN = "
<div id='retourfin'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_RETOUR_4."
</td></tr></table>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='forumheader3' colspan='2' style='width:100%;white-space:nowrap;text-align:center'>".BIBLIO_RETOUR_11."
{OPEN1}{RETOUR_RESTEENCORE}
{OPEN2}{RETOUR_LISTERESTEENCORE}
{LAST_TABLE}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
".BIBLIO_RETOUR_12."<br />
</td>
</tr>
</table>
</div>
";}

//Template de la page d'emprunt des documents
if(!defined($EMPRUNT_BODY)){
$EMPRUNT_BODY = "
{EMPRUNT_FORM_OPEN}
<div id='emprunt'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_EMPRUNT_2."
</td></tr></table>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
{FIRST_TABLE}".BIBLIO_LIST_9." :
{OPEN2}{EMPRUNT_EMPRUNTEUR}
{OPEN1}".BIBLIO_EMPRUNT_3."<br /><span class='smalltext'>".BIBLIO_EMPRUNT_4."</span>
{OPEN2}{AUTOCOMPLETE_EMPRUNT}<br /><br />
<span class='smalltext'>".BIBLIO_EMPRUNT_5."</span>
{LAST_TABLE}
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
<input class='button' type='submit' name='emprunt' value='".BIBLIO_EMPRUNT_6."' />
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
<br />
<div style='text-align:center'>
<table class='fborder' style='".USER_WIDTH."'>
{FIRST_TABLE}".BIBLIO_EMPRUNT_7."
{OPEN2}".BIBLIO_EMPRUNT_8."
<input class='button' type ='button' value='".BIBLIO_EMPRUNT_9."' onclick='expandit(this);' />
<div style='display: none; text-align:center'>
 {EMPRUNT_PRETNONAUTORISE}<br />
<div style='text-align:left'>".BIBLIO_EMPRUNT_10."</div>
</div>
{LAST_TABLE}
</table>
</div>
";}




//Template de la page d'ajout de nouveaux documents
if(!defined($AJOUT_BODY)){
$AJOUT_BODY = "
{AJOUT_FORM_OPEN}
<div id='ajout_doc'>
<table class='fborder' style='text-align:center;".USER_WIDTH."'>
<tr>
<td class='fcaption' style='width:100%; white-space:nowrap'>".BIBLIO_AJOUT_9."
</td></tr></table>
<table class='fborder' style='".USER_WIDTH."'>
<tr style='vertical-align:top'>
<td class='forumheader' colspan='2' style='text-align:center'>
".$tp->toHTML($pref['library_edit_message'])."
</td>
</tr>
{FIRST_TABLE}".CATEGORY."{CHAMPS_REQUIS}:
{OPEN2}<select class='tbox' id='categorie_edit' name='categorie_edit'>{LISTE_CATEGORIE}</select> &nbsp;&nbsp;&nbsp;<input class='button' type ='button' value='".BIBLIO_EDIT_4."' onclick='expandit(\"categorie_text_form\");' />
<div id='categorie_text_form' style='display: none'>
{AJOUT_CATEGORIE_TEXT}<span class='smalltext'>".BIBLIO_EDIT_5."</span>
</div>
{OPEN1}".BIBLIO_AJOUT_4."
{OPEN2}{AJOUT_PRETAUTORISE}
{OPEN1}".BIBLIO_AJOUT_5."
{OPEN2}{AJOUT_ISBN}<span class='smalltext'>".BIBLIO_EDIT_6."</span>
{OPEN1}".TITLE."{CHAMPS_REQUIS}:
{OPEN2}{AJOUT_TITRE}
{OPEN1}".SUBTITLE." :
{OPEN2}{AJOUT_SOUSTITRE}
{OPEN1}".AUTHOR."(s){CHAMPS_REQUIS}: &nbsp;<span class='smalltext'>(<u><strong>".BIBLIO_EDIT_7."</strong></u> &amp; ".BIBLIO_EDIT_8.")</span>
{OPEN2}
	{AJOUT_AUTEUR1}
	<span class='smalltext' onclick='expandit(\"auteurs1\");' style='vertical-align:middle; cursor: pointer' title='".BIBLIO_AJOUT_1."'>
		".$img_style_plus.BIBLIO_AJOUT_2."
	</span>
	<div id='auteurs1' style='display: none'>
		<span class='smalltext' onclick='expandit(\"auteurs2\");' style='vertical-align:middle; cursor: pointer'  title='".BIBLIO_AJOUT_1."'>
		{AJOUT_AUTEUR2}
		".$img_style_plus.BIBLIO_AJOUT_2."
		</span>
		<div id='auteurs2' style='display: none'>
			<span class='smalltext' onclick='expandit(\"auteurs3\");' style='vertical-align:middle; cursor: pointer' title='".BIBLIO_AJOUT_1."' >
			{AJOUT_AUTEUR3} 
			".$img_style_plus.BIBLIO_AJOUT_2."
			</span>
			<div id='auteurs3' style='display: none'>
				<span class='smalltext' onclick='expandit(\"auteurs4\");' style='vertical-align:middle; cursor: pointer' title='".BIBLIO_AJOUT_1."' >
				{AJOUT_AUTEUR4} 
				".$img_style_plus.BIBLIO_AJOUT_2."
				</span>
				<div id='auteurs4' style='display: none'>
					{AJOUT_AUTEUR5}
				</div id='auteurs4'>
			</div id='auteurs3'>
		</div id='auteurs2'>
	</div id='auteurs1'>
{OPEN1}".BIBLIO_EDIT_9." :
{OPEN2}{AJOUT_EDITEUR}
{OPEN1}".BIBLIO_EDIT_10." :
{OPEN2}{AJOUT_COLLECTION}
{OPEN1}".SUMMARY." :
{OPEN2}{AJOUT_SOMMAIRE}
{OPEN1}".BIBLIO_EDIT_11." :
{OPEN2}{AJOUT_PARUTION}
{OPEN1}".BIBLIO_EDIT_12." :
{OPEN2}{AJOUT_QUANTITE}
{LAST_TABLE}

<tr style='vertical-align:top'>
<td class='forumheader' colspan='2'  style='text-align:center'>
<input class='button' type='submit' name='ajout' value='".BIBLIO_AJOUT_10."' />
<br />
</td>
</tr>
</table>
</div>
{FORM_CLOSE}
";}
?>
