<?php 
require_once __DIR__ . '/Common.php';

use  mail\Ali_mailtools;


$accessKeyId = "LTAI5tDf2EpWeyTog8xtkpg7";
$accessKeySecret = "xxxxxx"; 
$accountName = "service@send.dlxswh.com";
$mailtools = new  Ali_mailtools($accessKeyId,$accessKeySecret,$accountName);
$email_list="613154514@qq.com";
$html="我是发送内容！";
$rs= $mailtools->sendmail_ali($email_list,$html);
print_r($rs);