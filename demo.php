<?php
require_once("./vendor/autoload.php");
use xiaoqiangqiang\cainiao\Tools;

$tool = new Tools("", "");
$orderId = "2019235314";
$apiData = [
    "cpCode"=>"CTO",
    "tradeOrderInfoDtos"=>[
        "orderInfo"=>[
            "orderChannelsType"=>"OTHERS",
            "tradeOrderList"=>[$orderId],
        ],
        "recipient"=>[
            "address"=>[
                "province"=>"",
                "city"=>"",
                "district"=>"",
                "town"=>"",
                "detail"=>"",
            ],
            "phone"=>"",
            "mobile"=>"",
            "name"=>"",
        ],
        "packageInfo"=>[],
        "userId"=>"",
        "objectId"=>"",
        "templateUrl"=>"",
    ],
    "needEncrypt"=>false,
    "resourceCode"=>"无",
    "sender"=>[
        "address"=>[
            "province"=>"",
            "city"=>"",
            "district"=>"",
            "town"=>"",
            "detail"=>"",
        ],
        "phone"=>"",
        "mobile"=>"",
        "name"=>"",
    ],
    "dmsSorting"=>false,
    "storeCode"=>"无",
];
$data = $tool->getOrder($apiData);
echo $data;
