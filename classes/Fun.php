<?php
 require_once 'Env.php';

class Fun extends Env{


    //check value if exist 
public function checkIfExist($column,$table,$value) {
         $search =  "SELECT $column FROM $table WHERE $column = '$value'";
         $rows=  mysqli_query($this->connect(),$search);
         $numRows = mysqli_num_rows($rows);

         // Return the number of rows
         if($numRows){
             return true ; /// exists
         }else{
             return false; // not exist
         }
}
    ////response
public function response($status='',$filed='',$msg='',$data=''){
          return json_encode([
              'status'=>$status,
               'msg'  =>[$filed=>$msg] ,
              'data'  =>$data,
          ]);
}
/////////validate
public function validateEmail($email) {
    // Check if the email is not empty
    if (empty($email)) {
        return $this->response('error','email','Please enter a valid email !','') ;
    }elseif (!preg_match('/^[a-zA-Z0-9-_+#@.,]+$/', $email)) {
        return $this->response('error','email','Only letters,numbers,-_+#@. are acceptable','') ;
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         // Check if the email format is valid using regular expression
        return $this->response('error','email','this email is not valid ','') ;
    }else{
    // Email is valid errors =0
    return false ;}
}
//////////// validate vars for name password ...
public function validateVars($var, $minL, $maxL ,$var_name) {
     $varLength = strlen($var);

    // Check if the name is not empty
    if (empty($var)) {
        return $this->response('error',$var_name,'Please, enter your '.$var_name.' !' ,'') ;
    }elseif ($varLength < $minL || $varLength > $maxL) 
    {  // Check if the length of the var is within the specified range
        return $this->response('error',$var_name,'length should be between '.$minL.' and '.$maxL,'') ;
    ///
    }elseif($var_name==='name') {   
        if (!preg_match('/^[a-zA-Z0-9\s\-_+#@.,]+$/', $var)) 
        {// Check if the var contains only allowed characters
                        return $this->response('error',$var_name,'Only letters,numbers,-_+#@.s are acceptable','') ;
        }else{
                        return false; // no errors
        }
    }else{ // remove space u_name
        if (!preg_match('/^[a-zA-Z0-9-_+#@.,]+$/', $var)) 
        {// Check if the var contains only allowed characters
                        return $this->response('error',$var_name,'Only letters,numbers,-_+#@.s are acceptable','') ;
        }else{
                        return false; // no errors
        }

    }


   
}

public function validateLength($var,$min,$max)
{
    $varLength = strlen($var);
    if ($varLength < $min || $varLength > $max){
        return true;
    }else{
        return false;
    } 
}    

public function reg_match($var)
{
    if (!preg_match('/^[a-zA-Z0-9\s\-_+#@.,]+$/', $var)){
        return true;
    }else{
        return false;
    } 
}
public function reg_match2($var)
{
    if (!preg_match('/^[a-zA-Z0-9-_+#@.,]+$/', $var)){
        return true;
    }else{
        return false;
    } 
}
public function validateSize($files,$maxSize)
{
    foreach ($files['name'] as $index => $file_name) {
             $filesize = $files['size'][$index];

        // Check if the image size is within the allowed limit
        if ($filesize > $maxSize) {
            return $file_name; // error in this filename
            
        }else{
            return false; // no error
        }
            
    }
    
}
public function validateAllowed($files,$allowed)
{
    foreach ($files['name'] as $index => $file_name) {
              $Ext = explode('.', $file_name);
              $fileExt = strtolower(end($Ext));
               // Allowed file types
               
               if (!in_array($fileExt, $allowed)) {
                    return $file_name;
               }else{
                   return  false;
               }
            
    }
}    

public function getUser($table,$column,$id)
{
    $mysqli=  $this->connect();
    $sql =  "SELECT * FROM $table WHERE id = '$id'";
    $rows=  $mysqli->query($sql);
    $USER = mysqli_fetch_assoc($rows);

    // Return the number of rows
    if($USER){
        return $USER[$column] ; /// exists
    }else{
        return ''; // not exist
    }
}
public function getTime($time)
{
    $now = time(); // Current Unix timestamp
    // $timestamp = strtotime($date); // Convert date string to Unix timestamp
    $timestamp = $time;

    $diff = $now - $timestamp; // Calculate difference in seconds

    if ($diff < 60) {
        return 'منذ ' . $diff . ' ثانية';
    } elseif ($diff < 3600) {
        return 'منذ ' . floor($diff / 60) . ' دقيقة';
    } elseif ($diff < 86400) {
        return 'منذ ' . floor($diff / 3600) . ' ساعة';
    } elseif ($diff < 604800) {
        return 'منذ ' . floor($diff / 86400) . ' يوم';
    } elseif ($diff < 2592000) {
        return 'منذ ' . floor($diff / 604800) . ' أسبوع';
    } elseif ($diff < 31536000) {
        return 'منذ ' . floor($diff / 2592000) . ' شهر';
    } else {
        return 'منذ ' . floor($diff / 31536000) . ' سنة';
    }
}

////////////////////
public function like($user_id,$post_id,$comment_id)
{
    if($comment_id){
        $table='comment_likes';    
        $user_like =  "SELECT * FROM $table WHERE post_id = '$post_id' && user_id = '$user_id' && comment_id='$comment_id' ";
         ///check if user liked this before
                $like=  mysqli_query($this->connect(),$user_like);
                $likeRows = mysqli_num_rows($like);

                // Return the number of rows
                if($likeRows){
                    //dislike 
                    $sql = "DELETE FROM $table WHERE post_id = '$post_id' && comment_id='$comment_id' && user_id = '$user_id' ";    
                    $result = mysqli_query($this->connect(),$sql);
                }else{
                   //set like                               
                   $sql = "INSERT INTO $table (`user_id`,`post_id`,`comment_id`) VALUES ('$user_id','$post_id','$comment_id')";
                   $q = mysqli_query($this->connect(),$sql);
                }
                return $this->response('error','com',$likeRows.'00'.$post_id.'00'.$user_id,'0---'.$comment_id,'') ;





    }else{
        $table='post_likes';
        $user_like =  "SELECT * FROM $table WHERE post_id = '$post_id' && user_id = '$user_id' ";
///check if user liked this before
        $like=  mysqli_query($this->connect(),$user_like);
        $likeRows = mysqli_num_rows($like);

        if($likeRows){
            //dislike 
            $sql = "DELETE FROM $table WHERE post_id = '$post_id' && user_id = '$user_id' ";    
            $result = mysqli_query($this->connect(),$sql);
        }else{
           //set like                               
           $sql = "INSERT INTO $table (`user_id`,`post_id`) VALUES ('$user_id','$post_id')";
           $q = mysqli_query($this->connect(),$sql);
        }

        return $this->response('error','post',$likeRows.'00'.$post_id.'00'.$user_id,'0---'.$comment_id,'') ;


    }



}
////////////////

