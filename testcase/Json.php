<?php
/** op-unit-notice:/testcase/Json.php
 *
 * @created    2023-04-02
 * @version    1.0
 * @package    op-unit-notice
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

//  ...
$json = OP::Request('json');

?>
<p>Please enter the JSON string and submit.</p>
<form method="post">
    <textarea name="json" style="width:100%; height: 10em"><?= $json ?></textarea>
    <button> Submit </button>
</form>
<?php
//  ...
if(!$json ){
    return;
}

//  ...
$json = json_decode( OP::Decode($json), true);

//  ...
D($json);
