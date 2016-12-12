<?php 
$k = array (
  'name' => 'cron_auto',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
<script type="text/javascript">
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
<div id="myModal" class="reveal-modal">
					<h1>请在新打开页面完成支付完成付款</h1>
					<li>完成付款后请根据您 的情况点击下边按钮</li>
					<div><input type='button' class="bnt_blue_1" pay-done value="已完成付款"> <input type='button'  pay-no class="bnt_blue_1" value="付款遇到问题"></div>
					<a class="close-reveal-modal">&#215;</a>
					</div>

  <div class="footer ">
  
   <div class="slogen">
    <dl> 
            	<dt class="footer_ico1"></dt>
                <dd>
                    <p>全场正品</p><span>开具正规发票</span>
                </dd>
            </dl>
            <dl> 
            	<dt class="footer_ico4"></dt>
                <dd>
                    <p>免费送货</p>
                </dd>
            </dl>
            <dl> 
            	<dt class="footer_ico2"></dt>
                <dd>
                    <p>开箱验货</p><span>先验货再签收</span>
                </dd>
            </dl>
            <dl> 
            	<dt class="footer_ico3"></dt>
                <dd>
                    <p>免费安装</p>
                </dd>
            </dl>
            <dl> 
            	<dt class="footer_ico5"></dt>
                <dd>
                    <p>售后全包</p><span>检测 换件 维修</span>
                </dd>
            </dl>
    </div>
    
    <div class="w1160px">
   
      <div class="footer-menu clearfix ">
        <?php if ($this->_var['helps']): ?>
        <?php $_from = $this->_var['helps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'help_cat');if (count($_from)):
    foreach ($_from AS $this->_var['help_cat']):
?>
        <ul>
          <li><strong><?php echo $this->_var['help_cat']['cat_name']; ?></strong></li>
          <?php $_from = $this->_var['help_cat']['article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item_0_20007000_1480915354');if (count($_from)):
    foreach ($_from AS $this->_var['item_0_20007000_1480915354']):
?>
          <li><a href="<?php echo $this->_var['item_0_20007000_1480915354']['url']; ?>" title="<?php echo htmlspecialchars($this->_var['item_0_20007000_1480915354']['title']); ?>"><?php echo $this->_var['item_0_20007000_1480915354']['short_title']; ?></a></li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php endif; ?>
        <ul>
          <li><strong>商城官方微信</strong></li>
          <li><img src="<?php echo $this->_var['weixin']; ?>" width="100" height="100" alt=""></li>
        </ul>
      
      <div class="conner ">
        <div class="tel">
          <p><strong><?php echo $this->_var['service_phone']; ?></strong></p>
          <p>周一至周日9:00-23:00</p>
          <?php if ($this->_var['qq']): ?>
          <p><a href="tencent://message/?uin=<?php echo $this->_var['qq']; ?>&Site=<?php echo $this->_var['shop_name']; ?>&Menu=yes" target="_blank">联系在线客服</a></p>
          <?php endif; ?>
          
        </div>
        <div class="share">
          <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
        </div>
      </div>
      </div>
      
      <div class="clr"></div>
    </div>
  </div>


  <div class="copyright">
    <div class="w1160px">
      <p>
       <?php if ($this->_var['navigator_list']['bottom']): ?>
       <?php $_from = $this->_var['navigator_list']['bottom']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav_0_20111900_1480915354');$this->_foreach['nav_bottom_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_bottom_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav_0_20111900_1480915354']):
        $this->_foreach['nav_bottom_list']['iteration']++;
?>
            <a href="<?php echo $this->_var['nav_0_20111900_1480915354']['url']; ?>" <?php if ($this->_var['nav_0_20111900_1480915354']['opennew'] == 1): ?> target="_blank" <?php endif; ?>><?php echo $this->_var['nav_0_20111900_1480915354']['name']; ?></a>
            <?php if (! ($this->_foreach['nav_bottom_list']['iteration'] == $this->_foreach['nav_bottom_list']['total'])): ?>
               |
            <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <?php endif; ?>

      </p>
      <p> <?php echo $this->_var['copyright']; ?>  <a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo $this->_var['icp_number']; ?></a>
      <?php if ($this->_var['stats_code']): ?>
         <divsh><?php echo $this->_var['stats_code']; ?></div>
      <?php endif; ?>
      </p>
      
      <div class="safe-site mt20">
        <a href="#" title=""><img src="themes/default/images/robot/safe1.jpg" alt=""></a><a href="#" title=""><img src="themes/default/images/robot/safe2.jpg" alt=""></a><a href="#" title=""><img src="themes/default/images/robot/safe3.jpg" alt=""></a>
      </div>
    </div>
  </div>

</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'focus.js,mousevent.js,ztab.js,simplefoucs.js')); ?>
