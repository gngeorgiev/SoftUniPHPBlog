<div>
	<label for="inputUsername" class="control-label">Edit comment:</label>
	<form action="/comments/editGuestComment/<?=$this->comment['id']?>" method="POST">
		<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
		<div class="form-group">
		    <label for="inputUsername" class="col-sm-2 control-label">Name</label>
		    <div class="col-sm-10">
		      	<input type="text" class="form-control" id="inputUsername" name="username" placeholder="Name" value="<?=htmlspecialchars($this->comment['username'])?>">
		    </div>
	  	</div>
		<div class="form-group">
		    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
		    <div class="col-sm-10">
		      	<input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?=htmlspecialchars($this->comment['email'])?>">
		    </div>
	  	</div>
	  	<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      	<textarea class="form-control" placeholder="Content" name="content"><?=htmlspecialchars($this->comment['content'])?></textarea><br/>
		    </div>
		</div>
		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      	<br/><input class="btn btn-lg btn-warning" type="submit" value="Edit">
		    </div>
		</div>	
	</form>
</div>


