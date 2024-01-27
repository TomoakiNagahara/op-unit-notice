
/** op-unit-notice:/notice2.js
 *
 * @created		2023-12-30
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */

//	...
if( 'undefined' === typeof $OP ){
	$OP = {};
}

/** Notice to console and desktop.
 * 
 * @created		2017-07-28	op-unit-notice:/notice.js
 * @moved		2023-12-30	op-unit-notice:/notice2.js
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */
(function(){
	//	...
	document.addEventListener('DOMContentLoaded', function(){
		//	...
		var divs = document.querySelectorAll('div.OP_NOTICE');
		//	...
		for(var i=0; i<divs.length; i++){
			//	...
			const json  = JSON.parse(divs[i].innerText);
			//	...
			$OP.Notice2console(json);
			$OP.Notice2desktop(json);
			$OP.Notice2footer(json);
			//	...
			divs[i].innerText = '';
		}
	});
})();
