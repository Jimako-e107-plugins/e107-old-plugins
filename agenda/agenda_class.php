<?php

class Agenda {
   // private variables
   var $today_arr;
   var $today_day_num;
   var $today_month_num;
   var $today_month_txt;
   var $today_year_num;
   var $today_ds;
   var $tomorrow_ds;
   var $today_monthstart_ds;
   var $today_monthend_ds;
   var $today_weekstart_ds;
   var $today_firstday_arr;
   var $today_lastday_arr;

   var $curdate_ds;
   var $curdate_txt;
   var $curmonth_ds;
   var $curyear_ds;
   var $nextday_ds;
   var $nextmonth_ds;
   var $nextyear_ds;
   var $nextdate_ds;
   var $curmonth_txt;
   var $curweekstart_ds;
   var $curmonthstart_ds;

   var $table_join;
   var $filter;
   var $dhtmlcalendar;

   var $usr_filter_state;

   // private arrays
   var $diary_codes_arr;
   var $days_arr;
   var $months_arr;
   var $eventCache;       // An multi-dimensional arrray of events by day used to cache information

   // private lists
   var $views;
   var $recur_codes;
   var $types;
   var $filter_types;
   var $categories;
   var $owners;
   var $questions;

   // private constants
   var $_ONEDAY;
   var $_ONEWEEK;
   var $_AGENDA_TABLE;
   var $_CATEGORY_TABLE;
   var $_REG_TABLE;
   var $_SUBS_TABLE;
   var $_TYPE_TABLE;
   var $_USER_TABLE;
   var $_FILENAME;
   var $_DIRECTORY;

   // Control variables
   var $p1;
   var $p2;
   var $p3;
   var $p4;
   var $p5;
   var $print;

   function Agenda() {
      $this->initConstantVars();
      $this->initControlVars();
      $this->initPrivateVars();
      $this->initPrivateArrays();
      $this->initPrivateLists();
      $this->initEvents();
   }

   function initConstantVars() {
      $this->_ONEDAY          = 60*60*24;
      $this->_ONEWEEK         = 60*60*24*7;
      $this->_AGENDA_TABLE    = "agenda";
      $this->_CATEGORY_TABLE  = "agenda_category";
      $this->_REG_TABLE       = "agenda_registration";
      $this->_SUBS_TABLE      = "agenda_subs";
      $this->_TYPE_TABLE      = "agenda_type";
      $this->_USER_TABLE      = "agenda_user";
      $this->_FILENAME        = "agenda.php";
      $this->_DIRECTORY       = e_PLUGIN."agenda/";
   }

   /**
    * Initialise control variables
    */
   function initControlVars() {
      global $pref;

      $temp    = explode(".", e_QUERY);
      $this->print = false;
      if ($temp[0] == "plugin:agenda") {
         $this->print = true;
         array_shift($temp);
      }

      $this->p1  = strlen($temp[0])>0 ? $temp[0] : "view";    // Default action
      $this->p2  = isset($temp[1]) ? $temp[1] : $pref["agenda_default_view"];
      if ($this->p2 == "") {
         $this->p2 = "0"; // Default view
      }

      $this->p3  = isset($temp[2]) ? $temp[2] : "0";  // Default entry id
      $this->p4  = isset($temp[3]) ? $temp[3] : "";   // Default day
      $this->p5  = isset($temp[4]) ? $temp[4] : "";   // Default entry type

      // Sort out some dates
      if (strpos($this->p4, "-") > 0) {
         // Date from date text field
         $bits = explode("-", $this->p4);
         $this->curdate_ds = mktime(0, 0, 0, $bits[1], $bits[0], $bits[2]);
         $this->p4 = $this->getDateDS();
      } else {
         if (strlen($this->p4) == 0 || $this->p4 == 0) {
            $this->p4 = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
         }
         $this->curdate_ds = $this->p4;
      }
   }

   /**
    * Initialise private variables
    */
   function initPrivateVars() {
      global $pref;

      // Dates
      $this->today_arr           = getdate();
      $this->today_day_num       = $this->today_arr['mday'];
      $this->today_month_num     = $this->today_arr['mon'];
      $this->today_month_txt     = $this->today_arr['month'];

      $this->today_ds            = mktime(0, 0, 0, $this->getTodayMonthNum(), $this->getTodayDayNum(), $this->getTodayYearNum());
      $this->tomorrow_ds         = mktime(0, 0, 0, $this->getTodayMonthNum(), $this->getTodayDayNum()+1, $this->getTodayYearNum());
      $this->today_monthstart_ds = mktime(0, 0, 0, $this->getTodayMonthNum(), 1, $this->getTodayYearNum());
      $this->today_monthend_ds   = mktime(0, 0, 0, $this->getTodayMonthNum()+1, 1, $this->getTodayYearNum()) - 1;
      $this->today_firstday_arr  = getdate($this->getTodayMonthStartDS());
      $this->today_lastday_arr   = getdate($this->getTodayMonthEndDS());
      $this->today_monthstart_ds = mktime(0, 0, 0, $this->getTodayMonthNum(), 1, $this->getTodayYearNum());
      $this->today_monthend_ds   = mktime(0, 0, 0, $this->getTodayMonthNum()+1, 1, $this->getTodayYearNum()) - 1;
      $this->today_weekstart_ds  = $this->getTodayDS();
      // Make sure we can get out of the next loop if preferences not correctly set
      if (!isset($pref['agenda_week_start'])) {
         $pref['agenda_week_start'] = "1";
         save_prefs();
      }
      while (date("w", $this->today_weekstart_ds) != $pref['agenda_week_start']) {
         $this->today_weekstart_ds  = $this->today_weekstart_ds - $this->getOneDay();
      }

      $this->curdate_txt         = date("d-m-Y", $this->getDateDS());
      $this->curmonth_ds         = mktime(0, 0, 0, date('m', $this->getDateDS()), 0, date('Y', $this->getDateDS()));
      $this->curyear_ds          = mktime(0, 0, 0, 0, 0, date('Y', $this->getDateDS()));
      $this->nextday_ds          = mktime(0, 0, 0, 0, date('d', $this->getDateDS())+1, 0);
      $this->nextmonth_ds        = mktime(0, 0, 0, date('m', $this->getDateDS())+1, 0, date('Y', $this->getDateDS()));
      $this->nextyear_ds         = mktime(0, 0, 0, 0, 0, date("Y", $this->getDateDS())+1);
      $this->nextdate_ds         = $this->getDateDS() + $this->getOneDay();
      $this->curweekstart_ds     = $this->getDateDS();
      while (date("w", $this->curweekstart_ds) != $pref['agenda_week_start']) {
         $this->curweekstart_ds  = $this->curweekstart_ds - $this->getOneDay();
      }
      $this->curmonthstart_ds    = mktime(0, 0, 0, $this->getMonthNum(), 1, $this->getYearNum());

      $this->table_join = "
         select * from ".MPREFIX.$this->getAgendaTable()." as e
            left join ".MPREFIX.$this->getCategoryTable()." as c on e.agn_category = c.cat_id
            left join ".MPREFIX.$this->getTypeTable()." as t on e.agn_type = t.typ_id
            left join ".MPREFIX.$this->getRegTable()." as r on e.agn_question = r.reg_id ";
      /// e107 0.7 $table_join  = "
      /// e107 0.7    select * from #".$this->getAgendaTable()." as e
      /// e107 0.7        left join #".$this->getCategoryTable()." as c on e.agn_category = c.cat_id
      /// e107 0.7        left join #".$this->getTypeTable()." as t on e.agn_type = t.typ_id ";

      $this->filter = "";

      if (class_exists("DHTML_Calendar")) {
         $this->dhtmlcalendar = new DHTML_Calendar(false);
      } else {
         $this->dhtmlcalendar = false;
      }
   }

