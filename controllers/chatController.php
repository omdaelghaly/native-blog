<?php
 require_once './../classes/Post.php';
 require_once './../classes/Comment.php';
 require_once './../classes/Fun.php';
 require_once './../classes/Chat.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $chatClass = new Chat();
    // // use fun
     $funClass = new Fun();
    // $env= new Env();
   
////  
session_start();

$process = $_POST['process'];
$time=time();
$my_id = $_SESSION['id'];
$table='chats';


if($process==='sendMsg'){

   $msg = $_POST['msg'];
   $u_id = $_POST['u_id'];

     if($my_id>$u_id){
         $chat_id=$my_id.$u_id;
     }else{
         $chat_id=$u_id.$my_id;
     };
    $columns= "(`chat_id`,`my_id`,`other_id`,`message`,`seen`,`time`)";
    $values = "('$chat_id','$my_id','$u_id','$msg','',$time)";

      
        $sendMsg = $chatClass->sendMsg($table,$columns,$values);
        if($sendMsg){
             echo $funClass->response('success', 'msg','message sent',$sendMsg);            
        }

}elseif($process==='editMsg'){
      $msg_id = $_POST['msg_id'];
      $msg = $_POST['msg'];
      $editMsg = $chatClass->editMsg($table,'message',$msg,$msg_id);
        if($editMsg){
             echo $funClass->response('success', 'msg','message edit',$editMsg);            
        }
}elseif($process==='deleteMsg'){
      $msg_id = $_POST['msg_id'];
      $deleteMsg = $chatClass->deleteMsg($table,$msg_id);
        if($deleteMsg){
             echo $funClass->response('success', 'msg','message deleted',$deleteMsg);            
        }

}else{
      echo $funClass->response('success', 'msg','no process','');

}







////
}
?>
