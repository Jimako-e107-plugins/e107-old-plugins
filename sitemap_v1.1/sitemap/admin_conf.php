<?php
$eplug_admin = true;
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_ADMIN."auth.php");
e107_require_once(e_HANDLER.'arraystorage_class.php');
$eArrayStorage = new ArrayData();
require_once(e_HANDLER."form_handler.php");
$rs = new form;
unset($text);

include_lan(e_PLUGIN."sitemap/languages/".e_LANGUAGE.".php");
// include the sitemap  Class
include 'sitemap.php';
	
   // Handle preferences form being submitted
if (e_QUERY) {
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0];
	unset($tmp);
}   
	
if(isset($_POST['update_sitemap_prefs'])){
	$message = update_sitemapPrefs();
}	

function update_sitemapPrefs(){
	global $sql, $eArrayStorage, $tp; 
		
		$sitemap_pref['sitemap_active'] = $tp->toDB($_POST['sitemap_active']);
		$sitemap_pref['sitemap_spiders'] = $tp->toDB($_POST['sitemap_spiders']);
		$sitemap_pref['ITEM_PER_SITEMAP'] = $tp->toDB($_POST['ITEM_PER_SITEMAP']);
		$sitemap_pref['yahooAppId'] = $tp->toDB($_POST['yahooAppId']);
		$sitemap_pref['sitemap_news'] = $tp->toDB($_POST['sitemap_news']);
		$sitemap_pref['sitemap_news_freq'] = $tp->toDB($_POST['sitemap_news_freq']);
		$sitemap_pref['sitemap_news_prio'] = $tp->toDB($_POST['sitemap_news_prio']);
		$sitemap_pref['sitemap_newscat'] = $tp->toDB($_POST['sitemap_newscat']);
		$sitemap_pref['sitemap_newscat_freq'] = $tp->toDB($_POST['sitemap_newscat_freq']);
		$sitemap_pref['sitemap_newscat_prio'] = $tp->toDB($_POST['sitemap_newscat_prio']);
		$sitemap_pref['sitemap_downloads'] = $tp->toDB($_POST['sitemap_downloads']);
		$sitemap_pref['sitemap_downloads_freq'] = $tp->toDB($_POST['sitemap_downloads_freq']);
		$sitemap_pref['sitemap_downloads_prio'] = $tp->toDB($_POST['sitemap_downloads_prio']);
		$sitemap_pref['sitemap_downloadscat'] = $tp->toDB($_POST['sitemap_downloadscat']);
		$sitemap_pref['sitemap_downloadscat_freq'] = $tp->toDB($_POST['sitemap_downloadscat_freq']);
		$sitemap_pref['sitemap_downloadscat_prio'] = $tp->toDB($_POST['sitemap_downloadscat_prio']);
		// $sitemap_pref['sitemap_content'] = $tp->toDB($_POST['sitemap_content']);
		// $sitemap_pref['sitemap_contentcat'] = $tp->post_toForm($_POST['sitemap_contentcat']);
		// $sitemap_pref['sitemap_forums'] = $tp->post_toForm($_POST['sitemap_forums']);
		// $sitemap_pref['sitemap_forumspost'] = $tp->post_toForm($_POST['sitemap_forumspost']);
		// $sitemap_pref['sitemap_events'] = $tp->post_toForm($_POST['sitemap_events']);
		// $sitemap_pref['sitemap_comments'] = $tp->post_toForm($_POST['sitemap_comments']);

			
	$tmp = $eArrayStorage->WriteArray($sitemap_pref);
	$sql -> db_Update("core", "e107_value='$tmp' WHERE e107_name='sitemap_prefs' ");
	
	if($sitemap_pref['sitemap_active'] == 1){$div_style="success";}else if($sitemap_pref['sitemap_active'] == 0){$div_style="warning";}
		
		$message = "<div class='".$div_style."'><h2>".SITEMAP_MENU_L41."</h2>";
	if($sitemap_pref['sitemap_active'] == 1){
		$message .= "<p>".SITEMAP_MENU_L42."</p></div>";
	}else if($sitemap_pref['sitemap_active'] == 0){
		$message .= "<p>".SITEMAP_MENU_L43."</p></div>";
		}

	return $message;

}

