
<?php
session_start();
 include('./../../classes/All.php');
    $chatClass= new Chat;
    $funClass= new Fun;


             $data= $chatClass->getUsersChat('chats', $_SESSION['id']) ;  
             $uzers=$data['uzers'];
             $uzers=array_reverse($uzers);



     
?>
        <li class="nav-item dropdown">

          <a class="nav-link nav-icon d-flex" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-sm-block">My messages </span>
            <i class="fab fa-facebook-messenger fa-lg"></i>
            <span class="badge bg-success badge-number">
              <?php echo isset($data['unseen'])?$data['unseen']:'' ?>
            </span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages" style="height: 420px;overflow-y:scroll">
            <li class="dropdown-header">
              You have <?php echo isset($data['unseen'])?$data['unseen']:0 ?> new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2" hidden>View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

                  <?php foreach ($uzers as $uzer) {
                      $otherUser = ($_SESSION['id'] == $uzer['my_id']) ? $uzer['other_id'] : $uzer['my_id'];

                      $u_img= $funClass->getUser('users','image', $otherUser) ;  
                      $u_name= $funClass->getUser('users','name', $otherUser) ;  
                      $time= $funClass->getTime($uzer['time'])  ;


                   ?>
            <li class="message-item">
              <a href="#" onclick="setu_id(event,<?php echo  $otherUser; ?>)">
                <img src="/assets/images/profiles/<?php echo $u_img ? $u_img :'' ;?>" alt="" class="rounded-circle">
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

               
   <!--          <li class="message-item">
              <a href="#"  onclick="setu_id(event,2)">
                <img src="/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#"  onclick="setu_id(event,3)">
                <img src="/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li> -->

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->
