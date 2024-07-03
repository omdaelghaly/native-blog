<?php
 require_once 'Env.php';

class Chat extends Env{
  
    
 


    
// //save chat msg
    public function sendMsg($table,$columns,$data)
    {
        
           $sql = "INSERT INTO $table $columns VALUES $data ";
           $msg  = mysqli_query($this->connect(),$sql);
            if (!$msg) {
                   die('Error: ' . mysqli_error($this->connect()));
            }else{
                    $sqll = "SELECT * FROM $table WHERE id = LAST_INSERT_ID()";
                    $lmsg = mysqli_query($this->connect(), $sqll);
                   if (!$lmsg) {
                        die('Error: ' . mysqli_error($this->connect()));
                    }else {
                              $row = mysqli_fetch_assoc($lmsg);
                              if($row){
                                  return $row;                            
                              }else{
                                  return 'no returned data because no data inserted';
                              }
                   }
                }
        
    }

    public function getMessages($my_id,$u_id)
    {
            if($my_id>$u_id){
                     $chat_id=$my_id.$u_id;
            }else{
                      $chat_id=$u_id.$my_id;
            };

             $ms = "SELECT * FROM chats WHERE chat_id='$chat_id' ";
             $msq = mysqli_query($this->connect(), $ms);
                   if (!$msq) {
                        die('Error: ' . mysqli_error($this->connect()));
                    }else {
                           $rows=[];
                          while($row = mysqli_fetch_assoc($msq)){
                            $rows[]=$row;
                          }
                           return $rows; // Re
                   }   

                   
    }
    //seen
    public function seenMessage($msg_id)
    {
              $query = "UPDATE chats SET seen = 1 WHERE id = '$msg_id'"; 
              $result_query = mysqli_query($this->connect(),$query);
        if($result_query){
             return true;
        }else{
            return false;
        }   

                   
    }
//////edit
    // //edit chat msg
    public function editMsg($table,$column,$data,$id)
    {
        
            $umsg = "UPDATE $table SET $column='$data' WHERE id='$id'";
            $msg_update  = mysqli_query($this->connect(),$umsg);
            if (!$msg_update) {
                   die('Error: ' . mysqli_error($this->connect()));
            }else{
                    $sqll = "SELECT * FROM $table WHERE id = '$id'";
                    $lmsg = mysqli_query($this->connect(), $sqll);
                   if (!$lmsg) {
                        die('Error: ' . mysqli_error($this->connect()));
                    }else {
                              $row = mysqli_fetch_assoc($lmsg);
                              if($row){
                                  return $row;                            
                              }else{
                                  return 'no returned data because no data inserted';
                              }
                   }
                }
    }
  // //delete chat msg
    public function deleteMsg($table,$id)
    {
                    $sqll = "SELECT * FROM $table WHERE id = '$id'";
                    $msg = mysqli_query($this->connect(), $sqll);
                   if (!$msg) {
                        die('Error: ' . mysqli_error($this->connect()));
                    }else {
                             $row= null;
                             $row = mysqli_fetch_assoc($msg);
                             $del = "DELETE FROM $table  WHERE id='$id'";
                             $delRow  = mysqli_query($this->connect(),$del);

                              if($row){
                                  return $row;                            
                              }else{
                                  return 'no msg found'.$table.$id;
                              }
                   }
            
    }
    /////////////get users chat and new msg///////////

public function getUsersChat($table, $my_id)
{
    $query = "SELECT * FROM $table WHERE (my_id='$my_id' OR other_id='$my_id')";
    $result = mysqli_query($this->connect(), $query);
    if (!$result) {
        return [];
    } else {
        $users = [];
        $unseen = 0; // Counter for unseen rows
        while ($row = mysqli_fetch_assoc($result)) {
            $chat_id = $row['chat_id'];
            if (!isset($users[$chat_id])) {
                $users[$chat_id] = [
                    'id' => $row['id'],
                    'chat_id' => $row['chat_id'],
                    'message' => $row['message'],
                    'my_id' => $row['my_id'],
                    'other_id' => $row['other_id'],
                    'time' => $row['time'],
                ];
            }
            // Increment the unseen count if 'seen' is 0
            if ($my_id!=$row['my_id']&&$row['seen'] == 0) {  //my messages which is unseen 
                $unseen++;
            }
        }
        // Add the unseen count to the result
        $data=['unseen'=>$unseen,'uzers'=>$users];        

        return $data;
    }
}

    
/////////////////////////////////////////////////////////
    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}
?>
