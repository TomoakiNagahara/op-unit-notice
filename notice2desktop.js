
/** op-unit-notice:/notice2desktop.js
 *
 * @created		2023-12-30
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */

/** Notice to desktop for developer.
 * 
 * @created		2017-07-28	op-unit-notice:/notice.js
 * @moved		2023-12-30	op-unit-notice:/notice2desktop.js
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */
(function(){
	//	...
	let i = 1;

	//	...
	$OP.Notice2desktop = function(json){
		//	...
		let message = json.message;

		//	...
		var area = document.querySelector('#OP_NOTICE_AREA');
		if(!area ){
			//	...
			area = document.createElement('div');
			area.id = 'OP_NOTICE_AREA';

			//	...
			var body = document.querySelector('body');
				body.insertBefore(area, body.children[0]);
		}

		//	...
		var div  = document.createElement('div');
		var span = document.createElement('span');
			span.innerText = message;

		//	...
		setTimeout(function(){
			div .appendChild(span);
			area.appendChild(div);
		}, 1000 * i);

		//	...
		setTimeout(function(){
			//	...
			div.classList.add('hide');
			setTimeout(function(){
				area.removeChild(div);
			}, 1000 * 1 * i);
		}, 1000 * 3 * i);

		//	...
		i++;
	};
})();
