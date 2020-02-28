<?php require 'header.php' ?>
<?php 

function redirect($url, $statusCode=303)
{
    header('Location: '.$url,true,$statusCode);
    die();
}
if(empty($_GET['nazwa']))
{
    redirect('./all.php');
}
elseif (file_exists('./blogs/'.$_GET['nazwa']))
{
 echo "<h1> ".$_GET['nazwa']."</h1>";
 $info= fopen('./blogs/'.$_GET['nazwa'].'/info.txt', 'r');
 $user = fgets($info);
 $pass = fgets($info);
 echo "<p class='desc'>";
while (($data = fgets($info))!==false)
                {
                    echo $data."<br/>";
                }
 echo "</p>";
foreach (new DirectoryIterator('./blogs/'.$_GET['nazwa']) as $post) {
    if ($post->isDot() || substr($post,-2,2)=='.k' || basename($post)=='info.txt' || strlen(basename($post))!=16) continue;
        else
            {
                echo "<h2 class='poscik'> $post </h2>";
                $file = fopen('./blogs/'.$_GET['nazwa'].'/'.$post,'r');
                echo "<p class='post'>";
                while (($data = fgets($file))!==false)
                {
                    echo $data."<br/>";
                }
                echo "</p>";
                foreach (new DirectoryIterator('./blogs/'.$_GET['nazwa']) as $uFile)
                {
                    if(substr(basename($uFile),0,16)==basename($post) && substr(basename($uFile),-2,2)!='.k' && basename($uFile)!=basename($post))
                {
                    
                  echo  " <a class='files' href=./blogs/".$_GET['nazwa']."/$uFile>$uFile</a><br/>";
                    
                }
                }
                fclose($file);

                echo "<a class='addkom' href=./AddComment.php?post=$post&blog=".$_GET['nazwa']."> Dodaj komentarz</a>";
                echo "<h3> Komentarze </h3>";
                
                if(file_exists('./blogs/'.$_GET['nazwa'].'/'.$post.'.k')) {
                    foreach (new DirectoryIterator('./blogs/'.$_GET['nazwa'].'/'.$post.'.k') as $kom) {
                        if ($kom->isDot()) continue;
                        else {
                            $file = fopen($kom->getPath().'/'.$kom,'r');
                            echo "<div class=".fgets($file).">";
                            $i=0;
                            while (($data = fgets($file))!==false)
                            {
                            	if($i==0){
                                echo "<p class='date'>$data</p>";
                            	}
                            	else if($i==1){
                            		echo "<p class='nick'>$data</p>";
                            	}else{
                            		echo "<p>$data</p>";
                            	}
                            	$i++;
                            }
                            echo '</div><br/>';
                            fclose($file);
                        }
                    }
                }
            }
}
}
else
{
    echo "<h1>blog nie isnieje</h1>";
}
?>
<?php require 'footer.php'?>