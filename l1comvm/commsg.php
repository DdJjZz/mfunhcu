<?php
/**
 * Created by PhpStorm.
 * User: jianlinz
 * Date: 2016/6/20
 * Time: 13:16
 */

//由于PHP中无法定义结构，而且消息就是两个模块之间协商的结构，故而这里不再定义详细的消息结构，留给两个任务自行确定
//这里只是定义了消息ID。由于消息ID的多寡并没有太多限制，建议未来不要在消息内部区分不同的子消息，而是平铺直叙，一个消息
//完成一个任务功能，所以两个任务之间可以定义多个消息
//消息定义均以SOURCE为基础
$index = 0;
define("MSG_ID_MFUN_MIN", $index++);
//L1L2部分消息

//earthquick
define("EARTHQUICK_COMING",$index++);


define("MSG_ID_L1VM_TO_L2SDK_WECHAT_INCOMING", $index++);
define("MSG_ID_WECHAT_TO_L2SDK_IOT_WX_INCOMING", $index++);
define("MSG_ID_IOTWX_TO_L2SDK_IOT_WX_JSSDK_INCOMING", $index++);
define("MSG_ID_L1VM_TO_L2SDK_IOT_STDXML_INCOMING", $index++);
define("MSG_ID_L1VM_TO_L2SDK_IOT_APPLE_INCOMING", $index++);
define("MSG_ID_L1VM_TO_L2SDK_IOT_JD_INCOMING", $index++);
define("MSG_ID_L1VM_TO_L3WXL3WXOPR_FAAM_XCXPOST", $index++);
//L2CODEC
define("MSG_ID_L1VM_TO_L2SDK_IOT_HUITP_INCOMING", $index++);
define("MSG_ID_L2CODEC_ENCODE_HUITP_INCOMING", $index++);
define("MSG_ID_L2SDK_WECHAT_TO_L2DECODE_HUITP", $index++);
define("MSG_ID_L2SDK_IOT_HUITP_TO_L2DECODE_HUITP", $index++);
//L2SDK
define("MSG_ID_L2SDK_HCU_TO_L2SNR_EMC", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_EMC_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_EMC_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_POWER_STATUS_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_HSMMP_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_HSMMP_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_AIRPRS", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_AIRPRS_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_AIRPRS_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_ALCOHOL", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_ALCOHOL_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_ALCOHOL_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_CO1", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_CO1_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_CO1_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_HCHO", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_HCHO_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_HCHO_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_TOXICGAS", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_TOXICGAS_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_TOXICGAS_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_LIGHTSTR", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_LIGHTSTR_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_LIGHTSTR_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_RAIN", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_RAIN_DATA_READ_INSTANT", $index++);
define("MSG_ID_L2SDK_EMCWX_TO_L2SNR_RAIN_DATA_REPORT_TIMING", $index++);
define("MSG_ID_L2SDK_WECHAT_DATA_COMING", $index++);
define("MSG_ID_L2SDK_HCU_DATA_COMING", $index++);
define("MSG_ID_L2SDK_HUITP_DATA_COMING", $index++);
//FHYS智能云锁消息
define("MSG_ID_L2SDK_HCU_TO_L2SNR_HSMMP", $index++); //兼容老的云控锁消息(照片发送)
define("MSG_ID_L2SDK_HCU_TO_L2SNR_DOORLOCK", $index++); //用于兼容老的郑州FHYS方案
define("MSG_ID_L2SDK_HCU_TO_L2SNR_BATT", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_BLE", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_GPRS", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_RFID", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_SMOK", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_VIBR", $index++);
define("MSG_ID_L2SDK_HCU_TO_L2SNR_WATER", $index++);
//BFSC组合秤消息
define("MSG_ID_L2SDK_HCU_TO_L2SNR_WEIGHT", $index++);
//L2SDK_JD消息部分
define("MSG_ID_L2SDK_JD_INCOMING", $index++);
//L2SDK_APPLE消息部分
define("MSG_ID_L2SDK_APPLE_INCOMING", $index++);
//L2SDK_NBIOT_STD_QG376消息部分
define("MSG_ID_L2SDK_NBIOT_STD_QG376_INCOMING", $index++);
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_CNFNG", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_RESET", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_LICK", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_RELAY", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_SETPAR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_CONTROL", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_SECNEG", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_REQREP", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_REQCFG", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_INQPAR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_REQTSK", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_REQDATA1", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_REQDATA2", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_REQDATA3", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_FILETRNS", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_QG376_TO_L2SNR_IPM_AFN_UL_DATAFWD", $index++); //终端主动上报消息或者被动反馈消息
//L2SDK_NBIOT_STD_CJ188消息部分
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_INCOMING", $index++);
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IWM_READ_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IWM_READ_KEY_VER", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IWM_READ_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IWM_WRITE_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IWM_WRITE_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IWM_WRITE_DEVICE_SYN", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IHM_READ_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IHM_READ_KEY_VER", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IHM_READ_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IHM_WRITE_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IHM_WRITE_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IHM_WRITE_DEVICE_SYN", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IGM_READ_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IGM_READ_KEY_VER", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IGM_READ_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IGM_WRITE_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IGM_WRITE_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IGM_WRITE_DEVICE_SYN", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IPM_READ_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IPM_READ_KEY_VER", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IPM_READ_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IPM_WRITE_DATA", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IPM_WRITE_ADDR", $index++); //终端主动上报消息或者被动反馈消息
define("MSG_ID_L2SDK_NBIOT_STD_CJ188_TO_L2SNR_IPM_WRITE_DEVICE_SYN", $index++); //终端主动上报消息或者被动反馈消息

