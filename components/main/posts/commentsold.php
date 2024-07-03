<?php
include('./../../../classes/All.php');
session_start();

   $env = new Env;
   $funClass = new Fun;
   $mysqli = $env->connect();
   $getComments = new Comment;


   $postId= isset($_GET['post_id']) && is_numeric($_GET['post_id'])? intval($_GET['post_id']) :false ;
if($postId){
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


<div class="col-12 comments my-1" >
   <?php
      if(isset($_SESSION['id'])){?>

   <form action=""  class="input-button d-flex" id="form-comment<?php echo $post['id'] ?>" enctype="multipart/form-data" >

          <?php
              
                   $my_img= $funClass->getUser('users','image',$_SESSION['id']) ;  
                          
          ?>    
  <a class=""  href="/components/profiles/index.php" >
    <img src="/assets/images/profiles/<?php echo $my_img ? $my_img :'' ;    ?> " class="card-icon rounded-circle d-flex align-items-center justify-content-center">
  </a> 
    <input type="file" name="images[]" id="upload-photo" style="display: none;" accept=".jpg, .jpeg, .png, .gif" multiple>
              <label for="upload-photo" class="btn btn-sm my-3"><i class="fas fa-camera"></i> </label>
    <input type="file"  name="files[]" id="upload-file" style="display: none;" accept=".docx, .doc, .pdf" multiple>
              <label for="upload-file" class="btn btn-sm my-3 "><i class="fas fa-file"></i></label>
      <input type="text" dir="rtl"  name="comment" id="comment" class="form-control" >
      <input type="text" hidden  name="post_id"  style="display: none;"  value="<?php echo $post['id'] ?>"  >
    <button id="save-comment" type="submit" class="btn btn-sm btn-primary rounded-circle"><i class="bi bi-send "></i></button>

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

    <!-- =====================post============================== -->
    <div class="container col-12">
      <div class="row p-0 m-0" style="text-align:right;">

      

         <div class="postContainer">
                     <p class="postText" style="font-size:18px">
                     <?php echo $comment['comment']  ;?> 
                       التعليم هو مفتاح التقدم والتطور في أي مجتمع. يعتبر الاستثمار في التعليم استثمارًا حقيقيًا في مستقبل الأمم. من خلال بناء قاعدة تعليمية قوية، يمكن للدول تحقيق النمو الاقتصادي والاجتماعي المستدام. يجب أن تكون التعليم متاحًا ومناسبًا للجميع دون تمييز، ويجب توفير البيئة المناسبة لتحفيز الطلاب على التعلم والابتكار. إن التزام الحكومات والمجتمعات بتعزيز التعليم يمثل خطوة أساسية نحو بناء مجتمعات مستدامة ومزدهرة."

                     </p>
  <button class="read-more">Read more</button>
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



              <img class="col-12 p-0 m-0" <?php echo $i_p>0?'style="display:none;height:200px"':'style="height:200px"' ?>  id="<?php  echo $post['id'].'i'.$comment['id'].'c'.$i_p;  ?>"
              src="/assets/images/posts/images/<?php echo   $c_image    ?>" class="img-fluid p-0 m-0">

             
<?php               $i_p++;
 } ?>
<button  onclick="showHideComment('<?php  echo $post['id'] ?>','<?php echo $comment['id']?>','<?php echo $countc;?>')" id="showHideBtn<?php  echo $post['id'].'c'.$comment['id'] ?>"
               style="position:absolute;top:100px;left:90%;cursor: pointer" ><?php echo $countp; ?>++</button>
</div>


<?php       }?>
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
    <span style="cursor: pointer;"  onclick="setCommentLike(<?php echo $post['id'] ?>,<?php echo $comment['id'] ?>)" id="allPostLikes<?php echo $post['id'].'c'.$comment['id']  ?>" class="red" ><i class="fas fa-2x fa-thumbs-up"></i> 
      <span id="allPostLikesNum<?php echo $post['id'].'c'.$comment['id']  ?>"><?php echo $likesc ? $likesc :'0'?></span>  
    </span>

<?php
}else{ ?>
    <span style="cursor: pointer;"  onclick="setCommentLike(<?php echo $post['id'] ?>,<?php echo $comment['id'] ?>)" id="allPostLikes<?php echo $post['id'].'c'.$comment['id']  ?>"  ><i class="fas fa-2x fa-thumbs-up"></i> 
      <span id="allPostLikesNum<?php echo $post['id'].'c'.$comment['id']  ?>"><?php echo $likesc ? $likesc :'0'?></span>  
    </span>
<?php } ?>



<span style="cursor: pointer;"  onclick="showHideAllPostCommentsDiv(<?php echo $post['id'] ?>)">
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
               $('#AreaEdit').val('<?php echo $comment['comment'] ; ?>');
               $('#edit-id').val('<?php echo $comment['id'] ; ?>');
               $('#post-id').val('<?php echo $post['id'] ; ?>');
               $('#edit-table').val('comments');
               $('#edit-status').val('comment');
               

       })      
       
       $('#comment-delete<?php echo $comment['id']; ?>').click((e)=>{
               e.preventDefault();
               $('#plus-delete').click();
               $('#delete-id').val('<?php echo $comment['id'] ; ?>');
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
          $('#form-comment<?php echo $post['id'] ?>').submit(function(e) {
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
        socket.emit('new_comment',formData);
                    
              // $.ajax({
              //     url: './../../controllers/commentController.php',
              //     type: 'POST',
              //     data: formData,
              //     contentType: false,
              //     processData: false,
              //     success: function(response) {
              //       $('#save-comment').prop('disabled', false).removeClass('disabled').html('<i class="bi bi-send"></i>');
              //       $('#comment').val('');
              //       $('#upload-photo').val('');
              //       $('#upload-file').val('');

      
              //       var res = JSON.parse(response);
              //       console.log(res);
              //         //alert('Data saved successfully.');
              //         // Additional code to handle the response if needed
              //     },
              //     error: function(xhr, status, error) {
              //       $('#save-comment').prop('disabled', false).removeClass('disabled').html('<i class="bi bi-send"></i>');
      
              //         alert('Error occurred. Please try again.');
              //     }
              //});
          });
      });
        
        
      
      
      ///////////////



      

     





      
        
          
      </script>




