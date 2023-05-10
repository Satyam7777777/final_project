<?php

    function getFileType($file){
        $parsed = explode("/", $file['type']);
        return $parsed[1];
    }

    function validImage($str){
        
        if( $str=="jpg" || $str=="png" || $str=="gif" || $str=="jpeg" ){
            return true;
        }
        return false;
    }

    function recvFile(){

        $file = $_FILES['file'];
        $extension = getFileType($file);
        $name = bin2hex(random_bytes(16)).'.'.$extension;
        $location = "upload/".$name;
            
        if( !validImage($extension) || $file['size'] > 2097152 ){
            http_response_code(608);
            exit;
        }

        if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
            
            http_response_code(200);
            exit;
        }
        else { 
            http_response_code(609);
            exit;
        }
    }
    

    function processRegistration(){

        $data = json_decode(base64_decode($_POST['registration']));

        print_r($data);

    }



    if( isset($_FILES['file']) ){
        recvFile();
    }
    else if( isset( $_POST['registration'] ) ){
        processRegistration();
    }

?>