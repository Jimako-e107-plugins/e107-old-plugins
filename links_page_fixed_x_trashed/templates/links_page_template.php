<?php
/**
 * @file
 * Templates for plugins displays.
 */

global $sc_style;

// ##### -----------------------------------------------------------------------
$sc_style['LINK_CAT_DESC']['pre'] = "<br /><span class='smalltext'><i>";
$sc_style['LINK_CAT_DESC']['post'] = "</i></span>";

$sc_style['LINK_PAGE_URL']['pre'] = "<span class='smalltext'>";
$sc_style['LINK_PAGE_URL']['post'] = "</span>";

$sc_style['LINK_DESC']['pre'] = "<span class='smalltext'>";
$sc_style['LINK_DESC']['post'] = "</span>";
 
 
// ##### NEXT PREV -------------------------------------------------------------
$LINKS_PAGE_TEMPLATE['LINK_NP_TABLE'] = 
 "<div class='nextprev'>{LINK_NEXTPREV}</div>";

 
$sc_style['LINK_CATMENU']['pre'] = "<td style='text-align:left;'>";
$sc_style['LINK_CATMENU']['post'] = "</td>";

$LINKS_PAGE_TEMPLATE['LINK_PAGE_NAVIGATOR'] = '
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">'.LAN_LINKS_47.'</h3>
  </div>
  <div class="panel-body">
    <ul id="navigator" class="nav nav-pills btn-group">
      {LINK_NAVIGATOR} 
    </ul>
  </div>
</div>
 ';
 
$LINKS_PAGE_TEMPLATE['LINK_PAGE_CAT_NAVIGATOR'] = '
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">'.LAN_LINKS_48.'</h3>
  </div>
  <div class="panel-body">
    <ul id="navigator" class="nav nav-pills btn-group">
      {LINK_NAV_ALLCATS} 
    </ul>
  </div>
</div>
 '; 

$LINKS_PAGE_TEMPLATE['LINK_SORTORDER'] = "{LINK_SORTORDER} ";

$LINKS_PAGE_TEMPLATE['LINK_TABLE_CAPTION'] = LCLAN_ITEM_24;

$LINKS_PAGE_TEMPLATE['LINK_TABLE_START'] = ' 
	<div class="panel panel-default linktablestart"> 
  	<div class="panel-heading" style="word-wrap: break-word;">
        <div class="row">
         <div class="col-md-8">'.LAN_LINKS_32.' <h3 class="panel-title" style=" display:inline-block;"> {LINK_CAT_NAME}</h3> 
         {LINK_CAT_TOTAL} {LINK_CAT_DESC}</div>
         <div class="col-md-2 hidden-xs hidden-sm">{LINK_RATING_LAN}</div>
         <div class="col-md-1 hidden-xs hidden-sm">{LINK_COMMENT_LAN}</div>       
         <div class="col-md-1 hidden-xs hidden-sm">{LINK_REFER_LAN}</div>       
        </div> 
    </div>
    <div class="panel-body">
  ';
  
$LINKS_PAGE_TEMPLATE['LINK_TABLE_REFER_START'] = '{NAVIGATOR}
	<div class="panel panel-default linktablestart"> 
  	<div class="panel-heading" style="word-wrap: break-word;">
        <div class="row">
         <div class="col-md-8"><h3 class="panel-title" style=" display:inline-block;"> '.LAN_LINKS_10.' </h3> 
         </div>
         <div class="col-md-2 hidden-xs hidden-sm">{LINK_RATING_LAN}</div>
         <div class="col-md-1 hidden-xs hidden-sm">{LINK_COMMENT_LAN}</div>       
         <div class="col-md-1 hidden-xs hidden-sm">{LINK_REFER_LAN}</div>       
        </div> 
    </div>
    <div class="panel-body">
  ';

