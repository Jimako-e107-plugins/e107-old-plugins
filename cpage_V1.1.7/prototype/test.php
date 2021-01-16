<?php

require_once('../../class2.php');
require(HEADERF);
$text="
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
something<br /><br /><br /><br />
<div id='fbmenu_wrapper'>
	<span id='fbmenu'>
		<span id='fbmenu_inner'>
			<span class='fb_bar_icon_left'>
				<a href='".SITEURL."index.php'><img src='images/bar/house.png' alt='Home Page' /></a>
			</span>
			<span class='fb_bar_icon_left'>
				<a href='".SITEURL."download.php'><img src='images/bar/downloads.png' alt='Downloads' /></a>
			</span>
			<span class='fb_bar_icon_right'>
				<a href='".SITEURL."forum.php'><img src='images/bar/forums.png' alt='Forums' /></a>
			</span>

			<span class='fb_bar_icon_right'>
				<a href='".SITEURL."index.php'><img src='images/bar/feed.png' alt='RSS' /></a>
			</span>
			<span class='fb_bar_icon_right'>
				<a href='".SITEURL."index.php'><img src='images/bar/house.png' alt='home' /></a>
			</span>
		</span>
	</span>
	<span id='fb_menu_co'>
		<span  >
			<img id='fbmenu_excol' src='images/bar/section_collapsed.png' alt='home' />
		</span>
	</span>
</div>
";

$ns->tablerender('baz',$text,'bb');
require(FOOTERF);