<?php

//TAGCLOUD PLUGIN COPYRIGHT 2007-2009 jezza101
//www.jezza101.co.uk
//Plugin released in good faith and has been tested by many users however I make no guarantee of its
//suitability for your site.  Please test carefully before use on a production site!
//you may use this plugin freely on your site but please do not distribute without consent
//please pass back any modifications so that I can consider them for inclusion in an official release
//Thanks! :)

//-----initialise

   require_once("../../class2.php");

	$cache_tag = "tagcloud_";

// See if the page is already in the cache
	if($cacheData = $e107cache->retrieve($cache_tag))
	{
		define("e_PAGETITLE", "Title of page");
		require_once(HEADERF);
		echo $cacheData;
	}
else {

   global $tp;
   if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
   include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/lan_search.php');
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;
   require_once(e_PLUGIN."tagcloud/tagcloud_shortcodes.php");
   include_once(e_PLUGIN."tagcloud/tagcloud_template.php");
   require_once(e_HANDLER."ren_help.php");

   $con = new convert;

   include_lan(e_PLUGIN.'tagcloud/languages/'.e_LANGUAGE.'/lan_tagcloud.php');

//ECHO "<P>DECODE:".URLDECODE(e_QUERY)."<P>" ;
//a tag -> a_tag ->  a+tag  -> a_tag -> a tag

//--VARIABLES-----
   $tmp         = explode(".", e_QUERY);
   $tag         = $tmp[0];
   $tag_db      = $tagcloud->tagtodb($tag);
   $tag_display = $tagcloud->tagtodisplay($tag_db);

   $from        = (isset($tmp[1]) ? intval($tmp[1]) : 0);
   $pagehead    = $tag_display;
   $view        = 10;

//test
//echo "EQ:".e_QUERY."<p>";
//echo "C:$tag_display T:$tag_db<p>";

//------------------------
//---header

   $tagtext .= $tp->parseTemplate($header, TRUE, $tagcloud_shortcodes)."\n";


//------------------------
//---body


   $sql2 = new db;

   $query = "SELECT
              Tag_Item_ID, Tag_Type
             FROM
              #tag_main A
             JOIN
              #tag_config B on A.Tag_Type = B.Tag_Config_Type
             WHERE
              B.Tag_Config_CloudFlag = 1     and
              Tag_Name               = '".$tag_db."' ORDER BY Tag_Rank LIMIT ".$from.",".$view;

   if ($sql2->db_select_gen($query)) //validates $tag_db
{
      //tag exists, start building the output

      //load config into array
      if($sql->select("tag_config","Tag_Config_Type"))    //,"Tag_Config_Flag = 1")) //switching off areas?
          {
            while ($row = $sql->fetch())
                  {
                  $tag_type =$row['Tag_Config_Type'];
                  include_once(e_PLUGIN."tagcloud/config/".$tag_type.".php");
                  $config[$tag_type] = array (
                  "id_field"      => $id_field     ,
                  "return_fields" => $return_fields,
                  "where"         => $where        ,
                  "order"         => $order        ,
                  "table"         => $table);
                 }
           }
      //print_r($config['download']);

      //loop through the items in the tag list from tag_main
      while ($tagrow = $sql2->fetch())
       {
                $TAGS          = "";
                $tag_type      = $tagrow['Tag_Type'];
                $return_fields = $config[$tag_type]['return_fields'];
                $table         = $config[$tag_type]['table'];
                $where         = $config[$tag_type]['where'];
                $id_field      = $config[$tag_type]['id_field'];

                //echo"<p>WHERE:$where<p>";

                //select the items from source table
                $sql_query = "SELECT  ".$return_fields."
                              FROM   #".$table."
                              WHERE   ".$where." AND ".$id_field." = ".$tagrow['Tag_Item_ID'];     //echo "<p>$sql_query<p>";

                //echo "<p>Q:$sql_query<p>";
                $itemrow = $sql->gen($sql_query);
                $itemrow = $sql->fetch();

                        $handler = "search_".$tagrow['Tag_Type'] ;
                        $res = call_user_func($handler, $itemrow);

                        //ADD:checks to see if these fields are populated, ie what happens
                        //if content has no title?

                        $TITLE      = "<a href = '".e_BASE.$res['link']."'>".$res['title']."</a>";
                        $PRETITLE   = $res['pretitle'];                                           //echo "PRETITLE<p>$PRETITLE";
                        $PRESUMMARY = $res['pre_summary'];                                        //echo "PRESUMMARY<p>$PRESUMMARY";
                        $SUMMARY    = $res['summary'];
                        $SUMMARY    = $tp->toHTML($SUMMARY, TRUE, 'constants');
                        $SUMMARY    = $tp->html_truncate($SUMMARY,$pref['tags_preview'],"");   //echo "SUMMARY<p>$SUMMARY";
                        $SUMMARY   .= "...<a href='".e_BASE.$res['link']."'>".LAN_TG7."</a>";
                        $DETAIL     = $res['detail'];

                        //get other tags for output
                        $sql->select("tag_main","*","Tag_Item_ID = ".$tagrow['Tag_Item_ID']." and Tag_Name <> '".$tagrow['Tag_Name']."' and Tag_Type ='".$tagrow['Tag_Type']."' ORDER BY Tag_Rank" ,  TRUE);
                        $TAGS  .= "<span class='".$pref['tags_style_link']."'>";
                        while ($othertags = $sql->fetch())
                              {
                              $link = $tagcloud->MakeSEOLink($othertags['Tag_Name']);
                              //$meta .= $othertags['Tag_Name'].' ';
                              $TAGS .= "<a href='".$link."'>".preg_replace("#_#"," ",$othertags['Tag_Name'])."</a>   &nbsp;&nbsp;";
                              }
                        $TAGS  .= "</span>";

                        if ($pref['tags_adminmod'] and ADMIN) {$TAGS .= "<a href='".e_PLUGIN."tagcloud/tagedit.php?".$tagrow['Tag_Type'].".".$tagrow['Tag_Item_ID']."'>(edit tags)</a>";}
                        $tagtext .= $tp->parseTemplate($bodyt, TRUE, $tagcloud_shortcodes)."\n";

      }

       $total = $sql -> select("tag_main", "*", "Tag_Name = '".$tag_db."'");

       //build up nextprev parameter
       $url       = e_SELF.'?'.$tag_db.'.[FROM]';
       $parms = $total.",".$view.",".$from.",".$url;

       $tagtext .= "<div style='text-align:center;'>";
       $tagtext .= $tp->parseTemplate("{NEXTPREV={$parms}}");
       $tagtext .= "</div>";
       //$link = preg_replace("# #","-",$tag_display);

//-------------------------------------------------------------
       //CREATE SOME BACKLINKS FOR THE AUTHOR :)

       //this plugin took hundreds of hours to write, I don't ask for anything other than a few backlinks on a couple of keywords :)!
       //these links will only appear on a handful of pages only where relevant

       //ONLY SHOWS IF YOU TICK THE SHOW LINK BOX :)
       if ($pref['tags_credit'])
       {
           //$credit = "<p><center><a style='font-size:85%' href='http://gnu.su'>Jezza101`s e107 tagcloud plugin</a></center><p>";
           $credit = $tagcloud->makelinks($tag_display);
           $tagtext .= $credit;
        }
//--------------------------------------------------------------

        $tagtext .= $tp->parseTemplate($footer, TRUE, $tagcloud_shortcodes)."\n";

}
else {
      if (!isset($pref['tags_errortag'])){$pref['tags_errortag']=200;}
      $tagtext  = $tp->parseTemplate("{TAGCLOUD=".$pref['tags_errortag']."}", TRUE, $tagcloud_shortcodes); //LAN_TG1;  //'Tag not found';
      $pagehead = $pref['tags_menuname'];  //"Error!";
      //PLEASE LEAVE THIS LINK
      //THIS PLUGIN REPRESENTS MANY HOURS OF WORK, ALL I ASK IN RETURN IS ONE LINK BACK TO MY SITE :)
      //USE OF THIS PLUGIN IS CONDITIONAL ON LINKING TO MY SITE SOMEWHERE :)
      //MANY THANKS
      $tagtext .= "<div style='width:100%;text-align:center;'><span style='text-align:center;'></span></div>";
      }

//use the last title for the meta summary?
//$metadesc   .= $res['title'];

//------------------------
//---Footer


   //$tagtext .= $tp->parseTemplate($footer, TRUE, $tagcloud_shortcodes)."\n";


//-----------
//   define("META_KEYWORDS", "$tag_display");    FIX THIS
//   define("META_DESCRIPTION", SITENAME." - Страница содержит весь материал о $tag_display !!!  Вы найдете всю интересующую информацию о  $tag_display тут. Все что вы хотели знать о $tag_display но боялись спросить!");
   define("e_PAGETITLE", "$pagehead");     
   
   
//	ob_start();					// Set up a new output buffer
//	$ns -> tablerender($pagehead, $tagtext);	// Render the page
//	$cache_data = ob_get_flush();			// Get the page content, and display it
//	$e107cache->set($cache_tag, $cache_data);	// Save to cache

   require_once(HEADERF);
   $ns->tablerender($pagehead, $tagtext);
   require_once(FOOTERF);

}

?>

