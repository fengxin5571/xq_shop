<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js,transport.js')); ?>

<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php if ($this->_var['action'] == 'login'): ?>
<div class="main login_main">
<?php else: ?>
<div class="main1">
<?php endif; ?>
    
    <?php if ($this->_var['action'] != 'login'): ?>
    <div class="mg-cate w1160px clearfix">
    <?php echo $this->fetch('library/category_tree.lbi'); ?>
    </div>
    <?php endif; ?>
    


<?php if ($this->_var['action'] == 'login'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'jquery.kinMaxShow-1.1.src.js')); ?>
    <script type="text/javascript">
      $(function(){
        $("#kinMaxShow").kinMaxShow();
      });
    </script>
    <div class="w1160px login_w">
      <div class="robert fl">
         <div id="kinMaxShow">
              <?php 
$k = array (
  'name' => 'ads',
  'id' => '4',
  'num' => '4',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
      </div>
      <div class="login fr mt30">
      <div class="m31">
      <span class="s1">馨清会员</span>
      <span class="s2">
      <a href="user.php?act=register"><img src="themes/default/images/robot/tp2.jpg">立即注册</a>
      </span>
      </div>
      <div class="msg-wrap">
      <div class="msg-warn" id='msg-warn'><b></b> 公共场所不建议自动登录，以防账号丢失</div>
      <div class="msg-error" id='msg-error' style="display:none;"></div>
      <div class="msg-error hide" style="display: none;"><b></b></div>
      </div>
        <form name="formLogin" action="javascript:ajuserLogin()" method="post" >
        <div class='item item-fore1'>
        <label for="loginname" class="login-label name-label"></label>
        <input type="text" name="username" class="login-input" placeholder="用户名<?php if ($this->_var['_CFG'] [ 'ihuyi_sms_mobile_log' ] == 1): ?>/已验证手机<?php endif; ?>"></p>
        </div>
        <div class='item item-fore2'>
        <label class="login-label pwd-label" for="nloginpwd"></label>
        <input type="password" name="password" class="login-input"  placeholder="密码"></p>
        </div>
        <div class="item item-vcode item-fore4  hide item-error" id="captchadiv">
        <?php if ($this->_var['enabled_captcha']): ?>
        <input type="text" size="8" name="captcha" class="itxt itxt02" />
        <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" />
        <span>看不清点击图片换一张</span>
        <?php endif; ?>
        </div>
        <input type="hidden" name="act" value="act_login" />
        <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
        <div class='item item-fore3'>
        <input type="checkbox" value="1" name="remember" id="remember"> <?php echo $this->_var['lang']['auto_login']; ?>
        <span class="forget-pw-safe"><a href="user.php?act=get_password" title=""><?php echo $this->_var['lang']['get_password']; ?></a></span>
        </div>
        <!--<p class="talignC"><a href="user.php?act=qpassword_name" title=""><?php echo $this->_var['lang']['get_password_by_question']; ?></a></p>-->
        <div class="item item-fore4" style="width: 306px;">
        <div class="login-btn1">
        <input type="submit" name="submit" class="jdbtn" value="登&nbsp;&nbsp;&nbsp;&nbsp;录" id="jdbtn">
        </div>
        </div>
        </form>
        <span>使用合作网站账号登录馨清</span>
        <div class="coagent">
        <ul>
        <li><a href="javascript:void(0)" onclick="window.location='user.php?act=oath&type=weixin'"><img src="themes/default/images/robot/wxlogo.gif" width='35' height="35" style="vertical-align: middle;" title="微信登录"/></a><span class="lline">|</span></li>
        <li><a href="javascript:void(0)" onclick="window.location='user.php?act=oath&type=alipay'"><img src="themes/default/images/robot/zfb.gif" width='35' height="35" style="vertical-align: middle;" title="支付宝登录"/></a></li>
        </ul>
        </div>
      </div>
      <div class="clr"></div>
      
    </div>
<?php endif; ?>


<?php if ($this->_var['action'] == 'wechat_ready'): ?>
<div class="w1160px clearfix">
<div class="wxbmain clearfix">
<div class="register-tabNav clearfix">
<div class="r-tab r-tab-cur" id='bindtab'><span class="icon i-bind"></span><span><?php echo $this->_var['lang']['existing_account']; ?></span></div>
<div class="r-tab" id='registertab'><span class="icon i-reg"></span><span><?php echo $this->_var['lang']['no_account']; ?></span></div>
</div>
<div class="reg-tab-con">

<div class="r-tabCon bind-login-content" style="display: block;">
<div class="account-login-panle">
<div class="wellcome-tip"><img src="<?php echo $this->_var['headimg']; ?>" width='28' height='28'/>Hi,<?php echo $this->_var['wx_name']; ?>&nbsp;欢迎来到馨清</div>
<form action="user.php" method="post" name="formLogin" onsubmit="return userLogin()">
<div class="form-item form-item-account">
<label><?php echo $this->_var['lang']['label_username']; ?></label>
<txt id='usernametxtbind' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的账户名和登录名</txt>
<input type="text" class="register-input" name="username"  id="usernamebind" onblur="hidden_txt(this.value,this.name)" onfocus="show_bindtxt(this.name)">
</div>
<div class="input-tip"><span id="username_notice1" class=" color06"></span></div>
<div class="form-item">
<label>输&nbsp;入&nbsp;密&nbsp;码</label>
<txt id='passwordtxtbind' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">密码</txt>
<input name="password" type="password" id="passwordbind" onblur="hidden_txt(this.value,this.name)"  class="register-input" onfocus="show_bindtxt(this.name)">
</div>
<div class="input-tip"><span id="password_notice1" class=" color06"> <i class="i-def"></i></span></div>
<div class='item item-fore3'>
        <span class="forget-pw-safe" style="float: right;padding: 10px;"><a href="user.php?act=get_password" title=""><?php echo $this->_var['lang']['get_password']; ?></a></span>
</div>
<input type="hidden" name="act" value="weixinbind"/>
<input type="hidden" name="wechatid" value="<?php echo $this->_var['wechatid']; ?>" />
<input type="hidden" name="openid" value="<?php echo $this->_var['openid']; ?>" />
<input type="hidden" name="headimg" value="<?php echo $this->_var['headimg']; ?>" />
<input type="hidden" name="wx_name" value="<?php echo $this->_var['wx_name']; ?>" />
<input type="submit" class="reg-btn" id="form-register" value="立即绑定">
</form>
</div>
</div>


<div class="r-tabCon reg-form" style="display: none;">
<div class="wellcome-tip"><img src="<?php echo $this->_var['headimg']; ?>" width='28' height='28'/>Hi,<?php echo $this->_var['wx_name']; ?>&nbsp;欢迎来到馨清</div>
<form action="user.php" method="post" name="formUser" onsubmit="return register();">
            <ul class="register-list mt20">
            <div class="form-item form-item-account">
            <label><?php echo $this->_var['lang']['label_username']; ?></label>
            <txt id='usernametxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的账户名和登录名</txt>
            <input type="text" class="register-input" name="username"  id="username" onblur="is_registered(this.value);" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="username_notice" class=" color06"></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_email']; ?></label>
            <txt id='emailtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的常用邮箱</txt>
            <input name="email" type="text" id="email" onblur="checkEmail(this.value);" class="register-input" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="email_notice" class=" color06"> <i class="i-def"></i></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_password']; ?></label>
            <txt id='passwordtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">建议至少使用两种字符组合</txt>
            <input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensityup(this.value)"  class="register-input" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="password_notice" class=" color06"> <i class="i-def"></i></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_confirm_password']; ?></label>
            <txt id='confirm_passwordtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请再次输入密码</txt>
            <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);"  class="register-input"  onfocus="show_txt(this.name)"/>
            </div>
            <div class="input-tip"><span id="conform_password_notice" class=" color06"> <i class="i-def"></i></span></div>
             
              <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
              <?php if ($this->_var['field']['id'] == 6): ?>
              <div class="form-item"><label><?php echo $this->_var['lang']['passwd_question']; ?></label>
                <select name='sel_question' class="register-input">
                <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
                <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'])); ?>
                </select>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
              <div class="form-item"><label><?php echo $this->_var['lang']['passwd_answer']; ?></label>
                <input name="passwd_answer" type="text" class="register-input" >
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06" id="passwd_quesetion"> *</span><?php endif; ?>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
              <?php elseif ($this->_var['field']['reg_field_name'] == '手机'): ?>
		      <?php if ($this->_var['_CFG'] [ 'ihuyi_sms_mobile_reg' ] == '1'): ?>
        
              <input type="hidden" id="ztime" value="<?php echo $this->_var['ztime']; ?>">
              <input type="hidden" id="smsyy" value="<?php echo $this->_var['smsyy']; ?>">
             
              <input type="hidden" id="sms_code" name="sms_code" value="<?php echo $this->_var['sms_code']; ?>">
			  <?php echo $this->smarty_insert_scripts(array('files'=>'global.js')); ?>
			  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
			  <?php echo $this->smarty_insert_scripts(array('files'=>'sms.js')); ?>
			  <div class="form-item"><label>手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机</label>
			  <txt id='moblie_phonetxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">建议使用常用手机</txt>
			  <input type="text" class="register-input" onblur="check_mobile_phone(this.value);" name="extend_field<?php echo $this->_var['field']['id']; ?>" onfocus="show_txt(this.name)">
             
              </div>
              <div class="input-tip"><span id="mobile_phone_notice" class=" color06"> <i class="i-def"></i></span></div>
              <div class="form-item"><label>手机验证码</label> 
              <txt id='moblie_phonecodetxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请输入手机验证码</txt>
              <input name="sms_verifycode" id="sms_verifycode" type="text" size="25" class="register-input" style="width:150px" maxlength="6" onfocus="show_txt(this.name)" onblur="check_sms_verifycode(this.value)"/>
              <input type="button" id="zphone" class="btn-phonecode"    value="<?php if ($this->_var['smsyy'] == 0): ?>获取语音验证码<?php else: ?>获取验证码<?php endif; ?>"  onclick="getverifycode1('extend_field<?php echo $this->_var['field']['id']; ?>', '<?php echo $this->_var['field']['reg_field_name']; ?>');">
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
			  <?php else: ?>
			  <div class="form-item"><label><?php echo $this->_var['field']['reg_field_name']; ?></label><input type="text" class="register-input" name="extend_field<?php echo $this->_var['field']['id']; ?>">
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06"> *</span><?php endif; ?>
              </div>
            <?php endif; ?>
              <?php else: ?>
              <div class="form-item"><label><?php echo $this->_var['field']['reg_field_name']; ?></label>
              <input type="text" class="register-input" name="extend_field<?php echo $this->_var['field']['id']; ?>">
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06"> *</span><?php endif; ?>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
             
              <?php if ($this->_var['enabled_captcha']): ?>
              <div class="form-item"><label>验&nbsp;&nbsp;&nbsp;证&nbsp;&nbsp;&nbsp;码</label>
              <txt id='captchatxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请输入验证码</txt>
              <input type="text" name="captcha" class="register-input" style="width: 150px;" onfocus='show_captcha_message()' onblur="hidden_captcha_message(this.value)"><img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /></div>
              <div class="input-tip"><span id="captcha_notice" class=" color06"> <i class="i-def"></i></span></div>
              <?php endif; ?>
              <div><strong></strong><input name="agreement" type="checkbox" value="1" checked="checked" />
            <?php echo $this->_var['lang']['agreement']; ?></div>
            <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
            <div>
                  <input name="act" type="hidden" value="act_register" >
                  <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                  <input type="hidden" name="wechatid" value="<?php echo $this->_var['wechatid']; ?>" />
                  <input type="hidden" name="openid" value="<?php echo $this->_var['openid']; ?>" />
                  <input type="hidden" name="headimg" value="<?php echo $this->_var['headimg']; ?>" />
                  <input type="hidden" name="wx_name" value="<?php echo $this->_var['wx_name']; ?>" />
                  <input name="Submit" type="submit" value="立即注册" class="reg-btn">
            </div>
              
            </ul>
          </form>
