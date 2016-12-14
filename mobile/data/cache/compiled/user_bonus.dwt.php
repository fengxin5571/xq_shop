<?php echo $this->fetch('library/user_header.lbi'); ?>
 
<div class="user-account-detail user-bonus">
  <?php if ($this->_var['bonus']): ?>
  <ul>
	<?php $_from = $this->_var['bonus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    <li>
		<p class="title"><?php echo $this->_var['lang']['bonus_sn']; ?>：<?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?><span class="pull-right"><?php echo $this->_var['item']['status']; ?></span></p>
		
		<p class="content"><span class="remark pull-left"><?php echo $this->_var['lang']['bonus_amount']; ?>：<?php echo $this->_var['item']['type_money']; ?></span> <span class="pull-right text-right type"><?php echo $this->_var['lang']['bonus_name']; ?>：<?php echo $this->_var['item']['type_name']; ?></span></p>
		<p class="content"><span class="remark pull-left"><?php echo $this->_var['lang']['min_goods_amount']; ?>：<?php echo $this->_var['item']['min_goods_amount']; ?></span> <span class="pull-right text-right type"><?php echo $this->_var['lang']['bonus_end_date']; ?>：<?php echo $this->_var['item']['use_enddate']; ?></span></p>
	</li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
  <div class="deffbonus">
  <?php echo $this->fetch('library/page.lbi'); ?> 
  </div>
  <?php endif; ?>
  </div>

  <form action="<?php echo url('user/bonus');?>" method="post" onSubmit="return addBonus()" class="form-inline bonus-form-inline" role="form">
    <div class="form-group bonus-form-group">
	  <div class="form-group-text"><input type="text" class="form-control" name="bonus_sn" placeholder="<?php echo $this->_var['lang']['bonus_number']; ?>"/></div>
	  <input type="submit" class="input-group-addon ect-bg" value="<?php echo $this->_var['lang']['add_bonus']; ?>" />
	</div>
  </form>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>