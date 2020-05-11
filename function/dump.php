<?php
/**
 * unit-notice:/function/dump.php
 *
 * @created   2019-12-05
 * @version   1.0
 * @package   unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-12-05
 */
namespace OP\UNIT\NOTICE\FUNCTIONS;

/** use
 *
 */
use OP\Env;
use function OP\Json;
use function OP\Decode;
use function OP\CompressPath;

/** Display to dump of notice.
 *
 * @created
 * @moved    2019-12-05  Separate from Notice.class.php
 * @param    array       $notice
 */
function Dump( $notice )
{
	//	...
	switch( Env::Mime() ?? 'text/html' ){
		case 'text/html':
			//	Escape is done with self::Shutdown().
			//	$notice = Escape($notice);
			Json($notice, 'OP_NOTICE');
			break;

		case 'text/css':
			echo "/* {$notice['message']} */".PHP_EOL;
			break;

		case 'text/javascript':
			//	...
			if(!$file = $notice['backtrace'][0]['file'] ?? null ){
				$file = $notice['backtrace'][1]['file'] ?? null;
			};

			//	...
			if(!$line = $notice['backtrace'][0]['line'] ?? null ){
				$line = $notice['backtrace'][1]['line'] ?? null;
			};

			//	...
			$file = CompressPath($file);

			//	...
			$message = Decode($notice['message']);
			$message = str_replace("'", "\'",$message);
			$message = str_replace('"', '\"',$message);
			$message = str_replace("\n",'\n',$message);
			$message = str_replace("\\",'\\\\',$message);

			//	...
			$json = json_encode($notice['backtrace']);

			//	...
			echo "console.error('{$file} #{$line} {$message}');".PHP_EOL;
			echo "console.log($json)";
			break;

		default:
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

				echo '('.join(', ', $join).')'.PHP_EOL;
			};
			echo PHP_EOL;
	}
}
