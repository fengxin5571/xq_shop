
var smsyy = document.getElementById("smsyy").value; //发送短信出发语音限制
var ztime =document.getElementById("ztime").value;//倒计时

function getverifycode1(field_id, field_name) {

  var frm  = document.forms['formUser'];
  var username  = Utils.trim(frm.elements['username'].value);
  var email  = frm.elements['email'].value;
  var password  = Utils.trim(frm.elements['password'].value);
  var confirm_password = Utils.trim(frm.elements['confirm_password'].value);
  var checked_agreement = frm.elements['agreement'].checked;
  var msn = frm.elements['extend_field1'] ? Utils.trim(frm.elements['extend_field1'].value) : '';
  var qq = frm.elements['extend_field2'] ? Utils.trim(frm.elements['extend_field2'].value) : '';
  var home_phone = frm.elements['extend_field4'] ? Utils.trim(frm.elements['extend_field4'].value) : '';
  var office_phone = frm.elements['extend_field3'] ? Utils.trim(frm.elements['extend_field3'].value) : '';
  var mobile_phone = frm.elements['extend_field5'] ? Utils.trim(frm.elements['extend_field5'].value) : '';
  var passwd_answer = frm.elements['passwd_answer'] ? Utils.trim(frm.elements['passwd_answer'].value) : '';
  var sel_question =  frm.elements['sel_question'] ? Utils.trim(frm.elements['sel_question'].value) : '';
  var captcha = Utils.trim(frm.elements["captcha"].value);
	  var msg = "";
	  // 检查输入
	  var msg = '';
	  if (username.length == 0)
	  {
		msg += username_empty + '\n';
	  }
	  else if (username.match(/^\s*$|^c:\\con\\con$|[%,\'\*\"\s\t\<\>\&\\]/))
	  {
		msg += username_invalid + '\n';
	  }
	  else if (username.length < 3)
	  {
		//msg += username_shorter + '\n';
	  }
	  if (email.length == 0)
	  {
		msg += email_empty + '\n';
	  }
	  else
	  {
		if ( ! (Utils.isEmail(email)))
		{
		  msg += email_invalid + '\n';
		}
	  }
	  if (password.length == 0)
	  {
		msg += password_empty + '\n';
	  }
	  else if (password.length < 6)
	  {
		msg += password_shorter + '\n';
	  }
	  if (/ /.test(password) == true)
	  {
		msg += passwd_balnk + '\n';
	  }
	  if (confirm_password != password )
	  {
		msg += confirm_password_invalid + '\n';
	  }
	  if(checked_agreement != true)
	  {
		msg += agreement + '\n';
	  }
	  if (msn.length > 0 && (!Utils.isEmail(msn)))
	  {
		msg += msn_invalid + '\n';
	  }
	  if (qq.length > 0 && (!Utils.isNumber(qq)))
	  {
		msg += qq_invalid + '\n';
	  }
	  if (office_phone.length>0)
	  {
		var reg = /^[\d|\-|\s]+$/;
		if (!reg.test(office_phone))
		{
		  msg += office_phone_invalid + '\n';
		}
	  }
	  if (home_phone.length>0)
	  {
		var reg = /^[\d|\-|\s]+$/;

		if (!reg.test(home_phone))
		{
		  msg += home_phone_invalid + '\n';
		}
	  }
	  if (mobile_phone.length>0)
	  {
		var reg = /^[\d|\-|\s]+$/;
		if (!reg.test(mobile_phone))
		{
		  msg += mobile_phone_invalid + '\n';
		}
	  }
	  if (passwd_answer.length > 0 && sel_question == 0 || document.getElementById('passwd_quesetion') && passwd_answer.length == 0)
	  {
		msg += no_select_question + '\n';
	  }
      if(captcha.length == 0){
    	  msg+="- 验证码不能为空！";
      }
	  for (i = 4; i < frm.elements.length - 4; i++)	// 从第五项开始循环检查是否为必填项
	  {
		needinput = document.getElementById(frm.elements[i].name + 'i') ? document.getElementById(frm.elements[i].name + 'i') : '';

		if (needinput != '' && frm.elements[i].value.length == 0)
		{
		  msg += '- ' + needinput.innerHTML + msg_blank + '\n';
		}
	  }

	  if (msg.length > 0)
	  {
		jAlert(msg,null,"馨清网");
		return false;
	  }

	  var mobile  = Utils.trim(frm.elements[field_id].value);
	  var smscode  = Utils.trim(frm.elements["sms_code"].value);

	if(mobile == '') {
		//alert("- "+field_name+" 不能为空！");
		jAlert("- "+field_name+" 不能为空！",null,"馨清网");
		$(field_id).focus();
		return;
	}
	
	if(!frm.elements["captcha"]){
		alert("请开启图形验证码功能(系统设置-验证码管理-勾选新用户注册-保存设置)！");
		return;	
	}	 

	
	if(captcha!=''){
		smscode = captcha ;//取消了随机码，改为图形验证码
	}else{
		//alert("验证码不能为空！");
		jAlert("验证码不能为空！",null,"馨清网");
		return;	
	}
	
	
	if(smsyy==-1 || parseInt(smsyy)>0){
	
		Ajax.call('sms.php?step=getverifycode1&r=' + Math.random(), 'mobile=' + mobile+'&smscode=' + smscode, getverifycode1Response, 'POST', 'JSON');
	
	}else if(parseInt(smsyy)==0){
	
		Ajax.call('sms.php?step=getverifycode2&r=' + Math.random(), 'mobile=' + mobile+'&smscode=' + smscode, getverifycode2Response, 'POST', 'JSON');
			
	}
	
	

}


function getverifycode2() {
	var frm  = document.forms['formBindmobile'];
	var mobile  = Utils.trim(frm.elements["mobile"].value);
	var smscode  = Utils.trim(frm.elements["smscode"].value);
	
	if(mobile == '') {
		alert("手机号不能为空！");
		$("mobile").focus();
		return;
	}
	Ajax.call('sms.php?step=getverifycode3&r=' + Math.random(), 'mobile=' + mobile+'&smscode=' + smscode, getverifycode2Response, 'POST', 'JSON');
}

function getverifycode1Response(result) {
	if (result.error==0){
		smsyy--; //发送次数
		
		RemainTime();		
	}
	//alert(result.message);
	jAlert(result.message,null,"馨清网");
}

function getverifycode2Response(result) {
	if (result.error==0){
		smsyy--; //发送次数
		RemainTime();		
	}
	//alert(result.message);
	jAlert(result.message,null,"馨清网");
}

var iTime = parseInt(ztime)-1;

var Account;
function RemainTime(){
	document.getElementById('zphone').disabled = true;
	var iSecond,sTime="";
	if (iTime >= 0){
		iSecond = parseInt(iTime%60);
		iMinute = parseInt(iTime/60)
		if (iSecond >= 0){
			if(iMinute>0){
				sSecond = iMinute + "分" + iSecond + "秒";
			}else{
				sSecond = iSecond + "秒";
			}
		}
		sTime=sSecond;
		if(iTime==0){
			clearTimeout(Account);
			if(smsyy==-1 || parseInt(smsyy)>0){
				sTime ="获取短信验证码";
			}else{
				sTime ="获取语音验证码";
			}
		
			
			iTime = parseInt(ztime)-1;
			document.getElementById('zphone').disabled = false;
		}else{
			Account = setTimeout("RemainTime()",1000);
			iTime=iTime-1;
		}
	}else{
		sTime='没有倒计时';
	}
	document.getElementById('zphone').value = sTime;
}