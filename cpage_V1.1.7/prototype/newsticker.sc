global $sql, $PROTOTYPE_PREF, $tp, $prototype_obj;
if ($PROTOTYPE_PREF['prototype_newscontent'] == 0) {
    // Site News
    // date where
    $now = time();
    // get it if start date is before now
    // and end date is 0 or after now
    $myclasses = explode(',', USERCLASS_LIST);
    $where = "where news_start<{$now} and (news_end>{$now} or news_end=0) and not find_in_set('255',news_class)";
    if ($sql->db_Select('news', 'news_id,news_title,news_summary,news_class,news_extended', "$where order by news_sticky desc, news_datestamp", 'nowhere', false)) {
        echo '<div id="fb_newsticker"><ul>';
        $count = 0;
        $url = array();

        while ($row = $sql->db_Fetch()) {
            if ($count < $PROTOTYPE_PREF['prototype_newsnumnews']) {
                // check each news item
                $found = false;
                $prototype_allowed = explode(',', $row['news_class']);
                foreach($myclasses as $check_class) {
                    // check through the allowed classes
                    if (in_array($check_class, $prototype_allowed)) {
                        // we are permitted to see it so add it to the list of items
                        if(empty($row['news_extended'])){
							$destiny='item';
						}else
						{
							$destiny='extend';
						}
                        $url[] = "<li>NEWS HEADLINES : <a href='news.php?$destiny." . $row['news_id'] . "'>" . $row['news_title'] . '</a></li>';
                        $count++;
                        break;
                    }
                }
            }
        }
        if (count($url) == 0) {
            echo "<li>" . PROTOTYPE_C19 . "</li>";
        } else {
            if ($PROTOTYPE_PREF['prototype_newsrandom'] == 1) {
                // if randomize then shuffle the array
                shuffle($url);
            }
            foreach($url as $line) {
                echo $line;
            }
        }
        echo '</ul></div>';
    } else {
        // no news items
        echo '<div id="fb_newsticker"><ul>';
        echo '<li>' . PROTOTYPE_C19 . '</li>';
        echo '</ul></div>';
    }
} elseif ($PROTOTYPE_PREF['prototype_newscontent'] == 1) {
    // news feed
    $prototype_news_obj = new fb_newsfeed;
    $data = $prototype_news_obj->newsfeed_info($PROTOTYPE_PREF['prototype_newsfeed']);
    $output=$data['text'];
    if ($PROTOTYPE_PREF['prototype_newsrandom'] == 1) {
        shuffle($output);
    }
    if(count($output>0)){
    echo '<div id="fb_newsticker"><ul>';
    foreach($output as $line) {
        echo '<li>' . $line . '</li>';
    }
    echo '</ul></div>';
    }else{
        echo '<div id="fb_newsticker"><ul>';
        echo '<li>' . PROTOTYPE_C19 . '</li>';
		echo '</ul></div>';
    }
} else {
    // static file
    $search = array('<br />');
    $replace = array('*');
    $res = $tp->toHTML($PROTOTYPE_PREF['prototype_static_content']);
    $prototype_lines = explode('<br />', $res);
    if ($PROTOTYPE_PREF['prototype_newsrandom'] == 1) {
        shuffle($prototype_lines);
    }
    echo '
	<div id="fb_newsticker"><ul>';
    foreach($prototype_lines as $line) {
        echo '<li>' . $line . '</li>';
    }
    echo '</ul></div>';
}