<?php
require_once("../../class2.php");
if (!getperms("P")) {
   header("location:".e_HTTP."index.php");
   exit;
}
require_once(e_ADMIN."auth.php");

$caption = "Readme File for ".EPLAYER_LAN_NAME." ".EPLAYER_LAN_VER;
$text    = EPLAYER_LAN_NAME." ".EPLAYER_LAN_VER." by bugrain<br>
<br>
A plugin for the e107 Website System (http://e107.org)<br>
<br>
Released under the terms and conditions of the<br>
GNU General Public License (http://gnu.org).<br>
<hr>

<p>ePlayer is a media player plugin that allows media clips to be displayed by category.</p>

<p>ePlayer is configurable from the Admin area of e107. Media clips can be added, updated and deleted, as can media categories.
The preferences page lets you choose where your media clips are located and allows you to change the way media clips are
displayed on your website.</p>

<p>Use normal e107 plugin installtion procedures to install ePlayer. Additionally, copy the <code>eplayer_icons</code> folder
from <code>eplayer/images</code> to <code>e107_images</code> to allow selection of the supplied icons when adding categories
and clips.</p>

<u>Features:</u>
<ul>
   <li>Support for many media types, including MPEG, Quicktime, Shockwave Flash and Real Media.</li>
   <li>Support for image types JPEG, GIF and PNG</li>
   <li>Display media clips sorted by title, date (ascending or descending) or timestamp (again, ascending or descending).</li>
   <li>Set individual icons for categories and media clips.</li>
   <li>Set a custom title for the media pages on your website.</li>
   <li>Set the number of clips to be displayed per page.</li>
   <li>Allow comments to be posted for individual clips</li>
</ul>

<br /><p>ePlayer was inspired by the Media plugin by Perry.</p>

<hr>

<u>Changelog:</u>
<ul>
   <li>Version 1.9:
      <ul>
         <li>+ Added a button in admin area to allow showing of items to approve only
         <li>+ Added a preview option to the admin area
         <li>+ Added admin preference to allow ratings to be turned off
         <li>* Fix for bug that only listed one item even though there were more and the 1 of X text indicated more items
         <li>* Fix for ordering so that items with same date/time appear in correct order (the (reverse) order they were added)
         <li>* Added support for BMP files
         <li>* Ensure unapproved items do not appear in recent list
         <li>* Fixed links from recent list to ePlayer item
      </ul>
   <li>Version 1.8:
      <ul>
         <li>+ Preference to display Upload link via User Class</li>
         <li>+ Global User Class preference for viewing all ePlayer pages</li>
         <li>+ E-Mail on file upload</li>
         <li>+ Added Link for downloading (configured by user class)</li>
         <li>+ Added User Class selection for viewing categories</li>
         <li>* Added number of items to approve to Admin status area</li>
         <li>* Check exif funtion available before use in admin area</li>
      </ul>
   <li>Version 1.7:
      <ul>
         <li>+ Added an entry to status area of main Admin page</li>
         <li>+ Rating system</li>
         <li>+ View counter and last viewed date</li>
         <li>+ Search box on main page</li>
         <li>+ User submission/admin approval of clips</li>
         <li>* Check exif funtion available before use</li>
         <li>* Menu link incorrect during installation</li>
         <li>* Include ver.php to get e107 version (fixes comments where all comments show as guest)</li>
         <li>* Fixed some XHTML issues</li>
      </ul>
   </li>
   <li>Version 1.6:
      <ul>
         <li>Added preference to use EXIF information for timestamps where available</li>
         <li>Added next/previous item links when viewing a media item</li>
         <li>Added automatic calculation of image and SWF width/height</li>
         <li>Added option to set maximum width of image and SWF when displayed on website</li>
         <li>Added link to images so they can be opened full size in a new window</li>
         <li>Added ability to show EXIF information for images that contain this info.</li>
         <li>Fixed bug (when running e107 0.7) that caused all comments to look as if they had been posted by 'guest'</li>
      </ul>
   </li>
   <li>Version 1.5:
      <ul>
         <li>Added support for JPEG, PNG and GIF files</li>
         <li>New clips and comments better integrated into e107</li>
         <li>Preference to show clip's details above/below/not shown when viewing a clip</li>
         <li>Language defaults to English if no local language file available</li>
      </ul>
   </li>
   <li>Version 1.4:
      <ul>
         <li>Added link from sub-category back to main category</li>
         <li>Fixed some bugs in next/previous paging</li>
      </ul>
   </li>
   <li>Version 1.3:
      <ul>
         <li>Added ePlayer to the e107 search page - can search in clip title and description and category name and description</li>
         <li>Added sub-categories</li>
      </ul>
   </li>
   <li>Version 1.2:
      <ul>
         <li>Admin is automatically notified when updates are available (using the Update Checker plugin)</li>
      </ul>
   </li>
   <li>Version 1.1:
      <ul>
         <li>Added ability to use movie clips from remote sites</li>
         <li>Added ability for visitors to post commnets about movie clips</li>
         <li>Bug fixes</li>
	   </ul>
	</li>
   <li>Version 1.0b1:
      <ul>
         <li>first beta release</li>
	   </ul>
	</li>
</ul>";

$ns->tablerender($caption,$text);

require_once(e_ADMIN."footer.php");
?>
