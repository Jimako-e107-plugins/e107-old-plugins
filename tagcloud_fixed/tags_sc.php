<?php
   parse_str($parm);

   global $tp,$sql,$post_info,$forum,$meta;;
   include_lan(e_PLUGIN.'tagcloud/languages/'.e_LANGUAGE.'/lan_tagcloud.php');
   //$TAGS ="";
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;
   if (check_class($pref['tags_adminmod']))
                   {$TAGMOD=TRUE;}  else {$TAGMOD=FALSE;}

   $posturl = e_SELF."?".e_QUERY;

   //$a = e_QUERY;$b = e_SELF;  $id = $pageID;
   //$TAGS .= "Query: $a";
   //$TAGS .= "Self: $b";
   //$TAGS .= "ID: $id";



//-------------------------------------
//--  set type and find id field


//--- NEED TO MAKE THIS GENERIC

   //detect news page:
   if($news_item = getcachedvars('current_news_item'))
   {$Tag_Item_ID = $news_item['news_id'];
    $Tag_Type    = 'news';}

   //detect page
   if(e_PAGE=='page.php'){
      $tmp          = explode(".", e_QUERY);
      $Tag_Item_ID  = intval($tmp[0]);
      $Tag_Type     = 'page';
         }

   //detect download view
   if(e_PAGE=='download.php'){
      $tmp          = explode(".", e_QUERY);
      $Tag_Item_ID  = intval($tmp[1]);
      $Tag_Type     = 'download';
         }

   //detect forum
   if(e_PAGE=='forum_viewtopic.php'){
      if ($post_info['user_id'] != '0' && $post_info['user_name'] === USERNAME && check_class($pref['tags_usermod'])){$TAGMOD=TRUE;}
      $posturl = e_SELF."?".e_QUERY."#post_{$post_info['thread_id']}";
      $Tag_Item_ID  = $post_info['thread_id'];
      $Tag_Type     = 'forum';
         }

   //detect content
   if(e_PAGE=='content.php'){

      $tmp          = explode(".", e_QUERY);
      $Tag_Item_ID  = intval($tmp[1]);
      $Tag_Type     = 'content';
         }


//-----------------------------------
//-- update tags

if ($TAGMOD){
    $upd = 'tagupdate'.$Tag_Item_ID;
    $tgs = 'tags'.$Tag_Item_ID;

    if (isset($_POST[$upd])) {
      $tagcloud->tags_to_db($_POST[$tgs],$Tag_Type,$Tag_Item_ID);
      }
 }



