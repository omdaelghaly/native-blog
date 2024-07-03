<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show file</title>
</head>
<?php 

$file_name = isset($_GET['file'])?$_GET['file']:false;

?>

<body>
    <h1>show file</h1>

    <div style="width:100%;height:100vh" >
        <!-- Replace 'path_to_your_file.php' with the path to your file -->
        <!-- <embed src="http://newsite.com/aa.pdf" type="application/pdf" width="100%" height="100%" />
        <iframe src="http://newsite.com/aa.doc" type="application/doc" width="100%" height="100%" ></iframe> -->

        <!-- <iframe src="http://newsite.com/66019c9e5abe6document.doc" type="application/docx"></iframe> -->
            <!-- <iframe style="width:600px; height:500px;" 
            src="https://docs.google.com/gview?url=66019c9e5abe6document.doc&embedded=true"></iframe> -->
            
 <!-- <iframe src="https://docs.google.com/gview?url=http://newsite.com/aa.doc&embedded=true" width="100%" height="900px" frameborder="0"></iframe>    </div>

  <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://newsite.com/aa.doc' width='100%' height='650px' frameborder='0'></iframe> -->
   
   <?php 
   if($file_name){ ?>
    <iframe src="/assets/images/posts/files/<?php echo $file_name;?>" width="100%" height="600px">
        <p>Your browser does not support iframes.</p>
    </iframe>
    <?php
    }else  { ?>
        
        <p>This file or Your browser does not support iframes.</p>
    
   <?php } ?>
</body>
</html>
