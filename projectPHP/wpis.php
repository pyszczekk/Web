<?php
define(KLUCZ, 123456);
function redirect($url, $statusCode=303)
{
    header('Location: '.$url,true,$statusCode);
    die();
}
$blogname = null;
$sem = sem_get(KLUCZ);
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=trim($_POST['username']);
    $password=md5(trim($_POST['password']));
    $post=$_POST['content'];
    $date=trim($_POST['date']);
    $hour=trim($_POST['hour']).':'.date('s',time());

    $files = scandir('./blogs');

    foreach(new DirectoryIterator('./blogs') as $file)
    {
        if($file->isDot()) continue;
        $plik = fopen('./blogs/'.$file.'/info.txt','r');
        $user = trim(fgets($plik));
        if($user==$username){
            $blogname = $file;
            break;
        }
        fclose($plik);
    }
    if(!isset($blogname)) {
        redirect('./AddPost.php?err=1');
    }
    $plik = fopen('./blogs/'.$blogname.'/info.txt','r');
    fgets($plik);
    $pass = trim(fgets($plik));

    if($pass!=$password){
        redirect('./AddPost.php?err=2');
    }
    fclose($plik);
    $number = 0;
    $nazwa = substr($date,0,4).substr($date,5,2).substr($date,8,2)
        .substr($hour,0,2).substr($hour,3,2).date('s',time()).str_pad($number,2,'0',STR_PAD_LEFT);

    if(!$sem){
        redirect('./FileCantBeOpen.php');
            exit();
    }
    if(sem_acquire($sem)){
    while(file_exists('./blogs/'.$blogname.'/'.$nazwa))
    {
        $number++;
        $nazwa = substr($nazwa,0,-1);
        $nazwa = $nazwa.str_pad($number,2,'0',STR_PAD_LEFT);
    }
    $plik = fopen('./blogs/'.$blogname.'/'.$nazwa,'w');
    if(flock($plik,LOCK_EX)) {
        fwrite($plik, $post);
        fclose($plik);
        flock($plik,LOCK_UN);
    }
    else{
        redirect('./FileCantBeOpen.php');
    }
    $files =
        [
          'tmp_name'=>$_FILES['files']['tmp_name'],
          'name'=>$_FILES['files']['name']
        ];

    for($i = 0;; $i++){
        if(is_uploaded_file($files['tmp_name'][$i]))
        {    $info= explode(".",$files['name'][$i]);
        
            move_uploaded_file($files['tmp_name'][$i],'./blogs/'.$blogname.'/'.$nazwa.($i+1).".".end($info));
        }else{
            break;
        }
    }
    redirect('./PostAdded.php');
    }
    sem_release($sem);
}
else {
    redirect('./AddPost.php');
}