//L2SDK_NBIOT_LTEV消息部分
define("MSG_ID_L2SDK_NBIOT_LTEV_INCOMING", $index++);
//L2SDK_NBIOT_AGC消息部分
define("MSG_ID_L2SDK_NBIOT_AGC_INCOMING", $index++);
//L2TIMERCRON消息部分
define("MSG_ID_L2TIMER_CRON_1MIN_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_3MIN_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_10MIN_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_30MIN_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_1HOUR_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_6HOUR_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_24HOUR_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_2DAY_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_7DAY_COMING", $index++);
define("MSG_ID_L2TIMER_CRON_30DAY_COMING", $index++);
//L2SOCKET_LISTEN消息部分
define("MSG_ID_L2SOCKET_LISTEN_DATA_COMING", $index++);
define("MSG_ID_L2SOCKET_TO_L2SNR_HSMMP", $index++);
//L3APPL消息部分
define("MSG_ID_L3APPL_DATA_COMING", $index++);

//L3NBIOT_OPR_METER
define("MSG_ID_L3NBIOT_OPR_METERTO_STD_QG376_DL_REQUEST", $index++);
define("MSG_ID_L3NBIOT_OPR_METERTO_STD_CJ188_DL_REQUEST", $index++);

//L4COMCUI部分
define("MSG_ID_L4COMUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_LOGIN", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_USERAUTHCODE", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_PWRESET", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_USERINFO", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_USERNEW", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_USERMOD", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_USERDEL", $index++);
define("MSG_ID_L4COMUI_TO_L3F1_USERTABLE", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_TABLEQUERY", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PROJECTPGLIST", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PROJECTLIST", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_USERPROJ", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PGTABLE", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PGNEW", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PGMOD", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PGDEL", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PGPROJ", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PROJTABLE", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PROJNEW", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_PROJMOD", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_ALLPROJPOINT", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_ONEPROJPOINT", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_POINTTABLE", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_POINTNEW", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_POINTMOD", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_POINTACTIVESET", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_POINTACTIVEINFO", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_POINTDEV", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_DEVTABLE", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_DEVNEW", $index++);
define("MSG_ID_L4COMUI_TO_L3F2_DEVMOD", $index++);
define("MSG_ID_L4COMUI_TO_L3F3_MONITORLIST", $index++);
define("MSG_ID_L4COMUI_TO_L3F3_FAKEMONITORLIST", $index++);
define("MSG_ID_L4COMUI_TO_L3F3_FAVOURITELIST", $index++);
define("MSG_ID_L4COMUI_TO_L3F3_FAVOURITECOUNT", $index++);
define("MSG_ID_L4COMUI_TO_L3F4_CAMWEB", $index++);     //使用第三方控件实现视频和摄像头处理
define("MSG_ID_L4COMUI_TO_L3F4_HSMMPLIST", $index++);  //查询某HCU设备指定日期的视频/图片文件列表
define("MSG_ID_L4COMUI_TO_L3F4_HSMMPPLAY", $index++);  //请求播放某指定视频/图片文件
define("MSG_ID_L4COMUI_TO_L3F4_GETCAMERASTATUS", $index++);  //查询垂直和水平角度，同时报告传一个照片给后台
define("MSG_ID_L4COMUI_TO_L3F4_GETCAMERAUNIT", $index++);
define("MSG_ID_L4COMUI_TO_L3F4_SENSORUPDATE", $index++);
define("MSG_ID_L4COMUI_TO_L3F6_PERFORMANCETABLE", $index++);
define("MSG_ID_L4COMUI_TO_L3F7_SETUSERMSG", $index++);
define("MSG_ID_L4COMUI_TO_L3F7_GETUSERMSG", $index++);
define("MSG_ID_L4COMUI_TO_L3F7_SHOWUSERMSG", $index++);
define("MSG_ID_L4COMUI_TO_L3F7_GETUSERIMG", $index++);
define("MSG_ID_L4COMUI_TO_L3F7_CLEARUSERIMG", $index++);

