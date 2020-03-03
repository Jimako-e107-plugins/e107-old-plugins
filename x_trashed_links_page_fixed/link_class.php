<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/links_page/link_class.php $
|     $Revision: 12570 $
|     $Id: link_class.php 12570 2012-01-21 16:42:48Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }


define('URL_SEPARATOR','X');		// Used in names of 'inc' and 'dec' fields

e107::lan('links_page',false, true);

class linkclass 
{

	/**
	 * Private variable to store plugin configurations.
	 *
	 * @var array
	 */
	private $plugPrefs = array();
	private $link_shortcodes = array();
	private $link_template = array();   
	/**
	 * Constructor.
	 */
	function __construct()
	{
		$this->plugPrefs = e107::getPlugConfig('links_page')->getPref();
		$this->link_shortcodes = e107::getScBatch('links_page',true); 
    $this->link_template = e107::getTemplate('links_page', 'links_page'); 
	}
  
   
	function ShowNextPrev($from='0', $number, $total)
	{
		global  $qs,  $LINK_NEXTPREV ;
    $tp   = e107::getParser();  
 
		if($total<=$number)
		{
			return;
		}
		if( $this->plugPrefs["link_nextprev"])
		{ 
		  $base = e107::url('links_page', 'index');
      $np_querystring = $base."/[FROM]".(isset($qs[0]) ? ".".$qs[0] : "").(isset($qs[1]) ? ".".$qs[1] : "").(isset($qs[2]) ? ".".$qs[2] : "").(isset($qs[3]) ? ".".$qs[3] : "").(isset($qs[4]) ? ".".$qs[4] : ""); 
      //$np_querystring = e_REQUEST_SELF.(isset($qs[1]) ? $qs[1] : "");
      $parms = $total.",".$number.",".$from.",".$np_querystring."";
			$LINK_NEXTPREV = $tp->parseTemplate("{NEXTPREV={$parms}}"); 
      $LINK_NP_TABLE = $this->link_template['LINK_NP_TABLE'];           
			return $tp -> parseTemplate($LINK_NP_TABLE, FALSE, $this->link_shortcodes);
		}
	}


  function setPageTitle()
	{
        global $qs;
        $db = e107::getDb();
        //show all categories
        if(!isset($qs[0]) && $this->plugPrefs['link_page_categories']){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_2;
        }
        //show all categories
        if(isset($qs[0]) && $qs[0] == "cat" && !isset($qs[1]) ){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_2;
        }
        //show all links in all categories
        if( (!isset($qs[0]) && !$this->plugPrefs['link_page_categories']) || (isset($qs[0]) && $qs[0] == "all") ){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_3;
        }
        //show all links in one categories
        if(isset($qs[0]) && $qs[0] == "cat" && isset($qs[1]) && is_numeric($qs[1])){
            $db -> select("links_page_cat", "link_category_name", "link_category_id='".$qs[1]."' ");
            $row2 = $db -> fetch();
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_4." / ".$row2['link_category_name'];
        }
        //view top rated
        if(isset($qs[0]) && $qs[0] == "rated"){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_5;
        }
        //view top refer
        if(isset($qs[0]) && $qs[0] == "top"){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_6;
        }
        //personal link managers
        if (isset($qs[0]) && $qs[0] == "manage"){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_7;
        }
        //comments on links
        if (isset($qs[0]) && $qs[0] == "comment" && isset($qs[1]) && is_numeric($qs[1]) ){
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_8;
        }
        //submit link
        if (isset($qs[0]) && $qs[0] == "submit" && check_class($this->plugPrefs['link_submit_class'])) {
            $page = LCLAN_PAGETITLE_1." / ".LCLAN_PAGETITLE_9;
        }
        //define("e_PAGETITLE", strtolower($page));
        define("e_PAGETITLE", $page);
    }




