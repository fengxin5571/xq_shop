$(function(){
			
			// @ 给窗口加滚动条事件
			$(window).scroll(function(){
				
				// 获得窗口滚动上去的距离
				var ling = $(document).scrollTop();
				// 在标题栏显示滚动的距离
				//document.title = ling;
				if(ling>0){
				var winH = $(window).height();
				var winW = $(window).width();
				$("#indexheadpopup").css({'top': (winH/2-$("#indexheadpopup").height()/2)+ling,'left': winW/2-$("#indexheadpopup").width()/2 });
				}
				// 如果滚动距离大于1534的时候让滚动框出来
				var left=$('.w1160px ').offset().left-($('#box').width()+10);
				$('#box').css('left',left);
				if(ling>982){
					$('#box').show();
					
				}
				if(982<ling && ling<1662){
					// 让第一层的数字隐藏，文字显示，让其他兄弟元素的li数字显示，文字隐藏
					$('#box ul li').eq(0).find('.num').hide().siblings('.word').css('display','block');
					$('#box ul li').eq(0).siblings('li').find('.num').css('display','block').siblings('.word').hide();
				}else if(ling<2335){
					$('#box ul li').eq(1).find('.num').hide().siblings('.word').css('display','block');
					$('#box ul li').eq(1).siblings('li').find('.num').css('display','block').siblings('.word').hide();
				}else if(ling<3595){
					$('#box ul li').eq(2).find('.num').hide().siblings('.word').css('display','block');
					$('#box ul li').eq(2).siblings('li').find('.num').css('display','block').siblings('.word').hide();
				}
				if(ling>8800 || ling<982){
					// $('#box').css('display','none');  // @ 这一句和下一句效果一样。
					$('#box').hide();
				}
				
			})

		})
        $(function(){
        	$('#box ul li').last().attr('class','last');
        })
		$(function(){
			$('#box ul li').hover(function(){
				$(this).find('.num').hide().siblings('.word').css({'display':'block','background':'#0374D9','color':'white'});
			},function(){
			
				$(this).find('.num').css({'display':'block','background':'#918888','color':'#fefefe'}).siblings('.word').hide().css({'display':'none','background':'','color':''});
			})
		})