//L4AQYCUI部分
define("MSG_ID_L4AQYCUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F2_PROJDEL", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F2_POINTDEL", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F2_DEVDEL", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F3_SENSORLIST", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F3_DEVSENSOR", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F3_GETSTATICMONITORTABLE", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMTYPE", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_DEVALARM", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMMONITORLIST", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMHANDLETABLE", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMIMGGET", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMHANDLE", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMCLOSE", $index++);
define("MSG_ID_L4AQYCUI_TO_L3F5_ALARMQUERY", $index++);

//L4FHYS部分
define("MSG_ID_L4FHYSUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_PROJDEL", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_POINTDEL", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_DEVDEL", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_USERKEY", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_PROJKEYLIST", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_PROJKEY", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_PROJKEYUSERLIST", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYTABLE", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYNEW", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYMOD", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYDEL", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_OBJAUTHLIST", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYAUTHLIST", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYGRANT", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYAUTHNEW", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F2_KEYAUTHDEL", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F3_KEYHISTORY", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F3_DOOROPENPIC", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F3_SENSORLIST", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F3_DEVSENSOR", $index++);  //原有AQYC消息修改适配FHYS功能
define("MSG_ID_L4FHYSUI_TO_L3F3_POINTPICTURE", $index++); //FHYS新增站点图片消息
define("MSG_ID_L4FHYSUI_TO_L3F3_GETSTATICMONITORTABLE", $index++);  //原有AQYC消息修改适配FHYS功能
define("MSG_ID_L4FHYSUI_TO_L3F2_RTUTABLE", $index++); //用于FHYS临时纤芯资源管理
define("MSG_ID_L4FHYSUI_TO_L3F2_OTDRTABLE", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F4_LOCKOPEN", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F5_ALARMTYPE",$index++);
define("MSG_ID_L4FHYSUI_TO_L3F5_DEVALARM", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F5_ALARMHANDLETABLE", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F5_ALARMHANDLE", $index++);
define("MSG_ID_L4FHYSUI_TO_L3F5_ALARMCLOSE", $index++);

//L4FHYS WECHAT部分
define("MSG_ID_L4FHYS_WECHAT_CLICK_INCOMING", $index++);
define("MSG_ID_FHYSWECHAT_TO_L3WXOPR_LOGIN", $index++);
define("MSG_ID_FHYSWECHAT_TO_L3WXOPR_USERBIND", $index++);
define("MSG_ID_FHYSWECHAT_TO_L3WXOPR_LOCKQUERY", $index++);
define("MSG_ID_FHYSWECHAT_TO_L3WXOPR_LOCKSTATUS", $index++);
define("MSG_ID_FHYSWECHAT_TO_L3WXOPR_LOCKOPEN", $index++);

//for BFSC
define("MSG_ID_L4BFSCUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4BFSCUI_TO_L3F3_GETSTATICMONITORTABLE", $index++);

//L4EMCWXUI部分
define("MSG_ID_L4EMCWXUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4EMCWXUI_TO_L3WXOPR_EMCUSER", $index++); //EMC H5界面请求当前微信用户的OPEN ID
define("MSG_ID_L4EMCWXUI_TO_L3WXOPR_EMCNOW", $index++);  //EMC H5界面请求当前辐射值
define("MSG_ID_L4EMCWXUI_TO_L3WXOPR_EMCHISTORY", $index++); //EMC H5界面请求历史辐射值
define("MSG_ID_L4EMCWXUI_TO_L3WXOPR_EMCALARM", $index++); //EMC H5界面请求辐射值warning，alarm门限
define("MSG_ID_L4EMCWXUI_TO_L3WXOPR_EMCTRACK", $index++); //EMC H5界面请求当前辐射记录地理轨迹

//L4TBSWRUI部分
define("MSG_ID_L4TBSWR_CLICK_INCOMING", $index++);
define("MSG_ID_L4TBSWRUI_TO_L3F4_GETTEMPSTATUS", $index++);  //查询温度状态

//L4FDWQUI部分
define("MSG_ID_L4FDWQUI_CLICK_INCOMING", $index++);

//L4GTJY部分
define("MSG_ID_L4GTJYUI_CLICK_INCOMING", $index++);

//L4FAAM
define("MSG_ID_L4FAAMUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_FACTORYCODELIST", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_FACTORYTABLE", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_FACTORYMOD", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_FACTORYNEW", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_FACTORYDEL", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_PRODUCTTYPE", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_PRODUCTTYPEMOD", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_PRODUCTTYPENEW", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_PRODUCTTYPEDEL", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_STAFFNAMELIST", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_STAFFTABLE", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_STAFFNEW", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_STAFFMOD", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_STAFFDEL", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCEHISTORY", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCERECORDNEW", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCERECORDBATCH", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCEDEL", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCEGET", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCEMOD", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_ATTENDANCEAUDIT", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_PRODUCTIONHISTORY", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_PRODUCTIONAUDIT", $index++);
define("MSG_ID_L4FAAMUI_TO_L3F11_KPIAUDIT", $index++);

//L4NBIOTIPMUI部分
define("MSG_ID_L4NBIOT_IPMUI_CLICK_INCOMING", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3F1_LOGIN", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_AFN_REQDATA1_F1", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_AFN_REQDATA1_F2", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_AFN_REQDATA1_F25", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_AFN_REQDATA1_F26", $index++);
//暂时不考虑其他功能，而只是先搞规范确定的功能
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_CURRENT_COUNTER_DATA", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA1", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA2", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA3", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA4", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA5", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA6", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA7", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA8", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA9", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA10", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA11", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA12", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BILL_DATE", $index++);  //结算日
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ACCOUNT_DATE", $index++); //抄表日
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BUY_AMOUNT", $index++); //购入金额
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_KEY_VER", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BILL_DATE", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ACCOUNT_DATE", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BUY_AMOUNT", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_NEW_KEY", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_STD_TIME", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_SWITCH_CTRL", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_OFF_FACTORY_START", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IPMUI_TO_L3OPR_METER_DL_WRITE_DEVICE_SYN_DATA", $index++);

//L4NBIOTIGMUI部分
define("MSG_ID_L4NBIOT_IGMUI_CLICK_INCOMING", $index++);
//暂时不考虑其他功能，而只是先搞规范确定的功能
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_CURRENT_COUNTER_DATA", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA1", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA2", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA3", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA4", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA5", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA6", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA7", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA8", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA9", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA10", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA11", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA12", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BILL_DATE", $index++);  //结算日
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ACCOUNT_DATE", $index++); //抄表日
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BUY_AMOUNT", $index++); //购入金额
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_KEY_VER", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BILL_DATE", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ACCOUNT_DATE", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BUY_AMOUNT", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_NEW_KEY", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_STD_TIME", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_SWITCH_CTRL", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_OFF_FACTORY_START", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IGMUI_TO_L3OPR_METER_DL_WRITE_DEVICE_SYN_DATA", $index++);