   /**
    * Initialise private arrays
    */
   function initPrivateArrays() {
      global $pref;

      $this->days_arr = array(AGENDA_LAN_07, AGENDA_LAN_01, AGENDA_LAN_02, AGENDA_LAN_03, AGENDA_LAN_04, AGENDA_LAN_05, AGENDA_LAN_06);
      if ($pref["agenda_week_start"] == 1) {
         array_push($this->days_arr, AGENDA_LAN_07);
         array_shift($this->days_arr);
      }

      $this->months_arr = array(
         AGENDA_LAN_08,
         AGENDA_LAN_09,
         AGENDA_LAN_10,
         AGENDA_LAN_11,
         AGENDA_LAN_12,
         AGENDA_LAN_13,
         AGENDA_LAN_14,
         AGENDA_LAN_15,
         AGENDA_LAN_16,
         AGENDA_LAN_17,
         AGENDA_LAN_18,
         AGENDA_LAN_19
      );
      $this->diary_codes_arr = array(
         array("D:".AGENDA_LAN_51,
               "W:".AGENDA_LAN_52,
               "M:".AGENDA_LAN_53,
               "N:".AGENDA_LAN_54,
               "T:".AGENDA_LAN_55,
               "Q:".AGENDA_LAN_56,
               "F:".AGENDA_LAN_57,
               "H:".AGENDA_LAN_58,
               "Y:".AGENDA_LAN_59,
         ),
         array("W;1:".AGENDA_LAN_01,
               "W;2:".AGENDA_LAN_02,
               "W;3:".AGENDA_LAN_03,
               "W;4:".AGENDA_LAN_04,
               "W;5:".AGENDA_LAN_05,
               "W;6:".AGENDA_LAN_06,
               "W;0:".AGENDA_LAN_07,
               "N;1:".AGENDA_LAN_70,
               "N;2:".AGENDA_LAN_71,
               "N;3:".AGENDA_LAN_72,
               "N;0:".AGENDA_LAN_73,
               "M; :[date]",
               "T;1:".AGENDA_LAN_08.",".AGENDA_LAN_10.",".AGENDA_LAN_12.",".AGENDA_LAN_46,
               "T;0:".AGENDA_LAN_09.",".AGENDA_LAN_11.",".AGENDA_LAN_13.",".AGENDA_LAN_46,
               "Q;1:".AGENDA_LAN_08.",".AGENDA_LAN_11.",".AGENDA_LAN_14.",".AGENDA_LAN_17,
               "Q;2:".AGENDA_LAN_09.",".AGENDA_LAN_12.",".AGENDA_LAN_15.",".AGENDA_LAN_18,
               "Q;0:".AGENDA_LAN_10.",".AGENDA_LAN_13.",".AGENDA_LAN_16.",".AGENDA_LAN_19,
               "F;1:".AGENDA_LAN_08.",".AGENDA_LAN_12.",".AGENDA_LAN_16,
               "F;2:".AGENDA_LAN_09.",".AGENDA_LAN_13.",".AGENDA_LAN_17,
               "F;3:".AGENDA_LAN_10.",".AGENDA_LAN_14.",".AGENDA_LAN_18,
               "F;0:".AGENDA_LAN_11.",".AGENDA_LAN_15.",".AGENDA_LAN_19,
               "H;1:".AGENDA_LAN_08.",".AGENDA_LAN_14,
               "H;2:".AGENDA_LAN_09.",".AGENDA_LAN_15,
               "H;3:".AGENDA_LAN_10.",".AGENDA_LAN_16,
               "H;4:".AGENDA_LAN_11.",".AGENDA_LAN_17,
               "H;5:".AGENDA_LAN_12.",".AGENDA_LAN_18,
               "H;0:".AGENDA_LAN_13.",".AGENDA_LAN_19,
               "Y;1:".AGENDA_LAN_08,
               "Y;2:".AGENDA_LAN_09,
               "Y;3:".AGENDA_LAN_10,
               "Y;4:".AGENDA_LAN_11,
               "Y;5:".AGENDA_LAN_12,
               "Y;6:".AGENDA_LAN_13,
               "Y;7:".AGENDA_LAN_14,
               "Y;8:".AGENDA_LAN_15,
               "Y;9:".AGENDA_LAN_16,
               "Y;A:".AGENDA_LAN_17,
               "Y;B:".AGENDA_LAN_18,
               "Y;C:".AGENDA_LAN_19
         ),
         array("N1;1:".AGENDA_LAN_01,
               "N1;2:".AGENDA_LAN_02,
               "N1;3:".AGENDA_LAN_03,
               "N1;4:".AGENDA_LAN_04,
               "N1;5:".AGENDA_LAN_05,
               "N1;6:".AGENDA_LAN_06,
               "N1;0:".AGENDA_LAN_07,
               "N2;1:".AGENDA_LAN_01,
               "N2;2:".AGENDA_LAN_02,
               "N2;3:".AGENDA_LAN_03,
               "N2;4:".AGENDA_LAN_04,
               "N2;5:".AGENDA_LAN_05,
               "N2;6:".AGENDA_LAN_06,
               "N2;0:".AGENDA_LAN_07,
               "N3;1:".AGENDA_LAN_01,
               "N3;2:".AGENDA_LAN_02,
               "N3;3:".AGENDA_LAN_03,
               "N3;4:".AGENDA_LAN_04,
               "N3;5:".AGENDA_LAN_05,
               "N3;6:".AGENDA_LAN_06,
               "N3;0:".AGENDA_LAN_07,
               "N0;1:".AGENDA_LAN_01,
               "N0;2:".AGENDA_LAN_02,
               "N0;3:".AGENDA_LAN_03,
               "N0;4:".AGENDA_LAN_04,
               "N0;5:".AGENDA_LAN_05,
               "N0;6:".AGENDA_LAN_06,
               "N0;0:".AGENDA_LAN_07,
               "T1; :[date]",
               "T0; :[date]",
               "Q1; :[date]",
               "Q2; :[date]",
               "Q3; :[date]",
               "Q0; :[date]",
               "F1; :[date]",
               "F2; :[date]",
               "F0; :[date]",
               "H1; :[date]",
               "H2; :[date]",
               "H3; :[date]",
               "H4; :[date]",
               "H5; :[date]",
               "H0; :[date]",
               "Y1; :[date]",
               "Y2; :[date]",
               "Y3; :[date]",
               "Y4; :[date]",
               "Y5; :[date]",
               "Y6; :[date]",
               "Y7; :[date]",
               "Y8; :[date]",
               "Y9; :[date]",
               "YA; :[date]",
               "YB; :[date]",
               "YC; :[date]"
         )
      );
   }

