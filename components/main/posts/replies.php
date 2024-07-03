<?php
include('./../../../classes/All.php');
session_start();

   $env = new Env;
   $funClass = new Fun;
   $mysqli = $env->connect();
   $getComments = new Comment;


   $commentId= isset($_GET['comment_id']) && is_numeric($_GET['comment_id'])? intval($_GET['comment_id']) :false ;
if($commentId){
?>

<!-- // $connection = new mysqli('localhost', 'root', '', 'blog1');

// $query = "SELECT comments.*,comment_images.i_name , comment_files.f_name
//           FROM comments
//           LEFT JOIN comment_images ON comments.id = comment_images.comment_id
//           LEFT JOIN comment_files ON comments.id = comment_files.comment_id
//           WHERE comments.post_id =  $postId ";
// $result = $mysqli->query($query);
 -->

         
         

<!-- comments======================================================== -->


<div class="container replies my-1 ml-3 pl-2" >
   <?php
      if(isset($_SESSION['id'])){?>

   <form action=""  class="input-button d-flex" id="form-comment<?php echo $postId ?>" enctype="multipart/form-data" >

          <?php
              
                   $my_img= $funClass->getUser('users','image',$_SESSION['id']) ;  
                          
          ?>    
  <a class=""  href="/components/profiles/index.php" >
    <img src="/assets/images/profiles/<?php echo $my_img ? $my_img :'' ;    ?> " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
  </a> 


      <input type="text" dir="rtl"  name="reply" id="reply" class="form-control" >
      <input type="text" hidden  name="comment_id"  style="display: none;"  value="<?php echo $commentId ?>"  >
    <button id="save-reply" type="submit" class="btn btn-sm btn-primary rounded-circle"><i class="bi bi-send "></i></button>

   </form>
   <?php
      }
      else{ ?>
      <div class="col=12 text-center">
       <?php echo " يجب عليك التسجيل اولا لكى تتمكن من التعليق" ;?>
      </div>
      <?php
      };
      ?>
</div>





<!-- show comments -->

 
<?php

$comments = $getComments->getComments($postId);

  // if ($result) {
    // $comments = array();

    // while ($row = mysqli_fetch_assoc($result)) {
    //      $commentId = $row['id'];
    //     // $user_id = $row['user_id'];

    //     if (!isset($comments[$commentId])) {
    //         $comments[$commentId] = array(
    //             'id' => $commentId,
    //             'comment' => $row['comment'],
    //             'user_id' => $row['user_id'],
    //             'post_id' => $row['post_id'],
    //             'time' => $row['time'],
    //             'images' => array(),
    //             'files' => array()
    //         );
    //     }

    //             if (!empty($row['i_name'])) {
    //                 if(!in_array($row['i_name'],$comments[$commentId]['images'])){
    //                   $comments[$commentId]['images'][] = $row['i_name'];
    //                 }
    //              }      
    //               if (!empty($row['f_name'])) {
    //                   if(!in_array($row['f_name'],$comments[$commentId]['files'])){
    //                     $comments[$commentId]['files'][] = $row['f_name'];
    
    //                   }
    //               }
    // }
      
    foreach ($comments as $comment) {
                 ?>

<!-- ============================================================================================== -->

         
<div class="col-xxl-4 col-xl-12 " id="comment<?php echo $comment['id'] ?>">
<div class="card info-card customers-card ">
<!-- edit option show -->
<?php if(isset($_SESSION['id'])&& $_SESSION['id']===$comment['user_id'] ){?>

<div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <li class="dropdown-header text-start">
        <!-- <h6>Filter</h6> -->
      </li>

      <li><a class="dropdown-item" id="comment-edit<?php echo $comment['id'];?>" href="#">edit</a></li>
      <li><a class="dropdown-item" id="comment-delete<?php echo $comment['id'];?>" href="#">delete</a></li>
    </ul>
</div>
<?php 
}?>
<div class="card-body p-0 m-0">

<div class="d-flex align-items-center p-1">
      <?php
         $img= $funClass->getUser('users','image',$comment['user_id']) ;
         
      ?>
          <img src="/assets/images/profiles/<?php echo $img ? $img :'' ;    ?> " class="card-icon rounded-circle d-flex align-items-center justify-content-center">

      
      
    <div class="ps-2 ">
        <span class="fw-bold">
        <?php echo $funClass->getUser('users','name',$comment['user_id'])  ?>
        </span><br>
        <span class="text-danger small pt-1 fw-bold">
        
        </span>
         <span class="text-muted small pt-2 ps-1">
         <?php echo $funClass->getTime($comment['time'])  ?>
         </span>

    </div>
</div>

    <!-- =====================comments============================== -->
    <div class="container col-12">
      <div class="row p-0 m-0" style="text-align:right;">

      

         <div class="commentContainer">
                     <p class="commentText" style="font-size:18px">
                     <?php echo $comment['comment']  ;?> 
                     
                     </p>
  <button class="read-more-c">Read more</button>
                   </div>


<!-- images==================================================== -->


<?php 
        if (!empty($comment['images'])) {?>
         <div class="col-12 p-0 m-0" style="position:relative">
 <?php
                   $i_p=0;
        foreach ($comment['images'] as $c_image) {
            $countc= count($comment['images']);
            // echo $countc;
?>



              <img class="col-12 p-0 m-0" <?php echo $i_p>0?'style="display:none;height:200px"':'style="height:200px"' ?>  id="<?php  echo $postId.'i'.$comment['id'].'c'.$i_p;  ?>"
              src="/assets/images/posts/images/<?php echo   $c_image    ?>" class="img-fluid p-0 m-0">

             
<?php               
$i_p++;
 }
   if($countc >1){ //show btn if img >1
  ?>
<button  onclick="showHideComment('<?php  echo $postId ?>','<?php echo $comment['id']?>','<?php echo $countc;?>')" id="showHideBtn<?php  echo $postId.'c'.$comment['id'] ?>"
               style="position:absolute;top:100px;left:90%;cursor: pointer" ><?php echo $countc; ?>++</button>
</div>


<?php       
         }
}?>
<!-- end images================================================== -->
<!-- files========================================================== -->
<div class="col-12 p-1 mb-3 d-flex justify-content-end">
<?php 

if (!empty($comment['files'])) {
  $countc= count($comment['files']);
// echo $countc;
foreach ($comment['files'] as $file_c) {
$fileExt = explode('.', $file_c);
$Ext = strtolower(end($fileExt));
// echo $Ext;
$cf_image='unknown.png';
if($Ext==='pdf'){ $cf_image='pdf.jpeg';}
elseif( $Ext==='doc'|| $Ext==='docx'){$cf_image='word.jpg';}


?>



  <div style="width:100px;height:100px"> 
 <a class="icon" style="z-index:300;position:absolute;" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li><a class="dropdown-item" target="_blank"  href="/showFile.php?file=<?php echo $file_c ?>">preview</a></li>
        <li><a class="dropdown-item" download href="/assets/images/posts/files/<?php echo $file_c ?>">download</a></li>
    </ul>
    
    <img style="width:100px;height:100px"  src="/assets/images/posts/files/<?php echo $cf_image ? $cf_image : '';    ?>" class="img-fluid p-0 m-0">
    <span class="aa" style=""><?php echo $file_c  ?></span>
 
 </div> 
     







<?php
}}
?>

</div>

<!-- ==================== -->
<!-- ----------btn like comment----- -->

<hr class="my-1 pb-0">
<div class=" d-flex justify-content-around">
<?php
   $sessionID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
   $commentLikesNum = $funClass->likesNum($postId,$comment['id'],$sessionID);
    $cData = json_decode($commentLikesNum);
    $likesc= $cData->data->num;
    $uzlike =$cData->data->u_like;
?>

<?php 
if($uzlike){ ?>
    <span style="cursor: pointer;"  onclick="setCommentLike(<?php echo $postId ?>,<?php echo $comment['id'] ?>)" id="allPostLikes<?php echo $postId.'c'.$comment['id']  ?>" class="red" ><i class="fas fa-2x fa-thumbs-up"></i> 
      <span id="allPostLikesNum<?php echo $postId.'c'.$comment['id']  ?>"><?php echo isset($likesc) ? $likesc :'0'?></span>  
    </span>

<?php
}else{ ?>
    <span style="cursor: pointer;"  onclick="setCommentLike(<?php echo $postId ?>,<?php echo $comment['id'] ?>)" id="allPostLikes<?php echo $postId.'c'.$comment['id']  ?>"  ><i class="fas fa-2x fa-thumbs-up"></i> 
      <span id="allPostLikesNum<?php echo $postId.'c'.$comment['id']  ?>"><?php echo isset($likesc) ? $likesc :'0'?></span>  
    </span>
<?php } ?>



<span style="cursor: pointer;"  onclick="showHideAllPostCommentsDiv(<?php echo $postId ?>)">
<!-- <i class="fas fa-2x fa-comments"></i> <span>3</span> -->
</span>

</div>


<!-- =================== -->
</div>
</div>
</div>
</div>
</div>

<!-- ----------- -->

<!-- ======================== -->
<script>
////////show box modal delete edit

$(document).ready(()=>{
      $('#comment-edit<?php echo $comment['id']; ?>').click((e)=>{
               e.preventDefault();
               $('#plus-edit').click();
               $('#AreaEdit').val(`<?php echo $comment['comment'] ; ?>`);
               $('#edit-id').val('<?php echo $comment['id'] ; ?>');
               $('#post-id').val('<?php echo $comment['post_id']; ?>');
               $('#edit-table').val('comments');
               $('#edit-status').val('comment');
               

       })      
       
       $('#comment-delete<?php echo $comment['id']; ?>').click((e)=>{
               e.preventDefault();
               $('#plus-delete').click();
               $('#delete-id').val('<?php echo $comment['id'] ; ?>');
               $('#post-id').val('<?php echo $comment['post_id']; ?>');
               $('#delete-table').val('comments');
               $('#delete-status').val('comment');
               

       })


     })


     function showHideComment(pid,cid,length){
         var val_x='';
        for (let index = 0; index < length; index++) {
           if(index !=0){
                $('#'+pid+'i'+cid+'c'+index).toggle();
           }
        }
        val_x=$('#showHideBtn'+pid+'c'+cid).text();
        if(val_x===length+'++'){
          $('#showHideBtn'+pid+'c'+cid).text(length+'--');
        }else{
          $('#showHideBtn'+pid+'c'+cid).text(length+'++');
        }
      
      }




</script>




<link rel="stylesheet" type="text/css" href="/assets/css/commentDivResize.css">

<script type="text/javascript" src="/assets/js/commentDivResize.js"></script>
<!-- ============================================================================================ -->
     <?php
               }
               //}


          }else{
            //no postid
           echo '<div class="col-12 text-center">  لا يوجد تعلقات على هذا المنشور بعد  </div>';
            }     
    ?>
  

