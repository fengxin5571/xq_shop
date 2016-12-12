$(document).ready(function () {
    $("#susong").click(function(){
      $("#susong_form").slideDown();
      $('html,body').animate({scrollTop:$('#susong_form').offset().top}, 800);
    });
});

function submitMsg()
{
  var frm         = document.forms['formMsg'];
  var user_name   = frm.elements['user_name'].value;
  var user_phone   = frm.elements['user_phone'].value;
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

  if (msg_content.length == 0)
  {
    msg += '备注为空\n'
  }

  if (msg_content.length > 500)
  {
    msg += '备注长度超过500\n';
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


function addTalent(talentId)
{
  Ajax.call('talent_show.php?act=addTalent', 'id=' + talentId, addTalentResponse, 'GET', 'JSON');
}

function addTalentResponse(result)
{
  alert(result.message);
}