function getDefault_sitemapPrefs(){
            $sitemap_pref['sitemap_active'] = '1';
            $sitemap_pref['sitemap_spiders'] = '1';
            $sitemap_pref['ITEM_PER_SITEMAP'] = '50000';
            $sitemap_pref['yahooAppId'] = '';
			$sitemap_pref['sitemap_news'] = '1';
			$sitemap_pref['sitemap_news_freq'] = '0.1';
			$sitemap_pref['sitemap_news_prio'] = 'weekly';
			$sitemap_pref['sitemap_newscat'] = '0';
			$sitemap_pref['sitemap_newscat_freq'] = '0.5';
			$sitemap_pref['sitemap_newscat_prio'] = 'always';
			$sitemap_pref['sitemap_downloads'] = '0';
			$sitemap_pref['sitemap_downloads_freq'] = '0.1' ;
			$sitemap_pref['sitemap_downloads_prio'] = 'weekly';
			$sitemap_pref['sitemap_downloadscat'] = '0';
			$sitemap_pref['sitemap_downloadscat_freq'] = '0.5';
			$sitemap_pref['sitemap_downloadscat_prio'] = 'always';			
                        
		return $sitemap_pref;
}

function get_sitemapPrefs(){
	global $sql, $eArrayStorage;

	if(!is_object($sql)){ $sql = new db; }
	$num_rows = $sql -> db_Select("core", "*", "e107_name='sitemap_prefs' ");
	if($num_rows == 0){
		$tmp = getDefault_sitemapPrefs();
		$tmp2 = $eArrayStorage->WriteArray($tmp);
		$sql -> db_Insert("core", "'sitemap_prefs', '".$tmp2."' ");
		$sql -> db_Select("core", "*", "e107_name='sitemap_prefs' ");
	}
	$row = $sql -> db_Fetch();
	$sitemap_pref = $eArrayStorage->ReadArray($row['e107_value']);
	return $sitemap_pref;
}

if(isset($message)){
	$caption = SITEMAP_MENU_TITLE;
	$ns -> tablerender($caption, $message);
}

$freq_list = array
	(
		"always"	=>	SITEMAP_MENU_L32,
		"hourly"	=>	SITEMAP_MENU_L33,
		"daily"		=>	SITEMAP_MENU_L34,
		"weekly"	=>	SITEMAP_MENU_L35,
		"monthly"	=>	SITEMAP_MENU_L36,
		"yearly"	=>	SITEMAP_MENU_L37,
		"never"		=>	SITEMAP_MENU_L38
	);	

$sitemap_pref = get_sitemapPrefs();

