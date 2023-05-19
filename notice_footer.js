
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
        });
    };

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
            case 'include':
            case 'require':
            case 'include_once':
            case 'require_once':
                span.appendChild(Arg(trace.args[0]));
                break;
            default:
                for(let i=0; i<trace.args.length; i++){
                    span.appendChild( Arg(trace.args[i]) );
                }
        }

        //  ...
        return span;
    }

    //  ...
    function Arg(arg){
        //  ...
        let type = typeof arg;

        //  ...
        let span = document.createElement('span');
            span.classList.add('arg', 'underline', type);
            span.innerText = type;
            span.addEventListener('click', function(){
                console.log(arg);
            }, false);

        //  ...
        switch(type){
            case 'number':
                span.innerText = arg;
                span.classList.remove('underline');
                break;
            case 'string':
                if(!arg.match(/\n/) ){
                    //  ...
                    let quote = document.createElement('span');
                        quote.classList.add('quote');
                        quote.innerText = $OP.Path.Compress(arg);
                    //  ...
                    span.innerText = '';
                    span.classList.remove('underline');
                    span.appendChild(quote);
                }
                break;
        }

        //  ...
        return span;
    }
})();
