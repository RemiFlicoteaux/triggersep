/**
 * JavaScript ecmascript 5
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 12 mai 2015
 * 
 */


jQuery(document).ready(function () {

  var utils = {};
  utils.back_element = $('.back-previous-page');
  utils.int = $('.int');

  //retour a la page precedente pour les elements ayant la classe 'back-previous-page'
  utils.back_element.click(function (e) {
    e.preventDefault();
    location_back();
  });

  //forcage du type entier sur les champs de formulaire ayant la classe 'int'
  utils.int.on('focus keyup keydown', function (e) {
    var value = $(this).val();
   
    if (e.ctrlKey && e.keyCode === 65 
        || e.ctrlKey && e.keyCode === 88 
        || e.keyCode === 17
        || e.keyCode === 8) {
      return true;
    }
    $(this).val(value.replace(/[^0-9]/, ''));
  });
});
