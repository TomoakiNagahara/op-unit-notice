<?php
/** op-unit-notice:/Notice.class.php
 *
 * @created   2016-11-17
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2018-04-18
 */
namespace OP\UNIT;

/** Used class
 *
 */
use OP\OP_CORE;
use OP\OP_UNIT;
use OP\IF_UNIT;
use OP\Env;
use function OP\Decode;
use function OP\CompressPath;

/** Notice
 *
 * @created   2016-11-17
 * @version   1.0
 * @package   core
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Notice implements IF_UNIT
{
	/** trait.
	 *
	 */
	use OP_CORE, OP_UNIT;

	/** Callback of app shutdown.
	 *
	 */
	function Auto()
	{
		//	...
		while( $notice = \OP\Notice::Get() ){
			//	...
			if( Env::isAdmin() ){
				require_once(__DIR__.'/function/dump.php');
				NOTICE\FUNCTIONS\Dump($notice);
			}else{
				require_once(__DIR__.'/function/mail.php');
				NOTICE\FUNCTIONS\Mail($notice);
			};
		};
	}
}
