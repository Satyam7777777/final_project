<?php

    if( session_status() !== PHP_SESSION_ACTIVE ){
      session_start();
    }

    require_once 'user/connection.php';

    // ------------------------

    class updateData extends DBConnection {

        protected $credTable1;
        protected $credTable2;

        public function __construct(){

            parent::__construct();
            $this->credTable1 = userCred;
            $this->credTable2 = userAdres;
        }

        public function update($data){

            try{

                $con = &$this->getCon($data);

                if( !isset($_SESSION['imgname']) ){
                    echo "No Image found";
                    return false;
                }


                if( $con->connect_error ){
                    throw new Exception("Error : Failed to connect to database");
                }
                else{

                    $cmd1 = "INSERT INTO $this->credTable1 (rollno, fname, mname, lname, dept, degree, sYear, eYear, profile) VALUES ( '".$data->rollno."', '".$data->fname."','".$data->mname."', '".$data->lname."', '".$data->department."', '".$data->degree."' , '".$data->syear."', '".$data->eyear."', '".$_SESSION['imgname']."');";
                    $cmd2 = "INSERT INTO $this->credTable2 (rollno, pincode, addressline1, addressline2, sociallink1, sociallink2, email, email2, phone1, phone2, parentphone, city, curstate, employedetail) VALUES ( '".$data->rollno."', '".$data->pincode."', '".$data->address1."', '".$data->address2."', '".$data->sociallink1."', '".$data->sociallink2."', '".$data->email1."', '".$data->email2."', '".$data->phoneno1."', '".$data->phoneno2."', '".$data->parentphoneno."', '".$data->currentcity."', '".$data->currentstate."', '".$data->employment."' );";

                    try{

                        $result1 = $con->query($cmd1);
                        $result2 = $con->query($cmd2);
                        
                        if( !$result1 || !$result2 ){
                            echo "Error : Database command error";
                            throw new Exception("Error : Failed to access database");
                        }
                        else{

                            echo "success";
                            return true;
                        }
                    }
                    catch(Exception $e){
                        echo $e;
                        return true;
                    }
                }

            }
            catch(Exception $e){
                echo $e;
                return false;
            }            
        }
    }


    // ------------------------

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

            $_SESSION['imgname'] = $name;
            echo "Image Set";

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
        $con = new updateData();
        $con->update($data);
    }



    if( isset($_FILES['file']) ){
        recvFile();
    }
    else if( isset( $_POST['registration'] ) ){
        processRegistration();
    }

?>
