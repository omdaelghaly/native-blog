


    <div class="d-flex align-items-center justify-content-between">
      <a href="/index.php" class="logo d-flex align-items-center">
        <img src="/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">
        <?php echo Env::siteName; ?>
        </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown" id="userschatlistnav">
         <?php
           // include('userschatNav.php');
         ?>
        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

<?php if(isset($_SESSION['email'])) { ?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="./../profiles/index.php" data-bs-toggle="dropdown">
            <img src="/assets/images/profiles/<?php echo $_SESSION['image'] ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
            <?php echo $_SESSION['name']? $_SESSION['name']:' ';?>
            </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo isset($_SESSION['name'])? $_SESSION['name']:' ';?></h6>
              <span><?php echo isset($_SESSION['job'])? $_SESSION['job']:' ';?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center"  href="/components/profiles/index.php" >
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center"  href="/components/profiles/index.php" >
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" id="logoutBtn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
<?php }else{ ?>

   <a class="nav-link nav-profile d-flex align-items-center pe-0" href="/components/auth/index.php" >
            <span class=" ps-2">login</span>
          </a><!-- End Profile Iamge Icon -->


          <?php } ?>







      </ul>
    </nav><!-- End Icons Navigation -->


<script>
$(document).ready(function(){
    $('#logoutBtn').click(function(e){
        e.preventDefault(); // Prevent default action of the link
        
        // AJAX request
        $.ajax({
            url: './../../controllers/logout.php',
            type: 'GET',
            success: function(response) {
              var res = JSON.parse(response);
                  console.log(res);
                // Redirect to the desired location
                window.location.href = '/';
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });


 function refreshUsersChatListNav() {///chat box
        $.ajax({
            url: '/components/inc/userschatNav.php', 
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('#userschatlistnav').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
            $(document).ready(function() {
               scrollToBottom();
             });
            
    }
     refreshUsersChatListNav();


socket.on('new_msg_s',(mmy_id,uu_id)=>{
   if(uu_id==='<?php echo $_SESSION['id']; ?>'){
     
      refreshUsersChatListNav();
      
  

      console.log('chat box refresh reciever');
                  scrollToBottom();

    }    
})
});

</script>

