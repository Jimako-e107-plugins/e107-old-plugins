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

define(ES_PLUGIN_1, 'e107Слайдер');
define(ES_PLUGIN_2, 'Настройките са записани успешно!');
define(ES_PLUGIN_3, 'Запиши настройките');
define(ES_PLUGIN_4, 'e107 Слайдер картинки');
define(ES_PLUGIN_5, 'e107 Слайдер новини');
define(ES_PLUGIN_6, 'Модул e107Слайдер');

/*admin_menu.php*/
define(ES_PLUGIN_MU_1, 'Слайдер картинки');
define(ES_PLUGIN_MU_2, 'Слайдер новини');
define(ES_PLUGIN_MU_3, 'Настройки на слайдер');
define(ES_PLUGIN_MU_4, 'Детайли за модула');
define(ES_PLUGIN_MU_5, 'Тема Vanilla');
define(ES_PLUGIN_MU_6, '<p>Изградете неограничен брой уникални сайтове с най-мощната e107 тема на пазара!</p><p><a href="http://www.xenthemes.com/product/e107/vanilla/">Виж детайли за темата Vanilla</a></p>');

/*admin_slider_settings.php*/
define(ES_PLUGIN_SS_1, 'Настройки на слайдера');
define(ES_PLUGIN_SS_2, 'Авто-старт слайдер:');
define(ES_PLUGIN_SS_3, 'Скорост на смяна:');
define(ES_PLUGIN_SS_4, 'Време на пауза:');
define(ES_PLUGIN_SS_5, 'Покажи страници:');
define(ES_PLUGIN_SS_6, 'Покажи контроли:');
define(ES_PLUGIN_SS_7, 'Показвай слайдовете случайно:');
define(ES_PLUGIN_SS_8, 'Пауза при минаване с мишката:');
define(ES_PLUGIN_SS_9, 'Пауза при минаване с мишката на контрол');
define(ES_PLUGIN_SS_10, 'ИД');
define(ES_PLUGIN_SS_11, 'Заглавие');
define(ES_PLUGIN_SS_12, 'Картинка');
define(ES_PLUGIN_SS_13, 'Линк');
define(ES_PLUGIN_SS_14, 'Опции');
define(ES_PLUGIN_SS_15, 'Брой постове за показване:');
define(ES_PLUGIN_SS_16, 'Заглавие на меню:');
define(ES_PLUGIN_SS_17, 'Добави слайд');

/*admin_slider.php*/
define(ES_PLUGIN_SL_1, 'Редактирай слайд');
define(ES_PLUGIN_SL_2, 'Добави слайдове');
define(ES_PLUGIN_SL_3, 'Наименование<span class="smalltext">Опция</span>');
define(ES_PLUGIN_SL_4, 'Заглавие<span class="smalltext">Опция</span>');
define(ES_PLUGIN_SL_5, 'Картинка');
define(ES_PLUGIN_SL_6, 'Линк<span class="smalltext">Опция</span>');
define(ES_PLUGIN_SL_7, 'Запиши промените');
define(ES_PLUGIN_SL_8, 'Добави');

/*plugin.php*/
define(ES_PLUGIN_PL_2, 'Модула е инсталиран успешно!');
define(ES_PLUGIN_PL_3, 'Модула е обновен успешно!');

/*admin_config.php*/
define(ES_PLUGIN_CF_1, 'Детайли за модула');
define(ES_PLUGIN_CF_2, 'Модулът e107Слайдер е лек и отзивчив слайдер, построен с помощта на ResponsiveSlides.js. Модулът има две менюта, един <a href=\''.e_PLUGIN.'e107slider/admin_slider_settings.php\'>слайдер за картинки</a> и един <a href=\''.e_PLUGIN.'e107slider/admin_news_slider_settings.php\'>слайдер за новини</a>.');
define(ES_PLUGIN_CF_3, 'ResponsiveSlides.js е малък JQuery плъгин, който създава отзивчив слайдер, използвайки списъчни елементи вътре в &#60;ul&#62;. Той работи с широк кръг от браузъри, включително всички версии на IE от IE6 нагоре. Той добавя също, CSS максимална ширина поддръжка за IE6 и други браузъри, които по принцип не я поддържат. Единствената му особеност е, че <strong>всички изображения трябва да са с еднакъв размер</strong>.');
define(ES_PLUGIN_CF_4, 'Най-голямата разлика с други отзивчиви слайдер плъгини е размерът на файла (1kb минимизиран и компресиран).');
define(ES_PLUGIN_CF_5, 'Инструкции');
define(ES_PLUGIN_CF_6, 'Меню Слайдер Картинки показва изображения на слайдове и по избор надпис, на слайдовет може също да бъде даден линк. В менюто има редица настройки, които могат да бъдат конфигурирани от <a href=\''.e_PLUGIN.'e107slider/admin_slider_settings.php\'>Настройки Слайдер Картинки</a>.');
define(ES_PLUGIN_CF_7, 'Добавяйте картинките в <code>e107_plugins/e107slider/slides/</code> и после изберете коя картинка ще използвате, когато \'Добавите слайд\'. <strong>Всички картинки трябва да са с еднакви размери</strong>. Можете да добавите по избор надпис или да създадете линк за всеки слайд. Надписите може да съдържат HTML.');
define(ES_PLUGIN_CF_8, 'Меню Слайдер Новини ще покаже последните публикувани изображения новините и техните заглавия в отзивчив слайдер. Слайдовете се генерират от изображенията в новините, който се поставят, когато създавате новина. <strong>Всички картинки трябва да са с еднакви размери</strong>. Вие може да избирате колко новини да се покажат в <a href=\''.e_PLUGIN.'e107slider/admin_news_slider_settings.php\'>Настройки Слайдер новини</a>.');
define(ES_PLUGIN_CF_9, 'Лиценз');