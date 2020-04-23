<?php  
 include 'crud.php';  
 $object = new Crud();  
 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {  
           echo $object->get_data_in_table("SELECT * FROM users WHERE is_deleted <> 1 ORDER BY id DESC");
      }  
      if($_POST["action"] == "Insert")  
      {  
           $first_name = mysqli_real_escape_string($object->connect, $_POST["first_name"]);  
           $last_name = mysqli_real_escape_string($object->connect, $_POST["last_name"]);  
           $email = mysqli_real_escape_string($object->connect, $_POST["email"]);  
           $phone = mysqli_real_escape_string($object->connect, $_POST["phone"]);  
           $dob = mysqli_real_escape_string($object->connect, $_POST["dob"]);  
           $sex = mysqli_real_escape_string($object->connect, $_POST["sex"]); 
           $CreatedAt=date("Y-m-d"); 
           $UpdatedAt =date("Y-m-d");
           // print_r($CreatedAt);exit();
           $query = "  
           INSERT INTO users  
           (first_name, last_name,email,phone,dob,sex,CreatedAt,UpdatedAt)   
           VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$phone."', '".$dob."', '".$sex."', '".$CreatedAt."', '".$UpdatedAt."')"; 
           // print_r($query);exit(); 
           $success = $object->execute_query($query);
           if ($success) {
             echo 'Data inserted';       
           }
           else{
            echo "insert failed";
           }
           
      }  
      if($_POST["action"] == "Fetch Single Data")  
      {  
           $output = '';  
           $query = "SELECT * FROM users WHERE id = '".$_POST["user_id"]."'";  
           $result = $object->execute_query($query);
           // print_r($result);exit();  
           while($row = mysqli_fetch_array($result))  
           {  
                $output["first_name"] = $row['first_name'];  
                $output["last_name"] = $row['last_name']; 
                $output["email"] = $row['email'];  
                $output["phone"] = $row['phone']; 
                $output["dob"] = $row['dob'];  
                $output["sex"] = $row['sex']; 
                // print_r($output);exit();   
           }  
           echo json_encode($output);  
      }  
      if($_POST["action"] == "Edit")  
      {   
           $first_name = mysqli_real_escape_string($object->connect, $_POST["first_name"]);  
           $last_name = mysqli_real_escape_string($object->connect, $_POST["last_name"]); 
           $email = mysqli_real_escape_string($object->connect, $_POST["email"]);  
           $phone = mysqli_real_escape_string($object->connect, $_POST["phone"]); 
           $dob = mysqli_real_escape_string($object->connect, $_POST["dob"]);  
           $sex = mysqli_real_escape_string($object->connect, $_POST["sex"]);
            $UpdatedAt =date("Y-m-d");

           // print_r($_POST) ;exit();
           $query = "UPDATE users SET first_name = '".$first_name."', last_name = '".$last_name."' , email = '".$email."', phone = '".$phone."', dob = '".$dob."', sex = '".$sex."',UpdatedAt='".$UpdatedAt."' WHERE id = '".$_POST["user_id"]."'";  
           $object->execute_query($query);  
           echo 'Data Updated';  
      } 

      if($_POST["action"] == "delete")  
      {   
        $id = mysqli_real_escape_string($object->connect, $_POST["user_id"]); 
        $query = "UPDATE users SET is_deleted = 1 WHERE  id = $id";
                // echo $query;exit();
        $object->execute_query($query);  
        echo 'Successfully deleted';  
      }  
 }  
 ?>  