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
use function OP\RootPath;
use function OP\CompressPath;

/* @var $notice array */
if( false ){
	$notice = [];
}

//	...
$app_root= RootPath('app');
$count   = $notice['count'];
$created = $notice['created'];
$message = $notice['message'];

//	...
echo PHP_EOL;
echo "{$message} | {$created} (count: $count)".PHP_EOL;
echo PHP_EOL;

//	...
foreach( $notice['backtrace'] as $i => $trace ){
	echo str_pad($i, 2, ' ', STR_PAD_LEFT);
	echo ': ';
	//	print_r($trace);
	$join   = [];
	$file   = $trace['file']     ?? null;
	$line   = $trace['line']     ?? null;
	$func   = $trace['function'] ??   '';
	$type   = $trace['type']     ?? null;
	$args   = $trace['args']     ??   [];
	$class  = $trace['class']    ?? null;
//	$object = $trace['object']   ?? null;

	//	...
	if( $line ){
		$line = str_pad($line, 3, ' ', STR_PAD_RIGHT);
	}

	//	...
	if( $file ){
		$file = CompressPath($file);
		$file = str_pad($file, 30, ' ', STR_PAD_RIGHT);
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

				//	Omitting to path.
				if( $arg[0] === '/' ){
					if( strpos($arg, $app_root) === 0  ){
						$len = strlen(RootPath('app'));
						$arg = '.../'.substr($arg, $len);
					}
				}

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