</div>

</div>
</div>
</div>
<?php endif; ?>



<?php if ($this->_var['action'] == 'zfb_ready'): ?>
<div class="w1160px clearfix">
<div class="wxbmain clearfix">
<div class="register-tabNav clearfix">
<div class="r-tab r-tab-cur" id='bindtab'><span class="icon i-bind"></span><span><?php echo $this->_var['lang']['existing_account']; ?></span></div>
<div class="r-tab" id='registertab'><span class="icon i-reg"></span><span><?php echo $this->_var['lang']['no_account']; ?></span></div>
</div>
<div class="reg-tab-con">

<div class="r-tabCon bind-login-content" style="display: block;">
<div class="account-login-panle">
<div class="wellcome-tip"><img src="<?php echo $this->_var['headimg']; ?>" width='28' height='28'/>Hi,<?php echo $this->_var['nickname']; ?>&nbsp;欢迎来到馨清</div>
<form action="user.php" method="post" name="formLogin" onsubmit="return userLogin()">
<div class="form-item form-item-account">
<label><?php echo $this->_var['lang']['label_username']; ?></label>
<txt id='usernametxtbind' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的账户名和登录名</txt>
<input type="text" class="register-input" name="username"  id="usernamebind" onblur="hidden_txt(this.value,this.name)" onfocus="show_bindtxt(this.name)">
</div>
<div class="input-tip"><span id="username_notice1" class=" color06"></span></div>
<div class="form-item">
<label>输&nbsp;入&nbsp;密&nbsp;码</label>
<txt id='passwordtxtbind' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">密码</txt>
<input name="password" type="password" id="passwordbind" onblur="hidden_txt(this.value,this.name)"  class="register-input" onfocus="show_bindtxt(this.name)">
</div>
<div class="input-tip"><span id="password_notice1" class=" color06"> <i class="i-def"></i></span></div>
<div class='item item-fore3'>
        <span class="forget-pw-safe" style="float: right;padding: 10px;"><a href="user.php?act=get_password" title=""><?php echo $this->_var['lang']['get_password']; ?></a></span>
