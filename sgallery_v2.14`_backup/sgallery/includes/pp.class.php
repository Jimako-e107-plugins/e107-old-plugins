<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|       Advanced PerPage Class: e107_plugins/sgallery/includes/pp_class.php
|        Email: m.yovchev@clabteam.com
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	Copyright Corllete Lab ( http://www.clabteam.com )
|        Free Support: http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

//lan file
include_lan(SGAL_LAN.'_pp.php');

/**
 * Next / Previous handling class
 *
 */

class cl_pp {
    /**
     * Generate next / previous pages and appropriate links (
     *
     * @param int $total, total pages
     * @param int $page, current page
     * @param int $perPage, items per page
     * @param int $pageNum, num next prev
     * @param string $get_query, QUERY_STRING, default null
     * @param bool $return, Output onto page or return the links
     * @returns nextprev string
     */

     var $perPage;
     var $pageNum;
     var $postQuery = '';

     function pageLimit($total, $page, $array=false)
     {
       $perPage = $this->perPage;

       if(empty($total)) return false;

       $page = $page ? intval($page) : 1;

       $total_pages = ceil($total / $perPage);

       //no result found
       if($total_pages <= 0) return $limit = ' LIMIT 0 , '.$perPage;

       if($page > $total_pages) $page = $total_pages;

       $from = ($page * $perPage) - $perPage; 

       $limit = 'LIMIT '.$from.' , '.$perPage;
       if($array) return array('from'=>$from, 'num'=>$perPage);
        
       return $limit;
     }

     function pageNav($total, $page, $get_query = false, $return=true, $qseparator='.')
     {
        $ret = '';

        $perPage = $this->perPage;
        $pageNum = $this->pageNum;

        $total_pages = ceil($total / $perPage);

        //no paginating needed
        if($total_pages <= 1) return false;

        $page = intval($page);

        //if the current page is greater than total
        if($page > $total_pages) $page = $total_pages;

        $mid = ceil($pageNum / 2);

        //SEO FIX - future e107 development
        if(defined('e_SEOSELF')) 
            $get_query = e_SEOSELF.$get_query.$qseparator;
        else 
            $get_query = !empty($get_query) ? '?'.$get_query.$qseparator : '?';


        //jump to page 
        $ret .= '<span class="pagelink"><a title="'.LNG_PP_GOTOPAGE.'" href="#" onclick="javascript:page_jump(\''.$get_query.'\','.$total_pages.','.$page.', \''.LNG_PP_JSMSG.'\'); return false;">'.$total_pages.' '.LNG_PP_PAGES.':</a></span>';

        //go to first
        if(($page - $mid) > 0)
           $ret .= '&nbsp;<span class="pagelinklast"><a href="'.$get_query.'1'.($this->postQuery ? $qseparator.$this->postQuery : '').'" title="'.LNG_PP_FIRSTPAGE.'">&laquo;</a></span>';


        //prev
        if($page > 1)
        {
           $prev = ($page - 1);

           //prev page link
           $ret .= '&nbsp;<span class="pagelink"><a href="'.$get_query.$prev.($this->postQuery ? $qseparator.$this->postQuery : '').'" title="'.LNG_PP_PREVPAGE.'">&lt;</a></span>';
        }

        $cnt = $pageNum + $page;

        $fromI = ($page - $mid) < 0 ? 1 : $page - $mid + 1;
        $toI = ($page + $mid) > $total_pages ? $total_pages : $page + $mid - 1;

        //Creat the navigation page numbers

        for($i = $fromI; $i <= $toI; $i++)
        {
           if(($page) == $i)
           { // make sure the link is not given to the page being viewed
               $ret .= '&nbsp;<span class="pagecurrent"><a href="#" onclick="return false;" style="cursor: default;">'.$i.'</a></span>';
           }
           else
           {
               $ret .= '&nbsp;<span class="pagelink"><a href="'.$get_query.$i.($this->postQuery ? $qseparator.$this->postQuery : '').'" title="'.LNG_PP_TOPAGE.' '.$i.'">'.$i.'</a></span>';
           }
        }

        //next
        if($page < $total_pages)
        {
           $next = ($page + 1);

           //prev page link
           $ret .= '&nbsp;<span class="pagelink"><a href="'.$get_query.$next.($this->postQuery ? $qseparator.$this->postQuery : '').'" title="'.LNG_PP_NEXTPAGE.'">&gt;</a></span>';
        }

        // Create the last link.
        if(($page + $mid) <= $total_pages)
        {
            $ret .= '&nbsp;<span class="pagelinklast"><a href="'.$get_query.$total_pages.($this->postQuery ? $qseparator.$this->postQuery : '').'" title="'.LNG_PP_LASTPAGE.'">&raquo;</a></span>';
        }

        return $ret;

     }

     function pp_Config($perPage=10, $pageNum=5) {

          $this->perPage = $perPage;
          $this->pageNum = $pageNum;
     }
}
?>
