<?php
/*
+---------------------------------------------------------------+
|	4xA-EMS v0.6 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	sorce: ../../4xA_ems/languages/English.php
|	Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|	For the e107 website system
|	©Steve Dunstan
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
//vers. 0.5
define("", "");
define("", "");
define("", "");
define("e4xA_EMS_DESC" , "A Plugin that it permits to filter the users after the approved Bunutzer data. 
		Original idea is of EMS- Plugin version 1.0 trunk of iNfLuX  (influx604@gmail.com)<br/> 
		This version was extended in such a way that man all extension user- fields into the search with usen"); 
define("e4xA_EMS_INSTALL_DONE" , "Installation was successful! "); 
define("e4xA_PAGE_LINK_NAME" , "User Search"); 
define("SEARCH_FORM_CAPTION" , "Searchform"); 
define("SEARCH_START" , "User Filtern"); 
define("NO_RESULTS" , "No Results"); 
define("REGESTRIERTE_MITGIELDER" , "Registered user: "); 
define("GEFUNDEN_MITGIELDER" , "Found users: "); 
define("PAGE_NAME_4xA_EMS" , "User Filtern"); 
define("VON" , " of "); 
define("BIS" , " to "); 
define("EINSTELLUNGEN_GESCHPEICHERT" , "Attitudes are stored! "); 
define("SYSTEM_BENUTZER_FELDER" , "System- fields of the User"); 
define("DB_FIELD_EDIT" , "Extended user- field edit"); 
define("ERWEITERTE_BENUTZER_FELDER" , "Extend user- field"); 
define("e4xA_EMS_RECHTE" , "Further Attitudes"); 
define("VISITENKARTE" , "as Kart"); 
define("TABELLE" , "as Table"); 
define("RESULTS_ZEIGEN_ALS" , "Results indicate as: "); 
define("NO_OF_RESULTS_PER_SITE" , "Number of D. Results per side: "); 
define("NO_OF_ROWS_PER_SITE" , "Number of D. Columns. (only with map opinion!): "); 
define("SEARCH_USER_ACCES" , "Who may do the search using?: "); 
define("SPEICHERN" , "Attitudes save"); 
define("BESUCHE_MICH" , "Visit our side! "); 
define("e4xA_EMS_ADMIN_CAPTION" , "4xA-EMS Attitudes"); 
define("USER_SEARCH_TO" , "After user "); 
define("USER_SEARCH_TO_ACCES" , "filter permit? "); 
define("FIELD_TYP_TABLE" , "Table"); 
define("FIELD_TYP_FROM_TABLE" , "Contents from the table: "); 
define("FIELD_TYP_FROM_TABLE_ISO" , "Value field: "); 
define("FIELD_TYP_FROM_TABLE_TXT" , "Text field: "); 
define("FIELD_TYP_TXTAREA" , "Textarea"); 
define("ABFRAGE_PARAMETER" , "parameter: "); 
define("FIELD_TYP_INT" , "Intenger"); 
define("FIELD_TYP_DATA" , "Date"); 
define("FIELD_TYP_LANG" , "Language"); 
define("JEDER" , "everyone"); 
define("NUR_MITGLIEDER" , "only User"); 
define("NUR_ADMIN" , " only Admins"); 
define("KEINER" , " none (inactively) "); 
define("e4xA_EMS_SYS_01" , "Username"); 
define("e4xA_EMS_SYS_02" , "Correct Name"); 
define("e4xA_EMS_SYS_03" , "Avatar"); 
define("e4xA_EMS_SYS_04" , "Photo"); 
define("e4xA_EMS_SYS_05" , "On-line Status"); 
define("e4xA_EMS_SYS_06" , "Burtday"); 
define("e4xA_EMS_SYS_07" , "Seit"); 
define("e4xA_EMS_SYS_08" , "eMail"); 
define("e4xA_EMS_CEL_COUNT_TEXT" , "Number of D. Columns. only map opinion!: "); 
define("e4xA_EMS_BURT_FIELD_TEXT" , "Exdendet field for birthday: "); 
define("e4xA_EMS_SEX_FIELD_TEXT" , "Exdendet field for sex: "); 
define("e4xA_EMS_NO_DATA" , "No Data"); 
define("e4xA_EMS_NO_VIEW" , "- hidden -"); 
define("e4xA_EMS_ALTER" , " Y."); 
//vers. 0.6 
define("e4xA_EMS_FIELT_OPT_NAME" , "Search field name: "); 
define("e4xA_EMS_FIELT_OPT_NAME2" , "Optionally! the text of the Felders suns is übernohmen.");
define("e4xA_EMS_HELP_CAP", "Readme 4xA-EMS 0.6");
define("e4xA_EMS_HELP", "<h2>1. Burtday.</h2><br/>
in that railways are already an extended field burtday put on and as date configure. We would like to look for these naturally also to for age (is called zBsp. show all users vo the 10 years old until 20 years old are.) 
So that the Plugin does it also correctly, mash this field under 4xA-EMS-> Attitudes something besonnders to be configured. : 
<br/>a) chop set 
<br/>b) to parameters indicate. Here it is important to pick that man of everything correctly angiebt, because this character string out several times put by that program outer each other around field parameters. 
<br/>An example of a <b>date field</b>: <input style='width: 300px;' name='bespiel001' type='text' value='A|2|10,16,18,20,25,30,35,40,45,60,70,90,100|'/><br/><br/>

 Explanation: in the first place <b>A</b> stands that means this field is as age are treated. Then after a separator | comes <b>2</b> that meant that in the Searchform are the Searchfield as Kombobox are indicated. Here also a <b>1</b> can be used, 
 then it becomes text box. After a further separator <b>|</b> Comes djede quantity of numbers. 
 Those are the values in the Kombobox to selection to stand are. Note!!!!! text box does not need to leave these defenierte values thus can one it empty, then it would look in such a way with text box: <b>A|1||</b> (is nevertheless completely simple? ) 
 A further characteristic: In the example rates listed <b>10,16,18,20,25,30,35,40,45,60,70,90,100</b> it 
 can more or less be, is everything stands above after your luke, BUT the values are with comma separately all. 
 If one liked to indicate it however not all values themselves, one can represent it also in such a way: <b>1,-,100</b> or <b>10,-,60</b> etc. all values become automatic zbsp. from 1 to 100 aufgwlistet. The commas are very important before and to post indication. 
 This parameters are only for railway fields, those as date fishing rod narrow are important now! Man can use also further fields in such a way, example date marriage ceremony. And then it can be looked for the value as for a long time one already married is for example. 
  <br/><br/>
 <br/>
<h2>2. Time interwhales.</h2><br/>
One knows Sowas zBsp. uses for the information, when one visited the school. Or when man in the association was active…. But one must put on new fields under the extension of user fields TWO, zBsp. weding1 and weding2 (like these hot, main thing special characters and no 
blanks is not wurscht) Around better representation to make possible one is to provide a field group (see under extension user fields). One is to then assign the two provided fields into this group. 
<br/
Then under 4xA-EMS-> Attitudes: 
<br/>a) do not chop set however please only with one of two thereby it in the search form doubly erschent. 
<br/>b) to parameters indicate. Here it is important to pick that man of everything correctly angiebt, because this character string out several times put by that program outer each other around field parameters. 
<br/>
An example of a date field: <input style='width: 300px;' name='bespiel002' type='text' value='VB|2|1960,-,2010|user_weding2|'/><br/><br/>

<br/>Explanation: in the first place stands
");
?>

