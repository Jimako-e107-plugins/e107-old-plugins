<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/

// admin_menu.php // Added by e107 Italia
define("TUT_ADMIN_MENUTITLE", "Opzioni Archivio Tutorial");
define("TUT_ADMIN_MENU_1", "Preferenze");
define("TUT_ADMIN_MENU_2", "Nuova Categoria");
define("TUT_ADMIN_MENU_3", "Elimina Categoria");
define("TUT_ADMIN_MENU_4", "Nuovo Tutorial");
define("TUT_ADMIN_MENU_5", "Elimina Tutorial");
define("TUT_ADMIN_MENU_6", "Vedi Tutorial inviati");
define("TUT_ADMIN_MENU_7", "Vedi Statistiche");

// admin_add.php // Added by e107 Italia
define("TUT_ADMIN_SELECT", "-- Seleziona --");



define("TUT_TITLE", "Archivio Tutorial");
define("TUT_ADMIN_TITLE", "Gestione Archivio Tutorial");
define("TUT_PREVIEW_TITLE", "Anteprima...");
define("TUT_SUBM_TITLE", "Tutorial inviati dagli utenti");
define("TUT_SUBM_AUTH", "Spiacenti, non hai i permessi per inviare un tutorial."); // missing string Added by e107 Italia

define("TUT_MSSG_CHANGE", "Impostazioni configurazione modificate...");
if($pref['tuts_menulist'] == 'new'){
	define("TUT_MENU_TITLE", "Tutorial Recenti");
}else if($pref['tuts_menulist'] == 'views'){
	define("TUT_MENU_TITLE", "Tutorial pi&ugrave; letti");
}else{
	define("TUT_MENU_TITLE", "Top Tutorial valutati");
}

define("TUT_ERROR_ADDCAT", "Errore: Impossibile aggiungere nuova categoria al database.");
define("TUT_SUCC_ADDCAT", "Nuova categoria inserita con successo...");
define("TUT_ERROR_ADDTUT", "Errore: Impossibile aggiungere nuovo tutorial al database.");
define("TUT_SUCC_ADDTUT", "Nuovo tutorial inserito con successo...");
define("TUT_ERROR_MISS", "Errore: Un Campo obbligatorio non &egrave; stato compilato...");

define("TUT_CONF_L1", "<b>Criterio Ordinamento Categoria</b><br />Scegli con quale criterio vuoi ordinare le categorie.");
define("TUT_CONF_L6", "<b>Direzione Ordinamento Categoria</b><br />Ascendente o Discendente.");
define("TUT_CONF_L9", "<b>Criterio Ordinamento Tutorial</b><br />Scegli con quale criterio vuoi ordinare i tutorial.");
define("TUT_CONF_L12", "<b>Direzione Ordinamento Tutorial</b><br />Ascendente o Discendenteg.");
define("TUT_CONF_L21", "<b>Numero Tutorial per Pagina</b><br />Il numero di tutorial elencati in ciascuna pagina.");
define("TUT_CONF_L16", "<b>Impostazione Menu Avanzato</b><br />Quali tutorials vuoi visualizzare nel Menu Avanzato.");
define("TUT_CONF_L20", "<b>Numero nel Menu</b><br />Quanti tutorial vuoi mostrare nel Menu Avanzato.");
define("TUT_CONF_L24", "<b>Consenti l'invio di tutorial da parte degli Utenti</b>");
define("TUT_CONF_L22", "<b>Consenti l'invio email di Notifica agli Utenti</b><br />Send an email to the user who submitted their tutorial when it has been approved.");
define("TUT_CONF_L23", "<b>Eliminare il tutorial inviato dopo il Timeout</b><br />Eliminare il tutorial inviato dopo un certo numero di secondi. Lasciare 0 per nessun timeout.");