  function parse_link_append($rowl)
	{
        global $tp;
        if($this->plugPrefs['link_open_all'] && $this->plugPrefs['link_open_all'] == "5"){
            $link_open_type = $rowl['link_open'];
        }else{
            $link_open_type = $this->plugPrefs['link_open_all'];
        }

        switch ($link_open_type) {
            case 1:
            $lappend = "<a class='linkspage_url' href='".$rowl['link_url']."' onclick=\"open_window('".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."','full');return false;\" >"; // Googlebot won't see it any other way.
            break;
            case 2:
            $lappend = "<a class='linkspage_url' href='".$rowl['link_url']."' onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."';return false\" >";  // Googlebot won't see it any other way.
            break;
            case 3:
            $lappend = "<a class='linkspage_url' href='".$rowl['link_url']."' onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."';return false\" >";  // Googlebot won't see it any other way.
            break;
            case 4:
            $lappend = "<a class='linkspage_url' href='".$rowl['link_url']."' onclick=\"open_window('".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."');return false\">"; // Googlebot won't see it any other way.
            break;
            default:
            $lappend = "<a class='linkspage_url' href='".$rowl['link_url']."' onclick=\"location.href='".e_PLUGIN_ABS."links_page/links.php?view.".$rowl['link_id']."';return false\" >";  // Googlebot won't see it any other way.
        }
        return $lappend;
    }


  function showLinkSort($mode='')
	{
        global $rs, $qs;
        $frm = e107::getForm(); 
        $db  = e107::getDb();

        if($mode == "cat") {
          $baseurl = e107::url('links_page', 'base'); 
        }
        else {
          $baseurl = e107::url('links_page', 'base');
        }
 
        $check = "";
        if($qs){
            for($i=0;$i<count($qs);$i++){
                if($qs[$i] && substr($qs[$i],0,5) == "order"){
                    $check = $qs[$i];
                    break;
                }
            }
        }
        if($check){
            //string is like : order + a + heading
            $checks = substr($check,6);
            $checko = substr($check,5,1);
        }else{
            $checks = "";
            $checko = "";
        }  
        
        $qry = '';
         $qry = (isset($qs[0]) && substr($qs[0],0,5) != "order" ? '/'.$qs[0] : "")
         .(isset($qs[1]) && substr($qs[1],0,5) != "order" ? ".".$qs[1] : "")
         .(isset($qs[2]) && substr($qs[2],0,5) != "order" ? ".".$qs[2] : "")
         .(isset($qs[3]) && substr($qs[3],0,5) != "order" ? ".".$qs[3] : "");
   
         $path = $baseurl.$qry;     
         $order_options_cat = array(
            "heading"        => LAN_LINKS_4,
            "id" => LAN_LINKS_44,
            "order" => LAN_LINKS_6
         );
         $order_options_link = array(
            "heading"  => LAN_LINKS_4,
            "url"      => LAN_LINKS_5,
            "order"    => LAN_LINKS_6,            
            "refer"    => LAN_LINKS_7,
            "date"     => LAN_LINKS_38
         );        
         
         $sort_options = array(
            $path."ordera"    => LAN_LINKS_8,
            $path."orderd"   => LAN_LINKS_9
         );
         
          
        $sotext  = "<div class='panel panel-default panel-body'>";
        $sotext .= $frm->open('linkorder','post',e_REQUEST_URI, 'class=form-inline'); 
        $sotext .= "<div class='form-group col-md-6'> <label for='link_sorter' class='control-label'>".LAN_LINKS_15."</label>";
        if($mode == "cat"){
            $sotext .= $frm->select('link_sorter', $order_options_cat, $checks);               
        }else{
            $sotext .= $frm->select('link_sorter',  $order_options_link, $checks); 
        }
        $sotext .= "</div><div class='form-group'> <label for='link_order' class='control-label '>".LAN_LINKS_6."</label>"; 
        $sotext .= $frm->select('link_order', $sort_options, $checko); 
                                                                                 
             
        $sotext .= $rs -> form_button("button", "submit", LCLAN_ITEM_36, 
        " onclick=\"document.location.href=link_order.options[link_order.selectedIndex].value+link_sorter.options[link_sorter.selectedIndex].value;\"", "", "");                    
        $sotext .="</div> ";         
        $sotext .=$frm -> close()."</div>";
           
        return $sotext;
    }


