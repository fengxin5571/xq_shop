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
<a href="user_info.html"<?php if ($this->_var['action'] == 'profile' || $this->_var['action'] == 'userinfo_headimg'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_profile']; ?></a>
<a href="safety_center.html" <?php if ($this->_var['action'] == 'safetycenter'): ?>class="curs"<?php endif; ?>><span>账户安全</span></a>
<a href="account_union.html" <?php if ($this->_var['action'] == 'account_union'): ?>class="curs"<?php endif; ?>><span>账户绑定</span></a>
<a href="address_list.html"<?php if ($this->_var['action'] == 'address_list'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_address']; ?></a>
<!--<a href="user.php?act=account_log"<?php if ($this->_var['action'] == 'account_log'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_user_surplus']; ?></a> -->
<div style="padding-bottom: 15px;"></div>
<a href="javascript:void()"class="big-title">资产中心</a> 
<a href="user.php?act=bonus"<?php if ($this->_var['action'] == 'bonus'): ?>class="curs"<?php endif; ?>> <?php echo $this->_var['lang']['label_bonus']; ?></a> 
</div>