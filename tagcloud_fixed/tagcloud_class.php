<?php
//ADD: function that renders a list or item info box. this can then be called at top of edit or item entry
//	 and at top of show just item or list page

if (!defined('e107_INIT')) { exit; }

if (!class_exists('e107tagcloud')) {
	
	class e107tagcloud
	{
	  var $tagsTemplates = array();
	  var $tagsShortcodes = array();
	  var $tagsPrefs = array();
	  
		function __construct() {
		  $this->tagsTemplates 	= e107::getTemplate('tagcloud');  
		  $this->tagsShortcodes = e107::getScBatch('tagcloud', 'tagcloud');
		  $this->tagsPrefs 			= e107::getPlugConfig('tagcloud')->getPref(); 
		}
		
		function get_cloud_list($no,$ty,$order)
		{
 
			switch ($order) {
				case "random":
					$ordersql = "rand()";
				break;
				case "alpha":
					$ordersql = "Tag_Name";
				break;
				case "date":
					$ordersql = "Tag_Created desc";
				break;
				default:
					$ordersql = "rand()";	//default to random?
				break;
			}

			if (strlen($ty)>1)
			{
				$whr = " AND A.Tag_Type ='$ty' ";
			}
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
			$records = e107::getDb()->retrieve($query, true);
			foreach ($records AS $row)
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
			$sql = e107::getDb();
			$tp = e107::getParser();
			$tmp	= explode(",",$list);
			$sql->db_delete("tag_main","Tag_Type = '".$area."' AND Tag_Item_ID =".$id);
			$cnt = 0;
			$time = time();
			foreach ($tmp as $updatetag)
			{
				$cnt++;
				//Validation - profanity filter/excluded word list/minimum legth?
				$updatetag = trim($updatetag);
				$updatetag = $tp->toDB($updatetag);
				$updatetag = preg_replace ("#\s#","_",$updatetag);

				if ($updatetag <>'')
				{
					$insertsting = "null,".$id.",'".$area."','".$updatetag."',".$cnt.",$time";	
					$sql->db_insert("tag_main",$insertsting);
				}
			}
		}


		function MakeSEOLink($tag_db) //expects a db tag
		{
			$plugPrefs = e107::getPlugConfig('tagcloud')->getPref();
			if ($plugPrefs['tags_useseo'])
			{				
				/*	 $link = //SITEURLBASE.
								//e_HTTP.$plugPrefs['tags_seolink'].ereg_replace("[^A-Za-z0-9]", $plugPrefs['tags_tagspace'], substr($tag,0,100)).$plugPrefs['tags_fileext']	;}
								e_HTTP.$plugPrefs['tags_seolink'].preg_replace("#_#", $plugPrefs['tags_tagspace'], substr($tag_db,0,100)).$plugPrefs['tags_fileext']	;*/
						
				$data = array('tagcloud_key'=> preg_replace("#_#", $plugPrefs['tags_tagspace'], substr($tag_db,0,100)));																 
				$link = e107::url('tagcloud', 'tag', $data);																			
			}	
			else
			{
				$link = e_PLUGIN_ABS."tagcloud/tagcloud.php?".$tag_db;
			}
			//echo "T:$link<p>";
			return $link;
		}

		//tag forms ------------------------------------------------------------------
		//a tag -> a_tag ->	a+tag	-> a_tag -> a tag
		function tagtodisplay($tag) //expects a db tag
		{
							$tag	= preg_replace("#_#"," ",$tag); //this is the tag to display, replace underscore with a space
							$tag	= $this->html2txt($tag);	 //overkill?
			return $tag;
		}

		function tagtodb($tag) //expects?
		{
			$tp = e107::getParser();
			$plugPrefs = e107::getPlugConfig('tagcloud')->getPref();
			//generates a URL style tag from.... anything?

			if (strlen($plugPrefs['tags_tagspace'])<1)
			{
				$spc='_';}else{$spc = $plugPrefs['tags_tagspace'];
			}
			$tag				 = URLDECODE($tag);
			$tag				 = $tp->toDB($tag);		//if anything nasty is in the url it will be escaped
			$tag				 = $this->html2txt($tag);	 //overkill?
			$tag				 = str_replace($spc,"_",$tag);				 //swap users chosen spacer with an underscore
			$tag				 = str_replace(" ","_",$tag);				 //strip actually just leaves a space
			//echo "classTEST1:$tag<p>";
			return $tag;
		}
		//function tagtourl($tag_db) //expects a db tag
		//{ global $plugPrefs;			return $tag_url;		 }

		//-------------------------------------------------------------------


		function	gradient($hexstart, $hexend, $steps) {

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
 
		//PARANOIA :)
		function html2txt($document)
		{
			$search = array('@<script[^>]*?>.*?</script>@si',	// Strip out javascript
							'@<style[^>]*?>.*?</style>@siU',		// Strip style tags properly
							'@<[\/\!]*?[^<>]*?>@si',						// Strip out HTML tags
							'@<![\s\S]*?--[ \t\n\r]*>@'				 // Strip multi-line comments including CDATA
			);
			$text = preg_replace($search, '', $document);
			return $text;
		}

	}
}
?>
