/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7.4 RC1
|        Compatible with all games from www.ibproarcade.com
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stephen Sherlock
|        http://www.krooze.net/
|        aterlatus@krooze.net
|  -----------------------------------
|  ----- Brought back to life by -----
|  _____ Penbrock and encieno ________
|  
|	 http://www.penbrock.com
|        admin@penbrock.com
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

Changelog:
=========


Version 0.7.1 
	- Added minor fix for scoring system
************** Mod's my Penbrock  www.penbrock.com   admin@penbrock.com

* Added mInOtAuR's and doughall's options (close and replay buttons) 	06/06
* Added Spook's change at allow more then 5 catagories			06/06
* Ordered games list by catagory					06/06
* Added score resetting option per game					06/06
* Added button for future tournment feature				06/06
* Changed (by Northwst) corrections to menu				07/18
* Set to show 3 game catagory per line					11/20/06
* Bolded game name in Admin Game list					12/09/06
* Centered 'times played' in admin menu					12/09/06
* Restricted size of pull down in menu to 20				12/09/06
* removed 'Blast billards' from plugin install				12/09/06
* Changed web site and e-mail in plugin.php to my info			12/09/06

Version 0.7.4 RC1
* Wrong files were uploaded on last package
* Added directories for newer games data files
* Added random images to category list
* Added random game to menu					
* Added game count to kroozearcade_menu.php
* Added IBP v3.x support mini-fix
* Fixed Krooze menu bug with Windows server
* Added Admin can now edit Catagories
* Added Image to index.php
* Added New icon for the game

Version 0.7.5 
* Update version for e107coders release.

===============================================================

INSTALLATION:
============

o Upload the kroozearcade_menu directory and all of it's contents to the e107_plugins folder on your server.
o 'chmod 777' the kroozearcade_menu/games directory
o 'chmod -R 777' the kroozearcade_menu/games/arcade directory
o Install and Configure KroozeArcade via your administration interface

UPGRADING:
=========

Versions marked above with a (*) require a database update to function correctly if you are upgrading KroozeArcade! If you are upgrading to one (or beyond) of these releases, you should go to your plugin manager and hit the "Upgrade" link alongside KroozeArcade to complete the necessary changes.

Please note that no testing is performed for upgrades beyond one minor version - ie, we have not tested upgrading from 0.5 to 0.7, thus we can offer no support on this. Please try to upgrade one minor version at a time. All versions are available upon request.

WHAT IT IS:
==========

KroozeArcade is a plugin for e107 that allows you to add games to your e107 powered website with self-updating score boards. You will see the top 10 for the current month, last months highest score and an overall champion for each game. 12 games are included to get you started.

CONSIDERATIONS:
==============

o This is an early BETA version of KroozeArcade. Not all features are currently active (see the wishlist below).
o This plugin is in early BETA - if you break it, you'll have to reinstall or try and fix it yourself. There is little or no error checking in here. If you use a lot of apostrophes in game names, or delete all of the included games and categories then things are likely to stop working.
o No more games will be added to the standard install now we have 18. If you require more games, download some from http://www.ibproarcade.com/ as detailed below. If you already have any of the new games then you will need to remove the appropriate lines from plugin.php before upgrading. New games are:
	o Basketball Shooter
	o Canyon Glider
	o WRX Racing
	o Pacman
	o Space Invaders

ADDING NEW GAMES:
================

Find the game you want to install on http://www.ibproarcade.com/ (these are the only ones I know of that will work with the KroozeArcade scoring system). Download the SWF and the "gamename"1.gif file (you don't need the "gamename"2.gif). Use the KroozeArcade admin pages to upload the game and set it's title, description, controls et al. If you have any difficulty, post for assistance in the thread listed below.

If the game has a '/gamedata/[game name]/ folder you will need to FTP it in to the /krooze_menu/games/arcade/gamedata/ folder as well as loading the main game as normal.

Sample install:
	Unzip the game.
	open the {game name}.php file with any text editor.
	Go to Krooze in the admin area and click "Add Game"
	Copy information from the {game name}.php to the Add Game
		gtitle		=	Game Name
		gwords		=	Game Description
		gkeys		=	Game Controls
	If highscore_type is low=	Check Reverse Scores
		Game File	=	{game name}.swf file (use the BROWSE button to locate)
		Game Icon	=	{game name}1.gif (use the BROWSE button to locate)
		Catagory	=	Select where you want the game to be loaded
		gwith		=	Default Width
		gheight		=	Default Height
	
		Click Add Game

	FTP /{game name}/ folder to /krooze_menu/games/arcade/gamedata/ 

Game is ready to play, make sure to test it.

Some other sites to find games:
	http://teamwolfpack.org/
	http://www.gaming-heaven.com


SUPPORT:
=======

Support can be found at http://www.penbrock.com

BUGS:
====

If you find a bug then please report it via the BugTracker on http://www.penbrock.com
or at http://e107coders.org/news.php
