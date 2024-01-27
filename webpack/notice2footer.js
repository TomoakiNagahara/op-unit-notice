
/** op-unit-notice:/notice2footer.js
 *
 * @created		2023-12-30
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */

/** Notice to footer for developer.
 * 
 * @created		2023-12-30
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */
(function(){
	//	...
	$OP.Notice2footer = function(json){
		//	...
		let lines    = json.message.split(/\n/);
		let message1 = lines[0] ?? '';
		let message2 = lines[1] ?? '';
		//	...
		let node = document.createElement('div');
			node.innerHTML = `<div class="OP_NOTICE"><h1>${message1}</h1><p>${message2}</p></div>`;

		//	...
		document.body.appendChild(node);
	};
})();
