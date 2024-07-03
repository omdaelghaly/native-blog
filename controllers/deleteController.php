<?php
 require_once './../classes/Delete.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteClass = new Delete();
    // use fun
    $funClass = new Fun();
    $env= new Env();
   
////  
session_start();
$id = $_POST['id'];
$table = $_POST['table'];
$status = $_POST['status'];
$user_id = $_SESSION['id'];

if($status==='post'){
$delete_posts = $deleteClass->deleteRows('posts','id',$id);
$delete_images = $deleteClass->deleteRows('post_images','post_id',$id);
$delete_files = $deleteClass->deleteRows('post_files','post_id',$id);
//delete comments 
$delete_comments = $deleteClass->deleteRows('comments','post_id',$id);
$delete_images = $deleteClass->deleteRows('comment_images','post_id',$id);
$delete_files = $deleteClass->deleteRows('comment_files','post_id',$id);
}elseif($status==='comment'){
    //delete one comment 
$delete_comments = $deleteClass->deleteRows('comments','id',$id);
$delete_images = $deleteClass->deleteRows('comment_images','comment_id',$id);
$delete_files = $deleteClass->deleteRows('comment_files','comment_id',$id);
}

echo $funClass->response('success', 'msg',$status.'-'.$id.'-'.$table ,'');



}
?>
