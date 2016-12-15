<form method="GET" class="sort" name="listform">
  <div class="ect-wrapper text-center">
    <div> <a class="<?php if ($this->_var['sort'] == 'goods_id' && $this->_var['order'] == 'DESC'): ?>ect-colory<?php endif; ?>" href="<?php echo url('brand/goods_list#goods_list',array('id'=>$this->_var['brand_id'],'cat'=>$this->_var['cat'],'display'=>$this->_var['display'],'brand'=>$this->_var['brand_id'],'price_min'=>$this->_var['price_min'],'price_max'=>$this->_var['price_max'],'filter_attr'=>$this->_var['filter_attr'], 'sort'=>'goods_id', 'order'=> 'DESC', 'keywords'=>$this->_var['keywords']));?>"><?php echo $this->_var['lang']['sort_default']; ?></a> <a class="<?php if ($this->_var['sort'] == 'sales_volume' && $this->_var['order'] == 'DESC'): ?>select ect-colory<?php elseif ($this->_var['sort'] == 'sales_volume' && $this->_var['order'] == 'ASC'): ?>ect-colory<?php else: ?><?php endif; ?>" href="<?php echo url('brand/goods_list#goods_list',array('id'=>$this->_var['brand_id'],'cat'=>$this->_var['cat'],'display'=>$this->_var['display'],'brand'=>$this->_var['brand_id'],'price_min'=>$this->_var['price_min'],'price_max'=>$this->_var['price_max'],'filter_attr'=>$this->_var['filter_attr'], 'sort'=>'sales_volume', 'order'=> ($this->_var['sort']=='sales_volume' && $this->_var['order']=='ASC')?'DESC':'ASC', 'keywords'=>$this->_var['keywords']));?>"><?php echo $this->_var['lang']['sort_sales']; ?> <i class="glyphicon glyphicon-arrow-up"></i></a> <a class="<?php if ($this->_var['sort'] == 'click_count' && $this->_var['order'] == 'DESC'): ?>select ect-colory<?php elseif ($this->_var['sort'] == 'click_count' && $this->_var['order'] == 'ASC'): ?>ect-colory<?php else: ?><?php endif; ?>" href="<?php echo url('brand/goods_list#goods_list',array('id'=>$this->_var['brand_id'],'cat'=>$this->_var['cat'],'display'=>$this->_var['display'],'brand'=>$this->_var['brand_id'],'price_min'=>$this->_var['price_min'],'price_max'=>$this->_var['price_max'],'filter_attr'=>$this->_var['filter_attr'], 'sort'=>'click_count', 'order'=> ($this->_var['sort']=='click_count' && $this->_var['order']=='ASC')?'DESC':'ASC', 'keywords'=>$this->_var['keywords']));?>"><?php echo $this->_var['lang']['sort_popularity']; ?> <i class="glyphicon glyphicon-arrow-up"></i></a> <a class="<?php if ($this->_var['sort'] == 'shop_price' && $this->_var['order'] == 'DESC'): ?>select ect-colory<?php elseif ($this->_var['sort'] == 'shop_price' && $this->_var['order'] == 'ASC'): ?>ect-colory<?php else: ?><?php endif; ?>" href="<?php echo url('brand/goods_list#goods_list',array('id'=>$this->_var['brand_id'],'cat'=>$this->_var['cat'],'display'=>$this->_var['display'],'brand'=>$this->_var['brand_id'],'price_min'=>$this->_var['price_min'],'price_max'=>$this->_var['price_max'],'filter_attr'=>$this->_var['filter_attr'], 'sort'=>'shop_price', 'order'=> ($this->_var['sort']=='shop_price' && $this->_var['order']=='ASC')?'DESC':'ASC', 'keywords'=>$this->_var['keywords']));?>"><?php echo $this->_var['lang']['sort_price']; ?> <i class="glyphicon glyphicon-arrow-up"></i></a> </div>
  </div>
  <input type="hidden" name="cat" value="<?php echo $this->_var['cat']; ?>" />
  <input type="hidden" name="display" value="<?php echo $this->_var['pager']['display']; ?>" id="display" />
  <input type="hidden" name="brand" value="<?php echo $this->_var['brand_id']; ?>" />
  <input type="hidden" name="price_min" value="<?php echo $this->_var['price_min']; ?>" />
  <input type="hidden" name="price_max" value="<?php echo $this->_var['price_max']; ?>" />
  <input type="hidden" name="filter_attr" value="<?php echo $this->_var['filter_attr']; ?>" />
  <input type="hidden" name="page" value="<?php echo $this->_var['page']; ?>" />
  <input type="hidden" name="sort" value="<?php echo $this->_var['sort']; ?>" />
  <input type="hidden" name="order" value="<?php echo $this->_var['order']; ?>" />
  <input type="hidden" name="keywords" value="<?php echo $this->_var['keywords']; ?>" />
