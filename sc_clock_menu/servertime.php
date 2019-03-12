<?php
/*
 * Filename.....: inc_servertime.php
 * Features.....: Javascript servertime script
 * 
 * Erstellt am..: in 2001->rough include file / 2003-09-06->this class
 *       _  __      _ _
 *  ||| | |/ /     (_) |        Wirtschaftsinformatiker IHK
 * \. ./| ' / _ __  _| |_ ___   www.ingoknito.de
 * - ^ -|  < | '_ \| | __/ _ \  
 * / - \| . \| | | | | || (_) | Peter Klauer
 *  ||| |_|\_\_| |_|_|\__\___/  06131-651236
 * mailto.......: knito@knito.de
 *
 * Changes:
 * 2003-12-07: Spanish month names and date syntax from Martin Link
 *             Updated french month names (Sarah Vetsch) 
 * 2003-10-26: Steffen Niegsch <niegsch at gmx dot de> noticed that the old 
 *             servertime script (from 2001) started faster than the class does. 
 *             There was less time spent until the clock was running.
 *             New feature: Optional starting of the clock within the <body> tag
 *             with <body onload="clock()">
 *             Must tell this to the class with $servertime->bodyonload=true;
 * 2003-10-03: Idea from Martin Link <martin@link-korntal.de>
 *             Time offset in var $offset_hours 
 * 2003-10-01: By Eric Mathieu <agneric@videotron.ca>
 *             Supports french in date language. 
 * 2003-09-25: By Paul Hargreaves (www.silicontable.com)
 *             am/pm can be selected big or small with $ucaseampm
 * 2003-09-18: By Paul Hargreaves (www.silicontable.com) and Knito
 *             Added functionality do have an alarm-array and output
 *             alarms. New variables: $alarmon, $alarmdate, $alarm,
 *             $onalarm, $alarmpage (see readme.txt/liesmich.txt)
 *
 * 2003-09-10: By Paul Hargreaves (www.silicontable.com)
 *             added two more switches:
 *
 *             new switch $military for 24 h (default) or 12 h (am/pm) format
 *             new switch $showdate to switch the date off
 *
 * 2003-09-06: Made a class out of the script, made it easier to implement
 *             (only 2 installing points instead of three) 
 *             made it work with Mozilla 1.4
 */

/*
The Server-Date-Time script

Purpose: Install a digital clock showing server date and time 
using php and javascript

Browser: IE, NS

the original javascript-code comes from 
http://javascript.internet.com/clocks/basic-clock.html

copyright (c) 2001 by knito@knito.de
http://www.ingoknito.de

License: FREE
        
*/

class servertime
{

  var $divid = 'Pendule'; // default id name
  var $divstyle = 'position:absolute;'; // default for NS 4.7
  var $divtag = 'div'; // other possibility: 'span'
  var $divclass = ''; // default empty
    
  var $title = 'Servertime:'; // default clock title
  var $language = 'english'; // default language
  var $shortmonth = true; // have 3-letter-months like "Apr" if true
  
  #
  # Internal use only: $ok_head and $ok_clock
  #
  var $ok_head  = false; // InstallClockBody() and InstallClock() will check for this.
  var $ok_clock = false; // InstallClockBody() will check for this, too.

  #
  # New on Oct 3 2003: offset_hours
  #
  var $offset_hours = 0;
  
// Feedy's edits
  var $military = true; // use military time?
  var $ucaseampm = true; // use upper case for am/pm?
  var $showdate = true; // show the date?
  var $alarmon = false; // alarms on?
  var $alarmdate = false; // ahouls alarms check the date?
  var $alarm = array(); // alarm times array (strings in military format "HH:MM" for time only and "YYYY-MM-DD HH:MM" for date & time check)
  var $bodyonload = false; // If <body onload="clock()"> is used, set it to true, please
// End of Feedy's edits

  #
  # the programmer may support his/her own javascript alarm function.
  #
  var $onalarm = 'doAlarm'; // default value: javascript function to open a window
  var $alarmpage = 'alarm.php'; // default page to be loaded

  var $alarmpagew = '200'; // width of default alarm page
  var $alarmpageh = '200'; // height of default alarm page
  var $alarmpageopts = 'scrollbars=yes, resizable=yes'; // options for default alarm page
  # $alarmpageopts is a comma separated string var and it can be an empty string for no options
  # valid options include:
  # toolbar		-> shows the tool or button bar
  # location	-> shows the address field
  # directories	-> shows the directory or links bar
  # menubar		-> shows the menu
  # scrollbars	-> shows the scrollbars if the page to display is larger than the windown size
  # resizable	-> allows the window to be resized
  # to get a normal browser window, you would use $alarmpageopts = 'toolbar,location,directories,menubar,scrollbars,resizable';

