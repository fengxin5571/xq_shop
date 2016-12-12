<?php if ($this->_var['best_goods']): ?>
<div class="m-box-s1">
  <div class="mt"><strong class="mt-title">商品精选</strong></div>
  <div class="mc">
  <ul class="goods-chosen-list">
  <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good_0_37872200_1480915372');if (count($_from)):
    foreach ($_from AS $this->_var['good_0_37872200_1480915372']):
?>
  <li>
  <div class="p-img"><a target="_blank" href="<?php echo $this->_var['good_0_37872200_1480915372']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['good_0_37872200_1480915372']['name']); ?>"><img src="<?php echo $this->_var['good_0_37872200_1480915372']['thumb']; ?>" width="190" height="190"/></a></div>
  <div class="p-name"><a target="_blank" href="<?php echo $this->_var['good_0_37872200_1480915372']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['good_0_37872200_1480915372']['name']); ?>"><em><?php echo htmlspecialchars($this->_var['good_0_37872200_1480915372']['name']); ?></em></a></div>
  <div class="p-price"><strong class="price"><?php if ($this->_var['good_0_37872200_1480915372']['promote_price'] != ""): ?><?php echo $this->_var['good_0_37872200_1480915372']['promote_price']; ?><?php else: ?><?php echo $this->_var['good_0_37872200_1480915372']['shop_price']; ?><?php endif; ?></strong></div>
  
  </li>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
  </div>
  </div>
  <?php endif; ?>