
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="./../../assets/img/logo.png" alt="">
                  <span class="d-none d-sm-block">
                    <?php echo Env::siteName; ?>
                  </span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2" >
                    <!-- success alert-->
              <div class="alert alert-success alert-dismissible fade show text-center successDiv" role="alert">
                 <span class="success"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                   <!-- error alert -->
              <div class="alert alert-danger alert-dismissible fade show text-center errorDiv" role="alert">
                <span class="error"> </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                    
                    <h5 class="card-title text-center pb-0 fs-4 ">Create an Account</h5>
                    <p class="text-center small ">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id="registrationForm">
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback name-error" >Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback email-error" >Please enter a valid Email address!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback username-error" >Please choose a username!</div>
                      </div>
                    </div>
<!--  -->
                  <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      
                   <div class="input-group">

                      <div class="d-inline-flex col-12">
                      <input type="password" name="password" class="form-control grow" id="yourPassword" required>
                      <button class="btn btn-outline border-0" type="button" id="toggle-password" >
                             <i class="bi bi-eye"></i>
                     </button>
                      </div>
                    </div>

                      <div class="invalid-feedback password-error" >Please enter your password!</div>
                  </div>
<!--  -->
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="createAccount" type="submit">Create Account</button>
                    </div>
                    <div class="col-12 mt-5">
                    <span class="small mb-0">Already have an account? 
                      Click Login 
                      </span>
                      <a href="#" id="upBtn" >
                          <i class="bi bi-arrow-up-short bg-primary" style="color:white"></i></a>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main --> 
<style>
  .is_invalid {
    border-color: #dc3545 !important;
}
.normalBorder{
  border-color:gray;
}
</style> 




    <script>
        $('.successDiv').hide();
        $('.errorDiv').hide();
      
        $(document).ready(function() {
            $('#registrationForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission
                var formData = $(this).serialize(); // Serialize form data
                $('.successDiv').hide();
                $('.errorDiv').hide();

    // Check if the checkbox is checked
         if ($('#acceptTerms').is(':checked')) {
          $('#createAccount').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... `);

   

                $.ajax({
                    url: './../../controllers/register.php', // PHP script to handle the request
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                      var res = JSON.parse(response);
                      $('#createAccount').prop('disabled', false).removeClass('disabled').html('Create Account');
                      // console.log(res);
                         if(res.status==='success'){
                            $('.successDiv').show();
                            $('.success').text(res.msg.msg); // Display response message
                            $('input').val('');
                            $('input').addClass('normalBorder'); 
                            $('#upBtn').click();
                            setTimeout(() => {
                              window.location.href = '/components/auth/index.php';
                            }, 2);                      
                         }else{
                            $('input').removeClass('normalBorder');                       

                          if(res.msg.email){
                            $(".email-error").text(res.msg.email);
                            $(".email-error").show();
                            $("#yourEmail").addClass("is_invalid");
                          }else if(res.msg.userName){
                            $('.username-error').text(res.msg.userName);
                            $('.username-error').show();
                            $("#yourUsername").addClass("is_invalid"); 
                          }else if(res.msg.name){
                            $('.name-error').show();
                            $('.name-error').text(res.msg.name);
                            $("#yourName").addClass("is_invalid");                            
                          }else if(res.msg.password){
                            $('.password-error').text(res.msg.password);
                            $('.password-error').show();
                            $("#yourPassword").addClass("is_invalid");
                          }else if(res.msg.error){
                            $('.errorDiv').show();
                            $('.error').text(res.msg.error);
                          }
                           
                         }
                    },
                    error: function(xhr, status, error) {
                      var res = JSON.parse(xhr.responseText); 
                  $('#createAccount').prop('disabled', false).removeClass('disabled').html('Create Account');
      
                        console.log('in error');
                    }
               });

         }else {
      // Do something when the checkbox is not checked
      console.log("Checkbox is not checked");
    }


            });


  
  

///////any input key up 
$('input').on('keyup', function() {
        var inputField = $(this);
        inputField.removeClass('is_invalid').addClass('normalBorder');

        var errorDiv = inputField.attr('name')+'-error';
        $('.'+errorDiv).text('');

       // console.log('Input Name:', '.'+errorDiv);
      });


/////togal pass show
      $('#toggle-password').click(function() {
        var passwordInput = $('#yourPassword');
        var toggleButton = $(this);

        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          toggleButton.find('i').removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
          passwordInput.attr('type', 'password');
          toggleButton.find('i').removeClass('bi-eye-slash').addClass('bi-eye');
        }
      });
//////////////////




        });
  
  
    </script>
