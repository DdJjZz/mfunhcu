<?php
/**
 * Created by PhpStorm.
 * User: MAMA
 * Date: 2016/6/20
 * Time: 23:00
 */
//include_once "../../l1comvm/vmlayer.php";

/*

//该数据表单的逻辑是试图将所有的不同参数组成一个大表，通过SENSOR_ID来记录不同SENSOR的仪表操控状态
//由于不同仪表的潜在操控参数不完全一样，这里是讲所有可能的仪表参数组合成为一个大表，而不再为不同仪表进行区分
//如果涉及到区分，则需要通过具体的dbi函数来完成
//这个表格是否与设备中SENSOR列表相互冲突，待完善

-- --------------------------------------------------------
--
-- 表的结构 `t_l3f4icm_sensorctrltable`
--

CREATE TABLE IF NOT EXISTS `t_l3f4icm_sensorctrltable` (
  `sid` int(4) NOT NULL AUTO_INCREMENT,
  `deviceid` char(20) NOT NULL,
  `sensorid` int(2) NOT NULL,
  `equid` int(2) NOT NULL,
  `sensortype` char(10) NOT NULL,
  `workingcycle` int(2) NOT NULL,
  `onoffstatus` tinyint(1) NOT NULL,
  `sampleduaration` int(2) NOT NULL,
  `paralpha` int(2) NOT NULL,
  `parbeta` int(2) NOT NULL,
  `pargama` int(2) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `t_l3f4icm_sensorctrltable`
--

INSERT INTO `t_l3f4icm_sensorctrltable` (`sid`, `deviceid`, `sensorid`, `equid`, `sensortype`, `workingcycle`, `onoffstatus`, `sampleduaration`, `paralpha`, `parbeta`, `pargama`) VALUES
(1, 'HCU301_22', 111, 6, '风速', 0, 0, 0, 0, 0, 0);


--
-- 表的结构 `t_l3f4icm_swfactory`
--

CREATE TABLE IF NOT EXISTS `t_l3f4icm_swfactory` (
  `sid` int(4) NOT NULL AUTO_INCREMENT,
  `swverid` char(50) NOT NULL,
  `swverdescripition` char(50) NOT NULL,
  `issuedate` date NOT NULL,
  `swbin` mediumblob NOT NULL,
  `dbbin` mediumblob NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `t_l3f4icm_swfactory`
--

INSERT INTO `t_l3f4icm_swfactory` (`sid`, `swverid`, `swverdescripition`, `issuedate`, `swbin`, `dbbin`) VALUES
(1, 'AQYC.R02.099', '飞凌335D Baseline, 基础功能完善，气象五参数，视频，支持基于树莓派的传感器', '2016-07-13', '', '');

*/

class classDbiL3apF4icm
{
    //构造函数
    public function __construct()
    {

    }

    public function dbi_sensor_control_table_save($deviceid, $sensorid, $equid, $sensortype)
    {
        //建立连接
        $mysqli=new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli)
        {
            die('Could not connect: ' . mysqli_error($mysqli));
        }

        //存储新记录，如果发现是已经存在的数据，则覆盖，否则新增
        $result = $mysqli->query("SELECT * FROM `t_l3f4icm_sensorctrltable` WHERE (`deviceid` = '$deviceid' AND `sensorid` = '$sensorid'");
        if (($result != false) && ($result->num_rows)>0)   //重复，则覆盖
        {
            $result=$mysqli->query("UPDATE `t_l3f4icm_sensorctrltable` SET  `equid` = '$equid',`sensortype` = '$sensortype' WHERE (`deviceid` = '$deviceid' AND `sensorid` = '$sensorid')");
        }
        else   //不存在，新增
        {
            $result=$mysqli->query("INSERT INTO `t_l3f4icm_sensorctrltable` (deviceid,sensorid,equid,sensortype)
                    VALUES ('$deviceid','$sensorid','$equid','$sensortype')");
        }
        $mysqli->close();
        return $result;
    }