</div>
<input type="hidden" name="act" value="zfbbind"/>
<input type="hidden" name="zfbid" value="<?php echo $this->_var['zfbid']; ?>" />
<input type="hidden" name="openid" value="<?php echo $this->_var['openid']; ?>" />
<input type="hidden" name="headimg" value="<?php echo $this->_var['headimg']; ?>" />
<input type="hidden" name="nickname" value="<?php echo $this->_var['nickname']; ?>" />
<input type="submit" class="reg-btn" id="form-register" value="立即绑定">
</form>
</div>
</div>


<div class="r-tabCon reg-form" style="display: none;">
<div class="wellcome-tip"><img src="<?php echo $this->_var['headimg']; ?>" width='28' height='28'/>Hi,<?php echo $this->_var['nickname']; ?>&nbsp;欢迎来到馨清</div>
<form action="user.php" method="post" name="formUser" onsubmit="return register();">
            <ul class="register-list mt20">
            <div class="form-item form-item-account">
            <label><?php echo $this->_var['lang']['label_username']; ?></label>
            <txt id='usernametxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的账户名和登录名</txt>
            <input type="text" class="register-input" name="username"  id="username" onblur="is_registered(this.value);" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="username_notice" class=" color06"></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_email']; ?></label>
            <txt id='emailtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的常用邮箱</txt>
            <input name="email" type="text" id="email" onblur="checkEmail(this.value);" class="register-input" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="email_notice" class=" color06"> <i class="i-def"></i></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_password']; ?></label>
            <txt id='passwordtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">建议至少使用两种字符组合</txt>
            <input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensityup(this.value)"  class="register-input" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="password_notice" class=" color06"> <i class="i-def"></i></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_confirm_password']; ?></label>
            <txt id='confirm_passwordtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请再次输入密码</txt>
            <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);"  class="register-input"  onfocus="show_txt(this.name)"/>
            </div>
            <div class="input-tip"><span id="conform_password_notice" class=" color06"> <i class="i-def"></i></span></div>
             
              <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
              <?php if ($this->_var['field']['id'] == 6): ?>
              <div class="form-item"><label><?php echo $this->_var['lang']['passwd_question']; ?></label>
                <select name='sel_question' class="register-input">
                <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
                <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'])); ?>
                </select>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
              <div class="form-item"><label><?php echo $this->_var['lang']['passwd_answer']; ?></label>
                <input name="passwd_answer" type="text" class="register-input" >
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06" id="passwd_quesetion"> *</span><?php endif; ?>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
              <?php elseif ($this->_var['field']['reg_field_name'] == '手机'): ?>
		      <?php if ($this->_var['_CFG'] [ 'ihuyi_sms_mobile_reg' ] == '1'): ?>
        
              <input type="hidden" id="ztime" value="<?php echo $this->_var['ztime']; ?>">
              <input type="hidden" id="smsyy" value="<?php echo $this->_var['smsyy']; ?>">
             
              <input type="hidden" id="sms_code" name="sms_code" value="<?php echo $this->_var['sms_code']; ?>">
			  <?php echo $this->smarty_insert_scripts(array('files'=>'global.js')); ?>
			  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
			  <?php echo $this->smarty_insert_scripts(array('files'=>'sms.js')); ?>
			  <div class="form-item"><label>手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机</label>
			  <txt id='moblie_phonetxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">建议使用常用手机</txt>
			  <input type="text" class="register-input" onblur="check_mobile_phone(this.value);" name="extend_field<?php echo $this->_var['field']['id']; ?>" onfocus="show_txt(this.name)">
             
              </div>
              <div class="input-tip"><span id="mobile_phone_notice" class=" color06"> <i class="i-def"></i></span></div>
              <div class="form-item"><label>手机验证码</label> 
              <txt id='moblie_phonecodetxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请输入手机验证码</txt>
              <input name="sms_verifycode" id="sms_verifycode" type="text" size="25" class="register-input" style="width:150px" maxlength="6" onfocus="show_txt(this.name)" onblur="check_sms_verifycode(this.value)"/>
              <input type="button" id="zphone" class="btn-phonecode"    value="<?php if ($this->_var['smsyy'] == 0): ?>获取语音验证码<?php else: ?>获取验证码<?php endif; ?>"  onclick="getverifycode1('extend_field<?php echo $this->_var['field']['id']; ?>', '<?php echo $this->_var['field']['reg_field_name']; ?>');">
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
			  <?php else: ?>
			  <div class="form-item"><label><?php echo $this->_var['field']['reg_field_name']; ?></label><input type="text" class="register-input" name="extend_field<?php echo $this->_var['field']['id']; ?>">
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06"> *</span><?php endif; ?>
              </div>
            <?php endif; ?>
              <?php else: ?>
              <div class="form-item"><label><?php echo $this->_var['field']['reg_field_name']; ?></label>
              <input type="text" class="register-input" name="extend_field<?php echo $this->_var['field']['id']; ?>">
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06"> *</span><?php endif; ?>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
             
              <?php if ($this->_var['enabled_captcha']): ?>
              <div class="form-item"><label>验&nbsp;&nbsp;&nbsp;证&nbsp;&nbsp;&nbsp;码</label>
              <txt id='captchatxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请输入验证码</txt>
              <input type="text" name="captcha" class="register-input" style="width: 150px;" onfocus='show_captcha_message()' onblur="hidden_captcha_message(this.value)"><img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /></div>
              <div class="input-tip"><span id="captcha_notice" class=" color06"> <i class="i-def"></i></span></div>
              <?php endif; ?>
              <div><strong></strong><input name="agreement" type="checkbox" value="1" checked="checked" />
            <?php echo $this->_var['lang']['agreement']; ?></div>
            <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
            <div>
                  <input name="act" type="hidden" value="act_register" >
                  <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                  <input type="hidden" name="zfbid" value="<?php echo $this->_var['zfbid']; ?>" />
                  <input type="hidden" name="headimg" value="<?php echo $this->_var['headimg']; ?>" />
                  <input type="hidden" name="nickname" value="<?php echo $this->_var['nickname']; ?>" />
                  <input name="Submit" type="submit" value="立即注册" class="reg-btn">
            </div>
              
            </ul>
          </form>
