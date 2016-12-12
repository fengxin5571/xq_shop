<?php echo $this->fetch('library/user_header.lbi'); ?>
<form action="<?php echo url('user/edit_password');?>" method="post" name="getPassword2" onSubmit="return submitPwd()">
  <div class="flow-consignee ect-bg-colorf" id="tabBox1-bd">
    <ul>
      <li>
        <div class="input-text"><b><?php echo $this->_var['lang']['new_password']; ?>：</b> <span>
          <input placeholder="<?php echo $this->_var['lang']['new_password']; ?>" name="new_password" type="password" class="inputBg" />
          </span></div>
      </li>
      <li>
        <div class="input-text"><b><?php echo $this->_var['lang']['confirm_password']; ?>:</b><span>
          <input placeholder="<?php echo $this->_var['lang']['confirm_password']; ?>" name="confirm_password" type="password" class="inputBg"/>
          </span></div>
      </li>
    </ul>
  </div>
  <div class="ect-padding-lr ect-padding-tb">
    <input type="hidden" name="uid" value="<?php echo $this->_var['uid']; ?>" />
    <?php if ($this->_var['code']): ?>
    <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
    <?php endif; ?> 
    <?php if ($this->_var['mobile']): ?>
    <input type="hidden" name="mobile" value="<?php echo $this->_var['mobile']; ?>" />
    <?php endif; ?> 
    <?php if ($this->_var['question']): ?>
    <input type="hidden" name="question" value="<?php echo $this->_var['question']; ?>" />
    <?php endif; ?>
    <input name="Submit" type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="btn btn-info ect-btn-info ect-colorf ect-bg">
  </div>
</form>
</div>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript">
<?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>