$LINKS_PAGE_TEMPLATE['LINK_TABLE'] = '
      <div class="row" >
       <div class="col-md-1 col-xs-2">{LINK_BUTTON: x=1&w=32&h=32&crop=1&class=linkspage_button img-responsive}</div>
       <div class="col-md-7 col-xs-10">
          {LINK_NEW} {LINK_APPEND} {LINK_NAME} </a><br />
          {LINK_PAGE_URL=link}
	        {LINK_DESC}</div>
       <div class="hidden-sm col-xs-6 visible-xs">{LINK_RATING_LAN}</div>   
       <div class="col-md-2 col-xs-6">{LINK_RATING}</div>
       <div class="hidden-sm col-xs-6 visible-xs">{LINK_COMMENT_LAN}</div>
       <div class="col-md-1 col-xs-6">{LINK_COMMENT}</div>  
       <div class="hidden-sm hidden-md hidden-lg col-xs-6 visible-xs ">{LINK_REFER_LAN}</div>     
       <div class="col-md-1 col-xs-6 "> {LINK_REFER}</div>       
      </div>
	';

$LINKS_PAGE_TEMPLATE['LINK_TABLE_END'] = '
	 </div>
  </div>';
  
// ##### FRONTPAGE -------------------------------------------------------------  
$LINKS_PAGE_TEMPLATE['LINK_MAIN_TABLE_START'] = "
	<div class='panel panel-default linkmaintablestart'>
   <div class='panel-body'> ";
$LINKS_PAGE_TEMPLATE['LINK_MAIN_TABLE'] = "
      <div class='row'>
       <div class='col-md-1'>{LINK_MAIN_ICON: x=1&w=32&h=32&crop=1&class=linkspage_button img-responsive}</div>
       <div class='col-md-9'>{LINK_MAIN_HEADING}<br>{LINK_MAIN_DESC}</div>
       <div class='col-md-2'>{LINK_MAIN_NUMBER}</div>    
      </div>
 "; 
$LINKS_PAGE_TEMPLATE['LINK_MAIN_TABLE_END'] = "
   </div>
   <div class='panel-footer'>
      <div class='row'>
        <div class='col-md-12'>{LINK_MAIN_TOTAL}</div>
      </div>
    </div>    
	</div>";   
 
// ##### PERSONAL MANAGER ------------------------------------------------------  
$LINKS_PAGE_TEMPLATE['LINK_TABLE_MANAGE_START'] = "
  <form method='post' action='".e_SELF."?".e_QUERY."' id='linkmanagerform' enctype='multipart/form-data'>".
	'<div class="panel panel-default linkmaintablestart">
    	<div class="panel-heading" style="word-wrap: break-word;">
        <div class="row">
         <div class="col-sm-3 hidden-xs">'.LAN_LINKS_MANAGER_5.'</div>
         <div class="col-sm-7 hidden-xs">'.LAN_LINKS_MANAGER_1.'</div>       
         <div class="col-sm-2 hidden-xs">'.LAN_LINKS_MANAGER_2.'</div>       
        </div> 
    </div>
   <div class="panel-body"> 
';

$LINKS_PAGE_TEMPLATE['LINK_TABLE_MANAGE'] = '      
      <div class="row" >
       <div class="hidden-sm col-xs-6 visible-xs">'.LAN_LINKS_MANAGER_5.':&nbsp; {LINK_MANAGE_CAT} </div>   
       <div class="col-sm-3 hidden-xs">{LINK_MANAGE_CAT}</div>
       <div class="hidden-sm col-xs-6 visible-xs">'.LAN_LINKS_MANAGER_1.':&nbsp; {LINK_MANAGE_NAME} </div>   
       <div class="col-sm-7 hidden-xs">{LINK_MANAGE_ICON} {LINK_MANAGE_NAME}</div>      
       <div class="hidden-sm col-xs-6 visible-xs">'.LAN_LINKS_MANAGER_2.':&nbsp; {LINK_MANAGE_ACTIVE}{LINK_MANAGE_OPTIONS} </div>   
       <div class="col-sm-2 hidden-xs">{LINK_MANAGE_ACTIVE}{LINK_MANAGE_OPTIONS}</div>                
      </div>    
