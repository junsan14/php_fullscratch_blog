<?php

	error_reporting(E_ALL);
	ini_set('log_errors','on');
	ini_set('error_log','php.log');
	

	$debug_flag =true;
	$error_msg = array();

function debug($str){
	global $debug_flag;
	if($debug_flag){
		error_log('デバッグ:'.$str);
	}
}
function debug_log_start(){
		debug('----- 画面表示処理開始 -----');
		debug('セッションID：'.session_id());
		debug('セッション変数の中身:'.print_r($_SESSION,true));
		debug('現在日時タイムスタンプ'.time());
		if(!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])){
			debug('ログイン期限日時タイムスタンプ：'.($_SESSION['login_date'] + $_SESSION['login_limit']));

		}

	}

	session_save_path("/var/tmp/");
	ini_set('session.gc_maxlifetime',60*60*24*30);
	ini_set('session.cookie_lifetime',60*60*24*30);
	session_start();
	session_regenerate_id();

	define('ERROR00','エラーが発生しました、しばらく経ってから入力してください');
	define('ERROR01','入力必須です');
	define('ERROR02','4文字以上で入力してください');
	define('ERROR03','パスワードが一致しません');
	define('ERROR04','半角英数字で入力してください');
	define('ERROR05','ユーザーネームまたはパスワードが誤っています');
	define('ERROR06','Eメールの形式で入力してください');

	function validRequired($str, $key){
		global $error_msg;
		if(empty($str)){
			$error_msg[$key] = ERROR01;
		}
	}

	function validMinletters($str,$key,$min){
		global $error_msg;
		if(mb_strlen($str) < $min){
			$error_msg[$key] = ERROR02;
		}
	}

	function validHalfNum($str,$key){
		global $error_msg;
		if(!preg_match("/^[a-zA-Z0-9]+$/", $str)){
			$error_msg[$key] = ERROR04;
		}
	}

	function validPassmatch($str,$str2,$key){
		global $error_msg;
		if($str !== $str2){
			$error_msg[$key] = ERROR03;
		}
	}

	function validEmail($str,$key){
		global $error_msg;
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $str)){
			$error_msg[$key] = ERROR06;
		}
	}

	function db_connect(){
		global $dbh;
		$db = ('mysql:dbname=homepage;host=localhost;charset=utf8');
		$user = 'root';
		$dbpass = 'root';



		$options = array(
                // SQL実行失敗時に例外をスロー
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // デフォルトフェッチモードを連想配列形式に設定
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
                // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            );
		$dbh = new pdo($db,$user,$dbpass,$options);
		return $dbh;
	}

	function sendEmail($from,$to,$suject,$content){

		mb_language('Japanese');
		mb_internal_encoding('UTF8');

		$result = mb_send_mail($to, $suject, $content, 'From:'.$from);

		if($result){
			debug('メールの送信に成功しました');
			$msg = 'メールの送信しました';
		}else{
			debug('メールの送信に失敗しました');
		}

	}



?>