   function initPrivateLists() {
      global $pref;

      $this->views       = USER ? "11:".AGENDA_LAN_VIEW_11."," : "";
      $this->views       .= "0:".AGENDA_LAN_VIEW_00
                          .",5:".AGENDA_LAN_VIEW_05
                          .",1:".AGENDA_LAN_VIEW_01
                          .",2:".AGENDA_LAN_VIEW_02
                          .",3:".AGENDA_LAN_VIEW_03
                          .",7:".str_replace("@@@@@", $pref['agenda_multiple_weeks'], AGENDA_LAN_VIEW_07)
                          .",4:".AGENDA_LAN_VIEW_04
                          .",6:".AGENDA_LAN_VIEW_06
                          //.",8:".AGENDA_LAN_VIEW_08
                          //.",9:".AGENDA_LAN_VIEW_09
                          .",10:".AGENDA_LAN_VIEW_10
                          ;
      $this->recur_codes  = "D:".AGENDA_LAN_RECUR_00
                          .",W:".AGENDA_LAN_RECUR_01
                          .",M:".AGENDA_LAN_RECUR_02
                          .",Q:".AGENDA_LAN_RECUR_03
                          .",Y:".AGENDA_LAN_RECUR_04
                          ;

      $sql = new e107HelperDB();
      $sql->select($this->getTypeTable(), "*", " order by typ_name asc", "no-where", $this->isDebug());
      $this->types = ":[select]";
      $comma = "";
      while ($agn_trow = $sql->db_Fetch()) {
         extract($agn_trow, EXTR_OVERWRITE);
         // Only add types that the current user can create entries for
         if (check_class($typ_user) || check_class($typ_admin)) {
            $this->types        .= ",$typ_id:$typ_name";
            $this->filter_types .= "$comma$typ_id:$typ_name";
            $comma = ",";
         }
      }

      $sql->select($this->getCategoryTable(), "*", " order by cat_name asc", "no-where", $this->isDebug());
      $this->categories = array();
      while ($row = $sql->db_Fetch()) {
         extract($row, EXTR_OVERWRITE);
         if (check_class($cat_visibility)) {
            $this->categories[] = "$cat_id:$cat_name";
         }
      }
      $this->categories = implode(",", $this->categories);
			 
      //$sql->select($this->getAgendaTable(), "DISTINCT agn_owner", " agn_owner<>'' order by agn_owner asc", true, $this->isDebug());  ISSUE?
      $sql->select($this->getAgendaTable(), "DISTINCT agn_owner", " WHERE agn_owner<>'' order by agn_owner asc", true, $this->isDebug());
      $this->owners = "";
      if ($agn_row = $sql->db_Fetch()) {
         extract($agn_row, EXTR_OVERWRITE);
         $this->owners .= "$agn_owner";
         while ($agn_row = $sql->db_Fetch()) {
            extract($agn_row, EXTR_OVERWRITE);
            $this->owners .= ",$agn_owner";
         }
      }

      $sql->select($this->getRegTable(), "*", " order by reg_question asc", "no-where", $this->isDebug());
      $this->questions = "";
      if ($agn_row = $sql->db_Fetch()) {
         extract($agn_row, EXTR_OVERWRITE);
         $this->questions .= "$reg_id:$reg_question";
         while ($agn_row = $sql->db_Fetch()) {
            extract($agn_row, EXTR_OVERWRITE);
            $this->questions .= ",$reg_id:$reg_question";
         }
      }
   }

   function initEvents() {
//      $sql = new db();
//      $this->events = array();
//      $entries = $sql->select_gen($this->getSQL2($this->getTodayMonthStartDS(), $this->getTodayMonthEndDS(), $this->getFilter()), $this->isDebug());
//      while ($row = $sql->db_Fetch()) {
//         extract($row);
//         $key = mktime(0,0,0, date("m", $agn_start), date("d", $agn_start), date("Y", $agn_start));
//         $this->events[$key][] = $row;
//      }
   }

   function getEvent($ds, $ix=0) {
      $this->cacheEvents($ds);
      if (isset($this->eventCache[$ds][$ix])) {
         return $this->eventCache[$ds][$ix];
      } else {
         return false;
      }
   }

   function countEvents($ds) {
      $this->cacheEvents($ds);
      // Subtract 1 to discount the cached flag element
      return $this->eventCache[$ds] == 0 ? 0 : count($this->eventCache[$ds])-1;
   }

   function hasTimed($ds) {
      $ix = 0;
      while ($event = $this->getEvent($ds, $ix++)) {
         if ($event->isTimed()) {
            return true;
         }
      }
      return false;
   }

   function hasUntimed($ds) {
      $ix = 0;
      while ($event = $this->getEvent($ds, $ix++)) {
         if ($event->isUntimed()) {
            return true;
         }
      }
      return false;
   }

   function cacheEvents($ds) {
      // Make sure datestamp does not include time
      $ds = mktime(0,0,0, date("m", $ds), date("d", $ds), date("Y", $ds));

      if ($this->eventCache[$ds]["cached"]) {
         // Entries already cached so just return
         return;
      }

      // Get entries for current datestamp
      $sql = new e107HelperDB();
      $qry = $this->getSQL($ds);
      $qry .= "order by e.agn_start asc, e.agn_priority asc";
      if ($sql->db_Select_gen($qry, $this->isDebug())) {
         while ($row = $sql->db_Fetch()) {
            // Only add event to cache if current user can view this category
            $event = new AgendaEvent($row);
            if (check_class($event->getCatVisibility())) {
               $this->eventCache[$ds][] = $event;
            }
         }
      }
      $this->eventCache[$ds]["cached"] = 1;//true;
   }

   function getNumberOfEntries($day_ds) {
      return count($this->events[$day_ds]);
   }

   /**
    * Calculates all of the diary codes that occur between the supplied dates
    * @param   int      the start datestamp to calculate diary codes for
    * @param   int      the end datestamp to calculate diary codes for
    * @return  string   comma separated list of diary codes that occur on the supplied date
    */
   function getDiaryCodes($start_ds, $end_ds=0) {
      $end_ds = $end_ds == 0 ? $start_ds : $end_ds;
      $daycount = 0;
      $date_ds = mktime(0,0,0, date("m", $start_ds), date("d", $start_ds), date("Y", $start_ds));
      $diaryCodes = array("''");
      while ($date_ds <= $end_ds) {
         $date = getdate($date_ds);

         // Fix/add some values in/to the array for our purpose
         $date["mday"] = str_pad($date["mday"], 2, "0", STR_PAD_LEFT);
         $date["week_in_month"] = ceil($date["mday"] / 7);
         // Fix for Monthly by day "every 4th ?" diary codes
         if ($date["week_in_month"] == 4) {
            $date["week_in_month"] = 0;
         }

         for ($i=0; $i<count($this->diary_codes_arr[0]); $i++) {
            $tmp = explode(":", $this->diary_codes_arr[0][$i]);

            switch ($tmp[0]) {
               case "D" :
                  // Daily - valid on any day
                  $diaryCodes[] = "'".$tmp[0]."'";
                  break;
               case "W" :
                  // Weekly
                  $diaryCodes[] = "'".$tmp[0].$date["wday"]."'";
                  break;
               case "M" :
                  // Monthly by date, *** need to think about e.g. M31 when date is 30th, etc.
                  $diaryCodes[] = "'".$tmp[0].$date["mday"]."'";
                  break;
               case "N" :
                  // Monthly by day in week
                  $diaryCodes[] = "'".$tmp[0].$date["week_in_month"].$date["wday"]."'";
                  break;
               case "T" :
                  // Two monthly, e.g. T1xx
                  $diaryCodes[] = "'".$tmp[0].($date["mon"] % 2).$date["mday"]."'";
                  break;
               case "Q" :
                  // Quarterly, e.g. Q1xx
                  $diaryCodes[] = "'".$tmp[0].($date["mon"] % 3).$date["mday"]."'";
                  break;
               case "F" :
                  // Four monthly, e.gF Q1xx
                  $diaryCodes[] = "'".$tmp[0].($date["mon"] % 4).$date["mday"]."'";
                  break;
               case "H" :
                  // Half yearly, e.g. H1xx
                  $diaryCodes[] = "'".$tmp[0].($date["mon"] % 6).$date["mday"]."'";
                  break;
               case "Y" :
                  // Yearly (Annually), e.g. Y1xx, note months > 9 represented by A, B, C
                  $diaryCodes[] = "'".$tmp[0].strtoupper(dechex($date["mon"])).$date["mday"]."'";
                  break;
               default :
                  // Ignore unknown diary codes
            }
         }
         $daycount++;
         $date_ds = mktime(0,0,0, date("m", $start_ds), date("d", $start_ds)+$daycount, date("Y", $start_ds));
      }
      //print "<br>Diary codes for ".date("d-M-Y", $start_ds)." to ".date("d-M-Y", $end_ds)." are: ".implode(", ", $diaryCodes)."<br><br>";
      return implode(", ", $diaryCodes);
   }

