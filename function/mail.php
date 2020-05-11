<?php
/**
 * unit-notice:/function/mail.php
 *
 * @created   2019-12-05
 * @version   1.0
 * @package   unit-notice
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2019-12-05
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
	//	...
	static $to, $from, $file_path;

	//	...
	if( !$to ){
		//	...
		$admin = Config::Get('admin');

		//	...
		$to   = $admin[Env::_ADMIN_MAIL_] ?? null;
		$from = $admin[Env::_MAIL_FROM_ ] ?? null;

		//	...
		if(!$to ){
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
