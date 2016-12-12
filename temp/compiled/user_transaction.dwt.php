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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="main" style="background-color: #f5f5f5;">
    
    <div class="w1160px clearfix">
        
        <div class="mt">
              
              <?php if ($this->_var['action'] != 'order_detail' || $this->_var['order']['order_status'] == '已取消'): ?>
              <div class="AreaL">
                <div class="box">
                 <div class="box_1" style="border:none">
                  <div class="userCenterBox">
                  	<?php if ($this->_var['action'] == 'profile' || $this->_var['action'] == 'address_list' || $this->_var['action'] == 'account_union' || $this->_var['action'] == 'safetycenter' || $this->_var['action'] == 'update_password' || $this->_var['action'] == 'userinfo_headimg'): ?>
                  	<?php echo $this->fetch('library/user_menu1.lbi'); ?>
                  	<?php else: ?>
                    <?php echo $this->fetch('library/user_menu.lbi'); ?>
                    <?php endif; ?>
                  </div>
                 </div>
                </div>
              </div>
              
              <?php endif; ?>

                
                    <div class="AreaR"<?php if ($this->_var['action'] == 'order_detail' && $this->_var['order']['order_status'] != '已取消'): ?>style="width:1160px"<?php endif; ?>style="margin-top: 20px;">
                      <div class="box">
                       <div class="box_1">
                        <div class="userCenterBox boxCenterList clearfix" <?php if ($this->_var['action'] == 'order_detail' || $this->_var['action'] == 'bonus'): ?>style="background-color: #f5f5f5;"<?php else: ?>style="_height:1%;"<?php endif; ?>>
                           
                           <?php if ($this->_var['action'] == 'profile'): ?>
                           <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
                          <script type="text/javascript">
                            <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                              var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          </script>
                        <div class="mod-main">
                        <div class="mt">
                        <ul class="extra-l">
                        <li class="fore-1"><a <?php if ($this->_var['action'] == 'profile'): ?>class="curr"<?php endif; ?> href="user_info.html"><?php echo $this->_var['lang']['profile']; ?></a></li>
                        <li class="fore-1"><a href="showImg.html"><?php echo $this->_var['lang']['user_headimg']; ?></a></li>
                        </ul>
                        </div>
                        <div class="mc">
                        <div class="user-set userset-lcol">
                        <form name="formEdit" action="user.php" method="post" onSubmit="return userEdit()">
                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="">
                        		  <tr>
                                    <td width="28%" align="right" bgcolor="#FFFFFF"><span style="color:#FF0000"> *</span><?php echo $this->_var['lang']['username']; ?>： </td>
                                    <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'><strong><?php echo $this->_var['profile']['user_name']; ?></strong></td>
                                  </tr>
                                  
                                  <tr>
                                    <td width="28%" align="right" bgcolor="#FFFFFF"><span style="color:#FF0000"> *</span><?php echo $this->_var['lang']['sex']; ?>： </td>
                                    <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'>
                                      <input type="radio" name="sex" value="1" <?php if ($this->_var['profile']['sex'] == 1): ?>checked="checked"<?php endif; ?> />
                                      <?php echo $this->_var['lang']['male']; ?>&nbsp;&nbsp;
                                      <input type="radio" name="sex" value="2" <?php if ($this->_var['profile']['sex'] == 2): ?>checked="checked"<?php endif; ?> />
                                    <?php echo $this->_var['lang']['female']; ?>&nbsp;&nbsp; 
                                    <input type="radio" name="sex" value="0" <?php if ($this->_var['profile']['sex'] == 0): ?>checked="checked"<?php endif; ?> />
                                      <?php echo $this->_var['lang']['secrecy']; ?>&nbsp;&nbsp;
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['birthday']; ?>： </td>
                                    <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'> <?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'birthday','start_year'=>'-60','end_year'=>'+1','display_days'=>'true','month_format'=>'%m','day_value_format'=>'%02d','time'=>$this->_var['profile']['birthday'])); ?> </td>
                                  </tr>
                                  <tr>
                                    <td width="28%" align="right" bgcolor="#FFFFFF"><span style="color:#FF0000"> *</span><?php echo $this->_var['lang']['email']; ?>： </td>
                                    <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'><input name="email" type="text" value="<?php echo $this->_var['profile']['email']; ?>" size="25" class="itxt itxt-succ" /><?php if ($this->_var['profile']['is_validated'] == 1): ?><span class="ftx-03">&nbsp;&nbsp;&nbsp;已验证</span><?php endif; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="28%" align="right" bgcolor="#FFFFFF">真实姓名： </td>
                                    <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'><input name="real_name" type="text" value="<?php echo $this->_var['profile']['real_name']; ?>" size="25" class="itxt itxt-succ" /></td>
                                  </tr>
                      <?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
                      <?php if ($this->_var['field']['id'] == 6): ?>
                      <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
                        <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'>
                        <select name='sel_question'>
                        <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
                        <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'],'selected'=>$this->_var['profile']['passwd_question'])); ?>
                        </select>
                        </td>
                      </tr>
                      <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF" <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
                        <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'>
                        <input name="passwd_answer" type="text" size="25" class="itxt" maxlengt='20' value="<?php echo $this->_var['profile']['passwd_answer']; ?>"/><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?>
                        </td>
                      </tr>
                      
		<?php elseif ($this->_var['field']['reg_field_name'] == '手机'): ?>
			
				<td width="28%" align="right" bgcolor="#FFFFFF" <?php if ($this->_var['field']['is_need']): ?>id="extend_field<?php echo $this->_var['field']['id']; ?>i"<?php endif; ?>><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?><?php echo $this->_var['field']['reg_field_name']; ?>：</td>
				<td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'>
				<?php echo $this->_var['field']['content']; ?>
				</td>
			
                
                      
                      <?php else: ?>
                      <tr>
                        <td width="28%" align="right" bgcolor="#FFFFFF" <?php if ($this->_var['field']['is_need']): ?>id="extend_field<?php echo $this->_var['field']['id']; ?>i"<?php endif; ?>><?php echo $this->_var['field']['reg_field_name']; ?>：</td>
                        <td width="72%" align="left" bgcolor="#FFFFFF" colspan='2'>
                        <input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" class="inputBg" value="<?php echo $this->_var['field']['content']; ?>"/><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?>
                        </td>
                      </tr>
                      <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  <tr>
                                    <td colspan="3" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_profile" />
                                      <input name="submit" type="submit" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" class="get_passbtn"  />
                                    </td>
                                  </tr>
                         </table>
                      </form>
                      </div>
                      <div id="user-info">
                      <div class="u-pic">
                      <?php if ($this->_var['profile']['xqheadimg']): ?>
                      <img alt="用户头像" src="/data/user_head/<?php echo $this->_var['profile']['user_id']; ?>/<?php echo $this->_var['profile']['xqheadimg']; ?>" style="vertical-align: middle;" width="100" height='100'/>
                      <?php else: ?>
                      <img alt="用户头像" src="themes/default/images/robot/no-img_mid_.jpg" style="vertical-align: middle;"/>
                      <?php endif; ?>
                      <div class="mask"></div>
                      <div class="face-link-box"></div>
                      </div>
                      <div class='info-m'>
                      <div><b><?php echo $this->_var['lang']['username']; ?>：<?php echo $this->_var['profile']['user_name']; ?></b></div>
                      <div class='u-level'>
                      <?php if ($this->_var['ranks']): ?>
                  		<?php $_from = $this->_var['ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                          <span class="urank r1"><s></s><?php echo $this->_var['item']['type_name']; ?>: </span><?php if (isset ( $this->_var['item']['rank_name'] )): ?><?php echo $this->_var['item']['rank_name']; ?><?php else: ?>无此模块权限<?php endif; ?>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  		<?php else: ?>
                  		<span class="urank r1"><s></s>注册会员</span>    
                  	  <?php endif; ?>    
                      </div>
                      <div class='u-email'><label>邮箱认证：</label><?php if ($this->_var['profile']['is_validated'] == 1): ?>已认证<?php else: ?><a href="javascript:sendHashMail()" style="color:red;">未认证</a><?php endif; ?></div>
                      <div>真实姓名：<?php echo $this->_var['profile']['real_name']; ?></div>
                      </div>
                      </div>
                      <div class="fr" style="width: 280px;text-align: center;">注：修改手机和邮箱认证请到<a href="safety_center.html" class="ftx-05 ml5">账户安全</a></div>
                        </div>
                        </div>
            
                       <?php endif; ?>
                       
                     <?php if ($this->_var['action'] == 'userinfo_headimg'): ?>
                     <link href="<?php echo $this->_var['img_css_path']; ?>" rel="stylesheet" type="text/css" />
                     <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,zyFile.js,zyUpload.js,demo.js')); ?>
                     <script> 
                     var ad="<?php echo $this->_var['profile']['xqheadimg']; ?>";  
                     var user_path="<?php echo $this->_var['profile']['user_id']; ?>";  
                     </script>
                     <div class="mod-main">
                        <div class="mt">
                        <ul class="extra-l">
                        <li class="fore-1"><a <?php if ($this->_var['action'] == 'profile'): ?>class="curr"<?php endif; ?> href="user_info.html"><?php echo $this->_var['lang']['profile']; ?></a></li>
                        <li class="fore-1"><a <?php if ($this->_var['action'] == 'userinfo_headimg'): ?>class="curr"<?php endif; ?> href="showImg.html"><?php echo $this->_var['lang']['user_headimg']; ?></a></li>
                        </ul>
                        </div>
                        <div class="mc">
                        <div class="ftx03" style="padding-left: 30px;">仅支持JPG、GIF、PNG、JPEG、BMP格式，文件小于4M</div>
                        <div id="demo" class="demo"></div> 
                        
                        </div>
                     </div>     
                     <?php endif; ?>
                        
                       
                       
                        <?php if ($this->_var['action'] == 'account_union'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3>账号绑定</h3></div>
                        <div class="mc">
                        <div class="bind-list">
                        <div class="bind-tit"><strong><?php echo $this->_var['lang']['zfb_bind_account']; ?></strong>
                        <?php if ($this->_var['user_info']['zfbid']): ?><span class="ftx-02">已绑定</span><div class="account_d"><img src="themes/default/images/robot/zfb.gif" width='28' height='28' style="margin-right: 10px;border-radius: 30px;vertical-align: middle;"/><span><?php echo $this->_var['user_info']['zfbname']; ?></div><div class="bind-op-btn"><a href="javascript:jConfirm('您确定要解除支付宝账号绑定吗？',function(){location.href='user.php?act=unbind&zfbid=<?php echo $this->_var['user_info']['zfbid']; ?>';},'馨清网')" class="ftx-05">解绑</a></div><?php else: ?><span class='ftx-04'>未绑定</span><?php endif; ?></div>
                        </div>
                        <div class="bind-list">
                        <div class="bind-tit"><strong><?php echo $this->_var['lang']['weixin_bind_account']; ?></strong>
                        <?php if ($this->_var['user_info']['wxid']): ?><span class="ftx-02">已绑定</span><div class="account_d"><img src="<?php echo $this->_var['user_info']['headimg']; ?>" width='28' height='28' style="margin-right: 10px;border-radius: 30px;vertical-align: middle;"/><span><?php echo $this->_var['user_info']['nickname']; ?></span></div><div class="bind-op-btn"><a href="javascript:jConfirm('您确定要解除微信账号绑定吗？',function(){location.href='user.php?act=unbind&wxid=<?php echo $this->_var['user_info']['wxid']; ?>';},'馨清网')" class="ftx-05">解绑</a></div><?php else: ?><span class='ftx-04'>未绑定</span><?php endif; ?></div>
                        </div>
                        </div>
                        </div>
                        <?php endif; ?>
                       
                       
                       <?php if ($this->_var['action'] == 'safetycenter'): ?>
                       <div class="mod-main mod-comm">
                       <div class="mt"><h3>安全中心</h3></div>
                       <div class="mc">
                       <div class="saft-item-lists">
                       <div class="u-safe warn-box"><strong>安全级别：</strong>
                       <?php if ($this->_var['safetyleve'] == 'middle'): ?>
                       <i class="safe-rank04"></i><strong class="rank-text ftx-04">中级</strong><span class="ftx-04 ml10" id="promptInfo">建议您启动全部安全设置，以保障账户及资金安全。</span>
                       <?php elseif ($this->_var['safetyleve'] == 'high'): ?>
                       <i class="safe-rank05"></i><strong class="rank-text ftx-02">高级</strong><span class="ftx-02 ml10" id="promptInfo">安全状态良好。</span>
                        <?php endif; ?>
                       </div>
                       <div class="safe-item">
                       <div class="fore1"><s class="icon-01"></s><strong>登录密码</strong></div>
                       <div class="fore2"><span class="ftx-01">互联网账号存在被盗风险，建议您定期更改密码以保护账户安全。</span></div>
                       <div class="fore3"><a class="ftx-05" href="user.php?act=update_password">修改</a></div>
                       </div>
                       <div class="safe-item">
                        <?php if ($this->_var['user_info']['is_validated'] == 0): ?>
                       <div class='fore1'><s class="icon-02"></s><strong>邮箱认证</strong></div>
                       <div class="fore2"><span class="ftx-03">验证后，可用于快速找回登录密码，接收商家邮件信息。</span></div>
                       <div class="fore3"><a href="javascript:sendHashMail()" class="get_passbtn">立即认证</a></div>
                       <?php else: ?>
                        <div class='fore1'><s class="icon-01"></s><strong>邮箱认证</strong></div>
                       <div class="fore2"><span class="ftx-03">您验证的邮箱：<strong class="ftx-06"><?php echo $this->_var['user_info']['email']; ?></strong></span></div>
                        <?php endif; ?>
                       </div>
                       <div class="safe-item">
                       <div class='fore1'><s class="icon-01"></s><strong>手机验证</strong></div>
                       <div class="fore2"><span class="ftx-03">您验证的手机：<strong class="ftx-06">  <?php echo $this->_var['user_info']['mobile_phone']; ?></strong>&nbsp;&nbsp;若已丢失或停用，请立即更换，<span style="color:#cc0000;">避免账户被盗</span></span></div>
                       <div class="fore3">
                       <?php if ($this->_var['_CFG'] [ 'ihuyi_sms_mobile_bind' ] == '1'): ?>
                       <?php if ($this->_var['user_info']['mobile_phone'] != ''): ?>
				       <a href="user.php?act=bindmobile" class="get_passbtn" >重新绑定</a>
				       <?php else: ?>
				       <a href="user.php?act=bindmobile" class="get_passbtn">绑定手机</a>
				       <?php endif; ?>
                       
                       <?php endif; ?>
                       </div>
                       
                       </div>
                       
                       </div>
                       </div>
                       </div>
                       <?php endif; ?>
                       
                       
                       <?php if ($this->_var['action'] == 'update_password'): ?>
                        <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
                          <script type="text/javascript">
                            <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                              var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          </script>
                       <div class="mod-main mod-comm">
                       <div class="mt"><h3>修改登录密码</h3></div>
                       <form name="formPassword" action="user.php" method="post" onSubmit="return editPassword()" >
                       <table width="450" border="0" cellpadding="5" cellspacing="1" bgcolor="">
                          <tr>
                            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['old_password']; ?>：</td>
                            <td width="76%" align="left" bgcolor="#FFFFFF"><input name="old_password" type="password" size="25"  class="get_passwordinput" /></td>
                          </tr>
                          <tr>
                            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['new_password']; ?>：</td>
                            <td align="left" bgcolor="#FFFFFF"><input name="new_password" type="password" size="25"  class="get_passwordinput" /></td>
                          </tr>
                          <tr>
                            <td width="28%" align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['confirm_password']; ?>：</td>
                            <td align="left" bgcolor="#FFFFFF"><input name="comfirm_password" type="password" size="25"  class="get_passwordinput" /></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_edit_password" />
                              <input name="submit" type="submit" class="get_passbtn"  value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                            </td>
                          </tr>
                        </table>
                      </form>
                      </div>
                       <?php endif; ?>
                       
                       
     
         <?php if ($this->_var['action'] == 'bindmobile'): ?>
         <script>var ztime=<?php echo $this->_var['ztime']; ?>;</script>
         <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
	 <?php echo $this->smarty_insert_scripts(array('files'=>'global.js')); ?>
	 <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
	 <input type="hidden" id="sms_code" value="<?php echo $this->_var['sms_code']; ?>">
     <input type="hidden" id="ztime" value="<?php echo $this->_var['ztime']; ?>">
     <input type="hidden" id="smsyy" value="<?php echo $this->_var['smsyy']; ?>">
	 <?php echo $this->smarty_insert_scripts(array('files'=>'sms.js')); ?>
        <script type="text/javascript">
          <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </script>
      <div class="mod-main mod-comm">
      <div class='mt'>
      <h3>修改已验证手机</h>
      </div>
     <div class="mc">
     <div class="stepflex" style="width: 600px;">
    <dl class="first done">
    <dt class="s-num">1</dt>
    <dd class="s-text">验证身份</dd>
    </dl>
    <dl class="normal">
    <dt class="s-num">2</dt>
    <dd class="s-text">修改已验证手机</dd>
    </dl>
    <dl class="last">
    <dt class="s-num">√</dt>
    <dd class="s-text">完成</dd>
    </dl>
    </div>
     <form name="formBindmobile" action="user.php" method="post" onSubmit="return bindMobile()" >
     
     <table width="700" border="0" cellpadding="5" cellspacing="1" class="bind_mobile">
        <tr>
          <td width="28%" align="right" bgcolor="#FFFFFF"><span class="label">手机号：</span></td>
          <td width="76%" align="left" bgcolor="#FFFFFF"><input id="mobile" name="mobile" type="text" size="25"  class="itxt" maxlength="12" /></td>
        </tr>
        <tr>
          <td width="28%" align="right" bgcolor="#FFFFFF"><span class="label">图形验证码：</span></td>
          <td align="left" bgcolor="#FFFFFF"><input id="smscode" name="smscode" type="text" size="25"  class="itxt" maxlength="6" /><span style="color:#FF0000;padding-left: 10px;"> <img src="captcha.php?139417314" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /></span></td>
        </tr>
        <tr>
          <td width="28%" align="right" bgcolor="#FFFFFF"><span class="label">请填写手机校验码：</span></td>
          <td align="left" bgcolor="#FFFFFF"><input id="verifycode" name="verifycode" type="text" size="25"  class="itxt" maxlength="6" /><span style="color:#FF0000"> <input type="button" id="zphone" value="获取手机验证码"  onclick="getverifycode2();" class="btn"></span></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#FFFFFF"><input name="act" type="hidden" value="act_bindmobile" />
            <input name="submit" type="submit" class="get_passbtn"  value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
          </td>
        </tr>
      </table>
    </form>
    </div>
    </div>
     <?php endif; ?>
     
     
                       <?php if ($this->_var['action'] == 'bonus'): ?>
                       <div class="mod-main mod-comm" style="padding-bottom: 10px;">
                        <script type="text/javascript">
                          <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </script>
                        <div class="mt">
                        <h3><?php echo $this->_var['lang']['label_bonus']; ?></h3>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt">
                        <div style="float:left">
                        <h3><?php echo $this->_var['lang']['add_bonus']; ?></h3>
                        </div>
                        <form name="addBouns" action="user.php" method="post" onSubmit="return addBonus()">
                          <div style="float: right;">
                          <?php echo $this->_var['lang']['bonus_number']; ?>
                            <input name="bonus_sn" type="text" size="30" class="inputBg" style="line-height: 18px;border: 1px solid #ccc;padding: 5px;float: none;font-family: "Microsoft YaHei";font-size: 12px;"/>
                            <input type="hidden" name="act" value="act_add_bonus" class="inputBg" />
                            <input type="submit" class="get_passbtn"  value="<?php echo $this->_var['lang']['add_bonus']; ?>" />
                          </div>
                        </form>
                        </div>
                        <div class="mt"></div>
                        <div class="mc">
                        <div class="coupon-items" style="    overflow: hidden;">
                        <?php if ($this->_var['bonus']): ?>
                         <?php $_from = $this->_var['bonus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                         <div class="coupon-item coupon-item-d">
                         <div></div>
                         <div class="c-type">
                         <div class="c-price"><em>¥</em><strong><?php echo $this->_var['item']['type_money']; ?></strong></div>
                         <div class="c-limit"><span><?php echo $this->_var['item']['type_name']; ?></span>【满<?php echo $this->_var['item']['min_goods_amount']; ?>可用】</div>
                         <div class="c-time"><?php echo $this->_var['item']['use_startdate']; ?> - <?php echo $this->_var['item']['use_enddate']; ?></div>
                         <div class="c-type-top"></div>
                         <div class="c-type-bottom"></div>
                         </div>
                         <div class="c-msg">
                         <div class="c-range" style="overflow: hidden;">
                         <div class="range-item"><span class="label">券编号：</span><span class="txtl"><?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?></span></div>
                         <div class="range-item"><span class="label">状态：</span><span class="txtl"><?php echo $this->_var['item']['status']; ?></span></div>
                         </div>
                         
                         <div class="op-btns">
                         <?php if ($this->_var['item']['status'] == "未使用"): ?>
                         <a href="/" class="btn"><span class="txtl">立即使用</span><b></b></a>
                         <?php elseif ($this->_var['item']['status'] == "已使用"): ?>
                         <a href="user.php?act=order_detail&amp;order_id=<?php echo $this->_var['item']['order_id']; ?>"class="btn"><span class="txtl">查看使用订单</span><b></b></a>
                         <?php elseif ($this->_var['item']['status'] == "未开始"): ?>
                         <a href="javascript:;"class="btn"><span class="txtl">请耐心等待！</span><b></b></a>
                         <?php elseif ($this->_var['item']['status'] == "已过期"): ?>
                         <a href="javascript:;" class="btn"><span class="txtl"><?php echo $this->_var['item']['status']; ?></span><b></b></a>
                         <?php endif; ?>
                         </div>
                         </div>
                         </div>
                         <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                         <?php else: ?>
                         <?php echo $this->_var['lang']['user_bonus_empty']; ?>
                         <?php endif; ?>
                        </div>
                        
                        
                        
                        <?php echo $this->fetch('library/pages.lbi'); ?>
                        </div>
                        
                        </div>
                      <?php endif; ?>
                     
                        
                         <?php if ($this->_var['action'] == 'order_list'): ?>
                         <div class="mod-main mod-comm mod-order">
                         <div class="mt">
                         <h3><?php echo $this->_var['lang']['label_order']; ?></h3>
                         </div>
                         <div class="mt">
                         <ul class="extra-l">
                         <li class="fore1"><a class='<?php if ($this->_var['step'] == 'order_list'): ?>curr<?php endif; ?>' href="order_list.html">全部订单</a></li>
                         <li><a href="user.php?act=order_list&step=pay&pay_s=1" class="<?php if ($this->_var['step'] == 'pay'): ?>curr<?php endif; ?>"><?php echo $this->_var['lang']['ps']['0']; ?></a></li>
                         <li><a href="user.php?act=order_list&step=shipping&shipp_s=2" class="<?php if ($this->_var['step'] == 'shipping'): ?>curr<?php endif; ?>">待收货</a></li>
                         </ul>
                         <div class="extra-r">
                         <div class="search">
                         <input id="ip_keyword" type="text" class="itxt"/>
                         <a href="javascript:;" class="search-btn">搜索<b></b></a>
                         </div>
                         </div>
                         </div>
                         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="" class="order-tb" style="border-collapse: collapse;">
                            <thead>
                            <tr align="center">
                              <th bgcolor="#ffffff">订单详情</th>
                              <th bgcolor="#ffffff">收货人</th>
                              <th bgcolor="#ffffff"><?php echo $this->_var['lang']['order_money']; ?></th>
                              <th bgcolor="#ffffff"><?php echo $this->_var['lang']['order_status']; ?></th>
                              <th bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></th>
                            </tr>
                            </thead>
                            <tr class="sep-row"><td colspan="5"></td></tr>
                            <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                            <tr class="tr-th">
                            <td colspan="5" style="position: relative;">
                            <span class="gap"></span>
                            <span class="dealtime" title="<?php echo $this->_var['item']['order_time']; ?>"><?php echo $this->_var['item']['order_time']; ?></span>
                            <span class="number"><?php echo $this->_var['lang']['order_number']; ?>：<a href="order_item-<?php echo $this->_var['item']['order_id']; ?>.html"><?php echo $this->_var['item']['order_sn']; ?></a></span>
                            <div class="tr-operate"><span class="order-shop"><span class="shop-txt"><?php echo $this->_var['shop_name']; ?></span><a href="tencent://message/?uin=<?php echo $this->_var['qq']; ?>&Site=<?php echo $this->_var['shop_name']; ?>&Menu=yes" target="_blank" title="联系客服" class="btn-im "></a></span></div>
                            <?php $_from = $this->_var['item']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foo']['iteration']++;
?>
                            <?php if ($this->_var['item']['is_presell']): ?>
                            <i class="zc_icon"></i>
                            
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </td>
                            </tr>
                            
                            <?php $_from = $this->_var['item']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['foo']['iteration']++;
?>
                            <tr class="tr-bd">
                            <td>
                            <div class="goods-item">
                            <div class="p-img"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank"><img src="<?php if ($this->_var['goods']['extension_code'] == 'package_buy'): ?>themes/<?php echo $this->_var['_CFG']['template']; ?>/images/robot/pack.png<?php else: ?><?php echo $this->_var['goods']['goods_thumb']; ?><?php endif; ?>" width="60" height="60" title="<?php echo $this->_var['goods']['goods_name']; ?>"/></a></div>
                            <div class="p-msg"><div class="p-name"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" title="<?php echo $this->_var['goods']['goods_name']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></div></div>
                            </div>
                            <div class="goods-number">x<?php echo $this->_var['goods']['goods_number']; ?></div>
                            <div class="goods-repair"><div><?php echo $this->_var['goods']['goods_attr']; ?></div></div>
                            <div class="jclr"></div>
                            </td>
                            <?php if (($this->_foreach['foo']['iteration'] <= 1)): ?>
                            <td rowspan="<?php echo $this->_foreach['foo']['total']; ?>"><div class='consignee tooltip'><span class="ctxt" value="<?php echo $this->_var['item']['order_id']; ?>"><?php echo $this->_var['item']['consignee']; ?></span><b></b>
                            <div class="prompt-01 prompt-02" style="display:none" id="consignee_<?php echo $this->_var['item']['order_id']; ?>">
                            <div class="pc"><strong><?php echo $this->_var['item']['consignee']; ?></strong><p><?php echo $this->_var['item']['region']; ?></p><p><?php echo $this->_var['item']['mobile']; ?></p></div>
                            <div class="p-arrow p-arrow-left"></div>
                            </div>
                            </div></td>
                            <td rowspan="<?php echo $this->_foreach['foo']['total']; ?>"><div class="amount"><span><?php echo $this->_var['item']['total_fee']; ?></span><br/><strong>应付</strong><br/><strong><?php echo $this->_var['item']['total_fee']; ?></strong><br/><span class="ftx-13"><?php echo $this->_var['item']['pay_name']; ?></span></div></td>
                            <td rowspan="<?php echo $this->_foreach['foo']['total']; ?>"><div class="status"><?php echo $this->_var['item']['order_status']; ?><br/><div class="tooltip"><i class="auto-icon"></i><a href="<?php if ($this->_var['item']['shipping_status'] == '1'): ?>user.php?act=track_packages<?php else: ?>javascript:;<?php endif; ?>" value="<?php echo $this->_var['item']['order_id']; ?>" class="track_packages_div">跟踪</a><i class="circle-icon"></i>
                            <div class="prompt-01" style="display:none;" id="track_packages_<?php echo $this->_var['item']['order_id']; ?>">
                            <div class="pc">
                            <div class="p-tit"><?php echo $this->_var['item']['shipping_name']; ?></div>
                            <div class="logistics-cont">
                            <ul>
                            <?php if ($this->_var['item']['is_presell']): ?>
                             <li class="first"><i class="node-icon"></i><a>此订单为预售商品，预计10-15个工作日内发货</a><div class="ftx-13"></div></li>
                            <?php endif; ?>
                            <li class="first"><i class="node-icon"></i><a>您提交了订单，请等待系统确认</a><div class="ftx-13"><?php echo $this->_var['item']['order_time']; ?></div></li>
                            <?php if ($this->_var['item']['done_stauts'] == 400): ?>
                            <li class="first"><i class="node-icon"></i><a>您已申请退货，具体细节查看售后服务</a><div class="ftx-13"><?php echo $this->_var['item']['shipping_time']; ?></div></li>
                            <?php else: ?>
                            <?php if ($this->_var['item']['shipping_time']): ?>
                            <li class="first"><i class="node-icon"></i><a>商家已经发货，请您保持电话畅通</a><div class="ftx-13"><?php echo $this->_var['item']['shipping_time']; ?></div></li>
                            <?php endif; ?>
                            <?php if ($this->_var['item']['done_stauts'] == '122'): ?>
                            <li class="first"><i class="node-icon"></i><a>您已确认收货，此订单已经完成</a><div class="ftx-13"></div></li>
                            <?php endif; ?>
                            <?php endif; ?>
                            </ul>
                            </div>
                            </div>
                            <div class="p-arrow p-arrow-left"></div>
                            </div>
                            </div><a href="order_item-<?php echo $this->_var['item']['order_id']; ?>.html">订单详情</a></div></td>
                            <td rowspan="<?php echo $this->_foreach['foo']['total']; ?>"><div class="operate"><font class="f6"><?php echo $this->_var['item']['handler']; ?></font><?php if ($this->_var['item']['msg_id']): ?><?php if ($this->_var['item']['msg_status'] == 0): ?> <a href="user.php?act=service_list"> 已提交售后</a><?php elseif ($this->_var['item']['msg_status'] == 3): ?><a href="user.php?act=view_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>&order_id=<?php echo $this->_var['item']['order_id']; ?>"> 售后完成</a><?php else: ?><a href="user.php?act=view_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>&order_id=<?php echo $this->_var['item']['order_id']; ?>"> 售后中&nbsp;&nbsp;&nbsp;</a><?php endif; ?><?php else: ?><?php if ($this->_var['item']['done_stauts'] == '122'): ?> <a href="user.php?act=service_repair&order_id=<?php echo $this->_var['item']['order_id']; ?>">申请售后</a><?php endif; ?><?php endif; ?></div></td>
                            <?php endif; ?>
                            </tr>
                            
                             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr class="sep-row"><td colspan="5"></td></tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </table>
                          <div class="blank5"></div>
                         <?php echo $this->fetch('library/pages.lbi'); ?>
                         <div class="blank5"></div>
                         </div>
                         <?php endif; ?>
                        
                        
                        <?php if ($this->_var['action'] == 'merge_order_ui'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt">
                         <h3><?php echo $this->_var['lang']['merge_order']; ?></h3>
                        </div>
                         <div class="merge_order">
                          <script type="text/javascript">
                          <?php $_from = $this->_var['lang']['merge_order_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          </script>
                          <div class="mt"><h3><?php echo $this->_var['lang']['merge_order_notice']; ?></h3></div>
                          <div class='mc'>
                          <form action="user.php" method="post" name="formOrder" onsubmit="return mergeOrder()">
                            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                             
                              <tr>
                                <td width='35%' align="right" bgcolor="#F5F5F5"><?php echo $this->_var['lang']['first_order']; ?>:</td>
                                <td width='65%' align="left" bgcolor="#ffffff"><select name="to_order">
                                <option value="0"><?php echo $this->_var['lang']['select']; ?></option>

                                    <?php echo $this->html_options(array('options'=>$this->_var['merge'])); ?>

                                  </select></td>
                                
                                
                              </tr>
                              <tr>
                              <td  align="right" bgcolor="#F5F5F5"><?php echo $this->_var['lang']['second_order']; ?>:</td>
                               <td  align="left" bgcolor="#ffffff"><select name="from_order">
                                <option value="0"><?php echo $this->_var['lang']['select']; ?></option>

                                    <?php echo $this->html_options(array('options'=>$this->_var['merge'])); ?>

                                  </select></td>
                              </tr>
                              <tr>
                              <td  bgcolor="#ffffff" colspan='2' align="center">&nbsp;<input name="act" value="merge_order" type="hidden" />
                                <input type="submit" name="Submit"  class="get_passbtn"  value="<?php echo $this->_var['lang']['merge_order']; ?>" /></td>
                              </tr>
                            </table>
                          </form>
                          </div>
                          </div>
                          </div>
                        <?php endif; ?>
                        
                        
                        <?php if ($this->_var['action'] == 'service_repair'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt">
                        <h3><?php echo $this->_var['lang']['label_service_repair']; ?></h3>
                        </div>
                        <div class="blank"></div>
                        <div class="mc">
                        <form action="user.php" method="post" enctype="multipart/form-data" name="formService" onSubmit="return submitService()" autocomplete="off">
                                  <table width="100%" border="0" cellpadding="3" bgcolor="#dddddd">
                                    <?php if ($this->_var['order_info']): ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
                                      <td bgcolor="#ffffff">
                                      <a href ="<?php echo $this->_var['order_info']['url']; ?>"><img src="themes/default/images/note.gif" /><?php echo $this->_var['order_info']['order_sn']; ?></a>
                                      <input name="msg_type" type="hidden" value="5" />
                                      <input name="order_id" type="hidden" value="<?php echo $this->_var['order_info']['order_id']; ?>" class="inputBg" />
                                      </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['service_type']; ?>：</td>
                                      <td bgcolor="#ffffff">
                                      <?php $_from = $this->_var['service_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'type');$this->_foreach['type_item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['type_item']['total'] > 0):
    foreach ($_from AS $this->_var['type']):
        $this->_foreach['type_item']['iteration']++;
?>
                                      <input name="service_type" type="radio" id='service_type_<?php echo $this->_var['type']['id']; ?>' value="<?php echo $this->_var['type']['id']; ?>" <?php if ($this->_var['service_type_id'] == $this->_var['type']['id']): ?> checked='checked'<?php endif; ?> onclick='get_service(<?php echo $this->_var['type']['id']; ?>,<?php echo $this->_var['order']['order_id']; ?>)'/>
                                      <?php echo $this->_var['type']['service_type']; ?>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
                                         </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_sn']; ?>：</td>
                                      <td bgcolor="#ffffff"><a href="user.php?act=order_detail&amp;order_id=<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['order']['order_sn']; ?></a></td>
                                      <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>"/>
                                    </tr>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['need_service_good']; ?>：</td>
                                      <td bgcolor="#ffffff">
                                      <?php $_from = $this->_var['order_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');if (count($_from)):
    foreach ($_from AS $this->_var['good']):
?>
                                      <li><input type="checkbox" name="service_good[]" value="<?php echo $this->_var['good']['goods_id']; ?>"><?php echo $this->_var['good']['goods_name']; ?></li>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                     </td>
                                    </tr>
                                    <?php if ($this->_var['guzhang']): ?>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_type']; ?>：</td>
                                      <td bgcolor="#ffffff"><select name="fault_type" class="repair_select">
                                      <?php $_from = $this->_var['guzhang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                      <option value="<?php echo $this->_var['item']['cat_id']; ?>"><?php echo $this->_var['item']['cat_name']; ?></option>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select></td>
                                    </tr>
                                    <tr >
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_title']; ?>：</td>
                                      <td bgcolor="#ffffff"><input name="fault_title" type="text" size="30" class="repair_itxt" /></td>
                                    </tr>
                                    <tr >
                                      <td align="right" valign="top" bgcolor="#ffffff"><?php echo $this->_var['lang']['failure_phenomena']; ?>：</td>
                                      <td bgcolor="#ffffff"><textarea name="fault_content" cols="50" rows="4" wrap="virtual" class="textarea-re"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['welcome_to_upload_img']; ?>：</td>
                                      <td bgcolor="#ffffff"><input type="file" name="service_img"  size="45"  class="inputBg" /></td>
                                    </tr>
                                    
                                    <?php elseif ($this->_var['huanhuo']): ?>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_reason']; ?>：</td>
                                      <td bgcolor="#ffffff"><select name="fault_type" onchange='change_reason(this.value,<?php echo $this->_var['service_type_id']; ?>)' id="fault_type" class="repair_select">
                                      <?php $_from = $this->_var['huanhuo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                      <option value="<?php echo $this->_var['item']['cat_id']; ?>"><?php echo $this->_var['item']['cat_name']; ?></option>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select><span style="color:red"> 提示： 选择无理由退换货需要支付上门费用</span></td>
                                    </tr>
                                          
                                    <tr id="fault_title" style="display:none">
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_title']; ?>：</td>
                                      <td bgcolor="#ffffff"><input name="fault_title" type="text" size="30" class="repair_itxt" /></td>
                                    </tr>
                                    <tr id="failure_phenomena"style="display:none">
                                      <td align="right" valign="top" bgcolor="#ffffff"><?php echo $this->_var['lang']['failure_phenomena']; ?>：</td>
                                      <td bgcolor="#ffffff"><textarea name="fault_content" cols="50" rows="4" wrap="virtual" class="textarea-re"></textarea></td>
                                    </tr>
                                    <tr id="service_img" style="display:none">
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['welcome_to_upload_img']; ?>：</td>
                                      <td bgcolor="#ffffff"><input type="file" name="service_img"  size="45"  class="inputBg" /></td>
                                    </tr>
                                    <?php elseif ($this->_var['tuihuo']): ?>
                                    <tr>
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_reason']; ?>：</td>
                                      <td bgcolor="#ffffff"><select name="fault_type" onchange='change_reason(this.value,<?php echo $this->_var['service_type_id']; ?>)' id="fault_type" class="repair_select">
                                      <?php $_from = $this->_var['tuihuo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                      <option value="<?php echo $this->_var['item']['cat_id']; ?>"><?php echo $this->_var['item']['cat_name']; ?></option>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select><span style="color:red"> 提示： 选择无理由退换货需要支付上门费用</span></td>
                                    </tr>
                                    <tr id="fault_title" style="display:none">
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_title']; ?>：</td>
                                      <td bgcolor="#ffffff"><input name="fault_title" type="text" size="30" class="repair_itxt" /></td>
                                    </tr>
                                    <tr id="failure_phenomena"style="display:none">
                                      <td align="right" valign="top" bgcolor="#ffffff"><?php echo $this->_var['lang']['failure_phenomena']; ?>：</td>
                                      <td bgcolor="#ffffff"><textarea name="fault_content" cols="50" rows="4" wrap="virtual" class="textarea-re"></textarea></td>
                                    </tr>
                                    <tr id="service_img" style="display:none">
                                      <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['welcome_to_upload_img']; ?>：</td>
                                      <td bgcolor="#ffffff"><input type="file" name="service_img"  size="45"  class="inputBg" /></td>
                                    </tr>
                                    <?php endif; ?>       
                                    <tr>
                                      <td bgcolor="#ffffff">&nbsp;</td>
                                      <td bgcolor="#ffffff"><input type="hidden" name="act" value="submit_service" />
                                        <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="get_passbtn" />
                                      </td>
                                    </tr>
                                   
                                  </table>
                                </form>
                                </div>
                         </div>
                        <?php endif; ?>
                        
                        
                        <?php if ($this->_var['action'] == 'user_payment'): ?>
                        <h5><span><?php echo $this->_var['lang']['noreason_topay']; ?></span></h5>
                        <div class="blank"></div>
                        <form action="user.php" method='post' enctype="multipart/form-data" name="formMsg"> 
                         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                         <tr>
                            <td width="15%" align="right" bgcolor="#ffffff">付费项目：</td>
                            <td align="left" bgcolor="#ffffff">订单 <font color=red><?php echo $this->_var['order']['order_sn']; ?></font> 的<?php echo $this->_var['cat_info']['cat_name']; ?></td>
                         </tr>
                         <tr>
                            <td width="15%" align="right" bgcolor="#ffffff">支付上门费用：</td>
                            <td align="left" bgcolor="#ffffff">￥<?php echo $this->_var['cat_info']['cat_price']; ?>元</td>
                         </tr>
                         </table>
                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="mt30 update_tab">
                              <tr align="center">
                                <td bgcolor="#ffffff"  colspan="3" align="left">支付方式:</td>
                              </tr>
                              <tr align="center">
                                <td bgcolor="#ffffff">名称</td>
                                <td bgcolor="#ffffff" width="60%">描述</td>
                                <td bgcolor="#ffffff" width="17%">手续费</td>
                              </tr>
                              <?php $_from = $this->_var['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                              <tr>
                                <td bgcolor="#ffffff" align="left">
                                <input type="radio" name="payment_id" value="<?php echo $this->_var['list']['pay_id']; ?>" /><?php echo $this->_var['list']['pay_name']; ?></td>
                                <td bgcolor="#ffffff" align="left"><?php echo $this->_var['list']['pay_desc']; ?></td>
                                <td bgcolor="#ffffff" align="center"><?php echo $this->_var['list']['pay_fee']; ?></td>
                              </tr>
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                              <tr>
                          <td bgcolor="#ffffff" colspan="3"  align="center">
                            <input type="hidden" name="cat_id" value="<?php echo $this->_var['cat_info']['cat_id']; ?>">
                            <input type="hidden" name="act" value="update">
                            <input type="submit" value="提 交" class="bnt_bonus">
                          </td>
                        </tr>
                      </table>
                        </form>
                        <?php endif; ?>
                        <?php if ($this->_var['action'] == 'update'): ?>
                        <h5><span><?php echo $this->_var['lang']['noreason_topay']; ?></span></h5>
                        <div class="blank"></div>
                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class=" update_tab">
                        <tr>
                          <td width="25%" align="right" bgcolor="#ffffff">支付费用为：</td>
                          <td width="80%" bgcolor="#ffffff"><?php echo $this->_var['amount']; ?></td>
                        </tr>
                        <tr>
                          <td align="right" bgcolor="#ffffff">您选择的支付方式为：</td>
                          <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_name']; ?></td>
                        </tr>
                        <tr>
                          <td align="right" bgcolor="#ffffff">支付手续费用为：</td>
                          <td bgcolor="#ffffff"><?php echo $this->_var['pay_fee']; ?></td>
                        </tr>
                        <tr>
                          <td align="right" valign="middle" bgcolor="#ffffff">支付方式描述：</td>
                          <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_desc']; ?></td>
                        </tr>
                        <tr>
                          <td colspan="2" bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_button']; ?></td>
                        </tr>
                      </table>
                        <?php endif; ?>
                        
                        
                        <?php if ($this->_var['action'] == 'service_list'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt">
                         <h3><?php echo $this->_var['lang']['my_application']; ?></h3>
                        </div>
                         <div class="blank"></div>
                         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr align="center">
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
                              <td bgcolor="#ffffff">申请时间</td>
                              <td bgcolor="#ffffff">申请标题</td>
                              <td bgcolor="#ffffff">申请类型</td>
                              <td bgcolor="#ffffff">申请状态</td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                            </tr>
                            <?php $_from = $this->_var['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                            <tr>
                              <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="f6"><?php echo $this->_var['item']['order_sn']; ?></a></td>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['msg_time']; ?></td>
                              <td align="right" bgcolor="#ffffff"><?php echo sub_str($this->_var['item']['msg_title'],'15'); ?></td>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['service_type']; ?></td>
                              <?php if ($this->_var['item']['msg_type'] == 1): ?>
                              <td align="center" bgcolor="#ffffff"><?php if ($this->_var['item']['msg_status'] == 0): ?>等待申请处理，请耐心等待<?php elseif ($this->_var['item']['msg_status'] == 1): ?>已确认申请<?php elseif ($this->_var['item']['msg_status'] == 2): ?>已确认维修时间<?php else: ?>已完成<?php endif; ?></td>
                               <td align="center" bgcolor="#ffffff"><?php if ($this->_var['item']['msg_status'] == 0): ?><a href="user.php?act=view_service&step=edit&msg_id=<?php echo $this->_var['item']['msg_id']; ?>&order_id=<?php echo $this->_var['item']['order_id']; ?>">修改</a>  <a href="user.php?act=drop_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>" onclick="if (!confirm('你确实要彻底删除这条申请吗？')) return false;">删除</a><?php else: ?><a href="user.php?act=view_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>&order_id=<?php echo $this->_var['item']['order_id']; ?>">查看</a><?php endif; ?></td>
                              <?php elseif ($this->_var['item']['msg_type'] == 2 || $this->_var['item']['msg_type'] == 3): ?>
                              <td align="center" bgcolor="#ffffff"><?php if ($this->_var['item']['msg_status'] == 0): ?>等待申请处理，请耐心等待<?php elseif ($this->_var['item']['msg_status'] == 1): ?>已确认申请<?php elseif ($this->_var['item']['msg_status'] == 2): ?>已确认换货时间<?php else: ?>已完成<?php endif; ?></td>
                              <td align="center" bgcolor="#ffffff"><?php if ($this->_var['item']['msg_status'] == 0): ?><a href="user.php?act=view_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>&order_id=<?php echo $this->_var['item']['order_id']; ?>">查看</a>  <a href="user.php?act=drop_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>" onclick="if (!confirm('你确实要彻底删除这条申请吗？')) return false;">删除</a><?php else: ?><a href="user.php?act=view_service&msg_id=<?php echo $this->_var['item']['msg_id']; ?>&order_id=<?php echo $this->_var['item']['order_id']; ?>">查看</a><?php endif; ?></td>
                              <?php endif; ?>
                              
                             
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </table>
                          <div class="blank5"></div>
                         <?php echo $this->fetch('library/pages.lbi'); ?>
                         <div class="blank5"></div>
                        </div>
                        <?php endif; ?>
                        
                        
                        <?php if ($this->_var['action'] == 'view_service'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt">
                        <h3><?php echo $this->_var['lang']['my_application']; ?></h3>
                        </div>
                        <div class="blank"></div>
                        <div class="mc">
                        <form action="user.php" method="post" enctype="multipart/form-data" name="formService" onSubmit="return submitService()">
                        <?php if ($this->_var['msg']['msg_status'] == 0): ?>
                        <input type="hidden" name="step" value="edit"/>
                        <?php endif; ?>
                                  <table width="100%" border="0" cellpadding="3" bgcolor="#dddddd">
                                    <?php if ($this->_var['order_info']): ?>
                                    <tr>
                                      <td align="right"><?php echo $this->_var['lang']['order_number']; ?></td>
                                      <td>
                                      <a href ="<?php echo $this->_var['order_info']['url']; ?>"><img src="themes/default/images/note.gif" /><?php echo $this->_var['order_info']['order_sn']; ?></a>
                                      <input name="msg_type" type="hidden" value="5" />
                                      <input name="order_id" type="hidden" value="<?php echo $this->_var['order_info']['order_id']; ?>" class="inputBg" />
                                      </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['service_type']; ?>：</td>
                                      <td  bgcolor="#ffffff">
									  <?php if ($this->_var['service_info']['msg_type'] == 1): ?>
                                      <input name="service_type" type="radio" value="<?php echo $this->_var['service_info']['msg_type']; ?>"  <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> checked/>
                                                                                                维修
                                      <?php elseif ($this->_var['service_info']['msg_type'] == 2): ?>
                                       <input name="service_type" type="radio" value="<?php echo $this->_var['service_info']['msg_type']; ?>"  <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> checked/>
                                                                                                 换货                                                         
                                      <?php else: ?>
                                      <input name="service_type" type="radio" value="<?php echo $this->_var['service_info']['msg_type']; ?>"  <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> checked/>
                                                                                                 退货 
                                      <?php endif; ?>  
                                         </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_sn']; ?>：</td>
                                      <td bgcolor="#ffffff"><a href="user.php?act=order_detail&amp;order_id=<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['order']['order_sn']; ?></a></td>
                                      <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>"/>
                                    </tr>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['need_service_good']; ?>：</td>
                                      <td bgcolor="#ffffff">
                                      <?php $_from = $this->_var['service_info']['good_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');if (count($_from)):
    foreach ($_from AS $this->_var['good']):
?>
                                      <li><input type="checkbox" name="service_good[]" value="<?php echo $this->_var['good']['goods_id']; ?>" <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> checked><?php echo $this->_var['good']['goods_name']; ?></li>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </td>
                                    </tr>
                                    <?php if ($this->_var['service_info']['guzhang'] == 11 || $this->_var['service_info']['guzhang'] == 13): ?>
                                    <?php if ($this->_var['service_info']['is_payment'] == 0): ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</td>
                                      <td  bgcolor="#ffffff">
                                      <?php echo $this->_var['lang']['ps']['0']; ?>
                                      
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_method']; ?>：</td>
                                      <td  bgcolor="#ffffff">
                                      <?php echo $this->_var['service_info']['pay_online']; ?>
                                      </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr >
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</td>
                                      <td  bgcolor="#ffffff">
                                      <?php echo $this->_var['lang']['ps']['2']; ?>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($this->_var['guzhang']): ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_type']; ?>：</td>
                                      <td bgcolor="#ffffff"><select name="fault_type" <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> class="repair_select">
                                      <?php $_from = $this->_var['guzhang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                      <option value="<?php echo $this->_var['item']['cat_id']; ?>" <?php if ($this->_var['service_info']['guzhang'] == $this->_var['item']['cat_id']): ?>selected<?php endif; ?>><?php echo $this->_var['item']['cat_name']; ?></option>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select></td>
                                    </tr>
                                    <?php elseif ($this->_var['huanhuo']): ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_reason']; ?>：</td>
                                      <td  bgcolor="#ffffff"><select name="fault_type" onchange='change_reason(this.value)' id="fault_type" <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> class="repair_select">
                                      <?php $_from = $this->_var['huanhuo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                      <option value="<?php echo $this->_var['item']['cat_id']; ?>" <?php if ($this->_var['service_info']['guzhang'] == $this->_var['item']['cat_id']): ?>selected<?php endif; ?>><?php echo $this->_var['item']['cat_name']; ?></option>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select></td>
                                    </tr>
                                    <?php elseif ($this->_var['tuihuo']): ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_reason']; ?>：</td>
                                      <td  bgcolor="#ffffff"><select name="fault_type" onchange='change_reason(this.value)' id="fault_type" <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?> class="repair_select">
                                      <?php $_from = $this->_var['tuihuo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                                      <option value="<?php echo $this->_var['item']['cat_id']; ?>" <?php if ($this->_var['service_info']['guzhang'] == $this->_var['item']['cat_id']): ?>selected<?php endif; ?>><?php echo $this->_var['item']['cat_name']; ?></option>
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['fault_title']; ?>：</td>
                                      <td  bgcolor="#ffffff"><input name="fault_title" type="text" size="30" class="repair_itxt" value="<?php echo $this->_var['service_info']['msg_title']; ?>" <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?>/></td>
                                    </tr>
                                    <tr>
                                      <td align="right" valign="top"  bgcolor="#ffffff"><?php echo $this->_var['lang']['failure_phenomena']; ?>：</td>
                                      <td  bgcolor="#ffffff"><textarea name="fault_content" cols="50" rows="4" wrap="virtual" class="textarea-re" <?php if ($this->_var['stauts'] != 'edit'): ?>disabled<?php endif; ?>><?php echo $this->_var['service_info']['msg_content']; ?></textarea></td>
                                    </tr>
                                    <?php if ($this->_var['stauts'] == 'edit'): ?>
                                    <tr>
                                      <td align="right"  bgcolor="#ffffff"><?php echo $this->_var['lang']['welcome_to_upload_img']; ?>：</td>
                                      <td bgcolor="#ffffff"><input type="file" name="service_img"  size="45"  class="inputBg" /><?php if ($this->_var['service_info']['service_img']): ?><?php echo $this->_var['lang']['warn_service_img']; ?><a href="<?php echo $this->_var['service_info']['service_img']; ?>" target="_blank"><img src="<?php echo $this->_var['service_info']['service_img']; ?>" width="60"/></a><?php endif; ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($this->_var['stauts'] == 'edit'): ?>
                                    <tr>
                                      <td  bgcolor="#ffffff">&nbsp;</td>
                                      <td  bgcolor="#ffffff">
                                      
                                      <input type="hidden" name="act" value="update_service" />
                                      <input type="hidden" name="msg_id" value="<?php echo $this->_var['service_info']['msg_id']; ?>" />
                                      <input type="submit" value="更新" class="get_passbtn" />
                                      </td>
                                    </tr>
                                    
                                     <?php elseif ($this->_var['service_info']['msg_status'] == '1'): ?>
                                      <tr>
                                      <td align="right" valign="top"  bgcolor="#ffffff"><?php echo $this->_var['lang']['service_status']; ?>：</td>
                                      <td bgcolor="#ffffff"><?php echo $this->_var['service_info']['service_confirm_text']; ?></td>
                                    </tr>
                                     <?php elseif ($this->_var['service_info']['msg_status'] == '2'): ?>
                                     <tr>
                                      <td align="right" valign="top"  bgcolor="#ffffff"><?php echo $this->_var['lang']['confirm_time_span']; ?>：</td>
                                      <td  bgcolor="#ffffff"><?php echo $this->_var['service_info']['reply_time']; ?></td>
                                    <tr>
                                    <tr>
                                      <td align="right" valign="top"  bgcolor="#ffffff"><?php echo $this->_var['lang']['service_reply']; ?>：</td>
                                      <td  bgcolor="#ffffff"><?php echo $this->_var['service_info']['reply']; ?></td>
                                    <tr>
                                      <td  bgcolor="#ffffff">&nbsp;</td>
                                      <td  bgcolor="#ffffff">
                                      <input type="hidden" name="act" value="confirm_service" />
                                      <input type="hidden" name="msg_id" value="<?php echo $this->_var['service_info']['msg_id']; ?>" />
                                      <input type="hidden" name="msg_type" value="<?php echo $this->_var['service_info']['msg_type']; ?>"/>
                                      <input type="hidden" name="order_id" value="<?php echo $this->_var['service_info']['order_id']; ?>"/>
                                      <?php if ($this->_var['service_info']['msg_type'] == '1'): ?>
                                      <input type="submit" value="确认维修完毕" class="get_passbtn" />
                                      <?php elseif ($this->_var['service_info']['msg_type'] == '2'): ?>
                                      <input type="submit" value="确认换货完毕" class="get_passbtn" />
                                      <?php elseif ($this->_var['service_info']['msg_type'] == '3'): ?>
                                      <input type="submit" value="确认退货完毕" class="get_passbtn" />
                                      <?php endif; ?>
                                      </td>
                                    </tr>
                                     <?php elseif ($this->_var['service_info']['msg_status'] == '3'): ?>
                                      <tr>
                                      <td align="right" valign="top"  bgcolor="#ffffff"><?php echo $this->_var['lang']['service_status']; ?>：</td>
                                      <td  bgcolor="#ffffff">此售后已经处理完毕，时间为： <?php echo $this->_var['service_info']['msg_time']; ?></td>
                                      </tr>
                                     <?php endif; ?>
                                    
                                  </table>
                                </form>
                                </div>
                        </div>
                        <?php endif; ?>
                        
                         
                        <?php if ($this->_var['action'] == 'track_packages'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt">
                          <h3><?php echo $this->_var['lang']['label_track_packages']; ?></h3>
                        </div>
                          <div class="blank"></div>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="order_table">
                          <tr align="center">
                            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
                            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                          </tr>
                          <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                          <tr>
                            <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>"><?php echo $this->_var['item']['order_sn']; ?></a></td>
                            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['query_link']; ?></td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        </table>
                        <script>
                        var query_status = '<?php echo $this->_var['lang']['query_status']; ?>';
                        var ot = document.getElementById('order_table');
                        for (var i = 1; i < ot.rows.length; i++)
                        {
                          var row = ot.rows[i];
                          var cel = row.cells[1];
                          cel.getElementsByTagName('a').item(0).innerHTML = query_status;
                        }
                        </script>
                        <div class="blank5"></div>
                        <?php echo $this->fetch('library/pages.lbi'); ?>
                        </div>
                        <?php endif; ?>
                      
                       
                        <?php if ($this->_var['action'] == order_detail): ?>
                        <?php if ($this->_var['order']['order_status'] == '已取消'): ?>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['order_status']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                          <tr>
                            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_sn']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_sn']; ?>
                            <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?>
                            <a href="./group_buy.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_group_buy']; ?></strong></a>
                            <?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
                            <a href="./exchange.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_exchange']; ?></strong></a>
                            <?php endif; ?>  
                            <a href="user.php?act=message_list&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="f6">[<?php echo $this->_var['lang']['business_message']; ?>]</a>
                            </td>
                          </tr>
                          <?php if ($this->_var['order']['is_presell']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff  " style="color: #0374d9;">预售订单：</td>
                            <td align="left" bgcolor="#ffffff  " class="ftx-01">预计10-15个工作日内发货！请耐心等待</td>
                          </tr>
                          <?php endif; ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['confirm_time']; ?></td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['pay_time']; ?></td>
                          </tr>
                          <?php if ($this->_var['order']['order_amount'] > 0): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_method']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php if ($this->_var['order']['order_amount'] > 0): ?><?php echo $this->_var['order']['pay_online']; ?><?php endif; ?></td>
                          </tr>
                          <?php endif; ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_shipping_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['shipping_time']; ?></td>
                          </tr>
                          <?php if ($this->_var['order']['invoice_no']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignment']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['invoice_no']; ?></td>
                          </tr>
                          <?php if ($this->_var['order']['shipping_id'] == 14): ?>
                          <?php $_from = $this->_var['self_delivery_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'self_delivery');if (count($_from)):
    foreach ($_from AS $this->_var['self_delivery']):
?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['self_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['self_delivery']['self_delivery_time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['self_delivery']['self_delivery_person']; ?>&nbsp;&nbsp;&nbsp;&nbsp<?php echo $this->_var['self_delivery']['status_type']; ?></td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          <?php endif; ?>
                          <?php endif; ?>
                          <?php if ($this->_var['order']['to_buyer']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_to_buyer']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['to_buyer']; ?></td>
                          </tr>
                          <?php endif; ?>

                          <?php if ($this->_var['virtual_card']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['virtual_card_info']; ?>：</td>
                            <td colspan="3" align="left" bgcolor="#ffffff">
                            <?php $_from = $this->_var['virtual_card']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vgoods');if (count($_from)):
    foreach ($_from AS $this->_var['vgoods']):
?>
                              <?php $_from = $this->_var['vgoods']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
                                <?php if ($this->_var['card']['card_sn']): ?><?php echo $this->_var['lang']['card_sn']; ?>:<span style="color:red;"><?php echo $this->_var['card']['card_sn']; ?></span><?php endif; ?>
                                <?php if ($this->_var['card']['card_password']): ?><?php echo $this->_var['lang']['card_password']; ?>:<span style="color:red;"><?php echo $this->_var['card']['card_password']; ?></span><?php endif; ?>
                                <?php if ($this->_var['card']['end_date']): ?><?php echo $this->_var['lang']['end_date']; ?>:<?php echo $this->_var['card']['end_date']; ?><?php endif; ?><br />
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </td>
                          </tr>
                          <?php endif; ?>
                        </table>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['goods_list']; ?></h3>
                        <?php if ($this->_var['allow_to_cart']): ?>
                        <div class="extra-r">
                          <a href="javascript:;" onclick="returnToCart(<?php echo $this->_var['order']['order_id']; ?>)" class="f6"><?php echo $this->_var['lang']['return_to_cart']; ?></a>
                        </div>
                          <?php endif; ?>
                        </div>
                        <div class='mc'>
                        
                        <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <th width="23%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_name']; ?></th>
                              <th width="29%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                              <!--<th><?php echo $this->_var['lang']['market_price']; ?></th>-->
                              <th width="26%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?></th>
                              <th width="9%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['number']; ?></th>
                              <th width="20%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['subtotal']; ?></th>
                            </tr>
                            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                            <tr>
                              <td bgcolor="#ffffff">
                                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                                  <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                                  <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
                                  <?php elseif ($this->_var['goods']['is_gift']): ?>
                                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                                  <?php endif; ?>
                                <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                                  <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（礼包）</span></a>
                                  <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                                      <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                                        <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  </div>
                                <?php endif; ?>
                                </td>
                              <td align="left" bgcolor="#ffffff"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                              <!--<td align="right"><?php echo $this->_var['goods']['market_price']; ?></td>-->
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_price']; ?></td>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_number']; ?></td>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['subtotal']; ?></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr>
                              <td colspan="8" bgcolor="#ffffff" align="right">
                              <?php echo $this->_var['lang']['shopping_money']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
                              </td>
                            </tr>
                          </table>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['fee_total']; ?></h3></div>
                        <div class="mc">
                         <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <td align="right" bgcolor="#ffffff">
                                  <?php echo $this->_var['lang']['goods_all_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
                                <?php if ($this->_var['order']['discount'] > 0): ?>
                                - <?php echo $this->_var['lang']['discount']; ?>: <?php echo $this->_var['order']['formated_discount']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['tax'] > 0): ?>
                                + <?php echo $this->_var['lang']['tax']; ?>: <?php echo $this->_var['order']['formated_tax']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['shipping_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['shipping_fee']; ?>: <?php echo $this->_var['order']['formated_shipping_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['insure_fee']; ?>: <?php echo $this->_var['order']['formated_insure_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['pay_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['pay_fee']; ?>: <?php echo $this->_var['order']['formated_pay_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['pack_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['pack_fee']; ?>: <?php echo $this->_var['order']['formated_pack_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['card_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['card_fee']; ?>: <?php echo $this->_var['order']['formated_card_fee']; ?>
                                <?php endif; ?>        </td>
                            </tr>
                            <tr>
                              <td align="right" bgcolor="#ffffff">
                                <?php if ($this->_var['order']['money_paid'] > 0): ?>
                                - <?php echo $this->_var['lang']['order_money_paid']; ?>: <?php echo $this->_var['order']['formated_money_paid']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['surplus'] > 0): ?>
                                - <?php echo $this->_var['lang']['use_surplus']; ?>: <?php echo $this->_var['order']['formated_surplus']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['integral_money'] > 0): ?>
                                - <?php echo $this->_var['lang']['use_integral']; ?>: <?php echo $this->_var['order']['formated_integral_money']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['bonus'] > 0): ?>
                                - <?php echo $this->_var['lang']['use_bonus']; ?>: <?php echo $this->_var['order']['formated_bonus']; ?>
                                <?php endif; ?>        </td>
                            </tr>
                            <tr>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_amount']; ?>: <?php echo $this->_var['order']['formated_order_amount']; ?>
                              <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><br />
                              <?php echo $this->_var['lang']['notice_gb_order_amount']; ?><?php endif; ?></td>
                            </tr>
                              <?php if ($this->_var['allow_edit_surplus']): ?>
                            <tr>
                              <td align="right" bgcolor="#ffffff">
                        <form action="user.php" method="post" name="formFee" id="formFee"><?php echo $this->_var['lang']['use_more_surplus']; ?>:
                              <input name="surplus" type="text" size="8" value="0" style="border:1px solid #ccc;"/><?php echo $this->_var['max_surplus']; ?>
                              <input type="submit" name="Submit" class="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                        <input type="hidden" name="act" value="act_edit_surplus" />
                        <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
                        </form></td>
                            </tr>
                      <?php endif; ?>
                          </table>
                        </div>
                        </div>
                        <div class='mod-main mod-comm'>
                        <div class="mt"><h3><?php echo $this->_var['lang']['consignee_info']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                           <?php if ($this->_var['order']['allow_update_address'] > 0): ?>
                            <form action="user.php" method="post" name="formAddress" id="formAddress">
                             <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                <tr>
                                  <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>： </td>
                                  <td width="35%" align="left" bgcolor="#ffffff"><input name="consignee" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['consignee']); ?>" size="25">
                                  </td>
                                  <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>： </td>
                                  <td width="35%" align="left" bgcolor="#ffffff"><input name="email" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['email']); ?>" size="25" />
                                  </td>
                                </tr>
                                <?php if ($this->_var['order']['exist_real_goods']): ?>
                                
                                <tr>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>： </td>
                                  <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['address']); ?> " size="25" /></td>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['zipcode']); ?>" size="25" /></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['tel']); ?>" size="25" /></td>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="mobile" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['mobile']); ?>" size="25" /></td>
                                </tr>
                                <?php if ($this->_var['order']['exist_real_goods']): ?>
                                
                                <tr>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="sign_building" class="inputBg" type="text" value="<?php echo htmlspecialchars($this->_var['order']['sign_building']); ?>" size="25" />
                                  </td>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="best_time" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['best_time']); ?>" size="25" />
                                  </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                  <td colspan="4" align="center" bgcolor="#ffffff"><input type="hidden" name="act" value="save_order_address" />
                                    <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                    <input type="submit" class="bnt_blue_2" value="<?php echo $this->_var['lang']['update_address']; ?>"  />
                                  </td>
                                </tr>
                              </table>
                            </form>
                            <?php else: ?>
                            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                              <tr>
                                <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                                <td width="35%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['consignee']; ?></td>
                                <td width="15%" align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['email_address']; ?>：</td>
                                <td width="35%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['email']; ?></td>
                              </tr>
                              <?php if ($this->_var['order']['exist_real_goods']): ?>
                              <tr>
                                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                                <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['address']; ?>
                                  <?php if ($this->_var['order']['zipcode']): ?>
                                  [<?php echo $this->_var['lang']['postalcode']; ?>: <?php echo $this->_var['order']['zipcode']; ?>]
                                  <?php endif; ?></td>
                              </tr>
                              <?php endif; ?>
                              <tr>
                                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['tel']; ?> </td>
                                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['mobile']; ?></td>
                              </tr>
                              <?php if ($this->_var['order']['exist_real_goods']): ?>
                              <tr>
                                <td align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['sign_building']; ?> </td>
                                <td align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['best_time']; ?></td>
                              </tr>
                              <?php endif; ?>
                            </table>
                            <?php endif; ?>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['payment']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                  <tr>
                                    <td bgcolor="#ffffff">
                                    <?php echo $this->_var['lang']['select_payment']; ?>: <?php echo $this->_var['order']['pay_name']; ?>。<?php echo $this->_var['lang']['order_amount']; ?>: <strong><?php echo $this->_var['order']['formated_order_amount']; ?></strong><br />
                                    <?php echo $this->_var['order']['pay_desc']; ?>
                                    </td>
                                  </tr>
                                    <tr>
                                    <td bgcolor="#ffffff" align="right">
                                    <?php if ($this->_var['payment_list']): ?>
                                <form name="payment" method="post" action="user.php">
                                <?php echo $this->_var['lang']['change_payment']; ?>:
                                <select name="pay_id">
                                  <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                                  <option value="<?php echo $this->_var['payment']['pay_id']; ?>">
                                  <?php echo $this->_var['payment']['pay_name']; ?>(<?php echo $this->_var['lang']['pay_fee']; ?>:<?php echo $this->_var['payment']['format_pay_fee']; ?>)
                                  </option>
                                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <input type="hidden" name="act" value="act_edit_payment" />
                                <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                <input type="submit" name="Submit" class="get_passbtn btn-1" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                                </form>
                                <?php endif; ?>
                                    </td>
                                  </tr>
                                </table>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['other_info']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <?php if ($this->_var['order']['shipping_id'] > 0): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['shipping']; ?>：</td>
                              <td colspan="3" width="85%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_name']; ?></td>
                            </tr>
                            <?php endif; ?>

                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_name']; ?></td>
                            </tr>
                            <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['pack_name']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_pack']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pack_name']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['card_name']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_card']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_name']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['card_message']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['bless_note']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_message']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['surplus'] > 0): ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['integral'] > 0): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_integral']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['integral']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['bonus'] > 0): ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['inv_payee'] && $this->_var['order']['inv_content']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_title']; ?>：</td>
                              <td width="36%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_payee']; ?></td>
                              <td width="19%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_content']; ?>：</td>
                              <td width="25%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_content']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['postscript']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_postscript']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['postscript']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_process']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['how_oos_name']; ?></td>
                            </tr>
                          </table>
                        </div>
                        </div>
                        <?php else: ?>
                        <div class="breadcrumb"><a href="user.php"><?php echo $this->_var['lang']['user_center']; ?></a><span>&nbsp;&gt;&nbsp;<a href="user.php?act=order_list"><?php echo $this->_var['lang']['label_order']; ?></a>&nbsp;&gt;&nbsp;<strong>订单：<?php echo $this->_var['order']['order_sn']; ?></strong></span></div>
                        <div class="m order-state order-state01">
                        <?php if ($this->_var['order']['pay_status'] == '未付款' && $this->_var['order']['order_status'] != '退货'): ?>
                        <?php if ($this->_var['order']['pay_id'] == '3'): ?>
                        
                        <?php else: ?>
                        <div class="mc state-cont">
                        <div class="state-lcol"><div class="state-top"><?php echo $this->_var['lang']['detail_order_sn']; ?>：<?php echo $this->_var['order']['order_sn']; ?></div>
                        <h3 class="state-txt ftx-01"><?php echo $this->_var['order']['pay_status']; ?></h3>
                        <div class="state-btns"><a href="user.php?act=order_detail_pay&&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="get_passbtn btn-1">付款</a></div>
                        </div>
                        <div 
                        class="state-rcol">
                        <div class="state-rtop"><div class="ftx-03">该订单会为您保留24小时（从下单之日算起），24小时之后如果还未付款，我们将取消该订单。</div></div>
                        <div class="order-process order-strike-process" id="process-04">
                        <div class="node ready"><i class="node-icon icon-start"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">提交订单</li><li class="txt3"><?php echo $this->_var['order']['formated_add_time']; ?></li></ul></div>
                        <div class="proce doing"><ul><li class="txt1">等待付款</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-pay"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">付款成功</li><li class="txt3"></li></ul></div>
                        <div class="proce wait"><ul><li class="txt1">&nbsp;</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-store"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">商品出库</li><li class="txt3"></li></ul></div>
                        <div class="proce wait"><ul><li class="txt1">&nbsp;</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-express"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">等待收货</li><li class="txt3"></li></ul></div>
                        <div class="proce wait"><ul><li class="txt1">&nbsp;</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-finish"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">完成</li><li class="txt3"></li></ul></div>
                        </div>
                        </div>
                        </div>
                        <?php endif; ?>
                        <?php elseif ($this->_var['order']['pay_status'] == '已付款' && ( $this->_var['order']['shipping_status'] == '未发货' || $this->_var['order']['shipping_status'] == '配货中' )): ?>
                        <div class="mc state-cont">
                        <div class="state-lcol"><div class="state-top"><?php echo $this->_var['lang']['detail_order_sn']; ?>：<?php echo $this->_var['order']['order_sn']; ?></div>
                        <h3 class="state-txt ftx-01"><?php echo $this->_var['order']['shipping_status']; ?></h3>
                        </div>
                        <div class="state-rcol">
                        <div class="state-rtop"><div class="ftx-03">该订单会为您保留24小时（从下单之日算起），24小时之后如果还未付款，我们将取消该订单。</div></div>
                        <div class="order-process order-strike-process  " id="process-04">
                        <div class="node done"><i class="node-icon icon-start"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">提交订单</li><li class="txt3"><?php echo $this->_var['order']['formated_add_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1"><?php echo $this->_var['order']['order_status']; ?></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-pay"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">付款成功</li><li class="txt3"><?php echo $this->_var['order']['pay_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1">已付款</li></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-store" style="background-position: -108px -162px;"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">商品出库</li><li class="txt3"></li></ul></div>
                        <div class="proce doing" style="background-position: 0 -94px;"><ul><li class="txt1" style="color: #fab715;">等待发货</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-express"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">等待收货</li><li class="txt3"></li></ul></div>
                        <div class="proce wait"><ul><li class="txt1">&nbsp;</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-finish"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">完成</li><li class="txt3"></li></ul></div>
                        </div>
                        </div>
                        </div>
                        <?php elseif ($this->_var['order']['pay_status'] == '已付款' && $this->_var['order']['shipping_status'] == '已发货'): ?>
                          <div class="mc state-cont">
                        <div class="state-lcol"><div class="state-top"><?php echo $this->_var['lang']['detail_order_sn']; ?>：<?php echo $this->_var['order']['order_sn']; ?></div>
                        <h3 class="state-txt ftx-01"><?php echo $this->_var['order']['shipping_status']; ?></h3>
                        <div class="state-btns"><a href="user.php?act=affirm_received&amp;order_id=<?php echo $this->_var['order']['order_id']; ?>" onclick="if (!confirm('你确认已经收到货物了吗？')) return false;" class="get_passbtn btn-1">确认收货</a></div>
                        </div>
                        <div class="state-rcol">
                        <div class="state-rtop"><div class="ftx-03">该订单会为您保留24小时（从下单之日算起），24小时之后如果还未付款，我们将取消该订单。</div></div>
                        <div class="order-process order-strike-process  " id="process-04">
                        <div class="node done"><i class="node-icon icon-start"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">提交订单</li><li class="txt3"><?php echo $this->_var['order']['formated_add_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1"><?php echo $this->_var['order']['order_status']; ?></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-pay"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">付款成功</li><li class="txt3"><?php echo $this->_var['order']['pay_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1">已付款</li></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-store" ></i><ul><li class="txt1">&nbsp;</li><li class="txt2">商品出库</li><li class="txt3"><?php echo $this->_var['order']['shipping_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1"><?php echo $this->_var['order']['shipping_status']; ?></li></ul></div>
                        <div class="node ready" ><i class="node-icon icon-express" style="background-position: -432px -54px;"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">等待收货</li><li class="txt3"></li></ul></div>
                        <div class="proce doing"style="background-position: 0 -94px;"><ul><li class="txt1">&nbsp;</li></ul></div>
                        <div class="node wait"><i class="node-icon icon-finish"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">完成</li><li class="txt3"></li></ul></div>
                        </div>
                        </div>
                        </div>
                        <?php elseif ($this->_var['order']['pay_status'] == '已付款' && $this->_var['order']['shipping_status'] == '收货确认' && $this->_var['order']['order_status'] == '已确认'): ?>
                          <div class="mc state-cont">
                        <div class="state-lcol"><div class="state-top"><?php echo $this->_var['lang']['detail_order_sn']; ?>：<?php echo $this->_var['order']['order_sn']; ?></div>
                        <h3 class="state-txt ftx-01"><?php echo $this->_var['order']['shipping_status']; ?></h3>
                        </div>
                        <div class="state-rcol">
                        <div class="state-rtop"><div class="ftx-03">该订单会为您保留24小时（从下单之日算起），24小时之后如果还未付款，我们将取消该订单。</div></div>
                        <div class="order-process order-strike-process  " id="process-04">
                        <div class="node done"><i class="node-icon icon-start"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">提交订单</li><li class="txt3"><?php echo $this->_var['order']['formated_add_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1"><?php echo $this->_var['order']['order_status']; ?></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-pay"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">付款成功</li><li class="txt3"><?php echo $this->_var['order']['pay_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1">已付款</li></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-store" ></i><ul><li class="txt1">&nbsp;</li><li class="txt2">商品出库</li><li class="txt3"><?php echo $this->_var['order']['shipping_time']; ?></li></ul></div>
                        <div class="proce done"><ul><li class="txt1">已发货</li></ul></div>
                        <div class="node ready" ><i class="node-icon icon-express" ></i><ul><li class="txt1">&nbsp;</li><li class="txt2">等待收货</li><li class="txt3"></li></ul></div>
                        <div class="proce done"><ul><li class="txt1"><?php echo $this->_var['order']['shipping_status']; ?></li></ul></div>
                        <div class="node ready"><i class="node-icon icon-finish"></i><ul><li class="txt1">&nbsp;</li><li class="txt2">完成</li><li class="txt3"></li></ul></div>
                        </div>
                        </div>
                        </div>
                        <?php endif; ?>
                        <div class="mb"></div>
                        </div>
                          <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['order_status']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                          <tr>
                            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_sn']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_sn']; ?>
                            <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?>
                            <a href="./group_buy.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_group_buy']; ?></strong></a>
                            <?php elseif ($this->_var['order']['extension_code'] == "exchange_goods"): ?>
                            <a href="./exchange.php?act=view&id=<?php echo $this->_var['order']['extension_id']; ?>" class="f6"><strong><?php echo $this->_var['lang']['order_is_exchange']; ?></strong></a>
                            <?php endif; ?>  
                            <a href="user.php?act=message_list&order_id=<?php echo $this->_var['order']['order_id']; ?>" class="f6">[<?php echo $this->_var['lang']['business_message']; ?>]</a>
                            </td>
                          </tr>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['confirm_time']; ?></td>
                          </tr>
                          <?php if ($this->_var['order']['is_presell']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff  " style="color: #0374d9;">预售订单：</td>
                            <td align="left" bgcolor="#ffffff  " class="ftx-01">预计10-15个工作日内发货！请耐心等待</td>
                          </tr>
                          <?php endif; ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['pay_time']; ?></td>
                          </tr>
                          
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_shipping_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['shipping_time']; ?></td>
                          </tr>
                          <?php if ($this->_var['order']['invoice_no']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignment']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['invoice_no']; ?></td>
                          </tr>
                          <?php if ($this->_var['order']['shipping_id'] == 14): ?>
                          <?php $_from = $this->_var['self_delivery_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'self_delivery');if (count($_from)):
    foreach ($_from AS $this->_var['self_delivery']):
?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['self_status']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['self_delivery']['self_delivery_time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['self_delivery']['self_delivery_person']; ?>&nbsp;&nbsp;&nbsp;&nbsp<?php echo $this->_var['self_delivery']['status_type']; ?></td>
                          </tr>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          <?php endif; ?>
                          <?php endif; ?>
                          <?php if ($this->_var['order']['to_buyer']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_to_buyer']; ?>：</td>
                            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['to_buyer']; ?></td>
                          </tr>
                          <?php endif; ?>

                          <?php if ($this->_var['virtual_card']): ?>
                          <tr>
                            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['virtual_card_info']; ?>：</td>
                            <td colspan="3" align="left" bgcolor="#ffffff">
                            <?php $_from = $this->_var['virtual_card']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vgoods');if (count($_from)):
    foreach ($_from AS $this->_var['vgoods']):
?>
                              <?php $_from = $this->_var['vgoods']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
                                <?php if ($this->_var['card']['card_sn']): ?><?php echo $this->_var['lang']['card_sn']; ?>:<span style="color:red;"><?php echo $this->_var['card']['card_sn']; ?></span><?php endif; ?>
                                <?php if ($this->_var['card']['card_password']): ?><?php echo $this->_var['lang']['card_password']; ?>:<span style="color:red;"><?php echo $this->_var['card']['card_password']; ?></span><?php endif; ?>
                                <?php if ($this->_var['card']['end_date']): ?><?php echo $this->_var['lang']['end_date']; ?>:<?php echo $this->_var['card']['end_date']; ?><?php endif; ?><br />
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            </td>
                          </tr>
                          <?php endif; ?>
                        </table>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['goods_list']; ?></h3>
                        <?php if ($this->_var['allow_to_cart']): ?>
                        <div class="extra-r">
                          <a href="javascript:;" onclick="returnToCart(<?php echo $this->_var['order']['order_id']; ?>)" class="f6"><?php echo $this->_var['lang']['return_to_cart']; ?></a>
                        </div>
                          <?php endif; ?>
                        </div>
                        <div class='mc'>
                        
                        <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <th width="23%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_name']; ?></th>
                              <th width="29%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_attr']; ?></th>
                              <!--<th><?php echo $this->_var['lang']['market_price']; ?></th>-->
                              <th width="26%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?></th>
                              <th width="9%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['number']; ?></th>
                              <th width="20%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['subtotal']; ?></th>
                            </tr>
                            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                            <tr>
                              <td bgcolor="#ffffff">
                                <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                                  <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                                  <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
                                  <?php elseif ($this->_var['goods']['is_gift']): ?>
                                  <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                                  <?php endif; ?>
                                <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                                  <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（礼包）</span></a>
                                  <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                                      <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                                        <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
                                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                  </div>
                                <?php endif; ?>
                                </td>
                              <td align="left" bgcolor="#ffffff"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
                              <!--<td align="right"><?php echo $this->_var['goods']['market_price']; ?></td>-->
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_price']; ?></td>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_number']; ?></td>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['subtotal']; ?></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr>
                              <td colspan="8" bgcolor="#ffffff" align="right">
                              <?php echo $this->_var['lang']['shopping_money']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
                              </td>
                            </tr>
                          </table>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['fee_total']; ?></h3></div>
                        <div class="mc">
                         <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <td align="right" bgcolor="#ffffff">
                                  <?php echo $this->_var['lang']['goods_all_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
                                <?php if ($this->_var['order']['discount'] > 0): ?>
                                - <?php echo $this->_var['lang']['discount']; ?>: <?php echo $this->_var['order']['formated_discount']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['tax'] > 0): ?>
                                + <?php echo $this->_var['lang']['tax']; ?>: <?php echo $this->_var['order']['formated_tax']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['shipping_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['shipping_fee']; ?>: <?php echo $this->_var['order']['formated_shipping_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['insure_fee']; ?>: <?php echo $this->_var['order']['formated_insure_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['pay_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['pay_fee']; ?>: <?php echo $this->_var['order']['formated_pay_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['pack_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['pack_fee']; ?>: <?php echo $this->_var['order']['formated_pack_fee']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['card_fee'] > 0): ?>
                                + <?php echo $this->_var['lang']['card_fee']; ?>: <?php echo $this->_var['order']['formated_card_fee']; ?>
                                <?php endif; ?>        </td>
                            </tr>
                            <tr>
                              <td align="right" bgcolor="#ffffff">
                                <?php if ($this->_var['order']['money_paid'] > 0): ?>
                                - <?php echo $this->_var['lang']['order_money_paid']; ?>: <?php echo $this->_var['order']['formated_money_paid']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['surplus'] > 0): ?>
                                - <?php echo $this->_var['lang']['use_surplus']; ?>: <?php echo $this->_var['order']['formated_surplus']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['integral_money'] > 0): ?>
                                - <?php echo $this->_var['lang']['use_integral']; ?>: <?php echo $this->_var['order']['formated_integral_money']; ?>
                                <?php endif; ?>
                                <?php if ($this->_var['order']['bonus'] > 0): ?>
                                - <?php echo $this->_var['lang']['use_bonus']; ?>: <?php echo $this->_var['order']['formated_bonus']; ?>
                                <?php endif; ?>        </td>
                            </tr>
                            <tr>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_amount']; ?>: <?php echo $this->_var['order']['formated_order_amount']; ?>
                              <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><br />
                              <?php echo $this->_var['lang']['notice_gb_order_amount']; ?><?php endif; ?></td>
                            </tr>
                              <?php if ($this->_var['allow_edit_surplus']): ?>
                            <tr>
                              <td align="right" bgcolor="#ffffff">
                        <form action="user.php" method="post" name="formFee" id="formFee"><?php echo $this->_var['lang']['use_more_surplus']; ?>:
                              <input name="surplus" type="text" size="8" value="0" style="border:1px solid #ccc;"/><?php echo $this->_var['max_surplus']; ?>
                              <input type="submit" name="Submit" class="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                        <input type="hidden" name="act" value="act_edit_surplus" />
                        <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
                        </form></td>
                            </tr>
                      <?php endif; ?>
                          </table>
                        </div>
                        </div>
                        <div class='mod-main mod-comm'>
                        <div class="mt"><h3><?php echo $this->_var['lang']['consignee_info']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                           <?php if ($this->_var['order']['allow_update_address'] > 0): ?>
                            <form action="user.php" method="post" name="formAddress" id="formAddress">
                             <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                <tr>
                                  <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>： </td>
                                  <td width="35%" align="left" bgcolor="#ffffff"><input name="consignee" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['consignee']); ?>" size="25">
                                  </td>
                                  <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>： </td>
                                  <td width="35%" align="left" bgcolor="#ffffff"><input name="email" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['email']); ?>" size="25" />
                                  </td>
                                </tr>
                                <?php if ($this->_var['order']['exist_real_goods']): ?>
                                
                                <tr>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>： </td>
                                  <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['address']); ?> " size="25" /></td>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['zipcode']); ?>" size="25" /></td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['tel']); ?>" size="25" /></td>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="mobile" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['mobile']); ?>" size="25" /></td>
                                </tr>
                                <?php if ($this->_var['order']['exist_real_goods']): ?>
                                
                                <tr>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="sign_building" class="inputBg" type="text" value="<?php echo htmlspecialchars($this->_var['order']['sign_building']); ?>" size="25" />
                                  </td>
                                  <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                                  <td align="left" bgcolor="#ffffff"><input name="best_time" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['best_time']); ?>" size="25" />
                                  </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                  <td colspan="4" align="center" bgcolor="#ffffff"><input type="hidden" name="act" value="save_order_address" />
                                    <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                    <input type="submit" class="get_passbtn " value="<?php echo $this->_var['lang']['update_address']; ?>"  />
                                  </td>
                                </tr>
                              </table>
                            </form>
                            <?php else: ?>
                            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                              <tr>
                                <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                                <td width="35%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['consignee']; ?></td>
                                <td width="15%" align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['email_address']; ?>：</td>
                                <td width="35%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['email']; ?></td>
                              </tr>
                              <?php if ($this->_var['order']['exist_real_goods']): ?>
                              <tr>
                                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                                <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['address']; ?>
                                  <?php if ($this->_var['order']['zipcode']): ?>
                                  [<?php echo $this->_var['lang']['postalcode']; ?>: <?php echo $this->_var['order']['zipcode']; ?>]
                                  <?php endif; ?></td>
                              </tr>
                              <?php endif; ?>
                              <tr>
                                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['tel']; ?> </td>
                                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['mobile']; ?></td>
                              </tr>
                              <?php if ($this->_var['order']['exist_real_goods']): ?>
                              <tr>
                                <td align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['sign_building']; ?> </td>
                                <td align="right" bgcolor="#ffffff" ><?php echo $this->_var['lang']['deliver_goods_time']; ?>：</td>
                                <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['best_time']; ?></td>
                              </tr>
                              <?php endif; ?>
                            </table>
                            <?php endif; ?>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['payment']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                  <tr>
                                    <td bgcolor="#ffffff">
                                    <?php echo $this->_var['lang']['select_payment']; ?>: <?php echo $this->_var['order']['pay_name']; ?>。<?php echo $this->_var['lang']['order_amount']; ?>: <strong><?php echo $this->_var['order']['formated_order_amount']; ?></strong><br />
                                    <?php echo $this->_var['order']['pay_desc']; ?>
                                    </td>
                                  </tr>
                                    <tr>
                                    <td bgcolor="#ffffff" align="right">
                                    <?php if ($this->_var['payment_list']): ?>
                                <form name="payment" method="post" action="user.php">
                                <?php echo $this->_var['lang']['change_payment']; ?>:
                                <select name="pay_id" style="line-height: 18px;border: 1px solid #ccc;padding: 5px;float: none;font-family: "Microsoft YaHei";font-size: 12px;width: 170px;">
                                  <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                                  <option value="<?php echo $this->_var['payment']['pay_id']; ?>">
                                  <?php echo $this->_var['payment']['pay_name']; ?>(<?php echo $this->_var['lang']['pay_fee']; ?>:<?php echo $this->_var['payment']['format_pay_fee']; ?>)
                                  </option>
                                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <input type="hidden" name="act" value="act_edit_payment" />
                                <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                                <input type="submit" name="Submit" class="get_passbtn btn-1" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
                                </form>
                                <?php endif; ?>
                                    </td>
                                  </tr>
                                </table>
                        </div>
                        </div>
                        <div class="mod-main mod-comm">
                        <div class="mt"><h3><?php echo $this->_var['lang']['other_info']; ?></h3></div>
                        <div class="mc">
                        <div class="blank"></div>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <?php if ($this->_var['order']['shipping_id'] > 0): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['shipping']; ?>：</td>
                              <td colspan="3" width="85%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_name']; ?></td>
                            </tr>
                            <?php endif; ?>

                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_name']; ?></td>
                            </tr>
                            <?php if ($this->_var['order']['insure_fee'] > 0): ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['pack_name']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_pack']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pack_name']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['card_name']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_card']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_name']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['card_message']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['bless_note']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_message']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['surplus'] > 0): ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['integral'] > 0): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_integral']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['integral']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['bonus'] > 0): ?>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['inv_payee'] && $this->_var['order']['inv_content']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_title']; ?>：</td>
                              <td width="36%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_payee']; ?></td>
                              <td width="19%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_content']; ?>：</td>
                              <td width="25%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_content']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if ($this->_var['order']['postscript']): ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_postscript']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['postscript']; ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_process']; ?>：</td>
                              <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['how_oos_name']; ?></td>
                            </tr>
                          </table>
                        </div>
                        </div>
                        <?php endif; ?>
                     
                        <?php endif; ?>
                      
                      
                      <?php if ($this->_var['action'] == 'order_detail_pay'): ?>
                      <div class="order" style="overflow: hidden;">
                      <div class="o-left"><h3 class="o-title">订单提交成功，请您尽快付款！ 订单号：<a href="user.php?act=order_detail&order_id=<?php echo $this->_var['order']['order_id']; ?>"><?php echo $this->_var['order']['order_sn']; ?></a></h3><p class="o-tips">请您在提交订单后<span class="font-red">24小时</span>内完成支付，否则我们将取消您的订单。</p></div>
                      <div class="o-right"><div class="o-price"><em><?php echo $this->_var['lang']['order_amount']; ?></em><strong><?php echo $this->_var['order']['formated_order_amount']; ?></strong></div></div>
                      </div>
                      <div class="payment">
                      <?php if ($this->_var['order']['pay_online'] != ''): ?>
                      <div class="jp-logo-wrap"><span class="jp-logo"></span></div>
                      <div class="jp-notice"><div class="jp-tips">以下支付方式由馨清网提供</div></div>
                      <div class="paybox j_paybox paybox-selected">
                      
                      <div class="p-wrap"><i class="p-border"></i>
                      <div class="p-key"><span class="p-k-check"><strong><?php echo $this->_var['order']['pay_name']; ?></strong></span></div>
                      <div class="p-amount"><em>支付</em><strong><?php echo $this->_var['order']['formated_order_amount']; ?></strong></div>
                      </div>
                      <div style="overflow: hidden;padding-bottom: 20px;"><?php echo $this->_var['order']['pay_online']; ?></div>
                      </div>
                      <?php endif; ?>
                      </div>
                      <?php endif; ?>
                      
                      
                        <?php if ($this->_var['action'] == "account_raply" || $this->_var['action'] == "account_log" || $this->_var['action'] == "account_deposit" || $this->_var['action'] == "account_detail"): ?>
                          <script type="text/javascript">
                            <?php $_from = $this->_var['lang']['account_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                              var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          </script>
                          <h5><span><?php echo $this->_var['lang']['user_balance']; ?></span></h5>
                          <div class="blank"></div>
                           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <td align="right" bgcolor="#ffffff"><a href="user.php?act=account_deposit" class="f6"><?php echo $this->_var['lang']['surplus_type_0']; ?></a> | <a href="user.php?act=account_raply" class="f6"><?php echo $this->_var['lang']['surplus_type_1']; ?></a> | <a href="user.php?act=account_detail" class="f6"><?php echo $this->_var['lang']['add_surplus_log']; ?></a> | <a href="user.php?act=account_log" class="f6"><?php echo $this->_var['lang']['view_application']; ?></a> </td>
                            </tr>
                          </table>
                          <?php endif; ?>
                          <?php if ($this->_var['action'] == "account_raply"): ?>
                          <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['repay_money']; ?>:</td>
                              <td bgcolor="#ffffff" align="left"><input type="text" name="amount" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" class="inputBg" size="30" />
                              </td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?>:</td>
                              <td bgcolor="#ffffff" align="left"><textarea name="user_note" cols="55" rows="6" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffff" colspan="2" align="center">
                              <input type="hidden" name="surplus_type" value="1" />
                                <input type="hidden" name="act" value="act_account" />
                                <input type="submit" name="submit"  class="bnt_blue_1" value="<?php echo $this->_var['lang']['submit_request']; ?>" />
                                <input type="reset" name="reset" class="bnt_blue_1" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                              </td>
                            </tr>
                          </table>
                          </form>
                          <?php endif; ?>
                          <?php if ($this->_var['action'] == "account_deposit"): ?>
                          <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                              <tr>
                                <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['deposit_money']; ?>:</td>
                                <td align="left" bgcolor="#ffffff"><input type="text" name="amount"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" size="30" /></td>
                              </tr>
                              <tr>
                                <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?>:</td>
                                <td align="left" bgcolor="#ffffff"><textarea name="user_note" cols="55" rows="6" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea></td>
                              </tr>
                            </table>
                            <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                              <tr align="center">
                                <td bgcolor="#ffffff"  colspan="3" align="left"><?php echo $this->_var['lang']['payment']; ?>:</td>
                              </tr>
                              <tr align="center">
                                <td bgcolor="#ffffff"><?php echo $this->_var['lang']['pay_name']; ?></td>
                                <td bgcolor="#ffffff" width="60%"><?php echo $this->_var['lang']['pay_desc']; ?></td>
                                <td bgcolor="#ffffff" width="17%"><?php echo $this->_var['lang']['pay_fee']; ?></td>
                              </tr>
                              <?php $_from = $this->_var['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
                              <tr>
                                <td bgcolor="#ffffff" align="left">
                                <input type="radio" name="payment_id" value="<?php echo $this->_var['list']['pay_id']; ?>" /><?php echo $this->_var['list']['pay_name']; ?></td>
                                <td bgcolor="#ffffff" align="left"><?php echo $this->_var['list']['pay_desc']; ?></td>
                                <td bgcolor="#ffffff" align="center"><?php echo $this->_var['list']['pay_fee']; ?></td>
                              </tr>
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                              <tr>
                          <td bgcolor="#ffffff" colspan="3"  align="center">
                          <input type="hidden" name="surplus_type" value="0" />
                            <input type="hidden" name="rec_id" value="<?php echo $this->_var['order']['id']; ?>" />
                            <input type="hidden" name="act" value="act_account" />
                            <input type="submit" class="bnt_blue_1" name="submit" value="<?php echo $this->_var['lang']['submit_request']; ?>" />
                            <input type="reset" class="bnt_blue_1" name="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                          </td>
                        </tr>
                            </table>
                          </form>
                          <?php endif; ?>
                          <?php if ($this->_var['action'] == "act_account"): ?>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <td width="25%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_amount']; ?></td>
                              <td width="80%" bgcolor="#ffffff"><?php echo $this->_var['amount']; ?></td>
                            </tr>
                            <tr>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_name']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_name']; ?></td>
                            </tr>
                            <tr>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_fee']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['pay_fee']; ?></td>
                            </tr>
                            <tr>
                              <td align="right" valign="middle" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_desc']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_desc']; ?></td>
                            </tr>
                            <tr>
                              <td colspan="2" bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_button']; ?></td>
                            </tr>
                          </table>
                          <?php endif; ?>
                         <?php if ($this->_var['action'] == "account_detail"): ?>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr align="center">
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['change_desc']; ?></td>
                            </tr>
                            <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                            <tr>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['change_time']; ?></td>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
                              <td bgcolor="#ffffff" title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr>
                              <td colspan="4" align="center" bgcolor="#ffffff"><div align="right"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></div></td>
                            </tr>
                          </table>
                          <?php echo $this->fetch('library/pages.lbi'); ?>
                          <?php endif; ?>
                          <?php if ($this->_var['action'] == "account_log"): ?>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr align="center">
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['admin_notic']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['is_paid']; ?></td>
                              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                            </tr>
                            <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                            <tr>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['add_time']; ?></td>
                              <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
                              <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_user_note']; ?></td>
                              <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_admin_note']; ?></td>
                              <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['pay_status']; ?></td>
                              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['handle']; ?>
                                <?php if (( $this->_var['item']['is_paid'] == 0 && $this->_var['item']['process_type'] == 1 ) || $this->_var['item']['handle']): ?>
                                <a href="user.php?act=cancel&id=<?php echo $this->_var['item']['id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) return false;"><?php echo $this->_var['lang']['is_cancel']; ?></a>
                                <?php endif; ?>
                                              </td>
                            </tr>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                            <tr>
                              <td colspan="7" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></td>
                            </tr>
                          </table>
                          <?php echo $this->fetch('library/pages.lbi'); ?>
                        <?php endif; ?>
                        
                        
                        <?php if ($this->_var['action'] == 'address_list'): ?>
                          <div class='mod-main mod-comm'>
                          <div class="mt">
                          <h3><?php echo $this->_var['lang']['consignee_info']; ?></h3>
                          </div>
                          <div class="mt">
                          <a class="get_passbtn" style="line-height: 28px;margin: 0 10px 0 0;"href="javascript:;" id="add_address" value="<?php echo $this->_var['consignee_list_count']; ?>"><?php echo $this->_var['lang']['add_address']; ?></a>
                          <span class='ftx-03'>您已经创建<span class="ftx-05"><?php echo $this->_var['consignee_list_count']; ?> </span>个收货地址，最多可创建<span class="ftx-05">5 </span>个</span>
                          </div>
                         
                           
                              <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,region.js,shopping_flow.js')); ?>
                              <script type="text/javascript">
                                region.isAdmin = false;
                                <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                                var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                
                                onload = function() {
                                  if (!document.all)
                                  {
                                    document.forms['theForm'].reset();
                                  }
                                }
                                
                              </script>
                              <div class="mc">
                              <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
                              <?php if ($this->_var['consignee']['consignee']): ?>
                              <form action="user.php" method="post" name="theForm" onsubmit="return checkConsignee(this)">
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="" class="easebuy-m">
                                  <tr>
                                  <td align="left" bgcolor="#ffffff"><h3><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>&nbsp;<?php echo $this->_var['consignee']['mobile']; ?></h3></td>
                                  <td colspan="3"  bgcolor="#ffffff" ><div class="extra"><?php if ($this->_var['consignee']['consignee']): ?><a href="#none" onclick="jConfirm('你确认要删除该收货地址吗？',function(){location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>';},'馨清网')" class="del-btn"><?php echo $this->_var['lang']['drop']; ?><a><?php endif; ?></div></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['country_province']; ?>：</td>
                                    <td colspan="3" align="left" bgcolor="#ffffff"><select name="country" id="selCountries_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 1, 'selProvinces_<?php echo $this->_var['sn']; ?>')">
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
                                        <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                        <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['consignee']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                      <select name="province" id="selProvinces_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 2, 'selCities_<?php echo $this->_var['sn']; ?>')">
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
                                        <?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                                        <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                      <select name="city" id="selCities_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 3, 'selDistricts_<?php echo $this->_var['sn']; ?>')">
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
                                        <?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                        <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                      <select name="district" id="selDistricts_<?php echo $this->_var['sn']; ?>" <?php if (! $this->_var['district_list'][$this->_var['sn']]): ?>style="display:none"<?php endif; ?>>
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
                                        <?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                        <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                    <?php echo $this->_var['lang']['require_field']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg" id="consignee_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?> </td>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="email" type="text" class="inputBg" id="email_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['email']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" id="address_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['address']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?></td>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text" class="inputBg" id="zipcode_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['zipcode']); ?>" /></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" id="tel_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['tel']); ?>" />
                                    </td>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="mobile" type="text" class="inputBg" id="mobile_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"  colspan="3"><input name="sign_building" type="text" class="inputBg" id="sign_building_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?>" /></td>
                                    
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff">&nbsp;</td>
                                    <td colspan="3" align="right" bgcolor="#ffffff"><?php if ($this->_var['consignee']['consignee'] && $this->_var['consignee']['email']): ?>
                                      <input type="submit" name="submit" class="get_passbtn" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                                     
                                      <?php else: ?>
                                      <input type="submit" name="submit" class="get_passbtn"  value="<?php echo $this->_var['lang']['add_address']; ?>"/>
                                      <?php endif; ?>
                                      <input type="hidden" name="act" value="act_edit_address" />
                                      <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                                    </td>
                                  </tr>
                                </table>
                              </form>
                              <?php else: ?>
                              <div class="xdsoft_dialog_overlay xdsoft_modal add_address" style="z-index: 10; display: none;">
                              <div class="xdsoft_dialog xdsoft_dialog_shadow_effect">
                              <div class="xdsoft_dialog_popup_title" style="display: block;"><span>添加收货地址</span><a class="xdsoft_close">×</a></div>
                              <a class="xdsoft_close" style="display: none;">×</a>
                              <div class="xdsoft_dialog_content">
                              <form action="user.php" method="post" name="theForm" onsubmit="return checkConsignee(this)">
                                <table width="740" border="0" cellpadding="5" cellspacing="1" bgcolor="" class="easebuy-m">
                                  <tr>
                                  <td align="left" bgcolor="#ffffff"><h3><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>&nbsp;<?php echo $this->_var['consignee']['mobile']; ?></h3></td>
                                  <td colspan="3"  bgcolor="#ffffff" ><div class="extra"><?php if ($this->_var['consignee']['consignee']): ?><a href="#none" onclick="jConfirm('你确认要删除该收货地址吗？',function(){location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>';},'馨清网')" class="del-btn"><?php echo $this->_var['lang']['drop']; ?><a><?php endif; ?></div></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['country_province']; ?>：</td>
                                    <td colspan="3" align="left" bgcolor="#ffffff"><select name="country" id="selCountries_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 1, 'selProvinces_<?php echo $this->_var['sn']; ?>')">
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
                                        <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                                        <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['consignee']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                      <select name="province" id="selProvinces_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 2, 'selCities_<?php echo $this->_var['sn']; ?>')">
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
                                        <?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                                        <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                      <select name="city" id="selCities_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 3, 'selDistricts_<?php echo $this->_var['sn']; ?>')">
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
                                        <?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                                        <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                      <select name="district" id="selDistricts_<?php echo $this->_var['sn']; ?>" <?php if (! $this->_var['district_list'][$this->_var['sn']]): ?>style="display:none"<?php endif; ?>>
                                        <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
                                        <?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                                        <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
                                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                      </select>
                                    <?php echo $this->_var['lang']['require_field']; ?> </td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="consignee" type="text" class="inputBg" id="consignee_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?> </td>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="email" type="text" class="inputBg" id="email_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['email']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" id="address_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['address']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?></td>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['postalcode']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="zipcode" type="text" class="inputBg" id="zipcode_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['zipcode']); ?>" /></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" id="tel_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['tel']); ?>" />
                                    </td>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['backup_phone']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff"><input name="mobile" type="text" class="inputBg" id="mobile_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?>" />
                                    <?php echo $this->_var['lang']['require_field']; ?></td>
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['sign_building']; ?>：</td>
                                    <td align="left" bgcolor="#ffffff" colspan="3"><input name="sign_building" type="text" class="inputBg" id="sign_building_<?php echo $this->_var['sn']; ?>" value="<?php echo htmlspecialchars($this->_var['consignee']['sign_building']); ?>" /></td>
                                    
                                  </tr>
                                  <tr>
                                    <td align="right" bgcolor="#ffffff">&nbsp;</td>
                                    <td colspan="3" align="right" bgcolor="#ffffff"><?php if ($this->_var['consignee']['consignee'] && $this->_var['consignee']['email']): ?>
                                      <input type="submit" name="submit" class="get_passbtn" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                                     
                                      <?php else: ?>
                                      <input type="submit" name="submit" class="get_passbtn"  value="<?php echo $this->_var['lang']['add_address']; ?>"/>
                                      <?php endif; ?>
                                      <input type="hidden" name="act" value="act_edit_address" />
                                      <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                                    </td>
                                  </tr>
                                </table>
                              </form>
                              </div>
                              </div>
                              </div>
                              <?php endif; ?>
                              
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                              </div>
                              </div>
                        <?php endif; ?>
                      
                        
                         <?php if ($this->_var['action'] == 'transform_points'): ?>
                         <h5><span><?php echo $this->_var['lang']['transform_points']; ?></span></h5>
                               <div class="blank"></div>
                         <?php if ($this->_var['exchange_type'] == 'ucenter'): ?>
                          <form action="user.php" method="post" name="transForm" onsubmit="return calcredit();">
                         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                                  <tr>
                                      <th width="120" bgcolor="#FFFFFF" align="right" valign="top"><?php echo $this->_var['lang']['cur_points']; ?>:</th>
                                      <td bgcolor="#FFFFFF">
                                      <label for="pay_points"><?php echo $this->_var['lang']['exchange_points']['1']; ?>:</label><input type="text" size="15" id="pay_points" name="pay_points" value="<?php echo $this->_var['shop_points']['pay_points']; ?>" style="border:0;border-bottom:1px solid #DADADA;" readonly="readonly" /><br />
                                      <div class="blank"></div>
                                      <label for="rank_points"><?php echo $this->_var['lang']['exchange_points']['0']; ?>:</label><input type="text" size="15" id="rank_points" name="rank_points" value="<?php echo $this->_var['shop_points']['rank_points']; ?>" style="border:0;border-bottom:1px solid #DADADA;" readonly="readonly" />
                                      </td>
                                      </tr>
                            <tr><td bgcolor="#FFFFFF">&nbsp;</td>
                            <td bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                              <th align="right" bgcolor="#FFFFFF"><label for="amount"><?php echo $this->_var['lang']['exchange_amount']; ?>:</label></th>
                              <td bgcolor="#FFFFFF"><input size="15" name="amount" id="amount" value="0" onkeyup="calcredit();" type="text" />
                                  <select name="fromcredits" id="fromcredits" onchange="calcredit();">
                                    <?php echo $this->html_options(array('options'=>$this->_var['lang']['exchange_points'],'selected'=>$this->_var['selected_org'])); ?>
                                  </select>
                              </td>
                            </tr>
                            <tr>
                              <th align="right" bgcolor="#FFFFFF"><label for="desamount"><?php echo $this->_var['lang']['exchange_desamount']; ?>:</label></th>
                              <td bgcolor="#FFFFFF"><input type="text" name="desamount" id="desamount" disabled="disabled" value="0" size="15" />
                                <select name="tocredits" id="tocredits" onchange="calcredit();">
                                  <?php echo $this->html_options(array('options'=>$this->_var['to_credits_options'],'selected'=>$this->_var['selected_dst'])); ?>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <th align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['exchange_ratio']; ?>:</th>
                              <td bgcolor="#FFFFFF">1 <span id="orgcreditunit"><?php echo $this->_var['orgcreditunit']; ?></span> <span id="orgcredittitle"><?php echo $this->_var['orgcredittitle']; ?></span> <?php echo $this->_var['lang']['exchange_action']; ?> <span id="descreditamount"><?php echo $this->_var['descreditamount']; ?></span> <span id="descreditunit"><?php echo $this->_var['descreditunit']; ?></span> <span id="descredittitle"><?php echo $this->_var['descredittitle']; ?></span></td>
                            </tr>
                            <tr><td bgcolor="#FFFFFF">&nbsp;</td>
                            <td bgcolor="#FFFFFF"><input type="hidden" name="act" value="act_transform_ucenter_points" /><input type="submit" name="transfrom" value="<?php echo $this->_var['lang']['transform']; ?>" /></td></tr>
                    </table>
                          </form>
                         <script type="text/javascript">
                          <?php $_from = $this->_var['lang']['exchange_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'lang_js');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['lang_js']):
?>
                          var <?php echo $this->_var['key']; ?> = '<?php echo $this->_var['lang_js']; ?>';
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                          var out_exchange_allow = new Array();
                          <?php $_from = $this->_var['out_exchange_allow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'ratio');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['ratio']):
?>
                          out_exchange_allow['<?php echo $this->_var['key']; ?>'] = '<?php echo $this->_var['ratio']; ?>';
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

                          function calcredit()
                          {
                              var frm = document.forms['transForm'];
                              var src_credit = frm.fromcredits.value;
                              var dest_credit = frm.tocredits.value;
                              var in_credit = frm.amount.value;
                              var org_title = frm.fromcredits[frm.fromcredits.selectedIndex].innerHTML;
                              var dst_title = frm.tocredits[frm.tocredits.selectedIndex].innerHTML;
                              var radio = 0;
                              var shop_points = ['rank_points', 'pay_points'];
                              if (parseFloat(in_credit) > parseFloat(document.getElementById(shop_points[src_credit]).value))
                              {
                                  alert(balance.replace('{%s}', org_title));
                                  frm.amount.value = frm.desamount.value = 0;
                                  return false;
                              }
                              if (typeof(out_exchange_allow[dest_credit+'|'+src_credit]) == 'string')
                              {
                                  radio = (1 / parseFloat(out_exchange_allow[dest_credit+'|'+src_credit])).toFixed(2);
                              }
                              document.getElementById('orgcredittitle').innerHTML = org_title;
                              document.getElementById('descreditamount').innerHTML = radio;
                              document.getElementById('descredittitle').innerHTML = dst_title;
                              if (in_credit > 0)
                              {
                                  if (typeof(out_exchange_allow[dest_credit+'|'+src_credit]) == 'string')
                                  {
                                      frm.desamount.value = Math.floor(parseFloat(in_credit) / parseFloat(out_exchange_allow[dest_credit+'|'+src_credit]));
                                      frm.transfrom.disabled = false;
                                      return true;
                                  }
                                  else
                                  {
                                      frm.desamount.value = deny;
                                      frm.transfrom.disabled = true;
                                      return false;
                                  }
                              }
                              else
                              {
                                  return false;
                              }
                          }
                         </script>
                         <?php else: ?>
                          <b><?php echo $this->_var['lang']['cur_points']; ?>:</b>
                          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                            <tr>
                              <td width="30%" valign="top" bgcolor="#FFFFFF"><table border="0">
                                <?php $_from = $this->_var['bbs_points']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'points');if (count($_from)):
    foreach ($_from AS $this->_var['points']):
?>
                                <tr>
                                  <th><?php echo $this->_var['points']['title']; ?>:</th>
                                  <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['points']['value']; ?></td>
                                </tr>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                              </table></td>
                              <td width="50%" valign="top" bgcolor="#FFFFFF"><table>
                                      <tr>
                                  <th><?php echo $this->_var['lang']['pay_points']; ?>:</th>
                                  <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['shop_points']['pay_points']; ?></td>
                                      </tr>
                                <tr>
                                  <th><?php echo $this->_var['lang']['rank_points']; ?>:</th>
                                  <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['shop_points']['rank_points']; ?></td>
                                </tr>
                              </table></td>
                            </tr>
                          </table>
                          <br />
                          <b><?php echo $this->_var['lang']['rule_list']; ?>:</b>
                          <ul class="point clearfix">
                            <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['rule']):
?>
                            <li><font class="f1">·</font>"<?php echo $this->_var['rule']['from']; ?>" <?php echo $this->_var['lang']['transform']; ?> "<?php echo $this->_var['rule']['to']; ?>" <?php echo $this->_var['lang']['rate_is']; ?> <?php echo $this->_var['rule']['rate']; ?>
                            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          </ul>

                          <form action="user.php" method="post" name="theForm">
                          <table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" style="border-collapse:collapse;border:1px solid #DADADA;">
                            <tr style="background:#F1F1F1;">
                              <th><?php echo $this->_var['lang']['rule']; ?></th>
                              <th><?php echo $this->_var['lang']['transform_num']; ?></th>
                              <th><?php echo $this->_var['lang']['transform_result']; ?></th>
                            </tr>
                            <tr>
                              <td>
                                <select name="rule_index" onchange="changeRule()">
                                  <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['rule']):
?>
                                  <option value="<?php echo $this->_var['key']; ?>"><?php echo $this->_var['rule']['from']; ?>-><?php echo $this->_var['rule']['to']; ?></option>
                                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                            </td>
                            <td>
                              <input type="text" name="num" value="0" onkeyup="calPoints()"/>
                            </td>
                            <td><span id="ECS_RESULT">0</span></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center"><input type="hidden" name="act" value="act_transform_points"  /><input type="submit" value="<?php echo $this->_var['lang']['transform']; ?>" /></td>
                            </tr>
                          </table>
                          </form>
                         <script type="text/javascript">
                            //<![CDATA[
                              var rule_list = new Object();
                              var invalid_input = '<?php echo $this->_var['lang']['invalid_input']; ?>';
                              <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['rule']):
?>
                              rule_list['<?php echo $this->_var['key']; ?>'] = '<?php echo $this->_var['rule']['rate']; ?>';
                              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                              function calPoints()
                              {
                                var frm = document.forms['theForm'];
                                var rule_index = frm.elements['rule_index'].value;
                                var num = parseInt(frm.elements['num'].value);
                                var rate = rule_list[rule_index];

                                if (isNaN(num) || num < 0 || num != frm.elements['num'].value)
                                {
                                  document.getElementById('ECS_RESULT').innerHTML = invalid_input;
                                  rerutn;
                                }
                                var arr = rate.split(':');
                                var from = parseInt(arr[0]);
                                var to = parseInt(arr[1]);

                                if (from <=0 || to <=0)
                                {
                                  from = 1;
                                  to = 0;
                                }
                                document.getElementById('ECS_RESULT').innerHTML = parseInt(num * to / from);
                              }

                              function changeRule()
                              {
                                document.forms['theForm'].elements['num'].value = 0;
                                document.getElementById('ECS_RESULT').innerHTML = 0;
                              }
                            //]]>
                         </script>
                         <?php endif; ?>
                          <?php endif; ?>
                          




                        </div>
                       </div>
                      </div>
                    </div>
                
        </div>
    </div>
</div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>
</html>