   function getDiaryCodeDescription($dc) {
      $desc = "";
      $c1 = substr($dc, 0, 1);
      $c2 = substr($dc, 1, 1);
      $c3 = substr($dc, 2, 1);
      for ($i=0; $i<count($this->diary_codes_arr[0]); $i++) {
         if ($c1 == substr($this->diary_codes_arr[0][$i], 0, 1)) {
            $desc .= substr($this->diary_codes_arr[0][$i], 2);
            break;
         }
      }
      for ($i=0; $i<count($this->diary_codes_arr[1]); $i++) {
         if ($c1 == substr($this->diary_codes_arr[1][$i], 0, 1)) {
            for ($j=$i; $j<count($this->diary_codes_arr[1]); $j++) {
               if ($c2 == substr($this->diary_codes_arr[1][$j], 2, 1)) {
                  $desc .= " ".substr($this->diary_codes_arr[1][$j], 4);
                  break 2;
               }
            }
         }
      }
      for ($i=0; $i<count($this->diary_codes_arr[2]); $i++) {
         if ($c1.$c2 == substr($this->diary_codes_arr[2][$i], 0, 2)) {
            for ($j=$i; $j<count($this->diary_codes_arr[2]); $j++) {
               if ($c3 == substr($this->diary_codes_arr[2][$j], 3, 1)) {
                  $desc .= " ".substr($this->diary_codes_arr[2][$j], 5);
                  break 2;
               }
            }
         }
      }

      return $desc;
   }