</div>

</div>
</div>
</div>
<?php endif; ?>



    <?php if ($this->_var['action'] == 'register'): ?>
    <?php if ($this->_var['shop_reg_closed'] == 1): ?>
    <div class="usBox">
      <div class="usBox_2 clearfix">
        <div class="f1 f5" align="center"><?php echo $this->_var['lang']['shop_register_closed']; ?></div>
      </div>
    </div>
    <?php else: ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <div class="w1160px">
      <div class="pos mt30">
        <?php echo $this->fetch('library/ur_here.lbi'); ?>
      </div>
      <div class="border mt10">
        <div class="register mt30 mb30">
          
           <form action="user.php" method="post" name="formUser" onsubmit="return register();">
            <ul class="register-list mt20">
            <div class="form-item form-item-account">
            <label><?php echo $this->_var['lang']['label_username']; ?></label>
            <txt id='usernametxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的账户名和登录名</txt>
            <input type="text" class="register-input" name="username"  id="username" onblur="is_registered(this.value);" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="username_notice" class=" color06"></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_email']; ?></label>
            <txt id='emailtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">您的常用邮箱</txt>
            <input name="email" type="text" id="email" onblur="checkEmail(this.value);" class="register-input" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="email_notice" class=" color06"> <i class="i-def"></i></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_password']; ?></label>
            <txt id='passwordtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">建议至少使用两种字符组合</txt>
            <input name="password" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensityup(this.value)"  class="register-input" onfocus="show_txt(this.name)">
            </div>
            <div class="input-tip"><span id="password_notice" class=" color06"> <i class="i-def"></i></span></div>
            <div class="form-item">
            <label><?php echo $this->_var['lang']['label_confirm_password']; ?></label>
            <txt id='confirm_passwordtxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请再次输入密码</txt>
            <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);"  class="register-input"  onfocus="show_txt(this.name)"/>
            </div>
            <div class="input-tip"><span id="conform_password_notice" class=" color06"> <i class="i-def"></i></span></div>
             
              <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
              <?php if ($this->_var['field']['id'] == 6): ?>
              <div class="form-item"><label><?php echo $this->_var['lang']['passwd_question']; ?></label>
                <select name='sel_question' class="register-input">
                <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
                <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'])); ?>
                </select>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
              <div class="form-item"><label><?php echo $this->_var['lang']['passwd_answer']; ?></label>
                <input name="passwd_answer" type="text" class="register-input" >
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06" id="passwd_quesetion"> *</span><?php endif; ?>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
              <?php elseif ($this->_var['field']['reg_field_name'] == '手机'): ?>
		      <?php if ($this->_var['_CFG'] [ 'ihuyi_sms_mobile_reg' ] == '1'): ?>
        
              <input type="hidden" id="ztime" value="<?php echo $this->_var['ztime']; ?>">
              <input type="hidden" id="smsyy" value="<?php echo $this->_var['smsyy']; ?>">
             
              <input type="hidden" id="sms_code" name="sms_code" value="<?php echo $this->_var['sms_code']; ?>">
			  <?php echo $this->smarty_insert_scripts(array('files'=>'global.js')); ?>
			  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
			  <?php echo $this->smarty_insert_scripts(array('files'=>'sms.js')); ?>
			  <div class="form-item"><label>手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机</label>
			  <txt id='moblie_phonetxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">建议使用常用手机</txt>
			  <input type="text" class="register-input" onblur="check_mobile_phone(this.value);" name="extend_field<?php echo $this->_var['field']['id']; ?>" onfocus="show_txt(this.name)">
             
              </div>
              <div class="input-tip"><span id="mobile_phone_notice" class=" color06"> <i class="i-def"></i></span></div>
               <?php if ($this->_var['enabled_captcha']): ?>
              <div class="form-item"><label>验&nbsp;&nbsp;&nbsp;证&nbsp;&nbsp;&nbsp;码</label>
              <txt id='captchatxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请输入验证码</txt>
              <input type="text" name="captcha" class="register-input" style="width: 150px;" onfocus='show_captcha_message()' onblur="hidden_captcha_message(this.value)"><img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /></div>
              <div class="input-tip"><span id="captcha_notice" class=" color06"> <i class="i-def"></i></span></div>
              <?php endif; ?>
              
              <div class="form-item"><label>手机验证码</label> 
              <txt id='moblie_phonecodetxt' style="position: absolute; z-index: 2; line-height: 46px; margin-left: 20px; margin-top: 1px; font-size: 14px; font-family: 'Microsoft YaHei', 'Hiragino Sans GB'; color: rgb(204, 204, 204); display: inline;">请输入手机验证码</txt>
              <input name="sms_verifycode" id="sms_verifycode" type="text" size="25" class="register-input" style="width:150px" maxlength="6" onfocus="show_txt(this.name)" onblur="check_sms_verifycode(this.value)"/>
              <input type="button" id="zphone" class="btn-phonecode"    value="<?php if ($this->_var['smsyy'] == 0): ?>获取语音验证码<?php else: ?>获取验证码<?php endif; ?>"  onclick="getverifycode1('extend_field<?php echo $this->_var['field']['id']; ?>', '<?php echo $this->_var['field']['reg_field_name']; ?>');">
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
			  <?php else: ?>
			  <div class="form-item"><label><?php echo $this->_var['field']['reg_field_name']; ?></label><input type="text" class="register-input" name="extend_field<?php echo $this->_var['field']['id']; ?>">
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06"> *</span><?php endif; ?>
              </div>
            <?php endif; ?>
              <?php else: ?>
              <div class="form-item"><label><?php echo $this->_var['field']['reg_field_name']; ?></label>
              <input type="text" class="register-input" name="extend_field<?php echo $this->_var['field']['id']; ?>">
                <?php if ($this->_var['field']['is_need']): ?><span class="prompt color06"> *</span><?php endif; ?>
              </div>
              <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
             
             
              <div><strong></strong><input name="agreement" type="checkbox" value="1" checked="checked" />
            <?php echo $this->_var['lang']['agreement']; ?></div>
            <div class="input-tip"><span id="" class=" color06"> <i class="i-def"></i></span></div>
            <div>
                  <input name="act" type="hidden" value="act_register" >
                  <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                  <input name="Submit" type="submit" value="立即注册" class="reg-btn">
            </div>
              
            </ul>
          </form>
        </div>
      </div>
    </div>

