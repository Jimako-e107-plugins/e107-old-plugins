<?php
if(strstr(e_PAGE, "news.php")){ $page = 0;}
elseif(strstr(e_PAGE, "comment.php")){ $page = 1;}
elseif(strstr(e_PAGE, "content.php") && strstr(e_QUERY, "content")){ $page = 2;}
elseif(strstr(e_PAGE, "content.php") && strstr(e_QUERY, "review")){ $page = 3;}
elseif(strstr(e_PAGE, "content.php") && strstr(e_QUERY, "content")){ $page = 4;}
elseif(strstr(e_PAGE, "chat.php")){ $page = 5;}
elseif(strstr(e_PAGE, "links.php")){ $page = 6;}
elseif(strstr(e_PAGE, "forum")){ $page = 7;}
elseif(strstr(e_PAGE, "user.php") || strstr(e_PAGE, "usersettings.php")){ $page = 8;}
elseif(strstr(e_PAGE, "download.php")){ $page = 9;}
else{ $page = 99;
}

$text .= "<form method='post' action='".e_BASE."search.php'>
<p>
<input class='tbox' type='text' name='searchquery' size='20' value='' maxlength='50' />
<input type='hidden' name='searchtype' value='$page' />
<input class='button' type='submit' name='searchsubmit' value='".ONLINEINFO_SEARCH."' />
</p>
</form>";
if($searchflat){ echo $text; }else{ $ns -> tablerender(LAN_180." ".SITENAME, "<div style='text-align:center'>".$text."</div>"); }
?>