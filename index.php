<?php
include('header-login.php');
include('functions.php');
?>

<div class="row vertical-offset-100">
	<div id="response" class="alert alert-success" style="display:none;">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<div class="message"></div>
	</div>

	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default login-panel">
		  	<div class="panel-heading panel-login">
		  		<h1 class="text-center">
					<img src="logo.png" class="img-responsive">
				</h1>
		    	
		 	</div>
		  	<div class="panel-body">
		    	<form accept-charset="UTF-8" role="form" method="post" id="login_form">
		    		<input type="hidden" name="action" value="login">
	                <fieldset>
			    	  	<div class="input-group form-group">
			    	  		<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
			    		    <input class="form-control required" name="username" id="username" type="text" placeholder="Enter Username">
			    		</div>
			    		<div class="input-group form-group">
			    		 	<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
			    			<input class="form-control required" placeholder="Password" name="password" type="password" placeholder="Enter Password">
			    		</div>
			    		
			    		<button type="button" id="btn-login" class="btn btn-danger btn-block">Login</button><br>
			    	</fieldset>

					<a href="login.html" class="btn btn-sm">Buy WiFi Vochure<img src="logo2.png" style="width:60px;" alt=""></a>
					<a href="http://localhost/globalpathbilling/subscription_portal.php" class="btn btn-sm">Subscribe For Internet<img src="logo2.png" style="width:60px;" alt=""></a>
		      	</form>
		      	
		      	
		    </div>
		</div>
	</div>
</div>

<?php
	include('footer.php');
?>
