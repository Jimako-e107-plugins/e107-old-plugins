<?php
/**
 * Glossary by Shirka (www.shirka.org)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * ©Andre DUCLOS 2006
 * http://www.shirka.org
 * duclos@shirka.org
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: /home/e-smith/files/ibays/cvsroot/files/glossary/glossary_class.php,v $
 * $Revision: 1.18 $
 * $Date: 2006/06/28 01:16:10 $
 * $Author: duclos $
 */

if (!defined('e107_INIT')) { exit; }

// OLD include_lan(e_PLUGIN."glossary/languages/".e_LANGUAGE."/Lan_".basename(__FILE__));
e107::lan('glossary','class',true);

class glossary_class
{
	var $message;
	var $caption;

  private $plugTemplates   = array();
  private $word_shortcodes = array();  
	/**
	 * Constructor.
	 */
	function __construct()
	{
		$this->word_shortcodes = e107::getScBatch('glossary', 'glossary');
 
    /* div layout - to do */
		if(deftrue('BOOTSTRAP') === 3)  {
		   $glosarytemplate   = e107::getTemplate('glossary', 'glossarybootstrap3' );
	     $this->word_shortcodes->wrapper('glossarybootstrap3/glossary');
		}
		/* table layout */
		else {
			 $glosarytemplate   = e107::getTemplate('glossary', 'glossarytable' );
			 $this->word_shortcodes->wrapper('glossarytable/glossary');
		} 
		
		$this->plugTemplates['WORD_BODY_MENU']  		= $glosarytemplate['WORD_BODY_MENU'];  
		$this->plugTemplates['WORD_MENU_TITLE'] 		= $glosarytemplate['WORD_MENU_TITLE'];		
		$this->plugTemplates['WORD_BODY_PAGE']  		= $glosarytemplate['WORD_BODY_PAGE'];  
		$this->plugTemplates['BACK_TO_TOP']     		= $glosarytemplate['BACK_TO_TOP'];
		$this->plugTemplates['WORD_PAGE_TITLE']   	= $glosarytemplate['WORD_PAGE_TITLE'];  
		$this->plugTemplates['WORD_PAGE_START']     = $glosarytemplate['WORD_PAGE_START'];  
		$this->plugTemplates['WORD_PAGE_END']       = $glosarytemplate['WORD_PAGE_END'];
		$this->plugTemplates['WORD_CHAR_START']     = $glosarytemplate['WORD_CHAR_START'];
		$this->plugTemplates['WORD_CHAR_END']       = $glosarytemplate['WORD_CHAR_END'];
		$this->plugTemplates['WORD_ANCHOR'] 				= $glosarytemplate['WORD_ANCHOR'];	
		$this->plugTemplates['WORD_CHAR_LINK']  		= $glosarytemplate['WORD_CHAR_LINK'];  
		$this->plugTemplates['WORD_CHAR_NOLINK'] 		= $glosarytemplate['WORD_CHAR_NOLINK'];
		$this->plugTemplates['WORD_ALLCHAR_PRE']  	= $glosarytemplate['WORD_ALLCHAR_PRE'];  
		$this->plugTemplates['WORD_ALLCHAR_POST'] 	= $glosarytemplate['WORD_ALLCHAR_POST'];		
		$this->plugTemplates['PRINT_MESSAGE_PRE']  	= $glosarytemplate['PRINT_MESSAGE_PRE'];  
		$this->plugTemplates['PRINT_MESSAGE_POST'] 	= $glosarytemplate['PRINT_MESSAGE_POST'];				
		$this->plugTemplates['LINK_PAGE_NAVIGATOR'] = $glosarytemplate['LINK_PAGE_NAVIGATOR'];  
		$this->plugTemplates['LINK_MENU_NAVIGATOR'] = $glosarytemplate['LINK_MENU_NAVIGATOR'];	
  			
	}
	
