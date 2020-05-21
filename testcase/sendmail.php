<?php
/** op-unit-notice:/testcase/sendmail.php
 *
 * @creation  2019-04-18
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
D( Env::Get(Env::_ADMIN_IP_), Env::Get(Env::_ADMIN_MAIL_) );

//	...
Env::Set(Env::_ADMIN_IP_, null);

//	...
Notice::Set('Sendmail test');
