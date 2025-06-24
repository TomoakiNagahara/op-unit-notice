<?php
/** op-unit-notice:/function/dump_text_javascript.inc.php
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
namespace OP\UNIT\NOTICE;

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

//	...
$file = OP()->Path($file);

//	...
$message = OP()->Decode($notice['message']);
$message = str_replace("\\",'\\\\',$message);
$message = str_replace("'", "\'",$message);
$message = str_replace('"', '\"',$message);
$message = str_replace("\n",'\n',$message);

//	...
$json = json_encode($notice['backtrace']);

//	...
echo "\n";
echo "console.error('{$file} #{$line} {$message}');\n";
echo "console.log($json);\n";
