<?php
/**
 * Created by PhpStorm.
 * User: MAMA
 * Date: 2016/7/4
 * Time: 21:46
 */
include_once "../l1comvm/vmlayer.php";

class classTaskL2SocketListen
{
    //构造函数
    public function __construct()
    {

    }

    /**************************************************************************************
     *                             任务入口函数                                           *
     *************************************************************************************/
    public function mfun_l2socket_listen_task_main_entry($parObj, $msgId, $msgName, $msg)
    {
        //定义本入口函数的logger处理对象及函数
        $loggerObj = new classApiL1vmFuncCom();
        $project = MFUN_PRJ_HCU_HEXDATA;
        $statCode = "";

        //入口消息内容判断
        if (empty($msg) == true) {
            $log_content = "E: receive null message body";
            $loggerObj->mylog($project,"NULL","MFUN_TASK_ID_L2DECODE_HUITP","MFUN_TASK_ID_L2SOCKET_LISTEN",$msgName,$log_content);
            return false;
        }
        else{
            //解开消息
            if (isset($msg["socketid"])) $socketid = $msg["socketid"]; else  $socketid = "";
            if (isset($msg["data"])) $data = $msg["data"]; else  $data = "";
        }
        if (($msgId != MSG_ID_L2SOCKET_LISTEN_DATA_COMING) || ($msgName != "MSG_ID_L2SOCKET_LISTEN_DATA_COMING")){
            $log_content = "E: L2SOCKET_LISTEN receive Msgid or MsgName error";
            $loggerObj->mylog($project,"NULL","MFUN_TASK_ID_L1VM","MFUN_TASK_ID_L2SOCKET_LISTEN",$msgName,$log_content);
            return false;
        }

        //图片HEX数据来自MFUN_SWOOLE_SOCKET_DATA_STREAM_TCP端口，数据格式定义如下：
        //第0-31字节为后台分配的照片ID，该ID通过开锁请求响应Anth_Resp消息发送给CCL, CCL在发送照片数据时带回。如果照片ID不满32个字符用下划线“_"填充
        //第32～35字节为数据长度，4B，网络字节序高位在前，后面的数据为照片Hex码流
        if ($msgId == MSG_ID_L2SOCKET_LISTEN_DATA_COMING)
        {
            $filename = "";
            //解析照片ID
            for($i=0; $i<HUITP_IEID_UNI_CCL_GEN_PIC_ID_LEN_MAX; $i++){
                $filename = $filename. $data[$i];
            }
            $picname = trim($filename, "_").MFUN_HCU_SITE_PIC_FILE_TYPE; //去除可能的填充字符

            //解析数据长度
            $len = array();
            for($i=0; $i<4; $i++) {
                $len[$i] = intval(bin2hex($data[$i+HUITP_IEID_UNI_CCL_GEN_PIC_ID_LEN_MAX]),16);
            }
            $length = ($len[0]*256*256*256) + ($len[1]*256*256) + ($len[2]*256) + $len[3];

            //查询开锁记录表，通过事先生成的文件名找到对应的站点。
            //这里有一种情况没有考虑，暴力开锁没有事先生成照片ID的情况
            $dbiL2snrHsmmpObj = new classDbiL2snrHsmmp();
            $statCode = $dbiL2snrHsmmpObj->dbi_fhys_locklog_picture_name_inqury($picname);
            if (empty($statCode)){
                $log_content = "E: L2SOCKET_LISTEN reecive invalid picnmae = ".$picname;
                $loggerObj->mylog($project,"NULL","MFUN_TASK_ID_L1VM","MFUN_TASK_ID_L2SDK_IOT_STDXML",$msgName,$log_content);
                echo trim($log_content); //这里echo主要是为了swoole log打印，帮助查找问题
                return true;
            }
            //解析HEX Content
            $content = array();
            for($i=0; $i<$length; $i++){
                $content[$i] = $data[$i+HUITP_IEID_UNI_CCL_GEN_PIC_ID_LEN_MAX+4];
            }

            $msg = array("project" => $project,
                "picname" => $picname,
                "picsize" => $length,
                "statCode" => $statCode,
                "content" => $content);
            if ($parObj->mfun_l1vm_msg_send(MFUN_TASK_ID_L2SOCKET_LISTEN,
                    MFUN_TASK_ID_L2SENSOR_HSMMP,
                    MSG_ID_L2SOCKET_TO_L2SNR_HSMMP,
                    "MSG_ID_L2SOCKET_TO_L2SNR_HSMMP",
                    $msg) == false) $resp = "E: send to message buffer error";
            else $resp = "";
        }

        else{
            $resp ="E: received invalid MSGID!";
        }

        if (!empty($resp))  {
            $log_content = json_encode($resp,JSON_UNESCAPED_UNICODE);
            $loggerObj->mylog($project,$statCode,"MFUN_TASK_ID_L2SOCKET_LISTEN","MFUN_TASK_ID_L2SENSOR_HSMMP",$msgName,$log_content);
        }

        //返回
        return true;
    }

}//End of class_task_service
