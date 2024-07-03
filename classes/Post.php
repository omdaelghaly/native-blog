<?php
 require_once 'Env.php';

class Post extends Env{

// //save file
    public function saveFile($files,$saveDIR,$table,$columns,$data)
    {
        $user_id=$data['user_id'];
        $post_id=$data['post_id'];
      
       foreach ($files['tmp_name'] as $index => $tmpName) {
            $originName = $files['name'][$index];
            $fileName = uniqid().$originName;
            move_uploaded_file($tmpName, $saveDIR.$fileName);

            $DATA = "('$user_id','$post_id','$fileName')";


        // Insert the image det['tmp_name']ails into the database
         $sql = "INSERT INTO $table $columns VALUES $DATA ";

            if (mysqli_query($this->connect(),$sql)=== false) {
               die('Error: ' );
            }
         }

        
    }


    public function getPosts()
    {
        $query = "SELECT posts.*,post_images.i_name , post_files.f_name
          FROM posts
          LEFT JOIN post_images ON posts.id = post_images.post_id
          LEFT JOIN post_files ON posts.id = post_files.post_id
          ORDER BY time DESC";

          $result = mysqli_query($this->connect(),$query);
          if(!$result){
                  return []; 
          }
          //var_dump($result);
if($result){
          $posts = [];
          while ($row = mysqli_fetch_assoc($result)) {
              $postId = $row['id'];
              if (!isset($posts[$postId])) {
                  $posts[$postId] = [
                      'id' => $postId,
                      'post' => $row['post'],
                      'user_id' => $row['user_id'],
                      'time' => $row['time'],
                      'images' => [],
                      'files' => []
                  ];
              }
      
              if (!empty($row['i_name'])) {
                if(!in_array($row['i_name'],$posts[$postId]['images'])){
                  $posts[$postId]['images'][] = $row['i_name'];
                }
             }      
              if (!empty($row['f_name'])) {
                  if(!in_array($row['f_name'],$posts[$postId]['files'])){
                    $posts[$postId]['files'][] = $row['f_name'];

                  }
              }


          }
      
          mysqli_free_result($result); // Free result set
         return $posts;

        //   var_dump($posts);
        //var_dump($posts[$postId]['images']);
 }


    }




    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}
?>
