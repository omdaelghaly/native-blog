


<!-- ===================================== -->
<?php
session_start();
include('./../../classes/All.php');
   $chatClass= new Chat;
   $funClass= new Fun;

if (!isset($_SESSION['id'])) {
  echo "<script>window.location.href = './../../../index.php';</script>";
  exit();
}


 $u_id= isset($_GET['u_id']) && is_numeric($_GET['u_id'])? intval($_GET['u_id']) :0 ;
  // echo 'mm'.$u_id;

 if($_SESSION['id']==$u_id){ //NO chat with urself
     echo "<script>window.location.href = './../../../index.php';</script>";
     exit(); 
 }
// echo $u_id;echo $_SESSION['id'];
 



   $messages = $chatClass->getMessages($_SESSION['id'],$u_id);
   //var_dump($messages);
   if($messages){
     foreach ($messages as $msg) {

  
///////////////////////////my messages///////////
        if($_SESSION['id']===$msg['my_id']){
                          
          $my_img= $funClass->getUser('users','image',$msg['my_id']) ;  
          $my_name= $funClass->getUser('users','name',$msg['my_id']) ;  
          $time= $funClass->getTime($msg['time'])  ;  
                          
           
     ?>
    <!-- ==================my message  ==========================================-->
  <div class="col-12 container card info-card customers-card my-1" dir="rtl" style="background:skyblue ;">
    <div class="row d-flex">
        <div class="col-1 ">                           
                 <a href="#"  >   
                   <img src="/assets/images/profiles/<?php echo $my_img ? $my_img :'' ;?>" style="width:50px;height:50px ;" class="rounded-circle">
                  </a>  
        </div>

        <div class="col">
                 <div class="pt-2 " style="line-height:18px;background: ;">
                                                             <span class="" style="display:inline-block ; width:20px;height:2px;" ></span>

                      <span class="fw-bold pb-0 mb-0">
                                <?php echo $my_name ? $my_name :'' ;?>
                      </span><br class="p-0 m-0">
                                                         <span class="" style="display:inline-block ; width:20px;height:2px;background: " ></span>

                       <span class="text-muted small ">
                                  <?php echo $time ? $time :'' ;?>
                       </span><br>
                 </div>
                  

            
            <p>
             <?php echo $msg['message'] ? $msg['message'] :'' ;?>
            </p>   
        </div>

        <div class="col-1 d-flex flex-column justify-content-end" >
               <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                   
                    <li><a class="dropdown-item" onclick="editMsg(event,'<?php echo $msg['id'];?>','<?php echo $msg['message'];?>')" id="" href="#">edit</a></li>
                    <li><a class="dropdown-item" onclick="deleteMsg(event,'<?php echo $msg['id'];?>')" id="" href="#">delete</a></li>
                  </ul>
              </div>  
              <div class="mt-auto">
              <?php 
                   if($msg['seen']){ // message seen  ?>
                      <span class="" style="color:blue"><i class="bi bi-check2-all"></i></span>      
                  <?php
                    }else{ // message still not seen -> send now seen ?>
                     <span class="" style="color:gray"><i class="bi bi-check2-all"></i></span>              
                   <?php } ?>
             </div>         
        </div>

    </div>
</div>
 
<!-- =========================================================================================================== -->
  <?php
       }else{
               $other_img= $funClass->getUser('users','image',$msg['my_id']) ;  
               $other_name= $funClass->getUser('users','name',$msg['my_id']) ;  
               $time= $funClass->getTime($msg['time'])  ;  
        ?>
    
    <!-- ========================other message ======================================== -->
  <div class="col-12 container card info-card customers-card my-1" >
    <div class="row d-flex">
        <div class="col-1">                           
                 <a href="#"  >   
                   <img src="/assets/images/profiles/<?php echo $other_img ? $other_img :'' ;?>" style="width:50px;height:50px ;" class="rounded-circle">
                  </a>  
        </div>

        <div class="col">
                 <div class="pt-2 " style="line-height:18px ;">
                                                             <span class="" style="display:inline-block ; width:20px;height:2px;background: ;" ></span>

                      <span class="fw-bold pb-0 mb-0">
                                <?php echo $other_name ? $other_name :'' ;?>
                      </span><br class="p-0 m-0">
                                                              <span class="" style="display:inline-block ; width:20px;height:2px;background: ;" ></span>
          
                       <span class="text-muted small p-0 m-0">
                                  <?php echo $time ? $time :'' ;?>
                       </span><br>

                    </div>
                  

            
            <p>
             <?php echo $msg['message'] ? $msg['message'] :'' ;?>
            </p>   
        </div>
        <div class="col-1 d-flex flex-column justify-content-end">

              <!--  <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">               
                    <li><a class="dropdown-item" onclick="edit(event,'<?php echo $msg['id'];?>','<?php echo $msg['message'];?>')"  id="" href="#">edit</a></li>
                    <li><a class="dropdown-item" id="" href="#">delete</a></li>
                  </ul>
              </div>  -->

              <div class="mt-auto" >
<!-- seen notification -->
        <?php
                if(!$msg['seen']){
                       $seenMessage = $chatClass->seenMessage($msg['id']);
                       if($seenMessage){// my_id to refresh his box only?>
                            <script type="text/javascript">
                          socket.emit('msg_seen','<?php echo $msg['my_id'] ?>','<?php echo $msg['other_id'] ?>');
                          refreshUsersChatList();
                          refreshUsersChatListNav();
                            </script>
        <?php    } }
               ?>               
               

<!-- ======= -->
              </div>        
        </div>

    </div>
</div>

    <!-- =============================================================================== -->

    <?php
        }
     }
   }else{ ?>
                <div class="col-12 text-center">
                   <span> start chat now ...... </span>
                </div>

   <?php }


   


 ?>

 <script type="text/javascript">
     
    
      


        

 </script>








