<?php
/**	op-unit-notice:/Notice.class.php
 *
 * @created    2016-11-17
 * @version    1.0
 * @package    op-unit-notice
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	namespace
 *
 */
namespace OP\UNIT;

/**	Used class
 *
 */
use OP\OP_CORE;
use OP\OP_CI;
use OP\IF_NOTICE;

/**	Notice
 *
 * @created    2016-11-17
 * @version    1.0
 * @package    core
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */
class Notice implements IF_NOTICE
{
	/**	trait.
	 *
	 */
	use OP_CORE, OP_CI;

	/**	Callback of app shutdown.
	 *
	 */
	function Auto()
	{
		//	...
		while( $notice = \OP\Error::Get() ){
			//	...
			if( OP()->isAdmin() ){
				require_once(__DIR__.'/function/dump.php');
				NOTICE\FUNCTIONS\Dump($notice);
			}else{
				require_once(__DIR__.'/function/mail.php');
				NOTICE\FUNCTIONS\Mail($notice);
			};
		};
	}
}
