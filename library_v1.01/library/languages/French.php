<?php 
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/languages/French.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:18 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
define("PAGE_NAME", "Gestion de la bibliothèque");

define("BIBLIO_ADMIN_1", "Préférences de l'administrateur");
define("BIBLIO_ADMIN_2", "Qui peut contrôler l'extension via le système lui-même ? ");
define("BIBLIO_ADMIN_3", "Qui peut accéder à l'extension (la voir) ? ");
define("BIBLIO_ADMIN_4", "Préférences sauvegardées");
define("BIBLIO_ADMIN_5", "Sauvegarder les préférences");
define("BIBLIO_ADMIN_6", "Configuration");
define("BIBLIO_ADMIN_7", "Préférences");
define("BIBLIO_ADMIN_7b", "Options avancées");
define("BIBLIO_ADMIN_8", "Y a-t-il un autre groupe qui puisse gérer les emprunts ?");
define("BIBLIO_ADMIN_9", "Qui peut emprunter des documents (est membre) ?");
define("BIBLIO_ADMIN_10", "Les membres peuvent signifier leurs emprunts eux-même...");
define("BIBLIO_ADMIN_11", "Les membres peuvent signifier leurs retours eux-même...");
define("BIBLIO_ADMIN_12", "Les membres peuvent voir la liste de tous les emprunts...");
define("BIBLIO_ADMIN_13", "Les membres peuvent ajouter des documents au répertoire...");
define("BIBLIO_ADMIN_14", "Les membres peuvent éditer le sommaire des documents...");
define("BIBLIO_ADMIN_15", "Nombre de livres empruntables");
define("BIBLIO_ADMIN_16", "Durée max des prêts (en journée)");
define("BIBLIO_ADMIN_17", "Message à afficher lors de l'édition/ajout des exemplaires");
define("BIBLIO_ADMIN_18", "Veillez à remplir le maximum de ces champs.<br />Il est peu probable que quelqu'un les complète pour vous plus tard...<br />Merci ! ");

define("BIBLIO_PLUGIN_1", "Bibliothèque");
define("BIBLIO_PLUGIN_2", "Un système complet de gestion des emprunts d'une bibliothèque, développé pour une réelle biblio, vous pouvez aussi l'employer pour partager des DVD ou autres.");
define("BIBLIO_PLUGIN_4", "Installez, veuillez d'abord configurer les droits d'accès globaux, ensuite rendez-vous dand l'espace de gestion avancées (user-side) de votre système de gestion de bibliothèque.");

define("YES", "Oui");
define("NO", "Non");
define("AUTHOR", "Auteur");
define("TITLE", "Titre");
define("SUBTITLE", "Sous-titre");
define("SUMMARY", "Sommaire");
define("STATUS", "Statut");
define("EDIT_THIS", "Éditer ce document");
define("CATEGORY", "Catégorie");
define("ACTIVE", "activé");
define("NOTACTIVE", "désactivé");