  function parseOrderCat($orderstring)
	{
        if(substr($orderstring,6) == "heading"){
            $orderby        = "link_category_name";
            $orderby2       = "";
        }elseif(substr($orderstring,6) == "id"){
            $orderby        = "link_category_id";
            $orderby2       = ", link_category_name ASC";
        }elseif(substr($orderstring,6) == "order"){
            $orderby        = "link_category_order";
            $orderby2       = ", link_category_name ASC";
        }else{
            $orderstring    = "orderdheading";
            $orderby        = "link_category_name";
            $orderby2       = ", link_category_name ASC";
        }
        return $orderby." ".(substr($orderstring,5,1) == "a" ? "ASC" : "DESC")." ".$orderby2;
  }

	function parseOrderLink($orderstring)
	{
        if(substr($orderstring,6) == "heading"){
            $orderby        = "link_name";
            $orderby2       = "";
        }elseif(substr($orderstring,6) == "url"){
            $orderby        = "link_url";
            $orderby2       = ", link_name ASC";
        }elseif(substr($orderstring,6) == "refer"){
            $orderby        = "link_refer";
            $orderby2       = ", link_name ASC";
        }elseif(substr($orderstring,6) == "date"){
            $orderby        = "link_datestamp";
            $orderby2       = ", link_name ASC";
        }elseif(substr($orderstring,6) == "order"){
            $orderby        = "link_order";
            $orderby2       = ", link_name ASC";
        }else{
            $orderstring    = "orderaorder";
            $orderby        = "link_order";
            $orderby2       = ", link_name ASC";
        }
 
        return $orderby." ".(substr($orderstring,5,1) == "a" ? "ASC" : "DESC")." ".$orderby2;
    }

	function getOrder($mode='')
	{
        global $qs;
 
        if(isset($qs[0]) && substr($qs[0],0,5) == "order"){
            $orderstring    = $qs[0];
        }elseif(isset($qs[1]) && substr($qs[1],0,5) == "order"){
            $orderstring    = $qs[1];
        }elseif(isset($qs[2]) && substr($qs[2],0,5) == "order"){
            $orderstring    = $qs[2];
        }elseif(isset($qs[3]) && substr($qs[3],0,5) == "order"){
            $orderstring    = $qs[3];
        }else{
            if($mode == "cat"){
                $orderstring    = "order".($this->plugPrefs["link_cat_order"] == "ASC" ? "a" : "d" ).($this->plugPrefs["link_cat_sort"] ? $this->plugPrefs["link_cat_sort"] : "date" );
            }else{
                $orderstringcat = "order".($this->plugPrefs["link_cat_order"] == "ASC" ? "a" : "d" ).($this->plugPrefs["link_cat_sort"] ? $$this->plugPrefs["link_cat_sort"] : "date" );

                $orderstring    = "order".($this->plugPrefs["link_order"] == "ASC" ? "a" : "d" ).($this->plugPrefs["link_sort"] ? $this->plugPrefs["link_sort"] : "date" );
            }
        }
 
        if($mode == "cat"){
            $str = $this -> parseOrderCat($orderstring);
        }else{
            if(isset($orderstringcat)){
                $str = $this -> parseOrderCat($orderstringcat);
                $str .= ", ".$this -> parseOrderLink($orderstring);
            }else{
                $str = $this -> parseOrderLink($orderstring);
            }
        }
        
        $order = " ORDER BY ".$str; 
        return $order;
    }
 
 

	function verify_link_manage($id)
	{

    $db = e107::getDb();
		if ($db->select("links_page", "link_author", "link_id='".intval($id)."' "))
		{
			$row = $db->fetch();
		}

		if(varset($row['link_author']) != USERID)
		{
			//jsx_location(SITEURL);
			$url = SITEURL; 
			e107::getRedirect()->go($url);
		}
	}

