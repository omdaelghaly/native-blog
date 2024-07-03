<?php
 require_once 'Env.php';

class User extends Env{
  

    public function register($name, $email, $u_name, $password,$image) {
     
       $pass=password_hash($password, PASSWORD_DEFAULT); //hash pass
        // Perform SQL insert operation to register user
        $sql = "INSERT INTO `users` (`name`, `email`, `u_name`, `password`, `image`) VALUES ('$name', '$email','$u_name', '$pass','$image')";
        $q = mysqli_query($this->connect(),$sql);
        if($q){
            return true;
        }else{
            return false;
        }
    }
//login
    public function login($login,$column,$password)
    {
        
        $sql = "SELECT * FROM `users` WHERE $column='$login'";
               $result = mysqli_query($this->connect(),$sql);
               if ($result->num_rows == 1) {
                // User found, fetch the password
                $user = $result->fetch_assoc();
                $pass = $user['password'];
                           if(password_verify($password, $pass)){
                           session_start();
                           $_SESSION = $user;
                            
                              
                            }else{
                                  //error password
                                  return 'error_pass';
                            }

               }else{
                   //error email/username
                   return 'error_email_user';
               }

        
    }
//logout
    public function logout()
    {
    // Start or resume session
     session_start();

    // Clear all session variables
     $_SESSION = array();

      // Destroy the session
      session_destroy();

    // Send a response indicating success
     return 'logout'; 
    }
    



    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}
?>
