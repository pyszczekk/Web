<?php

session_write_close();
ignore_user_abort(false);
set_time_limit(40);

try {
	if(!empty($_GET['nick'])){
		$filename="messages.txt";
	$file = file($filename); 
	$LIMIT=10;
	$nick = $_GET['nick'];
	$mes=$_GET['mes'];
	$count=count($file);
	if($count == $LIMIT) { 
	  $out="";
	  for($i=1;$i<$LIMIT;$i++){
	  		$out .= $file[$i];  
	  }

		  $f = fopen($filename, "w");  
		 if(flock($f,LOCK_EX)){
			 fwrite($f, $out); 
			 flock($f,LOCK_UN);
			 fclose($f);
		}else{
			echo 'blaaad';
		}
}
	
 $f = fopen('messages.txt','r+'); 
	$stareDane = fread($f, filesize("messages.txt"));

	$data = "\n".$nick.": ".$mes;
	fputs($f,$data);
	fclose($f);

}
	if (!isset($_COOKIE['lastUpdate'])) {
		setcookie('lastUpdate', 0);
		$_COOKIE['lastUpdate'] = 0;
	}

	$lastUpdate = $_COOKIE['lastUpdate'];
	$file = 'messages.txt';

	if (!file_exists($file)) {
		throw new Exception('messages.txt Does not exist');
	}

	while (true) {

		$fileModifyTime = filemtime($file);

		if ($fileModifyTime === false) {
			throw new Exception('Could not read last modification time');
		}

		if ($fileModifyTime > $lastUpdate) {
			setcookie('lastUpdate', $fileModifyTime);

			$fileRead = file_get_contents($file);

			exit(json_encode([
				'status' => true,
				'time' => $fileModifyTime, 
				'content' => $fileRead
			]));

		}
		clearstatcache();

		sleep(1);
		
	}

} catch (Exception $e) {

	exit(
		json_encode(
			array (
				'status' => false,
				'error' => $e -> getMessage()
			)
		)
	);

}
