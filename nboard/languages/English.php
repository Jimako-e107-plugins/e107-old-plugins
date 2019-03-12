<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
/*---------------info plugin--------------------*/
define('NB_INFO',"Notice Board");
define('NB_EDIT',"Board settings");
define('NB_ABOUT',"Notice-Board. The free e107 Notice board plugin.");
define('NB_INSTALL',"Notice Board is successfully installed");
define('NB_UNINSTALL',"Notice Board is successfully uninstalled");
define('NB_AUTHOR_NAME',"ComPolyS Team");
define('NB_AUTHOR_SITE',"http://e107.compolys.ru");
define('NB_AUTHOR_MAIL',"sunout@compolys.ru");
define('NB_CODERS',"programmers");
define('NB_CODERS_NAME',"Sunout (Kazancev Sergey), Geo (Georgy Matveev)");
define('NB_TRANSLATOR',"language officer");
define('NB_TRANSLATOR_NAME',"Georgy Pyankov");
/*---------------menu---------------------------*/
define('NB_ADMIN_MENU',"Admin Menu");
/*--------------config--------------------------*/
define('NB_CON_MENU',"Configurations");
define('NB_CONF_00',"Notice Board settings");
define('NB_CONF_01',"Admin email");
define('NB_CONF_02',"The notice is valid unitl (days)");
define('NB_CONF_03',"Date format");
define('NB_CONF_04',"Reduce the downloadable image to");
define('NB_CONF_05',"Reduce the downloadable image icon to");
define('NB_CONF_06',"The quantity of columns to display categories");
define('NB_CONF_07',"The quantity of ads displayed on the first page");
define('NB_CONF_08',"Security Question");
define('NB_CONF_09',"Answer to the Security Question");
define('NB_CONF_10',"Permit renewal for (days)");
define('NB_CONF_11',"Allow comment boards?");
/*---------------category-----------------------*/
define('NB_CAT_MENU',"Categories");
define('NB_CAT_00',"Management of the Categories");
define('NB_CAT_01',"Categories");
define('NB_CAT_02',"Category");
define('NB_CAT_03',"Category Name");
define('NB_CAT_04',"Caterogy Info");
define('NB_CAT_05',"Select the category");
define('NB_SCAT_MENU',"Sub-categories");
define('NB_SCAT_00',"Management of the Sub-categories");
define('NB_SCAT_01',"Sub-categories");
define('NB_SCAT_02',"Sub-category");
define('NB_SCAT_03',"Sub-category Name");
define('NB_SCAT_04',"Sub-categories of the Ads");
define('NB_SCAT_05',"Select the sub-category");
define('NB_SCAT_06',"Move the category to");
define('NB_SCAT_07',"Select the parent category");
/*--------------notice--------------------------*/
define('NB_NOT_MENU',"Ads");
define('NB_NOT_00',"Management of the Ads");
define('NB_NOT_01',"Ads");
define('NB_NOT_02',"Select the declaration");
define('NB_NOT_03',"Declaration Title");
define('NB_NOT_04',"The categories of the adt");
define('NB_NOT_05',"The sub-category of the adt");
define('NB_NOT_06',"Full text of the adt");
define('NB_NOT_07',"Price");
define('NB_NOT_08',"Your name");
define('NB_NOT_09',"City");
define('NB_NOT_10',"Phone number");
define('NB_NOT_11',"Your email");
define('NB_NOT_12',"Prolong the adt for");
define('NB_NOT_13',"Days");
define('NB_NOT_15',"The Start date of publication");
define('NB_NOT_16',"The Expiration date of publication");
/*--------------banner--------------------------*/
define('NB_BAN_MENU',"Banners");
define('NB_BAN_00',"Management ot the Banners");
define('NB_BAN_01',"Category");
define('NB_BAN_02',"Select the category");
define('NB_BAN_03',"Organisation");
define('NB_BAN_04',"Link");
define('NB_BAN_05',"The date of inclusion/disable banner");
define('NB_BAN_06',"Banner");
define('NB_BAN_07',"Select the banner");
define('NB_BAN_08',"Show the banner");
define('NB_BAN_09',"Management");
define('NB_BAN_10',"Home Page");
define('NB_BAN_11',"On all pages");
/*--------------about---------------------------*/
define('NB_ABO_MENU',"About the plugin");
define('NB_ABO_CAP',"Information about the plugin");
define('NB_ABO_NOW',"<b>Features of this version of the plugin Notice-Board:</b>
<br>1) Comments on ads,
<br>2) Counter that tracks the number of display ads,
<br>3) Own management system banner,
<br>4) Title boards equipped with options for easy transition,
<br>5) The plugin has a Russian, English and German version of the language packs
<br>6) Spam protection system,
<br>7) Ability to select the date format for output,
<br>8) If you use a plug-in 'New Content', then you can include the Notice-Board. Ads are displayed with pictures,
<br>9) Making the plug with the general design of the site.");
define('NB_ABO_INFO',"You can leave your comments and suggestions on the <a href='http://e107.compolys.ru'>Compolys e107 development and support site</a>. <br><br>You can also join to development team. We are always open for joint work in the fields of design and programming. Our philosophy is GNU GPL! Free Software for Free People!
<br><br>If you like the work of our plugin and you want to receive updates more often - you can help develop the project in any way:<br>1) Place in your site or blog <img src='".e_PLUGIN."nboard/theme/e107_compolys.png' alt='".NB_INFO."'> this button to link to developer team site.<br>
Code: <font color=red>&#60a href='http://e107.compolys.ru'&#62&#60img src='&#34.e_PLUGIN.&#34nboard/theme/e107_compolys.png' alt='&#34.NB_INFO.&#34'&#62&#60/a&#62</font><br>
2) Place a banner on the notice board with a link to the our site (you can add a banner from the your Admin panel)<br>
3) ...or make a donation in any manner, listed on the site of our team. For example, Yandex.Money, bank account number is 41001945332279 (RUR)<br>");
define('NB_ABO_FUTURE',"</b>Plans to develop Notice-Board plugin:</b>
<br>1) The ability to manage an ad for unregistered users,
<br>2) The separation of all the ads for private and commercial,
<br>3) Improvement of the plugin with the images when you edit your ads,
<br>4) Adding the ability to join several images to the adt,
<br>5) Improving the process of editing ads from Admin Panel,
<br>6) Adding Ads management capabilities in Admin Panel,
<br>7) Adding the ability to send notification of the termination of Adt,
<br>8) Create a tracking system for the release of new versions and auto-update system,
<br>9) Divert all dialogues and messages on js or ajax.");