	// Create a new link. If $mode == 'submit', link has to go through the approval process; else its admin entry
  function dbLinkCreate($mode='') 
	{
    global $tp, $qs,  $e107cache, $e_event;
     
    $db = e107::getDb('links_page');
    $mes = e107::getMessage();

    $link_name          = $tp->toDB($_POST['link_name']);
    $link_url           = $tp->toDB($_POST['link_url']);
    $link_description   = $tp->toDB($_POST['link_description']);
    $link_button        = $tp->toDB($_POST['link_button']);

		if (!$link_name || !$link_url || !$link_description) 
		{
		  message_handler("ALERT", 5);
		  return;
		} 

    if ($link_url && !strstr($link_url, "http")) 
		{
          $link_url = "http://".$link_url;
    }
 
    //create link, submit area , not allowed direct post
		if(isset($mode) && $mode == "submit")
		{
		  $username           = (defined('USERNAME')) ? USERNAME : LAN_LINKS_3;
      $insert = array(
					'link_id'          => NULL,
					'link_name'        => $link_name,
					'link_url'         => $link_url,
					'link_description' => $link_description,
					'link_button'      => $link_button ,
					'link_category'    => intval($_POST['cat_id']),
					'link_order'       => $link_t+1,
					'link_refer'       => 0,
					'link_open'        => intval($_POST['linkopentype']),
					'link_class'       => intval($_POST['link_class']),
					'link_datestamp'   => time(),
					'link_author'      => USERID,                                                 
					'link_active'      => 0,
				);
			if($db->insert("links_page", $insert)) { $mes->addSuccess(LAN_LINKS_29); $mes->render();};    

			$edata_ls = array("link_category" => $_POST['cat_id'], "link_name" => $link_name, "link_url" => $link_url, "link_description" => $link_description, "link_button" => $link_button, "username" => $username, "submitted_link" => $submitted_link);
			$e_event->trigger("linksub", $edata_ls);
			$url = e107::url('links_page','submitted','full');
			//jsx_location($url);
			e107::getRedirect()->go($url);      
		}
    // edit link, not allowed direct posting      
		elseif(isset($mode) && $mode == "edit")
		{    
      if (is_numeric($qs[2]) && $qs[1] != "sn") {
        $link_class = $_POST['link_class'];
        if($qs[1] == "manage"){
          $link_author = USERID;
        }else{  // not needed anymore, left for future
          $link_author = ($_POST['link_author'] && $_POST['link_author']!='' ? $tp -> toDB($_POST['link_author']) : USERID);
        }
        $id = intval($qs[2]);
        $where = 'link_id = '.$id; 
        $update = array(
  					'link_name'        => $link_name,
  					'link_url'         => $link_url,
  					'link_description' => $link_description,
  					'link_button'      => $link_button ,
  					'link_category'    => intval($_POST['cat_id']),
  					'link_open'        => intval($_POST['linkopentype']),
  					'link_class'       => intval($link_class),
  					'link_datestamp'   => intval($time),
  					'link_author'      => $link_author,                                                 
  					'link_active'      => 0,
        'WHERE' => $where
        );      
   
        if($db->update('links_page', $update))  {
           $mes->addSuccess(LCLAN_ADMIN_3.' '.LAN_LINKS_29);
           echo $mes->render();          
        }  
        $e107cache->clear("sitelinks");
        
        
      }
      else {
        
        e107::getMessage()->addError('Something went wrong. Contact admin.' );
        echo e107::getMessage()->render();
      }
    } 
    // direct posting allowed   
    else 
		{
      $link_t = $db->count("links_page", "(*)", "WHERE link_category='".intval($_POST['cat_id'])."'");
      $time   = ($_POST['update_datestamp'] ? time() : ($_POST['link_datestamp'] != "0" ? $_POST['link_datestamp'] : time()) );
      //update link
			if (is_numeric($qs[2]) && $qs[1] != "sn") {
				$link_class = $_POST['link_class'];
				if($qs[1] == "manage"){
            $link_author = USERID;
        }else{
            $link_author = ($_POST['link_author'] && $_POST['link_author']!='' ? $tp -> toDB($_POST['link_author']) : USERID);
        }

        $update = array(
					'link_name'        => $link_name,
					'link_url'         => $link_url,
					'link_description' => $link_description,
					'link_button'      => $link_button ,
					'link_category'    => intval($_POST['cat_id']),
					'link_open'        => intval($_POST['linkopentype']),
					'link_class'       => intval($link_class),
					'link_datestamp'   => intval($time),
					'link_author'      => $link_author,                                                 
					'link_active'      => 1,
        'WHERE' => $where
        );         
        $e107cache->clear("sitelinks");
        if($db->update('links_page', $update))  {
           $mes->addSuccess(LCLAN_ADMIN_3);
           echo $mes->render();          
        }
 
            //create link
			} else {
      
      $insert = array(
					'link_id'          => NULL,
					'link_name'        => $link_name,
					'link_url'         => $link_url,
					'link_description' => $link_description,
					'link_button'      => $link_button ,
					'link_category'    => intval($_POST['cat_id']),
					'link_order'       => $link_t+1,
					'link_refer'       => 0,
					'link_open'        => intval($_POST['linkopentype']),
					'link_class'       => intval($_POST['link_class']),
					'link_datestamp'   => time(),
					'link_author'      => USERID,                                                 
					'link_active'      => 1,
				);
      if($db->insert("links_page", $insert)) { $mes->addSuccess(LCLAN_ADMIN_2); $mes->render();};
                $e107cache->clear("sitelinks");
                $mes->addSuccess(LCLAN_ADMIN_2);
                echo $mes->render();
       }
 
    }
  }

