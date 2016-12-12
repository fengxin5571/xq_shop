%$(function () {
    var sWidth = $("#banner").width();
    var len = $("#banner ul li").length;
    var index = 0;
    var picTimer;
    var btn = "<div class='btnBg'></div><div class='btn'>";
    for (var i = 0; i < len; i++) {
        btn += "<span></span>";
    }
    btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
    $("#banner").append(btn);
    $("#banner .btnBg").css("opacity", 0);
    $("#banner .btn span").css("opacity", 0.4).mouseenter(function () {
        index = $("#banner .btn span").index(this);
        showPics(index);
    }).eq(0).trigger("mouseenter");
    $("#banner .preNext").css("opacity", 0.0).hover(function () {
        $(this).stop(true, false).animate({ "opacity": "0.5" }, 300);
    }, function () {
        $(this).stop(true, false).animate({ "opacity": "0" }, 300);
    });
    $("#banner .pre").click(function () {
        index -= 1;
        if (index == -1) { index = len - 1; }
        showPics(index);
    });
    $("#banner .next").click(function () {
        index += 1;
        if (index == len) { index = 0; }
        showPics(index);
    });
    $("#banner ul").css("width", 1800);
    $("#banner").hover(function () {
        clearInterval(picTimer);
    }, function () {
        picTimer = setInterval(function () {
            showPics(index);
            index++;
            if (index == len) { index = 0; }
        }, 2800);
    }).trigger("mouseleave");
    function showPics(index) {
        var nowLeft = -index * sWidth;
        $("#banner ul").stop(true, false).animate({ "left": nowLeft }, 300);
        $("#banner .btn span").stop(true, false).animate({ "opacity": "0.4" }, 300).eq(index).stop(true, false).animate({ "opacity": "1" }, 300);
    }
});




$(function () {
    var sWidth = $("#banner1").width();
    var len = $("#banner1 ul li").length;
    var index = 0;
    var picTimer;
    var btn = "<div class='btnBg'></div><div class='btn'>";
    for (var i = 0; i < len; i++) {
        btn += "<span></span>";
    }
    btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
    $("#banner1").append(btn);
    $("#banner1 .btnBg").css("opacity", 0);
    $("#banner1 .btn span").css("opacity", 0.4).mouseenter(function () {
        index = $("#banner1 .btn span").index(this);
        showPics(index);
    }).eq(0).trigger("mouseenter");
    $("#banner1 .preNext").css("opacity", 0.0).hover(function () {
        $(this).stop(true, false).animate({ "opacity": "0.5" }, 300);
    }, function () {
        $(this).stop(true, false).animate({ "opacity": "0" }, 300);
    });
    $("#banner1 .pre").click(function () {
        index -= 1;
        if (index == -1) { index = len - 1; }
        showPics(index);
    });
    $("#banner1 .next").click(function () {
        index += 1;
        if (index == len) { index = 0; }
        showPics(index);
    });
    $("#banner1 ul").css("width", sWidth * (len));
    $("#banner1").hover(function () {
        clearInterval(picTimer);
    }, function () {
        picTimer = setInterval(function () {
            showPics(index);
            index++;
            if (index == len) { index = 0; }
        }, 2800);
    }).trigger("mouseleave");
    function showPics(index) {
        var nowLeft = -index * sWidth;
        $("#banner1 ul").stop(true, false).animate({ "left": nowLeft }, 300);
        $("#banner1 .btn span").stop(true, false).animate({ "opacity": "0.4" }, 300).eq(index).stop(true, false).animate({ "opacity": "1" }, 300);
    }
});