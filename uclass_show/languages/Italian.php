<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012 rev. 12 nov 2012 09.42
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

//plugin.php
define("UC_SHOW_01", "Assegna una immagine ad ogni classe utente e la mostra sotto il suo avatar e/o nel profilo personale.");
define("UC_SHOW_02", "UserClass SHOW");
define("UC_SHOW_03", "UserClass SHOW è stato installato. Per la configurazione iniziale premi qui");
define("UC_SHOW_04", "UserClass SHOW è stato aggiornato.");
define("UC_SHOW_05", "Impostazioni salvate");

//admin config
define("UC_SHOW_ADM_01", "Configurazione di UserClass SHOW");
define("UC_SHOW_ADM_02", "Attenzione!<br />hai già caricato questo file");
define("UC_SHOW_ADM_03", "Estensione non ammessa");
define("UC_SHOW_ADM_04", "non puoi caricare files con questa estensione");
define("UC_SHOW_ADM_05", "Assegna una immagine alle classi esistenti");
define("UC_SHOW_ADM_06", "nome");
define("UC_SHOW_ADM_07", "descrizione");
define("UC_SHOW_ADM_08", "immagine attuale");
define("UC_SHOW_ADM_09", "carica immagine  (max larghezza consigliata:");
define("UC_SHOW_ADM_10", "immagini disponibili");
define("UC_SHOW_ADM_11", "l'immagine è stata cancellata, devi ricaricarla o assegnarne una diversa");
define("UC_SHOW_ADM_12", "nessuna immagine assegnata");
define("UC_SHOW_ADM_13", "carica");
define("UC_SHOW_ADM_14", "non ci sono immagini");
define("UC_SHOW_ADM_15", "assegna");
define("UC_SHOW_ADM_16", "Attenzione!<br />più classi utente usano la stessa immagine");
define("UC_SHOW_ADM_17", "Non hai ancora configurato delle classi utente (gruppi Utenti)<br />configurale adesso, anche da qui <a href ='".e_ADMIN."userclass2.php' title='gruppi utenti'><img src='".e_PLUGIN."uclass_show/images/conf_class.png' alt=''/></a>");
define("UC_SHOW_ADM_18", "Il plugin è");
define("UC_SHOW_ADM_19", "DISATTIVATO");
define("UC_SHOW_ADM_20", "ATTIVATO");
define("UC_SHOW_ADM_21", "Menu di configurazione");
define("UC_SHOW_ADM_22", "Attiva o disattiva il plugin. Se disattivato nessuna configurazione è possibile a meno della gestione delle immagini (sopra)");
define("UC_SHOW_ADM_23", "Visualizza nel forum");
define("UC_SHOW_ADM_24", "Se attivi questa opzione le immagini di \"classe utente\" che hai impostato verranno visualizzate sotto l'avatar nel forum.");
define("UC_SHOW_ADM_25", "Visualizza nei commenti");
define("UC_SHOW_ADM_26", "Se attivi questa opzione le immagini di \"classe utente\" che hai impostato verranno visualizzate sotto l'avatar nei commenti.");
define("UC_SHOW_ADM_27", "Visualizza nel profilo utente");
define("UC_SHOW_ADM_28", "Se attivi questa opzione le immagini di \"classe utente\" che hai impostato verranno visualizzate nel profilo dell'utente.");
define("UC_SHOW_ADM_29", "Numero delle immagini");
define("UC_SHOW_ADM_30", "Se hai creato tante classi utente ed hai quindi troppe immagini da mostrare, qui puoi decidere il numero massimo. Per default è 5.<br />Comunque, se selezionata lopzione corrispondente, nella pagina del profilo utente verranno mostrate tutte le immagini di tutti i gruppi di appartenenza.");
define("UC_SHOW_ADM_31", "Nascondi agli ospiti");
define("UC_SHOW_ADM_32", "Attivando questa opzione solo gli utenti registrati e loggati potranno vedere le immagini delle classi di appartenenza dell'utente.");
define("UC_SHOW_ADM_33", "Mostra nome del gruppo");
define("UC_SHOW_ADM_34", "Attivando questa opzione ogni immagine di classe sarà accompagnata, con effetto onmouse over, dal nome del gruppo che rappresenta.");
define("UC_SHOW_ADM_35", "Salva le impostazioni");
define("UC_SHOW_ADM_36", "ed altre: ");
define("UC_SHOW_ADM_37", "seleziona");
//upgrade 1.01 12 nov 12
define("UC_SHOW_ADM_38", "Uso template custom");
define("UC_SHOW_ADM_39", "seleziona per attivare");
define("UC_SHOW_ADM_40", "per il forum:");
define("UC_SHOW_ADM_41", "per i commenti");
define("UC_SHOW_ADM_42", "per profilo utente");
define("UC_SHOW_ADM_43", "Questa opzione ti consente di sostituire le shortcodes di default di e107, nel caso tu utilizzi dei template customizzati per il forum, per i commenti o per il profilo utente.<br /><span style='color:#861e03;font-weight:bold;'>Attenzione!</span> quello che scriverai nelle caselle di testo qui a fianco verrà salvato nel core del CMS ed usato nelle pagine che utilizzano quei template. Devi inserire unicamente codice di cui sei assolutamente sicuro (ad esempio {AVATARSTATUS} o {FS_AVATAR} provenienti dagli sviluppatori del template custom che utilizzi). <strong>L'inserimento di altro codice potrebbe esporre a seri rischi il tuo sito.</strong>");
define("UC_SHOW_ADM_44", "Per default questo plugin cerca e sostituisce le seguenti shortcodes:<br /> {AVATAR} per il forum e per i commenti;<br />{USER_LOGINNAME} per il profilo utente.");