   /**
    * Generate the JavaScript to decalre the diary codes array
    */
   function getDiaryCodesJS() {
      $script = "<script type='text/javascript'>
      <!--
      var agendaDiaryCodes = new Array(";
      for ($i=0; $i<count($this->diary_codes_arr); $i++) {
         $script .= "new Array(";
         for ($j=0; $j<count($this->diary_codes_arr[$i]); $j++) {
            $script .= "'".$this->diary_codes_arr[$i][$j]."'";
            $script .= $j < count($this->diary_codes_arr[$i]) - 1 ? ", " : "";
         }
         $script .= $i < count($this->diary_codes_arr) - 1 ? "), " : ")";
      }
      return $script;
   }

   /**
    * Generate the SQL required to get all events for a day
    */
   function getSQL($viewdate_ds, $timed="", $incfilter=true) {
      global $pref;

      $viewenddate_ds = $viewdate_ds + $this->getOneDay();

      // Start of query
      $qry = $this->getTableJoin() ."WHERE ";

      // Now add in normal and recurring events
      $qry .= "agn_diary_code in (".$this->getDiaryCodes($viewdate_ds).") and ";

      // Are we after timed events?
      if (strlen($timed) > 0) {
         $qry .= "t.typ_timed=$timed and ";
      }
      // Public entries or private and author/admin logged on
      if (!ADMIN) {
         if ($pref["agenda_private_calendar"] == "Y") {
            $qry .= "(e.agn_author='".USERID.".".USERNAME."') and ";
         } else {
            $qry .= "(e.agn_private=0 or (e.agn_private=1 and (e.agn_author='".USERNAME."' or e.agn_author='".USERID.".".USERNAME."'))) and ";
         }
      }

      // Non-floating events
      $qry .= "((e.agn_start>=$viewdate_ds and e.agn_start<$viewenddate_ds and t.typ_floating=0) "; // for current day
      $qry .= " or (e.agn_start<=$viewdate_ds and (e.agn_end>=$viewdate_ds or e.agn_end=-1) and t.typ_floating=0 and agn_diary_code != '') ";  // spanning more than one day but falls in to current day

      // Floating events...
      $qry .= "or (t.typ_floating=1 and (";
      // ...complete on current day
      $qry .= "(e.agn_complete=1 and (e.agn_end>=$viewdate_ds or e.agn_end=-1) and e.agn_end<$viewenddate_ds)";
      if ($viewdate_ds == $this->getTodayDS()) {
         // ...incomplete and starting on or before current day
         $qry .= " or (e.agn_complete=0 and e.agn_start<$viewenddate_ds)";
      } else if ($viewdate_ds > $this->getTodayDS()) {
         // ...incomplete, starting on current day and current day is in the future
         $qry .= " or (e.agn_complete=0 and e.agn_start>=$viewdate_ds and e.agn_start<$viewenddate_ds)";
      }
      $qry .= "))) ";

      //print "<br>$qry<br>";
      return $qry;
   }

   /**
    * Generate the SQL required to get all events for a date range
    */
   function getSQL2($start_ds, $end_ds, $timed="", $incfilter=true) {
      global $pref;

      // Start of query
      $qry = $this->getTableJoin() ."WHERE ";

      // Now add in normal and recurring events
      $qry .= "agn_diary_code in (".$this->getDiaryCodes($start_ds, $end_ds).") and ";

      // Are we after timed events?
      if (strlen($timed) > 0) {
         $qry .= "t.typ_timed=$timed and ";
      }
      // Public entries or private and author/admin logged on
      if (!ADMIN) {
         if ($pref["agenda_private_calendar"] == "Y") {
            $qry .= "(e.agn_author='".USERID.".".USERNAME."') and ";
         } else {
            $qry .= "(e.agn_private=0 or (e.agn_private=1 and e.agn_author='".USERNAME."')) and ";
         }
      }

      // Non-floating events
      $qry .= "((e.agn_start>=$start_ds and e.agn_start<=$end_ds and t.typ_floating=0) "; // for current day
      $qry .= " or (e.agn_start<=$start_ds and (e.agn_end>=$start_ds or e.agn_end=-1) and t.typ_floating=0 and agn_diary_code != '') ";  // spanning more than one day but falls in to current day

      // Floating events...
      $qry .= "or (t.typ_floating=1 and (";
      // ...complete on current day
      $qry .= "(e.agn_complete=1 and (e.agn_end>=$start_ds or e.agn_end=-1) and e.agn_end<$end_ds)";
      if ($viewdate_ds == $this->getTodayDS()) {
         // ...incomplete and starting on or before current day
         $qry .= " or (e.agn_complete=0 and e.agn_start<$end_ds)";
      } else if ($viewdate_ds > $this->getTodayDS()) {
         // ...incomplete, starting on current day and current day is in the future
         $qry .= " or (e.agn_complete=0 and e.agn_start>=$start_ds and e.agn_start<$end_ds)";
      }
      $qry .= "))) ";

//      if ($incfilter) {
//         $qry .= $this->getFilter();
//      }

      print "<br>$qry<br>";
      return $qry;
   }

   /**
    * Get a date stamp (no time) for a specific date
    * Use this instead of adding multiple seconds to a date as it takes in to account daylight saving
    * @param $m month number
    * @param $d day number
    * @param $y year number
    * @returns datestamp for a specific day (time will be  00:00.00)
    */
   function getDateAsDS($m,$d,$y) {
      return mktime(0,0,0,date($m), date($d), date($y));
   }

   function getOneDay() {
      return $this->_ONEDAY;
   }
   function getOneWeek() {
      return $this->_ONEWEEK;
   }
   function getFilename() {
      return $this->_FILENAME;
   }
   function getPathToAgenda() {
      return $this->_DIRECTORY.$this->_FILENAME;
   }

   function getTodayDS() {
      return $this->today_ds;
   }
   function getTodayDayNum() {
      return $this->today_arr['mday'];
   }
   function getTodayWeekStartDS() {
      return $this->today_weekstart_ds;
   }
   function getTodayMonthNum() {
      return $this->today_arr['mon'];
   }
   function getTodayMonthName() {
      return $this->months_arr[$this->getTodayMonthNum()-1];
   }
   function getTodayMonthStartDS() {
      return $this->today_monthstart_ds;
   }
   function getTodayMonthEndDS() {
      return $this->today_monthend_ds;
   }
   function getTodayYearNum() {
      return $this->today_arr['year'];
   }
   function getTodayMonthNameAndYearNum() {
      return $this->getTodayMonthName()."&nbsp;".$this->getTodayYearNum();
   }

   function getDateDS() {
      return $this->curdate_ds;
   }
   function getDateTxt() {
      return $this->curdate_txt;
   }
   function getDateNum() {
      return date("d", $this->getDateDS());
   }
   function getWeekNum() {
      return date("W", $this->getDateDS());
      return $this->curweek_num;
   }
   function getWeekStartDS() {
      return $this->curweekstart_ds;
   }
   function getMonthDS() {
      return $this->curmonth_ds;
   }
   function getMonthStartDS() {
      return $this->curmonthstart_ds;
   }
   function getMonthNum() {
      return date("m", $this->getDateDS());
   }
   function getYearNum() {
      return date("Y", $this->getDateDS());
   }

   function getAgendaTable() {
      return $this->_AGENDA_TABLE;
   }
   function getCategoryTable() {
      return $this->_CATEGORY_TABLE;
   }
   function getSubsTable() {
      return $this->_SUBS_TABLE;
   }
   function getRegTable() {
      return $this->_REG_TABLE;
   }
   function getTypeTable() {
      return $this->_TYPE_TABLE;
   }
   function getUserTable() {
      return $this->_USER_TABLE;
   }

   function getDays() {
      return $this->days_arr;
   }

   function getP1() {
      return $this->p1;
   }

   function getP2() {
      return $this->p2;
   }

   function getP3() {
      return $this->p3;
   }

   function getP4() {
      return $this->p4;
   }

   function getP5() {
      return $this->p5;
   }

   function getFilter() {
      return $this->filter;
   }

   function getDayName($ds, $full=false) {
      global $pref;

      $daynum = date("w", $ds);
      if ($pref["agenda_week_start"] == 1) {
         $daynum--;
         if ($daynum < 0) {
            $daynum = 6;
         }
      }
      if ($full) {
         return $this->days_arr[$daynum];
      } else {
         return substr($this->days_arr[$daynum], 0, $pref["agenda_dayname_length"]);
      }
   }

   function getMonthName($ds, $full=false) {
      global $pref;
      $monthnum = date("n", $ds) - 1;
      if ($full) {
         return $this->months_arr[$monthnum];
      } else {
         return substr($this->months_arr[$monthnum], 0, $pref["agenda_dayname_length"]);
      }
   }

   function getMonthNameFromNum($monthnum, $full=false) {
      global $pref;
      if ($full) {
         return $this->months_arr[$monthnum];
      } else {
         return substr($this->months_arr[$monthnum], 0, $pref["agenda_dayname_length"]);
      }
   }

   /**
    * Returns the offset from the start of the week of the first day of the current or supplied month
    */
   function getMonthFirstDayOffset($ds=0) {
      global $pref;

      if (0==$ds) {
         $ds_arr = getdate($this->getMonthStartDS());
      } else {
         $ds_arr = getdate($ds);
      }

    if ($pref['agenda_week_start'] == 1) {
         return ($ds_arr['wday'] == 0 ? 6 : $ds_arr['wday']-1);
      } else {
         return $ds_arr['wday'];
      }
   }

   function getViewsList() {
      return $this->views;
   }

   function getRecurCodesList() {
      return $this->recur_codes;
   }

   function getTypesList() {
      return $this->types;
   }

   function getFilterTypesList() {
      return $this->filter_types;
   }

   function getCategoriesList() {
      return $this->categories;
   }

   function getOwnersList() {
      return $this->owners;
   }

   function getRegQuestions() {
      return $this->questions;
   }

   function getTableJoin() {
      return $this->table_join;
   }

   function setP1($new) {
      $this->p1 = $new;
   }

   function setP3($new) {
      $this->p3 = $new;
   }

   function setFilter($new) {
      $this->filter = $new;
   }

   // Agenda preferences
   function getPrefHeaderCSS() {
      global $pref;
      return $pref['agenda_header_css'];
   }
   function getPrefDayCSS() {
      global $pref;
      return $pref['agenda_day_css'];
   }
   function getPrefTodayCSS() {
      global $pref;
      return $pref['agenda_today_css'];
   }
   function getPrefDayWithEntriesCSS() {
      global $pref;
      return $pref['agenda_day_with_entries_css'];
   }

   function getDhtmlCalendar() {
      return $this->dhtmlcalendar;
   }

   function isDhtmlCalendar() {
      if ($this->dhtmlcalendar) {
         return true;
      }
      return false;
   }

   function isFiltered($row) {
      extract($row);
      $filter = $this->getFilter();
      $x = eval("if (true $filter) return false; else return true;");
      return $x;
   }

   function isFilterOn() {
      global $currentUser;

      if (!isset($this->usr_filter_state)) {
         $this->usr_filter_state = false;
         $sql = new db();
         $sql->select($this->getUserTable(), "*", " WHERE usr_id=".$currentUser["user_id"], true, $this->isDebug());
         if ($row = $sql->db_Fetch()) {
            extract($row, EXTR_OVERWRITE);
            $this->usr_filter_state = $usr_filter_state==1 ? true : false;
         }
      }
      return $this->usr_filter_state;
   }

   function isPrint() {
      return $this->print;
   }

   function getRegistrationUserResponses($id, $displayNone=false) {
      $sql = new e107HelperDB();

      $agn_responses = array();
      $sql->select($this->getAgendaTable(), "agn_question, agn_responses", " WHERE agn_id=$id", true, $this->isDebug());
      $row = $sql->db_Fetch();

      if (strlen($row["agn_responses"])) {
         $agn_responses = explode(",", $row["agn_responses"]);
      }

      $sql->select($this->getRegTable(), "reg_answers", " WHERE reg_id=".$row["agn_question"], true, $this->isDebug());
      $row = $sql->db_Fetch();
      $reg_answers = explode("\n", $row["reg_answers"]);

      $count = 0;
      for ($i=0; $i<count($agn_responses); $i++) {
         $tmp = explode("=", $agn_responses[$i]);
         $sql->select("user", "*", " WHERE user_id=".$tmp[0], true, $this->isDebug());
         if ($row = $sql->db_Fetch()) {
            // Increment count of number of responses and get user link
            $_userresponse[$reg_answers[$tmp[1]]]["count"]++;
            // Add deregister link if admin user
            $unsubscribe = ADMIN ? "&nbsp;&nbsp;<span title='".AGENDA_LAN_158."' style='cursor:pointer;' onclick='if (jsconfirm(\"".AGENDA_LAN_157."\")) agendaDeregister(".$row['user_id'].");'/>x</span>" : "";
            // Add user link to array
            $_userresponse[$reg_answers[$tmp[1]]]["users"][] = "<a href='".e_BASE."user.php?id.".$row['user_id']."'>".$row['user_name']."</a>".$unsubscribe;
            $count++;
         }
      }

      $display = $displayNone ? "none" : "inline";
      $userresponses = "<span class='smalltext' style='cursor: pointer;' onclick='expandit(\"responses_span\")'>".$count;
      $userresponses .= $count==1 ? AGENDA_LAN_130 : AGENDA_LAN_131;
      if (USER) {
         $userresponses .= " (".AGENDA_LAN_132.")</span><span id='responses_span' class='smalltext' style='display:$display;'>";
         $keys = array_keys($_userresponse);
         foreach ($keys as $key) {
            $userresponses .= "<br/> ".$_userresponse[$key]["count"]." $key (".implode(", ", $_userresponse[$key]["users"]).")";
         }
      }
      $userresponses .= "</span>";

      return $userresponses;
   }

   function persViewFilter() {
      global $e107Helper, $agn_field, $agn_filter_fields;
      $sql = new e107HelperDB();

      $rs = new agenda_form;
      $filter = array();
      $sql->select($this->getUserTable(), "*", " WHERE usr_id=".USERID, true, $this->isDebug());
      if ($row = $sql->db_Fetch()) {
         extract($row);
         $filters = explode(";", $usr_filter);
         for ($i=0; $i<count($filters); $i++) {
            $tmp = explode(":", $filters[$i]);
            $filter[$tmp[0]] = $tmp[1];
         }
      }

      for ($i=0; $i<count($agn_filter_fields); $i++) {
         $rows[] = agendaDrawFormRow($rs, $agn_field[$agn_filter_fields[$i]], $filter[$agn_filter_fields[$i]]);
      }

      $rows[] = "<tr style='vertical-align:top'><td colspan='3' style='text-align:center' class='".$this->getPrefTodayCSS()."'>
               <input class='button' type='button' name='setfilter' value='".AGENDA_LAN_45."' onclick='agendaFilter(event);'/></td></tr>";

      return $this->persViewRenderSection("agendaPersViewFilter", AGENDA_LAN_141, $rows);
   }

   function persViewRegistrations() {
      global $e107Helper;
      $sql = new e107HelperDB();
      $qry = $this->getTableJoin()."where agn_responses regexp '^1=' or agn_responses regexp ',1='";
      if ($sql->db_Select_gen($qry, $this->isDebug())) {
         while ($row = $sql->db_Fetch()) {
            $event = new AgendaEvent($row);
            $responses = explode(",", $event->getAgnResponses());
            foreach ($responses as $response) {
               $response = explode("=", $response);
               $answers = explode("\n", $event->getRegAnswers());
               $myresponse = $event->getRegQuestion()." ".$answers[$response[1]];
            }
            $temp = "<tr><td class='".$this->getPrefTodayCSS()."'>".$event->drawLink();
            $temp = substr($temp, 0, strlen($temp)-7)."$myresponse</span></td></tr>";
            $rows[] = $temp;
         }
      } else {
         $rows[] = mysqli_error();
      }

      return $this->persViewRenderSection("agendaPersViewRegistrations", AGENDA_LAN_142, $rows);
   }

   function persViewSubscriptions() {
      global $e107Helper;
      $sql = new e107HelperDB();

      $subs = array();
      $sql->select($this->getSubsTable(), "subs_cat", " WHERE subs_userid='".USERID."'", true, $this->isDebug());
      while ($row = $sql->db_Fetch()) {
         $subs[] = $row[0];
      }

      if ($sql->select($this->getCategoryTable(), "*", " WHERE cat_subs>0 and find_in_set(cat_class,'".$e107Helper->getUserClassList()."') order by cat_name asc", true, $this->isDebug())) {

         $optsubs = 0;
         $autosubs = 0;

         while ($row = $sql->db_Fetch()) {
            extract($row);
            $text = "<tr>";
            $text .= "<td class='".$this->getPrefTodayCSS()."' style='text-align:center;'>";
            $text .= "<img src='$cat_icon' border='0' align='middle' /></td>";
            $text .= "<td class='".$this->getPrefTodayCSS()."'>";
            if ($cat_subs == 1 || $cat_subs == 3) {
               $text .= "<input type='hidden' name='event_list[]' value='".$cat_id."' />";
               $text .= "<label for='agenda_event_sub".$cat_id."'>";
               $checked = in_array($cat_id, $subs) ? "checked='checked'" : "";
               $text .= "<input type='checkbox' class='tbox' value='1' id='agenda_event_sub".$cat_id."' name='agenda_event_sub[$cat_id]' ".$checked." />";
               if ($checked) {
                  $optsubs++;
               }
            }
            $text .= "$cat_name</label>";
            if ($cat_subs == 2 || $cat_subs == 4) {
               $text .= "<br /><span class='smalltext'>".AGENDA_LAN_117."</span>";
            }
            if ($cat_subs == 3 || $cat_subs == 4) {
               $text .= "<br /><span class='smalltext'>".AGENDA_LAN_126."</span>";
               $autosubs++;
            }
            $text .= "</td><td class='".$this->getPrefTodayCSS()."'>$cat_description";
            $text .= strlen($cat_description) ? " - " : "";
            if ($cat_notify == 0) {
               $text .= "<span class='smalltext'>".AGENDA_LAN_150."</span>";
            }
            elseif ($cat_notify == 1) {
               $text .= "<span class='smalltext'>".AGENDA_LAN_152."$cat_ahead".AGENDA_LAN_153."</span>";
            }
            elseif ($cat_notify == 2) {
               $text .= "<span class='smalltext'>".AGENDA_LAN_151."</span>";
            }
            elseif ($cat_notify == 3) {
               $text .= "<span class='smalltext'>".AGENDA_LAN_152."$cat_ahead".AGENDA_LAN_153."</span>";
            }
            $text .= "</td></tr>";
            $rows[] = $text;
         }
         $text = "<tr style='vertical-align:top'><td colspan='3' style='text-align:center' class='".$this->getPrefTodayCSS()."'>";
         $text .= "<input class='button' type='button' name='setsubs' value='".AGENDA_LAN_115."' onclick='agendaSubscriptions(event);'/></td></tr>";
         $rows[] = $text;

         $text = "";
         $text2 = "<div style='text-align:center'>";
         $text2 .= "<div class=''>";
         $text2 .= AGENDA_LAN_112." $optsubs ".AGENDA_LAN_113." $autosubs ".AGENDA_LAN_118;
         $text2 .= "</div>";
         $text2 .= "</div>";
         $text = str_replace("@@@@@", $text2, $text);
         $rows[] = $text;
      } else {
         $rows[] = "<tr><td class='".$this->getPrefTodayCSS()."' colspan='2'>" . AGENDA_LAN_114 . "</td></tr>";
      }

      return $this->persViewRenderSection("agendaPersViewSubscriptions", AGENDA_LAN_143, $rows);
   }

   function persViewSummary() {
      $sql = new e107HelperDB();
      $debug = false;

      if ($count = $sql->db_Count($this->getAgendaTable(), "(agn_id)", "WHERE SUBSTRING(agn_author,1,1)='".USERID."'", $debug)) {
         $totals[] = "<tr><td class='".$this->getPrefTodayCSS()."'>".AGENDA_LAN_146."</td><td class='".$this->getPrefTodayCSS()."' style='text-align:right;'>$count</td></tr>";
      } else {
         print $debug ? "<br>".mysqli_error()."<br>" : "";
      }

      if ($count = $sql->db_Count($this->getAgendaTable(), "(agn_id)", "WHERE agn_start>=".time()." AND SUBSTRING(agn_author,1,1)='".USERID."'", $debug)) {
         $totals[] = "<tr><td class='".$this->getPrefTodayCSS()."'>".AGENDA_LAN_147."</td><td class='".$this->getPrefTodayCSS()."' style='text-align:right;'>$count</td></tr>";
      } else {
         print $debug ? "<br>".mysqli_error()."<br>" : "";
      }

      if ($count = $sql->db_Count($this->getAgendaTable(), "(agn_id)", "WHERE agn_owner like'%".USERNAME."%'", $debug)) {
         $totals[] = "<tr><td class='".$this->getPrefTodayCSS()."'>".AGENDA_LAN_148."</td><td class='".$this->getPrefTodayCSS()."' style='text-align:right;'>$count</td></tr>";
      } else {
         print $debug ? "<br>".mysqli_error()."<br>" : "";
      }

      if ($count = $sql->db_Count($this->getAgendaTable(), "(agn_id)", "WHERE agn_start>=".time()." AND agn_owner like'%".USERNAME."%'", $debug)) {
         $totals[] = "<tr><td class='".$this->getPrefTodayCSS()."'>".AGENDA_LAN_149."</td><td class='".$this->getPrefTodayCSS()."' style='text-align:right;'>$count</td></tr>";
      } else {
         print $debug ? "<br>".mysqli_error()."<br>" : "";
      }

      return $this->persViewRenderSection("agendaPersViewSummary", AGENDA_LAN_144, $totals);
   }

   function persViewUpcoming() {
      global $e107Helper, $pref;
      $sql = new e107HelperDB();
      $limit = $pref['agenda_upcoming_events_limit'];

      $text = "";
      $day = 0;
      $curdate = "";
      while ($day < $limit) {
         $thisday = mktime(0,0,0, date("m", $this->getTodayMonthStartDS()), $this->getTodayDayNum()+$day, $this->getTodayYearNum());
         $ix = 0;
         while ($event = $this->getEvent($thisday, $ix++)) {
            if ($event->isForCurrentUser()) {
               $rows[] = "<tr><td class='".$this->getPrefTodayCSS()."'>".$event->drawLink(true, true, false, $thisday)."</td></tr>";
            }
         }
         $day++;
      }

      return $this->persViewRenderSection("agendaPersViewUpcoming", AGENDA_LAN_145, $rows);
   }

   function persViewRenderSection($id, $caption, $rows) {
      switch ($id) {
         case "agendaPersViewFilter" : {
            $display = "none";
            break;
         }
         default : {
            $display = "";
         }
      }
      $text = "<div id='$id' style='display:$display;'>";
      $text .= "<table width='100%'>";
      for ($i=0; $i<count($rows); $i++) {
         $text .= $rows[$i];
      }
      $text .= "</table>";
      $text .= "</div>";
      $tab = new e107Table();
      $caption = "<div style='cursor:pointer;' onclick='expandit(\"$id\");'>$caption</div>";
      $text = $tab->tablerender($caption, $text, "", true);
      return $text;
   }

   function isDebug() {
      global $pref;
      return isset($pref["agenda_debug"]) && $pref["agenda_debug"]=='Y' ? true : false;
   }
}

class AgendaEvent {
   var $row;
   function AgendaEvent($row) {
      $this->row = $row;
   }

