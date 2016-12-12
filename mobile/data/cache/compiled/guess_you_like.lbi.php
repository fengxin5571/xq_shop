<div class="ect-margin-tb ect-pro-list1 ect-margin-bottom0" style="border-bottom:none;background-color: #f7f7f7;;" >
<div class="gray-text"><span class="gray-layout"><span class="gray-text-img"></span>为您推荐</span></div>
<ul class="find-similar-ul cf" style="overflow: hidden;">
<?php $_from = $this->_var['get_guess_you_like']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <li class="similar-li"><a href="<?php echo $this->_var['goods']['goods_url']; ?>">
<div class="similar-product">
<img  style='height:200px' src="<?php echo $this->_var['goods']['goods_img']; ?>" style="" alt="<?php echo $this->_var['goods']['goods_name']; ?>" />
<span class="similar-product-text"><?php echo $this->_var['goods']['goods_name']; ?></span>
<span class="similar-product-price"><span class="big-price"><?php echo $this->_var['goods']['shop_price']; ?></span></span>
</div>
</a></li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>
</div>