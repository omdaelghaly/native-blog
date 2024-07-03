<?php
include('./../../../classes/All.php');

session_start();

   $env = new Env;
   $funClass = new Fun;
   $mysqli = $env->connect();
   $getComments = new Comment;


$postId= isset($_GET['post_id']) && is_numeric($_GET['post_id'])? intval($_GET['post_id']) :false ;

 //echo $postId .'<br>';
 $comments = $getComments->getComments($postId);
if($comments){


function renderComments($comments) {
    echo '<ul dir="rtl">';
    foreach ($comments as $comment) {
        echo '<li>';
        echo '<div>';
        // echo $comment['level'];
        echo '<p>' . $comment['comment'] ;?>
              <span style="cursor: pointer;"  onclick="popreply(<?php echo $comment['post_id'] ?>,<?php echo $comment['id'] ?>)"><i class="fas fa-2x fa-reply"></i>
             </span>
      <?php
       echo  '</p>'; // Output comment content
        if (!empty($comment['images'])) {
            echo '<p>Images: ' . implode(', ', $comment['images']) . '</p>'; // Output images
        }
        if (!empty($comment['files'])) {
            echo '<p>Files: ' . implode(', ', $comment['files']) . '</p>'; // Output files
        }

        echo '</div>';
        if (!empty($comment['replies'])) {
            renderComments($comment['replies']); // Recursive call to render child comments
        }
        echo '</li>';
    }
    echo '</ul>';
}

// Output the comments
renderComments($comments);





}else{
?>
<div>
   no comments yet............
</div>

<?php
}

?>
