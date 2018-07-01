<?php
/**
 * $Id: Dutch.php,v 1.5 2009/10/22 21:44:20 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.5 $
 * Last Modified: $Date: 2009/10/22 21:44:20 $
 *
 * Change Log:
 * $Log: Dutch.php,v $
 * Revision 1.5  2009/10/22 21:44:20  michiel
 * Synchronized with all changes in English
 *
 * Revision 1.4  2009/07/14 19:29:06  michiel
 * CVS Merge
 *
 * Revision 1.3.2.2  2009/07/13 18:53:40  michiel
 * - Added Sending PM
 * - Added medal reward
 *
 * Revision 1.3.2.1  2009/07/05 20:30:31  michiel
 * MERGE Maint1.3->Dev1.4
 *
 * Revision 1.3.4.1  2009/06/30 20:10:15  michiel
 * Fixed weird apache/php (?) bug: white line after ?> mark (at end of file) could lead into not parsing the code
 *
 * Revision 1.3  2009/06/28 15:05:54  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/28 02:35:06  michiel
 * - Position of rank image in forum is configurable
 * - Medal/Ribbon counts can be shown in forum
 *
 * Revision 1.2  2009/06/26 09:23:12  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/05/20 18:40:33  michiel
 * Translated into Dutch
 *
 *
 *  
 */

define('RANKS_DENIED', 'Je bent niet bevoegd om deze pagina te bekijken');

define('RANKS_01', 'Rangen Systeem');
//define('RANKS_02', 'Vaardigheid');
//define('RANKS_03', 'Teamspel');
//define('RANKS_04', 'Betrokkenheid');
//define('RANKS_05', 'Betrokkenheid (site)');
//define('RANKS_06', 'Gedrag');
//define('RANKS_07', 'Penalty (site)');
define('RANKS_08', 'Opmerkingen');
define('RANKS_09', 'In Gevangenis');
define('RANKS_10', 'Op Proef');
define('RANKS_11', 'Verbannen');
define('RANKS_12', 'Categorieen');
define('RANKS_13', 'Speciaal');
define('RANKS_14', 'Rangen');
define('RANKS_15', 'Rang');
define('RANKS_16', 'Vereiste punten');
define('RANKS_17', 'Vereiste leeftijd');
define('RANKS_18', 'Huidige gebruikers');
define('RANKS_19', 'Nieuwe Gebruiker');
define('RANKS_20', 'Condities');

define('RANKS_CT_01', 'Handmatige toewijzing');
define('RANKS_CT_02', 'Site Betrokkenheid');
define('RANKS_CT_03', 'Site Penalty');

define('RANKS_ED_01', 'Wijzig Rang');
define('RANKS_ED_02', 'Je bent niet bevoegd rangen te wijzigen!');
define('RANKS_ED_03', 'Je bent niet bevoegd je eigen rang te wijzigen!');
define('RANKS_ED_04', 'Verban');
define('RANKS_ED_05', 'De-Verband');
define('RANKS_ED_06', 'Naar Gevangenis');
define('RANKS_ED_07', 'Uit Gevangenis');
define('RANKS_ED_08', 'Op Proef');
define('RANKS_ED_09', 'Uit Proef');
define('RANKS_ED_10', 'Toegang Geweigerd!');
define('RANKS_ED_11', 'Annuleer');
define('RANKS_ED_12', 'Sluit gebruiker uit van leeftijds beperkingen');

define('RANKS_FRM_01', 'Medailles:');
define('RANKS_FRM_02', 'Lintjes:');

define('RANKS_GS_01', 'Jouw ');
define('RANKS_GS_02', '\'s wedde');
define('RANKS_GS_03', 'Beloning voor het ontvangen van de ');
define('RANKS_GS_04', ' medaille');
define('RANKS_GS_05', ' ribbon');

define('RANKS_LOG_01', 'Rang instellingen gewijzigd van');
define('RANKS_LOG_02', 'naar de gevangenis gestuurd');
define('RANKS_LOG_03', 'vrijgelaten uit de gevangenis');
define('RANKS_LOG_04', 'in proeftijd gezet');
define('RANKS_LOG_05', 'uit proeftijd gehaald');
define('RANKS_LOG_06', 'verbannen');
define('RANKS_LOG_07', 'de-verbannen');

define('RANKS_LNK_01', 'Rangen');

define('RANKS_MED_01', 'Medailles');
define('RANKS_MED_02', 'Naam');
define('RANKS_MED_03', 'Categorie');
define('RANKS_MED_04', 'Type');
define('RANKS_MED_05', 'Description');
define('RANKS_MED_06', 'Medaille');
define('RANKS_MED_07', 'Lintje');
define('RANKS_MED_08', 'Leden die deze medaille hebben ontvangen');
define('RANKS_MED_09', 'Leden die dit lintje hebben ontvangen');
define('RANKS_MED_10', 'Niemand');
define('RANKS_MED_11', 'Medailles &amp; Lintjes');
define('RANKS_MED_12', 'Wijzig Medailles');
define('RANKS_MED_13', 'Lid');
define('RANKS_MED_14', 'Reden');
define('RANKS_MED_15', 'Uitgereikt op');
define('RANKS_MED_16', 'Medailles');
define('RANKS_MED_17', 'Lintjes');
define('RANKS_MED_18', 'Alle');
define('RANKS_MED_19', 'Bonus punten');
define('RANKS_MED_20', 'Beloning');

