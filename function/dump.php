<?php
/** op-unit-notice:/function/dump.php
 *
 * @created   2019-12-05
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT\NOTICE\FUNCTIONS;

/** use
 *
 */
use OP\Env;
use function OP\Json;

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
			require(__DIR__.'/dump_text_javascript.inc.php');
			break;

		default:
			require(__DIR__.'/dump_text_plain.inc.php');
	}
}
