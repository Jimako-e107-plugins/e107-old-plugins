<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/languages/French_notice.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:18 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
$notice_complete = "
Ce gestionnaire permet de conserver à jour l'état des emprunts de tous les documents de la bibliothèque {SITENAME}.
<p>
Les options avancées sont contrôlées par le groupe <i>{$biblio_admin1}</i>. <br />
Ce groupe gère également les membres du groupe <i>{$biblio_admin2}</i>.<br />
Les emprunts sont gérés par le groupe <i>{$biblio_admin1}</i>".($biblio_admin2 != '' ? " et <i>{$biblio_admin2}</i>":"").". <br />
</p>
<p>
Les emprunts peuvent être déclarés par les membres du groupe <i>{$biblio_admin1}</i>".($biblio_admin2 != '' ? " ou <i>{$biblio_admin2}</i>":"").".<br />
Il y a possibilité de déclarer ses emprunts soi-même en étant {$biblio_membre} si les options sont activés. (Présentement <strong>".(($pref['biblio_perm_emprunt'] == '1') ? ACTIVE:NOTACTIVE)."</strong>)
</p>
<fieldset><legend><em><u>Pour déclarer un emprunt</u></em></legend>
Vous devez vous rendre sur l'onglet <strong><em>{BIBLIO_OPTION_2}</em></strong>.
<hr align='center' width='50%' />
<ul>
  <li>Vous êtes un <strong>membre du {$biblio_admin1} ou {$biblio_admin2}</strong> ?
    <ol>
      <li>Vous devez <strong>sélectionner l'emprunteur</strong> parmi la liste proposée. </li>
      <ul>
        <li>NB. Seuls les membres ayant <strong><em>cotisés</em></strong> apparaissent dans cette liste !<br />
          Si l'emprunteur ne figure pas dans cette liste, c'est qu'il n'a tout  simplement pas réglé sa cotisation auprès de l'association.<br />
          Il lui est alors interdit d'emprunter des documents.</li>
      </ul>
      <li>Vous devez ensuite <strong>sélectionner les documents empruntés</strong>.      </li>
      <ul>
        <li>NB. Vous serez pour cette opération <strong>assisté par une fonction de <em>Remplissage automatique</em></strong>.<br />
          Vous n'aurez qu'à entrer quelques caractères du titre OU du sous-titre OU du nom d'auteur, pour que le logiciel tri toutes les entrées de la  base de données et vous renvoi uniquement les documents contenant les  caractères indiqués.<br />
          Cette opération est automatique. Vous pouvez la tester avec la fonction  de recherche sous l'onglet option. Il fonctionne de la même façon...</li>
        <li>Vous devrez simplement choisir le document en le surlignant et en appuyant sur <strong><em>Entrée.</em></strong></li>
        <li>Vous pourrez ajouter autant de documents que vous le souhaitez dans ce champ. Ne modifiez surtout pas les titres renvoyés dans le champ de sélection. </li>
      </ul>
      <li>Cliquer sur Enregistrer les emprunts </li>
    </ol>
  </li>
</ul>
<hr align='center' width='50%' />
<ul>
  <li>Vous êtes un <strong>{$biblio_membre}</strong> et l'option de <strong>déclaration de ses emprunts est activé</strong> ?
    <ol>
      <li>Vous devez ensuite <strong>sélectionner LE document emprunté</strong>.
        <ul>
          <li>NB. Vous serez pour cette opération <strong>assisté par une fonction de <em>Remplissage automatique</em></strong>.<br />
            Vous n'aurez qu'à entrer quelques caractères du titre OU du sous-titre  OU du nom d'auteur, pour que le logiciel tri toutes les entrées de la  base de données et vous renvoi uniquement les documents contenant les  caractères indiqués.<br />
            Cette opération est automatique. Vous pouvez la tester avec la fonction  de recherche sous l'onglet option. Il fonctionne de la même façon...</li>
          <li>Vous devrez simplement choisir le document en le surlignant et en appuyant sur <strong><em>Entrée.</em></strong></li>
          <li><strong><em>Vous ne pourrez rajouter qu'un emprunt à la fois</em></strong>. Ne modifiez surtout pas les titres renvoyés dans le champ de sélection. </li>
        </ul>
      </li>
      <li>Cliquer sur Enregistrer les emprunts.</li>
    </ol>
  </li>
