
<?php


  $u_id= isset($_GET['u_id']) && is_numeric($_GET['u_id'])? intval($_GET['u_id']) :0 ;
  if (!$u_id) {
    echo "<script>window.location.href = './../../../pages-error-404.php';</script>";
    exit();
  }

    $check_id= $funClass->getUser('users','email',$u_id)  ;
    if(!$check_id){
      echo "<script>window.location.href = './../../../pages-error-404.php';</script>";

    }
    


?>
<script type="text/javascript">
  let u_id='<?php echo $u_id ?>';
 
</script>




  <header id="header" class="header d-flex align-items-center">


    <div id="currentUser" class="d-flex align-items-center justify-content-between">
          <!-- current user data -->
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center" id="userschatlist">

      <?php
        // include('./userschat.php')
      ?>

      </ul>
    </nav><!-- End Icons Navigation -->
</header>

<br>
<!-- ==========================chat box ==========================================-->
<div class="container " id="messagesBox" style="min-height: 350px;max-height:400px;overflow-y:scroll;overflow-x: hidden;scroll-behavior:smooth   ; ">
          <div class="col-12 text-center">
                <span class="spinner-border spinner-border-xl "
                  style="margin-top:50px" role="status" aria-hidden="true"></span>
          </div>
    <!-- chat messagessssssss here -->

</div>

<!--================================== input send ===============================-->
<div class="container" style="min-height: 70px;background:;">
<div class="col-12  my-1" >
   

   <form action=""  class="input-button d-flex" id="form-msg" enctype="multipart/form-data" >

      <input type="text" dir="rtl"  name="msg" id="msg" class="form-control" >
      <input type="text" hidden id="u_id"  name="u_id"  style="display: none;"  value="<?php echo $u_id; ?>"  >
    <button id="save-msg" type="submit" style="width:50px;height:50px" class="btn btn-sm btn-primary rounded-circle"><i class="bi bi-send "></i></button>

   </form>
   
</div>
</div>


<div>
<audio src="/assets/sounds/msg.mp3" id="soundMsg" ></audio>  
<?php
   include('./plus/edit.php');
   include('./plus/delete.php');
   

?>
</div>


<!-- ========================= ========================= -->

<script type="text/javascript">

   function refreshMessagesBox(u_id) {///chat box
        $.ajax({
            url: './chatMessages.php?u_id='+u_id, 
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('#messagesBox').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
            $(document).ready(function() {
               scrollToBottom();
             });
    }
 refreshMessagesBox(u_id);
  
//reftresh users chat menu
   function refreshUsersChatList() {///chat box
        $.ajax({
            url: './userschat.php', 
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('#userschatlist').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
            $(document).ready(function() {
               scrollToBottom();
             });
    }
 refreshUsersChatList();

 //reftresh users chat menu nav
   function refreshUsersChatListNav() {///chat box
        $.ajax({
            url: './../inc/userschatNav.php', 
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

 // user data in head chat box
   function refreshCurrentUser(u_id) { 
        $.ajax({
            url: './currentUser.php?u_id='+u_id, 
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('#currentUser').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
 refreshCurrentUser(u_id);   

 //change user chat box to another user && refresh all u_id
    function setu_id(e,u_id) {
        e.preventDefault();
         $('#u_id').val(u_id); //set id user in form
        refreshMessagesBox(u_id);
        refreshCurrentUser(u_id);   
  } 
/////////scroll bottom

  function scrollToBottom() {
        var scrollDiv = $("#messagesBox");
        if(scrollDiv){
         scrollDiv.scrollTop(scrollDiv.prop("scrollHeight"));
        }
      }
      

/////////////////////////////////////send////////////////////////////////////////////////////
    $('#form-msg').submit(function(e) {
        e.preventDefault(); // Prevent normal form submission
        $('#save-msg').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... `);
        var formData = new FormData(this);
         formData.append('process','sendMsg');

    $.ajax({
            url: './../../controllers/chatController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              $('#save-msg').prop('disabled', false).removeClass('disabled').html('<i class="bi bi-send "></i>');
              $('#msg').val('');
              
                    refreshMessagesBox(u_id);// refresh current user =>sender
                          console.log('chat box refresh sender');
                      scrollToBottom();

                     socket.emit('new_msg','<?php echo $_SESSION['id']; ?>',u_id);

              var res = JSON.parse(response);
            //  console.log(res);
                //alert('Data saved successfully.');
                // Additional code to handle the response if needed
            },
            error: function(xhr, status, error) {
              $('#save-msg').prop('disabled', false).removeClass('disabled').html('<i class="bi bi-send "></i>');

                alert('Error occurred. Please try again.');
            }
        });

  });


  $(document).ready(function() {

            scrollToBottom();

        function playAudio(){
          let audio = document.getElementById("soundMsg");
            audio.muted = false; 
           scrollToBottom(); 
           audio.play();        
        }
   

////////////////////////socket//////////
// msg from uuid to mmyid
socket.on('msg_seen_s',(mmy_id,uu_id)=>{
   if(mmy_id==='<?php echo $_SESSION['id']; ?>'){
      refreshMessagesBox(uu_id);
      refreshUsersChatList();   
      //refreshCurrentUser(uu_id);   

      console.log('chat box refresh reciever');
    }    
})
// myid here is the other user id recieve ms 
socket.on('new_msg_s',(mmy_id,uu_id)=>{
   if(uu_id==='<?php echo $_SESSION['id']; ?>'){
      playAudio();
      refreshMessagesBox(mmy_id);
      refreshUsersChatList();
      refreshUsersChatListNav();
      //refreshCurrentUser(mmy_id); 
      console.log('hello');  
  

      console.log('chat box refresh reciever');
                  scrollToBottom();

    }    
})




})

/////////////edit-delet msg///////////////////
   
          function editMsg(e,msg_id,msg) {
            e.preventDefault();

             $('#msg_id').val(msg_id);
             $('#msg_edit').val(msg);
             $('#plus-edit-msg').click();

              // console.log(msg_id);
          }

          function deleteMsg(e,msg_id) {
            e.preventDefault();

             $('#del_msg_id').val(msg_id);
             $('#plus-delete-msg').click();

              // console.log('id msg = '+msg_id);
          }









// // /////////////////change page param///////////
//      function userParams(e,chatId,u_id) {
        
//            e.preventDefault();
//                    console.log(chatId+'--'+u_id);
//         var currentURL = window.location.href;
//         let newurl =updateURLParam(currentURL, chatId, u_id);
//                 console.log('this is url '+newurl+ ' hellp');

//         // // Update the browser's address bar
//          history.pushState({}, '', newurl);

//         }

//         function updateURLParam(urlx, newChatId, newU_id) {
//              // Extract the current parameters from the URL
//                      var url = new URL(urlx);

//              var params = new URLSearchParams(url.search);

//              // Update the parameters with new values
//              params.set('chatId', newChatId);
//              params.set('u_id', newU_id);

//              // Rebuild the URL with the updated parameters
//              var updatedURL = url.origin + url.pathname + (params.toString() ? '?' + params.toString() : '');
//              console.log('updat '+updatedURL);
//              return updatedURL;
//         }
            
</script>

<!-- ===================================== -->
