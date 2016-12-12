<?php echo $this->fetch('library/user_header.lbi'); ?>
<form action="<?php echo url('user/service');?>" method="post" enctype="multipart/form-data" name="formMsg" onSubmit="return submitMsg()">
  <section class="ect-bg-colorf user-service flow-consignee">
    <ul>
      <li class="ect-radio">
        <input name="msg_type" type="radio" id="msg-type0" checked="checked" value="0">
        <label for="msg-type0"><?php echo $this->_var['lang']['type']['0']; ?><i></i></label>
        &nbsp;
        <input name="msg_type" type="radio" id="msg-type1" value="1">
        <label for="msg-type1"><?php echo $this->_var['lang']['type']['1']; ?><i></i></label>
        &nbsp;
        <input name="msg_type" type="radio" id="msg-type2" value="2">
        <label for="msg-type2"><?php echo $this->_var['lang']['type']['2']; ?><i></i></label>
        &nbsp;
        <input name="msg_type" type="radio" id="msg-type3" value="3">
        <label for="msg-type3"><?php echo $this->_var['lang']['type']['3']; ?><i></i></label>
        &nbsp;
        <input name="msg_type" type="radio" id="msg-type4" value="4">
        <label for="msg-type4"><?php echo $this->_var['lang']['type']['4']; ?><i></i></label>
        &nbsp; </li>
      <li>
        <div class="input-text"><b><?php echo $this->_var['lang']['message_title']; ?>：</b><span>
          <input name="msg_title" type="text" placeholder="<?php echo $this->_var['lang']['message_title']; ?>">
          </span></div>
      </li>
      <li>
        <div class="input-text"><b><?php echo $this->_var['lang']['message_content']; ?>：</b>
          <textarea name="msg_content" placeholder="<?php echo $this->_var['lang']['message_content']; ?>" cols="50" rows="4" wrap="virtual"></textarea>
        </div>
      </li>
    </ul>
  </section>
  <div class="two-btn ect-padding-tb ect-padding-lr ect-margin-tb text-center">
    <input type="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="btn btn-info" />
  </div>
</form>
</div>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>