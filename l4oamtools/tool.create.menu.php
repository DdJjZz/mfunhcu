<?php
/**
 * Created by PhpStorm.
 * User: jianlinz
 * Date: 2015/7/7
 * Time: 14:15
 */

/**Start of tool_main
 * 本工具用于管理员创建用户侧菜单
 *
 **/
include_once "../l1comvm/vmlayer.php";
include_once "../l2sdk/task_l2sdk_wechat.class.php";

header("Content-type:text/html;charset=utf-8");

$wx_options = array(
    'token'=>MFUN_WX_TOKEN, //填写你设定的key
    'encodingaeskey'=>MFUN_WX_ENCODINGAESKEY, //填写加密用的EncodingAESKey，如接口为明文模式可忽略
    'appid'=>MFUN_WX_APPID,
    'appsecret'=>MFUN_WX_APPSECRET, //填写高级调用功能的密钥
    'debug'=> MFUN_WX_DEBUG,
    'logcallback' => MFUN_WX_LOGCALLBACK
);
$wxObj = new classTaskL2sdkWechat($wx_options);


//Step1:刷新Token
echo "<br><H2>微信硬件工作环境即将开始......<br></H2>";
echo "WX_APPID = " . MFUN_WX_APPID . "<br>";
echo "WX_APPSECRET = " . MFUN_WX_APPSECRET .  "<br>";


$wxDevObj = new classTaskL2sdkIotWx(MFUN_WX_APPID, MFUN_WX_APPSECRET);


//实验Token是否已经被刷新
echo "<br>测试最新刷新的Token=<br>".$wxDevObj->access_token ."<br>";

$self_create_menu = array();
//Step2:测试创建微信界面上自定义的菜单
if (MFUN_WX_APPID == "wx1183be5c8f6a24b4") //如果是测试号
{
    $self_create_menu =
    '{"button":[
                {"name":"调测",
                    "sub_button":[
                                  {"type":"click","name":"强制绑定","key":"CLICK_TEST_BIND"},
                                  {"type":"click","name":"绑定查询","key":"CLICK_TEST_BIND_INQ"},
                                  {"type":"click","name":"解绑自己","key":"CLICK_TEST_UNBIND"},
                                  {"type":"click","name":"用户信息","key":"CLICK_TEST_USER"}]
                },
                {"name":"设置",
                    "sub_button":[
                                  {"type":"click","name":"周期读取(开)","key":"CLICK_EMC_PERIOD_READ_OPEN"},
                                  {"type":"click","name":"周期读取(关)","key":"CLICK_EMC_PERIOD_READ_CLOSE"},
                                  {"type":"click","name":"Trace开","key":"CLICK_TEST_TRACE_ON"},
                                  {"type":"click","name":"Trace关","key":"CLICK_TEST_TRACE_OFF"}]
                },
                {"name":"生产",
                     "sub_button":[{"type":"scancode_push","name":"扫码绑定","key":"TEST_QR_SCAN"},
                                   {"type":"click","name":"电量查询","key":"CLICK_POWER_STATUS"},
                                   {"type":"click","name":"瞬时读取","key":"CLICK_EMC_INSTANT_READ"}]
                }
         ]
    }';
}
elseif (MFUN_WX_APPID == "wxf2150c4d2941b2ab") //如果是正式小慧智能服务号
{
    $self_create_menu =
    '{"button":[
                {"type":"view","name":"辐射查看","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2150c4d2941b2ab&redirect_uri=http://www.hkrob.com/mfunhcu/l4emcwxui/index.html?response_type=code&scope=snsapi_base&state=1#wechat_redirect"},

                {"name":"云控锁",
                    "sub_button":[{"type":"click","name":"用户解绑","key":"CLICK_FHYS_WECHATKEY_UNBIND"},
                                  {"type":"view","name":"系统登录","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2150c4d2941b2ab&redirect_uri=http://www.hkrob.com/mfunhcu/l4fhyswechat/index.html?response_type=code&scope=snsapi_base&state=1#wechat_redirect"}]
                }

                {"name":"我",
                    "sub_button":[{"type":"scancode_push","name":"扫码绑定","key":"XHZN_QR_SCAN"},
                                  {"type":"click","name":"解绑自己","key":"CLICK_XHZN_UNBIND"},
                                  {"type":"click","name":"绑定查询","key":"CLICK_XHZN_BIND_INQ"},
                                  {"type":"view","name":"小慧科技","url":"http://www.hkrob.com/home/index.html"}]
                }
         ]
    }';
}
elseif (MFUN_WX_APPID == "wxd054d0d6bae92d04") //如果是FOHA服务号
{
    $self_create_menu =
        '{"button":[
                {"name":"云控平台",
                    "sub_button":[{"type":"click","name":"用户解绑","key":"CLICK_FHYS_WECHATKEY_UNBIND"},
                                {"type":"view","name":"系统登录","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd054d0d6bae92d04&redirect_uri=http://www.foome.com.cn/mfunhcu/l4fhyswechat/index.html?response_type=code&scope=snsapi_base&state=1#wechat_redirect"}]
                },

                {"name":"关于",
                    "sub_button":[{"type":"click","name":"帮助","key":"CLICK_FHYS_HELP"}]
                }
         ]
    }';
}

//{"type":"click","name":"用户信息","key":"CLICK_USER"},
//{"type":"click","name":"版本信息","key":"CLICK_VERSION"},
//{"type":"view","name":"辐射查看","url":"http://121.40.118.33/mfunhcu/l4emcwxui/index.html"},

//{"type":"view","name":"辐射查看","url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2150c4d2941b2ab&redirect_uri=www.hkrob.com/hyj/sport_react/index.html?response_type=code&scope=snsapi_base&state=1#wechat_redirect"},

echo "<br>自定义菜单创建（先删再建-微信界面需要24小时更新，重新关注可立即刷新） <br><br>";

echo "菜单删除结果：<br>";
var_dump($wxDevObj->delete_menu());
echo "<br>新菜单创建结果：<br>";
var_dump($wxDevObj->create_menu($self_create_menu));


?>