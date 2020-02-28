<?php require 'header.php'; ?>
<h1>Wszystkie blogi:</h1>

<?php
foreach (new DirectoryIterator('./blogs') as $blog)
{
    if($blog->isDot()) continue;
    if($blog=='.DS_Store') continue;
    else
    {
     echo  "<h2><a href=./blog.php?nazwa=$blog> $blog <small>kliknij aby zobaczyć bloga</small></a></h2>";
    }
}

?>
<?php require 'footer.php'; ?>