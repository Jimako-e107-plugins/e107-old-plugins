<?php
define('FIRST_CPGUSER_CAT', 10000);

if($pref['cpg_cats'] != ""){
	$pref['cpg_cats']=str_replace(" ","",$pref['cpg_cats']);
	$limit=split(",",$pref['cpg_cats']);
	foreach($limit as $x){
		$x=ltrim(rtrim($x));
		if($limit_text){$limit_text.=" OR ";}
		$limit_text.="category='".$x."'";
	}
	if($sql -> db_Select("CPG_albums","*",$limit_text)){
		$pref['cpg_albums']="";
		while($row = $sql -> db_Fetch()){
			$pref['cpg_albums'] .= $row['aid'].",";
		}
	}
	$limit_text = "";
}

if($pref['cpg_albums'] != ""){
	$pref['cpg_albums']=str_replace(" ","",$pref['cpg_albums']);
	$limit=split(",",$pref['cpg_albums']);
	foreach($limit as $x){
		$x=ltrim(rtrim($x));
		if($limit_text){$limit_text.=" OR ";}
		$limit_text.="aid='".$x."'";
	}
	$limit_text=" AND ".$limit_text;
}
$limit_text=" WHERE approved='YES' ".$limit_text;
$qry="SELECT * FROM ".MPREFIX."CPG_pictures ".$limit_text." ORDER BY RAND() limit ".$pref['cpg_numimages'];
$text="";

if($sql -> db_Select_gen($qry)){
	while($id = $sql -> db_Fetch()){
		extract($id);
		$text.="<a href='".e_PLUGIN."coppermine_menu/displayimage.php?pos=-".$pid."'";
		if($pref['cpg_opennew'] == "Yes"){$text.=" target='cpg' ";}
		$text.="><img src='".e_PLUGIN."coppermine_menu/albums/".$filepath."thumb_".$filename."' style='border: 0;margin:2px;' alt='' /></a>";
		if($pref['cpg_horiz'] == "Vertical"){
			$text.="<br /><br />";
		}
	}
}
if($pref['cpg_click_text']){
	$text.='<br />'.$pref['cpg_click_text'];
}

$rand_text=$text;
$text="";
$pref['cpg_showcats'] = str_replace(" ","",$pref['cpg_showcats']);
$pref['cpg_showalbs'] = str_replace(" ","",$pref['cpg_showalbs']);
$sqlx = new db;

if($pref['cpg_showcats'] != ""){
	$limit_text="";
	if(!preg_match("/all/i",$pref['cpg_showcats'])){
		$limit=split(",",$pref['cpg_showcats']);
		foreach($limit as $x){
			$x=ltrim(rtrim($x));
			if($limit_text){$limit_text.=" OR ";}
			$limit_text.="a.category='".$x."'";
		}
	} else {
		$limit_text="1";
	}
	
	if($sql -> db_Select_gen("SELECT 
		a.category as cid, 
		concat(
		  if(pp.cid is not NULL,concat(pp.name,'>'),''),
		  if(p.cid is not NULL, concat(p.name,'>'),''),
		  c.name) as catname 
	FROM ((".MPREFIX."CPG_albums as a
	     left join ".MPREFIX."CPG_categories as c on c.cid=a.category)
	     left join ".MPREFIX."CPG_categories as p on c.parent=p.cid) 
	     left join ".MPREFIX."CPG_categories as pp on p.parent=pp.cid
	WHERE $limit_text AND category < ".FIRST_CPGUSER_CAT."
	GROUP by a.category
	ORDER by catname")){
	   $text .= "<div style='text-align:center'><form name='catjump'>
		<select class='tbox' name='catjumpbox' OnChange='jumpTo(this);'>
		<option value=''>Jump to Category\n
		";
		while($row = $sql -> db_Fetch()){
			$text .= "<option value='".e_PLUGIN."coppermine_menu/index.php?cat=".$row['cid']."'>{$row['catname']}</option>\n";
		}
		$text .= "</select></form></div>";
	}
}

if($pref['cpg_showalbs'] != ""){
	$limit_text="";
	if(!preg_match("/all/i",$pref['cpg_showalbs'])){
		$limit=split(",",$pref['cpg_showalbs']);
		foreach($limit as $x){
			$x=ltrim(rtrim($x));
			if($limit_text){$limit_text.=" OR ";}
			$limit_text.="pic.aid='".$x."'";
		}
	} else {
		$limit_text = "1";
	}
	
	if($sql -> db_Select_gen("SELECT 
		a.aid as aid, 
		concat(a.title,
		  if(c.cid is not NULL,concat(' (',c.name,')'),''),
		  if(u.user_name is not NULL,concat(' (*',u.user_name,')'),''))
		  as mytitle 
	FROM ((".MPREFIX."CPG_pictures as pic
		left join ".MPREFIX."CPG_albums as a on pic.aid=a.aid)
		left join ".MPREFIX."CPG_categories as c on a.category=c.cid) 
		left join ".MPREFIX."user as u 
			on (a.category-".FIRST_CPGUSER_CAT.")=u.user_id 
	WHERE $limit_text
	GROUP by pic.aid
	ORDER by u.user_name,mytitle")){
		$text .= "<div style='text-align:center'><form name='albjump'>
		<select class='tbox' name='albjumpbox' OnChange='jumpTo(this);'>
		<option value=''>Jump to Album\n
		";
		while($row = $sql -> db_Fetch()){
			$text .= "<option value='".e_PLUGIN."coppermine_menu/thumbnails.php?album=".$row['aid']."'>{$row['mytitle']}</option>\n";
		}
		$text .= "</select></form></div>";
	}
}

if($text){
	echo <<< EOT
	<SCRIPT LANGUAGE="JavaScript">
<!-- Start Hiding the Script

function jumpTo(URL_List){
   var URL = URL_List.options[URL_List.selectedIndex].value;
   window.location.href = URL;
}

// Stop Hiding script --->
</SCRIPT>
EOT;
}

if($pref['cpg_title2'] != ""){
	$ns -> tablerender($pref['cpg_title1'], "<div style='text-align:center'>".$rand_text."</div>");
	$ns -> tablerender($pref['cpg_title2'],$text);
} else {
	$ns -> tablerender($pref['cpg_title1'], "<div style='text-align:center'>".$rand_text.$text."</div>");
}
?>