//L4NBIOTIWMUI部分
define("MSG_ID_L4NBIOT_IWMUI_CLICK_INCOMING", $index++);
//暂时不考虑其他功能，而只是先搞规范确定的功能
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_CURRENT_COUNTER_DATA", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA1", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA2", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA3", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA4", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA5", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA6", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA7", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA8", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA9", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA10", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA11", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA12", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BILL_DATE", $index++);  //结算日
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ACCOUNT_DATE", $index++); //抄表日
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BUY_AMOUNT", $index++); //购入金额
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_KEY_VER", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BILL_DATE", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ACCOUNT_DATE", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BUY_AMOUNT", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_NEW_KEY", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_STD_TIME", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_SWITCH_CTRL", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_OFF_FACTORY_START", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IWMUI_TO_L3OPR_METER_DL_WRITE_DEVICE_SYN_DATA", $index++);


//L4NBIOTIHMUI部分
define("MSG_ID_L4NBIOT_IHMUI_CLICK_INCOMING", $index++);
//暂时不考虑其他功能，而只是先搞规范确定的功能
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_CURRENT_COUNTER_DATA", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA1", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA2", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA3", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA4", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA5", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA6", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA7", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA8", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA9", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA10", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA11", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_HISTORY_COUNTER_DATA12", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BILL_DATE", $index++);  //结算日
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ACCOUNT_DATE", $index++); //抄表日
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_BUY_AMOUNT", $index++); //购入金额
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_KEY_VER", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_READ_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_PRICE_TABLE", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BILL_DATE", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ACCOUNT_DATE", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_BUY_AMOUNT", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_NEW_KEY", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_STD_TIME", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_SWITCH_CTRL", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_OFF_FACTORY_START", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DI0DI1_ADDRESS", $index++);
define("MSG_ID_L4NBIOT_IHMUI_TO_L3OPR_METER_DL_WRITE_DEVICE_SYN_DATA", $index++);


