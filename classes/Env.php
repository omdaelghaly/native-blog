<?php


class Env
{
  const siteName = "newsite.com";
  const host ='localhost';
  const dbUser = 'root';
  const dbPass ='';
  const dbName ='blog1';




  
  public function connect()
  {
    $connect = new mysqli($this::host, $this::dbUser, $this::dbPass, $this::dbName);
     if($connect){
               return $connect;
      }else{
        die("Connection failed " );
      }         
  }


};


?>