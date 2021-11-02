$('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
  var url = new String(e.target);
  var pieces = url.split("#");

  if (pieces[1] == "profile") {
    $("#profile").css("left", "-" + $(window).width() + "px");
    var left = $("#profile").offset().left;
    $("#profile").css({ left: left }).animate({ left: "0px" }, "10");
  }

  if (pieces[1] == "home") {
    $("#home").css("right", "-" + $(window).width() + "px");
    var right = $("#home").offset().right;
    $("#home").css({ right: right }).animate({ right: "0px" }, "10");
  }

  if (pieces[1] == "messages") {
    $("#messages").css("top", "-" + $(window).height() + "px");
    var top = $("#messages").offset().top;
    $("#messages").css({ top: top }).animate({ top: "0px" }, "10");
  }

  if (pieces[1] == "settings") {
    $("#settings").css("bottom", "-" + $(window).height() + "px");
    var bottom = $("#settings").offset().bottom;
    $("#settings").css({ bottom: bottom }).animate({ bottom: "0px" }, "10");
  }
});
