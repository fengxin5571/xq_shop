<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?>商城</title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_var['jd_css_path']; ?>" rel="stylesheet" type="text/css" />
<link rel="alternate" type="application/rss+xml" title="RSS|<?php echo $this->_var['page_title']; ?>" href="<?php echo $this->_var['feed_url']; ?>" />
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery-1.9.1.min.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'focus.js,common.js')); ?>
</head>
<body>
<style type="text/css">
#indexheadpopup{width:600px; height:600px; overflow:hidden;position:absolute;display:none; margin:0 auto;z-Index:999}
</style>
<script>
jQuery(function() {
/*首页弹窗广告*/
    //Set the popup window to center
	var COOKIE_NAME = "mode1";
	if( $.cookie(COOKIE_NAME)){
		$("#indexheadpopup").hide();
	}else{
	   var winH = $(window).height();
	   var winW = $(window).width();
	   
	  $("#indexheadpopup").css({position:'absolute','top': (winH - $('#indexheadpopup').outerHeight())/2 + $(document).scrollTop() ,'left': winW/2-$("#indexheadpopup").width()/2});
        $("#indexheadpopup").slideDown(1000, function() {
        setTimeout("ClearIndexHeadPopup()", '25000');
        });
      $.cookie(COOKIE_NAME,"mode1", {path: '/', expires: 1});
	}});
	function ClearIndexHeadPopup() {
	     $('#indexheadpopup').hide();  
   }
   jQuery(window).click(function(){
      $('#indexheadpopup').hide();  
   });
