<div class='mg-left'>
<div class="ui-scrollbar-wrap">
<div class='mg-noticelist'>
<div class="ui-scrollbar-main">
<ul>
<a href="user.php?act=message_list">
<li class="mg-types <?php if ($this->_var['action'] == 'message_list' && $this->_var['order_info']['order_id'] == ''): ?>mg-types-cur <?php endif; ?>">
<span class="mg-timg actimg"></span>
<div class="mg-tcont">
<div class="mg-ttitle"><div style="float: left;width: 80px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><a href='user.php?act=message_list'>系统消息</a></div></div>
<div class="mg-illus"><div style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 135px;float: left;"><?php if ($this->_var['message_count']['message_count']): ?><font><?php echo $this->_var['message_count']['message_count']; ?>条消息</font><?php else: ?><font>暂无消息</font><?php endif; ?></div></div>
</div>
</a>
</li>
<a href="user.php?act=comment_list">
<li class="mg-types <?php if ($this->_var['action'] == 'comment_list'): ?>mg-types-cur<?php endif; ?>">
<span class="mg-timg simg" ></span>
<div class="mg-tcont">
<div class="mg-ttitle"><div style="float: left;width: 80px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><a href="user.php?act=comment_list"><?php echo $this->_var['lang']['label_comment']; ?></a></div></div>
<div class="mg-illus"><div style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 135px;float: left;"><?php if ($this->_var['message_count']['comment_count']): ?><font><?php echo $this->_var['message_count']['comment_count']; ?>条消息</font><?php else: ?><font>暂无消息</font><?php endif; ?></div></div>
</div>
</a>
</li>
<?php if ($this->_var['order_info']): ?>
<li class="mg-types mg-types-cur">
<span class="mg-timg runimg" ></span>
<div class="mg-tcont">
<div class="mg-ttitle"><div style="float: left;width: 80px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><a href="user.php?act=message_list&order_id=1">系统通知</a></div></div>
<div class="mg-illus"><div style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 135px;float: left;"><?php if ($this->_var['message_count']['order_message_count']): ?><font><?php echo $this->_var['message_count']['order_message_count']; ?>条消息</font><?php else: ?><font>暂无消息</font><?php endif; ?></div></div>
</div>
</li>
<?php endif; ?>
</ul>
</div>
</div>
</div>
</div>