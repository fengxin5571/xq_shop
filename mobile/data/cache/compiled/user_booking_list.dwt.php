<?php echo $this->fetch('library/user_header.lbi'); ?>
 <div class="ect-pro-list ect-booking-list">
  <ul>
  <?php $_from = $this->_var['booking_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    <li>
      <dl>
        <dt>
          <h4 class="title"><a href="<?php echo $this->_var['item']['url']; ?>"><?php echo $this->_var['item']['goods_name']; ?> <span>[订购数量：<?php echo $this->_var['item']['goods_number']; ?>]</span></a></h4>
        </dt>
        <dd class="date ect-color999"><?php echo $this->_var['item']['booking_time']; ?></dd>
        <dd><?php echo $this->_var['item']['dispose_note']; ?></dd>
        <dd><a href="javascript:if(confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')){window.location.href='<?php echo url('user/del_booking', array('rec_id'=>$this->_var['item']['rec_id']));?>'};" class="pull-right del"><i class="glyphicon glyphicon-trash"></i></a></dd>
      </dl>
    </li>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<?php echo $this->fetch('library/page.lbi'); ?>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>