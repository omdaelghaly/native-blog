<?php
 require_once 'Env.php';

class Edit extends Env{
  
    
 


    
// //save file
    public function editRow($table,$column,$newData,$id)
    {    
    
        $query = "UPDATE $table SET $column = '$newData' WHERE id = $id"; 
        $result_query = mysqli_query($this->connect(),$query);
        if($result_query){
             return '';
        }else{
            return '';
        }   

           // check if post exist 
        //    $query = "SELECT * FROM $table WHERE id = $id"; 
        //    $result_query = mysqli_query($this->connect(),$query);
        //    if($result_query){

        //         $sql = "DELETE FROM $table WHERE $column = $id";    
        //         $result = mysqli_query($this->connect(),$sql);
        //         if($result){
        //                 return $result;
        //        }else{              
        //        }
        //    }else{
        //        return '';
        //    }   

//  if($table==='posts'){
//            ///check if has comments 
//            $query = "SELECT * FROM comments  WHERE $column = $id"; 
//            $result_query = mysqli_query($this->connect(),$query);
//            if($result_query){

//                 $sql = "DELETE FROM comments WHERE $column = $id";    
//                 $result = mysqli_query($this->connect(),$sql);
//                 if($result){
//                         return $result;
//                }else{              
//                }
//            }else{
//                return '';
//            }   
//          /// delete comments images if exist 
//                     $query = "SELECT * FROM comment_images  WHERE $column = $id"; 
//                     $result_query = mysqli_query($this->connect(),$query);
//                     if($result_query){
         
//                          $sql = "DELETE FROM comment_images WHERE $column = $id";    
//                          $result = mysqli_query($this->connect(),$sql);
//                          if($result){
//                                  return $result;
//                         }else{              
//                         }
//                     }else{
//                         return '';
//                     }   


//          /// delete comment file if exist
//                     $query = "SELECT * FROM comment_files  WHERE $column = $id"; 
//                     $result_query = mysqli_query($this->connect(),$query);
//                     if($result_query){
         
//                          $sql = "DELETE FROM comment_files WHERE $column = $id";    
//                          $result = mysqli_query($this->connect(),$sql);
//                          if($result){
//                                  return $result;
//                         }else{              
//                         }
//                     }else{
//                         return '';
//                     }   


// //}




    }


    




    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}
?>
