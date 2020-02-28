<?php
$handle = fopen("message.html", 'w+');
$data = $_POST['id'];
if($handle)
{
fwrite($handle, $data )
echo "ok";
}

?>