	function setPageTitle()
	{
		global $sql, $action ;
    $pref = e107::getPlugConfig('glossary')->getPref();
		// Show all words
		if (!$action)
			$page = LAN_GLOSSARY_PAGETITLE_01." / ".LAN_GLOSSARY_PAGETITLE_02;

		if ($action == "submit" && check_class($pref['glossary_submit_class']))
			$page = LAN_GLOSSARY_PAGETITLE_01." / ".LAN_GLOSSARY_PAGETITLE_03;

		define("e_PAGETITLE", $page);
	}

	function build_message($message)
	{
 		$text  = e107::getParser()->parseTemplate($this->plugTemplates['PRINT_MESSAGE_PRE'], FALSE);
		$text .= $message;
		$text .= e107::getParser()->parseTemplate($this->plugTemplates['PRINT_MESSAGE_POST'], FALSE);

		return $text;
	}

	function show_message($message, $caption='')
	{
		global $ns;

		$ns->tablerender($caption, $this->build_message($message));
	}

	function first_car($word)
	{
 
		$head = e107::getParser()->toHTML($word, TRUE, "no_hook");

		if(ord($head) < 128)
			$head_sub = strtoupper(substr($head,0,1));
		else
			$head_sub = substr($head,0,2);
			
		return $head_sub;
	}

	function show_letter($approved)
	{

		$distinctwords = e107::getDb()->retrieve("glossary", " DISTINCT(glo_name) ", "glo_approved = '$approved' ORDER BY glo_name ASC", "default");
		foreach($distinctwords AS $row) 
		{
			$arrletters[] = $this->first_car($row['glo_name']);
		}
		$distinctfirstletter = count($distinctwords);	 
		$arrletters = array_unique($arrletters);
		$arrletters = array_values($arrletters);
		sort($arrletters);
		$text = "";
		if($distinctfirstletter != 1)
		{
			$text .= "</fieldset></form><div class='e-container'>";  
			//$text .= $rs->form_open("post", e_SELF . ($approved ? "" : "?displaySubmitted"), "letters")."			
			$text .= e107::getForm()->open("letters", "get", e_SELF . ($approved ? "?mode=main" : "?mode=submitted"))."
				<table id='show_letter' style='".ADMIN_WIDTH."' class='table adminlist table-striped'>
					<thead><tr class='even'>
						<td colspan='2' class='fcaption'>".LAN_GLOSSARY_SHOWLETT_01."</td>
					</tr></thead>
				<tr>
					<td colspan='2' class='forumheader3' style='text-align: center;'>";

			for($i = 0; $i < count($arrletters); $i++)
			{
				if($arrletters[$i]!= "")
					//$text .= $rs->form_button("submit", "letter", strtoupper($arrletters[$i]), "", "", LAN_GLOSSARY_SHOWLETT_03);
					$text .= e107::getForm()->button( "letter", strtoupper($arrletters[$i]), "submit",   "", LAN_GLOSSARY_SHOWLETT_03);
			}

			//$text .= "&nbsp;".$rs->form_button("submit", "letter", LAN_GLOSSARY_SHOWLETT_02, "", "", LAN_GLOSSARY_SHOWLETT_04);
			$text .= "&nbsp;".e107::getForm()->button( "letter", LAN_GLOSSARY_SHOWLETT_02, "submit", "", LAN_GLOSSARY_SHOWLETT_04);
			$text .= "</td></tr></table>".e107::getForm()->close()."</div><form><fieldset>";
		}
		return $text;
	}
	
