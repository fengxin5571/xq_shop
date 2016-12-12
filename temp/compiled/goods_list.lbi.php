
<div class="mg-sortbar mt20">
  <a name='goods_list'></a>
  <form method="GET" class="sort" name="listform">
    <div class="sorts fl">
        <b><?php echo $this->_var['lang']['btn_display']; ?>：</b>
        <a  <?php if ($this->_var['pager']['sort'] == 'goods_id' && $this->_var['pager']['order'] == 'DESC'): ?> class="up"<?php elseif ($this->_var['pager']['sort'] == 'goods_id' && $this->_var['pager']['order'] == 'ASC'): ?>class="down"<?php endif; ?> href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=goods_id&order=<?php if ($this->_var['pager']['sort'] == 'goods_id' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>#goods_list"><span>上架时间</span></a>

        <a  <?php if ($this->_var['pager']['sort'] == 'shop_price' && $this->_var['pager']['order'] == 'DESC'): ?> class="up" <?php elseif ($this->_var['pager']['sort'] == 'shop_price' && $this->_var['pager']['order'] == 'ASC'): ?>class="down"<?php endif; ?> href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=<?php if ($this->_var['pager']['sort'] == 'shop_price' && $this->_var['pager']['order'] == 'ASC'): ?>DESC<?php else: ?>ASC<?php endif; ?>#goods_list"><span>价格</span></a>

        <a <?php if ($this->_var['pager']['sort'] == 'last_update' && $this->_var['pager']['order'] == 'DESC'): ?> class="up"<?php elseif ($this->_var['pager']['sort'] == 'last_update' && $this->_var['pager']['order'] == 'ASC'): ?>class="down"<?php endif; ?> href="<?php echo $this->_var['script_name']; ?>.php?category=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=last_update&order=<?php if ($this->_var['pager']['sort'] == 'last_update' && $this->_var['pager']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>#goods_list"><span>更新时间</span></a>
    </div>
    <div class="mg-items fr">
        <b class="fl">显示方式：</b>
        <ul class="fl clearfix">    
            <li class="mg-listcon <?php if ($this->_var['pager']['display'] == 'list'): ?>listhover<?php endif; ?>" onClick="javascript:display_mode('list')"></li>
            <li class="mg-blockcon <?php if ($this->_var['pager']['display'] == 'grid'): ?>listhover<?php endif; ?>" onClick="javascript:display_mode('grid')"></li>
        </ul>
        <div class="mg-pages fl">
        <div class="f-pager fr"> 
        <span class="fp-text">
        <b><?php echo $this->_var['pager']['page']; ?></b><em>/</em><i><?php echo $this->_var['pager']['page_count']; ?></i>
        </span>
            <?php if ($this->_var['pager']['page_prev']): ?>
                <a href="<?php echo $this->_var['pager']['page_prev']; ?>" class="fp-prev">&lt;</a>
            <?php else: ?>
                <a href="javascript:;" class="fp-prev disabled">&lt;</a>
            <?php endif; ?>
            <?php if ($this->_var['pager']['page_next']): ?>
              <a href="<?php echo $this->_var['pager']['page_next']; ?>" class="fp-next">&gt;</a>
            <?php else: ?>
              <a href="javascript:;" class="fp-next disabled">&gt;</a>
            <?php endif; ?>
        </div>   
        <div class="f-result-sum">总共<span class="f40"><?php echo $this->_var['pager']['record_count']; ?></span>件商品</div>
        
        </div>
    </div>
  <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>" />
  <input type="hidden" name="display" value="<?php echo $this->_var['pager']['display']; ?>" id="display" />
  <input type="hidden" name="brand" value="<?php echo $this->_var['brand_id']; ?>" />
  <input type="hidden" name="price_min" value="<?php echo $this->_var['price_min']; ?>" />
  <input type="hidden" name="price_max" value="<?php echo $this->_var['price_max']; ?>" />
  <input type="hidden" name="filter_attr" value="<?php echo $this->_var['filter_attr']; ?>" />
  <input type="hidden" name="page" value="<?php echo $this->_var['pager']['page']; ?>" />
  <input type="hidden" name="sort" value="<?php echo $this->_var['pager']['sort']; ?>" />
  <input type="hidden" name="order" value="<?php echo $this->_var['pager']['order']; ?>" />
</form>
</div>


 
<?php if ($this->_var['pager']['display'] == 'list'): ?>
    <div id="splist" class="mg-splist">
        <div class="mg-grid mt20 clearfix">
            <ul class="list-x">
              <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_31379600_1480915372');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_31379600_1480915372']):
        $this->_foreach['goods_list']['iteration']++;
