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
<link href="<?php echo $this->_var['jd_css_path']; ?>" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,compare.js,lefttime.js')); ?>
<script type="text/javascript">
function $id(element) {
  return document.getElementById(element);
}
//切屏--是按钮，_v是内容平台，_h是内容库
function reg(str){
  var bt=$id(str+"_b").getElementsByTagName("h2");
  for(var i=0;i<bt.length;i++){
    bt[i].subj=str;
    bt[i].pai=i;
    bt[i].style.cursor="pointer";
    bt[i].onclick=function(){
      $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
      for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("h2").length;j++){
        var _bt=$id(this.subj+"_b").getElementsByTagName("h2")[j];
        var ison=j==this.pai;
        _bt.className=(ison?"":"h2bg");
      }
    }
  }
  $id(str+"_h").className="none";
  $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
}

</script>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/jd_toolbar.lbi'); ?>
<script type="text/javascript">
 $(function(){
      $(".thumb_img").mouseenter(function() {
          $('#coverimg').attr('src',$(this).find('img').attr('data-img-url'));
          $('#coverimg').attr('jqimg', $(this).find('img').attr('data-orig-url'));
      });

      $(".tabmenu").click(function() {

          var tabid = $(this).attr('data-id');
          $('.tab_content').hide();
          $('#' + tabid).show();
          $('.tabmenu').removeClass('hover');
          $(this).addClass('hover');
      });
      
 });

function setAmount(type) {
  var number = parseInt($('#number').val());
  var result;
  if (type=='add') {
    result = number+1;
  } else if (type=='reduce') {
    if (number == 1) return;
    result = number-1;
  }
  $('#number').val(result);
  changePrice();
}
</script>
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.jqzoom.js,base.js')); ?>


<div class="main">
    <div class="mg-cate w1160px clearfix">
    <?php echo $this->fetch('library/category_tree.lbi'); ?>
    
    </div>
	<div class="p-box">
    <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
        <div class="w1160px clearfix">
          
          <div class="mg-subnav pt20 ">
            <?php echo $this->fetch('library/ur_here.lbi'); ?>
          </div>
          

          
          
          <div class="mg-item-info mt20 fl clearfix wbg">
            <div class="previewLeft fl">
              <div id="preview" class="spec-preview">
                    <?php if ($this->_var['pictures']): ?>
                       <span>
                           <a href="javascript:;" onclick="window.open('gallery.php?id=<?php echo $this->_var['goods']['goods_id']; ?>'); return false;" class="jqzoom">
                            <img src="<?php echo $this->_var['goods']['goods_img']; ?>" jqimg="<?php echo $this->_var['goods']['original_img']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" id="coverimg" width="350px"/>
                           </a>
                        </span>
                  
                    <?php else: ?>
                      <span class="jqzoom">
                      <img src="<?php echo $this->_var['goods']['goods_img']; ?>" jqimg="<?php echo $this->_var['goods']['original_img']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" id="coverimg" width="350px"/></span>
                    <?php endif; ?>
              </div>
              
              <div class="spec-scroll"> <a class="prev"></a> <a class="next"></a>
                <div class="items">
                  <ul>
                     <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');if (count($_from)):
    foreach ($_from AS $this->_var['picture']):
