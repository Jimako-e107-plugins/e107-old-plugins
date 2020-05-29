<?php
//////////////////////////////////////////////
//
//
//
//  Fußball-Weltmeisterschaft der Frauen 2011
//
//
//
//
///////////////////////////////////////////////
require_once("../../class2.php");

//Check permissions
if(!getperms("P")){
	header("location:".e_BASE."index.php");
	exit;
}

//Load Header
require_once(e_ADMIN."auth.php");


/////////////Preffs
$pref['4xa_wm_cap'] = "Fußball-Weltmeisterschaft der Frauen 2011";	
$pref['4xa_wm_acces_class'] = "252";
$pref['4xa_wm_top_points'] = "3";
$pref['4xa_wm_div_points'] = "2";
$pref['4xa_wm_tendenz_points'] ="1";
$pref['4xa_wm_niete_points'] = "0";
$pref['4xa_wm_games_count'] = "10";
$pref['4xa_wm_sportart'] = "Fußball";
$pref['4xa_wm_gametime'] = "90";
$pref['4xa_wm_timer'] = "5";
$pref['4xa_wm_top_points_color'] = "00FF66";
$pref['4xa_wm_div_points_color'] = "FFFF66";
$pref['4xa_wm_tendenz_color'] = "FF6633";
$pref['4xa_wm_niete_points_color'] = "CCCCCC";
$pref['4xa_wm_kA_field_color'] = "CCCCFF";
$pref['4xa_wm_xx_field_color'] = "66FFFF";
$pref['4xa_wm_verdeckt_field_color'] = "FF6666";
$pref['4xa_wm_menu_timer'] = "4";
$pref['4xa_wm_menu_timer_value'] = "2";
save_prefs();