//-----------------------------------
// get tag list


       //this gets wrapped in a table
       $TAGS .= "<tr><td class='".$pref['tags_style_item']."'>";

       $query = "SELECT
                  A.*
                 FROM
                  #tag_main A
                 JOIN
                  #tag_config B on A.Tag_Type = B.Tag_Config_Type
                 WHERE
                  B.Tag_Config_OnOffFlag = 1     and
                 Tag_Item_ID = ".$Tag_Item_ID." and Tag_Type ='".$Tag_Type."'
                 ORDER BY
                  Tag_Rank";

       if ($sql->gen("$query"))
       {
         while ($othertags = $sql->fetch())
         {
             $link = $tagcloud->MakeSEOLink($othertags['Tag_Name']);
             $TAGS     .= "<a ".$class." href='".$link."'>".preg_replace("#_#"," ",$othertags['Tag_Name'])."</a>   &nbsp;&nbsp;";
             $EDITLIST .= $com.preg_replace("#_#"," ",$othertags['Tag_Name']);
             $com       = ',';
             $meta     .= $othertags['Tag_Name'].' ';
         }
       }
       else
       {
        if($pref['tags_autogen'])     //JM rewritten to use v2 data 
        {        $keywords =  array();
                //auto generate tags if there are none:
                 if (e_PAGE=='news.php') {
                   //$news_item = getcachedvars('current_news_item');   
									 $sc = e107::getScBatch('news');    
									 $news_item = $sc->getScVar('news_item');          
                   //$param     = getcachedvars('current_news_param'); why?
                   $ystring    = $tp -> toHTML($news_item['news_body'], TRUE, 'parse_sc, fromadmin', $news_item['news_author']);
                   $keywords = explode(",",$news_item["news_meta_keywords"]); 
                 }
                 elseif (e_PAGE=='page.php' AND  $_GET['id'] > 0 ) {   
								   $sc   = e107::getScBatch('page', null, 'cpage');
        					 $page_item = $sc->getVars('cpage');       print_a($page_item);      
                   $keywords = explode(",",$page_item["page_metakeys"]); 
                 }
                  elseif (e_CURRENT_PLUGIN =='download' AND $_GET['action'] == 'view' AND  $_GET['id'] > 0 ) {        //this works only after constants fix
                    $sc   = e107::getScBatch('download',true);
										$download_item = $sc->getVars('view');       
                    $keywords = explode(",",$download_item["download_keywords"]); 
                 }
                  elseif (e_PAGE=='pcontent.php') {  
                    //not tested
                    //$content_item = getcachedvars('current_content_item');  
                    //$keywords = explode(",",$download_item["content_meta"]); 
                 }  
                 elseif (e_PAGE=='forum_viewtopic.php') {
                   //uncomment to auto gen on your forum - read the note in the readme before doing this!  other solution is needed
                   //$ystring    = $post_info['thread_thread']; 
                 }
                 //else {continue;}   //caused an error

                 
                 $limit    = 0;
                 $time     = time();

                 if ($keywords)
                     {
                     foreach ($keywords as $word)
                      {
                       if ($limit>=$pref['tags_peritem']){continue;}
                       if (strlen($word)<=$pref['tags_minlen']){continue;}

                       $needle    = ','.$word.',';
                       $haystack  = ','.$pref['excludelist'].',';
                       $word      = preg_replace ("#\s#","_",$word);                         //echo  "$needle and $haystack</span>";
                       $pos       = strpos($haystack,$needle);
                       if ($pos===false){
                          $limit++; $cnt++;
                          $sql->db_insert("tag_main","null,".$Tag_Item_ID.",'".$Tag_Type."','".$word."',$limit,$time");}            //`Tag_ID`  `Tag_Item_ID`  `Tag_Type`  `Tag_Tags`
                          }
                     }


                   //---now tags are there get them again
                   if ($sql->select("tag_main","*","WHERE Tag_Item_ID = ".$Tag_Item_ID." and Tag_Type ='".$Tag_Type."' ORDER BY Tag_Rank" ,  TRUE))
                         {
                             while ($othertags = $sql->fetch())
                             {
                                 $link = $tagcloud->MakeSEOLink($othertags['Tag_Name']);
                                 $TAGS     .= "<a ".$class." href='".$link."'>".preg_replace("#_#"," ",$othertags['Tag_Name'])."</a>   &nbsp;&nbsp;";
                                 $EDITLIST .= $com.preg_replace("#_#"," ",$othertags['Tag_Name']);
                                 $com       = ',';
                                 $meta     .= $othertags['Tag_Name'].' ';
                             }
                         }
          }
       }
       $TAGS     .= "</td></tr>"; //end tag style div

//-----------------------------------
// build output


$string .= "<table>".$TAGS;

if ($TAGMOD) {  $string .="<tr><td>
                 <div style='cursor:pointer' onclick=\"expandit('exp_tags_{$Tag_Item_ID}')\">
                 ".LAN_TG4."
                  </div>
                  <div id='exp_tags_{$Tag_Item_ID}' style='display:none'>
	          <form method='post' action='".$posturl."' id='tageditform'>
	          <textarea class='fborder' name='tags".$Tag_Item_ID."' cols='30' rows='2'>".$EDITLIST."</textarea>
 	          <input class='button' type='submit' name='tagupdate".$Tag_Item_ID."' value='".LAN_TG5."' />
                  </div></div> </tr></td>

                  ";
            }

$string .= "</table>";


//-------------------------------------


   //$string = $TAGS.$form;

   $text = $tp->parseTemplate($string)."\n";


?>