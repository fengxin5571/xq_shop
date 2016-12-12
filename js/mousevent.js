jQuery(document).ready(function(){
    /* 购物车展开收起 */
	jQuery(".settle").mouseover(function(){
		jQuery(".settledown").show();
		jQuery(".settle").css('border-bottom','none');
    });

	jQuery(".settle").mouseout(function(){
		jQuery(".settledown").hide();
		jQuery(".settle").css('border-bottom','1px solid #d3d3d3');
    });

    /* nav */
    jQuery(".navitems li").mouseover(function(){
    	jQuery(this).find('.nav-hover').show();
    })
 
    jQuery(".navitems li").mouseout(function(){
    	jQuery(this).find('.nav-hover').hide();
    })

    /* category list */
    jQuery(".catelist li").mouseover(function(){
    	jQuery(this).find('.catebox').show();
    })
 
    jQuery(".catelist li").mouseout(function(){
    	jQuery(this).find('.catebox').hide();
    })
    
    /*分类*/
	var mgCate=jQuery(".mg-cate");
	if(mgCate.length!=0){
		mgCate.hide();
		jQuery(".category").mouseenter(function(){
			mgCate.show();
			cateCss="";
			jQuery(".category .cate-ico").attr('id','cate-ico-hover');
			jQuery(".category .cateup").removeClass('cateDown');
			jQuery(".category").attr('id','cate-bg');
		})
		jQuery(".catelist").mouseleave(function(){
			mgCate.hide();
			jQuery(".category .cate-ico").attr('id','cate-ico');
			jQuery(".category .cateup").addClass('cateDown');
			jQuery(".category").attr('id','cate-bg-mg');
		})
		
		jQuery(".category").attr('id','cate-bg-mg');
		jQuery(".category .cate-ico").attr('id','cate-ico');
		jQuery(".category .cateup").addClass('cateDown');
	}
	
    /*列表*/
    var mgItems=jQuery(".mg-items li");
    var mgSp=jQuery("#splist");
    mgItems.bind("click",function(){
    	jQuery(this).addClass("listhover").siblings().removeClass("listhover");
        if($(this).attr("class")=="mg-blockcon listhover"){
            mgSp.attr("class","mg-splist");
        }else {
            mgSp.attr("class","mg-splist2");
        }
    })
    /*属性筛选*/
    jQuery('.sm-wrap').click(function(){
    	if(jQuery('.s-more-line').css('display')=='none'){
    		jQuery('.s-more').css('display','none');
    		jQuery('.s-more-line').css("display",'block');
    		jQuery('.s-more-open').css("display",'block');
    	}
    });
    jQuery('.sm-wrap-open').click(function(){
    	if(jQuery('.s-more-line').css('display')=='block'){
    		jQuery('.s-more').css('display','block');
    		jQuery('.s-more-line').css("display",'none');
    		jQuery('.s-more-open').css("display",'none');
    	}
    });
    /* 分类页面包屑*/
    jQuery('.cpage:last').mouseover(function(){
    	jQuery('.menu-drop-main').show();
    	jQuery('.menu-drop-main').css('left',$(this).offset().left);
    	
    });
    jQuery('.menu-drop-main').mouseleave(function(){
    	jQuery('.menu-drop-main').hide();
    });	
    /*更多参数*/
    jQuery(".J-more-param").click(function(){
    	jQuery("li[data-id=desc_tab]").attr("class","tabmenu");
    	jQuery("li[data-id=attr_tab]").attr("class","tabmenu hover");
    	jQuery("#desc_tab").hide();
    	jQuery("#attr_tab").show();
    });
  
    /* 绑定页面*/
    jQuery('#bindtab').on('click',function(){
    	jQuery(this).addClass('r-tab-cur');
    	jQuery('#registertab').removeClass('r-tab-cur');
    	jQuery('.bind-login-content').show();
    	jQuery('.reg-form').hide();
    });
    jQuery('#registertab').on('click',function(){
    	jQuery(this).addClass('r-tab-cur');
    	jQuery('#bindtab').removeClass('r-tab-cur');
    	jQuery('.reg-form').show();
    	jQuery('.bind-login-content').hide();
    });
    //注册
	if(jQuery('#username').val() !=''){
		jQuery('#usernametxt').hide();
	}
    if(jQuery('#email').val() !=''){
		jQuery('#emailtxt').hide();
	}
    if(jQuery('input[name=extend_field5]').val() !=''){
		jQuery('#moblie_phonetxt').hide();
	}
    if(jQuery('#sms_verifycode').val() !=''){
		jQuery('#moblie_phonecodetxt').hide();
	}
    if(jQuery('input[name=captcha]').val() !=''){
		jQuery('#captchatxt').hide();
	}
    if(jQuery('#usernamebind').val() !=''){
		jQuery('#usernametxtbind').hide();
	}
    /*红包*/
    $(".red").click(function(){
    $(this).addClass("shake");
    setTimeout(function(){$(".red").removeClass("shake");$(".windows").fadeIn();$(".opacity").fadeIn();},1000);});
    $(".close").click(function(){$(this).parent().fadeOut();$(".opacity").fadeOut();$(".red").fadeOut(function(){
    	Ajax.call('user.php?act=clear_s_bonus_user', "", "", 'GET', 'JSON');
    	location.href="user.php?act=bonus";
    })});
    
    /* 支付弹层*/
    /*---------------------------
    Defaults for Reveal
   ----------------------------*/
   	 
   /*---------------------------
    Listener for data-reveal-id attributes
   ----------------------------*/

   	jQuery('input[data-reveal-id]').on('click', function(e) {
   		e.preventDefault();
   		var modalLocation = $(this).attr('data-reveal-id');
   		jQuery('#'+modalLocation).reveal($(this).data());
   	});

   /*---------------------------
    Extend and Execute
   ----------------------------*/

   	jQuery.fn.reveal = function(options) {
           
           
           var defaults = {  
   	    	animation: 'fadeAndPop', //fade, fadeAndPop, none
   		    animationspeed: 300, //how fast animtions are
   		    closeonbackgroundclick: true, //if you click background will modal close?
   		    dismissmodalclass: 'close-reveal-modal' //the class of a button or element that will close an open modal
       	}; 
       	
           //Extend dem' options
           var options = jQuery.extend({}, defaults, options); 
   	
           return this.each(function() {
           
   /*---------------------------
    Global Variables
   ----------------------------*/
           	var modal = jQuery(this),
           		topMeasure  = parseInt(modal.css('top')),
   				topOffset = modal.height() + topMeasure,
             		locked = false,
   				modalBG = jQuery('.reveal-modal-bg');

   /*---------------------------
    Create Modal BG
   ----------------------------*/
   			if(modalBG.length == 0) {
   				modalBG = $('<div class="reveal-modal-bg" />').insertAfter(modal);
   			}		    
        
   /*---------------------------
    Open & Close Animations
   ----------------------------*/
   			//Entrance Animations
   			modal.bind('reveal:open', function () {
   			  modalBG.unbind('click.modalEvent');
   				$('.' + options.dismissmodalclass).unbind('click.modalEvent');
   				if(!locked) {
   					lockModal();
   					if(options.animation == "fadeAndPop") {
   						modal.css({'top': $(document).scrollTop()-topOffset, 'opacity' : 0, 'visibility' : 'visible'});
   						modalBG.fadeIn(options.animationspeed/2);
   						modal.delay(options.animationspeed/2).animate({
   							"top": $(document).scrollTop()+topMeasure + 'px',
   							"opacity" : 1
   						}, options.animationspeed,unlockModal());					
   					}
   					if(options.animation == "fade") {
   						modal.css({'opacity' : 0, 'visibility' : 'visible', 'top': $(document).scrollTop()+topMeasure});
   						modalBG.fadeIn(options.animationspeed/2);
   						modal.delay(options.animationspeed/2).animate({
   							"opacity" : 1
   						}, options.animationspeed,unlockModal());					
   					} 
   					if(options.animation == "none") {
   						modal.css({'visibility' : 'visible', 'top':$(document).scrollTop()+topMeasure});
   						modalBG.css({"display":"block"});	
   						unlockModal()				
   					}
   				}
   				modal.unbind('reveal:open');
   			}); 	

   			//Closing Animation
   			modal.bind('reveal:close', function () {
   			  if(!locked) {
   					lockModal();
   					if(options.animation == "fadeAndPop") {
   						modalBG.delay(options.animationspeed).fadeOut(options.animationspeed);
   						modal.animate({
   							"top":  $(document).scrollTop()-topOffset + 'px',
   							"opacity" : 0
   						}, options.animationspeed/2, function() {
   							modal.css({'top':topMeasure, 'opacity' : 1, 'visibility' : 'hidden'});
   							unlockModal();
   						});					
   					}  	
   					if(options.animation == "fade") {
   						modalBG.delay(options.animationspeed).fadeOut(options.animationspeed);
   						modal.animate({
   							"opacity" : 0
   						}, options.animationspeed, function() {
   							modal.css({'opacity' : 1, 'visibility' : 'hidden', 'top' : topMeasure});
   							unlockModal();
   						});					
   					}  	
   					if(options.animation == "none") {
   						modal.css({'visibility' : 'hidden', 'top' : topMeasure});
   						modalBG.css({'display' : 'none'});	
   					}		
   				}
   				modal.unbind('reveal:close');
   			});     
      	
   /*---------------------------
    Open and add Closing Listeners
   ----------------------------*/
           	//Open Modal Immediately
       	modal.trigger('reveal:open')
   			
   			//Close Modal Listeners
   			var closeButton = $('.' + options.dismissmodalclass).bind('click.modalEvent', function () {
   			  modal.trigger('reveal:close')
   			});
   			
   			if(options.closeonbackgroundclick) {
   				modalBG.css({"cursor":"pointer"})
   				modalBG.bind('click.modalEvent', function () {
   				  modal.trigger('reveal:close')
   				});
   			}
   			$('body').keyup(function(e) {
           		if(e.which===27){ modal.trigger('reveal:close'); } // 27 is the keycode for the Escape key
   			});
   			
   			
   /*---------------------------
    Animations Locks
   ----------------------------*/
   			function unlockModal() { 
   				locked = false;
   			}
   			function lockModal() {
   				locked = true;
   			}	
   			$('input[pay-done]').click(function(){
   	    	   location.href ='user.php';
   	        });
   	        $('input[pay-no]').click(function(){
   	        	modal.trigger('reveal:close');
   	        });
           });//each call
       }//orbit plugin call
       /*用户中心*/
   	jQuery("#user-dl").mouseover(function(){
		jQuery(this).addClass("hover");
    });
   	jQuery("#user-dl").mouseout(function(){
		jQuery(this).removeClass('hover');
		
    });
   	/*订单查询*/
   	jQuery('.search-btn').on('click', function() {
   		if(!jQuery("#ip_keyword").val()){
   			jAlert("请输入订单号！",null,"馨清网");
   			return;
   		}
   		if(isNaN(jQuery("#ip_keyword").val())){
   			jAlert("您输入的不是一个有效的订单号！",null,"馨清网");
   			return;
   		}
   		location.href="user.php?act=order_list&keyword="+jQuery("#ip_keyword").val();
   	});
   	/* 订单地址 */
	jQuery(".ctxt").mouseover(function(){
	    var id=jQuery(this).attr('value');
		jQuery("#consignee_"+id).show();
		
    });
	jQuery(".ctxt").mouseout(function(){
		var id=jQuery(this).attr('value');
		jQuery("#consignee_"+id).hide();
		
    });
	/*订单跟踪*/
	jQuery(".track_packages_div").mouseover(function(){
	    var id=jQuery(this).attr('value');
		jQuery("#track_packages_"+id).show();
		
    });
	jQuery(".track_packages_div").mouseout(function(){
		var id=jQuery(this).attr('value');
		jQuery("#track_packages_"+id).hide();
		
    });
	/* 弹出新增收货地址*/
	jQuery('#add_address').on("click",function(){
		if(jQuery(this).attr('value')>=5){
			jAlert("收货地址已经超过最大数!",null,"馨清网");
			return;
		}
		jQuery(".add_address").show();
	});
	
	jQuery('.xdsoft_close').on("click",function(){
		jQuery(".add_address").hide();
	});
	/* 猜你喜欢换一换*/
	jQuery('.extra').on("click",function(){
		var num=0;
		var count=Math.floor(Math.random() * (jQuery('#guess_ul li').length-6) + 1);
		jQuery('#guess_ul li').hide();
		jQuery('#guess_ul li').each(function(){
			 if(num<6){
			 jQuery('.fore'+(count+num)).show();
		     }
			 num++;
			});
		
	});
});
