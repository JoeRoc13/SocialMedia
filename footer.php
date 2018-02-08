      <hr>

      <footer>
        <p>&copy; <?php echo date("Y"); ?> {SiteName}, Inc.</p>
      </footer>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Bootstrap Validator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


  </body>

  <script>
    $(document).ready(function() {

      $('#formSignIn').validator().on('submit', function(e) {
        e.preventDefault();

        var dataString = $('#formSignIn').serialize();
        var empty = false;

        $('#formSignIn :input.form-control').each(function() {
          if($(this).val().trim().length == 0) {
            empty = true;
          }
        });

        if(!empty) {
          $.ajax({
            url: "<?php echo $get_root; ?>/login/login.php",
            type: "post",
            data: dataString,
            dataType: "json",
            success: function(response) {
              if(response.success) {
                document.location.reload();
              } else {
                if(response.message == "Incorrect email or password") {
                  console.log(response);
                  console.log("Incorrect email or password");
                } else if (response.message == "Email not on file") {
                  console.log("Email not on file");
                }
              }
            },
            error: function(err) {
              console.log(err.responseText);
            }
          });
        }
      });

      $('#formSignUp').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {

        } else {
          e.preventDefault();
          var dataString = $('#formSignUp').serialize();
          $.ajax({
            url: "<?php echo $get_root; ?>/signup/signup.php",
            type: "post",
            data: dataString,
            dataType: "json",
            success: function(response) {
              if(response.success) {
                console.log("Account created");
              } else {
                if(response.message == "Email exists") {
                  $('#error-msg').text("An account is already active with this email address.");
                  $('#error-msg').show();
                } else if(response.message == "Username taken") {
                  $('#error-msg').text("Username already in use.");
                  $('#error-msg').show();
                }
              }
            },
            error: function(err) {
              console.log(err.responseText);
            }
          });
        }
      });

    });
  </script>
</html>
