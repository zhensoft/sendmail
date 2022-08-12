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
namespace   mail;

use AlibabaCloud\SDK\Dm\V20151123\Dm;
use AlibabaCloud\Tea\Tea;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Console\Console;

use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dm\V20151123\Models\SingleSendMailRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;


class Ali_mailtools
{
    //是否开启debug
    public $accessKeyId;
    public $accessKeySecret;
    public $accountName;

    public function __construct($accessKeyId = "", $accessKeySecret = "", $accountName = "")
    {
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
        $this->accountName = $accountName;
    }


    //发送smtp邮阿里云
    //$email_list 邮件列表，逗号拼接的字符串
    //$html html邮件内容
    public function sendmail_ali($email_list, $html)
    {

        $client = self::createClient($this->accessKeyId, $this->accessKeySecret);
        $singleSendMailRequest = new SingleSendMailRequest([
            "accountName" =>  $this->accountName,
            "addressType" => 1,
            "replyToAddress" => "true",
            "toAddress" => $email_list,
            "subject" => "通知",
            "htmlBody" => $html
        ]);
        $runtime = new RuntimeOptions([]);
        $runtime->maxIdleConns   = 3;
        $runtime->connectTimeout = 10000;
        $runtime->readTimeout    = 10000;


        try {

            // 复制代码运行请自行打印 API 的返回值
            $client->singleSendMailWithOptions($singleSendMailRequest, $runtime);
            $json = Utils::toJSONString($resp);
            $rt['sta'] = "1";
            $rt['msg'] = "成功！";
            return $rt;
        } catch (\Exception $e) {
            $rt['sta'] = "0";
            $rt['msg'] = "失败！" . $e->getMessage();
            return $rt;
        }
    }

    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return Dm Client
     */
    public static function createClient($accessKeyId, $accessKeySecret)
    {
        $config = new Config([
            // 您的 AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 您的 AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dm.aliyuncs.com";
        return new Dm($config);
    }
}
