<?php

include_once "../l1comvm/vmlayer.php";
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/23
 * Time: 10:31
 */
if (EARTH_QUAKE == true) {

//    {
//        “ToUsr”:”XHZN”,
//	“FrUsr”:”IHU_LHEQ10060_RND01”,
//	“CrTim”:4335667,
//	“MsgTp”:"huitp-json",
//	“MsgId”:23681,  //0x5C81
//	“MsgLn”:115,
//	“IeCnt”:
//	{
//        “num”: 5,  //该值根据实际发送数据长度修改
//		“xData”: [2.45, 2.45, 2.45, 2.45, 2.45],
//		“yData”: [3.69, 3.69, 3.69, 3.69, 3.69],
//		“zData”: [6.88, 6.88, 6.88, 6.88, 6.88]
//	},
//	“FnFlg”:0
//}
    $obj = new classTaskL1vmCoreRouter();
//    $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
//    $json = json_decode('{"a":1,"b":2,"c":3,"d":4,"e":5}');
//    $json = $json;
/*
       "IeCnt":{
            "num":5,
            "xData":[2.45, 2.45, 2.45, 2.45, 2.45],
            "yData":[3.69, 3.69, 3.69, 3.69, 3.69],
            "zData":[6.88, 6.88, 6.88, 6.88, 6.88],
        },*/
    $json = '{
        "ToUsr":"XHZN",
        "FrUsr":"IHU_LHEQ10060_RND01",
        "CrTim":4335667,
        "MsgTp":"huitp",
        "MsgId":23681,
        "MsgLn":"115",
        "IeCnt":{
            "num":5,
            "xData":[2.45, 1.45, 3.45, 4.45, 5.45],
            "yData":[3.69, 1.69, 3.69, 4.69, 5.69],
            "zData":[6.88, 1.88, 3.88, 4.88, 5.88]
        },
        "FnFlg":0
    }';
//    $json = json_decode($json);
    $msg = array("socketid" => 1, "data"=>$json);
//    $msg = json_encode($msg);

    $obj->mfun_l1vm_task_main_entry(MFUN_MAIN_ENTRY_IOT_JSON, MSG_ID_L2SDK_JSON_DATA_INCOMING, "MSG_ID_L2SDK_JSON_DATA_INCOMING", $msg);
}

?>