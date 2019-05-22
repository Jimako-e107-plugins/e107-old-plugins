<?php
//$eplug_admin = true;

require_once("../../class2.php");
if(!getperms("P"))
	{ 
		header("location:".e_BASE."index.php"); 
	}
require_once(e_ADMIN."auth.php");

e107_require_once(e_HANDLER.'arraystorage_class.php');
$eArrayStorage = new ArrayData();

require_once(e_HANDLER."form_handler.php");
$rs = new form;

unset($text);
unset($seopack_pref);

include_lan(e_PLUGIN."seopack/languages/".e_LANGUAGE.".php");

	
   // Handle preferences form being submitted
if (e_QUERY) {
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0];
	$subaction = varset($tmp[1],'');
	$finalaction = varset($tmp[2],'');	
	unset($tmp);
}   


if ( isset($_POST['submitrobots']) ) {	
	$message = $seo -> update_robot();
}

if ( isset($_POST['submithtaccess']) ) {
	$message = $seo -> update_htaccess();
}
			
if(isset($_POST['update_seopack_prefs'])){
	$message = $seo -> update_seopackPrefs();
}	

if(isset($_POST['reset_seopack_prefs'])){
	$message = $seo -> getDefault_seopack();
}

if(isset($_POST['deletespider'])){
	$message = $seo -> deleteSpider();
}

if(isset($_POST['deletespiderall'])){
	$message = $seo -> deletespiderall();
}
	
if(isset($_POST['deletekeywords'])){
	$message = $seo -> deletekeywords();
	echo $_POST['keyword_id'] ;
}	


if(isset($message)){
	$caption = SEOPACK_MENU_TITLE;
	$ns -> tablerender($caption, $message);
}

$distribution = array
	(
		"Global",
		"Local"	,
		"IU"		
	);	


$seopack_pref = get_seopackPrefs();

