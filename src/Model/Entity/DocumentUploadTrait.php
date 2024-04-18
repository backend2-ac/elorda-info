<?php

namespace App\Model\Entity;

trait DocumentUploadTrait{

    public function uploadDocumentFunc($file, $folder = 'docs'){
        return $this->_customUploadDoc($file, $folder);
    }

    protected function _customUploadDoc($file = array(), $folder){
        if( is_array($file) || is_object($file) ){
            $fileName = $file->getClientFilename();
            // $oldPath = WWW_ROOT . 'files'.DS.$folder.DS. $fileName;

            // if(file_exists($oldPath)){
            // 	return $fileName;
            // }

            // $ext = strtolower(preg_replace("#.+\.([a-z]+)$#", "$1", $fileName));
            // $fileName = $this->_genNameFileDoc($ext, $folder);
            $path = WWW_ROOT . 'files'.DS.$folder.DS. $fileName;
            $file_move = $file->moveTo($path);
            return $fileName;

        } elseif( is_string($file) ){
            return $file;
        } else{
            return false;
        }
    }
    // protected function _genNameFileDoc($ext, $folder){
    // 	$name = md5(microtime()) . ".{$ext}";
    // 	if(is_file(WWW_ROOT . 'files'.DS.$folder.DS. $name)){
    // 		$name = $this->_genNameFileDoc($ext, $folder);
    // 	}
    // 	return $name;
    // }
}

?>
