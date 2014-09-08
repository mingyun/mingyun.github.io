<?php

// 让crontab定时执行的脚本程序     */5 * * * * /usr/bin/php /data/www/app/cron.php

// 想获取video中 6条数据

require_once('./db.php');
require_once('./file.php');

$sql = "select * from video where status = 1 order by orderby desc";
try {
	$connect = Db::getInstance()->connect();
} catch(Exception $e) {
	// $e->getMessage();
	file_put_contents('./logs/'.date('y-m-d') . '.txt' , $e->getMessage());
	return;
}
$result = mysql_query($sql, $connect); 
$videos = array();
while($video = mysql_fetch_assoc($result)) {
	$videos[] = $video;
}
$file = new File();
if($videos) {
	$file->cacheData('index_cron_cahce', $videos);
} else {
	file_put_contents('./logs/'.date('y-m-d') . '.txt' , "没有相关数据");
}
return;