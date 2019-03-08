<?php

include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . "_helpdesk_admin.php");
include_lan(e_PLUGIN . "helpdesk3_menu/languages/" . e_LANGUAGE . "_helpdesk.php");
require_once(e_HANDLER . "userclass_class.php");
class helpdesk
{
    var $hdu_read = false; // allowed to access and read
    var $hdu_super = false; // supervisor
    var $hdu_technician = false;
    var $hdu_poster = false; //allowed to post tickets
    var $hduprefs_autoclosedays = 0; // auto close tickets after days
    var $hduprefs_autocloseres = 0; // the resolution/status when auto closed
    var $hduprefs_colours = array(); // colours used for priority
    var $hduprefs_rows = 10;
    var $hduprefs_memberof = "";
    var $hduprefs_posteronly = false;
    var $hduconvert_date = "";
    var $hdu_new = false;
    var $hdu_edit = false;
    var $hdu_quick = false;
    var $hduprefs_showassettag = false;
    var $hdu_showemail = false;
    var $hdu_showfixes = false;
    var $hduprefs_showfinance = false;
    var $hduprefs_defaultres = 0;
    var $hduprefs_callout = 0;
    var $hduprefs_autoassign = false;
    var $hduprefs_assigned = 0;
    var $hduprefs_statcloses = false;
    var $hduprefs_reopen = false;
    var $hduprefs_mailuser = 0;
    var $hduprefs_mailhelpdesk = 0;
    var $hduprefs_sendas = 0;
    var $hduprefs_pmfrom = 0;
    var $hduprefs_emailfrom = "";
    var $hduprefs_usersubject = "";
    var $hduprefs_userupsubject = "";
    var $hduprefs_usertext = "";
    var $hduprefs_updateuser = "";
    var $hduprefs_helpdeskemail = "";
    var $hduprefs_helpupsubject = "";
    var $hduprefs_techniciansubject = "";
    var $hduprefs_helpdesktext = "";
    var $hduprefs_updatehelpdesk = "";
    var $hduprefs_helpdesksubject = "";
    var $hduprefs_updatetechnician = "";
    var $hduprefs_techniciantext = "";
    var $hduprefs_menutitle = "";
    var $hduprefs_title = "";
    var $hduprefs_mailpdf = false;
    var $hduprefs_distancerate = 0;
    var $hduprefs_hourlyrate = 0;
    var $hduprefs_closestat = 0;
    var $hduprefs_assignto = 0;
    var $hduprefs_escalatedays = 0;
    var $hduprefs_allread = false;
    var $hdu_print = false;
    var $hduprefs_showfixes = false;
    var $hduprefs_escalateon = 0;

    function helpdesk()
    {
        global $sql, $HELPDESK_PREF;
        $this->load_prefs();
        $this->hduprefs_posteronly = ($HELPDESK_PREF['hduprefs_posteronly'] == 1);
        $this->hduprefs_colours = array("1" => $HELPDESK_PREF['hduprefs_p1col'],
            "2" => $HELPDESK_PREF['hduprefs_p2col'],
            "3" => $HELPDESK_PREF['hduprefs_p3col'],
            "4" => $HELPDESK_PREF['hduprefs_p4col'],
            "5" => $HELPDESK_PREF['hduprefs_p5col']);
        // is this person a technician in any helpdesk
        $sql->db_Select("hdu_helpdesk", "hdudesk_id", "where find_in_set(hdudesk_class,'" . USERCLASS_LIST . "')", "nowhere", false);
        while ($hdu_row = $sql->db_Fetch())
        {
            // get the helpdesks this person belongs to
            $this->hdu_memberof .= $hdu_row['hdudesk_id'] . ",";
        } // while
        $this->hdu_technician = (empty($this->hdu_memberof)?false:true);
        $this->hdu_super = check_class($HELPDESK_PREF['hduprefs_supervisorclass']);
        // all in read class, supervisor or technicians can access
        $this->hdu_poster = check_class($HELPDESK_PREF['hduprefs_postclass']) || $this->hdu_super || $this->hdu_technician;
        $this->hdu_read = check_class($HELPDESK_PREF['hduprefs_userclass']) || $this->hdu_poster;
        $this->hduprefs_autoclosedays = $HELPDESK_PREF['hduprefs_autoclosedays'];
        $this->hduprefs_autocloseres = $HELPDESK_PREF['hduprefs_autocloseres'];
        $this->hduprefs_rows = $HELPDESK_PREF['hduprefs_rows'];
        $this->hduprefs_showassettag = $HELPDESK_PREF['hduprefs_showassettag'] == 1;
        $this->hduprefs_showfixes = $HELPDESK_PREF['hduprefs_showfixes'] == 1;
        $this->hduprefs_autoassign = $HELPDESK_PREF['hduprefs_autoassign'] == 1;
        $this->hduprefs_statcloses = $HELPDESK_PREF['hduprefs_statcloses'] == 1;
        $this->hduprefs_reopen = $HELPDESK_PREF['hduprefs_reopen'] == 1;
        $this->hduprefs_mailpdf = $HELPDESK_PREF['hduprefs_mailpdf'] == 1;
        $this->hduprefs_allread = $HELPDESK_PREF['hduprefs_allread'] == 1;
        $this->hduconvert_date = new convert;
        // if show finance and supervisor or technician
        // or show finance and show to users
        if (($HELPDESK_PREF['hduprefs_showfinance'] == 1 && ($this->hdu_super || $this->hdu_technician)) || ($HELPDESK_PREF['hduprefs_showfinance'] == 1 && $HELPDESK_PREF['hduprefs_showfinusers'] == 1))
        {
            $this->hduprefs_showfinance = true;
        }
        $this->hduprefs_defaultres = $HELPDESK_PREF['hduprefs_defaultres'];
        $this->hduprefs_mailuser = $HELPDESK_PREF['hduprefs_mailuser'];
        $this->hduprefs_helpdeskemail = $HELPDESK_PREF['hduprefs_helpdeskemail'];
        $this->hduprefs_emailfrom = $HELPDESK_PREF['hduprefs_emailfrom'];
        $this->hduprefs_usersubject = $HELPDESK_PREF['hduprefs_usersubject'];
        $this->hduprefs_userupsubject = $HELPDESK_PREF['hduprefs_userupsubject'];
        $this->hduprefs_usertext = $HELPDESK_PREF['hduprefs_usertext'];

        $this->hduprefs_updateuser = $HELPDESK_PREF['hduprefs_updateuser'];
        $this->hduprefs_mailhelpdesk = $HELPDESK_PREF['hduprefs_mailhelpdesk'];
        $this->hduprefs_helpupsubject = $HELPDESK_PREF['hduprefs_helpupsubject'];
        $this->hduprefs_techniciansubject = $HELPDESK_PREF['hduprefs_techniciansubject'];
        $this->hduprefs_helpdesktext = $HELPDESK_PREF['hduprefs_helpdesktext'];
        $this->hduprefs_updatehelpdesk = $HELPDESK_PREF['hduprefs_updatehelpdesk'];
        $this->hduprefs_helpdesksubject = $HELPDESK_PREF['hduprefs_helpdesksubject'];
        $this->hduprefs_updatetechnician = $HELPDESK_PREF['hduprefs_updatetechnician'];
        $this->hduprefs_techniciantext = $HELPDESK_PREF['hduprefs_techniciantext'];
        $this->hduprefs_sendas = $HELPDESK_PREF['hduprefs_sendas'];
        $this->hduprefs_pmfrom = $HELPDESK_PREF['hduprefs_pmfrom'];
        $this->hduprefs_title = $HELPDESK_PREF['hduprefs_title'];
        $this->hduprefs_callout = $HELPDESK_PREF['hduprefs_callout'];
        $this->hduprefs_distancerate = $HELPDESK_PREF['hduprefs_distancerate'];
        $this->hduprefs_hourlyrate = $HELPDESK_PREF['hduprefs_hourlyrate'];
        $this->hduprefs_menutitle = $HELPDESK_PREF['hduprefs_menutitle'];
        $this->hduprefs_closestat = $HELPDESK_PREF['hduprefs_closestat'];
        $this->hduprefs_assignto = $HELPDESK_PREF['hduprefs_assignto'];
        $this->hduprefs_assigned = $HELPDESK_PREF['hduprefs_assigned'];
        $this->hduprefs_escalatedays = $HELPDESK_PREF['hduprefs_escalatedays'];
        $this->hduprefs_escalateon = $HELPDESK_PREF['hduprefs_escalateon'];
    }
    // ********************************************************************************************
    // *
    // * Helpdesk load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $HELPDESK_PREF, $sql;


