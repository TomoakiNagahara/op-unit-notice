<?php
/** op-unit-notice:/testcase/action.php
 *
 * @creation  2019-04-18
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2019-04-18
 */
namespace OP;

//	...
Template('menu.phtml');

/* @var array args */
if( false ){ $args = []; };

//	...
switch( array_shift($args) ){
	case 'sendmail':
		Template('sendmail.php', $args);
		break;
}