   function getAgnId() {
      return $this->row['agn_id'];
   }
   function getAgnStart() {
      return $this->row['agn_start'];
   }
   function getAgnResponses() {
      return $this->row['agn_responses'];
   }
   function getAgnTitle() {
      return $this->row['agn_title'];
   }

   function getCatIcon($fullpath=false) {
      return $fullpath ? str_replace("../../".e_IMAGE, e_IMAGE_ABS, $this->row["cat_icon"]) : $this->row["cat_icon"];
   }
   function getCatVisibility() {
      return $this->row['cat_visibility'];
   }

   function getRegAnswers() {
      return $this->row['reg_answers'];
   }
   function getRegQuestion() {
      return $this->row['reg_question'];
   }

   function isForCurrentUser() {
      return substr($this->row['agn_author'],0,1) == USERID;
   }
   function isTimed() {
      return $this->row['typ_timed']==1;
   }
   function isUntimed() {
      return !$this->isTimed();
   }

   function drawLink($full=true, $withdate=false, $includeBreak=false, $useDate=0) {
      global $agenda, $agn_tooltip_styles, $pref, $e107Helper;

      extract($this->row, EXTR_OVERWRITE);

      // Assume we will be showing this item
      $text = "<span";
      if ($agenda->isFiltered($this->row)) {
         $text .= " id='agenda_entry_filter_$agn_id'";
         if ($agenda->isFilterOn()) {
            $text .= " style='display:none'";
         }
      } else {
         $text .= " id='agenda_entry_$agn_id'";
      }
      $text .= ">";
      $style = $agn_complete ? " style='text-decoration:line-through;'" : "";
      if ($pref["agenda_detailed_tooltips"] == "Y") {
         $tooltip = "<strong>$cat_name</strong>";
         if ($typ_timed && ($full || $pref["agenda_time_in_compact_views"] == "Y")) {
            $tooltip .= " (".agendaDrawStartEndTime($agn_start, $agn_end, true).")";
         }
         if (strlen($agn_location) > 0) {
            $tooltip .= "<br/><u>$agn_location</u>";
         }
         if (strlen($agn_owner) > 0) {
            $tooltip .= "<br/><em>".AGENDA_LAN_159." $agn_owner</em>";
         }
         $tooltip .= "<p>$agn_details</p>";
      } else {
         $tooltip = $agn_details;
      }

      if ($withdate) {
         if ($useDate>0) {
            $text .= date("d-m-Y", $useDate)." : "; // ."-".date("d-m-Y", $agn_end)." : ";
         } else {
            $text .= date("d-m-Y", $agn_start)." : "; // ."-".date("d-m-Y", $agn_end)." : ";
         }
      }

      if ($full || $pref["agenda_icons_in_compact_views"] == "Y") {
         if (strlen($cat_icon) > 0) {
            // Need to check user has authority to edit here
            $tmp = str_replace("../../".e_IMAGE, e_IMAGE_ABS, $cat_icon);
            $text .= "<a href='".e_SELF."?edit.".$agenda->getP2().".$agn_id.".$agenda->getDateDS()."'$style title=''>";
            $text .= "<img src='$tmp' alt='*' border='0' align='middle'";
            $text .= $e107Helper->getTooltip($tooltip, $agn_title, $agn_tooltip_styles);
            $text .= "/></a> ";
         }
      }

      if (!$agenda->isPrint()) {
         $text .= "<a href='".e_SELF."?viewitem.".$agenda->getP2().".$agn_id.".$agenda->getDateDS()."'$style title=''";
         $text .= ">";
      }

      $iconsize = getimagesize($tmp);
      if ($typ_timed && ($full || $pref["agenda_time_in_compact_views"] == "Y")) {
         $text .= agendaDrawStartEndTime($agn_start, $agn_end, $full);
         $text .= " ";
      }
      $title = $full || strlen($agn_title) <= $pref["agenda_short_title_length"] ? $agn_title : substr($agn_title, 0, $pref["agenda_short_title_length"])."...";
      $text .= $e107Helper->tp_toHTML($title);
      if ($agn_private == 1) {
         $text .= " <span class='smalltext'>(".AGENDA_LAN_156.")</span>";
      }
      if ($full && $agn_priority > 0) {
         $text .= " <span class='smalltext'>($agn_priority)</span>";
      }
      if ($full && strlen($agn_details) > 0) {
         $text .= "<br /><span class='smalltext' style='margin-left:".($iconsize[1]+6)."px;'>$agn_details</span>";
      }
      if ($full && strlen($agn_location) > 0) {
         $text .= "<br /><span class='smalltext' style='margin-left:".($iconsize[1]+6)."px;'>$agn_location</span>";
      }

      if (!$agenda->isPrint()) {
         $text .= "</a>";
      }

      //$text .= "&nbsp;<img src='images/delete_8.png' border='0' width='8px' height='8px'align='middle'>";

      $text .= "<br/></span>";
      return $text;
   }

