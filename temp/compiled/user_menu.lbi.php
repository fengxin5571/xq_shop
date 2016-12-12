<div class="userMenu">
<a href="javascript:void()"class="big-title">订单中心</a>
<a href="order_list.html"<?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'order_detail'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_order']; ?></a>
<a href="merge_order.html"<?php if ($this->_var['action'] == 'merge_order_ui'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['merge_order']; ?></a>
<a href="user.php?act=track_packages"<?php if ($this->_var['action'] == 'track_packages'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_track_packages']; ?></a>
<div style="padding-bottom: 15px;"></div>
<a href="javascript:void()"class="big-title">关注中心</a>
<a href="collection_list.html"<?php if ($this->_var['action'] == 'collection_list'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_collection']; ?></a>
<a href="history_list.html"<?php if ($this->_var['action'] == 'history_list'): ?>class="curs"<?php endif; ?>>我的足迹</a>
<div style="padding-bottom: 15px;"></div>
<a href="javascript:void()"class="big-title">客服服务</a>
<a href="user.php?act=service_list"<?php if ($this->_var['action'] == 'service_list'): ?>class="curs"<?php endif; ?>> 售后服务</a>
<div style="padding-bottom: 15px;"></div>
<a href="javascript:void()"class="big-title">设置</a>
<a href="user_info.html"<?php if ($this->_var['action'] == 'profile'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_profile']; ?></a>
<a href="safety_center.html" <?php if ($this->_var['action'] == 'safetycenter'): ?>class="curs"<?php endif; ?>><span>账户安全</span></a>
<a href="account_union.html" <?php if ($this->_var['action'] == 'account_union'): ?>class="curs"<?php endif; ?>><span>账户绑定</span></a>
<a href="address_list.html"<?php if ($this->_var['action'] == 'address_list'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_address']; ?></a>
<div style="padding-bottom: 15px;"></div>
 <a href="javascript:void()"class="big-title">资产中心</a> 
<!--<a href="user.php?act=tag_list"<?php if ($this->_var['action'] == 'tag_list'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_tag']; ?></a>-->
<!--<a href="user.php?act=booking_list"<?php if ($this->_var['action'] == 'booking_list'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_booking']; ?></a>-->

<a href="user.php?act=bonus"<?php if ($this->_var['action'] == 'bonus'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_bonus']; ?></a> 
<?php if ($this->_var['affiliate']['on'] == 1): ?><a href="user.php?act=affiliate"<?php if ($this->_var['action'] == 'affiliate'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_affiliate']; ?></a><?php endif; ?>
<!--<a href="user.php?act=group_buy"><?php echo $this->_var['lang']['label_group_buy']; ?></a>-->
<div style="padding-bottom: 15px;"></div>


<?php if ($this->_var['show_transform_points']): ?>
<a href="user.php?act=transform_points"<?php if ($this->_var['action'] == 'transform_points'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_transform_points']; ?></a>
<?php endif; ?>
<!--<a href="user.php?act=talent_collection_list"<?php if ($this->_var['action'] == 'talent_collection_list'): ?>class="curs"<?php endif; ?>> 人才收藏</a>-->
<!--<a href="user.php?act=talent_request"<?php if ($this->_var['action'] == 'talent_request'): ?>class="curs"<?php endif; ?>>人才输送</a>-->
<a href="user.php?act=logout" style="background:none; text-align:right; margin-right:10px;"></a>
</div>