//L5BI部分
define("MSG_ID_L4BI_CLICK_INCOMING", $index++);

//为了兼容最新HUITP消息，暂时修改
define("MSG_ID_MFUN_MAX", 0xFEFF);


/**************************************************************************************
 *                             公共消息全局量定义                                     *
 *************************************************************************************/


//公共命令操作字
define("MFUN_HCU_OPT_INVENTORY_REQ", 0x01);
define("MFUN_HCU_OPT_INVENTORY_RESP", 0x81);
define("MFUN_HCU_OPT_SWUPDATE_REQ", 0x01);
define("MFUN_HCU_OPT_SWUPDATE_RESP", 0x81);
define("MFUN_HCU_OPT_VEDIOLINK_REQ", 0x01);  //读取下位机存放的视频文件link
define("MFUN_HCU_OPT_VEDIOLINK_RESP", 0x81); //返回下位机存放的视频文件link
define("MFUN_HCU_OPT_VEDIOFILE_REQ", 0x02);   //命令下位机上传选中的视频文件
define("MFUN_HCU_OPT_VEDIOFILE_RESP", 0x82);  //视频文件传输完成响应
define("MFUN_HCU_OPT_VEDIOPIC_REQ", 0x07);   //mfunhcu向下位机取照片操作字
define("MFUN_HCU_OPT_VEDIOPIC_RESP", 0x87);   //下位机取完照片之后完成相应
define("MFUN_HCU_OPT_STATUS_REQ", 0x01); //读取下位机的状态
define("MFUN_HCU_OPT_STATUS_RESP", 0x81); //返回下位机的状态


/**************************************************************************************
 *                            NBIOT IPM376消息定义                                    *
 *************************************************************************************/
