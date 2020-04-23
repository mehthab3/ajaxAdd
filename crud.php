<?php  
 class Crud  
	  {  
		        public $connect;  
			      private $host = 'localhost';  
			      private $username = 'root';   //db username
			            private $password = 'ubuntu';  //db password
			            private     $database = 'crud';   //db name
				          function __construct()  
						        {  
								$this->database_connect();  
								}  
				          public function database_connect()  
						        {  
								$this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);  
								}  
				          public function execute_query($query)  
						        {  
								return mysqli_query($this->connect, $query);  
								}  
				          public function get_data_in_table($query)  
						        {  
									$output = '';  
									$result = $this->execute_query($query);
									$output .= '  
									<table class="table table-bordered table-striped">  
									<tr>  
								  	<th width="35%">First Name</th> 
									<th width="35%">Last Name</th> 
									<th width="35%">DOB</th> 
									<th width="35%">Email</th> 
									<th width="35%">Phone</th> 
									<th width="35%">Sex</th>  
									<th width="10%">Update</th>  
									<th width="10%">Delete</th>
									</tr>';  
           				while($row = mysqli_fetch_object($result))  
				              {  
								$output .= '  
								<tr>  
								<td>'.$row->first_name.'</td>  
								<td>'.$row->last_name.'</td>
								<td>'.$row->dob.'</td>
								<td>'.$row->email.'</td>  
								<td>'.$row->phone.'</td>
								<td>'.$row->sex.'</td>
								<td><button type="button" name="update" id="'.$row->id.'" class="btn btn-success btn-xs update">Update</button></td>  
								<td><button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs delete" >Delete</button></td>  
								</tr> ';  
           						}  
           					$output .= '</table>'; 
	              			return $output;  
	         				}    
		    }  
 ?>
