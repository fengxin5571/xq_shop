<!-- $Id: start.htm 17110 2010-04-15 07:47:51Z sxc_shop $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start personal message -->
<?php if ($this->_var['admin_msg']): ?>
<div class="list-div" style="border: 1px solid #CC0000">
  <table cellspacing='1' cellpadding='3'>
    <tr>
      <th><?php echo $this->_var['lang']['pm_title']; ?></th>
      <th><?php echo $this->_var['lang']['pm_username']; ?></th>
      <th><?php echo $this->_var['lang']['pm_time']; ?></th>
    </tr>
    <?php $_from = $this->_var['admin_msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'msg');if (count($_from)):
    foreach ($_from AS $this->_var['msg']):
?>
      <tr align="center">
        <td align="left"><a href="message.php?act=view&id=<?php echo $this->_var['msg']['message_id']; ?>"><?php echo sub_str($this->_var['msg']['title'],60); ?></a></td>
        <td><?php echo $this->_var['msg']['user_name']; ?></td>
        <td><?php echo $this->_var['msg']['send_date']; ?></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
  </div>
<br />
<?php endif; ?>
<!-- end personal message --><div class="list-div">	<div class="important">    	<ul>        	<li class="item01">            	<div class="con_box">                	<img src="images/menu/icon01.png" />                	<h2>今日销售总额</h2>                    <p><!--<?php if ($this->_var['today']['formatted_money']): ?>--><?php echo $this->_var['today']['formatted_money']; ?><!--<?php else: ?>-->0.00<!--<?php endif; ?>--></p>                </div>            </li>            <li class="item02">            	<div class="con_box">                	<img src="images/menu/icon02.png" />                	<h2>今日订单总数</h2>                    <p><?php echo $this->_var['today']['order']; ?></p>                </div>            </li>            <li class="item03">            	<div class="con_box">                	<img src="images/menu/icon03.png" />                	<h2>今日注册会员</h2>                    <p><?php echo $this->_var['today']['user']; ?></p>                </div>            </li>            <li class="item04">            	<div class="con_box">                	<img src="images/menu/icon04.png" />                	<h2>今日网站访问</h2>                    <p><?php echo $this->_var['today_visit']; ?></p>                </div>            </li>        </ul>    </div>	<div class="console_detaile">    	<ul>        	<li class="item01">            	<div class="con_box clearfix">                    <div class="img"><img src="images/menu/iconfont-weiqueren.png" width="30" height="30" /></div>                    <div class="text"><h2><?php echo $this->_var['lang']['unconfirmed']; ?></h2><p><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['unconfirmed']; ?>"><?php echo $this->_var['order']['unconfirmed']; ?></a></p></div>                </div>            </li><li class="item02">            	<div class="con_box clearfix">                    <div class="img"><img src="images/menu/iconfont-daizhifu.png" width="30" height="30" /></div>                	<div class="text"><h2><?php echo $this->_var['lang']['await_pay']; ?></h2><p><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_pay']; ?>"><?php echo $this->_var['order']['await_pay']; ?></a></p></div>                </div>            </li><li class="item03">            	<div class="con_box clearfix">                    <div class="img"><img src="images/menu/iconfont-daifahuo.png" width="30" height="30" /></div>                	<div class="text"><h2><?php echo $this->_var['lang']['await_ship']; ?></h2><p><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_ship']; ?>"><?php echo $this->_var['order']['await_ship']; ?></a></p></div>                </div>            </li><li class="item04">            	<div class="con_box clearfix">                    <div class="img"><img src="images/menu/iconfont-iconsvggyiwancheng18.png" width="30" height="30" /></div>                	<div class="text"><h2><?php echo $this->_var['lang']['finished']; ?></h2><p><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['finished']; ?>"><?php echo $this->_var['order']['finished']; ?></a></p></div>                </div>            </li><li class="item05">            	<div class="con_box clearfix">                    <div class="img"><img src="images/menu/iconfont-dengji.png" width="30" height="30" /></div>                	<div class="text clearfix"><h2><?php echo $this->_var['lang']['new_booking']; ?></h2><p><a href="goods_booking.php?act=list_all"><?php echo $this->_var['booking_goods']; ?></a></p></div>                </div>            </li><li class="item06">            	<div class="con_box">                    <div class="img"><img src="images/menu/iconfont-yifahuo.png" width="30" height="30" /></div>                	<div class="text"><h2>发货订单</h2><p><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['shipped_part']; ?>"><?php echo $this->_var['order']['shipped_part']; ?></a></p></div>                </div>            </li>        </ul>    </div></div>
<!-- start order statistics -->
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4" class="group-title"><?php echo $this->_var['lang']['order_stat']; ?></th>
  </tr>
  <tr>
    <td width="20%"><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_ship']; ?>"><?php echo $this->_var['lang']['await_ship']; ?></a></td>
    <td width="30%"><strong style="color: red"><?php echo $this->_var['order']['await_ship']; ?></strong></td>
    <td width="20%"><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['unconfirmed']; ?>"><?php echo $this->_var['lang']['unconfirmed']; ?></a></td>
    <td width="30%"><strong><?php echo $this->_var['order']['unconfirmed']; ?></strong></td>
  </tr>
  <tr>
    <td><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['await_pay']; ?>"><?php echo $this->_var['lang']['await_pay']; ?></a></td>
    <td><strong><?php echo $this->_var['order']['await_pay']; ?></strong></td>
    <td><a href="order.php?act=list&composite_status=<?php echo $this->_var['status']['finished']; ?>"><?php echo $this->_var['lang']['finished']; ?></a></td>
    <td><strong><?php echo $this->_var['order']['finished']; ?></strong></td>
  </tr>
  <tr>
    <td><a href="goods_booking.php?act=list_all"><?php echo $this->_var['lang']['new_booking']; ?></a></td>
    <td><strong><?php echo $this->_var['booking_goods']; ?></strong></td>
    <td><a href="user_account.php?act=list&process_type=1&is_paid=0"><?php echo $this->_var['lang']['new_reimburse']; ?></a></td>
    <td><strong><?php echo $this->_var['new_repay']; ?></strong></td>
  </tr>
</table>
</div>
<!-- end order statistics -->
<br />
<!-- start goods statistics -->
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4" class="group-title"><?php echo $this->_var['lang']['goods_stat']; ?></th>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->_var['lang']['goods_count']; ?></td>
    <td width="30%"><strong><?php echo $this->_var['goods']['total']; ?></strong></td>
    <td width="20%"><a href="goods.php?act=list&stock_warning=1"><?php echo $this->_var['lang']['warn_goods']; ?></a></td>
    <td width="30%"><strong style="color: red"><?php echo $this->_var['goods']['warn']; ?></strong></td>
  </tr>
  <tr>
    <td><a href="goods.php?act=list&amp;intro_type=is_new"><?php echo $this->_var['lang']['new_goods']; ?></a></td>
    <td><strong><?php echo $this->_var['goods']['new']; ?></strong></td>
    <td><a href="goods.php?act=list&amp;intro_type=is_best"><?php echo $this->_var['lang']['recommed_goods']; ?></a></td>
    <td><strong><?php echo $this->_var['goods']['best']; ?></strong></td>
  </tr>
  <tr>
    <td><a href="goods.php?act=list&amp;intro_type=is_hot"><?php echo $this->_var['lang']['hot_goods']; ?></a></td>
    <td><strong><?php echo $this->_var['goods']['hot']; ?></strong></td>
    <td><a href="goods.php?act=list&amp;intro_type=is_promote"><?php echo $this->_var['lang']['sales_count']; ?></a></td>
    <td><strong><?php echo $this->_var['goods']['promote']; ?></strong></td>
  </tr>
</table>
</div>
<br />

<!-- start access statistics -->
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4" class="group-title"><?php echo $this->_var['lang']['acess_stat']; ?></th>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->_var['lang']['acess_today']; ?></td>
    <td width="30%"><strong><?php echo $this->_var['today_visit']; ?></strong></td>
    <td width="20%"><?php echo $this->_var['lang']['online_users']; ?></td>
    <td width="30%"><strong><?php echo $this->_var['online_users']; ?></strong></td>
  </tr>
  <tr>
    <td><a href="user_msg.php?act=list_all"><?php echo $this->_var['lang']['new_feedback']; ?></a></td>
    <td><strong><?php echo $this->_var['feedback_number']; ?></strong></td>
    <td><a href="comment_manage.php?act=list"><?php echo $this->_var['lang']['new_comments']; ?></a></td>
    <td><strong><?php echo $this->_var['comment_number']; ?></strong></td>
  </tr>
</table>
</div>
<!-- end access statistics -->
<br />


<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js')); ?>
<script type="Text/Javascript" language="JavaScript">
<!--
onload = function()
{
  /* 检查订单 */
  startCheckOrder();
}
  

   function start_api(result)
    {
      apilist = document.getElementById("lilist").innerHTML;
      document.getElementById("lilist").innerHTML =result+apilist;
      if(document.getElementById("mar") != null)
      {
        var Mar = document.getElementById("mar");
        lis = Mar.getElementsByTagName('div');
        //alert(lis.length); //显示li元素的个数
        if(lis.length>3)
        {
          api_styel();
        }      
      }


    }
      function api_styel()
      {
        if(document.getElementById("mar") != null)
        {
            var Mar = document.getElementById("mar");
            if (Browser.isIE)
            {
              Mar.style.height = "52px";
            }
            else
            {
              Mar.style.height = "36px";
            }
            
            var child_div=Mar.getElementsByTagName("div");

        var picH = 16;//移动高度
        var scrollstep=2;//移动步幅,越大越快
        var scrolltime=30;//移动频度(毫秒)越大越慢
        var stoptime=4000;//间断时间(毫秒)
        var tmpH = 0;
        
        function start()
        {
          if(tmpH < picH)
          {
            tmpH += scrollstep;
            if(tmpH > picH )tmpH = picH ;
            Mar.scrollTop = tmpH;
            setTimeout(start,scrolltime);
          }
          else
          {
            tmpH = 0;
            Mar.appendChild(child_div[0]);
            Mar.scrollTop = 0;
            setTimeout(start,stoptime);
          }
        }
        setTimeout(start,stoptime);
        }
      }
-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
