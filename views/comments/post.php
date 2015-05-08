<div class="comment">
	<label for="inputContent" class="control-label">Leave a comment:</label>
	<form action="/comments/post/<?=$this->post['id']?>" method="POST">
		<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
		<?php if(!$this->isLoggedIn()):?>
			<div class="form-group">
			    <label for="inputUsername" class="control-label">Name</label>
			    <input type="text" class="form-control" id="inputUsername" name="guest_name" placeholder="Name">
		  	</div>
		  	<div class="form-group">
			    <label for="inputEmail" class="control-label">Email (not required)</label>
			    <input type="text" class="form-control" id="inputEmail" name="guest_email" placeholder="Email">
		  	</div>
		<?php endif;?>
		<div>
			<textarea class="form-control" id="inputContent" placeholder="Comment" name="comment_text"></textarea><br/>
			<input class="btn btn-primary" type="submit" value="Post">
	    </div>
	</form>
</div>

