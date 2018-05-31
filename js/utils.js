/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ util.js
* @descritpion ~ Outils divers et variés utilisé par le site.
*/

/*$("#footer").css("top", $("html").height() - 50)*/
$("#footer").width($("html").width())

var html = $('html');
var footer = $('#footer');

new ResizeSensor(html, function() {
  /*$("#footer").css("top", $("html").height() - 50)*/
  footer.width($("html").width())
  });
