
/** op-unit-notice:/notice_window.js
 *
 * @created     2023-05-15
 * @version     1.0
 * @package     op-unit-notice
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */

(function(){
    //  ...
    i = 0;
    
    //  ...
    $OP.NoticeWindow = function(message){
        i++;
        
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
        var div  = document.createElement('div');
        var span = document.createElement('span');
            span.innerText = message;

        //  ...
        setTimeout(function(){
            div .appendChild(span);
            area.appendChild(div);
        }, 1000 * i);

        //  ...
        setTimeout(function(){
            //div.classList.add('hide');
            setTimeout(function(){
                //area.removeChild(div);
            }, 1000 * 1);
        }, 1000 * 3);
    };
})();
