<?php

/*
    if( session_status() !== PHP_SESSION_ACTIVE ){
        session_start();
    }

    require_once 'connection.php';

    
    if( isset($_POST['admin']) && $_POST['admin']=="true" && isset($_SESSION['user']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true && isset($_SESSION['token'])  ){

        $headers = getallheaders();


        if( isset($headers['token']) && $_SESSION['token'] == $headers['token'] ){

            if( isset($_POST['fetchQ']) ){
                echo $_POST['fetchQ'];
            }
            else{
                echo "Empty";
            }
        }
        else{
            echo "Error 1";
        }
    }
    else{
        echo "Error 2";
    }
*/

    //$obj = json_decode(base64_decode($_POST['fetchQ']));
    //print_r($obj);


    //if( session_start() !== PHP_SESSION_ACTIVE ){
       // session_start();
    //}


    require_once 'connection.php';


    class fetchData extends DBConnection {

        protected $credTable;

        public function __construct(){

            parent::__construct();
            $this->credTable = userCred;
        }

        public function fetch(){

            $obj = json_decode(base64_decode($_POST['fetchQ']));

            try{

                $con = &$this->getCon();


                if( $con->connect_error ){
                    throw new Exception("Error : Failed to connect to database");
                }
                else{

                    $cmd = $this->getQuery($obj);

                    try{

                        $result = $con->query($cmd);
                        
                        if( !$result ){
                            throw new Exception("Error : Unable to retrieve data from database");
                        }
                        else{

                            //$responses = &$this->getResponse(mysqli_fetch_array($result), $obj);
                            $data = array();
                            $i=0;

                            while( $responses = mysqli_fetch_array($result) ){

                                $temp = array();

                                $temp['dept'] = $responses['dept'];
                                $temp['sYear'] = $responses['sYear'];
                                $temp['rollno'] = $responses['rollno'];
                                $temp['fname'] = $responses['fname'];

                                $data[$i++] = $temp;
                            }                            

                            echo base64_encode(json_encode($data));

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

        public function getQuery($obj){

            $cmd = "SELECT dept, sYear, rollno, fname FROM $this->credTable WHERE ";

            foreach( $obj as $key => $value ){

                if( $key == 'dept' && $value!="" ){
                    $cmd .= "dept='".$value."' AND ";
                }
                else if( $key == "year" && $value!="" ){
                    $cmd .= "sYear='".$value."' AND ";
                }
                else if( $key == "roll" && $value!="" ){
                    $cmd .= "rollno LIKE '%".$value."' AND ";
                }
                else if( $key == "name" && $value!="" ){
                    $cmd .= "fname LIKE '%".$value."%' AND ";
                }
                else if( $key == "degree" && $value!="" ){
                    $cmd .= "degree LIKE '%".$value."%' AND ";
                }
            }

            $cmd = substr(trim($cmd), 0, -3);
            $cmd .= " ;";

            return $cmd;
        }

    };

    if( isset($_POST['fetchQ']) ){
        $fetch = new fetchData();
        $fetch->fetch();
    }
?>