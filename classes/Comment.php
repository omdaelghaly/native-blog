<?php
 require_once 'Env.php';

class Comment extends Env{
  
    
 


    
// //save file comment
    public function saveFile($files,$saveDIR,$table,$columns,$data)
    {
        $user_id=$data['user_id'];
        $post_id=$data['post_id'];
        $comment_id=$data['comment_id'];
        
      
       foreach ($files['tmp_name'] as $index => $tmpName) {
            $originName = $files['name'][$index];
            $fileName = uniqid().$originName;
            move_uploaded_file($tmpName, $saveDIR.$fileName);

            $DATA = "('$user_id','$post_id','$comment_id','$fileName')";


        // Insert the image det['tmp_name']ails into the database
         $sql = "INSERT INTO $table $columns VALUES $DATA ";

            if (mysqli_query($this->connect(),$sql)=== false) {
               die('Error: ' );
            }
         }

        
    }






    public function getComments($post_id, $parent_id = 0, $x=0) {
        $query = "SELECT comments.*, comment_images.i_name, comment_files.f_name
                  FROM comments
                  LEFT JOIN comment_images ON comments.id = comment_images.comment_id
                  LEFT JOIN comment_files ON comments.id = comment_files.comment_id
                  WHERE comments.post_id = $post_id AND comments.parent_id = $parent_id
                  ORDER BY comments.time DESC";

        $result = mysqli_query($this->connect(), $query);
        if (!$result) {
            return [];
        }

        $comments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $commentId = $row['id'];

            $comment = [
                'id' => $commentId,
                'comment' => $row['comment'],
                'user_id' => $row['user_id'],
                'post_id' => $row['post_id'],
                'time' => $row['time'],
                'images' => [],
                'files' => [],
                'level'=>$x,
                'replies' => $this->getComments($post_id, $commentId,$x+10) // Recursive call for child comments
            ];

            if (!empty($row['i_name'])) {
                $comment['images'][] = $row['i_name'];
            }

            if (!empty($row['f_name'])) {
                $comment['files'][] = $row['f_name'];
            }

            $comments[] = $comment;
        }

        mysqli_free_result($result); // Free result set
        return $comments;
    }






















    public function getCommentsold($post_id)
    {
        $query = "SELECT comments.*,comment_images.i_name , comment_files.f_name
          FROM comments 
          LEFT JOIN comment_images ON comments.id = comment_images.comment_id
          LEFT JOIN comment_files ON comments.id = comment_files.comment_id
          WHERE comments.post_id = $post_id
          ORDER BY time DESC";

          $result = mysqli_query($this->connect(),$query);
          if(!$result){
                  return []; 
          }
          if ($result) {
            $comments = [];
        
            while ($row = mysqli_fetch_assoc($result)) {
                 $commentId = $row['id'];
                // $user_id = $row['user_id'];
        
                if (!isset($comments[$commentId])) {
                    $comments[$commentId] = array(
                        'id' => $commentId,
                        'comment' => $row['comment'],
                        'user_id' => $row['user_id'],
                        'post_id' => $row['post_id'],
                        'time' => $row['time'],
                        'images' => [],
                        'files' => []
                    );
                }
        
                if (!empty($row['i_name'])) {
                    if(!in_array($row['i_name'],$comments[$commentId]['images'])){
                      $comments[$commentId]['images'][] = $row['i_name'];
                    }
                 }      
                  if (!empty($row['f_name'])) {
                    if(!in_array($row['f_name'],$comments[$commentId]['files'])){
                        $comments[$commentId]['files'][] = $row['f_name'];
    
                      }
                  }



            }


                  mysqli_free_result($result); // Free result set
                  return $comments;
           
        }
    }





    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}
?>
