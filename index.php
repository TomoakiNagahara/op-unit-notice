<?php
/** op-unit-notice:/index.php
 *
 * @created   2018-04-13
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

 /** Declare strict
 *
 * @created   2022-11-01
 */
declare(strict_types=1);

/** namespace
 *
 * @created   2019-02-22
 */
namespace OP;

//	...
require_once(__DIR__.'/Notice.class.php');

//	...
if( Env::isHttp() ){
//	...
register_shutdown_function(function(){
	//	...
	if( Env::isAdmin() ){
		try{
			//	...
			Unit::Load('webpack');

			/* @var $webpack \OP\UNIT\WebPack */
			$webpack = Unit::Instantiate('Webpack');
			/*
			$webpack->Js (__DIR__.'/notice');
			*/
			$webpack->Js (__DIR__.'/notice2');
			$webpack->Js (__DIR__.'/notice2console');
			$webpack->Js (__DIR__.'/notice2desktop');
			$webpack->Js (__DIR__.'/notice2footer');
			$webpack->Css(__DIR__.'/notice');
			$webpack->Js (__DIR__.'/notice_window');
			$webpack->Js (__DIR__.'/notice_footer');
		//	$webpack->Js (__DIR__.'/notice_console');

		}catch( \Exception $e ){
			//	...
			echo $e->getMessage();

			//	...
			echo '<script>';
			include(__DIR__.'/notice.js');
			echo '</script>';

			//	...
			echo '<style>';
			include(__DIR__.'/notice.css');
			echo '</style>';
		};
	};
});
} // if( Env::isHttp() )
