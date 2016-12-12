<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<?php if ($this->_var['cat_style']): ?>
<link href="<?php echo $this->_var['cat_style']; ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,global.js,compare.js')); ?>
</head>
<body>

<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="main">
    <div class="mg-cate w1160px clearfix">
    <?php echo $this->fetch('library/category_tree.lbi'); ?>
    </div>
    <div class="w1160px clearfix">
    
    <?php if ($this->_var['hot_goods']): ?>
    <div class='mt20'>
    <div class="hot-sales">
    <div class="hot-sales-main">
    <div class='hd'>热卖推荐</div>
    <div class="bd">
    <ul>
     <?php $_from = $this->_var['hot_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
    <li>
    <a class="p-img" target="_blank" href='<?php echo $this->_var['goods']['url']; ?>' title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><img width='100' height="100" src="<?php echo $this->_var['goods']['thumb']; ?>" /></a>
    <a class="p-name" target="_blank" href='<?php echo $this->_var['goods']['url']; ?>'title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>"><em><?php echo htmlspecialchars($this->_var['goods']['name']); ?></em></a>
    <div class="p-price"><strong><em class='number'><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></em></strong></div>
    <div class="p-btnbox"><a class="btn-default" href="javascript:addToCart(<?php echo $this->_var['goods']['id']; ?>)">立即抢购</a></div>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    </div>
    </div>
    <div class="hot-sales-act">
    <div class='hd'>促销活动</div>
    <div class="bd">
    <ul class='market-adlist'>
    <li class="item"><?php 
$k = array (
  'name' => 'ads',
  'id' => '11',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></li>
    <li class="item"><?php 
$k = array (
  'name' => 'ads',
  'id' => '12',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></li>
    </ul>
    </div>
    </div>
    </div>
    </div>
    <?php endif; ?>
      
      <div class="mg-subnav mt20">
        <?php echo $this->fetch('library/ur_here.lbi'); ?>
        <?php if ($this->_var['current_categories']): ?>
        <div class="menu-drop-main" style="display:none">
        <ul class="menu-drop-list">
            <?php $_from = $this->_var['current_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
            <li <?php if ($this->_var['cat']['id'] == $this->_var['category']): ?>class="cur"<?php endif; ?>><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
        </ul>
        </div>
      <?php endif; ?>
      </div>
      
        
        <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?>
        <div class="s-title mt10">
        <h3><b><?php echo $this->_var['cat_name']; ?></b><em>商品筛选</em></h3>
        <div class="st-ext"> 共&nbsp;<span><?php echo $this->_var['pager']['record_count']; ?></span>个商品</div>
        </div>
        <div class="mg-filter ">
          <dl class="clearfix">
            <dt><?php echo $this->_var['lang']['brand']; ?>：</dt>
            <dd>
              <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                  <?php if ($this->_var['brand']['selected']): ?>
                  <span><?php echo $this->_var['brand']['brand_name']; ?></span>
                  <?php else: ?>
                  <a href="<?php echo $this->_var['brand']['url']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a>
                  <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dd>
          </dl>
          <dl class="clearfix">
            <dt><?php echo $this->_var['lang']['price']; ?>：</dt>
            <dd>
              <?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?>
              <?php if ($this->_var['grade']['selected']): ?>
              <span><?php echo $this->_var['grade']['price_range']; ?></span>
              <?php else: ?>
              <a href="<?php echo $this->_var['grade']['url']; ?>"><?php echo $this->_var['grade']['price_range']; ?></a>
              <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dd>
          </dl>
          <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'filter_attr_0_27938900_1480915372');$this->_foreach['attr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attr']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['filter_attr_0_27938900_1480915372']):
        $this->_foreach['attr']['iteration']++;
?>
          <?php if ($this->_foreach['attr']['iteration'] >= 5): ?>
          <?php if ($this->_foreach['attr']['iteration'] == 5): ?>
          <div class="s-more">
          <span1 class="sm-wrap">更多选项（
          <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'filter_attrs');$this->_foreach['attrs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['attrs']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['filter_attrs']):
        $this->_foreach['attrs']['iteration']++;
?>
          <?php if ($this->_foreach['attrs']['iteration'] >= 5 && $this->_foreach['attrs']['iteration'] < 8): ?>
          <?php echo htmlspecialchars($this->_var['filter_attrs']['filter_attr_name']); ?>,
          <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                             等）<li></li></span1>
          </div>
          <?php endif; ?>
          <?php if ($this->_foreach['attr']['iteration'] == 5): ?>
          <div class="s-more-line" style="display:none">
          <?php endif; ?>
          <?php endif; ?>
          <dl class="clearfix">
            <dt><?php echo htmlspecialchars($this->_var['filter_attr_0_27938900_1480915372']['filter_attr_name']); ?>：</dt>
            <dd>
              <?php $_from = $this->_var['filter_attr_0_27938900_1480915372']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
              <?php if ($this->_var['attr']['selected']): ?>
              <span><?php echo $this->_var['attr']['attr_value']; ?></span>
              <?php else: ?>
              <a href="<?php echo $this->_var['attr']['url']; ?>"><?php echo $this->_var['attr']['attr_value']; ?></a>
              <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </dd>
          </dl>
          <?php if ($this->_foreach['attr']['iteration'] >= 5): ?>
          <?php if (($this->_foreach['attr']['iteration'] == $this->_foreach['attr']['total'])): ?>
          </div>
          <?php endif; ?>
          <?php endif; ?>	
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          
          <div class="s-more-open" style="display:none"><span1 class="sm-wrap-open">收起<li></li></span1></div>
         
        </div>
        
        <?php endif; ?>
      
      <div class="mg-sidebar mt20 fl">
      
      <?php echo $this->fetch('library/people_buy.lbi'); ?>
      
      </div>
      
      
      <div class="mg-container mt20 fr">
        <?php echo $this->fetch('library/goods_list.lbi'); ?>
        <?php echo $this->fetch('library/pages.lbi'); ?>
      </div>
      
    </div>
  </div>
  
  <div class="w1160px clearfix mt10">
  <?php echo $this->fetch('library/best_goods.lbi'); ?>
  </div>
  
<?php echo $this->fetch('library/page_footer.lbi'); ?>

</body>
</html>
