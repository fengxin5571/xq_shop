<?php if ($this->_var['user_info']): ?>
<font style="position:relative;float:left ">
<?php echo $this->_var['lang']['hello']; ?>! <font class="f4_b_top"><?php echo $this->_var['user_info']['username']; ?></font>, <?php echo $this->_var['lang']['welcome_return']; ?>！|
 
 <a href="user.php?act=logout"><?php echo $this->_var['lang']['user_logout']; ?></a>
</font>
<?php else: ?>
<font style="position:relative;float:left ">
<a href="login.html" ><?php echo $this->_var['lang']['label_login_top']; ?></a>|
<a href="register.html" ><?php echo $this->_var['lang']['label_regist_top']; ?></a>
</font>
<?php endif; ?>