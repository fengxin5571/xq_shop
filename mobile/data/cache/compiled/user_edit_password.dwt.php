<?php echo $this->fetch('library/user_header.lbi'); ?>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>
  <form name="formPassword" action="<?php echo url('user/edit_password');?>" method="post" onSubmit="return editPassword()" >
  <section class="flow-consignee ect-bg-colorf">
   		<ul>
       	  <li>
       	    <div class="input-text"><b class="pull-left"><?php echo $this->_var['lang']['old_password']; ?>：</b><span>
   	        <input placeholder="<?php echo $this->_var['lang']['old_password']; ?>" name="old_password" type="password"></span></div></li>
          <li>
            <div class="input-text"><b><?php echo $this->_var['lang']['new_password']; ?>：</b><span>
            <input placeholder="<?php echo $this->_var['lang']['new_password']; ?>" name="new_password" type="password"></span></div></li>
          <li><div class="input-text"><b><?php echo $this->_var['lang']['confirm_password']; ?>：</b><span><input placeholder="<?php echo $this->_var['lang']['confirm_password']; ?>" name="comfirm_password" type="password"></span></div></li>
        </ul>
   </section>
   <input name="act" type="hidden" value="edit_password" />
   <div class="two-btn ect-padding-tb ect-padding-lr ect-margin-tb text-center">
        <input name="submit" type="submit" class="btn btn-info" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
   </div>
   </form>
</div>


</div>
<?php echo $this->fetch('library/search.lbi'); ?>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>