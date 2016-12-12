<?php echo $this->smarty_insert_scripts(array('files'=>'jquery-1.9.1.min.js')); ?>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
<div class="container">

  <div class="user-top top">
    <div class="w1160px clearfix">
      
       <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js,utils.js,json2.js,jquery.dialog.js')); ?>
       <font class="user-f">
       <?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
	   </font>
      <div class="topnav fr">
      <a href="user_center.html" style="color:#666"><?php echo $this->_var['lang']['user_center']; ?></a>|
      <img src="themes/default/images/robot/u37.png"/><a href="order_list.html" style="color:#666"><?php echo $this->_var['lang']['label_order']; ?></a>|
       <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
            <?php if ($this->_var['key'] > 0): ?>|<?php endif; ?><a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?> target="_blank" <?php endif; ?> style="color:#666"><?php echo $this->_var['nav']['name']; ?></a>
       <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

      </div>
    </div>
  </div>


  <div class="user-header">
    <div class="w1160px clearfix">
      
      <div class="logo fl "><a href="index.html" name="top" title="<?php echo $this->_var['shop_name']; ?>" class="fore1"></a>
      <a  href="user_center.html" class="fore2"><?php echo $this->_var['lang']['user_center']; ?></a>
      <a  href="index.html" class="fore3">返回馨清首页</a>
      </div>
      
      

      <script type="text/javascript">
      
      <!--
      function checkSearchForm()
      {
          if(document.getElementById('keyword').value)
          {
              return true;
          }
          else
          {
              jAlert("<?php echo $this->_var['lang']['no_keywords']; ?>",null,"馨清网");
              return false;
          }
      }
      -->
      
      </script>
      <div class="navitems">
      <ul>
      <li class="fore-1"><a href="user_center.html">首页</a></li>
      <li class="fore-3"><div class="dl " id='user-dl'>
      <div class="dt" ><span class="myjd-set">账户设置</span><b></b></div>
      <div class="dd">
      <a href="user_info.html" id="u-a"><span><?php echo $this->_var['lang']['label_profile']; ?></span></a>
      <a href="safety_center.html" id="u-a"><span>账户安全</span></a>
      <a href="account_union.html" id="u-a"><span>账户绑定</span></a>
      <a href="address_list.html" id="u-a"><span><?php echo $this->_var['lang']['label_address']; ?></span></a>
      </div>
      </div></li>
      <li class="fore-5"><a href="message_list.html">消息</a></li>
      </ul>
      </div>
      <div class="nav-r">
      <div class="soso clearfix fl mt60 search-2014">
        <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()">
        <input name="keywords" type="text" id="keyword" class="user-soso-input fl" value="<?php echo htmlspecialchars($this->_var['search_keywords']); ?>">
        <input type="submit" class="user-soso-btn" value="搜索">
        </form>
        
      </div>
      
      <div class="user-settle fr mt25">
        <div class="user-settleup"><ul><li class="u-ci-left"></li><li class='ci-right'></li><li class="u-ci-count"><?php 
$k = array (
  'name' => 'cart_num',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></li></ul><a href='flow.php'class='ml20'>我的购物车</a></div>
        <div class="settledown"><?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?><br><button onclick="location.href='flow.php'">查看我的购物车</button></div>
      </div>
      </div>
    </div>
  </div>