define("TUT_CONF_L2", "ID (ordine di invio)");
define("TUT_CONF_L3", "Titolo");
define("TUT_CONF_L4", "Autore");
define("TUT_CONF_L5", "Tutorial archiviato");
define("TUT_CONF_L7", "Discendente");
define("TUT_CONF_L8", "Ascendente");
define("TUT_CONF_L10", "Letture");
define("TUT_CONF_L11", "Data accettazione");
define("TUT_CONF_L17", "Pi&ugrave; recente");
define("TUT_CONF_L18", "Pi&ugrave; letto");
define("TUT_CONF_L19", "Pi&ugrave; votato");

define("TUT_TADD_L1", "<b>Categoria:</b><br />In quale categoria vuoi inserire il tutorial?");
define("TUT_TADD_L2", "<b>Titolo Tutorial:</b><br />Il titolo del tutorial, assicurati che sia in qualche modo pertinente con il contenuto del  tutorial.");
define("TUT_TADD_L3", "<b>Breve Descrizione:</b><br />Una breve descrizione di ci&ograve; che il tutorial descrive.");
define("TUT_TADD_L4", "<b>Descrizione completa:</b><br />Il testo completo del tutorial.");
define("TUT_TADD_L5", "<b>Icona Tutorial</b><br />Scegli un'icona per questo tutorial.<br />(puoi anche utilizzare l'URL all'immagine di un altro sito");
define("TUT_TADD_L6", "Nessuna icona presente in questa directory...");

define("TUT_ADD_L", "<b></b><br />");

define("TUT_CADD_L1", "<b>Nome Categoria:</b><br />Qual &egrave; il nome scelto per questa categoria?");
define("TUT_CADD_L2", "<b>Descrizione Categoria:</b><br />Un breve testo per descrivere il contenuto di questa categoria.");
define("TUT_CADD_L3", "<b>Icona Categoria</b><br />Scegli un'icona per questa categoria.<br />(puoi anche utilizzare l'URL all'immagine di un altro sito)");
define("TUT_CADD_L4", "Nessuna icona presente in questa directory..");

define("TUT_BUTTON_VIEWICON", "Vedi Icone");
define("TUT_BUTTON_SUBMIT", "Salva");
define("TUT_BUTTON_PREVIEW", "Anteprima");
define("TUT_BUTTON_RESET", "Reimposta");
define("TUT_BUTTON_REMOVE", "Elimina");

define("TUT_VIEW_VIEWS", "letture");
define("TUT_VIEW_BY", "di:");
define("TUT_VIEW_ON", "data:");
define("TUT_VIEW_IN", "in");
define("TUT_VIEW_INDEXED", "tutorial");
define("TUT_VIEW_NOTUTS", "Non sono presenti tutorial archiviati in questa categoria.");

define("TUT_ACC_ACCEPT", "Accetti questo tutorial inviato e vuoi visualizzarlo pubblicamente?");
define("TUT_ACC_REJECT", "Rifiuti questo tutorial inviato?");
define("TUT_ACC_REASON", "Prego inserisci una motivazione del rifiuto.");
define("TUT_ACC_COMPL_ACCEPT", "Tutorial accettato con successo...");
define("TUT_ACC_FAIL_ACCEPT", "Impossibile accettare Tutorial...");
define("TUT_ACC_COMPL_REJECT", "Tutorial rifiutato...");
define("TUT_ACC_FAIL_REJECT", "Tutorial non pu&ograve; essere rifiutato...");
define("TUT_ACC_COMPL_EMAIL", "Email inviata a {USERMAIL}.");
define("TUT_ACC_FAIL_EMAIL", "Impossibile inviare email a {USERMAIL}.");
define("TUT_ACC_SHORTDESC", "Breve Descrizione:");

