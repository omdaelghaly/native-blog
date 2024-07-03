<?php
 require_once './../classes/Post.php';
 require_once './../classes/Comment.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $funClass = new Fun();
 
   
////  
session_start();
$process = $_POST['process'];
$user_id = $_SESSION['id'];

if($process==='like'){
      $post_id = $_POST['post_id'];
      $comment_id = $_POST['comment_id'];


    $res= $funClass->like($user_id,$post_id,$comment_id);
    echo $funClass->response('success', 'msg',$res,'');
    

}elseif ($process==='update_profile') {
    $name = $_POST['fullName'];
    $about = $_POST['about'];
    $email = $_POST['email'];
    $country= $_POST['country'];
    $job = $_POST['job'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];

    if (!empty($_FILES['profile_image_upload']['name'][0])){
      $image= $_FILES['profile_image_upload'];
     $imagesDIR = './../assets/images/profiles/'; // Directory to store the uploaded images
   }

    $res= $funClass->update_profile($user_id,$name , $about ,$email, $country, $job , $company , $address ,
    $phone ,$twitter , $facebook , $instagram , $linkedin  );
    echo $funClass->response('success', 'msg',$res,'');

    if (!empty($_FILES['profile_image_upload']['name'][0])) {
           if($image['name'][0]!=='default.jpg'){
               $resi= $funClass->update_profile_img($user_id,$image,$imagesDIR);
               echo $funClass->response('success', 'msg',$resi,'');


            }else{
                echo $funClass->response('success', 'msg','old one','');
            }


    }else{
        echo $funClass->response('success', 'msg','no image','');

    }


}





////
}
?>