	function show_link_create()
	{
        global $rs, $qs,  $fl;
        
        $frm = e107::getForm();
        $db = e107::getDb();          
        
        $row['link_category']       = "";
        $row['link_name']           = "";
        $row['link_url']            = "";
        $row['link_description']    = "";
        $row['link_button']         = "";
        $row['link_open']           = "";
        $row['link_class']          = "";
        $link_resize_value          = (isset($this->plugPrefs['link_resize_value']) && $this->plugPrefs['link_resize_value'] ? $this->plugPrefs['link_resize_value'] : "100");

        if (isset($qs[1]) && $qs[1] == 'edit' && !isset($_POST['submit'])) 
        {
          if ($db->select("links_page", "*", "link_id='".intval($qs[2])."' ")) 
          {
          $row = $db->fetch();
          }
        }

        if (isset($qs[1]) && $qs[1] == 'sn') 
		    {
            if ($db->select("tmp", "*", "tmp_time='".intval($qs[2])."'")) {
                $row = $db->fetch();
                $submitted                  = explode("^", $row['tmp_info']);
                $row['link_category']       = $submitted[0];
                $row['link_name']           = $submitted[1];
                $row['link_url']            = $submitted[2];
                $row['link_description']    = $submitted[3]."\n[i]".LCLAN_ITEM_1." ".$submitted[5]."[/i]";
                $row['link_button']         = $submitted[4];

            }
        }

        if(isset($_POST['uploadlinkicon'])){
            $row['link_category']       = $_POST['cat_id'];
            $row['link_name']           = $_POST['link_name'];
            $row['link_url']            = $_POST['link_url'];
            $row['link_description']    = $_POST['link_description'];
            $row['link_button']         = $_POST['link_button'];
            $row['link_open']           = $_POST['linkopentype'];
            $row['link_class']          = $_POST['link_class'];
            $link_resize_value          = (isset($_POST['link_resize_value']) && $_POST['link_resize_value'] ? $_POST['link_resize_value'] : $link_resize_value);
        }
 
        $text  = "<div style='text-align:center'>";

        $text .= $frm -> open('linkform',"post", e_REQUEST_URI, array('autocomplete' => 'on', 'class' => 'form-horizontal')); 

        $db = e107::getDb();
        if($allRows = $db->retrieve("SELECT * FROM #links_page_cat ", TRUE))
        {
        	foreach($allRows as $catrow)
        	{                                
        		$id =  $catrow['link_category_id']; $name = $catrow['link_category_name']; 
            $catlist[$id] = $name;
        	}
        }
             

        $text .= "<div class='form-group'> <label for='cat_id' class='col-sm-2 control-label'>".LCLAN_ITEM_2."</label>";
        $text .= "<div class='col-sm-10'>".$frm->select('cat_id',$catlist,$row['link_category'])."</div></div>";
  
        $text .= "<div class='form-group'> <label for='link_name' class='col-sm-2 control-label'>".LCLAN_ITEM_4."</label>";
        $text .= "<div class='col-sm-10'>".$frm->text('link_name',$row['link_name'],100, array('required'=>1))."</div></div>";

        $text .= "<div class='form-group'> <label for='link_url' class='col-sm-2 control-label'>".LCLAN_ITEM_5."</label>";
        $text .= "<div class='col-sm-10'>".$frm->text('link_url',$row['link_url'],100,  array('required'=>1))."</div></div>";          
   
        $text .= "<div class='form-group'> <label for='link_description' class='col-sm-2 control-label'>".LCLAN_ITEM_6."</label>";
        $text .= "<div class='col-sm-10'>".$frm->textarea('link_description',$row['link_description'],3,59,array('size'=>'xxlarge', 'required'=>1))."</div></div>";    

        $text .= "<div class='form-group'> <label for='link_button' class='col-sm-2 control-label'>".LCLAN_ITEM_7."</label>";
        $text .= "<div class='col-sm-10'>".$frm->imagepicker("link_button",  $row['link_button'] , LCLAN_ITEM_7, "media=linkspage")."</div></div>";    

        $winoopt['0'] = LCLAN_ITEM_17;
        $winoopt['1'] = LCLAN_ITEM_18;
        $winoopt['4'] = LCLAN_ITEM_19;
           
        //0=same window, 1=_blank, 2=_parent, 3=_top, 4=miniwindow
        $text .= "<div class='form-group'> <label for='link_open' class='col-sm-2 control-label'>".LCLAN_ITEM_16."</label>";
        $text .= "<div class='col-sm-10'>".$frm->select('link_open',$winoopt,$row['link_open'])."</div></div>";  
 
        $text .= "<div class='form-group'> <label for='link_class' class='col-sm-2 control-label'>".LCLAN_ITEM_20."</label>";
        $text .= "<div class='col-sm-10'>".$frm->userclass('link_class',$row['link_class'], 'dropdown', array('options'=>"public,guest,nobody,member,admin,classes"))."</div></div>";  

  
        if (isset($qs[2]) && $qs[2] && $qs[1] == "edit") {
            $text .= $frm->hidden("link_datestamp", $row['link_datestamp']);
            $text .= $frm->checkbox("update_datestamp", 1, false, array('inline'=>true,'label'=>LCLAN_ITEM_21)); 
            $text .= $frm->button("add_link", '1', 'submit', LCLAN_ITEM_22);
            $text .= $frm->hidden("link_id", $row['link_id']);
            $text .= $frm->hidden("link_author", $row['link_author']);                   
        } else {
            $text .= $frm->button("add_link", '1', 'submit', LCLAN_ITEM_23);
        }
        $text .= $frm -> close()."</div>";

        e107::getRender()->tablerender(LCLAN_ITEM_24, $text, 'links_page_class');
    }

                                               

