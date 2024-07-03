<?php
 require_once './../classes/Post.php';
 require_once './../classes/Comment.php';
 require_once './../classes/Delete.php';
 require_once './../classes/Edit.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteClass = new Delete();
    $editClass = new Edit();
    $postClass = new Post();
    $commentClass = new Comment();


    // use fun
    $funClass = new Fun();
    $env= new Env();
   
////  
session_start();
$id = $_POST['id'];
$table = $_POST['table'];
$newData = $_POST['newData'];
$status = $_POST['status'];
$user_id = $_SESSION['id'];

if (!empty($_FILES['images']['name'][0])){
        $images = $_FILES['images'];
}
if (!empty($_FILES['files']['name'][0])){      
$files = $_FILES['files'];
}

$user_id = $_SESSION['id'];
$maxImageSize=(1 * 1024 * 1024)/4; //500b
$maxFileSize=(5 * 1024 * 1024);     //5mb
$imagesDIR = './../assets/images/posts/images/'; // Directory to store the uploaded images
$filesDIR = './../assets/images/posts/files/'; // Directory to store the uploaded files




if($status==='post'){
$imagesTable = 'post_images';
$filesTable = 'post_files';
$i_columns="(`user_id`,`post_id`,`i_name`)";
$f_columns="(`user_id`,`post_id`,`f_name`)";
$data = ['user_id'=>$user_id,'post_id'=>$id];

  //only edit post without change comments
$edit = $editClass->editRow('posts','post',$newData,$id);
$delete_images = $deleteClass->deleteRows('post_images','i_name',$imagesDIR,'post_id',$id);
$delete_files = $deleteClass->deleteRows('post_files','f_name',$filesDIR,'post_id',$id);



//  uploaded images

if (!empty($_FILES['images']['name'][0])) {
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $validateAllowed = $funClass->validateAllowed($images,$allowed);
        if(!$validateAllowed){
                $validateSize = $funClass->validateSize($images,$maxImageSize);//$maxFileSize 500b = (1 * 1024 * 1024)/2
                if(!$validateSize){ // no error 
                      $postClass->saveFile($images,$imagesDIR,$imagesTable,$i_columns,$data);      
                                      
                }else{
                    echo $funClass->response('success', 'msg','file size should be less than '.($maxImageSize/1024).' kb ( '.$validateSize.' )','');
                }
        }else{
            echo $funClass->response('success', 'msg','this file is not acceptable '.'('.$validateAllowed.')' ,'');

        }
}

//upload files
if (!empty($_FILES['files']['name'][0])) {
    $allowed = array('pdf', 'doc', 'docx');
        $validateAllowed = $funClass->validateAllowed($files,$allowed);
        if(!$validateAllowed){
                $validateSize = $funClass->validateSize($files,$maxFileSize);//$maxFileSize 500b = (1 * 1024 * 1024)/2
                if(!$validateSize){ // no error 
                      $postClass->saveFile($files,$filesDIR,$filesTable,$f_columns,$data);      
                                      
                }else{
                    echo $funClass->response('success', 'msg','file size should be less than '.($maxImageSize/1024).' kb ( '.$validateSize.' )','');
                }
        }else{
            echo $funClass->response('success', 'msg','this file is not acceptable '.'('.$validateAllowed.')' ,'');

        }
}

echo $funClass->response('success', 'msg','edit post successfully');


}elseif($status==='comment'){
    //edit comment $imagesTable = 'comment_images';
$filesTable = 'comment_files';
$imagesTable = 'comment_images';

$i_columns="(`user_id`,`post_id`,`comment_id`,`i_name`)";
$f_columns="(`user_id`,`post_id`,`comment_id`,`f_name`)";
$post_id = $_POST['post_id'];

$data = ['user_id'=>$user_id,'post_id'=>$post_id,'comment_id'=>$id];


$edit = $editClass->editRow('comments','comment',$newData,$id);
$delete_images = $deleteClass->deleteRows('comment_images','i_name',$imagesDIR,'comment_id',$id);
$delete_files = $deleteClass->deleteRows('comment_files','f_name',$filesDIR,'comment_id',$id);



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



 echo $funClass->response('success', 'msg','comment edit','');



}

// echo $funClass->response('success', 'msg',$status.'-'.$id.'-'.$table ,'');



}
?>
