<?php
 require_once './../classes/User.php';
 require_once './../classes/Fun.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Create new User instance
    $user_model = new User();
    $logout = $user_model->logout();
    $funClass = new Fun();


    if($logout==='logout'){
        echo $funClass->response('success','success' ,'you have logged out successfully ','');
    }else{
       echo $funClass->response('error','error' ,'there is unknown error logout ','');

    }

} 