</script>
<div id="indexheadpopup">
<?php 
$k = array (
  'name' => 'ads',
  'id' => '17',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
<i style="background: url(themes/default/images/robot/delete_blue.png) no-repeat ;width: 30px;height: 28px;display: block;margin: 0 auto;position: absolute;right: 10px;top: 100px;z-index: 10;"></i>
</div>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/jd_toolbar.lbi'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'jdscro.js')); ?>
<?php echo $this->fetch('library/jdscro.lbi'); ?>
<div class="main">
    <div id="indexheadpopup">
<?php 
$k = array (
  'name' => 'ads',
  'id' => '17',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
</div>

    
    <div class="w1160px clearfix">
      
      <?php echo $this->fetch('library/category_tree.lbi'); ?>
      <div class="left_img"><?php 
$k = array (
  'name' => 'ads',
  'id' => '15',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
      
      
      <?php echo $this->fetch('library/index_ad.lbi'); ?>
      
      <div class="home-news fr">
        <?php echo $this->fetch('library/new_articles.lbi'); ?>
        <div class="user-region clearfix">
          <?php 
$k = array (
  'name' => 'ads',
  'id' => '10',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
        </div>
      </div>
    </div>
    
    
    <?php echo $this->fetch('library/guess_you_like.lbi'); ?>
    
    
    
    
    
    <?php echo $this->fetch('library/old_show_good.lbi'); ?> 
    
    
    <?php if ($this->_var['factory_goods']): ?>
    
    <div class="w1160px f1">
      
      <div class="mol mt5">
      <div class="mt"> 
      <div class='mtTop'><span class="h2_text">1F</span><h2>净水器</h2></div>
      <ul class="tab">
      <?php $_from = $this->_var['onef_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['catchild'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catchild']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['catchild']['iteration']++;
?> 
        <?php if ($this->_foreach['catchild']['iteration'] <= 6): ?>
        <li class="tab-item <?php if ($this->_foreach['catchild']['iteration'] == 1): ?>tab-selected<?php endif; ?>" ><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['name']; ?></a></li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <li class="tab-item" style="float:right"><a href="<?php echo $this->_var['factory_url']; ?>">查看更多</a></li>
      <ul>
      </div>
        
        <div class="mol-bd clearfix">
          <div class="big fl">
             <?php 
$k = array (
  'name' => 'ads',
  'id' => '13',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
          </div>
          <div class="img-list fl">
            <ul>
              <?php $_from = $this->_var['factory_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods']):
?>
                  <li class="con">
                  <div class="p-img">
                  <a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><img  src="<?php echo $this->_var['goods']['goods_img']; ?>" width="170" height="160" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class='err-product brand_rec_img'></a>
                  </div>
                  <?php if ($this->_var['is_show_presell_icn']): ?>
                  <?php if ($this->_var['goods']['is_presell']): ?>
                  <i class="zc_icon"></i>
                  <?php endif; ?>
                  <?php endif; ?>
                  <div class="txt"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a></div>
                  <div class="txt-price"><span class="mod_price sk_item_price_new"><?php if ($this->_var['goods']['promote_price'] != ""): ?>
                                <?php echo $this->_var['goods']['promote_price']; ?>
                                <?php else: ?>
                                <?php echo $this->_var['goods']['shop_price']; ?>
                                <?php endif; ?></span> 
                                <span class="mod_price sk_item_price_origin"><?php echo $this->_var['goods']['market_price']; ?></span>
                                </div>
                  </li>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
          </div>
          
        </div>
      </div>
      
      </div>
      <div class="w1160px">
      <div class="adv mt10">
        <?php 
$k = array (
  'name' => 'ads',
  'id' => '1',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
      </div>
      </div>
      <?php endif; ?>
      <?php if ($this->_var['life_goods']): ?>
      
      
      <div class="w1160px">
      <div class="mol mt20">
      <div class="mt"> 
      <div class='mtTop'><span class="h2_text">2F</span><h2>空气净化器</h2></div>
      <ul class="tab">
      <?php $_from = $this->_var['twof_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['catchild'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catchild']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['catchild']['iteration']++;
?> 
        <?php if ($this->_foreach['catchild']['iteration'] <= 6): ?>
        <li class="tab-item <?php if ($this->_foreach['catchild']['iteration'] == 1): ?>tab-selected<?php endif; ?>" ><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['name']; ?></a></li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <li class="tab-item" style="float:right"><a href="<?php echo $this->_var['life_url']; ?>">查看更多</a></li>
      <ul>
      </div>
        
       
        <div class="mol-bd clearfix">
          <div class="big fl">
            <?php 
$k = array (
  'name' => 'ads',
  'id' => '14',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
          </div>
          <div class="img-list fl">
            <ul>
              <?php $_from = $this->_var['life_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods']):
?>
                  <li class="con"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><img  src="<?php echo $this->_var['goods']['goods_img']; ?>" width="145" height="145" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class='err-product brand_rec_img'></a>
                  <?php if ($this->_var['is_show_presell_icn']): ?>
                  <?php if ($this->_var['goods']['is_presell']): ?>
                  <i class="zc_icon"></i>
                  <?php endif; ?>
                  <?php endif; ?>
                  <div class="txt"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a></div>
                  <div class="txt-price"><span class="mod_price sk_item_price_new"><?php if ($this->_var['goods']['promote_price'] != ""): ?>
                                <?php echo $this->_var['goods']['promote_price']; ?>
                                <?php else: ?>
                                <?php echo $this->_var['goods']['shop_price']; ?>
                                <?php endif; ?></span> 
                                <span class="mod_price sk_item_price_origin"><?php echo $this->_var['goods']['market_price']; ?></span>
                                </div>
                  </li>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
          </div>
          
        </div>
      </div>
      
      </div>
      <div class="w1160px">
      <div class="adv mt10">
        <?php 
$k = array (
  'name' => 'ads',
  'id' => '2',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
      </div>
	  </div>
	  <?php endif; ?>
	  <?php if ($this->_var['parts_goods']): ?>
      
      
      <div class="w1160px">
      <div class="mol mt20">
      <div class="mt"> 
      <div class='mtTop'><span class="h2_text">3F</span><h2>防护器具</h2></div>
      <ul class="tab">
      <?php $_from = $this->_var['threef_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['catchild'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catchild']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['catchild']['iteration']++;
?> 
        <?php if ($this->_foreach['catchild']['iteration'] <= 6): ?>
        <li class="tab-item <?php if ($this->_foreach['catchild']['iteration'] == 1): ?>tab-selected<?php endif; ?>" ><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['name']; ?></a></li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <li class="tab-item" style="float:right"><a href="<?php echo $this->_var['parts_url']; ?>">查看更多</a></li>
      <ul>
      </div>
        <div class="mol-bd clearfix">
          <div class="big fl">
            <div class="big-img"><a href="<?php echo $this->_var['parts_url']; ?>" title=""><img src="themes/default/images/robot/big2.jpg" width="201" height="398" alt=""></a></div>
          </div>
          <div class="img-list fl">
            <ul>
               <?php $_from = $this->_var['parts_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods']):
?>
                  <li class="con"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><img  src="<?php echo $this->_var['goods']['goods_img']; ?>" width="145" height="145" alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" class='err-product brand_rec_img'></a>
                  <?php if ($this->_var['is_show_presell_icn']): ?>
                  <?php if ($this->_var['goods']['is_presell']): ?>
                  <i class="zc_icon"></i>
                  <?php endif; ?>
                  <?php endif; ?>
                  <div class="txt"><a href="<?php echo $this->_var['goods']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" target="_blank"><?php echo htmlspecialchars($this->_var['goods']['name']); ?></a></div>
                  <div class="txt-price"><span class="mod_price sk_item_price_new"><?php if ($this->_var['goods']['promote_price'] != ""): ?>
                                <?php echo $this->_var['goods']['promote_price']; ?>
                                <?php else: ?>
                                <?php echo $this->_var['goods']['shop_price']; ?>
                                <?php endif; ?></span> 
                                <span class="mod_price sk_item_price_origin"><?php echo $this->_var['goods']['market_price']; ?></span>
                                </div>
                  </li>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </ul>
          </div>
          
        </div>
      </div>
      
      </div>
      <div class="w1160px">
      <div class="adv mt10">
          <?php 
$k = array (
  'name' => 'ads',
  'id' => '3',
  'num' => '1',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
      </div>
      </div>
      <?php endif; ?>
    
    
    <?php if ($this->_var['txt_links']): ?>
    <div class="w1160px">
      <div class="friendlink mt50"><strong>友情链接：</strong>
        <?php $_from = $this->_var['txt_links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'link');if (count($_from)):
    foreach ($_from AS $this->_var['link']):
?>
        <a href="<?php echo $this->_var['link']['url']; ?>" target="_blank" title="<?php echo $this->_var['link']['name']; ?>"><?php echo $this->_var['link']['name']; ?></a>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </div>
    </div>
    <?php endif; ?>
    
  </div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>

</body>
</html>
<script>
var interval = 1000; 
function ShowCountDown(year,month,day,divname) 
{ 
var now = new Date(); 
var endDate = new Date(year, month-1, day); 
var leftTime=endDate.getTime()-now.getTime(); 
var leftsecond = parseInt(leftTime/1000); 
//var day1=parseInt(leftsecond/(24*60*60*6)); 
var day1=Math.floor(leftsecond/(60*60*24)); 
var hour=Math.floor((leftsecond-day1*24*60*60)/3600); 
var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60); 
var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60); 
var cc = document.getElementById(divname);
if(day1>999){
	day1=999;
}
cc.innerHTML='<div class="cd_item cd_hour"><span class="cd_item_txt">'+day1+'</span></div>'+
             '<div class="cd_split"><i class="cd_split_dot cd_split_top"></i><i class="cd_split_dot cd_split_bottom"></i></div>'+
             '<div class="cd_item cd_minute"><span class="cd_item_txt">'+minute+'</span></div>'+
             '<div class="cd_split"><i class="cd_split_dot cd_split_top"></i><i class="cd_split_dot cd_split_bottom"></i></div>'+
             '<div class="cd_item cd_second"><span class="cd_item_txt">'+second+'</span></div>';
} 
window.setInterval(function(){ShowCountDown(<?php echo $this->_var['promote_end_time']['year']; ?>,<?php echo $this->_var['promote_end_time']['mon']; ?>,<?php echo $this->_var['promote_end_time']['mday']; ?>,'index_time');}, interval); 
</script>