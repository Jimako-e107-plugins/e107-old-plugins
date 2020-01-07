parse_str($parm);
   //require_once("../../class2.php");
   //eg {TAGCLOUD=20|news} would show 30 news tags

   global $tp,$class2,$pref;
   require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
   $tagcloud = new e107tagcloud;

   $tmp    = explode("|",$parm);
   $tagcnt = $tmp[0];
   $tagtyp = substr($tmp[1],0,10);  //security
   $tagord = substr($tmp[2],0,10);  //security

   if ($parm) {$tagcount = $parm;} else {$parm = $pref['tags_number'];}
   if (strlen($tagord)<1){$tagord=$pref[tags_order];}


   $tags = $tagcloud->get_cloud_list($tagcnt,$tagtyp,$tagord);
   //returns tag_name and number quant
   $max_size = $pref['tags_max_size']; // max font size in %
   $min_size = $pref['tags_min_size']; // min font size in %

   $max_qty = max(array_values($tags));
   $min_qty = min(array_values($tags));
   $spread = $max_qty - $min_qty;
   $colour  = $tagcloud->gradient($pref['tags_min_colour'],$pref['tags_max_colour'],$spread);
   //$colour  = $tagcloud->gradient('87CEFA','483D8B',$spread);
   if (0 == $spread) { // we don't want to divide by zero
       $spread = 1;
       }
       $step = ($max_size - $min_size)/($spread);
       $htmlout = "<div class='".$pref['tags_style_cloud']."'>";
       $xml     = "<tags>";
       foreach ($tags as $key => $value) {
//UTF-8
         $size     = $min_size + (($value - $min_qty) * $step);
         $link     = $tagcloud->MakeSEOLink($key);
         $search_link = mb_convert_encoding($link, 'utf-8', 'windows-1251');
         $search_link = str_replace("_","+",$search_link);
         $htmlout .= '<a href="'.$link.'" style="font-size: '.$size.'%;color:#'.$colour[$value].';"';
         $key      = preg_replace("#_#"," ",$key);
         $htmlout .=  'title="'.$value.' things tagged with '.$key.'"';
         $htmlout .=  '>'.$key.'</a>   ';
         $xml     .= "<a href='$search_link' style='22'>$key</a>"; //color='0xff0000' hicolor='0x00cc00'

// CP1251

//           $size     = $min_size + (($value - $min_qty) * $step);
//           $link     = $tagcloud->MakeSEOLink($key);
//           $htmlout .= '<a href="'.$link.'" style="font-size: '.$size.'%;color:#'.$colour[$value].';"';
//           $key      = preg_replace("#_#"," ",$key);
//           $htmlout .=  'title="'.$value.' things tagged with '.$key.'"';
//           $htmlout .=  '>'.$key.'</a> &nbsp;&nbsp;';
//           $xml     .= "<a href='$link' style='22'>$key</a>"; //color='0xff0000' hicolor='0x00cc00'
}
           $htmlout .= "</div>";
           $xml     .= "</tags>";
 
 
$text = $tp->parseTemplate($htmlout)."\n";
 
return $text;