    //删除对应用户所有超过90天的数据
    //缺省做成90天，如果参数错误，导致90天以内的数据强行删除，则不被认可
    public function dbi_sensor_control_table_3mondel($deviceid, $sensorid, $days)
    {
        if ($days <90) $days = 90;  //不允许删除90天以内的数据
        //建立连接
        $mysqli=new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli)
        {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $result = $mysqli->query("DELETE FROM `t_l3f4icm_sensorctrltable` WHERE ((`deviceid` = '$deviceid' AND `sensorid` ='$sensorid') AND (TO_DAYS(NOW()) - TO_DAYS(`date`) > '$days'))");
        $mysqli->close();
        return $result;
    }

    public function dbi_sensor_control_table_inqury($sid)
    {
        $LatestValue = "";
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $result = $mysqli->query("SELECT * FROM `t_l3f4icm_sensorctrltable` WHERE `sid` = '$sid'");
        if (($result != false) && ($result->num_rows)>0)
        {
            $row = $result->fetch_array();
            $LatestValue = $row['sensorid'];
        }
        $mysqli->close();
        return $LatestValue;
    }

    public function dbi_hcu_vediolist_inqury($statcode, $date, $hour)
    {
        //查询监测点下的设备列表
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $mysqli->query("set character_set_results = utf8");

        $query_str = "SELECT * FROM `t_l3f3dm_siteinfo` WHERE `statcode` = '$statcode' ";
        $result = $mysqli->query($query_str);

        $devlist = array();
        while($row = $result->fetch_array())
        {
            $temp = array(
                'statcode' => $row['statcode'],
                'name' =>  $row['name'],
                'devcode' => $row['devcode']
            );
            array_push($devlist, $temp);
        }

        $videolist = array();
        if(!empty($devlist)){
            $i = 0;
            $format = "A11Hcuid/A1Conj/A2Key/A8Date/A2Hour/A2Min/A9Fix";  //HCU_SH_0304_av201607202130.h264.mp4
            while ($i < count($devlist)){
                $deviceid = $devlist[$i]['devcode'];
                $start = $hour * 60;
                $end = $hour * 60 + 59;
                $query_str = "SELECT * FROM `t_l2snr_hsmmpdata` WHERE `deviceid` = '$deviceid' AND `reportdate` = '$date'
                                  AND `hourminindex` >= '$start' AND `hourminindex` < '$end' ";
                $result = $mysqli->query($query_str);
                while($row = $result->fetch_array()){
                    $videourl = $row['videourl'];
                    //$videourl = strrchr($videourl, '/');
                    $data = unpack($format, $videourl);

                    $temp = array(
                        'id'=> $videourl,
                        'attr'=> $devlist[$i]['name']."_视频".$data["Date"]."_".$data["Hour"].":".$data["Min"]
                    );
                    array_push($videolist, $temp);
                }
                $i++;
            }
        }
        $mysqli->close();
        return $videolist;
    }

