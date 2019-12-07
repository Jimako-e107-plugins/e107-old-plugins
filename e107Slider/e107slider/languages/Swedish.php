<?php
/*
 * e107Slider Plugin v0.1
 *
 * Copyright (C) 2007-2012 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 1 $
 * $Date: 25/05/2012 $
 * $Author: leonlloyd $
 *
*/

/* PLUGIN LANGUAGES */

define(ES_PLUGIN_1, 'e107 bildspel');
define(ES_PLUGIN_2, 'Inställningarna sparade');
define(ES_PLUGIN_3, 'Spara inställningarna');
define(ES_PLUGIN_4, 'e107 bildspel');
define(ES_PLUGIN_5, 'e107 nyhetsartiklar');
define(ES_PLUGIN_6, 'e107 bildspelsprogram');

/*admin_menu.php*/
define(ES_PLUGIN_MU_1, 'Bildspel');
define(ES_PLUGIN_MU_2, 'Nyhetsartiklar');
define(ES_PLUGIN_MU_3, 'Inställningar för bildspel');
define(ES_PLUGIN_MU_4, 'Programdetaljer');
define(ES_PLUGIN_MU_5, 'Vanilla tema');
define(ES_PLUGIN_MU_6, '<p>Skapa ett obegränsat antal unika webbplatser med det mest kraftfulla e107-temat på marknaden!</p><p><a href="http://www.xenthemes.com/product/e107/vanilla/">Se detaljer om temat Vanilla</a></p>');

/*admin_slider_settings.php*/
define(ES_PLUGIN_SS_1, 'Inställningar för bildspel');
define(ES_PLUGIN_SS_2, 'Auto-starta bildspelet:');
define(ES_PLUGIN_SS_3, 'Övergångshastighet:');
define(ES_PLUGIN_SS_4, 'Paus:');
define(ES_PLUGIN_SS_5, 'Visa sidor:');
define(ES_PLUGIN_SS_6, 'Visa kontroller:');
define(ES_PLUGIN_SS_7, 'Slumpmässig visning:');
define(ES_PLUGIN_SS_8, 'Pausa vid hovring:');
define(ES_PLUGIN_SS_9, 'Pausa vid ctrl-hovring');
define(ES_PLUGIN_SS_10, 'ID');
define(ES_PLUGIN_SS_11, 'Rubrik');
define(ES_PLUGIN_SS_12, 'Bild');
define(ES_PLUGIN_SS_13, 'Länk');
define(ES_PLUGIN_SS_14, 'Alternativ');
define(ES_PLUGIN_SS_15, 'Antal poster att visa:');
define(ES_PLUGIN_SS_16, 'Menyrubrik:');
define(ES_PLUGIN_SS_17, 'Lägg till en bild');

/*admin_slider.php*/
define(ES_PLUGIN_SL_1, 'Ändra en bild');
define(ES_PLUGIN_SL_2, 'Lägg till bilder');
define(ES_PLUGIN_SL_3, 'Rubrik<span class="smalltext">Valfritt</span>');
define(ES_PLUGIN_SL_4, 'Bildtext<span class="smalltext">Valfritt</span>');
define(ES_PLUGIN_SL_5, 'Bild');
define(ES_PLUGIN_SL_6, 'Länk URL<span class="smalltext">Valfritt</span>');
define(ES_PLUGIN_SL_7, 'Spara inställningarna');
define(ES_PLUGIN_SL_8, 'Spara');

/*plugin.php*/
define(ES_PLUGIN_PL_2, 'Programmet installerades utan problem!');
define(ES_PLUGIN_PL_3, 'Programmet uppdaterades utan problem!');

/*admin_config.php*/
define(ES_PLUGIN_CF_1, 'Programdetaljer');
define(ES_PLUGIN_CF_2, 'e107 bildspel är ett lätt och responsivt bildspel byggt med ResponsiveSlides.js. Programmet har två menyer, ett <a href=\''.e_PLUGIN.'e107slider/admin_slider_settings.php\'>bildspel</a> och <a href=\''.e_PLUGIN.'e107slider/admin_news_slider_settings.php\'>nyhetsartiklar</a>.');
define(ES_PLUGIN_CF_3, 'ResponsiveSlides.js är ett litet jQuery program som skapar ett responsivt bildspel baserat på innehållet i listor &#60;ul&#62;. Det fungerar med en lång rad webbläsare, inklusive alla IE-versioner från IE6 och upp. Det lägger även till css max-width för IE6 och andra webbläsare som saknar stöd för detta. Det enda kravet är att <strong>alla bilder håller samma storlek</strong>.');
define(ES_PLUGIN_CF_4, 'Den största skillnaden mot andra bildspel är filstorleken (1 kb gzippad).');
define(ES_PLUGIN_CF_5, 'Instruktioner');
define(ES_PLUGIN_CF_6, 'Bildspelsmenyn visar bilder och eventuell bildtext, bilderna kan länkas. Menyn har ett antal inställningar som kan <a href=\''.e_PLUGIN.'e107slider/admin_slider_settings.php\'>konfigureras under inställningarna</a>.');
define(ES_PLUGIN_CF_7, 'Lägg till bilder i <code>e107_plugins/e107slider/slides/</code> och välj vilken bild du vill använda under \'Lägg till bilder\'. <strong>Alla bilder måste vara av samma bredd och höjd</strong>. Du kan även lägga till bildtext och länk för varje bild. Bildtexter får innehålla HTML.');
define(ES_PLUGIN_CF_8, 'Menyn för nyhetsartiklar visar bildspel med ikon och rubrik från dina senaste nyhetsartiklar. <strong>Alla bilder måste ha samma bredd och höjd</strong>. Du kan välja antalet nyhetsartiklar som skall visas i bildspelet under <a href=\''.e_PLUGIN.'e107slider/admin_news_slider_settings.php\'>inställningarna för nyhetsartiklar</a>.');
define(ES_PLUGIN_CF_9, 'Licens');