?>
              <li>
                <div class="list-img"><a href="<?php echo $this->_var['goods_0_31379600_1480915372']['url']; ?>"><img src="<?php echo $this->_var['goods_0_31379600_1480915372']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_31379600_1480915372']['name']; ?>" width="77" height="77" title="<?php echo $this->_var['goods_0_31379600_1480915372']['name']; ?>"/></a></div>
                <div class="list-title">
                <div class="p-name">
                <a href="<?php echo $this->_var['goods_0_31379600_1480915372']['url']; ?>" title="<?php echo $this->_var['goods_0_31379600_1480915372']['goods_name']; ?>" target="_blank">
                <?php if ($this->_var['is_show_presell_icn']): ?>
                <?php if ($this->_var['goods_0_31379600_1480915372']['is_presell']): ?>
                <span style="color: #0374D9;">【预售商品】</span>
                <?php endif; ?>
                <?php endif; ?>
                  <strong><?php echo $this->_var['goods_0_31379600_1480915372']['name']; ?></strong>
                </a>
                </div>
                <div class="p-brief">
                <?php if ($this->_var['goods_0_31379600_1480915372']['goods_brief']): ?>
                    <?php echo sub_str($this->_var['goods_0_31379600_1480915372']['goods_brief'],15); ?>
                    <?php else: ?>
                    <em class="u-jd" style="margin-right: 10px;"><?php echo $this->_var['shop_name']; ?></em>馨清自营，品质保障
                    <?php endif; ?>
                </div>
                <div class="p-icons">
                <i class="goods-icons-s1 J-picon-tips1" data-tips="本商品馨清配送" title="本商品馨清配送">馨清配送</i>
                <?php if ($this->_var['goods_0_31379600_1480915372']['promote_price']): ?>
                <i class="goods-icons J-picon-tips" data-tips="本商品限时促销" title="本商品限时促销">限时促销</i>
                <?php endif; ?>
                <?php if ($this->_var['goods_0_31379600_1480915372']['is_shipping']): ?>
                <i class="goods-icons-s1 J-picon-tips" data-tips="本商品免运费" title="本商品免运费"></i>
                <?php endif; ?>
                </div>
                </div>
                
                <div class="list-price">
                <b>
                    <?php if ($this->_var['goods_0_31379600_1480915372']['promote_price'] != ""): ?>
                    <?php echo $this->_var['goods_0_31379600_1480915372']['promote_price']; ?>
                    <?php else: ?>
                    <?php echo $this->_var['goods_0_31379600_1480915372']['shop_price']; ?>
                    <?php endif; ?>
                </b>
                </div>
                <div class="list-collect"><a href="javascript:;" onclick="Compare.add(<?php echo $this->_var['goods_0_31379600_1480915372']['goods_id']; ?>,'<?php echo $this->_var['goods_0_31379600_1480915372']['goods_name']; ?>','<?php echo $this->_var['goods_0_31379600_1480915372']['goods_img']; ?>','<?php echo $this->_var['goods_0_31379600_1480915372']['type']; ?>','<?php echo $this->_var['goods_0_31379600_1480915372']['shop_price']; ?>')" class="list-a"><?php echo $this->_var['lang']['compare']; ?></a><a href="javascript:collect(<?php echo $this->_var['goods_0_31379600_1480915372']['goods_id']; ?>);" title="" target="_self"><?php echo $this->_var['lang']['favourable_goods']; ?></a></div>
                <div class="list-buy"><a href="javascript:addToCart(<?php echo $this->_var['goods_0_31379600_1480915372']['goods_id']; ?>)" title="" target="_blank"><img src="themes/default/images/robot/list-buy.gif"></a></div>
                <div class="clr"></div>
              </li>
               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
        </div>
    </div>

