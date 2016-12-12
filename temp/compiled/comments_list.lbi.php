
    <div class="mg-review">
            <?php if ($this->_var['comments']): ?>
                <table>
                  <tr>
                    <th class="mg-th1">评价时间</th>
                    <th class="mg-th2">评价内容</th>
                    <th class="mg-th3">评价等级</th>
                    <th class="mg-th4">用户名</th>
                  </tr>
                  <?php $_from = $this->_var['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
                  <tr>
                    <td class="text-center"><?php echo $this->_var['comment']['add_time']; ?></td>
                    <td>
                      <p><?php echo $this->_var['comment']['content']; ?></p>
                    </td>
                    <td class="text-center"><img src="themes/default/images/stars<?php echo $this->_var['comment']['rank']; ?>.gif" alt="<?php echo $this->_var['comment']['comment_rank']; ?>" /></td>
                    <td class="text-center"><?php if ($this->_var['comment']['username']): ?><?php echo htmlspecialchars($this->_var['comment']['username']); ?><?php else: ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?></td>
                  </tr>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </table>

                

                <form name="selectPageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <?php if ($this->_var['pager']['styleid'] == 0): ?>
                <div id="pager">
                  <div class="mg-page2 mt20 text-center clearfix">
                      <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span> <a href="<?php echo $this->_var['pager']['page_first']; ?>"><?php echo $this->_var['lang']['page_first']; ?></a> <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a> <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> </span>
                        <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_23568200_1481515010');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_23568200_1481515010']):
?>
                          <?php if ($this->_var['key'] == 'keywords'): ?>
                              <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item_0_23568200_1481515010']); ?>" />
                            <?php else: ?>
                              <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_23568200_1481515010']; ?>" />
                          <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                        <select name="page" id="page" onchange="selectPage(this)">
                        <?php echo $this->html_options(array('options'=>$this->_var['pager']['array'],'selected'=>$this->_var['pager']['page'])); ?>
                        </select>
                    </div>
                </div>
            
                <?php else: ?>

                <div class="mg-page mt20 text-right clearfix" id="pager">

                  <ul class="clearfix">
                    <li style="margin-right:10px;"><?php echo $this->_var['lang']['total']; ?><b><?php echo $this->_var['pager']['record_count']; ?></b> <?php echo $this->_var['lang']['user_comment_num']; ?></li>
                    <?php if ($this->_var['pager']['page_prev']): ?>
                      <li class="a1"><a href="<?php echo $this->_var['pager']['page_prev']; ?>">< <?php echo $this->_var['lang']['page_prev']; ?></a></li>
                    <?php endif; ?>
                    <?php if ($this->_var['pager']['page_count'] != 1): ?>
                      <?php $_from = $this->_var['pager']['page_number']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_23644100_1481515010');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_23644100_1481515010']):
?>
                        <?php if ($this->_var['pager']['page'] == $this->_var['key']): ?>
                        <li><span><?php echo $this->_var['key']; ?></span></li>
                        <?php else: ?>
                        <li><a href="<?php echo $this->_var['item_0_23644100_1481515010']; ?>"><?php echo $this->_var['key']; ?></a></li>
                        <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php endif; ?>
                      
                    <?php if ($this->_var['pager']['page_next']): ?>
                        <li><a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?> ></a></li>
                    <?php endif; ?>  

                    <?php if ($this->_var['pager']['page_kbd']): ?>
                      <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_23696000_1481515010');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_23696000_1481515010']):
?>
                        <?php if ($this->_var['key'] == 'keywords'): ?>
                            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo urldecode($this->_var['item_0_23696000_1481515010']); ?>" />
                          <?php else: ?>
                            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_23696000_1481515010']; ?>" />
                        <?php endif; ?>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                      <li class="last">到第<input type="text" name="page" >页<button name="mg-btn" onclick="selectPage(this)">确定</button></li>
                    <?php endif; ?>
                  </ul>
                </div>

              <?php endif; ?>
              </form>
              
            <?php else: ?>
                <li><?php echo $this->_var['lang']['no_comments']; ?></li>
            <?php endif; ?>
            
          </div>

<script type="Text/Javascript" language="JavaScript">
<!--

function selectPage(sel)
{
  sel.form.submit();
}

//-->
</script>



