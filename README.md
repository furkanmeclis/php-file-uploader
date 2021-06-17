# php-file-uploader
 
### Yükleme
- Composer İle Yükleme

    ```bash
    composer require furkanmeclis/file-uploader
    ```
- Manuel Olarak yükleme

     `src/File.php` Dosyasını indirerek projenize dahil edebilirsiniz.
### Örnek Kullanım 
 ```php
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
?>
 ```
 ### Fonksiyonlar
 - `init($config)`
    - `$config`: Bir Array alır
    - Örnek Array
      ```php
       $config = [
         "upload_path" => __DIR__."/uploads", // Dosyanın yükleneceği klasörü belirtir
         "encrypt_name" => true // Dosya isminin şifreleneceğini belirtir
       ];
      ```
- `upload($filekey,$filename = null)`
   - `$filekey`: Dosyanın seçildiği inputun ismi
   - `$filename`: Dosyanın adını değiştirmek isterseniz parametre olarak gönderin
   - return : `array`
     ```php
     $return = [
        "file_name"     => "mypic.jpg",
        "file_type"     => "image/jpeg",
        "file_path"     => "/path/to/your/upload/",
        "full_path"     => "/path/to/your/upload/jpg.jpg",
        "raw_name"      => "mypic",
        "orig_name"     => "mypic.jpg",
        "file_ext"      => ".jpg",
        "file_size"     => "222"
     ];
     ```     
    
