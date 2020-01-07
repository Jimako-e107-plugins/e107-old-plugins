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
//$xml="<tags><a href='http://www.roytanck.com' style='22' color='0xff0000' hicolor='0x00cc00'>WordPress</a><a href='http://www.roytanck.com' style='12'>Flash</a><a href='http://www.roytanck.com' style='16'>Plugin</a><a href='http://www.roytanck.com' style='14'>WP-Cumulus</a><a href='http://www.roytanck.com' style='12'>3D</a><a href='http://www.roytanck.com' style='12'>Tag cloud</a><a href='http://www.roytanck.com' style='9'>Roy Tanck</a><a href='http://www.roytanck.com' style='10'>SWFObject</a><a href='http://www.roytanck.com' style='10'>Example</a><a href='http://www.roytanck.com' style='12'>Click</a><a href='http://www.roytanck.com' style='12'>Animation</a></tags>";
//echo "$xml";

//THIS SETS THE NORMAL HTML TAG
$text = $tp->parseTemplate($htmlout)."\n";

//this generates the cumulus cloud, using the html one if required
if ($pref['tags_usecumulus'] and e_PAGE <>'tagcloud.php'){

//var so = new SWFObject("'.e_PLUGIN.'/tagcloud/cumulus/tagcloud.swf", "'.$pref['tags_menuname'].'", "'.$pref['tags_cumwidth'].'", "'.$pref['tags_cumheight'].'", "'.$pref['tags_cumspeed'].'", "'.$pref['tags_cumbackcolour'].'");

  if ($pref['tags_cumtransparent']){$trans='so.addParam("wmode", "transparent");';}
  $text ='<div id="flashcontent">'.$text.'</div>
   	<script type="text/javascript">
                var so = new SWFObject("'.e_PLUGIN.'/tagcloud/cumulus/tagcloud.swf", "'.$pref['tags_menuname'].'", "'.$pref['tags_cumwidth'].'", "'.$pref['tags_cumheight'].'", "7", "#'.$pref['tags_cumbackcolour'].'");
                '.$trans.'
		so.addVariable("tcolor", "0x'.$pref['tags_cumcolour'].'");
		so.addVariable("mode", "tags");
		so.addVariable("distr", "true");
		so.addVariable("tspeed", "'.$pref['tags_cumspeed'].'");
		so.addVariable("tagcloud", "'.$xml.'");
		so.write("flashcontent");
	</script>
  ';
}
else{
   $text = $tp->parseTemplate($htmlout)."\n";
}

return $text;