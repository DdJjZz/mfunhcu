<?php
header("Content-type:text/html;charset=utf-8");
include_once "../l1comvm/vmlayer.php";
function _getfilecounts($ff){
    if(!file_exists($ff)) return 0;
    $handle = opendir($ff);
    $i=0;
    while(false !== $file=(readdir($handle))){
        if($file !== "." && $file!=".."){
            $i++;
        }
    }
    return $i;
}
function _encode($arr)
{
  $na = array();
  foreach ( $arr as $k => $value ) {
    $na[_urlencode($k)] = _urlencode ($value);
  }
  return addcslashes(urldecode(json_encode($na)),"\r\n");
}

function _urlencode($elem)
{
  if(is_array($elem)&&(!(empty($elem)))){
    foreach($elem as $k=>$v){
      $na[_urlencode($k)] = _urlencode($v);
    }
    return $na;
  }
  if(is_array($elem)&&empty($elem)){
	  return $elem;
  }
  return urlencode($elem);
}
$request_body = file_get_contents('php://input');
//echo $request_body;
$payload = json_decode($request_body,true);
//echo $payload;
$key=$payload["action"];
//echo $key;
switch ($key){
    case "HCU_AQYC_Activate": //Open a lock
        $body=$payload["body"];
        $devCode=$body["code"];
        $latitude=(string)($body["latitude"]*1000000);
        $longitude=(string)($body["longitude"]*1000000);
        $dbiL3apF2cmObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
        $result = $dbiL3apF2cmObj->dbi_aqyc_qrcode_scan_siteinfo_update_gps($devCode, $latitude, $longitude);

        $loggerObj = new classApiL1vmFuncCom();
        $project = MFUN_PRJ_HCU_AQYCWX;
        $log_content = $devCode."R:Latitude=".$latitude.";Longitude=".$longitude."Result=".$result;
        $loggerObj->mylog($project,$devCode,"MFUN_TASK_ID_L4OAMTOOLS","MFUN_TASK_VID_L4AQYC_ACTIVE",$key,$log_content);

        if($result==true)
            $retval=array('status'=>'true','auth'=>'true','msg'=>'设备激活成功');
        else
            $retval=array('status'=>'false','auth'=>'true','msg'=>'设备激活失败');

        $jsonencode = _encode($retval);
        echo $jsonencode;
        break;

	default:
	    break;
}


?>