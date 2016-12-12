$(document).ready(function(){
    /* 购物车展开收起 */
    $(".settle").mouseover(function(){
        $(".settledown").show();
        $(".settle").css('border-bottom','none');
    });

    $(".settle").mouseout(function(){
        $(".settledown").hide();
        $(".settle").css('border-bottom','1px solid #d3d3d3');
    });

    /* nav */
    $(".navitems li").mouseover(function(){
        $(this).find('.nav-hover').show();
    })
 
    $(".navitems li").mouseout(function(){
        $(this).find('.nav-hover').hide();
    })

    /* category list */
    $(".catelist li").mouseover(function(){
        $(this).find('.catebox').show();
    })
 
    $(".catelist li").mouseout(function(){
        $(this).find('.catebox').hide();
    })
    
    /*分类*/
	var mgCate=$(".mg-cate");
	if(mgCate.length!=0){
		mgCate.hide();
		$(".category").mouseover(function(){
			mgCate.show();
			cateCss="";
			$(".category .cate-ico").attr('id','cate-ico-hover');
			$(".category .cateup").removeClass('cateDown');
			$(".category").attr('id','cate-bg');
		})
		$(".catelist").mouseout(function(){
			mgCate.hide();
			$(".category .cate-ico").attr('id','cate-ico');
			$(".category .cateup").addClass('cateDown');
			$(".category").attr('id','cate-bg-mg');
		})
		
		$(".category").attr('id','cate-bg-mg');
		$(".category .cate-ico").attr('id','cate-ico');
		$(".category .cateup").addClass('cateDown');
	}
	
    /*列表*/
    var mgItems=$(".mg-items li");
    var mgSp=$("#splist");
    mgItems.bind("click",function(){
        $(this).addClass("listhover").siblings().removeClass("listhover");
        if($(this).attr("class")=="mg-blockcon listhover"){
            mgSp.attr("class","mg-splist");
        }else {
            mgSp.attr("class","mg-splist2");
        }
    })
	
	/*商品信息*/
	var spHd=$(".mg-pro-hd li")
	var spShow=$(".mg-pro-bd .mg-info");
	spHd.click(function(){
		var index=spHd.index($(this));
		$(this).addClass("hover").siblings().removeClass("hover");
		spShow.eq(index).show().siblings().hide();
	});
	
	$(".mg-color a").click(function(){
		$(this).addClass("hover").siblings().removeClass("hover");
	})
	var mgInput=$(".mg-number input");
	var mgNum=mgInput.val();
	
	mgInput.blur(function(){
		mgNum=mgInput.val();
	});
	$(".mg-number .plus").click(function(){
		mgNum=Math.floor(mgNum)+1;
		mgInput[0].value=mgNum;
	});
	$(".mg-number .cuts").click(function(){
		if(mgNum>0){
			mgNum=Math.floor(mgNum)-1;
			mgInput[0].value=mgNum;
		}else{
			return;
		}
	});
	
	/*套餐宽度*/
	var chWidth=$(".mg-chall .master2").length*150;
	$(".mg-chall").css("width",chWidth+"px");
	var chall=parseInt(chWidth);
	var cccuts=150*5-chall;
	
	$(".ch-right").click(scllorLeft);

	function scllorLeft(){
		var chLeft=$(".mg-chall").css("left");
		chLeft=parseInt(chLeft);
		if(chLeft>=cccuts){
			$(".mg-chall").animate({
				left:"-=150"
			});
			var chLeft=$(".mg-chall").css("left");
			chLeft=parseInt(chLeft);
		}
	}
	
	/*套餐计算*/
	
	var price2=$(".mg-p-price2 input");
	function pricePlus(){
		var priceU1=$(".mg-p-price input").attr("data-mp");
		var priceP1=$(".mg-p-price input").attr("data-mp")-$(".mg-p-price input").attr("data-jp");
		var priceU2=0;
		var priceP2=0;
		var chNum=0;
		for(var i=0;i<price2.length;i++){
			if(price2.eq(i).attr("checked")=="checked"){
				price2.eq(i).parent().addClass("check-true");
				priceU2=priceU2-(-price2.eq(i).attr("data-mp"));
				priceP2=priceP2-(-(price2.eq(i).attr("data-mp")-price2.eq(i).attr("data-jp")));
				chNum++;
			}
		}
		$(".mg-tc-num span").text(chNum);
		var pr1=(priceU1-(-priceU2)).toFixed(2);
		var pr2=(priceP1-(-priceP2)).toFixed(2);
		
		$(".mg-tc-price span").text(pr1);
		$(".mg-tc-price2 span").text(pr2);
	}
	pricePlus();
	price2.parent().click(function(){
		if($(this).children().attr("checked")=="checked"){
			$(this).children().removeAttr("checked");
			$(this).removeClass("check-true");
			pricePlus();
		}else{
			$(this).children().attr("checked","checked");
			$(this).addClass("check-true");
			pricePlus();
		}
	});
});