<?php endif; ?>
<?php endif; ?>



    <?php if ($this->_var['action'] == 'get_password'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
<div class="w1160px">
  <div class="pos mt30">
    <?php echo $this->fetch('library/ur_here.lbi'); ?>
  </div>
  <div class="border usBox mt10" style="min-height:0">
    <div class="usBox_2 clearfix" style="padding:0 0 0 0;width:950px;margin: 0 auto;">
    <div class="stepflex">
    <dl class="first done">
    <dt class="s-num">1</dt>
    <dd class="s-text">填写账户名</dd>
    </dl>
    <dl class="normal">
    <dt class="s-num">2</dt>
    <dd class="s-text">验证身份</dd>
    </dl>
    <dl class="normal">
    <dt class="s-num">3</dt>
    <dd class="s-text">设置新密码</dd>
    </dl>
    <dl class="last">
    <dt class="s-num">√</dt>
    <dd class="s-text">完成</dd>
    </dl>
    </div>
      <form action="javascript:submitPwdInfo()" method="post" name="getPassword" >
          <br />
          <table width="350" border="0" align="center" style="margin: 0 auto;">
            
            <tr>
              <td  align="left" height="60"><?php echo $this->_var['lang']['username']; ?>:</td>
              <td ><input name="user_name" type="text" size="30" class="get_passwordinput"  /><br>
              <label id="username_error"  class="msg-error"></label>
              </td>
            </tr>
            <tr>
              <td align="left" height="60"><?php echo $this->_var['lang']['comment_captcha']; ?>:</td>
              <td><input type="text" size="8" name="captcha" class="get_passwordinput" />
              <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> <br>
              <label id="captcha_error"  class="msg-error"></label>
              </td>
            </tr>
            
            <tr>
              <td></td>
              <td height='60'><input type="hidden" name="act" value="get_password_ui" />
                <input type="submit" name="submit1" value="<?php echo $this->_var['lang']['submit']; ?>" class="get_passbtn"  />
                <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>"  class="get_passbtn" />
  	    </td>
            </tr>
          </table>
          <br />
        </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_var['action'] == 'get_password_method'): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
