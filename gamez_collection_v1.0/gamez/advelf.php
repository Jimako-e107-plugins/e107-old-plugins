<?php

require_once("../../class2.php");
require_once(HEADERF);
$text .='<center>
  <p><span class="copy8 style1"><strong>Adventure Elf</strong></span></p>
  <p>
    <object classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=7,0,2,0" width="512" height="384">
      <param name="src" value="http://downloads2.kewlbox.com/games_online/adventure-elf.dcr">
      <embed src="http://downloads2.kewlbox.com/games_online/adventure-elf.dcr" pluginspage="http://www.macromedia.com/shockwave/download/" width="512" height="384"></embed>
    </object>
    <br>
    </p>
</center>';
$ns -> tablerender("Adventure Elf", $text);
require_once(FOOTERF);
?>