    ////get likes num

    public function likesNum($post_id,$comment_id=null,$user_id)
    {
        if($comment_id===null){
            //postlikes
            $table='post_likes';
            $post_likes =  "SELECT * FROM $table WHERE post_id = '$post_id'  ";
            $likes=  mysqli_query($this->connect(),$post_likes);
            $likeRows = mysqli_num_rows($likes);

            $user_like =  "SELECT * FROM $table WHERE post_id = '$post_id' && user_id = '$user_id' ";
            $like=  mysqli_query($this->connect(),$user_like);
            $u_like = mysqli_num_rows($like);
            return $this->response('success','post','',['num'=>$likeRows,'u_like'=>$u_like]) ;




        }else{
            //commentlikes
            $table='comment_likes';
            $comment_likes =  "SELECT * FROM $table WHERE post_id = '$post_id' && comment_id='$comment_id' ";
            $likes=  mysqli_query($this->connect(),$comment_likes);
            $likeRows = mysqli_num_rows($likes);           
           
            $user_like =  "SELECT * FROM $table WHERE post_id = '$post_id' && user_id = '$user_id' && comment_id='$comment_id' ";
            $like=  mysqli_query($this->connect(),$user_like);
            $u_like = mysqli_num_rows($like);
            return $this->response('success','post','',['num'=>$likeRows,'u_like'=>$u_like]) ;

        }
    }
///////////////////////
        ////get likes num

