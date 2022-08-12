<?php 
require_once __DIR__ . '/Common.php';

use  mail\Mailtools;


$host = "'ssl://smtpdm.aliyun.com'";
$fromname = "service@send.dlxswh.com"; 
$password = "xxxxxx";  //密码请修改
$mailtools = new  Mailtools($host,$fromname,$password, $smtpsecure = "ssl", $port = "465", $debug =1);
$email_list="613154514@qq.com";
$html="我是发送内容！";
$rs= $mailtools->sendmail_smtp($email_list,$html);
print_r($rs);