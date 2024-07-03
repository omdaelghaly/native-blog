<?php
 require_once './../classes/User.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $login = $_POST['login-user'];
    $password = $_POST['login-password'];

    // Create new User instance
    $user_model = new User();
    // use fun
    $funClass = new Fun();
   
   // validate inputs-----

   $validate_password= $funClass->validateLength($password,5,20,);
   $validate_pass_reg= $funClass->reg_match2($password);
   $validate_login= $funClass->validateLength($login,5,30);
   $validate_login_reg= $funClass->reg_match2($login);

      $if_email = filter_var($login, FILTER_VALIDATE_EMAIL);
      if($if_email){
///           
               
      
         ///
         if(!$validate_login_reg){ //no errors reg
               
          if(!$validate_login){ // no errors length
              
                 if(!$validate_pass_reg){

                            if(!$validate_password){
                              // session start=>login
                                 $res = $user_model->login($login,'email',$password);
                                
                                 if($res==='error_pass'){
                                   echo $funClass->response('error','password','this password is not correct',''); 
                                 }else if($res==='error_email_user'){
                                   echo $funClass->response('error','login','this email/username is not correct ',''); 
                                 }else{
                                
                                     echo $funClass->response('success','success','you have logged in successfully',''); 
                                 }

                            }else{
                             echo $funClass->response('error','password','length should be between 5 and 20',''); 

                            }

                 }else{
                   echo $funClass->response('error','password','Only letters,numbers,-_+#@. are acceptable',''); 

                 }

           }else{
             echo $funClass->response('error','login','length should be between 5 and 30',''); 

           }             
 }else{
     echo $funClass->response('error', 'login','Only letters,numbers,-_+#@. are acceptable... ','');
 }

         ///
       
//
      }else{
            if(!$validate_login_reg){ //no errors reg
               
                     if(!$validate_login){ // no errors length
                         
                            if(!$validate_pass_reg){

                                       if(!$validate_password){
                                         // session start=>login
                                            $res = $user_model->login($login,'u_name',$password);
                                           
                                            if($res==='error_pass'){
                                              echo $funClass->response('error','password','this password is not correct',''); 
                                            }else if($res==='error_email_user'){
                                              echo $funClass->response('error','login','this email/username is not correct ',''); 
                                            }else{
                                           
                                                echo $funClass->response('success','success','you have logged in successfully',''); 
                                            }

                                       }else{
                                        echo $funClass->response('error','password','length should be between 5 and 20',''); 

                                       }

                            }else{
                              echo $funClass->response('error','password','Only letters,numbers,-_+#@. are acceptable',''); 

                            }

                      }else{
                        echo $funClass->response('error','login','length should be between 5 and 30',''); 

                      }             
            }else{
                echo $funClass->response('error', 'login','Only letters,numbers,-_+#@. are acceptable... ','');
            }
           
             

       };







   


////
}









?>