<div class="comments mt20">
   <form action="javascript:;" onsubmit="submitComment(this)" method="post" name="commentForm" id="commentForm">
    <table  cellspacing="5" cellpadding="0" border="0">
      <tr>
        <td width="88" align="right"><?php echo $this->_var['lang']['username']; ?>：</td>
        <td width="745"><?php if ($_SESSION['user_name']): ?><?php echo $_SESSION['user_name']; ?><?php else: ?><?php echo $this->_var['lang']['anonymous']; ?><?php endif; ?></td>
      </tr>
          <tr>
      <td align="right">E-mail：</td>
        <td>
        <input type="text" name="email" id="email"  maxlength="100" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" class="inputBorder"/>
        </td>
      </tr>
      <tr>
        <td align="right"><?php echo $this->_var['lang']['comment_rank']; ?>：</td>
        <td>
          <input name="comment_rank" type="radio" value="1" id="comment_rank1" /> <img src="themes/default/images/stars1.gif" />
          <input name="comment_rank" type="radio" value="2" id="comment_rank2" /> <img src="themes/default/images/stars2.gif" />
          <input name="comment_rank" type="radio" value="3" id="comment_rank3" /> <img src="themes/default/images/stars3.gif" />
          <input name="comment_rank" type="radio" value="4" id="comment_rank4" /> <img src="themes/default/images/stars4.gif" />
          <input name="comment_rank" type="radio" value="5" checked="checked" id="comment_rank5" /> <img src="themes/default/images/stars5.gif" />
        </td>
      </tr>
      <tr>
        <td align="right"><?php echo $this->_var['lang']['comment_content']; ?>：</td>
        <td>
        <textarea style="height:80px; width:800px;" class="inputBorder" name="content"></textarea>
        <input type="hidden" name="cmt_type" value="<?php echo $this->_var['comment_type']; ?>" />
        <input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
        </td>
      </tr>

      <?php if ($this->_var['enabled_captcha']): ?>
          <tr>
            <td align="right">
            <?php echo $this->_var['lang']['comment_captcha']; ?>：
            </td>
            <td>
            <input type="text" style="width:50px; margin-left:5px;" class="inputBorder" name="captcha">
            <img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" onClick="this.src='captcha.php?'+Math.random()" class="captcha hand">
            <input type="submit" class="btn-sub fr hand" value="" name="">
            </td>
          </tr>
     <?php endif; ?>
    </table>
    </form>
</div>



<script type="text/javascript">
//<![CDATA[
<?php $_from = $this->_var['lang']['cmt_lang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_23788400_1481515010');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_23788400_1481515010']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item_0_23788400_1481515010']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

/**
 * 提交评论信息
*/
function submitComment(frm)
{
  var cmt = new Object;

  //cmt.username        = frm.elements['username'].value;
  cmt.email           = frm.elements['email'].value;
  cmt.content         = frm.elements['content'].value;
  cmt.type            = frm.elements['cmt_type'].value;
  cmt.id              = frm.elements['id'].value;
  cmt.enabled_captcha = frm.elements['enabled_captcha'] ? frm.elements['enabled_captcha'].value : '0';
  cmt.captcha         = frm.elements['captcha'] ? frm.elements['captcha'].value : '';
  cmt.rank            = 0;

  for (i = 0; i < frm.elements['comment_rank'].length; i++)
  {
    if (frm.elements['comment_rank'][i].checked)
    {
       cmt.rank = frm.elements['comment_rank'][i].value;
     }
  }

//  if (cmt.username.length == 0)
//  {
//     alert(cmt_empty_username);
//     return false;
//  }

  if (cmt.email.length > 0)
  {
     if (!(Utils.isEmail(cmt.email)))
     {
        alert(cmt_error_email);
        return false;
      }
   }
   else
   {
        alert(cmt_empty_email);
        return false;
   }

   if (cmt.content.length == 0)
   {
      alert(cmt_empty_content);
      return false;
   }

   if (cmt.enabled_captcha > 0 && cmt.captcha.length == 0 )
   {
      alert(captcha_not_null);
      return false;
   }

   Ajax.call('comment.php', 'cmt=' + objToJSONString(cmt), commentResponse, 'POST', 'JSON');
   return false;
}

/**
 * 处理提交评论的反馈信息
*/
  function commentResponse(result)
  {
    if (result.message)
    {
      alert(result.message);
    }

    if (result.error == 0)
    {
      var layer = document.getElementById('commnet_tab');

      if (layer)
      {
        layer.innerHTML = result.content;
      }
    }
  }

//]]>
</script>