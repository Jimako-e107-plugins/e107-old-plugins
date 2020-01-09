<?php

   require_once("../../../class2.php");
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }


   require_once(e_ADMIN."auth.php");
   require_once(e_HANDLER."userclass_class.php");
   //echo $pref['tags_adminmod'];

//-------------------------------------------------------
//----------------  Handle form posting


if (isset($_POST['updateonoff'])) {
        if($sql->select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
            while ($config = $sql->fetch())
                 {
                  $tagid = $config['Tag_Config_ID'];
                  if($_POST['tags_cloud'.$tagid]){$flag1=1;}else{$flag1=0;}
                  if($_POST['tags_onoff'.$tagid]){$flag2=1;}else{$flag2=0;}
                  $sql2->db_update("tag_config","Tag_Config_CloudFlag =".$flag1.",Tag_Config_OnOffFlag =".$flag2." WHERE Tag_Config_ID =".$tagid);
                 }
           }
}

if (isset($_POST['updateseosettings'])) {
        $pref['tags_tagspace']   = ($_POST['tags_tagspace']   ? $_POST['tags_tagspace']   : '-');
        $pref['tags_useseo']     = ($_POST['tags_useseo']     ? $_POST['tags_useseo']     : 0);
        $pref['tags_seolink']    = ($_POST['tags_seolink']    ? $_POST['tags_seolink']    : '');
        $pref['tags_fileext']    = ($_POST['tags_fileext']    ? $_POST['tags_fileext']    : '');
 	save_prefs();
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}

if (isset($_POST['updatesettings'])) {

	$pref['tags_number']        = ($_POST['tags_number']        ? $_POST['tags_number']        : 20 );
	$pref['tags_preview']       = ($_POST['tags_preview']       ? $_POST['tags_preview']       : 200 );
	$pref['tags_errortag']      = ($_POST['tags_errortag']      ? $_POST['tags_errortag']      : 500 );
        $pref['tags_credit']        = ($_POST['tags_credit']        ? $_POST['tags_credit']        : 0);
        $pref['tags_adminmod']      = ($_POST['tags_adminmod']      ? $_POST['tags_adminmod']      : 0);
        $pref['tags_usermod']       = ($_POST['tags_usermod']       ? $_POST['tags_usermod']       : 0);
        $pref['tags_emetaforum']    = ($_POST['tags_emetaforum']    ? $_POST['tags_emetaforum']    : 0);
        $pref['tags_emetanews']     = ($_POST['tags_emetanews']     ? $_POST['tags_emetanews']     : 0);
        $pref['tags_emetadownload'] = ($_POST['tags_emetadownload'] ? $_POST['tags_emetadownload'] : 0);
        $pref['tags_autogen']       = ($_POST['tags_autogen']       ? $_POST['tags_autogen']       : 0);
        $pref['tags_menuname']      = ($_POST['tags_menuname']      ? $_POST['tags_menuname']      : '');

        //echo "ORDER".$_POST['order'];
        if     ($_POST['order'] =='alpha'){$pref['tags_order']   = 'alpha';}
        elseif ($_POST['order'] =='date') {$pref['tags_order']   = 'date';}
        else   {$pref['tags_order']   = 'random';}
        //echo "<p>pref:".$pref['tags_order'];
	save_prefs();
	$e107cache->clear("tagcloud");
	$message = 'Settings Saved!';
}


   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$tags_number   = $pref['tags_number'];
$tags_preview  = $pref['tags_preview'];
$tags_menuname = $pref['tags_menuname'];
$tags_seolink  = $pref['tags_seolink'];
$tags_tagspace = $pref['tags_tagspace'];
$tags_fileext  = $pref['tags_fileext'];
$tags_adminmod = $pref['tags_adminmod'];
$tags_usermod  = $pref['tags_usermod'];
$tags_errortag = $pref['tags_errortag'];
if ($pref['tags_useseo'])             {$tags_useseo         ='checked';}
if ($pref['tags_credit'])             {$tags_credit         ='checked';}
if ($pref['tags_emetaforum'])         {$tags_emetaforum     ='checked';}
if ($pref['tags_emetanews'])          {$tags_emetanews      ='checked';}
if ($pref['tags_emetadownload'])      {$tags_emetadownload  ='checked';}
if ($pref['tags_autogen'])            {$tags_autogen        ='checked';}
if ($pref['tags_order']=='random')     {$tags_orderrandom    ='checked';}
if ($pref['tags_order']=='alpha')      {$tags_orderalpha     ='checked';}
if ($pref['tags_order']=='date')       {$tags_orderdate      ='checked';}