define('RANKS_MED_ED_01', 'Je bent niet bevoegd je eigen medailles te wijzigen!');
define('RANKS_MED_ED_02', 'Je bent niet bevoegd medailles te wijzigen!');
define('RANKS_MED_ED_03', 'Medaille Naam');
define('RANKS_MED_ED_04', 'Datum uitgereikt');
define('RANKS_MED_ED_05', 'Actie');
define('RANKS_MED_ED_06', 'Reik uit');
define('RANKS_MED_ED_07', 'Vorder terug');
define('RANKS_MED_ED_08', 'Terug naar profiel');
define('RANKS_MED_ED_09', 'Opmerkingen');

define('RANKS_RM_01', 'Aanbevelingen');
define('RANKS_RM_02', 'Je bent niet bevoegd aanbevelingen te versturen!');
define('RANKS_RM_03', 'Nomineer voor rang level');
define('RANKS_RM_04', 'Klaag over gedrag');
define('RANKS_RM_05', 'Nomineer voor medaille');
define('RANKS_RM_06', 'Nominatie type');
define('RANKS_RM_07', 'Nomineer lid');
define('RANKS_RM_08', 'Volgende ->');
define('RANKS_RM_09', 'Motivatie');
define('RANKS_RM_10', 'Verzend Aanbeveling');
define('RANKS_RM_11', 'Je aanbeveling is verstuurd!<br>Bedankt.');
define('RANKS_RM_12', 'Je aanbeveling is <strong>NIET</strong> verstuurd!<br>Neem aub contact op met de beheerder.');
define('RANKS_RM_13', 'Toon Aanbevelingen');
define('RANKS_RM_14', 'Van');
define('RANKS_RM_15', 'Voor');
define('RANKS_RM_16', 'Toon');
define('RANKS_RM_17', 'Type');
define('RANKS_RM_18', 'Datum');
define('RANKS_RM_19', 'Geen aanbevelingen');
define('RANKS_RM_20', 'deze gebruiker');
define('RANKS_RM_21', 'Alles');
define('RANKS_RM_22', 'Status');
define('RANKS_RM_23', 'Je hebt nog geen aanbeveling ingediend...');
define('RANKS_RM_24', 'Toon mijn aanbevelingen');

define('RANKS_NF_01', 'Rangk Recommendation');
define('RANKS_NF_02', 'Rank Recommendation submitted');
define('RANKS_NF_03', 'A new recommendation has been submitted by');
define('RANKS_NF_04', 'Recommended member');
define('RANKS_NF_05', 'Recommendation');
define('RANKS_NF_06', 'Motivation');

define('RANKS_PM_01', 'Je hebt een medaille ontvangen!');
define('RANKS_PM_02', 'Je hebt een lintje ontvangen!');
define('RANKS_PM_03', 'Hoi {USER_NAME}!<br/><br/>Gefeliciteerd!<br/>Je hebt de <strong>{MEDAL_NAME}</strong> medaille gekregen!<br/>{MEDAL_IMAGE}');
define('RANKS_PM_04', 'Hpo {USER_NAME}!<br/><br/>Gefeliciteerd!<br/>Je hebt het <strong>{MEDAL_NAME}</strong> lintje gekregen!<br/>{MEDAL_IMAGE}');
define('RANKS_PM_05', 'De reden hiervoor is:<br/><blockquote>{DESCRIPTION}</blockquote>');
define('RANKS_PM_06', 'Bij de ontvangst hiervan heb je ook een beloning van <strong>{MEDAL_REWARD} {GOLD_CURRENCY}</strong> ontvangen.');
define('RANKS_PM_07', 'Je bent gepromoveerd!');
define('RANKS_PM_08', 'Je bent gedegradeerd!');
define('RANKS_PM_09', 'Hoi {USER_NAME}!<br/><br/>Gefeliciteerd!<br/>Je bent gepromoveerd!<br/><br/>Je bent nu een <strong>{RANK_NAME}</strong>!<br/>{RANK_IMAGE}');
define('RANKS_PM_10', 'Hoi {USER_NAME}!<br/><br/>Het spijt me je te moeten informeren dat je gedegradeerd bent!<br/><br/>Je bent nu een <strong>{RANK_NAME}</strong>.<br/>{RANK_IMAGE}');

define('RANKS_UP_01', 'Rang punten:');
define('RANKS_UP_02', 'Medaille bonus:');
define('RANKS_UP_03', 'Totaal:');
define('RANKS_UP_04', 'Volgende rang:');
define('RANKS_UP_05', '<i>Leeftijd limiet</i>');
define('RANKS_UP_06', '-');
define('RANKS_UP_07', '<i>rang is statisch</i>');

?>