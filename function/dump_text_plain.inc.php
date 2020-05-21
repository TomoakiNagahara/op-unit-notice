<?php
/** op-unit-notice:/function/dump_text_plain.inc.php
 *
 * @created   2020-05-21
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT\NOTICE;

/** use
 *
 */

/* @var $notice array */
if( false ){
	$notice = [];
}

//	...
$count   = $notice['count'];
$created = $notice['created'];
$message = $notice['message'];

//	...
echo PHP_EOL;
echo "{$message} | {$created} (count: $count)".PHP_EOL;
echo PHP_EOL;

//	...
foreach( $notice['backtrace'] as $i => $trace ){
	echo $i . ': ';
	//	print_r($trace);
	$join   = [];
	$file   = $trace['file']     ?? null;
	$line   = $trace['line']     ?? null;
	$func   = $trace['function'] ?? null;
	$type   = $trace['type']     ?? null;
	$args   = $trace['args']     ??   [];
	$class  = $trace['class']    ?? null;
//	$object = $trace['object']   ?? null;

	//	...
	if( $file ){
		echo "{$file} #{$line} ";
	};

	//	...
	if( strpos($func, '{closure}') ){
		echo '{closure}';
	}else{
		echo $type ? $class.$type.$func : $func;
	};

	//	...
	foreach( $args as $arg ){
		switch( $type = gettype($arg) ){
			case 'integer':
				$join[] = $arg;
				break;

			case 'string':
				//	Limit string length.
				$len = 60;
				//	If too long.
				if( mb_strlen($arg) > $len ){
					//	Rmove \n and \r
					$arg = preg_replace('/\n|\r/', '', $arg);
					//	Turncate string.
					$arg = mb_substr($arg, 0, 60) . '...';
				}
				//	Join.
				$join[] = '"'.$arg.'"';
				break;

			case 'boolean':
				$join[] = $arg ? 'true': 'false';
				break;

			case 'array':
				$join[] = 'array('.count($arg).')';
				break;

			default:
				$join[] = $type;
		};
	};

	//	...
	echo '('.join(', ', $join).')'.PHP_EOL;
};

//	...
echo PHP_EOL;