//AFN消息字段
define("MFUN_NBIOT_IPM376_AFN_CMDID_CNFNG", 0x00);
define("MFUN_NBIOT_IPM376_AFN_CMDID_RESET", 0x01);
define("MFUN_NBIOT_IPM376_AFN_CMDID_LICK", 0x02);  //Link Interface Check
define("MFUN_NBIOT_IPM376_AFN_CMDID_RELAY", 0x03);
define("MFUN_NBIOT_IPM376_AFN_CMDID_SETPAR", 0x04);
define("MFUN_NBIOT_IPM376_AFN_CMDID_CONTROL", 0x05);
define("MFUN_NBIOT_IPM376_AFN_CMDID_SECNEG", 0x06);
define("MFUN_NBIOT_IPM376_AFN_CMDID_REQREP", 0x08);
define("MFUN_NBIOT_IPM376_AFN_CMDID_REQCFG", 0x09);
define("MFUN_NBIOT_IPM376_AFN_CMDID_INQPAR", 0x0A);
define("MFUN_NBIOT_IPM376_AFN_CMDID_REQTSK", 0x0B);
define("MFUN_NBIOT_IPM376_AFN_CMDID_REQDATA1", 0x0C);
define("MFUN_NBIOT_IPM376_AFN_CMDID_REQDATA2", 0x0D);
define("MFUN_NBIOT_IPM376_AFN_CMDID_REQDATA3", 0x0E);
define("MFUN_NBIOT_IPM376_AFN_CMDID_FILETRNS", 0x0F);
define("MFUN_NBIOT_IPM376_AFN_CMDID_DATAFWD", 0x10);

//消息头的全局定义
define("MFUN_NBIOT_IPM376_FRAME_FIX_HEAD", 0x68);
define("MFUN_NBIOT_IPM376_FRAME_FIX_START", 0x68);
define("MFUN_NBIOT_IPM376_FRAME_FIX_TAIL", 0x16);
define("MFUN_NBIOT_IPM376_FRAME_MAX_LEN", 255); //16383 under fix network transmission


/**************************************************************************************
 *                            NBIOT CJ188消息定义                                    *
 *************************************************************************************/
//T代码标识不同的仪表
define("MFUN_NBIOT_CJ188_T_TYPE_WATER_METER_MIN", 0x10);
define("MFUN_NBIOT_CJ188_T_TYPE_WATER_METER_MAX", 0x19);
define("MFUN_NBIOT_CJ188_T_TYPE_HEAT_METER_MIN", 0x20);
define("MFUN_NBIOT_CJ188_T_TYPE_HEAT_METER_MAX", 0x29);
define("MFUN_NBIOT_CJ188_T_TYPE_GAS_METER_MIN", 0x30);
define("MFUN_NBIOT_CJ188_T_TYPE_GAS_METER_MAX", 0x39);
define("MFUN_NBIOT_CJ188_T_TYPE_POWER_METER_MIN", 0x40);
define("MFUN_NBIOT_CJ188_T_TYPE_POWER_METER_MAX", 0x49);

define("MFUN_NBIOT_CJ188_T_TYPE_COLD_WATER_METER", 0x10);
define("MFUN_NBIOT_CJ188_T_TYPE_HOT_WATER_METER", 0x11);
define("MFUN_NBIOT_CJ188_T_TYPE_DRINK_WATER_METER", 0x12);
define("MFUN_NBIOT_CJ188_T_TYPE_MIDDLE_WATER_METER", 0x13);
define("MFUN_NBIOT_CJ188_T_TYPE_HEAT_ENERGY_METER", 0x20);
define("MFUN_NBIOT_CJ188_T_TYPE_COLD_ENERGY_METER", 0x21);
define("MFUN_NBIOT_CJ188_T_TYPE_GAS_METER", 0x30);
define("MFUN_NBIOT_CJ188_T_TYPE_ELECTRONIC_POWER_METER", 0x40);

