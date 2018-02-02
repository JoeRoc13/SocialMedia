<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" id="websiteDetails">
      <div class="container">
        <h1>Welcome to {Site Name}</h1>
	        <div class="row">
		        <div class="col-md-4">
		          <h3>See photos and updates</h3>
		          <p style="font-size: 16px">from friends in the News Feed.</p>
		        </div>
		        <div class="col-md-4">
		          <h3>Share what's new</h3>
		          <p style="font-size: 16px">in your life on your Timeline.</p>
		       </div>
		        <div class="col-md-4">
		          <h3>Find more</h3>
		          <p style="font-size: 16px">of what you're looking for with {SiteName} search.</p>
		        </div>
	      </div>
      </div>
    </div>

    <div class="container">
      <div class="col-md-6 col-md-offset-3">
			<h2>Join today.</h2>
			<br />
      <p class="alert alert-danger" id="error-msg" hidden></p>
			<form data-toggle="validator" role="form" id="formSignUp" method="post">
				<div class="form-group">
			    <label for="inputEmail" class="control-label">Email</label>
			    <input name="email" type="email" pattern="[A-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" id="email" placeholder="Email" data-error="Invalid Email address." required>
			    <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
			    <label for="inputName" class="control-label">Name</label>
			    <input name="name" type="text" class="form-control" id="name" placeholder="John Doe" required>
			    <div class="help-block-with-errors"></div>
			  </div>
			  <div class="form-group">
			    <label for="inputUsername" class="control-label">Username</label>
			    <input name="username" type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" class="form-control" id="username" placeholder="Username" required>
			    <div class="help-block with-errors"></div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword" class="control-label">Password</label>
			    <div class="form-inline row">
			      <div class="form-group col-sm-6">
			        <input name="password" type="password" data-minlength="6" class="form-control" id="password" placeholder="Password" required>
			        <div class="help-block">Minimum of 6 characters</div>
			      </div>
			      <div class="form-group col-sm-6">
			        <input name="confirm" type="password" class="form-control" id="confirm" data-match="#password" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
			        <div class="help-block with-errors"></div>
			      </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <button id="btnSignUp" type="submit" class="btn btn-primary">Submit</button>
			  </div>
			</form>
			<div class="small">By signing up, you agree to the <a href='./legal/terms'>Terms of Service</a> and <a href='./legal/privacy'>Privacy Policy</a>.</div>
