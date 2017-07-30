/**
 * JavaScript ecmascript 5
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 6 mai 2015
 * 
 * l'utilisation de ces fonctions requiert l'installation de jQuery
 */

/**
 * place le scroll en haut de la page
 * 
 */
function page_top() {
  $('html, body').scrollTop(0);
}

/**
 * creer une popup au centre
 * 
 * @param String url
 * @param String title
 * @param Integer w
 * @param Integer h
 * @returns Window
 */
function popupwindow(url, title, w, h) {
  var left = (screen.width / 2) - (w / 2);
  var top = (screen.height / 2) - (h / 2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=yes, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
} 

/**
 * soumet le formulaire courant en modifiant son url d'apres le lien passez en parametres
 * 
 * @param {jQuery-Object} form
 * @param {jQuery-Object} elements
 */
function submit_form_current_url(form,elements){
  var url = null;
  
  elements.click(function(event){
    event.preventDefault();
    url = $(this).attr("href");
    if(url !== null){
      form.attr('action', url);
      form.submit();
    }
  });
}

/**
 * permet de revenir a la page precedente
 * @returns boolean //false si on arrive pas a revenir en arriere
 */
function location_back(){
  if(window.location.href !== document.referrer && document.referrer !== ''){
    window.location.href = document.referrer;
  } else if(window.history){
    window.history.back();
  }
  return false;
}



//s Handelbars helper

Handlebars.registerHelper('ifCond', function (v1, v2, options) {
  if (v1 === v2) {
    return options.fn(this);
  }
  return options.inverse(this);
});



