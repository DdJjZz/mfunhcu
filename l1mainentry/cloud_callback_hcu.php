<?php
/**
 * Created by PhpStorm.
 * User: MAMA
 * Date: 2016/6/21
 * Time: 21:38
 */
include_once "../l1comvm/vmlayer.php";

// 主程序MAIN()
$obj = new classTaskL1vmCoreRouter();
//$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
$obj->mfun_l1vm_task_main_entry(MFUN_MAIN_ENTRY_HCU_IOT, file_get_contents('php://input','r'));

?>