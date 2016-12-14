<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="user-account-detail" >
  <ul class="ect-bg-colorf" id="J_ItemList">
    <li class="single_item"></li>
    <a href="javascript:;" style="text-align:center" class="get_more"></a>
  </ul>
</div>
</div>
<?php echo $this->fetch('library/search.lbi'); ?>
<?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript" src="__PUBLIC__/js/jquery.more.js"></script> 
<script type="text/javascript">
get_asynclist('<?php echo url("user/msg_list");?>' , '__TPL__/images/loader.gif');
</script>
</body></html>