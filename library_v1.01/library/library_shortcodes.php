<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/library_shortcodes.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:16:15 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
$library_shortcodes = $tp -> e_sc -> parse_scbatch(__FILE__);

/*
SC_BEGIN EMPRUNT_OUINON
global $pref;
return (($pref['library_perm_emprunt'] == '1') ? YES:NO);
SC_END
SC_BEGIN RETOUR_OUINON
global $pref;
return (($pref['library_perm_retour'] == '1') ? YES:NO);
SC_END
SC_BEGIN LISTE_OUINON
global $pref;
return (($pref['library_perm_listeemprunt'] == '1') ? YES:NO);
SC_END
SC_BEGIN AJOUT_OUINON
global $pref;
return (($pref['library_perm_ajout'] == '1') ? YES:NO);
SC_END
SC_BEGIN DUREE_DISPLAY
global $pref;
return $pref['library_duree_emprunt']/86400;
SC_END



SC_BEGIN AJOUT_FORM_OPEN
global $rs;
return $rs->form_open("post", e_SELF."?ajout", "ajoutform");
SC_END
SC_BEGIN EDITION_FORM_OPEN
global $rs;
return $rs->form_open("post", e_SELF."?edit.".$_POST['id'], "edition_documents");
SC_END
SC_BEGIN RETOUR_FORM_OPEN
global $rs;
return $rs->form_open("post", e_SELF."?retour", "retourform");
SC_END
SC_BEGIN EMPRUNT_FORM_OPEN
global $rs;
return $rs->form_open("post", e_SELF."?emprunt", "empruntform");
SC_END

SC_BEGIN CHAMPS_REQUIS
return "<span style='text-align:right;font-size:15px; color:red'> *</span>";
SC_END

SC_BEGIN FIRST_TABLE
return "<tr>
<td class='forumheader3' style='width:30%'>";
SC_END
SC_BEGIN OPEN1
return "</td></tr>
<tr>
<td class='forumheader3' style='width:30%'>";
SC_END
SC_BEGIN OPEN2
return "</td>
<td class='forumheader3' style='width:70%'>";
SC_END
SC_BEGIN LAST_TABLE
return "</td></tr>";
SC_END

SC_BEGIN AJOUT_ISBN
global $rs,$pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	return $rs->form_text("isbn", 20,  ($_POST['isbn'] ? $_POST['isbn'] : $isbn), 13);
}else{
	return ($_POST['isbn'] ? $_POST['isbn'] : $isbn);
}
SC_END
SC_BEGIN AJOUT_AUTEUR1
global $rs;
return $rs->form_text("auteur1", 30,  ($_POST['auteur1'] ? $_POST['auteur1'] : $auteur1), 50);
SC_END
SC_BEGIN AJOUT_AUTEUR2
global $rs;
return $rs->form_text("auteur2", 30,  ($_POST['auteur2'] ? $_POST['auteur2'] : $auteur2), 50);
SC_END
SC_BEGIN AJOUT_AUTEUR3
global $rs;
return $rs->form_text("auteur3", 30,  ($_POST['auteur3'] ? $_POST['auteur3'] : $auteur3), 50);
SC_END
SC_BEGIN AJOUT_AUTEUR4
global $rs;
return $rs->form_text("auteur4", 30,  ($_POST['auteur4'] ? $_POST['auteur4'] : $auteur4), 50);
SC_END
SC_BEGIN AJOUT_AUTEUR5
global $rs;
return $rs->form_text("auteur5", 30,  ($_POST['auteur5'] ? $_POST['auteur5'] : $auteur5), 50);
SC_END

SC_BEGIN AUTEURS_USER
global $rs;
for($i = 1; $i < 6; $i++){
	$ret .= ($_POST['auteur'.$i] ? $_POST['auteur'.$i]."<br />"  :  '').$rs->form_hidden('auteur'.$i, $_POST['auteur'.$i] );
}
return $ret;
SC_END

SC_BEGIN PRET_AUTORISE
return (($_POST['pretautorise'] == '0') ? YES : NO );
SC_END

SC_BEGIN AJOUT_TITRE
global $rs,$pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	return $rs->form_text("titre", 50,  ($_POST['titre'] ? $_POST['titre'] : $titre), 200);
}else{
	return ($_POST['titre'] ? $_POST['titre'] : $titre).$rs->form_hidden("titre", $_POST['titre'] );
}
SC_END

SC_BEGIN AJOUT_SOUSTITRE
global $rs,$pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	return $rs->form_text("soustitre", 50,  ($_POST['soustitre'] ? $_POST['soustitre'] : $soustitre), 200);
}else{
	return ($_POST['soustitre'] ? $_POST['soustitre'] : $soustitre);
}
SC_END

SC_BEGIN LISTE_CATEGORIE
global $sql;
$ret ="<option value=''>".BIBLIO_LIST_1."</option>";
      $sql -> db_Select('library',"library_categorie","library_categorie != '' ORDER by library_categorie");
        while($row = $sql-> db_Fetch())
        {$array[] = $row[library_categorie];
        }
      $array = array_unique($array);  
      foreach ($array as $v => $catlist) {
        $sel = ($_POST['categorie_edit'] == $catlist) ? "selected='selected'" : "";
        $ret .="<option value='$catlist' $sel>$catlist</option>";
      }
return $ret;
SC_END
SC_BEGIN AJOUT_CATEGORIE_TEXT
global $rs;
return $rs->form_text("categorie_text", 50,  ($_POST['categorie_text'] ? $_POST['categorie_text'] : $categorie_text), 200);
SC_END

SC_BEGIN AJOUT_EDITEUR
global $rs,$pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	return $rs->form_text("editeur", 50,  ($_POST['editeur'] ? $_POST['editeur'] : $editeur), 200);
}else{
	return ($_POST['editeur'] ? $_POST['editeur'] : $editeur);
}
SC_END
SC_BEGIN AJOUT_COLLECTION
global $rs,$pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	return $rs->form_text("collection", 50,  ($_POST['collection'] ? $_POST['collection'] : $collection), 200);
}else{
	return ($_POST['collection'] ? $_POST['collection'] : $collection);
}
SC_END
SC_BEGIN AJOUT_SOMMAIRE
global $rs,$pref;
if($pref['library_user_edit_summary'] == '1'){
	return $rs->form_textarea("sommaire", 50, 5, ($_POST['sommaire'] ? $_POST['sommaire'] : $sommaire), "style='overflow:hidden'");
}else{
	return $rs->form_textarea("sommaire", 50, 5, ($_POST['sommaire'] ? $_POST['sommaire'] : $sommaire), "style='overflow:hidden'", '' ,'' , 'readonly');
}
SC_END

SC_BEGIN AJOUT_PARUTION
global $pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	$ret.= "<select name='parution' class='tbox'><option></option>";
	$gettoday=getdate();
	$todayyear=$gettoday['year'];
	for($i=$todayyear;$i>=1900;$i--){
		if ($i==$_POST['parution']){
			$ret.= "<option value='$i' selected='selected'>$i</option>";
		}else{
			$ret.= "<option value='$i' >$i</option>";
		}
	}
	$ret.= "</select>";
	return $ret;
}else{
	return ($_POST['parution'] ? $_POST['parution'] : $parution);
}
SC_END

SC_BEGIN CATEGORIE_USER
global $rs;
return ($_POST['categorie_edit'] ? $_POST['categorie_edit'] : $categorie_edit).$rs->form_hidden("categorie_edit", $_POST['categorie_edit'] );
SC_END

SC_BEGIN AJOUT_QUANTITE
global $rs,$pref;
if (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) {
	$ret.= "<select name='quantite' class='tbox'>";
	for($i=1;$i<=10;$i++){
		if ($i==$_POST['quantite']){
			$ret.= "<option value='$i' selected='selected'>$i</option>";
		}else{
			$ret.= "<option value='$i' >$i</option>";
		}
	}
	$ret.= "</select>";
	return $ret;
}else{
	return ($_POST['quantite'] ? $_POST['quantite'] : $quantite);
}
SC_END
SC_BEGIN AJOUT_PRETAUTORISE
global $rs;
($_POST['pretautorise'] == ('0' || '')) ? $sel0 = '1' : '0';
($_POST['pretautorise'] == '1') ? $sel1 = '1' : '0';

return $rs->form_radio("pretautorise", 0, $sel0).YES."&nbsp;&nbsp;".$rs->form_radio("pretautorise", 1, $sel1).NO;
SC_END


SC_BEGIN DOCUMENT_NAME
$ret = ($_POST['titre'] ? $_POST['titre'] : $titre);
$ret .= " - ".($_POST['soustitre'] ? $_POST['soustitre'] : $soustitre);
$ret .= BIBLIO_LIST_2.($_POST['categorie_edit'] ? $_POST['categorie_edit'] : $categorie);
return $ret;
SC_END

SC_BEGIN MEMBRE_EMPRUNT
global $sql,$pref;
$nombredemprunt = $sql->db_Count("library", "(*)", "WHERE library_empruntepar = '".USERID."' AND library_emprunte = '1' ");
$empruntrestant = $pref['library_nb_emprunt_max']-$nombredemprunt;
$membre = USERNAME.BIBLIO_OPTION_MEMBER_10.$empruntrestant.BIBLIO_OPTION_MEMBER_11;
$nonmembre = USERNAME.BIBLIO_OPTION_NOTMEMBER_12;
$visiteur = BIBLIO_OPTION_GUEST_13;
if(USER){
((check_class($pref['library_membre']))?$ret=$membre:$ret=$nonmembre);}
else{
$ret = $visiteur;}
return $ret;
SC_END
SC_BEGIN CHECK_CLASS_BIBLIO
global $sql,$pref;
$group = (check_class($pref['library_gestionemprunt'])) ? BIBLIO_OPTION_ADMINGROUP_1 : BIBLIO_OPTION_ADMINGROUP_2;
$gestionnaire = BIBLIO_OPTION_ADMINGROUP_3.$group.BIBLIO_OPTION_ADMINGROUP_4;
$ret = (check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])) ? $gestionnaire : "";
return $ret;
SC_END

SC_BEGIN SI_CATEGORIE
($_POST[categorie]) ? $ret = BIBLIO_LIST_3.$_POST[categorie]."." : $ret = " :";
return $ret;
SC_END

SC_BEGIN FORM_CLOSE
return "</form>";
SC_END


SC_BEGIN LISTE_DOCUMENTS
global $sql, $sql2, $tp, $user, $rs, $pref;
$ret ="     <tr>
            <td class='forumheader' style='width:5%;white-space:nowrap'>* </td>
            <td class='forumheader' style='width:30%;white-space:nowrap'>".TITLE." </td>
            <td class='forumheader' style='width:20%;white-space:nowrap'>".SUBTITLE." </td>
            <td class='forumheader' style='width:10%;white-space:nowrap'>".AUTHOR."(s) </td>
            <td class='forumheader' style='width:15%;white-space:nowrap'>".SUMMARY." </td>
            <td class='forumheader' style='white-space:nowrap; width:170px'>".STATUS." </td>
            </tr>
                    ";
($_POST[categorie] == '*') ? $cat = "library_categorie != ''" : $cat = "library_categorie = '$_POST[categorie]'";
$sql -> db_Select("library","*","$cat ORDER by library_emprunte DESC,library_categorie,library_titre,library_soustitre,library_auteur1");
        while($row = $sql-> db_Fetch())
        {
            $ret .="<tr>
                    <td class='forumheader2'>
                    <form action='".e_SELF."?edit.".$row[library_id]."' method='post' id='edition".$row[library_id]."' >
                    <INPUT TYPE='hidden' name='edition_documents' VALUE='".$row[library_id]."' />
                    <INPUT TYPE='IMAGE' src='".e_IMAGE."/admin_images/edit_16.png' alt='".EDIT_THIS."' title='".EDIT_THIS."' /></form></td>
                    <td class='forumheader2'>$row[library_titre]</td>
                    <td class='forumheader2'>$row[library_soustitre]</td>
           			    <td class='forumheader2'>".$row[library_auteur1];
                      if ($row[library_auteur2] != ''){$ret .="<br />$row[library_auteur2]"; }
                      if ($row[library_auteur3] != ''){$ret .="<br />$row[library_auteur3]"; }
                      if ($row[library_auteur4] != ''){$ret .="<br />$row[library_auteur4]"; }
                      if ($row[library_auteur5] != ''){$ret .="<br />$row[library_auteur5]"; }
      $ret .="</td><td class='forumheader2'>$row[library_sommaire]</td>";
                if ($row['library_emprunte'] == '0' && $row['library_pretautorise'] == ('0' ||''))
                  {$ret .="<td class='disponible' style='white-space:nowrap; width:100px'>".BIBLIO_LIST_4."</td>";
                }elseif($row['library_pretautorise'] =='1'){
                  $ret .="<td class='consultable' style='white-space:nowrap; width:100px'>".BIBLIO_LIST_5."</td>";
                }else{
                  $sql2 -> db_Select("user","user_id,user_login,user_name","user_id = '".$row[library_empruntepar]."'");
                  while($row2 = $sql2-> db_Fetch())
                  {
                    $ret .="<td class='emprunte' style='white-space:nowrap; width:170px'>".BIBLIO_LIST_6."<a href='".e_BASE."user.php?id.$row2[user_id]'>$row2[user_login] ($row2[user_name])</a>
                    <br /><span class='smalltext'>Retour max : ".strftime("%A, %d %B %Y", $row[library_empruntdate]+$pref['library_duree_emprunt'])."</span></td>";
                  }
                }
            $ret .="</tr>";
        }
return $ret;
SC_END


SC_BEGIN LISTE_EMPRUNTEUR
global $sql, $sql2, $tp, $user, $pref;
if($pref['library_perm_listeemprunt'] != '1' && !check_class($pref['library_gestionemprunt']) && !check_class($pref['library_gestionemprunt_second'])){
$ret ="             <tr>
                    <td class='forumheader5' style='white-space:nowrap'>".CATEGORY." </td>
                    <td class='forumheader5' style='white-space:nowrap'>".TITLE." </td>
                    <td class='forumheader5' style='white-space:nowrap'>".BIBLIO_LIST_7." </td></tr>
                    ";

$sql -> db_Select("library","library_categorie,library_titre,library_soustitre,library_empruntepar,library_empruntdate","library_emprunte = '1' AND library_empruntepar = '".USERID."' ORDER by library_empruntdate,library_categorie,library_titre,library_soustitre");
        while($row = $sql-> db_Fetch())
        {
            $ret .="<tr>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_categorie]</td>
                    <td class='forumheader2'>$row[library_titre] - $row[library_soustitre]</td>
                    <td class='forumheader2' style='white-space:nowrap'>".strftime("%A le %d %B %Y", $row[library_empruntdate]+$pref['library_duree_emprunt'])."</td>
                </tr>
                ";
        }
}
else{
$ret ="             <tr>
                    <td class='forumheader5' style='white-space:nowrap'>".BIBLIO_LIST_8." </td>
                    <td class='forumheader5' style='white-space:nowrap'><a href='".e_SELF."?listeemprunt.user'>".BIBLIO_LIST_9."</a> </td>
                    <td class='forumheader5' style='white-space:nowrap'>".CATEGORY." </td>
                    <td class='forumheader5' style='white-space:nowrap'>".TITLE." </td>
                    <td class='forumheader5' style='white-space:nowrap'><a href='".e_SELF."?listeemprunt.time'>".BIBLIO_LIST_7."</a> </td></tr>
                    ";
if(e_QUERY == 'listeemprunt.user'){$order = "library_empruntepar,library_empruntdate,";}
else{$order = "library_empruntdate,library_empruntepar,";}

$sql -> db_Select("library","library_categorie,library_titre,library_soustitre,library_empruntepar,library_empruntdate","library_emprunte = '1' ORDER by ".$order."library_categorie,library_titre,library_soustitre");
        while($row = $sql-> db_Fetch())
        {
          $sql2 -> db_Select('user',"user_id,user_login","user_id = '".$row[library_empruntepar]."'");
              while($row2 = $sql2-> db_Fetch())
             {
            $ret .="<tr>
                    <td class='forumheader2' style='white-space:nowrap'><a href='?preview_email'><img src='".e_PLUGIN."pm/images/mail_send.png' style='border: 0px solid black' alt='".BIBLIO_EMAIL_ALT_LIST."' title='".BIBLIO_EMAIL_ALT_LIST."' /></a></td>
                    <td class='forumheader2' style='white-space:nowrap'><a href='".e_BASE."user.php?id.$row2[user_id]'>$row2[user_login]</a></td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_categorie]</td>
                    <td class='forumheader2'>$row[library_titre] - $row[library_soustitre]</td>
                    <td class='forumheader2' style='white-space:nowrap'>".strftime("%A le %d %B %Y", $row[library_empruntdate]+$pref['library_duree_emprunt'])."</td>
                </tr>
                ";
              }
        }
}
return $ret;
SC_END

SC_BEGIN RETOUR_RESTEENCORE
global $sql, $pref;
$ret = "<strong>Il vous reste ";
if(check_class($pref['library_membre']) && $pref['library_perm_retour'] == '1' && !check_class($pref['library_gestionemprunt']) && !check_class($pref['library_gestionemprunt_second'])){
$ret .= $sql->db_Count("library", "(*)", "WHERE library_emprunte = '1' AND library_empruntepar = '".USERID."' ");
}
else{
$ret .= $sql->db_Count("library", "(*)", "WHERE library_emprunte = '1' AND library_empruntepar = '".$_POST['emprunteur']."' ");
}
$ret .= BIBLIO_EMPRUNT_1."</strong>";
return $ret;
SC_END
SC_BEGIN RETOUR_LISTERESTEENCORE
global $sql, $pref;
if(check_class($pref['library_membre']) && $pref['library_perm_retour'] == '1' && !check_class($pref['library_gestionemprunt']) && !check_class($pref['library_gestionemprunt_second'])){
$id = USERID;}else{$id = $_POST['emprunteur'];}
if ($sql->db_Count("library", "(*)","WHERE library_emprunte = '1' AND library_empruntepar = '".$id."' "))
{
$ret ="<table class='fborder' style='text-align:center'><tr>
                    <td class='forumheader5' style='white-space:nowrap'>".CATEGORY."</td>
                    <td class='forumheader5' style='white-space:nowrap'>".TITLE."</td>
                    <td class='forumheader5' style='white-space:nowrap'>".BIBLIO_LIST_7."</td></tr>
";
$sql -> db_Select("library","library_categorie,library_titre,library_soustitre,library_empruntdate","library_emprunte = '1' AND library_empruntepar = '".$id."' ");
        while($row = $sql-> db_Fetch())
        {
          $ret .="<tr>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_categorie]</td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_titre] - $row[library_soustitre]</td>
                    <td class='forumheader2' style='white-space:nowrap'>".strftime("%A le %d %B %Y", $row[library_empruntdate]+$pref['library_duree_emprunt'])."</td>
                </tr>";
        }
 $ret .="</table>";
}else
{$ret = BIBLIO_RETOUR_1;}
return $ret;
SC_END

SC_BEGIN RETOUR_EMPRUNTEUR
global $sql, $sql2;
$ret ="<select class='tbox' id='retour_emprunteur' name='retour_emprunteur' onchange='this.form.submit()'><option></option>";
$sql -> db_Select('library',"library_empruntepar","library_emprunte='1'");
while($user_pret = $sql-> db_Fetch())
{$array[] = $user_pret[library_empruntepar];}
$user_pret = array_unique($array);
foreach($user_pret as $id)
  {
     $sql2 -> db_Select('user',"user_id,user_name,user_login","user_id = '".$id."' ORDER by user_login");
        while($row = $sql2-> db_Fetch())
        {
          $ret .="<option value='".$row[user_id]."'>$row[user_login] ($row[user_name])</option>";
        }
  }
      $ret .="</select>";
return $ret;
SC_END

SC_BEGIN RETOUR_LISTE_EMPRUNT
global $sql;

$ret ="<table class='fborder'><tr>
                    <td class='forumheader5' style='white-space:nowrap'>".BIBLIO_RETOUR_2."</td>
                    <td class='forumheader5' style='white-space:nowrap'>".TITLE." </td>
                    <td class='forumheader5' style='white-space:nowrap'>".CATEGORY." </td>
";
if(check_class($pref['library_membre']) && $pref['library_perm_retour'] == '1' && !check_class($pref['library_gestionemprunt']) && !check_class($pref['library_gestionemprunt_second'])){
$sql -> db_Select("library","library_id,library_categorie,library_titre,library_soustitre","library_emprunte = '1' AND library_empruntepar = '".USERID."' ");
}
else{
$sql -> db_Select("library","library_id,library_categorie,library_titre,library_soustitre","library_emprunte = '1' AND library_empruntepar = '".$_POST['retour_emprunteur']."' ");
}
        while($row = $sql-> db_Fetch())
        {
          $ret .="<tr>
                    <td class='forumheader2' style='white-space:nowrap'>
                    <input type='checkbox' name='docurendu[]' value='".$row[library_id]."' /></td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_titre] - $row[library_soustitre]</td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_categorie]</td>
                </tr>";
        }
 $ret .="</table>";

return $ret;
SC_END

SC_BEGIN RETOUR_LISTE_EMPRUNT_SANS_EMPRUNTEUR
global $sql,$sql2;

$ret ="<table class='fborder'><tr>
                    <td class='forumheader5' style='white-space:nowrap'>".BIBLIO_RETOUR_2."</td>
                    <td class='forumheader5' style='white-space:nowrap'>".TITLE." </td>
                    <td class='forumheader5' style='white-space:nowrap'>".CATEGORY." </td>
                    <td class='forumheader5' style='white-space:nowrap'>".BIBLIO_RETOUR_3."</td></tr>
";
$sql -> db_Select("library","library_id,library_categorie,library_titre,library_soustitre,library_empruntepar","library_emprunte = '1' ORDER by library_titre,library_soustitre,library_categorie,library_empruntepar");
        while($row = $sql-> db_Fetch())
        {
          $sql2 -> db_Select('user',"user_id,user_login","user_id = '".$row[library_empruntepar]."'");
              while($row2 = $sql2-> db_Fetch())
             {
          $ret .="<tr>
                    <td class='forumheader2' style='white-space:nowrap'>
                    <input type='hidden' name='doc_pour_histo[".$row2[user_id]."]' value='".$row[library_id]."' />
                    <input type='checkbox' name='docurendu[]' value='".$row[library_id]."' /></td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_titre] - $row[library_soustitre]</td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_categorie]</td>
                    <td class='forumheader2' style='white-space:nowrap'><a href='".e_BASE."user.php?id.$row2[user_id]'>$row2[user_login]</a></td>
                </tr>";
              }
        }
 $ret .="</table>";
return $ret;
SC_END


SC_BEGIN NOM_EMPRUNTEUR_RETOUR
global $sql, $pref;
if(check_class($pref['library_membre']) && $pref['library_perm_retour'] == '1' && !check_class($pref['library_gestionemprunt']) && !check_class($pref['library_gestionemprunt_second'])){
$sql -> db_Select('user',"user_login","user_id = '".USERID."' ");}
else{
$sql -> db_Select('user',"user_login","user_id = '".$_POST['retour_emprunteur']."' ");}
$ret = $sql-> db_Fetch();
return $ret[0];
SC_END

SC_BEGIN AUTOCOMPLETE_EMPRUNT
	$ret = autocomplete_form('ac_liste_multichoice', 'textarea');
return $ret;
SC_END
SC_BEGIN AUTOCOMPLETE_MEMBRE
	$ret = autocomplete_form('ac_member');
return $ret;
SC_END
SC_BEGIN AUTOCOMPLETE_RECHERCHE_TITRE
global $rs;
if(e_QUERY != 'emprunt'){
	$ret = $rs->	form_open("post", e_SELF."?edit");
	$ret .= autocomplete_form('ac_liste');
	$ret .= $rs->form_button("submit", "submit_search", "GO", "", BIBLIO_AUTOCOMPLETE_1);
	$ret .= $rs->form_close();
}else{
	$ret = "";
}
return $ret;
SC_END

SC_BEGIN EMPRUNT_EMPRUNTEUR
global $sql, $pref, $tp;
if(check_class($pref['library_gestionemprunt']) || check_class($pref['library_gestionemprunt_second'])){
	if($pref['library_membre'] === FALSE) { $pref['library_membre'] = e_UC_MEMBER;}
	switch ($pref['library_membre'])
	{
		case e_UC_ADMIN:
			$where = "user_admin = 1";
			break;

		case e_UC_MEMBER:
			$where = "1";
			break;
			
		case e_UC_NOBODY:
			return "";
			break;
			
		default:
			$where = "user_class REGEXP '(^|,)(".$tp -> toDB($pref['library_membre'], true).")(,|$)'";
			break;
	}
			
	$text = "<select class='tbox' id='emprunteur' name='emprunteur' onchange=\"uc_switch('class')\">";
	$text .= "<option value=''>???</option>";
	$sql -> db_Select("user", "user_id,user_name", $where." ORDER BY user_name");
	while ($row = $sql -> db_Fetch()) {
		$text .= "<option value='".$row['user_id']."'>".$row['user_name']."</option>";
	}
	$text .= "</select>";
	$ret = $text;
}else{
$ret = USERNAME."<input type='hidden' name='emprunteur' id='emprunteur' value='".USERNAME."' />";
}
return $ret;
SC_END

SC_BEGIN EMPRUNT_PRETNONAUTORISE
global $sql;
$ret ="<table class='fborder'><tr>
                    <td class='forumheader5' style='white-space:nowrap'>".CATEGORY."</td>
                    <td class='forumheader5' style='white-space:nowrap'>".TITLE."</td></tr>
";
      $sql -> db_Select('library',"library_titre,library_soustitre,library_categorie","library_pretautorise='1' ORDER by library_categorie, library_titre");
        while($row = $sql-> db_Fetch())
        {
          $ret .="<tr>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_categorie]</td>
                    <td class='forumheader2' style='white-space:nowrap'>$row[library_titre] - $row[library_soustitre]</td>
                </tr>";
        }
 $ret .="</table>";
return $ret;
SC_END


*/

//--------------Fonction employée avec le script AUTOCOMPLETE AJAX-----------------------------------------------
function autocomplete_form($autocomplete_id, $autocomplete_type = 'off') {
//Choice for $autocomplete_id : ac_liste_multichoice , ac_liste , ac_member 
//Choice for $autocomplete_type : textarea (else will be a textbox while list appear under) 
if($autocomplete_type == 'textarea'){
	$text .= "
            <textarea class='tbox' name='$autocomplete_id' id='$autocomplete_id' style='width:90%' rows='4'></textarea>
            <input type='hidden' name='autocomplete' id='autocomplete' value='$autocomplete_id' />
            ";
}else{
  if($autocomplete_id == 'ac_liste'){$affiche = BIBLIO_OPTION_8;}
	$text .= "
            <input class='tbox' type='text' name='$autocomplete_id' id='$autocomplete_id' size='50' maxlength='150' value='$affiche' onclick='javascript:this.value=\"\"' />
            <input type='hidden' name='autocomplete' id='autocomplete' value='$autocomplete_id' />
            ";
}
return $text;
}


?>