define("BIBLIO_OPTION_1", "Options");
define("BIBLIO_OPTION_2", "<strong>Emprunts</strong>");
define("BIBLIO_OPTION_3", "<strong>Retour</strong>");
define("BIBLIO_OPTION_4", "<strong>Liste des emprunts</strong>");
define("BIBLIO_OPTION_5", "<strong>Ajouter un document</strong>");
define("BIBLIO_OPTION_6", "<strong>Réglages avancées</strong>");
define("BIBLIO_OPTION_7", "Liste de tous les documents ");
define("BIBLIO_OPTION_WELCOME", "<strong>Bienvenue dans le système de gestion de la bibliothèque ".SITENAME.".</strong>");
define("BIBLIO_OPTION_MEMBER_10", ",  tu es un membre de l'association, tu as le droit d'emprunter encore <i>");
define("BIBLIO_OPTION_MEMBER_11", " documents</i>.");
define("BIBLIO_OPTION_NOTMEMBER_12", ", vous n'êtes pas <a href='".e_PLUGIN."content/content.php?content.27' title='Comment le devenir...'>membre de l'association</a>, vous pouvez consulter les documents de la bibliothèque sur place, mais pas les emprunter.");
define("BIBLIO_OPTION_GUEST_13", "Bienvenue cher visiteur!<br />Vous n'êtes pas <a href='".e_PLUGIN."content/content.php?content.27' title='Comment le devenir...'>membre de l'association</a> (ou pas enregistré sur le site), mais vous pouvez toujours consulter les ouvrages disponibles à la biblio si vous nous rendez visite et que les portes sont ouvertes.<br />Malheureusement, vous ne pourrez partir avec les trésors que vous découvrirez...");
define("BIBLIO_OPTION_ADMINGROUP_1", "Comité Bibliothèque");
define("BIBLIO_OPTION_ADMINGROUP_2", "Permanence Bibliothèque");
define("BIBLIO_OPTION_ADMINGROUP_3", "Tu es aussi un membre du groupe ");
define("BIBLIO_OPTION_ADMINGROUP_4", ", tu as de ce fait accès à de nombreuses options pour améliorer et exploiter ce système de gestion.");
define("BIBLIO_OPTION_8", "Rechercher un document");
define("BIBLIO_OPTION_", "");
define("BIBLIO_OPTION_", "");
define("BIBLIO_OPTION_", "");
define("BIBLIO_OPTION_", "");


define("BIBLIO_LIST_TITLE", "Liste des documents");
define("BIBLIO_OPTION_CAT_ALL", "Tous les documents");
define("BIBLIO_LIST_1", "Choisissez la catégorie");
define("BIBLIO_LIST_2", " de la catégorie : ");
define("BIBLIO_LIST_3", "de la catégorie ");
define("BIBLIO_LIST_4", "Disponible pour le prêt");
define("BIBLIO_LIST_5", "Disponible en consultation seulement");
define("BIBLIO_LIST_6", "Emprunté par : ");
define("BIBLIO_LIST_7", "Échéance !");
define("BIBLIO_LIST_8", "Contacter");
define("BIBLIO_LIST_9", "Emprunteur");
define("BIBLIO_LIST_", "");
define("BIBLIO_LIST_", "");