   function toString() {
      $string = "class AgendaEvent : (id=".$this->getAgnId().") ";
      $string .= $this->getAgnTitle().", ";
      $string .= "<br/>";
      return $string;
   }
}

class AgendaField {
   var $label;
   var $prompt;
   var $name;
   var $type;
   var $value;
   var $mandatory;
   var $class;

   function AgendaField($label="", $prompt="", $name="", $type="", $value="", $mandatory="", $class="") {
      $this->setLabel($label);
      $this->setPrompt($prompt);
      $this->setName($name);
      $this->setType($type);
      $this->setValue($value);
      $this->setMandatory($mandatory);
      $this->setClass($class);
   }

   function setLabel($new) {
      $this->label = $new;
   }
   function setPrompt($new) {
      $this->prompt = $new;
   }
   function setName($new) {
      $this->name = $new;
   }
   function setType($new) {
      $this->type = $new;
   }
   function setValue($new) {
      $this->value = $new;
   }
   function setMandatory($new) {
      $this->mandatory = $new;
   }
   function setClass($new) {
      $this->class = $new;
   }

   function getLabel() {
      return $this->label;
   }
   function getPrompt() {
      return $this->prompt;
   }
   function getName() {
      return $this->name;
   }
   function getType() {
      return $this->type;
   }
   function getValue() {
      return $this->value;
   }
   function getMandatory() {
      return $this->mandatory;
   }
   function getClass() {
      return $this->class;
   }
}

/**
 * This class represnts all the possible fields that an Agenda event can have.
 * It is responsible for all HTML generation and validation of input values.
 */
class AgendaFields {
   var $fields;

   function AgendaFields() {
      $this->fields = array();
      $this->fields[14] = new AgendaField(AGENDA_LAN_FIELD_14_0, AGENDA_LAN_FIELD_14_1, "agn_diarycode",       "diarycode",   "", "*", "tbox");
   }

