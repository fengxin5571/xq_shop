/* *
 * 对会员的留言输入作处理
 */
function submitMsg()
{
  var frm         = document.forms['formMsg'];
  var user_name   = frm.elements['user_name'].value;
  var user_phone   = frm.elements['user_phone'].value;
  var msg_title = frm.elements['msg_title'].value;
  var msg_content = frm.elements['msg_content'].value;
  var msg = '';

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
    msg += '需求标题为空\n'
  }
  if (msg_content.length == 0)
  {
    msg += '需求说明为空\n'
  }

  if (msg_content.length > 500)
  {
    msg += '需求说明长度超过500\n';
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

