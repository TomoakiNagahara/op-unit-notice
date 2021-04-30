<?php
/** op-unit-notice:/testcase/plain-text.php
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
namespace OP;

//	...
if( Env::isHttp() ){
	return;
}

//	...
Notice::Set("This is plain-text notice test.");
