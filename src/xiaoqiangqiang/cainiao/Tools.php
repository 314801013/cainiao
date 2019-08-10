<?php
namespace xiaoqiangqiang\cainiao;

class Tools
{
	private $apiUrl = "https://link.tbsandbox.com/gateway/link.do";
	private $appSecret = "";
	private $cpCode = "";

    /**
     * 初始化
     * @param $appSecret APPKEY对应的秘钥
     * @param $cpCode 调用方的CPCODE
     */
    public function __construct($appSecret, $cpCode)
    {
        $this->appSecret = $appSecret;
        $this->cpCode = $cpCode;
    }
    /**
     * 电子面单云打印取号
     * @param $data 订单信息
     */
    public function getOrder($data)
    {
        return $this->requestApi("CLOUDPRINT_STANDARD_TEMPLATES", $data);
    }
    /**
     * 发起api请求
     * @param $apiName 调用的API名
     * @param $apiData 请求数据
     * @return mixed
     */
    private function requestApi($apiName, $apiData)
	{
        $digest = base64_encode(md5(json_encode($apiData).$this->appSecret, true));
	    $data = [
	        "msg_type"=>$apiName,
            "to_code"=>"json",
            "logistics_interface"=>json_encode($apiData),
            "data_digest"=>$digest,
            "logistic_provider_id"=>$this->cpCode
        ];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/x-www-form-urlencoded']);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		$output = curl_exec($ch);
		curl_close($ch);
		echo $output;
		return json_decode($output);
	}
}
