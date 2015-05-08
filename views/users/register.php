<label class="control-label" for="inputUsername">Register:</label>
<form action="/users/register" class="form-horizontal" method="POST">
<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<div class="form-group">
	    <label for="inputUsername" class="col-sm-4 control-label">Username</label>
	    <div class="col-sm-8">
	      <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="<?= htmlspecialchars($this->username) ?>">
	    </div>
  	</div>
  	<div class="form-group">
	    <label for="inputPassword" class="col-sm-4 control-label">Password</label>
	    <div class="col-sm-8">
	      	<input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" value="<?= htmlspecialchars($this->password) ?>">
	    </div>
  	</div>
  	<div class="form-group">
	    <label for="inputPasswordRep" class="col-sm-4 control-label">Repeat password</label>
	    <div class="col-sm-8">
	      <input type="password" class="form-control" id="inputPasswordRep" name="repeatPassword" placeholder="Repeat password" value="<?= htmlspecialchars($this->repeatPassword) ?>">
	    </div>
  	</div>
	<div class="form-group">
	    <label for="inputEmail" class="col-sm-4 control-label">Email</label>
	    <div class="col-sm-8">
	      <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?= htmlspecialchars($this->email) ?>">
	    </div>
  	</div>
  	<div class="form-group">
	    <div class="col-sm-offset-4 col-sm-8">
	      	<br/><input class="btn btn-lg btn-primary" type="submit" value="Register">
	    </div>
  	</div>
</form>