	/**
	 *		Display list of links within a particular category
	 */
    function show_links() 
	{
        global  $qs, $rs, $tp, $from;
        $db = e107::getDb();

        $number = "20";
		$LINK_CAT_NAME = '';			// May be appropriate to add a shortcode later

        if($qs[2] == "all")
		{	// Show all categories
            $caption = LCLAN_ITEM_38;
            $qry = " link_id != '' ORDER BY link_category ASC, link_order ASC";
        }
		else
		{	// Show single category
            if ($db->select("links_page_cat", "link_category_name", "link_category_id='".intval($qs[2])."' " )) 
			{
                $row = $db->fetch();
                $caption = LCLAN_ITEM_2." ".$row['link_category_name'];
            }
            $qry = " link_category=".intval($qs[2])." ORDER BY link_order, link_id ASC";
        }

        $link_total = $db->select("links_page", "*", " ".$qry." ");
        if (!$db->select("links_page", "*", " ".$qry." LIMIT ".intval($from).",".intval($number)." ")) 
		{
					//jsx_location(e107::url('links_page', 'index'));  
					$url = e107::url('links_page', 'index'); 
					e107::getRedirect()->go($url);
				}
		else
		{	// Display the individual links
            $text = $rs->form_open("post", e_SELF.(e_QUERY ? "?".e_QUERY : ""), "myform_{$row['link_id']}", "", "");
            $text .= "<div style='text-align:center'>
            <table class='fborder' style='".ADMIN_WIDTH."'>
            <tr>
            <td class='fcaption' style='width:5%'>".LCLAN_ITEM_25."</td>
            <td class='fcaption' style='width:65%'>".LCLAN_ITEM_26."</td>
            <td class='fcaption' style='width:10%'>".LCLAN_ITEM_27."</td>
            <td class='fcaption' style='width:10%'>".LCLAN_ITEM_28."</td>
            <td class='fcaption' style='width:10%'>".LCLAN_ITEM_29."</td>
            </tr>";
            while ($row = $db->fetch()) 
			{
                $linkid = $row['link_id'];
                $img = "";
                if ($row['link_button']) 
				{
                    if (strpos($row['link_button'], "http://") !== FALSE) 
					{
                        $img = "<img style='border:0;' src='".$row['link_button']."' alt='".$LINK_CAT_NAME."' />";
                    } 
					else 
					{
                        if(strstr($row['link_button'], "/"))
						{
                            $img = "<img style='border:0;' src='".e_BASE.$row['link_button']."' alt='".$LINK_CAT_NAME."' />";
                        }
						else
						{
                            $img = "<img style='border:0' src='".e_PLUGIN_ABS."links_page/link_images/".$row['link_button']."' alt='".$LINK_CAT_NAME."' />";
                        }
                    }
                }

				$name_suffix = URL_SEPARATOR.$linkid.URL_SEPARATOR.$row['link_order'].URL_SEPARATOR.$row['link_category'];
                if($row['link_order'] == "1")
				{
                    $up = "&nbsp;&nbsp;&nbsp;";
                }
				else
				{
					//$up = "<input type='image' src='".LINK_ICON_ORDER_UP_BASE."' value='".$linkid.".".$row['link_order'].".".$row['link_category']."' name='inc' />";
					$up = "<input type='image' src='".LINK_ICON_ORDER_UP_BASE."' name='inc".$name_suffix."' />";
                }
                if($row['link_order'] == $link_total)
				{
                    $down = "&nbsp;&nbsp;&nbsp;";
                }
				else
				{
                    //$down = "<input type='image' src='".LINK_ICON_ORDER_DOWN_BASE."' value='".$linkid.".".$row['link_order'].".".$row['link_category']."' name='dec' />";
					$down = "<input type='image' src='".LINK_ICON_ORDER_DOWN_BASE."' name='dec".$name_suffix."' />";
                }
                $text .= "
                <tr>
                <td class='forumheader3' style='width:5%; text-align: center; vertical-align: middle'>".$img."</td>
                <td style='width:65%' class='forumheader3'>
                    <a href='".e_PLUGIN_ABS."links_page/links.php?".$row['link_id']."' rel='external'>".LINK_ICON_LINK."</a> ".$row['link_name']."
                </td>
                <td style='width:10%; text-align:center; white-space: nowrap' class='forumheader3'>
                    <a href='".e_SELF."?link.edit.".$linkid."' title='".LCLAN_ITEM_31."'>".LINK_ICON_EDIT."</a>
                    <input type='image' title='delete' name='delete[main_{$linkid}]' alt='".LCLAN_ITEM_32."' src='".LINK_ICON_DELETE_BASE."' onclick=\"return jsconfirm('".$tp->toJS(LCLAN_ITEM_33." [ ".$row['link_name']." ]")."')\" />
                </td>
                <td style='width:10%; text-align:center; white-space: nowrap' class='forumheader3'>
                    ".$up."
                    ".$down."
                </td>
                <td style='width:10%; text-align:center' class='forumheader3'>
                    <select name='link_order[]' class='tbox'>";
                    //".$rs -> form_select_open("link_order[]");
                    for($a = 1; $a <= $link_total; $a++) {
                        $text .= $rs -> form_option($a, ($row['link_order'] == $a ? "1" : "0"), $linkid.".".$a, "");
                    }
                    $text .= $rs -> form_select_close()."
                </td>
                </tr>";
            }
            $text .= "
            <tr>
            <td class='forumheader' colspan='4'>&nbsp;</td>
            <td class='forumheader' style='width:5%; text-align:center'>
            ".$rs->form_button("submit", "update_order", LCLAN_ITEM_30)."
            </td>
            </tr>
            </table></div>
            ".$rs->form_close();
        }
      e107::getRender()->tablerender($caption, $text, 'links_page_class');
		  $this->ShowNextPrev($from, $number, $link_total);
    }
}

?>