<div class="w1160px">
  <div class="pos mt30">
    <?php echo $this->fetch('library/ur_here.lbi'); ?>
  </div>
  <div class="border usBox mt10" style="min-height:0">
    <div class="usBox_2 clearfix" style="padding:0 0 0 0;width:950px;margin: 0 auto;">
    
    <div class="stepflex">
    <dl class="first ">
    <dt class="s-num">1</dt>
    <dd class="s-text">填写账户名</dd>
    </dl>
    <dl class="normal done">
    <dt class="s-num">2</dt>
    <dd class="s-text">验证身份</dd>
    </dl>
    <dl class="normal">
    <dt class="s-num">3</dt>
    <dd class="s-text">设置新密码</dd>
    </dl>
    <dl class="last">
    <dt class="s-num">√</dt>
    <dd class="s-text">完成</dd>
    </dl>
    </div>
      <form action="user.php" method="post" name="getPassword" autocomplete="off" onsubmit="return submitPwdInfonoa();">
          <br />
          <table width="350" border="0" align="center" style="margin: 0 auto;">
            <tr>
              <td  align="left" height="60">请选择验证身份方式:</td>
              <td >
              <select name="password_method" class="selt" onchange="selectVerifyType();">
              <?php if ($this->_var['getp_user_info']['is_validated'] == 1): ?>
              <option value="email">已验证邮箱</option>
              <?php endif; ?>
              <?php if ($this->_var['getp_user_info']['mobile_phone']): ?>
              <option value="mobile">已验证手机</option>
              <?php endif; ?>
              </select>
              </td>
            </tr>
            <tr>
              <td  align="left" height="60"><?php echo $this->_var['lang']['username']; ?>:</td>
              <td >
              <strong style="font-size: 16px;"><?php echo $this->_var['getp_user_info']['user_name']; ?></strong>
              <input type="hidden" name='user_name' value="<?php echo $this->_var['getp_user_info']['user_name']; ?>"/>
              </td>
            </tr>
            
            <tr id="emaildiv" <?php if ($this->_var['getp_user_info']['is_validated'] == 1): ?>style="display:''"<?php else: ?>style="display:none"<?php endif; ?>>
              <td align="left" height="60"><?php echo $this->_var['lang']['email']; ?>:</td>
              <td><input name="email" type="text" size="30" class="get_passwordinput" /></td>
              <?php if ($this->_var['getp_user_info']['is_validated'] == 1): ?><input type="hidden" name="act" value="send_pwd_email"/>
              <?php else: ?>
              <input type="hidden" name="act" value="send_pwd_mobile"/>
              <?php endif; ?>
            </tr>
            
            
            <tr id="mobilediv" <?php if ($this->_var['getp_user_info']['is_validated'] == 1): ?>style="display:none"<?php else: ?>style="display:''"<?php endif; ?>>
               <td align="left" height="60">已验证手机:</td>
               <td><strong style="font-size: 16px;"><?php echo $this->_var['getp_user_info']['mobile_phone']; ?></strong>
               </td>
            
            </tr>
            <tr id="mobilediv1" <?php if ($this->_var['getp_user_info']['is_validated'] == 1): ?>style="display:none"<?php else: ?>style="display:''"<?php endif; ?>>
               <td align="left" height="60">输入已验证手机:</td>
               <td>
               <input name="mobile" type="text" size="30" class="get_passwordinput" />
               </td>
             
            </tr>
           
            <tr>
              <td></td>
              <td height='60'>
              
                <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="get_passbtn"  />
                <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" class="get_passbtn" />
  	    </td>
            </tr>
          </table>
          <br />
        </form>
    </div>
  </div>
