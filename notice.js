//<?php
/** op-unit-notice:/notice.js
 *
 * @created   2017-07-28
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
//?>

//	...
if( $OP === undefined ){
	var $OP = {};

	//	...
	$OP.Args = function( args ){
		var span = document.createElement('span');
			span.innerText = '()';

		//	...
		console.log(args);

		//	...
		return span;
	};
}

//	...
if( $OP.Path === undefined ){
	$OP.Path = {};
	$OP.Path.Compress = function(file){
		//	...
		var root = "<?= \OP\RootPath()['doc'] ?>";

		//	...
		if(!file ){
			return null;
		};

		//	...
		return file.replace(root, '');
	};
};

//	...
(function(){
	//	Display the Notice at the bottom of the document.
	$OP.Notice = function(div, i){
		//	...
		if(!div.innerText){
			return;
		}

		//	...
		var json  = JSON.parse(div.innerText);
		var tags = {};
			tags.count   = document.createElement('span');
			tags.headline= document.createElement('div');
			tags.message = document.createElement('div');
			tags.created = document.createElement('span');

			tags.count  .innerText = json.count;
			tags.created.innerText = json.created;

			//	...
			var me1 = document.createElement('p');
			var me2 = document.createElement('p');

			//	...
			json.message += "\n";
			var pos = json.message.indexOf("\n");
			me1.innerText = json.message.substr(0, pos);
			me2.innerText = json.message.substr(pos+1, json.message.length -pos -2);

			//	...
			tags.headline.classList.add('headline');
			tags.headline.appendChild(me1);

			//	...
			tags.message.classList.add('message');
			tags.message.appendChild(me2);

		//	...
		var temp = document.createElement('div');
			temp.appendChild( tags.headline);
			temp.appendChild( tags.message );
			temp.appendChild( __backtrace( json.backtrace ) )

		//	...
		div.innerText = '';
		div.appendChild(temp);

		//	...
		for(var dom of div.querySelectorAll('.OP_NOTICE .arg.object') ){
			dom.addEventListener('click', function(e){
				console.log( JSON.parse(e.target.dataset.json) );
			});
		};

		//	...
		setTimeout(function(){
			__notice(me1.innerText, me2.innerText);
		}, 1000 * i);
	};

	//	Display the Notice on the upper left of the document.
	function __notice(message, subtext){
		//	...
		console.error(message, subtext);

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
		div .appendChild(span);
		area.appendChild(div);

		//	...
		setTimeout(function(){
			div.classList.add('hide');
			setTimeout(function(){
				area.removeChild(div);
			}, 1000 * 1);
		}, 1000 * 3);
	}

	//	...
	function __backtrace(json){
		var table = document.createElement('table');
			table.classList.add('border');
			table.classList.add('none');
		for(var i=0; i<json.length; i++){
			table.appendChild( __line(json[i]) );
		}
		return table;
	}

	//	...
	function __line(json){
		//	...
		var tds = {};
			//	...
			tds.file = document.createElement('td');
			tds.line = document.createElement('td');
			tds.func = document.createElement('td');

			//	...
			tds.file.classList.add('file');
			tds.line.classList.add('line');
			tds.func.classList.add('function');

			//	file
			var span = document.createElement('span');
			span.innerText = $OP.Path.Compress(json.file);
			span.classList.add('file');
			tds.file.appendChild(span);

			//	line
			var span = document.createElement('span');
			span.innerText = json.line === undefined ? '': json.line;
			span.classList.add('line');
			tds.line.appendChild(span);

			//	function
			var span = document.createElement('span');
			span.innerText = json.line;
			span.classList.add('function');
			tds.func.appendChild(span);
			if( json.type ){
				span.innerHTML = json.class + json.type + json['function'];
			}else if( json['function'] ){
				span.innerText = json['function'];
			}else{
				span.innerText = '';
			}

			//	arguments
			if( span.innerText ){
				tds.func.appendChild( $OP.Args(json.args, true) );
			}

		var tr = document.createElement('tr');
		if( json.file ){ // Closure
			tr.appendChild( tds.file );
			tr.appendChild( tds.line );
			tr.appendChild( tds.func );
		};
		return tr;
	}

	//	...
	document.addEventListener('DOMContentLoaded', function(){
		//	...
		var divs = document.querySelectorAll('div.OP_NOTICE');

		//	...
		for(var i=0; i<divs.length; i++){
			$OP.Notice(divs[i], i);
		}
	});
})();