define("TUT_REM_CAT_METHOD_DELETE", "Elimina Tutto");
define("TUT_REM_CAT_METHOD_MOVE", "Sposta in -> ");
define("TUT_REM_CAT_SUCC", "Categoria eliminata con successo...");
define("TUT_REM_CAT_FAIL", "Impossibile eliminare categoria!");
define("TUT_REM_CAT_DEL_SUCC", "Tutorial eliminato con successo...");
define("TUT_REM_CAT_DEL_FAIL", "Impossibile eliminare Tutorial!");
define("TUT_REM_CAT_MOV_SUCC", "Tutorial spostato con successo...");
define("TUT_REM_CAT_MOV_FAIL", "Impossibile spostare Tutorial!");
define("TUT_REM_CAT_NOEXIST", "La categoria selezionata non esiste!");
define("TUT_REM_TUT_SUCC", "Tutorial eliminato con successo...");
define("TUT_REM_TUT_FAIL", "Impossibile eliminare Tutorial!");
define("TUT_REM_TUT_NOEXIST", "Il tutorial selezionato non esiste!");

define("TUT_STATS_ICON", "Icona");
define("TUT_STATS_NAME", "Nome");
define("TUT_STATS_AUTHOR", "Autore");
define("TUT_STATS_VIEWS", "Letture");
define("TUT_STATS_INDEXED", "In archivio");

define("TUT_SUBM_AGREE", "Inviando questo tutorial l'utente accetta di assumersi la piena responsabilit&agrave; per eventuale plagio e/o violazione diritti d'autore. Inoltre, l'utente accetta che l'amministratore del sito ha il pieno diritto di tutto il contenuto all'interno del tutorial e pu&ograve; eventualmente modificarlo. Se non si accettano questi termini, non inviare questo modulo.");
define("TUT_SUBM_THANKS", "Grazie per il tuo articolo.<br />Verr&agrave; visionato da un amministratore e, se approvato, verr&agrave; pubblicato.");
define("TUT_SUBM_LINK", "Invia un Tutorial");


define("TUT_EMAIL_SUBJ_ACCEPT", "Il tuo tutorial &egrave; stato accettato!");
define("TUT_EMAIL_SUBJ_REJECT", "Il tuo tutorial non &egrave; stato accettato.");
define("TUT_EMAIL_MESSAGE_ACCEPT", "Congratulazioni, {USERNAME}!<br />Il tutorial che hai inviato a {SITENAME} &egrave; stato accettato ed &egrave; ora visibile pubblicamente.<br /><br/>Per visualizzare il tutorial, si prega di cliccare sul link sottostante. Per domande o dubbi riguardanti il tuo tutorial o il suo utilizzo, si prega di contattare l'amministratore al seguente indirizzo {ADMINEMAIL}.<br /><br/>Clicca qui per visualizzare il tutorial: {TUTLINK}<br />");
define("TUT_EMAIL_MESSAGE_REJECT", "{USERNAME},  il tutorial che hai inviato a {SITENAME} non &egrave; stato accettato per il seguente motivo:<br /><br />{REJECTREASON}<br /><br />Per dubbi o domande, si prega di contattare l'amministratore al seguente indirizzo {ADMINEMAIL}");



if (defined("RATELAN_0")) define("TUT_RATELAN_0", RATELAN_0); else define("TUT_RATELAN_0", "voto");
if (defined("RATELAN_1")) define("TUT_RATELAN_1", RATELAN_1); else define("TUT_RATELAN_1", "voti");
if (defined("RATELAN_2")) define("TUT_RATELAN_2", RATELAN_2); else define("TUT_RATELAN_2", "Come valuti questo articolo?");
if (defined("RATELAN_3")) define("TUT_RATELAN_3", RATELAN_3); else define("TUT_RATELAN_3", "Grazie per il tuo voto.");
if (defined("RATELAN_4")) define("TUT_RATELAN_4", RATELAN_4); else define("TUT_RATELAN_4", "Non valutato.");
if (defined("RATELAN_5")) define("TUT_RATELAN_5", RATELAN_5); else define("TUT_RATELAN_5", "Valutazione");
?>