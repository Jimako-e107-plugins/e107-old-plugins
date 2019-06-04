<?php

   /*
   -----------------------------------------------------------------------------------------------------------+
   |
   |	e107 website system
   |	CUPS PLUGIN
   |
   |	©Crytiqal.Aero 2010
   |	http://www.team-aero.co.nr
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
   |
   +----------------------------------------------------------------------------------------------------------+
   */

//------------------------------------------------------------------------------------------------------------+

  $cups_admin_class = 'Team-Aero: Comp Leader';		// The class you want to be able to manage the cups.
  $cups_player_class = 'Team-Aero: Comp Player';	// The class you want to receive emails from newly added cups. (This is NOT the emails send to players who participated!)
  $cups_cal_category = 'Team-Aero: Cups';			// The category name for newly added cups to the calendar.

//------------------------------------------------------------------------------------------------------------+

/*
You can add a new game inside the 'images/game/' folder by creating a new folder with the name of the game.
The Cup Plugin will read the 'images/game/' folder and extracts the names of the folders inside and adds them to the options, from which you can choose what game the cup is for.
Once you have chosen what game the cup is for, it will automaticly add the corresponding roster (userclass) to that game.

(For example: All players who play the game 'Enemy Territory - Quake Wars' are part of the roster (userclass) 'Team: ETQW')
(If you don't have seperate userclasses for each roster, you can just rename them all to the same userclass, e.g. USER)
*/

  $cups_userclass = "$form[gamename]";
	if ($cups_userclass == 'Enemy Territory - QUAKE Wars')
	{  $cups_userclass = 'Team: ETQW';  }
	if ($cups_userclass == 'Wolfenstein - Enemy Territory')
	{  $cups_userclass = 'Team: WOLFET';  }
	if ($cups_userclass == 'Wolfenstein')
	{  $cups_userclass = 'Team: WOLF';  }
	if ($cups_userclass == 'QuakeLive')
	{  $cups_userclass = 'Team: QL';  }

//------------------------------------------------------------------------------------------------------------+

  $cups_squad = "$mysql_row[gamename]";
	if ($cups_squad == 'Enemy Territory - QUAKE Wars')
	{  $cups_squad = 'Team: ETQW';  }
	if ($cups_squad == 'Wolfenstein - Enemy Territory')
	{  $cups_squad = 'Team: WOLFET';  }
	if ($cups_squad == 'Wolfenstein')
	{  $cups_squad = 'Team: WOLF';  }
	if ($cups_squad == 'QuakeLive')
	{  $cups_squad = 'Team: QL';  }

?>