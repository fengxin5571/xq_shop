    
    <?php if ($this->_var['package_goods_list']): ?>
    <div class="w1160px mt20">
      <div class="mg-dp">
        <ul>
          <?php $_from = $this->_var['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods');$this->_foreach['package_goods_list_1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['package_goods_list_1']['total'] > 0):
    foreach ($_from AS $this->_var['package_goods']):
        $this->_foreach['package_goods_list_1']['iteration']++;
?> 
          <li id="czjb_btn_<?php echo $this->_foreach['package_goods_list_1']['iteration']; ?>" onClick='change_tab("czjb_btn_", "czlb_cont_", <?php echo $this->_foreach['package_goods_list_1']['iteration']; ?>,<?php echo $this->_foreach['package_goods_list_1']['total']; ?>,"on","")'  <?php if ($this->_foreach['package_goods_list_1']['iteration'] == 1): ?>class="on"<?php endif; ?>><?php echo $this->_var['package_goods']['act_name']; ?></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>

        <?php $_from = $this->_var['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods');$this->_foreach['package_goods_list_2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['package_goods_list_2']['total'] > 0):
    foreach ($_from AS $this->_var['package_goods']):
        $this->_foreach['package_goods_list_2']['iteration']++;
?> 
        <div class="mg-stabcon clearfix" id="czlb_cont_<?php echo $this->_foreach['package_goods_list_2']['iteration']; ?>" <?php if ($this->_foreach['package_goods_list_2']['iteration'] != 1): ?>  style="display:none;" <?php endif; ?>>
          <div class="master fl">
            <div class="mg-p-img">
              <a href="<?php echo $this->_var['package_goods']['goods_main']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['package_goods']['goods_main']['goods_thumb']; ?>"></a>
            </div>
            <div class="mg-p-price">
              <label>价格：<b><?php echo $this->_var['package_goods']['goods_main']['rank_price']; ?></b></label>
            </div>
          </div>
          <div class="mg-s fl"></div>
          
          <div class="mg-ch-all fl clearfix">
            <div class="mg-chall">

              <?php $_from = $this->_var['package_goods']['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['goods_list']):
?>
              <?php if ($this->_var['goods_list']['goods_id'] != package_goods.goods_id): ?>
              <div class="master2">
                <div class="mg-p-img">
                  <a href="<?php echo $this->_var['goods_list']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['goods_list']['goods_thumb']; ?>"></a>
                </div>
                <div class="mg-p-price2">
                  <label>价格：<b><?php echo $this->_var['goods_list']['rank_price']; ?></b></label>
                </div>
              </div>
              <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
              
            </div>
          </div>
          
          <div class="ch-right fl"></div>
          <div class="mg-p-infos fl">
            <div class="mg-tc-num">套装价：<b><?php echo $this->_var['package_goods']['package_price']; ?></b></div>
            <div class="mg-tc-price">原&nbsp;&nbsp;价：<b><?php echo $this->_var['package_goods']['subtotal']; ?></b></div>
            <div class="mg-tc-price2">为你节省：<b><?php echo $this->_var['package_goods']['saving']; ?></b></div>
            <a href="javascript:addPackageToCart(<?php echo $this->_var['package_goods']['act_id']; ?>)" class="buy">购买优惠套餐</a>
            <a href="javascript:addPackageToCart(<?php echo $this->_var['package_goods']['act_id']; ?>)" class="incart">加入购物车</a>
          </div>
        </div>
      </div>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>


    <script>
 function change_tab(btn_pre, cont_pre, cnum,num,css_on,css_off)
{
  var button;
  var content;
  for(i=1;i<=num;i++)
  {
    button  = document.getElementById(btn_pre+i);
    content = document.getElementById(cont_pre+i);
    if(i== cnum)
    {
    button.className = css_on;
    content.style.display='';
    }
    else
    {
    button.className= css_off;
    content.style.display='none';  
    }
    
    
  }
}
 </script>
    <?php endif; ?>


