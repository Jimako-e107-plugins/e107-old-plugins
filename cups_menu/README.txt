-----------------------------------------------------------------------------------------------------------+

Contact:

- If you have any questions there is a forum at team-aero.co.nr where you can leave a message.

- If you found this plugin useful, I would appreciate you signing my guestbook and leaving your site url :)

-----------------------------------------------------------------------------------------------------------+

Installation:

- Upload the war_cups_menu folder to e107_plugins folder

- Goto the Admin Area, Plugin Manager, choose to Install Cups

- Goto the Admin Area, Cups, and change the configuration

- Goto the Admin Area, Cups, Menus, and set where the Cups Menu is to appear

- In the cups_config.php file there is a short conversion code which converts the gamename to a defined roster (userclass)
  YOU NEED TO CHANGE THESE GAMENAMES AND THEIR CORRESPONDING USERCLASSES TO YOUR OWN PREFERRED VALUES
  The gamename is related to the folder inside 'images/game/YourGameName'

- In the cups_config.php file there are values you need to set for which userclass you want to be able to manage the cups
  Also to which userclass the mass-emails should be send to, and in what calendar category the events should be placed in

-----------------------------------------------------------------------------------------------------------+

Frequent Asked Questions and Useful Information:

Q. How do I add a new game ?
A. Create a new folder /images/game/YourGameName and place inside it a 16x16 pixel image called icon.gif

Q. How do I add a new league ?
A. Create a 16x16 pixel gif image within /images/league/ and name the image after the league.

Q. How do I remove unwanted Games, Types, Leagues ?
A. Just delete the folder / gifs that you dont want.

Q. How do I add and remove Squads ?
A. You can do this in the Admin Area, Cup section.

Q. How does the emailing work ?
A. When a cup is set to '1st Place', '2nd Place' or '3th Place' each chosen player will be emailed.

Q. How do I make people appear on the Select Player list ?
A. Make them a part of a roster (userclass) defined as '$cups_userclass' and '$cups_squad' in cups_config.php

Q. How do I add people to the Player list who are not part of the roster but did participate in the cup ?
A. Select the game they are part of and press "Update Game and Players". The Player should then be selectable. Add him, press "Update Game and Players"
	again, and change the game back again to what it was. Press "Update Game and Players" once more. Be sure to save it by pressing "Add or Update Cup"

Q. How can I give non admins permission just to create and modify wars ?
A. Make them part of a userclass defined as '$cups_admin_class' in cups_config.php

Q. How can I rename the Cups Link on the menu ?
A. Goto the Admin Area, Links, and choose Edit.

Q. How do I get the cups to show up on the calendar ?
A. Install the calendar plugin included with E107 and then enable in the Admin Panel.

-----------------------------------------------------------------------------------------------------------+
