/* *
 * 对会员的留言输入作处理
 */
function submitMsg()
{
  var frm         = document.forms['formMsg'];
  var user_name   = frm.elements['user_name'].value;
  var user_phone   = frm.elements['user_phone'].value;
  var guzhang   = frm.elements['guzhang'].value;
  var goods_id   = frm.elements['goods_id'].value;
  var msg_title = frm.elements['msg_title'].value;
  var msg_content = frm.elements['msg_content'].value;
  var msg = '';

  if (goods_id.length == 0)
  {
    msg += '产品为空\n';
  }
  if (guzhang.length == 0)
  {
    msg += '类型为空\n';
  }
  if (user_name.length == 0)
  {
    msg += '姓名为空\n';
  }
  if (user_phone.length == 0)
  {
    msg +=  '手机为空\n';
  }
  if (msg_title.length == 0)
  {
    msg += '标题为空\n'
  }
  if (msg_content.length == 0)
  {
    msg += '描述为空\n'
  }

  if (msg_content.length > 500)
  {
    msg += '描述长度超过500\n';
  }

  if (msg.length > 0)
  {
    alert(msg);
    return false;
  }
  else
  {
    return true;
  }
}

