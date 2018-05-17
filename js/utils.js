/*$("#footer").css("top", $("html").height() - 50)*/
$("#footer").width($("html").width())

var html = $('html');
var footer = $('#footer');

new ResizeSensor(html, function() {
  /*$("#footer").css("top", $("html").height() - 50)*/
  footer.width($("html").width())
  });
