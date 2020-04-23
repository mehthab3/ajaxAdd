<?php  
 include 'crud.php';  
 $object = new Crud();  
 ?>  
 <html>  
      <head>  
           <title>Users</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <style>  
                body  
                {  
                     margin:0;  
                     padding:0;  
                     background-color:#f1f1f1;  
                }  
                .box  
                {  
                     width:1270px;  
                     padding:20px;  
                     background-color:#fff;  
                     border:1px solid #ccc;  
                     border-radius:5px;  
                     margin-top:10px;  
                }  
           </style>  
      </head>  
      <body>  
           <div class="container box">  
                <h3 align="center">User Details </h3><br />  
                <button type="button" name="add" class="btn btn-success" data-toggle="collapse" data-target="#user_collapse">Add</button>  
                <br /><br />  
                <div id="user_collapse" class="collapse">  
                     <form method="post" id="user_form">  
                          <label>Enter First Name</label>  
                          <input type="text" name="first_name" id="first_name" class="form-control" required />  
                          <br />  
                          <label>Enter Last Name</label>  
                          <input type="text" name="last_name" id="last_name" class="form-control" />
                          <br /> 
                          <label>Email Id</label>  
                          <input type="email" name="email" id="email" class="form-control" required/>
                          <br /> 
                          <label>Phone No</label>  
                          <input type="tel" name="phone" id="phone" class="form-control" required/>
                          <br />
                          <label>Date of Birth</label>  
                          <input type="date" name="dob" id="dob" class="form-control" required />
                          <br />
                          <label>Sex</label>  
                          <select id="sex" name="sex"  class="form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                          <br/>  
                        </select>
                          <br />  
                          <div align="center">  
                               <input type="hidden" name="action" id="action" />  
                               <input type="hidden" name="user_id" id="user_id" />  
                               <input type="submit" name="button_action" id="button_action" class="btn btn-success" value="Insert" />  
                          </div>
                          <br />  
                     </form>  
                </div>  
                <br />  
                <div class="table-responsive" id="user_table">  
                </div>  
           </div>  
      </body>  
 </html>  
 <script type="text/javascript">  
      $(document).ready(function(){  
           load_data();  
           $('#action').val("Insert");  
           $('#add').click(function(){  
                $('#user_form')[0].reset();    
                $('#button_action').val("Insert");  
           });  
           function load_data()  
           {  
                var action = "Load";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{action:action},  
                     success:function(data)  
                     {  
                          $('#user_table').html(data);  
                     }  
                });  
           }  
           $('#user_form').on('submit', function(event){  
                event.preventDefault();  
                var firstName = $('#first_name').val();  
                var lastName = $('#last_name').val();
                var email = $('#email').val();  
                var phone = $('#phone').val();  
                var dob = $('#dob').val();  
                var sex = $('#sex').val();
        
                if(firstName != '' && lastName != '' && email != '' && dob != ''&& sex != ''&& phone != '' )  
                {  
                     $.ajax({  
                          url:"action.php",  
                          method:'POST',  
                          data:new FormData(this),  
                          contentType:false,  
                          processData:false,  
                          success:function(data)  
                          {  
                               alert(data);  
                               $('#user_form')[0].reset();  
                               load_data();  
                               $("#action").val("Insert");  
                               $('#button_action').val("Insert");  
      
                          }  
                     });  
                }  
                else  
                {  
                     alert("All Fields are Required");  
                }  
           });  
           $(document).on('click', '.update', function(){  
                var user_id = $(this).attr("id");  
                var action = "Fetch Single Data";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{user_id:user_id, action:action},  
                     dataType:"json",  
                     success:function(data)  
                     {  
                          $('.collapse').collapse("show");  
                          $('#first_name').val(data.first_name);  
                          $('#last_name').val(data.last_name);  
                          $('#email').val(data.email);  
                          $('#sex').val(data.sex);
                          $('#phone').val(data.phone);  
                          $('#dob').val(data.dob);  
                          $('#button_action').val("Edit");  
                          $('#action').val("Edit");  
                          $('#user_id').val(user_id); 

                     }  
                });  
           });

           $(document).on('click', '.delete', function(){  
                var user_id = $(this).attr("id");  
                var action = "delete";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{user_id:user_id, action:action},  
                     success:function(data)  
                     {  
                          alert(data);
                          load_data();   
                     }
                });  
           });  
      });  
 </script>  