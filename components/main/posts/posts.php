<?php
include('./../../../classes/All.php');
session_start();

   $env = new Env;
   $funClass = new Fun;
   $getPosts = new Post;


   include('./../plus/edit.php');
   include('./../plus/delete.php');
    include('./addreply.php');



$posts = $getPosts->getPosts();

// if ($result) {
//     $posts = array();

//     while ($row = mysqli_fetch_assoc($result)) {
//          $postId = $row['id'];
//         // $user_id = $row['user_id'];

//         if (!isset($posts[$postId])) {
//             $posts[$postId] = array(
//                 'id' => $postId,
//                 'post' => $row['post'],
//                 'user_id' => $row['user_id'],
//                 'time' => $row['time'],
//                 'images' => array(),
//                 'files' => array()
//             );
//         }

//         if (!empty($row['i_name'])) {
//             $posts[$postId]['images'][] = $row['i_name'];
//         }

//         if (!empty($row['f_name'])) {
//             $posts[$postId]['files'][] = $row['f_name'];
//         }

// }

    

?>
<!-- <div id='omda'>gg</div>
 --><?php
    foreach ($posts as $post) {
     


?>
         
         
         
            <!-- Customers Card -->
         
            <div class="col-xxl-4 col-xl-12 " id="post<?php echo $post['id'];?>">

              <div class="card info-card customers-card ">
<!-- edit option -->
 <?php if(isset($_SESSION['id'])&& $_SESSION['id']===$post['user_id'] ){?>

              <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <!-- <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li> -->

                    <li><a class="dropdown-item" id="edit<?php echo $post['id'];?>" href="#">edit</a></li>
                    <li><a class="dropdown-item" id="delete<?php echo $post['id'];?>" href="#">delete</a></li>
                  </ul>
            </div>
<?php 
}?>
          <div class="card-body p-0 m-0">

              <div class="d-flex align-items-center p-1">
                    <?php
                       $img= $funClass->getUser('users','image',$post['user_id']) ;
                       
                    ?>
                 <a href="#" onclick="getProfilePage(<?php echo $post['user_id'];?>,<?php echo isset($_SESSION['id'])?$_SESSION['id']:0 ?>)" >

                        <img src="/assets/images/profiles/<?php echo $img ? $img :'' ;    ?> " class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                  </a>  
                    
                  <div class="ps-2 ">
                      <span class="fw-bold">
                      <?php echo $funClass->getUser('users','name',$post['user_id'])  ?>
                      </span><br>
                      <span class="text-danger small pt-1 fw-bold">
                      
                      </span>
                       <span class="text-muted small pt-2 ps-1">
                       <?php echo $funClass->getTime($post['time'])  ?>
                       </span>

                    </div>
                  </div>

<!-- =====================post============================== -->
                  <div class="container col-12">
                    <div class="row p-0 m-0" style="text-align:right;">

                <div class="postContainer">
                     <p class="postText" style="font-size:23px">
                     <?php echo $post['post'] ;?>                     
                   
                     </p>
  <button class="read-more">Read more</button>
                   </div>

<!-- images==================================================== -->
<?php 
        if (!empty($post['images'])) {?>
         <div class="col-12 p-0 m-0" style="position:relative">
 <?php
                   $i_p=0;
        foreach ($post['images'] as $image_p) {
            $countp= count($post['images']);
            // echo $countp;
?>


              <img class="col-12 p-0 m-0" <?php echo $i_p>0?'style="display:none;height:200px"':'style="height:200px"' ?>  id="<?php  echo $post['id'].'i'.$i_p;  ?>"
              src="/assets/images/posts/images/<?php echo   $image_p    ?>" class="img-fluid p-0 m-0">

             
<?php              
 $i_p++;
 } 
   if($countp >1){ //show btn if img >1
 ?>
<button   onclick="showHide('<?php  echo $post['id'] ?>',<?php echo $countp;?>)" id="showHideBtn<?php  echo $post['id'] ?>"
               style="position:absolute;top:100px;left:90% ;cursor: pointer" ><?php echo $countp; ?>++</button>
</div>


<?php      
               }

 }?>



<!-- end images================================================== -->
<!-- files========================================================== -->
<div class="col-12 p-1 mb-1  d-flex justify-content-end">
<?php 
      
      if (!empty($post['files'])) {
        $countf= count($post['files']);
            // echo $countf;

         foreach ($post['files'] as $file) {
          $fileExt = explode('.', $file);
          $Ext = strtolower(end($fileExt));
        // echo $Ext;
          $img='unknown.png';
          if($Ext==='pdf'){ $img='pdf.jpeg';}
          elseif( $Ext==='doc'|| $Ext==='docx'){$img='word.jpg';}
          

?>
 <div style="width:100px;height:100px;position:relative" class="mx-1">
    <a class="icon" style="z-index:300;position:absolute;" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li><a class="dropdown-item" target="_blank"  href="/showFile.php?file=<?php echo $file ?>">preview</a></li>
        <li><a class="dropdown-item" download href="/assets/images/posts/files/<?php echo $file ?>">download</a></li>
    </ul>
    
    <img style="width:100px;height:100px"  src="/assets/images/posts/files/<?php echo $img ? $img : ''; ?>" class="img-fluid p-0 m-0">
     <span class="aa" style=""><?php echo $file  ?></span>
</div>

 
<?php
     } }                                               
?>
</div>
<!-- end files======================================================= -->
<!-- like buttons==================================================== -->

<div>
<?php
   $sessionID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
   $postLikesNum = $funClass->likesNum($post['id'],null, $sessionID);
   $commentNum = $funClass->commentNum($post['id']);
     $commentData = json_decode($commentNum);
     $comNum= $commentData->data->num;
     $postData = json_decode($postLikesNum);
     $likesp= $postData->data->num;
     $ulike =$postData->data->u_like;
?>
<hr class="mb-0 pb-0">
<div class=" d-flex justify-content-around">


<?php 
if($ulike){ ?>
    <span style="cursor: pointer;" onclick="setPostLike(<?php echo $post['id'] ?>)" id="allPostLikes<?php echo $post['id'] ?>" class="red" ><i class="fas fa-2x fa-thumbs-up"></i> 
      <span id="allPostLikesNum<?php echo $post['id'] ?>"><?php echo isset($likesp) ? $likesp :'0'?></span>  
    </span>

<?php
}else{ ?>
    <span style="cursor: pointer;"  onclick="setPostLike(<?php echo $post['id'] ?>)" id="allPostLikes<?php echo $post['id'] ?>"  ><i class="fas fa-2x fa-thumbs-up"></i> 
      <span id="allPostLikesNum<?php echo $post['id'] ?>"><?php echo isset($likesp) ? $likesp :'0'?></span>  
    </span>
<?php } ?>



<span style="cursor: pointer;"  onclick="showHideAllPostCommentsDiv(<?php echo $post['id'] ?>)"><i class="fas fa-2x fa-comments"></i> 
<span>   <?php echo isset($comNum) ? $comNum :'0'?>   </span>
</span>

</div>

<!--  -->
<!-- comments======================================================== -->
<hr class="mt-0 pt-0">
<div class="col-12 comments my-1 container" style="display:none" id="allPostCommentsDiv<?php echo $post['id'] ?>">
<?php
 // include('comments.php');
?>
</div>

<script type="text/javascript">
  $(document).ready(()=> {
    // Call the refreshComents function initially
    refreshComments(<?php echo $post['id'] ?>);
});

     
</script>

<!-- end comments================================================ -->

 </div>
                    </div>
                  </div>
                  <!-- =====================post============================== -->

                </div>
              </div>

            </div><!-- End Customers Card -->


<!-- edit delete==================================================== -->
<style>
.red{
  color:red
}
</style>

<script>
     ////////show box modal delete edit

     $(document).ready(()=>{
      $('#edit<?php echo $post['id']; ?>').click((e)=>{
               e.preventDefault();
               $('#plus-edit').click();
               $('#AreaEdit').val(`<?php echo $post['post'] ; ?>`);
               $('#edit-id').val('<?php echo $post['id'] ; ?>');
               $('#edit-table').val('posts');
               $('#edit-status').val('post');

       })      
       
       $('#delete<?php echo $post['id']; ?>').click((e)=>{
               e.preventDefault();
               $('#plus-delete').click();
               $('#delete-id').val('<?php echo $post['id'] ; ?>');
               $('#delete-table').val('posts');
               $('#delete-status').val('post');
               

       })



     

     })

//photos
     function showHide(pid,length){
         var val_x='';
        for (let index = 0; index < length; index++) {
           if(index !=0){
                $('#'+pid+'i'+index).toggle();
           }
        }
        val_x=$('#showHideBtn'+pid).text();
        if(val_x===length+'++'){
          $('#showHideBtn'+pid).text(length+'--');
        }else{
          $('#showHideBtn'+pid).text(length+'++');
        }
      
      }

// comments////////////////////////////////////////////
function showHideAllPostCommentsDiv(postId){
  $('#allPostCommentsDiv'+postId).toggle();

}
function xLike(process,postId,commentId){

  var form_data = new FormData();
      form_data.append('process',process);   
      form_data.append('post_id',postId);   
      form_data.append('comment_id',commentId);    
  $.ajax({
            url: './../../controllers/processController.php',
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response) {
              var res = JSON.parse(response);
              console.log(res);
                //alert('Data saved successfully.');
                // Additional code to handle the response if needed
            },
            error: function(xhr, status, error) {

                alert('Error occurred. Please try again.');
            }
        });
        

}
///////////////////////////////////////////////////////
//setlike
function setPostLike(postId){
  var sessionId ='<?php echo isset($_SESSION['id'])?$_SESSION['id']:false;?>';
  var el = document.getElementById('allPostLikes'+postId);
  var numLikes = $("#allPostLikesNum"+postId).text();
  //console.log($('#allPostLikes'+postId).classList);
      if(el){
        if(sessionId){
            if (el.classList.contains("red")) {
                        // Class "red" exists, so remove it
                        el.classList.remove("red");
                          // console.log(Number(numLikes)+1);
                          $("#allPostLikesNum"+postId).text((Number(numLikes)-1));


            } else {
                        // Class "red" does not exist, so add it
                        el.classList.add("red");
                        $("#allPostLikesNum"+postId).text((Number(numLikes)+1));
            }
            //like unlike
            xLike('like',postId,'')
          }else{
            alert(' يجب عليك التسجيل اولا لكى تتمكن من عمل اعجاب للبوست');
          }
      }else{
        console.log('no element');
      }      
}