switch ($action) 
{
	default:
			
		$text = "<div style='text-align:center'>
		".$rs -> form_open("post", e_SELF, "sitemapform", "", "enctype='multipart/form-data'")."
		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L21."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_active", "1", ($sitemap_pref['sitemap_active'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_active", "0", ($sitemap_pref['sitemap_active'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
				</td>
			</tr>		  
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L44."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_spiders", "1", ($sitemap_pref['sitemap_spiders'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_spiders", "0", ($sitemap_pref['sitemap_spiders'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
				</td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L45."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_text("ITEM_PER_SITEMAP", 6, $sitemap_pref['ITEM_PER_SITEMAP'], 6 , "tbox" ,"readonly" )." By default is 50000
					<div class='warning'>".SITEMAP_MENU_L14."</div>
				</td>
			</tr>			
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L46."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_text("yahooAppId", 50, $sitemap_pref['yahooAppId'], 150 ). "<br />". SITEMAP_MENU_L47 ." 
				</td>
			</tr>				
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L22."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_news", "1", ($sitemap_pref['sitemap_news'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_news", "0", ($sitemap_pref['sitemap_news'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<br />". SITEMAP_MENU_L39 ." 
					".$rs -> form_select_open('sitemap_news_freq')."\n";
						foreach($freq_list as $k=>$fq){
							$sel = ($sitemap_pref['sitemap_news_freq'] == $k)? "selected='selected'" : "";
							//$text .= "<option value='$k' $sel>".$fq."</option>\n";
							$text .= $rs -> form_option($k, $sel, $fq )."\n";
						}
					$text.= $rs -> form_select_close()."
					<br />". SITEMAP_MENU_L40 ." 
					".$rs -> form_select_open('sitemap_news_prio')."\n";
						for ($i=0.1; $i<1.0; $i=$i+0.1) {
							$sel = ($sitemap_pref['sitemap_news_prio'] == number_format($i,1))? "selected='selected'" : "";
							//$text .= "<option value='".number_format($i,1)."' $sel>".number_format($i,1)."</option>\n";
							$text .= $rs -> form_option(number_format($i,1), $sel, number_format($i,1))."\n";
						}
					$text.= $rs -> form_select_close()."						
				</td>
			</tr>  
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L22A."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_newscat", "1", ($sitemap_pref['sitemap_newscat'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_newscat", "0", ($sitemap_pref['sitemap_newscat'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<br />". SITEMAP_MENU_L39 ." 
					".$rs -> form_select_open('sitemap_newscat_freq')."\n";
						foreach($freq_list as $k=>$fq){
							$sel = ($sitemap_pref['sitemap_newscat_freq'] == $k)? "selected='selected'" : "";
							//$text .= "<option value='$k' $sel>".$fq."</option>\n";
							$text .= $rs -> form_option($fq, $sel, $k)."\n";
						}
					$text.= $rs -> form_select_close()."						
					<br />". SITEMAP_MENU_L40 ." 
					".$rs -> form_select_open('sitemap_news_prio')."\n";
						for ($i=0.1; $i<1.0; $i=$i+0.1) {
							$sel = ($sitemap_pref['sitemap_news_prio'] == number_format($i,1))? "selected='selected'" : "";
							//$text .= "<option value='".number_format($i,1)."' $sel>".number_format($i,1)."</option>\n";
							$text .= $rs -> form_option(number_format($i,1), $sel, number_format($i,1))."\n";
						}
					$text.= $rs -> form_select_close()."						
				</td>
			</tr>  
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L23."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_downloads", "1", ($sitemap_pref['sitemap_downloads'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_downloads", "0", ($sitemap_pref['sitemap_downloads'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<br />". SITEMAP_MENU_L39 ." 
					".$rs -> form_select_open('sitemap_downloads_freq')."\n";
						foreach($freq_list as $k=>$fq){
							$sel = ($sitemap_pref['sitemap_downloads_freq'] == $k)? "selected='selected'" : "";
							//$text .= "<option value='$k' $sel>".$fq."</option>\n";
							$text .= $rs -> form_option($fq, $sel, $k)."\n";
						}
					$text.= $rs -> form_select_close()."						
					<br />". SITEMAP_MENU_L40 ." 
					".$rs -> form_select_open('sitemap_downloads_prio')."\n";
						for ($i=0.1; $i<1.0; $i=$i+0.1) {
							$sel = ($sitemap_pref['sitemap_downloads_prio'] == number_format($i,1))? "selected='selected'" : "";
							//$text .= "<option value='".number_format($i,1)."' $sel>".number_format($i,1)."</option>\n";
							$text .= $rs -> form_option(number_format($i,1), $sel, number_format($i,1))."\n";
						}
					$text.= $rs -> form_select_close()."						
				</td>
			</tr>  
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L24."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_downloadscat", "1", ($sitemap_pref['sitemap_downloadscat'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_downloadscat", "0", ($sitemap_pref['sitemap_downloadscat'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<br />". SITEMAP_MENU_L39 ." 
					".$rs -> form_select_open('sitemap_downloadscat_freq')."\n";
						foreach($freq_list as $k=>$fq){
							$sel = ($sitemap_pref['sitemap_downloadscat_freq'] == $k)? "selected='selected'" : "";
							//$text .= "<option value='$k' $sel>".$fq."</option>\n";
							$text .= $rs -> form_option($fq, $sel, $k)."\n";
						}
					$text.= $rs -> form_select_close()."						
					<br />". SITEMAP_MENU_L40 ." 
					".$rs -> form_select_open('sitemap_downloadscat_prio')."\n";
						for ($i=0.1; $i<1.0; $i=$i+0.1) {
							$sel = ($sitemap_pref['sitemap_downloadscat_prio'] == number_format($i,1))? "selected='selected'" : "";
							//$text .= "<option value='".number_format($i,1)."' $sel>".number_format($i,1)."</option>\n";
							$text .= $rs -> form_option(number_format($i,1), $sel, number_format($i,1))."\n";
						}
					$text.= $rs -> form_select_close()."						
				</td>
			</tr>  
		
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L25."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_content", "1", ($sitemap_pref['sitemap_content'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_content", "0", ($sitemap_pref['sitemap_content'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<div class='warning'>".SITEMAP_MENU_L14."</div>
				</td>
			</tr>  
			
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L26."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_contentcat", "1", ($sitemap_pref['sitemap_contentcat'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_contentcat", "0", ($sitemap_pref['sitemap_contentcat'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<div class='warning'>".SITEMAP_MENU_L14."</div>
				</td>
			</tr>  
			
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L27."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_forums", "1", ($sitemap_pref['sitemap_forums'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_forums", "0", ($sitemap_pref['sitemap_forums'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<div class='warning'>".SITEMAP_MENU_L14."</div>
				</td>
			</tr>  
			<tr>
				<td class='forumheader3' style='width:40%'><h4>".SITEMAP_MENU_L28."</h4></td>
				<td class='forumheader3' style='width:60%'>
					".$rs -> form_radio("sitemap_forumspost", "1", ($sitemap_pref['sitemap_forumspost'] ? "1" : "0"), "", "")." ".SITEMAP_MENU_L19." 
					".$rs -> form_radio("sitemap_forumspost", "0", ($sitemap_pref['sitemap_forumspost'] ? "0" : "1"), "", "")." ".SITEMAP_MENU_L20." 
					<div class='warning'>".SITEMAP_MENU_L14."</div>
				</td>
			</tr>  			
			<tr>
		<td  class='forumheader' colspan='2' style='text-align:center'>
		".$rs -> form_button("submit", "update_sitemap_prefs", SITEMAP_MENU_L31)."	
		</td>
		</tr>
		</table>
		".$rs -> form_close()."
		</div>";

		
		$ns -> tablerender(SITEMAP_MENU_TITLE , $text);
	break;
	case 'new':
		if($sitemap_pref['sitemap_active'] == 1)
		{
			if(!is_object($sql)){ $sql = new db; }
			$sitemap = new Sitemap($e107->http_path);   
			$sitemap->setPath($e107->relative_base_path);
			//$sitemap->setFilename('customsitemap');
			$text = "<div class='info'>" .SITEMAP_MENU_L13 .  "<a href='". $e107->http_path ."sitemap-index.xml' > ". $e107->http_path ."sitemap-index.xml </a></div><br />";
			
			// sitemap fro news 
			if ($sitemap_pref['sitemap_news'] == 1)			
				{
					$div_style="success";
					// $result = $sql->db_Select('news', '	news_id,news_title,news_datestamp', 			
					$result = $sql->db_Select('news', '	news_id,news_datestamp', 
														"news_class != ".e_UC_NOBODY."  
														AND (news_start=0 || news_start < ".time().") 
														AND (news_end=0 || news_end>".time().") 
														ORDER BY news_datestamp DESC");					
					
							while($row = $sql->db_Fetch()) {
								//$row[1] = ereg_replace(' ', '-', $row[1]); //added seo
								$sitemap->addItem('news.php?extend.' . $row[0] , $sitemap_pref['sitemap_news_prio'], $sitemap_pref['sitemap_news_freq'], $row[1]);
								// $sitemap->addItem('games/' . $row[1] .'/'. $row[0], $sitemap_pref['sitemap_news_prio'], $sitemap_pref['sitemap_news_freq'], $row[2]);
							}	
					$message = SITEMAP_MENU_L3 . SITEMAP_MENU_L2;
					
				}
			else 
				{
					$div_style="error";
					$message = SITEMAP_MENU_L3 . SITEMAP_MENU_L2A ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";
			
			// sitemap fro news cat
			if ($sitemap_pref['sitemap_newscat'] == 1)			
				{
					$div_style="success";
								
					$result = $sql->db_Select('news_category', 'category_id');
						
							while($row = $sql->db_Fetch()) 
							{
								$sitemap->addItem('news.php?cat.' . $row[0] , $sitemap_pref['sitemap_newscat_prio'], $sitemap_pref['sitemap_newscat_freq']);
							}	
					$message = SITEMAP_MENU_L4 . SITEMAP_MENU_L2;
					
				}
			else 
				{
					$div_style="error";
					$message = SITEMAP_MENU_L4 . SITEMAP_MENU_L2A ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";

			// sitepam fro downloads
			if ($sitemap_pref['sitemap_downloads'] == 1)
				{
					$div_style="success";
					$result = $sql->db_Select('download', '	download_id,download_datestamp', 
															"download_class != ".e_UC_NOBODY."  
															AND download_active > 0 
															ORDER BY download_datestamp DESC");					
					
							while($row = $sql->db_Fetch()) 
							{
								$sitemap->addItem('download.php?view.' . $row[0] , $sitemap_pref['sitemap_downloads_prio'], $sitemap_pref['sitemap_downloads_freq'], $row[1]);
							}	
					
					$message = SITEMAP_MENU_L8 . SITEMAP_MENU_L2 ;
				}		
			else 
				{
					$div_style="error";
					$message = SITEMAP_MENU_L8 . SITEMAP_MENU_L2A ;
				}				
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";	
			
			// sitemap for downloads cat
			if ($sitemap_pref['sitemap_downloadscat'] == 1)			
				{
					$div_style="success";
								
					$result = $sql->db_Select('download_category', 'download_category_id', 
																	"download_category_class != ".e_UC_NOBODY);
							while($row = $sql->db_Fetch()) 
							{
								$sitemap->addItem('download.php?list.' . $row[0] , $sitemap_pref['sitemap_downloadscat_prio'], $sitemap_pref['sitemap_downloadscat_freq']);
							}	
					$message = SITEMAP_MENU_L9 . SITEMAP_MENU_L2;
					
				}
			else 
				{
					$div_style="error";
					$message = SITEMAP_MENU_L9 . SITEMAP_MENU_L2A ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";

			// sitemap for forums
			if ($sitemap_pref['sitemap_forums'] == 1)			
				{
					$div_style="warning";				 			
					$message = SITEMAP_MENU_L5 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
					
				}
			else 
				{
					$div_style="warning";
					$message = SITEMAP_MENU_L5 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";

			// sitemap for forums post
			if ($sitemap_pref['sitemap_forumspost'] == 1)			
				{
					$div_style="warning";				 			
					$message = SITEMAP_MENU_L6 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
					
				}
			else 
				{
					$div_style="warning";
					$message = SITEMAP_MENU_L6 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";
			
			// sitemap for forums post
			if ($sitemap_pref['sitemap_content'] == 1)			
				{
					$div_style="warning";				 			
					$message = SITEMAP_MENU_L10 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
					
				}
			else 
				{
					$div_style="warning";
					$message = SITEMAP_MENU_L10 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";
			
			// sitemap for forums post
			if ($sitemap_pref['sitemap_contentcat'] == 1)			
				{
					$div_style="warning";				 			
					$message = SITEMAP_MENU_L11 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
					
				}
			else 
				{
					$div_style="warning";
					$message = SITEMAP_MENU_L11 . SITEMAP_MENU_L2A . SITEMAP_MENU_L14 ;
				}
			$text .= "<div class='".$div_style."'><h2>".$message."</h2></div><br />";
			
			if ($sitemap_pref['sitemap_spiders'] == 1)
			{
				// submit sitemaps to search engines
				$result = $sitemap->submitSitemap($sitemap_pref['yahooAppId']);

				$ping = "<div class='info'>";
				$ping .= "Yahoo ping: " .$result[0][message]  ."<br />" ;
				$ping .= "Google ping: " .$result[1][message]  ."<br />" ;
				$ping .= "Ask ping: " .$result[2][message]  ."<br />" ;
				$ping .= "Bing ping: " .$result[3][message]  ."<br />" ;
				$ping .= "</div>";
				$text .= $ping ;
			}
			
			$sitemap->createSitemapIndex($e107->http_path, 'Today');	
		}	
		else 
		{
			$message = SITEMAP_MENU_L43 ; 
			$text .= "<div class='error'><h2>".$message."</h2></div><br />";
		}
		$ns -> tablerender(SITEMAP_MENU_TITLE , $text);
	break;
	case 'instructions':
	
	break;			
}
require_once(e_ADMIN."footer.php");

function headerjs() 
{
	global $tp;
	$headerjs = "";
	return $headerjs;
}

?>

