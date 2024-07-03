<?php
 require_once './../classes/User.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $u_name = $_POST['username'];
    $password = $_POST['password'];
    $image ='default.jpg';

    // Create new User instance
    $user = new User();
    // use fun
    $funClass = new Fun();
   
   // validate inputs-----
   $validateName= $funClass->validateVars($name, 5 , 50 ,'name');
    if(!$validateName){ // name 
         $validateEmail = $funClass->validateEmail($email);
         if(!$validateEmail){//email
              $validate_u_Name= $funClass->validateVars($u_name,5,30,'userName');
              if(!$validate_u_Name){ // user name
                  $validate_password= $funClass->validateVars($password,5,20,'password');
                  if(!$validate_password){ //password
//      // validate data 
    $rowsE = $funClass->checkIfExist('email','users',$email);
    if(!$rowsE){
          $rowsU = $funClass->checkIfExist('u_name','users',$u_name);
           if(!$rowsU){
                 // Insert user into database
                  $result = $user->register($name, $email, $u_name, $password,$image);
 
                     if ($result) {
                          echo $funClass->response('success', 'msg','You have registered successfully ... LOGIN now','');
                     } else {
                        echo $funClass->response('error','error' ,'Error , try again ','');
                    }
           }else{
            echo $funClass->response('error', 'userName','UserName is used . try another one','');
        }
    }else{
        echo $funClass->response('error', 'email', 'Email is used, try another one','');
    }

////
                  }else{
                      echo $validate_password;
                  }
             }else{
                 echo $validate_u_Name;
             }
         }else{
             echo $validateEmail ;
         }
   }else{
    echo $validateName;
}
   


 
////
}
?>
