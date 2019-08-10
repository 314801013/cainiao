<?php
namespace xiaoqiangqiang\cainiao;

class Tools
{
	private $apiUrl = "https://link.tbsandbox.com/gateway/link.do";
	private $appSecret = "o4Uz43n454Q999PVDE97Mh0Oh3M10qF3";
	private $cpCode = "CN7000001065877";

    /**
     * Tools constructor.
     * @param $appSecret APPKEY对应的秘钥
     * @param $cpCode 调用方的CPCODE
     */
    public function __construct($appSecret, $cpCode)
    {

    }
    public function getOrder()
    {

    }
    /**
     * @param $apiName 调用的API名
     * @param $apiData 请求数据
     * @return mixed
     */
    private function requestApi($apiName, $apiData)
	{
        $digest = base64_encode(md5(json_encode($apiData).$this->appSecret, true));
	    $data = [
	        "msg_type"=>$apiName,
            "to_code"=>"",
            "logistics_interface"=>urlencode(json_encode($apiData)),
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
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);
		return json_decode($output);
	}
}
