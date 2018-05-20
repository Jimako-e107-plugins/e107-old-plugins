<?php
/**
 * Constants.php
 *
 * This file is intended to group all constants to
 * make it easier for the site administrator to tweak
 * the login script.
 *
 */

/**
 * Database Table Constants - these constants
 * hold the names of all the database tables used
 * in the script.
 */
define("TBL_PREFIX", "ebattles_");

define("TBL_USERS_SHORT",           "user");
define("TBL_EVENTS_SHORT",          TBL_PREFIX."Events");
define("TBL_EVENTMODS_SHORT",       TBL_PREFIX."EventModerators");
define("TBL_TEAMS_SHORT",           TBL_PREFIX."Teams");
define("TBL_MATCHS_SHORT",          TBL_PREFIX."Matchs");
define("TBL_PLAYERS_SHORT",         TBL_PREFIX."Players");
define("TBL_SCORES_SHORT",          TBL_PREFIX."Scores");
define("TBL_CLANS_SHORT",           TBL_PREFIX."Clans");
define("TBL_DIVISIONS_SHORT",       TBL_PREFIX."Divisions");
define("TBL_MEMBERS_SHORT",         TBL_PREFIX."Members");
define("TBL_STATSCATEGORIES_SHORT", TBL_PREFIX."StatsCategories");
define("TBL_GAMES_SHORT",           TBL_PREFIX."Games");
define("TBL_AWARDS_SHORT",          TBL_PREFIX."Awards");
define("TBL_PLAYERS_RESULTS_SHORT", TBL_PREFIX."PlayersResults");
define("TBL_GAMES_GENRES_SHORT",    TBL_PREFIX."GamesGenres");
define("TBL_GAMES_PLATFORMS_SHORT", TBL_PREFIX."GamesPlatforms");
define("TBL_MAPS_SHORT",            TBL_PREFIX."Maps");
define("TBL_FACTIONS_SHORT",        TBL_PREFIX."Factions");
define("TBL_MEDIA_SHORT",           TBL_PREFIX."Media");
define("TBL_CHALLENGES_SHORT",      TBL_PREFIX."Challenges");
define("TBL_GAMERS_SHORT",          TBL_PREFIX."Gamers");
define("TBL_OFFICIAL_EVENTS_SHORT", TBL_PREFIX."OfficialEvents");

define("TBL_USERS",           MPREFIX."user");
define("TBL_EVENTS",          MPREFIX.TBL_EVENTS_SHORT);
define("TBL_EVENTMODS",       MPREFIX.TBL_EVENTMODS_SHORT);
define("TBL_TEAMS",           MPREFIX.TBL_TEAMS_SHORT);
define("TBL_MATCHS",          MPREFIX.TBL_MATCHS_SHORT);
define("TBL_PLAYERS",         MPREFIX.TBL_PLAYERS_SHORT);
define("TBL_SCORES",          MPREFIX.TBL_SCORES_SHORT);
define("TBL_CLANS",           MPREFIX.TBL_CLANS_SHORT);
define("TBL_DIVISIONS",       MPREFIX.TBL_DIVISIONS_SHORT);
define("TBL_MEMBERS",         MPREFIX.TBL_MEMBERS_SHORT);
define("TBL_STATSCATEGORIES", MPREFIX.TBL_STATSCATEGORIES_SHORT);
define("TBL_GAMES",           MPREFIX.TBL_GAMES_SHORT);
define("TBL_AWARDS",          MPREFIX.TBL_AWARDS_SHORT);
define("TBL_PLAYERS_RESULTS", MPREFIX.TBL_PLAYERS_RESULTS_SHORT);
define("TBL_GAMES_GENRES",    MPREFIX.TBL_GAMES_GENRES_SHORT);
define("TBL_GAMES_PLATFORMS", MPREFIX.TBL_GAMES_PLATFORMS_SHORT);
define("TBL_MAPS",            MPREFIX.TBL_MAPS_SHORT);
define("TBL_FACTIONS",        MPREFIX.TBL_FACTIONS_SHORT);
define("TBL_MEDIA",           MPREFIX.TBL_MEDIA_SHORT);
define("TBL_CHALLENGES",      MPREFIX.TBL_CHALLENGES_SHORT);
define("TBL_GAMERS",          MPREFIX.TBL_GAMERS_SHORT);
define("TBL_OFFICIAL_EVENTS", MPREFIX.TBL_OFFICIAL_EVENTS_SHORT);

define("ELO_DEFAULT", 1000);
define("ELO_K", 50);
define("ELO_M", 100);
define("TS_Mu0"     , 25);
define("TS_sigma0"  , TS_Mu0/3);
define("TS_beta"    , TS_Mu0/6);
define("TS_epsilon" , 1.0);
define("TS_tau" , TS_Mu0/300);
define("PointsPerWin_DEFAULT" , 3);
define("PointsPerDraw_DEFAULT" , 1);
define("PointsPerLoss_DEFAULT" , 0);
define("G2_r0", 1500);
define("G2_RD0", 350);
define("G2_sigma0", 0.06);
define("G2_tau", 0.5);
define("G2_epsilon", 0.000001);
define("G2_qinv", 173.7178); //400/log(10);
define("eb_rating_period", 1);	// in days

// Match report userclass
define("eb_UC_MATCH_WINNER", 16);
define("eb_UC_EB_MODERATOR", 8);
define("eb_UC_EVENT_OWNER", 4);
define("eb_UC_EVENT_MODERATOR", 2);
define("eb_UC_EVENT_PLAYER", 1);
define("eb_UC_NONE", 0);

define("eb_PAGINATION_MIDRANGE", 7);

define("eb_MATCH_NOEVENTINFO", 1);
define("eb_MATCH_SCHEDULED", 2);
define("eb_MATCH_NO_EDIT_ICONS", 4);

define("eb_MAX_CHALLENGE_DATES", 3);
define("eb_MAX_MAPS_PER_MATCH", 1);

define("eb_EVENT_STATUS_DRAFT", 1);
define("eb_EVENT_STATUS_SIGNUP", 2);
define("eb_EVENT_STATUS_CHECKIN", 3);
define("eb_EVENT_STATUS_ACTIVE", 4);
define("eb_EVENT_STATUS_FINISHED", 5);

?>
