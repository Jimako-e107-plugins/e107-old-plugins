<?php
/*
*************************************
*        Signup Secure				*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
define("SS_FAIL", "Ihr Ergebnis war leider nicht korrekt. Bitte versuchen Sie es erneut.");
define("SS_BACK", "Zurück");
define("SS_REQUEST", "Bitte rechnen Sie folgende kleine Rechnung aus, um zu beweisen, dass Sie ein Mensch sind.");
define("SS_SEND", "Absenden");
define("SS_INQ", "Unterstützt durch ");

define("SS_README", "
<p>Mit diesem Plugin helfen Sie sich selber Ihre Homepage vor sog. Spam-Bots zu schützen. Diese Bots durchsuchen das Internet nach Webseiten, die auf dem CMS e107 aufgebaut sind. Sobald sie eine gefunden haben registrieren sie sich automatisch und beginnen dann in einigen Abständen Posts in Forum und Newskommentare zu setzen, welche mit Links zu anderen Seiten durchsetzt sind. Dadurch erhalten diese Seiten sog. Backlinks wodurch sie bei Google und Co. nach oben schießen.</p>
<p>Das Plugin allein kann Sie natürlich nicht vor allen Angriffen schützen, ist aber ein erster Schritt in die richtige Richtung. Hier ein paar Tipps wie sie Ihre Webseite noch sicherer machen können:</p>
<ol>
  <li>Verbieten Sie Einträge in Foren und Kommentaren für Gäste.</li>
  <li>Verbieten Sie an jeder anderen Stelle (außer ein gut gesichertes Gästebuch oder Kontaktformular) dass Gäste Einträge oder Einstellungen machen können.</li>
  <li>Sichern Sie regelmäßig Ihre Datenbanken.</li>
  <li>Halten Sie ihr e107 auf dem aktuellen Stand.</li>
  <li>Löschen Sie Spammer, die wie oben beschrieben handeln, nicht einfach sondern bannen Sie die betreffende IP sowie die betreffende E-Mailadresse.</li>
</ol>
<p>
<br /><br />
Version 1.1:
<blockquote>Seiten die COPPA in der Registration verwenden, werden nun vollständig unterstützt. Vielen Dank an C6Dave für den Hinweis!</blockquote>
<br /><br />
<table class='fborder' style='width:95%'>
	<tr>
		<td class='fcaption' valign='middle'>
			<a href='http://oyabunstyle.de' target='blank'>
				<img align='left' alt='oyabunstyle.de' src='http://www.oyabunstyle.de/e107_images/custom/LinkMe/LU88.jpg' style='margin:10px;'>
			</a>
			<br />
			Zögern Sie nicht mich bei Fragen, Vorschlägen oder erkannten Fehlern zu kontaktieren.<br />
			Oder besuchen Sie mich einfach mal so auf <a href='http://oyabunstyle.de' target='blank'>Oyabunstyle.de</a>.
			Ich freue mich auf Ihren Besuch!
		</td>
	</tr>
</table>
<br /><br />
<table class='fborder' style='width:95%'>
	<tr>
		<td class='fcaption' valign='middle'>
			<a href='http://oyabunstyle.de' target='blank'>
				<img align='left' alt='e107-german.de' src='http://www.e107-german.de/e107_images/banners/e107german.png' style='margin:10px;'>
			</a>
			<br /><br />
			Besuchen Sie auf jeden Fall auch <a href='http://e107-german.de' target='blank'>e107-german.de</a>.<br />
			Hier gibt es tiefer gehende Hilfe zu allen Themen rund um das CMS e107!<br />
			Ich freue mich auf Ihren Besuch!
		</td>
	</tr>
</table></p>
");
?>