</ul>
</fieldset>
<p>
Les retours peuvent être déclarés par les membres du groupe <i>{$biblio_admin1}</i> ou <i>{$biblio_admin2}</i>.<br />
Il y a possibilité de déclarer ses retours soi-même en étant {$biblio_membre} si les options sont activés. (Présentement <strong>".(($pref['biblio_perm_retour'] == '1') ? ACTIVE:NOTACTIVE)."</strong>)
</p>
<fieldset><legend><em><u>Pour déclarer un retour de document(s)</u></em></legend>
Vous devez vous rendre sur l'onglet <strong><em>".BIBLIO_OPTION_3."</em></strong>.
<hr align='center' width='50%' />
<ul>
  <li>Vous êtes un <strong>membre du {$biblio_admin1} ou {$biblio_admin2}</strong> ? <br />
  	  Vous avez 2 options, soit :
    <ol>
      <li>Vous devez <strong>sélectionner l'emprunteur</strong> parmi la liste proposée. </li>
      <ul>
        <li>Cette liste affiche tous les emprunteurs enregistrés dans la base de données.<br />
          Si l'emprunteur ne figure pas dans cette liste, c'est qu'il n'avait pas déclaré son emprunt.</li>
		 <li>La liste des documents empruntés par l'usager sélectionné apparaîtra. Cochez les documents retournés.</li>
		 <li>Une liste des documents non-rendus par cette usager s'affichera après l'opération. Vous serez à même de prévenir l'usager de ses emprunts.</li>
      </ul>
      <li>Vous pouvez aussi remettre en disponiblité des livres <strong>sans connaître l'emprunteur</strong>.      </li>
      <ul>
        <li>Cliquez sur le bouton de sélection des documents empruntés,</li>
		<li>La liste complète des emprunts enregistrés vous sera présentée,</li>
        <li>Cochez tous les documents retournés.</li>
      </ul>
    </ol>
  </li>
</ul>
<hr align='center' width='50%' />
<ul>
  <li>Vous êtes un <strong>{$biblio_membre}</strong> et l'option de <strong>déclaration de ses retours est activé</strong> ?
    <ul>
      <li>La liste de vos documents empruntés s'affichera,.
      </li>
      <li>Cochez les documents retournés.</li>
	  <li>Une liste de vos documents non-rendus s'affichera après l'opération.</li>
    </ul>
  </li>
</ul>
</fieldset>
<fieldset><legend><em><u>Consulter la liste de tous les emprunts</u></em></legend>
Vous devez vous rendre sur l'onglet <strong><em>".BIBLIO_OPTION_4."</em></strong>.
<ul>
  <li>La liste de tous les emprunts enregistrés ainsi que l'accès au détail des emprunteurs sera visible.</li>
  <li>Vous pourrez poster automatiquement un courriel de rappel aux retardataires dans cette page.</li>
</ul>
</fieldset>
<fieldset><legend><em><u>Ajouter des documents à la base de données</u></em></legend>
Vous devez vous rendre sur l'onglet <strong><em>".BIBLIO_OPTION_5."</em></strong>.
<ul>
  <li>Vous pourrez entrer un maximum des détails des documents.</li>
  <li>Veillez à remplir le maximum d'information lors de l'ajout.</li>
  <li>Vous avez la possibilité de créer une nouvelle catégorie de document si les catégories présentes ne correspondent pas au document ajouté.</li>
</ul>
</fieldset>
<fieldset><legend><em><u>Modifier(compléter) les informations relatives à un document</u></em></legend>
Faites d'abord une <strong>recherche</strong> du document <strong>par catégorie</strong>.<br />
À la gauche du document, vous trouverez une image <img src='".e_IMAGE."/admin_images/edit_16.png' alt='' />, cliquez cette image pour éditer les détails du document.<br />
Les <strong>{$biblio_membre}</strong> pourront uniquement modifier le sommaire des documents.

</fieldset>


";
?>
