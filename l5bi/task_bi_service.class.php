<?php
/**
 * Created by PhpStorm.
 * User: zehongli
 * Date: 2016/1/6
 * Time: 13:40
 */
//include_once "../l1comvm/vmlayer.php";
include_once "../l5bi/dbi_l5bi_service.class.php";
include_once "../l2sensorproc/proccom/dbi_l2snr_com.class.php";

$biObj = new classDbiL2snrCommon();

$timestamp = time();
$date = date("ymd",$timestamp);
$hour =date('H',$timestamp);

$devcode = "HCU_SH_0301";
$statcode = "120101001";

$biObj->dbi_hourreport_process($devcode,$statcode,$date,$hour);

class classTaskL5biService
{
    //构造函数
    public function __construct()
    {

    }

    /**************************************************************************************
     *                             任务入口函数                                           *
     *************************************************************************************/
    public function mfun_l5bi_service_task_main_entry($parObj, $msgId, $msgName, $msg)
    {

    }

}//End of class_task_service

?>