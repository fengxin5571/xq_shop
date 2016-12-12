/* $Id: compare.js 15469 2008-12-19 06:34:44Z testyang $ */
var Compare = new Object();

Compare = {
  add : function(goodsId, goodsName,goodsImg, type,goodsSprice)
  {
    var count = 0;
    for (var k in this.data)
    {
      if (typeof(this.data[k]) == "function")
      continue;
      if (this.data[k].t != type) {
        alert(goods_type_different.replace("%s", goodsName));
        return;
      }
      count++;
      
    }
    if(count>3)
    {
    	alert("对比栏已满，您可以删除不需要的栏内商品再继续添加哦！");
        return;
    }
    if (this.data[goodsId])
    {
      alert(exist.replace("%s",goodsName));
      return;
    }
    else
    {
      this.data[goodsId] = {n:goodsName,t:type,i:goodsImg,s:goodsSprice};
    }
    
    this.save();
    this.init();
  },
  relocation : function()
  {
    if (this.compareBox.style.display != "") return;
    var diffY = Math.max(document.documentElement.scrollTop,document.body.scrollTop);
    var percent = .2*(diffY - this.lastScrollY);
    if(percent > 0)
      percent = Math.ceil(percent);
    else
      percent = Math.floor(percent);
    this.compareBox.style.top = parseInt(this.compareBox.style.top)+ percent + "px";
    
    this.lastScrollY = this.lastScrollY + percent;
  },
  init : function(){
    this.data = new Object();
    var cookieValue = document.getCookie("compareItems");
    if (cookieValue != null) {
     // this.data = cookieValue.parseJSON();
    	this.data=JSON.parse(cookieValue) ;
    }
    if (!this.compareBox)
    {
      this.compareBox = document.createElement("DIV");
      var submitBtn = document.createElement("INPUT");
      this.compareList = document.createElement("UL");
      this.compareBox.id = "compareBox";
      this.compareBox.style.display = "none";
      this.compareBox.style.top = "200px";
      this.compareBox.align = "center";
      this.compareList.id = "compareList";
      submitBtn.type = "button";
      submitBtn.value = "对比";
	  this.compareBox.appendChild(this.compareList);
      this.compareBox.appendChild(submitBtn);
      submitBtn.onclick = function() {
        var cookieValue = document.getCookie("compareItems");
        var obj = JSON.parse(cookieValue);
        var url = document.location.href;
        url = url.substring(0,url.lastIndexOf('/')+1) + "compare.php";
        var i = 0;
        for(var k in obj)
        {
          if(typeof(obj[k])=="function")
          continue;
          if(i==0)
            url += "?goods[]=" + k;
          else
            url += "&goods[]=" + k;
          i++;
        }
        if(i<2)
        {
          alert(compare_no_goods);
          return ;
        }
        document.location.href = url;
      }
      document.body.appendChild(this.compareBox);
    }
    this.compareList.innerHTML = "";
    var self = this;
    for (var key in this.data)
    {
      if(typeof(this.data[key]) == "function")
        continue;
      var li = document.createElement("LI");
      var span = document.createElement("SPAN");
      span.style.overflow = "hidden";
      span.style.width = "100px";
      span.style.height = "20px";
      span.style.display = "block";
      span.innerHTML = this.data[key].n;
      li.appendChild(span);
      var Sspan=document.createElement("SPAN");
      Sspan.style.width = "100px";
      Sspan.style.height = "20px";
      Sspan.style.display = "block";
      Sspan.style.color="#e4393c";
      Sspan.innerHTML = this.data[key].s;
      li.appendChild(Sspan);
      li.style.listStyle = "none";
      var goodImg=document.createElement("IMG");
      goodImg.src=this.data[key].i;
      goodImg.width=50;
      var delBtn = document.createElement("IMG");
      delBtn.src = "themes/default/images/drop.gif";
      delBtn.className = key;
      delBtn.onclick = function(){
        document.getElementById("compareList").removeChild(this.parentNode);
        delete self.data[this.className];
        self.save();
        self.init();
      }
      li.insertBefore(goodImg,li.childNodes[0]);
      li.insertBefore(delBtn,li.childNodes[0]);
      this.compareList.appendChild(li);
    }
    if (this.compareList.childNodes.length > 0)
    {
      this.compareBox.style.display = "";
      this.timer = window.setInterval(this.relocation.bind(this), 50);
    }
    else
    {
      this.compareBox.style.display = "none";
      window.clearInterval(this.timer);
      this.timer = 0;
    }
  },
  save : function()
  {
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie("compareItems", objToJSONString(this.data));
  },
  lastScrollY : 0
}