</div>
<?php endif; ?>


<?php if ($this->_var['action'] == 'reset_password_done'): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
<div class="w1160px">
  <div class="pos mt30">
    <?php echo $this->fetch('library/ur_here.lbi'); ?>
  </div>
  <div class="border usBox mt10" style="min-height:0">
    <div class="usBox_2 clearfix" style="padding:0 0 0 0;width:950px;margin: 0 auto;">
    
    <div class="stepflex">
    <dl class="first ">
    <dt class="s-num">1</dt>
    <dd class="s-text">填写账户名</dd>
    </dl>
    <dl class="normal ">
    <dt class="s-num">2</dt>
    <dd class="s-text">验证身份</dd>
    </dl>
    <dl class="normal">
    <dt class="s-num">3</dt>
    <dd class="s-text">设置新密码</dd>
    </dl>
    <dl class="last done">
    <dt class="s-num">√</dt>
    <dd class="s-text">完成</dd>
    </dl>
    </div>
    <div class="reset_password_done"><?php echo $this->_var['lang']['send_pwd_mobile_success']; ?>&nbsp;&nbsp;<a href="<?php echo $this->_var['relogin_lnk']; ?>" style="color: #005ea7;">请重新登录</a></div>
    </div>
  </div>
</div>
<?php endif; ?>


    <?php if ($this->_var['action'] == 'qpassword_name'): ?>
