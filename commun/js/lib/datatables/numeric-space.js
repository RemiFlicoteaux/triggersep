/**
 * JavaScript ecmascript 5
 * 
 * @author : Elbaz Michael <elbazmichael92@gmail.com>
 * @date : 22 juil. 2015
 */

/**
 *  @example
 *    $('#example').dataTable( {
 *       columnDefs: [
 *         { type: 'numeric-space', targets: 0 }
 *       ]
 *    } );
 */
 

jQuery.extend(jQuery.fn.dataTableExt.oSort, {
  "numeric-space-pre": function (a) {
    var b = a.replace(/\s/g, "");
    /(-?[0-9]+)/.exec(b);
    
    var x = (a == "-") ? 0 : RegExp.$1;
    return parseFloat(x);
  },
  "numeric-space-asc": function (a, b) {
    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
  },
  "numeric-space-desc": function (a, b) {
    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
  }
});