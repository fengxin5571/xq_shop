
<form name="selectPageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<?php if ($this->_var['pager']['styleid'] == 0): ?>
<div id="pager">
  <div class="mg-page2 mt20 text-center clearfix">
      <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span> <a href="<?php echo $this->_var['pager']['page_first']; ?>"><?php echo $this->_var['lang']['page_first']; ?></a> <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a> <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> </span>
        <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_33117600_1480915372');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_33117600_1480915372']):
?>
          <?php if ($this->_var['key'] == 'keywords'): ?>
              <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item_0_33117600_1480915372']); ?>" />
            <?php else: ?>
              <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_33117600_1480915372']; ?>" />
          <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <select name="page" id="page" onchange="selectPage(this)">
        <?php echo $this->html_options(array('options'=>$this->_var['pager']['array'],'selected'=>$this->_var['pager']['page'])); ?>
        </select>
    </div>
</div>
<?php else: ?>


 <div id="pager" class="pagebar">
    <div class="mg-page mt20 text-center clearfix">
      <ul class="clearfix">
        <li style="margin-right:10px;"><?php echo $this->_var['lang']['pager_1']; ?><b><?php echo $this->_var['pager']['record_count']; ?></b> <?php echo $this->_var['lang']['pager_2']; ?></li>
        <?php if ($this->_var['pager']['page_prev']): ?>
          <li class="a1"><a href="<?php echo $this->_var['pager']['page_prev']; ?>">< <?php echo $this->_var['lang']['page_prev']; ?></a></li>
        <?php endif; ?>
        <?php if ($this->_var['pager']['page_count'] != 1): ?>
          <?php $_from = $this->_var['pager']['page_number']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_33201600_1480915372');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_33201600_1480915372']):
?>
            <?php if ($this->_var['pager']['page'] == $this->_var['key']): ?>
            <li><span><?php echo $this->_var['key']; ?></span></li>
            <?php else: ?>
            <li><a href="<?php echo $this->_var['item_0_33201600_1480915372']; ?>"><?php echo $this->_var['key']; ?></a></li>
            <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php endif; ?>
          
        <?php if ($this->_var['pager']['page_next']): ?>
            <li><a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?> ></a></li>
        <?php endif; ?>  

        <?php if ($this->_var['pager']['page_kbd']): ?>
          <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_33254400_1480915372');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_33254400_1480915372']):
?>
            <?php if ($this->_var['key'] == 'keywords'): ?>
                <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item_0_33254400_1480915372']); ?>" />
              <?php else: ?>
                <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_33254400_1480915372']; ?>" />
            <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <li class="last">到第<input type="text" name="page" >页<button name="mg-btn" onclick="selectPage(this)">确定</button></li>
        <?php endif; ?>
      </ul>
    </div>
</div>


<?php endif; ?>
</form>
<script type="Text/Javascript" language="JavaScript">
<!--

function selectPage(sel)
{
  sel.form.submit();
}

//-->
</script>