    public function dbi_hcu_vedioplay_request($videoid)
    {
        //查询该视频文件当前状态，是否已经下载，是否正在下载
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $mysqli->query("set character_set_results = utf8");

        $query_str = "SELECT * FROM `t_l2snr_hsmmpdata` WHERE `videourl` = '$videoid' ";
        $result = $mysqli->query($query_str);
        if (($result->num_rows)>0) {
            $row = $result->fetch_array();
            $dataflag = $row["dataflag"];
            $devCode = $row["deviceid"];
            $apiL2snrCommonServiceObj = new classApiL2snrCommonService();
            if ($dataflag == MFUN_HCU_VIDEO_DATA_STATUS_NORMAL){
                $ctrl_key = $apiL2snrCommonServiceObj->byte2string(MFUN_HCU_CMDID_HSMMP_DATA);
                $opt_key = $apiL2snrCommonServiceObj->byte2string(MFUN_HCU_OPT_VEDIOFILE_REQ);
                $len = $apiL2snrCommonServiceObj->byte2string(strlen( $opt_key)/2 + strlen($videoid));
                $cmdStr = $ctrl_key . $len . $opt_key . $videoid;
                //保存命令到CmdBuf
                $dbiL1VmCommonObj = new classDbiL1vmCommon();
                $dbiL1VmCommonObj->dbi_cmdbuf_save_cmd(trim($devCode), trim($cmdStr));

                //更新视频文件的状态
                $dataflag = MFUN_HCU_VIDEO_DATA_STATUS_DOWNLOAD;
                $query_str = "UPDATE `t_l2snr_hsmmpdata` SET `dataflag` = '$dataflag' WHERE (`deviceid` = '$devCode' AND `videourl` = '$videoid')";
                $result = $mysqli->query($query_str);

                $resp = "downloading";
            }
            elseif ($dataflag == MFUN_HCU_VIDEO_DATA_STATUS_DOWNLOAD){
                //正在下载中又收到该视频文件的请求什么也不做，直接回复
                $resp = "downloading";
            }
            elseif ($dataflag == MFUN_HCU_VIDEO_DATA_STATUS_READY){
                $resp = "http://121.40.185.177/xhzn/avorion/" . $videoid;
            }
            elseif ($dataflag == MFUN_HCU_VIDEO_DATA_STATUS_FAIL){
                $resp = "";
            }
            else
                $resp = "";
        }
        else
            $resp = "";

        $mysqli->close();
        return $resp;
    }

    public function dbi_hcu_allsw_inqury()
    {
        //建立连接
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $result = $mysqli->query("SELECT * FROM `t_l3f4icm_swfactory` WHERE 1");
        $verlist = array();
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_array()) {
                $version = $row["swverid"];
                array_push($verlist, $version);
            }
        }
        $mysqli->close();
        return $verlist;

    }

    //HCU_SWVER对应数据库的访问，获取最新的SWVER
    public function dbi_latest_hcu_swver_inqury()
    {
        //建立连接
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $result = $mysqli->query("SELECT * FROM `t_l3f4icm_swfactory` WHERE 1");

        $LatestVerValue = "";
        $LatestRelease = 0;
        $LatestVersion = 0;
        if (($result != false) && ($result->num_rows)>0)   //重复，则覆盖
        {
            while($row = $result->fetch_array()){
                $temp1 = $row['swverid'];
                //对版本格式有严格的诉求，否则会出错
                $temp = substr(trim($temp1), -7);
                $release = substr($temp, 1, 2);
                $version = substr($temp, 4, 3);
                //空的，或者大版本大，或者大版本相当但小版本大
                if ((empty($LatestVerValue)) || ($release > $LatestRelease) || (($release == $LatestRelease) && ($version > $LatestVersion))){
                    $LatestVerValue = $temp1;
                    $LatestRelease = $release;
                    $LatestVersion = $version;
                }
                else{}
            }
        }
        $result = $LatestVerValue;

        $mysqli->close();
        return $result;
    }

    //HCU_SWVER对应数据库的访问
    public function dbi_hcu_swver_inqury($swverid)
    {
        //建立连接
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        $result = $mysqli->query("SELECT * FROM `t_l3f4icm_swfactory` WHERE `swverid` = '$swverid'");

        $LatestSwValue = "";
        $LatestDbValue = "";
        if (($result != false) && ($result->num_rows)>0)   //重复，则覆盖
        {
            $row = $result->fetch_array();
            $LatestSwValue = $row['swbin'];
            $LatestDbValue = $row['dbbin'];
        }

        $result = array("swbin" => $LatestSwValue, "dbbin" => $LatestDbValue);

        $mysqli->close();
        return $result;
    }

    //仪表控制，更新传感器信息
    public function dbi_sensor_info_update($DevCode, $SensorCode, $status,$ParaList)
    {
        //建立连接
        $mysqli = new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }

        $mysqli->query("set character_set_results = utf8");

        $query_str = "SELECT * FROM `t_l2sdk_iothcu_hcudevice` WHERE `devcode` = '$DevCode'";
        $result = $mysqli->query($query_str);
        if (($result != false) && ($result->num_rows)>0) {
            $row = $result->fetch_array();

        }


    }

}

?>