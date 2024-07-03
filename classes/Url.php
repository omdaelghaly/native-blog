

<?php


class Url
{
   public $url;

    public function __construct() {
        // Get the requested URI
        $this->url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }




  public function getPage()
  {
       $url = $this->url;
       return $url;

  }


};


?>