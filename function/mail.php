<?php
/** op-unit-notice:/function/mail.php
 *
 * @created   2019-12-05
 * @version   1.0
 * @package   op-unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP\UNIT\NOTICE\FUNCTIONS;

/** use
 *
 */
use OP\Env;
use OP\Config;
use OP\EMail;
use function OP\Json;
use function OP\Decode;
use function OP\CompressPath;

/** Send email of notice.
 *
 * @param array $notice
 */
function Mail( $notice )
{
	//	Static values.
	static $to, $from, $file_path;

	//	Get hash value.
	$hash = md5($notice['message']);
	$hash = substr($hash, 0, 10);

	//	Check if already sent.
	if( function_exists('apcu_exists') ){
		if( apcu_exists($hash) ){
			//	Exists if already sent.
			return;
		}
	}

	//	...
	if( !$to ){
		//	...
		$admin = Config::Get('admin');

		//	...
		$to   = $admin[Env::_ADMIN_MAIL_] ?? null;
		$from = $admin[Env::_MAIL_FROM_ ] ?? null;

		//	...
		if(!$to ){
			include(__DIR__.'/../../bootstrap/app/config-admin.phtml');
			echo '<p class="error">Has not been set admin mail address.</p>'.PHP_EOL;
			return;
		}

		//	...
		if(!$from ){
			$from = EMail::GetLocalAddress();
		}

		//	...
		$file_path = __DIR__.'/../mail/notice.phtml';

		//	...
		if( file_exists($file_path) === false ){
			print "<p class=\"error\">Does not file exists. ($file_path)</p>";
			return;
		}
	}

	//	...
	if(!$content = include($file_path) ){
		return;
	}

	//	Get message.
	$subject = Decode($notice['message']);

	//	...
	$mail = new \OP\EMail();
	$mail->From($from);
	$mail->To($to);
	$mail->Subject($subject);
	$mail->Content($content, 'text/html');
	$mail->Send();

	//	Avoid sent the same email.
	if( function_exists('apcu_add') ){
		$ttl = 60 * 60 * 24;
		apcu_add($hash, $subject, $ttl);
	}
}
