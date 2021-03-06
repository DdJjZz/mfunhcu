<?php
/**
 * Created by PhpStorm.
 * User: zehongl
 * Date: 2016/1/2
 * Time: 16:04
 */
//include_once "../../l1comvm/vmlayer.php";

/*
-- --------------------------------------------------------

--
-- 表的结构 `t_l2snr_humiddata`
--

CREATE TABLE IF NOT EXISTS `t_l2snr_humiddata` (
  `sid` int(4) NOT NULL,
  `deviceid` char(50) NOT NULL,
  `humidity` float NOT NULL,
  `dataflag` char(1) DEFAULT 'N',
  `reportdate` date NOT NULL,
  `hourminindex` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_l2snr_humiddata`
--
ALTER TABLE `t_l2snr_humiddata`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_l2snr_humiddata`
--
ALTER TABLE `t_l2snr_humiddata`
  MODIFY `sid` int(4) NOT NULL AUTO_INCREMENT;

*/

class classDbiL2snrHumid
{
    //更新每个传感器自己对应的l2snr data表
    private function dbi_l2snr_humiddata_update($mysqli, $devCode, $timeStamp, $humidValue)
    {
        //存储新记录，如果发现是已经存在的数据，则覆盖，否则新增
        $reportdate = date("Y-m-d", $timeStamp);
        $stamp = getdate($timeStamp);
        $hourminindex = floor(($stamp["hours"] * 60 + $stamp["minutes"])/MFUN_HCU_AQYC_TIME_GRID_SIZE);
        $dataFlag = MFUN_HCU_DATA_FLAG_VALID;

        $query_str = "SELECT * FROM `t_l2snr_humiddata` WHERE (`deviceid` = '$devCode' AND `reportdate` = '$reportdate' AND `hourminindex` = '$hourminindex')";
        $result = $mysqli->query($query_str);
        if (($result != false) && ($row = $result->fetch_array())>0) {  //重复，则覆盖
            $sid = $row['sid'];
            $query_str = "UPDATE `t_l2snr_humiddata` SET `humidity` = '$humidValue' WHERE (`sid` = '$sid')";
            $result = $mysqli->query($query_str);
        }
        else {  //不存在，新增
            $query_str = "INSERT INTO `t_l2snr_humiddata` (deviceid,humidity,dataflag,reportdate,hourminindex) VALUES ('$devCode','$humidValue','$dataFlag','$reportdate','$hourminindex')";
            $result = $mysqli->query($query_str);
        }

        return $result;
    }

    //更新传感器分钟聚合表
    private function dbi_l2snr_humiddata_minreport_update($mysqli, $devCode,$statCode,$timeStamp,$humidValue)
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
            $query_str = "UPDATE `t_l2snr_aqyc_minreport` SET `humidity` = '$humidValue'
                          WHERE (`devcode` = '$devCode' AND `statcode` = '$statCode' AND `reportdate` = '$reportdate' AND `hourminindex` = '$hourminindex')";
            $result=$mysqli->query($query_str);
        }
        else   //不存在，新增
        {
            $query_str = "INSERT INTO `t_l2snr_aqyc_minreport` (devcode,statcode,humidity,reportdate,hourminindex)
                                  VALUES ('$devCode', '$statCode', '$humidValue','$reportdate','$hourminindex')";
            $result=$mysqli->query($query_str);
        }

        return $result;
    }

    //更新传感器当前报告聚合表
    private function dbi_l2snr_humiddata_currentreport_update($mysqli,$devCode,$statCode,$timeStamp,$humidValue)
    {
        $currenttime = date("Y-m-d H:i:s",$timeStamp);

        //存储新记录，如果发现是已经存在的数据，则覆盖，否则新增
        $query_str = "SELECT * FROM `t_l3f3dm_aqyc_currentreport` WHERE (`deviceid` = '$devCode')";
        $result = $mysqli->query($query_str);
        if (($result->num_rows)>0) {
            $query_str = "UPDATE `t_l3f3dm_aqyc_currentreport` SET `statcode` = '$statCode',`humidity` = '$humidValue',`createtime` = '$currenttime' WHERE (`deviceid` = '$devCode')";
            $result = $mysqli->query($query_str);
        }
        else {
            $query_str = "INSERT INTO `t_l3f3dm_aqyc_currentreport` (deviceid,statcode,createtime,humidity) VALUES ('$devCode','$statCode','$currenttime','$humidValue')";
            $result = $mysqli->query($query_str);
        }

        return $result;
    }

    public function dbi_huitp_msg_uni_humid_data_report($devCode, $statCode, $content)
    {
        //$data[0] = HUITP_IEID_uni_com_report，暂时没有使用

        $dbiL2snrCommon = new classDbiL2snrCommon();
        $humidData = hexdec($content[1]['HUITP_IEID_uni_humid_value']['humidValue']) & 0xFFFFFFFF;
        $dataFormat =hexdec($content[1]['HUITP_IEID_uni_humid_value']['dataFormat']) & 0xFF;
        $humidValue = $dbiL2snrCommon->dbi_l2snr_datavalue_convert($dataFormat, $humidData);


        $timeStamp = time();

        //建立连接
        $mysqli=new mysqli(MFUN_CLOUD_DBHOST, MFUN_CLOUD_DBUSER, MFUN_CLOUD_DBPSW, MFUN_CLOUD_DBNAME_L1L2L3, MFUN_CLOUD_DBPORT);
        if (!$mysqli){
            die('Could not connect: ' . mysqli_error($mysqli));
        }
        //保存记录到对应l2snr表
        $result = $this->dbi_l2snr_humiddata_update($mysqli,$devCode,$timeStamp,$humidValue);

        //更新分钟测量报告聚合表
        $result = $this->dbi_l2snr_humiddata_minreport_update($mysqli,$devCode,$statCode,$timeStamp,$humidValue);

        //更新瞬时测量值聚合表
        $result = $this->dbi_l2snr_humiddata_currentreport_update($mysqli,$devCode,$statCode,$timeStamp,$humidValue);

        //生成 HUITP_MSGID_uni_humid_data_confirm 消息的内容
        $respMsgContent = array();
        $baseConfirmIE = array();

        $l2codecHuitpIeDictObj = new classL2codecHuitpIeDict;
        //组装IE HUITP_IEID_uni_com_confirm
        $huitpIe = $l2codecHuitpIeDictObj->mfun_l2codec_getHuitpIeFormat(HUITP_IEID_uni_com_confirm);
        $huitpIeLen = intval($huitpIe['len']);
        $comConfirm = HUITP_IEID_UNI_COM_CONFIRM_YES;
        array_push($baseConfirmIE, HUITP_IEID_uni_com_confirm);
        array_push($baseConfirmIE, $huitpIeLen);
        array_push($baseConfirmIE, $comConfirm);

        array_push($respMsgContent, $baseConfirmIE);

        $mysqli->close();
        return $respMsgContent;
    }

}

?>