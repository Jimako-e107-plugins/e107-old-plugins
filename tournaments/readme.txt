Tournaments Plugin v1.2 for e107 v0.7+

Great help in creating this plug-in gave me the Kroozearcade plug-in for e107.

The source now is a bit in a mess but in future versions i will clean it up.
This plug-in is released under the terms of the GNU General Public License (GPL). The license can be found
at http://gnu.org You can redistribute, modify or even use portions of this plug-in in any way. I would appreciate
it though if you dropped me a thank you line. This is how every opensource developer is reqarded. Thanks for using.


TODO:

  * A more flexible administration
  * Javascript calendar for dates - DONE
  * No GMT dates, just localized
  * Menu to integrate with the plug-in - DONE
  * Countdown - Partialy done
  * Add support for Greek lang that temporarily i disabled
  
For any bugs, suggestions etc contact me at:
	stratosg@stratosector.net

or visit my website at:
	http://stratosector.net
	
Thanks for downloading!!

PS: I would realy like it and appreciate it if you visit my site and leave a comment or a forum post with comments
on how you like this plug-in and probably witch site you use it on.



Code Tips-Tricks:

  - If you want to manualy adjust your language then replace in files:
    * tournaments/config.php
	* tournaments/index.php
	* tournaments/games/index.php
  the following:
  
    -> Line 23-28:
		if(file_exists(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php")){
			require_once(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php");
		}
		else{
			require_once(e_PLUGIN."tournaments/language/English.php");
		}
	with: require_once(e_PLUGIN."tournaments/language/YOURLANGUAGE.php");
	
  - If you want to disable the image "Play" in the menu delete line 37 from tournaments_menu.php

	
	
Changelog v1.2:

  - Added javascript for dates in the tournament creation
  - Changed the main page with countdowns
  - Created the menu to integrate with this plug-in
  - Solved incompatibility with dates/times. Now all works great with GMT
  - Removed support for Greek language for the moment.


Changelog v1.1:

  - Solved major problem with IE (instead of USERID post it to URL)
  - Added German and Greek language
  - Changed tha language selection so default (if site's language is not implemented) should be English
  - Changed query at index.php in games folder so query does not use hardcoded e107 table prefix, MPREFIX used instead
  
  * To update replace files:
    -> tournaments/index.php
	-> tournaments/config.php
	-> tournaments/games/index.php
	-> Insert language files.
	
No database update needed.

For update v1.1 i want to thank:
  - IZON
  - Elijah
  - Fabian Herold for the German translation