';       

$LINKS_PAGE_TEMPLATE['LINK_TABLE_MANAGE_END'] = 
"   </div>
   <div class='panel-footer'>
      <div class='row'>
        <div class='col-md-12 text-right'><a href='{LINK_MANAGE_NEWLINK}'>".LAN_LINKS_MANAGER_3."></a> </div>
      </div>
    </div>    
	</div>
  </form><br />";
  
// ##### SUBMIT ----------------------------------------------------------------
$LINKS_PAGE_TEMPLATE['LINK_SUBMIT_TABLE'] = "
	<div class=' text-center'> 
	<form method='post' action='".e_REQUEST_URI."' class='form-horizontal'>
    <div class='well'>{LINK_SUBMIT_PRETEXT}</div>
    <div class='form-group'> <label for='cat_id' class='col-sm-2 control-label'><span class='required'>*&nbsp;</span>".LCLAN_ITEM_2."</label> 
      <div class='col-sm-10'>{LINK_SUBMIT_CAT}</div>
    </div>  
    <div class='form-group'> <label for='cat_id' class='col-sm-2 control-label'><span class='required'>*&nbsp;</span>".LCLAN_ITEM_4."</label>
      <div class='col-sm-10'>{LINK_SUBMIT_NAME}</div>
    </div>
    <div class='form-group'> <label for='link_url' class='col-sm-2 control-label'><span class='required'>*&nbsp;</span>".LCLAN_ITEM_5."</label>
      <div class='col-sm-10'>{LINK_SUBMIT_URL}</div>
    </div>          
    <div class='form-group'> <label for='link_description' class='col-sm-2 control-label'><span class='required'>*&nbsp;</span>".LCLAN_ITEM_6."</label>
      <div class='col-sm-10'>{LINK_SUBMIT_DESCRIPTION}</div>
    </div>
    <div class='form-group'> <label for='link_button' class='col-sm-2 control-label'>".LCLAN_ITEM_7."</label>
    <div class='col-sm-10'>{LINK_SUBMIT_IMAGE}</div></div>    
    
    <button type='submit' name='add_link' value='1' id='add-link' class='btn submit btn-success' data-original-title=''><span>".LAN_LINKS_27."</span></button>
   
	</form>
  </div>    
 
	";

// ##### RATE PAGE -------------------------------------------------------------
$LINKS_PAGE_TEMPLATE['LINK_RATED_TABLE_START'] = '
	<div class="panel panel-default"> 
  	<div class="panel-heading" style="word-wrap: break-word;">
        <div class="row">
         <div class="col-md-10"><h3 class="panel-title" style=" display:inline-block;"> '.LAN_LINKS_11.' </h3> 
         </div>
         <div class="col-md-2 hidden-xs hidden-sm">{LINK_RATING_LAN}</div>      
        </div> 
    </div>   
    <div class="panel-body">
	';

$LINKS_PAGE_TEMPLATE['LINK_RATED_TABLE'] = '
<div class="row" >    
  <div class="col-sm-2 col-xs-6">{LINK_BUTTON: x=1&w=32&h=32&crop=1&class=linkspage_button img-responsive}</div>   
  <div class="col-sm-8 col-xs-6">{LINK_RATED_APPEND} {LINK_RATED_NAME}
    <br> 	
  {LINK_RATED_URL}
	{LINK_RATED_CATEGORY}
	{LINK_RATED_DESC}
  </div>          
  <div class="col-sm-2 col-xs-6">{LINK_RATED_RATING}</div>                
</div> 
   ';

$LINKS_PAGE_TEMPLATE['LINK_RATED_TABLE_END'] = "
	</div><div class='panel-footer'></div></div>";
  
$LINKS_PAGE_TEMPLATE['LINK_ERROR_MESSAGE'] = '
<div class="panel panel-default panel-body">{ERROR_MESSAGE}</div>';
?>
