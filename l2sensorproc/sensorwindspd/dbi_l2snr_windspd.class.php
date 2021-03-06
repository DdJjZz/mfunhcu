<?php
/**
 * Created by PhpStorm.
 * User: zehongl
 * Date: 2016/1/2
 * Time: 16:07
 */
//include_once "../../l1comvm/vmlayer.php";

/*
-- --------------------------------------------------------

--
-- 表的结构 `t_l2snr_windspd`
--

CREATE TABLE IF NOT EXISTS `t_l2snr_windspd` (
  `sid` int(4) NOT NULL,
  `deviceid` char(50) NOT NULL,
  `windspeed` float DEFAULT NULL,
  `dataflag` char(1) DEFAULT NULL,
  `reportdate` date NOT NULL,
  `hourminindex` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_l2snr_windspd`
--
ALTER TABLE `t_l2snr_windspd`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_l2snr_windspd`
--
ALTER TABLE `t_l2snr_windspd`
  MODIFY `sid` int(4) NOT NULL AUTO_INCREMENT;

*/


class classDbiL2snrWindspd
{

    //更新每个传感器自己对应的l2snr data表
    private function dbi_l2snr_windspd_update($mysqli,$devCode,$timeStamp,$windspdValue)
    {
        //存储新记录，如果发现是已经存在的数据，则覆盖，否则新增
        $reportdate = date("Y-m-d", $timeStamp);
        $stamp = getdate($timeStamp);
        $hourminindex = floor(($stamp["hours"] * 60 + $stamp["minutes"])/MFUN_HCU_AQYC_TIME_GRID_SIZE);
        $dataFlag = MFUN_HCU_DATA_FLAG_VALID;

        $query_str = "SELECT * FROM `t_l2snr_windspd` WHERE (`deviceid` = '$devCode' AND `reportdate` = '$reportdate' AND `hourminindex` = '$hourminindex')";
        $result = $mysqli->query($query_str);
        if (($result != false) && ($row = $result->fetch_array())>0) {  //重复，则覆盖
            $sid = $row['sid'];
            $query_str = "UPDATE `t_l2snr_windspd` SET `windspeed` = '$windspdValue' WHERE (`sid` = '$sid')";
            $result = $mysqli->query($query_str);
        }
        else {  //不存在，新增
            $query_str = "INSERT INTO `t_l2snr_windspd` (deviceid,windspeed,dataflag,reportdate,hourminindex) VALUES ('$devCode','$windspdValue','$dataFlag','$reportdate','$hourminindex')";
            $result = $mysqli->query($query_str);
        }

        return $result;
    }

    //更新传感器分钟聚合表
    private function dbi_l2snr_windspd_minreport_update($mysqli,$devCode,$statCode,$timeStamp,$windspdValue)
    {
        $reportdate = date("Y-m-d", $timeStamp);
        $stamp = getdate($timeStamp);
        $hourminindex = floor(($stamp["hours"] * 60 + $stamp["minutes"])/MFUN_HCU_AQYC_TIME_GRID_SIZE);

        //存储新记录，如果发现是已经存在的数据，则覆盖，否则新增
        $query_str = "SELECT * FROM `t_l2snr_aqyc_minreport` WHERE (`devcode` = '$devCode' AND `statcode` = '$statCode'
                                  AND `reportdate` = '$reportdate' AND `hourminindex` = '$hourminindex')";
        $result = $mysqli->query($query_str);
        if (($result != false) && ($result->num_rows)>0)  //重复，则覆盖
        {
            $query_str = "UPDATE `t_l2snr_aqyc_minreport` SET `windspeed` = '$windspdValue'
                          WHERE (`devcode` = '$devCode' AND `statcode` = '$statCode' AND `reportdate` = '$reportdate' AND `hourminindex` = '$hourminindex')";
            $result=$mysqli->query($query_str);
        }
        else   //不存在，新增
        {
            $query_str = "INSERT INTO `t_l2snr_aqyc_minreport` (devcode,statcode,windspeed,reportdate,hourminindex)
                                  VALUES ('$devCode', '$statCode', '$windspdValue','$reportdate','$hourminindex')";
            $result=$mysqli->query($query_str);
        }

        return $result;
    }

    //更新传感器当前报告聚合表
    private function dbi_l2snr_windspd_currentreport_update($mysqli,$devCode,$statCode,$timeStamp,$windspdValue)
    {
        $currenttime = date("Y-m-d H:i:s",$timeStamp);

        //存储新记录，如果发现是已经存在的数据，则覆盖，否则新增
        $query_str = "SELECT * FROM `t_l3f3dm_aqyc_currentreport` WHERE (`deviceid` = '$devCode')";
        $result = $mysqli->query($query_str);
        if (($result->num_rows)>0) {
            $query_str = "UPDATE `t_l3f3dm_aqyc_currentreport` SET `statcode` = '$statCode', `windspeed` = '$windspdValue',`createtime` = '$currenttime' WHERE (`deviceid` = '$devCode')";
            $result = $mysqli->query($query_str);
        }
        else {
            $query_str = "INSERT INTO `t_l3f3dm_aqyc_currentreport` (deviceid,statcode,createtime,windspeed) VALUES ('$devCode','$statCode','$currenttime','$windspdValue')";
            $result = $mysqli->query($query_str);
        }

        return $result;
    }

    public function dbi_huitp_msg_uni_windspd_data_report($devCode, $statCode, $content)
    {
        //$data[0] = HUITP_IEID_uni_com_report，暂时没有使用

        $dbiL2snrCommon = new classDbiL2snrCommon();
        $windspdData = hexdec($content[1]['HUITP_IEID_uni_windspd_value']['windspdValue']) & 0xFFFFFFFF;
        $dataFormat =hexdec($content[1]['HUITP_IEID_uni_windspd_value']['dataFormat']) & 0xFF;
        $windspdValue = $dbiL2snrCommon->dbi_l2snr_datavalue_convert($dataFormat, $windspdData);


        $timeStamp = time();
        //建立连接
        $mysqli=new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        //保存记录到对应l2snr表
        $result1 = $this->dbi_l2snr_windspd_update($mysqli,$devCode,$timeStamp,$windspdValue);
        //更新分钟测量报告聚合表
        $result2 = $this->dbi_l2snr_windspd_minreport_update($mysqli,$devCode,$statCode,$timeStamp,$windspdValue);
        //更新瞬时测量值聚合表
        $result3 = $this->dbi_l2snr_windspd_currentreport_update($mysqli,$devCode,$statCode,$timeStamp,$windspdValue);
        $result = $result1 AND $result2 AND $result3;

        //生成 HUITP_MSGID_uni_windspd_data_confirm 消息的内容
        $respMsgContent = array();
        $baseConfirmIE = array();

        $l2codecHuitpIeDictObj = new classL2codecHuitpIeDict;
        //组装IE HUITP_IEID_uni_com_confirm
        $huitpIe = $l2codecHuitpIeDictObj->mfun_l2codec_getHuitpIeFormat(HUITP_IEID_uni_com_confirm);
        $huitpIeLen = intval($huitpIe['len']);
        if($result)
            $comConfirm = HUITP_IEID_UNI_COM_CONFIRM_YES;
        else
            $comConfirm = HUITP_IEID_UNI_COM_CONFIRM_NO;
        array_push($baseConfirmIE, HUITP_IEID_uni_com_confirm);
        array_push($baseConfirmIE, $huitpIeLen);
        array_push($baseConfirmIE, $comConfirm);

        array_push($respMsgContent, $baseConfirmIE);

        $mysqli->close();
        return $respMsgContent;
    }

}

?>