?>
                      <li class="thumb_img"><a href="gallery.php?id=<?php echo $this->_var['id']; ?>&amp;img=<?php echo $this->_var['picture']['img_id']; ?>" target="_blank"><img src="<?php if ($this->_var['picture']['thumb_url']): ?><?php echo $this->_var['picture']['thumb_url']; ?><?php else: ?><?php echo $this->_var['picture']['img_url']; ?><?php endif; ?>" alt="<?php echo $this->_var['goods']['goods_name']; ?>" class="B_blue" data-orig-url="<?php echo $this->_var['picture']['img_original']; ?>" data-img-url="<?php echo $this->_var['picture']['img_url']; ?>" /></a>
                      </li>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  </ul>
                </div>
              </div>
              
              <div class="short-share">
              <div class="fl"><span>商品编号：</span><span><?php echo $this->_var['goods']['goods_sn']; ?></span></div>
              <a class="choose-btn-coll" href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)"><b></b><em>收藏商品</em></a>
              </div>
            </div>
            <div class="mg-sp-content fl">
              <h2><?php echo $this->_var['goods']['goods_style_name']; ?></h2>
              <?php if ($this->_var['promotion']): ?>
              <div class="p-ad">
              <?php $_from = $this->_var['promotion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
               <?php echo $this->_var['lang']['activity']; ?>
               <?php if ($this->_var['item']['type'] == "favourable"): ?>
              <a href="javascript:;" title="<?php echo $this->_var['lang']['favourable']; ?>" style="font-weight:100; color:#006bcd; text-decoration:none;">[<?php echo $this->_var['lang']['favourable']; ?>]</a>
               <?php endif; ?>
               <a href="<?php echo $this->_var['item']['url']; ?>" title="<?php echo $this->_var['lang'][$this->_var['item']['type']]; ?> <?php echo $this->_var['item']['act_name']; ?><?php echo $this->_var['item']['time']; ?>" style="font-weight:100; color:#006bcd;"><?php echo $this->_var['item']['act_name']; ?></a><br />
               <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </div>
              <?php endif; ?>
              <ul style="padding-top:5px">
                <li class="clearfix" style="background-color:#f7f7f7"><div style="float:left">
                     <?php if ($this->_var['cfg']['show_marketprice']): ?>
                     <span><?php echo $this->_var['lang']['market_price']; ?></span><font class="market" ><?php echo $this->_var['goods']['market_price']; ?></font><br />
                     <?php endif; ?>
                     
                     <span><?php echo $this->_var['lang']['shop_price']; ?></span><font class="price" id="ECS_SHOPPRICE" <?php if ($this->_var['goods']['promote_price_org'] || $this->_var['volume_price_list']): ?>style="text-decoration: line-through;"<?php endif; ?>><?php echo $this->_var['goods']['shop_price_formated']; ?></font>
                    
                </div>
                <div class="summary-info">
                <div class="item">
                <p>累计评价</p>
                <a href="javascript:;" class="count"><?php echo $this->_var['comment_count']; ?></a>
                </div>
                </div>
                </li>
				<?php if ($this->_var['goods']['promote_price_org']): ?>
				<div class="summary-promotion">
				<div class="dt">促销信息：</div>
				<div class="dd">
				<div class="p-promotions">
				<div style="position: relative;"><em class="hl_red_bg"><?php echo $this->_var['lang']['time_promotion']; ?></em><span class="hl_red ">￥<?php echo $this->_var['goods']['promote_price_org']; ?></span>
				<span class="hl_red ">距离结束还有: </span><span id="leftTime" class="hl_red " ><?php echo $this->_var['lang']['please_waiting']; ?></span>
				</div>
				</div>
				</div>
				</div>
				<?php endif; ?>
                <?php if ($this->_var['goods']['is_shipping']): ?>
               <div class="summary-promotion">
				<div class="dt">促销信息：</div>
				<div class="dd">
				<div class="p-promotions">
				<div style="position: relative;"><em class="hl_red_bg"><?php echo $this->_var['lang']['free_goods']; ?></em><span class="hl_red "><?php echo $this->_var['lang']['goods_free_shipping']; ?></span></div>
				</div>
				</div>
				</div>
                <?php endif; ?>
                <?php if ($this->_var['volume_price_list']): ?>
                <div class="summary-promotion">
				<div class="dt">促销信息：</div>
				<div class="dd">
				<div class="p-promotions">
				<div style="position: relative;"><em class="hl_red_bg">批发促销信息</em>
				<?php $_from = $this->_var['volume_price_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'v_good');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['v_good']):
?>
				<span class="hl_red " <?php if ($this->_var['key'] > 1): ?>style="padding-left:157px"<?php endif; ?>>起订数满：<?php echo $this->_var['v_good']['number']; ?>个 &nbsp;优惠价为：<?php echo $this->_var['v_good']['format_price']; ?></span><br>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</div>
				</div>
				</div>
				</div>
                <?php endif; ?>
                <?php if ($this->_var['goods']['is_presell']): ?>
               <div class="summary-promotion">
				<div class="dt">预售信息：</div>
				<div class="dd">
				<div class="p-promotions">
				<div style="position: relative;"><em class="hl_red_bg">预售商品</em><span class="hl_red ">此商品为预售商品，付款后10—15个工作日内发货</span></div>
				</div>
				</div>
				</div>
                <?php endif; ?>
                <?php if ($this->_var['cfg']['show_addtime']): ?>
                    <li class="clearfix"><span><?php echo $this->_var['lang']['add_time']; ?></span><div class="font"><?php echo $this->_var['goods']['add_time']; ?></div></li>
                <?php endif; ?>

                <!--<li class="bg clearfix"><span>销售情况</span><div class="font">评价数 <b><?php echo $this->_var['comment_count']; ?></b> | 已售 <b><?php echo $this->_var['sale_count']; ?></b> </div></li> -->


                
                <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
                    <li class="mg-color clearfix"><span><?php echo $this->_var['spec']['name']; ?>：</span>

                      <?php if ($this->_var['spec']['attr_type'] == 1): ?>
                          <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
                            <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                                
                                <input type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> onclick="changePrice()" />
                                <label for="spec_value_<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['label']; ?></label>
                                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
                          <?php else: ?>
                                <select name="spec_<?php echo $this->_var['spec_key']; ?>" onchange="changePrice()">
                                  <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                                  <option label="<?php echo $this->_var['value']['label']; ?>" value="<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['label']; ?> <?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?><?php if ($this->_var['value']['price'] != 0): ?><?php echo $this->_var['value']['format_price']; ?><?php endif; ?></option>
                                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                </select>
                                <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
                          <?php endif; ?>
                      <?php else: ?>
                          <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                          
                          <input type="checkbox" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" onclick="changePrice()" />
                          <label for="spec_value_<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['label']; ?></label>
                            
                          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                          <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
                      <?php endif; ?>
                    </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                


                <li class="clearfix"><span><?php echo $this->_var['lang']['goods_rank']; ?></span><img src="themes/default/images/stars<?php echo $this->_var['goods']['comment_rank']; ?>.gif" alt="comment rank <?php echo $this->_var['goods']['comment_rank']; ?>" style="margin-top:5px;"/></li>

               <!-- <li class="clearfix"><span><?php echo $this->_var['lang']['amount']; ?>：</span><div class="price" id="ECS_GOODS_AMOUNT"></div></li> -->
                
                <?php if ($this->_var['goods']['goods_number'] != "" && $this->_var['cfg']['show_goodsnumber']): ?>
                <li class="mg-number clearfix"><div class="font">
                
                  <?php if ($this->_var['goods']['goods_number'] == 0 && $this->_var['goods']['is_presell'] != 1): ?>
                      <?php echo $this->_var['lang']['goods_number']; ?>
                      <font color='red'><?php echo $this->_var['lang']['stock_up']; ?></font>
                  <?php elseif ($this->_var['goods']['is_presell'] == 1): ?>    
                      <?php echo $this->_var['lang']['goods_number']; ?>
                      <font color='red'>预售商品无需考虑库存</font>
                    <?php else: ?>
                      <?php echo $this->_var['lang']['goods_number']; ?>
                      <?php echo $this->_var['goods']['goods_number']; ?> <?php echo $this->_var['goods']['measure_unit']; ?>
                    <?php endif; ?>
                  

                </div></li>
                <?php endif; ?>

                <li class="clearfix"><span><?php echo $this->_var['lang']['goods_click_count']; ?>：</span><div class="font"><?php echo $this->_var['goods']['click_count']; ?></div></li>


              </ul>
              <div class="mg-cart clearfix">
              <div class="choose-amount fl">
              <div class="wrap-input">
              <a herf="javascript:;" class="btn-reduce" onclick="setAmount('reduce')">-</a>
              <a herf="javascript:;" class="btn-add" onclick="setAmount('add')">+</a>
              <input id="number" type="text" size="4" value="1" name="number" onblur="changePrice()">
              </div>
              </div>
                <a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" class="in-cart">
               
                <span>加入购物车</span>
               
                </a>
                
              </div>


              

            </div>
            
          <div class="mg-sidebar mt20 fr wbg pr10">
          <?php if ($this->_var['goods']['brand_id']): ?>
          
          <div class="mg-leftlist">
          <div class="brand-logo"><a target="_blank" href="category.php?id=<?php echo $this->_var['goods']['cat_id']; ?>&brand=<?php echo $this->_var['goods']['brand_id']; ?>"><img src="<?php echo $this->_var['goods']['brand_logo']; ?>" title="<?php echo $this->_var['goods']['goods_brand']; ?>" width="180" height="70"/></a></div>
          <div class="seller-infor"><a class="name" target="_blank" href="category.php?id=<?php echo $this->_var['goods']['cat_id']; ?>&brand=<?php echo $this->_var['goods']['brand_id']; ?>" title="<?php echo $this->_var['goods']['goods_brand']; ?>"><?php echo $this->_var['goods']['goods_brand']; ?></a>
          <em class="u-jd"><?php echo $this->_var['shop_name']; ?></em>
          </div>
          <div class="customer-service"><div class="seller-phone"><i class="concat-ico"></i><?php echo $this->_var['service_phone']; ?></div></div>
          <div style="padding:10px"><?php echo sub_str($this->_var['goods']['brand_desc'],200); ?></div>
          
          </div>
          <?php else: ?>
          	此商品无品牌
          <?php endif; ?>
          </div>
          
          </div>
          
          
          
        </div>
    </form>
	</div>
	<?php if ($this->_var['goods']['is_presell']): ?>
    <div class="w1160px clearfix mt10">
    <div class="pingou-process">
    <h3>预售流程</h3>
    <div class="item"><i class="sprite-step1"></i><dl><dt>1.拍下订单</dt><dd>与正常商品购物一样，加入购物车，拍下订单</dd></dl></div>
    <div class="item"><i class="sprite-step2"></i><dl><dt>2.支付款项</dt><dd>拍下订单后，按正常购物流程进行付款操作</dd></dl></div>
    <div class="item"><i class="sprite-step3"></i><dl><dt>3.等待发货</dt><dd>订单付款后，预计10—15个工作日内发货</dd></dl></div>
    </div>
    </div>
    <?php endif; ?>
    <?php echo $this->fetch('library/taocan.lbi'); ?>
    
	<div class="w1160px clearfix ">
	
	<div class="mg-sidebar mt10 fl">
	
	<div class="mt20 m2">
	<div class="mt"><h2>同类其他品牌</h2></div>
	<div class="mc">
	<ul class="lh">
	<?php $_from = $this->_var['similar_brand']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
	<li ><a href="category.php?id=<?php echo $this->_var['goods']['cat_id']; ?>&amp;brand=<?php echo $this->_var['brand']['brand_id']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a></li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	</div>
	</div>
	
     <?php echo $this->fetch('library/people_buy.lbi'); ?>
    </div>
    
     <div class="mg-container mt40 fr">
     
     <div class="mg-pro-hd">
        <ul>
          <li class="hover tabmenu" data-id="desc_tab"><?php echo $this->_var['lang']['goods_brief']; ?></li>
          <?php if ($this->_var['properties']): ?>
          <li class="tabmenu" data-id="attr_tab"><?php echo $this->_var['lang']['attr_parameter']; ?></li>
          <?php endif; ?>
          <?php if ($this->_var['goods']['goods_packing_list']): ?>
          <li class="tabmenu" data-id="pack_tab"><?php echo $this->_var['lang']['packing_list']; ?></li>
          <?php endif; ?>
          <li class="tabmenu" data-id="buy_tab">购买记录（<?php echo $this->_var['sale_count']; ?>）</li>
          <li class="tabmenu" data-id="commnet_tab"><?php echo $this->_var['lang']['user_comment']; ?>（<?php echo $this->_var['comment_count']; ?>）</li>
          <li class="tabmenu" data-id="alert_sale"><?php echo $this->_var['lang']['alert_sale']; ?></li>
        </ul>
      </div>
      
      
      <div class="mg-pro-bd">
        <div class="mg-info tab_content" id="desc_tab">
        <div class="p-parameter ">
        <!--<ul class="p-parameter-list"><li title="<?php echo $this->_var['goods']['goods_brand']; ?>">品牌：<a target="_blank" href="category.php?id=<?php echo $this->_var['goods']['cat_id']; ?>&brand=<?php echo $this->_var['goods']['brand_id']; ?>"><?php echo $this->_var['goods']['goods_brand']; ?></a></li></ul> -->
        <ul class="p-parameter-list">
        <!--<li title="<?php echo $this->_var['goods']['goods_brand']; ?>">商品名称：<?php echo $this->_var['goods']['goods_name']; ?></li> -->
        <!-- <li title="<?php echo $this->_var['goods']['goods_sn']; ?>">商品编号：<?php echo $this->_var['goods']['goods_sn']; ?></li> -->
        <li title="<?php echo $this->_var['goods']['goods_weight']; ?>"><?php echo $this->_var['lang']['goods_weight']; ?> <?php echo $this->_var['goods']['goods_weight']; ?></li>
        <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property_attr');if (count($_from)):
    foreach ($_from AS $this->_var['property_attr']):
?>
        <?php $_from = $this->_var['property_attr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');$this->_foreach['childitem'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['childitem']['total'] > 0):
    foreach ($_from AS $this->_var['property']):
        $this->_foreach['childitem']['iteration']++;
?>
        <?php if ($this->_foreach['childitem']['iteration'] <= 8): ?>
        <li title="<?php echo $this->_var['property']['value']; ?>"><?php echo htmlspecialchars($this->_var['property']['name']); ?>: <?php echo sub_str($this->_var['property']['value'],20); ?></li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <?php if ($this->_var['properties']): ?>
        <p class="more-par"><a href="javascript:;" class="J-more-param">更多参数>></a></p>
        <?php endif; ?>
        </div>
          <div class="sub-wrap">
            <div class="mg-content mt20">
              <?php echo $this->_var['goods']['goods_desc']; ?>
            </div>
            <?php if ($this->_var['goods']['brand_id']): ?>
            <div class="brand-info">
            <?php if ($this->_var['goods']['brand_desc_img']): ?>
            <img src="<?php echo $this->_var['goods']['brand_desc_img']; ?>" width="750" alt="<?php echo $this->_var['goods']['goods_brand']; ?>" title="<?php echo $this->_var['goods']['goods_brand']; ?>"/>
            <?php endif; ?>
            <?php if ($this->_var['goods']['brand_warrant_img']): ?>
            <img src="<?php echo $this->_var['goods']['brand_warrant_img']; ?>" width="750" alt="<?php echo $this->_var['goods']['goods_brand']; ?>" title="<?php echo $this->_var['goods']['goods_brand']; ?>"/>
            <?php endif; ?>
            <?php if ($this->_var['goods']['brand_license_img']): ?>
            <img src="<?php echo $this->_var['goods']['brand_license_img']; ?>" width="750" alt="<?php echo $this->_var['goods']['goods_brand']; ?>" title="<?php echo $this->_var['goods']['goods_brand']; ?>"/>
            <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        
        <div class="mg-info tab_content" style="display: none;" id="buy_tab">
          <?php 
$k = array (
  'name' => 'bought_notes',
  'id' => $this->_var['id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
		<div class="mg-info tab_content" style="display: none;" id="attr_tab">
		<div class="sub-wrap">
          <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
            <h4 class="attr_tit"><?php echo htmlspecialchars($this->_var['key']); ?></h4>
            <div class="attributes">
              <table>
                <?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');if (count($_from)):
    foreach ($_from AS $this->_var['property']):
?>
                <tr>
                  <td class="gray"><?php echo htmlspecialchars($this->_var['property']['name']); ?>:</td>
                  <td><?php echo $this->_var['property']['value']; ?></td>
                </tr>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </table>
            </div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </div>
        </div>
        <div class="mg-info tab_content" style="display: none;" id="pack_tab">
          <div class="sub-wrap">
          	<?php echo $this->_var['goods']['goods_packing_list']; ?>
          </div>
        </div>
        <div class="mg-info tab_content" style="display: none;" id="commnet_tab">
          <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js')); ?>
          <?php 
$k = array (
  'name' => 'comments',
  'type' => $this->_var['type'],
  'id' => $this->_var['id'],
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
        <div class="mg-info tab_content" style="display: none;" id="alert_sale">
          <?php echo $this->fetch('library/alert_sale.lbi'); ?>
        </div>
      </div>
      
      
      <?php echo $this->fetch('library/ui_box.lbi'); ?>
      
     </div>
	</div>
    
</div>

<?php echo $this->fetch('library/page_footer.lbi'); ?>

</body>
<script type="text/javascript">
var goods_id = <?php echo $this->_var['goods_id']; ?>;
var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
<?php $_from = $this->_var['lang']['goods_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var goodsId = <?php echo $this->_var['goods_id']; ?>;
var now_time = <?php echo $this->_var['now_time']; ?>;


onload = function(){
  changePrice();
  fixpng();
  try {onload_leftTime();}
  catch (e) {}
}

/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;

  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
}

/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('ECS_GOODS_AMOUNT'))
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
  }
}

</script>
</html>
