<?php
/**
 * Created by PhpStorm.
 * User: jianlinz
 * Date: 2016/6/20
 * Time: 13:16
 */

//系统任务级MAX_TASK_NUM_IN_ONE_MFUN
define("MAX_TASK_NUM_IN_ONE_MFUN", 64);
define("TASK_NAME_MAX_LENGTH", 40);

//消息长度
define("MFUN_MSG_BUFFER_NBR_MAX", 5);
define("MFUN_MSG_NAME_MAX_LENGTH", 70);
define("MFUN_MSG_BODY_LENGTH", 400);
define("MFUN_FILE_NAME_LENGTH_MAX", 100);

define("SWOOLE_SOCKET_PACKAGE_MAX_LENGTH", 200000); //200K,用于图片等Hex数据包

?>