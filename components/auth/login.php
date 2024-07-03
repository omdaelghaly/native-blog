



  <main>
    <div class="container " >

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
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

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id="loginForm">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="login-user" class="form-control" id="login-user"
                        value="<?php echo isset($_COOKIE['login']) ? $_COOKIE['login'] : ''; ?>" required>
                        <div class="invalid-feedback login-user-error">Please enter your username or email...</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group">
                      <div class="d-inline-flex col-12">
                        <input type="password" name="login-password" class="form-control grow" id="login-password"
                        value="<?php  echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>"  required>
                        <button class="btn btn-outline border-0" type="button" id="toggle-login-password" >
                             <i class="bi bi-eye"></i>
                       </button>
                      </div>
                    </div>

                    <div class="invalid-feedback login-password-error">Please enter your password!</div>


                    </div>
<!--  -->
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="loginBtn">Login</button>
                    </div>
                    <div class="col-12 mt-5">
                    <span class="small mb-0">Don't have an account? 
                      Click Register 
                      </span>
                      <a href="#"  >
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
      
      
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission
                var formData = $(this).serialize(); // Serialize form data
                 var login = $('#login-user').val().trim();
                 var pass =  $('#login-password').val().trim() ;
                 console.log(pass + login);
                if (login !== "" ) {
                   if(pass !==''){

          $('#loginBtn').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... `);

   

                $.ajax({
                    url: './../../controllers/Login.php', // PHP script to handle the request
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                      var res = JSON.parse(response);
                      $('#loginBtn').prop('disabled', false).removeClass('disabled').html('Login');
                      // console.log(res);
                         if(res.status==='success'){
                            $('.successDiv').show();
                            $('.success').text(res.msg.success); // Display response message
                            $('input').val(' ');
                            $('input').addClass('normalBorder');    
                            window.location.href = '/';
                   
                         }else{
                            $('input').removeClass('normalBorder');                       

                          if(res.msg.login){
                            $(".login-user-error").text(res.msg.login);
                            $(".login-user-error").show();
                            $("#login-user").addClass("is_invalid");                          
                          }else if(res.msg.password){
                            $('.login-password-error').text(res.msg.password);
                            $('.login-password-error').show();
                            $("#login-password").addClass("is_invalid");
                          }else if(res.msg.error){
                            $('.errorDiv').show();
                            $('.error').text(res.msg.error);
                          }
                           
                         }
                    },
                    error: function(xhr, status, error) {
                      var res = JSON.parse(xhr.responseText); 
                     $('#loginBtn').prop('disabled', false).removeClass('disabled').html('Create Account');
      
                        console.log('in error');
                    }
                });

                }else{ //empty pass
                  $(".login-password-error").show();
                  $(".login-password-error").text('Please enter your password !');

                }
                }else{  //empty login
                  $(".login-user-error").text('Please enter your username or email !');

                }

            });


  
  

///////any input key up 
$('input').on('keyup', function() {
        var inputField = $(this);
        inputField.removeClass('is_invalid').addClass('normalBorder');

        var errorDiv = inputField.attr('name')+'-error';
        $('.'+errorDiv).text('');

        //console.log('Input Name:', '.'+errorDiv);
      });


/////toggle pass show
      $('#toggle-login-password').click(function() {
        var passwordInput = $('#login-password');
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