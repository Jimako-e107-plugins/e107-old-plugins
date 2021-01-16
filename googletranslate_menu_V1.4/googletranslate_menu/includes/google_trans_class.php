<?php
/*
+---------------------------------------------------------------+
|   googletranslate _menu
|	Copyright Father Barry 2006 - 2008
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|   Suitable for e107 v76+
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}

class google_translate
{
    function google_translate()
    {
        $this->load_prefs();
    }
    // ********************************************************************************************
    // *
    // * Load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $GTRANS_PREFS;
        $GTRANS_PREFS['gtrans_langs']['en'] = array('code' => 'en', 'language' => 'English', 'flag' => 'uk.png', 'alt' =>utf8_encode( 'Translate this page'));
        $GTRANS_PREFS['gtrans_langs']['ar'] = array('code' => 'ar', 'language' => 'Arabic', 'flag' => 'arabia.png', 'alt' =>utf8_encode( 'ترجم هذه الصفحة'));
        $GTRANS_PREFS['gtrans_langs']['bg'] = array('code' => 'bg', 'language' => 'Bulgarian', 'flag' => 'bulgaria.png', 'alt' =>utf8_encode( 'Преведи тази страница'));
        $GTRANS_PREFS['gtrans_langs']['ca'] = array('code' => 'ca', 'language' => 'Catalan', 'flag' => 'catalan.png', 'alt' =>utf8_encode( 'Tradueix aquesta pàgina'));
        $GTRANS_PREFS['gtrans_langs']['zh-CN'] = array('code' => 'zh-CN', 'language' => 'Chinese', 'flag' => 'china.png', 'alt' =>utf8_encode( '翻译此页'));
        $GTRANS_PREFS['gtrans_langs']['hr'] = array('code' => 'hr', 'language' => 'Croatioan', 'flag' => 'croatia.png', 'alt' =>utf8_encode( 'Prevedi ovu stranicu'));
        $GTRANS_PREFS['gtrans_langs']['cs'] = array('code' => 'cs', 'language' => 'Czech', 'flag' => 'czech.png', 'alt' =>utf8_encode( 'Preložit tuto stránku'));
        $GTRANS_PREFS['gtrans_langs']['da'] = array('code' => 'da', 'language' => 'Danish', 'flag' => 'danish.png', 'alt' =>utf8_encode( 'Oversæt denne side'));
        $GTRANS_PREFS['gtrans_langs']['tl'] = array('code' => 'tl', 'language' => 'Filipino', 'flag' => 'filipino.png', 'alt' =>utf8_encode( 'Isalin ang pahinang ito'));
        $GTRANS_PREFS['gtrans_langs']['fi'] = array('code' => 'fi', 'language' => 'Finnish', 'flag' => 'finland.png', 'alt' =>utf8_encode( 'Käännä tämä sivu'));
        $GTRANS_PREFS['gtrans_langs']['fr'] = array('code' => 'fr', 'language' => 'French', 'flag' => 'france.png', 'alt' =>utf8_encode( 'Traduire cette page'));
        $GTRANS_PREFS['gtrans_langs']['de'] = array('code' => 'de', 'language' => 'German', 'flag' => 'germany.png', 'alt' =>utf8_encode( 'Diese Seite übersetzen'));
        $GTRANS_PREFS['gtrans_langs']['el'] = array('code' => 'el', 'language' => 'Greek', 'flag' => 'greece.png', 'alt' =>utf8_encode( 'Μετάφραση αυτής της σελίδας'));
        $GTRANS_PREFS['gtrans_langs']['iw'] = array('code' => 'iw', 'language' => 'Hebrew', 'flag' => 'israel.png', 'alt' =>utf8_encode( 'תרגם דף זה'));
        $GTRANS_PREFS['gtrans_langs']['hi'] = array('code' => 'hi', 'language' => 'Hindi', 'flag' => 'india.png', 'alt' =>utf8_encode( 'Translate this page'));
        $GTRANS_PREFS['gtrans_langs']['id'] = array('code' => 'id', 'language' => 'Indonesian', 'flag' => 'indonesia.png', 'alt' =>utf8_encode( 'Terjemahkan halaman ini'));
        $GTRANS_PREFS['gtrans_langs']['it'] = array('code' => 'it', 'language' => 'Italian', 'flag' => 'italy.png', 'alt' =>utf8_encode( 'Traduci questa pagina'));
        $GTRANS_PREFS['gtrans_langs']['ja'] = array('code' => 'ja', 'language' => 'Japanese', 'flag' => 'japan.png', 'alt' =>utf8_encode( 'このページを翻訳'));
        $GTRANS_PREFS['gtrans_langs']['ko'] = array('code' => 'ko', 'language' => 'Korean', 'flag' => 'korea.png', 'alt' =>utf8_encode( 'Translate this page'));
        $GTRANS_PREFS['gtrans_langs']['lv'] = array('code' => 'lv', 'language' => 'Latvian', 'flag' => 'latvia.png', 'alt' =>utf8_encode( 'Tulkot šo lapu'));
        $GTRANS_PREFS['gtrans_langs']['lt'] = array('code' => 'lt', 'language' => 'Lithuanian', 'flag' => 'lithuania.png', 'alt' =>utf8_encode( 'Išversti ši puslapi'));
        $GTRANS_PREFS['gtrans_langs']['nl'] = array('code' => 'nl', 'language' => 'Dutch', 'flag' => 'netherlands.png', 'alt' =>utf8_encode( 'Vertaal deze pagina'));
        $GTRANS_PREFS['gtrans_langs']['no'] = array('code' => 'no', 'language' => 'Norwegian', 'flag' => 'norway.png', 'alt' =>utf8_encode( 'Oversett denne siden'));
        $GTRANS_PREFS['gtrans_langs']['pl'] = array('code' => 'pl', 'language' => 'Polish', 'flag' => 'poland.png', 'alt' =>utf8_encode( 'Translate this page'));
        $GTRANS_PREFS['gtrans_langs']['pt'] = array('code' => 'pt', 'language' => 'Portuguese', 'flag' => 'portugal.png', 'alt' =>utf8_encode( 'Traduzir esta página'));
        $GTRANS_PREFS['gtrans_langs']['ro'] = array('code' => 'ro', 'language' => 'Romanian', 'flag' => 'romania.png', 'alt' =>utf8_encode( 'Traduce aceasta pagina'));
        $GTRANS_PREFS['gtrans_langs']['ru'] = array('code' => 'ru', 'language' => 'Russian', 'flag' => 'russia.png', 'alt' =>utf8_encode( 'Перевести эту страницу'));
        $GTRANS_PREFS['gtrans_langs']['sl'] = array('code' => 'sl', 'language' => 'Slovenian', 'flag' => 'slovenia.png', 'alt' =>utf8_encode( 'Prevedi to stran'));
        $GTRANS_PREFS['gtrans_langs']['sr'] = array('code' => 'sr', 'language' => 'Serbian', 'flag' => 'serbia.png', 'alt' =>utf8_encode( 'Преведи ову страну'));
        $GTRANS_PREFS['gtrans_langs']['sk'] = array('code' => 'sk', 'language' => 'Slovakian', 'flag' => 'slovakia.png', 'alt' =>utf8_encode( 'Preložit túto stránku'));
        $GTRANS_PREFS['gtrans_langs']['es'] = array('code' => 'es', 'language' => 'Spanish', 'flag' => 'spain.png', 'alt' =>utf8_encode( 'Traducir esta página'));
        $GTRANS_PREFS['gtrans_langs']['sv'] = array('code' => 'sv', 'language' => 'Swedish', 'flag' => 'sweden.png', 'alt' =>utf8_encode( 'Översätt den här sidan'));
        $GTRANS_PREFS['gtrans_langs']['uk'] = array('code' => 'uk', 'language' => 'Ukrainian', 'flag' => 'ukraine.png', 'alt' =>utf8_encode( 'Перекласти цю сторінку'));
        $GTRANS_PREFS['gtrans_langs']['vi'] = array('code' => 'vi', 'language' => 'Vietnamese', 'flag' => 'vietnam.png', 'alt' =>utf8_encode( 'Phiên d?ch các trang này'));
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $GTRANS_PREFS;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($GTRANS_PREFS);
        $sql->db_Update('core', 'e107_value="' . $tmp . '" where e107_name="google_trans"', false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $GTRANS_PREFS;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select('core', '*', 'e107_name="google_trans" ');
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($GTRANS_PREFS);
            $sql->db_Insert("core", "'google_trans', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='google_trans' ");
        }
        else
        {
            $GTRANS_PREFS = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function show_flags()
    {
        global $GTRANS_PREFS;
        if (isset ($HTTP_SERVER_VARS)) $_SERVER = &$HTTP_SERVER_VARS;
        (!e_QUERY?$page = e_SELF:$page = e_SELF . "?" . e_QUERY);
        $gpage = e_SELF . "?" . e_QUERY;
        $gpath = "http://translate.google.com/translate?langpair=";
        // print_a($GTRANS_PREFS['gtrans_langs']);
        $language = e_LANGUAGE;
        // default english
        $from = 'en';

        foreach($GTRANS_PREFS['gtrans_langs'] as $frr)
        {
            // check to see if we have an e107 language
            if ($frr['language'] == $language)
                $from = $frr['code'];
        }
        foreach($GTRANS_PREFS['gtrans_langs'] as $gtrans_country)
        {
            $to = $gtrans_country['code'];
            if($from!=$to)
            {
            	$gtrans_text .= "
				<a href='{$gpath}{$from}|{$to}&amp;u={$gpage}'>
					<img src='" . e_PLUGIN . "googletranslate_menu/images/{$gtrans_country['flag']}' alt='" . utf8_decode($gtrans_country['alt']) . "' title='" . utf8_decode($gtrans_country['alt']) . "' style='vertical-align:middle;border:0px;width:19px;height:12px;' />
				</a>";
			}
        }
        return $gtrans_text;
    }
}
?>