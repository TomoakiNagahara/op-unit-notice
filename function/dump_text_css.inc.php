<?php
/** op-unit-notice:/function/dump_text_css.inc.php
 *
 * @created   2022-10-06
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT\NOTICE;

/** use
 *
 */
use function OP\Decode;
use function OP\CompressPath;

/* @var $notice array */
if( false ){
	$notice = [];
}

//	...
if(!$file = $notice['backtrace'][0]['file'] ?? null ){
	$file = $notice['backtrace'][1]['file'] ?? null;
};

//	...
if(!$line = $notice['backtrace'][0]['line'] ?? null ){
	$line = $notice['backtrace'][1]['line'] ?? null;
};

/*
//	...
$file = CompressPath($file);
*/

//	...
$message = Decode($notice['message']);
/*
$message = str_replace("'", "\'",$message);
$message = str_replace('"', '\"',$message);
$message = str_replace("\n",'\n',$message);
$message = str_replace("\\",'\\\\',$message);
*/

//	...
echo "/*\n";
echo "{$file} #{$line}\n";
echo "{$message}\n";
\OP\DebugBacktrace::Auto($notice['backtrace']);
echo "*/\n";

?>
body:before {
	content: "<?= $_SERVER['REQUEST_URI'] ?>: <?= $message ?>";
}
