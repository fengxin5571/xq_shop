<?php echo $this->fetch('library/user_header.lbi'); ?>
<div class="user-info">
  <div class="user-img pull-left"><a href="<?php echo url('user/showImg');?>"><i class="glyphicon glyphicon-user"></i></a></div>
  <dl class="pull-left">
    <dt>
      <h4><?php echo $this->_var['info']['username']; ?> | <a href="<?php echo url('user/logout');?>" class="ect-colorf"><?php echo $this->_var['lang']['label_logout']; ?></a></h4>
    </dt>
    <dd><?php echo $this->_var['rank_name']; ?></dd>
    <dd><?php echo $this->_var['info']['integral']; ?></dd>
  </dl>
  <span class="pull-right"><a href="<?php echo url('user/msg_list');?>" class="ect-colorf"><?php echo $this->_var['sys_notice']; ?>&nbsp;<i class="fa fa-envelope-o <?php if ($this->_var['new_msg']): ?>fa-envelope-o-sl<?php endif; ?>"></i></a></span></div>
<section class="container-fluid user-nav">
  <ul class="row ect-row-nav text-center">
    <a href="<?php echo url('user/not_pay_order_list');?>">
    <li class="col-sm-3 col-xs-3"> <i class="glyphicon glyphicon-credit-card"></i>
      <p class="text-center"><?php echo $this->_var['lang']['not_pay_list']; ?></p>
    </li>
    </a> <a href="<?php echo url('user/order_list');?>">
    <li class="col-sm-3 col-xs-3"> <i class="fa fa-file-text"></i>
      <p class="text-center"><?php echo $this->_var['lang']['order_list_lnk']; ?></p>
    </li>
    </a> <a href="<?php echo url('user/address_list');?>">
    <li class="col-sm-3 col-xs-3"><i class="glyphicon glyphicon-map-marker"></i>
      <p class="text-center"><?php echo $this->_var['lang']['label_address']; ?></p>
    </li>
    </a> 
    <!--<a href="<?php echo url('user/account_detail');?>">
    <li class="col-sm-3 col-xs-3"><i class="glyphicon glyphicon-usd"></i>
      <p class="text-center"><?php echo $this->_var['lang']['label_user_surplus']; ?></p>
    </li>
    </a>  -->
    <a href="<?php echo url('user/profile');?>">
    <li class="col-sm-3 col-xs-3"><i class="fa fa-user"></i>
      <p class="text-center"><?php echo $this->_var['lang']['profile']; ?></p>
    </li>
    </a> 
    <a href="<?php echo url('user/edit_password');?>">
    <li class="col-sm-3 col-xs-3"><i class="fa fa-shield"></i>
      <p class="text-center"><?php echo $this->_var['lang']['edit_password']; ?></p>
    </li>
    </a> <a href="<?php echo url('user/service');?>">
    <li class="col-sm-3 col-xs-3"><i><img src="__TPL__/images/u-kefu.png"></i>
      <p class="text-center"><?php echo $this->_var['lang']['user_service']; ?></p>
    </li>
    </a> 
    <!--<a href="<?php echo url('user/share');?>">
    <li class="col-sm-3 col-xs-3"><i class="fa fa-share-alt"></i>
      <p class="text-center"><?php echo $this->_var['lang']['label_share']; ?></p>
    </li>
    </a> -->
     <!--<a href="<?php echo url('user/tag_list');?>">
    <li class="col-sm-3 col-xs-3"><i class="glyphicon glyphicon-tags"></i>
      <p class="text-center"><?php echo $this->_var['lang']['label_tag']; ?></p>
    </li>
    </a> -->
    <a href="<?php echo url('user/bonus');?>">
    <li class="col-sm-3 col-xs-3"><i class="glyphicon glyphicon-gift"></i>
      <p class="text-center"><?php echo $this->_var['lang']['label_bonus']; ?></p>
    </li>
    </a>
     <a href="<?php echo url('user/booking_list');?>">
    <li class="col-sm-3 col-xs-3"><i class="glyphicon glyphicon-link"></i>
      <p class="text-center"><?php echo $this->_var['lang']['label_booking']; ?></p>
    </li>
    </a>
	
  </ul>