$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
	<td class='forumheader3' style='width:40%'>Default no. Tags shown in cloud:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_number' value = '".$tags_number."' SIZE='2' MAXLENGTH='2'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Tag cloud menu title:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_menuname' value = '".$tags_menuname."' SIZE='40' MAXLENGTH='40'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>Length of item preview:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_preview' value = '".$tags_preview."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

     	<tr>
	<td class='forumheader3' style='width:40%'>Allow Site wide Tag edits:</td>
	<td class='forumheader3' style='width:60%'>
      	".r_userclass('tags_adminmod', $tags_adminmod, 'off', 'main,admin,nobody')."
	</td>
	</tr>

     	<tr>
	<td class='forumheader3' style='width:40%'>Allow users to mod their own tags where appropriate:</td>
	<td class='forumheader3' style='width:60%'>
      	".r_userclass('tags_usermod', $tags_usermod, 'off', 'member,classes,nobody')."
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Attempt override forum template</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_emetaforum' ".$tags_emetaforum." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Attempt override news template</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_emetanews' ".$tags_emetanews." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Attempt override download template</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_emetadownload' ".$tags_emetadownload." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Auto generate tags when none are found for content being displayed (news only atm)</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_autogen' ".$tags_autogen." />
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>Number of tags to show on the tagcloud page.  This is shown if no tags are found!</td>
	<td class='forumheader3' style='width:60%'>
        <input  class='tbox' type='text' name='tags_errortag' value = '".$tags_errortag."' SIZE='4' MAXLENGTH='4'/>
	</td>
	</tr>

     	<tr>
	<td class='forumheader3' style='width:40%'>Order of tags</td>
	<td class='forumheader3' style='width:60%'>
	Random: <input type='radio' name='order' value='random' $tags_orderrandom>
	Alphabetical: <input type='radio' name='order' value='alpha' $tags_orderalpha>
        Date: <input type='radio' name='order' value='date' $tags_orderdate>
	</td>
	</tr>

      	<tr>
	<td class='forumheader3' style='width:40%'>This plugin is free, all I ask is for a credit link back to my site on the <a href='".e_PLUGIN."tagcloud/tagcloud.php'>tags</a> page. However if you do not want to help me out you can remove the link by unticking the box:<br>(Please tick!)</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_credit' ".$tags_credit." />
	</td>
	</tr>
        ";


$text .= "
	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updatesettings' value='Save Settings' />
	</td>
	</tr>
          </table>
	  </form>
	  </div>";

   $ns->tablerender("Prefs", $text);


//---------------------------------------------------------------------
//  ON OFF


if($sql->select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tr>
	  <td></td>
	  <td class='forumheader3'>Include in Cloud</td>
	  <td class='forumheader3'>Global on/off (will also switch off in cloud)</td>
	</tr>
";
            while ($config = $sql->fetch())
                 {
                 //build up existing form rows
                 if ($config['Tag_Config_CloudFlag'] == 1)  {$check1 = 'checked';} else {$check1='';}
                 if ($config['Tag_Config_OnOffFlag'] == 1)  {$check2 = 'checked';} else {$check2='';}
                 $text .= "
                       	<tr>
	                <td class='forumheader3' style='width:40%'>".$config['Tag_Config_Type']."</td>
	                <td class='forumheader3' style='width:30%'>
	                <input class='tbox' type='checkbox' name='tags_cloud".$config['Tag_Config_ID']."' ".$check1." />
	                </td>
	                <td class='forumheader3' style='width:30%'>
	                <input class='tbox' type='checkbox' name='tags_onoff".$config['Tag_Config_ID']."' ".$check2." />
	                </td>
	                </tr>
                        ";
            }
$text .= "
	<tr>
	<td  class='forumheader' colspan='3' style='text-align:center'>
	<input class='button' type='submit' name='updateonoff' value='Save Settings' />
	</td>
	</tr>
          </table>
	  </form>
	  </div>";
   $ns->tablerender("Tag Content areas On/Off control", $text);

}




//---------------------------------------------
   $text=" <div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>

	<tr>
	<td class='forumheader3' style='width:40%'>Use SEO Links:</td>
	<td class='forumheader3' style='width:60%'>
	<input class='tbox' type='checkbox' name='tags_useseo' ".$tags_useseo." />
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>SEO Link structure: <div style='text-align:right'>".SITEURLBASE.e_HTTP."</div></td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_seolink' value = '".$tags_seolink."' SIZE='50' MAXLENGTH='50'/>
	</td>
	</tr>

	<tr>
	<td class='forumheader3' style='width:40%'>File extension:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_fileext' value = '".$tags_fileext."' SIZE='6' MAXLENGTH='6'/>
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Replace space with:</td>
	<td class='forumheader3' style='width:60%'>
	<input  class='tbox' type='text' name='tags_tagspace' value = '".$tags_tagspace."' SIZE='1' MAXLENGTH='1'/>
	</td>
	</tr>

	<tr>
	<td  class='forumheader' colspan='2' style='text-align:center'>
	<input class='button' type='submit' name='updateseosettings' value='Save Settings' />
	</td>
	</tr>
	

        </table>
	</form>
	</div>";

   $ns->tablerender("SEO Prefs", $text);

   require_once(e_ADMIN."footer.php");
?>