<?php elseif ($this->_var['pager']['display'] == 'grid'): ?>

    <div id="splist" class="mg-splist">
        <div class="mg-grid clearfix">

            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_31514500_1480915372');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_31514500_1480915372']):
        $this->_foreach['goods_list']['iteration']++;
?>
            <div class="itemlist">
                <div class="pic">
                    <a href="<?php echo $this->_var['goods_0_31514500_1480915372']['url']; ?>"><img src="<?php echo $this->_var['goods_0_31514500_1480915372']['goods_img']; ?>" alt="<?php echo $this->_var['goods_0_31514500_1480915372']['name']; ?>" title="<?php echo $this->_var['goods_0_31514500_1480915372']['name']; ?>" class="err-product"></a>
                    <?php if ($this->_var['is_show_presell_icn']): ?>
                    <?php if ($this->_var['goods_0_31514500_1480915372']['is_presell']): ?>
                    <i class="zc_icon"></i>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="p-price"><strong>
                <?php if ($this->_var['goods_0_31514500_1480915372']['promote_price'] != ""): ?>
                    <?php echo $this->_var['goods_0_31514500_1480915372']['promote_price']; ?>
                    <?php else: ?>
                    <?php echo $this->_var['goods_0_31514500_1480915372']['shop_price']; ?>
                <?php endif; ?>
                </strong></div>
                <div class="title">
                    <div style="height: 44px;overflow: hidden;">
                    <a href="<?php echo $this->_var['goods_0_31514500_1480915372']['url']; ?>">
                      <strong>
                      <?php echo $this->_var['goods_0_31514500_1480915372']['name']; ?>
                     </strong>
                    </a>
                    </div>
                    <?php if ($this->_var['goods_0_31514500_1480915372']['goods_brief']): ?>
                    <?php echo sub_str($this->_var['goods_0_31514500_1480915372']['goods_brief'],15); ?>
                    <?php else: ?>
                    <em class="u-jd" style="margin-right: 10px;"><?php echo $this->_var['shop_name']; ?></em>馨清自营，品质保障
                    <?php endif; ?>
                    
                </div>
                <div class="p-icons">
                <i class="goods-icons-s1 J-picon-tips1" data-tips="本商品馨清配送" title="本商品馨清配送">馨清配送</i>
                <?php if ($this->_var['goods_0_31514500_1480915372']['promote_price']): ?>
                <i class="goods-icons J-picon-tips" data-tips="本商品限时促销" title="本商品限时促销">限时促销</i>
                <?php endif; ?>
                <?php if ($this->_var['goods_0_31514500_1480915372']['is_shipping']): ?>
                <i class="goods-icons-s1 J-picon-tips" data-tips="本商品免运费" title="本商品免运费"></i>
                <?php endif; ?>
                </div>
                <div class="p-operate">
                 <a href="javascript:;" onclick="Compare.add(<?php echo $this->_var['goods_0_31514500_1480915372']['goods_id']; ?>,'<?php echo $this->_var['goods_0_31514500_1480915372']['goods_name']; ?>','<?php echo $this->_var['goods_0_31514500_1480915372']['goods_img']; ?>','<?php echo $this->_var['goods_0_31514500_1480915372']['type']; ?>','<?php echo $this->_var['goods_0_31514500_1480915372']['shop_price']; ?>')" class="p-o-btn contrast J_contrast"><?php echo $this->_var['lang']['compare']; ?></a>
                 <a class="p-o-btn lfocus J_focus" href="javascript:collect(<?php echo $this->_var['goods_0_31514500_1480915372']['goods_id']; ?>);"><i></i>收藏</a>
                 <a class="p-o-btn addcart" href="javascript:addToCart(<?php echo $this->_var['goods_0_31514500_1480915372']['goods_id']; ?>)"><i></i>加入购物车</a>
                </div>
                
                
            </div>
             <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    </div>
<?php endif; ?>



<script type="Text/Javascript" language="JavaScript">
<!--

function selectPage(sel)
{
  sel.form.submit();
}

//-->
</script>
<script type="text/javascript">
window.onload = function()
{
  Compare.init();
  fixpng();
}
<?php $_from = $this->_var['lang']['compare_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
<?php if ($this->_var['key'] != 'button_compare'): ?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php else: ?>
var button_compare = '';
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>