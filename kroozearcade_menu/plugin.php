<?php
/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7.5
|        Compatible with all games from www.ibproarcade.com
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stephen Sherlock
|        http://www.penbrock.com/
|        admin@penbrock.com
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Krooze Arcade";
$eplug_version = "0.7.5";
$eplug_author = "Stephen Sherlock, Edited by encieno and Penbrock";
$eplug_logo = "button.png";
$eplug_url = "http://www.penbrock.com/";
$eplug_email = "admin@penbrock.com";
$eplug_description = "A plugin to implement an arcade in e107 with high score tables. Compatible with most games from www.ibproarcade.com.";
$eplug_compatible = "e107v7+";
$eplug_readme = "readme.txt";        // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "kroozearcade_menu";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "kroozearcade_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon.gif";
$eplug_caption =  "Configure your plugin";
$eplug_icon_small = $eplug_folder."/images/krooze16_16.gif";
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
        "KROOZEARCADE_1" => 0 // this stores a default value in the preferences.0 = off , 1= On
);



// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("arcade_champs", "arcade_games", "arcade_scores", "arcade_banlist", "arcade_categories");


// List of sql requests to create tables -----------------------------------------------------------------------------
$timestamp = time();

$eplug_tables = array("
CREATE TABLE ".MPREFIX."arcade_champs (
  champ_id int(10) unsigned NOT NULL auto_increment,
  game_id int(10) unsigned NOT NULL,
  user_id int(10) unsigned NOT NULL,
  score varchar(16) NOT NULL,
  date_scored varchar(16) NOT NULL,
  PRIMARY KEY (champ_id)
);","
CREATE TABLE ".MPREFIX."arcade_games (
  game_id int(10) unsigned NOT NULL auto_increment,
  game_filename varchar(100) NOT NULL default '',
  game_enable tinyint(1) NOT NULL default '0',
  game_category int(10) unsigned NOT NULL default '0',
  date_added varchar(16) NOT NULL,
  game_title varchar(64) NOT NULL,
  game_description varchar(255) default NULL,
  game_controls varchar(255) default NULL,
  display_height int(10) unsigned NOT NULL default '480',
  display_width int(10) unsigned NOT NULL default '640',
  reverse_score_order tinyint(1) NOT NULL default '0',
  times_played int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (game_id)
);","
INSERT INTO ".MPREFIX."arcade_games VALUES (1, 'asteroids', 1, 2, '".$timestamp."', 'Asteroids', 'Retro gaming at it\'s best! Blast the asteroids but don\'t let the aliens get you!', 'Cursors keys to move, space to fire', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (2, 'breakout', 1, 2, '".$timestamp."', 'BreakOut', 'The arcade classic - use your mouse', 'Select in-game whether to use your mouse or the cursor keys to control your paddle.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (3, 'curveball', 1, 3, '".$timestamp."', 'Curveball', 'Pong for the 21st century! 3D version of the classic game', 'Left click to launch the ball, then use the mouse to move your paddle', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (4, 'funkypong', 1, 3, '".$timestamp."', 'Funky Pong', 'Bounce the ball off your paddle as many times as you can without letting it go outside the circle', 'Move your mouse to control the paddle', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (5, 'lilquackers', 1, 3, '".$timestamp."', 'Little Quackers', 'Get all the ducks to safety whilst avoiding obstacles', 'Press the spacebar when you want the little quacker to jump in the water and swin towards safety.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (6, 'missilestrike', 1, 2, '".$timestamp."', 'Missile Strike', 'An arcade classic - destroy the missiles before they reach your bases', 'Move your mouse to control the target and time your clicks to destroy the missiles', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (7, 'moonlander', 1, 3, '".$timestamp."', 'Moon Lander', 'Land your spacecraft on the platforms without running out of fuel!', 'Up arrow for boost, left and right arrows control movement.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (8, 'rubberbanditsm', 1, 1, '".$timestamp."', 'Rubber Bandits', 'Fire your rubber bands at people around the office. You loose a band for every target missed. Game is over when you run out of bands.', 'Left and right cursor keys to aim, space to fire a rubber band.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (9, 'simon', 1, 3, '".$timestamp."', 'Simon', 'Copy the pattern that the computer shows you. See how far you can get before you make a mistake!', 'Use your mouse to click on the colours in the right order.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (10, 'snake', 1, 2, '".$timestamp."', 'Snake', 'The game made famous by mobile phones around the globe - see if you can master this PC version too!', 'Cursor keys control the direction of your snake.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (11, 'spacerunner', 1, 3, '".$timestamp."', 'Space Runner', 'Space-based game where you have to dodge objects in your way. Gets harder each level.', 'Up arrow to jump, down arrow to roll, right arrow to dive.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (12, 'basketball', 1, 4, '".$timestamp."', 'Basketball Shooter', 'Classic basketball game. Can you get a perfect 30?', 'Use the space bar to pick up a ball, jump, then release the ball at the right time.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (13, 'wrx2', 1, 5, '".$timestamp."', 'WRX Racing', 'Race around three laps as fast as you can!', 'Cursor keys - up to accelerate, down to brake, left and right to steer.', 480, 640, 1, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (14, 'pacman', 1, 2, '".$timestamp."', 'PacMan', 'Classic gaming - eat all the dots whilst not getting eaten yourself!', 'Use the cursor keys to control pacman.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (15, 'invaders', 1, 2, '".$timestamp."', 'Space Invaders!', 'Classic gaming - shoot all the aliens whilst avoiding their boms. Use the shields for shelter.', 'Use the cursor keys to control your spaceship, and space to fire.', 480, 640, 0, 0);","

CREATE TABLE ".MPREFIX."arcade_scores (
  score_id int(10) unsigned NOT NULL auto_increment,
  game_id int(10) unsigned NOT NULL,
  user_id int(10) unsigned NOT NULL default '0',
  score int(11) NOT NULL,
  date_scored varchar(16) NOT NULL,
  PRIMARY KEY (score_id)
);","
CREATE TABLE ".MPREFIX."arcade_banlist (
  ban_id int(10) unsigned NOT NULL auto_increment,
  user_id int(10) unsigned NOT NULL,
  ban_reason varchar(255) default NULL,
  ban_date varchar(16) NOT NULL default 0,
  ban_end_date varchar(16) NOT NULL default 0,
  strike_count int(10) unsigned NOT NULL default 0,
  UNIQUE KEY user_id (user_id),
  PRIMARY KEY (ban_id)
);","
CREATE TABLE ".MPREFIX."arcade_categories (
  cat_id int(10) unsigned NOT NULL auto_increment,
  category_name varchar(64) NOT NULL,
  category_description varchar(255) default NULL,
  category_image varchar(100) NOT NULL default 'category.jpg',
  UNIQUE KEY category_name (category_name),
  PRIMARY KEY (cat_id)
);","
INSERT INTO ".MPREFIX."arcade_categories VALUES ('1', 'General Games', 'General Games', 'category.png');","
INSERT INTO ".MPREFIX."arcade_categories VALUES ('2', 'Classic Games', 'Classic Games', 'category.png');","
INSERT INTO ".MPREFIX."arcade_categories VALUES ('3', 'Strategy Games', 'Strategy Games', 'category.png');","
INSERT INTO ".MPREFIX."arcade_categories VALUES ('4', 'Sports Games', 'Sports Games', 'category.png');","
INSERT INTO ".MPREFIX."arcade_categories VALUES ('5', 'Racing Games', 'Racing Games', 'category.png');","
);");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Arcade";
$eplug_link_url = "e107_plugins/kroozearcade_menu/kroozearcade.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Installation completed successful. Enjoy the games!";


// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = $upgrade_alter_tables = array(
"ALTER TABLE ".MPREFIX."arcade_scores CHANGE score score INT(10) NOT NULL default 0;",
"ALTER TABLE ".MPREFIX."arcade_games ADD display_height int(10) unsigned NOT NULL default '480';",
"ALTER TABLE ".MPREFIX."arcade_categories ADD category_description varchar(255) default NULL;",
"ALTER TABLE ".MPREFIX."arcade_categories ADD category_image varchar(100) NOT NULL default 'category.jpg';",
"ALTER TABLE ".MPREFIX."arcade_games ADD display_width int(10) unsigned NOT NULL default '640';","
INSERT INTO ".MPREFIX."arcade_games VALUES (14, 'basketball', 1, 1, '".$timestamp."', 'Basketball Shooter', 'Classic basketball game. Can you get a perfect 30?', 'Use the space bar to pick up a ball, jump, then release the ball at the right time.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (16, 'wrx2', 1, 1, '".$timestamp."', 'WRX Racing', 'Race around three laps as fast as you can!', 'Cursor keys - up to accelerate, down to brake, left and right to steer.', 480, 640, 1, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (17, 'pacman', 1, 1, '".$timestamp."', 'PacMan', 'Classic gaming - eat all the dots whilst not getting eaten yourself!', 'Use the cursor keys to control pacman.', 480, 640, 0, 0);","
INSERT INTO ".MPREFIX."arcade_games VALUES (18, 'invaders', 1, 1, '".$timestamp."', 'Space Invaders!', 'Classic gaming - shoot all the aliens whilst avoiding their boms. Use the shields for shelter.', 'Use the cursor keys to control your spaceship, and space to fire.', 480, 640, 0, 0);"
);

$eplug_upgrade_done = "Upgrade completed sucessfully. Enjoy the new features!";





?>
