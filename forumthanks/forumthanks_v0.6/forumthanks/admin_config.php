<?php

   require_once("../../class2.php");


   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }
   
	include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_admin_thanks.php');

   require_once(e_ADMIN."auth.php");

	$e_sub_cat = 'config';

//-------------------------------------------------------
//----------------  Handle form posting




if (isset($_POST['updatesettings'])) {

		$pref['thanks_showuser']     = ($_POST['thanks_showuser']     ? $_POST['thanks_showuser'] : 0 );
		$pref['thanks_replaceposts'] = ($_POST['thanks_replaceposts'] ? $_POST['thanks_replaceposts'] : 0);
        $pref['thanks_statlink']     = ($_POST['thanks_statlink']     ? $_POST['thanks_statlink'] : 0 );
        $pref['thanks_loading_icon'] = ($_POST['thanks_loading_icon'] ? $_POST['thanks_loading_icon'] : 0 );
        $pref['thanks_icon']         = ($_POST['thanks_icon']         ? $_POST['thanks_icon'] : 0 );
        $pref['thanks_limit']        = ($_POST['thanks_limit']        ? $_POST['thanks_limit'] : 0 );
        $pref['thanks_start']        = ($_POST['thanks_start']        ? $_POST['thanks_start'] : 0 );
        $pref['allow_remove_thanks'] = ($_POST['allow_remove_thanks'] ? $_POST['allow_remove_thanks'] : 0 );
        $pref['thanks_show_date']    = ($_POST['thanks_show_date']    ? $_POST['thanks_show_date'] : 0 );
        
	save_prefs();
	$e107cache->clear("thanks");
	$message = LAN_AT10;
}


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}


if ($pref['thanks_showuser'])     {$thanks_showuser      ='checked';}
if ($pref['thanks_replaceposts']) {$thanks_replaceposts  ='checked';}
if ($pref['thanks_statlink'])     {$thanks_statlink      ='checked';}
if ($pref['allow_remove_thanks']) {$allow_remove_thanks  ='checked';}
if ($pref['thanks_start'])        {$thanks_start         ='checked';}
if ($pref['thanks_show_date'])    {$thanks_show_date     ='checked';}
$thanks_limit     										 =$pref['thanks_limit'];

$param = "thanks_loading_icon,".e_PLUGIN."forumthanks/user_images/loading/".",".$pref['thanks_loading_icon'];
$loading_icon_list = $tp->parseTemplate("{IMAGESELECTOR={$param}}");

$param = "thanks_icon,".e_PLUGIN."forumthanks/user_images/thank/".",".$pref['thanks_icon'];
$thanks_icon_list = $tp->parseTemplate("{IMAGESELECTOR={$param}}");

$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

      	<tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT1."</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_replaceposts' ".$thanks_replaceposts." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT2."</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_showuser' ".$thanks_showuser." />
	</td>
	</tr>
	
	      	<tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT31."</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_show_date' ".$thanks_show_date." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT3."</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='allow_remove_thanks' ".$allow_remove_thanks." />
	</td>
	</tr>

        <tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT4."</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_statlink' ".$thanks_statlink." />
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT5."</td>
	<td class='forumheader3' style='width:60%'>
	$thanks_icon_list
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT6."</td>
	<td class='forumheader3' style='width:60%'>
	$loading_icon_list
	</td>
	</tr>
	
        <tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT7."</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_start' ".$thanks_start." />
	</td>
	</tr>
	
        <tr>
	<td class='forumheader3' style='width:40%'>".LAN_AT8."</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='thanks_limit' value = '".$thanks_limit."' SIZE='2' MAXLENGTH='2'/>
	</td>
	</tr>

	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updatesettings' value='".LAN_AT9."' />
	</td>
	</tr>
          </table>
	  </form>
	  </div>";





   // The usual, tell e107 what to include on the page
   $ns->tablerender(LAN_AT12, $text);

   require_once(e_ADMIN."footer.php");
?>

