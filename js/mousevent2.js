$(document).ready(function(){
    /* 单页导航 */
    $(".s-plan-block").mouseenter(function(){
        $(this).find('.subnav').show();
    })
    $(".s-plan-block").mouseleave(function(){
        $(this).find('.subnav').hide();
    })
});