<?php
//ADD: function that renders a list or item info box.  this can then be called at top of edit or item entry
//     and at top of show just item or list page

if (!defined('e107_INIT')) { exit; }

class e107tagcloud
{
 

  	function get_cloud_list($no,$ty,$order)
	{
          global $sql;

          Switch ($order) {
            case "random":
             $ordersql = "rand()";
            break;
            case "alpha":
             $ordersql = "Tag_Name";
            break;
            case "date":
             $ordersql = "Tag_Created desc";
            break;
            Default:
             $ordersql = "rand()";   //default to random?
            break;
          }

          if (strlen($ty)>1) {$whr = " AND A.Tag_Type ='$ty' ";}
                      $query = "SELECT
                                 Tag_Name, count(*) as quant
                                FROM ".MPREFIX."tag_main A
                                JOIN
                                  ".MPREFIX."tag_config B on A.Tag_Type = B.Tag_Config_Type
                                WHERE
                                 B.Tag_Config_CloudFlag = 1 AND
                                 B.Tag_Config_OnOffFlag = 1
                                 $whr
                                Group by
                                 Tag_Name
                                ORDER BY
                                  ".$ordersql."
                                LIMIT
                                   ".$no."";
                      //echo "$query";
                      $sql ->db_Select_gen($query);
	              while ($row = $sql->db_fetch())
                     {
	              $ret[$row['Tag_Name']] = $row['quant'];
                     }

           return $ret;
	}
	

	
	

//ADD:function that works out what the appropriate value for Tag_Config_Field_Table and Tag_Item_ID
//if we know this we can creat the corect links.
//eg if e_SELF is page?1 then we know to use the page link and id 1


  	function tags_to_db($list,$area,$id)
	{
          global $sql,$tp;
                 $tmp    = explode(",",$list);
                 $sql->db_delete("tag_main","Tag_Type = '".$area."' AND Tag_Item_ID =".$id);
                 $cnt = 0;
                 $time = time();
                 foreach ($tmp as $updatetag)
                 {
                  $cnt++;
                  //Validation  - profanity filter/excluded word list/minimum legth?
                  $updatetag = trim($updatetag);
                  $updatetag = $tp->toDB($updatetag);
                  $updatetag = preg_replace ("#\s#","_",$updatetag);

                  if ($updatetag <>''){
                     $insertsting = "null,".$id.",'".$area."','".$updatetag."',".$cnt.",$time";
                     $sql->db_insert("tag_main",$insertsting);
                     }
                  }
          }


    function MakeSEOLink($tag_db) //expects a db tag
    {
      global $pref;
              if ($pref['tags_useseo'])
                               {$link = //SITEURLBASE.
                                     //e_HTTP.$pref['tags_seolink'].ereg_replace("[^A-Za-z0-9]", $pref['tags_tagspace'], substr($tag,0,100)).$pref['tags_fileext']  ;}
                                     e_HTTP.$pref['tags_seolink'].preg_replace("#_#", $pref['tags_tagspace'], substr($tag_db,0,100)).$pref['tags_fileext']  ;}
               else
                               {$link = e_PLUGIN_ABS."tagcloud/tagcloud.php?".$tag_db;}
        //echo "T:$link<p>";
      return $link;
    }

//tag forms ------------------------------------------------------------------
//a tag -> a_tag ->  a+tag  -> a_tag -> a tag
    function tagtodisplay($tag) //expects a db tag
    {
             $tag  = preg_replace("#_#"," ",$tag); //this is the tag to display, replace underscore with a space
             $tag  = $this->html2txt($tag);   //overkill?
      return $tag;
    }

