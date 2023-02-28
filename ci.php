<?php
/** op-core:/ci.php
 *
 * @created    2023-01-01
 * @version    2.2.2
 * @package    op-core
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
$php = $_SERVER['_'];

//	...
$argv1 = $_SERVER['argv'][1] ?? '';
$argv2 = $_SERVER['argv'][2] ?? '';
$argv3 = $_SERVER['argv'][3] ?? '';
$argv4 = $_SERVER['argv'][4] ?? '';
$argv5 = $_SERVER['argv'][5] ?? '';

/* @var $output array   */
/* @var $status integer */
exec("{$php} ../../../ci.php {$argv1} {$argv2} {$argv3} {$argv4} {$argv5}", $output, $status);
if( $output ){
	echo join("\n", $output)."\n";
}
exit($status);
