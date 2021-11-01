<?php
/*
+ ----------------------------------------------------------------------------+
|    e107 website system
|
|    ©Steve Dunstan 2001-2002
|    http://e107.org
|    jalist@e107.org
|
|    Released under the terms and conditions of the
|    GNU General Public License (http://gnu.org).
|
|    $Source: /cvsroot/e107/e107_0.7/e107_plugins/pagerestriction/e_module.php,v $
|    $Revision: 1.0 $
|    $Date: 2006/07/23 08:03:58 $
|    $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

$pr = new pagerestriction();
$pr->pr_pagerestriction();

class pagerestriction{

// ##### constructor ----------------------------------------------------------
	function pagerestriction(){

		// ##### use this to divide the full url into seperate vars for each folder and subfolders
		$vars = explode("/", $this->pr_reversestrrchr($_SERVER['PHP_SELF'], '/'));
		for($a=0;$a<count($vars);$a++){
			if($vars[$a] != ""){
				$folders[] = $vars[$a];
			}
		}
		$this->pageroot = $folders[count($folders)-1];
		// ----------------------------------------------------------

		// ##### check data from database ---------------------------
		global $sql, $eArrayStorage;
		$num_rows = $sql -> db_Select("core", "*", "e107_name='pagerestriction' ");
		$row = $sql -> db_Fetch();
		$this->prpref = $eArrayStorage->ReadArray($row['e107_value']);
		// ----------------------------------------------------------

		// ##### prepare preferences --------------------------------
		for($i=0;$i<count($this->prpref['protect']);$i++){
			if($this->prpref['protect'][$i]['type'] == 'plugin'){
				$this->prpref['plugin'][$this->prpref['protect'][$i]['url']] = $this->prpref['protect'][$i]['class'];
			}elseif($this->prpref['protect'][$i]['type'] == 'page'){
				$this->prpref['page'][$this->prpref['protect'][$i]['url']] = $this->prpref['protect'][$i]['class'];
			}
		}
		// ----------------------------------------------------------
	}

// ##### divide full url ------------------------------------------------------
	function pr_reversestrrchr($haystack, $needle){
		$pos = strrpos($haystack, $needle);
		if($pos === false) {
			return $haystack;
		}
		return substr($haystack, 1, $pos);
	}

// ##### check page restriction -----------------------------------------------
	function pr_pagerestriction(){

		// ##### e_PAGE ---------------------------------------------
		$this->pr_check(e_PAGE, 'page');
		// ----------------------------------------------------------

		// ##### e_PAGE + e_QUERY -----------------------------------
		if(e_QUERY){
			$this->pr_check(e_PAGE."?".e_QUERY, 'page');
		}
		// ----------------------------------------------------------

		// ##### e_PAGE + e_QUERY (each parm, split e_QUERY) --------
		if(e_QUERY){
			$qs = explode(".", e_QUERY);
			if(is_numeric($qs[0])){
				$from = array_shift($qs);
			}else{
				$from = "0";
			}
			for($a=0;$a<count($qs);$a++){
				$return = "";
				for($b=0;$b<$a;$b++){
					$return .= $qs[$b].".";
				}
				$return = e_PAGE."?".substr($return,0,-1);
				$this->pr_check($return, 'page');
			}
		}
		// ----------------------------------------------------------

		// ##### plugin path ----------------------------------------
		if(strpos(e_SELF, e_PLUGIN_ABS)!==FALSE){
			$this->pr_check($this->pageroot, 'plugin');
			//echo "debug: plugin path";
		}else{
			//echo "debug: no plugin path";
		}
		// ----------------------------------------------------------

		return;
	}

// ##### check class ----------------------------------------------------------
	function pr_check($path, $mode='page'){
		global $tp;

		$redirect = ($this->prpref['option']['pagerestriction_redirect'] ? $tp->replaceConstants($this->prpref['option']['pagerestriction_redirect']) : SITEURL);

		if($mode=='page'){
			$url = $this->prpref['page'][$path];
		}elseif($mode=='plugin'){
			$url = $this->prpref['plugin'][$path];
		}

		if(isset($url) && $url){
			if( !check_class($url) ){
				header("location:".$redirect);
				//echo "debug: redirect<br />";
			}else{
				//echo "debug: allowed<br />";
			}
		}

		return;
	}


} //end class

?>