switch ($action) 
{
	default:	
		$text = "
		<div style='text-align:center'>	
			".$rs -> form_open("post", e_SELF, "seopackform", "", "enctype='multipart/form-data'");
			$text .= "
			<div class='fade'>
				<ul class='idTabs'>	  
					<li><a href='#item1'>".SEOPACK_MENU_L1A."</a></li>
					<li><a href='#item2'>".SEOPACK_MENU_L1B."</a></li>
					<li><a href='#item3'>".SEOPACK_MENU_L1C."</a></li>
					<li><a href='#item4'>".SEOPACK_MENU_L1D."</a></li>
					<br /><br /><br />
					<li><a href='#item5'>".SEOPACK_MENU_L25."</a></li>
					<li><a href='#item6'>".SEOPACK_MENU_L34."</a></li>
				</ul>
				<div class='items'>
					<div  id='item1'  style='width:100%'>
						<table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
								<td class='fcaption' colspan=2>".SEOPACK_MENU_L1A."</td>
							</tr>				
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L6."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['seopack_active'] ? $rs->form_checkbox("seopack_active", 1, 1) : $rs->form_checkbox("seopack_active", 1))."
								</td>
							</tr>		  
							
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L9."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['seopack_prevnextnews'] ? $rs->form_checkbox("seopack_prevnextnews", 1, 1) : $rs->form_checkbox("seopack_prevnextnews", 1))."
									<div class='info'>".SEOPACK_MENU_L9A."</div>
								</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L10."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".$rs -> form_select_open('seopack_distribution')."\n";
										foreach($distribution as $k){
											$sel = ($seopack_pref['seopack_distribution'] == $k)? "selected='selected'" : "";
											$text .= $rs -> form_option($k, $sel, $k )."\n";
										}
									$text.= $rs -> form_select_close()."
									<div class='info'>".SEOPACK_MENU_L10A."</div>
								</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L11."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['seopack_generator'] ? $rs->form_checkbox("seopack_generator", 1, 1) : $rs->form_checkbox("seopack_generator", 1))."
									<div class='info'>".SEOPACK_MENU_L11A."</div>
								</td>
							</tr>			
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L12."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".$rs -> form_text("seopack_author", 60, $seopack_pref['seopack_author'], 60  )." 
									<div class='info'>".SEOPACK_MENU_L12A."</div>
									<div class='warning'>".SEOPACK_MENU_L12B."</div>
								</td>
							</tr>					
						</table>	
					</div>
					<div id='item2'  style='width:100%' >
						<table style='".ADMIN_WIDTH."' class='fborder'>			
							<tr>
								<td class='fcaption' colspan=2>".SEOPACK_MENU_L1B."</td>
							</tr>			
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L13."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".$rs -> form_text("googleverify", 60, $seopack_pref['googleverify'], 60  )." 
									<div class='info'>".SEOPACK_MENU_L13A."</div>
								</td>
							</tr>			
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L14."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".$rs -> form_text("msverify", 60, $seopack_pref['msverify'], 60  )." 
									<div class='info'>".SEOPACK_MENU_L14A."</div>
								</td>
							</tr>			
						</table>	
					</div>
					<div id='item3' style='width:100%' >
						<table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
								<td class='fcaption' colspan=2>".SEOPACK_MENU_L1C."</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L15."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['noodp'] ? $rs->form_checkbox("noodp", 1, 1) : $rs->form_checkbox("noodp", 1))."
									<div class='info'>".SEOPACK_MENU_L15A."</div>
								</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L16."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['noydir'] ? $rs->form_checkbox("noydir", 1, 1) : $rs->form_checkbox("noydir", 1))."
									<div class='info'>".SEOPACK_MENU_L16A. "</div>
								</td>
							</tr>				
						</table>
					</div>
					<div id='item4'  style='width:100%' >
						<table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
								<td class='fcaption' colspan=2>".SEOPACK_MENU_L1D."</td>
							</tr>			
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L21."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['indexfollow'] ? $rs->form_checkbox("indexfollow", 1, 1) : $rs->form_checkbox("seopack_active", 1))."
									<div class='info'>".SEOPACK_MENU_L21A. "</div>
								</td>
							</tr>				
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L17."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['search'] ? $rs->form_checkbox("search", 1, 1) : $rs->form_checkbox("search", 1))."
									<div class='info'>".SEOPACK_MENU_L17A."</div>
								</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L18."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['logininput'] ? $rs->form_checkbox("logininput", 1, 1) : $rs->form_checkbox("logininput", 1))."
									<div class='info'>".SEOPACK_MENU_L18A. "</div>
								</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L19."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['admin'] ? $rs->form_checkbox("admin", 1, 1) : $rs->form_checkbox("admin", 1))."
									<div class='info'>".SEOPACK_MENU_L19A. "</div>
								</td>
							</tr>	
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L20."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['noarchive'] ? $rs->form_checkbox("noarchive", 1, 1) : $rs->form_checkbox("noarchive", 1))."
									<div class='info'>".SEOPACK_MENU_L20A. "</div>
								</td>
							</tr>
						</table>			
					</div>
					<div id='item5'  style='width:100%' >
						<table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
								<td class='fcaption' colspan=2>".SEOPACK_MENU_L22."</td>
							</tr>				
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L22A."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['spideractive'] ? $rs->form_checkbox("spideractive", 1, 1) : $rs->form_checkbox("spideractive", 1))."
									<div class='info'>".SEOPACK_MENU_L22A. "</div>
								</td>
							</tr>				
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L31."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".$rs -> form_textarea("spiderlist", 70, 10, $seopack_pref['spiderlist'] ,"overflow:hidden")."
									<div class='info'>".SEOPACK_MENU_L31A. "</div>
								</td>
							</tr>				
						</table>
					</div>
					<div id='item6'  style='width:100%' >
						<table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
								<td class='fcaption' colspan=2>".SEOPACK_MENU_L34."</td>
							</tr>				
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L40."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['keywordsactive'] ? $rs->form_checkbox("keywordsactive", 1, 1) : $rs->form_checkbox("keywordsactive", 1))."
									<div class='info'>".SEOPACK_MENU_L40. "</div>
								</td>
							</tr>				
							<tr>
								<td class='forumheader3' style='width:40%'><h4>".SEOPACK_MENU_L41."</h4></td>
								<td class='forumheader3' style='width:60%'>
									".($seopack_pref['keywordsnews'] ? $rs->form_checkbox("keywordsnews", 1, 1) : $rs->form_checkbox("keywordsnews", 1))."
									<div class='info'>".SEOPACK_MENU_L41A. "</div>
								</td>
							</tr>				
						</table>
					</div>					
					<table style='".ADMIN_WIDTH."' class='fborder'>
						<tr>
							<td  class='forumheader' colspan='2' style='text-align:center'>
							".$rs -> form_button("submit", "update_seopack_prefs", SEOPACK_MENU_L7)."	
							".$rs -> form_button("reset", "reset_seopack_prefs", SEOPACK_MENU_L7D)."				
							".$rs -> form_button("submit", "reset_seopack_prefs", SEOPACK_MENU_L7C)."	
							</td>
						</tr>
					</table>
				</div>		
			</div>			
			".$rs -> form_close()."	
		</div>
		";
		$ns -> tablerender(SEOPACK_MENU_TITLE , $text);
	break;
	case 'robot':
		$text = "<div style='text-align:center'>";
		
		if (file_exists(e_BASE ."/robots.txt")) 
		{
			$robots_file = e_BASE  ."/robots.txt";
			$f = fopen($robots_file, 'r');
			$content = fread($f, filesize($robots_file));
			$robotstxtcontent = htmlspecialchars($content);
			if (!is_writable($robots_file)) {
				$text .= "
				<table style='".ADMIN_WIDTH."' class='fborder'>
					<tr>
						<td  class='forumheader1' colspan='2' style='text-align:center'>
							<div class='warning'><p><em>".SEOPACK_MENU_L50."</em></p></div>
							".$rs->form_textarea("robotstxtcontent", 100, 15, $robotstxtcontent ,"overflow:hidden",'','',$form_readonly = 1)."
						</td>
					</tr>
				</table>";
			} else {
				$text .= $rs -> form_open("post", e_SELF."?robot", "submitrobots", "", "enctype='multipart/form-data'") ;
				$text .= "
				<table style='".ADMIN_WIDTH."' class='fborder'>
					<tr>				
						<td  class='forumheader1' colspan='2' style='text-align:center'>
							<div class='info'><p>".SEOPACK_MENU_L52."</p></div>
							".$rs->form_textarea("robotstxtcontent", 100, 15, $robotstxtcontent ,"overflow:hidden")."
						</td>
					</tr>
					<tr>
						<td  class='forumheader' colspan='2' style='text-align:center'>
							".$rs -> form_button("submit", "submitrobots", SEOPACK_MENU_L7A)."	
						</td>
					</tr>
				</table>
				".$rs -> form_close();				
			}

		}		
		
		if (file_exists(e_BASE ."/.htaccess")) {
			$htaccess_file = e_BASE ."/.htaccess";
			$f = fopen($htaccess_file, 'r');
			$contentht = fread($f, filesize($htaccess_file));
			$htaccessnew = htmlspecialchars($contentht);

			if (!is_writable($htaccess_file)) {			
				$text .= "
				<table style='".ADMIN_WIDTH."' class='fborder'>
					<tr>
						<td  class='forumheader1' colspan='2' style='text-align:center'>
							<div class='warning'><p><em>".SEOPACK_MENU_L51. "</em></p></div>
							".$rs->form_textarea("htaccessnew", 100, 15, $htaccessnew ,"overflow:hidden",'','',$form_readonly = 1)."
						</td>
					</tr>
				</table>";			
			} else {			
				$text .= $rs -> form_open("post", e_SELF."?robot", "submithtaccess", "", "enctype='multipart/form-data'") ;
				$text .= "
				<table style='".ADMIN_WIDTH."' class='fborder'>
					<tr>				
						<td  class='forumheader1' colspan='2' style='text-align:center'>
							<div class='info'><p>".SEOPACK_MENU_L53."</p></div>
							".$rs->form_textarea("htaccessnew", 100, 15, $htaccessnew ,"overflow:hidden")."
						</td>
					</tr>
					<tr>
						<td  class='forumheader' colspan='2' style='text-align:center'>
							".$rs -> form_button("submit", "submithtaccess", SEOPACK_MENU_L7B)."	
						</td>
					</tr>
				</table>
				".$rs -> form_close();		
			}

		}			
		$text .= "
		</div>";			
		$ns -> tablerender(SEOPACK_MENU_TITLE , $text);
	break;
	case 'spider':	
		$text = "<div class='spider'>";
		
		//Default settings.
		$numperpage  = 50;
		$numstart = $subaction;
		$totalspiders = $sql -> db_count("seo_spiderlog");
		if ($numstart == "") 
		{
			$numstart = 0;
		}
		
		$nextnum = $numstart + $numperpage;
		
		if ($numstart >= $numperpage) {		
			$prevnum = $numstart - $numperpage;
			$text .= "<a href='".e_SELF."?spider.".$prevnum ."'>[ ".SEOPACK_MENU_L23.$numperpage."]</a> ";
		}
		
		if ($nextnum <= $totalspiders) 		
			$text .= "<a href='".e_SELF."?spider.".$nextnum ."'>[ ".SEOPACK_MENU_L24.$numperpage."]</a></div>	";	
				
		
		$text .= "</div>";
		$text .= $rs -> form_open("post", e_SELF."?spider", "deletespider", "", "enctype='multipart/form-data'") ."

		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td class='theader' colspan=5>".SEOPACK_MENU_L25."</td>
			</tr>		
			<tr >
				<td class='forumheader' style='width:3%' ><input type='checkbox' name='checkall' onclick='checkUncheckAll(this);'/></td>
				<td class='forumheader' style='width:15%' >".SEOPACK_MENU_L27."</td>
				<td class='forumheader' style='width:17%' >".SEOPACK_MENU_L26."</td>
				<td class='forumheader' style='width:50%' >".SEOPACK_MENU_L29."</td>
				<td class='forumheader' style='width:10%' >".SEOPACK_MENU_L30."</td>
			</tr>";
		$sql -> db_Select("seo_spiderlog",  "*", "spider_id>=0 ORDER BY spider_date DESC LIMIT $numstart,$numperpage");

		while ($row = $sql-> db_Fetch()) 
		{
			extract($row);
			$text .= "
			<tr class='spiderrow' >
				<td >".$rs->form_checkbox("spider_id[]", $spider_id)."</td>
				<td >".$spider_agent."</td>
				<td >".strftime("%d/%m/%Y - %H:%M", $spider_date)."</td>
				<td >".$spider_url."</td>
				<td >".$spider_ip."</td>
			</tr>
			
			";
		}

		$text .= "
			<tr>
				<td  class='forumheader' colspan='5' style='text-align:center'>
					".$rs -> form_button("submit", "deletespider", SEOPACK_MENU_L32)."	
					".$rs -> form_button("submit", "deletespiderall", SEOPACK_MENU_L33)."	
				</td>
			</tr>
		</table><br />
		".$rs -> form_close."
		<div class='spider' >";

		if ($numstart >= $numperpage) 
		{
			$prevnum = $numstart - $numperpage;
			$text .= "<a href='".e_SELF."?spider.".$prevnum."'>".SEOPACK_MENU_L23 . $numperpage."</a> ";
		}

		if ($nextnum <= $totalspiders) 		
			$text .= "<a href='".e_SELF."?spider.".$nextnum ."'>[ ".SEOPACK_MENU_L24.$numperpage."]</a></div>	";	
		$text .= "</div>";	
		$ns -> tablerender(SEOPACK_MENU_L22 , $text);
	break;	
	case 'sef':
		$text ='The option of SEF rewrite May be will in the next release !!! ';
		$ns -> tablerender(SEOPACK_MENU_L3 , $text);
	break;		
	case 'keywords':
		$text = "<div class='spider'>";
		
		//Default settings.
		$numperpage  = 50;
		$numstart = $subaction;
		$totalspiders = $sql -> db_count("seo_keywords");
		if ($numstart == "") 
		{
			$numstart = 0;
		}
		
		$nextnum = $numstart + $numperpage;
		
		if ($numstart >= $numperpage) {		
			$prevnum = $numstart - $numperpage;
			$text .= "<a href='".e_SELF."?keywords.".$prevnum ."'>[ ".SEOPACK_MENU_L23.$numperpage."]</a> ";
		}
		
		if ($nextnum <= $totalspiders) 		
			$text .= "<a href='".e_SELF."?keywords.".$nextnum ."'>[ ".SEOPACK_MENU_L24.$numperpage."]</a></div>	";	
				
		
		$text .= "</div>";
		$text .= $rs -> form_open("post", e_SELF."?keywords", "deletekeywords", "", "enctype='multipart/form-data'") ."

		<table style='".ADMIN_WIDTH."' class='fborder'>
			<tr>
				<td class='theader' colspan='6'>".SEOPACK_MENU_L34."</td>
			</tr>		
			<tr >
				<td class='forumheader' style='width:3%' ><input type='checkbox' name='checkall' onclick='checkUncheckAll(this);'/></td>
				<td class='forumheader' style='width:20%' >".SEOPACK_MENU_L36."</td>
				<td class='forumheader' style='width:7%' >".SEOPACK_MENU_L37."</td>
				<td class='forumheader' style='width:35%' >".SEOPACK_MENU_L35."</td>
				<td class='forumheader' style='width:15%' >".SEOPACK_MENU_L38."</td>				
				<td class='forumheader' style='width:20%' >".SEOPACK_MENU_L26."</td>				
			</tr>";
		$sql -> db_Select("seo_keywords",  "*", "keyword_id>=0 ORDER BY keyword_date DESC LIMIT $numstart,$numperpage");

		while ($row = $sql-> db_Fetch()) 
		{
			extract($row);
			$text .= "
			<tr class='spiderrow' >
				<td >".$rs->form_checkbox("keyword_id[]", $keyword_id)."</td>
				<td >".$keyword_type."</td>
				<td >".$keyword_page."</td>
				<td >".$keyword_keywords."</td>
				<td >".$keyword_engine."</td>					
				<td >".strftime("%d/%m/%Y - %H:%M", $keyword_date)."</td>
			</tr>
			
			";
		}

		$text .= "
			<tr>
				<td  class='forumheader' colspan='6' style='text-align:center'>
					".$rs -> form_button("submit", "deletekeywords", SEOPACK_MENU_L32)."	
				</td>
			</tr>
		</table><br />
		".$rs -> form_close."
		<div class='spider' >";

		if ($numstart >= $numperpage) 
		{
			$prevnum = $numstart - $numperpage;
			$text .= "<a href='".e_SELF."?keywords.".$prevnum."'>".SEOPACK_MENU_L23 . $numperpage."</a> ";
		}

		if ($nextnum <= $totalspiders) 		
			$text .= "<a href='".e_SELF."?keywords.".$nextnum ."'>[ ".SEOPACK_MENU_L24.$numperpage."]</a></div>	";	
		$text .= "</div>";	
		$ns -> tablerender(SEOPACK_MENU_L34 , $text);
	break;		
	case 'help':
   // Our informative text
	$text ="
 	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" .SEOPACK_MENU_L4 . "</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . SEOPACK_MENU_L56 . "</td>
			<td class='forumheader'>
			v.2.2 :<br />
			- Added incoming Search Keywords .<br />
			- Changed Database struture .<br />		
			v.2.1 :<br />
			- Fixed htacess and robot.txt update.<br />
			- Fixed Display settings Tabs in Firefox .<br />
			- Fixed e_META and PHP 5.2.17 Bug.<br />
			- Fixed Url decode in spider log .<br />
			- Moved funtion to Class (seo.class.php ).<br />
			- Fixed CSS display error in some browseres . <br />
			v.2 :<br />
			- Added Spiders Options <br />
			- Public release to e107 community.<br />
			v.1.2 :<br />			
			- Fixed Some bugs.<br />				
			- Full Release to More clients.<br />			
			v.1 :<br />			
			- Beta Release to some clients.<br />
			v.0.6 :<br />			
			- Edit ability to change contents of .htaccess from settings.<br />				
			v.0.5 :<br />			
			- Edit ability to change contents of robot.txt from settings.<br />		
			v.0.4 :<br />
			- Added diretories option to the meta robots.<br />			
			v.0.3 :<br />
			- Added new Metas to the settings .<br />			
			v.0.2 :<br />
			- added Settings to Meta Robots .<br />
			v.0.1 :<br />
			- Tested in personal website .<br />
			- Basic code and functions .<br />			
			TODO :<br /> 
			- SEF URL , friendly searh engine optimisation .<br />
			- Add Meta Robots to <a href='http://e107.org/e107_plugins/psilo/list.php?mode=plugin&cat=0&id=1194' >xml sitemap Generator</a>.<br />
			- Add XML-RPC ping.<br /> 
			- Add PubSubHubbub ping (get indexed).<br /> 			
			- .<br /> 			
			</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . SEOPACK_MENU_L54 . "</td>
			<td class='forumheader'>".SEOPACK_MENU_L55."</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='2'>Created & supported by <a href='http://naja7host.com' title='Quality Hosting' >Naja7host.com</a> , Quality Hosting and Secure e107 servers.</td>
		</tr>
	</table>";
	$ns->tablerender(SEOPACK_MENU_L4 , $text);	
	break;			
}
require_once(e_ADMIN."footer.php");

?>

