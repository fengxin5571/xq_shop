<div class="jd-express-news">
<a class="J_ping jd-news-tit"><img src="themes/default/images/jd-news-tit.png"/></a>
<div class="news-list-wrapper" id="scroll-news">
<ul class="news-list" style="transform: translate3d(0px, 0px, 0px);">
<?php $_from = $this->_var['new_articles']['12']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'news');if (count($_from)):
    foreach ($_from AS $this->_var['news']):
?>
<li class="news-item"><a href="<?php echo $this->_var['news']['url']; ?>"><?php echo $this->_var['news']['title']; ?></a></li>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>
</div>
<a href="index.php?m=default&c=article&a=art_list&id=12" class="J_ping jd-news-more"><i class="line"></i>更多</a>
</div>