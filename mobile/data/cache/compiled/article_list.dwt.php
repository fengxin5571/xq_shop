<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="con">
  <div class="ect-bg">
    <header class="ect-header ect-margin-tb ect-margin-lr text-center icon-write article"><a class="ect-icon ect-icon-home pull-left" href="<?php echo url();?>"></a><span><?php echo $this->_var['cat_name']; ?></span><a class="ect-icon ect-icon-cate pull-right" href="<?php echo url('article/index');?>"></a></header>
  </div>
  <div class="article-list">
   <form action="<?php echo url('article/art_list');?>" name="search_form" method="post" class="article_search">
    <div class="input-search"> <span>
        <input autocomplete="off" placeholder="<?php echo $this->_var['lang']['art_no_keywords']; ?>"  name="keywords" id="requirement" class="J_SearchInput inputSear" type="text">
        </span>
         <input name="id" type="hidden" value="<?php echo $this->_var['cat_id']; ?>" />
        <input name="cur_url" id="cur_url" type="hidden" value="" />
        <button type="button" disabled="true" class="input-delete J_InputDelete"> <span></span> </button>
      	<button type="submit" ><i class="glyphicon glyphicon-search"></i></button>
      </div>
      </form>

	
	<?php if ($this->_var['show_asynclist'] == 1): ?>
		<div class="article-list-ol">
		  <ol id="J_ItemList">
			<li class="single_item"> </li>
			<a href="javascript:;" class="get_more"></a>
		  </ol>
		</div>
	<?php else: ?>

		<div class="article-list-ol">
		  <ol id="J_ItemList">
		  	<?php $_from = $this->_var['artciles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'article');if (count($_from)):
    foreach ($_from AS $this->_var['article']):
?>
				<li class="single_item"><a href="<?php echo $this->_var['article']['url']; ?>" ><?php echo $this->_var['article']['index']; ?>、<?php echo $this->_var['article']['short_title']; ?></a></li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		  </ol>
		</div>
    	<span class="blank10"></span> 
			<?php echo $this->fetch('library/page.lbi'); ?>
    	<span class="blank10"></span>
	<?php endif; ?>
</div>
<footer ></footer>
<?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript">
<?php if ($this->_var['show_asynclist']): ?>
	get_asynclist("<?php echo url('article/asynclist', array('id'=>$this->_var['id'], 'page'=>$this->_var['page'], 'sort'=>$this->_var['sort'], 'keywords'=>$this->_var['keywords']));?>" , '__TPL__/images/loader.gif');
<?php endif; ?> 
</script>
</body></html>