///////comment like
function setCommentLike(postId,commentId){
    var sessionId ='<?php echo isset($_SESSION['id'])?$_SESSION['id']:false;?>';
  var el = document.getElementById('allPostLikes'+postId+'c'+commentId);
  var numLikes = $("#allPostLikesNum"+postId+'c'+commentId).text();
  //console.log($('#allPostLikes'+postId).classList);
      if(el){
        if(sessionId){
            if (el.classList.contains("red")) {
                        // Class "red" exists, so remove it
                        el.classList.remove("red");
                          // console.log(Number(numLikes)+1);
                          $("#allPostLikesNum"+postId+'c'+commentId).text((Number(numLikes)-1));


            } else {
                        // Class "red" does not exist, so add it
                        el.classList.add("red");
                        $("#allPostLikesNum"+postId+'c'+commentId).text((Number(numLikes)+1));
            }
            //like unlike
            xLike('like',postId,commentId);
        }else{
          alert(' يجب عليك التسجيل اولا لكى تتمكن من عمل اعجاب للكومنت');
        }  
      }else{
        console.log('no element c');
      }      
}
///////////////

///redirect to profile
function getProfilePage(u_id,my_id){
    if(u_id===my_id){
      window.location.href = '/components/profiles/index.php';
    }else{
      window.location.href = '/components/profiles/index2.php?u_id='+u_id;

    }

}

</script>









<?php

         
        }
    
    //     mysqli_free_result($result);
    // }

?>






<script >
  
   function refreshComments(post_id) {
        $.ajax({
            url: '/components/main/posts/comments.php?post_id='+post_id, 
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('#allPostCommentsDiv'+post_id).html(response);
                // console.log('kkkkkkkk');

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


socket.on('new_comment_s',(postId)=>{

  refreshComments(postId);
    console.log('comment refresh---'+postId);
      
})
</script>

<link rel="stylesheet" type="text/css" href="/assets/css/postDivResize.css">

<script type="text/javascript" src="/assets/js/postDivResize.js"></script>
