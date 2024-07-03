
<?php
session_start();
 include('./../../classes/All.php');
    $chatClass= new Chat;
    $funClass= new Fun;

    
       if(isset($_SESSION['id'])){//show message if login
 

             $data= $chatClass->getUsersChat('chats',$_SESSION['id']) ;  
             $uzers=$data['uzers'];
             $uzers=array_reverse($uzers);

            
             

     
?>
       
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">
            	<?php echo isset($data['unseen'])?$data['unseen']:'0' ?>
            </span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have <?php echo isset($data['unseen'])?$data['unseen']:'0' ?> new messages
              <a href="#" hidden><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


                  <?php 
      if($uzers){

                  foreach ($uzers as $uzer) {
                      $otherUser = ($_SESSION['id'] == $uzer['my_id']) ? $uzer['other_id'] : $uzer['my_id'];

                      $u_img= $funClass->getUser('users','image', $otherUser) ;  
                      $u_name= $funClass->getUser('users','name', $otherUser) ;  
                      $time= $funClass->getTime($uzer['time'])  ;
                   ?> 
            <li class="message-item">
              <a href="/components/chat/index.php?chatId=<?php echo $uzer['chat_id'] ;?>&&u_id=<?php echo $otherUser; ?>">
                <img src="/assets/images/profiles/<?php echo $u_img ? $u_img :'' ;?>"alt="" class="rounded-circle">
                <div>
                  <h4><?php echo $u_name ? $u_name :'' ;?></h4>
                  <p><?php echo $uzer['message'] ? $uzer['message'] :'' ;?></p>
                  <p><?php echo $time ? $time :'' ;?></p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
                     <?php } ?>
           <?php
            }else{

             ?>
               <li class="message-item">
                 <div>
                     <p>you dont have message yet ..</p>
                  
                </div>
               </li>
             <?php }
             ?>   

          </ul><!-- End Messages Dropdown Items -->

         

<?php
  }else{

?>

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">
                   <!-- //num msg --> 0
            </span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 0 new messages
              <a href="#" hidden><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
               <li class="message-item">
                <div>
                     <p>login to be able to chat with your friends ..</p>
                  
                </div>
               </li>   
              <hr class="dropdown-divider">
            </li>
                     

            

          </ul><!-- End Messages Dropdown Items -->

<?php
}
  ?>