
/** op-unit-notice:/notice_footer.js
 *
 * @created     2023-05-15
 * @version     1.0
 * @package     op-unit-notice
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */
//  ...
(function(){
    //  ...
    document.addEventListener('DOMContentLoaded', function(){
        //  ...
        $OP.NoticeFooter();
    });

    //  ...
    $OP.NoticeFooter = function(){
        //  ...
        let body = document.getElementsByTagName('body')[0];

        //  ...
        document.querySelectorAll('div.OP_NOTICE').forEach(function(div){
            //  ...
            let json = JSON.parse(div.innerText);
            
            //  ...
            let section = document.createElement('section');
                section.appendChild( Message(json) );
                section.appendChild( Trace(json)   );
                section.classList.add('OP','Notice');
            //  ...
            body.appendChild(section);

            //  ...
            div.style.display = 'none';
        });
    };

    //  ...
    function Area(){
        //  ...
        var area = document.querySelector('#OP_NOTICE_AREA');
        if(!area ){
            //  ...
            area = document.createElement('div');
            area.id = 'OP_NOTICE_AREA';

            //  ...
            var body = document.querySelector('body');
                body.insertBefore(area, body.children[0]);
        }

        //  ...
        return area;
    }

    //  ...
    function Message(json){
        //  ...
        let h1 = document.createElement('h1');
            h1.innerText = json.message;
            h1.classList.add('message');

        //  ...
        return h1;
    }

    //  ...
    function Trace(json){
        //  ...
        let table = document.createElement('table');
            table.classList.add('table');

        //  ...
        json.backtrace.forEach(function(trace){
            table.appendChild( TR(trace) );
        });

        //  ...
        return table;
    }

    //  ...
    function TR(trace){
        console.log(trace);
        //  ...
        let tr  = document.createElement('tr');
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let div = document.createElement('div');
            div.classList.add('function');

        //  ...
        let file = trace.file     ?? '';
        let line = trace.line     ?? '';
        let func = trace.function ?? '';
        let clss = trace.class    ?? '';
        let type = trace.type     ?? '';
        let args = Args(trace);

        //  ...
        if( file ){
            file = $OP.Path.Compress(file);
        }

        //  ...
        if( clss ){
            func = `${clss}${type}${func}`;
        }

        //  ...
        div.innerText = func;
        div.appendChild(args);
        td1.innerText = file;
        td2.innerText = line;
        td3.appendChild(div);

        //  ...
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);

        //  ...
        return tr;
    }

    //  ...
    function Args(trace){
        //  ...
        let span = document.createElement('span');
            span.classList.add('args');
        //  ...
        let func = trace.function ?? '';

        //  ...
        switch( func ){
            //  If function is empty.
            case '':
                span.classList.remove('args');
                break;

            case 'include':
            case 'require':
            case 'include_once':
            case 'require_once':
                let path = (trace?.args?.length ?? 0) ? trace.args[0]: null;
                span.appendChild(Arg(path));
                break;
            default:
                let length = trace?.args?.length ?? 0;
                for(let i=0; i<length; i++){
                    span.appendChild( Arg(trace.args[i]) );
                }
        }

        //  ...
        return span;
    }

    //  ...
    function Arg(arg){
        //  ...
        let type = arg === null ? 'null': typeof arg;

        //  ...
        let span = document.createElement('span');
            span.classList.add('arg', type);
            span.innerText = type;
            span.addEventListener('click', function(){
                console.log(arg);
            }, false);

        //  ...
        switch(type){

            case 'null':
                break;

            case 'boolean':
                span.innerText = arg;
                span.classList.add(arg);
                break;

            case 'number':
                span.innerText = arg;
                break;
            case 'string':
                if(!arg.match(/\n/) ){
                    //  ...
                    let quote = document.createElement('span');
                        quote.classList.add('quote');
                        quote.innerText = $OP.Path.Compress(arg);
                    //  ...
                    span.innerText = '';
                    span.appendChild(quote);
                }
                break;

            default:
            span.classList.add('underline');
        }

        //  ...
        return span;
    }
})();
