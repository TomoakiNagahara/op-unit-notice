
/** op-unit-notice:/notice2console.js
 *
 * @created		2023-12-30
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */

/** Notice to console for developer.
 * 
 * @created		2023-12-30
 * @version		2.0
 * @package		op-unit-notice
 * @author		Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright	Tomoaki Nagahara All right reserved.
 */
(function(){
	//	...
	$OP.Notice2console = function(json){
		//	...
		let table = [];
		for( let trace of json.backtrace ){
			let   file = trace.file   ?? null;
			const line = trace.line   ?? null;
			const type = trace.type   ?? null;
			const args = trace.args   ?? null;
			const clss = trace.class  ?? null;
			let func = trace.function ?? null;
			if( file ){
				file = $OP.Path.Compress(file);
			}
			if( type ){
				func = clss + type + func;
			}
			if( func ){
				func = func.replace(/\\\\/g, '\\');
				func = func + '()';
			}
			jstr = (args === null) ? null: JSON.stringify(args);
			const cell = {file: file, line: line, function: func, args: jstr};
			table.push(cell);
		}
		console.group(json.message);
		console.table(table);
		console.groupEnd();
	};
})();