<!--  -->
<!-- end comments================================================ -->




<script>

 
   
      
 
   
      $('#save-comment').prop('disabled', true);
            
      
      $(document).ready(function() {
        $('#save-comment').prop('disabled', false)
          $('#form-comment<?php echo $postId ?>').submit(function(e) {
              e.preventDefault(); // Prevent normal form submission
      
              $('#save-comment').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      ... `);
              var formData = new FormData(this);
              var images = $('#upload-photo')[0].files; // Get selected image 
        for (var i = 0; i < images.length; i++) {
            formData.append('images['+i+']', images[i]);
        }
        var files = $('#upload-file')[0].files; // Get selected  files
        for (var i = 0; i < files.length; i++) {
            formData.append('files['+i+']', files[i]);
        }
      
        //console.log(formData);
                    
              $.ajax({
                  url: './../../controllers/commentController.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    $('#save-comment').prop('disabled', false).removeClass('disabled').html('<i class="bi bi-send"></i>');
                    $('#comment').val('');
                    $('#upload-photo').val('');
                    $('#upload-file').val('');

                 socket.emit('new_comment','<?php echo $postId; ?>');

                    var res = JSON.parse(response);
                    console.log(res);
                      //alert('Data saved successfully.');
                      // Additional code to handle the response if needed
                  },
                  error: function(xhr, status, error) {
                    $('#save-comment').prop('disabled', false).removeClass('disabled').html('<i class="bi bi-send"></i>');
      
                      alert('Error occurred. Please try again.');
                  }
              });
          });
      });
        
        
      
      
      ///////////////



      

     





      
        
          
      </script>




