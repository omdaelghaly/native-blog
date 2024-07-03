


  <!-- Custom CSS -->
  <style>
    .post-box {
      background-color: #f0f2f5;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
    }

    .post-box textarea {
      width: 100%;
      border: none;
      /* resize: none; */
      overflow: hidden;
      border-radius:5px;
      box-shadow: none;
    }

    .post-box .btn {
      margin-top: 5px;
    }
    .clear-border {
    
    }
  </style>
</head>
<body class="">
  <div class="container">
    <div class="row">
      <div class="col-md-">
      
        <form action=""  id="form-post" class="post-box" enctype="multipart/form-data">
          <textarea rows="3" name="post" dir="rtl" id="postArea" placeholder=" بماذا تفكر ...... ! " ></textarea>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <input type="file" name="images[]" id="upload-photo" style="display: none;" accept=".jpg, .jpeg, .png, .gif" multiple>
              <label for="upload-photo" class="btn btn-sm btn-secondary"><i class="fas fa-camera"></i> Upload Photo</label>
              <input type="file"  name="files[]" id="upload-file" style="display: none;" accept=".docx, .doc, .pdf" multiple>
              <label for="upload-file" class="btn btn-sm btn-secondary"><i class="fas fa-file"></i> Upload File</label>
            </div>
            <button id="save-post" type="submit" class="btn btn-primary">Post</button>
          </div>
        </form>

      </div>
    </div>
  </div>

</body>
</html>


<script>

  
   
$('#save-post').prop('disabled', true);
      

$(document).ready(function() {
  $('#save-post').prop('disabled', false)
    $('#form-post').submit(function(e) {
        e.preventDefault(); // Prevent normal form submission
        $('#save-post').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... `);
        var formData = new FormData(this);

        
function formDataToObject(formData) {
  const object = {};
  formData.forEach((value, key) => {
    if (object.hasOwnProperty(key)) {
      if (Array.isArray(object[key])) {
        object[key].push(value);
      } else {
        object[key] = [object[key], value];
      }
    } else {
      object[key] = value;
    }
  });
  const imageInput = document.querySelector('input[name="images[]"]'); // Assuming the input field has the name 'images'
  const imageFiles = imageInput.files;
  const imageFileNames = [];
  for (let i = 0; i < imageFiles.length; i++) {
    imageFileNames.push(imageFiles[i].name);
    // console.log(imageFiles[i].name);
  }  
  const fileInput = document.querySelector('input[name="files[]"]'); // Assuming the input field has the name 'files'
  const fileFiles = fileInput.files;
  const fileFileNames = [];
  for (let i = 0; i < fileFiles.length; i++) {
    fileFileNames.push(fileFiles[i].name);
   // console.log(fileFiles[i].name);
  }
  object['name']='<?php echo $_SESSION['name'] ?>';
  object['image']='<?php echo $_SESSION['image'] ?>';
  object['images']= imageFileNames;
  object['files']= fileFileNames;
  return object;
}
   


        $.ajax({
            url: './../../controllers/postController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              $('#save-post').prop('disabled', false).removeClass('disabled').html('post');
              $('#postArea').val('');
              
            socket.emit('new_post',formDataToObject(formData));

              var res = JSON.parse(response);
              console.log(res);
                //alert('Data saved successfully.');
                // Additional code to handle the response if needed
            },
            error: function(xhr, status, error) {
              $('#save-post').prop('disabled', false).removeClass('disabled').html('post');

                alert('Error occurred. Please try again.');
            }
        });
        
    });
});
  
  




  
    
</script>