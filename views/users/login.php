<label class="control-label" for="inputUsername">Login:</label>
<form class="form-horizontal" action="/users/login" method="POST">
<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<div class="form-group">
	    <label for="inputUsername" class="col-sm-3 control-label">Username</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
	    </div>
  	</div>
  	<div class="form-group">
	    <label for="inputPassword" class="col-sm-3 control-label">Password</label>
	    <div class="col-sm-9">
	      <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
	    </div>
  	</div>
  	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	      	<input class="btn btn-lg btn-primary" type="submit" value="Login">
	    </div>
  	</div>
</form>