  # This function is to be used in the <head> section of the page.
  function InstallClockHead( )
  {
    echo "<script type='text/javascript'>";
    
    if( $this->showdate == true ) // array with month names is not always necessary
    {
      if( $this->shortmonth == true )
      {
    	   switch ($this->language) {
         
            case 'spanish' :
              echo 'var monat=new Array("enc.","feb.","mar.","abr.","may.",'.
                   '"jun.","jul.","ago.","sep.","oct.","nov.","dic.");';
              break;
                          
            case 'german':
               echo 'var monat=new Array("Jan.","Feb.","M&auml;r.","Apr.","Mai","Jun.",'.
                    '"Jul.","Aug.","Sep.","Okt.","Nov.","Dez.");';
               break;
               
            case 'french':
               echo 'var monat=new Array("Jan","F&eacute;v","Mar","Avr","Mai","Jun",'.
                    '"Jul","Aou","Sep","Oct","Nov","D&eacute;c");';
               break;
               
            case 'english':
            default:
               echo 'var monat=new Array("01","02","03","04","05","06",'.
                    '"07","08","09","10","11","12");';
               break;
        }
      }
      else
      {
    	   switch ($this->language) {
         
            case 'spanish' :
              echo 'var monat=new Array("encro","febrero","marzo","abril","mayo",'.
                   '"junio","julio","agosto","septiembre","octubre","noviembre","diciembre");';
              break;
                          
            case 'german':
               echo 'var monat=new Array("Januar","Februar","M&auml;rz","April","Mai",'.
                    '"Juni","Juli","August","September","Oktober","November","Dezember");';
               break;
               
            case 'french':
               echo 'var monat=new Array("Janvier","F&eacute;vrier","Mars","Avril","Mai",'.
                    '"Juin","Juillet","Ao&ucirc;t","Septembre","Octobre","Novembre","D&eacute;cembre");';
               break;
               
            case 'english':
            default:
               echo 'var monat=new Array("January","February","March","April","May",'.
                    '"June","July","August","September","October","November","December");';
               break;
        }
      } // else ( $this->shortmonth != true )
    } // if ( $this->showdate == true )            
    echo "\n";
    
    #
    # Here is where the server time comes into the script:
    # date() is a php function which runs on the server, giving exactly
    # the time the server has.
    #
    $datum = 
      date('d M Y H:i:s', 
      mktime( date('H') + $this->offset_hours, 
      date('i'), date('s'), date('m'), date('d'), date( 'Y' ) ) );
    

    echo 'var digital = new Date( "'.$datum.'");'; // <-- this is the trick!
   
    echo "\n\nfunction writeLayer(layerID,txt)".
    "\n{\n  if(document.getElementById)\n  {\n".
    "    document.getElementById(layerID).innerHTML=txt;\n".
    "  }\n  else if(document.all)\n  {\n    document.all[layerID].innerHTML=txt;\n".
    "  }\n  else if(document.layers)\n  {\n".
    "    document.layers[layerID].document.open();\n".
    "    document.layers[layerID].document.write(txt);\n".
    "    document.layers[layerID].document.close();\n  }\n}\n";   

// Feedy's edits
// This is what happens when the alarm goes off... 
// you can change this to open a window or whatever alse you would like to happen
   if( $this->onalarm == 'doAlarm' )
   {
     echo "\n\nfunction doAlarm(alarmtext,alarmtime)\n".
     "{\n".
     "  url = '$this->alarmpage?alarmtext=' + alarmtext + '&amp;alarmtime=' + alarmtime;\n". // knito
     "  popupWin = window.open(url, 'alarm', 'width=$this->alarmpagew,height=$this->alarmpageh";
  	 if ( strlen(trim($this->alarmpageopts))>0 ) echo ",$this->alarmpageopts";

	   echo "')\n}\n";
     
   } // if( $this->onalarm == 'doAlarm' )
   
// End of Feedy's edits
   
   echo "\n//-->\n</script>\n";

   if( $this->alarmon == true and !file_exists( $this->alarmpage ) ) // knito 
   {
     die( "Servertime: file $this->alarmpage is missing!\n" );
   }
   
   $this->ok_head = true; // Check later
   
  } // eof InstallClockHead();

