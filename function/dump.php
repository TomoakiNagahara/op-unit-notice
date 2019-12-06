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

			//	...
			$json = json_encode($notice['backtrace']);

			//	...
			echo "console.error('{$file} #{$line} {$message}');".PHP_EOL;
			echo "console.log($json)";
			break;

		default:
			echo PHP_EOL.$notice['message'].PHP_EOL;
			print_r($notice);
	}
}