<div class="w1160px">
  <div class="pos mt30">
    <?php echo $this->fetch('library/ur_here.lbi'); ?>
  </div>
  <div class="border usBox mt10">
    <div class="usBox_2 clearfix">
      <form action="user.php" method="post">
          <br />
          <table width="70%" border="0" align="center">
            <tr>
              <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['get_question_username']; ?></strong></td>
            </tr>
            <tr>
              <td width="29%" align="right" height="50"><?php echo $this->_var['lang']['username']; ?></td>
              <td width="61%"><input name="user_name" type="text" size="30" class="login-input" /></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="hidden" name="act" value="get_passwd_question" class="login-input"/>
                <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="btning" style="border:none;" />
                <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;"class="btning" />
  	         </td>
            </tr>
          </table>
          <br />
        </form>
    </div>
  </div>
</div>
<?php endif; ?>


    <?php if ($this->_var['action'] == 'get_passwd_question'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['input_answer']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
            <td width="61%"><?php echo $this->_var['passwd_question']; ?></td>
          </tr>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
            <td><input name="passwd_answer" type="text" size="20" class="inputBg" /></td>
          </tr>
          <?php if ($this->_var['enabled_captcha']): ?>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
            <td><input type="text" size="8" name="captcha" class="inputBg" />
            <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td></td>
            <td><input type="hidden" name="act" value="check_answer" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="get_passbtn"  />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>"  class="get_passbtn" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_var['action'] == 'reset_password'): ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
<div class="usBox">
  <div class="usBox_2 clearfix">
     <div class="stepflex">
    <dl class="first ">
    <dt class="s-num">1</dt>
    <dd class="s-text">填写账户名</dd>
    </dl>
    <dl class="normal ">
    <dt class="s-num">2</dt>
    <dd class="s-text">验证身份</dd>
    </dl>
    <dl class="normal done">
    <dt class="s-num">3</dt>
    <dd class="s-text">设置新密码</dd>
    </dl>
    <dl class="last">
    <dt class="s-num">√</dt>
    <dd class="s-text">完成</dd>
    </dl>
    </div>
    <form action="user.php" method="post" name="getPassword2" onSubmit="return submitPwd()">
      <br />
      <table width="350" border="0" align="center" style="margin: 0 auto;">
        <tr>
          <td height="50"><?php echo $this->_var['lang']['new_password']; ?>:</td>
          <td><input name="new_password" type="password" size="25" class="get_passwordinput" /></td>
        </tr>
        <tr>
          <td height='50'><?php echo $this->_var['lang']['confirm_password']; ?>:</td>
          <td><input name="confirm_password" type="password" size="25"  class="get_passwordinput"/></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="hidden" name="act" value="act_edit_password" />
            <input type="hidden" name="uid" value="<?php echo $this->_var['uid']; ?>" />
            <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
            <input type="submit" name="submit" value="<?php echo $this->_var['lang']['confirm_submit']; ?>" class='get_passbtn'/>
          </td>
        </tr>
      </table>
      <br />
    </form>
  </div>
</div>
<?php endif; ?>

</div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
</script>
</html>
