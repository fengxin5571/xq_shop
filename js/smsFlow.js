var smsyy = document.getElementById("smsyy").value; //发送短信出发语音限制
var ztime =document.getElementById("ztime").value;//倒计时

function getverifycode1(field_id, field_name) {

  var frm  = document.forms['formUser'];
   var mobile  = Utils.trim(frm.elements['mobile'].value);
	  var smscode  = Utils.trim(frm.elements["sms_code"].value);

	if(mobile == '') {
		alert("手机号不能为空！");
		return;
	}
	
	if(!frm.elements["captcha"]){
		alert("请开启图形验证码功能(系统设置-验证码管理-勾选新用户注册-保存设置)！");
		return;	
	}	 

	var captcha = Utils.trim(frm.elements["captcha"].value);
	if(captcha!=''){
		smscode = captcha ;//取消了随机码，改为图形验证码
	}else{
		alert("验证码不能为空！");
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
	var smscode  = Utils.trim(frm.elements["sms_code"].value);
	
	
	if(mobile == '') {
		alert("手机号不能为空！");
		$("mobile").focus();
		return;
	}
	Ajax.call('sms.php?step=getverifycode2&r=' + Math.random(), 'mobile=' + mobile+'&smscode=' + smscode, getverifycode2Response, 'POST', 'JSON');
}

function getverifycode1Response(result) {
	if (result.error==0){
		smsyy--; //发送次数
		RemainTime();		
	}
	alert(result.message);
}

function getverifycode2Response(result) {
	if (result.error==0){
		
		RemainTime();		
	}
	alert(result.message);
}


var iTime = parseInt(ztime)-1;
var Account;
function RemainTime(){
	document.getElementById('zphone').disabled = true;
	var iSecond,sSecond="",sTime="";
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