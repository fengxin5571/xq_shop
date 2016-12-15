<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="con">
  <div class="ect-bg">
    <header class="ect-header ect-margin-tb ect-margin-lr text-center icon-write article"><a class="ect-icon ect-icon-home pull-left" href="index.php"></a><span><?php echo $this->_var['lang']['shophelp']; ?></span><a class="ect-icon ect-icon-cate pull-right" href="<?php echo url('article/index');?>"></a></header>
  </div>
  <div class="article-info">
    <h3><?php echo $this->_var['article']['title']; ?></h3>
    <div class="article-info-con"> <?php echo $this->_var['article']['content']; ?> </div>
  </div>
</div>
<footer class="logo"></footer>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body></html>