<?php
namespace furkanmeclis;
class FileUploader{

    public $file = [];
    public $config = [];
    public $errors = array( 
        0 => 'Hata yok, dosya başarıyla yüklendi',
        1 => "Yüklenen dosya php.ini'deki upload_max_filesize yönergesini aşıyor",
        2 => 'Yüklenen dosya, HTML formunda belirtilen MAX_FILE_SIZE yönergesini aşıyor',
        3 => 'Yüklenen dosya yalnızca kısmen yüklendi',
        4 => 'Dosya yüklenmedi',
        6 => 'Geçici klasör eksik',
        7 => 'Dosya diske yazılamadı.',
        8 => 'Bir PHP uzantısı dosya yüklemesini durdurdu.',
    );
    public function init($config){
        $this->config = $config;
    }
    public function upload($filekey,$filename = null){

        $filedata = $_FILES[$filekey];

            $config = $this->config;
            if(isset($config["encrypt_name"])){
                if( $config["encrypt_name"] == true || $config["encrypt_name"] == "true"){
                    $this->file["file_name"] = sha1(md5((rand(0,9999999)+time())));
                }else{
                    $this->file["file_name"] = $filedata["name"];
                }
            }

            if(is_uploaded_file($_FILES[$filekey]["tmp_name"])){
                $fileinfo = pathinfo($_FILES[$filekey]["name"]);
                if(isset($filename)){
                    $this->file["file_name"] = $filename;
                }else{
                    $this->file["file_name"] = $fileinfo["filename"];
                }
                $this->file["orig_name"] = $fileinfo["basename"];
                $this->file["raw_name"] = $fileinfo["filename"];
                $this->file["file_ext"] = '.'.$fileinfo["extension"];
                $this->file['file_type'] = $filedata["type"];
                $this->file['file_size'] = $filedata["size"];
                $this->file["file_name"] = $this->file["file_name"] . $this->file["file_ext"];
                $path = isset($this->config["upload_path"]) ? $this->config["upload_path"] : __DIR__;
                $pathe = $path.'/'.$this->file["file_name"];
                if(!file_exists($pathe)){
                    if(move_uploaded_file($_FILES[$filekey]["tmp_name"],$pathe)){
                        $this->file["file_path"] = $path;
                        $this->file["full_path"] = $pathe;
                        $this->file["message"] = $this->errors[$_FILES[$filekey]["error"]];
                        return $this->file;
                    }else{
                        throw new Error('"'.$this->errors[$_FILES[$filekey]["error"]].'"');
                    }
                }else{
                    throw new Error('"'.$this->file["file_name"].' Adında dosya zaten mevcut."');
                }
            }else{
                throw new Error('"'.$this->errors[$_FILES[$filekey]["error"]].'"');
            }

    }
}