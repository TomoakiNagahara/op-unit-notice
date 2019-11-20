<?php
/**
 * core:/Template/Developer/Sendmail.inc.php
 *
 * Use for core:/Template/Developer/Sendmail.phtml
 *
 * @creation  2016-11-30
 * @version   1.0
 * @package   core
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright 2016 (C) Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2019-03-17
 */
namespace OP;

//	Rendering backtrace.
function _backtrace($backtraces){
	print '<table>';
	foreach( $backtraces as $backtrace ){
		//	...
		$file = $backtrace['file']     ?? null;
		$line = $backtrace['line']     ?? null;
		$func = $backtrace['function'] ?? null;
		$class= $backtrace['class']    ?? null;
		$type = $backtrace['type']     ?? null;
		$args = $backtrace['args']     ?? null;

		//	...
		$file = CompressPath($file);

		//	...
		if( isset($type) ){
			$func = "{$class}{$type}{$func}";
		}

		//	...
		$args = _args($args);

		//	...
		print "<tr><td> {$file} </td><td> {$line} </td><td> {$func}($args) </td></tr>\n";
	}
	print '</table>';
}

//	Serialize arguments.
function _args($args){
	$join = [];
	if( $args ){
		foreach($args as $arg){
			$join[] = _arg($arg);
		}
	}
	return join(', ', $join);
}

//	Get each value.
function _arg($arg){
	switch( $type = gettype($arg) ){
		case 'boolean':
			$reslut = $arg ? 'true': 'false';
			break;

		case 'double':
			$reslut = $arg;
			break;

		case 'string':
			$reslut = '"'.Encode($arg).'"';
			break;

		case 'array':
		//	$reslut = '['._args($arg).']';
			$reslut = 'array';
			break;

		case 'object':
			$reslut = 'object';

			/*
			$name = get_class($arg);
			$prop  = [];
			foreach( $arg as $key => $val ){
				$prop[] = $key.'->'._arg($val);
			}
			$reslut = "{$name}{".join(', ',$prop)."}";
			*/

			break;

		default:
			$reslut = $type;
	}
	return $reslut;
}
