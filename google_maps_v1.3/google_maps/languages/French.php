<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Fichier Langue  :  e107_0.7/e107_plugins/yourplugin/languages/French.php
|        Author:Juan 
|        Email: webmaster@reseau.li
|        Internet website  : http://www.reseau.li/RZO-E107/
+----------------------------------------------------------------------------------------------------+
*/ 
// Mettre English/admin/lan_admin.php pour une liste de termes communs que vous 
// Peut être utiliser dans votre secteur ADMIN.
// En utilisant ces termes, votre plugin sera aussitôt traduit et ceci dans des nombreux cas.

//lan dans la page  yourplugin.php

define('LAN_YPLUG_1', "Un certain texte d'introduction<br />");
define('LAN_YPLUG_2', "Plus de texte encore<br />");
define('LAN_YPLUG_3', "<b>Votre Plugin</b>");
define('LAN_YPLUG_4', "Le corps de ");
define('LAN_YPLUG_5', "votre page de plugin  </br>");
define('LAN_YPLUG_6', "Vous préférence Admin sont établies sur: ");
define('LAN_YPLUG_7', "Activé");
define('LAN_YPLUG_8', "Désactivé");
define('LAN_YPLUG_9', "mon nom de plugin");
define('LAN_YPLUG_10', "");
define('LAN_YPLUG_11', "");
define('LAN_YPLUG_12', "");

define('LAN_YPLUG_13', "Lisez-Moi");
define('LAN_YPLUG_14', "
<br/>===============================================================
<br/> YOUR PLUGIN - v3.1 - de Cameron
 <br/> un modèle de plugin pour le Système e107 Website System
 <br/>http://e107.org 
 <br/>Pour plus de choix de plugins et obtenir de l'aide vistez: http://www.e107coders.org
<br/>===============================================================

<br/><br/>Modifications:<br/>
=========
<br/><br/>
<br/>Version 3.1:
<br/>- Ajout de lan dans tous les fichiers
<br/>- readme.php added
<br/><br/>
Version 3.0:
	<br/>- Nouvelle options ajoutées - textarea, couleur, Date Cachet, répertoire, image, table-en lecture seule etc. 
	<br/>- compatible 0.7. 
	<br/>- compliant xhtml 1.1
	<br/>- Ajout de boucle en exemple dans yourplugin.php 
	<br/>- Suppression de la configuration avec le fichier ypsettings.php - la config est maintenant au début de chaque script.
	<br/>- Aide grâce à l'éditeur wysiwyg et à l'ajout de définitions .
	<br/>- Meilleur utilisation des fonctions js incorporées
	<br/>- plugin.php-maker ajouté au package. 
<br/><br/>
Version 2.3:
	- Table d'accès ajoutées
<br/><br/>
Version 2.2:
       <br/> - Options textarea  ajoutées dans formhandler
       <br/> - Correction de la cassure d'easy admin menu par v6.16
<br/><br/>
Version 2.1:
	<br/>- improved form handling.
	<br/>- ajout option 'date'.
	<br/>- viewdate() function added.
<br/><br/>
Version 2.0:
	<br/>- Créaction dynamique d'espace d'administration avec un nouveau fichier de paramètrage.
	<br/>- Aide pour tables de base de données et sauvegardes des préférences.
	<br/>- Exemples d'encodage
<br/><br/>
Version 1.0:
	<br/>- Première release
 
<br/><br/>

===============================================================

<br/><br/>

 <br/>Voici un modèle simple que vous pouvez utiliser il vous aidera 
 <br/>il vous aidera dans la création de plugins pour e107. 

<br/>Fichiers Inclus:
<br/>===============
<br/><br/>
 Les fichiers qui requièrent une configuration :
	<br/>plugin.php - les paramètres d'installation de votre plugin.  
 	<br/>admin_config.php - fichier de configuration admin . 
 	<br/>admin_pref.php - fichier des préférences admin. 
 	<br/>admin_menu.php - fichier menu admin . 
 	<br/>help.php - fichier d'aide admin . 
	<br/>admin_pluginmaker.php - Générateur de fichier plugin.php  - Devrait être supprimé après utilisation. 
<br/><br/>
 Les fichiers qui requièrent un peu d'encodage:	
 	<br/>yourplugin.php - votre page principale de plugin. 
 	<br/>yourplugin_menu.php - (Éditez ceci si vous voulez avoir un menu).
	<br/>admin_menu - Éditez pour changer vos options de menu admin. (Facultatif peut-être supprimé)
	<br/>admin_config - La configuration principale pour votre espace admin. 
	<br/>admin_pref - Options préférences. (Facultatif peut être supprimé)
	<br/>help.php - help file. (Facultatif peut être supprimé)
	
<br/><br/>
<br/> Rédaction Facultative de ces fichiers:
<br/>languages/English.php - fichier de langue admin - Utilisé pour votre interface Yourplugin.php. 
<br/>languages/admin/English.php - fichier de langue admin - Utilisé pour votre espace admin. 
<br/><br/>
Edition non exigée :
  Form_handler.php - AUCUN ÉDITION NÉCESSAIRE mais fichier REQUIS pour le fonctionnement du plugin.
 Admin_pluginmaker.php - devrait être supprimé après utilisation.

<br/> De toute façon, j'espère que vous trouvez ce petit modèle .. utile 
<br/> je suis sûr qu'il peut être amélioré ..., mais c'est un début. 
<br/><br/>
J'ai aussi inclus un fichier de photoshop que vous pouvez éditer pour vos icônes admin. 
<br/><br/>
Remerciements
<br/> Cameron
<br/>( webmaster - www.e107coders.org ) 

<br/><br/>


 Si vous n'avez pas besoin de menu.
<br/>================================== 
<br/><br/>
1. renommer le dossier plugin en:
<br/> 'yourplugin' (ie. enlève _menu ) et supprimez le fichier xxxxxxxx_menu.php. 
 <br/><br/> 
Notez : 'yourplugin' devrait dans tous les cas être remplacé par un nom unique de votre propre cru .
<br/><br/>
2. éditer plugin.php:
 <br/> changer -   $eplug_menu_name = 'yourplugin_menu';  par $eplug_menu_name = ''; 

<br/><br/>

 Si vous avez besoin SEULEMENT d'un menu.
<br/>=================================
<br/><br/>
1. Supprimez le fichier yourplugin.php. 
<br/><br/>
2. Ouvrez plugin.php and éditez les lignes suivantes :
  <br/> $eplug_link = TRUE; 
   <br/>Changez-le en:
  <br/> $eplug_link = FALSE;
<br/><br/>
  Instructions accès Tables
 <br/>=================================
<br/><br/>
On vous recommande de ne utiliser ceci dans le secteur des préférences uniquement.
<br/><br/>
1) Ajoutez une option pour selectionner la visibilité.  Voir ypsettings.php par example.
<br/><br/>
2) Dans vos classes d'interface utilisateur, utilisez la fonction checkclass 
<br/>  validant son accès avant l'affichage de la page...

<br/><br/> (voir l'exemple sur texte original) <a href='readme.txt'>readme.txt</a></b>


		");
?>

