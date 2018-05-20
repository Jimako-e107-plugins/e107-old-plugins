<?php

class Paginator{
    var $items_per_page;
    var $items_total;
    var $current_page;
    var $num_pages;
    var $mid_range;
    var $low;
    var $high;
    var $limit;
    var $return;
    var $default_ipp = 25;
    var $querystring;

    function Paginator()
    {
        global $pref;
        $this->current_page = 1;
        $this->mid_range = eb_PAGINATION_MIDRANGE;
        $this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp']:$pref['eb_default_items_per_page'];
    }

    function paginate()
    {
        if($_GET['ipp'] == 'All')
        {
            $this->num_pages = ceil($this->items_total/$this->default_ipp);
            $this->items_per_page = $this->default_ipp;
        }
        else
        {
            if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
            $this->num_pages = ceil($this->items_total/$this->items_per_page);
        }
        if (isset($_GET['page'])) $this->current_page = (int) $_GET['page']; // must be numeric > 0
        if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
        if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
        
        $prev_page = $this->current_page-1;
        $next_page = $this->current_page+1;

        if($_GET)
        {
            $args = explode("&amp;",$_SERVER['QUERY_STRING']);
            foreach($args as $arg)
            {
                if ($arg != '')
                {
                    $keyval = explode("=",$arg);
                    if($keyval[0] != "page" And $keyval[0] != "ipp" And $keyval[0]!="") $this->querystring .= "&amp;" . $arg;
                }
            }
        }

        if($this->num_pages > 10)
        {
            $this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?page=$prev_page&amp;ipp=$this->items_per_page$this->querystring\">&laquo; ".EB_PGN_L2."</a> ":"<span class=\"inactive\">&laquo; ".EB_PGN_L2."</span> ";

            $this->start_range = $this->current_page - floor($this->mid_range/2);
            $this->end_range = $this->current_page + floor($this->mid_range/2);

            if($this->start_range <= 0)
            {
                $this->end_range += abs($this->start_range)+1;
                $this->start_range = 1;
            }
            if($this->end_range > $this->num_pages)
            {
                $this->start_range -= $this->end_range-$this->num_pages;
                $this->end_range = $this->num_pages;
            }
            $this->range = range($this->start_range,$this->end_range);

            for($i=1;$i<=$this->num_pages;$i++)
            {
                if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
                // loop through all pages. if first, last, or in range, display
                if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
                {
                    $this->return .= ($i == $this->current_page And $_GET['page'] != 'All') ? "<a title=\"".EB_PGN_L1." $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" title=\"".EB_PGN_L1." $i of $this->num_pages\" href=\"$_SERVER[PHP_SELF]?page=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a> ";
                }
                if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
            }
            $this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($_GET['page'] != 'All')) ? "<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?page=$next_page&amp;ipp=$this->items_per_page$this->querystring\">".EB_PGN_L3." &raquo;</a>\n":"<span class=\"inactive\">&raquo; ".EB_PGN_L3."</span>\n";
            //fm $this->return .= ($_GET['page'] == 'All') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">".EB_PGN_L4."</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=\"$_SERVER[PHP_SELF]?page=1&amp;ipp=All$this->querystring\">".EB_PGN_L4."</a> \n";
        }
        else
        {
            for($i=1;$i<=$this->num_pages;$i++)
            {
                $this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?page=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a> ";
            }
            //fm $this->return .= "<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?page=1&amp;ipp=All$this->querystring\">".EB_PGN_L4."</a> \n";
        }
        $this->low = ($this->current_page>0) ? ($this->current_page-1) * $this->items_per_page:0;
        $this->high = ($_GET['ipp'] == 'All') ? $this->items_total - 1:($this->current_page * $this->items_per_page)-1;
        $this->limit = ($_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
    }

    function display_items_per_page()
    {
        $items = '';
        $ipp_array = array(5,10,25,50,100,'All');
        foreach($ipp_array as $ipp_opt)
        {
        	$ipp_txt = ($ipp_opt == 'All') ? EB_PGN_L4 : $ipp_opt;
        	$items .= ($ipp_opt == $this->items_per_page) ? "<option selected=\"selected\" value=\"$ipp_opt\">$ipp_txt</option>\n":"<option value=\"$ipp_opt\">$ipp_txt</option>\n";
        }
        return EB_PGN_L5." <select class=\"tbox\" onchange=\"window.location='$_SERVER[PHP_SELF]?page=1&amp;ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
    }

    function display_jump_menu()
    {
        for($i=1;$i<=$this->num_pages;$i++)
        {
            $option .= ($i==$this->current_page) ? "<option value=\"$i\" selected=\"selected\">$i</option>\n":"<option value=\"$i\">$i</option>\n";
        }
        return EB_PGN_L1." <select class=\"tbox\" onchange=\"window.location='$_SERVER[PHP_SELF]?page='+this[this.selectedIndex].value+'&amp;ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n";
    }

    function display_pages()
    {
        return $this->return;
    }
}