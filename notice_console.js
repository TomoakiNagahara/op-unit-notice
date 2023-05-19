
/** op-unit-notice:/notice_console.js
 *
 * @created     2023-05-15
 * @version     1.0
 * @package     op-unit-notice
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */

(function(){
    //  ...
    $OP.NoticeConsole = function(json){
        //  ...
        let traces = [];

        //  ...
        json.backtrace.forEach(function(trace){
            //  ...
            let file = trace.file;
            let line = trace.line;
            let func = trace.function;
            let args = trace.args;
            let type = trace.type;
            let clss = trace.class;

            //  ...
            if( file ){
                file = $OP.Path.Compress(file);
            }

            //  ...
            if( clss ){
                func = `${clss}${type}${func}`;
            }

            //  ...
            trace = {};
            trace.file = file;
            trace.line = line;
            trace.function = func;
            trace.args = args;
            traces.push(trace);
        });

        //  ...
        console.error(json.message, json);
        console.table(traces);
    };
})();
