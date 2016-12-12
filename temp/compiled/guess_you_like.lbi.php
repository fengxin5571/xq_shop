<div class="w1160px mt15">
<div id="guessyou" class="m">
<div class="mt"><h2>猜你喜欢</h2><a class="extra" href="javascript:; ">换一批</a></div>
<div class="mc">
<div class="spacer" ><i></i></div>
<ul id="guess_ul">
<?php $_from = $this->_var['get_guess_you_like']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['like'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['like']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['like']['iteration']++;
?>
<li class="fore<?php echo $this->_foreach['like']['iteration']; ?>"<?php if ($this->_foreach['like']['iteration'] > 6): ?>style="display:none"<?php endif; ?>>
<div class="p-img"><a href="<?php echo $this->_var['goods']['goods_url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="130" height="130" title="<?php echo $this->_var['goods']['goods_name']; ?>" class='sk_item_img err-product'/></a></div>
<div class="p-info">
<div class="p-name"><a href="<?php echo $this->_var['goods']['goods_url']; ?>" target="_blank" title="<?php echo $this->_var['goods']['goods_name']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></div>
<div class="p-price"><?php echo $this->_var['goods']['shop_price']; ?></div>
</div>
</li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<ul>
</div>

</div>
</div>
