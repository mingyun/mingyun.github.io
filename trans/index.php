<?php
require_once "transfer.class.php";

header("Content-Type: text/html; charset=utf-8");
  
$transferObject = new Transfer();
$smpString = "中华人民共和国";
$traString = $transferObject->cnToTw($smpString);
echo $traString;

echo "<br/>";

$traditionalStr = "不知道什麼叫做快樂，神馬都是浮雲，神馬都是悲劇，人生如戲，戲玩人生";
$smpliString = $transferObject->twToCn($traditionalStr);
echo $smpliString;
?>