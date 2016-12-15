<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="ect-margin-tb ect-pro-list ect-margin-bottom0 ect-border-bottom0">
<?php if ($this->_var['collection_list']): ?>
  <ul>
  <?php $_from = $this->_var['collection_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
    <li class="single_item" id="more_element_1"> <a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['goods_id']));?>"><img src="<?php echo $this->_var['val']['goods_thumb']; ?>"></a>
      <dl>
        <dt>
          <h4 class="title"><a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['goods_id']));?>"><?php echo $this->_var['val']['goods_name']; ?></a></h4>
        </dt>
        <dd class="dd-price">
			<span class="pull-left"><strong><?php echo $this->_var['lang']['sort_price']; ?>：<b class="ect-colory"><?php echo $this->_var['val']['shop_price']; ?></b></strong><small class="ect-margin-lr"><del><?php echo $this->_var['val']['market_price']; ?></del></small></span>
			<span class="pull-right">
				<?php if ($this->_var['val']['is_attention']): ?>
				<a href="javascript:if (confirm('<?php echo $this->_var['lang']['del_attention']; ?>')) location.href='<?php echo url('user/del_attention', array('rec_id'=>$this->_var['val']['rec_id']));?>'" class="fa fa-eye-slash"><?php echo $this->_var['lang']['no_attention']; ?></a>
				<?php else: ?>
				<a href="javascript:if (confirm('<?php echo $this->_var['lang']['add_to_attention']; ?>')) location.href='<?php echo url('user/add_attention', array('rec_id'=>$this->_var['val']['rec_id']));?>'" class="fa fa-eye"><?php echo $this->_var['lang']['attention']; ?></a>
				<?php endif; ?>
			</span>
		</dd>
        <dd class="text-center">
			<a class="flow-del" href="javascript:addToCart(<?php echo $this->_var['val']['goods_id']; ?>)"><?php echo $this->_var['lang']['add_to_cart']; ?></a>
			<a class="flow-del" href="javascript:if(confirm('<?php echo $this->_var['lang']['remove_collection_confirm']; ?>')) location.href='<?php echo url('delete_collection', array('rec_id'=>$this->_var['val']['rec_id']));?>'"><?php echo $this->_var['lang']['drop']; ?></a>
		</dd>
      </dl>
    </li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
   <?php else: ?>
      <p class="text-center ect-margin-tb ect-padding-tb"><?php echo $this->_var['lang']['no_data']; ?></p>
   <?php endif; ?> 
</div>
<?php echo $this->fetch('library/page.lbi'); ?>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>
<script type="text/javascript">
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
</body>
</html>