//Control码子代表的不同含义
define("MFUN_NBIOT_CJ188_CTRL_MIN", 0x0);
define("MFUN_NBIOT_CJ188_CTRL_RESERVED", 0x0);
define("MFUN_NBIOT_CJ188_CTRL_READ_DATA", 0x01);
define("MFUN_NBIOT_CJ188_CTRL_WRITE_DATA", 0x04);
define("MFUN_NBIOT_CJ188_CTRL_READ_KEY_VER", 0x09);
define("MFUN_NBIOT_CJ188_CTRL_READ_ADDR", 0x03);
define("MFUN_NBIOT_CJ188_CTRL_WRITE_ADDR", 0x05);
define("MFUN_NBIOT_CJ188_CTRL_WRITE_DEVICE_SYN", 0x16);
define("MFUN_NBIOT_CJ188_CTRL_MAX", 0x16);

//应用层DI0DI1的定义
define("MFUN_NBIOT_CJ188_READ_DI0DI1_CURRENT_COUNTER_DATA", 0x901F);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA1", 0xD120);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA2", 0xD121);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA3", 0xD122);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA4", 0xD123);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA5", 0xD124);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA6", 0xD125);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA7", 0xD126);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA8", 0xD127);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA9", 0xD128);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA10", 0xD129);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA11", 0xD12A);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_HISTORY_COUNTER_DATA12", 0xD12B);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_PRICE_TABLE", 0x8102);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_BILL_DATE", 0x8103);  //结算日
define("MFUN_NBIOT_CJ188_READ_DI0DI1_ACCOUNT_DATE", 0x8104); //抄表日
define("MFUN_NBIOT_CJ188_READ_DI0DI1_BUY_AMOUNT", 0x8105); //购入金额
define("MFUN_NBIOT_CJ188_READ_DI0DI1_KEY_VER", 0x8106);
define("MFUN_NBIOT_CJ188_READ_DI0DI1_ADDRESS", 0x810A);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_PRICE_TABLE", 0xA010);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_BILL_DATE", 0xA011);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_ACCOUNT_DATE", 0xA012);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_BUY_AMOUNT", 0xA013);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_NEW_KEY", 0xA014);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_STD_TIME", 0xA015);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_SWITCH_CTRL", 0xA017);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_OFF_FACTORY_START", 0xA019);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_ADDRESS", 0xA018);
define("MFUN_NBIOT_CJ188_WRITE_DI0DI1_DEVICE_SYN_DATA", 0xA016);

//单位代号表
define ("MFUN_NBIOT_CJ188_UNIT_WH", 0x02);
define ("MFUN_NBIOT_CJ188_UNIT_KWH", 0x05);
define ("MFUN_NBIOT_CJ188_UNIT_MWH", 0x08);
define ("MFUN_NBIOT_CJ188_UNIT_100MWH", 0x0A);
define ("MFUN_NBIOT_CJ188_UNIT_J", 0x01);
define ("MFUN_NBIOT_CJ188_UNIT_KJ", 0x0B);
define ("MFUN_NBIOT_CJ188_UNIT_MJ", 0x0E);
define ("MFUN_NBIOT_CJ188_UNIT_GJ", 0x11);
define ("MFUN_NBIOT_CJ188_UNIT_100GJ", 0x13);
define ("MFUN_NBIOT_CJ188_UNIT_W", 0x14);
define ("MFUN_NBIOT_CJ188_UNIT_KW", 0x17);
define ("MFUN_NBIOT_CJ188_UNIT_MW", 0x1A);
define ("MFUN_NBIOT_CJ188_UNIT_L", 0x29);
define ("MFUN_NBIOT_CJ188_UNIT_M3", 0x2C);
define ("MFUN_NBIOT_CJ188_UNIT_L_H", 0x32);
define ("MFUN_NBIOT_CJ188_UNIT_M3_H", 0x35);

//消息头的全局定义
define("MFUN_NBIOT_CJ188_FRAME_FIX_HEAD", 0x68);
define("MFUN_NBIOT_CJ188_FRAME_FIX_TAIL", 0x16);
define("MFUN_NBIOT_CJ188_FRAME_READ_MAX_LEN", 77);  //最少64+13的固定长度
define("MFUN_NBIOT_CJ188_FRAME_WRITE_MAX_LEN", 45); //最少32+13的固定长度

?>