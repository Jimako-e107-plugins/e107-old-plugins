<?php

   require_once("../../class2.php");


   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }


   require_once(e_ADMIN."auth.php");



//-------------------------------------------------------
//----------------  Handle form posting




if (isset($_POST['updatesettings'])) {

	$pref['thanks_showuser']     = ($_POST['thanks_showuser']     ? $_POST['thanks_showuser'] : 0 );
	$pref['thanks_replaceposts'] = ($_POST['thanks_replaceposts'] ? $_POST['thanks_replaceposts'] : 0);
        $pref['thanks_credit']       = ($_POST['thanks_credit']       ? $_POST['thanks_credit'] : 0 );
        $pref['thanks_statlink']     = ($_POST['thanks_statlink']     ? $_POST['thanks_statlink'] : 0 );
        $pref['thanks_thanklist']    = ($_POST['thanks_thanklist']    ? $_POST['thanks_thanklist'] : 0 );
        $pref['thanks_icon']         = ($_POST['thanks_icon']         ? $_POST['thanks_icon'] : 0 );
        $pref['thanks_limit']        = ($_POST['thanks_limit']        ? $_POST['thanks_limit'] : 0 );
        $pref['thanks_start']        = ($_POST['thanks_start']        ? $_POST['thanks_start'] : 0 );
	save_prefs();
	$e107cache->clear("thanks");
	$message = 'Settings Saved!';
}


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}


if ($pref['thanks_showuser'])     {$thanks_showuser      ='checked';}
if ($pref['thanks_replaceposts']) {$thanks_replaceposts  ='checked';}
if ($pref['thanks_credit'])       {$thanks_credit        ='checked';}
if ($pref['thanks_statlink'])     {$thanks_statlink      ='checked';}
if ($pref['thanks_thanklist'])    {$thanks_thanklist     ='checked';}
if ($pref['thanks_icon'])         {$thanks_icon          ='checked';}
if ($pref['thanks_start'])        {$thanks_start          ='checked';}
$thanks_limit      =$pref['thanks_limit'];


$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

      	<tr>
	<td class='forumheader3' style='width:40%'>Replace forum post count</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_replaceposts' ".$thanks_replaceposts." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Show thanks stats in user.php<br>(test this doesnt break theme)</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_showuser' ".$thanks_showuser." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Show expandable thanks list at base of posts</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_thanklist' ".$thanks_thanklist." />
	</td>
	</tr>

        <tr>
	<td class='forumheader3' style='width:40%'>Insert stat links shortcode into forum.php page</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_statlink' ".$thanks_statlink." />
	</td>
	</tr>
	
        <tr>
	<td class='forumheader3' style='width:40%'>Use icon instead of link</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_icon' ".$thanks_icon." />
	</td>
	</tr>
	
        <tr>
	<td class='forumheader3' style='width:40%'>Only thread starter may be thanked</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='thanks_start' ".$thanks_start." />
	</td>
	</tr>
	
        <tr>
	<td class='forumheader3' style='width:40%'>Max thanks allowed per day</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='thanks_limit' value = '".$thanks_limit."' SIZE='2' MAXLENGTH='2'/>
	</td>
	</tr>

	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updatesettings' value='Save Settings' />
	</td>
	</tr>
          </table>
	  </form>
	  </div>";





   // The usual, tell e107 what to include on the page
   $ns->tablerender("Prefs", $text);

   require_once(e_ADMIN."footer.php");
?>

