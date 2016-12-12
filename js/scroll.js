//<!--
// 附带函数
var
// 用ID获取元素
$ = function(element) {
 return typeof(element) == 'object' ? element : document.getElementById(element);
},
// 生成随机数
RandStr = function(n, u){
 var tmStr = "abcdefghijklmnopqrstuvwxyz0123456789";
 var Len = tmStr.length;
 var Str = "";
 for(i=1;i<n+1;i++){
  Str += tmStr.charAt(Math.random()*Len);
 }
 return (u ? Str.toUpperCase() : Str);
};
//-->



//<!--
/*******************************************
 - Marquee 替代 -- 无间滚动
********************************************
 new Marquee({
  obj   : 'myMarquee',  // 滚动对象（必须）
  name  : 'MyMQ_1',   // 实例名（可选，不指定则随机）
  mode  : 'x',    // 滚动模式（可选，x=水平, y=垂直，默认x）
  speed  : 10,    // 滚动速度（可选，越小速度越快，默认10）
  autoStart  : true,    // 自动开始（可选，默认True）
  movePause : true    // 鼠标经过是否暂停（可选，默认True）
 });
********************************************/
var MyMarquees = new Array();
// 获取检测实例名
function getMyMQName(mName) {
 var name = mName==undefined ? RandStr(5) : mName;
 var myNames = ','+ MyMarquees.join(',') +',';
 
 while(myNames.indexOf(','+ name +',')!=-1) {
  name = RandStr(5);
 }
 return name;
}
function Marquee(inits) {
 var _o = this;
 var _i = inits;
 
 if(_i.obj==undefined) return;
 _o.mode    = _i.mode==undefined ? 'x' : _i.mode;   // 滚动模式(x:横向, y:纵向)
 _o.mName = getMyMQName(_i.name);       // 实例名
 _o.mObj  = $(_i.obj);         // 滚动对象
 _o.speed = _i.speed==undefined ? 30 : _i.speed;   // 滚动速度
 _o.autoStart= _i.autoStart==undefined ? true : _i.autoStart;// 自动开始
 _o.movePause= _i.movePause==undefined ? true : _i.movePause;// 鼠标经过是否暂停
 
 _o.mDo  = null;           // 计时器
 _o.pause = false;          // 暂停状态
 
 // 无间滚动初始化
 _o.init = function() {
  if((_o.mObj.scrollWidth<=_o.mObj.offsetWidth && _o.mode=='x') && (_o.mObj.scrollHeight<=_o.mObj.offsetHeight && _o.mode=='y')) return;
  
  MyMarquees.push(_o.mName);
  
  // 克隆滚动内容
  _o.mObj.innerHTML = _o.mode=='x' ? (
   '<table width="100%" border="0" align="left" cellpadding="0" cellspace="0">'+
   ' <tr>'+
   '  <td id="MYMQ_'+ _o.mName +'_1">'+ _o.mObj.innerHTML +'</td>'+
   '  <td id="MYMQ_'+ _o.mName +'_2">'+ _o.mObj.innerHTML +'</td>'+
   ' </tr>'+
   '</table>'
  ) : (
   '<div id="MYMQ_'+ _o.mName +'_1">'+ _o.mObj.innerHTML +'</div>'+
   '<div id="MYMQ_'+ _o.mName +'_2">'+ _o.mObj.innerHTML +'</div>'
  );
  
  // 获取对象、高宽
  _o.mObj1 = $('MYMQ_'+ _o.mName +'_1');
  _o.mObj2 = $('MYMQ_'+ _o.mName +'_2');
  _o.mo1Width = _o.mObj1.scrollWidth;
  _o.mo1Height = _o.mObj1.scrollHeight;
  
  // 初始滚动
  if(_o.autoStart) _o.start();
 };
  
 // 开始滚动
 _o.start = function() {
  _o.mDo = setInterval((_o.mode=='x' ? _o.moveX : _o.moveY), _o.speed);
  if(_o.movePause) {
   _o.mObj.onmouseover = function() {_o.pause = true;} 
   _o.mObj.onmouseout = function() {_o.pause = false;}
  }
 }
 
 // 停止滚动
 _o.stop = function() {
  clearInterval(_o.mDo)
  _o.mObj.onmouseover = function() {} 
  _o.mObj.onmouseout = function() {}
 }
 
 // 水平滚动
 _o.moveX = function() {
  if(_o.pause) return;
  var left = _o.mObj.scrollLeft;
  if(left==_o.mo1Width){ 
   _o.mObj.scrollLeft = 0 ;
  }else if(left>_o.mo1Width) {
   _o.mObj.scrollLeft = left-_o.mo1Width;
  }else{ 
   _o.mObj.scrollLeft++;
  }
 };
 
 // 垂直滚动
 _o.moveY = function() {
  if(_o.pause) return;
  var top = _o.mObj.scrollTop;
  if(top==_o.mo1Height){ 
   _o.mObj.scrollTop = 0 ;
  }else if(top>_o.mo1Height) {
   _o.mObj.scrollTop = top-_o.mo1Height;
  }else{ 
   _o.mObj.scrollTop++;
  }
 };
 
 _o.init();
}
//-->