	function show_word($approved)
	{
		global $sql, $ns, $rs, $tp;

		$text = $this->show_letter($approved);

		$letter = (isset($_POST['letter']) ? $_POST['letter'] : "");
		if ($letter != "" && $letter != LAN_GLOSSARY_SHOWLETT_02 )
			$qryletter .= " AND glo_name LIKE '".$tp->toDB($letter)."%' ";
		else
			$qryletter .= "";
			
		$text .= "<div class='center'>\n";
		if (!$total = $sql->select("glossary", "*", "glo_approved = '$approved' ".$qryletter." ORDER BY glo_name ASC", "default"))
			$text .= $approved ? LAN_GLOSSARY_SHOWWORD_02 : LAN_GLOSSARY_SHOWSUB_03;
		else
		{
			if ($total < 20 || $letter != "")
			{
				$words = $sql -> db_getList('ALL', FALSE, FALSE, FALSE);
				$text .= $rs->form_open("post", e_SELF, $approved ? "wordsform" : "submitted_words")."
					<table id='show_word' style='".ADMIN_WIDTH."' class='fborder'>
						<tr>
							<td style='width: 5%; text-align: center;' class='fcaption'>ID</td>
							<td style='width:15%' class='fcaption'>".($approved ? LAN_GLOSSARY_SHOWWORD_03 : LAN_GLOSSARY_SHOWSUB_04)."</td>
							<td style='width:60%' class='fcaption'>".($approved ? LAN_GLOSSARY_SHOWWORD_07 : LAN_GLOSSARY_SHOWSUB_10)."</td>
							<td style='width:10%; text-align: center;' class='fcaption'>".($approved ? LAN_GLOSSARY_SHOWWORD_08 : LAN_GLOSSARY_SHOWSUB_05)."</td>
							<td style='width:10%; white-space:nowrap; text-align: center;' class='fcaption'>".($approved ? LAN_GLOSSARY_SHOWWORD_04 : LAN_GLOSSARY_SHOWSUB_06)."</td>
						</tr>\n";

				foreach($words as $word)
				{
					list($uid, $user) = explode(".", $word['glo_author']);

					$text .= "
						<tr>
							<td style='width: 5%; text-align: center;' class='forumheader3'>".$word[glo_id]."</td>
							<td style='width:15%' class='forumheader3'>".$word['glo_name']."</td>
							<td style='width:60%' class='forumheader3'>".$word['glo_description']."</td>
							<td style='width:10%' class='forumheader3'><a href='".e_BASE."user.php?id.".$uid."'>".$user."</a></td>
							<td style='width:10%; white-space:nowrap; text-align: center;' class='forumheader3'>
								<a href='".e_SELF."?edit.".$word['glo_id']."' title='".LAN_GLOSSARY_SHOWSUB_07."'>".ADMIN_EDIT_ICON."</a>
								<input type='image' title='".($approved ? LAN_GLOSSARY_SHOWWORD_06 : LAN_GLOSSARY_SHOWSUB_08)."' name='action[delete_{$word[glo_id]}]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".$tp->toJS(($approved ? LAN_GLOSSARY_SHOWWORD_05 : LAN_GLOSSARY_SHOWSUB_02)." [ ID: ".$word['glo_id']." ]")."')\" />";
					if ($approved && getperms("0"))
						$text .= "
								<a href='".e_SELF."?link.{$word[glo_id]}'>".($word[glo_linked] ? GLOSSARY_ICON_NOLINK : GLOSSARY_ICON_LINK)."</a>";
					$text .= "
							</td>
						</tr>";
				}
				$text .= "</table>".$rs->form_close();
			}
			else
				$text .= "<br /><div style='text-align:center'>".LAN_GLOSSARY_SHOWWORD_09."</div>";
		}