/*--------------add-----------------------------*/
define('NB_ADD_CAP',"Management of the Ads");
define('NB_ADD_01',"Adt title");
define('NB_ADD_02',"Category");
define('NB_ADD_03',"Select the category");
define('NB_ADD_04',"Sub-category");
define('NB_ADD_05',"Select the sub-category");
define('NB_ADD_06',"Upload the image");
define('NB_ADD_07',"Full text of the adt");
define('NB_ADD_08',"Price");
define('NB_ADD_09',"Your name (or nickname)");
define('NB_ADD_10',"Your locality");
define('NB_ADD_11',"Your phone number");
define('NB_ADD_12',"Your email");
define('NB_ADD_13',"Pleace write an answer:");
define('NB_ADD_14',"Ads");
define('NB_ADD_15',"Date");
define('NB_ADD_16',"Price");
define('NB_ADD_17',"Your previous ads");
/*--------------nboard---------------------------*/
define('NB_NAME_01',"Date");
define('NB_NAME_02',"The adt");
define('NB_NAME_03',"Price");
define('NB_NAME_04',"Location");
define('NB_NAME_05',"");
/*--------------viewads---------------------------*/
define('NB_VIEW_CAP',"An adt");
define('NB_VIEW_01',"Title");
define('NB_VIEW_02',"Full text of the adt");
define('NB_VIEW_03',"Price");
define('NB_VIEW_04',"Image");
define('NB_VIEW_05',"Missing");
define('NB_VIEW_06',"Previous");
define('NB_VIEW_07',"Next");
define('NB_VIEW_08',"Author");
define('NB_VIEW_09',"Location");
define('NB_VIEW_10',"Phone number");
define('NB_VIEW_11',"Email");
define('NB_VIEW_12',"Send email to the author");
define('NB_VIEW_13',"The Start/Expiration date of publication");
define('NB_VIEW_14',"Views");
define('NB_AUTH_1',"Author");
/*--------------search----------------------------*/
define('NB_SARCH_CAP',"Search ot the ast");
define('NB_SARCH_01',"Enter text to search for");
define('NB_SARCH_02',"on the ads title");
define('NB_SARCH_03',"on the ads text");
define('NB_SARCH_04',"ads");
define('NB_SARCH_05',"ads text");
define('NB_SARCH_06',"Unfortunately, your search returned no results. Try changing the search criterion.");
/*--------------navigation------------------------*/
define('NB_NAVI_01',"Navigation Panel");
define('NB_NAVI_02',"Search the ads");
define('NB_NAVI_03',"Add/Edit");
define('NB_NAVI_04',"Homepage");
define('NB_NAVI_05',"Previous");
define('NB_NAVI_06',"Next");
/*--------------images----------------------------*/
define('NB_IMG_00',"Image");
define('NB_IMG_01',"Upload an image");
define('NB_IMG_02',"Select the image");
define('NB_IMG_03',"Show the icons");
define('NB_IMG_04',"Change the image");
/*--------------action---------------------------*/
define('NB_COL_00', "The quantity of days of publication");
define('NB_COL_01', "7 days");
define('NB_COL_02', "15 days");
define('NB_COL_03', "30 days");
/*--------------date formate---------------------*/
define('NB_RDATE_01', "00.00.0000");
define('NB_FDATE_01', "%d.%m.%Y");
define('NB_RDATE_02', "00-00-0000");
define('NB_FDATE_02', "%d-%m-%Y");
/*--------------button----------------------------*/
define('NB_BUT_PROLONG',"Prolong");
define('NB_BUT_ADD',"Add");
define('NB_BUT_DEL',"Remove");
define('NB_BUT_EDIT',"Edit");
define('NB_BUT_UPD',"Update");
define('NB_BUT_RES',"Clear out");
define('NB_BUT_CANS',"Cancel");
define('NB_BUT_AGR',"Apply");
define('NB_BUT_SEA',"Search");
/*--------------yes no----------------------------*/
define('NB_SEL_YES',"Yes");
define('NB_SEL_NO',"No");
/*--------------messeg----------------------------*/
define('NB_MES_START',"Тo category ads are not configured. Please inform the site administrator.");
define('NB_MES_00',"Message");
define('NB_MES_01',"No object is selected for editing");
define('NB_MES_02',"No object is selected for remove");
define('NB_MES_03',"Do you really want to delete the category?");
define('NB_MES_04',"You are trying to add an empty category!");
define('NB_MES_05',"The category is successfully added");
define('NB_MES_06',"The category was updated");
define('NB_MES_07',"The category");
define('NB_MES_08',"was removed");
define('NB_MES_09',"Page number format is incorrect");
define('NB_MES_10',"Query to the database is incrorrect");
define('NB_MES_11',"You are trying to add an empty sub-category!");
define('NB_MES_12',"The sub-category is successfully added");
define('NB_MES_13',"The sub-category was update");
define('NB_MES_14',"The settings was updated");
define('NB_MES_15',"Without an image");
define('NB_MES_16',"Enter your name (20 characters maximum)");
define('NB_MES_17',"The settings was updated");
define('NB_MES_18',"The settings was added");
define('NB_MES_19',"Your adt is successfully added!");
define('NB_MES_20',"Your adt is added up to ");
define('NB_MES_21',"Please complete all fields marked with *");
define('NB_MES_22',"The adt is successfully updated");
define('NB_MES_23',"The banner information was updated !");
define('NB_MES_24',"The adt was removed");
define('NB_MES_30',"Your adt is prolong. It will valid more ");
define('NB_MES_31',"days! Do not forget, you can pick it up at the top of the list at any time.");
/*--------------example----------------------------*/
define('NB_EX_CONF_01',"What is 4+4");
define('NB_EX_CONF_02',"8");
define('NB_EX_CAT_01',"Cars");
define('NB_EX_CATDESC_01',"Cars, motorcycles, spare parts");
define('NB_EX_CAT_02',"Кeal estate");
define('NB_EX_CATDESC_02',"Apartments, houses, villas, offices");
define('NB_EX_CAT_03',"PC and electronics");
define('NB_EX_CATDESC_03',"Computers, telephones, satellite equipment");
define('NB_EX_CAT_04',"Life");
define('NB_EX_CATDESC_04',"Dating, jobs");
define('NB_EX_CAT_05',"buying");
define('NB_EX_CAT_06',"selling");
define('NB_EX_CAT_07',"exchange");
define('NB_EX_CAT_08',"rent");
define('NB_EX_CAT_09',"seeking");
define('NB_EX_CAT_10',"jobs");
define('NB_EX_CAT_11',"propose to work");
?>