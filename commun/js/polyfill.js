/**
 * JavaScript ecmascript 5
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 26 mai 2015
 */

//ajout de la methode trim pour IE8
if(typeof String.prototype.trim !== 'function'){
  String.prototype.trim = function(){
    var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
    return this.replace(rtrim, '');
  };
}