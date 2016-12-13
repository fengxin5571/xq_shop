<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="user-tags">
  <ul>
   <?php if ($this->_var['tags']): ?>
    <?php $_from = $this->_var['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
    <li class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
      <a href="<?php echo url('category/index', array('keywords'=>$this->_var['tag']['tag_words']));?>" title="<?php echo htmlspecialchars($this->_var['tag']['tag_words']); ?>"><?php echo htmlspecialchars($this->_var['tag']['tag_words']); ?></a>
	</li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   <?php endif; ?>
  </ul>
</div>
</ul>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>
<script type="text/javascript">
$(function(){
	$(".alert").on('close.bs.alert', function(){
		var tag_words = $(this).find("a").attr("title");
		$.get("<?php echo url('user/del_tag');?>", {tag_wrods:tag_words}, function(data){
			if(data.status == 0){
				alert(data.msg);
			}
		}, 'json');
	});
})
</script>
</body>
</html>