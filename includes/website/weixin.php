<?php 
//  微信登录插件类，如有BUG请联系本人！！ 
/*===========================================================
**/

if (defined('WEBSITE'))
{
	global $_LANG;
	$_LANG['help']['APP_KEY'] = '在https://open.weixin.qq.com/里申请的 App Key';
	$_LANG['help']['APP_SECRET'] = '请注意填写，最长的就填此处';
	$_LANG['help']['weibo_version'] = '勾选使用 Oauth2.0版本 验证方法 , 否则采用 1.0a 版本验证方案';
	$_LANG['APP_KEY'] = 'App Key';
	$_LANG['APP_SECRET'] = 'App Secret';
	$_LANG['weibo_version'] = '是否使用Oauth2.0版本';
	
	
	$i = isset($web) ? count($web) : 0;
	
	// 类名
	$web[$i]['name'] = '微信';
	
	// 文件名，不包含后缀
	
	$web[$i]['type'] = 'weixin';
	
	// 作者信息
	$web[$i]['author'] = '冯鑫';
	
	$web[$i]['className'] = 'weixin';
	
	// 作者QQ
	$web[$i]['qq'] = '502251245';
	
	// 作者邮箱
	$web[$i]['email'] = '502251245@qq.com';
	
	// 申请网址
	$web[$i]['website'] = 'https://open.weixin.qq.com/ ';
	
	// 版本号
	$web[$i]['version'] = '1.2v';
	
	// 更新日期
	$web[$i]['date']  = '2016-2-25';
	
	// 配置信息
	$web[$i]['config'] = array(
		array('type'=>'text' , 'name'=>'APP_KEY', 'value'=>''),
		array('type'=>'text' , 'name' => 'APP_SECRET' , 'value' => ''),
	);
}


if (!defined('WEBSITE'))
{
	include_once(dirname(__FILE__).'/oath2.class.php');
	class website extends oath2
	{
		function website()
		{
			$this->app_key = APP_KEY;
			$this->app_secret = APP_SECRET;
			$this->scope = 'snsapi_login';
			//by tiandi authorizeURL是用来PHP打开微信登录时用,JS调用则不用authorizeURL。
			$this->authorizeURL = 'https://open.weixin.qq.com/connect/qrconnect';
			$this->tokenURL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
			$this->refreshtokenURL = 'https://api.weixin.qq.com/sns/oauth2/refresh_token';
			$this->userURL = 'https://api.weixin.qq.com/sns/userinfo';
			$this->meth = 'GET';
		}
		function login($callblock)
		{
		    $pare = array();
		    $pare['appid'] = $this->app_key;
		    $pare['redirect_uri'] = $callblock;
		    $pare['response_type'] = 'code';
		    //$pare['state'] = $callblock;
		    $pare['scope'] = $this->scope;
		    $pare['display'] = $this->display;
		    setcookie('___OATH2_CALLBLOCK__' , $callblock , time()+3600 , '/');
		    $p = array_merge($pare , $this->post_login);
		    $p = $this->unset_null($p);
		    return $this->authorizeURL .'?'. http_build_query($p);
		}
		function Code2Token($code)
		{
		    $params  = 'appid='.$this->app_key.'&secret='.$this->app_secret.'&code='.$code.
		    '&grant_type=authorization_code';
		    $tokenurl = $this->tokenURL."?". $params;
		    $token = $this->http($tokenurl, 'GET');
		    $token = json_decode($token , true);
		    return $token;
		}
		
		function GetRefreshToken($token)
		{
		    $params  = 'appid='.$this->app_key.'&grant_type=refresh_token&refresh_token='.$token;
		    $tokenurl = $this->refreshtokenURL."?". $params;
		    $token = $this->http($tokenurl, 'GET');
		    $token = json_decode($token , true);
		    return $token;
		}
		
		function Getinfo($token,$openid)
		{
		    $params = 'access_token='.$token.'&openid='.$openid;
		    $userurl = $this->userURL."?". $params;
		    $userinfo = $this->http($userurl, 'GET');
		    return json_decode($userinfo , true);
		}	
	}
}
?>