</section>
<section class="user-tab ect-margin-tb ect-margin-bottom0"> 
  
  <ul class="nav nav-tabs text-center">
    <li class="col-xs-4 active"><a href="#one" role="tab" data-toggle="tab"><?php echo $this->_var['lang']['label_collection']; ?></a></li>
    <li class="col-xs-4"><a href="#two" role="tab" data-toggle="tab"><?php echo $this->_var['lang']['label_comment']; ?></a></li>
    <li class="col-xs-4"><a href="#three" role="tab" data-toggle="tab"><?php echo $this->_var['lang']['user_history']; ?></a></li>
  </ul>
  
  <div class="tab-content" id="gwc-tab-xq-bd">
    <div class="tab-pane active ect-pro-list" id="one"> 
      <?php if ($this->_var['goods_list']): ?>
      <ul>
        <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
        <li><a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['goods_id']));?>"><img src="<?php echo $this->_var['val']['goods_thumb']; ?>"></a>
          <dl>
            <dt>
              <h4 class="title"><a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['goods_id']));?>"><?php echo $this->_var['val']['goods_name']; ?></a></h4>
            </dt>
            <dd class="dd-price"><span class="pull-left"><strong><?php echo $this->_var['lang']['sort_price']; ?>：<b class="ect-colory"><?php echo $this->_var['val']['shop_price']; ?></b></strong><small class="ect-margin-lr"><del><?php echo $this->_var['val']['market_price']; ?></del></small></span></dd>
          </dl>
          <a href="<?php echo url('user/delete_collection', array('rec_id'=>$this->_var['val']['rec_id']));?>" class="pull-right del"><i class="glyphicon glyphicon-trash"></i></a></li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
         <a href="<?php echo url('collection_list');?>" class="more"><?php echo $this->_var['lang']['view_more']; ?></a>
      </ul>
     
      <?php else: ?>
      <p class="text-center ect-margin-tb ect-padding-tb"><?php echo $this->_var['lang']['no_data']; ?></p>
      <?php endif; ?> 
    </div>
    <div class="tab-pane ect-pro-list pinglun-list" id="two"> 
      <?php if ($this->_var['comment_list']): ?>
      <ul>
        <?php $_from = $this->_var['comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
        <li>
          <dl>
            <dt>
              <h4 class="title"><a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['id_value']));?>"><?php if ($this->_var['val']['comment_type'] == 0): ?> <?php echo $this->_var['lang']['goods_comment']; ?><?php else: ?><?php echo $this->_var['lang']['article_comment']; ?><?php endif; ?>：<?php echo $this->_var['val']['cmt_name']; ?></a></h4>
            </dt>
            <dd class="date ect-color999"><?php echo $this->_var['val']['formated_add_time']; ?></dd>
            <dd><?php echo $this->_var['val']['content']; ?></dd>
            <?php if ($this->_var['val']['reply_content']): ?>
            <dd><?php echo $this->_var['lang']['reply_comment']; ?>：<?php echo $this->_var['val']['reply_content']; ?></dd>
            <?php endif; ?>
            <dd><a href="<?php echo url('user/delete_comment',array('id'=>$this->_var[val][comment_id]));?>" class="pull-right del"><i class="glyphicon glyphicon-trash"></i></a></dd>
          </dl>
        </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <a href="<?php echo url('comment_list');?>" class="more"><?php echo $this->_var['lang']['view_more']; ?></a>
      </ul>
      <?php else: ?>
      <p class="text-center ect-margin-tb ect-padding-tb"><?php echo $this->_var['lang']['no_data']; ?></p>
      <?php endif; ?> 
    </div>
    <div class="tab-pane ect-pro-list" id="three"> 
      <?php if ($this->_var['history']): ?> 
      <span class="pull-right ect-padding-lr ect-margin-tb ect-margin-bottom0">
      <a href="<?php echo url('user/clear_history');?>" class="history_clear del"><i class="glyphicon glyphicon-trash"></i> <?php echo $this->_var['lang']['clear_history']; ?></a></span>
      <ul>
        <?php $_from = $this->_var['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
        <li><a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['goods_id']));?>"><img src="<?php echo $this->_var['val']['goods_thumb']; ?>"></a>
          <dl>
            <dt>
              <h4 class="title"><a href="<?php echo url('goods/index', array('id'=>$this->_var[val]['goods_id']));?>"><?php echo $this->_var['val']['goods_name']; ?></a></h4>
            </dt>
            <dd class="dd-price"><span class="pull-left"><strong><?php echo $this->_var['lang']['sort_price']; ?>：<b class="ect-colory"><?php echo $this->_var['val']['shop_price']; ?></b></strong><small class="ect-margin-lr"><del><?php echo $this->_var['val']['market_price']; ?></del></small></span></dd>
          </dl>
        </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </ul>
      <?php else: ?>
      <p class="text-center  ect-margin-tb ect-padding-tb"><?php echo $this->_var['lang']['not_history']; ?><a href="<?php echo url('category/index');?>" class="ect-color ect-margin-lr" style="font-size:1.3em;"><?php echo $this->_var['lang']['enter']; ?></a><?php echo $this->_var['lang']['scan_goods']; ?></p>
      <?php endif; ?> 
    </div>
  </div>
</section>
</div>
<?php echo $this->fetch('library/search.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript">
    $(function(){
        $(".del").click(function(){
            if(!confirm('您确定要删除吗？')){
                return false;
            }
            var obj = $(this);
            var url = obj.attr("href");
            $.get(url, '', function(data){
                if(1 == data.status){
                    if(obj.hasClass("history_clear")){
                        obj.closest(".ect-pro-list").html("<p class='text-center  ect-margin-tb ect-padding-tb'>暂无浏览记录，点击<a href=<?php echo url('category/index');?> class='ect-color ect-margin-lr' style='font-size:1.3em;'>进入</a>浏览商品</p>");
                        obj.parent().siblings("ul").remove();
                    } 
                    else{
                        if(obj.closest("li").siblings("li").length == 0){
                            obj.closest("ul").html("<p class='text-center  ect-margin-tb ect-padding-tb'><?php echo $this->_var['lang']['no_data']; ?></p>");
                        }
                        obj.closest("li").remove();
                    }
                }
                else{
                    alert("删除失败");
                }
            }, 'json');
            return false;
   		});
    })
</script> 
</body>
</html>
