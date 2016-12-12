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

<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,common.js,user.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="main" style="background-color: #f5f5f5;">
    <div class="w1160px clearfix">
              <div class="mt">
              
                  <div class="AreaL"<?php if ($this->_var['action'] == 'message_list' || $this->_var['action'] == 'comment_list'): ?>style="width:253px"<?php endif; ?>>
                    <div class="box" >
                     <div class="box_1" style="border:none">
                      <div class="userCenterBox">
                      <?php if ($this->_var['action'] == 'message_list' || $this->_var['action'] == 'comment_list'): ?>
                      <?php echo $this->fetch('library/user_message_menu.lbi'); ?>
                      <?php else: ?>
                        <?php echo $this->fetch('library/user_menu.lbi'); ?>
                      <?php endif; ?>
                      </div>
                     </div>
                    </div>
                  </div>
              


              
                  <div class="AreaR" style="margin-top: 20px;<?php if ($this->_var['action'] == 'message_list' || $this->_var['action'] == 'comment_list'): ?>width:860px<?php endif; ?>" >
                  
                  <?php if ($this->_var['action'] == 'default'): ?>
                  <div style="margin-bottom: 20px;">
                  <div class="fc-msg">
                  <span></span>
                  <a href="tencent://message/?uin=<?php echo $this->_var['qq']; ?>&Site=<?php echo $this->_var['shop_name']; ?>&Menu=yes" target="_blank">联系客服</a>
                  <b>|</b>
                  </div>
                  <div class="user-info">
                  <div class="info-lcol">
                  <div class="u-pic">
                  <?php if ($this->_var['info']['xqheadimg']): ?>
                  <img alt="用户头像" src="data/user_head/<?php echo $this->_var['info']['user_id']; ?>/<?php echo $this->_var['info']['xqheadimg']; ?>" style="vertical-align: middle;" width="100" height="100"/>
                  <?php else: ?>
                  <img alt="用户头像" src="themes/default/images/robot/no-img_mid_.jpg" style="vertical-align: middle;"/>
                  <?php endif; ?>
                  <a href="showImg.html">
                  <div class="mask"></div></a></div>
                  <div class="info-m">
                  <div class="u-name"><?php echo $this->_var['info']['username']; ?></div>
                  <div class="u-level">
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
                  <div class="u-safe">
                  <a href="user.php?act=safetycenter"><span>账户安全：</span></a>
                  <?php if ($this->_var['safetyleve'] == 'middle'): ?>
                  <i class="safe-rank04"></i>
                  <strong class="rank-text ftx-04">中</strong>
                  <a href="safety_center.html">提升</a>
                  <?php elseif ($this->_var['safetyleve'] == 'high'): ?>
                  <i class="safe-rank05"></i>
                  <strong class="rank-text ftx-02">高</strong>
                  <?php endif; ?>
                  </div>
                  <div class="u-medal"> <?php echo $this->_var['lang']['last_month_order']; ?><?php echo $this->_var['info']['order_count']; ?><?php echo $this->_var['lang']['order_unit']; ?></div>
                  <div class="info-line">
                  <span class="top-icon"></span>
				  <span class="bottom-icon"></span>
				  <span class="left-icon"></span>
                  </div>
                  </div>
                  </div>
                  <div class="info-rcol">
                  
                  <div class="user-counts">
                  <ul>
                  <li><div class="count-item"><a href="no_pay.html"><i class="count-icon count-icon01"></i><?php echo $this->_var['lang']['ps']['0']; ?><em><?php echo $this->_var['order_count']['no_pay']; ?></em></a></div></li>
                  <li><div class="count-item"><a href="shipped.html"><i class="count-icon count-icon02"></i><?php echo $this->_var['lang']['ss']['1']; ?><em><?php echo $this->_var['order_count']['shipped']; ?></em></a></div></li>
                  <li><div class="count-item"><a href="returned.html"><i class="count-icon count-icon03"></i><?php echo $this->_var['lang']['os']['4']; ?><em><?php echo $this->_var['order_count']['returned']; ?></em></a></div></li>
                  <li><div class="count-item"><a href="no_shipping.html"><i class="count-icon count-icon02"></i><?php echo $this->_var['lang']['ss']['0']; ?><em><?php echo $this->_var['order_count']['unshipped']; ?></em></a></div></li>
                  </ul>
                  </div>
                  
                  
                  <div class="acco-info">
                  
                  <ul>
                  <li class="fore1"><div class="acco-item">
                  <div><label><?php echo $this->_var['lang']['last_time']; ?>:</label> <?php echo $this->_var['info']['last_time']; ?></div>
                  <div><label><?php echo $this->_var['lang']['weixin_bind_account']; ?>:</label>&nbsp;<?php if ($this->_var['info']['weixin']): ?> <img src="<?php echo $this->_var['info']['headimg']; ?>" width='20' height='20' style="margin-right: 10px;border-radius: 30px;vertical-align: middle;"/><b class="f4"><?php echo $this->_var['info']['weixin']; ?></b><?php else: ?>未绑定<?php endif; ?></div>
                  <div><label><?php echo $this->_var['lang']['zfb_bind_account']; ?>:</label>&nbsp;<?php if ($this->_var['info']['zfb']): ?> <img src="themes/default/images/robot/zfb.gif" width='20' height='20' style="margin-right: 10px;border-radius: 30px;vertical-align: middle;"/><b class="f4"><?php echo $this->_var['info']['zfb']; ?></b><?php else: ?>未绑定<?php endif; ?></div>
                  <div><label>邮箱认证：</label><?php if ($this->_var['info']['is_validate'] == 0): ?><a href="javascript:sendHashMail()" style="color:red;">未认证</a><?php else: ?>已认证<?php endif; ?></div>
                  <div><label><?php echo $this->_var['lang']['your_bonus']; ?>:</label>&nbsp;<a href="user.php?act=bonus" style="color: #676767;"><?php echo $this->_var['info']['bonus']; ?></a></div>
                  </div>
                  </li>
                  <li class="fore2">
                  <div class="acco-item">
                  <div><?php echo $this->_var['user_notice']; ?></div>
                  </div>
                  </li>
                  </ul>
                  </div>
                  </div>
                  </div>
                  </div>
                  <div style="float: left;width: 730px;">
                  <div class="mod-main">
                  <div class="mt"><h3><?php echo $this->_var['lang']['label_order']; ?></h3><div class="extra-r"><a href="order_list.html">查看全部订单</a></div></div>
                  <div class="mc">
                  <div class="tb-order">
                  <table width="100%" cellspacing="0" cellpadding="0" border="0">
                  <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
                  <tr>
                  <td><a href="order_item-<?php echo $this->_var['order']['order_id']; ?>.html"><?php echo $this->_var['order']['order_sn']; ?></a></td>
                  <td><div class="u-name"><?php echo $this->_var['order']['consignee']; ?></div></td>
                  <td><strong ><?php echo $this->_var['order']['total_fee']; ?></strong></td>
                  <td><span class='ftx-03'><?php echo $this->_var['order']['order_time']; ?></span></td>
                  <td><?php echo $this->_var['order']['order_status']; ?></td>
                  <td><a href="order_item-<?php echo $this->_var['order']['order_id']; ?>.html">查看</a></td>
                  </tr>
                  <?php endforeach; else: ?>
                  <div class="nocont-box nocont-order">
                  <b class="icon-order"></b>
                                                      您买的东西太少了，这里都空空的，快去挑选合适的商品吧！
                  </div>
                  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </table>
                  </div>
                  </div>
                  </div>
                  </div>
                  
                  
                  <div style="float: right;width: 280px;">
                  <div class="lyt-c-5">
                  <div class="mod-main" id="history">
                  <div class="mt"><h3>我的足迹</h3><div class="extra-r"><a href="history_list.html" target="_blank">查看更多</a></div></div>
                  <div class="mc">
                  <?php if ($this->_var['user_history']): ?>
                  <div class="history-con">
                  <div class="slider-show">
                  <ul>
                  <?php $_from = $this->_var['user_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                  <li>
                  <div class="history-item">
                  <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" target="_blank" title="<?php echo $this->_var['goods']['goods_name']; ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" height='50' width="50" alt="<?php echo $this->_var['goods']['goods_name']; ?>"/></a></div>
                  <div class="p-price"><?php echo $this->_var['goods']['shop_price']; ?></div>
                  </div>
                  </li>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </ul>
                  </div>
                  </div>
                  <?php else: ?>
                  <div class="nocont-box nocont-history"><p>您还未在馨清留下足迹哦，快快开启您的馨清之旅吧~</p></div>
                  <?php endif; ?>
                  </div>
                  </div>
                  </div>
                  </div>
                 
                 <div class="lyt-c-9">
                 <div class="mod-main fol-goods">
                 <div class="mt"><h3><?php echo $this->_var['lang']['label_collection']; ?></h3><div class="extra-r"><a href="collection_list.html">查看更多</a></div></div>
                 <div class="mc">
                 <?php if ($this->_var['collection_goods']): ?>
                 <div class="follow">
                 <div class="slider-show">
                 <div class="slider-show-ctn">
                 <ul>
                 <?php $_from = $this->_var['collection_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                 <li>
                 <div class="fol-item">
                 <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo $this->_var['goods']['goods_name']; ?>" target="_blank"><img class="err-product" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="110" alt="<?php echo $this->_var['goods']['goods_name']; ?>"/></a></div>
                 <div class="p-price"><?php echo $this->_var['goods']['shop_price']; ?></div>
                 </div>
                 </li>
                 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                 </ul>
                 </div>
                 </div>
                 </div>
                 <?php else: ?>
                  <div class="nocont-box nocont-fol"><div>您还没有关注任何商品，看到感兴趣的就果断关注吧！</div></div>
                 <?php endif; ?>
                 
                 </div>
                 </div>
                 </div>
                 <?php if ($this->_var['bonus_by_user_s']): ?>
                 <div class="opacity"></div>
                <div class="red"><img src="themes/default/images/robot/asd23.png"></div>
                <div class="windows">
	            <div class="texthongbao"><span>恭喜您领取</span><br><div style="margin-top: 10px;"><?php echo $this->_var['bonus_by_user_s']; ?></div></div>
	            <div class="close"><img src="themes/default/images/robot/closeh.png"/></div>
                </div>
                <?php endif; ?>
                  <?php endif; ?>
                  
                         
                         <?php if ($this->_var['action'] == 'message_list'): ?>
                     	  <div class="box">
                    	  <div class="box_1">
                    	  <div class="userCenterBox boxCenterList clearfix" style="_height:1%;background-color: #f5f5f5;">
                          <?php if ($this->_var['message_list']): ?>
                          <div class="mod-main mod-comm">
                          <div class="mt"><h3><?php echo $this->_var['lang']['label_message']; ?></h3></div>
                          
                          <div class="blank"></div>
                          <div class="mc">
                           <?php $_from = $this->_var['message_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'message');$this->_foreach['messagelou'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['messagelou']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['message']):
        $this->_foreach['messagelou']['iteration']++;
?>
                          <div class='cmt-list-cont'>
                          <div class='msg-user'>
                          <div class="f_r">
                          <a href="user.php?act=del_msg&amp;id=<?php echo $this->_var['key']; ?>&amp;order_id=<?php echo $this->_var['message']['order_id']; ?>" title="<?php echo $this->_var['lang']['drop']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_msg']; ?>')) return false;" class="btn"><?php echo $this->_var['lang']['drop']; ?></a>
                          </div>
                          <b><?php echo $this->_var['message']['msg_type']; ?>:</b>&nbsp;&nbsp;<font class="f4"><?php echo $this->_var['message']['msg_title']; ?></font><span class="user-time"><?php echo $this->_var['message']['msg_time']; ?></span><span class='user-lou'><?php echo $this->_foreach['messagelou']['iteration']; ?></span> 
                          
                          
                          </div>
                          <div class="msgBottomBorder">
                          <?php echo $this->_var['message']['msg_content']; ?>
                           <?php if ($this->_var['message']['message_img']): ?>
                           <div align="right">
                           <a href="data/feedbackimg/<?php echo $this->_var['message']['message_img']; ?>" target="_bank" class="f6"><?php echo $this->_var['lang']['view_upload_file']; ?></a>
                           </div>
                           <?php endif; ?>
                           <br />
                           <?php if ($this->_var['message']['re_msg_content']): ?>
                           <a href="mailto:<?php echo $this->_var['message']['re_user_email']; ?>" class="f6"><?php echo $this->_var['lang']['shopman_reply']; ?></a> (<?php echo $this->_var['message']['re_msg_time']; ?>)<br />
                           <?php echo $this->_var['message']['re_msg_content']; ?>
                           <?php endif; ?>
                          </div>
                           </div>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          <?php if ($this->_var['message_list']): ?>
                          <?php echo $this->fetch('library/pages.lbi'); ?>
                          <?php endif; ?>
                          </div>
                          </div>
                          <?php endif; ?>
                          <div class="mod-main mod-comm">
                          <form action="user.php" method="post" enctype="multipart/form-data" name="formMsg" onSubmit="return submitMsg()">
                                  <table width="100%" border="0" cellpadding="3" class="message_tab" style="border-collapse: collapse;">
                                    <?php if ($this->_var['order_info']): ?>
                                    <tr>
                                      <td align="right"><?php echo $this->_var['lang']['order_number']; ?></td>
                                      <td>
                                      <a href ="<?php echo $this->_var['order_info']['url']; ?>"><img src="themes/default/images/note.gif" /><?php echo $this->_var['order_info']['order_sn']; ?></a>
                                      <input name="msg_type" type="hidden" value="5" />
                                      <input name="order_id" type="hidden" value="<?php echo $this->_var['order_info']['order_id']; ?>" class="inputBg" />
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right"><?php echo $this->_var['lang']['message_title']; ?>：</td>
                                      <td>
                                      <input name="msg_title" type="text" size="30" class="message_title" />
                                      </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr class="th_tab">
                                    <td colspan='2'>
                                    <div class='cmt-top-title'>
                                    <div class="tit-join"><span>发送消息</span></div>
                                    <div class="action-login"><span><?php echo $this->_var['lang']['message_type']; ?>：</span><select name="msg_type" class="message_msg_type">
                                        <option value="0"><?php echo $this->_var['lang']['type']['0']; ?></option>
                                        <option value="1"><?php echo $this->_var['lang']['type']['1']; ?></option>
                                        <option value="2"><?php echo $this->_var['lang']['type']['2']; ?></option>
                                        <option value="3"><?php echo $this->_var['lang']['type']['3']; ?></option>
                                        <option value="4"><?php echo $this->_var['lang']['type']['4']; ?></option>
                                        </select><span><?php echo $this->_var['lang']['message_title']; ?>：</span><input name="msg_title" type="text" size="30" class="message_title" /></div>
                                    </div>
                                    </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                      <td colspan='2'>
                                      <div class="textarea-b">
                                      <textarea name="msg_content" cols="50" rows="4" wrap="virtual" class="textarea-fw"></textarea>
                                      </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right"><?php echo $this->_var['lang']['upload_img']; ?>：</td>
                                      <td ><input type="file" name="message_img"  size="45"  class="inputBg" /></td>
                                    </tr>
                                    <tr>
                                      
                                      <td colspan='2' align='right'><input type="hidden" name="act" value="act_add_message" />
                                        <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_bonus" />
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan='2' align='right'>
                                      <?php echo $this->_var['lang']['img_type_tips']; ?>
                                      <?php echo $this->_var['lang']['img_type_list']; ?>
                                      </td>
                                    </tr>
                                  </table>
                                </form>
                               </div>
                         <?php endif; ?>
                         
                         
                          <?php if ($this->_var['action'] == 'comment_list'): ?>
                          <div class="mod-main mod-comm">
                          <div class="mt"><h3><?php echo $this->_var['lang']['label_comment']; ?></h3></div>
                          <div class="mc">
                          <div class="blank"></div>
                          <?php $_from = $this->_var['comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
                          <div class="f_l">
                          <b><?php if ($this->_var['comment']['comment_type'] == '0'): ?><?php echo $this->_var['lang']['goods_comment']; ?><?php else: ?><?php echo $this->_var['lang']['article_comment']; ?><?php endif; ?>: </b><font class="f4"><?php echo $this->_var['comment']['cmt_name']; ?></font>&nbsp;&nbsp;(<?php echo $this->_var['comment']['formated_add_time']; ?>)
                          </div>
                          <div class="f_r">
                          <a href="user.php?act=del_cmt&amp;id=<?php echo $this->_var['comment']['comment_id']; ?>" title="<?php echo $this->_var['lang']['drop']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_msg']; ?>')) return false;" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
                          </div>
                          <div class="msgBottomBorder">
                          <?php echo htmlspecialchars($this->_var['comment']['content']); ?><br />
                          <?php if ($this->_var['comment']['reply_content']): ?>
                          <b><?php echo $this->_var['lang']['reply_comment']; ?>：</b><br />
                          <?php echo $this->_var['comment']['reply_content']; ?>
                           <?php endif; ?>
                          </div>
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          <?php if ($this->_var['comment_list']): ?>
                          <?php echo $this->fetch('library/pages.lbi'); ?>
                          <?php else: ?>
                          <?php echo $this->_var['lang']['no_comments']; ?>
                          <?php endif; ?>
                          
                          </div>
                          </div>
                          <?php endif; ?>
                    
                    
                    <?php if ($this->_var['action'] == 'tag_list'): ?>
                    
                    <h5><span><?php echo $this->_var['lang']['label_tag']; ?></span></h5>
                    <div class="blank"></div>
                     <?php if ($this->_var['tags']): ?>
                    <?php $_from = $this->_var['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
                    <a href="search.php?keywords=<?php echo urlencode($this->_var['tag']['tag_words']); ?>" class="f6"><?php echo htmlspecialchars($this->_var['tag']['tag_words']); ?></a> <a href="user.php?act=act_del_tag&amp;tag_words=<?php echo urlencode($this->_var['tag']['tag_words']); ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_drop_tag']; ?>')) return false;" title="<?php echo $this->_var['lang']['drop']; ?>"><img src="themes/default/images/drop.gif" alt="<?php echo $this->_var['lang']['drop']; ?>" /></a>&nbsp;&nbsp;
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php else: ?>
                    <span style="margin:2px 10px; font-size:14px; line-height:36px;"><?php echo $this->_var['lang']['no_tag']; ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                    
                    
                    <?php if ($this->_var['action'] == 'collection_list'): ?>
                  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js,compare.js')); ?>
                  <script type="text/javascript">
                  window.onload = function()
                  {
                   Compare.init();
                   fixpng();
                   }
                  <?php $_from = $this->_var['lang']['compare_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                  <?php if ($this->_var['key'] != 'button_compare'): ?>
                  var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                  <?php else: ?>
                  var button_compare = '';
                   <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
                  var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
                  var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
                  var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
                 </script>
                 
                  <div class="mod-main mod-comm">
                  <div class="mt">
                    <h3 class="collection_curr"><?php echo $this->_var['lang']['label_collection']; ?></h3>
                  </div>
                  <?php if ($this->_var['goods_list']): ?>
                  <div class="mt">
                  <div class="fav-toolbar">
                  <div class="toolbar-l">
                  <input type="checkbox" class="jdcheckbox" name='prodcutListAllCheck' onclick="allcheck_prodcut(this)"/><label>全选</label>
                  <a class="ftx-05 ml10 btn-addcart" href="javascript:void(0)"><?php echo $this->_var['lang']['add_to_cart']; ?></a>
                  <a class="ftx-05 ml10" href="javascript:check_delete_collection()">取消收藏</a>
                  </div>
                  </div>
                  </div>
                    <div class="mc">
                    <div class="fav-goods-list">
                    <ul>
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <li>
                    <div class="fav-goods-item fav-goods-item-hover">
                    <div class="p-img"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="160" height="160" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" style="vertical-align: middle;"/></a></div>
                    <div class="p-name"><input type="checkbox" class="jdcheckbox" name="sku" value="<?php echo $this->_var['goods']['rec_id']; ?>" /><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" target="_blank"><?php echo sub_str(htmlspecialchars($this->_var['goods']['goods_name']),"45"); ?></a></div>
                    <div class="p-price"><strong><?php echo $this->_var['goods']['shop_price']; ?></strong><span><?php echo $this->_var['goods']['sale_count']; ?>人购买</span></div>
                    <div class="p-opbtns">
                    <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn"><?php echo $this->_var['lang']['add_to_cart']; ?></a>
                    <a href="javascript:void(0)" onclick="Compare.add(<?php echo $this->_var['goods']['goods_id']; ?>,'<?php echo $this->_var['goods']['goods_name']; ?>','<?php echo $this->_var['goods']['goods_thumb']; ?>','<?php echo $this->_var['goods']['goods_type']; ?>','<?php echo $this->_var['goods']['shop_price']; ?>')" class="btn"><?php echo $this->_var['lang']['compare']; ?></a>
                    <a href="javascript:jConfirm('<?php echo $this->_var['lang']['remove_collection_confirm']; ?>',function(){location.href='user.php?act=delete_collection&collection_id=<?php echo $this->_var['goods']['rec_id']; ?>';},'馨清网') " class="btn"><?php echo $this->_var['lang']['drop']; ?></a>
                    </div>
                    </div>
                    </li>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </ul>
                    </div>
                    <?php else: ?>
                    <div class="blockalign pt100">
                    <div class="item-fore"><h3 class="ftx-04 mt20">您还没有关注过任何商品哦</h3></div>
                    </div>
                    <?php endif; ?>
                    </div>
                    <?php echo $this->fetch('library/pages.lbi'); ?>
                    </div>
                  <?php endif; ?>
                  
                    
                    
                    <?php if ($this->_var['action'] == 'booking_list'): ?>
                    
                    <h5><span><?php echo $this->_var['lang']['label_booking']; ?></span></h5>
                    <div class="blank"></div>
                     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                      <tr align="center">
                        <td width="20%" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_goods_name']; ?></td>
                        <td width="10%" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_amount']; ?></td>
                        <td width="20%" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_time']; ?></td>
                        <td width="35%" bgcolor="#ffffff"><?php echo $this->_var['lang']['process_desc']; ?></td>
                        <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
                      </tr>
                      <?php $_from = $this->_var['booking_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
                      <tr>
                        <td align="left" bgcolor="#ffffff"><a href="<?php echo $this->_var['item']['url']; ?>" target="_blank" class="f6"><?php echo $this->_var['item']['goods_name']; ?></a></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['goods_number']; ?></td>
                        <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['booking_time']; ?></td>
                        <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['dispose_note']; ?></td>
                        <td align="center" bgcolor="#ffffff"><a href="javascript:if (confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) location.href='user.php?act=act_del_booking&id=<?php echo $this->_var['item']['rec_id']; ?>'" class="f6"><?php echo $this->_var['lang']['drop']; ?></a> </td>
                      </tr>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </table>
                    <?php endif; ?>
                    <div class="blank5"></div>


                  
                  <?php if ($this->_var['action'] == 'talent_collection_list'): ?>
                  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js')); ?>
                    <h5><span>人才收藏</span></h5>
                    <div class="blank"></div>
                     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                      <tr align="center">
                        <th width="35%" bgcolor="#ffffff">人才姓名</th>
                        <th width="30%" bgcolor="#ffffff">收藏时间</th>
                        <th width="35%" bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></th>
                      </tr>
                      <?php $_from = $this->_var['talent_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'talent');if (count($_from)):
    foreach ($_from AS $this->_var['talent']):
?>
                      <tr>
                        <td align="center" bgcolor="#ffffff"><a href="<?php echo $this->_var['talent']['url']; ?>" class="f6" target="_blank"><?php echo htmlspecialchars($this->_var['talent']['name']); ?></a></td>
                        <td align="center" bgcolor="#ffffff">
                          <span class="goods-price"><?php echo $this->_var['talent']['add_time']; ?></span></td>
                        <td align="center" bgcolor="#ffffff">
                           <a href="<?php echo $this->_var['talent']['url']; ?>" class="f6" target="_blank">查看</a> 
                           <a href="javascript:if (confirm('您确定要删除此人才吗?')) location.href='user.php?act=delete_talent_collection&collection_id=<?php echo $this->_var['talent']['rec_id']; ?>'" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
                        </td>
                      </tr>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </table>
                    <?php echo $this->fetch('library/pages.lbi'); ?>
                     <?php endif; ?>


                  
                  <?php if ($this->_var['action'] == 'talent_request'): ?>
                  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js')); ?>
                    <h5><span>输送记录</span></h5>
                    <div class="blank"></div>
                     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                      <tr align="center">
                        <th width="25%" bgcolor="#ffffff">人才姓名</th>
                        <th width="25%" bgcolor="#ffffff">申请时间</th>
                        <th width="25%" bgcolor="#ffffff">回复状态</th>
                        <th width="25%" bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></th>
                      </tr>
                      <?php $_from = $this->_var['talent_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'talent');if (count($_from)):
    foreach ($_from AS $this->_var['talent']):
?>
                      <tr>
                        <td align="center" bgcolor="#ffffff"><a href="<?php echo $this->_var['talent']['url']; ?>" class="f6" target="_blank"><?php echo htmlspecialchars($this->_var['talent']['name']); ?></a></td>
                        <td align="center" bgcolor="#ffffff">
                          <span class="goods-price"><?php echo $this->_var['talent']['msg_time']; ?></span></td>
                        <td align="center" bgcolor="#ffffff">
                          <?php if (! empty ( $this->_var['talent']['reply'] )): ?>已回复<?php else: ?>未回复<?php endif; ?></td>
                        <td align="center" bgcolor="#ffffff">
                           <?php if (! empty ( $this->_var['talent']['reply'] )): ?>
                            <a href="javascript:showReply(<?php echo $this->_var['talent']['msg_id']; ?>)" class="f6" id="reply_text_<?php echo $this->_var['talent']['msg_id']; ?>">查看回复</a> 
                           <?php endif; ?>
                           <a href="javascript:if (confirm('您确定要删除此人才吗?')) location.href='user.php?act=delete_talent_request&msg_id=<?php echo $this->_var['talent']['msg_id']; ?>'" class="f6"><?php echo $this->_var['lang']['drop']; ?></a>
                        </td>
                      </tr>

                      <tr id="reply_<?php echo $this->_var['talent']['msg_id']; ?>" style="display:none;background:#fff;color:#f00;">
                        <td colspan="4" >
                          回复内容：<?php echo $this->_var['talent']['reply']; ?>
                        </td>
                      </tr>

                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </table>
                    <?php echo $this->fetch('library/pages.lbi'); ?>
                     <?php endif; ?>


                   
                  <?php if ($this->_var['action'] == 'add_booking'): ?>
                    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
                    <script type="text/javascript">
                    <?php $_from = $this->_var['lang']['booking_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
                    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </script>
                    <h5><span><?php echo $this->_var['lang']['add']; ?><?php echo $this->_var['lang']['label_booking']; ?></span></h5>
                    <div class="blank"></div>
                     <form action="user.php" method="post" name="formBooking" onsubmit="return addBooking();">
                     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                      <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_goods_name']; ?></td>
                        <td bgcolor="#ffffff"><?php echo $this->_var['info']['goods_name']; ?></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_amount']; ?>:</td>
                        <td bgcolor="#ffffff"><input name="number" type="text" value="<?php echo $this->_var['info']['goods_number']; ?>" class="inputBg" /></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['describe']; ?>:</td>
                        <td bgcolor="#ffffff"><textarea name="desc" cols="50" rows="5" wrap="virtual" class="B_blue"><?php echo $this->_var['goods_attr']; ?><?php echo htmlspecialchars($this->_var['info']['goods_desc']); ?></textarea>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['contact_username']; ?>:</td>
                        <td bgcolor="#ffffff"><input name="linkman" type="text" value="<?php echo htmlspecialchars($this->_var['info']['consignee']); ?>" size="25"  class="inputBg"/>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['email_address']; ?>:</td>
                        <td bgcolor="#ffffff"><input name="email" type="text" value="<?php echo htmlspecialchars($this->_var['info']['email']); ?>" size="25" class="inputBg" /></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['contact_phone']; ?>:</td>
                        <td bgcolor="#ffffff"><input name="tel" type="text" value="<?php echo htmlspecialchars($this->_var['info']['tel']); ?>" size="25" class="inputBg" /></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#ffffff">&nbsp;</td>
                        <td bgcolor="#ffffff"><input name="act" type="hidden" value="act_add_booking" />
                          <input name="id" type="hidden" value="<?php echo $this->_var['info']['id']; ?>" />
                          <input name="rec_id" type="hidden" value="<?php echo $this->_var['info']['rec_id']; ?>" />
                          <input type="submit" name="submit" class="submit" value="<?php echo $this->_var['lang']['submit_booking_goods']; ?>" />
                          <input type="reset" name="reset" class="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
                        </td>
                      </tr>
                    </table>
                     </form>
                    <?php endif; ?>
                    
                    <?php if ($this->_var['affiliate']['on'] == 1): ?>
                     <?php if ($this->_var['action'] == 'affiliate'): ?>
                      <?php if (! $this->_var['goodsid'] || $this->_var['goodsid'] == 0): ?>
                      <h5><span><?php echo $this->_var['lang']['affiliate_detail']; ?></span></h5>
                      <div class="blank"></div>
                     <?php echo $this->_var['affiliate_intro']; ?>
                    <?php if ($this->_var['affiliate']['config']['separate_by'] == 0): ?>
                    
                    <div class="blank"></div>
                    <h5><span><a name="myrecommend"><?php echo $this->_var['lang']['affiliate_member']; ?></a></span></h5>
                    <div class="blank"></div>
                   <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_lever']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_num']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['level_point']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['level_money']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['affdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('level', 'val');$this->_foreach['affdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['affdb']['total'] > 0):
    foreach ($_from AS $this->_var['level'] => $this->_var['val']):
        $this->_foreach['affdb']['iteration']++;
?>
                    <tr align="center">
                      <td bgcolor="#ffffff"><?php echo $this->_var['level']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['val']['num']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['val']['point']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['val']['money']; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </table>
                
                <?php else: ?>
                
                
                <?php endif; ?>
                
                <div class="blank"></div>
                <h5><span>分成规则</span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_money']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_point']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_mode']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_status']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['logdb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['logdb']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['logdb']['iteration']++;
?>
                    <tr align="center">
                      <td bgcolor="#ffffff"><?php echo $this->_var['val']['order_sn']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['val']['money']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['val']['point']; ?></td>
                      <td bgcolor="#ffffff"><?php if ($this->_var['val']['separate_type'] == 1 || $this->_var['val']['separate_type'] === 0): ?><?php echo $this->_var['lang']['affiliate_type'][$this->_var['val']['separate_type']]; ?><?php else: ?><?php echo $this->_var['lang']['affiliate_type'][$this->_var['affiliate_type']]; ?><?php endif; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_stats'][$this->_var['val']['is_separate']]; ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                <tr><td colspan="5" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['no_records']; ?></td>
                </tr>
                    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php if ($this->_var['logdb']): ?>
                    <tr>
                    <td colspan="5" bgcolor="#ffffff">
                 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                  <div id="pager"> <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span> <a href="<?php echo $this->_var['pager']['page_first']; ?>"><?php echo $this->_var['lang']['page_first']; ?></a> <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a> <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> </span>
                    <select name="page" id="page" onchange="selectPage(this)">
                    <?php echo $this->html_options(array('options'=>$this->_var['pager']['array'],'selected'=>$this->_var['pager']['page'])); ?>
                    </select>
                    <input type="hidden" name="act" value="affiliate" />
                  </div>
                </form>
                    </td>
                    </tr>
                    <?php endif; ?>
                  </table>
                 <script type="text/javascript" language="JavaScript">
                <!--
                
                function selectPage(sel)
                {
                  sel.form.submit();
                }
                
                //-->
                </script>
                
                <div class="blank"></div>
                <h5><span><?php echo $this->_var['lang']['affiliate_code']; ?></span></h5>
                <div class="blank"></div>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                <tr>
                <td width="30%" bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" class="f6"><?php echo $this->_var['shopname']; ?></a></td>
                <td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="&lt;a href=&quot;<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>&quot; target=&quot;_blank&quot;&gt;<?php echo $this->_var['shopname']; ?>&lt;/a&gt;" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_webcode']; ?></td>
                </tr>
                <tr>
                <td bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" title="<?php echo $this->_var['shopname']; ?>"  class="f6"><img src="<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>" /></a></td>
                <td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="&lt;a href=&quot;<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>&quot; target=&quot;_blank&quot; title=&quot;<?php echo $this->_var['shopname']; ?>&quot;&gt;&lt;img src=&quot;<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>&quot; /&gt;&lt;/a&gt;" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_webcode']; ?></td>
                </tr>
                <tr>
                <td bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" class="f6"><?php echo $this->_var['shopname']; ?></a></td>
                <td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="[url=<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>]<?php echo $this->_var['shopname']; ?>[/url]" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_bbscode']; ?></td>
                </tr>
                <tr>
                <td bgcolor="#ffffff"><a href="<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>" target="_blank" title="<?php echo $this->_var['shopname']; ?>" class="f6"><img src="<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>" /></a></td>
                <td bgcolor="#ffffff"><input size="40" onclick="this.select();" type="text" value="[url=<?php echo $this->_var['shopurl']; ?>?u=<?php echo $this->_var['userid']; ?>][img]<?php echo $this->_var['shopurl']; ?><?php echo $this->_var['logosrc']; ?>[/img][/url]" style="border:1px solid #ccc;" /> <?php echo $this->_var['lang']['recommend_bbscode']; ?></td>
                </tr>
                </table>

                        <?php else: ?>
                        
                        <style type="text/css">
                        .types a{text-decoration:none; color:#006bd0;}
                        </style>
                    <h5><span><?php echo $this->_var['lang']['affiliate_code']; ?></span></h5>
                    <div class="blank"></div>
                  <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                    <tr align="center">
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_view']; ?></td>
                      <td bgcolor="#ffffff"><?php echo $this->_var['lang']['affiliate_code']; ?></td>
                    </tr>
                    <?php $_from = $this->_var['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from AS $this->_var['val']):
        $this->_foreach['types']['iteration']++;
?>
                    <tr align="center">
                      <td bgcolor="#ffffff" class="types"><script src="<?php echo $this->_var['shopurl']; ?>affiliate.php?charset=<?php echo $this->_var['ecs_charset']; ?>&gid=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>&type=<?php echo $this->_var['val']; ?>"></script></td>
                      <td bgcolor="#ffffff">javascript <?php echo $this->_var['lang']['affiliate_codetype']; ?><br>
                        <textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>" style="border:1px solid #ccc;"><script src="<?php echo $this->_var['shopurl']; ?>affiliate.php?charset=<?php echo $this->_var['ecs_charset']; ?>&gid=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>&type=<?php echo $this->_var['val']; ?>"></script></textarea>[<a href="#" title="Copy To Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');"  class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]
                <br>iframe <?php echo $this->_var['lang']['affiliate_codetype']; ?><br><textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>_iframe"  style="border:1px solid #ccc;"><iframe width="250" height="270" src="<?php echo $this->_var['shopurl']; ?>affiliate.php?charset=<?php echo $this->_var['ecs_charset']; ?>&gid=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>&type=<?php echo $this->_var['val']; ?>&display_mode=iframe" frameborder="0" scrolling="no"></iframe></textarea>[<a href="#" title="Copy To Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>_iframe').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');" class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]
                <br /><?php echo $this->_var['lang']['bbs']; ?>UBB <?php echo $this->_var['lang']['affiliate_codetype']; ?><br /><textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>_ubb"  style="border:1px solid #ccc;"><?php if ($this->_var['val'] != 5): ?>[url=<?php echo $this->_var['shopurl']; ?>goods.php?id=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>][img]<?php if ($this->_var['val'] < 3): ?><?php echo $this->_var['goods']['goods_thumb']; ?><?php else: ?><?php echo $this->_var['goods']['goods_img']; ?><?php endif; ?>[/img][/url]<?php endif; ?>

                [url=<?php echo $this->_var['shopurl']; ?>goods.php?id=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?>][b]<?php echo $this->_var['goods']['goods_name']; ?>[/b][/url]
                <?php if ($this->_var['val'] != 1 && $this->_var['val'] != 3): ?>[s]<?php echo $this->_var['goods']['market_price']; ?>[/s]<?php endif; ?> [color=red]<?php echo $this->_var['goods']['shop_price']; ?>[/color]</textarea>[<a href="#" title="Copy To Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>_ubb').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');"  class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]
                <?php if ($this->_var['val'] == 5): ?><br /><?php echo $this->_var['lang']['im_code']; ?> <?php echo $this->_var['lang']['affiliate_codetype']; ?><br /><textarea cols=30 rows=2 id="txt<?php echo $this->_foreach['types']['iteration']; ?>_txt"  style="border:1px solid #ccc;"><?php echo $this->_var['lang']['show_good_to_you']; ?> <?php echo $this->_var['goods']['goods_name']; ?>

                <?php echo $this->_var['shopurl']; ?>goods.php?id=<?php echo $this->_var['goodsid']; ?>&u=<?php echo $this->_var['userid']; ?></textarea>[<a href="#" title="Copy To Clipboard" onClick="Javascript:copyToClipboard(document.getElementById('txt<?php echo $this->_foreach['types']['iteration']; ?>_txt').value);alert('<?php echo $this->_var['lang']['copy_to_clipboard']; ?>');"  class="f6"><?php echo $this->_var['lang']['code_copy']; ?></a>]<?php endif; ?></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </table>
                <script language="Javascript">
                copyToClipboard = function(txt)
                {
                 if(window.clipboardData)
                 {
                    window.clipboardData.clearData();
                    window.clipboardData.setData("Text", txt);
                 }
                 else if(navigator.userAgent.indexOf("Opera") != -1)
                 {
                   //暂时无方法:-(
                 }
                 else if (window.netscape)
                 {
                  try
                  {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                  }
                  catch (e)
                  {
                    alert("<?php echo $this->_var['lang']['firefox_copy_alert']; ?>");
                    return false;
                  }
                  var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
                  if (!clip)
                    return;
                  var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
                  if (!trans)
                    return;
                  trans.addDataFlavor('text/unicode');
                  var str = new Object();
                  var len = new Object();
                  var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
                  var copytext = txt;
                  str.data = copytext;
                  trans.setTransferData("text/unicode",str,copytext.length*2);
                  var clipid = Components.interfaces.nsIClipboard;
                  if (!clip)
                  return false;
                  clip.setData(trans,null,clipid.kGlobalClipboard);
                 }
                }
                                </script>
                            
                            <?php endif; ?>
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
