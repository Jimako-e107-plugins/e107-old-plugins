<?php
// **************************************************************************
// *
// *  Prune Inactive Users (Nettoyage des utilisateurs inactifs)
// *  Fichier de langue pour la partie administration d’e107.
// *  Traduction fr de Tibert
// *
// **************************************************************************
// Subject for the email to inactive user
define(PRUNE_ASUBJECT, "Contribuez… et gardez vos accès !");
// Email contents for not logged in recently
// $_REQUEST['prune_days'] is the number of days you entered
define(PRUNE_AMESSAGEL1, "L’administrateur de " . SITENAME . " a purgé les comptes inactifs depuis " . $pref['prune_days'] . " jours. ");
define(PRUNE_AMESSAGEL2, "Avant d’en arriver là, nous vous laissons la possibilité de revenir visiter le site si vous le désirez. Si vous ne visitez pas le site dans moins d’une semaine, votre compte sera perdu. ");
define(PRUNE_AMESSAGEL3, "Amitiés - " . SITENAME . , Administrateur . ");

// Email contents for not making a forum post recently
define(PRUNE_AMESSAGEF1, "L’administrateur de ".SITENAME." a purgé les comptes qui n’ont pas contribué depuis ".$pref['prune_days']." jours . ");
define(PRUNE_AMESSAGEF2, "Avant d’en arriver là, nous vous laissons la possibilité de revenir visiter le site et de poster sur le forum . Si vous ne visitez pas le site dans moins d’une semaine, votre compte sera perdu . ");
define(PRUNE_AMESSAGEF3, "Amitiés - ".SITENAME., Administrateur.");
// Email to say account now deleted
define(PRUNE_AMESSAGED1, "L’administrateur de " . SITENAME . " a purgé les comptes qui n’ont pas contribué ou qui ne se sont pas connecté depuis " . $pref['prune_days'] . " jours. ");
define(PRUNE_AMESSAGED2, "Votre compte est effacé et ses codes d’accès sont à présent invalides.");
define(PRUNE_AMESSAGED3, "Amitiés - " . SITENAME . , Administrateur . ");

define(PRUNE_HELP_0,"Nettoyage de la liste des membres");
define(PRUNE_HELP_1,"Configuration");
define(PRUNE_HELP_2,"Choisir la date limite");
define(PRUNE_HELP_3,"Choisissez la date limite d'inactivité en nombre de jours.");
define(PRUNE_HELP_4,"Mode de sélection");
define(PRUNE_HELP_5,"Choisissez s'il faut cibler les utilisateurs en fonction de leur dernier message sur le forum ou seulement depuis leur dernière connexion . ");
define(PRUNE_HELP_6,"Avertir de la suppression");
define(PRUNE_HELP_7,"Voulez - vous envoyer un email à l'utilisateur quand son compte est effacé? (Ca ne change rien aux mails de rappel).");
define(PRUNE_HELP_8,"Action");
define(PRUNE_HELP_9,"Choisissez d'avertir les utilisateur seulement ou de détruire leur compte directement . Si vous choisissez la destruction de compte, utilisez l'option précédente afin de les avertir que leur compte est effacé.");
define(PRUNE_HELP_10,"General");
define(PRUNE_HELP_11,"Commencez par configurer les options puis cliquez sur le lien <i>Prune Users</i> de votre menu.<br />Selon ce que vous aurez choisi, l'alerte du panneau d'administration, ne vous donnera pas les même informations sur les utilisateurs à effacer.");


define(PRUNE_A1, "Suppression des membres inactifs");
define(PRUNE_A2, "Choisissez les utilisateurs inactifs depuis (jours)");
define(PRUNE_A3, "Exécuter");
define(PRUNE_A4, "Nom de l'utilisateur");
define(PRUNE_A5, "Date de la dernière activité sur le site");
define(PRUNE_A6, "Détruire");
define(PRUNE_A7, "Echec de la commande de destruction");
define(PRUNE_A8, "Destruction effectuée");
define(PRUNE_A9, "Aucun utilisateur ne remplis les critères");
define(PRUNE_A10, "Continuer");
define(PRUNE_A11, "Vous devez spécifiez une période au moins supérieure à 0 jours !");
define(PRUNE_A12, "Depuis plus de ");
define(PRUNE_A13, " jours");
define(PRUNE_A14, " < strong > ATTENTION < / strong > : Le compte sélectionné va être détruit . Vous ne pourrez PAS revenir en arrière (Vous avez, bien sûr, une sauvegarde de votre bdd . . . hmm?) . La suite relève de votre seule responsabilité . ");
define(PRUNE_A15, "vous n'avez rien sélectionné.");
define(PRUNE_A16, "Méthode");
define(PRUNE_A17, "Dernière connexion");
define(PRUNE_A18, "Dernier post sur le forum");
define(PRUNE_A19, "Aucun post");
define(PRUNE_A20, "Nettoyer les comptes");
define(PRUNE_A21, "Configurer");
define(PRUNE_A22, "Les changements ont bien été sauvegardés");
define(PRUNE_A23, "Mail de (nom)");
define(PRUNE_A24, "Mail de (adresse)");
define(PRUNE_A25, "Action");
define(PRUNE_A26, "Envoyer un mail aux utilisateurs sélectionnés");
define(PRUNE_A27, "Détruire les comptes sélectionnés");
define(PRUNE_A28, "Mail correctement envoyé");
define(PRUNE_A29, "Echec lors de l'envoi du mail");
define(PRUNE_A30, "Un avertissement est envoyé à l'utilisateur");
define(PRUNE_A31, "Avertir l'utilisateur du nettoyage");
define(PRUNE_A32, "Non");
define(PRUNE_A33, "Oui");
define(PRUNE_A34, "Aucune visite");
define(PRUNE_A35, "Enlever le statut d'admin avant de détruire le compte ou de l'alerter par mail");
define(PRUNE_A36, "Tout sélectionner");
define(PRUNE_A37, "Tout désélectionner");
define(PRUNE_A38, "Sauvegarder");
define(PRUNE_A39, "Sélectionner les utilisateurs inactifs depuis (jours)");
define(PRUNE_A40, "Mode de sélection des membres");
define(PRUNE_A41, "Action à effectuer");
define(PRUNE_A42, "Envoyer un mail aux membres");
define(PRUNE_A43, "Détruire le compte");
define(PRUNE_A44, "Inscription du");
define(PRUNE_A45, "Comptes correspondants aux critères de nettoyage");
define(PRUNE_A46, "Check for Updates");
define(PRUNE_A47, "Remove from class");
define(PRUNE_A48, "Removed from class");
define(PRUNE_A49, "Prune from class");
?>