		$text .= "</div>";
		$ns->tablerender($approved ? LAN_GLOSSARY_SHOWWORD_01 : LAN_GLOSSARY_SHOWSUB_09, $text);
	}

	function showExistingWord()
	{
		$this->show_word(1);
	}
	
	function displaySubmittedWord()
	{
		$this->show_word(0);
	}

	function createDef($id = 0, $sub = 0)
	{
		global $sql, $tp, $ns, $rs ;
    $pref = e107::getPlugConfig('glossary')->getPref();
		$username = "";
		$word_link = 0;

		if ($id && !$sub)
		{
			if ($sql->db_Select("glossary", "*", "glo_id='$id'"))
			{
				$row				= $sql->db_Fetch();
				$word_link	= $row['glo_linked'];
				$username		= $row['glo_author'];
				if (e_WYSIWYG)
				{
					$word_name = $tp->toHTML($row['glo_name'], $parseBB = TRUE, "no_hook");
					$word_desc = $tp->toHTML($row['glo_description'], $parseBB = TRUE, "no_hook");
				}
				else
				{
					$word_name = $tp->toFORM($row['glo_name']);
					$word_desc = $tp->toFORM($row['glo_description']);
				}
			}
		}

		if ($username == "")
		{
			if (USER)
				$username = USERID.".".USERNAME;
			else
				$username = "0.".LAN_GLOSSARY_SUBMITWORD_03;
		}
		
		$text = "
		<div style='text-align:center'>
		".$rs->form_open("post", e_SELF, "dataform", "", "", "")."
				<table id='createDef'  class='fborder'>
					<tr>
						<td colspan='2' style='width:100%; text-align:center' class='forumheader'><b>";
		
		if (!$id || $sub)
			$text .= LAN_GLOSSARY_CREATEWORD_08;     
		else
			$text .= LAN_GLOSSARY_CREATEWORD_09;
		
		$text .= "</b>
						</td>
					</tr>
					<tr>
						<td style='width:20%' class='forumheader3'>".LAN_GLOSSARY_CREATEWORD_03."</td>
						<td style='width:80%' class='forumheader3'>			
							".$rs->form_text("word_name", 50, $word_name, "50")."
						</td>
					</tr>
					<tr>
						<td style='width:20%' class='forumheader3'>".LAN_GLOSSARY_CREATEWORD_04."</td>
						<td style='width:80%' class='forumheader3'>";

		$word_desc = $tp->toForm($word_desc);

		if (!e_WYSIWYG && $pref['glossary_submit_htmlarea'])
			$text .= $rs->form_textarea("word_desc",
																	80,
																	15,
																	strstr($word_desc, "[img]http") ? $word_desc : str_replace("[img]../", "[img]", $word_desc),
																	" onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' ");
		else
			$text .= $rs->form_textarea("word_desc",
																	80,
																	25,
																	strstr($word_desc, "[img]http") ? $word_desc : str_replace("[img]../", "[img]", $word_desc),
																	"",
																	"width: 100%");

		if (!e_WYSIWYG && $pref['glossary_submit_htmlarea'])
			$text .= $rs->form_text("helpb", 100, "", "", "helpbox")."<br />".display_help("helpb");

		$text .= "
						</td>
					</tr>";

		if (!$sub && getperms("0"))
			$text .= "
					<tr>
						<td style='width:20%' class='forumheader3'>".LAN_GLOSSARY_CREATEWORD_07."</td>
						<td style='width:80%' class='forumheader3'>
							".$rs->form_radio("word_link", "1", ($word_link ? "1" : "0"), "", "").LAN_GLOSSARY_OPT_01."
							".$rs->form_radio("word_link", "0", ($word_link ? "0" : "1"), "", "").LAN_GLOSSARY_OPT_02."
						</td>
					</tr>";

		$text .= "
					<tr>
						<td colspan='2' style='text-align:center' class='forumheader'>";

		if ($sub)
			$text .= $rs->form_button("submit", "action[submit]", $id ? LAN_GLOSSARY_CREATEWORD_02 : LAN_GLOSSARY_CREATEWORD_06);
		else if ($id)
			$text .= $rs->form_button("submit", "action[update_{$id}]", LAN_GLOSSARY_CREATEWORD_05);
		else
			$text .= $rs->form_button("submit", "action[add]", LAN_GLOSSARY_CREATEWORD_02);
			
		$text .= $rs->form_hidden("username", $username);

		$text .= "
						</td>
					</tr>
				</table>
			".$rs->form_close()."
		</div>";

		if ($sub)
		{
			if ($id)
				$caption = LAN_GLOSSARY_CREATEWORD_02;
			else
				$caption = LAN_GLOSSARY_CREATEWORD_10;
		}
		else if ($id)
			$caption = LAN_GLOSSARY_CREATEWORD_01;
		else
			$caption = LAN_GLOSSARY_CREATEWORD_02;

		$ns -> tablerender($caption, $text);
	}

	function createWord($id)
	{
		$this->createDef($id, 0);
	}

	function createSubWord($id)
	{
		$this->createDef($id, 1);
	}

	function editWord($id)
	{
		$this->createWord($id);
	}	
	
	function admin_update($update, $type, $success)
	{
		global $ns;
		
		if (($type == "update" && $update) || ($type == "insert" && $update != false))
		{
			$caption = LAN_UPDATE;
			$text = $success ? $success : LAN_UPDATED;
		}
		else if ($type == "delete" && $update)
		{
			$caption = LAN_DELETE;
			$text = $success ? $success : LAN_DELETED;
		}
		else if (!mysql_errno())
		{
			if ($type == "update")
			{
				$caption = LAN_UPDATED_FAILED;
				$text = LAN_NO_CHANGE."<br />".LAN_TRY_AGAIN;
			}
			else if ($type == "delete")
			{
				$caption = LAN_DELETED_FAILED;
				$text = LAN_DELETED_FAILED."<br />".LAN_TRY_AGAIN;
			}
		}
		else
		{
			$caption = LAN_UPDATED_FAILED;
			$text = $failed ? $failed : LAN_UPDATED_FAILED." - ".LAN_ERROR." ".mysql_errno().": ".mysql_error();
		}
		
		$this->message = $text;
		$this->caption = $caption;
	}

	function addWord($approved = '1')
	{
		$this->updateWord(0, $approved);
	}
	
	function updateWord($id, $approved = '1')
	{
		global $sql, $tp, $e107cache;

		$word_name = $tp -> toDB($_POST['word_name']);
		$word_desc = $tp -> toDB($_POST['word_desc']);
		$username =  $tp -> toDB($_POST['username']);
		if (isset($_POST['word_link']))
			$word_link = $_POST['word_link'];

		switch($id)
		{
			case 0:
				$create = $sql -> db_Insert("glossary", "'0', '$word_name', '$word_desc', '$username', '".time()."', '$approved'".(isset($word_name) ? ", '$word_link'" : ""));
				$this->admin_update($create, 'insert', LAN_GLOSSARY_SUBMITWORD_01);
				break;
			default:
				$update = $sql->db_Update("glossary", "glo_name='$word_name', glo_description='$word_desc', glo_approved='$approved'".(isset($word_name) ? ", glo_linked='$word_link'" : "")." WHERE glo_id='".intval($id)."'");
				$this->admin_update($update, 'update', LAN_GLOSSARY_SUBMITWORD_02);
				break;
		}
		$e107cache->clear();
	}

	function submitWord()
	{
		global $sql, $tp, $e_event, $e107 ;
    $pref = e107::getPlugConfig('glossary')->getPref();
		$word_name = $tp -> toDB($_POST['word_name']);
		$word_desc = $tp -> toDB($_POST['word_desc']);
		if (!isset($_POST['username']))
		{
			if (USER)
				$username = USERID.".".USERNAME;
			else
				$username = "0.".LAN_GLOSSARY_SUBMITWORD_03;
		}
		else
			$username = $tp -> toDB($_POST['username']);

		$ip = $e107->getip();

		$edata_ls = array(
			"username"				=> $username,
			"ip"							=> $ip,
			"word_name"				=> $word_name,
			"word_desc"				=> $word_desc,
			);

		$fp = new floodprotect;
		if ($fp->flood("glossary", "datestamp") == false && !ADMIN)
		{
			js_location(e_BASE."index.php");
			exit;
		}

		$direct = (isset($pref['glossary_submit_directpost']) && $pref['glossary_submit_directpost']) ? 1 : 0;

		if ($direct)
			$this->addWord(1);
		else
			$this->addWord(0);
			
		$e_event->trigger("wordsub", $edata_ls);
		
		if ($direct)
			js_location(e_SELF."?s_direct");
		else
			js_location(e_SELF."?s");
	}

	function deleteWord($id)
	{
		global $sql;
		
		$this->admin_update($sql->db_Delete("glossary", "glo_id='".intval($id)."'"), 'delete', LAN_GLOSSARY_DELETEWORD_01);
	}
	
	function linkWord($id)
	{
		global $sql, $e107cache;

		$sql->db_Select("glossary", "glo_linked", "glo_id = '".intval($id)."'");
		$row = $sql->db_Fetch();

		$this->admin_update($sql->db_Update("glossary", "glo_linked='".($row['glo_linked'] ? 0 : 1)."' WHERE glo_id='".intval($id)."'"), 'update', LAN_GLOSSARY_SUBMITWORD_02);

		$e107cache->clear();
	}
 

	function show_options($action)
	{
		global $sql;

		switch($action)
		{
			case "":
			case "update":
			case "delete":
			case "link":
				$action = "main";
				break;

			case "edit":
				$action = "create";
				break;
		}

		// Definition Frontpage
		$var['main']['text'] = LAN_GLOSSARY_MENU_02;
		$var['main']['link'] = e_PLUGIN."glossary/admin_config.php?mode=main";

		// Create Definition
		$var['create']['text'] = LAN_GLOSSARY_MENU_03;
		$var['create']['link'] = e_SELF."?create";

		// Submitted definition
		$total = $sql->db_Count("glossary", "(*)", "where glo_approved = '0'");
		//if ($total)
		if (TRUE)  // to see all admin menu items
		{
			$var['displaySubmitted']['text'] = LAN_GLOSSARY_MENU_04." (".$total.")";
			$var['displaySubmitted']['link'] = e_PLUGIN."glossary/admin_config.php?mode=submitted";
		}

		show_admin_menu(LAN_GLOSSARY_MENU_01, $action, $var);

		if (getperms("0"))
		{
			unset($var);

			// General Options
			$var['optgen']['text'] = LAN_GLOSSARY_MENU_11;
			$var['optgen']['link'] = e_PLUGIN."glossary/admin_config.php?mode=general&action=prefs";
			$var['optgen']['perm'] = "0";

			// Menu Options
			$var['optpage']['text'] = LAN_GLOSSARY_MENU_12;
			$var['optpage']['link'] = e_PLUGIN."glossary/admin_config.php?mode=page&action=prefs";
			$var['optpage']['perm'] = "0";
	
			// Menu Options
			$var['optmenu']['text'] = LAN_GLOSSARY_MENU_13;
			$var['optmenu']['link'] = e_PLUGIN."glossary/admin_config.php?mode=menu&action=prefs";
			$var['optmenu']['perm'] = "0";
	
			show_admin_menu(LAN_GLOSSARY_MENU_10, $action, $var);
		}
	}
 
 

	function displayWords($submittext = "")
	{
		global $sql, $rs, $ns;
		global $glo_id, $word, $description;
		global $wcar;

		//require_once(e_PLUGIN.'glossary/glossary_shortcodes.php');
		$word_table = "";
		$wall = array();
		$title = e107::getParser()->parseTemplate($this->plugTemplates['WORD_PAGE_TITLE'], FALSE, $this->word_shortcodes);
		$words = $sql->retrieve("glossary", "*", "glo_approved = '1' ORDER BY glo_name ASC" , true);
  
		if ($words)
		{
      $firstword      = TRUE;
      foreach($words as $row)
     	{
        $glo_id       = $row['glo_id'];
        $word         = $row['glo_name'];
        $description  = $row['glo_description'];
        
				if ($wcar <> strtoupper($word{0}))
				{
					$wcar = strtoupper($word{0});
					$wall[$wcar] = 1;  
          if(!$firstword) {  
           $text .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_END'], FALSE, $this->word_shortcodes);
          }         
          $text .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_START'], FALSE, $this->word_shortcodes);
					$text .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_ANCHOR'], FALSE, $this->word_shortcodes);
          $firstword      = FALSE;
				}
				$text .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_BODY_PAGE'], FALSE, $this->word_shortcodes);
				$text .= e107::getParser()->parseTemplate($this->plugTemplates['BACK_TO_TOP'], FALSE, $this->word_shortcodes);
        
			} 
      $text .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_END'], FALSE, $this->word_shortcodes);
		}

		$ok = 0;
		for($i = 0; $i <= 255; $i++)
		{
			$car = chr($i);
			if ($wall[$car] && (($car < 'A') || ($car > 'Z')))
			{
				$ok =1;
				break;
			}
		}

		$wcar = "0-9";
		if ($ok)
			$text2 .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_LINK'], FALSE, $this->word_shortcodes);
		else
			$text2 .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_NOLINK'], FALSE, $this->word_shortcodes);

		for($i = ord("A"); $i <= ord("Z"); $i++)
		{
			$wcar = chr($i);
			if ($wall[$wcar])
				$text2 .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_LINK'], FALSE, $this->word_shortcodes);
			else
				$text2 .= e107::getParser()->parseTemplate($this->plugTemplates['WORD_CHAR_NOLINK'], FALSE, $this->word_shortcodes);
		}

		$text2 = e107::getParser()->parseTemplate($this->plugTemplates['WORD_ALLCHAR_PRE'], FALSE).$text2.e107::getParser()->parseTemplate($this->plugTemplates['WORD_ALLCHAR_POST'], FALSE);
		$text  = $text2.$text;
    
    $start = e107::getParser()->parseTemplate($this->plugTemplates['WORD_PAGE_START']);
    $end   = e107::getParser()->parseTemplate($this->plugTemplates['WORD_PAGE_END']);

		if (!$words)
			$text .= $this->build_message(LAN_GLOSSARY_DISPLAYWORDS_01);

		$ns->tablerender($title, $start.$submittext.$text.$end);
	}
	
	function buildMenuWord($qry)
	{
		global $sql, $rs, $ns, $tp ;
		global $glo_id, $word, $description;
 
    $pref = e107::getPlugConfig('glossary')->getPref();
		//require_once(e_PLUGIN.'glossary/glossary_shortcodes.php');

    $words = $sql->retrieve("glossary", "*", "glo_approved = '1' ORDER BY ".$qry." LIMIT ".$pref['glossary_menu_number'], true);
    if ($words)
		{
      $text = $tp->parseTemplate($this->plugTemplates['WORD_MENU_TITLE'], FALSE, $this->word_shortcodes);
			foreach($words as $row)
     	{
        $glo_id       = $row['glo_id'];
        $word         = $row['glo_name'];
        $description  = $row['glo_description'];
 
				$text .= $tp->parseTemplate($this->plugTemplates['WORD_BODY_MENU'], FALSE, $this->word_shortcodes);
			}
		}
		else $text = LAN_GLOSSARY_BLMENU_05;

		return $text;
	}
	
	function buildMenuLastWord()
	{
		return $this->buildMenuWord("glo_datestamp DESC");
	}
	
	function buildMenuRandWord()
	{
		return $this->buildMenuWord("RAND()");
	}

	function nospam($text)
	{
		$tmp = explode("@", $text);
		return ($tmp[0] != "") ? $tmp[0] . "@nospam.com" : "noauthor@nospam.com";
	}

	function getAuthor($author)
	{
		global $sql;

		list($uid, $author) = explode(".", $author);
	
		if ($uid)
		{
			if ($sql->db_Select("user", "user_id, user_name, user_email, user_hideemail", "user_id='".intval($uid)."'"))
				list($user_id, $user_name, $user_email, $user_hideemail) = $sql->db_Fetch();
			else
				list($user_id, $user_name, $user_email, $user_hideemail) = array($uid, $author, "", 1);
		}

		if ($user_hideemail)
			$user_email = $this->nospam($user_email);

		return array($user_id, $user_name, $user_email);
	}

	function displayNav($Type)
	{
		global $tp;
 

		//require_once(e_PLUGIN.'glossary/glossary_shortcodes.php');

		switch($Type)
		{
			case "page":
				$nav	= $tp->parseTemplate($this->plugTemplates['LINK_PAGE_NAVIGATOR'], FALSE, $this->word_shortcodes);
				break;

			case "menu":
				$nav	= $tp->parseTemplate($this->plugTemplates['LINK_MENU_NAVIGATOR'], FALSE, $this->word_shortcodes);
				break;
		}
		
		return $nav;
	}
}

?>