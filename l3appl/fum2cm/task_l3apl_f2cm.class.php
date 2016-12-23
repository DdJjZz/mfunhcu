<?php
/**
 * Created by PhpStorm.
 * User: MAMA
 * Date: 2016/6/27
 * Time: 22:32
 */
//include_once "../../l1comvm/vmlayer.php";
header("Content-type:text/html;charset=utf-8");
include_once "dbi_l3apl_f2cm.class.php";

class classTaskL3aplF2cm
{
    //构造函数
    public function __construct()
    {

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
        $na = 0;
        if(is_array($elem)&&(!empty($elem))){
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

    function func_project_pglist_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $proj_pg_list = $uiF2cmDbObj->dbi_all_projpglist_req();
            if(!empty($proj_pg_list))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$proj_pg_list,'msg'=>"获取项目项目组列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取项目项目组列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_project_list_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $projlist = $uiF2cmDbObj->dbi_all_projlist_req();
            if(!empty($projlist))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$projlist,'msg'=>"获取项目列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取项目列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_user_project_list_process($type, $user, $body)
    {
        if (isset($body["userid"])) $userid = $body["userid"]; else  $userid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $userproj = $uiF2cmDbObj->dbi_user_projpglist_req($userid);
            if(!empty($userproj))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$userproj,'msg'=>"获取用户所属项目列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取用户所属项目列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_pg_table_process($type, $user, $body)
    {
        if (isset($body["length"])) $length = $body["length"]; else  $length = "";
        if (isset($body["startseq"])) $startseq = $body["startseq"]; else  $startseq = "";

        $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
        $total = $uiF2cmDbObj->dbi_all_pgnum_inqury();
        $query_length = (int)($length);
        $start = (int)($startseq);
        if($query_length> $total-$start)
            {$query_length = $total-$start;}

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $pgtable = $uiF2cmDbObj->dbi_all_pgtable_req($start, $query_length);
            if(!empty($pgtable)){
                $ret = array('start'=> (string)$start,'total'=> (string)$total,'length'=>(string)$query_length,'pgtable'=>$pgtable);
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$ret,'msg'=>"项目组表获取成功");
            }
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"项目组获取失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_pg_new_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_pginfo_update($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"项目组新增成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"项目组新增失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_pg_mod_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_pginfo_update($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"项目组信息修改成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"项目组信息修改失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_pg_del_process($type, $user, $body)
    {
        if (isset($body["PGCode"])) $pgid = $body["PGCode"]; else  $pgid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_pginfo_delete($pgid);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"删除一个项目组成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"删除一个项目组失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_pg_project_process($type, $user, $body)
    {
        if (isset($body["PGCode"])) $pgid = $body["PGCode"]; else  $pgid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $projlist = $uiF2cmDbObj->dbi_pg_projlist_req($pgid);
            if(!empty($projlist))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$projlist,'msg'=>"获取项目组下项目列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取项目组下项目列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_project_table_process($type, $user, $body)
    {
        if (isset($body["length"])) $length = $body["length"]; else  $length = "";
        if (isset($body["startseq"])) $startseq = $body["startseq"]; else  $startseq = "";

        $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
        $total = $uiF2cmDbObj->dbi_all_projnum_inqury();
        $query_length = (int)($length);
        $start = (int)($startseq);
        if($query_length> $total-$start) {$query_length = $total-$start;}

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $projtable = $uiF2cmDbObj->dbi_all_projtable_req($start, $query_length);
            if(!empty($projtable)){
                $ret = array('start'=> (string)$start,'total'=> (string)$total,'length'=>(string)$query_length,'projtable'=>$projtable);
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$ret,'msg'=>"项目列表获取成功");
            }
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"项目列表获取失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_project_new_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_projinfo_update($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"新项目创建成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"新项目创建失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_project_mod_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_projinfo_update($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"项目信息修改成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"项目信息修改失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_project_del_process($type, $user, $body)
    {
        if (isset($body["ProjCode"])) $ProjCode = $body["ProjCode"]; else  $ProjCode = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_projinfo_delete($ProjCode);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"删除一个项目成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"删除一个项目失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    /*********************************智能云锁新增处理 Start*********************************************/
    function func_project_userkey_process($type, $user, $body)
    {
        if (isset($body["userid"])) $uid = $body["userid"]; else  $uid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $user_keylist = $uiF2cmDbObj->dbi_project_userkey_process($uid);
            if(!empty($user_keylist))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$user_keylist,'msg'=>"获取用户钥匙列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取用户钥匙列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_all_projkey_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $all_projkey = $uiF2cmDbObj->dbi_all_projkey_process();
            if(!empty($all_projkey))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$all_projkey,'msg'=>"查询所有项目钥匙列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"查询所有项目钥匙列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_project_keylist_process($type, $user, $body)
    {
        if (isset($body["ProjCode"])) $projCode = $body["ProjCode"]; else  $projCode = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $proj_keylist = $uiF2cmDbObj->dbi_project_keylist_process($projCode);
            if(!empty($proj_keylist))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$proj_keylist,'msg'=>"获取项目钥匙列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取项目钥匙列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_all_projkeyuser_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $all_keyuser = $uiF2cmDbObj->dbi_all_projkeyuser_process();
            if(!empty($all_keyuser))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$all_keyuser,'msg'=>"获取项目钥匙用户列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取项目钥匙用户列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_table_process($type, $user, $body)
    {
        if (isset($body["length"])) $length = $body["length"]; else  $length = "";
        if (isset($body["startseq"])) $startseq = $body["startseq"]; else  $startseq = "";

        $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
        $total = $uiF2cmDbObj->dbi_all_keynum_inqury();
        $query_length = (int)($length);
        $start = (int)($startseq);
        if($query_length> $total-$start) {$query_length = $total-$start;}

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $key_table = $uiF2cmDbObj->dbi_all_keytable_req($start, $query_length);
            if(!empty($key_table)){
                $ret = array('start'=> (string)$start,'total'=> (string)$total,'length'=>(string)$query_length,'keytable'=>$key_table);
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$ret,'msg'=>"钥匙列表获取成功");
            }
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"钥匙列表获取失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_new_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_key_new_process($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"新建钥匙成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"新建钥匙失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_mod_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_key_mod_process($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"修改钥匙成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"修改钥匙失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_del_process($type, $user, $body)
    {
        if (isset($body["KeyCode"])) $keyid = $body["KeyCode"]; else  $keyid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_key_del_process($keyid);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"删除钥匙成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"删除钥匙失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_obj_authlist_process($type, $user, $body)
    {
        if (isset($body["DomainCode"])) $authobjcode = $body["DomainCode"]; else  $authobjcode = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $authlist = $uiF2cmDbObj->dbi_obj_authlist_process($authobjcode);
            if(!empty($authlist))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$authlist,'msg'=>"查询授权对象下所有的授权信息列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"查询授权对象下所有的授权信息列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_authlist_process($type, $user, $body)
    {
        if (isset($body["KeyCode"])) $keyid = $body["KeyCode"]; else  $keyid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $authlist = $uiF2cmDbObj->dbi_key_authlist_process($keyid);
            if(!empty($authlist))
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>$authlist,'msg'=>"获取指定钥匙下授权信息列表成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>"获取指定钥匙下授权信息列表失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'ret'=>"",'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_grant_process($type, $user, $body)
    {
        if (isset($body["KeyCode"])) $keyid = $body["KeyCode"]; else  $keyid = "";
        if (isset($body["UserId"])) $userid = $body["UserId"]; else  $userid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_key_grant_process($keyid, $userid);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"钥匙使用人授予成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"钥匙使用人授予失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_authnew_process($type, $user, $body)
    {
        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_key_authnew_process($body);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"钥匙新建授权成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"钥匙新建授权失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }

    function func_key_authdel_process($type, $user, $body)
    {
        if (isset($body["AuthId"])) $authid = $body["AuthId"]; else  $authid = "";

        $uiF1symDbObj = new classDbiL3apF1sym(); //初始化一个UI DB对象
        $usercheck = $uiF1symDbObj->dbi_user_authcheck($type, $user);
        if($usercheck['status']=="true" AND $usercheck['auth']=="true") { //用户session没有超时且有权限做此操作
            $uiF2cmDbObj = new classDbiL3apF2cm(); //初始化一个UI DB对象
            $result = $uiF2cmDbObj->dbi_key_authdel_process($authid);
            if($result == true)
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"钥匙授权删除成功");
            else
                $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>"钥匙授权删除失败");
        }
        else
            $retval=array('status'=>$usercheck['status'],'auth'=>$usercheck['auth'],'msg'=>$usercheck['msg']);

        return $retval;
    }


    /**************************************************************************************
     *                             任务入口函数                                           *
     *************************************************************************************/
    public function mfun_l3apl_f2cm_task_main_entry($parObj, $msgId, $msgName, $msg)
    {
        //定义本入口函数的logger处理对象及函数
        $loggerObj = new classApiL1vmFuncCom();
        $log_time = date("Y-m-d H:i:s", time());
        $project ="";

        //入口消息内容判断
        if (empty($msg) == true) {
            $result = "Received null message body";
            $log_content = "R:" . json_encode($result);
            $loggerObj->logger("MFUN_TASK_ID_L3APPL_FUM2CM", "mfun_l3apl_f2cm_task_main_entry", $log_time, $log_content);
            echo trim($result);
            return false;
        }
        else{
            //解开消息
            if (isset($msg["type"])) $type = $msg["type"]; else  $type = "";
            if (isset($msg["user"])) $user = $msg["user"]; else  $user = "";
            if (isset($msg["body"])) $body = $msg["body"]; else  $body = "";
        }

        //多条消息发送到L3APPL_F2CM，这里潜在的消息太多，没法一个一个的判断，故而只检查上下界
        if (($msgId <= MSG_ID_MFUN_MIN) || ($msgId >= MSG_ID_MFUN_MAX)){
            $result = "Msgid or MsgName error";
            $log_content = "P:" . json_encode($result);
            $loggerObj->logger("MFUN_TASK_ID_L3APPL_FUM2CM", "mfun_l3apl_f2cm_task_main_entry", $log_time, $log_content);
            echo trim($result);
            return false;
        }

        switch($msgId)
        {
            case MSG_ID_L4AQYCUI_TO_L3F2_PROJECTPGLIST://功能Project Pg List
                $resp = $this->func_project_pglist_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PROJECTLIST://功能Project List
                $resp = $this->func_project_list_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_USERPROJ://功能User Project
                $resp = $this->func_user_project_list_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PGTABLE://功能PG Table
                $resp = $this->func_pg_table_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PGNEW://功能PG New
                $resp = $this->func_pg_new_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PGMOD://功能PG Mod
                $resp = $this->func_pg_mod_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PGDEL://功能PG Del
                $resp = $this->func_pg_del_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PGPROJ://功能PG Project
                $resp = $this->func_pg_project_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PROJTABLE://功能Project Table
                $resp = $this->func_project_table_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PROJNEW://功能ProjNew
                $resp = $this->func_project_new_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PROJMOD://功能ProjMod
                $resp = $this->func_project_mod_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            case MSG_ID_L4AQYCUI_TO_L3F2_PROJDEL://功能ProjDel
                $resp = $this->func_project_del_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_AQYCUI;
                break;

            /*********************************智能云锁新增处理 Start*********************************************/
            case MSG_ID_L4FHYSUI_TO_L3F2_USERKEY:
                $resp = $this->func_project_userkey_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_PROJKEYLIST:
                $resp = $this->func_all_projkey_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_PROJKEY:
                $resp = $this->func_project_keylist_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_PROJKEYUSERLIST:
                $resp = $this->func_all_projkeyuser_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYTABLE:
                $resp = $this->func_key_table_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYNEW:
                $resp = $this->func_key_new_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYMOD:
                $resp = $this->func_key_mod_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYDEL:
                $resp = $this->func_key_del_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_OBJAUTHLIST:
                $resp = $this->func_obj_authlist_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYAUTHLIST:
                $resp = $this->func_key_authlist_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYGRANT:
                $resp = $this->func_key_grant_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYAUTHNEW:
                $resp = $this->func_key_authnew_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            case MSG_ID_L4FHYSUI_TO_L3F2_KEYAUTHDEL:
                $resp = $this->func_key_authdel_process($type, $user, $body);
                $project = MFUN_PRJ_HCU_FHYSUI;
                break;

            default :
                $resp = ""; //啥都不ECHO
                break;
        }

        //返回ECHO
        if (!empty($resp))
        {
            $jsonencode = json_encode($resp, JSON_UNESCAPED_UNICODE);
            $log_content = "T:" . $jsonencode;
            $loggerObj->logger($project, "MFUN_TASK_ID_L3APPL_FUM2CM", $log_time, $log_content);
            echo trim($jsonencode);
        }

        //返回
        return true;
    }

}//End of class_task_service

?>