  # This is to be used where you want the clock to appear on your page.
  function InstallClock()
  {
    # To have it work with NS 4.7 the style "position:absolute" MUST be given (knito)
    $klasse = strlen( trim( $this->divclass ) ) > 0 ? " class='$this->divclass'" : '';
    $style  = strlen( trim( $this->divstyle ) ) > 0 ? " style='$this->divstyle'" : '';
    
    echo "<$this->divtag id='$this->divid'>$this->title</$this->divtag>";
//    echo "<$this->divtag id='$this->divid'$style$klasse>$this->title</$this->divtag>";
    
    if( $this->ok_head == false )
    {
      die("Servertime: InstallClockHead() is missing");
    }
    $this->ok_clock = true;
  } // eof Clock() 

  
  # This function is to be used at the end of the <body> section of the page.
  function InstallClockBody( )
  {
    echo "\n<script type='text/javascript'>\n<!--\n".
    "function clock()\n{\n".
    "  var hours = digital.getHours();\n".
    "  var minutes = digital.getMinutes();\n".
    "  var seconds = digital.getSeconds();\n".
    
  	"  var ampm = '';\n".  // Feedy
    
    "  var d = digital.getDate();\n".
    "  var m = digital.getMonth();\n".
    "  var y = digital.getFullYear();\n".
    "  var dispTime;\n\n  digital.setSeconds( seconds+1 );\n\n".
    
    "  if (minutes < 10) minutes = '0' + minutes;\n".
    "  if (seconds < 10) seconds = '0' + seconds;\n\n";

  // Feedy's edits    
  	if ( $this->alarmon ) {
		echo "  alid=new Array ();\n".
		"  altm=new Array ();\n";
		reset($this->alarm);
		$el=0;
		while ($alarminfo = each($this->alarm)) {
			echo "  alid[$el] = '".$alarminfo['value']."';\n".
			"  altm[$el] = '".$alarminfo['key'].":00';\n";
			$el++;
		}
		echo "  timeCheck = hours + \":\" + minutes + \":\" + seconds;\n".
		"  if (hours < 10) timeCheck = '0' + timeCheck;\n";
		if ($this->alarmdate) {
			echo "  timeCheck = d + \" \" + timeCheck;\n".
			"  if (d < 10) timeCheck = '0' + timeCheck;\n".
			"  timeCheck = (m+1) + \"-\" + timeCheck;\n".
			"  if ((m+1) < 10) timeCheck = '0' + timeCheck;\n".
			"  timeCheck = y + \"-\" + timeCheck;\n";
		}
		echo "  alCt=altm.length;\n".
		"  for (var i=0; i < alCt; i++) {\n".
		"  if (timeCheck==altm[i]) $this->onalarm(alid[i],altm[i]);\n".
		"  }\n";
	}
	
	if ( !$this->military )
	{
		$ampm="\"pm\" : \"am\"";
		if ( $this->ucaseampm ) $ampm=strtoupper($ampm);
    
		echo "  ampm = ( hours > 11 ) ? ".$ampm.";\n".
		"  hours = ( hours > 12 ) ? hours-12 : hours;\n".
		"  hours = ( hours == 0 ) ? 12 : hours;";
	}

	if ( $this->showdate )
   {
  	   switch ($this->language) {
       
          case 'spanish':
		      echo "  dispTime = \"$this->title \"+d+\" de \"+monat[m]+\" \"+".
			        "y+\" \"+hours + \":\" + minutes + \":\" + seconds + \" \" + ampm;\n";
            break;
       
          case 'german':
		      echo "  dispTime = \"$this->title \"+d+\". \"+monat[m]+\" \"+".
			        "y+\" \"+hours + \":\" + minutes + \":\" + seconds + \" \" + ampm;\n";
            break;
            
          case 'french':
		      echo "  dispTime = \"$this->title \"+d+\" \"+monat[m]+\" \"+".
			        "y+\" \"+hours + \":\" + minutes + \":\" + seconds + \" \" + ampm;\n";
            break;
            
          case 'english':
          default:
			echo "  dispTime = \"<center><font face='tahoma, verdana, arial, helvetica, sans-serif'; size='1'; color=#999999>Servertime: \" +hours+ \":\" +minutes+ \" CET \"+d+\"/\"+monat[m]+\"/\"+"."y;'</font></center>';\n";
            break;      
      }
	}
   else
   {
  	   switch ($this->language) {
          case 'german':
            #
            # Germans don't like am/pm - we'd rather guess the right half of the day
            # or like to use military time (knito)
            #
		      echo "  dispTime = \"$this->title \"+hours + \":\" + minutes + \":\" + seconds;\n";
            break;
          case 'english':
          case 'french':
          default:
		      echo " dispTime = \"$this->title \"+hours + \":\" + minutes + \":\" + seconds + \" \" + ampm;\n";
            break;
      }
	}
// End of Feedy's edits
    
    echo 
    "  writeLayer( '$this->divid', dispTime );\n".
    "  setTimeout(\"clock()\", 1000);\n}\n\n";
    
    if( $this->bodyonload==false ) echo "  clock();\n//-->\n";
    
    echo "</script>\n";
    
    if( $this->ok_head == false )
    {
      die("Servertime: InstallClockHead() is missing");
    }
    if( $this->ok_clock == false )
    {
      die("Servertime: InstallClock() is missing");
    }

  } // eof InstallClockBody

/*
  function Help()
  {
    echo 
      "<br/>Put InstallClockHead() into the head section".
      "<br/>Put InstallClock() where you want the clock to appear".      
      "<br/>Put InstallClockBody() near the bottom of the document";
  }
*/  
} // eoc ServerTime
?>