//admin menu
define("UC_SHOW_ADM_OPT_01", "Opzioni di UserClass SHOW");
define("UC_SHOW_ADM_OPT_02", "Configurazione");
define("UC_SHOW_ADM_OPT_03", "Informazioni");
define("UC_SHOW_ADM_OPT_04", "Suggerimenti");

//admin readme
define("UC_SHOW_README_01", "UserClass_Show permette di assegnare delle immagini ad ogni gruppo utente creato in e107 e mostrarle sotto l'avatar di ogni Utente appartenente a quella classe (gruppo).");
define("UC_SHOW_README_02", "La particolarità di UserClass_Show è quella di permettere all'utente la totale gestione delle immagini direttamente dal pannello di controllo, senza necessità alcuna di editare files, inserire shortcodes o caricare immagini via FTP. Tutto viene gestito dal pannello di controllo del plugin, che automaticamente pulisce le proprie tabelle, controlla le immagini ed avverte l'utente ad ogni cambiamento significativo nella gestione delle classi utente di e107.");
define("UC_SHOW_README_03", "</strong>Funzioni del plugin</strong>:<br />assegna immagini ad ogni gruppo utente creato;<br />carica le immagini direttamente dal suo pannello di controllo (necessita permessi upload di e107 settati. Vds documentazione e107);<br />avviso in caso di immagine inesistente e/o cancellata;<br />avviso se due o più classi usano la stessa immagine;<br />avviso se vengono caricati files con estensioni non ammesse;<br />rilevamento automatico delle dimensioni impostate da e107 per l'avatar e ridimensionamento proporzionale delle immagini di gruppo;<br />possibilità di browsing di tutte le immagini caricate per successive riassegnazioni;<br />anteprima delle immagini caricate;<br />possibilità di scelta, singola o multipla, delle sezioni dove mostrare le immagini (forum, commenti, profilo utente);<br />possibilità di nascondere agli ospiti le immagini di gruppo;<br />possibilità di limitare il numero delle immagini mostrate ad un valore preimpostabile dal pannello di controllo;<br />possibilità di visualizzare o nascondere la descrizione dell'immagine di gruppo.");
define("UC_SHOW_README_04", "<strong>Considerato che il plugin lavora sui template originali di e107, gli utenti che utilizzano template customizzati possono trovare informazioni utili nella pagina \"suggerimenti\" del plugin stesso.</strong>");

//admin tips
define("UC_SHOW_TIPS_01", "Questo plugin lavora sui template originali di e107. Questo implica che, se usi dei template customizzati  (forum_viewtopic, comments, user), la visualizzazione delle immagini di gruppo potrebbe essere viziata da errori e, in qualche caso, non avvenire. Di seguito alcuni suggerimenti.");
define("UC_SHOW_TIPS_02", "Nel caso si usassero shortcodes provenienti da custom template di terze parti , come nel caso del custom avatar scaricabile da e107works.org, la mod che visualizza lo stato online/offline dell'utente, è possibile attivare l'opzione \"<strong>usa template custom</strong>\". Utilizzando questa funzione è possibile inserire a mano la shortcode da utilizzare, ove essa sia differente da quella di default di e107. Il menu relativo spiega comunque ed esattamente come intervenire");
define("UC_SHOW_TIPS_03", "Gli utenti più esperti, lavorando sul file <strong>e_meta.php</strong> contenuto in questo plugin, possono inoltre correggere non solo le shortcodes utilizzate da template customizzati, ma anche intervenire sul codice HTML per migliorare o adattare la visualizzazione , se necessario.");
define("UC_SHOW_TIPS_04", "Il plugin configura automaticamente i permessi (CHMOD) della cartella di upload immagini. Se in qualche caso l'upload dal pannello di controllo non dovesse andare a buon fine, <strong>dopo aver verificato i permessi di caricamento di e107 (IMPORTANTE !)</strong> , verificate se la cartella <strong>uclass_show/class_images</strong> ha i permessi <strong>0755</strong> o quelli che il tuo server richiede.");
define("UC_SHOW_TIPS_05", "In ogni caso queste operazioni non saranno necessarie per la maggior parte degli utenti, ma se dovessi incontrare problemi puoi richiedere assistenza <a href='http://www.e107works.org/e107_plugins/forum/forum_viewforum.php?11' title='FAQ'>==>qui</a> e risolveremo molto velocemente.");

?>