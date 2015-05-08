<div>
<label for="inputContent" class="control-label">Edit comment:</label>
	<form action="/comments/editUserComment/<?=$this->comment['id']?>" method="POST">
		<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
		<div class="form-group">
	      	<textarea name="content" id="inputContent" class="form-control" placeholder="Content"><?=htmlspecialchars($this->comment['content'])?></textarea>
	  	</div>		
	  	<div class="form-group">
			<input class="btn btn-lg btn-warning" type="submit" value="Edit">
		</div>	
	</form>
</div>

