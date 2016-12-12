$(document).ready(function(){
if ($("#scroll-news").length > 0) {
var f=Number($(this).rotatetime);
setInterval(function() {
$("#scroll-news").find(".news-list").animate({
"-webkit-transform" : "translate3d(0px,-23px, 0px)",
transform : "translate3d(0px,-23px, 0px)",
"transition-duration" : "0.5s",
"transition-timing-function":"ease",
},600,function() {
$(this).css({"-webkit-transform" : "translate3d(0px,0px, 0px)",transform : "translate3d(0px,0px, 0px)",
}).find("li:first").appendTo(this)})
},isNaN(f) ? 3000: f * 1000);
                       }
});