#### 邮件发送php的sdk支持阿里云邮件推送以及普通的smtp

#### 介绍

#### 软件架构
软件架构说明
测试文件在tests下面，测试的时候，可以点击根目录的bat,然后放访问
先在根目录 composer install
http://localhost:8888/tests/sendmail1.php
类似这样方法测试



#### 安装教程

composer require zhensoft/sendmail  dev-master  


#### 使用说明

```php 
<?php

//普通的smtp模式都用这个方法
use  mail\Mailtools;
require "vendor/autoload.php";
$host = "'ssl://smtpdm.aliyun.com'";
$fromname = "service@send.dlxswh.com"; 
$password = "11111";  //密码请修改
$mailtools = new  Mailtools($host,$fromname,$password);
$email_list="613154514@qq.com";
$html="我是发送内容！";
$rs= $mailtools->sendmail_smtp($email_list,$html);
print_r($rs);



use  mail\Ali_mailtools;
require "vendor/autoload.php";
//下面是阿里云邮件推送api
//https://dm.console.aliyun.com/  来这里开通服务，配置信息
$accessKeyId = "LTAI5tDf2EpWeyTog8xtkpg7";
$accessKeySecret = "1111111";  //密码请修改
$accountName = "service@send.dlxswh.com";
$mailtools = new  Ali_mailtools($accessKeyId,$accessKeySecret,$accountName);
$email_list="613154514@qq.com";
$html="我是发送内容！";
$rs= $mailtools->sendmail_ali($email_list,$html);
print_r($rs);



```

