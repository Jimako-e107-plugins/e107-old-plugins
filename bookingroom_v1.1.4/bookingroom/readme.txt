####################################################################
#                                                                  #      
#            	Meeting Room Booking System                        #   
#               ---------------------------                        #  
#                                                                  #  
#     This plugin is a conversion of the MRBS system 1.1.3 pre     #
#                                                                  #
#    Converted by Ian Beaver on 24 december 2006 to the e107 CMS   #
#                                                                  #
####################################################################

Support is at www.keal.org.uk  Do not try to get support at MRBS They won't support this as it is
in effect a fork of their project.  Thanks to the team at MRBS for this excellent system.  I've been using the standalone version for 2 years without fauls.
i have no support web site i use the works to delvopment of web


Installation
------------

Copy the booking plugin folder into you e107plugins folder.  Go to the admin panel and select the plugin manager.
Find the Room Booking plugin and click on install.  Then go to the admin panel again and configure the plugin.

When the plugin has been created and configured you will need to go to the main web site and go to Room Bookings.  Click on Admin and create areas and rooms.  The system is now ready for your users.

Help on Configuring
-------------------
The config for MRBS is quite extensive and brief help on the settings is given below:

Setting			Comment
Administrator class	Select the class that will have access to creating rooms/areas and can delete/edit any booking
User class		The class that can create bookings and edit/delete their own meetings.  
			Recommend at least members only
View only class		These can only view bookings, can not create/edit/delete bookings
IFrame height		Size of iframe in browser.  MRBS has to work in IFrame.
Send confirmation email	Send email to booker when created.edited or deleted
Resolution		Time spacing on calendar in seconds.  1800 is 30 minutes.  
			This is the time interval between meetings.  eg with resolution of 1800 meetings
			start at 9:00 9:30 10:00 10:30 etc.
Day starts		Earliest time you can book the room
Day ends		Latest time you can book a meeting.
Day ends (minutes)	Minutes to add to to get the real end of the day.
			Examples: To get the last slot on the calendar to be 16:30-17:00, set
			Day Ends = 16 and Day Ends (minutes) = 30. 
			To get a full 24 hour display with 15-minute steps, set 
				day starts=0 
				day ends=23
				day endsminutes =45
				resolution=900
Week starts		Select first day of week
Date format		either like Jan 13 or like 13 Jan
Time format		use 12 hour or 24 hour clock
Max repeating entries	Maximum number of entries that can be created at once.
Default report span	in days
Screen Refresh		How often the screen refreshes in seconds (0 to disable)
Show areas as		List of areas or a drop down list.  Latter is tidy when lots of areas.
Month view shown as	Time slot or brief description.
Week trailer		You can either show the week number or the actual date in the list at the 
			bottom of the page.
Booking type 1 - 9	Different booking types - show in different colours on the calendar
			Leave blank to omit that colour
Resource 1 - 5		Up to 5 user defined Yes/No fields.  
			May be used for AV Equipment/ Refreshments/ Video Conference eqpt etc
			For room caretaker to prepare the room in advance.

GET THESE RIGHT BEFORE YOU START USING THE SYSTEM - ESPECIALLY TIMES.  Changing afterwards is not easy, you may lose sight of bookings etc.

ToDo
----
Sort out the html
User classes on the rooms/areas
Convert from Iframe to e107 tablerender
Convert to e107 language system


you need 
			
change the database usre and the password
in config.inc.php before start

the Resource 1   
Resource 2   
Resource 3   
Resource 4   
Resource 5 

does not work correcly



you need to set a admin class for a user to be able to dele or edit other users room booking
once you set room up 

is just remove the word admin from lang.en

$vocab["admin"]              = "Admin";  
to
$vocab["admin"]              = "";  

at 178 remove function.in lines

  <TD CLASS="banner" BGCOLOR="#C0E0FF" ALIGN=CENTER>
  <A HREF="admin.php?day=<?php echo $day ?>&month=<?php echo $month ?>&year=<?php echo $year ?>"><?php echo get_vocab("admin") ?></A>

to stop users re editing the rooms

and that it

I have tested this and the edit now works

sign up book a room and that user can del and re edit others can`t not edit or delelet unless you set them to admin class

remember to setup a class for admin users


 

