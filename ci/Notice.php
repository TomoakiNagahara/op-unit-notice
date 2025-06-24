<?php
/** op-unit-notice:/ci/Notice.php
 *
 * @created   2023-01-13
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

/* @var $ci \OP\UNIT\CI\CI_Config */
$ci = OP::Unit('CI')::Config();

//	Template
$args   = 'ci.txt';
$result = 'OK';
$ci->Set('Template', $result, $args);

//	...
return $ci->Get();
