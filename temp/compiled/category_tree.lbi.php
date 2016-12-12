
    <ul class="catelist but fl" >
      <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cat']):
?>
      <li>
        <h2><a href="<?php echo $this->_var['cat']['url']; ?>" class='but'><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></h2>
        <p>
        <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['catchild'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catchild']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['catchild']['iteration']++;
?>
          <?php if ($this->_foreach['catchild']['iteration'] <= 2): ?>
          <a href="<?php echo $this->_var['child']['url']; ?>"class="but"><?php echo sub_str(htmlspecialchars($this->_var['child']['name']),10); ?></a>
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </p>
        <div class="catebox">
        <div class='subitems'>
          <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['catchild'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catchild']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['catchild']['iteration']++;
?>
          <dl class="fore<?php echo $this->_foreach['catchild']['iteration']; ?>">
          <dt>
          <a href="<?php echo $this->_var['child']['url']; ?>"><?php echo htmlspecialchars($this->_var['child']['name']); ?></a>
          <i>></i>
          </dt>
          <dd>
          <?php $_from = $this->_var['child']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'childs');$this->_foreach['catchilds'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catchilds']['total'] > 0):
    foreach ($_from AS $this->_var['childs']):
        $this->_foreach['catchilds']['iteration']++;
?>
          <?php if ($this->_foreach['catchilds']['iteration'] <= 15): ?>
          <a href="<?php echo $this->_var['childs']['url']; ?>"><?php echo htmlspecialchars($this->_var['childs']['name']); ?></a>
          <?php endif; ?>
           <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </dd>
          </dl>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </div>
        </div>
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 

    </ul>