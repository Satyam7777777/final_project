<?php
    require_once 'AlumniPortalXLSX.php';
	require_once 'connection.php';

	function getName($n) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
	 
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
 
		return $randomString;
	}

	
	class fetchDataForXLSX extends DBConnection {

        protected $credTable1;
		protected $credTable2;

        public function __construct(){

            parent::__construct();
            $this->credTable1 = userCred;
			$this->credTable2 = userAdres;
        }

        public function fetch($obj){

            //$obj = json_decode(base64_decode($_POST['fetchQ']));

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
							
							$head = ['Roll No.', 'Name', 'Department', 'Batch', 'Pincode', 'Address Line 1', 'Address Line 2', 'Social Link 1', 'Social Link 2', 'Email', 'Alternate Email', 'Phone', 'Alternate Phone', 'Parent Phone', 'City', 'Current State'];
							
							$data[$i++] = $head;
							
							

                            while( $responses = mysqli_fetch_array($result) ){
								
								$name = $responses['fname'].' ';
								if( $responses['mname'] == "" ){
									$name .= $responses['lname'];
								}
								else{
									$name .= $responses['mname'].' '.$responses['lname'];
								}
								
								$temp = [ $responses['rollno'], $name, $responses['dept'], $responses['sYear'].'-'.$responses['eYear'], $responses['pincode'], $responses['addressline1'], $responses['addressline2'], $responses['sociallink1'], $responses['sociallink2'], $responses['email'], $responses['email2'], $responses['phone1'], $responses['phon2'], $responses['parentphone'], $responses['city'], $responses['curstate'] ];
								
								$data[$i++] = $temp;
                            }                            
							
							echo "Size :".$i;
							
                            return $data;
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
		
		public function getQuery($data){

            $cmd = "SELECT * FROM $this->credTable1 AS table1, $this->credTable2 AS table2 WHERE (table1.rollno=table2.rollno) AND (";
			
            foreach( $data as $value ){
				$cmd .= "table1.rollno='".$value."' OR ";
            }

			$cmd = substr(trim($cmd), 0, -3);
            $cmd .= " );";

            return $cmd;
        }
	}
	
	

    // $books = [
        // ['ISBN', 'title', 'author', 'publisher', 'ctry' ],
        // [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
        // [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
    // ];
    
	
	
	function generateXLSX($data){
		
		
		$fetch = new fetchDataForXLSX();
		
		
		
		$fileName = "AlumniStudentDetails_".getName(12).".xlsx";
		
		//$fetch->fetch($data);
		
		$xlsx = AlumniPortalXLSX::fromArray( $fetch->fetch($data)  );
		$xlsx->saveAs($fileName); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 
		
		$xlsx->downloadAs($fileName);
		unlink($fileName);
	}	
	
?>