<?php
   // Remember that we must include class2.php
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

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
   <li>Auto generate tags if none are found - this uses yahoo keyword generator to create some tags from the current content about to be displayed.
   Note:  This could slow down your site if your content is too sparse to generate any keywords as the plugin will atempt to generate some keywords
   each time the content is displayed.  You might want to add at least one tag manually in these cases.
   <li>Number of tags to show on the big page of tags page, eg  <a href='".e_PLUGIN."tagcloud/tagcloud.php'>here</a>
   <LI>The order of the tags shown in the tagcloud can be set.  This can be useful for ensuring the links in the cloud do not change so often and
   will allow Google to iterate over the links.
   <p>
   The tagcloud shortcode can accept parameters to override settings.  This can be used if you want a particular type of cloud on a specific page
   <p>eg {TAGCLOUD=50|news|date} would show 50 news tags ordered by date
   <p>eg {TAGCLOUD=10|forum|alpha} would show 10 news tags in alphabetical order
   <p>
   <b>Cumulus</b>
   <p>
   Cumulus is a flash based animated tagcloud written by <a href='http://www.roytanck.com/about-my-themes/donations/'>Roy</a> and
   ported to e107 by <a href='http://www.jezza101.co.uk'>jez</a>.  Note that it doesn't handle special characters by default
   you need a version adapted for your own language's character set.  See Roy's site for more info.
   <li>Switch on or off. Switch off to use a traditional html style cloud. Uses without flash (eg Google) will see
   the old style html tags.   Remember to test that this looks how you expect.
   <li>Width and Height:  Set a size appropriate for your theme. You need to work out how big the cloud should be.
   <li>Set the tag colour
   <li>Set the background colour or
   <li>set the cloud to be transparent to use your theme's background
   <li>Set the rotation speed.  A value of 100 is a good starting point.
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
   <b>Yahoo:</b>
   <p>
   This Plugin uses the yahoo API to generate key words from the various e107 source tables. Hit the Update button to run.
   <p>
   Yahoo only allows 5000 lookups to its keyword generator per IP per day, if your site generates more entries than this then you will have problems!
   <p>
   Yahoo decides what are keywords in your text, not me, sometimes it seems to work well, othertimes its not so great.
   Yahoo also ranks the tags in order of priority, again this is down to Yahoo's own algorithms.
   Yahoo ID is required by the Yahoo API
   <p>
   <li>The Overwrite option will re-generate tags for all items in all areas, this may take a while.
   With this unticked, new tags are not regenerated if they already exist, even if you update content.
   <li>The yahoo ID is supplied by Yahoo, you require one to use their API, read more <a href ='http://developer.yahoo.com/faq/#apps'>here</a>.
   I have generated one for release with this product, but I cant guarantee its validity - you may wish to register your own.
   <li>The max no. look-ups is the number of content items that you will pass to the Yahoo API in one update, this enables you to run smaller batches
   for a large site.  Remember the max is currently 5000 requests in one day.  If a large batch does fall over, tags created up to that point will be stored in the db.
   Using this preference only makes sense if you have overwrite off above.
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

