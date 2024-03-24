<?php

namespace App\Model\Entity;

trait ImageUploadTrait{

    public function uploadImageFunc($file, $folder = null, $max_w = 2000, $max_h = 2000, $th_w = 300, $th_h = 300 ){

        if( is_string($file) ){
            if( mb_substr($file, 0, 4) == 'data' && mb_strlen($file) > 255 ){
                $clean_base_code = stristr($file, 'base64,');
                $str_index = stripos($file, 'image/') + 6;
                $img_ext = str_replace(';', '', mb_substr($file, $str_index, 4));

                $ext = 'png';
                switch($img_ext){
                    case("jpeg"):
                    case("jpg"):
                    case("png"):
                    case("gif"):
                    case("webp"): // Добавляем поддержку WebP
                        $ext = $img_ext;
                        break;
                    default:
                        $ext = 'png';
                }

                return $this->_baseImgDecode( mb_substr($clean_base_code, 7), $folder, $max_w, $max_h, $th_w, $th_h, $ext );
            } else{
                return $this->_customUploadImg($file, $folder, $max_w, $max_h, $th_w, $th_h);
            }

        } else{
            $mimeType = $file->getClientMediaType();
            switch($mimeType){
                case("image/jpeg"):
                case("image/jpg"):
                case("image/png"):
                case("image/gif"):
                case("image/webp"): // Добавляем поддержку WebP
                return $this->_customUploadImg($file, $folder, $max_w, $max_h, $th_w, $th_h);
                    break;
                default:
                    return false;
            }
        }
    }

    protected function _customUploadImg($file = array(), $folder, $max_w, $max_h, $th_w, $th_h){
        if( is_array($file) || is_object($file) ){

            if($folder){
                $fileName = $file->getClientFilename();
                $oldPath = WWW_ROOT.'img'.DS.$folder.DS.$fileName;
                $oldPathThumb = WWW_ROOT.'img'.DS.$folder.DS.'thumbs'.DS.$fileName;

                if (file_exists($oldPath)){
                    if( file_exists($oldPathThumb) ){
                        return $fileName;
                    } else {
                        return false;
                    }
                }

                $ext = strtolower(preg_replace("#.+\.([a-z]+)$#", "$1", $fileName));
                $fileName = $this->_genNameFile($ext, $folder);

                $path = WWW_ROOT . 'img'.DS.$folder .DS. $fileName;
                $path_th = WWW_ROOT . 'img'.DS.$folder.DS.'thumbs'.DS. $fileName;
                $path_orig = WWW_ROOT . 'img'.DS.$folder.DS.'original_'. $fileName;;
                $file_move = $file->moveTo($path_orig);
                $this->_resizeImg($path_orig, $path_th, $th_w, $th_h, $ext);
                $this->_resizeImg($path_orig, $path, $max_w, $max_h, $ext);

                unlink($path_orig);
                return $fileName;
            } else{
                return false;
            }

        } elseif( is_string($file) ){
            return $file;
        } else{
            return false;
        }
    }
    protected function _genNameFile($ext, $folder){
        $name = md5(microtime()) . ".{$ext}";
        if(is_file(WWW_ROOT . 'img'.DS.$folder.DS. $name)){
            $name = $this->_genNameFile($ext, $folder);
        }
        return $name;
    }
    protected function _resizeImg($target, $dest, $wmax = 300, $hmax = 300, $ext){
        /*
        $target - путь к оригинальному файлу
        $dest - путь сохранения обработанного файла
        $wmax - максимальная ширина
        $hmax - максимальная высота
        $ext - расширение файла
        */
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            case("webp"): // Добавляем обработку WebP
                $img = imagecreatefromwebp($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }

        if( $w_orig > $wmax || $h_orig > $hmax ){ // если размер изображения превышает максимально допустимый
            $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

            if($ext == "png"){
                imagesavealpha($newImg, true); // сохранение альфа канала
                $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
                imagefill($newImg, 0, 0, $transPng); // заливка
            }

            imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение

        } else{
            if($ext == "png"){
                imagesavealpha($img, true); // сохранение альфа канала
                $transPng = imagecolorallocatealpha($img,0,0,0,127); // добавляем прозрачность
                imagefill($img, 0, 0, $transPng); // заливка
            }
        }

        if( isset($newImg) && $newImg ){
            $img_create = $newImg;
        } else{
            $img_create = $img;
        }

        switch($ext){
            case("gif"):
                imagegif($img_create, $dest);
                break;
            case("png"):
                imagepng($img_create, $dest);
                break;
            case("webp"): // Добавляем сохранение в WebP
                imagewebp($img_create, $dest);
                break;
            default:
                imagejpeg($img_create, $dest);
        }
        imagedestroy($img_create);
    }

    protected function _baseImgDecode($base_img, $folder, $max_w, $max_h, $th_w, $th_h, $ext){
        $item_img = base64_decode($base_img);
        $fileName = md5(microtime()) . ".".$ext;
        $path_original = WWW_ROOT . 'img'.DS.$folder.DS.$fileName;
//        file_put_contents($path_original, $item_img);

        $path_th = WWW_ROOT . 'img'.DS.$folder.DS.'thumbs'.DS. $fileName;
//        $this->_resizeImg($path_original, $path_th, $th_w, $th_h, $ext);
        // Добавляем обработку и сохранение WebP
        if ($ext == "webp") {
            file_put_contents($path_original, $item_img);
        } else {
            // Сохраняем в других форматах как обычно
            $this->_resizeImg($path_original, $path_th, $th_w, $th_h, $ext);
        }
        return $fileName;
    }
}

?>
