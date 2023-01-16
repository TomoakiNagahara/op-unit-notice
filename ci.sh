
 ## op-unit-notice:/ci.sh
 #
 # Call from git pre-push
 #
 # @created   2022-11-14
 # @version   1.0
 # @package   op-unit-notice
 # @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright Tomoaki Nagahara All right reserved.

rm .ci_commit_id_*
php ../../../ci.php $@
