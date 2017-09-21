<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/admin_readme.php,v $
 * $Revision: 1.2 $
 * $Date: 2006/06/28 01:16:10 $
 * $Author: duclos $
 */

require_once("../../class2.php");

if (!getperms("P"))
{
	header("location:".e_HTTP."index.php");
	exit;
}

require_once(e_PLUGIN."glossary/glossary_ver.php");

include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));

require_once(e_ADMIN."auth.php");

$caption = LAN_GLOSSARY_ADMIN_README_01." ".GLOSSARY_NAME." v".GLOSSARY_VER;

$text    = GLOSSARY_NAME." v".GLOSSARY_VER." ".LAN_GLOSSARY_ADMIN_README_02." Shirka<br />
<br />
".LAN_GLOSSARY_ADMIN_README_03."<br />
<br />
".LAN_GLOSSARY_ADMIN_README_04."<br />
<hr />

<p>".LAN_GLOSSARY_ADMIN_README_05."</p>

<p>".LAN_GLOSSARY_ADMIN_README_06."</p>

<p>".LAN_GLOSSARY_ADMIN_README_07."</p>

<u>".LAN_GLOSSARY_ADMIN_README_08.":</u>
<ul>
   <li>".LAN_GLOSSARY_ADMIN_README_09."</li>
</ul>

<hr />

<u>Changelog:</u>
<ul>
    <li>Version 0.1:
	<ul>
	    <li>first beta release</li>
	</ul>
    </li>
</ul>";

$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");

?>