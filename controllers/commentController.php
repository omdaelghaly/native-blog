<?php
 require_once './../classes/Post.php';
 require_once './../classes/Comment.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentClass = new Comment();
    // use fun
    $funClass = new Fun();
    $env= new Env();
   
////  
session_start();
$comment = $_POST['comment'];
$post_id = $_POST['post_id'];
$parent_id = $_POST['parentid'];
$time=time();
$images = $_FILES['images'];
$files = $_FILES['files'];

$user_id = $_SESSION['id'];
$maxImageSize=(1 * 1024 * 1024)/4; //500b
$maxFileSize=(5 * 1024 * 1024);     //5mb
$mysqli = $env->connect();
$commentId=null;
$imagesDIR = './../assets/images/posts/images/'; // Directory to store the uploaded images
$filesDIR = './../assets/images/posts/files/'; // Directory to store the uploaded files
$imagesTable = 'comment_images';
$filesTable = 'comment_files';
$i_columns="(`user_id`,`post_id`,`comment_id`,`i_name`)";
$f_columns="(`user_id`,`post_id`,`comment_id`,`f_name`)";



// //Insert the post content into the database
$sql = "INSERT INTO comments (`user_id`,`post_id`,`comment`,`time`,`parent_id`) VALUES ('$user_id', '$post_id','$comment','$time','$parent_id')";
$comment =  $mysqli->query($sql);

if ($comment === TRUE) {
    // Retrieve the ID of the last inserted row
    $comment_id = $mysqli->insert_id;
};
 $data = ['user_id'=>$user_id,'post_id'=>$post_id,'comment_id'=>$comment_id];
 
 echo $funClass->response('success', 'msg',$images,'');

//  uploaded images

if (!empty($images['name'][0])) {
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $validateAllowed = $funClass->validateAllowed($images,$allowed);
        if(!$validateAllowed){
                $validateSize = $funClass->validateSize($images,$maxImageSize);//$maxFileSize 500b = (1 * 1024 * 1024)/2
                if(!$validateSize){ // no error 
                      $commentClass->saveFile($images,$imagesDIR,$imagesTable,$i_columns,$data);      
                                      
                }else{
                    echo $funClass->response('success', 'msg','file size should be less than '.($maxImageSize/1024).' kb ( '.$validateSize.' )','');
                }
        }else{
            echo $funClass->response('success', 'msg','this file is not acceptable '.'('.$validateAllowed.')' ,'');

        }
}

//upload files
if (!empty($files['name'][0])) {
    $allowed = array('pdf', 'doc', 'docx');
        $validateAllowed = $funClass->validateAllowed($files,$allowed);
        if(!$validateAllowed){
                $validateSize = $funClass->validateSize($files,$maxFileSize);//$maxFileSize 500b = (1 * 1024 * 1024)/2
                if(!$validateSize){ // no error 
                      $commentClass->saveFile($files,$filesDIR,$filesTable,$f_columns,$data);      
                                      
                }else{
                    echo $funClass->response('success', 'msg','file size should be less than '.($maxImageSize/1024).' kb ( '.$validateSize.' )','');
                }
        }else{
            echo $funClass->response('success', 'msg','this file is not acceptable '.'('.$validateAllowed.')' ,'');

        }
}



////
}
?>