    function tagtodb($tag) //expects?
    {
      global $pref,$tp;
       //generates a URL style tag from.... anything?

             if (strlen($pref['tags_tagspace'])<1){$spc='_';}else{$spc = $pref['tags_tagspace'];}
             $tag         = URLDECODE($tag);
             $tag         = $tp->toDB($tag);    //if anything nasty is in the url it will be escaped
             $tag         = $this->html2txt($tag);   //overkill?
             $tag         = str_replace($spc,"_",$tag);         //swap users chosen spacer with an underscore
             $tag         = str_replace(" ","_",$tag);         //strip actually just leaves a space
             //echo "classTEST1:$tag<p>";
      return $tag;
    }
    //function tagtourl($tag_db) //expects a db tag
    //{ global $pref;      return $tag_url;     }

//-------------------------------------------------------------------


function  gradient($hexstart, $hexend, $steps) {

    $start['r'] = hexdec(substr($hexstart, 0, 2));
    $start['g'] = hexdec(substr($hexstart, 2, 2));
    $start['b'] = hexdec(substr($hexstart, 4, 2));

    $end['r'] = hexdec(substr($hexend, 0, 2));
    $end['g'] = hexdec(substr($hexend, 2, 2));
    $end['b'] = hexdec(substr($hexend, 4, 2));

    $step['r'] = ($start['r'] - $end['r']) / ($steps - 1);
    $step['g'] = ($start['g'] - $end['g']) / ($steps - 1);
    $step['b'] = ($start['b'] - $end['b']) / ($steps - 1);
    
    $gradient = array();
    
    for($i = 0; $i <= $steps; $i++) {
        
        $rgb['r'] = floor($start['r'] - ($step['r'] * $i));
        $rgb['g'] = floor($start['g'] - ($step['g'] * $i));
        $rgb['b'] = floor($start['b'] - ($step['b'] * $i));
        
        $hex['r'] = sprintf('%02x', ($rgb['r']));
        $hex['g'] = sprintf('%02x', ($rgb['g']));
        $hex['b'] = sprintf('%02x', ($rgb['b']));
        
        $gradient[] = implode(NULL, $hex);
                
    }
    
    return $gradient;
 }

function makelinks ($tag){  //THIS MAKES A BACKLINKS FOR SPECIFIC TAG PAGES IF AUTHOR LINK CHECK BOX IS TICKED!
    $hintsxml = '<taglinks>
                        <hint>Plugin</hint><anchor>E107 Plugins</anchor><site>jezza101.co.uk</site><hint>Blog</hint><anchor>How to build a blog</anchor><site>blogercise.com</site><hint>Website</hint><anchor>How to build a website</anchor><site>blogercise.com</site><hint>Adsense</hint><anchor>Make money with adsense</anchor><site>blogercise.com/search-engine-optimisation-basics</site><hint>Google</hint><anchor>SEO for beginners</anchor><site>blogercise.com/search-engine-optimisation-basics</site><hint>Money</hint><anchor>Make money online</anchor><site>blogercise.com</site><hint>Flare</hint><anchor>Flared trousers</anchor><site>flaredtrousers.co.uk</site><hint>Trousers</hint><anchor>Seventies Trousers</anchor><site>flaredtrousers.co.uk</site><hint>Fashion</hint><anchor>Hot fashion trends</anchor><site>flaredtrousers.co.uk</site><hint>Netbook</hint><anchor>Netbook accessories</anchor><site>sammynetbook.com/netbook-accessories-upgrades-addons</site><hint>Nc10</hint><anchor>Samsung NC10</anchor><site>sammynetbook.com/samsung-nc10-netbook-best-deals</site><hint>Nc20</hint><anchor>Samsung NC20</anchor><site>sammynetbook.com/samsung-nc20-netbook-best-deals</site><hint>Eee</hint><anchor>Netbooks</anchor><site>SammyNetbook.com</site><hint>Wind</hint><anchor>Portable PCs</anchor><site>SammyNetbook.com</site><hint>Aspire</hint><anchor>Ultra portables</anchor><site>SammyNetbook.com</site><hint>Notebook</hint><anchor>Samsung Notebooks</anchor><site>sammynotebook.com</site><hint>Q210</hint><anchor>Samsung Q210 Notebook</anchor><site>sammynotebook.com</site><hint>Q310</hint><anchor>Samsung Q310 Notebook</anchor><site>sammynotebook.com</site><hint>SSD</hint><anchor>Samsung SSD Storage</anchor><site>SammySSD.com</site><hint>Mobile</hint><anchor>Samsung Mobile Phones</anchor><site>sammymobile.com</site><hint>Phone</hint><anchor>Samsung Phones</anchor><site>sammymobile.com</site><hint>Pixon</hint><anchor>Samsung Pixon Phone</anchor><site>sammymobile.com/reviews/samsung-pixon</site><hint>Iphone</hint><anchor>Mobile Phones</anchor><site>sammymobile.com</site><hint>Omnia</hint><anchor>Samsung Omnia Phone</anchor><site>sammymobile.com/reviews/samsung-omnia</site><hint>Tocco</hint><anchor>Samsung Tocco Phone</anchor><site>sammymobile.com/reviews/samsung-tocco</site><hint>Q1</hint><anchor>Samsung Q1</anchor><site>Sammyumpc.com</site><hint>TV</hint><anchor>Samsung TVs</anchor><site>sammytelevisions.com</site><hint>Television</hint><anchor>Samsung Televisions</anchor><site>sammytelevisions.com</site><hint>Mp3</hint><anchor>Samsung Home Entertainment</anchor><site>sammyhome.com</site><hint>DVD</hint><anchor>Samsung DVD Players</anchor><site>sammyhome.com</site><hint>Blue-ray</hint><anchor>Blue Ray Players</anchor><site>sammyhome.com</site><hint>Laptop</hint><anchor>Samsung Laptops</anchor><site>Sammylaptop.com</site><hint>X360</hint><anchor>Samsung X360 Laptop</anchor><site>Sammylaptop.com/reviews/samsung-x360</site><hint>X460</hint><anchor>Samsung X460 Laptop</anchor><site>Sammylaptop.com/reviews/samsung-x460</site><hint>Camera</hint><anchor>Samsung Cameras</anchor><site>sammydigitalcamera.com</site><hint>Photo</hint><anchor>Camera Blog</anchor><site>sammydigitalcamera.com</site><hint>Digital</hint><anchor>Digital cameras</anchor><site>sammydigitalcamera.com</site><hint>SLR</hint><anchor>SLR Cameras</anchor><site>sammydigitalcamera.com</site><hint>Q1EX</hint><anchor>Samsung Q1</anchor><site>samsungq1ex.com</site><hint>Kindle</hint><anchor>Kindle Blog</anchor><site>kindleblog.co.uk</site><hint>Ebook</hint><anchor>Buy an ebook reader</anchor><site>buyebookreader.co.uk</site><hint>Read</hint><anchor>Free ebooks</anchor><site>buyebookreader.co.uk</site><hint>British</hint><anchor>Top British Stuff</anchor><site>topbritish.com</site><hint>UK</hint><anchor>Top UK Stuff</anchor><site>topbritish.com</site><hint>Sex</hint><anchor>Home sex change</anchor><site>homesexchange.com</site><hint>History</hint><anchor>Book guide</anchor><site>historybooks.to-buy.co.uk</site><hint>Book</hint><anchor>History Books</anchor><site>historybooks.to-buy.co.uk</site><hint>E107</hint><anchor>E107 hints and tips</anchor><site>jezza101.co.uk</site>
                        <hint>Tag</hint><anchor>Tagcloud Plugin</anchor><site>jezza101.co.uk</site><hint>Buy</hint><anchor>Bargains and deals</anchor><site>to-buy.co.uk</site><hint>Shop</hint><anchor>Online shops</anchor><site>to-buy.co.uk</site><hint>Dad</hint><anchor>How to be a good dad</anchor><site>whohasdad.com</site><hint>Father</hint><anchor>How to be a good father</anchor><site>whohasdad.com</site><hint>Exercise</hint><anchor>Treadmill guide</anchor><site>treadmillsexercise.com</site><hint>Homes</hint><anchor>Home Exchanges</anchor><site>homesexchange.com</site><hint>N110</hint><anchor>Samsung N110</anchor><site>sammynetbook.com</site><hint>N310</hint><anchor>Samsung N310</anchor><site>sammynetbook.com</site><hint>Samsung</hint><anchor>Samsung Wiki</anchor><site>sammywiki.com</site><hint>Forum</hint><anchor>Samsung Forum</anchor><site>sammywiki.com/forum</site><hint>wiki</hint><anchor>Samsung Wiki</anchor><site>sammywiki.com/wiki</site>
                 </taglinks>';
    $xml = $hintsxml;
    $key = 0;
    //print_r($xml);
    foreach  ($xml->hint as $hint)
       {
        $anchor = $xml->anchor[$key];
        $site   = $xml->site[$key];
        //echo ":$hint:$anchor:$site:$tag:<p>";
        if (stristr($tag, strval($hint))){
           $credit = "<p><center><a style='font-size:85%' href='http://www.$site'>$anchor</a></center><p>";
           return  $credit;
            }
        $key++;
       }
       return  "<p><center><a style='font-size:85%' href='http://www.jezza101.co.uk'>e107 plugins tagcloud</a></center><p>";
}


 //PARANOIA :)
 function html2txt($document){
   $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
                   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
    );
    $text = preg_replace($search, '', $document);
    return $text;

}

}

?>
