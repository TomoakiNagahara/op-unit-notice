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

/** Display to dump of notice.
 *
 * @created
 * @moved    2019-12-05  Separate from Notice.class.php
 * @param    array       $notice
 */
function Dump( $notice )
{
	//	...
	$mime = OP()->isHttp() ? OP()->MIME(): 'text/plain';

	//	...
	switch( $mime ){
		case 'text/html':
			require_once(_ROOT_CORE_.'/function/Json.php');
			\OP\Json($notice, 'OP_NOTICE');
			break;

		case 'text/css':
			require(__DIR__.'/dump_text_css.inc.php');
			break;

		case 'text/javascript':
			require(__DIR__.'/dump_text_javascript.inc.php');
			break;

		default:
			require(__DIR__.'/dump_text_plain.inc.php');
	}
}