        // otherwise create new default prefs
        $HELPDESK_PREF = array("hduprefs_messagetop" => "Helpdesk Message",
            "hduprefs_messagebottom" => "Bottom",
            "hduprefs_phone" => "0800 123 45678",
            "hduprefs_rows" => 10,
            "hduprefs_escalateon" => 0,
            "hduprefs_escalatedays" => 14,
            "hduprefs_autoclosedays" => 28,
            "hduprefs_autocloseres" => 0,
            "hduprefs_defaultres" => 0,
            "hduprefs_reopen" => 0,
            "hduprefs_allread" => 0,
            "hduprefs_posteronly" => 0,
            "hduprefs_title" => "Helpdesk",
            "hduprefs_showassettag" => 0,
            "hduprefs_showfixes" => 0,
            "hduprefs_showfinance" => 0,
            "hduprefs_userclass" => 253,
            "hduprefs_postclass" => 253,
            "hduprefs_supervisorclass" => 255,
            "hduprefs_hourlyrate" => 10,
            "hduprefs_callout" => 10,
            "hduprefs_showfinusers" => 0,
            "hduprefs_distancerate" => 0,
            "hduprefs_assignto" => 0,
            "hduprefs_restech" => 0,
            "hduprefs_autoassign" => 0,
            "hduprefs_assigned" => 0,
            "hduprefs_closestat" => 0,
            "hduprefs_faq" => "",
            "hduprefs_p1col" => "#00CC00",
            "hduprefs_p2col" => "#99CC00",
            "hduprefs_p3col" => "#FFFF33",
            "hduprefs_p4col" => "#FF9933",
            "hduprefs_p5col" => "#FF0000",
            "hduprefs_mailhelpdesk" => 0,
            "hduprefs_mailtechnician" => 0,
            "hduprefs_mailuser" => 0,
            "hduprefs_helpdeskemail" => "helpdesk@example.com",
            "hduprefs_usersubject" => "Helpdesk Ticket",
            "hduprefs_techniciansubject" => "Helpdesk Ticket",
            "hduprefs_helpupsubject" => "Helpdesk Ticket",
            "hduprefs_technicianupsubject" => "Updated Helpdesk Ticket",
            "hduprefs_userupsubject" => "Updated Helpdesk Ticket",
            "hduprefs_emailfrom" => "Helpdesk for ",
            "hduprefs_sendas" => "",
            "hduprefs_usertext" => "Text",
            "hduprefs_techniciantext" => "Text",
            "hduprefs_helpdesktext" => "Text",
            "hduprefs_updateuser" => "Update Text",
            "hduprefs_updatetechnician" => "Update Text",
            "hduprefs_updatehelpdesk" => "Update Text",
            "hduprefs_helpdesksubject" => "Update Text",
            "hduprefs_pmfrom" => 0,
            "hduprefs_mailpdf" => 0,
            "hduprefs_seo" => 0,
            "hduprefs_menutitle" => "HelpDesk"
            );

    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $HELPDESK_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($HELPDESK_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='helpdesk'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $HELPDESK_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='helpdesk' ");
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($HELPDESK_PREF);
            $sql->db_Insert("core", "'helpdesk', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='helpdesk' ");
        }
        else
        {
            $HELPDESK_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	auto_close()
    // *
    // *	Parameters	:
    // *
    // *	Returns		:	void
    // *
    // *	Description	:	Processes auto close on any open tickets
    // *
    // *
    // **********************************************************************************************
    function auto_close()
    {
        global $sql, $tp;
        if ($this->hduprefs_autoclosedays > 0)
        {
            // if we do default close then check for last activity and if more than hdu_defclose days ago
            // close the ticket.  Reopening restarts the counter.
            $hdu_timecheck = time() - ($this->hduprefs_autoclosedays * 86400);
            $hdu_args = "hdu_closed='" . time() . "', hdu_resolution ='" . $this->hduprefs_autocloseres . "' where hdu_lastchanged < '$hdu_timecheck' and hdu_closed ='0' ";
            $sql->db_Update("hdunit", $hdu_args, false);
        }
    }
    // **********************************************************************************************
    // *
    // *	Function	:	helpdesk_cache_clear()
    // *
    // *	Parameters	:
    // *
    // *	Returns		:	void
    // *
    // *	Description	:	Clear any helpdesk caches
    // *
    // *
    // **********************************************************************************************
    function helpdesk_cache_clear()
    {
        global $e107cache;
        // $e107cache->clear("nq_helpdesktop_menu");
        $e107cache->clear("nq_helpdesk3_menu");
        // $e107cache->clear("nq_helpdesknew_menu");
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_makedate($hdu_cal_date)
    // *
    // *	Parameters	:	$hdu_cal_date
    // *
    // *	Returns		:	void
    // *
    // *	Description	:	Make a date from calendar format
    // *
    // *
    // **********************************************************************************************
    // function hdu_makedate($hdu_cal_date)
    // {
    // global $pref;
    // if ($hdu_cal_date > 0)
    // {
    // switch ($pref['eventguide_dateformat'])
    // {
    // case 1:
    // $hdu_cal_retval = date("m-d-Y", $hdu_cal_date);
    // break;
    // case 2:
    // $hdu_cal_retval = date("Y-m-d", $hdu_cal_date);
    // break;
    // case 0:
    // default:
    // $hdu_cal_retval = date("d-m-Y", $hdu_cal_date);
    // } // switch
    // }
    // else
    // {
    // $hdu_cal_retval = 0;
    // }
    // return $hdu_cal_retval;
    // }
    // function hdu_indate($hdu_cal_date)
    // {
    // global $pref;
    // if (!empty($hdu_cal_date))
    // {
    // $hdu_cal_tmp = explode("-", $hdu_cal_date);
    // switch ($pref['eventguide_dateformat'])
    // {
    // case 1:
    // $hdu_cal_retval = mktime(0, 0, 0, $hdu_cal_tmp[0], $hdu_cal_tmp[1], $hdu_cal_tmp[2]);
    // break;
    // case 2:
    // $hdu_cal_retval = mktime(0, 0, 0, $hdu_cal_tmp[1], $hdu_cal_tmp[2], $hdu_cal_tmp[0]);
    // break;
    // case 0:
    // default:
    // $hdu_cal_retval = mktime(0, 0, 0, $hdu_cal_tmp[1], $hdu_cal_tmp[0], $hdu_cal_tmp[2]);
    // } // switch
    // }
    // else
    // {
    // $hdu_cal_retval = 0;
    // }
    // return $hdu_cal_retval;
    // }
    // **********************************************************************************************
    // *
    // *	Function	:	display_priority()
    // *
    // *	Parameters	:	void
    // *
    // *	Returns		:	void
    // *
    // *	Description	:	Return a table with priority key
    // *
    // *
    // **********************************************************************************************
    function display_priority()
    {
        $retval = "
	<table style='" . USER_WIDTH . "' >
		<tr>
			<td style='text-align:Left;'>" . HDU_190 . "&nbsp;
	" . HDU_191 . " <img src='./images/green.gif' style='border:0;' alt='" . HDU_191 . "' title='" . HDU_191 . "' />&nbsp;
	" . HDU_192 . " <img src='./images/yellow.gif' style='border:0;' alt='" . HDU_192 . "' title='" . HDU_192 . "' />&nbsp;
	" . HDU_193 . " <img src='./images/red.gif' style='border:0;' alt='" . HDU_193 . "' title='" . HDU_193 . "' />
			</td>
			<td style='text-align:right;'>" . HDU_189 . "&nbsp; </td>
			<td style='text-align:center; width:20px; border: #C3BDBD 1px solid; background-color: " . $this->hduprefs_colours[1] . "'>1</td>
    		<td style='text-align:center; width:20px; border: #C3BDBD 1px solid; background-color: " . $this->hduprefs_colours[2] . "'>2</td>
    		<td style='text-align:center; width:20px; border: #C3BDBD 1px solid; background-color: " . $this->hduprefs_colours[3] . "'>3</td>
    		<td style='text-align:center; width:20px; border: #C3BDBD 1px solid; background-color: " . $this->hduprefs_colours[4] . "'>4</td>
    		<td style='text-align:center; width:20px; border: #C3BDBD 1px solid; background-color: " . $this->hduprefs_colours[5] . "'>5</td>
    	</tr>
	</table>";

        return $retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getstatussel($hdu_res = 0)
    // *
    // *	Parameters	:	$hdu_res integer - current resolution
    // *
    // *	Returns		:	void
    // *
    // *	Description	:	Return a select object with list of resolutions / status
    // *
    // *
    // **********************************************************************************************
    function hdu_getstatussel($hdu_res = 0)
    {
        global $sql, $tp;
        if ($hdu_res == 0)
        {
            $hdu_res = $this->hduprefs_defaultres;
        }
        $retval = "
		<select class='tbox'  onchange=\"changed()\" name='hdu_resolution'>";
        if ($sql->db_Select("hdu_resolve", "hdures_id,hdures_resolution", " order by hdures_resolution", "nowhere", false))
        {
            while ($hdu_catrow = $sql->db_Fetch())
            {
                extract($hdu_catrow);
                $retval .= "<option value='$hdures_id' " .
                ($hdures_id == $hdu_res?"selected='selected'":"") . ">" . $tp->toFORM($hdures_resolution) . "</option>";
            }
        }
        $retval .= "</select>";
        return $retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_statcloses($hdu_id = 0)
    // *
    // *	Parameters	:	$hdu_id integer - the selected status/resolution
    // *
    // *	Returns		:	boolean - true this closes - false doesn't close it.
    // *
    // *	Description	:	Return a whether this status closes the ticket
    // *
    // *
    // **********************************************************************************************
    function hdu_statcloses($hdu_id = 0)
    {
        global $sql;
        $retval = false;
        if ($sql->db_Select("hdu_resolve", "where hdures_closed", "hdures_id='$hdu_id'", 'nowhere', false))
        {
            $$hdu_row = $sql->db_Fetch();
            if ($hdu_row['hdures_closed'] == 1)
            {
                $retval = true;
            }
        }
        return $retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getfixcost($hdu_fixid = 0)
    // *
    // *	Parameters	:	$hdu_id integer - the id of the fix
    // *
    // *	Returns		:	number - the value of the fix or false if not found
    // *
    // *	Description	:	Return the amount that this fix costs
    // *
    // *
    // **********************************************************************************************
    function hdu_getfixcost($hdu_fixid = 0)
    {
        global $sql, $tp;
        // Get the fix cost for the fix if a fix is selected and there is no fix cost entered on the form
        if ($sql->db_Select("hdu_fixes", "hdufix_fixcost", "where hdufix_id = '" . $hdu_fixid . "'", 'nowhere', false))
        {
            $hdu_row = $sql->db_Fetch() ;
            return $tp->toFORM($hdu_row['hdufix_fixcost']);
        }
        else
        {
            return false;
        }
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getcat($hdu_id)
    // *
    // *	Parameters	:	$hdu_id integer - the id of the category
    // *
    // *	Returns		:	number - the value of the fix or false if not found
    // *
    // *	Description	:	Return the amount that this fix costs
    // *
    // *
    // **********************************************************************************************
    function hdu_getcat($hdu_id)
    {
        $hdu_repdb = new DB;
        if ($hdu_repdb->db_Select("hdu_categories", "where hducat_category", "hducat_id='$hdu_id'", 'nowhere', false))
        {
            $hdu_reprow = $hdu_repdb->db_Fetch();

            return $hdu_reprow['hducat_category'];
        }
        else
        {
            return HDU_256; //No category defined
        }
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getstat($hdu_id)
    // *
    // *	Parameters	:	$hdu_id integer - the id of the status
    // *
    // *	Returns		:	number - the value of the fix or false if not found
    // *
    // *	Description	:	Return the amount that this fix costs
    // *
    // *
    // **********************************************************************************************
    function hdu_getstat($hdu_id)
    {
        $hdu_repdb = new DB;
        if ($hdu_repdb->db_Select("hdu_resolve", " hdures_resolution", "where hdures_id='$hdu_id'", 'nowhere', false))
        {
            $hdu_reprow = $hdu_repdb->db_Fetch();
            return $hdu_reprow['hdures_resolution'];
        }
        else
        {
            return HDU_214; // no status defined
        }
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_get_colours()
    // *
    // *	Parameters	:	void
    // *
    // *	Returns		:	array - of colours (#000000)
    // *
    // *	Description	:	Return array of colour codes
    // *
    // *
    // **********************************************************************************************
    function hdu_get_colours()
    {
        global $hduprefs_p1col, $hduprefs_p2col, $hduprefs_p3col, $hduprefs_p4col, $hduprefs_p5col;
        $retval = array($hduprefs_p1col, $hduprefs_p2col, $hduprefs_p3col, $hduprefs_p4col, $hduprefs_p5col);
        return $retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_gethemail($hdu_gete)
    // *
    // *	Parameters	:	integer - id of the helpdesk
    // *
    // *	Returns		:	string - email address
    // *
    // *	Description	:	Return email address for the helpdesk
    // *
    // *
    // **********************************************************************************************
    function hdu_gethemail($hdu_gete)
    {
        $hdu_gete_db = new DB;
        // get from the category which helpdesk is using it and then get the email address:
        $hdu_gete_args = "select hdudesk_email from #hdu_helpdesk left join #hdu_categories on hducat_helpdesk=hdudesk_id
		where hducat_id='{$hdu_gete}'";
        if ($hdu_gete_db->db_Select_gen($hdu_gete_args, false))
        {
            $hdu_gete_row = $hdu_gete_db->db_Fetch();

            return $hdu_gete_row['hdudesk_email'];
        }
        else
        {
            return "";
        }
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getuserselect($hdu_id)
    // *
    // *	Parameters	:	integer - $hdu_id current id
    // *
    // *	Returns		:	string - select with list of users
    // *
    // *	Description	:	Return select with list of users
    // *
    // *
    // **********************************************************************************************
    function hdu_getuserselect($hdu_id = 0)
    {
        $hdu_seldb = new DB;
        $retval = "<select name='hduposterqname' class='tbox'><option value='0'>" . HDU_136 . "</option>";
        if ($hdu_seldb->db_Select("user", "where user_id,user_name", 'nowhere', false))
        {
            while ($hdu_selrow = $hdu_seldb->db_Fetch())
            {
                extract($hdu_selrow);
                $retval .= "<option value='{$user_id}' " . ($hdu_id == $user_id?"selected'selected'":"") . " >{$user_name}</option>";
            } // while
        }
        $retval .= "</select>";
        return $retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getuseremail($hdu_userid = 0)
    // *
    // *	Parameters	:	integer - $hdu_userid user's id
    // *
    // *	Returns		:	string - users email address
    // *
    // *	Description	:	Return email address for specified user
    // *
    // *
    // **********************************************************************************************
    function hdu_getuseremail($hdu_userid = 0)
    {
        $hdu_userdb = new DB;
        $hdu_userdb->db_Select("user", "user_email", "where user_id='$hdu_userid'", 'nowhere', false);
        $hdu_row = $hdu_userdb->db_Fetch();

        return $hdu_row['user_email'];
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_getposterdetails($hdu_userid = 0)
    // *
    // *	Parameters	:	integer - $hdu_userid user's id
    // *
    // *	Returns		:	string - users email address
    // *
    // *	Description	:	Return email address for specified user
    // *
    // *
    // **********************************************************************************************
    function hdu_getposterdetails($hdu_userid = 0)
    {
        $hdu_userdb = new DB;
        if ($hdu_userdb->db_Select("user", "user_name", "where user_id='$hdu_userid'", 'nowhere', false))
        {
            $hdu_row = $hdu_userdb->db_Fetch();
            extract($hdu_row);

            return $hdu_userid . ".$user_name";
        }
        else
        {
            return false;
        }
    }
    // // **********************************************************************************************
    // // *
    // // *	Function	:	hdu_getposterdetails($hdu_userid = 0)
    // // *
    // // *	Parameters	:	integer - $hdu_userid user's id
    // // *
    // // *	Returns		:	string - users email address
    // // *
    // // *	Description	:	Return email address for specified user
    // // *
    // // *
    // // **********************************************************************************************
    // function hdu_gettechemail($hdu_tech_id)
    // {
    // $hdu_get_db = new DB;
    // if ($hdu_get_db->db_Select("user", "user_email", "where user_id ='$hdu_tech_id'", 'nowhere', false))
    // {
    // $hdu_get_row = $hdu_get_db->db_Fetch() ;

    // $retval = $hdu_get_row['user_email'];
    // }
    // else
    // {
    // $retval = false;
    // }
    // return $retval;
    // }
    // **********************************************************************************************
    // *
    // *	Function	:	post_comment
    // *
    // *	Parameters	:	void
    // *
    // *	Returns		:	void
    // *
    // *	Description	:	Posts a comment
    // *
    // *
    // **********************************************************************************************
    function post_comment()
    {
        global $sql, $tp;
        $hdu_id = intval($_POST['id']);

        if (!empty($_POST['hduc_comment']))
        {
            $hduc_args = "
		'0',
		'$hdu_id',
		'" . USERID . "." . $tp->toDB(USERNAME) . "',
		'" . USERID . "',
		'" . time() . "',
		'0',
		'" . $tp->toDB($_POST['hduc_comment']) . "'";
            $hduc = $sql->db_Insert("hdu_comments", $hduc_args);
            $hduc_msg = HDU_92;
        }
        $sql->db_Select("hdunit", "*", "where hdu_id = $hdu_id", "nowhere");
        $hdu_row = $sql->db_Fetch();
        extract($hdu_row);
        // print $hdu_tech . "AL";
        // if ($hdu_tech > 0)
        // {
        // if ($hduprefs_assigned > 0)
        // {
        // $hdu_allocon = ",hdu_resolution = $hduprefs_assigned";
        // }
        // else
        // {
        // $hdu_allocon = ",hdu_resolution = $hduprefs_defaultres";
        // }
        // }
        if ($this->hdu_technician || $this->hdu_super)
        {
            // maybe also need to check helpdesk class too!!!!
            // If technician or supervisor then set return to 1 to show comment is from helpdesk and ensure closed is taken off
            $sql->db_Update("hdunit", "hdu_return = '1',hdu_lastcomment='" . time() . "',hdu_lastchanged='" . time() . "' $hdu_allocon where hdu_id = '$hdu_id'");
        }
        else
        {
            $sql->db_Update("hdunit", "hdu_return = '0',hdu_lastcomment='" . time() . "',hdu_lastchanged='" . time() . "' $hdu_allocon where hdu_id = '$hdu_id'");
        }
    }
    // **********************************************************************************************
    // *
    // *	Function	:	delete_ticket($id)
    // *
    // *	Parameters	:	integer - $id ID of ticket to delete
    // *
    // *	Returns		:	string - form to confirm deletion
    // *
    // *	Description	:	Create a form to confirm deletion of a ticket
    // *
    // *
    // **********************************************************************************************
    function delete_ticket($id)
    {
        global $sql, $tp, $hdu_shortcodes, $hdu_id;
        require(HDU_THEME);
        $hdu_id = $id;
        $hdu_retval = "
		<form id='hdu_delform' method='post' action='" . e_SELF . "' >
		<div>
			<input type='hidden' name='id' value='$hdu_id' />
			<input type='hidden' name='from' value='$from' />
			<input type='hidden' name='hdu_aaction' value='list' />
		</div>";
        if ($this->hdu_super)
        {
            $hdu_retval .= $tp->parseTemplate($HDU_DELETE_OK, false, $hdu_shortcodes);
        }
        else
        {
            $hdu_retval .= $tp->parseTemplate($HDU_DELETE_NOTOK, false, $hdu_shortcodes);
        }
        $hdu_retval .= "</form>";
        return $hdu_retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	show($hdu_showid = 0)
    // *
    // *	Parameters	:	integer - $hdu_showid ID of ticket to show
    // *
    // *	Returns		:	string - form to show/edit a ticket
    // *
    // *	Description	:	Create a form to show/edit a ticket
    // *
    // *
    // **********************************************************************************************
    function show($hdu_showid = 0)
    {
        // Create required objects
        // TO DO
        // Check if user is technicial for this ticket - if not then don't allow to do things to it.
        // *
        global $sql, $tp, $helpdesk_obj, $HDU_SHOWTICKET_TICKET, $HDU_SHOWTICKET, $HDU_SHOWTICKET_DETAILS, $HDU_SHOWTICKET_FINANCE, $hdu_shortcodes,
        $HDU_SHOWTICKET_COMMENT_HEADER, $HDU_SHOWTICKET_COMMENT_FOOTER, $HDU_SHOWTICKET_COMMENT_DETAIL, $hdu_posterid, $hdu_sel_users,
        $hdupostername, $hdu_datestamp, $hdu_category, $hdu_summary, $hdu_tagno, $hdu_email, $hdu_resolution, $hdures_resolution, $hdu_description,
        $hdu_tech, $hdu_allocated, $hdu_closed, $hdu_hours, $hdu_fixcost, $hdu_hrate, $hdu_hcost, $hdu_distance, $hdu_fixother, $hdu_fix,
        $hdu_drate, $hdu_dcost, $hdu_eqptcost, $hdu_callout, $hduc_date, $hduc_postername, $hduc_comment, $hdu_priority, $hdu_savemsg, $hdu_totalcost;
        // get the ticket
        if ($this->hdu_quick || $this->hdu_new)
        {
            // Creating new ticket
            $id = 0;
        }
        else
        {
            // Not creating a new one so get the record
            $sql->db_Select_gen("
		select * from #hdunit
		left join #hdu_categories on hdu_category=hducat_id
		left join #hdu_helpdesk on hducat_helpdesk=hdudesk_id
		left join #hdu_resolve on  hdu_resolution=hdures_id
		where hdu_id = $hdu_showid", false);
            extract($sql->db_Fetch());
        }
        $hdu_userid = USERID;
        if ($this->hdu_new && $this->hdu_poster)
        {
            $hdu_read = true;
        }
        if ($this->hduprefs_posteronly && ($hdu_posterid == $hdu_userid))
        {
            $hdu_read = true;
        }
        if (!$this->hduprefs_posteronly || $this->hdu_super || $this->hdu_technician)
        {
            $hdu_read = true;
        }
        if ($this->hdu_new || $hdu_action_quick)
        {
            $hdu_read = true;
        }
        if (!$hdu_read)
        {
            $hdu_retval = "
<table class='fborder' style='" . USER_WIDTH . "'>
	<tr>
		<td class='fcaption'>" . HDU_199 . "</td>
	</tr>
	<tr>
		<td class='forumheader3'><a href='?$from.list.$id.$R1'><img src='./images/updir.png' alt='" . HDU_73 . "' title='" . HDU_73 . "' style='border:0;' /></a></td>
	</tr>
	<tr>
		<td class='forumheader3'>" . HDU_202 . "</td>
	</tr>
	<tr>
		<td class='fcaption'>&nbsp;</td>
	</tr>
</table>";
        }
        else
        {
            // If this is a new ticket and being entered by super or technician
            // then get the list of system users to chose from
            if ($this->hdu_new && ($this->hdu_super || $this->hdu_technician))
            {
                $hdu_sel_users = "<select class='tbox' name='hdu_selusers' >";
                $sql->db_Select("user", "user_id,user_name", "order by user_name", "nowhere", false);
                while ($hdu_urow = $sql->db_Fetch())
                {
                    $hdu_sel_users .= "<option value='" . $hdu_urow['user_id'] . "' >" . $tp->toFORM($hdu_urow['user_name']) . "</option>";
                }
                $hdu_sel_users .= "</select>";
            } elseif ($this->hdu_new)
            {
                // entered by a user
                $hdupostername = USERNAME;
                $hduposterid = USERID;
                $hdu_email = USEREMAIL;
                $hdu_datestamp = 0;
            }
            else
            {
                // Not a new ticket so get the details from the ticket
                $hduposterdet = explode(".", $hdu_poster, 2);
                $hduposterid = $hduposterdet[0];
                $hdupostername = $hduposterdet[1];
            }
            // If the ticket is closed then don't allow editing
            $hdu_ticket_closed = $hdu_closed > 0;
            // See if poster allows email address to be shown
            if ($sql->db_Select("user", "user_hideemail", "user_id='$hduposterid'"))
            {
                $hdu_urow = $sql->db_Fetch();
                $this->hdu_showemail = $hdu_urow['hdu_urow'] > 0;
            }
            // If the user is the poster supervisor or technician then show the email address anyway
            if (USERID == $hduposterid || $this->hdu_super || $this->hdu_technician)
            {
                $this->hdu_showemail = false;
            }
            // Display top table containing back or print record
            $hdu_retval = "

<script type='text/javascript'>
<!--
function checkform(theform)
{
	if (theform.hdu_summary.value==null || theform.hdu_summary.value == \"\")
	{
		alert(\"" . HDU_213 . "\");
		return false;
	}
	if (theform.hdu_category.value==0 )
	{
		alert(\"" . HDU_212 . "\");
		return false;
	}
	if (theform.hdu_description.value==null || theform.hdu_description.value == \"\")
	{
		alert(\"" . HDU_211 . "\");
		return false;
	}
	return true;
}
function changed()
{
	document.getElementById('formok').disabled=false
	document.getElementById('formok').value='" . HDU_5 . "'
	document.getElementById('hdu_changed').value='yes'
}
-->
</script>
	<form id='upstat' method='post' action='" . e_SELF . "' onsubmit=\"return checkform(this)\" >
	<div>
		<input type='hidden' name='hdu_aaction' value='updet' />
		<input type='hidden' name='from' value='$from' />
		<input type='hidden' name='id' value='$hdu_showid' />
		<input type='hidden' name='hdu_new' value='" . ($this->hdu_new?1:0) . "' />
		<input type='hidden' name='hdu_cfix' value='" . $hdu_fix . "' />
		<input type='hidden' name='hdu_callocated' value='" . $hdu_allocated . "' />
		<input type='hidden' name='hdu_readyclosed' value='" . $hdu_closed . "' />
		<input type='hidden' name='hduposterid' value='" . $hduposterid . "' />
		<input type='hidden' name='hdu_ctech' value='" . $hdu_tech . "' />
		<input type='hidden' id='hdu_changed' name='hdu_changed' value='no' />
		<input type='hidden' id='hdu_lasttime' name='hdu_lasttime' value='" . $hdu_lastchanged . "' />";
            if (!$helpdesk_obj->hdu_new && (USERID == $hdu_posterid || $helpdesk_obj->hduprefs_allread) && !$helpdesk_obj->hdu_super && !$helpdesk_obj->hdu_technician)
            {
                $hdu_retval .= "	<input type='hidden' name='hdu_commentonly' value='yes' />";
            }
            else
            {
                $hdu_retval .= "	<input type='hidden' name='hdu_commentonly' value='no' />";
            }
            $hdu_retval .= "
    	</div>";
            // *
            // * Top page header
            // *
            // $hdu_retval .= "
            // <div id='titlecaption' style='text-align:center'>";
            require(HDU_THEME);

            $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET, false, $hdu_shortcodes);
            // $hdu_retval .= "
            // <tr>
            // <td class='forumheader3' colspan='2'>
            // <div id=\"tabcontentcontainer\">";
            // // Div for ticket details
            // $hdu_retval .= "<div id=\"sc1\" class=\"tabcontent\">";
            $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_TICKET, false, $hdu_shortcodes);
            // $hdu_retval .= "</div>";
            $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_DETAILS, false, $hdu_shortcodes);
            if ($this->hdu_new)
            {
                // if it is a new ticket then set the default rates
                if ($hdu_hrate == 0)
                {
                    $hdu_hrate = $this->hduprefs_hourlyrate;
                }
                if ($hdu_drate == 0)
                {
                    $hdu_drate = $this->hduprefs_distancerate;
                }
                if ($hdu_callout == 0)
                {
                    $hdu_callout = $this->hduprefs_callout;
                }
            }
            $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_FINANCE, false, $hdu_shortcodes);
            if (!$helpdesk_obj->hdu_new && (USERID == $hdu_posterid || $helpdesk_obj->hduprefs_allread || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician))
            {
                $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_COMMENT_HEADER, false, $hdu_shortcodes);
                $sql->db_Select("hdu_comments", "*", "where hduc_ticketid='$hdu_showid' order by hduc_date asc", "nowhere", false);
                while ($hducrow = $sql->db_Fetch())
                {
                    extract($hducrow);
                    $hduc_poster = explode(".", $hduc_poster);
                    $hduc_posterid = $hduc_poster[0];
                    $hduc_postername = $hduc_poster[1];
                    $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_COMMENT_DETAIL, false, $hdu_shortcodes);
                }
                $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_COMMENT_FOOTER, false, $hdu_shortcodes);
            }
            $hdu_retval .= $tp->parseTemplate($HDU_SHOWTICKET_FOOTER, false, $hdu_shortcodes);
            $hdu_retval .= "
	</form>";
        }
        return $hdu_retval;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	update_ticket($id)
    // *
    // *	Parameters	:	integer - $id ID of ticket to update
    // *
    // *	Returns		:	integer - ID if successful else -ve for error
    // *
    // *	Description	:	Updates/creates a ticket
    // *
    // *
    // **********************************************************************************************
	   // Update the fields that techy people update and only the techy people are allowed to do it
    function update_ticket($id)
    {
        global $sql, $sql2, $tp, $id;
        unset($hdu_up_closed);
        unset($hdu_args);
        $this->hdu_new = intval($_POST['hdu_new']) == 1;
        if ($_POST['hdu_changed'] == "yes")
        {
            $hdu_sendmail = false;
            $hdu_a_alloctime = 0;
            $hdu_a_fcost = 0;
            $hdu_drate = 0;
            // *****************************************************************
            // * Now get all the calculatable bits
            // *****************************************************************
            // *****************************************************************
            // * Calculate the financials
            // *****************************************************************
            if ($this->hduprefs_showfixes && ($_POST['hdu_fixcost'] == 0 || $_POST['hdu_cfix'] != $_POST['hdu_fix']))
            {
                $hdu_fixcost = $this->hdu_getfixcost($_POST['hdu_fix']);
            }
            else
            {
                $hdu_fixcost = $_POST['hdu_fixcost'];
            }
            if (is_numeric($_POST['hdu_drate']))
            {
                $hdu_drate = $_POST['hdu_drate'];
            }
            else
            {
                $hdu_drate = ($this->hduprefs_distancerate > 0?$this->hduprefs_distancerate:0);
            }

            if (is_numeric($_POST['hdu_callout']))
            {
                $hdu_callout = $_POST['hdu_callout'];
            }
            else
            {
                $hdu_callout = ($this->hduprefs_callout > 0?$this->hduprefs_callout:0);
            }
            if (is_numeric($_POST['hdu_eqptcost']))
            {
                $hdu_eqptcost = $_POST['hdu_eqptcost'] ;
            }
            else
            {
                $hdu_eqptcost = 0;
            }
            if (is_numeric($_POST['hdu_distance']))
            {
                $hdu_distance = $_POST['hdu_distance'];
            }
            else
            {
                $hdu_distance = 0;
            }
            if (is_numeric($_POST['hdu_hours']))
            {
                $hdu_hours = $_POST['hdu_hours'];
            }
            else
            {
                $hdu_hours = 0;
            }

            if (is_numeric($_POST['hdu_hrate']))
            {
                $hdu_hrate = $_POST['hdu_hrate'];
            }
            else
            {
                $hdu_hrate = ($this->hduprefs_hourlyrate > 0?$this->hduprefs_hourlyrate:0);
            }
            $hdu_a_dcost = $hdu_distance * $hdu_drate ;
            $hdu_a_hcost = $hdu_hours * $hdu_hrate;
            $hdu_a_totalcost = $hdu_fixcost + $hdu_callout + $hdu_a_fcost + $hdu_eqptcost + $hdu_a_dcost + $hdu_a_hcost;
            // if the ticket has been allocated to a helpdesk then set the time
            // print $_POST['hdu_tech']."hdu_tech";
            // print $_POST['hdu_allocated']."allocated";
            // print $_POST['hdu_callocated']."callocated";
            // *****************************************************************
            // *Work out the allocations
            // *****************************************************************
            // If the ticket is new and not supervisor or technician because they get the details tab
            if ($this->hdu_new && !$this->hdu_super && !$this->hdu_technician)
            {
                // If we auto assign a helpdesk if category given then do so
                if ($this->hduprefs_autoassign)
                {
                    // if we are auto assigning to helpdesk and no manual selection of assignee
                    // get the help desk associated with this category
                    if ($sql->db_Select("hdu_categories", "hducat_helpdesk", "where hducat_id = '" . intval($_POST['hdu_category']) . "'", "nowhere", false))
                    {
                        // Get the helpdesk to which this will be assigned if one exists
                        extract($sql->db_Fetch());
                        $hdu_a_tech = $hducat_helpdesk;
                        // else
                        // {
                        // if there isnt a helpdesk
                        // $hdu_a_tech = 0;
                        // }
                        if (intval($hdu_a_tech) > 0)
                        {
                            $_POST['hdu_resolution'] = $this->hduprefs_assigned;
                            $hdu_a_alloctime = time();
                        }
                    }
                }
                else
                {
                    $hdu_a_tech = intval($_POST['hdu_tech']);
                }
                // $hdu_a_resolution = 0;
                // $hdu_a_tech = 0;
            } elseif ($_POST['hdu_ctech'] != $_POST['hdu_tech'] && intval($_POST['hdu_tech']) > 0)
            {
                // Assignment has changed and not un assigned
                $hdu_a_tech = $_POST['hdu_tech'];
                $hdu_a_alloctime = time();
            } elseif (intval($_POST['hdu_tech']) == 0)
            {
                // ticket now unassigned
                $hdu_a_tech = 0;
                $hdu_a_alloctime = 0;
            }
            else
            {
                // No change made to assignment
                $hdu_a_tech = $_POST['hdu_tech'];
                $hdu_a_alloctime = intval($_POST['hdu_callocated']);
            }
            // *****************************************************************
            // *Work out the resolutions
            // *****************************************************************
            // If no resolution specified then get the default
            // print "W" . $this->hduprefs_defaultres;
            if ($this->hduprefs_defaultres > 0 && $this->hdu_new && intval($_POST['hdu_resolution']) == 0)
            {
                $hdu_a_resolution = $this->hduprefs_defaultres;
            }
            else
            {
                // otherwise use the resolution specified
                $hdu_a_resolution = intval($_POST['hdu_resolution']);
            }
            // *****************************************************************
            // * Work out the status
            // *****************************************************************
            // Work out if the ticket is open or closed
            // Is this resolution is one that closes the ticket and not already closed then automatically then close the ticket.
            if ($this->hdu_statcloses($hdu_a_resolution) && intval($_POST['hdu_readyclosed']) == 0)
            {
                // print "closed";
                $hdu_a_closed = time();
            } elseif (!$this->hdu_statcloses($hdu_a_resolution))
            {
                // print "opened";
                $hdu_a_closed = 0;
            }
            else
            {
                $hdu_a_closed = intval($_POST['hdu_readyclosed']);
            }
            // if a comment has been posted and its by a user and this repoens then set status or if technician or supervisor then reopen
            if (!empty($_POST['hduc_comment']) && intval($_POST['hdu_readyclosed']) > 0 && ($this->hdu_technician || $this->hdu_super || $this->hduprefs_reopen))
            {
                if (intval($_POST['hdu_tech']) == 0)
                {
                    // if no status assigned set tod default open status
                    $hdu_a_resolution = $this->hduprefs_defaultres;
                }
                else
                {
                    $hdu_a_resolution = $this->hduprefs_assigned;
                }
                $hdu_a_closed = 0;
            }
            // *
            // *
            // print "$hdu_a_totalcost - $hdu_a_fcost - $hdu_a_dcost - $hdu_a_hcost - " . $_POST['hdu_eqptcost'] . " - " . $_POST['hdu_callout'] . "-";
            // Set all the parameters for inserting in to the db
            if ($this->hdu_new)
            {
                if (intval($_POST['hdu_selusers']) > 0)
                {
                    // Get poster's name and id if it was from a quick entry
                    $hdu_a_posterid = intval($_POST['hdu_selusers']);
                    $hdu_a_poster = $this->hdu_getposterdetails($hdu_a_posterid);
                    $hdu_email = $tp->toDB($this->hdu_getuseremail($hdu_a_posterid));
                }
                else
                {
                    // If they are a logged in user then get their username and id
                    $hdu_a_posterid = USERID;
                    $hdu_a_poster = $hdu_a_poster . USERID . "." . $tp->toDB(USERNAME);
                    $hdu_email = $tp->toDB(USEREMAIL);
                }
                // Insert the record
                // check if an existing identical ticket exists
                if ($sql->db_Select("hdunit", "hdu_id", "hdu_category='" . intval($_POST['hdu_category']) . "'
and hdu_summary='" . $tp->toDB($_POST['hdu_summary']) . "' and hdu_description='" . $tp->toDB($_POST['hdu_description']) . "' and
hdu_priority='" . intval($_POST['hdu_priority']) . "'"))
                {
                    // already exists
                    $hdu_result = -3;
                }
                else
                {
                    $hdu_args .= "
	'0',
	" . time() . ",
	'$hdu_a_poster',
	'$hdu_a_posterid',
	'" . intval($_POST['hdu_category']) . "',
	'" . $tp->toDB($_POST['hdu_summary']) . "',
	'" . $tp->toDB($_POST['hdu_description']) . "',
	'" . intval($_POST['hdu_priority']) . "',
	'" . $hdu_a_resolution . "',
	'" . $hdu_email . "',
	'" . $hdu_a_alloctime . "',
	'$hdu_a_tech',
	" . time() . ",
	'" . $hdu_a_closed . "',
	'" . $tp->toDB($_POST['hdu_tagno']) . "',
	'0',
	'0',
	'" . intval($_POST['hdu_fix']) . "',
	'" . $tp->toDB($hdu_fixother) . "',
	'" . $tp->toDB($hdu_fixcost) . "',
	'0',
	'" . $tp->toDB($hdu_distance) . "',
	'" . $tp->toDB($hdu_drate) . "',
	'" . $hdu_a_dcost . "',
	'" . $tp->toDB($hdu_hours) . "',
	'" . $tp->toDB($hdu_hrate) . "',
	'" . $hdu_a_hcost . "',
	'" . $tp->toDB($hdu_callout) . "',
	'" . $tp->toDB($hdu_eqptcost) . "',
	'" . $hdu_a_totalcost . "'";
                    $id = $sql->db_Insert("hdunit", $hdu_args, false);
                    if ($id > 0)
                    {
                        // Ticket created
                        $hdu_result = $id;
                    }
                    else
                    {
                        // unable to create ticket
                        $hdu_result = -2;
                    }
                }
            }
            else
            {
                if ($_POST['hdu_commentonly'] == "no")
                {
                    // only save if not just user's comments
                    $this->hdu_new = false;
                    // ***************************************************************
                    // * Save an existing ticket
                    // ***************************************************************
                    $hdu_email = $_POST['hdu_email'];
                    $hdu_args .= "hdu_category = '" . intval($_POST['hdu_category']) . "',";
                    $hdu_args .= "hdu_summary = '" . $tp->toDB($_POST['hdu_summary']) . "',";
                    $hdu_args .= "hdu_description = '" . $tp->toDB($_POST['hdu_description']) . "',";
                    $hdu_args .= "hdu_priority = '" . intval($_POST['hdu_priority']) . "',";
                    $hdu_args .= "hdu_resolution = '" . $hdu_a_resolution . "',";
                    $hdu_args .= "hdu_email = '" . $hdu_email . "',";
                    $hdu_args .= "hdu_allocated = '" . $hdu_a_alloctime . "',";
                    $hdu_args .= "hdu_tech = '" . $hdu_a_tech . "',";
                    $hdu_args .= "hdu_lastchanged = '" . time() . "',";
                    $hdu_args .= "hdu_closed = '" . $hdu_a_closed . "',";
                    $hdu_args .= "hdu_tagno = '" . $tp->toDB($_POST['hdu_tagno']) . "',";
                    $hdu_args .= "hdu_fix = '" . intval($_POST['hdu_fix']) . "',";
                    $hdu_args .= "hdu_fixother = '" . $tp->toDB($_POST['hdu_fixother']) . "',";
                    $hdu_args .= "hdu_fixcost = '" . $tp->toDB($hdu_fixcost) . "',";
                    $hdu_args .= "hdu_distance = '" . $tp->toDB($hdu_distance) . "',";
                    $hdu_args .= "hdu_drate = '" . $tp->toDB($hdu_drate) . "',";
                    $hdu_a_dcost = $hdu_a_dcost;
                    $hdu_args .= "hdu_dcost = '" . $tp->toDB($hdu_a_dcost) . "',";
                    $hdu_args .= "hdu_hours = '" . $tp->toDB($hdu_hours) . "',";
                    $hdu_a_hcost = $hdu_a_hcost;
                    $hdu_args .= "hdu_hrate = '" . $tp->toDB($hdu_hrate) . "',";
                    $hdu_args .= "hdu_hcost = '" . $hdu_a_hcost . "',";
                    $hdu_args .= "hdu_eqptcost = '" . $tp->toDB($hdu_eqptcost) . "',";
                    $hdu_args .= "hdu_callout = '" . $tp->toDB($hdu_callout) . "',";
                    $hdu_args .= "hdu_totalcost = '" . $hdu_a_totalcost . "'";
                    $hdu_args .= " where hdu_id = '" . intval($id) . "' " ;
                    if ($sql->db_Update("hdunit", $hdu_args, false))
                    {
                        $hdu_result = $id;
                    }
                    else
                    {
                        $hdu_result = -2;
                    }
                    $hdu_recno = intval($id);
                }
                $this->helpdesk_cache_clear();
            }
            // *****************************************************************
            // * If configured to produce a pdf then do so.
            // * We should also check if we can produce the pdf (directory writable
            // * etc)
            // * Else just send the emails
            // *****************************************************************
            // if ($this->hdu_new)
            // {
            // $hdu_msg .= "<br /><a href='?$from..." . $_POST['R1'] . "'>" . HDU_32 . "</a>";
            // }
            // else
            // {
            // $hdu_msg .= HDU_79 . "<br /><a href='?$from..." . $_POST['R1'] . "'>" . HDU_32 . "</a>";
            // }
            // make sure buffer is empty
            // ob_flush();
            if ($hdu_result)
            {
                if ($this->hduprefs_mailpdf)
                {
                    require_once("pdfit.php");
                    pdfit($hdu_recno, "f", "Helpdesk", e_PLUGIN . "helpdesk3_menu/pdfout/" . "helpdesk" . $hdu_recno . ".pdf", "A4");
                    $this->hdu_notify($id, $this->hdu_new);
                }
                else
                {
                    $this->hdu_notify($id, $this->hdu_new);
                }
            }
            if (!empty($_POST['hduc_comment']))
            {
                $this->post_comment();
                // now check if posting a comment re opens the ticket
                // add code
                $hdu_result = $id;
            }
        }
        return $hdu_result;
    }
    // **********************************************************************************************
    // *
    // *	Function	:	hdu_notify($hdu_notifyid = 0, $hdu_notifyaction)
    // *
    // *	Parameters	:	$hdu_notifyid integer the ticket number
    // *				:	$hdu_notifyaction boolean update or new ticket
    // *
    // *
    // *
    // *
    // **********************************************************************************************
    function hdu_notify($hdu_notifyid = 0, $hdu_notifyaction)
    {
        global $tp, $sql, $sql2, $PLUGINS_DIRECTORY, $pref, $sysprefs, $pm_prefs, $HELPDESK_PREF,
        $hdu_up_db, $hdu_msg, $hdu_recno,
        $hdu_newing,
        $hdu_email,
        $hdu_a_tech;
        // get the record for this particular ticket
        $sql->db_Select_gen("
		select * from #hdunit
		left join #hdu_categories on hdu_category=hducat_id
		left join #hdu_helpdesk on hducat_helpdesk=hdudesk_id
		left join #hdu_resolve on  hdu_resolution=hdures_id
		left join #user on hdu_posterid=user_id
		where hdu_id = $hdu_notifyid", false);
        extract($sql->db_Fetch());
        // get the poster name
        $hduposterdet = explode(".", $hdu_poster, 2);
        $hduposterid = $hduposterdet[0];
        $hdupostername = $hduposterdet[1];
        // *******************************
        // * Get the necessary files for emailing and PMing
        // *******************************
        require_once(e_HANDLER . "mail.php");
        $retrieve_prefs[] = 'pm_prefs';
        require_once(e_PLUGIN . "pm/pm_class.php");
        require_once(e_PLUGIN . "pm/pm_func.php");
        $lan_file = e_PLUGIN . "pm/languages/" . e_LANGUAGE . ".php";
        include_lan(e_PLUGIN . "pm/languages/English.php");

        $pm_prefs = $sysprefs->getArray("pm_prefs");
        $hdum_pm = new private_message;
        // Get the technician class
        // $sql->db_Select("hdu_helpdesk", "*", "where hdudesk_id=$hdu_a_tech", "nowhere", false);
        // $hdu_hrow = $sql->db_Fetch();
        // $hdu_technician_class = $hdu_hrow['hdudesk_class'];
        $message = $hdum_head . $hdum_info . $hdum_message . $hdum_link;
        // ********************
        // * 1. process the user
        // * 2. process supervisor
        // * 3. process technicians
        // * 4. Email the helpdesk's email
        // *********************
        // Check if we notify the user and we have a valid user id
        if ($this->hduprefs_mailuser > 0 && $user_id > 0)
        {
            // Check if we notify the user by email
            if ($this->hduprefs_mailuser == 1)
            {
                // Do we notify the user of updates to their ticket by email?
                // You can only send an email if the user's id > 0 otherwise they are not a registered user
                $hdu_message1 = $tp->toFORM(($hdu_notifyaction? $this->hduprefs_usertext:$this->hduprefs_updateuser)) . "<br /><br />";
                $hdu_message1 .= HDU_44 . "<br /><br />";
                $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
                $hdu_message1 .= HDU_22 . "<a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.$hdu_notifyid '>" . HDU_209 . "</a><br /><br />";
                $hdu_message1 .= HDU_43 . "<br /><br />";
                $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_usersubject:$this->hduprefs_userupsubject));
                if ($this->hduprefs_mailpdf)
                {
                    // Do we send ticket as a pdf
                    if (sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name, e_PLUGIN . "helpdesk3_menu/pdfout/helpdesk" . $hdu_notifyid . ".pdf"))
                    {
                        $hdu_msg .= HDU_46 . " $hdu_email<br />";
                    }
                    else
                    {
                        $hdu_msg .= HDU_47 . " $hdu_email<br />";
                    }
                }
                else
                {
                    // Dont send a pdf of the ticket
                    // sendemail($send_to, $subject, $message, $to_name, $send_from='', $from_name='', $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="")
                    // print " uemail - $hdu_email - $hdu_subject - $user_name - $hdudesk_email - $hdudesk_name";
                    if (sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name))
                    {
                        $hdu_msg .= HDU_46 . "<br />";
                    }
                    else
                    {
                        $hdu_msg .= HDU_47 . "<br />";
                    }
                }
            } // end : if ($this->hduprefs_mailuser == 1 && $user_id>0)
            // Check if we notify the user by PM
            if ($this->hduprefs_mailuser == 2)
            {
                // Do we notify the user of updates to their ticket by PM?
                // You can only send a PM if the user's id > 0 otherwise they are not a registered user
                $hdu_message1 = "<hr />" . $tp->toFORM(($hdu_notifyaction? $this->hduprefs_usertext:$this->hduprefs_updateuser)) . "<br /><br />";
                $hdu_message1 .= HDU_44 . "<br /><br />";
                $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
                $hdu_message1 .= HDU_22 . " <a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.{$hdu_notifyid }' >" . HDU_209 . "</a><br /><br />";
                $hdu_message1 .= HDU_43 . "<br /><br /><hr />";
                $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_usersubject:$this->hduprefs_userupsubject));
                $hdu_vars['pm_subject'] = $hdu_subject;
                $hdu_vars['pm_message'] = $hdu_message1;
                $hdu_vars['to_info']['user_id'] = $user_id;
                $hdu_vars['from_id'] = $this->hduprefs_pmfrom;
                $hdu_vars['to_info']['user_email'] = $hdu_email;
                $hdu_vars['to_info']['user_name'] = $user_name;
                $hdu_vars['to_info']['user_class'] = $user_class;
                $res = $this->add($hdu_vars);
            }
        }
        // Check if we notify the supervisor class and supervisor class is active
        if ($this->hduprefs_mailhelpdesk > 0 && $HELPDESK_PREF['hduprefs_supervisorclass'] < 255)
        {
            // get a list of supervisors
            $hdusclist = $HELPDESK_PREF['hduprefs_supervisorclass'];
            if ($hdusclist == 254)
            {
                // admin
                $hdu_where = 'where user_admin=1';
            } elseif ($hdusclist == 250)
            {
                // main admin
                $hdu_where = 'where user_admin=1 and left(user_perms,1)="0"';
            }
            else
            {
                // normal userclass
                $hdu_where = "where find_in_set({$hdusclist},user_class)";
            }

            $hdu_arg = "select user_id,user_name,user_email from #user {$hdu_where} ";
            $hdu_gotsuper = $sql->db_Select_gen($hdu_arg, false);
            if ($hdu_gotsuper)
            {
                while ($hdu_row = $sql->db_Fetch())
                {
                    $hdu_supers[] = array('user_id' => $hdu_row['user_id'], 'user_name' => $hdu_row['user_name'], 'user_email' => $hdu_row['user_email']);
                }
            }
            foreach($hdu_supers as $value)
            {
                // check if we notify the supervisor class by email
                $user_email = $value['user_email'];
                $user_name = $value['user_name'];
                $user_id = $value['user_id'];
                if ($this->hduprefs_mailhelpdesk == 1)
                {
                    // get the email address for this helpdesk
                    $hdu_message1 = $tp->toFORM(($hdu_notifyaction? $this->hduprefs_helpdesktext:$this->hduprefs_updatehelpdesk)) . "<br /><br />";
                    $hdu_message1 .= HDU_44 . "<br /><br />";
                    $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
                    $hdu_message1 .= HDU_22 . "<a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.$hdu_notifyid '>" . HDU_209 . "</a><br /><br />";
                    $hdu_message1 .= HDU_43 . "<br /><br />";
                    $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_helpdesksubject:$this->hduprefs_helpupsubject));
                    // Get all the members of the class for this helpdesk and email each one
                    // hdu_tech
                    $hdu_technician_class = $hdu_a_tech;
                    // $hdu_mailarg = "select user_id,user_email,user_name,user_class from #user where find_in_set('$hdudesk_class',user_class)";
                    // $sql->db_Select_gen($hdu_mailarg, false);
                    // print $hdu_mailarg;
                    // while ($hdu_row = $sql->db_Fetch())
                    // {
                    // extract($hdu_row);
                    // print $user_email;
                    // print "<br>tech " . $user_email;
                    if ($this->hduprefs_mailpdf)
                    {
                        // print " uemail - $user_email ";
                        sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name, e_PLUGIN . "helpdesk3_menu/pdfout/helpdesk" . $hdu_notifyid . ".pdf");
                    }
                    else
                    {
                        // sendemail($send_to, $subject, $message, $to_name, $send_from='', $from_name='', $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="")
                        // print " uemail - $user_email - $hdu_subject - $user_name - $hdudesk_email - $hdudesk_name";
                        sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name);
                    }
                    // } // while
                }
                // if there is an email address specified for the helpdesk then email that anyway.
                if ($this->hduprefs_mailhelpdesk == 2)
                {
                    // PM Team all members of the user class containing the technicians
                    unset($hdu_vars);
                    $hdu_message1 = $tp->toFORM(($hdu_newing?$hduprefs_helpdesktext:$hduprefs_updatehelpdesk)) . "<br /><br />";
                    $hdu_message1 .= HDU_44 . "<br /><br />";
                    $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
                    $hdu_message1 .= HDU_22 . " <a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.{$hdu_notifyid }' >" . HDU_209 . "</a><br /><br />";
                    $hdu_message1 .= HDU_43 . "<br /><br /><hr />";
                    $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_helpdesksubject:$this->hduprefs_helpupsubject));
                    // $hdu_mailarg = "select user_id,user_email,user_class from #user where find_in_set('$hdudesk_class',user_class)";
                    // $hdu_sql = new db;
                    // $hdu_sql->db_Select_gen($hdu_mailarg, false);
                    // print $hdu_mailarg;
                    // while ($hdu_row = $hdu_sql->db_Fetch())
                    // {
                    // extract($hdu_row);
                    // print $user_email;
                    $hdu_up_hemail = $user_email;
                    $hdu_vars['pm_subject'] = $hdu_subject;
                    $hdu_vars['pm_message'] = $hdu_message1;
                    $hdu_vars['to_info']['user_id'] = $user_id;
                    $hdu_vars['from_id'] = $this->hduprefs_pmfrom;;
                    $hdu_vars['to_info']['user_email'] = $user_email;
                    $hdu_vars['to_info']['user_name'] = $user_name;
                    // $hdu_vars['to_info']['user_class'] = $user_class;
                    $res = $this->add($hdu_vars);
                    // } // while
                }
            }
        }
        // Check if we notify the helpdesk class with technicians and supervisor class is active
        if ($this->hduprefs_mailhelpdesk > 0 && $hdudesk_class < 255)
        {
            // get a list of supervisors
            $hdusclist = $hdudesk_class;
            if ($hdusclist == 254)
            {
                // admin
                $hdu_where = 'where user_admin=1';
            } elseif ($hdusclist == 250)
            {
                // main admin
                $hdu_where = 'where user_admin=1 and left(user_perms,1)="0"';
            }
            else
            {
                // normal userclass
                $hdu_where = "where find_in_set({$hdusclist},user_class)";
            }
            // Get all the members of the class for this helpdesk and email each one
            $hdu_arg = "select user_id,user_name,user_email from #user {$hdu_where} ";
            $hdu_gottech = $sql->db_Select_gen($hdu_arg, false);
            if ($hdu_gottech)
            {
                while ($hdu_row = $sql->db_Fetch())
                {
                    $hdu_techs[] = array('user_id' => $hdu_row['user_id'], 'user_name' => $hdu_row['user_name'], 'user_email' => $hdu_row['user_email']);
                }
            }

            foreach($hdu_techs as $value)
            {
                // check if we notify the supervisor class by email
                $user_email = $value['user_email'];
                $user_name = $value['user_name'];
                $user_id = $value['user_id'];
                if ($this->hduprefs_mailhelpdesk == 1)
                {
                    // get the email address for this helpdesk
                    $hdu_message1 = $tp->toFORM(($hdu_notifyaction? $this->hduprefs_helpdesktext:$this->hduprefs_updatehelpdesk)) . "<br /><br />";
                    $hdu_message1 .= HDU_44 . "<br /><br />";
                    $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
                    $hdu_message1 .= HDU_22 . "<a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.$hdu_notifyid '>" . HDU_209 . "</a><br /><br />";
                    $hdu_message1 .= HDU_43 . "<br /><br />";
                    $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_helpdesksubject:$this->hduprefs_helpupsubject));
                    $hdu_technician_class = $hdu_a_tech;

                    if ($this->hduprefs_mailpdf)
                    {
                        // print " uemail - $user_email ";
                        sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name, e_PLUGIN . "helpdesk3_menu/pdfout/helpdesk" . $hdu_notifyid . ".pdf");
                    }
                    else
                    {
                        // sendemail($send_to, $subject, $message, $to_name, $send_from='', $from_name='', $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="")
                        // print " uemail - $user_email - $hdu_subject - $user_name - $hdudesk_email - $hdudesk_name";
                        sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name);
                    }
                    // } // while
                }
                // if there is an email address specified for the helpdesk then email that anyway.
                if ($this->hduprefs_mailhelpdesk == 2)
                {
                    // PM Team all members of the user class containing the technicians
                    unset($hdu_vars);
                    $hdu_message1 = $tp->toFORM(($hdu_newing?$hduprefs_helpdesktext:$hduprefs_updatehelpdesk)) . "<br /><br />";
                    $hdu_message1 .= HDU_44 . "<br /><br />";
                    $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
                    $hdu_message1 .= HDU_22 . " <a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.{$hdu_notifyid }' >" . HDU_209 . "</a><br /><br />";
                    $hdu_message1 .= HDU_43 . "<br /><br /><hr />";
                    $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_helpdesksubject:$this->hduprefs_helpupsubject));
                    // $hdu_mailarg = "select user_id,user_email,user_class from #user where find_in_set('$hdudesk_class',user_class)";
                    // $hdu_sql = new db;
                    // $hdu_sql->db_Select_gen($hdu_mailarg, false);
                    // print $hdu_mailarg;
                    // while ($hdu_row = $hdu_sql->db_Fetch())
                    // {
                    // extract($hdu_row);
                    // print $user_email;
                    $hdu_up_hemail = $user_email;
                    $hdu_vars['pm_subject'] = $hdu_subject;
                    $hdu_vars['pm_message'] = $hdu_message1;
                    $hdu_vars['to_info']['user_id'] = $user_id;
                    $hdu_vars['from_id'] = $this->hduprefs_pmfrom;;
                    $hdu_vars['to_info']['user_email'] = $user_email;
                    $hdu_vars['to_info']['user_name'] = $user_name;
                    // $hdu_vars['to_info']['user_class'] = $user_class;
                    $res = $this->add($hdu_vars);
                    // } // while
                }
            }
        }
        if (!empty($hdudesk_email))
        {
            $hdu_message1 = $tp->toFORM(($hdu_notifyaction? $this->hduprefs_helpdesktext:$this->hduprefs_updatehelpdesk)) . "<br /><br />";
            $hdu_message1 .= HDU_44 . "<br /><br />";
            $hdu_plugloc = SITEURL . $PLUGINS_DIRECTORY;
            $hdu_message1 .= HDU_22 . "<a href='" . $hdu_plugloc . "helpdesk3_menu/helpdesk.php?0.show.$hdu_notifyid '>" . HDU_209 . "</a><br /><br />";
            $hdu_message1 .= HDU_43 . "<br /><br />";
            $hdu_subject = $tp->toFORM(($hdu_notifyaction?$this->hduprefs_helpdesksubject:$this->hduprefs_helpupsubject));
            $user_email = $hdudesk_email;
            if ($this->hduprefs_mailpdf)
            {
                // print " uemail - $user_email ";
                sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name, e_PLUGIN . "helpdesk3_menu/pdfout/helpdesk" . $hdu_notifyid . ".pdf");
            }
            else
            {
                // sendemail($send_to, $subject, $message, $to_name, $send_from='', $from_name='', $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="")
                // print " uemail - $user_email - $hdu_subject - $user_name - $hdudesk_email - $hdudesk_name";
                sendemail($user_email, $hdu_subject . "- [$hdu_id]", $hdu_message1, $user_name, $hdudesk_email, $this->hduprefs_emailfrom . " " . $hdudesk_name);
            }
        }
    }
    function add($vars)
    {
        global $pm_prefs, $tp, $sql;
        $vars['options'] = "";
        $pmsize = 0;
        $attachlist = "";
        $pm_options = "";
        if (isset($vars['receipt']) && $vars['receipt'])
        {
            $pm_options .= "+rr+";
        }
        if (isset($vars['uploaded']))
        {
            foreach($vars['uploaded'] as $u)
            {
                if (!isset($u['error']))
                {
                    $pmsize += $u['size'];
                    $a_list[] = $u['name'];
                }
            }
            $attachlist = implode(chr(0), $a_list);
        }
        $pmsize += strlen($vars['pm_message']);
        $pm_subject = $tp->toDB($vars['pm_subject']);
        $pm_message = $tp->toDB($vars['pm_message'], false, true);
        $sendtime = time();
        if (isset($vars['to_userclass']) || isset($vars['to_array']))
        {
            if (isset($vars['to_userclass']))
            {
                require_once(e_HANDLER . "userclass_class.php");
                $toclass = r_userclass_name($vars['pm_userclass']);
                $tolist = $this->get_users_inclass($vars['pm_userclass']);
                $ret .= LAN_PM_38 . ": {$vars['to_userclass']}<br />";
                $class = true;
            }
            else
            {
                $tolist = $vars['to_array'];
                $class = false;
            }
            foreach($tolist as $u)
            {
                set_time_limit(30);
                if ($pmid = $sql->db_Insert("private_msg", "0, '" . intval($vars['from_id']) . "', '" . $tp->toDB($u['user_id']) . "', '" . intval($sendtime) . "', '0', '{$pm_subject}', '{$pm_message}', '1', '0', '" . $tp->toDB($attachlist) . "', '" . $tp->toDB($pm_options) . "', '" . intval($pmsize) . "'"))
                {
                    if ($class == false)
                    {
                        $toclass .= $u['user_name'] . ", ";
                    }
                    if (check_class($pm_prefs['notify_class'], $u['user_class']))
                    {
                        $vars['to_info'] = $u;
                        $this->pm_send_notify($u['user_id'], $vars, $pmid, count($a_list));
                    }
                }
                else
                {
                    $ret .= LAN_PM_39 . ": {$u['user_name']} <br />";
                }
            }
            if (!$pmid = $sql->db_Insert("private_msg", "0, '" . intval($vars['from_id']) . "', '" . $tp->toDB($toclass) . "', '" . intval($sendtime) . "', '1', '{$pm_subject}', '{$pm_message}', '0', '0', '" . $tp->toDB($attachlist) . "', '" . $tp->toDB($pm_options) . "', '" . intval($pmsize) . "'"))
            {
                $ret .= LAN_PM_41 . "<br />";
            }
        }
        else
        {
            if ($pmid = $sql->db_Insert("private_msg", "0, '" . intval($vars['from_id']) . "', '" . $tp->toDB($vars['to_info']['user_id']) . "', '" . intval($sendtime) . "', '0', '{$pm_subject}', '{$pm_message}', '0', '0', '" . $tp->toDB($attachlist) . "', '" . $tp->toDB($pm_options) . "', '" . intval($pmsize) . "'"))
            {
                if (check_class($pm_prefs['notify_class'], $vars['to_info']['user_class']))
                {
                    set_time_limit(30);
                    $this->pm_send_notify($vars['to_info']['user_id'], $vars, $pmid, count($a_list));
                }
                $ret .= LAN_PM_40 . ": {$vars['to_info']['user_name']}<br />";
            }
        }
        return $ret;
    }
    function pm_send_notify($uid, $pminfo, $pmid, $attach_count = 0)
    {
        require_once(e_HANDLER . "mail.php");
        global $PLUGINS_DIRECTORY;
        $subject = LAN_PM_100 . SITENAME;
        $pmlink = SITEURL . $PLUGINS_DIRECTORY . "pm/pm.php?show.{$pmid}";
        $txt = LAN_PM_101 . SITENAME . "\n\n";
        $txt .= LAN_PM_102 . USERNAME . "\n";
        $txt .= LAN_PM_103 . $pminfo['pm_subject'] . "\n";
        if ($attch_count > 0)
        {
            $txt .= LAN_PM_104 . $attach_count . "\n";
        }
        $txt .= LAN_PM_105 . "\n" . $pmlink . "\n";
        sendemail($pminfo['to_info']['user_email'], $subject, $txt, $pminfo['to_info']['user_name']);
    }

    function tablerender($caption, $text, $mode = "default", $return = false)
    {
        global $ns, $HELPDESK_PREF;
        // do the mod rewrite steps if installed
        // $modules = apache_get_modules();
        if ($HELPDESK_PREF['hduprefs_seo'] == 1)
        {
            $patterns[0] = '/' . $PLUGINS_DIRECTORY . '\/helpdesk3_menu\/helpdesk\.php\?([0-9]+).([a-z]+).([0-9]+).([0-9]+)/';
            $patterns[1] = '/' . $PLUGINS_DIRECTORY . '\/helpdesk3_menu\/helpdesk\.php\?([0-9]+).([a-z]+).([0-9]+)/';
            $replacements[0] = '/helpdesk3_menu/helpdesk-$1-$2-$3-$4.html';
            $replacements[1] = '/helpdesk3_menu/helpdesk-$1-$2-$3.html';

            $text = preg_replace($patterns, $replacements, $text);
        }
        $ns->tablerender($caption, $text, $mode , $return);
    }
    function regen_htaccess($onoff)
    {
        $hta = '.htaccess';
        $pattern = array("\n", "\r");
        $replace = array("", "");
        if (is_writable($hta) || !file_exists($hta))
        {
            // open the file for reading and get the contents
            $file = file($hta);
            $skip_line = false;
            unset($new_line);
            foreach($file as $line)
            {
                if (strpos($line, '*** HELPDESK REWRITE BEGIN ***') > 0)
                {
                    // we start skipping
                    $skip_line = true;
                }

                if (!$skip_line)
                {
                    // print strlen($line) . '<br>';
                    $new_line[] = str_replace($pattern, $replace, $line);
                }
                if (strpos($line, '*** HELPDESK REWRITE END ***') > 0)
                {
                    $skip_line = false;
                }
            }
            if ($onoff == 'on')
            {
                $base_loc = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
                $new_line[] = "#*** HELPDESK REWRITE BEGIN ***";
                $new_line[] = 'RewriteEngine On';
                $new_line[] = "RewriteBase $base_loc";
                $new_line[] = 'RewriteRule helpdesk.html helpdesk.php';
                $new_line[] = 'RewriteRule helpdesk-([0-9]*)-([a-z]*)-([0-9]*)\.html(.*)$ helpdesk.php?$1.$2.$3';
                $new_line[] = 'RewriteRule helpdesk-([0-9]*)-([a-z]*)-([0-9]*)-([0-9]*)\.html(.*)$ helpdesk.php?$1.$2.$3.$4';
                $new_line[] = '#*** HELPDESK REWRITE END ***';
                $outwrite = implode("\n", $new_line);
            }
            else
            {
                $outwrite = implode("\n", $new_line);
            }
            $retval = 0;
            if ($fp = fopen('tmp.txt', 'wt'))
            {
                // we can open the file for reading
                if (fwrite($fp, $outwrite) !== false)
                {
                    fclose($fp);
                    // we have written the new data to temp file OK
                    if (is_readable('old.htaccess'))
                    {
                        // there is an old htaccess file so delete it
                        if (!unlink('old.htaccess'))
                        {
                            $retval = 2;
                        }
                    }
                    if ($retval == 0)
                    {
                        // old one deleted OK so rename the existing to the old one
                        if (is_readable('.htaccess'))
                        {
                            // if there is an old .htaccess then rename it
                            if (!rename('.htaccess', 'old.htaccess'))
                            {
                                $retval = 3;
                            }
                        }
                    }
                    if ($retval == 0)
                    {
                        // successfully renamed existing htaccess to old.htaccess
                        // so rename the temp file to .htaccess
                        if (!rename('tmp.txt', '.htaccess'))
                        {
                            $retval = 4;
                        }
                    }
                }
                else
                {
                    // unable to open temporary file
                    $retval = 5;
                }
            }
            else
            {
                fclose($fp);
                $retval = 1;
            }
            return $retval;
            // unlink('old.htaccess');
            // print_a($new_line);
        }
    }
}
