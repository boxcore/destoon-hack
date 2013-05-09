<?php
defined('IN_DESTOON') or exit('Access Denied');
#Your Functions
//hacked start get_cat_by_dir
function get_cat_by_dir($catdir,$moduleid) {
	global $db;
	return $db->get_one("SELECT * FROM {$db->pre}category WHERE moduleid = $moduleid and catdir='$catdir'");
}
function pr($arr,$exit=false){
  if ($arr === false){
    echo 'false';
  }else{
    printf('<pre>%s</pre>',print_r($arr,true));
  }
  if($exit) exit();
}
function get_cats_for_detect($moduleid){
	global $db;
	$condition = "moduleid=$moduleid";
	$cat = array();
	$result = $db->query("SELECT catid,catname,parentid FROM {$db->pre}category WHERE $condition ORDER BY parentid desc,catid ASC", 'CACHE');
	while($r = $db->fetch_array($result)) {
    if($r['catname'] == '其它') continue;
		$cat[$r['catid']] = $r['catname'];
	}
	return $cat;
}
//ini_set("pcre.recursion_limit", "300000");
function detect_cat($post,$moduleid=5){
  $cats = get_cats_for_detect($moduleid);
  $names =  str_replace('/','\/',(implode('|',array_unique(array_values($cats)))));

  $len = mb_strlen($names);
  while(mb_strlen($names) > 31550){
    $start = 0;
    $tmp = mb_substr($names,$start,31550);
    $limit = strrpos($tmp,'|');
    $tmp = mb_substr($names,$start,$limit);
    $names_arr[] = $tmp;
    $start += ($limit + 1);
    $names = mb_substr($names,$start);
  }
  $names_arr[] = $names;

  foreach($names_arr as $names){
    if(!preg_match('!'.$names.'!',$post['title'],$m)) continue;
    $catname = $m[0];
    $post['catid'] = array_search($catname,$cats);
    break;
  }
  return $post;
}
//hacked end
?>