////////// Runden
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_rounds VALUES (1, 'Vorrunde', 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_rounds VALUES (2, 'Viertelfinale', 2) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_rounds VALUES (3, 'Halbfinale', 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_rounds VALUES (4, 'Finale', 4) ");
////////// Groups
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (1, 'Gruppe A', 1, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (2, 'Gruppe B', 1, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (3, 'Gruppe C', 1, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (4, 'Gruppe D', 1, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (5, '1/4 Paarung A', 2, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (6, '1/4 Paarung B', 2, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (7, '1/4 Paarung C', 2, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (8, '1/4 Paarung D', 2, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (9, '1/2 Paarung A', 3, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (10, '1/2 Paarung B', 3, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (11, '1-tes /2-tes Platz', 4, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_groups VALUES (12, 'Spiel um Platz drei', 4, 1) ");
////////// Teams
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (1, 'Deutschland', '0.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (2, 'Kanada', '1.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (3, 'Nigeria', '2.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (4, 'Frankreich', '3.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (5, 'Japan', '4.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (6, 'Neuseeland', '5.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (7, 'Mexiko', '6.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (8, 'England', '7.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (9, 'Vereinigte Staaten', '8.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (10, 'Nordkorea', '9.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (11, 'Kolumbien', '10.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (12, 'Schweden', '11.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (13, 'Brasilien', '12.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (14, 'Australien', '13.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (15, 'Norwegen', '14.gif') ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams VALUES (16, 'Äquatorialguinea', '15.gif') ");
/////////// Stadions
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (1, 'Augsburg', 'SGL Arena', 'Augsburg.jpg', 28367) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (2, 'Berlin', 'Olympiastadion', 'Berlin.jpg', 74244) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (3, 'Bochum', 'Rewirpowerstadion', 'Bochum.jpg', 23000) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (4, 'Dresden', 'Glücksgas-Stadion', 'Dresden.jpg', 27190) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (5, 'Frankfurt', 'Commerzbank-Arena', 'Frankfurt.jpg', 49240) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (6, 'Leverkusen', 'BayArena', '', 0) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (7, 'Mönchengladbach', 'Stadion im Borussia-Park', '', 0) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (8, 'Sinsheim', 'Rhein-Neckar-Arena', '', 0) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_stadions VALUES (9, 'Wolfsburg', 'Arena im Allerpark', '', 0) ");

///////// Teams in Groups
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (1, '', 1, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (2, '', 2, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (3, '', 3, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (4, '', 4, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (5, '', 5, 2) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (6, '', 6, 2) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (7, '', 7, 2) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (8, '', 8, 2) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (9, '', 9, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (10, '', 10, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (11, '', 11, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (12, '', 12, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (13, '', 13, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (14, '', 14, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (15, '', 15, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (16, '', 16, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (17, 'Sieger A', 0, 5) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (18, 'Zweiter B', 0, 5) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (19, 'Sieger C', 0, 6) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (20, 'Zweiter D', 0, 6) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (21, 'Sieger B', 0, 7) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (22, 'Zweiter A', 0, 7) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (23, 'Sieger D', 0, 8) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (24, 'Zweiter C', 0, 8) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (25, 'Sieger 1/4 A', 0, 9) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (26, 'Sieger 1/4 B', 0, 9) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (27, 'Sieger 1/4 C', 0, 10) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (28, 'Sieger 1/4 D', 0, 10) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (29, 'Sieger 1/2 A', 0, 11) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (30, 'Sieger 1/2 B', 0, 11) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (31, 'Verlierer 1/2 A', 0, 12) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_teams_in_groups VALUES (32, 'Verlierer 1/2 A', 0, 12) ");
//////////////////// Games
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (1, 1, 1, '1309093200', 3, 4, 0, 0, 0, 8) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (2, 1, 1, '1309104000', 1, 2, 0, 0, 0, 2) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (3, 1, 1, '1309449600', 2, 4, 0, 0, 0, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (4, 1, 1, '1309459500', 1, 3, 0, 0, 0, 5) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (5, 1, 1, '1309891500', 4, 1, 0, 0, 0, 7) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (6, 1, 1, '1309891500', 4, 3, 0, 0, 0, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (7, 1, 2, '1309179600', 5, 6, 0, 0, 0, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (8, 1, 2, '1309190400', 7, 8, 0, 0, 0, 9) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (9, 1, 2, '1309525200', 5, 7, 0, 0, 0, 6) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (10, 1, 2, '1309536900', 6, 8, 0, 0, 0, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (11, 1, 2, '1309882500', 8, 5, 0, 0, 0, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (12, 1, 2, '1309882500', 6, 7, 0, 0, 0, 8) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (13, 1, 3, '1309266000', 11, 12, 0, 0, 0, 6) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (14, 1, 3, '1309277700', 9, 10, 0, 0, 0, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (15, 1, 3, '1309608000', 10, 12, 0, 0, 0, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (16, 1, 3, '1309622400', 9, 11, 0, 0, 0, 8) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (17, 1, 3, '1309977900', 12, 9, 0, 0, 0, 9) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (18, 1, 3, '1309977900', 10, 11, 0, 0, 0, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (19, 1, 4, '1309352400', 15, 16, 0, 0, 0, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (20, 1, 4, '1309364100', 13, 14, 0, 0, 0, 7) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (21, 1, 4, '1309694400', 14, 16, 0, 0, 0, 3) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (22, 1, 4, '1309709700', 13, 15, 0, 0, 0, 9) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (23, 1, 4, '1309968000', 16, 13, 0, 0, 0, 5) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (24, 1, 4, '1309968000', 14, 15, 0, 0, 0, 6) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (25, 2, 5, '1310237100', 17, 18, 0, 0, 0, 9) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (26, 2, 6, '1310295600', 19, 20, 0, 0, 0, 1) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (27, 2, 7, '1310227200', 21, 22, 0, 0, 0, 6) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (28, 2, 8, '1310311800', 23, 24, 0, 0, 0, 4) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (29, 3, 9, '1310582700', 25, 26, 0, 0, 0, 5) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (30, 3, 10, '1310572800', 27, 28, 0, 0, 0, 7) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (31, 4, 11, '1310928300', 29, 30, 0, 0, 0, 5) ");
mysql_query("INSERT INTO ".MPREFIX."4xa_wm_games VALUES (32, 4, 12, '1310830200', 31, 32, 0, 0, 0, 8) ");
//load Footer


echo "Titi, kompletti!<a href='admin/admin_groups.php'>Zurück!</a>";
require_once(e_ADMIN."footer.php");

?>
