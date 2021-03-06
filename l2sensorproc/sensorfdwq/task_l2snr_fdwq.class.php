<?php
/**
 * Created by PhpStorm.
 * User: zehongl
 * Date: 2016/11/7
 * Time: 21:36
 */


include_once "dbi_l2snr_fdwq.class.php";

class classTaskL2snrFdwq
{

    /**************************************************************************************
     *                             任务入口函数                                           *
     *************************************************************************************/
    public function mfun_l2snr_fdwq_task_main_entry($parObj, $msgId, $msgName, $msg)
    {
        //定义本入口函数的logger处理对象及函数
        $loggerObj = new classApiL1vmFuncCom();
        $project= MFUN_PRJ_HCU_HUITP;

        //入口消息内容判断
        if (empty($msg) == true) {
            $log_content = "E: receive null message body";
            $loggerObj->mylog($project,"NULL","MFUN_TASK_ID_L2DECODE_HUITP","MFUN_TASK_ID_L2SENSOR_FDWQ",$msgName,$log_content);
            return false;
        }
        else{
            //解开消息
            if (isset($msg["project"])) $project = $msg["project"]; else $project= "";;
            if (isset($msg["devCode"])) $devCode = $msg["devCode"]; else $devCode="";
            if (isset($msg["statCode"])) $statCode = $msg["statCode"]; else $statCode = "";
            if (isset($msg["content"])) $content = $msg["content"]; else $content="";
        }

        switch($msgId)
        {
            case HUITP_MSGID_uni_fdwq_data_resp:
                $dbiL2snrFdwqObj = new classDbiL2snrFdwq();
                $respHuitpMsg = $dbiL2snrFdwqObj->dbi_huitp_msg_uni_fdwq_data_resp($devCode, $statCode, $content);
                $resp = "";
                break;
            case HUITP_MSGID_uni_fdwq_data_report:
                $dbiL2snrFdwqObj = new classDbiL2snrFdwq();
                $respHuitpMsg = $dbiL2snrFdwqObj->dbi_huitp_msg_uni_fdwq_data_report($devCode, $statCode, $content);
                //组装返回消息 HUITP_MSGID_uni_fdwq_data_confirm, 并发送给L2 ENCODE进行编码发送
                if (!empty($respHuitpMsg)){
                    $msg = array("project" => $project,
                        "devCode" => $devCode,
                        "respMsg" => HUITP_MSGID_uni_fdwq_data_confirm,
                        "content" => $respHuitpMsg);
                    if ($parObj->mfun_l1vm_msg_send(MFUN_TASK_ID_L2SENSOR_FDWQ,
                            MFUN_TASK_ID_L2ENCODE_HUITP,
                            MSG_ID_L2CODEC_ENCODE_HUITP_INCOMING,
                            "MSG_ID_L2CODEC_ENCODE_HUITP_INCOMING",
                            $msg) == false) $resp = "E: send to message buffer error";
                    else $resp = "";
                }
                $resp = "";
                break;

            case HUITP_MSGID_uni_fdwq_profile_report:
                $dbiL2snrFdwqObj = new classDbiL2snrFdwq();
                $respHuitpMsg = $dbiL2snrFdwqObj->dbi_huitp_msg_uni_fdwq_profile_report($devCode, $statCode, $content);
                //组装返回消息 HUITP_MSGID_uni_fdwq_profile_confirm, 并发送给L2 ENCODE进行编码发送
                if (!empty($respHuitpMsg)){
                    $msg = array("project" => $project,
                        "devCode" => $devCode,
                        "respMsg" => HUITP_MSGID_uni_fdwq_profile_confirm,
                        "content" => $respHuitpMsg);
                    if ($parObj->mfun_l1vm_msg_send(MFUN_TASK_ID_L2SENSOR_FDWQ,
                            MFUN_TASK_ID_L2ENCODE_HUITP,
                            MSG_ID_L2CODEC_ENCODE_HUITP_INCOMING,
                            "MSG_ID_L2CODEC_ENCODE_HUITP_INCOMING",
                            $msg) == false) $resp = "E: send to message buffer error";
                    else $resp = "";

                }
                break;

            default:
                $resp = "E: L2SNR_CCL receive unknown MsgId";
                break;
        }

        if (!empty($resp)) {
            $log_content = json_encode($resp,JSON_UNESCAPED_UNICODE);
            $loggerObj->mylog($project,$devCode,"MFUN_TASK_ID_L2SENSOR_FDWQ","MFUN_TASK_ID_L2ENCODE_HUITP",$msgName,$log_content);
        }

        //返回
        return true;
    }

}//End of class_task_service

?>