</form>
<?php if ($this->_var['show_asynclist']): ?>
<div class="ect-margin-tb ect-pro-list ect-margin-bottom0 ect-border-bottom0">
  <ul id="J_ItemList">
    <li class="single_item"></li>
    <a href="javascript:;" class="get_more"></a>
  </ul>
</div>
<?php else: ?>
<div class="ect-margin-tb ect-pro-list ect-margin-bottom0 ect-border-bottom0">
  <ul id="J_ItemList">
    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
?>
    <li class="single_item"> <a href="<?php echo $this->_var['goods']['url']; ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt="<?php echo $this->_var['goods']['name']; ?>"></a>
      <dl>
        <dt>
          <h4 class="title"><a href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['goods']['goods_name']; ?></a></h4>
        </dt>
        <dd><span class="pull-left"><strong><?php echo $this->_var['lang']['price']; ?>：<b class="ect-colory"><?php if ($this->_var['goods']['promote_price']): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></b></strong><small class="ect-margin-lr"><del><?php echo $this->_var['goods']['market_price']; ?></del></small></span><span class="ect-pro-price"> 
          <?php if ($this->_var['goods']['promotion']): ?> 
          <?php $_from = $this->_var['goods']['promotion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'promotion');if (count($_from)):
    foreach ($_from AS $this->_var['promotion']):
?> 
          <?php if ($this->_var['promotion']['type'] == 'group_buy'): ?><i class="label tuan"><?php echo $this->_var['lang']['group_buy_act']; ?></i> 
          <?php elseif ($this->_var['promotion']['act_type'] == 0): ?> <i class="label mz"> <?php echo $this->_var['lang']['favourable_mz']; ?></i> 
          <?php elseif ($this->_var['promotion']['act_type'] == 1): ?> <i class="label mj"> <?php echo $this->_var['lang']['favourable_mj']; ?></i> 
          <?php elseif ($this->_var['promotion']['act_type'] == 2): ?> <i class="label zk"> <?php echo $this->_var['lang']['favourable_zk']; ?></i> 
          <?php endif; ?> 
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
          <?php endif; ?> 
          </span></dd>
        <dd><span class="pull-left <?php if ($this->_var['goods']['mysc'] != 0): ?>ect-colory<?php endif; ?>"><i class="fa <?php if ($this->_var['goods']['mysc'] != 0): ?>fa-heart<?php else: ?>fa-heart-o<?php endif; ?>"></i> <?php echo $this->_var['goods']['sc']; ?><?php echo $this->_var['lang']['like_num']; ?></span><span class="pull-right"><?php echo $this->_var['lang']['sort_sales']; ?>：<?php echo $this->_var['goods']['sales_count']; ?><?php echo $this->_var['lang']['piece']; ?></span> </dd>
      </dl>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<?php echo $this->fetch('library/page.lbi'); ?>
<?php endif; ?> 