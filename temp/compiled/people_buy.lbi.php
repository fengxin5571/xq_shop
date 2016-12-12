<div class="ab-goods mt20">
      <div class="mt"><h2>达人选购</h2></div>
      <div class="mc">
      <ul>
      <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');if (count($_from)):
    foreach ($_from AS $this->_var['good']):
?>
      <li>
      <div class="p-img"><a target="_blank" href="<?php echo $this->_var['good']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['good']['name']); ?>"><img src="<?php echo $this->_var['good']['thumb']; ?>" width="190" height="190"/></a></div>
      <div class="p-price"><strong class="price"><?php if ($this->_var['good']['promote_price'] != ""): ?><?php echo $this->_var['good']['promote_price']; ?><?php else: ?><?php echo $this->_var['good']['price']; ?><?php endif; ?></strong></div>
       <div class="p-name"><a target="_blank" href="<?php echo $this->_var['good']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['good']['goods_name']); ?>"><em><?php echo htmlspecialchars($this->_var['good']['goods_name']); ?></em></a></div>
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </ul>
      </div>
      </div> 
      