   function initField($fieldid) {
      global $agenda, $e107HelperForm;
      switch ($fieldid) {
         case 0 : {
            $name = "agn_title";
            $e107HelperForm->createTag($name, "text", AGENDA_LAN_FIELD_00_0, AGENDA_LAN_FIELD_00_1, "", "tbox");
            $e107HelperForm->setMandatory($name, true);
            $e107HelperForm->addAttribute($name, "size", 30);
            $e107HelperForm->setMaxLength($name, 200);
            break;
         }
         case 1 : {
            $name = "agn_start";
            $e107HelperForm->createTag($name, "calendar", AGENDA_LAN_FIELD_01_0, AGENDA_LAN_FIELD_01_1, "", "tbox");
            $e107HelperForm->setMandatory($name, true);
            $e107HelperForm->setDefault($name, time());
            break;
         }
         case 2 : {
            $name = "agn_end";
            $e107HelperForm->createTag($name, "calendar", AGENDA_LAN_FIELD_02_0, AGENDA_LAN_FIELD_02_1, "", "tbox");
            $e107HelperForm->setMandatory($name, true);
            $e107HelperForm->setDefault($name, time());
            break;
         }
         case 3 : {
            $name = "agn_start";
            $e107HelperForm->createTag($name, "calendartime", AGENDA_LAN_FIELD_03_0, AGENDA_LAN_FIELD_03_1, "", "tbox");
            $e107HelperForm->setMandatory($name, true);
            $e107HelperForm->setDefault($name, time());
            break;
         }
         case 4 : {
            $name = "agn_end";
            $e107HelperForm->createTag($name, "calendartime", AGENDA_LAN_FIELD_04_0, AGENDA_LAN_FIELD_04_1, "", "tbox");
            $e107HelperForm->setMandatory($name, true);
            $e107HelperForm->setDefault($name, time()+3600);
            break;
         }
         case 5 : {
            $name = "agn_category";
            $e107HelperForm->createTag($name, "list", AGENDA_LAN_FIELD_05_0, AGENDA_LAN_FIELD_05_1, "", "tbox");
            $values = explode(",", $agenda->getCategoriesList());
            foreach ($values as $value) {
               $value = explode(":", $value);
               $e107HelperForm->addValue($name, $value[0], $value[1]);
            }
            break;
         }
         case 6 : {
            $name = "agn_location";
            $e107HelperForm->createTag($name, "text", AGENDA_LAN_FIELD_06_0, AGENDA_LAN_FIELD_06_1, "", "tbox");
            $e107HelperForm->addAttribute($name, "size", 50);
            $e107HelperForm->setMaxLength($name, 200);
            break;
         }
         case 7 : {
            $name = "agn_details";
            $e107HelperForm->createTag($name, "textarea", AGENDA_LAN_FIELD_07_0, AGENDA_LAN_FIELD_07_1, "", "tbox");
            $e107HelperForm->addStyle($name, "width", "350px");
            $e107HelperForm->addStyle($name, "height", "60px");
            break;
         }
         case 8 : {
            $name = "agn_priority";
            $e107HelperForm->createTag($name, "radio", AGENDA_LAN_FIELD_08_0, AGENDA_LAN_FIELD_08_1, "", "tbox");
            $e107HelperForm->addValue($name, 0);
            $e107HelperForm->addValue($name, 1);
            $e107HelperForm->addValue($name, 2);
            $e107HelperForm->addValue($name, 3);
            $e107HelperForm->addValue($name, 4);
            $e107HelperForm->addValue($name, 5);
            break;
         }
         case 9 : {
            $name = "agn_owner";
            $e107HelperForm->createTag($name, "text", AGENDA_LAN_FIELD_09_0, AGENDA_LAN_FIELD_09_1, "", "tbox");
            $e107HelperForm->setDefault($name, USERNAME);
            $e107HelperForm->addAttribute($name, "size", 20);
            $e107HelperForm->setMaxLength($name, 100);
            break;
         }
         case 10 : {
            $name = "agn_recurring";
            $e107HelperForm->createTag($name, "list", AGENDA_LAN_FIELD_10_0, AGENDA_LAN_FIELD_11_1, "", "tbox");
            $values = explode(",", $agenda->getRecurCodesList());
            foreach ($values as $value) {
               $value = explode(":", $value);
               $e107HelperForm->addValue($name, $value[0], $value[1]);
            }
            break;
         }
         case 11 : {
            $name = "agn_contact_email";
            $e107HelperForm->createTag($name, "text", AGENDA_LAN_FIELD_11_0, AGENDA_LAN_FIELD_11_1, "", "tbox");
            $e107HelperForm->addAttribute($name, "size", 50);
            $e107HelperForm->setMaxLength($name, 200);
            break;
         }
         case 12 : {
            $name = "agn_private";
            $e107HelperForm->createTag($name, "checkbox", AGENDA_LAN_FIELD_12_0, AGENDA_LAN_FIELD_12_1, "", "tbox");
            $e107HelperForm->addValue($name, 1);
            //, AGENDA_LAN_FIELD_12_2
            break;
         }
         case 13 : {
            $name = "agn_complete";
            $e107HelperForm->createTag($name, "checkbox", AGENDA_LAN_FIELD_13_0, AGENDA_LAN_FIELD_13_1, "", "tbox");
            $e107HelperForm->addValue($name, 1);
            //, AGENDA_LAN_FIELD_13_2
            break;
         }
         case 14 : {
            $name = "agn_diary_code";
            $html .= "<select class='tbox' name='agn_diary_code_0' id='agn_diary_code_0' onchange='agendaDCodePopulate1(event, \"agn_diary_code\", \"\");'></select>";
            $html .= "<select class='tbox' name='agn_diary_code_1' id='agn_diary_code_1' onchange='agendaDCodePopulate2(event, \"agn_diary_code\", \"\");' style='visibility:hidden' disabled></select>";
            $html .= "<select class='tbox' name='agn_diary_code_2' id='agn_diary_code_2' style='visibility:hidden' disabled></select>";
            $html .= "<script type='text/javascript' language='javascript'>";
            $html .= "   agendaDCodePopulate0('agn_diary_code', '$presetvalue');";
            $html .= "</script>";
            $e107HelperForm->createTag($name, "custom", AGENDA_LAN_FIELD_14_0, AGENDA_LAN_FIELD_14_1, "", "tbox");
            $e107HelperForm->setCustomHTML($name, $html);
            break;
         }
         case 15 : {
            $name = "agn_forum_thread";
            $e107HelperForm->createTag($name, "text", AGENDA_LAN_FIELD_15_0, AGENDA_LAN_FIELD_15_1, "", "tbox");
            $e107HelperForm->addAttribute($name, "size", 50);
            $e107HelperForm->setMaxLength($name, 200);
            break;
         }
         case 16 : {
            $name = "agn_question";
            $e107HelperForm->createTag($name, "list", AGENDA_LAN_FIELD_16_0, AGENDA_LAN_FIELD_16_1, "", "tbox");
            $e107HelperForm->addValue($name, 0, AGENDA_LAN_FIELD_16_3);
            $values = explode(",", $agenda->getRegQuestions());
            foreach ($values as $value) {
               $value = explode(":", $value);
               $e107HelperForm->addValue($name, $value[0], $value[1]);
            }
            break;
         }
         default : {
            $name = false;
         }
      }

      return $name;
   }

   function getFormRows($fields) {
      global $e107HelperForm;
      $html = "";
      $e107HelperForm->createForm("agn_event_form", HELPER_FORM_TYPE_NO_BUTTONS);
      for ($i=0; $i<count($fields); $i++) {
         $name = $this->initField($fields[$i]);
      }
      $e107HelperForm->generateHTML(true);
      return $e107HelperForm->getFormHTML();
   }

   function validateFormRows($fields, &$colstr, &$valstr, &$errtext) {
      global $e107HelperForm;
      $html = "";
      //print "<pre>";
      //print_r($_REQUEST);
      $e107HelperForm->createForm("agn_event_form");
      for ($i=0; $i<count($fields); $i++) {
         $name = $this->initField($fields[$i]);
         $colstr[] = $name;
         $valstr[] = "'".$e107HelperForm->getCurrentValue($name, 0)."'";
         //print "$name=".$e107HelperForm->getCurrentValue($name, 0)."<br>";
      }

      if ($e107HelperForm->validateForm()) {
         return true;
      } else {
         $errtext = $e107HelperForm->getErrorText();
         return false;
      }
   }
}
?>