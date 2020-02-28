<?php
function redirect($url, $statusCode=303)
{
    header('Location: '.$url,true,$statusCode);
    die();
}
define(KLUCZ, 123456);

$blog_root='./blogs/';
if($_SERVER['REQUEST_METHOD']=='POST'){

            $blog_name=trim($_POST['blog_name']);
            $username=trim($_POST['username']);
            $password=md5(trim($_POST['password']));
            $desc=trim($_POST['description']);
            $sem = sem_get(KLUCZ);
     if(!$sem){
        redirect('./FileCantBeOpen.php');
            exit();
     } 
if(sem_acquire($sem)){
    if(!file_exists($blog_root.$blog_name)){
        mkdir($blog_root.$blog_name,0755);
        $file = fopen($blog_root.$blog_name.'/info.txt','w');
        if(flock($file,LOCK_EX)){
            fwrite($file, $username."\n");
            fwrite($file, $password."\n");
            fwrite($file, $desc);
            flock($file,LOCK_UN);
            fclose($file);
        }
        else{
            redirect('./FileCantBeOpen.php');
        }
        redirect ('./CreatedBlog.php');
    }
    else{
        redirect ('./BlogExist.php');
    }
}
sem_release($sem);
}
else{
    redirect ('./CreateBlog.php');
}


?>