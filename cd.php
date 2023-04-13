<?php
/** op-core:/cd.php
 *
 * @created    2023-02-10
 * @version    2.2.0
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

//  Inherit the PHP version of the execution source.
$php = $_SERVER['_'];

//	...
$argv1 = $_SERVER['argv'][1] ?? '';
$argv2 = $_SERVER['argv'][2] ?? '';
$argv3 = $_SERVER['argv'][3] ?? '';
$argv4 = $_SERVER['argv'][4] ?? '';
$argv5 = $_SERVER['argv'][5] ?? '';

/* @var $output array   */
/* @var $status integer */
exec("{$php} ../../../cd.php {$argv1} {$argv2} {$argv3} {$argv4} {$argv5}", $output, $status);
if( $output ){
	echo join("\n", $output)."\n";
}
exit($status);
