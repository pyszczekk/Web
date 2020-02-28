<?php
define(KLUCZ, 123456);
function redirect($url, $statusCode=303)
{
    header('Location: '.$url,true,$statusCode);
    die();
};

        $type=$_POST['type']."\n";
        $kom=$_POST['kom'];
        $name=$_POST['name']."\n";
        $post=$_POST['post'];
        $blog=$_POST['blog'];

$path = './blogs/'.$blog.'/'.$post.'.k';
$sem = sem_get(KLUCZ);
if(!$sem){
            redirect('./FileCantBeOpen.php');
            exit();
        }
 
if(sem_acquire($sem)) {
    $i=0;
    if (!file_exists($path)) {
        
            mkdir($path,0755);
           
        }
    while(file_exists($path.'/'.$i))
{
    $i++;
}
    $plik = fopen($path.'/'.$i,'w');
    if(flock($plik,LOCK_EX)) {
        fwrite($plik, $type);
        fwrite($plik, date('Y-m-d, H:i:s')."\n");
        fwrite($plik, $name);
        fwrite($plik, $kom);
        flock($plik,LOCK_UN);
        fclose($plik);

        redirect('./blog.php?nazwa='.$blog);

    } else
        {
            redirect('./FileCantBeOpen.php');
        }
    }

 sem_release($sem);
?>
