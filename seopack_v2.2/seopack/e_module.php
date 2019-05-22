<?php
//$_SESSION['e_language'] = "Arabic";
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
function getDefault_seopackPrefs(){
            $seopack_pref['seopack_active'] = '1' ;
            $seopack_pref['seopack_prevnextnews'] = '1' ;   
			$seopack_pref['seopack_distribution'] = 'Global' ;
			$seopack_pref['seopack_generator'] = '0' ;
			$seopack_pref['seopack_author'] = '' ;
			$seopack_pref['googleverify'] = '' ;
			$seopack_pref['msverify'] = '' ;
			$seopack_pref['noodp'] = '' ;
			$seopack_pref['noydir'] = '';
			$seopack_pref['indexfollow'] = '1';
			$seopack_pref['search'] = '';
			$seopack_pref['logininput'] = '';			
			$seopack_pref['admin'] = '';			
			$seopack_pref['noarchive'] = '';			
			$seopack_pref['spideractive'] = '1';			
			$seopack_pref['spiderlist'] = 'bingbot,msnbot,msnbot-media,googlebot,Googlebot-Mobile,Googlebot-Image,Mediapartners-Google,Google-Sitemaps,Slurp,Yahoo! Slurp,AMZNKAssocBot,BoardReader,del.icio.us-thumbnails,Robozilla,UltraSeek,InfoSeek sidewinder,Factbot,ia_archiver,FAST-WebCrawler,magpie-crawler,ArchitextSpider,Scooter,Lycos_Spider,Gigabot,Mercator,Atomz,AskJeeves,Teoma,crawler@fast,BecomeBot,PSbot,Snoopy,Voila,Yandex,WebCrawler';		
			$seopack_pref['keywordsactive'] = '1';
			$seopack_pref['keywordsnews'] = '';
		return $seopack_pref;
}

function get_seopackPrefs(){
	global $sql, $eArrayStorage;

	if(!is_object($sql)){ $sql = new db; }
	$num_rows = $sql -> db_Select("core", "*", "e107_name='seopack_prefs' ");
	if($num_rows == 0){
		$tmp = getDefault_seopackPrefs();
		$tmp2 = $eArrayStorage->WriteArray($tmp);
		$sql -> db_Insert("core", "'seopack_prefs', '".$tmp2."' ");
		$sql -> db_Select("core", "*", "e107_name='seopack_prefs' ");
	}
	$row = $sql -> db_Fetch();
	$seopack_pref = $eArrayStorage->ReadArray($row['e107_value']);
	return $seopack_pref;
}

$seopack_pref = get_seopackPrefs();

// echo $seo_shortcodes;

?>