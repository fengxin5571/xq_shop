<div class="notice" >
  <div class="notice-hd"><strong>馨清商城公告</strong><span><a href="<?php echo $this->_var['notice_url']; ?>" title="更多公告">更多>> </a></span></div>
  <ul class="notice-list">
  	<?php $_from = $this->_var['new_articles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
    <li><a href="<?php echo $this->_var['article']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['article']['title']); ?>" target="_blank"><?php echo sub_str($this->_var['article']['title'],24); ?></a></li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>