    public function commentNum($post_id)
    {
            //postlikes
            $table='comments';
            $commentsNum =  "SELECT * FROM $table WHERE post_id = '$post_id'  ";
            $rows=  mysqli_query($this->connect(),$commentsNum);
            $numRows = mysqli_num_rows($rows);
            if($numRows){
            return $this->response('success','post','',['num'=>$numRows]) ;
           }else{
            return $this->response('success','post','',['num'=>0]) ;
           }

    }

////////update profile

   public function update_profile($user_id,$name , $about,$email , $country, $job , $company , $address ,
   $phone ,$twitter , $facebook , $instagram , $linkedin, )
   {
    

    $user_id = mysqli_real_escape_string($this->connect(), $user_id);
    $name = mysqli_real_escape_string($this->connect(), $name);
    $about = mysqli_real_escape_string($this->connect(), $about);
    $email = mysqli_real_escape_string($this->connect(), $email);
    $country = mysqli_real_escape_string($this->connect(), $country);
    $job = mysqli_real_escape_string($this->connect(), $job);
    $company = mysqli_real_escape_string($this->connect(), $company);
    $address = mysqli_real_escape_string($this->connect(), $address);
    $phone = mysqli_real_escape_string($this->connect(), $phone);
    $twitter = mysqli_real_escape_string($this->connect(), $twitter);
    $facebook = mysqli_real_escape_string($this->connect(), $facebook);
    $instagram = mysqli_real_escape_string($this->connect(), $instagram);
    $linkedin = mysqli_real_escape_string($this->connect(), $linkedin);

    $sql = "UPDATE users 
        SET name = '$name',
            about = '$about',
            email = '$email',
            country = '$country',
            job = '$job',
            company = '$company',
            address = '$address',
            phone = '$phone',
            twitter = '$twitter',
            facebook = '$facebook',
            instagram = '$instagram',
            linkedin = '$linkedin'

        WHERE id = '$user_id'";

$q = mysqli_query($this->connect(), $sql);
if ($q) {
    return $this->response('success','updated','','okkkkkkk') ;
  
} else {
    return $this->response('success','update_error','','error') ;
}
  



   }

///////update profile image

function update_profile_img($u_id,$image,$dir){
     $allowed = array('jpg', 'jpeg', 'png', 'gif');
      $validateAllowed = $this->validateAllowed($image,$allowed);
      if(!$validateAllowed){
             $validateSize = $this->validateSize($image,(1 * 1024 * 1024)/2);//$maxFileSize 500b = (1 * 1024 * 1024)/2
             if(!$validateSize){ // no error 

               $current_img= $this->getUser('users','image',$u_id);//del old
               if($current_img!=='default.jpg'){
                  $current_path = $dir.$current_img;
                  unlink($current_path);
               }
                    $tmp = $image['tmp_name'][0];
                    $originName = $image['name'][0];
                    $imgName = uniqid().$originName;
                    move_uploaded_file($tmp, $dir.$imgName);
                $sql = "UPDATE users  SET image = '$imgName'  WHERE id = '$u_id'";
                $q = mysqli_query($this->connect(), $sql);

    return 'file okk' ;

             }else{
                return 'file size should be less than 500b';
             }
     }else{
         return 'this file is not acceptable '.'('.$validateAllowed.')' ;

     }

}
////////////////////

public function getChatId($sid,$uid)
{
     if($sid > $uid){
      return $sid.$uid;
     }else{
      return $uid.$sid;
     }
}



///
}