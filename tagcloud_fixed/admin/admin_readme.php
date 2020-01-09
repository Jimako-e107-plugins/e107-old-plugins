<?php
require_once("admin_leftblock.php");

if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}
 
class currentplugin_adminArea extends leftblock_adminArea
{
       
}
  
new currentplugin_adminArea();

 

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");

   // Our informative text
   $text = "
   <b>Top Tags Tagcloud Plugin BETA v1.0</b>
   <p>
   Keep up to date on e107 and related news and <b>be the first</b> to know when my <b>new releases</b> are available:
   <p><a href='http://feeds.feedburner.com/Jezza101'>Subscribe to my <b>RSS News feed</b> now!</a>
   <p>
   <p>
   <br>
   <b>Getting started:</b>
   <p>
   To see a tagcloud please install the tagcloud menu in the e107 admin menu config page, or place the {TAGCLOUD}
   shortcode within your site.
   <p>
   Tags associated with content can be displayed by inserting the {TAGS} shordcode into your template.  In the latest release
   the plugin will attempt to do this automatically, but this may not work on all themes. If you find it messes up ypur theme,
   switch off the override function in the preferences page.
   Please ask on my <a href='http://www.jezza101.co.uk'>forum</a> if you need help.
   <p>
   <b>Admin Options:</b>
   <p>
   <b>Preferences</b>
   <p>
   <li>Enter default number of tags to be shown in the tag cloud, this can be overwritten when placing the tagcloud shortcode
   eg {TAGCLOUD=50} to show 50 tags.  This default option will determine how many tags are seen in the side menu if used.
   <li>Tag cloud menu title will be displayed at the top of your tag cloud if you use the included menu.  For example 'Quick Links' etc
   <li>Fix the length of item preview here, this is the number of caracters that will be shown on the <a href='".e_PLUGIN."tagcloud/tagcloud.php'>tagcloud.php</a> tags link/preview page
   <li>Check the show admin tag edit link to add an option for Admins to manually edit the tags on the tags link/preview page.
   Select the appropriate class
   <li>Check the user class to allow users to edit rags on their content, eg to add tags to a forum post they made.
   <li>Template override attempts to insert the {TAGS} shordcode into your theme.  This should work on standard themes, with the exception of tags on news
   items where the theme uses a newsstyle function.  If auto insertion fails, please manually insert the {TAGS} shortcode into your theme templates.
   <li>Number of tags to show on the big page of tags page, eg  <a href='".e_PLUGIN."tagcloud/tagcloud.php'>here</a>
   <LI>The order of the tags shown in the tagcloud can be set.  This can be useful for ensuring the links in the cloud do not change so often and
   will allow Google to iterate over the links.
   <p>
   The tagcloud shortcode can accept parameters to override settings.  This can be used if you want a particular type of cloud on a specific page
   <p>eg {TAGCLOUD=50|news|date} would show 50 news tags ordered by date
   <p>eg {TAGCLOUD=10|forum|alpha} would show 10 news tags in alphabetical order
   <p>
   <b>SEO</b>
   <p>
   This allows you to generate SEO friendly links for your tags.  Note, to use this, you must be able to set the mod_rewrite rules in .htaccess
   If you don't know what this is, then you will need to understand it before going further.
   <p>
   For example: <p>
   RewriteRule    ^tags-(.*).html$ e107_plugins/tagcloud/tagcloud.php?\$1 [L]
   <p>
   This will match any URL beginning with 'tags-' and ending in '.html'
   <p>
   <li>Use SEO Links - switches this functionality off or on
   <li>SEO link structure - set this to match the rewrite rule used above.  eg 'tags-' to use www.jezza101.co.uk/tags-mytag.html
   <li>File extension is the extension used in your rewrite rule.  Leave blank for none.
   <li>Replace spaces with a character.  Genrally a hyphen is standard Google friendly '-' but the old plugin used an underscore '_' so you may
   wish to keep this so keep your pages indexed.
   <p>
   <b>Style</b>
   <p>
   Allows you to enter a class in your theme css file to define the look of your tag links, eg:
   <p>
   .tag a:link     {text-decoration: underline }   <br>
   .tag a:visited  {color: purple; text-decoration: underline }    <br>
   .tag a:active   {text-decoration: underline; background-color: #5E7743; }      <br>
   .tag a:hover    {text-decoration: underline; background-color: #5E7743; }     <br>
   <p>
   Alternatively, leave blank, or enter a class that already exists in your theme.
   <p>
   <li>Cloud CSS class: style of the actual cloud ie {TAGCLOUD} as seen in the menu.
   <li>Item Tags CSS class: style as seen on the tags that appear with an item, eg at the base of a news post.
   <li>Tag link page CSS class: style of tags shown on the link/preview page, ie the page you go to when you click on a tag in the cloud.
   <p>
   <li>Colour gradient - enter a hex value for start and end colours (eg ffffff).  The tags will be automatically be coloured using colours between the ranges
   entered.
   <li>Min and Max determine the range of font sizes in the tag cloud, enter a % as desired here
   <p>
   <b>Maintenance:</b>
   <p>
   <li>Remove orphan tags, this will clear out any tags that are attached to items that nolonger exist
   <li>Remove tags under a minimum legth.  This can be used to remove rubbish short tags.
   <li>Remove tags from menu custom pages.  This is required because if you generate custom menu pages from the e107 backend
   this is stored in the pages table.  Unfortunately there is no easy way to block these as they are not flagged in the Pages table.
   However it is possible to remove the tags afterwards using this function.


   <p>
   <p>
   <b>Linkware</b>
   <p>
   If you use this plugin, please link back to my site!
   <p>
   www.jezza101.co.uk
   ";

   // The usual, tell e107 what to include on the page
   $ns->tablerender("MyPlugin Read Me", $text);

   require_once(e_ADMIN."footer.php");
?>

