<?php
// +----------------------------------------------------------------------
// | 王磊 [ Programming makes me happy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2022 08 12  http://www.wlphp.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wl < 613154514@qq.com >
// +----------------------------------------------------------------------
namespace  mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailtools
{
    //是否开启debug
    public $debug;
    public $host;
    public $smtpsecure;
    public $port;
    public $fromname;
    public $password;

    public function __construct($host = "", $fromname = "", $password = "", $smtpsecure = "ssl", $port = "465", $debug = 0)
    {
        $this->debug = $debug;
        $this->host = $host;
        $this->smtpsecure = $smtpsecure;
        $this->port = $port;
        $this->fromname = $fromname;
        $this->password = $password;
    }



    //发送smtp邮件
    //$email_list 邮件列表，逗号拼接的字符串
    //$html html邮件内容
    public function sendmail_smtp($email_list, $html)
    {
        //把传过来的收件地址转化成数组
        $email_list = str_replace("\r\n", ",", $email_list);
        $email_list = str_replace("\r", ",", $email_list);
        $email_list = str_replace("\n", ",", $email_list);
        $email_list = str_replace("，", ",", $email_list);
        $email_list = str_replace(";", ",", $email_list);
        $email_list = str_replace("；", ",", $email_list);
        $email_list = str_replace(" ", "", $email_list);
        $email_list_arr = explode(",", $email_list);
        //数组去掉空
        $email_list_arr = array_unique($email_list_arr);
        //数组去掉重复
        $email_list_arr = array_filter($email_list_arr);

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            $mail = new PHPMailer();
            $mail->SMTPDebug = $this->debug;  //调试模式 0关闭 
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $this->host;
            $mail->SMTPSecure = $this->smtpsecure;
            //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
            $mail->Port = $this->port;
            $mail->Hostname = $this->fromname;
            $mail->CharSet = 'UTF-8';
            $mail->FromName = $this->fromname;  //发件人名字(发件人和收件人不是好友的情况下显示)
            $mail->Username = $this->fromname;   //发件邮箱的账号
            $mail->Password = $this->password;    //发件邮箱邮箱授权码
            $mail->From = $this->fromname;

            $mail->isHTML(true);
            //$mail->addAddress("613154514@qq.com",'');   //收件人的姓名(发件人和收件人不是好友的情况下显示)	
            foreach ($email_list_arr as $k => $v) {
                $mail->addAddress($v, '');   //收件人的姓名(发件人和收件人不是好友的情况下显示)	

            }
            $mail->Subject = '温馨提示';             //邮件主题
            $mail->Body = $html;
            $status = $mail->send();
            $rt['sta'] = "1";
            $rt['msg'] = "发送成功！";
            return $rt;
        } catch (Exception $e) {
            $rt['sta'] = "0";
            $rt['msg'] = "发送失败！==>" . $mail->ErrorInfo;
            return $rt;
        }
    }
}
