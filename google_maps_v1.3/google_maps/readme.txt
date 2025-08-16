===============================================================
   GOOGLE MAps - v1.3 - by keithschm
   www.keithschmitt.com
keithschm AT GMAIL DOT COM

MAp Class from   www.phpinsider.com  ported for use on E107
===============================================================
/**
 * Project:     GoogleMapAPI: a PHP library inteface to the Google Map API
 * File:        GoogleMapAPI.class.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * For questions, help, comments, discussion, etc., please join the
 * Smarty mailing list. Send a blank e-mail to
 * smarty-general-subscribe@lists.php.net
 *
 * @link http://www.phpinsider.com/php/code/GoogleMapAPI/
 * @copyright 2005 New Digital Group, Inc.
 * @author Monte Ohrt <monte at ohrt dot com>
 * @package GoogleMapAPI
 * @version 2.3
 */

/* $Id: GoogleMapAPI.class.php,v 1.55 2006/10/22 17:42:10 mohrt Exp $ */


===============================================================



This plugin will allow you to post location points of your users on google maps based on the user class you choose.  
There are several options in the admin section that you can enable to show in the info window of the user on the map. see http://www.keithschmitt.com/e107_plugins/google_maps/google_maps.php for demo



Install

1.You need to get a Google Maps API key from http://www.google.com/apis/maps/signup.html
2. create or activate an extened user filed called location
3. create a class for use with maps (or use an existig class)
4. Install plugin
5. Configure options in the admin section.
6. Add you location to your user settings. (if you do not see you location try reformating it like Syracuse, NY.  Try it at google.com/maps and see if it works there)



