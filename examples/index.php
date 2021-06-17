<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require './vendor/autoload.php';
$file = new \furkanmeclis\FileUploader();
$file->init([
        "upload_path" => __DIR__ . '/uploads'
        ]);

if($_FILES){
    print_r($file->upload('file'));
}else{ ?>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">gönder</button>
</form>
<?php }