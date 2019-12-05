<?php
/**
 * unit-notice:/Notice.class.php
 *
 * @created   2016-11-17
 * @version   1.0
 * @package   unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2018-04-18
 */
namespace OP\UNIT;

/** Used class
 *
 */
use OP\Env;
use function OP\Decode;
use function OP\CompressPath;

/** Notice
 *
 * @created   2016-11-17
 * @version   1.0
 * @package   core
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Notice implements \OP\IF_UNIT
{
	/** trait.
	 *
	 */
	use \OP\OP_CORE, \OP\OP_UNIT;

	/** Callback of app shutdown.
	 *
	 */
	function Auto()
	{
		//	...
		while( $notice = \OP\Notice::Get() ){
			//	...
			if( Env::isAdmin() ){
				$this->Dump($notice);
			}else{
				$this->Mail($notice);
			};
		};
	}

	/** Display to dump of notice.
	 *
	 * @param array $notice
	 */
	static function Dump( $notice )
	{
		//	...
		switch( Env::Mime() ?? 'text/html' ){
			case 'text/html':
				//	Escape is done with self::Shutdown().
				//	$notice = Escape($notice);
				\OP\Json($notice, 'OP_NOTICE');
				break;

			case 'text/css':
				echo "/* {$notice['message']} */".PHP_EOL;
				break;

			case 'text/javascript':
				/*
				printf("console.error('%s');\n", str_replace("'", "\'", \OP\Decode($notice['message'].', '.$notice['backtrace'][0]['file'].' #'.$notice['backtrace'][0]['line'])));
				*/

				//	...
				if(!$file = $notice['backtrace'][0]['file'] ?? null ){
					$file = $notice['backtrace'][1]['file'] ?? null;
				};

				//	...
				if(!$line = $notice['backtrace'][0]['line'] ?? null ){
					$line = $notice['backtrace'][1]['line'] ?? null;
				};

				//	...
				$file = CompressPath($file);

				//	...
				$message = Decode($notice['message']);
				$message = str_replace("'", "\'",$message);
				$message = str_replace('"', '\"',$message);

				//	...
				echo "console.error('{$file} #{$line} {$message}');".PHP_EOL;
				break;

			default:
				echo PHP_EOL.$notice['message'].PHP_EOL;
				print_r($notice);
		}
	}

	/** Send email of notice.
	 *
	 * @param array $notice
	 */
	function Mail( $notice )
	{
		static $to, $from, $file_path;

		//	...
		if( !$to ){

			//	...
			if(!$to = Env::Get(Env::_ADMIN_MAIL_) ){
				echo '<p class="error">Has not been set admin mail address.</p>'.PHP_EOL;
				return;
			}

			//	...
			if(!$from = Env::Get(Env::_MAIL_FROM_) ){
				$from = $to;
			}

			//	...
			$file_path = __DIR__.'/mail/notice.phtml';

			//	...
			if( file_exists($file_path) === false ){
				print "<p class=\"error\">Does not file exists. ($file_path)</p>";
				return;
			}
		}

		//	...
		if(!ob_start()){
			echo '<p>"ob_start" was failed. (Notice::Shutdown)</p>'.PHP_EOL;
			return;
		}

		//	...
		include($file_path);

		//	...
		$content = ob_get_clean();

		//	...
		$subject = Decode($notice['message']);

		//	...
		$mail = new \OP\EMail();
		$mail->From($from);
		$mail->To($to);
		$mail->Subject($subject);
		$mail->Content($content, 'text/html');
		$mail->Send();
	}
}