define("BIBLIO_EMPRUNT_TITLE", "Gestion des emprunts");
define("BIBLIO_EMPRUNT_ERROR_1", "Vous n'avez pas spécifier l'emprunteur !!!");
define("BIBLIO_EMPRUNT_ERROR_2", "Attention, cet usager dépasse la quantité de livres qu'il peut emprunter!\\nIl peut encore emprunter :");
define("BIBLIO_EMPRUNT_MESSAGE_3", "Emprunt(s) enregistré(s). Merci.<br />Avis aux responsables, assurez-vous que le titre a été enregistré correctement s'il y a un 'apostrophe' dans le titre ou sous-titre.<br />S'il ne figure pas dans les emprunts, vous devrez éditer le livre en question pour que le programme réenregistre correctement son nom. <a href='".e_SELF."?listeemprunt'>Vérifier sur la liste des emprunts?</a>");
define("BIBLIO_EMPRUNT_1", " documents à rendre :");
define("BIBLIO_EMPRUNT_2", "Ajouter un ou des emprunts");
define("BIBLIO_EMPRUNT_3", "Documents empruntés");
define("BIBLIO_EMPRUNT_4", "Entrez tous les documents empruntés");
define("BIBLIO_EMPRUNT_5", "Écrivez une <u>partie</u> du <strong>titre</strong> ou du <strong>sous-titre</strong>,
 patientez 1 ou 2 secondes et une liste des documents incluant ces titres apparaîtra.
 Choisissez le bon document avec les flèches ou la souris et faites 'Entrée'.<br />
Pour ajouter un autre document, écrivez directement après la saisie du premier.");
define("BIBLIO_EMPRUNT_6", "Valider les emprunts");
define("BIBLIO_EMPRUNT_7", "Le document est introuvable??");
define("BIBLIO_EMPRUNT_8", "Figure-t-il dans la liste des documents <strong>NON</strong>-empruntables?");
define("BIBLIO_EMPRUNT_9", "Voir la liste");
define("BIBLIO_EMPRUNT_10", "Non, le document n'est pas dans cette liste, <a href='".e_SELF."?ajout'>cliquez ici pour ajouter le document au répertoire.</a>");
define("BIBLIO_EMPRUNT_", "");

define("BIBLIO_RETOUR_TITLE", "Gestion des retours");
define("BIBLIO_RETOUR_1", "Cet usager n'a plus de documents à rendre, merci.");
define("BIBLIO_RETOUR_2", "Rendu ? ");
define("BIBLIO_RETOUR_3", "Emprunté par ");
define("BIBLIO_RETOUR_4", "Valider des retours de documents");
define("BIBLIO_RETOUR_5", "Qui est l'emprunteur?");
define("BIBLIO_RETOUR_6", "Vous ne connaissez pas l'emprunteur?");
define("BIBLIO_RETOUR_7", "Retourner un (des) document(s) sans connaître les emprunteurs");
define("BIBLIO_RETOUR_8", "Documents rendus");
define("BIBLIO_RETOUR_9", "Valider les retours");
define("BIBLIO_RETOUR_10", "Cochez tous les documents rendus");
define("BIBLIO_RETOUR_11", "Merci, les documents ont bien été pris en compte comme étant rendus.");
define("BIBLIO_RETOUR_12", "Veillez à ramener ces documents le plus rapidement possible...");
define("BIBLIO_RETOUR_", "");
define("BIBLIO_RETOUR_", "");
define("BIBLIO_RETOUR_", "");
define("BIBLIO_RETOUR_", "");

define("BIBLIO_LISTEMPRUNT_TITLE", "Liste des emprunts et avertissements");
define("BIBLIO_LISTEMPRUNT_1", "Liste des emprunts non remis !");
define("BIBLIO_LISTEMPRUNT_", "");
define("BIBLIO_LISTEMPRUNT_", "");
define("BIBLIO_LISTEMPRUNT_", "");

define("BIBLIO_AJOUT_TITLE", "Ajout de documents");
define("BIBLIO_AJOUT_ERROR_1", "Vous ne pouvez utiliser ce caractère: _ ou ; dans le titre ou le sous-titre.\\nVeuillez le changer.\\n");
define("BIBLIO_AJOUT_ERROR_2", "Ce livre est déjà présent dans la base de données (Titre), veuillez y rajouter un exemplaire.\\n");
define("BIBLIO_AJOUT_ERROR_3", "Ce livre est déjà présent dans la base de données ou bien vous avez mal entré le code ISBN (ne mettez que les chiffres),\\nVeuillez corriger vos erreurs.\\n");
define("BIBLIO_AJOUT_ERROR_4", "Vous avez laissé vide des champs requis\\n");
define("BIBLIO_AJOUT_ERROR_5", "Vous devez spécifier la catégorie de documents !\\n");
define("BIBLIO_AJOUT_ERROR_TEXT", "Une erreur s'est produite lors de la création du livre. Veuillez contacter le webmestre.");
define("BIBLIO_AJOUT_3", "Catégorie :");
define("BIBLIO_AJOUT_4", "Prêt autorisé ?");
define("BIBLIO_AJOUT_5", "Numéro ISBN :");
define("BIBLIO_AJOUT_6", "Titre :");
define("BIBLIO_AJOUT_7", "Sous-titre :");
define("BIBLIO_AJOUT_8", "Auteur(s) : ");
define("BIBLIO_AJOUT_1", "Ajouter un auteur");
define("BIBLIO_AJOUT_2", "Cliquer pour agrandir");
define("BIBLIO_AJOUT_9", "Ajouter un document au répertoire");
define("BIBLIO_AJOUT_10", "Ajouter le document");
define("BIBLIO_AJOUT_", "");

define("BIBLIO_EDIT_TITLE", "Édition des documents");
define("BIBLIO_EDIT_ERROR_1", "Une erreur s'est produite lors de l'édition du document. Veuillez contacter le webmestre.");
define("BIBLIO_EDIT_2", "Édition du document");
define("BIBLIO_EDIT_3", "Éditer le document");
define("BIBLIO_EDIT_4", "Créer une catégorie ?");
define("BIBLIO_EDIT_5", "Écrivez le nom de la nouvelle catégorie.");
define("BIBLIO_EDIT_6", " (ne mettez que les chiffres)");
define("BIBLIO_EDIT_7", "NOM");
define("BIBLIO_EDIT_8", "Prénom");
define("BIBLIO_EDIT_9", "Éditeur");
define("BIBLIO_EDIT_10", "Collection");
define("BIBLIO_EDIT_11", "Année de parution");
define("BIBLIO_EDIT_12", "Nombre d'exemplaires");
define("BIBLIO_EDIT_", "");
define("BIBLIO_EDIT_", "");
define("BIBLIO_EDIT_", "");

define("BIBLIO_NOTICE_TITLE", "Mode d'emploi du gestionnaire de bibliothèque");
define("BIBLIO_NOTICE_1", "Mode d'emploi");
define("BIBLIO_NOTICE_2", "Options activées");
define("BIBLIO_NOTICE_3", "Quel(s) groupe(s) peut gérer les emprunts ?");
define("BIBLIO_NOTICE_4", "Qui peut emprunter des documents (est membre) ?");
define("BIBLIO_NOTICE_5", "Nombre de livres empruntables :");
define("BIBLIO_NOTICE_6", "documents");
define("BIBLIO_NOTICE_7", "Durée max des prêts :");
define("BIBLIO_NOTICE_8", "jours");
define("BIBLIO_NOTICE_9", "Les membres peuvent ...");
define("BIBLIO_NOTICE_10", "Déclarer leurs emprunts eux-même ?");
define("BIBLIO_NOTICE_11", "Déclarer leurs retours eux-même ?");
define("BIBLIO_NOTICE_12", "Consulter la liste de tous les emprunts ?");
define("BIBLIO_NOTICE_13", "Ajouter de nouveaux documents à la base de données ?");

define("BIBLIO_AUTOCOMPLETE_1", "Click to submit");
define("BIBLIO_AUTOCOMPLETE_2", "<ul>\n<li>Erreur! Vous devez modifier votre variable d'attribution.<br />
                   Possible choices are : 'ac_liste_multichoice' , 'ac_liste' , 'ac_member'<br />
                   Sinon, vous devrez modifier le fichier autocomplete/ac_retrieve.php pour répondre à vos besoins</li>\n</ul>");


define("BIBLIO_PERMISSION_1", "Vous n'avez pas les permissions requises pour accéder cette page.<br /><br />Veuillez <a href='".e_BASE."contact.php'>contacter le webmestre</a> s'il s'agit d'une erreur.<br /><br />Merci.");
define("BIBLIO_PERMISSION_2", "Permissions déniées");

define("BIBLIO_MENU_1", "Bibliothèque");
define("BIBLIO_MENU_2", "Pssst...<br />
N'oublis pas que tu as emprunté :<br />");


define("BIBLIO_EMAIL_TITLE", "Exemple de courriel : Rappel d'emprunt de documents à la bibliothèque ".SITENAME);
define("BIBLIO_EMAIL_ALT_LIST", "PAS ENCORE FONCTIONNEL, seulement un aperçu");
define("BIBLIO_EMAIL_ERROR", "There was a problem, the registration mail was not sent, please contact the website administrator.");
define("BIBLIO_EMAIL_", "");
define("BIBLIO_EMAIL_", "");
define("BIBLIO_EMAIL_", "");



?>
