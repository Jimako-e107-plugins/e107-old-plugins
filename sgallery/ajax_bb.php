<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin Ajax File: e107_plugins/lightbox/ajax_bb.php
|        Email: support@free-source.net
|        $Revision: 740 $
|        $Date: 2008-04-22 18:25:59 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|        Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Support Sites : http://www.free-source.net/ | http://dev.e107bg.org/
+----------------------------------------------------------------------------------------------------+
*/

/*	DEPRECATED!!! */
define('e_TOKEN_FREEZE', true); 
require_once("../../class2.php");
header("Content-Type: text/html; charset=".CHARSET);

require_once('init.php');
$lan_file = SGAL_LAN."_bb.php";
include_lan($lan_file);
$lb_path = e_PLUGIN.'lightbox/';
include_lan($lb_path."languages/".e_LANGUAGE.".php");

require_once(e_HANDLER."form_handler.php");

    if(check_class($pref['sgal_wperms']) && check_class($pref['sgal_active'])) {
        echo "
        <div id='sgal-uform' style='width: 100%; text-align: center; margin-top: 20px; display: block'>
    	<form method='post' action='".e_SELF."'>
    	<table class='fborder' style='width:96%'>
    	<tr>
    		<td colspan='2' style='padding: 5px'>".(check_class($pref['sgal_advwperms']) ? "<a href='#' onclick='expandit(\"sgal-uform\"); expandit(\"sgal-aform\"); return false;'>".SGAL_ABBLAN_40."</a> &raquo;" : '&nbsp;')."</td>
    	</tr>
    	<tr>
    		<td class='fcaption' colspan='2' style='padding: 5px'>".SGAL_ABBLAN_29."</td>
    	</tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_28."</td>
    		<td class='forumheader3' style='padding: 5px'>".form::form_text('sgal_img', '40', 'http://', 250)."</td>
    	</tr>
    	<tr>
    		<td class='fcaption' colspan='2' style='padding: 5px'>".SGAL_ABBLAN_29."</td>
    	</tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_29a."</td>
    		<td class='forumheader3' style='padding: 5px'>
                ".form::form_text('sgal_thw', '5', $sgal_pref['sgal_thumb_w'], 3, "tbox", "", "", "style='text-align:right'")."px
            </td>
        </tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_29b."</td>
    		<td class='forumheader3' style='padding: 5px'>
                ".form::form_text('sgal_thh', '5', $sgal_pref['sgal_thumb_h'], 3, "tbox", "", "", "style='text-align:right'")."px
            </td>
        </tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_29c."</td>
    		<td class='forumheader3' style='padding: 5px'>
                ".form::form_select_open('sgal_far')."
                ".form::form_option(SGAL_ABBLAN_6k, (!$sgal_pref['sgal_far']), '0')."
                ".form::form_option(SGAL_ABBLAN_6b, ($sgal_pref['sgal_far'] == 'C'), 'C')."
                ".form::form_option(SGAL_ABBLAN_6c, ($sgal_pref['sgal_far'] == 'T'), 'T')."
                ".form::form_option(SGAL_ABBLAN_6d, ($sgal_pref['sgal_far'] == 'R'), 'R')."
                ".form::form_option(SGAL_ABBLAN_6e, ($sgal_pref['sgal_far'] == 'B'), 'B')."
                ".form::form_option(SGAL_ABBLAN_6f, ($sgal_pref['sgal_far'] == 'L'), 'L')."
                ".form::form_option(SGAL_ABBLAN_6g, ($sgal_pref['sgal_far'] == 'TL'), 'TL')."
                ".form::form_option(SGAL_ABBLAN_6h, ($sgal_pref['sgal_far'] == 'TR'), 'TR')."
                ".form::form_option(SGAL_ABBLAN_6i, ($sgal_pref['sgal_far'] == 'BL'), 'BL')."
                ".form::form_option(SGAL_ABBLAN_6j, ($sgal_pref['sgal_far'] == 'BR'), 'BR')."
                ".form::form_select_close()."
            </td>
        </tr>
    	<tr>
    		<td class='fcaption' colspan='2' style='padding: 5px'>".SGAL_ABBLAN_6."</td>
    	</tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_30."</td>
    		<td class='forumheader3' style='padding: 5px'>".form::form_text('sgal_title', '40', '', 250)."</td>
    	</tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_31."</td>
    		<td class='forumheader3' style='padding: 5px'>".form::form_text('sgal_group', '40', '', 250)."</td>
    	</tr>
    	<tr>
    		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_32."</td>
    		<td class='forumheader3' style='padding: 5px'>
                ".form::form_select_open('sgal_float')."
        		".form::form_option('', true, '')."
        		".form::form_option(SGAL_ABBLAN_33, false, 'left')."
        		".form::form_option(SGAL_ABBLAN_34, false, 'right')."
        		".form::form_select_close()."
    		</td>
    	</tr>
    	<tr>
    		<td class='fcaption' colspan='2' style='text-align: left; padding: 3px 5px'>
                ".form::form_button('button', 'sgal_bbinsert', SGAL_ABBLAN_7, "onclick='if(addSgallery(\"default\")) Windows.closeAll();'")."
                ".form::form_button('button', 'sgal_bbcancel', SGAL_ABBLAN_8, "onclick='Windows.closeAll()'")."
            </td>
    	</tr>
    	</table>
    	</form>
    	</div>
        ";

        if(check_class($pref['sgal_advwperms'])) { //other permissions!
            
            if(ADMIN) $where = '1';
            else {
            	if(!check_class($sgal_pref['sgal_usermod_visible'])) {
            		$where = "al.sgal_user='' AND al.active > 0 AND alc.active > 0 AND al.album_ustatus > 0";
            	} else {
                    $where = "(alc.active > 0 || al.sgal_user!='') AND (al.active > 0 AND al.album_ustatus > 0)";
                }
            }
            //album list
        	$qry = "
        	SELECT al.*, alc.title as ctitle
        	FROM #sgallery AS al
        	LEFT JOIN #sgallery_cats AS alc ON al.cat_id = alc.cat_id 
        	WHERE {$where}
        	GROUP by al.album_id
            ORDER by alc.cat_order ASC, al.title ASC
        	";
            
            //imgselectors - destination images
            $parms = "name=sgal_imgsel";
            //array params
            if($sql->db_Select_gen($qry)) {
                $rows = $sql->db_getList();
                foreach ($rows as $row) {
                		$parms .= "&path[]=".SGAL_ALBUMPATH.$row['path'].'/';//album path
                		$parms .= "&label[]=".$tp->toHTML($row['ctitle'].' - '.$row['title'], false, 'LINKTEXT');//news
                }
            }
            
    		$parms .= "&path[]=".e_IMAGE.'newspost_images/';//news
    		$parms .= "&path[]=".e_FILE.'downloadimages/';//downloads
    		$parms .= "&path[]=".e_FILE.'public/';//public

    		$parms .= "&label[]=".SGAL_ABBLAN_42;//news
    		$parms .= "&label[]=".SGAL_ABBLAN_43;//downloads
    		$parms .= "&label[]=".SGAL_ABBLAN_44;//public
    		//array params end
    		$parms .= "&default=".e_IMAGE_ABS."generic/blank.gif";
    		$parms .= "&float=left";
    		$parms .= "&width=120px";
    		$parms .= "&height=120px";
    		$parms .= "&multiple=TRUE";
    		$parms .= "&swidth=300px";

            $sgalimg = $tp->parseTemplate("{LB_IMAGESELECTOR={$parms}}");
            
            //
            
            //admin options
            echo "
                 <div id='sgal-aform' style='width: 100%; text-align: center; margin-top: 20px; display: none'>
                    <form method='post' action='".e_SELF."'>
                	<table class='fborder' style='width:96%'>
                	<tr>
                		<td colspan='2' style='padding: 5px'>&laquo; <a href='#' onclick='expandit(\"sgal-uform\"); expandit(\"sgal-aform\"); return false;'>".SGAL_ABBLAN_41."</a></td>
                	</tr>
                	<tr>
                		<td class='fcaption' colspan='2' style='padding: 5px'>".SGAL_ABBLAN_28."</td>
                	</tr>
                	<tr>
                        <td class='forumheader3' colspan='2' style='height: 130px;padding: 5px; vertical-align: top'>
                            {$sgalimg}
                        </td>
                	</tr>
                	<tr>
                		<td class='fcaption' colspan='2' style='padding: 5px'>".SGAL_ABBLAN_29."</td>
                	</tr>
                	<tr>
                		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_29a."</td>
                		<td class='forumheader3' style='padding: 5px'>
                            ".form::form_text('sgal_athw', '5', $sgal_pref['sgal_thumb_w'], 3, "tbox", "", "", "style='text-align:right'")."px
                        </td>
                    </tr>
                	<tr>
                		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_29b."</td>
                		<td class='forumheader3' style='padding: 5px'>
                            ".form::form_text('sgal_athh', '5', $sgal_pref['sgal_thumb_h'], 3, "tbox", "", "", "style='text-align:right'")."px
                        </td>
                    </tr>
                	<tr>
                		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_29c."</td>
                		<td class='forumheader3' style='padding: 5px'>
                            ".form::form_select_open('sgal_afar')."
                            ".form::form_option(SGAL_ABBLAN_6k, (!$sgal_pref['sgal_far']), '0')."
                            ".form::form_option(SGAL_ABBLAN_6b, ($sgal_pref['sgal_far'] == 'C'), 'C')."
                            ".form::form_option(SGAL_ABBLAN_6c, ($sgal_pref['sgal_far'] == 'T'), 'T')."
                            ".form::form_option(SGAL_ABBLAN_6d, ($sgal_pref['sgal_far'] == 'R'), 'R')."
                            ".form::form_option(SGAL_ABBLAN_6e, ($sgal_pref['sgal_far'] == 'B'), 'B')."
                            ".form::form_option(SGAL_ABBLAN_6f, ($sgal_pref['sgal_far'] == 'L'), 'L')."
                            ".form::form_option(SGAL_ABBLAN_6g, ($sgal_pref['sgal_far'] == 'TL'), 'TL')."
                            ".form::form_option(SGAL_ABBLAN_6h, ($sgal_pref['sgal_far'] == 'TR'), 'TR')."
                            ".form::form_option(SGAL_ABBLAN_6i, ($sgal_pref['sgal_far'] == 'BL'), 'BL')."
                            ".form::form_option(SGAL_ABBLAN_6j, ($sgal_pref['sgal_far'] == 'BR'), 'BR')."
                            ".form::form_select_close()."
                        </td>
                    </tr>
                	<tr>
                		<td class='fcaption' colspan='2' style='padding: 5px'>".SGAL_ABBLAN_6."</td>
                	</tr>
                	<tr>
                		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_30."</td>
                		<td class='forumheader3' style='padding: 5px'>".form::form_text('sgal_atitle', '40', '', 250)."</td>
                	</tr>
                	<tr>
                		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_31."</td>
                		<td class='forumheader3' style='padding: 5px'>".form::form_text('sgal_agroup', '40', '', 250)."</td>
                	</tr>
                	<tr>
                		<td class='forumheader3' style='padding: 5px'>".SGAL_ABBLAN_32."</td>
                		<td class='forumheader3' style='padding: 5px'>
                        ".form::form_select_open('sgal_afloat')."
                		".form::form_option('', true, '')."
                		".form::form_option(SGAL_ABBLAN_33, false, 'left')."
                		".form::form_option(SGAL_ABBLAN_34, false, 'right')."
                		".form::form_select_close()."
                		</td>
                	</tr>
                	<tr>
                		<td class='fcaption' colspan='2' style='text-align: left; padding: 3px 5px'>
                            ".form::form_button('button', 'sgal_abbinsert', SGAL_ABBLAN_7, "onclick='if(addSgallery(\"advanced\")) Windows.closeAll();'")."
                            ".form::form_button('button', 'sgal_abbcancel', SGAL_ABBLAN_8, "onclick='Windows.closeAll()'")."
                        </td>
                	</tr>
                	</table>
                	</form>
                 </div>
            ";
        }
    } else {
        echo LB_LAN_38;
    }


$page = ob_get_clean();
echo $page;
?>