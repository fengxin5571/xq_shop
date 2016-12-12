<script type="text/javascript">
function clear_history()
{
	Ajax.call('user.php', 'act=clear_history',clear_history_Response, 'GET', 'TEXT',1,1);
}
function clear_history_Response(res)
{
	document.getElementById('jt-history-wrap').innerHTML = '您已清空最近浏览过的商品';
}
function drop_cart_goods(){
	document.getElementById('tbar-cart-list').innerHTML='';
}
</script>
<div class="J-global-toolbar">
	<div class="toolbar-wrap J-wrap">
		<div class="toolbar">
			<div class="toolbar-panels J-panel">
				<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-cart toolbar-animate-out">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="flow.php" class="title"><i></i><em class="title">购物车</em></a>
						<span class="close-panel J-close"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div id="J-cart-tips" class="tbar-tipbox hide">
								<div class="tip-inner">
									<span class="tip-text">还没有登录，登录后商品将被保存</span>
									<a href="#none" class="tip-btn J-login">登录</a>
								</div>
							</div>
							<div id="J-cart-render">
								<div class="tbar-cart-list">
								<?php 
$k = array (
  'name' => 'jd_car_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
					
				</div>

				<div style="visibility: hidden;" data-name="follow" class="J-content toolbar-panel tbar-panel-follow">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="javascript:;" target="_blank" class="title"> <i></i> <em class="title">我的收藏</em> </a>
						<span class="close-panel J-close"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
						<ul>
						<?php if ($this->_var['use_c_goods_list']): ?>
						<?php $_from = $this->_var['use_c_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'good');if (count($_from)):
    foreach ($_from AS $this->_var['good']):
?>
						<li class="jth-item"><a href="<?php echo $this->_var['good']['url']; ?>" target="_blank" class="img-wrap"><img src="<?php echo $this->_var['good']['goods_thumb']; ?>" alt="<?php echo $this->_var['good']['goods_name']; ?>" width="100" height="100">
            			</a><a class="add-cart-button" href="javascript:addToCart(<?php echo $this->_var['good']['goods_id']; ?>)" target="_blank" style="display: none;">加入购物车</a><p class="price"> <?php echo $this->_var['good']['shop_price']; ?></p>
            			</li>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php else: ?>
						未登录或收藏夹为空！
						<?php endif; ?>
						</ul>
							<div class="tbar-tipbox2">
								<div class="tip-inner"> <i class="i-loading"></i> </div>
							</div>
						</div>
					</div>
					<div class="tbar-panel-footer J-panel-footer"></div>
				</div>
				
				<div style="visibility: hidden;" class="J-content toolbar-panel tbar-panel-history toolbar-animate-in">
					<h3 class="tbar-panel-header J-panel-header">
						<a href="javascript:;" target="_blank" class="title"> <i></i> <em class="title">我的足迹</em> </a>
						<span class="close-panel J-close"></span>
					</h3>
					<div class="tbar-panel-main">
						<div class="tbar-panel-content J-panel-content">
							<div class="jt-history-wrap" id='jt-history-wrap'>
								<?php 
$k = array (
  'name' => 'history',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
								<a onclick="clear_history()" href="javascript:;" class="history-bottom-more" target="_blank"><?php echo $this->_var['lang']['clear_history']; ?> &gt;&gt;</a>
							</div>
						</div>
					</div>
					<div class="tbar-panel-footer J-panel-footer"></div>
				</div>
			</div>
			
			<div class="toolbar-header"></div>
			
			<div class="toolbar-tabs J-tab">
				<div class="toolbar-tab tbar-tab-cart">
					<i class="tab-ico"></i>
					<em class="tab-text ">购物车</em>
					<span class="tab-sub J-count "><?php 
$k = array (
  'name' => 'cart_num',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></span>
				</div>
				<div class=" toolbar-tab tbar-tab-follow">
					<i class="tab-ico"></i>
					<em class="tab-text">我的收藏</em>
					<span class="tab-sub J-count hide">0</span> 
				</div>
				<div class=" toolbar-tab tbar-tab-history ">
					<i class="tab-ico"></i>
					<em class="tab-text">我的足迹</em>
					<span class="tab-sub J-count hide">0</span>
				</div>
			</div>
			
			<div class="toolbar-footer">
				<div class="toolbar-tab tbar-tab-top"> <a href="#"> <i class="tab-ico  "></i> <em class="footer-tab-text">顶部</em> </a> </div>
				<?php if ($this->_var['qq']): ?>
				<div class=" toolbar-tab tbar-tab-feedback"> <a href="tencent://message/?uin=<?php echo $this->_var['qq']; ?>&Site=<?php echo $this->_var['shop_name']; ?>&Menu=yes" target="_blank"> <i class="tab-ico"></i> <em class="footer-tab-text ">反馈</em> </a> </div>
				<?php endif; ?>
			</div>
			
			<div class="toolbar-mini"></div>
			
		</div>
		
		<div id="J-toolbar-load-hook"></div>
		
	</div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'nav.js')); ?>