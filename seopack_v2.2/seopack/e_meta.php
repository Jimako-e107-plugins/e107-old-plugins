<?php
if (!defined('e107_INIT')) { exit; }
	
// global $seopack_pref  ;
	include(e_PLUGIN. "seopack/seo.class.php");
	$seo = new naja7host_seo ;

	$seoheader ='';
	
	if (defined('ADMIN_PAGE') && e_PLUGIN_ABS."seopack/admin_conf.php")
		$seoheader .= $seo->showcssadmin();

if ($seopack_pref['seopack_active']) {
	include_lan(e_PLUGIN."seopack/languages/".e_LANGUAGE.".php");

	if (defined('ADMIN_PAGE') && e_SELF == SITEURLBASE.e_ADMIN_ABS."admin.php") {
		if (file_exists(THEME.'admin_template.php')) {
			require_once(THEME.'admin_template.php');
		} else {
			require_once(e_BASE.$THEMES_DIRECTORY.'templates/admin_template.php');
		}

		$SEOPACKINFO = "<div class='info'>".SEOPACK_MENU_ADMININFO. $pref['plug_installed']['seopack'] . SEOPACK_MENU_ADMININFO1 ." </div>" ;
		$search		= $ADMIN_HEADER ;
		$replace	= $ADMIN_HEADER . $SEOPACKINFO;
		$ADMIN_HEADER = str_replace($search, $replace, $ADMIN_HEADER)	;
	}
	
	if($seopack_pref['keywordsactive']) {		
		$seo -> get_search_keywords();
	}
	
	if ($seopack_pref['spideractive']) {	
		$seo -> spiderlog();
	}
	
	if($seopack_pref['keywordsnews']) {
		$seo ->showkeywords();
	}	
	
	$seoheader .= $seo -> jscss();
	$seoheader .= $seo -> meta();
	$seoheader .= $seo -> nextprev();	

	// $keywords = $seo -> get_search_keywords('http://www.bing.com/search?q=%D8%A7%D9%84%D9%86%D8%AC%D8%A7%D8%AD+%D9%87%D9%88%D8%B3%D8%B3%D8%AA&qs=n&form=QBREArray');
	// if ($keywords)
		// echo " You have searched for " . $keywords;
}	

echo "<!-- Meta tags added by Universal Seo Pack: http:/www.naja7host.com / -->\n";
echo $seoheader ;


?>