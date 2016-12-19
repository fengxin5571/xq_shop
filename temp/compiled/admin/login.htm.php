<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_var['lang']['cp_home']; ?><?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?><?php endif; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" /><link href="styles/login.css" rel="stylesheet" type="text/css"  />
<link href="styles/main.css" rel="stylesheet" type="text/css" />

<style type="text/css">body{height:100%;background:#0374d9;overflow:hidden;font-family: "Microsoft YaHei";    font-size: .28em;color:#fff}canvas{z-index:-1;position:absolute;}
</style>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js,../js/jquery-1.9.1.min.js,../js/Particleground.js')); ?>
<script language="JavaScript">$(document).ready(function(){	$('body').particleground({dotColor: '#419AE8',	    lineColor: '#419AE8'});});
<!--
// 这里把JS用到的所有语言都赋值到这里
<?php $_from = $this->_var['lang']['js_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

if (window.parent != window)
{
  window.top.location.href = location.href;
}

-->
</script>
</head>
<body >
<form method="post" action="privilege.php" name='theForm' onsubmit="return validate()" autocomplete="off"> <dl class="admin_login"> <dt>  <strong><?php echo $this->_var['lang']['cp_home']; ?><?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?><?php endif; ?></strong>  <em>Management System</em> </dt> <dd class="user_icon">  <input type="text" placeholder="<?php echo $this->_var['lang']['label_username']; ?>" class="login_txtbx" name="username"/> </dd> <dd class="pwd_icon">  <input type="password" placeholder="<?php echo $this->_var['lang']['label_password']; ?>" class="login_txtbx" name="password"/> </dd>  <?php if ($this->_var['gd_version'] > 0): ?>  <dd class="val_icon">  <div class="checkcode">    <input type="text" id="J_codetext" placeholder="<?php echo $this->_var['lang']['label_captcha']; ?>" maxlength="4" class="login_txtbx" name="captcha">    <img src="index.php?act=captcha&<?php echo $this->_var['random']; ?>" width="145" height="20" alt="CAPTCHA" border="1" onclick= this.src="index.php?act=captcha&"+Math.random() style="cursor: pointer;" title="<?php echo $this->_var['lang']['click_for_another']; ?>" />  </div>  </dd>  <?php endif; ?>  <dd style="height:30px">  <input type="checkbox" value="1" name="remember" id="remember" /><label for="remember"><?php echo $this->_var['lang']['remember']; ?></label>  </dd>  <dd>  <input type="submit" value="立即登陆" class="submit_btn"/>  </dd>    <dd>  <p>© 2015-2016 馨清网  版权所有</p>   &raquo; <a href="../" style="color:white"><?php echo $this->_var['lang']['back_home']; ?></a> &raquo; <a href="get_password.php?act=forget_pwd" style="color:white"><?php echo $this->_var['lang']['forget_pwd']; ?></a> </dd> </dl>
  <input type="hidden" name="act" value="signin" />
</form>
<script language="JavaScript">
<!--
  document.forms['theForm'].elements['username'].focus();
  
  /**
   * 检查表单输入的内容
   */
  function validate()
  {
    var validator = new Validator('theForm');
    validator.required('username', user_name_empty);
    validator.required('password', password_empty);
    if (document.forms['theForm'].elements['captcha'])
    {
      validator.required('captcha', captcha_empty);
    }
    return validator.passed();
  }
  
//-->
</script>
</body>